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
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), rand(111,9999), true );
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', array(), _S_VERSION, true );
	//wp_enqueue_script( 'TweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery-throttle-debounce', 'https://cdn.jsdelivr.net/gh/cowboy/jquery-throttle-debounce@v1.1/jquery.ba-throttle-debounce.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'fontawesome', 'https://kit.fontawesome.com/13247fe767.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'swiper-bundle', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array(), _S_VERSION, true );
    wp_localize_script( 'script', 'ajax_menu_popular_items', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'noposts' => __('No older posts found', 'greenglobe'),
    ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if(is_front_page() || is_home()){
        wp_enqueue_style( 'index', get_template_directory_uri(). '/css/index.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-index', get_template_directory_uri() . '/js/script-index.js', array(), rand(111,9999), true );
		wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
		wp_enqueue_script( 'swiper-full_height', get_template_directory_uri() . '/js/swiper-full_height.js', array('swiper-bundle'), rand(111,9999), true );
//

    }elseif (is_page_template( 'page-templates/page-template-about-us.php' )){
        wp_enqueue_style( 'about-us', get_template_directory_uri(). '/css/about-us.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
		wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array('swiper-bundle'), rand(111,9999), true );
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array(), rand(111,9999), true );
    }elseif (is_page_template( 'page-templates/page-template-blog.php' ) || is_search() || is_category()){
        wp_enqueue_style( 'blog', get_template_directory_uri(). '/css/shop-page.css', array(), rand(111,9999));

	}elseif (is_page_template( 'page-templates/page-template-colors-and-materials.php' )){
        wp_enqueue_style( 'colors-and-materials', get_template_directory_uri(). '/css/colors-and-materials.css', array(), rand(111,9999));
        wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'script-colors-and-materials', get_template_directory_uri() . '/js/script-colors-and-materials.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array(), rand(111,9999), true );
    }elseif (is_page_template( 'page-templates/page-template-portfolio.php' )){
        wp_enqueue_style( 'portfolio', get_template_directory_uri(). '/css/portfolio.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array(), rand(111,9999), true );
	}elseif(is_single() && 'post' == get_post_type()){
        wp_enqueue_style( 'news-page', get_template_directory_uri(). '/css/news-page.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-shop-page', get_template_directory_uri() . '/js/script-shop-page.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );

	}elseif(is_account_page()){
		if(is_user_logged_in() && !is_wc_endpoint_url()){
			wp_enqueue_style( 'dashboards', get_template_directory_uri(). '/css/dashboard.css', array(), rand(111,9999));
			wp_enqueue_script( 'script-dashboard', get_template_directory_uri() . '/js/script-dashboard.js', array(), rand(111,9999), true );
			wp_enqueue_script( 'password-visibility', get_template_directory_uri() . '/js/script-password-visibility.js', array(), rand(111,9999), true );
			wp_localize_script( 'script-dashboard', 'ajax_posts', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'noposts' => __('No older posts found', 'greenglobe'),
			));
		}else{
           // wp_enqueue_style( 'checkout-order', get_template_directory_uri(). '/css/checkout-order.css', array(), rand(111,9999));
			wp_enqueue_style( 'sign-in', get_template_directory_uri(). '/css/sign-in.css', array(), rand(111,9999));
			wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
			wp_enqueue_script( 'script-stepper-input', get_template_directory_uri() . '/js/script-stepper-input.js', array(), rand(111,9999), true );
			wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );
			wp_enqueue_script( 'password-visibility', get_template_directory_uri() . '/js/script-password-visibility.js', array(), rand(111,9999), true );
            wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
            wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array(), rand(111,9999), true );

        }
       
	}elseif(is_checkout()){
		wp_enqueue_style( 'dashboards', get_template_directory_uri(). '/css/dashboard.css', array(), rand(111,9999));
		// wp_enqueue_style( 'sign-in', get_template_directory_uri(). '/css/sign-in.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-dashboard', get_template_directory_uri() . '/js/script-dashboard.js', array(), rand(111,9999), true );

		wp_enqueue_style( 'checkout-order', get_template_directory_uri(). '/css/checkout-order.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-stepper-input', get_template_directory_uri() . '/js/script-stepper-input.js', array(), rand(111,9999), true );
		wp_enqueue_script( 'script-checkout', get_template_directory_uri() . '/js/script-checkout.js', array(), rand(111,9999), true );
	}elseif(is_product()){
        wp_enqueue_style( 'item-page-in', get_template_directory_uri(). '/css/item-page.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_single_product', get_template_directory_uri(). '/css/woocommerce_single_product.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
		wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'script-item-page', get_template_directory_uri() . '/js/script-item-page.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'script-stepper-input', get_template_directory_uri() . '/js/script-stepper-input.js', array(), rand(111,9999), true );
//        wp_enqueue_script( 'swiper-item-gallery', get_template_directory_uri() . '/js/swiper-item-gallery.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'woocommerce-single-product', get_template_directory_uri() . '/js/woocommerce_single_product.js', array(), rand(111,9999), true );

	} elseif(is_cart()){
        wp_enqueue_style( 'my-cart', get_template_directory_uri(). '/css/my-cart.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_my-cart', get_template_directory_uri(). '/css/woocommerce_my-cart.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce_cart', get_template_directory_uri() . '/js/woocommerce_cart.js', array(), rand(111,9999), true );

        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));

        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );
    }elseif( is_archive()){
        wp_enqueue_style( 'shop-page', get_template_directory_uri(). '/css/shop-page.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_product', get_template_directory_uri(). '/css/woocommerce_product.css', array(), rand(111,9999));
        wp_enqueue_style( 'woocommerce_catalog', get_template_directory_uri(). '/css/woocommerce_catalog_page.css', array(), rand(111,9999));
        wp_enqueue_script( 'woocommerce-product', get_template_directory_uri() . '/js/woocommerce_product.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'script-shop-page', get_template_directory_uri() . '/js/script-shop-page.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'product-filter', get_template_directory_uri() . '/js/product-filter.js', array(), rand(111,9999), true );
        wp_localize_script( 'product-filter', 'ajax_filter_products', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'noposts' => __('No older posts found', 'greenglobe'),
        ));
    }
    else{

	}
}
//add_filter( 'avatar_defaults', 'new_gravatar' );
//function new_gravatar ($avatar_defaults) {
/*    $myavatar = '<?php echo get_template_directory_uri(); ?>/assets/images/Default_avatar.jpg';*/
//    $avatar_defaults[$myavatar] = "Default Gravatar";
//    return $avatar_defaults;
//}

