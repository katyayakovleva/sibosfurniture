<?php

/**
 * Sibosfurniture functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sibosfurniture
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
include_once('coaster_upd.php');
include_once('acme_upd.php');
include_once('foagroup_upd.php');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sibosfurniture_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Sibosfurniture, use a find and replace
		* to change 'sibosfurniture' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'sibosfurniture', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-primary' => esc_html__( 'Primary', 'sibosfurniture' ),
			'menu-primary-items' => esc_html__( 'Primary-items', 'sibosfurniture' ),
			'footer-menu' => esc_html__( 'Footer menu', 'sibosfurniture' ),
			'footer-info-links' => esc_html__( 'Footer info links', 'sibosfurniture' ),
			'home-page-menu' => esc_html__( 'Home Page Menu', 'sibosfurniture' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	// add_theme_support(
	// 	'custom-background',
	// 	apply_filters(
	// 		'sibosfurniture_custom_background_args',
	// 		array(
	// 			'default-color' => 'ffffff',
	// 			'default-image' => '',
	// 		)
	// 	)
	// );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'sibosfurniture_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sibosfurniture_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sibosfurniture_content_width', 640 );
}
add_action( 'after_setup_theme', 'sibosfurniture_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sibosfurniture_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sibosfurniture' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sibosfurniture' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sibosfurniture_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sibosfurniture_scripts() {
    wp_enqueue_style( 'sibosfurniture-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'style', get_template_directory_uri(). '/css/style.css', array(), rand(111,9999));
	wp_enqueue_style( 'swiper-bundle', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', array(), rand(111,9999));
    // wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.3.min.js');
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery'), rand(111,9999), true );
	//wp_enqueue_script( 'TweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery-throttle-debounce', 'https://cdn.jsdelivr.net/gh/cowboy/jquery-throttle-debounce@v1.1/jquery.ba-throttle-debounce.min.js',array( 'jquery'), _S_VERSION, true );
	wp_enqueue_script( 'fontawesome', 'https://kit.fontawesome.com/13247fe767.js',array( ), _S_VERSION, true );
	wp_enqueue_script( 'swiper-bundle', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array( 'jquery'), _S_VERSION, true );
    wp_localize_script( 'script', 'ajax_menu_popular_items', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'noposts' => __('No older posts found', 'greenglobe'),
    ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if(is_front_page() || is_home()){
        wp_enqueue_style( 'index', get_template_directory_uri(). '/css/index.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-index', get_template_directory_uri() . '/js/script-index.js', array( 'jquery'), rand(111,9999), true );
		wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array( 'swiper-bundle'), rand(111,9999), true );
		wp_enqueue_script( 'swiper-full_height', get_template_directory_uri() . '/js/swiper-full_height.js', array( 'swiper-bundle'), rand(111,9999), true );
//
    }elseif (is_page_template( 'page-templates/page-template-about-us.php' )){
        wp_enqueue_style( 'about-us', get_template_directory_uri(). '/css/about-us.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array('jquery'), rand(111,9999), true );
		wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array( 'jquery'), rand(111,9999), true );
    }elseif (is_page_template( 'page-templates/page-template-blog.php' ) || is_category()){
        wp_enqueue_style( 'blog', get_template_directory_uri(). '/css/blog.css', array(), rand(111,9999));

	}elseif (is_page_template( 'page-templates/page-template-colors-and-materials.php' )){
        wp_enqueue_style( 'colors-and-materials', get_template_directory_uri(). '/css/colors-and-materials.css', array(), rand(111,9999));
        wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_script( 'script-colors-and-materials', get_template_directory_uri() . '/js/script-colors-and-materials.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array( 'swiper-bundle'), rand(111,9999), true );
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array('jquery'), rand(111,9999), true );
    }elseif (is_page_template( 'page-templates/page-template-portfolio.php' )){
        wp_enqueue_style( 'portfolio', get_template_directory_uri(). '/css/portfolio.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array( 'jquery'), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array( 'swiper-bundle'), rand(111,9999), true );
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array( 'jquery'), rand(111,9999), true );
        wp_enqueue_script( 'portfolio', get_template_directory_uri() . '/js/portfolio.js', array( 'jquery'), rand(111,9999), true );

    }elseif(is_single() && 'post' == get_post_type()){
        wp_enqueue_style( 'news-page', get_template_directory_uri(). '/css/news-page.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-shop-page', get_template_directory_uri() . '/js/script-shop-page.js', array( 'jquery'), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array( 'swiper-bundle'), rand(111,9999), true );

	}elseif(is_account_page()){
		if(is_user_logged_in() && !is_wc_endpoint_url()){
			wp_enqueue_style( 'dashboards', get_template_directory_uri(). '/css/dashboard.css', array(), rand(111,9999));
			wp_enqueue_script( 'script-dashboard', get_template_directory_uri() . '/js/script-dashboard.js', array( 'jquery'), rand(111,9999), true );
			wp_enqueue_script( 'password-visibility', get_template_directory_uri() . '/js/script-password-visibility.js', array( 'jquery'), rand(111,9999), true );
			wp_localize_script( 'script-dashboard', 'ajax_posts', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'noposts' => __('No older posts found', 'greenglobe'),
			));
		}else{
           // wp_enqueue_style( 'checkout-order', get_template_directory_uri(). '/css/checkout-order.css', array(), rand(111,9999));
			wp_enqueue_style( 'sign-in', get_template_directory_uri(). '/css/sign-in.css', array(), rand(111,9999));
			wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array('jquery'), rand(111,9999), true );
			wp_enqueue_script( 'script-stepper-input', get_template_directory_uri() . '/js/script-stepper-input.js', array( 'jquery'), rand(111,9999), true );
			wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
			wp_enqueue_script( 'password-visibility', get_template_directory_uri() . '/js/script-password-visibility.js', array( 'jquery'), rand(111,9999), true );
            wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
            wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array( 'jquery'), rand(111,9999), true );

        }
       
	}elseif(is_checkout()){
		wp_enqueue_style( 'dashboards', get_template_directory_uri(). '/css/dashboard.css', array(), rand(111,9999));
		// wp_enqueue_style( 'sign-in', get_template_directory_uri(). '/css/sign-in.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-dashboard', get_template_directory_uri() . '/js/script-dashboard.js', array('jquery'), rand(111,9999), true );

		wp_enqueue_style( 'checkout-order', get_template_directory_uri(). '/css/checkout-order.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-stepper-input', get_template_directory_uri() . '/js/script-stepper-input.js', array('jquery'), rand(111,9999), true );
		wp_enqueue_script( 'script-checkout', get_template_directory_uri() . '/js/script-checkout.js', array('jquery'), rand(111,9999), true );

        wp_localize_script( 'script-checkout', 'custom_fees_params', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce('custom_fees_nonce'),
        ));
	}elseif(is_product()){
        wp_enqueue_style( 'item-page-in', get_template_directory_uri(). '/css/item-page.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_single_product', get_template_directory_uri(). '/css/woocommerce_single_product.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
		wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
        wp_enqueue_script( 'script-item-page', get_template_directory_uri() . '/js/script-item-page.js', array( 'jquery'), rand(111,9999), true );
        wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array( 'jquery'), rand(111,9999), true );
        wp_enqueue_script( 'script-stepper-input', get_template_directory_uri() . '/js/script-stepper-input.js', array( 'jquery'), rand(111,9999), true );
//        wp_enqueue_script( 'swiper-item-gallery', get_template_directory_uri() . '/js/swiper-item-gallery.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'woocommerce-single-product', get_template_directory_uri() . '/js/woocommerce_single_product.js', array( 'jquery'), rand(111,9999), true );
        wp_enqueue_style( 'review-form', get_template_directory_uri(). '/css/review-form.css', array(), rand(111,9999));

	} elseif(is_cart()){
        wp_enqueue_style( 'my-cart', get_template_directory_uri(). '/css/my-cart.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_my-cart', get_template_directory_uri(). '/css/woocommerce_my-cart.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce_cart', get_template_directory_uri() . '/js/woocommerce_cart.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
    }elseif( is_archive()){
        wp_enqueue_style( 'shop-page', get_template_directory_uri(). '/css/shop-page.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_catalog', get_template_directory_uri(). '/css/woocommerce_catalog_page.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_script( 'script-shop-page', get_template_directory_uri() . '/js/script-shop-page.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
        wp_enqueue_script( 'product-filter', get_template_directory_uri() . '/js/product-filter.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_style( 'news-page', get_template_directory_uri(). '/css/news-page.css', array(), rand(111,9999));


    }elseif (is_page_template( 'page-templates/page-template-wish-list.php' )){
        wp_enqueue_style( 'wishlist', get_template_directory_uri(). '/css/wishlist.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_script( 'wishlist', get_template_directory_uri() . '/js/wishlist.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
    }
    
    elseif (is_search()){
        if( isset($_GET['post_type']) && $_GET['post_type']){
            $type = $_GET['post_type'];
            if ($type == 'product') {  
                wp_enqueue_style( 'shop-page', get_template_directory_uri(). '/css/shop-page.css', array(), rand(111,9999));
                wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
                wp_enqueue_style( 'woocommerce_catalog', get_template_directory_uri(). '/css/woocommerce_catalog_page.css', array(), rand(111,9999));
                wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array('jquery'), rand(111,9999), true );
                wp_enqueue_script( 'script-shop-page', get_template_directory_uri() . '/js/script-shop-page.js', array('jquery'), rand(111,9999), true );
                wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
                wp_enqueue_script( 'product-filter', get_template_directory_uri() . '/js/product-filter.js', array('jquery'), rand(111,9999), true );
            }
        }else{
            wp_enqueue_style( 'blog', get_template_directory_uri(). '/css/blog.css', array(), rand(111,9999));
            // wp_enqueue_style( 'shop-page', get_template_directory_uri(). '/css/shop-page.css', array(), rand(111,9999));
        }
       
    }
    else{
        wp_enqueue_style( 'news-page', get_template_directory_uri(). '/css/news-page.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-shop-page', get_template_directory_uri() . '/js/script-shop-page.js', array('jquery'), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
	}
}
add_action( 'wp_enqueue_scripts', 'sibosfurniture_scripts' );
/* AVATAR */
/**
 * Change default gravatar.
 */

