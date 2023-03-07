<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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

do_action( 'woocommerce_before_lost_password_form' );
?>
<!-- <main class="header-padding">	 -->
	<article class="px-2 px-sm-4 mb-2">
		<header class="header-primary">
			<h1 class="ff-ms fs-2 fc-blue-2 fw-7">Sign in</h1>
		</header>
		<section class="container g-2 g-lg-4 mb-2">
			<article class="header-block mt-3">
			<header>
				<h2>My account</h2>
			</header>
			<section class="header-block__body">	
				<form method="post">

					<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

					<div class="form-control">
						<label for="user_login">Email</label>
						<input type="text" name="user_login" id="user_login" autocomplete="username" />
					</div>

					<div class="clear"></div>

					<?php do_action( 'woocommerce_lostpassword_form' ); ?>

					<p class="woocommerce-form-row form-row">
						<input type="hidden" name="wc_reset_password" value="true" />
						<button type="submit" class="btn"  value="Reset password">Reset password</button>
					</p>

					<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

				</form>
			</section>
		</article>
	</section>
</article>
<!-- </main> -->
<?php
do_action( 'woocommerce_after_lost_password_form' );?>