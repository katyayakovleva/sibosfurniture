<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$SKU = $product->get_sku();
$pieces = explode(' ', $SKU);
$SKU_last_word = array_pop($pieces);
$SKU_first_words = implode(' ', $pieces);
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
        <p class="ff-ms fs-6 fc-dark my-0 mt-sm-1"><?php echo ( $SKU_first_words ) ? $SKU_first_words : esc_html__( 'N/A', 'woocommerce' ); ?></p>
        <p class="ff-ms fs-6 fc-dark my-0 my-sm-1"><?php echo ( $SKU_last_word ) ? $SKU_last_word : esc_html__( 'N/A', 'woocommerce' ); ?></p>
        <p class="ff-ms fs-6 fw-7 fc-blue-3 m-sm-0"><?php echo $product->get_price_html(); ?></p>
    <?php endif; ?>

<!--	--><?php //echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

<!--	--><?php //echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