add_filter( 'avatar_defaults', 'new_gravatar' );
function new_gravatar ($avatar_defaults) {
    $myavatar = 'https://sibosfurniture.com/wp-content/uploads/2023/04/Default_avatar.png';
    $avatar_defaults[$myavatar] = "Default Gravatar";
    return $avatar_defaults;
}
/* AVATAR */

add_filter( 'loop_shop_per_page', 'bbloomer_redefine_products_per_page', 9999 );

function bbloomer_redefine_products_per_page( $per_page ) {
    $per_page = 12;
    return $per_page;
}


add_filter( 'preprocess_comment', 'wpb_preprocess_comment' );

function wpb_preprocess_comment($comment) {
    if ( strlen( $comment['comment_content'] ) > 235 ) {
        wp_die('Comment is too long. Please keep your comment under 5000 characters.');
    }
    if ( strlen( $comment['comment_content'] ) < 4 ) {
        wp_die('Comment is too short. Please use at least 60 characters.');
    }
    return $comment;
}

add_filter( 'woocommerce_output_related_products_args', 'bbloomer_change_number_related_products', 9999 );
function bbloomer_change_number_related_products( $args ) {
    $args['posts_per_page'] = 6;
    return $args;
}
//
//add_action('woocommerce_before_add_to_cart_quantity', 'bbloomer_display_dropdown_variation_add_cart');
//function find_variation_id()
//{
//    global $product;
//    if ($product->is_type('variable')) {
//        $variation_id = wc_enqueue_js("$( 'input.variation_id' );");
//        return $variation_id;\wp-admin\admin.php
//    }
//}
//add_action( 'woocommerce_after_add_to_cart_form', 'bbloomer_echo_variation_info' );

function bbloomer_echo_variation_info() {
    global $product;
    if ( ! $product->is_type( 'variable' ) ) return;
    echo '<div class="var_info ff-ms "></div>';
    wc_enqueue_js( "
        $(document).on('found_variation', 'form.cart', function( event, variation ) {   
         $('.var_info').html(variation.price_html);
         $('.var_info').css('visibility', 'visible');
        });
   ");
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'misha_rename_reviews_tab' );
function misha_rename_reviews_tab( $tabs ) {
    global $product;
    $tabs[ 'reviews' ][ 'title' ] = 'Feedback';
    return $tabs;
}
//function filter_woocommerce_cart_totals_coupon_html( $coupon_html, $coupon, $discount_amount_html ) {
//    // Change returned text
//    return str_replace( '[Remove]', '<i class="fa-solid fa-xmark"></i>', $coupon_html );
//}
//add_filter( 'woocommerce_cart_totals_coupon_html', 'filter_woocommerce_cart_totals_coupon_html', 10, 3 );

// -------------
// 1. Show plus minus buttons

add_action( 'woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_plus' );

function bbloomer_display_quantity_plus() {
    echo '<button type="button" class="plus cart_btn">+</button>';
}

add_action( 'woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_minus' );

function bbloomer_display_quantity_minus() {
    echo '<button type="button" class="minus cart_btn">-</button>';
}

// -------------
// 2. Trigger update quantity script

add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );

