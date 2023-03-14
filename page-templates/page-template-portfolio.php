<?php
/**
 * Template Name: Portfolio
 * 
 * The main template file
 *
 * @package Sibosfurniture
 */

get_header();
?>
 <main class="header-padding">
        <article class="px-2 px-sm-4 mb-2">
            <header class="header-primary">
                <h1 class="ff-ms fs-2 fc-blue-2 fw-7">Portfolio</h1>
            </header>
            <section class="grid-container">
            <?php //echo do_shortcode(get_field('gallery_shortcode') );?>
            <?php 
            if ( $gallery = get_post_gallery( get_the_ID(), false ) ) :
                foreach ( $gallery['src'] as $src ) {
                            ?>                
                           <a href="#" class="grid-item"> <img src="<?php echo $src; ?>"alt="portfolio"  /></a>
                    <?php
                }
            endif;
            ?>
                <!-- <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-1.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-2.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-3.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-1.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-2.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-3.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-1.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-2.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-3.jpg" alt="grid item image"></a> -->
            </section>
        </article>
     <article class="px-3 px-sm-4 bg-blue-5 related products">
         <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
         <?php get_template_part('template-parts/content', 'popular-products');?>
     </article>    </main>
<?php get_footer();?>
