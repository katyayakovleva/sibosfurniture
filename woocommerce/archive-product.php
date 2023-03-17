<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
    <main class="header-padding">
    <article class="catalog px-2 px-md-4 pt-2">
        <aside>
            <h4 class="ff-ms fs-4 fc-blue-2 fw-7 my-1">Categories</h4>
            <p class="ff-ms fs-5 fc-blue-2 ta-center">Living room</p>
            <ul class="link-category-list">
                <li>
                    <a href="#" class="link-category">Beds</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li>
                <li>
                    <a href="#" class="link-category">Beds</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li>
                <li>
                    <a href="#" class="link-category">Beds</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li>
            </ul>
            <p class="ff-ms fs-5 fc-blue-2 ta-center">Living room</p>
            <ul class="link-category-list">
                <li>
                    <a href="#" class="link-category">Beds</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li>
                <li>
                    <a href="#" class="link-category">Beds</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li>
                <li>
                    <a href="#" class="link-category">Beds</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li>
            </ul>
        </aside>
        <section>
            <div class="breadcrumb my-2">
                <div class="breadcrumb__item"><a href="<?php echo home_url();?>" class="link">Home</a></div>
                <div class="breadcrumb__item"><a href="<?php echo $shop_page_url ?>" class="link">Shop</a></div>
            </div>
            <article>
                <section class="d-flex jc-between g-1 jc-sm-end px-2">
                    <div class="dropdown d-sm-none">
                        <?php  echo woocommerce_catalog_ordering(); ?>
                    </div>
                    <div class="dropdown">
                        <?php  echo woocommerce_catalog_ordering(); ?>
                    </div>
                </section>
                <section class="grid-container py-2">
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                </section>
            </article>
        </section>
    </article>
<?php //echo do_shortcode('[wpf-filters id=1]') ?>
<!--    <header class="woocommerce-products-header">-->
<!--        --><?php //if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
<!--            <h1 class="woocommerce-products-header__title page-title">--><?php //woocommerce_page_title(); ?><!--</h1>-->
<!--        --><?php //endif; ?>
<!---->
<!--        --><?php
//        /**
//         * Hook: woocommerce_archive_description.
//         *
//         * @hooked woocommerce_taxonomy_archive_description - 10
//         * @hooked woocommerce_product_archive_description - 10
//         */
//        do_action( 'woocommerce_archive_description' );
//        ?>
<!--    </header>-->
<?php
if ( woocommerce_product_loop() ) {

    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked woocommerce_output_all_notices - 10
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */
    do_action( 'woocommerce_before_shop_loop' );

    woocommerce_product_loop_start();

    if ( wc_get_loop_prop( 'total' ) ) {
        while ( have_posts() ) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action( 'woocommerce_shop_loop' );

            wc_get_template_part( 'content', 'product' );
        }
    }

    woocommerce_product_loop_end();

    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked woocommerce_pagination - 10
     */
    do_action( 'woocommerce_after_shop_loop' );
} else {
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );?>
    </main>
<?php get_footer( 'shop' );
