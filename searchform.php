<?php
/**
 * The template for search form
 *
 * @package Sibosfurniture
 */

?>

<form class="form-control sm" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
    <label for="search" aria-label="Search"> <i class="fa-solid fa-magnifying-glass fa-sm"></i> </label> 
    <input type="text" name="s" class="search" placeholder="Search" value="<?php echo get_search_query(); ?>">
</form>