<?php
/**
 * The header for our theme
 *
 * @package Sibosfurniture
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"> -->
	<?php wp_head(); ?>
</head>
<style>
    /* .hero {
        background: url(<?php echo get_template_directory_uri(); ?>/assets/images/image-7.jpg) no-repeat center/cover;
    } */
    /* .hidden-work span {
        background: rgba(0,73,175,.3) url(<?php echo get_template_directory_uri(); ?>/assets/images/couple-choosing-fabric-in-furniture-store-1.jpg) no-repeat center/cover;
    } */
    .hero__right span:nth-child(5) {
        background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-328.jpg)
    }
    .hero__right span:nth-child(11) {
        background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-334.jpg)
    }
    @media screen and (min-width: 35.5em) {
        /* .hero {
            background: url(<?php echo get_template_directory_uri(); ?>/assets/images/image-6.jpg) no-repeat center/cover
        } */
        /* .numbers>div:nth-child(1) {
            background: rgba(0,73,175,.3) url(<?php echo get_template_directory_uri(); ?>/assets/images/couple-choosing-fabric-in-furniture-store-1.jpg) no-repeat center/cover;
        } */
        .hero__left {
            background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/image-5.jpg);
        }
    }
</style>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php

$theme_locations = get_nav_menu_locations();

$menu_obj = get_term( $theme_locations[ 'menu-primary'], 'nav_menu' );

$menu_id = $menu_obj->term_id;

$phone = get_field('menu_phone','menu_' . $menu_id);
$email = get_field('menu_email','menu_' . $menu_id);

?>
<div id="preloader"><svg><circle id="preloader_animation" cx="50%" cy="50%" r="15" fill="rgba(0,0,0,0)" stroke-width="1" stroke="white" ;/></svg></div>
    <header>
        <nav class="navbar">
            <div class="navbar-main">
                <div class="navbar-group">
                    <div class="link-group" type="group">
                        <a href="tel:<?php echo esc_attr($phone);?>" class="link xs"><?php echo esc_attr($phone);?></a> 
                        <a href="mailto:<?php echo esc_attr($email);?>" class="link xs"><?php echo esc_attr($email);?></a>
                    </div>
                    <a href="my-cart.html" class="link" type="button">
                        <i class="icon-cart-icon fa-2xl"></i>
                    </a>
                </div>
                <figure>
                    <a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-sibos.svg" alt="navbar logo"></a>
                </figure>
                <div class="navbar-group">
                    <div class="navbar-search">
                        <form>
                            <div class="form-control sm">
                                <label for="search" aria-label="Search"> <i class="fa-solid fa-magnifying-glass fa-sm"></i> </label> 
                                <input type="text" id="search" name="search" placeholder=" ">
                            </div>
                            <input type="submit" style="height: 0px; width: 0px; border: none; padding: 0px;"  hidefocus="true"> 
                            <?php if ( is_user_logged_in() ) { ?>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="My Account" class="link link-blue xs">My Account</a>
                            <?php } 
                            else { ?>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="Sign in" class="link link-blue xs">Sign in</a>
                            <?php } ?>
                        </form>
                    </div>
                    <div class="navbar-burger" type="button" data-toggle="collapse" data-target="navbar-collapse"><span></span></div>
                </div>
            </div>
            <div class="navbar-collapse" id="navbar-collapse">
                <div class="navbar-collapse-cross" type="button" data-toggle="collapse" data-target="navbar-collapse"><span></span></div>
                <menu class="navbar-collapse-left"></menu>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-primary-items',
                        'menu_id'        => 'menu-primary-items',
                        'container'            => '',
                        'container_class'      => '',
                        'container_id'         => '',
                        'container_aria_label' => '',
                        'menu_class'           => '',
                        'menu_id'              => '',
                        'echo'                 => true,
                        'fallback_cb'          => 'wp_page_menu',
                        'before'               => '',
                        'after'                => '',
                        'link_before'          => '',
                        'link_after'           => '',
                        'items_wrap'           => '<menu class="navbar-collapse-middle place-type-section%2$s">%3$s</menu>',
                        'item_spacing'         => 'preserve',
                        'depth'                => 0,
                        'walker'               => '',
                        'link_class'     => 'link link-navbar',

                    )
                );
                ?>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-primary',
                        'menu_id'        => 'menu-primary',
                        'container'            => '',
                        'container_class'      => '',
                        'container_id'         => '',
                        'container_aria_label' => '',
                        'menu_class'           => '',
                        'menu_id'              => '',
                        'echo'                 => true,
                        'fallback_cb'          => 'wp_page_menu',
                        'before'               => '',
                        'after'                => '',
                        'link_before'          => '',
                        'link_after'           => '',
                        'items_wrap'           => '<menu class="navbar-collapse-right %2$s">%3$s</menu>',
                        'item_spacing'         => 'preserve',
                        'depth'                => 0,
                        'walker'               => '',
                        'link_class'     => 'link link-navbar',

                    )
                );
                ?>
            </div>
        </nav>
    </header>
<script>
    jQuery(document).ready(function() {
        jQuery('.navbar-collapse-middle li:has(ul) ul ').each(function (index) {
            $(this).append('<div class="d-none d-sm-flex my-2 g-2">' +
                '<a href="#"> <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-355.png" alt="sale card image">' +
                '<figcaption class="ff-i fs-3 fc-dark">Sale</figcaption></figure></a>' +
                '<a href="#"><figure class="ratio-1x1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-355.png" alt="sale card image">' +
                '<figcaption class="ff-i fs-3 fc-dark">Sale</figcaption></figure></a></div>');
        });
    });
</script>
