<?php
/**
 * Template Name: Foagroup update price
 *
 * The main template file
 *
 * @package Sibosfurniture
 */
?>
<?php
const API_USER = 'sibosfurniture';
const API_KEY = '5ab3e1ed-5f50-4120-87db-6a547450c672';

const CACHE_FILE_FOAG = "/themes/sibosfurniture-master/cache_foagroup.json";
const FOAG_LOGGER_FILE = "/themes/sibosfurniture-master/foag_logs.txt";


const CACHE_FILE_PATH_FOAG = WP_CONTENT_DIR . CACHE_FILE_FOAG;
const FOAG_LOGGER_FILE_PATH = WP_CONTENT_DIR . FOAG_LOGGER_FILE;


$products = foag_read_products_cache(); // Or create if is does not exists

$client_v1 = new SoapClient('https://www.foagroup.com/api/soap/?wsdl');

$session_v1 = $client_v1->login(API_USER, API_KEY);

if (empty($products)) {
    echo '<p>Empty cache</p>';
    return;
}
// for ($i = 0; $i < sizeof($products); $i++) {
 for ($i = 10; $i < 11; $i++) {

    $sku = $products[$i]['sku'];
    $id = $products[$i]['product_id'];
    foag_log_info($sku, "Started");

    $existing_product_id = wc_get_product_id_by_sku($sku);
    if ($existing_product_id != null) {
        foag_update_product_price($client_v1, $session_v1, $existing_product_id, $sku, $id);
    }
 }

function foag_update_product_price($client_v1, $session_v1, $internal_product_id, $sku, $id){
    $modified_time = strtotime(get_post_modified_time('Y-m-d', false, $internal_product_id));
    $current_time = strtotime(current_time('Y-m-d'));
    $week_ago = strtotime('-1 week', $current_time);
    $existing_product = wc_get_product($internal_product_id);

    if ($modified_time >= $week_ago) {
        foag_log_info($sku, "Skipped, updated less then a week ago");
    } else {
        $product_info = $client_v1->call($session_v1, 'catalog_product.info', $id);
        if (!empty($product_info)) {
            $price = ceil(floatval($product_info['price'])*1.18);
            foag_log_info($sku, "API price: ". floatval($product_info['price']));
        } else {
            $price = 0;
        }
        
        // Managing price properties
        if ($price > 0) {
            $existing_product->set_regular_price(strval($price));
        } else {
            foag_log_info($sku, "No price info");
            $existing_product->set_status('draft');
        }

        $existing_product->save();
        foag_log_info($sku, "Updated");
    }
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
function foag_log_info($sku, $message): void
{
    $logger = fopen(FOAG_LOGGER_FILE_PATH, "a+");
    $currentDateTime = date('Y-m-d H:i:s');
    fwrite($logger, "[" . $currentDateTime . "] " . "[" . $sku . "] " . $message . "\n");
    fclose($logger);
}