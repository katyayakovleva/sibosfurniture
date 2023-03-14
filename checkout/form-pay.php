<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
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

$totals = $order->get_order_item_totals(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
?>

<section class="orders">
<p class="orders__title">Payment process</p>
    <div class="orders__container">
<!-- <form id="order_review" method="post"> -->
			<?php if ( count( $order->get_items() ) > 0 ) : ?>
				<?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                    <div class="orders__row">
					<?php
					if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
						continue;
					}
					?>
						 <div>
                            <p>Product</p>
                            <p>
                                <?php
                                    echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $item->get_name(), $item, false ) );

                                    do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

                                    wc_display_item_meta( $item );

                                    do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
                                ?>
                            </p>
                        </div>
						<div>
                            <p>Quantity</p>
                            <p>
                                <?php echo apply_filters( 'woocommerce_order_item_quantity_html', '' . sprintf( '&times;&nbsp;%s', esc_html( $item->get_quantity() ) ) . '', $item ); ?><?php // @codingStandardsIgnoreLine ?>
                            </p>
                        </div>	
                        <div>
                            <p>Totals</p>
                            <p>
                                <?php echo $order->get_formatted_line_subtotal( $item ); ?><?php // @codingStandardsIgnoreLine ?>
                            </p>
                        </div>
					
                    </div>
				<?php endforeach; ?>
			<?php endif; ?>
        
			<?php if ( $totals ) : ?>
                <div class="orders__row orders__footer">
                    <?php foreach ( $totals as $total ) : ?>
                        <div>
                            <p><?php echo $total['label']; ?></p><?php // @codingStandardsIgnoreLine ?>
                            <p><?php echo $total['value']; ?></p><?php // @codingStandardsIgnoreLine ?>
                        </div>
                    <?php endforeach; ?>
                </div>
			<?php endif; ?>

    </div>
    <form>
        <?php $allow_payment = false; ?>
		<?php if ( $order->needs_payment() ) : ?>
			
				<?php
				if ( ! empty( $available_gateways ) ) {
                    $allow_payment = true;
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<p>' . apply_filters( 'woocommerce_no_available_payment_methods_message', esc_html__( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ) . '</p>'; // @codingStandardsIgnoreLine
				}
				?>
			
		<?php endif; ?>
        <?php if($allow_payment):?>
		<!-- <div class="form-row"> -->
			<input type="hidden" name="woocommerce_pay" value="1" />

			<?php wc_get_template( 'checkout/terms.php' ); ?>

			<?php do_action( 'woocommerce_pay_order_before_submit' ); ?>
			<?php echo apply_filters( 'woocommerce_pay_order_button_html', '<button type="submit" class="btn" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

			<?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

			<?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>
		<!-- </div> -->
        <?php endif; ?>
	</form>

<!-- </form> -->
</section>