function bbloomer_add_cart_quantity_plus_minus() {

    if ( ! is_product() && ! is_cart() ) return;

    wc_enqueue_js( "   
           
      $(document).on( 'click', 'button.plus, button.minus', function() {
  
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
         }
 
      });
        
   " );
}
// add_filter( 'wc_add_to_cart_message_html', '__return_false' );

add_filter( 'template_include', 'woocommerce_archive_template', 99 );

function woocommerce_archive_template( $template ) {

    if ( is_woocommerce() && is_archive() ) {
        $new_template = get_stylesheet_directory() . '/woocommerce/archive-product.php';
        if ( !empty( $new_template ) ) {
            return $new_template;
        }
    }

    return $template;
}

add_filter ('yith_wcan_use_wp_the_query_object', '__return_true');

function get_ajax_menu_popular_item_category(){
    $slug = (!empty($_POST['slug']))? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
    $category = get_term_by( 'slug', $slug, 'product_cat' );
    $subcategories = (get_categories([
        'taxonomy' => 'product_cat',
        'parent' => $category->term_id,
        'hide_empty' => false,
        'orderby'    => 'count',
        'order'      => 'DESC',
    ]));
    $data = array();
    foreach ( $subcategories as $subcategory) {
        $data[$subcategory->term_id] = $subcategory->name;
    }
    wp_send_json( $data );
}
add_action('wp_ajax_nopriv_get_ajax_menu_popular_item_category', 'get_ajax_menu_popular_item_category');
add_action('wp_ajax_get_ajax_menu_popular_item_category', 'get_ajax_menu_popular_item_category');

function get_ajax_menu_popular_item_sales_category(){
    $out = '';
    $main_parent_category = get_term_by('slug', 'place-type', 'product_cat');
    $main_parent_category_id = $main_parent_category->term_id;
    $parent_categories =get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => $main_parent_category_id,
    ));
    $subcategory_slugs = array();
    if (!empty($parent_categories) && !is_wp_error($parent_categories)) {
        foreach ($parent_categories as $parent_category) {
            $subcategories =get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => $parent_category->term_id,
            ));
            if (!empty($subcategories) && !is_wp_error($subcategories)) {
                foreach ($subcategories as $subcategory) {
                    $subcategory_slugs[] = $subcategory->slug;
                }
            }
//            array_push($category_slugs, $subcategory->slug);
        }
    }
    $on_sale_product_ids = wc_get_product_ids_on_sale();
    $on_sale_category_slugs = array();

    foreach ($on_sale_product_ids as $product_id) {
        $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'slugs'));

        foreach ($product_categories as $category_slug) {
            if (in_array($category_slug, $subcategory_slugs)) {
                $on_sale_category_slugs[] = $category_slug;
            }
        }
    }
    $counted_values = array_count_values($on_sale_category_slugs);
    arsort($counted_values);
    $unique_values = array_keys($counted_values);
    $arr = array_slice($unique_values, 0, 9, true);
    $out_arr = array();
    for ($i = 0; $i < count($arr); $i++) {
        $category = get_term_by('slug', $arr[$i], 'product_cat');
        // $id = $category->term_id;
        $a_href = get_term_link( $category );
        $name = $category->name;
        $out_arr[$arr[$i]] = array($a_href, $name);
    }
    $out = $out_arr;
    die(json_encode($out));
}
add_action('wp_ajax_nopriv_get_ajax_menu_popular_item_sales_category', 'get_ajax_menu_popular_item_sales_category');
add_action('wp_ajax_get_ajax_menu_popular_item_sales_category', 'get_ajax_menu_popular_item_sales_category');


add_filter( 'woocommerce_default_catalog_orderby', 'change_default_sorting' );
function change_default_sorting( $default_sorting ) {
    $default_sorting = 'popularity';
    return $default_sorting;
}
function sibosfurniture_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'sibosfurniture_add_woocommerce_support' );
// function mytheme_add_woocommerce_support() {
// 	add_theme_support( 'woocommerce', array(
// 		'thumbnail_image_width' => 150,
// 		'single_image_width'    => 300,

//         'product_grid'          => array(
//             'default_rows'    => 3,
//             'min_rows'        => 2,
//             'max_rows'        => 8,
//             'default_columns' => 4,
//             'min_columns'     => 2,
//             'max_columns'     => 5,
//         ),
// 	) );
// }
// add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

function add_additional_class_on_a($classes, $item, $args)
{
    if (isset($args->link_class)) {
        $classes['class'] = $args->link_class;
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);


/**
 * Post Type: Review.
 */
function sibosfurniture_review_post_type() {

	
	$labels = [
		"name" => "Reviews",
		"singular_name" => "Review",
	];

	$args = array(
        'labels'             => $labels,
        'description'        => '',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'reviews' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'thumbnail','custom-fields' ),
        'show_in_rest'       => true
    );

	register_post_type( "review", $args );
}

add_action( 'init', 'sibosfurniture_review_post_type' );

/**
 * Post Type: Materials.
 */
function sibosfurniture_materials_post_type() {

	
	$labels = [
		"name" => "Materials",
		"singular_name" => "Material",
	];

	$args = array(
        'labels'             => $labels,
        'description'        => '',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'materials' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'           => array( 'title','thumbnail' ),
        'show_in_rest'       => true
    );

	register_post_type( "material", $args );
}

add_action( 'init', 'sibosfurniture_materials_post_type' );
/**
 * Post Type: Color.
 */
function sibosfurniture_colors_post_type() {

	
	$labels = [
		"name" => "Colors",
		"singular_name" => "Color",
	];

	$args = array(
        'labels'             => $labels,
        'description'        => '',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'colors' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'           => array( 'title' ),
		'taxonomies' => array( 'color_category' ),
        'show_in_rest'       => true
    );

	register_post_type( "color", $args );
}

add_action( 'init', 'sibosfurniture_colors_post_type' );