/* AVATAR */
// Add a default avatar to Settings > Discussion
add_filter( 'avatar_defaults', 'add_custom_gravatar' );
if ( !function_exists('add_custom_gravatar') ) {
    function add_custom_gravatar( $avatar_defaults ) {
        $myavatar = get_stylesheet_directory_uri() . '/assets/images/Default_avatar.jpg';
        $avatar_defaults[$myavatar] = 'Avatar Santé Ensemble';

        return $avatar_defaults;
    }
}

//Hack the default beahvior of gravatar to enable custom avatars on localhost
add_filter( 'get_avatar', 'so_14088040_localhost_avatar', 10, 5 );
function so_14088040_localhost_avatar( $avatar, $id_or_email, $size, $default, $alt )
{
    $whitelist = array( 'localhost', '127.0.0.1' );

    if( !in_array( $_SERVER['SERVER_ADDR'] , $whitelist ) )
        return $avatar;

    $doc = new DOMDocument;
    $doc->loadHTML( $avatar );
    $imgs = $doc->getElementsByTagName('img');
    if ( $imgs->length > 0 )
    {
        $url = urldecode( $imgs->item(0)->getAttribute('src') );
        $url2 = explode( 'd=', $url );
        $url3 = explode( '&', $url2[1] );
        $avatar= "<img src='{$url3[0]}' alt='' class='avatar avatar-64 photo' height='42' width='42' />";
    }
    return $avatar;
}
/* AVATAR */

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
add_filter( 'wc_add_to_cart_message_html', '__return_false' );

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
    $main_category_slug = (!empty($_POST['slug']))? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
    $out = '';
    $category = get_term_by('slug', 'item-type', 'product_cat');
    $category_id = $category->term_id; // Replace with the ID of your desired category
    $subcategories = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => $category_id,
    ));
    $category_slugs = array();
    if (!empty($subcategories) && !is_wp_error($subcategories)) {
        foreach ($subcategories as $subcategory) {
            array_push($category_slugs, $subcategory->slug);
        }
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 15,
        'product_cat' => $main_category_slug,
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
    );

    $products_query = new WP_Query($args);

    if ($products_query->have_posts()) {
        $categories = array();
        while ($products_query->have_posts()) {
            $products_query->the_post();
            global $product;
            $product_categories = wp_get_post_terms($product->get_id(), 'product_cat');
            foreach ($product_categories as $product_category) {
                if (in_array($product_category->slug, $category_slugs)) {
                    array_push($categories, $product_category->slug);
                }
            }
        }
        wp_reset_postdata();
        $counted_values = array_count_values($categories);
        arsort($counted_values);
        $unique_values = array_keys($counted_values);
        if (count($unique_values) >= 2) {
            $arr = array_slice($unique_values, 0, 2, true);
            $out_arr = array();
            for ($i = 0; $i < count($arr); $i++) {
                $category = get_term_by('slug', $arr[$i], 'product_cat');
                $a_href = get_term_link( $category );
                $name = $category->name;
                $out_arr[$arr[$i]] = array($a_href, $name);
            }
        } elseif (count($unique_values) == 1) {
            $unique_values_2 = get_more_categories($main_category_slug,$category_slugs);
//            print_r(array_slice($unique_values_2, 0, 2, true));
            $out_arr = array();
            if(count($unique_values_2) == 1){
                $category = get_term_by('slug', $unique_values_2[0], 'product_cat');
                $a_href = get_term_link( $category );
                $name = $category->name;
                $out_arr[$unique_values_2[0]] = array($a_href, $name);
            }elseif(count($unique_values_2) > 1){
                $arr = array_slice($unique_values_2, 0, 2, true);
                for ($i = 0; $i < count($arr); $i++) {
                    $category = get_term_by('slug', $arr[$i], 'product_cat');
                    $a_href = get_term_link( $category );
                    $name = $category->name;
                    $out_arr[$arr[$i]] = array($a_href, $name);
                }
            }else{
                $out_arr = [];
            }

        } else {
            $out_arr = [];
        }
        $out = $out_arr;
//        print_r($unique_values);
    }
    die(json_encode($out));
}
add_action('wp_ajax_nopriv_get_ajax_menu_popular_item_category', 'get_ajax_menu_popular_item_category');
add_action('wp_ajax_get_ajax_menu_popular_item_category', 'get_ajax_menu_popular_item_category');

