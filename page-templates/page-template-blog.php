<?php
/**
 * Template Name: Blog
 * 
 * The main template file
 *
 * @package Sibosfurniture
 */

get_header();
?>
<main class="header-padding">
        <article class="px-2 px-md-4">
            <header>
                <h1 class="ff-ms fs-2 fc-blue-2 fw-7">Blog</h1>
            </header>
            <section class="grid-container pt-0 pb-2 px-0">
                <?php 
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $posts = new WP_Query( array(
                        'posts_per_page' => 8,
                        'post_type'      => 'post',
                        'category' =>  get_category_by_slug( 'blog' )->term_id,
                        'paged'          => $paged,
                        'meta_key' => 'views_total',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        )
                );   
                
            ?>
            <?php if ( $posts->have_posts() ):
                while ( $posts->have_posts() ) : $posts->the_post(); ?>
                <div class="item-blog">
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
                
            </section>
        </article>
        <div class="control pb-1">
        <?php
            $total= [$posts -> max_num_pages];
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
    </main>
<?php
get_footer();
