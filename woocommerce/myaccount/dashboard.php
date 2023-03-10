<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// $allowed_html = array(
// 	'a' => array(
// 		'href' => array(),
// 	),
// );
?>

<article class="px-2 px-sm-4 mb-2">
    <header class="header-primary pl-2 pl-sm-0">
        <h1 class="ff-ms fs-2 fc-blue-2 fw-7">Welcome back</h1>
        <h2 class="ff-ms fs-4 mt-sm-2">Hello, <?php echo esc_html( $current_user->display_name );?></h2>
        <p class="ff-ms fs-5 fc-blue-4">(not <?php echo esc_html( $current_user->display_name );?>? <a href="<?php echo esc_url( wc_logout_url() );?>" class="decor">Loged out</a>)</p>
    </header>
    <?php $user = wp_get_current_user(); ?>
    <section class="menu">
        <div class="menu__header" id="dashboard-menu">
            <button id="dashboard" data-target="dashboard" class="active">Dashboard</button> 
            <button id="orders" data-target="orders">Orders</button> 
            <button id="addresses" data-target="addresses">Addresses</button> 
            <button id="payment-methods" data-target="payment-methods">Payment methods</button> 
            <button id="account-details" data-target="account-details">Account details</button> 
            <button id="logout" data-target="logout">Logout</button>
        </div>
        <div class="menu__body" >

            <div id="dashboard-content" class="dashboard active" >
                <div>
                  
                    <p>From your account dashboard you can <a data-target="orders">view your recent orders</a>,<br>manage
                        your <a data-target="addresses">shipping and billing addresses</a>,<br>and <a  data-target="account-details">edit your
                            passwords and account details</a>
                    </p>
                
                </div>
            </div>

            
        </div>
        
    </section>
</article>
</div></div>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */?>