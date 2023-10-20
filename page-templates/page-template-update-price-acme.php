<?php
/**
 * Template Name: ACME update price
 *
 * The main template file
 *
 * @package Sibosfurniture
 */
?>
<?php

const PRODUCT_BY_SKU_URL = 'https://acmecorp.com/rest/V1/products/';
const CACHE_FILE_ACME = "/themes/sibosfurniture-master/cache_acme_sku.json";
const ACME_LOGGER_FILE = "/themes/sibosfurniture-master/acme_logs_update_prices.txt";


const CACHE_FILE_PATH_ACME = WP_CONTENT_DIR . CACHE_FILE_ACME;
const ACME_LOGGER_FILE_PATH = WP_CONTENT_DIR . ACME_LOGGER_FILE;

$product_skus = acme_read_cache_product_sku();

if (empty($product_skus)) {
    echo '<p>Empty cache</p>';
    return;
}

// for ($i = 0; $i < sizeof($product_skus); $i++) {
    for ($i = 0; $i < 10; $i++) {

    $sku = $product_skus[$i];
    acme_log_info($sku, "[ACME] Started");

    $existing_product_id = wc_get_product_id_by_sku($sku);
    if ($existing_product_id != null) {
        acme_update_product_price($existing_product_id, $sku);
    }
}

function acme_update_product_price($product_id, $sku){

    $_product = wc_get_product($product_id);

    $modified_time = strtotime(get_post_modified_time('Y-m-d', false, $product_id));
    $current_time = strtotime(current_time('Y-m-d'));
    $week_ago = strtotime('-1 week', $current_time);

    if ($modified_time >= $week_ago) {
        acme_log_info($sku, "[ACME] Skipped, updated less then a week ago");
    } else {
        $product_response = json_decode(wp_remote_get(PRODUCT_BY_SKU_URL . $sku, array(
            'timeout' => 3000,
        ))['body'], true);


        $price = ceil(intval($product_response['price']) * 0.4);
        $_product->set_regular_price(strval($price));
        $_product->save();
        acme_log_info($sku, "[ACME] Updated");
    }
    
}


function acme_read_cache_product_sku(): array
{
    $cache_json = fopen(CACHE_FILE_PATH_ACME, "r");
    if (filesize(CACHE_FILE_PATH_ACME) > 0) {
        $cache = fread($cache_json, filesize(CACHE_FILE_PATH_ACME));
        fclose($cache_json);
        return json_decode($cache, true);
    } else {
        return array();
    }
}

function acme_log_info($sku, $message): void
{
    $logger = fopen(ACME_LOGGER_FILE_PATH, "a+");
    $currentDateTime = date('Y-m-d H:i:s');
    fwrite($logger, "[" . $currentDateTime . "] " . "[" . $sku . "] " . $message . "\n");
    fclose($logger);
}
