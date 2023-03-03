<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>
<main class="header-padding">
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
				<form  method="post">
				<?php do_action( 'woocommerce_login_form_start' ); ?>
				<div class="form-control">
					<label for="username">Email</label> 
					<input type="text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>              
				</div>
				<div class="form-control">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" autocomplete="current-password" />
				</div>
				
				<?php do_action( 'woocommerce_login_form' ); ?>
				
				<div class="form-checkbox big">
					<label><input name="rememberme" type="checkbox" id="rememberme" value="forever">Remember me</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				</div>
				<button  class="btn" type="submit" name="login" value="Log in">Log in</button> 
				<a class="link blue" href='<?php echo esc_url( wp_lostpassword_url() ); ?>'>Lost your password?</a>
				<?php do_action( 'woocommerce_login_form_end' ); ?>
				</form>
			</section>
			</article>
			<article class="header-block mt-3">
			<header>
				<h2>New here?</h2>
			</header>
			
			<section class="header-block__body">
				<p class="ff-ms fs-4 fc-blue-4 fw-7 fg-1 ta-center ta-sm-start pb-2 pb-sm-0">Sign up and cutomize your futniture!</p>
				<a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>?action=registeration"> register </a>
				<button class="btn as-center" onclick="location.href = '#'">Sign up</button>
			</section>
			</article>
		</section>
	</article>
</main>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>