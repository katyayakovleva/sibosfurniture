<?php
/**
 * Template Name: Registration Form
 * 
 * The main template file
 *
 * @package Sibosfurniture
 */
get_header();

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>


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
						<form  method="post" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
                        <?php do_action( 'woocommerce_register_form_start' ); ?>
							<div class="form-control">
								<label for="reg_username">Email</label> 
								<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</div>
							<div class="form-control">
								<label for="reg_password">Password</label>
								<input type="password" name="password" id="reg_password" autocomplete="new-password" />
							</div>
							
							<?php do_action( 'woocommerce_register_form' ); ?>
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button  class="btn" type="submit"value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">Register</button> 

                            <?php do_action( 'woocommerce_register_form_end' ); ?>

						</form>
					</section>
				</article>
			</section>
		</article>
	</main>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<?php endif; ?>
<?php get_footer();?>
