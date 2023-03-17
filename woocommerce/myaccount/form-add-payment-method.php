<?php
/**
 * Add payment method form form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-add-payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

$available_gateways = WC()->payment_gateways->get_available_payment_gateways();?>
<?php if ( $available_gateways ) : ?>
	<article class="px-2 px-sm-4 mb-2">
		<section class="container g-2 g-lg-4 mb-2">
			<article class="header-block mt-3">
				<header>
					<h2>Add payment method</h2><?php // @codingStandardsIgnoreLine ?>
				</header>
				<section class="header-block__body">
					<form id="add_payment_method" method="post">
						<div id="payment" class="woocommerce-Payment checkout-payment">
							<ul class="woocommerce-PaymentMethods payment_methods methods">
								<?php
								// Chosen Method.
								if ( count( $available_gateways ) ) {
									current( $available_gateways )->set_current();
								}

								foreach ( $available_gateways as $gateway ) {
									?>
									<li class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr( $gateway->id ); ?> payment_method_<?php echo esc_attr( $gateway->id ); ?>">
									<div class="form-checkbox">
										<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> />
										<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>"><?php echo wp_kses_post( $gateway->get_title() ); ?> <?php echo wp_kses_post( $gateway->get_icon() ); ?></label>
									</div>
										<?php
										if ( $gateway->has_fields() || $gateway->get_description() ) {
											echo '<div class="woocommerce-PaymentBox woocommerce-PaymentBox--' . esc_attr( $gateway->id ) . ' payment_box payment_method_' . esc_attr( $gateway->id ) . '" style="display: none;"><div class="payment_box_inner ">';
											$gateway->payment_fields();
											echo '</div></div>';
										}
										?>
									</li>
									<?php
								}
								?>
							</ul>

							<?php do_action( 'woocommerce_add_payment_method_form_bottom' ); ?>

							<div class="form-row">
								<?php wp_nonce_field( 'woocommerce-add-payment-method', 'woocommerce-add-payment-method-nonce' ); ?>
								<button type="submit" class=" btn woocommerce-Button woocommerce-Button--alt alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" id="place_order" value="<?php esc_attr_e( 'Add payment method', 'woocommerce' ); ?>"><?php esc_html_e( 'Add payment method', 'woocommerce' ); ?></button>
								<input type="hidden" name="woocommerce_add_payment_method" id="woocommerce_add_payment_method" value="1" />
							</div>
						</div>
					</form>
				</section>
			</article>
		</section>
	</article>
<?php else : ?>
	<article class="px-2 px-sm-4 mb-2">
		<div class="min-content-page">
			<div>
				<p class="ff-ms fs-5 fc-dark my-2"><?php esc_html_e( 'New payment methods can only be added during checkout. Please contact us if you require assistance.', 'woocommerce' ); ?></p>
			</div>
		</div>
	</article>
	<article class="px-3 px-sm-4 bg-blue-5 related products">
		<h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
		<?php get_template_part('template-parts/content', 'popular-products');?>
	</article>

<?php endif; ?>