function sibosfurniture_colors_category_taxonomy() {
 
	register_taxonomy( 'color_category', array( 'color'),
	   array(
		   'labels' => array(
		   'name'              => 'Color category',
		   'singular_name'     => 'Color category',
		   'menu_name'         => 'Categories',
		   ),
		   'hierarchical' => true,
		   'has_archive' => true,
		   // 'sort' => true,
		   // 'args' => array( 'orderby' => 'term_order' ),
		   'show_ui' => true,
		   'show_admin_column' => true,
		   'show_in_nav_menus'          => true,
		   'show_in_rest'               => true,
		   'show_tagcloud'              => false,
		   'with_front' => false,
	   )
   );
}

add_action( 'init', 'sibosfurniture_colors_category_taxonomy', 0 );



/**
  * custom title length
  */

  function sibosfurniture_custom_title($post=null, $limit = 60) {
	$title = get_the_title($post);
	if( strlen( $title ) > $limit ) {
		return substr( $title, 0, $limit ). " ...";
	} else {
		return $title;
	}
}


/**
  * custom excerpt length
  */
function sibosfurniture_custom_excerpt($post = null, $limit=20){
	$excerpt = explode(' ', get_the_excerpt($post), $limit);
	if (count($excerpt)>=$limit) {
	  array_pop($excerpt);
	  $excerpt = implode(" ",$excerpt).'...';
	} else {
	  $excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}

/**
  * create meta key for order by views
  */
  function plumber_wpp_update_postviews($postid) {
    // Accuracy:
    //   10  = 1 in 10 visits will update view count. (Recommended for high traffic sites.)
    //   30  = 30% of visits. (Medium traffic websites.)
    //   100 = Every visit. Creates many db write operations every request.

    $accuracy = 100;

    if ( function_exists('wpp_get_views') && (mt_rand(0,100) < $accuracy) ) {

		update_post_meta(
            $postid,
            'views_total',
            wpp_get_views($postid, 'all', false)
        );
        // update_post_meta(
        //     $postid,
        //     'views_daily',
        //     wpp_get_views($postid, 'daily', false)
        // );
        // update_post_meta(
        //     $postid,
        //     'views_weekly',
        //     wpp_get_views($postid, 'weekly', false)
        // );
        // update_post_meta(
        //     $postid,
        //     'views_monthly',
        //     wpp_get_views($postid, 'monthly', false)
        // );
    }
}
add_action( 'wpp_post_update_views', 'plumber_wpp_update_postviews' );

/**
  * show more posts with ajax
  */
  function more_post_ajax() {

	$dashboard_menu_item = (! empty( $_POST['dashboard_menu_item'] )) ? sanitize_text_field( wp_unslash( $_POST['dashboard_menu_item'] ) ) : '';
	$out ='';
  
	if($dashboard_menu_item == 'orders'){
	  $current_page    = empty( $current_page ) ? 1 : absint( $current_page );
	  $customer_orders = wc_get_orders(
		apply_filters(
		  'woocommerce_my_account_my_orders_query',
		  array(
		  'customer' => get_current_user_id(),
		  'page'     => $current_page,
		  'paginate' => true,
		  )
		)
	  );
	  wc_get_template(
		  'myaccount/orders.php',
		  array(
			'current_page'    => absint( $current_page ),
			'customer_orders' => $customer_orders,
			'has_orders'      => 0 < $customer_orders->total,
			'wp_button_class' => wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '',
		  )
		);
	}elseif($dashboard_menu_item == 'addresses'){
	  
	  wc_get_template(
			'myaccount/my-address.php',
			array(
			)
		  );
	}elseif($dashboard_menu_item == 'payment-methods'){

	  wc_get_template(
		'myaccount/payment-methods.php',
		array(
		)
		);
	}elseif($dashboard_menu_item == 'account-details'){
	  
	  wc_get_template(
		'myaccount/form-edit-account.php',
		array(
			'user'    =>  wp_get_current_user(),
			)
		);
	}
	elseif($dashboard_menu_item == 'logout'){
	  
	  $out = '
			  <p>Do you want to log out from your account?</p>
			  <div><button class="btn" onclick="location.href = \''.esc_url( wc_logout_url() ).'\';">Yes</button> <button class="btn">No</button></div>
			';
	}
	else{
	  $out='
	  <p>From your account dashboard you can <a data-target="orders">view your recent orders</a>,<br>manage
	  your <a data-target="addresses">shipping and billing addresses</a>,<br>and <a  data-target="account-details">edit your
		  passwords and account details</a>
  		</p>
	  ';

	}

	  die($out);
  }
  
  add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
  add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
  /**
  * show more posts with ajax
  */
  function order_details_ajax() {
	$action = (! empty( $_POST['order_action'] )) ? sanitize_text_field( wp_unslash( $_POST['order_action'] ) ) : '';
	$order_id = (isset($_POST['order_id'])) ? $_POST['order_id'] : 0;
	$out='';
	if($action === 'View'){
		$order = wc_get_order( $order_id );
		wc_get_template(
			'myaccount/view-order.php',
			array(
				'order'    =>  $order,
				'order_id' => $order_id,
				)
			);
	}
	
	else{
		// $out = '<p>'.esc_html( $action ).'</p>';
	}
	
	die($out);
	
  }
  
  add_action('wp_ajax_nopriv_order_details_ajax', 'order_details_ajax');
  add_action('wp_ajax_order_details_ajax', 'order_details_ajax');


add_filter('woocommerce_valid_order_statuses_for_cancel', 'my_cancellable_statuses', 10, 2);
 
function my_cancellable_statuses($statuses, $order){
  return array('pending', 'processing', 'on hold');
}

add_filter( 'woocommerce_my_account_my_orders_query', 'custom_my_account_orders_query', 20, 1 );
function custom_my_account_orders_query( $args ) {
    $args['limit'] = -1;

    return $args;
}

add_filter('woocommerce_paypal_payments_checkout_button_renderer_hook', function() {
    return 'woocommerce_review_order_before_submit';
});

add_action( 'woocommerce_save_account_details', 'redirect_to_my_account' );
add_action( 'woocommerce_customer_save_address', 'redirect_to_my_account' );


function redirect_to_my_account() {
   wp_safe_redirect( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );
   exit();
}

add_action( 'template_redirect', 'redirect_from_payment_methods' );

function redirect_from_payment_methods() {
    if ( is_wc_endpoint_url( 'payment-methods' ) ) {
        $myaccount_page_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
        wp_safe_redirect( $myaccount_page_url );
        exit;
    }
}


add_action('wp_ajax_nopriv_filter_product_ajax', 'filter_product_ajax');
add_action('wp_ajax_filter_product_ajax', 'filter_product_ajax');

function get_var($name = false, $default = false) {
    if($name === false) {
        return $_REQUEST;
    }
    if(isset($_REQUEST[$name])) {
        return $_REQUEST[$name];
    }
    return $default;
}

function get_place_types(){
    // $parent_product_cat = get_term_by( 'slug', 'place-type', 'product_cat' );
    $category = get_term_by( 'slug', 'waiting', 'product_cat' );
    $id_to_exclude = $category->term_id;
    $cat_args = array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'exclude'  => $id_to_exclude,
//                'parent' => 0,
                // 'parent'   => $parent_product_cat->term_id
            );
    $child_product_cats = get_terms( $cat_args );
    // $cat_args = array(
    //             'taxonomy' => 'product_cat',
    //             'hide_empty' => true,
    //             'parent'   => $parent_product_cat->term_id
    //         );
    // $child_product_cats = get_terms( $cat_args );
    $place_types_arr = [[]];
    $n = 0;
    foreach($child_product_cats as $child_product_cat){
        $place_types_arr[$n] = array($child_product_cat->slug, $child_product_cat->term_id);
        $n++;
    }
    return $place_types_arr;
}

