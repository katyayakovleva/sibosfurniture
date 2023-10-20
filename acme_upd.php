<?php

const CATEGORIES_URL_ACME = 'http://acmecorp.com/rest/V1/categories/';
const PRODUCT_BY_CATEGORY_ID = 'http://acmecorp.com/rest/V1/categories/%s/products';
const PRODUCT_BY_SKU_URL = 'https://acmecorp.com/rest/V1/products/';
const CACHE_FILE_ACME = "/themes/sibosfurniture-master/cache_acme_sku_1.json";
const CACHE_ACME_TO_CREATE = "/themes/sibosfurniture-master/cache_acme_to_create.json";
const ACME_LOGGER_FILE = "/themes/sibosfurniture-master/acme_logs.txt";


const CACHE_ACME_TO_CREATE_FILE_PATH = WP_CONTENT_DIR . CACHE_ACME_TO_CREATE;
const CACHE_FILE_PATH_ACME = WP_CONTENT_DIR . CACHE_FILE_ACME;
const ACME_LOGGER_FILE_PATH = WP_CONTENT_DIR . ACME_LOGGER_FILE;


function acme_log_info($sku, $message): void
{
    $logger = fopen(ACME_LOGGER_FILE_PATH, "a+");
    $currentDateTime = date('Y-m-d H:i:s');
    fwrite($logger, "[" . $currentDateTime . "] " . "[" . $sku . "] " . $message . "\n");
    fclose($logger);
}

function acme_save_sku_create($sku)
{
    if (file_exists(CACHE_ACME_TO_CREATE_FILE_PATH)) {
        $to_create_file = fopen(CACHE_ACME_TO_CREATE_FILE_PATH, 'r');
        clearstatcache(true, CACHE_ACME_TO_CREATE_FILE_PATH);
        $to_create_arr = json_decode(fread($to_create_file, filesize(CACHE_ACME_TO_CREATE_FILE_PATH)), true);
        fclose($to_create_file);
        if ($to_create_arr === null) {
            acme_log_info($sku, "Can't read json, Error: " . json_last_error_msg() );
        }
    } else {
        $to_create_arr = array();
    }
    $to_create_arr[] = $sku;

    $to_create_file = fopen(CACHE_ACME_TO_CREATE_FILE_PATH, 'w');
    fwrite($to_create_file, json_encode($to_create_arr));
    fclose($to_create_file);
}

add_action('run_acme_update', 'acme_runJob_update');

function acme_runJob_update()
{
    $product_skus = acme_read_cache_product_sku();

    if (empty($product_skus)) {
        return;
    }

    for ($i = 0; $i < sizeof($product_skus); $i++) {
        $sku = $product_skus[$i];
        acme_log_info($sku, "[ACME] Started");

        $existing_product_id = wc_get_product_id_by_sku($sku);
        if ($existing_product_id != null) {
            acme_update_existing_product($existing_product_id, $sku);
        } else {
            acme_save_sku_create($sku);
        }
    }

}

function acme_update_existing_product($existing_product_id, $sku)
{

    $existing_product = new WC_Product_Simple($existing_product_id);
    $stock_qty = 0;

    $modified_time = strtotime(get_post_modified_time('Y-m-d', false, $existing_product->get_id()));
    $current_time = strtotime(current_time('Y-m-d'));
    $week_ago = strtotime('-1 week', $current_time);


    if ($modified_time >= $week_ago) {
        acme_log_info($sku, "[ACME] Skipped, updated less then a week ago");
    } else {
        $product_response = json_decode(wp_remote_get(PRODUCT_BY_SKU_URL . $sku, array(
            'timeout' => 3000,
        ))['body'], true);

        $custom_attributes = $product_response['custom_attributes'];
        foreach ($custom_attributes as $custom_attribute) {
            if ($custom_attribute['attribute_code'] == 'la_qty') {
                $stock_qty = intval($custom_attribute['value']);
            }
        }

        $price = intval($product_response['price']);

        // Managing stock properties
        if ($stock_qty <= 0) {
            $existing_product->set_stock_status('outofstock');
            acme_log_info($sku, "[ACME] Went out of stock");
        } else {
            $existing_product->set_stock_status('instock');
        }
        // Managing price properties
        if (!empty($price) && $price > 0) {
            $existing_product->set_regular_price($price);
        } else {

        }

        $existing_product->save();
        acme_log_info($sku, "[ACME] Updated");
    }
}

add_action('acme_create_product_cache', 'acme_create_product_sku_cache');

function acme_create_product_sku_cache()
{
    $cache_json = fopen(CACHE_FILE_PATH_ACME, "w");
    $response = json_decode(wp_remote_get(CATEGORIES_URL_ACME, array(
        'timeout' => 3000,
    ))['body'], true);
    $categories_ids = array();
    foreach ($response['children_data'] as $category) {
        foreach ($category['children_data'] as $children_cat) {
            $categories_ids[] = $children_cat['id'];
        }
    }
    $products_skus = array();
    foreach ($categories_ids as $category_id) {
        $response = json_decode(wp_remote_get(sprintf(PRODUCT_BY_CATEGORY_ID, $category_id), array(
            'timeout' => 3000,
        ))['body'], true);
        foreach ($response as $product_sku) {
            $products_skus[] = $product_sku['sku'];
        }
    }
    $products_skus = array_values(array_unique($products_skus));
    fwrite($cache_json, json_encode($products_skus));
    fclose($cache_json);
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