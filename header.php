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
    .hero {
        background: url(<?php echo get_template_directory_uri(); ?>/assets/images/image-7.jpg) no-repeat center/cover;
    }
    .hidden-work span {
        background: rgba(0,73,175,.3) url(<?php echo get_template_directory_uri(); ?>/assets/images/couple-choosing-fabric-in-furniture-store-1.jpg) no-repeat center/cover;
    }
    .hero__right span:nth-child(5) {
        background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-328.jpg)
    }
    .hero__right span:nth-child(11) {
        background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-334.jpg)
    }
    @media screen and (min-width: 35.5em) {
        .hero {
            background: url(<?php echo get_template_directory_uri(); ?>/assets/images/image-6.jpg) no-repeat center/cover
        }
        .numbers>div:nth-child(1) {
            background: rgba(0,73,175,.3) url(<?php echo get_template_directory_uri(); ?>/assets/images/couple-choosing-fabric-in-furniture-store-1.jpg) no-repeat center/cover;
        }
        .hero__left {
            background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/image-5.jpg);
        }
    }
</style>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="preloader"><svg><circle id="preloader_animation" cx="50%" cy="50%" r="15" fill="rgba(0,0,0,0)" stroke-width="1" stroke="white" ;/></svg></div>
    <header>
        <nav class="navbar">
            <div class="navbar-main">
                <div class="navbar-group">
                    <div class="link-group" type="group"><a href="tel:+1818-696-3839" class="link xs">+1818-696-3839</a> <a href="mailto:orders@sibosfurniture" class="link xs">orders@sibosfurniture</a></div><a href="my-cart.html" class="link" type="button"><i class="icon-cart-icon fa-2xl"></i></a></div>
                <figure>
                    <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-sibos.svg" alt="navbar logo"></a>
                </figure>
                <div class="navbar-group">
                    <div class="navbar-search">
                        <form>
                            <div class="form-control sm"><label for="search" aria-label="Search"><i class="fa-solid fa-magnifying-glass fa-sm"></i></label> <input type="text" id="search" name="search" placeholder=" "></div><input type="submit" style="height: 0px; width: 0px; border: none; padding: 0px;"
                                hidefocus="true"> <a href="sign-in.html" class="link link-blue xs">Sign in</a></form>
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
                        'items_wrap'           => '<menu class="navbar-collapse-middle%2$s">%3$s</menu>',
                        'item_spacing'         => 'preserve',
                        'depth'                => 0,
                        'walker'               => '',
                        'link_class'     => 'link link-navbar',

                    )
                );
                ?>