// remove_action( 'woocommerce_checkout_before_customer_details', array( WC_Stripe_Payment_Request::instance(), 'display_payment_request_button_html' ), 1 );
// remove_action( 'woocommerce_checkout_before_customer_details', array( WC_Stripe_Payment_Request::instance(), 'display_payment_request_button_separator_html' ), 2 );

// add_action( 'sibos_stripe_payment_request_button', array( WC_Stripe_Payment_Request::instance(), 'display_payment_request_button_html' ), 2 );
// add_action( 'sibos_stripe_payment_request_button', array( WC_Stripe_Payment_Request::instance(), 'display_payment_request_button_separator_html' ), 1 );

add_action('delete_coaster_furniture_cron_hook', 'delete_coaster_furniture_cron_exec');

function delete_coaster_furniture_cron_exec()
{
    $args = array(
        'status' => 'publish',
        'limit' => -1,
    );

    $products = wc_get_products( $args );
    foreach ($products as $product)
    {
        $product->delete();
    }
}
add_action('set_or_update_product_coaster_furniture_cron_hook', 'set_or_update_product_coaster_furniture_cron_exec');

function set_or_update_product_coaster_furniture_cron_exec()
{
    $params = array(
        "keycode" => "45FDCB85CF2F440E9750F1E96A"
    );
    $isDiscontinued = false;


    $filter_api = "http://api.coasteramer.com/api/product/GetFilter?isDiscontinued=false";
    $filter_response = wp_remote_get($filter_api, array(
        'headers' => $params
    ));
// $filter = $filter_response['body'];
    $filterCode = str_replace('"', '', $filter_response['body']);
//var_dump($filterCode);

    $api_string = "http://api.coasteramer.com/api/product/GetProductList?filterCode=" . $filterCode;
//    $api_string_full = "http://api.coasteramer.com/api/product/GetProductList";
//var_dump($api_string);
    $product_response = wp_remote_get($api_string, array(
        'timeout' => 3000,
        'headers' => $params
    ));
    $json = json_decode($product_response['body'], true);

//    for ($k = 1; $k <= 6; $k++) {
    for ($k = 0; $k <= sizeof($json); $k++) {
        $product = $json[$k];
        $SKU = $product['ProductNumber'];
        $existing_product_id = wc_get_product_id_by_sku($SKU);
        if ($existing_product_id != null) {
            //Updating product
            $existing_product = new WC_Product_Simple($existing_product_id);
            set_or_update_product_coaster_furniture($SKU, $product, $existing_product);
            $existing_product->save();
        }
        else {
            //Creating product
            $new_product = new WC_Product_Simple();
            $new_product->set_status('publish');
            //Set if the product is featured. | bool
            $new_product->set_featured(FALSE);
            //Set catalog visibility. | string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
            $new_product->set_catalog_visibility('visible');
            $new_product->set_reviews_allowed(TRUE);
            set_or_update_product_coaster_furniture($SKU, $product, $new_product);
            $img_urls_array = explode(',', $product['PictureFullURLs']);
            $img_ids = [];
            foreach ($img_urls_array as $url){
                array_push($img_ids, rs_upload_from_url($url));
            }
            $main_img_id = $img_ids[0];
            unset($img_ids[0]); // remove item at index 0
            $img_ids = array_values($img_ids); // 'reindex' array
            $new_product->set_image_id($main_img_id);
            $new_product->set_gallery_image_ids($img_ids);
            $new_product->save();
        }
    }
}
function set_product_coaster_furniture($SKU, $product, $new_product)
{
    $name = $product['Name'];
    if (isset($product['Description'])){
        $description = $product['Description'];
    }else{
        $description = $name;
    }

    $new_product->set_name($name);
    //Set product description.
    $new_product->set_description($description);
    //Set SKU
    $new_product->set_sku($SKU);

    $raw_attributes = array();
    if(isset($product['MeasurementList'])){
        $measurementList = $product['MeasurementList'];
        $measurement_array = [];
        if (count($measurementList) == 1) {
            $allKeys = array_keys($measurementList[0]);
            $allValues = array_values($measurementList[0]);
            for ($i = 1; $i < count($measurementList[0]); $i++) {
                if ($allValues[$i] > 0) {
                    $attribute = new WC_Product_Attribute();
                    if (strtolower($allKeys[$i]) == strtolower("Weight")){
                        $attribute->set_name("Product " . strtolower($allKeys[$i]));
                    }else{
                        $attribute->set_name($allKeys[$i]);
                    }
                    $attribute->set_options(array($allValues[$i]));
                    $attribute->set_visible(true);
                    $attribute->set_variation(false);
                    $raw_attributes[] = $attribute;
                }
            }
        } else {
            for ($i = 0; $i < count($measurementList); $i++) {
                $piece_name = $measurementList[$i]['PieceName'];
                $allKeys = array_keys($measurementList[$i]);
                $allValues = array_values($measurementList[$i]);
                for ($j = 1; $j < count($measurementList[$i]); $j++) {
                    if ($allValues[$j] > 0) {
                        $attribute = new WC_Product_Attribute();
                        $attribute->set_name($piece_name . " " . $allKeys[$j]);
                        $attribute->set_options(array($allValues[$j]));
                        $attribute->set_visible(1);
                        $attribute->set_variation(0);
                        $raw_attributes[] = $attribute;
                    }
                }
            }
        }
    }

    if(isset($product['MaterialList'])){
        $product_materials = $product['MaterialList'];
        $materials_array = [];
        foreach ($product_materials as $product_material) {
            array_push($materials_array, $product_material['Value']);
        }
        $materials = implode(', ', $materials_array);
        $attribute = new WC_Product_Attribute();
        $attribute->set_name("Materials");
        $attribute->set_options(array($materials));
        $attribute->set_visible(1);
        $attribute->set_variation(0);
        $raw_attributes[] = $attribute;
    }

    if(isset($product['CountryOfOrigin'])){
        $countryOfOrigin = $product['CountryOfOrigin'];
        $attribute = new WC_Product_Attribute();
        $attribute->set_name("Country of origin");
        $attribute->set_options(array($countryOfOrigin));
        $attribute->set_visible(1);
        $attribute->set_variation(0);
        $raw_attributes[] = $attribute;
    }

    if(isset($product['FabricColor'])){
        $fabricColor = $product['FabricColor'];
        $attribute = new WC_Product_Attribute();
        $attribute->set_name("Fabric color");
        $attribute->set_options(array($fabricColor));
        $attribute->set_visible(1);
        $attribute->set_variation(0);
        $raw_attributes[] = $attribute;
    }

    if(isset($product['FinishColor'])){
        $finishColor = $product['FinishColor'];
        $attribute = new WC_Product_Attribute();
        $attribute->set_name("Finish color");
        $attribute->set_options(array($finishColor));
        $attribute->set_visible(1);
        $attribute->set_variation(0);
        $raw_attributes[] = $attribute;
    }

    if(isset($product['AdditionalFieldList'])){
        $additionalFieldList = $product['AdditionalFieldList'];
        foreach ($additionalFieldList as $additionalField) {
            $attribute = new WC_Product_Attribute();
            $attribute->set_name($additionalField['Field']);
            $attribute->set_options(array($additionalField['Value']));
            $attribute->set_visible(1);
            $attribute->set_variation(0);
            $raw_attributes[] = $attribute;
        }
    }
    $attribute = new WC_Product_Attribute();
    $attribute->set_name("Manufacture");
    $attribute->set_options(array("Coaster"));
    $attribute->set_visible(1);
    $attribute->set_variation(0);
    $raw_attributes[] = $attribute;
    if (sizeof($raw_attributes) > 0){
        $new_product->set_attributes($raw_attributes);
    }
}
function flip_array($arr) {
    $flipped = array();
    foreach($arr as $key => $value) {
        $flipped[$value] = $key;
    }
    return $flipped;
}
add_action('remove_discontinued_product_coaster_furniture_cron_hook', 'remove_discontinued_product_coaster_furniture_cron_exec');

