<?php
/**
 * Template Name: ACME API
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
ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);


$rename_subcategories = array("bed" => "beds",
    "nightstand" => "nightstands",
    "dresser & mirror" => "dressers & mirrors",
    "chest" => "chests",
    "bench" => "bench & ottoman",
    "vanity" => "vanities & jewelry armoires",
    "daybed" => "daybeds",
    "mattress & foundation" => "mattresses & foundations",
    "sofa" => "sofas",
    "genuine leather sofa" => "sofas",
    "loveseat" => "loveseats",
    "sectional" => "sectionals",
    "coffee table" => "coffee tables & end tables",
    "tv console" => "tv stands & media storage",
    "casual dining" => "everyday dining",
    "curio & buffet" => "sideboards, buffets & curio",
    "desk" => "desks",
    "desk chair" => "office chairs",
    "bookshelf & file cabinet" => "bookcases, bookshelves & file cabinet",
    "executive desk" => "desks",
    "gaming table" => "game tables & chairs",
    "outdoor living" => "sofa & sectional",
    "outdoor chair" => "chair & bench",
    "floor mirror" => "mirrors",
    "clock" => "clocks");

$rename_youth_subcategories = array("bunk bed" => "bunk & loft beds",
    "bed" => "youth beds",
    "chair" => "youth chairs",
    "desk" => "youth desks",
    "bookshelf" => "youth bookshelves",
    "accessiores" => "youth chests & accessories");


$cache_file_path = WP_CONTENT_DIR . "/themes/sibosfurniture/cache_acme.json";
$cache_json_file = fopen($cache_file_path, "a+");

$categories_url = 'http://acmecorp.com/rest/V1/categories/';
$product_by_category_id_url = 'http://acmecorp.com/rest/V1/categories/%s/products';
$product_by_sku_url = 'https://acmecorp.com/rest/V1/products/';
$full_res_pictures_url = 'https://static.acmecorp.com/pub/media/catalog/product/cache/ccdf461ec786272b80f0911286646ebc';

// TODO Categories
$categories_response = wp_remote_get($categories_url);
$categories_json = json_decode($categories_response['body'], true);

$acme_id_to_categories = array();
$acme_id_to_subcategories = array();
$acme_parent_id_to_subcategories = array();
// Parsing code to categories and sub categories
$categories_data = $categories_json['children_data'];
for ($i = 1; $i < sizeof($categories_data); $i++) {
    if (strtolower($categories_data[$i]['name']) != "trending style"){
      if (strtolower($categories_data[$i]['name']) == "youth") {
          $acme_id_to_categories[$categories_data[$i]['id']] = "kids room";
          $child_categories = array();
          foreach ($categories_data[$i]['children_data'] as $child_category) {
              if (array_key_exists(strtolower($child_category['name']), $rename_youth_subcategories)){
                  $acme_id_to_subcategories[$child_category['id']] = $rename_youth_subcategories[strtolower($child_category['name'])];
                  $child_category['name'] = $rename_youth_subcategories[strtolower($child_category['name'])];
                  $child_categories[] = $child_category;
              }else{
                  $acme_id_to_subcategories[$child_category['id']] = strtolower($child_category['name']);
                  $child_categories[] = $child_category;
              }
          }
          $acme_parent_id_to_subcategories[$categories_data[$i]['id']] = $child_categories;
      } else {
          $acme_id_to_categories[$categories_data[$i]['id']] = strtolower($categories_data[$i]['name']);
          $child_categories = array();
          foreach ($categories_data[$i]['children_data'] as $child_category) {
              if (array_key_exists(strtolower($child_category['name']), $rename_subcategories)){
                  $acme_id_to_subcategories[$child_category['id']] = $rename_subcategories[strtolower($child_category['name'])];
                  $child_category['name'] = $rename_subcategories[strtolower($child_category['name'])];
                  $child_categories[] = $child_category;
              }else{
                  $acme_id_to_subcategories[$child_category['id']] = strtolower($child_category['name']);
                  $child_categories[] = $child_category;
              }
          }
          $acme_parent_id_to_subcategories[$categories_data[$i]['id']] = $child_categories;
      }
//      foreach ($categories_data[$i]['children_data'] as $child_category) {
//          $acme_code_to_subcategories[$child_category['id']] = strtolower($child_category['name']);
//      }
    }
}
//var_dump($acme_id_to_categories);
//var_dump($acme_id_to_subcategories);
//var_dump($acme_parent_id_to_subcategories);




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
foreach ($acme_id_to_categories as $acme_term_key => $acme_term_value) {
    if (!isset($local_categories[$acme_term_value])) {
        $parent_category = get_term_by('slug', 'place-type', 'product_cat');
        $parent_id = $parent_category->term_id;
        $result = wp_insert_term(
            ucfirst($acme_term_value), // category name
            'product_cat', // taxonomy type (product categories)
            array(
                'parent' => $parent_id
            )
        );
    }
}
// Subcategories
foreach ($acme_parent_id_to_subcategories as $category_id => $subcategories) {
    // Creating subcategories
    $parent_category = get_term_by('name', $acme_id_to_categories[$category_id], 'product_cat');
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
        if (!isset($local_subcategories[strtolower($subcategory['name'])]) && !str_contains(strtolower($subcategory['name']), "all")) {
            $result = wp_insert_term(
                ucwords(strtolower($subcategory['name'])), // category name
                'product_cat', // taxonomy type (product categories)
                array(
                    'parent' => $parent_id
                )
            );
        }
    }
}


if (filesize($cache_file_path) > 0) {
    $cache = fread($cache_json_file, filesize($cache_file_path));
    fclose($cache_json_file);
    echo "read successfully";
    $json = json_decode($cache, true);
//    for ($i = 0; $i < sizeof($cache_json); $i++) {
    for ($i =0; $i < 6; $i++) {
        $SKU = $json[$i];
        $existing_product_id = wc_get_product_id_by_sku($SKU);
        if ($existing_product_id != null) {

        } else {
            // Getting product one by one at a time by SKU from cache
            $product_response = wp_remote_get($product_by_sku_url . $SKU);
//            var_dump(json_decode($product_response['body']));
            $response = json_decode($product_response['body']);
            var_dump($response);
            $new_product = new WC_Product_Simple();
            $new_product->set_featured(FALSE);
            //Set catalog visibility. | string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
            $new_product->set_catalog_visibility('visible');
            $new_product->set_reviews_allowed(TRUE);
            $name = $response->name;
            $new_product->set_name($name);
            //Set SKU
            $new_product->set_sku($response->sku);
//            $multiple_price = doubleval($response->price) * 2;
            $new_product->set_regular_price(doubleval($response->price));
            $new_product->set_status('publish');
            $api_categories = $response->extension_attributes->category_links;
            $category_ids = array();
            foreach ($api_categories as $api_category){
                $api_category_id = $api_category->category_id;
                if (array_key_exists($api_category_id, $acme_id_to_subcategories)){
                    $subcategory_name = ucwords($acme_id_to_subcategories[intval($api_category_id)]);
                    if(!str_contains(strtolower($subcategory_name), "all")){
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
                }
            }
            var_dump($category_ids);
            $category_ids = array_unique($category_ids);

            if (sizeof($category_ids) > 0) {
                $new_product->set_category_ids($category_ids);
            }

            $api_attributes_arr = $response->custom_attributes;
            $attributes = array();
            $description = "";
            $short_description = "";
            $height = 0;
            $width = 0;
            $length = 0;
            foreach ($api_attributes_arr as $api_attribute){
                if($api_attribute->attribute_code == 'description' && strlen($api_attribute->value)>0){
                    $description = $api_attribute->value;
                    $new_product->set_short_description($api_attribute->value);
                }elseif($api_attribute->attribute_code == 'short_description' && strlen($api_attribute->value)>0){
                    $short_description = $api_attribute->value;
                }elseif($api_attribute->attribute_code == 'pack' && strlen($api_attribute->value)>0){
                    $attribute = new WC_Product_Attribute();
                    $attribute->set_name("Pack");
                    $attribute->set_options(array($api_attribute->value));
                    $attribute->set_visible(1);
                    $attribute->set_variation(0);
                    $attributes[] = $attribute;
                }elseif($api_attribute->attribute_code == 'product_height' && strlen($api_attribute->value)>0 && intval($api_attribute->value)>0){
                    $height = $api_attribute->value;
                }elseif($api_attribute->attribute_code == 'product_length' && strlen($api_attribute->value)>0 && intval($api_attribute->value)>0){
                    $length = $api_attribute-> value;
                }elseif($api_attribute->attribute_code == 'product_width' && strlen($api_attribute->value)>0 && intval($api_attribute->value)>0){
                    $width = $api_attribute->value;
                }elseif($api_attribute->attribute_code == 'package_height' && strlen($api_attribute->value)>0 && intval($api_attribute->value)>0){
                    $new_product->set_height(intval($api_attribute->value));
                }elseif($api_attribute->attribute_code == 'package_length' && strlen($api_attribute->value)>0 && intval($api_attribute->value)>0){
                    $new_product->set_length(intval($api_attribute->value));
                }elseif($api_attribute->attribute_code == 'package_width' && strlen($api_attribute->value)>0 && intval($api_attribute->value)>0){
                    $new_product->set_width(intval($api_attribute->value));
                }elseif($api_attribute->attribute_code == 'package_weight' && strlen($api_attribute->value)>0 && intval($api_attribute->value)>0){
                    $new_product->set_weight(intval($api_attribute->value));
                }elseif($api_attribute->attribute_code == 'catalog_finish' && strlen($api_attribute->value)>0){
                    //Set product description.
                    $attribute = new WC_Product_Attribute();
                    $attribute->set_name('Finish');
                    $attribute->set_options(array($api_attribute->value));
                    $attribute->set_visible(1);
                    $attribute->set_variation(0);
                    $attributes[] = $attribute;
                }elseif($api_attribute->attribute_code == 'material_detail' && strlen($api_attribute->value)>0){
                    //Set product description.
                    $attribute = new WC_Product_Attribute();
                    $attribute->set_name('Material');
                    $attribute->set_options(array($api_attribute->value));
                    $attribute->set_visible(1);
                    $attribute->set_variation(0);
                    $attributes[] = $attribute;
                }
            }
            if($short_description != "" && $short_description != "<span>"){
                $new_product->set_description($short_description);
            }elseif($description != ""){
                $new_product->set_description($description);
            }else{
                $new_product->set_description($name);
            }
            if(intval($width) > 0 && intval($height) > 0 && intval($length) > 0){
                $attribute = new WC_Product_Attribute();
                $attribute->set_name('Product Dimensions');
                $attribute->set_options(array($length . '"L X ' . $width .'"W X ' . $height . '"H'));
                $attribute->set_visible(1);
                $attribute->set_variation(0);
                $attributes[] = $attribute;
            }else{
                if (intval($width) > 0){
                    $attribute = new WC_Product_Attribute();
                    $attribute->set_name('Width');
                    $attribute->set_options(array($width));
                    $attribute->set_visible(1);
                    $attribute->set_variation(0);
                    $attributes[] = $attribute;
                }
                if(intval($height) > 0){
                    $attribute = new WC_Product_Attribute();
                    $attribute->set_name('Height');
                    $attribute->set_options(array($height));
                    $attribute->set_visible(1);
                    $attribute->set_variation(0);
                    $attributes[] = $attribute;
                }
                if(intval($length) > 0){
                    $attribute = new WC_Product_Attribute();
                    $attribute->set_name('Length');
                    $attribute->set_options(array($length));
                    $attribute->set_visible(1);
                    $attribute->set_variation(0);
                    $attributes[] = $attribute;
                }
            }
            $attribute = new WC_Product_Attribute();
            $attribute->set_name('Net Weight');
            $attribute->set_options(array($response->weight));
            $attribute->set_visible(1);
            $attribute->set_variation(0);
            $attributes[] = $attribute;

            $attribute = new WC_Product_Attribute();
            $attribute->set_name("Manufacture");
            $attribute->set_options(array("ACME"));
            $attribute->set_visible(1);
            $attribute->set_variation(0);
            $attributes[] = $attribute;
            if (sizeof($attributes) > 0){
                $new_product->set_attributes($attributes);
            }
            $img_ids = [];
            foreach ($response->media_gallery_entries as $entry) {
                if(sizeof($response->media_gallery_entries) < 1){
                    $is_error = true;
                    var_dump("No images");
                }
                $img_ids[] = rs_upload_from_url($full_res_pictures_url . $entry->file, $SKU);
            }

            $main_img_id = $img_ids[0];
            $new_product->set_image_id($main_img_id);
            if (sizeof($img_ids) > 1) {
                unset($img_ids[0]); // remove item at index 0
                $img_ids = array_values($img_ids); // 'reindex' array
                $new_product->set_gallery_image_ids($img_ids);
            }
            $new_product->save();
        }
    }
} else {
    // If no cache - create cache with all unique SKUs
    $categories_response = wp_remote_get($categories_url);
    $categories_json = json_decode($categories_response['body'], true);

    $category_ids = array();
    $categories_data = $categories_json['children_data'];
    for ($i = 1; $i < sizeof($categories_data); $i++) {
        foreach ($categories_data[$i]['children_data'] as $child_category) {
            $category_ids[] = $child_category['id'];
        }
    }

    $product_skus = array();
    $products = array();

    foreach ($category_ids as $category_id) {
        $product_response = wp_remote_get(sprintf($product_by_category_id_url, $category_id))['body'];
        $product_from_category = json_decode($product_response);
        foreach ($product_from_category as $product_info) {
            $product_skus[] = $product_info->sku;
        }
    }
    $product_skus = array_values(array_unique($product_skus));
    fwrite($cache_json_file, json_encode($product_skus));
    fclose($cache_json_file);
}
?>

</body>
</html>