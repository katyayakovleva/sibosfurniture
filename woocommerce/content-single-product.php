<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$price = $product->get_price();
$title = $product->get_title();
$SKU = $product->get_sku();
$pieces = explode(' ', $SKU);
$SKU_last_word = array_pop($pieces);
$SKU_first_words = implode(' ', $pieces);
$short_description = $product->get_short_description();
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
    <div class="header-padding">
    <article class="product-article">
<!--    <section class="cols pt-2">-->
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action( 'woocommerce_before_single_product_summary' );
        ?>
        <div class="summary entry-summary">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>
        </div>

<!--        --><?php
//        /**
//         * Hook: woocommerce_after_single_product_summary.
//         *
//         * @hooked woocommerce_output_product_data_tabs - 10
//         * @hooked woocommerce_upsell_display - 15
//         * @hooked woocommerce_output_related_products - 20
//         */
//        do_action( 'woocommerce_after_single_product_summary' );
//        ?>
    </div>
<!--    </section>-->
    </article>
    </div>
    <main class="header-padding">
        <article class="px-2 px-sm-4">
            <section class="cols pt-2">
                <div class="col-1 col-sm-5-12 col-xxl-3-12 pr-sm-2">
                    <div class="image-gallery">
                        <div class="image-gallery__main">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="swiper-zoom-container"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" alt="image"></div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-zoom-container"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-2.jpg" alt="image"></div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-zoom-container"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-3.jpg" alt="image"></div>
                                </div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <div class="image-gallery__thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" alt="image"></div>
                                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-2.jpg" alt="image"></div>
                                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-3.jpg" alt="image"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 col-sm-7-12 col-xxl-6-12">
                    <form class="main-info">
                        <h1 class="ff-ms fs-2 fw-7 fc-blue-2 my-0">CLARENCE</h1>
                        <p class="ff-ms fs-6 fc-dark my-0 mt-sm-1">29" SWIVEL BARSTOOL (2/BOX)</p>
                        <p class="ff-ms fs-6 fc-dark my-0 my-sm-1">CM-BR1855A-29-2PK</p>
                        <span class="d-flex g-1 ai-center jc-between">
                        <p class="price ff-ms fs-2 fw-7 fc-blue-3 m-sm-0">$<?php echo esc_attr($price); ?></p>
                        <a href="my-cart.html" class="btn d-none d-sm-block">Add to cart</a>
                     </span>
                        <hr class="d-sm-none mt-0 mb-1">
                        <p class="ff-ms fs-5 fc-dark mb-sm-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolvore magna aliqua.</p>
                        <div class="color-picker my-0">
                            <div class="color-picker__ratio"><input type="radio" aria-label="Orange color" value="orange" name="color" checked="checked"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-316.jpg" alt="texture option"></div>
                            <div class="color-picker__ratio"><input type="radio" aria-label="Yellow color" value="yellow" name="color"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-317.jpg" alt="texture option"></div>
                            <div class="color-picker__ratio"><input type="radio" aria-label="Blue color" value="blue" name="color"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-318.jpg" alt="texture option"></div>
                        </div>
                        <div class="stepper-input mt-2">
                            <div class="stepper-input__container">
                                <p class="stepper-input__input ff-i fs-4 fw-7 fc-blue-4 m-0 ta-center">1</p>
                                <input id="count" type="number" hidden value="1" name="count">
                            </div>
                            <div class="stepper-input__control d-flex fd-col"><button type="button" aria-label="increase quantity" class="stepper-input__button stepper-input__button--left"><i class="fa-solid fa-chevron-up fc-blue-4"></i></button> <button type="button" aria-label="decrease quantity" class="stepper-input__button stepper-input__button--right"><i class="fa-solid fa-chevron-down fc-blue-4"></i></button></div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="pt-0 pb-2">
                <div class="description-info">
                    <div class="description-info__tabs my-1">
                        <div class="link-group half"><button class="link active" data-target="tab-description">Description</button> <button class="link" data-target="tab-feedback">Feedback</button></div>
                    </div>
                    <div class="description-info__info">
                        <div id="tab-description" class="description-info__block active w-100 w-sm-75">
                            <p class="ff-ms fs-5 fc-dark">When you are in the midst of deep conversation, the last thing you want is for your train of thought to be disrupted by an uncomfortable chair. That's why these barstools are designed to be flexible and dependable. The X-back and foot rest are made of sturdy metal, while the soft cushion provides ample support. The wooden back is contoured to cradle you in, as you twist back and forth to the rhythm of your dialogue.</p>
                            <hr>
                            <ul>
                                <li class="ff-ms fs-5">
                                    <strong class="fw-4 fc-blue-2">Height:</strong>
                                    <p class="fc-dark">30cm</p>
                                </li>
                                <li class="ff-ms fs-5">
                                    <strong class="fw-4 fc-blue-2">Length:</strong>
                                    <p class="fc-dark">30cm</p>
                                </li>
                                <li class="ff-ms fs-5">
                                    <strong class="fw-4 fc-blue-2">Weight:</strong>
                                    <p class="fc-dark">30kg</p>
                                </li>
                                <li class="ff-ms fs-5">
                                    <strong class="fw-4 fc-blue-2">Color:</strong>
                                    <p class="fc-dark">Brown</p>
                                </li>
                                <li class="ff-ms fs-5">
                                    <strong class="fw-4 fc-blue-2">Height:</strong>
                                    <p class="fc-dark">30cm</p>
                                </li>
                            </ul>
                        </div>
                        <div id="tab-feedback" class="description-info__block">
                            <div class="swiper-per-view">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide comment">
                                        <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Ellipse-5.jpg" alt="avatar"></figure>
                                        <div>
                                            <div><span class="checked"></span> <span class="checked"></span> <span class="checked"></span> <span class="checked"></span> <span class="checked"></span></div>
                                            <p class="ff-ms fs-5 fc-blue-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide comment">
                                        <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Ellipse-6.jpg" alt="avatar"></figure>
                                        <div>
                                            <div><span class="checked"></span> <span class="checked"></span> <span class="checked"></span> <span class="checked"></span> <span class="checked"></span></div>
                                            <p class="ff-ms fs-5 fc-blue-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                    <div class="swiper-slide comment">
                                        <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Ellipse-7.jpg" alt="avatar"></figure>
                                        <div>
                                            <div><span class="checked"></span> <span class="checked"></span> <span class="checked"></span> <span class="checked"></span> <span class="checked"></span></div>
                                            <p class="ff-ms fs-5 fc-blue-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>
        <article class="px-3 px-sm-4 bg-blue-5">
            <h2 class="ff-ms fs-4 fc-blue-2 my-1">Related items</h2>
            <div class="swiper-per-view">
                <div class="swiper-wrapper">
                    <div class="swiper-slide grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>
                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                        </div>
                        <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                        <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0">679$</p>
                            <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </article>
    </main>
