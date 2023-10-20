<?php

const COASTER_RENAME_SUBCATEGORIES = array("dressers & dresser mirrors" => "dressers & mirrors",
    "youth chests" => "youth chests & accessories",
    "youth dressers & dresser mirrors" => "youth dressers & mirrors",
    "bar carts" => "bar",
    "bar stools" => "bar",
    "counter ht dining" => "counter height dining",
    "counter ht dining chairs & stools" => "counter height dining",
    "counter ht dining tables" => "counter height dining",
    "dining room benches" => "dining chair & bench",
    "dining room chairs" => "dining chair & bench",
    "sideboards & buffets" => "sideboards, buffets & curio",
    "bookcases" => "bookcases, bookshelves & file cabinet",
    "accent pillows" => "rug & pillow",
    "lamps" => "lighting",
    "rugs" => "rug & pillow");

const COASTER_HEADERS = array(
    "keycode" => "45FDCB85CF2F440E9750F1E96A"
);

const CACHE_COASTER_FILE = "/themes/sibosfurniture-master/cache_coaster.json";
const CACHE_COASTER_TO_CREATE = "/themes/sibosfurniture-master/cache_coaster_to_create.json";
const CACHE_COASTER_PRICES_FILE = "/themes/sibosfurniture-master/cache_coaster_prices.json";
const CACHE_COASTER_CATEGORIES_FILE = "/themes/sibosfurniture-master/cache_coaster_categories.json";
const CACHE_COASTER_PROGRESS = "/themes/sibosfurniture-master/cache_coaster_progress.json";
const LOGGER_FILE = "/themes/sibosfurniture-master/logs.txt";

const CACHE_FILE_PATH = WP_CONTENT_DIR . CACHE_COASTER_FILE;
const CACHE_TO_CREATE_FILE_PATH = WP_CONTENT_DIR . CACHE_COASTER_TO_CREATE;
const CACHE_PRICES_FILE_PATH = WP_CONTENT_DIR . CACHE_COASTER_PRICES_FILE;
const CACHE_CATEGORIES_FILE_PATH = WP_CONTENT_DIR . CACHE_COASTER_CATEGORIES_FILE;
const CACHE_COASTER_PROGRESS_FILE_PATH = WP_CONTENT_DIR . CACHE_COASTER_PROGRESS;
const LOGGER_FILE_PATH = WP_CONTENT_DIR . LOGGER_FILE;


add_action('run_coaster_update', 'coaster_runJob_update');

function coaster_runJob_update(): void
{
    $products = coaster_read_product_cache(); // Or create if is does not exists
    $prices_map = coaster_read_product_price_cache();
    $inventory_stock = coaster_get_quantity_map();

    $to_create_arr = array();
    if (empty($prices_map) || empty($inventory_stock)) {
        return;
    }

    if (!empty($products)) {
        for ($i = 0; $i < sizeof($products); $i++) {
            $sku = $products[$i]['ProductNumber'];
            $product_id = wc_get_product_id_by_sku($sku);

            if ($product_id != null) {
                coaster_update_existing_product($product_id, $products[$i], $prices_map[$sku], $inventory_stock[$sku]);
            } else {
                // Write sku to file for creation
                $to_create_arr[] = $sku;
            }
        }
        $to_create_file = fopen(CACHE_TO_CREATE_FILE_PATH, 'w');
        fwrite($to_create_file, json_encode($to_create_arr));
        fclose($to_create_file);
    }
}

add_action('run_coaster_create', 'coaster_runJob_create');

