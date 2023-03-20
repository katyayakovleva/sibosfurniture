<?php
/**
 * Template Name: Wish-list
 *
 * The main template file
 *
 * @package Sibosfurniture
 */

get_header();
?>
<main class="header-padding">
    <article class="px-2 px-md-4">
        <?php echo do_shortcode('[yith_wcwl_wishlist]')?>
    </article>
    <article class="px-3 px-sm-4 bg-blue-5 related products">
        <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
        <?php get_template_part('template-parts/content', 'popular-products');?>
    </article>
</main>
<?php
get_footer();?>