function get_ajax_menu_popular_item_sales_category(){
    $out = '';
    $category = get_term_by('slug', 'item-type', 'product_cat');
    $category_id = $category->term_id; // Replace with the ID of your desired category
    $subcategories = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => $category_id,
    ));
    $category_slugs = array();
    if (!empty($subcategories) && !is_wp_error($subcategories)) {
        foreach ($subcategories as $subcategory) {
            array_push($category_slugs, $subcategory->slug);
        }
    }

    $on_sale_product_ids = wc_get_product_ids_on_sale();
    $on_sale_category_slugs = array();

    foreach ($on_sale_product_ids as $product_id) {
        $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'slugs'));

        foreach ($product_categories as $category_slug) {
            if (in_array($category_slug, $category_slugs)) {
                $on_sale_category_slugs[] = $category_slug;
            }
        }
    }
    $counted_values = array_count_values($on_sale_category_slugs);
    arsort($counted_values);
    $unique_values = array_keys($counted_values);
    $arr = array_slice($unique_values, 0, 2, true);
    $out_arr = array();
    for ($i = 0; $i < count($arr); $i++) {
        $category = get_term_by('slug', $arr[$i], 'product_cat');
        $a_href = get_term_link( $category );
        $name = $category->name;
        $out_arr[$arr[$i]] = array($a_href, $name);
    }
    $out = $out_arr;
    die(json_encode($out));
}
add_action('wp_ajax_nopriv_get_ajax_menu_popular_item_sales_category', 'get_ajax_menu_popular_item_sales_category');
add_action('wp_ajax_get_ajax_menu_popular_item_sales_category', 'get_ajax_menu_popular_item_sales_category');

