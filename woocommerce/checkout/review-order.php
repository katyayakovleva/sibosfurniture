<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<header>
	<h2>Your order</h2>
</header>
<section class="header-block__body shop_table woocommerce-checkout-review-order-table">
<div class="header">
	<div class="row">
		<p>Product</p>
		<p>Totals</p>
	</div>
</div>
<div class="main">
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );
		
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {?>
			<div class="row">
				<?php $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					
						<p>
								<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
								<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								
						</p>	
					
						<p>
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</p>	
				<?php } ?>
			</div>
		<?php }

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</div>	
	<div class="footer">
			<div class="row">
				<p>Subtotal</p>
				<p><?php wc_cart_totals_subtotal_html(); ?></p>
			</div>

			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
					<p><?php wc_cart_totals_coupon_label( $coupon ); ?></p>
					<p><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
				</div>
			<?php endforeach; ?>

			

			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<div class="fee row">
					<p><?php echo esc_html( $fee->name ); ?></p>
					<p><?php wc_cart_totals_fee_html( $fee ); ?></p>
				</div>
			<?php endforeach; ?>

			<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
				<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
						<div class=" row tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
							<p><?php echo esc_html( $tax->label ); ?></p>
							<p><?php echo wp_kses_post( $tax->formatted_amount ); ?></p>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="tax-total row">
						<p><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></p>
						<p><?php wc_cart_totals_taxes_total_html(); ?></p>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
			<div class="order-total row">
				<p>Total</p>
				<p><?php wc_cart_totals_order_total_html(); ?></p>
			</div>
			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
				<div class="order-detail-shipping row">
					<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

					<p><?php wc_cart_totals_shipping_html(); ?></p>

					<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
				</div>
			<?php endif; ?>

		</div>
		<?php 
		$args = array(
			'numberposts' => 1,
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_type'   => 'shop_order',
			'post_status' => 'wc-completed'
		);
		$orders = get_posts( $args );
		
		if(!(WC()->cart->has_discount( 'firstorder' ))):?>
			<div id="first_order_discount"><a>Applay first order discount</a></div>
		<?php endif; ?>
</section>

