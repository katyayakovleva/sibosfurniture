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
            <!-- <p class="ff-ms fs-5 fc-blue-2 ta-center">Living room</p> -->
            <?php 
                $args = array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'parent'   => 0,
                    'exclude'  =>array(get_term_by('slug','uncategorized','product_cat')->term_id)
                );
                $product_cat = get_terms( $args );
            ?>
            <ul class="link-category-list">
                <?php foreach ($product_cat as $parent_product_cat) { ?>
               
                    <li>
                        <a href="#" class="link-category"><?php echo $parent_product_cat->name; ?></a>
                       <ol>
                        <?php
                            $child_args = array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => true,
                                        'parent'   => $parent_product_cat->term_id
                                    );
                            $child_product_cats = get_terms( $child_args );
                            foreach ($child_product_cats as $child_product_cat) { ?>

                            <li><a href="<?php echo get_term_link($child_product_cat->term_id); ?>"><? echo $child_product_cat->name; ?></a></li>
                            
                            <?php } 
                        ?>
                        </ol>
                    </li>

                <?php } ?>
                
                <!-- <li>
                    <a href="#" class="link-category">Place types</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li>
                <li>
                    <a href="#" class="link-category">Item types</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li>
                <li>
                    <a href="#" class="link-category">Collections</a>
                    <ol>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Beds</a></li>
                    </ol>
                </li> -->
            </ul>
            <!-- <p class="ff-ms fs-5 fc-blue-2 ta-center">Living room</p>
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
            </ul> -->
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
                    <?php $args = array(
                        'post_type' => 'product',
                        'orderby' => 'popularity',
                        'order' => 'DESC',
                        'posts_per_page' => -1
                    );
                    $products = new WC_Product_Query( $args );
                    $products = $products->get_products();
                    if ( $products ) {
                    foreach ( $products as $product ) {
                        $product_id = $product->get_id();
                        $product_name = $product->get_name();
                        $product_url = get_permalink( $product_id );
                        $product_thumbnail = $product->get_image();
                        $product_rating = $product->get_average_rating();
                        $product_price = $product->get_price_html();?>
                    <div class="grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure>
                                <?php if ($product->is_on_sale()) {?>
                                    <span class="onsale">Sale!</span>
                                <?php }?>
                                <?php echo $product_thumbnail ?>
                            </figure>
<!--                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="dark-red" alt="item image"></figure>-->
<!--                            <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue" data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>-->
                        </div>
                        <p class="ff-ms fs-5 fg-1 product_name"><?php echo $product_name ?></p>
                        <div class="product-rating">
                            <?php if($product_rating > 0){
                                for ($i = 1; $i <= $product_rating; $i++){ ?>
                                    <span class="checked"></span>
                                <?php }
                            for ($i = 1; $i <= 5-$product_rating; $i++){?>
                            <span class="unchecked"></span>
                            <?php }
                            }?>
                        </div>
                        <div class="d-flex ai-center jc-between mt-2">
                            <p class="grid-item-shop__price ff-ms m-0"><?php echo $product_price ?></p>
                            <div class="grid-item-shop__buttons"><a href="<?php echo $product_url ?>" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                        </div>
                    </div>
                    <?php     }
                    }?>
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
//if ( woocommerce_product_loop() ) {
//
//    /**
//     * Hook: woocommerce_before_shop_loop.
//     *
//     * @hooked woocommerce_output_all_notices - 10
//     * @hooked woocommerce_result_count - 20
//     * @hooked woocommerce_catalog_ordering - 30
//     */
//    do_action( 'woocommerce_before_shop_loop' );
//
//    woocommerce_product_loop_start();
//
//    if ( wc_get_loop_prop( 'total' ) ) {
//        while ( have_posts() ) {
//            the_post();
//
//            /**
//             * Hook: woocommerce_shop_loop.
//             */
//            do_action( 'woocommerce_shop_loop' );
//
//            wc_get_template_part( 'content', 'product' );
//        }
//    }
//
//    woocommerce_product_loop_end();
//
//    /**
//     * Hook: woocommerce_after_shop_loop.
//     *
//     * @hooked woocommerce_pagination - 10
//     */
//    do_action( 'woocommerce_after_shop_loop' );
//} else {
//    /**
//     * Hook: woocommerce_no_products_found.
//     *
//     * @hooked wc_no_products_found - 10
//     */
//    do_action( 'woocommerce_no_products_found' );
//}
//
///**
// * Hook: woocommerce_after_main_content.
// *
// * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
// */
//do_action( 'woocommerce_after_main_content' );
//
///**
// * Hook: woocommerce_sidebar.
// *
// * @hooked woocommerce_get_sidebar - 10
// */
////do_action( 'woocommerce_sidebar' );?>
<article class="px-3 px-sm-4 bg-blue-5">
            <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top news</h2>
            <div class="swiper-per-view">
                <div class="swiper-wrapper">
                    <?php 
                        $posts = new WP_Query( array(
                            'posts_per_page' => 6,
                            'post_type'      => 'post',
                            'category' =>  get_category_by_slug( 'blog' )->term_id,
                            'meta_key' => 'views_total',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            )
                        );
                    ?>
                    <?php if ( $posts->have_posts() ):
                        while ( $posts->have_posts() ) : $posts->the_post(); ?>
                            <div class="swiper-slide item-blog">
                                <div>
                                    <div class="d-flex jc-between">
                                        <figure class="ratio-4x3">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <img src="<?php the_post_thumbnail_url();?>" alt="item image">
                                        <?php else:?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-sibos.svg" alt="item image">
                                        <?php endif;?>
                                        </figure>
                                        <div class="d-flex fd-col pl-1">
                                            <p class="ff-ms fs-1-25 fc-blue-4 m-0"><?php echo get_the_date('d/m'); ?></p>
                                            <p class="ff-ms fs-1-25 fc-blue-4 m-0"><?php echo get_the_date('Y'); ?></p>
                                        </div>
                                    </div>
                                    <p class="ff-ms fs-4 fw-7 uppercase"><?php echo sibosfurniture_custom_title();?></p>
                                    <p class="ff-ms fs-5 fc-dark"><?php echo sibosfurniture_custom_excerpt();?></p>
                                </div><a href="<?php the_permalink($post->ID); ?>" class="btn as-start">Read more</a>
                            </div>
                        <?php endwhile; ?>
                    <?php wp_reset_postdata();
                endif;?>
                    
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </article>
    </main>
<?php get_footer( 'shop' );