function remove_discontinued_product_coaster_furniture_cron_exec()
{
    $params = array(
        "keycode" => "45FDCB85CF2F440E9750F1E96A"
    );


    $filter_api = "http://api.coasteramer.com/api/product/GetFilter?isDiscontinued=true";
    $filter_response = wp_remote_get($filter_api, array(
        'headers' => $params
    ));
// $filter = $filter_response['body'];
    $filterCode = str_replace('"', '', $filter_response['body']);
//var_dump($filterCode);

    $api_string = "http://api.coasteramer.com/api/product/GetProductList?filterCode=" . $filterCode;
//    $api_string_full = "http://api.coasteramer.com/api/product/GetProductList";
//var_dump($api_string);
    $product_response = wp_remote_get($api_string, array(
        'timeout' => 1000,
        'headers' => $params
    ));
    $json = json_decode($product_response['body'], true);
    foreach ($json as $product)
    {
        $SKU = $product['ProductNumber'];
        $existing_product_id = wc_get_product_id_by_sku($SKU);
        if ($existing_product_id != null) {
            $existing_product = wc_get_product($existing_product_id);
            $existing_product->delete();
        }
    }
}
function rs_upload_from_url($url, $SKU, $title = null)
{
    require_once(ABSPATH . "/wp-load.php");
    require_once(ABSPATH . "/wp-admin/includes/image.php");
    require_once(ABSPATH . "/wp-admin/includes/file.php");
    require_once(ABSPATH . "/wp-admin/includes/media.php");

    // Download url to a temp file
    $tmp = download_url($url, 300);
    if (is_wp_error($tmp)){
        var_dump($tmp);
        var_dump($SKU);
        var_dump("Download url to a temp file error");
        return false;
    }

    // Get the filename and extension ("photo.png" => "photo", "png")
    $filename = pathinfo($url, PATHINFO_FILENAME);
    $extension = pathinfo($url, PATHINFO_EXTENSION);

    // An extension is required or else WordPress will reject the upload
    if (!$extension) {
        // Look up mime type, example: "/photo.png" -> "image/png"
        $mime = mime_content_type($tmp);
        $mime = is_string($mime) ? sanitize_mime_type($mime) : false;

        // Only allow certain mime types because mime types do not always end in a valid extension (see the .doc example below)
        $mime_extensions = array(
            // mime_type         => extension (no period)
            'text/plain' => 'txt',
            'text/csv' => 'csv',
            'application/msword' => 'doc',
            'image/jpg' => 'jpg',
            'image/jpeg' => 'jpeg',
            'image/gif' => 'gif',
            'image/png' => 'png',
            'video/mp4' => 'mp4',
        );

        if (isset($mime_extensions[$mime])) {
            // Use the mapped extension
            $extension = $mime_extensions[$mime];
        } else {
            // Could not identify extension
            @unlink($tmp);
            var_dump($SKU);
            var_dump("Could not identify extension error");
            return false;
        }
    }


    // Upload by "sideloading": "the same way as an uploaded file is handled by media_handle_upload"
    $args = array(
        'name' => "$filename.$extension",
        'tmp_name' => $tmp,
    );

    // Do the upload
    $attachment_id = media_handle_sideload($args, 0, $title);

    // Cleanup temp file
    @unlink($tmp);

    // Error uploading
    if (is_wp_error($attachment_id)){
        var_dump($SKU);
        var_dump("Error uploading");
        var_dump($attachment_id);
        return false;
    }

    // Success, return attachment ID (int)
    return (int)$attachment_id;
}


	
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