function coaster_runJob_create(): void
{
    $products = coaster_prepare_sku_to_product(coaster_read_product_cache()); // Or create if is does not exists
    $products_to_create = coaster_read_product_to_create_cache();
    $prices_map = coaster_read_product_price_cache();
    $categories_cache = coaster_read_categories_cache();
    $coaster_categories = $categories_cache['categories'];
    $coaster_subcategories = $categories_cache['subcategories'];
    $inventory_stock = coaster_get_quantity_map();

    if (empty($prices_map) || empty($categories_cache) || empty($inventory_stock)) {
        return;
    }

    if (filesize(CACHE_COASTER_PROGRESS_FILE_PATH) > 0) {
        $progress_file = fopen(CACHE_COASTER_PROGRESS_FILE_PATH, "r");
        $progress = intval(fread($progress_file, filesize(CACHE_COASTER_PROGRESS_FILE_PATH)));
    } else {
        $progress_file = fopen(CACHE_COASTER_PROGRESS_FILE_PATH, "w");
        $progress = 0;
        fwrite($progress_file, $progress);
    }
    fclose($progress_file);

    $counter = 0;
    if (!empty($products_to_create) && !empty($products)) {
        for ($i = $progress; $i < sizeof($products_to_create); $i++) {
            if($counter == 5){
                return;
            }
            $progress_file = fopen(CACHE_COASTER_PROGRESS_FILE_PATH, "w");
            fwrite($progress_file, $i);
            fclose($progress_file);

            $sku = $products_to_create[$i];
            $product_id = wc_get_product_id_by_sku($sku);
            log_info($sku, "[COASTER] Started product");
            if ($product_id != null) {
                continue;
            } else {
                if (!coaster_check_is_discontinued($products[$sku])) {
                    coaster_create_new_product($products[$sku], $prices_map[$sku], $coaster_categories, $coaster_subcategories, $inventory_stock[$sku]);
                }
            }
            $counter++;
        }
        $progress_file = fopen(CACHE_COASTER_PROGRESS_FILE_PATH, "w");
        fwrite($progress_file, 0);
        fclose($progress_file);
    }
}

function log_info($sku, $message): void
{
    $logger = fopen(LOGGER_FILE_PATH, "a+");
    $currentDateTime = date('Y-m-d H:i:s');
    fwrite($logger, "[" . $currentDateTime . "] " . "[" . $sku . "] " . $message . "\n");
    fclose($logger);
}

function clear_log(): void
{
    $logger = fopen(LOGGER_FILE_PATH, "w");
    fclose($logger);
}

function coaster_get_quantity_map(): array
{
    $qty_url = "http://api.coasteramer.com/api/product/GetInventoryList";
    $qty_response_url = json_decode(wp_remote_get($qty_url, array(
        'timeout' => 3000,
        'headers' => COASTER_HEADERS
    ))['body'], true);
    $inventory_array = array();
    foreach ($qty_response_url[0]['InventoryList'] as $inventory_info) {
        $inventory_array[$inventory_info['ProductNumber']] = intval($inventory_info['QtyAvail']);
    }
    return $inventory_array;
}

function coaster_update_existing_product($existing_product_id, array $product, float $price, int $stock_qty)
{
    $existing_product = new WC_Product_Simple($existing_product_id);

    $modified_time = strtotime(get_post_modified_time('Y-m-d', false, $existing_product->get_id()));
    $current_time = strtotime(current_time('Y-m-d'));
    $week_ago = strtotime('-1 week', $current_time);

    if ($modified_time >= $week_ago) {
        log_info($product['ProductNumber'], "[COASTER] Skipped, updated less then a week ago");
    } else {
        $is_discontinued = coaster_check_is_discontinued($product);
        // Managing stock properties
        if ($is_discontinued || $stock_qty <= 0) {
            $existing_product->set_stock_status('outofstock');
            log_info($product['ProductNumber'], "[COASTER] Went out of stock");
        } else {
            $existing_product->set_stock_status('instock');
        }
        // Managing price properties
        $existing_product->set_regular_price($price);

        $existing_product->save();
        log_info($product['ProductNumber'], "[COASTER] Updated");
    }
}

