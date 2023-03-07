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
	<?php the_content();?>
</main>

<?php get_footer();?>
