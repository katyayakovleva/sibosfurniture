<?php

const API_USER = 'sibosfurniture';
const API_KEY = '5ab3e1ed-5f50-4120-87db-6a547450c672';

const CACHE_FILE_FOAG = "/themes/sibosfurniture/cache_foagroup.json";
const CACHE_FOAG_TO_CREATE = "/themes/sibosfurniture/cache_foag_to_create.json";
const FOAG_LOGGER_FILE = "/themes/sibosfurniture/foag_logs.txt";


const CACHE_FOAG_TO_CREATE_FILE_PATH = WP_CONTENT_DIR . CACHE_FOAG_TO_CREATE;
const CACHE_FILE_PATH_FOAG = WP_CONTENT_DIR . CACHE_FILE_FOAG;
const FOAG_LOGGER_FILE_PATH = WP_CONTENT_DIR . FOAG_LOGGER_FILE;


function foag_log_info($sku, $message): void
{
    $logger = fopen(FOAG_LOGGER_FILE_PATH, "a+");
    $currentDateTime = date('Y-m-d H:i:s');
    fwrite($logger, "[" . $currentDateTime . "] " . "[" . $sku . "] " . $message . "\n");
    fclose($logger);
}

function foag_save_sku_create($sku)
{
    if (file_exists(CACHE_FOAG_TO_CREATE_FILE_PATH)) {
        $to_create_file = fopen(CACHE_FOAG_TO_CREATE_FILE_PATH, 'r');
        clearstatcache(true, CACHE_FOAG_TO_CREATE_FILE_PATH);
        $to_create_arr = json_decode(fread($to_create_file, filesize(CACHE_FOAG_TO_CREATE_FILE_PATH)), true);
        fclose($to_create_file);
        if ($to_create_arr === null) {
            foag_log_info($sku, "Can't read json, Error: " . json_last_error_msg());
        }
    } else {
        $to_create_arr = array();
    }
    $to_create_arr[] = $sku;

    $to_create_file = fopen(CACHE_FOAG_TO_CREATE_FILE_PATH, 'w');
    fwrite($to_create_file, json_encode($to_create_arr));
    fclose($to_create_file);
}

add_action('run_foag_update', 'foag_runJob_update');

function foag_runJob_update()
{
    $products = foag_read_products_cache(); // Or create if is does not exists
    $client_v1 = new SoapClient('https://www.foagroup.com/api/soap/?wsdl');

    $session_v1 = $client_v1->login(API_USER, API_KEY);

    if (empty($products)) {
        return;
    }
    for ($i = 0; $i < sizeof($products); $i++) {
        $sku = $products[$i]['sku'];
        $id = $products[$i]['product_id'];
        foag_log_info($sku, "[FOAGROUP] Started");

        $existing_product_id = wc_get_product_id_by_sku($sku);
        if ($existing_product_id != null) {
            foag_update_existing_product($client_v1, $session_v1, $existing_product_id, $id, $sku);
        } else {
            foag_save_sku_create($sku);
        }
    }
}

function foag_update_existing_product($client_v1, $session_v1, $existing_product_id, $id, $sku)
{
    $existing_product = new WC_Product_Simple($existing_product_id);
    $modified_time = strtotime(get_post_modified_time('Y-m-d', false, $existing_product->get_id()));
    $current_time = strtotime(current_time('Y-m-d'));
    $week_ago = strtotime('-1 week', $current_time);

    if ($modified_time >= $week_ago) {
        foag_log_info($sku, "[FOAGROUP] Skipped, updated less then a week ago");
    } else {
        $stock_qty_response = $client_v1->call($session_v1, 'cataloginventory_stock_item.list', $id);
        if (!empty($stock_qty_response)) {
            $stock_qty = intval($stock_qty_response[0]['ca_qty']);
        } else {
            $stock_qty = 0;
        }

        $product_info = $client_v1->call($session_v1, 'catalog_product.info', $id);
        if (!empty($product_info)) {
            $price = floatval($product_info['price'])*1.45;
        } else {
            $price = 0;
        }
        // Managing stock properties
        if ($stock_qty <= 0) {
            $existing_product->set_stock_status('outofstock');
            foag_log_info($sku, "[FOAGROUP] Went out of stock");
        } else {
            $existing_product->set_stock_status('instock');
        }
        // Managing price properties
        if ($price > 0) {
            $existing_product->set_regular_price($price);
        } else {

        }

        $existing_product->save();
        foag_log_info($sku, "Updated");
    }
}

add_action('foag_create_product_cache', 'foag_create_products_cache');


function foag_create_products_cache(): void
{
    $client_v2 = new SoapClient('https://www.foagroup.com/api/v2_soap/?wsdl');
    $cache_json = fopen(CACHE_FILE_PATH_FOAG, "w+");

    $complexFilter = array(
        'complex_filter' => array(
            array(
                'key' => 'status',
                'value' => array('key' => '=', 'value' => '1')
            )
        )
    );

    $session_v2 = $client_v2->login(API_USER, API_KEY);
    $product_response = $client_v2->catalogProductList($session_v2, $complexFilter);
    var_dump($product_response);
    fwrite($cache_json, json_encode($product_response));
    fclose($cache_json);
}

function foag_read_products_cache(): array
{
    $cache_json = fopen(CACHE_FILE_PATH_FOAG, "r");
    if (filesize(CACHE_FILE_PATH_FOAG) > 0) {
        $cache = fread($cache_json, filesize(CACHE_FILE_PATH_FOAG));
        fclose($cache_json);
        return json_decode($cache, true);
    } else {
        return array();
    }
}