function woocommerce_category_redirect() {
    if (is_product_category()) {
        wp_redirect(get_permalink(wc_get_page_id('shop')));
        exit();
    }
}
add_filter( 'big_image_size_threshold', '__return_false' );

//   function first_order_dicount() {

//     $email = (! empty( $_POST['email'] )) ? sanitize_text_field( wp_unslash( $_POST['email'] ) ) : '';
//     $out="";
//     if($email != ''){


//         $billing_email = $email;
//         $args = array(
//             'posts_per_page' => 1,
//             'post_type'      => 'shop_order',
//             'post_status'    => array( 'wc-completed', 'wc-processing', 'wc-on-hold' ),
//             'meta_query'     => array(
//                 array(
//                     'key'     => '_billing_email',
//                     'value'   => $billing_email,
//                     'compare' => '=',
//                 ),
//             ),
//         );

//         $order_query  = new WP_Query( $args );
//         $order_count  = $order_query->found_posts;
//         $discount_key = 'first_order_discount';
//         $fee_label    = 'First Order Discount';
//         $discount     = 0.15;
//         if ( $order_count == 0 ) {
//             $cart = WC()->cart;

    
//             $coupon = new WC_Coupon( 'FIRSTORDER' );

//             // Check if the coupon is valid
//             if ( $coupon->is_valid() ) {
//                 // Apply the coupon
//                 $cart->apply_coupon( 'FIRSTORDER');
//                 //echo 'Coupon applied successfully';
//             }

//         }
//     }
//     wp_die();
//     // die($out);
// }

// add_action('wp_ajax_nopriv_first_order_dicount', 'first_order_dicount');
// add_action('wp_ajax_first_order_dicount', 'first_order_dicount');
function update_custom_fees_callback() {
    if (!check_ajax_referer('custom_fees_nonce', 'nonce', false)) {
        wp_send_json_error('Invalid nonce');
    }

    WC()->session->set('apply_custom_fee', true);
    WC()->session->set('email_for_fee', isset($_POST['email_for_fee']) ? sanitize_email($_POST['email_for_fee']) : '');
    wp_send_json_success('Custom fee update successful');
}
add_action('wp_ajax_update_custom_fees', 'update_custom_fees_callback');
add_action('wp_ajax_nopriv_update_custom_fees', 'update_custom_fees_callback');



function add_custom_fee($cart) {
    if (is_checkout() && WC()->session->get('apply_custom_fee')) {
        $billing_email = WC()->session->get('email_for_fee');
        // $user_id = get_current_user_id();
        // if ( $user_id ) {
        //     $billing_email = get_user_meta( $user_id, 'billing_email', true );
        // } else{
        //     // $billing_email = isset($_POST['billing_email']) ? sanitize_email(trim($_POST['billing_email'])) : '';

        //     $billing_email = WC()->customer->get_billing_email();
        // }
        if ( ! empty($billing_email) ) {
            // error_log('$billing_email: ' . $billing_email);
            $discount_key = 'first_order_discount';
            $fee_label    = 'First Order Discount';
            $discount     = 0.15;
            $orders = wc_get_orders(array(
                'limit' => 1,
                'status' => array('completed', 'processing', 'on-hold'),
                'meta_key' => '_billing_email',
                'meta_value' => $billing_email,
                'return' => 'ids',
            ));
            if ( empty($orders) ) {
                    WC()->cart->add_fee( $fee_label,  -$cart->subtotal * 0.15, false);
            }else{
                // WC()->cart->remove_all_fees();
    
                // Get the fees in the cart
                $fees = WC()->cart->get_fees();
    
                // Loop through the fees
                foreach ($fees as $fee_key => $fee) {
                    // Check if the fee name matches
                    if ($fee->name === $fee_label) {
                        // Remove the fee
                        WC()->cart->remove_fee($fee_key);
                        break; // Stop looping once the fee is found and removed
                    }
                }
                // WC()->cart->add_fee( $billing_email,  -$cart->subtotal * 0.0, false);
            }
        }else{
            // WC()->cart->add_fee( 'No email',  -$cart->subtotal * 0.0, false);
        }
    }


}
add_action( 'woocommerce_cart_calculate_fees', 'add_custom_fee', 10 );

// function has_orders_for_email($email) {
//     $orders = get_posts(array(
//         'post_type'      => 'shop_order',
//         'post_status'    => array('wc-completed', 'wc-processing', 'wc-on-hold'), // Include desired order statuses
//         'posts_per_page' => 1,
//         'meta_query'     => array(
//             array(
//                 'key'     => '_billing_email',
//                 'value'   => sanitize_email($email),
//                 'compare' => '='
//             )
//         )
//     ));

//     return empty($orders);
// }
function has_orders_for_email($email) {
    $orders = wc_get_orders(array(
        'limit' => 1,
        'status' => array('completed', 'processing', 'on-hold'),
        'meta_key' => '_billing_email',
        'meta_value' => $email,
        'return' => 'ids',
    ));

    return empty($orders);
}
// add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_fee',20,3);
// function woo_add_cart_fee( $cart ){
//     //global $woocommerce;

//     if ( ! $_POST || ( is_admin() && ! is_ajax() ) ) {
//         return;
//     }
//     // Get the current user's billing email
//     $user_id = get_current_user_id();
//     $billing_email = '';
//     if ( $user_id ) {
//         $billing_email = get_user_meta( $user_id, 'billing_email', true );
//     } elseif ( WC()->customer->get_billing_email() ) {
//         $billing_email = isset($_POST['billing_email']) ? sanitize_email($_POST['billing_email']) : '';
//     }
//     $args = array(
//         'posts_per_page' => 1,
//         'post_type'      => 'shop_order',
//         'post_status'    => array( 'wc-completed', 'wc-processing', 'wc-on-hold' ),
//         'meta_query'     => array(
//             array(
//                 'key'     => '_billing_email',
//                 'value'   => $billing_email,
//                 'compare' => '=',
//             ),
//         ),
//     );

//     $order_query  = new WP_Query( $args );
//     $order_count  = $order_query->found_posts;
//     $discount_key = 'first_order_discount';
//     $fee_label    = 'Discount';
//     $discount     = 0.15;

