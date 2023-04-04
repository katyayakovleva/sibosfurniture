<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sibosfurniture
 */

get_header();
?>
<?php if(is_user_logged_in() && is_account_page() && !is_wc_endpoint_url()):?>
	<main class="header-padding mb-sm-2 mb-lg-3">	
<?php else:?>
	<main class="header-padding">	
<?php endif;?>
<?php if( is_product_tag() || is_checkout() || is_account_page() || is_cart() || is_wc_endpoint_url()):?>
	<?php the_content();?>
<?php else:?>
	<article class="primary-header px-2 px-md-4 pt-2 pb-1">
            <div class="d-flex fd-col">
                <h1 class="ff-ms fs-1 fw-7 fc-blue-2 m-0"><?php the_title();?></h1>
                <div class="breadcrumb my-1">
                    <div class="breadcrumb__item"><a href="<?php echo home_url();?>" class="link">Home</a></div>
                    <!-- <div class="breadcrumb__item"><a href="<?php echo get_permalink( $page_template[0]->ID ); ?>" class="link">Blog</a></div> -->
                    <div class="breadcrumb__item"><a href="<?php echo get_permalink();?>" class="link"><?php the_title(); ?></a></div>
                </div>
            </div>
            <!-- <div class="d-flex fd-col pl-sm-1">
                <p class="ff-ms fs-5 fc-blue-4 m-0"><?php echo get_the_date('d/m'); ?></p>
                <p class="ff-ms fs-5 fc-blue-4 m-0"><?php echo get_the_date('Y'); ?></p>
            </div> -->
        </article>
        <section class="px-2 px-sm-4 pb-3 pb-sm-4">
            <article class="article-block default-page-content">
                <?php the_content();?>
                <!-- <figure><?php the_post_thumbnail(); ?></figure> -->
            </article>
        </section>
        <article class="px-3 px-sm-4 bg-blue-5">
            <h2 class="ff-ms fs-4 fc-blue-2 my-1">You might like...</h2>
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
<?php endif;?>

	
</main>

<?php get_footer();?>