function coaster_create_new_product(array $product, float $price, array $coaster_categories, array $coaster_subcategories, int $stock_qty)
{
    $is_error = false;
    $new_product = new WC_Product_Simple();
    $new_product->set_featured(FALSE);
    $new_product->set_catalog_visibility('visible');
    $new_product->set_reviews_allowed(TRUE);

    if ($stock_qty <= 0) {
        $new_product->set_stock_status('outofstock');
    } else {
        $new_product->set_stock_status('instock');
    }

    $sku = $product['ProductNumber'];
    $name = $product['Name'];
    if (isset($product['Description'])) {
        $description = $product['Description'];
    } else {
        $description = $name;
    }

    $new_product->set_name($name);
    //Set product description.
    $new_product->set_description($description);
    //Set SKU
    $new_product->set_sku($sku);

    if ($price > 0) {
        $new_product->set_regular_price($price);
    } else {
        $is_error = true;
    }

    $category_ids = array();
    if (isset($product['CategoryCode'])) {
        $category_code = $product['CategoryCode'];
        if (array_key_exists($category_code, $coaster_categories)) {
            $category_name = ucfirst($coaster_categories[$category_code]);
            $full_category = get_term_by('name', $category_name, 'product_cat');
            $category_id = $full_category->term_id;
            $category_ids[] = $category_id;
        }
    }
    if (isset($product['SubCategoryCode'])) {
        $subcategory_code = $product['SubCategoryCode'];
        if (array_key_exists($subcategory_code, $coaster_subcategories)) {
            $subcategory_name = ucwords($coaster_subcategories[$subcategory_code]);
            $full_subcategories = get_terms(array(
                'taxonomy' => 'product_cat', // set your taxonomy here
                'hide_empty' => false,
                'name' => $subcategory_name,
            ));
            foreach ($full_subcategories as $full_subcategory) {
                $subcategory_id = $full_subcategory->term_id;
                $category_ids[] = $full_subcategory->parent;
                $category_ids[] = $subcategory_id;
            }
        }
    }
    if (sizeof($category_ids) > 0) {
        $category_ids = array_unique($category_ids);
        $new_product->set_category_ids($category_ids);
    } else {
        $is_error = true;
    }

    $raw_attributes = array();
    if (isset($product['MeasurementList'])) {
        $measurementList = $product['MeasurementList'];
        $measurement_array = [];
        if (count($measurementList) == 1) {
            $allKeys = array_keys($measurementList[0]);
            $allValues = array_values($measurementList[0]);
            for ($i = 1; $i < count($measurementList[0]); $i++) {
                if ($allValues[$i] > 0) {
                    $attribute = new WC_Product_Attribute();
                    if (strtolower($allKeys[$i]) == strtolower("Weight")) {
                        $attribute->set_name("Product " . strtolower($allKeys[$i]));
                    } else {
                        $attribute->set_name($allKeys[$i]);
                    }
                    $attribute->set_options(array($allValues[$i]));
                    $attribute->set_visible(true);
                    $attribute->set_variation(false);
                    $raw_attributes[] = $attribute;
                }
            }
        } else {
            for ($i = 0; $i < count($measurementList); $i++) {
                $piece_name = $measurementList[$i]['PieceName'];
                $allKeys = array_keys($measurementList[$i]);
                $allValues = array_values($measurementList[$i]);
                for ($j = 1; $j < count($measurementList[$i]); $j++) {
                    if ($allValues[$j] > 0) {
                        $attribute = new WC_Product_Attribute();
                        $attribute->set_name($piece_name . " " . $allKeys[$j]);
                        $attribute->set_options(array($allValues[$j]));
                        $attribute->set_visible(1);
                        $attribute->set_variation(0);
                        $raw_attributes[] = $attribute;
                    }
                }
            }
        }
    }

    if (isset($product['MaterialList'])) {
        $product_materials = $product['MaterialList'];
        $materials_array = [];
        foreach ($product_materials as $product_material) {
            array_push($materials_array, $product_material['Value']);
        }
        $materials = implode(', ', $materials_array);
        $attribute = new WC_Product_Attribute();
        $attribute->set_name("Materials");
        $attribute->set_options(array($materials));
        $attribute->set_visible(1);
        $attribute->set_variation(0);
        $raw_attributes[] = $attribute;
    }

    if (isset($product['CountryOfOrigin'])) {
        $countryOfOrigin = $product['CountryOfOrigin'];
        $attribute = new WC_Product_Attribute();
        $attribute->set_name("Country of origin");
        $attribute->set_options(array($countryOfOrigin));
        $attribute->set_visible(1);
        $attribute->set_variation(0);
        $raw_attributes[] = $attribute;
    }

    if (isset($product['FabricColor'])) {
        $fabricColor = $product['FabricColor'];
        $attribute = new WC_Product_Attribute();
        $attribute->set_name("Fabric color");
        $attribute->set_options(array($fabricColor));
        $attribute->set_visible(1);
        $attribute->set_variation(0);
        $raw_attributes[] = $attribute;
    }

    if (isset($product['FinishColor'])) {
        $finishColor = $product['FinishColor'];
        $attribute = new WC_Product_Attribute();
        $attribute->set_name("Finish color");
        $attribute->set_options(array($finishColor));
        $attribute->set_visible(1);
        $attribute->set_variation(0);
        $raw_attributes[] = $attribute;
    }

    if (isset($product['AdditionalFieldList'])) {
        $additionalFieldList = $product['AdditionalFieldList'];
        foreach ($additionalFieldList as $additionalField) {
            $attribute = new WC_Product_Attribute();
            $attribute->set_name($additionalField['Field']);
            $attribute->set_options(array($additionalField['Value']));
            $attribute->set_visible(1);
            $attribute->set_variation(0);
            $raw_attributes[] = $attribute;
        }
    }
    $attribute = new WC_Product_Attribute();
    $attribute->set_name("Manufacture");
    $attribute->set_options(array("Coaster"));
    $attribute->set_visible(1);
    $attribute->set_variation(0);
    $raw_attributes[] = $attribute;
    if (sizeof($raw_attributes) > 0) {
        $new_product->set_attributes($raw_attributes);
    }

    var_dump($sku);
    if (isset($product['PictureFullURLs'])) {
        $img_urls_array = explode(',', $product['PictureFullURLs']);
        var_dump($img_urls_array);
        $img_ids = [];
        try {
            foreach ($img_urls_array as $url) {
                array_push($img_ids, rs_upload_from_url($url, $sku));
            }
        } catch (Exception $e) {
            exit();
        }
        if (sizeof($img_ids) > 0) {
            $main_img_id = $img_ids[0];
            var_dump($main_img_id);
            if (sizeof($img_ids) > 1) {
                unset($img_ids[0]); // remove item at index 0
                $img_ids = array_values($img_ids); // 'reindex' array
                $new_product->set_gallery_image_ids($img_ids);
            }
            $new_product->set_image_id($main_img_id);
        } else {
            $is_error = true;
        }
    } else {
        $is_error = true;
    }
    var_dump($is_error);

    if ($is_error) {
        $new_product->set_status('draft');
    } else {
        $new_product->set_status('publish');
    }
    $new_product->save();
    log_info($sku, "[COASTER] Created");
}

