<?php
/**
 * The template for search form
 *
 * @package Sibosfurniture
 */

$type = "product";
if(is_page_template( 'page-templates/page-template-blog.php' ) || (is_single() && 'post' == get_post_type())){
    $type = "blog";
}
?>

<form class="form-control sm" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
    <label for="search" aria-label="Search"> <i class="fa-solid fa-magnifying-glass fa-sm"></i> </label> 
    <input type="text" name="s" id="podcastS" class="search" placeholder="Search" value="<?php echo get_search_query(); ?>">
    <input type="hidden" name="search-type" value="<?php echo $type; ?>" />
</form>