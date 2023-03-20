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
                    'hide_empty' => false,
                    'parent'   => 0,
                    'exclude'  =>array(get_term_by('slug','uncategorized','product_cat')->term_id)
                );
                $product_cat = get_terms( $args );
            ?>
            <div class="link-category-list" id="filter-checkout">
                <?php foreach ($product_cat as $parent_product_cat) { ?>
               
                        <p class="link-category"><?php echo $parent_product_cat->name; ?></p>
                       <form>
                        <?php
                            $child_args = array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => true,
                                        'parent'   => $parent_product_cat->term_id
                                    );
                            $child_product_cats = get_terms( $child_args );
                            foreach ($child_product_cats as $child_product_cat) { ?>

                            <div class="form-checkbox">
                                <label><input type="checkbox" data-category_id="<?php echo $child_product_cat->term_id; ?>"><? echo $child_product_cat->name; ?></label>
                                <!-- <a href="<?php echo get_term_link($child_product_cat->term_id); ?>"><? echo $child_product_cat->name; ?></a> -->
                            </div>
                            
                            <?php } 
                        ?>
                        </form>

                <?php } ?>
            </div>   
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
                <section class="grid-container py-2" id="products-loop">
                    <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                        'posts_per_page' => 12,
                        'post_type'      => 'product',
                        'paged'          => $paged,
//                        'meta_key' => 'views_total',
                        'orderby' => 'popularity',
                        'order' => 'DESC',
                    );
                    $products = new WP_Query( $args );
//                    $products = $products->get_products();
                    while ( $products->have_posts() ) : $products->the_post();
                        global $product;
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
                    <?php endwhile;

                    wp_reset_query();
                    ?>
                </section>
            </article>
        </section>
    </article>
        <div class="control pb-1">
            <?php
            $total= [$products -> max_num_pages];
            $previous_posts_link = previous_posts(false);
            $next_posts_link = next_posts( $total, false);
            ?>
            <div></div>
            <div class="arrows">
                <?php if($previous_posts_link && $paged > 1):?>
                    <a href="<?php echo $previous_posts_link; ?>" class="link fs-3" aria-label="back">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                <?php else :?>
                    <a href="" class="link fs-3 disabled" aria-label="back">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                <?php endif;?>
                <?php if($next_posts_link && $paged!=$total[0]):?>
                    <a href="<?php echo $next_posts_link; ?>" class="link fs-3" aria-label="back">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php else :?>
                    <a href="" class="link fs-3 disabled" aria-label="back">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php endif;?>
            </div>
            <div class="page-number">
                <p><?php echo $paged; ?></p>
                <p>/</p>
                <p><?php echo $total[0]; ?></p>
            </div>
        </div>
        <?php
        $page_template = get_pages( array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/page-template-colors-and-materials.php',
        ));
        ?>
        <div class="d-flex jc-center pb-3 px-2"><a href="<?php echo get_permalink( $page_template[0]->ID ); ?>" class="btn mx-auto">Search for your color and material</a></div>
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
