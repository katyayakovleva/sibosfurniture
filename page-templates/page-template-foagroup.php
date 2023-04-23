<?php
/**
 * Template Name: Foagroup
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

$client_v2 = new SoapClient('https://www.foagroup.com/api/v2_soap/?wsdl');
$client_v1 = new SoapClient('https://www.foagroup.com/api/soap/?wsdl');
$apiUser = 'sibosfurniture';
$apiKey = '5ab3e1ed-5f50-4120-87db-6a547450c672';

$rename_categories = array("youth" => "kids room",
    "dining" => "dining room",
    "living" => "living room",
    "accent" => "accent furniture");

$rename_subcategories = array("bed" => "beds",
    "night stand" => "nightstands",
    "dresser & mirror" => "dressers & mirrors",
    "chest" => "chests",
    "media chest" => "chests",
    "headboard" => "headboards",
    "mattress" => "mattresses & foundations",
    "dining table" => "dining room tables",
    "curio & hutch buffet" => "sideboards, buffets & curio",
    "sofa" => "sofas",
    "love seat" => "loveseats",
    "chair" => "chairs & seating",
    "sectional" => "sectionals",
    "futon" => "sofa beds & futons",
    "coffee table" => "coffee tables & end tables",
    "tv console" => "tv stands & media storage",
    "vanity" => "vanities & jewelry armories",
    "wall art" => "art",
    "pillow" => "rug & pillow");

$rename_youth_subcategories = array("bed" => "youth beds",
    "bunk bed" => "bunk & loft beds",
    "daybed" => "daybeds",
    "night stand" => "youth nightstands",
    "dresser & mirror" => "youth dressers & mirrors",
    "chest & accessory" => "youth chests & accessories",
    "desk" => "youth desks",
    "headboard" => "youth headboards");

$proxy = new SoapClient('https://www.foagroup.com/api/v2_soap/?wsdl');
$sessionId = $proxy->login($apiUser, $apiKey);
$categories_response_full = $proxy->catalogCategoryTree($sessionId);
$categories_response = $categories_response_full->children[0]->children;
$parent_categories_id_to_category_name = array();
$subcategory_id_to_subcategory_name = array();
$foagroup_parent_id_to_subcategories = array();
for ($i = 0; $i < sizeof($categories_response) - 3; $i++) {
    if(strtolower($categories_response[$i]->name) == "youth"){
        $parent_categories_id_to_category_name[$categories_response[$i]->category_id] = "kids room";
        $subcategories = array();
        foreach ($categories_response[$i]->children as $subcategory) {
            if(array_key_exists(strtolower($subcategory->name), $rename_youth_subcategories)){
                $subcategory_id_to_subcategory_name[$subcategory->category_id] = $rename_youth_subcategories[strtolower($subcategory->name)];
                $subcategory->name = $rename_youth_subcategories[strtolower($subcategory->name)];
                $subcategories[] = $subcategory;
            }else{
                $subcategory_id_to_subcategory_name[$subcategory->category_id] = strtolower($subcategory->name);
                $subcategories[] = $subcategory;
            }
        }
        $foagroup_parent_id_to_subcategories[$categories_response[$i]->category_id] = $subcategories;
    }else{
        if(array_key_exists(strtolower($categories_response[$i]->name), $rename_categories)){
            $parent_categories_id_to_category_name[$categories_response[$i]->category_id] = $rename_categories[strtolower($categories_response[$i]->name)];
        }else{
            $parent_categories_id_to_category_name[$categories_response[$i]->category_id] = strtolower($categories_response[$i]->name);
        }
        $subcategories = array();
        foreach ($categories_response[$i]->children as $subcategory) {
            if(array_key_exists(strtolower($subcategory->name), $rename_subcategories)){
                $subcategory_id_to_subcategory_name[$subcategory->category_id] = $rename_subcategories[strtolower($subcategory->name)];
                $subcategory->name = $rename_subcategories[strtolower($subcategory->name)];
                $subcategories[] = $subcategory;
            }else{
                $subcategory_id_to_subcategory_name[$subcategory->category_id] = strtolower($subcategory->name);
                if(!(strtolower($subcategory->name) == "lighting & accessory")){
                    $subcategories[] = $subcategory;
                }
            }
        }
        $foagroup_parent_id_to_subcategories[$categories_response[$i]->category_id] = $subcategories;
    }
}
var_dump($parent_categories_id_to_category_name);
//var_dump($subcategory_id_to_subcategory_name);
//var_dump($foagroup_parent_id_to_subcategories);

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
foreach ($parent_categories_id_to_category_name as $foagroup_term_key => $foagroup_term_value) {
    if (strtolower($foagroup_term_value) != "mattress" && !isset($local_categories[$foagroup_term_value])) {
        $parent_category = get_term_by('slug', 'place-type', 'product_cat');
        $parent_id = $parent_category->term_id;
        $result = wp_insert_term(
            ucfirst($foagroup_term_value), // category name
            'product_cat', // taxonomy type (product categories)
            array(
                'parent' => $parent_id
            )
        );
    }
}
// Subcategories
foreach ($foagroup_parent_id_to_subcategories as $category_id => $subcategories) {
    // Creating subcategories
    if(strtolower($parent_categories_id_to_category_name[$category_id]) == "mattress"){
        $parent_categories_id_to_category_name[$category_id] = "bedroom";
    }
    $parent_category = get_term_by('name', $parent_categories_id_to_category_name[$category_id], 'product_cat');
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
        if (!isset($local_subcategories[strtolower($subcategory->name)])) {
            $result = wp_insert_term(
                ucwords(strtolower($subcategory->name)), // category name
                'product_cat', // taxonomy type (product categories)
                array(
                    'parent' => $parent_id
                )
            );
        }
    }
}







//$cache_file_path = ABSPATH . "/wp-content/themes/sibosfurniture/cache_foagroup.json";
//
//$cache_json = fopen($cache_file_path, "a+");
//if (filesize($cache_file_path) > 0) {
//    $cache = fread($cache_json, filesize($cache_file_path));
//    fclose($cache_json);
//    echo "read successfully";
//    $products_json = json_decode($cache, true);
//    // Creating products from parsed json response
//    $session_v2 = $client_v2->login($apiUser, $apiKey);
//    $session_v1 = $client_v1->login($apiUser, $apiKey);


//    for ($i = 0; $i < sizeof($products_json); $i++) {
//    for ($i = 0; $i < 1; $i++) {
//        $SKU = $products_json[$i]['sku'];
//        var_dump($SKU);
//        var_dump($products_json[$i]['product_id']);
////        $full_product_info = $client_v1->call($session_v1, 'catalog_product.info', intval($products_json[$i]['product_id']));
//        $full_product_info = $client_v1->call($session_v1, 'catalog_product.info', 261);
////        $full_product_info = $client_v2->catalogProductInfo($session_v2,'FOA7466GY', null, null);
//        $product_images_info = $client_v2->catalogProductAttributeMediaList($session_v2, $SKU);
//
//        var_dump($full_product_info);
////        var_dump($product_images_info);
////        create_foagroup_product((array)$full_product_info, (array)$product_images_info);
//    }


//} else {
//
//    $complexFilter = array(
//        'complex_filter' => array(
//            array(
//                'key' => 'status',
//                'value' => array('key' => '=', 'value' => '1')
//            )
//        )
//    );
//
//    $session_v2 = $client_v2->login($apiUser, $apiKey);
//    $product_response = $client_v2->catalogProductList($session_v2, $complexFilter);
//    fwrite($cache_json, json_encode($product_response));
//    fclose($cache_json);
//    echo "Cache created";
//}
//
//function create_foagroup_product($full_product_info, $product_images_info)
//{
//    $name = $full_product_info['name'];
//    $SKU = $full_product_info['sku'];
//    $category_ids = $full_product_info['category_ids'];
//    $existing_product_id = wc_get_product_id_by_sku($SKU);
//
//    if ($existing_product_id != null) {
//
//    } else {
//        $new_product = new WC_Product_Simple();
//        $new_product->set_status('publish');
//        //Set if the product is featured. | bool
//        $new_product->set_featured(FALSE);
//        //Set catalog visibility. | string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
//        $new_product->set_catalog_visibility('visible');
//        $new_product->set_reviews_allowed(TRUE);
//
//
//        if (isset($full_product_info['description'])) {
//            $description = $full_product_info['description'];
//        } else {
//            $description = $name;
//        }
//
//
//        if (!empty($product_images_info)) {
//            $img_ids = [];
//            foreach ($product_images_info as $image_info) {
//                var_dump($image_info->url);
//                $img_ids [] = rs_upload_from_url($image_info->url);
//            }
//            $main_img_id = $img_ids[0];
//            if (sizeof($img_ids) > 1) {
//                unset($img_ids[0]); // remove item at index 0
//                $img_ids = array_values($img_ids); // 'reindex' array
//                $new_product->set_image_id($main_img_id);
//                $new_product->set_gallery_image_ids($img_ids);
//
//            }
//            //$new_product->save();
//        }
//    }
//}

?>

</body>
</html>