<!--    <div id="product---><?php //the_ID(); ?><!--" --><?php //wc_product_class( '', $product ); ?><!--
//        /**
//         * Hook: woocommerce_before_single_product_summary.
//         *
//         * @hooked woocommerce_show_product_sale_flash - 10
//         * @hooked woocommerce_show_product_images - 20
//         */
//        do_action( 'woocommerce_before_single_product_summary' );
//        ?>

        <div class="summary entry-summary">-->
<!--            --><?php
//            /**
//             * Hook: woocommerce_single_product_summary.
//             *
//             * @hooked woocommerce_template_single_title - 5
//             * @hooked woocommerce_template_single_rating - 10
//             * @hooked woocommerce_template_single_price - 10
//             * @hooked woocommerce_template_single_excerpt - 20
//             * @hooked woocommerce_template_single_add_to_cart - 30
//             * @hooked woocommerce_template_single_meta - 40
//             * @hooked woocommerce_template_single_sharing - 50
//             * @hooked WC_Structured_Data::generate_product_data() - 60
//             */
//            do_action( 'woocommerce_single_product_summary' );
//            ?>
<!--        </div>-->
<!---->
<!--        --><?php
//        /**
//         * Hook: woocommerce_after_single_product_summary.
//         *
//         * @hooked woocommerce_output_product_data_tabs - 10
//         * @hooked woocommerce_upsell_display - 15
//         * @hooked woocommerce_output_related_products - 20
//         */
//        do_action( 'woocommerce_after_single_product_summary' );
//        ?>
<!--    </div>-->

<?php do_action( 'woocommerce_after_single_product' ); ?>
<style>
    .wpgs-for .slick-arrow {
        top: 88%;
        padding: 0 12px;
    }
    .wpgs-for .slick-arrow:before {
        content: "";
        border: solid #c7d6eb;
        border-width: 0 4px 4px 0;
        display: inline-block;
        padding: 9px;
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
    }
    .wpgs-for .slick-arrow:first-of-type:before {
        transform: rotate(135deg);
        -webkit-transform: rotate(135deg);
    }
    .wpgs-nav .slick-track {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: .5em
    }
    .wpgs-nav .slick-slide {
        aspect-ratio: 1;
        padding: 6px;
        border: 2px solid transparent;
        transition: border ease-in-out .12s;
    }
    .wpgs-nav .slick-slide.slick-current {
         border-color: #0049af;
     }
    .wpgs-lightbox-icon::before{
        display: none;
    }
</style>
<script>
    jQuery(document).ready(function() {
        jQuery('.quantity input').attr("value", 1);
    })

</script>