<!--                <menu class="navbar-collapse-middle">-->
<!--                    <li><button href="shop-page.html" class="link link-navbar">Living room</button>-->
<!--                        <ul>-->
<!--                            <li><a href="#" class="link link-navbar">Accent chair</a></li>-->
<!--                            <li><a href="#" class="link link-navbar">Accent chair</a></li>-->
<!--                            <div class="d-none d-sm-flex my-2 g-2">-->
<!--                                <figure class="ratio-1x1"><img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/Rectangle-355.png" alt="sale card image">-->
<!--                                    <figcaption class="ff-i fs-3 fc-dark">Sale</figcaption>-->
<!--                                </figure>-->
<!--                                <figure class="ratio-1x1"><img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/Rectangle-355.png" alt="sale card image">-->
<!--                                    <figcaption class="ff-i fs-3 fc-dark">Sale</figcaption>-->
<!--                                </figure>-->
<!--                            </div>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><button href="shop-page.html" class="link link-navbar">Bedrooms</button>-->
<!--                        <ul>-->
<!--                            <li><a href="#" class="link link-navbar">Accent bed</a></li>-->
<!--                            <li><a href="#" class="link link-navbar">Accent bed</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><button href="shop-page.html" class="link link-navbar">Dinning room</button>-->
<!--                        <ul>-->
<!--                            <li><a href="#" class="link link-navbar">Dinning chair</a></li>-->
<!--                            <li><a href="#" class="link link-navbar">Dinning chair</a></li>-->
<!--                            <div class="d-none d-sm-flex my-2 g-2">-->
<!--                                <figure class="ratio-1x1"><img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/Rectangle-355.png" alt="sale card image">-->
<!--                                    <figcaption class="ff-i fs-3 fc-dark">Sale</figcaption>-->
<!--                                </figure>-->
<!--                            </div>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><button href="shop-page.html" class="link link-navbar">Accent furniture</button>-->
<!--                        <ul>-->
<!--                            <li><a href="#" class="link link-navbar">Accent furniture</a></li>-->
<!--                            <li><a href="#" class="link link-navbar">Accent furniture</a></li>-->
<!--                            <div class="d-none d-sm-flex my-2 g-2">-->
<!--                                <figure class="ratio-1x1"><img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/Rectangle-355.png" alt="sale card image">-->
<!--                                    <figcaption class="ff-i fs-3 fc-dark">Sale</figcaption>-->
<!--                                </figure>-->
<!--                                <figure class="ratio-1x1"><img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/Rectangle-355.png" alt="sale card image">-->
<!--                                    <figcaption class="ff-i fs-3 fc-dark">Sale</figcaption>-->
<!--                                </figure>-->
<!--                            </div>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><button href="shop-page.html" class="link link-navbar">Office</button>-->
<!--                        <ul>-->
<!--                            <li><a href="#" class="link link-navbar">Office chair</a></li>-->
<!--                            <li><a href="#" class="link link-navbar">Office chair</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><button href="shop-page.html" class="link link-navbar">Outdoor</button>-->
<!--                        <ul>-->
<!--                            <li><a href="#" class="link link-navbar">Outdoor chair</a></li>-->
<!--                            <li><a href="#" class="link link-navbar">Outdoor chair</a></li>-->
<!--                            <div class="d-none d-sm-flex my-2 g-2">-->
<!--                                <figure class="ratio-1x1"><img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/Rectangle-355.png" alt="sale card image">-->
<!--                                    <figcaption class="ff-i fs-3 fc-dark">Sale</figcaption>-->
<!--                                </figure>-->
<!--                            </div>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><button href="shop-page.html" class="link link-navbar">Sale</button>-->
<!--                        <ul>-->
<!--                            <li><a href="#" class="link link-navbar">Sale chair</a></li>-->
<!--                            <li><a href="#" class="link link-navbar">Sale chair</a></li>-->
<!--                            <div class="d-none d-sm-flex my-2 g-2">-->
<!--                                <figure class="ratio-1x1"><img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/Rectangle-355.png" alt="sale card image">-->
<!--                                    <figcaption class="ff-i fs-3 fc-dark">Sale</figcaption>-->
<!--                                </figure>-->
<!--                                <figure class="ratio-1x1"><img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/Rectangle-355.png" alt="sale card image">-->
<!--                                    <figcaption class="ff-i fs-3 fc-dark">Sale</figcaption>-->
<!--                                </figure>-->
<!--                            </div>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </menu>-->
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
<!--                <menu class="navbar-collapse-right">-->
<!--                    <li><a href="#" class="link link-navbar" aria-current="page">Home</a></li>-->
<!--                    <li><button href="shop-page.html" class="link link-navbar" data-toggle="collapse">Catalog</button>-->
<!--                        <ul></ul>-->
<!--                    </li>-->
<!--                    <li><a href="about-us.html" class="link link-navbar">About us</a></li>-->
<!--                    <li><a href="colors-and-materials.html" class="link link-navbar">Colors & materials</a></li>-->
<!--                    <li><a href="portfolio.html" class="link link-navbar">Portfolio</a></li>-->
<!--                    <li><a href="#reviews" class="link link-navbar">Reviews</a></li>-->
<!--                    <li><a href="#contact-us" class="link link-navbar">Contact us</a></li>-->
<!--                </menu>-->
            </div>
        </nav>
    </header>
<script>
    jQuery(document).ready(function() {
        jQuery('.navbar-collapse-middle li:has(ul) ul ').each(function (index){
            $(this).append('<div class="d-none d-sm-flex my-2 g-2">' +
                '<a href="#"> <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-355.png" alt="sale card image">' +
                '<figcaption class="ff-i fs-3 fc-dark">Sale</figcaption></figure></a>' +
                '<a href="#"><figure class="ratio-1x1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-355.png" alt="sale card image">' +
                '<figcaption class="ff-i fs-3 fc-dark">Sale</figcaption></figure></a></div>');
        });
    });
</script>