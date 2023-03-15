<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<form name="checkout" method="post" class="px-2 px-sm-4 cols w-100 border-box mb-2 checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
    <section class="col-1 col-sm-1-2">
        <h1 class="ff-ms fs-2 fw-7 fc-blue-2">Checkout</h1>
        <!-- <div class="form-group">
            <div class="form-control dark"><input type="text" name="coupon"
                    placeholder="Have a coupon? Click here to enter your code"></div>
        </div> -->
        <?php if ( $checkout->get_checkout_fields() ) : ?>

            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

            <div class="" id="customer_details">
                <div class="">
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>

                <div class="">
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

        <?php endif; ?>
    </section>
    <section class="col-1 col-sm-1-2 pl-sm-2 pl-sm-4">    
    <article class="header-block mt-3">
            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                        
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
  
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </article>
    </section>
</form>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>