<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<article class="px-2 px-sm-4 mb-2 checkout-form-coupon" >
    <form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

        <?php do_action( 'woocommerce_login_form_start' ); ?>

        <?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

        <div class="form-row form-row-first form-control">
            <label for="username"><?php esc_html_e( 'Email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
            <input type="text" class="input-text" name="username" id="username" autocomplete="username" />
        </div>
        <div class="form-row form-row-last form-control">
            <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
            <input type="password" name="password" id="password" autocomplete="current-password" />
            <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
        </div>
        <div class="clear"></div>

        <?php do_action( 'woocommerce_login_form' ); ?>
        <div class="checkout_login_footer">
            <div class="form-checkbox big">
                <label><input name="rememberme" type="checkbox" id="rememberme" value="forever">Remember me</label>
                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            </div>
            <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
            <button class="btn" type="submit" name="login" value="Log in">Log in</button> 
            <a class="link blue" href='<?php echo esc_url( wp_lostpassword_url() ); ?>'>Lost your password?</a>  
        </div>
        

        <div class="clear"></div>

        <?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>
</article>