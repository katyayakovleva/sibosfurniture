<?php
/**
 * Cart errors page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/cart-errors.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>
<article class="px-2 px-sm-4 mb-2">
    <div class="min-content-page">
        <div>
            <p class="ff-ms fs-4 fw-7 fc-blue-2"><?php esc_html_e( 'There are some issues with the items in your cart. Please go back to the cart page and resolve these issues before checking out.', 'woocommerce' ); ?></p>
            <?php do_action( 'woocommerce_cart_has_errors' ); ?>
            <button class="btn wc-backward" onclick="location.href = '<?php echo esc_url( wc_get_cart_url() ); ?>'">Return to cart</button>
        </div>
    </div>
</article>
<article class="px-3 px-sm-4 bg-blue-5 related products">
    <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
    <?php get_template_part('template-parts/content', 'popular-products');?>
</article>

