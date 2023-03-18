<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<div class="woocommerce-customer-details order-customer-details">

	<?php if ( $show_shipping ) : ?>


	<?php endif; ?>
    <div class=" woocommerce-column--billing-address">
        <h2 class="woocommerce-column__title"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2>

        <p>
            <?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
            <br>
            <?php if ( $order->get_billing_phone() ) : ?>
                <?php echo esc_html( $order->get_billing_phone() ); ?>
            <?php endif; ?>
            <br>
            <?php if ( $order->get_billing_email() ) : ?>
                <?php echo esc_html( $order->get_billing_email() ); ?>
            <?php endif; ?>
        </p>
    </div>
	<?php if ( $show_shipping ) : ?>


		<div class="woocommerce-column--shipping-address">
			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>
			<p>
				<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
                <br>
				<?php if ( $order->get_shipping_phone() ) : ?>
					<?php echo esc_html( $order->get_shipping_phone() ); ?>
				<?php endif; ?>
            </p>
		</div>


	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</div>