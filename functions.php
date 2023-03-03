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
        wp_enqueue_style( 'about', get_template_directory_uri(). '/css/about.css', array(), rand(111,9999));
		wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), rand(111,9999), true );
		wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
		


    }elseif (is_page_template( 'page-templates/page-template-blog.php' ) || is_search() || is_category() || is_archive()){
        wp_enqueue_style( 'blog', get_template_directory_uri(). '/css/shop-page.css', array(), rand(111,9999));

	}elseif (is_page_template( 'page-templates/page-template-colors-and-materials.php' )){
        wp_enqueue_style( 'colors-and-materials', get_template_directory_uri(). '/css/colors-and-materials.css', array(), rand(111,9999));
        wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'script-colors-and-materials', get_template_directory_uri() . '/js/script-colors-and-materials.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );

    }elseif (is_page_template( 'page-templates/page-template-portfolio.php' )){
        wp_enqueue_style( 'portfolio', get_template_directory_uri(). '/css/portfolio.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );

	}elseif(is_single() && 'post' == get_post_type()){
        wp_enqueue_style( 'news-page', get_template_directory_uri(). '/css/news-page.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-shop-page', get_template_directory_uri() . '/js/script-shop-page.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );

	}elseif(is_account_page() || is_page_template( 'page-templates/page-template-registration.php' )){
        wp_enqueue_style( 'sign-in', get_template_directory_uri(). '/css/sign-in.css', array(), rand(111,9999));
		wp_enqueue_script( 'script-changing-color-item', get_template_directory_uri() . '/js/script-changing-color-item.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'script-stepper-input', get_template_directory_uri() . '/js/script-stepper-input.js', array(), rand(111,9999), true );
        wp_enqueue_script( 'swiper-per_view', get_template_directory_uri() . '/js/swiper-per_view.js', array(), rand(111,9999), true );

	}
	else{

	}
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



add_filter( 'woocommerce_new_customer_data', function( $data ) {
	$data['user_login'] = $data['user_email'];

	return $data;
} );

/* Separate login form and registration form */
// add_action('woocommerce_login_form', 'load_registration_form', 2);
// function load_registration_form() {
//   if (isset($_GET['action']) == 'register') {
// 	woocommerce_get_template('myaccount/form-registration.php');
//   }
// }

add_action( 'init', 'custom_new_wc_endpoint' );
function custom_new_wc_endpoint() {
    add_rewrite_endpoint( 'registration', EP_ROOT | EP_PAGES );
}

add_filter( 'query_vars', 'custom_query_vars', 0 );
function custom_query_vars( $vars ) {
    $vars[] = 'registration';
    return $vars;
}

add_action( 'after_switch_theme', 'custom_flush_rewrite_rules' );    
function custom_flush_rewrite_rules() {
    flush_rewrite_rules();
}

// The custom template location
add_action( 'woocommerce_account_registration_endpoint', 'custom_endpoint_content' );
function custom_endpoint_content() {
    include 'woocommerce/myaccount/form-registration.php'; 
}
// add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );
// function custom_my_account_menu_items( $items ) {
//     // Remove the orders menu item.
//     $orders_item = $items['orders']; // first we keep it in a variable
//     unset( $items['orders'] ); // we unset it then

//     // Insert your custom endpoint.
//     $items['registration'] = __( 'Registration', 'woocommerce' );

//     // Insert back the logout item.
//     $items['orders'] = $orders_item; // we set it back

//     return $items;
// }