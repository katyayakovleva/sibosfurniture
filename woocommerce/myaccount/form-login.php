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

if ( is_user_logged_in() ) { 
  	if (strpos($_SERVER['REQUEST_URI'], "register") !== false){
 		// wp_redirect( home_url('/myaccount/') ); exit; 
		 header('Location: https:myaccount.php');
	//header("location:myaccount.php"); or sth that you want.
	} else if (strpos($_SERVER['REQUEST_URI'], "login") !== false) {
	header('Location: https:myaccount.php');
	//header("location:myaccount.php"); or sth that you want. 
	} else {}
	if (strpos($_SERVER['REQUEST_URI'], "myaccount") !== false){
	header('Location: https:myaccount.php');
	//header("location:myaccount.php"); or sth that you want. 
	} else {};
 }
if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly.
}
do_action( 'woocommerce_before_customer_login_form' ); ?>

<!-- <main class="header-padding">		 -->
<?php  
if ( !is_user_logged_in() ) :
	if (strpos($_SERVER['REQUEST_URI'], "register") !== false):
		?>
		<article class="px-2 px-sm-4 mb-2">
				<header class="header-primary">
					<h1 class="ff-ms fs-2 fc-blue-2 fw-7">Registration</h1>
				</header>
				<section class="container g-2 g-lg-4 mb-2">
					<article class="header-block mt-3">
					<header>
						<h2>New account</h2>
					</header>
					<section class="header-block__body">
						<form  method="post" <?php do_action( 'woocommerce_register_form_tag' ); ?> action="<?php echo home_url('/my-account/');?>">
							<?php do_action( 'woocommerce_register_form_start' ); ?>
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
								</p>
							<?php endif; ?>
							<div class="form-control">
								<label for="reg_email">Email&nbsp;<span class="required">*</span></label>
								<input type="email" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</div>
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
								<div class="form-control">
									<label for="reg_password">Password&nbsp;<span class="required">*</span></label>
									<input type="password" name="password" id="reg_password" autocomplete="new-password" />
									<span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
								</div>
							<?php else : ?>
								<!-- <p><?php //esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p> -->
							<?php endif; ?>
							<?php do_action( 'woocommerce_register_form' ); ?>
								<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
								<button type="submit" class="btn" name="register" value="Register">Register</button>
							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
					</section>
				</article>
			</section>
		</article>
	<?php else:?>
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
								<label for="username">Email&nbsp;<span class="required">*</span></label> 
								<input type="text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>              
							</div>
							<div class="form-control">
								<label for="password">Password&nbsp;<span class="required">*</span></label>
								<input type="password" name="password" id="password" autocomplete="current-password" />
								<span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
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
						<button class="btn as-center" onclick="location.href = '<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>register'">Sign up</button>
					</section>
				</article>
			</section>
		</article>
<?php 
	endif; 
endif;
?>
    <article class="px-3 px-sm-4 bg-blue-5 related products">
        <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
        <?php get_template_part('template-parts/content', 'popular-products');?>
    </article>
    <!-- </main> -->

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>