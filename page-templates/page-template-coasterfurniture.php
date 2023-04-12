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
$cache_file_path = ABSPATH . "/wp-content/themes/sibosfurniture/cache.json";
$cache_json = fopen($cache_file_path, "a+");
if (filesize($cache_file_path) > 0) {
    $cache = fread($cache_json, filesize($cache_file_path));
    fclose($cache_json);
    echo "read successfully";
    $json = json_decode($cache, true);
    // Продовжуй тут створювати обʼєкти, респонс зчитало з файлу
    for ($k = 0; $k <= 300; $k++) {
//    var_dump($json[$k]);654rt
        $product = $json[$k];
        $SKU = $product['ProductNumber'];
        $existing_product_id = wc_get_product_id_by_sku($SKU);
        if ($existing_product_id != null) {
            //Updating product
//        $existing_product = new WC_Product_Simple($existing_product_id);
//        set_or_update_product_coaster_furniture($SKU, $product, $existing_product);
//        $existing_product->save();
        }
        else {
            //Creating product
            $new_product = new WC_Product_Simple();
            $new_product->set_status('publish');
            //Set if the product is featured. | bool
            $new_product->set_featured(FALSE);
            //Set catalog visibility. | string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
            $new_product->set_catalog_visibility('visible');
            $new_product->set_reviews_allowed(TRUE);
            set_or_update_product_coaster_furniture($SKU, $product, $new_product);
            if(isset($product['PictureFullURLs'])){
                $img_urls_array = explode(',', $product['PictureFullURLs']);
//        var_dump($img_urls_array);
                $img_ids = [];
                foreach ($img_urls_array as $url){
                    array_push($img_ids, rs_upload_from_url($url));
                }
                $main_img_id = $img_ids[0];
                if(sizeof($img_ids) > 1){
                    var_dump($img_ids);
                    unset($img_ids[0]); // remove item at index 0
                    $img_ids = array_values($img_ids); // 'reindex' array
                    $new_product->set_image_id($main_img_id);
                    $new_product->set_gallery_image_ids($img_ids);

                }
            }
            $new_product->save();
        }
    }
}else {
    $params = array(
        "keycode" => "45FDCB85CF2F440E9750F1E96A"
    );
    $filter_api = "http://api.coasteramer.com/api/product/GetFilter?isDiscontinued=false";
    $filter_response = wp_remote_get($filter_api, array(
        'headers' => $params
    ));
// $filter = $filter_response['body'];
    $filterCode = str_replace('"', '', $filter_response['body']);
//var_dump($filterCode);
    $api_string = "http://api.coasteramer.com/api/product/GetProductList?filterCode=" . $filterCode;
//    $api_string_full = "http://api.coasteramer.com/api/product/GetProductList";
//var_dump($api_string);
    $product_response = wp_remote_get($api_string, array(
        'timeout' => 3000,
        'headers' => $params
    ));
    $json = json_decode($product_response['body'], true);
    fwrite($cache_json, $product_response['body']);
    fclose($cache_json);
    echo "cache created, reload page to parse it";
}
?>

</body>
</html>
