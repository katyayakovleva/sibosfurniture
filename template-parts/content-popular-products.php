
<?php
/**
 * Template part for displaying popular products
 *
 *
 * @package Sibosfurniture
 */

?>
<?php 
    $popular_products = new WP_Query( array(
        'post_type' => 'product',
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
        'posts_per_page' => 6,
        )
    );
?>
<!--<article class="px-3 px-sm-4 bg-blue-5 related products">-->
<!--        <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>-->
    <div class="swiper-per-view">
        <div class="swiper-wrapper">
        <?php if ( $popular_products->have_posts() ):
                while ( $popular_products->have_posts() ) : $popular_products->the_post(); ?>
                    <div class="swiper-slide grid-item-shop">
                        <?php
                        $post_object = get_post( get_the_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                        wc_get_template_part( 'content', 'product' );
                        ?>
                    </div>
                    <?php endwhile; ?>
            <?php wp_reset_query();
        endif;?>
            
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
<!--</article>-->