function get_more_categories($main_category_slug, $category_slugs){
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'product_cat' => $main_category_slug,
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
    );
    $products_query = new WP_Query($args);
    if ($products_query->have_posts()) {
        $categories = array();
        while ($products_query->have_posts()) {
            $products_query->the_post();
            global $product;
            $product_categories = wp_get_post_terms($product->get_id(), 'product_cat');
            foreach ($product_categories as $product_category) {
                if (in_array($product_category->slug, $category_slugs)) {
                    array_push($categories, $product_category->slug);
                }
            }
        }
        wp_reset_postdata();
        $counted_values = array_count_values($categories);
        arsort($counted_values);
        $unique_values = array_keys($counted_values);
        return $unique_values;
    }
}
add_filter( 'woocommerce_default_catalog_orderby', 'change_default_sorting' );
function change_default_sorting( $default_sorting ) {
    $default_sorting = 'popularity';
    return $default_sorting;
}




add_action( 'wp_enqueue_scripts', 'sibosfurniture_scripts' );

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
// add_action( 'woocommerce_add_payment_method_success', 'redirect_to_my_account' );
// add_action( 'woocommerce_saved_payment_methods_for_user', 'redirect_to_my_account' );
// add_action( 'woocommerce_payment_method_deleted', 'redirect_to_my_account' );

function redirect_to_my_account() {
   wp_safe_redirect( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );
   exit();
}
// add_filter( 'woocommerce_payment_gateways_settings', 'redirect_after_payment_method_saved' );

// function redirect_after_payment_method_saved( $settings ) {
//     if ( ! is_admin() ) {
//         return $settings;
//     }
 
//     $current_screen = get_current_screen();
 
//     if ( empty( $current_screen ) || $current_screen->id !== 'woocommerce_page_wc-settings' || empty( $_GET['section'] ) || $_GET['section'] !== 'checkout' ) {
//         return $settings;
//     }
 
//     foreach ( WC()->payment_gateways()->payment_gateways() as $gateway ) {
//         if ( isset( $_POST['woocommerce_' . $gateway->id . '_settings'] ) ) {
//             $myaccount_page_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
//             $redirect_url = remove_query_arg( 'payment-methods', $myaccount_page_url );
//             wp_safe_redirect( $redirect_url );
//             exit;
//         }
//     }
 
//     return $settings;
// }

add_action( 'template_redirect', 'redirect_from_payment_methods' );

function redirect_from_payment_methods() {
    if ( is_wc_endpoint_url( 'payment-methods' ) ) {
        $myaccount_page_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
        wp_safe_redirect( $myaccount_page_url );
        exit;
    }
}


function filter_product_ajax() {

	$selected = json_decode(stripslashes($_POST['selected']));
    // $size= sizeof($selected);
	$out ='';
  

	die($out);
  }
  
  add_action('wp_ajax_nopriv_filter_product_ajax', 'filter_product_ajax');
  add_action('wp_ajax_filter_product_ajax', 'filter_product_ajax');