function coaster_check_is_discontinued(array $product): bool
{
    $status = boolval($product['IsDiscontinued']);
    if ($status) {
        log_info($product['ProductNumber'], "Discontinued");
    }
    return $status;
}

add_action('coaster_create_product_cache', 'coaster_create_product_cache');

function coaster_create_product_cache(): void
{
    $cache_json = fopen(CACHE_FILE_PATH, "w");
    //Is discontinued filter
    /*$filter_api = "http://api.coasteramer.com/api/product/GetFilter?isDiscontinued=false";
    $filter_code = json_decode(wp_remote_get($filter_api, array(
        'timeout' => 3000,
        'headers' => COASTER_HEADERS
    ))['body']);*/

//    $all_products_url = "http://api.coasteramer.com/api/product/GetProductList?filterCode=".$filter_code;
    $all_products_url = "http://api.coasteramer.com/api/product/GetProductList";
    $product_response = wp_remote_get($all_products_url, array(
        'timeout' => 3000,
        'headers' => COASTER_HEADERS
    ))['body'];

    fwrite($cache_json, $product_response);
    fclose($cache_json);
}

function coaster_read_product_cache(): array
{
    $cache_json = fopen(CACHE_FILE_PATH, "r");
    if (filesize(CACHE_FILE_PATH) > 0) {
        $cache = fread($cache_json, filesize(CACHE_FILE_PATH));
        fclose($cache_json);
        return json_decode($cache, true);
    } else {
        return array();
    }
}

add_action('coaster_create_prices_cache', 'coaster_create_prices_cache');

