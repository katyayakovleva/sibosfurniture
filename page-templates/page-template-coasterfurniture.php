<?php
/**
 * Template Name: Coasterfurniture
 *
 * The main template file
 *
 * @package Sibosfurniture
 */
?>
<!DOCTYPE html>
<html>
<body>

<?php
set_time_limit(0);
ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);
$coaster_headers = array(
    "keycode" => "45FDCB85CF2F440E9750F1E96A"
);
$categories_url = "http://api.coasteramer.com/api/product/GetCategoryList";
$categories_response = wp_remote_get($categories_url, array(
    'headers' => $coaster_headers
));
$json_categories_full_response = json_decode($categories_response['body'], true);
$rename_subcategories = array("dressers & dresser mirrors" => "dressers & mirrors",
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
// Parsing response to [name => code]
$coaster_categories = array();
$coaster_subcategories = array();
$coaster_category_code_to_subcategories = array();
foreach ($json_categories_full_response as $full_category) {
    if(strtolower($full_category['CategoryName']) === "home office"){
        $coaster_categories[$full_category['CategoryCode']] = "home office & studio";
    }elseif (strtolower($full_category['CategoryName']) === "home decor"){
        $coaster_categories[$full_category['CategoryCode']] = "accessories";
    }else{
        $coaster_categories[$full_category['CategoryCode']] = strtolower($full_category['CategoryName']);
    }
    $subcategory_objects = array();
    foreach ($full_category['SubCategoryList'] as $subcategory) {
        if(array_key_exists(strtolower($subcategory['SubCategoryName']), $rename_subcategories)){
            $coaster_subcategories[$subcategory['SubCategoryCode']] = $rename_subcategories[strtolower($subcategory['SubCategoryName'])];// SC-10XX => Subcategory name
            $subcategory['SubCategoryName'] = $rename_subcategories[strtolower($subcategory['SubCategoryName'])];
        }else{
            $coaster_subcategories[$subcategory['SubCategoryCode']] = strtolower($subcategory['SubCategoryName']); // SC-10XX => Subcategory name
        }
        $subcategory_objects[] = $subcategory;// CA-10XX => SubcategoryInfo object
    }
    $coaster_category_code_to_subcategories[$full_category['CategoryCode']] = $subcategory_objects;
}
var_dump($coaster_categories);
//var_dump($coaster_category_code_to_subcategories);
var_dump($coaster_subcategories);
//Getting the root parent of categories
$category_parent_term = get_term_by('slug', 'place-type', 'product_cat');

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

$cache_file_path = WP_CONTENT_DIR . "/themes/sibosfurniture/cache.json";
$cache_json = fopen($cache_file_path, "a+");
$price_cache_file_path = WP_CONTENT_DIR . "/themes/sibosfurniture/cache_price_coaster.json";
$price_cache_json = fopen($price_cache_file_path, "a+");
$product_number_to_price_map = array();
if (filesize($cache_file_path) > 0 && filesize($price_cache_file_path) > 0) {
    $cache = fread($cache_json, filesize($cache_file_path));
    fclose($cache_json);
    echo "read successfully";
    $json = json_decode($cache, true);
    $price_cache = fread($price_cache_json, filesize($price_cache_file_path));
    fclose($price_cache_json);
    echo "<p>prices read successfully";
    $price_json = json_decode($price_cache, true);
    $prices = $price_json[0]['PriceList'];
    foreach ($prices as $product_price_info){
        $product_number_to_price_map[$product_price_info['ProductNumber']] = $product_price_info['MAP'];
    }
    $counter = 0;
    $update_counter = 0;
    for ($k = 121; $k <= 130; $k++) {
        $is_error = false;
        $product = $json[$k];
        $SKU = $product['ProductNumber'];
        $existing_product_id = wc_get_product_id_by_sku($SKU);
        if ($existing_product_id != null) {
            //Updating product
            $existing_product = new WC_Product_Simple($existing_product_id);
            update_product_price($existing_product, $SKU, $coaster_headers, $product, $product_number_to_price_map);
            update_product_categories($product, $coaster_subcategories, $existing_product);
            $existing_product->save();
            sleep(15);
            var_dump("Update");
        } else {
//            Creating product
            $new_product = new WC_Product_Simple();
//           $new_product->set_status('publish');
            //Set if the product is featured. | bool
            $new_product->set_featured(FALSE);
            //Set catalog visibility. | string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
            $new_product->set_catalog_visibility('visible');
            $new_product->set_reviews_allowed(TRUE);
            set_product_coaster_furniture($SKU, $product, $new_product);
            if(array_key_exists($SKU, $product_number_to_price_map)){
                $MAP_price = floatval($product_number_to_price_map[$SKU]);
                if ($MAP_price > 0) {
                    $new_product->set_regular_price($MAP_price);
                }else{
                    $is_error = true;
                }
            }else{
                $price_filter_api = "http://api.coasteramer.com/api/product/GetFilter?productNumber=" . $SKU;

                $price_filter_response = wp_remote_get($price_filter_api, array(
                    'headers' => $coaster_headers
                ));
                if (is_wp_error($price_filter_response)) {
                    var_dump($price_filter_response);
                    $is_error = true;
                    var_dump("price_filter_response error");
                } else {
                    $price_filter_response_json = json_decode($price_filter_response['body'], true);
                    $price_api = "http://api.coasteramer.com/api/product/GetPriceList?filterCode=" . $price_filter_response_json;
                    $price_response = wp_remote_get($price_api, array(
                        'headers' => $coaster_headers
                    ));
                }

                if (is_wp_error($price_response)) {
                    var_dump($price_response);
                    $is_error = true;
                    var_dump("price_response error");
                } else {
                    $price_response_json = json_decode($price_response['body'], true);

                    $MAP_price = floatval($price_response_json[0]['PriceList'][0]['MAP']);
                    if ($MAP_price > 0) {
                        $new_product->set_regular_price($MAP_price);
                    }else{
                        $is_error = true;
                    }
                }
            }



            $category_ids = array();
//            if (isset($product['CategoryCode'])) {
//                $category_code = $product['CategoryCode'];
////                if (isset($cat_arr[$category_code])) {
//                $category_name = ucfirst($coaster_categories[$category_code]);
//                $full_category = get_term_by('name', $category_name, 'product_cat');
//                $category_id = $full_category->term_id;
//                $category_ids[] = $category_id;
////                }
//
//            }
            if (isset($product['SubCategoryCode'])) {
                $subcategory_code = $product['SubCategoryCode'];
                $subcategory_name = ucwords($coaster_subcategories[$subcategory_code]);
                $full_subcategories = get_terms( array(
                    'taxonomy' => 'product_cat', // set your taxonomy here
                    'hide_empty' => false,
                    'name' => $subcategory_name,
                ) );
                foreach ($full_subcategories as $full_subcategory){
                    $subcategory_id = $full_subcategory->term_id;
                    $category_ids[] = $full_subcategory->parent;
                    $category_ids[] = $subcategory_id;
                }
            }
            $category_ids = array_unique($category_ids);

            if (sizeof($category_ids) > 0) {
                $new_product->set_category_ids($category_ids);
            }
            if (isset($product['PictureFullURLs'])) {
                $img_urls_array = explode(',', $product['PictureFullURLs']);
                if(sizeof($img_urls_array) < 1){
                    $is_error = true;
                    var_dump("No images");
                }
//        var_dump($img_urls_array);
                $img_ids = [];
                foreach ($img_urls_array as $url) {
                    array_push($img_ids, rs_upload_from_url($url, $SKU));
                }
                $main_img_id = $img_ids[0];
                $new_product->set_image_id($main_img_id);
                if (sizeof($img_ids) > 1) {
                    unset($img_ids[0]); // remove item at index 0
                    $img_ids = array_values($img_ids); // 'reindex' array
                    $new_product->set_gallery_image_ids($img_ids);

                }
            } else {
                $is_error = true;
                var_dump("image");
            }

            if ($is_error) {
                $new_product->set_status('draft');
            } else {
                $new_product->set_status('publish');

            }

            $new_product->save();
            var_dump("Create");
            sleep(15);
            $counter++;
            if ($counter == 50) {
                sleep(60);
                $counter = 0;
            }
        }
    }
} else {
    fclose($cache_json);
    fclose($price_cache_json);
    $cache_json = fopen($cache_file_path, "w+");
    $price_cache_json = fopen($price_cache_file_path, "w+");
    $coaster_headers = array(
        "keycode" => "45FDCB85CF2F440E9750F1E96A"
    );
    $filter_api = "http://api.coasteramer.com/api/product/GetFilter?isDiscontinued=false";
    $filter_response = wp_remote_get($filter_api, array(
        'headers' => $coaster_headers
    ));
// $filter = $filter_response['body'];
    $filterCode = str_replace('"', '', $filter_response['body']);
//var_dump($filterCode);
    $api_string = "http://api.coasteramer.com/api/product/GetProductList?filterCode=" . $filterCode;
//    $api_string_full = "http://api.coasteramer.com/api/product/GetProductList";
//var_dump($api_string);
    $product_response = wp_remote_get($api_string, array(
        'timeout' => 3000,
        'headers' => $coaster_headers
    ));
    $json = json_decode($product_response['body'], true);
    fwrite($cache_json, $product_response['body']);
    fclose($cache_json);
    $api_string_prices = "http://api.coasteramer.com/api/product/GetPriceList?filterCode=FL-10139"; // Filter isDiscontinued = true
    $prices_response = wp_remote_get($api_string_prices, array(
        'timeout' => 3000,
        'headers' => $coaster_headers
    ));
    $price_json = json_decode($prices_response['body'], true);

    fwrite($price_cache_json, $prices_response['body']);
    fclose($price_cache_json);
    echo "cache created, reload page to parse it";
}


function update_product_price($existing_product, $SKU, $coaster_headers, $product, $product_number_to_price_map){
    $is_error = false;
    if(array_key_exists($SKU, $product_number_to_price_map)){
        $MAP_price = floatval($product_number_to_price_map[$SKU]);
        if ($MAP_price > 0) {
            $existing_product->set_regular_price($MAP_price);
        }else{
            $is_error = true;
        }
    }else{
        $price_filter_api = "http://api.coasteramer.com/api/product/GetFilter?productNumber=" . $SKU;

        $price_filter_response = wp_remote_get($price_filter_api, array(
            'headers' => $coaster_headers
        ));
        if (is_wp_error($price_filter_response)) {
            var_dump($price_filter_response);
            $is_error = true;
            var_dump("price_filter_response error");
        } else {
            $price_filter_response_json = json_decode($price_filter_response['body'], true);
            $price_api = "http://api.coasteramer.com/api/product/GetPriceList?filterCode=" . $price_filter_response_json;
            $price_response = wp_remote_get($price_api, array(
                'headers' => $coaster_headers
            ));
        }

        if (is_wp_error($price_response)) {
            var_dump($price_response);
            $is_error = true;
            var_dump("price_response error");
        } else {
            $price_response_json = json_decode($price_response['body'], true);

            $MAP_price = floatval($price_response_json[0]['PriceList'][0]['MAP']);
            if ($MAP_price > 0) {
                $existing_product->set_regular_price($MAP_price);
            }else{
                $is_error = true;
            }
        }
    }
    if (isset($product['PictureFullURLs'])) {
        $img_urls_array = explode(',', $product['PictureFullURLs']);
        if(sizeof($img_urls_array) < 1){
            $is_error = true;
            var_dump("No images");
        }
        if(sizeof($img_urls_array) == 1){
            $img_ids = [];
            foreach ($img_urls_array as $url) {
                array_push($img_ids, rs_upload_from_url($url, $SKU));
            }
            $main_img_id = $img_ids[0];
            $existing_product->set_image_id($main_img_id);
        }
    } else {
        $is_error = true;
        var_dump("image");
    }
    if ($is_error) {
        $existing_product->set_status('draft');
    } else {
        $existing_product->set_status('publish');

    }

}


function update_product_categories($product, $coaster_subcategories, $existing_product)
{
    if (isset($product['SubCategoryCode'])) {
        $subcategory_code = $product['SubCategoryCode'];
        $subcategory_name = ucwords($coaster_subcategories[$subcategory_code]);
        $full_subcategories = get_terms( array(
            'taxonomy' => 'product_cat', // set your taxonomy here
            'hide_empty' => false,
            'name' => $subcategory_name,
        ) );
        foreach ($full_subcategories as $full_subcategory){
            $subcategory_id = $full_subcategory->term_id;
            $category_ids[] = $subcategory_id;
            $category_ids[] = $full_subcategory->parent;
        }
    }
    $category_ids =  array_unique($category_ids);

    if (sizeof($category_ids) > 0) {
        $existing_product->set_category_ids($category_ids);
    }
}

?>

</body>
</html>