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
global $post;
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :
        if(strlen($SKU)>1){?>
            <p class="ff-ms fs-6 fc-dark my-0 mt-sm-1"><?php echo  $SKU_first_words  ?></p>
            <p class="ff-ms fs-6 fc-dark my-0 my-sm-1"><?php echo  $SKU_last_word ?></p>
        <?php }else{?>
            <p class="ff-ms fs-6 fc-dark my-0 my-sm-1"><?php echo  $SKU_last_word ?></p>

    <?php } ?>

        <?php if( $product->is_type( 'variable' ) ){?>
        <p class="ff-ms fs-6 fw-7 fc-blue-3 m-sm-0 price-mobile"><?php echo $product->get_price_html(); ?></p>
        <?php }?>
        <?php if( !$product->is_type( 'variable' ) ){?>
        <p class="ff-ms fs-6 fw-7 fc-blue-3 m-sm-0 price-mobile simple-prod-mobile-price <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
        <?php }?>
        <hr class="d-sm-none mt-0 mb-1 <?php if( $product->get_type() == 'woosg' ){ echo 'woosg_hr'; }?>">
        <div class="mobile-description woocommerce-product-short-description">
            <?php echo $short_description; ?>
        </div>
    <?php endif; ?>

<!--	--><?php //echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

<!--	--><?php //echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