function coaster_create_prices_cache(): void
{
    $cache_json = fopen(CACHE_PRICES_FILE_PATH, "w");
    $product_number_to_price_map = array();
//    $api_string_prices = "http://api.coasteramer.com/api/product/GetPriceList?filterCode=FL-10139"; // Filter isDiscontinued = true
    $api_string_prices = "http://api.coasteramer.com/api/product/GetPriceList"; // Filter isDiscontinued = true
    $prices_response = wp_remote_get($api_string_prices, array(
        'timeout' => 3000,
        'headers' => COASTER_HEADERS
    ))['body'];

    $price_json = json_decode($prices_response, true);
    $prices = $price_json[0]['PriceList'];
    foreach ($prices as $product_price_info) {
        $product_number_to_price_map[$product_price_info['ProductNumber']] = floatval($product_price_info['MAP']);
    }

    fwrite($cache_json, json_encode($product_number_to_price_map));
    fclose($cache_json);
}

function coaster_read_product_price_cache(): array
{
    $cache_json = fopen(CACHE_PRICES_FILE_PATH, "r");
    if (filesize(CACHE_PRICES_FILE_PATH) > 0) {
        $cache = fread($cache_json, filesize(CACHE_PRICES_FILE_PATH));
        fclose($cache_json);
        return json_decode($cache, true);
    } else {
        return array();
    }
}

function coaster_prepare_sku_to_product($products): array
{
    $result = array();
    for ($i = 0; $i<sizeof($products); $i++){
        $result[$products[$i]['ProductNumber']] = $products[$i];
    }
    return $result;
}

function coaster_read_product_to_create_cache(): array
{
    $cache_json = fopen(CACHE_TO_CREATE_FILE_PATH, "r");
    if (filesize(CACHE_TO_CREATE_FILE_PATH) > 0) {
        $cache = fread($cache_json, filesize(CACHE_TO_CREATE_FILE_PATH));
        fclose($cache_json);
        return json_decode($cache, true);
    } else {
        return array();
    }
}

add_action('coaster_create_categories_cache', 'coaster_create_categories_cache');

function coaster_create_categories_cache(): void
{
    $categories_url = "http://api.coasteramer.com/api/product/GetCategoryList";
    $categories_response = json_decode(wp_remote_get($categories_url, array(
        'headers' => COASTER_HEADERS
    ))['body'], true);

    $coaster_categories = array();
    $coaster_subcategories = array();
    $coaster_category_code_to_subcategories = array();

    foreach ($categories_response as $full_category) {
        if (strtolower($full_category['CategoryName']) === "home office") {
            $coaster_categories[$full_category['CategoryCode']] = "home office & studio";
        } elseif (strtolower($full_category['CategoryName']) === "home decor") {
            $coaster_categories[$full_category['CategoryCode']] = "accessories";
        } else {
            $coaster_categories[$full_category['CategoryCode']] = strtolower($full_category['CategoryName']);
        }
        $subcategory_objects = array();
        foreach ($full_category['SubCategoryList'] as $subcategory) {
            if (array_key_exists(strtolower($subcategory['SubCategoryName']), COASTER_RENAME_SUBCATEGORIES)) {
                $coaster_subcategories[$subcategory['SubCategoryCode']] = COASTER_RENAME_SUBCATEGORIES[strtolower($subcategory['SubCategoryName'])];// SC-10XX => Subcategory name
                $subcategory['SubCategoryName'] = COASTER_RENAME_SUBCATEGORIES[strtolower($subcategory['SubCategoryName'])];
            } else {
                $coaster_subcategories[$subcategory['SubCategoryCode']] = strtolower($subcategory['SubCategoryName']); // SC-10XX => Subcategory name
            }
            $subcategory_objects[] = $subcategory;// CA-10XX => SubcategoryInfo object
        }
        $coaster_category_code_to_subcategories[$full_category['CategoryCode']] = $subcategory_objects;
    }
    $result['categories'] = $coaster_categories;
    $result['subcategories'] = $coaster_subcategories;
    $categories_export = json_encode($result);
    $categories_file = fopen(CACHE_CATEGORIES_FILE_PATH, "w");
    fwrite($categories_file, $categories_export);
    fclose($categories_file);
}

