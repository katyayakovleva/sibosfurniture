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
<article class="px-3 px-sm-4 bg-blue-5">
	<h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
	<div class="swiper-per-view">
		<div class="swiper-wrapper">
			<div class="swiper-slide grid-item-shop">
				<div class="grid-item-shop__header changing-color-item">
					<figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige"
							alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green"
							alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red"
							alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue"
							alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple"
							alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg"
							data-color="dark-red" alt="item image"></figure>
					<div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span
							role="button" aria-label="green" data-color="green"></span> <span role="button"
							aria-label="red" data-color="red"></span> <span role="button" aria-label="blue"
							data-color="blue"></span> <span role="button" aria-label="purple"
							data-color="purple"></span> <span role="button" aria-label="dark-red"
							data-color="dark-red"></span></div>
				</div>
				<p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
				<p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
				<div class="d-flex ai-center jc-between mt-2">
					<p class="grid-item-shop__price ff-ms m-0">679$</p>
					<div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i
								class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i
								class="icon-cart-icon"></i></a></div>
				</div>
			</div>
		</div>
		<div class="swiper-pagination"></div>
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>
</article>
<!-- </main> -->

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>