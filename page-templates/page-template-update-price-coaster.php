<?php
/**
 * Template Name: Coasterfurniture update price
 *
 * The main template file
 *
 * @package Sibosfurniture
 */
?>
<?php
const CACHE_COASTER_FILE = "/themes/sibosfurniture-master/cache_coaster.json";
const CACHE_COASTER_PRICES_FILE = "/themes/sibosfurniture-master/cache_coaster_prices.json";
const LOGGER_FILE = "/themes/sibosfurniture-master/logs_coaster_price_update.txt";


const CACHE_FILE_PATH = WP_CONTENT_DIR . CACHE_COASTER_FILE;
const CACHE_PRICES_FILE_PATH = WP_CONTENT_DIR . CACHE_COASTER_PRICES_FILE;
const LOGGER_FILE_PATH = WP_CONTENT_DIR . LOGGER_FILE;

const COASTER_HEADERS = array(
    "keycode" => "45FDCB85CF2F440E9750F1E96A"
);
coaster_create_prices_cache();
$products = coaster_read_product_cache(); // Or create if is does not exists
$prices_map = coaster_read_product_price_cache();

for ($i = 0; $i < sizeof($products); $i++) {

    $sku = $products[$i]['ProductNumber'];
    $product_id = wc_get_product_id_by_sku($sku);

    if ($product_id != null) {
        coaster_update_product_price($product_id, $prices_map[$sku], $sku);
    }
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

function coaster_update_product_price($product_id, $price, $sku){

    $modified_time = strtotime(get_post_modified_time('Y-m-d', false, $product_id));
    $current_time = strtotime(current_time('Y-m-d'));
    $week_ago = strtotime('-1 week', $current_time);
    if ($modified_time <= $week_ago) {
        log_info($sku, ' updated');
        echo '<p>'.$sku.' updated</p>';
        
        $_product = wc_get_product( $product_id );
        $changed_price = ceil($price * 0.73); // TODO add ceil to the sibosfurniture.com + -1 day in update terms
        $_product->set_regular_price(strval($changed_price));
        $_product->save();
    
    }else{
        log_info($sku, 'skipped');
    }
   
}


function coaster_create_prices_cache(): void
{
    $cache_json = fopen(CACHE_PRICES_FILE_PATH, "w+");
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

function log_info($sku, $message): void
{
    $logger = fopen(LOGGER_FILE_PATH, "a+");
    $currentDateTime = date('Y-m-d H:i:s');
    fwrite($logger, "[" . $currentDateTime . "] " . "[" . $sku . "] " . $message . "\n");
    fclose($logger);
}