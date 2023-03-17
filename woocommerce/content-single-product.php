<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $post;
$price = $product->get_price();
$title = $product->get_title();
$SKU = $product->get_sku();
$pieces = explode(' ', $SKU);
$SKU_last_word = array_pop($pieces);
$SKU_first_words = implode(' ', $pieces);
$short_description = $product->get_short_description();
$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
$current_post = get_the_ID();
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>

    <div class="header-padding">
    <article class="product-article">
        <div class="breadcrumb my-1">
            <div class="breadcrumb__item"><a href="<?php echo home_url();?>" class="link">Home</a></div>
            <div class="breadcrumb__item"><a href="<?php echo $shop_page_url ?>" class="link">Catalog</a></div>
            <div class="breadcrumb__item"><a href="<?php echo get_permalink();?>" class="link"><?php the_title(); ?></a></div>
        </div>
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        <div class="product-main-info">
            <?php
            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action( 'woocommerce_before_single_product_summary' );
            ?>
            <div class="summary entry-summary">
                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action( 'woocommerce_single_product_summary' );
                ?>
            </div>
        </div>
        <div class="product-additional-info">
            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action( 'woocommerce_after_single_product_summary' );
            ?>
        </div>
    </div>
    </article>
    </div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
<style>
    .wpgs-for .slick-arrow {
        top: 88%;
        padding: 0 12px;
    }
    .wpgs-for .slick-arrow:before {
        content: "";
        border: solid #c7d6eb;
        border-width: 0 4px 4px 0;
        display: inline-block;
        padding: 9px;
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
    }
    .wpgs-for .slick-arrow:first-of-type:before {
        transform: rotate(135deg);
        -webkit-transform: rotate(135deg);
    }
    .wpgs-nav .slick-track {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: .5em
    }
    .wpgs-nav .slick-slide {
        aspect-ratio: 1;
        padding: 6px;
        border: 2px solid transparent;
        transition: border ease-in-out .12s;
    }
    .wpgs-nav .slick-slide.slick-current {
         border-color: #0049af;
     }
    .wpgs-lightbox-icon::before{
        display: none;
    }
    @media screen and (max-width: 35.5em){
        .wpgs-nav .slick-slide {
            max-width: 95px;
        }
    }
</style>
<script>
    jQuery(document).ready(function() {
        jQuery('.quantity input').attr("value", 1);
    })

</script>
