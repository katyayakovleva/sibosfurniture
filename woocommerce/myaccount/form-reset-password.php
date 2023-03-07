<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
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

do_action( 'woocommerce_before_reset_password_form' );
?>
<article class="px-2 px-sm-4 mb-2">
    <header class="header-primary">
        <h1 class="ff-ms fs-2 fc-blue-2 fw-7">Reset password</h1>
    </header>
    <section class="container g-2 g-lg-4 mb-2">
        <article class="header-block mt-3">
            <header>
                <h2>My account</h2>
            </header>
            <section class="header-block__body">
                <form method="post">

                    <p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

                    <div class="form-control">
                        <label for="password_1">New password&nbsp;<span class="required">*</span></label>
                        <input type="password" name="password_1" id="password_1" autocomplete="new-password" />
                        <span id="toggle_pwd_1" class="fa fa-fw fa-eye field_icon"></span>
                    </div>
                    <div class="form-control">
                        <label for="password_2">Re-enter new password&nbsp;<span class="required">*</span></label>
                        <input type="password" name="password_2" id="password_2" autocomplete="new-password" />
                        <span id="toggle_pwd_2" class="fa fa-fw fa-eye field_icon"></span>
                    </div>

                    <input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
                    <input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

                    <div class="clear"></div>

                    <?php do_action( 'woocommerce_resetpassword_form' ); ?>

                    <p class="woocommerce-form-row form-row">
                        <input type="hidden" name="wc_reset_password" value="true" />
                        <button type="submit" class="btn" value="Save">Save</button>
                    </p>

                    <?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>
                </form>
            </section>
        </article>
    </section>
</article>
		
<?php
do_action( 'woocommerce_after_reset_password_form' );?>