//     if ( $order_count === 0 ) {
//         // Remove the discount if it exists
//         // if ( $cart->get_applied_coupons() ) {
//         //     $cart->remove_coupon( $discount_key );
//         // }
//         WC()->cart->add_fee( $fee_label,  -$cart->subtotal * $discount, false);
//     } else {
//         // Remove the fee if it exists
//         $fees = WC()->cart->get_fees();
//         if ( isset( $fees[ $fee_label ] ) ) {
//             WC()->cart->remove_fee( $fees[ $fee_label ]->get_id() );
//         }

//         // Apply the discount if it doesn't exist
//         // if ( ! $cart->get_applied_coupons() ) {
//         //     $cart->apply_coupon( $discount_key );
//         // }
//     }
// }


// add_action( 'woocommerce_applied_coupon', 'my_function_on_coupon_applied', 10, 1 );

// function my_function_on_coupon_applied( $coupon_code ) {
//     if ( $coupon_code === 'firstorder' ) {
//         $user_id = get_current_user_id();
//         $billing_email = '';
//         if ( $user_id ) {
//             $billing_email = get_user_meta( $user_id, 'billing_email', true );
//         } elseif ( WC()->customer->get_billing_email() ) {
//             $billing_email = isset($_POST['billing_email']) ? sanitize_email($_POST['billing_email']) : '';
//         }
//         if($billing_email != ''){
//             $args = array(
//             'posts_per_page' => 1,
//             'post_type'      => 'shop_order',
//             'post_status'    => array( 'wc-completed', 'wc-processing', 'wc-on-hold' ),
//             'meta_query'     => array(
//                 array(
//                     'key'     => '_billing_email',
//                     'value'   => $billing_email,
//                     'compare' => '=',
//                 ),
//             ),
//             );

//             $order_query  = new WP_Query( $args );
//             $order_count  = $order_query->found_posts;
//             $discount_key = 'first_order_discount';
//             $fee_label    = 'Discount';
//             $discount     = 0.15;

//             if ( $order_count > 0 ) {
//                 // Throw an error
//                 // wc_add_notice( 'Sorry, the "firstorder" coupon is only valid for first-time customers.', 'error' );
//                 WC()->cart->remove_coupon( $coupon_code );

//             }
//         }else{
//             WC()->cart->remove_coupon( $coupon_code ); 
//         }
    
//     }
// }

function wc_display_item_meta( $item, $args = array() ) {
    $strings = array();
    $html    = '';
    $args    = wp_parse_args(
        $args,
        array(
            'before'       => '<ul class="wc-item-meta"><li>',
            'after'        => '</li></ul>',
            'separator'    => '</li><li>',
            'echo'         => false,
            'autop'        => false,
            'label_before' => '<strong class="wc-item-meta-label">',
            'label_after'  => ':</strong> ',
        )
    );

    foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
        $value     = $args['autop'] ? wp_kses_post( $meta->display_value ) : wp_kses_post( make_clickable( trim( $meta->display_value ) ) );
        $strings[] = $args['label_before'] . wp_kses_post( $meta->display_key ) . $args['label_after'] . $value;
    }

    if ( $strings ) {
        $html = $args['before'] . implode( $args['separator'], $strings ) . $args['after'];
    }

    $html = apply_filters( 'woocommerce_display_item_meta', $html, $item, $args );

    if ( $args['echo'] ) {
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $html;
    } else {
        return $html;
    }
}


add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments){
    ob_start();
    $items_count = WC()->cart->get_cart_contents_count();
    ?>
    <span  class="mini-cart-count"> <?php echo $items_count ? '('.$items_count.')' : '&nbsp;'; ?></span>
    <?php
        $fragments['.mini-cart-count'] = ob_get_clean();
    return $fragments;
}

function mytheme_enqueue_styles()
{
// Check if ‘wc-cart-fragments’ script is already enqueued or registered
if ( ! wp_script_is( 'wc-cart-fragments', 'enqueued' ) && wp_script_is( 'wc-cart-fragments', 'registered' ) ) {
// Enqueue the ‘wc-cart-fragments’ script
wp_enqueue_script( 'wc-cart-fragments' );
}
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');


function get_min_price(){
    $query = array(
        'posts_per_page' => 1,
        'post_type'=> 'product',
        'orderby' => 'meta_value_num',
        'meta_key' =>'_price',
        'order' => 'ASC',
        
    );
    $products= new WP_Query($query);
    while ( $products->have_posts() ) : $products->the_post();
        global $product;
        $price = $product->get_price();
    endwhile;
    return $price;
}
function get_max_price(){
    $query = array(
        'posts_per_page' => 1,
        'post_type'=> 'product',
        'orderby' => 'meta_value_num',
        'meta_key' =>'_price',
        'order' => 'desc',
        
    );
    $products= new WP_Query($query);
    while ( $products->have_posts() ) : $products->the_post();
        global $product;
        $price = $product->get_price();
    endwhile;
    return $price;
}


function where_to_show_new_collection_pop_up(){
    $modern_product_cat_parent = get_term_by( 'slug', 'modern', 'product_cat' );
    $args = array(
        'taxonomy' => 'product_cat',
        'number' => 1,
        'hide_empty' => true,
        'parent' => 0,
        'parent'   => $modern_product_cat_parent->term_id,
        'fields' => 'ids',
        'orderby' => 'id',
        'order' => 'DESC',
        'meta_query' => array(
          array(
             'key'       => 'is_new',
             'value'     => '1',
             'compare'   => '='
          )
     ));
    $modern_new_collections = get_terms( $args );
    
    $transitional_product_cat_parent = get_term_by( 'slug', 'transitional', 'product_cat' );
    $args = array(
        'taxonomy' => 'product_cat',
        'number' => 1,
        'hide_empty' => true,
        'parent' => 0,
        'parent'   => $transitional_product_cat_parent->term_id,
        'fields' => 'ids',
        'orderby' => 'id',
        'order' => 'DESC',
        'meta_query' => array(
          array(
             'key'       => 'is_new',
             'value'     => '1',
             'compare'   => '='
          )
     ));
    $transitional_new_collections = get_terms( $args );
    
    if(!empty($modern_new_collections) && !empty($transitional_new_collections)){
        if( $modern_new_collections[0] > $transitional_new_collections[0]){
            return 'modern';
        }else{
            return 'transitional';
        }
    }else{
        if(!empty($modern_new_collections) && empty($transitional_new_collections)){
            return 'modern';
        }elseif(empty($modern_new_collections) && !empty($transitional_new_collections)){
            return 'transitional';
        }else{
            return 'none';
        }
    }
    
}