function coaster_read_categories_cache(): array
{
    $cache_json = fopen(CACHE_CATEGORIES_FILE_PATH, "r");
    if (filesize(CACHE_CATEGORIES_FILE_PATH) > 0) {
        $cache = fread($cache_json, filesize(CACHE_CATEGORIES_FILE_PATH));
        fclose($cache_json);
        return json_decode($cache, true);
    } else {
        return array();
    }
}

function coaster_create_categories_locally(): void
{
    $categories_url = "http://api.coasteramer.com/api/product/GetCategoryList";
    $categories_response = json_decode(wp_remote_get($categories_url, array(
        'headers' => COASTER_HEADERS
    ))['body'], true);
    $coaster_categories = array();
    $coaster_subcategories = array();
    $coaster_category_code_to_subcategories = array();
    foreach ($categories_response as $full_category) {
        if (strtolower($full_category['CategoryName']) === "home office") {
            $coaster_categories[$full_category['CategoryCode']] = "home office & studio";
        } elseif (strtolower($full_category['CategoryName']) === "home decor") {
            $coaster_categories[$full_category['CategoryCode']] = "accessories";
        } else {
            $coaster_categories[$full_category['CategoryCode']] = strtolower($full_category['CategoryName']);
        }
        $subcategory_objects = array();
        foreach ($full_category['SubCategoryList'] as $subcategory) {
            if (array_key_exists(strtolower($subcategory['SubCategoryName']), COASTER_RENAME_SUBCATEGORIES)) {
                $coaster_subcategories[$subcategory['SubCategoryCode']] = COASTER_RENAME_SUBCATEGORIES[strtolower($subcategory['SubCategoryName'])];// SC-10XX => Subcategory name
                $subcategory['SubCategoryName'] = COASTER_RENAME_SUBCATEGORIES[strtolower($subcategory['SubCategoryName'])];
            } else {
                $coaster_subcategories[$subcategory['SubCategoryCode']] = strtolower($subcategory['SubCategoryName']); // SC-10XX => Subcategory name
            }
            $subcategory_objects[] = $subcategory;// CA-10XX => SubcategoryInfo object
        }
        $coaster_category_code_to_subcategories[$full_category['CategoryCode']] = $subcategory_objects;
    }
    $category_parent_term = get_term_by('slug', 'place-type', 'product_cat');

    if ($category_parent_term) {
        $args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent' => $category_parent_term->term_id,
        );

        // Getting existing categories to [name => code]
        $local_categories_temp = get_terms($args);
        $local_categories = array();
        foreach ($local_categories_temp as $term) {
            $local_categories[strtolower($term->name)] = $term->term_id;
        }
// Create categories that are absent locally
        foreach ($coaster_categories as $coaster_term_key => $coaster_term_value) {
            if (!isset($local_categories[$coaster_term_value])) {
                $parent_category = get_term_by('slug', 'place-type', 'product_cat');
                $parent_id = $parent_category->term_id;
                $result = wp_insert_term(
                    ucfirst($coaster_term_value), // category name
                    'product_cat', // taxonomy type (product categories)
                    array(
                        'parent' => $parent_id
                    )
                );
            }
        }

    }


// Subcategories
    foreach ($coaster_category_code_to_subcategories as $category_code => $subcategories) {
        // Creating subcategories
        $parent_category = get_term_by('name', $coaster_categories[$category_code], 'product_cat');
        $parent_id = $parent_category->term_id;
        $args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent' => $parent_id,
        );
        $local_subcategories_terms = get_terms($args);
        $local_subcategories = array();
        foreach ($local_subcategories_terms as $term) {
            $local_subcategories[strtolower($term->name)] = $term->term_id;
        }
        foreach ($subcategories as $subcategory) {
            if (!isset($local_subcategories[strtolower($subcategory['SubCategoryName'])])) {
                $result = wp_insert_term(
                    ucwords(strtolower($subcategory['SubCategoryName'])), // category name
                    'product_cat', // taxonomy type (product categories)
                    array(
                        'parent' => $parent_id
                    )
                );
            }
        }
    }
}