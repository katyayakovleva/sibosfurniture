<?php
/**
 * The template for displaying search results pages
 *
 * @package Sibosfurniture
 */

get_header();
?>

<?php 

if(isset($_GET['search-type'])) {

	$type = $_GET['search-type'];


	if($type == 'blog') {?>
		<?php get_header(); ?>
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
							's'             => $_GET['s'],
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
				if($total[0] == 0){
					$total[0] = 1;
				}
			?>
				<div></div>
				<div class="arrows">
					<?php if($previous_posts_link && $paged > 1):?>
						<a href="<?php echo $previous_posts_link; ?>" class="link fs-3" aria-label="back">
							<i class="fa-solid fa-arrow-left"></i>
						</a>
					<?php else :?> 
						<a href="" class="link image.pngfs-3 disabled" aria-label="back">
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
		<?php get_footer();?>
	<?php
	} else  {?>
<?php


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

if (isset($_GET['place_types'])) {
    $place_types = json_decode(urldecode($_GET['place_types']), true);
} else {
    $place_types = [];
}

if (isset($_GET['sale'])) {
    $sale = $_GET['sale'];
} else {
    $sale = '';
}
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'popularity';
}
if (isset($_GET['posts_per_page'])) {
    $posts_per_page = $_GET['posts_per_page'];
} else {
    $posts_per_page = 12;
}
if (isset($_GET['collection'])) {
    $collection_id = $_GET['collection'];
} else {
    $collection_id = 0;
}
$min_price_default = get_min_price();
$max_price_default = get_max_price();

if (isset($_GET['min'])) {
    $min_price = $_GET['min'];
} else {
    $min_price = $min_price_default;
}
if (isset($_GET['max'])) {
    $max_price = $_GET['max'];
} else {
    $max_price = $max_price_default;
}

$posts_per_page_veriants = [12, 24, 48];

$current_product_cat = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
?>
<a href = "<? echo get_post_type_archive_link( 'product')?>" id="catalog_link" hidden ></a>
<main class="header-padding">
    <article class="catalog px-2 px-md-4 pt-2">
        <aside>
            <h4 class="ff-ms fs-4 fc-blue-2 fw-7 my-1">Collections</h4>
            
            <div class="collections-container">
                <?php 
                $where_to_show_new_collection_pop_up =  where_to_show_new_collection_pop_up();
               
                $is_show_pop_up = TRUE;
                $active_collection = 'none';

                if($current_product_cat || $collection_id != 0){
                    
                    if($collection_id != 0){
                        $current_term = get_term($collection_id, 'product_cat');
                    }
                    else{
                        $current_term = $current_product_cat;
                    }
                    $current_term_parent = get_term($current_term->parent, 'product_cat');
                    if($current_term_parent->slug == 'modern'){
                        $active_collection = 'modern_children';
                        $is_show_pop_up = FALSE;
                    } 
                    if($current_term->slug == 'modern'){
                        $active_collection = 'modern_parent';
                        $is_show_pop_up = FALSE;
                    } 
                    if($current_term_parent->slug == 'classical'){
                        $active_collection = 'classical_children';
                        $is_show_pop_up = FALSE;
                    } 
                    
                    if($current_term->slug == 'classical'){
                        $active_collection = 'classical_parent';
                        $is_show_pop_up = FALSE;
                    }
                    
                }
                    
                    
                ?>
                <?php $modern_product_cat_parent = get_term_by( 'slug', 'modern', 'product_cat' ); ?>
                <div class="dropdown-modern  <?php if($active_collection == 'modern_children' || $active_collection == 'modern_parent'): echo 'active'; endif; ?>">


                    <span>
                        <a <?php if( $active_collection == 'modern_parent'): echo 'class="active"'; endif; ?> href="<?php echo get_term_link( $modern_product_cat_parent );?>">Modern</a>
                        <button></button>
                        <?php if($where_to_show_new_collection_pop_up == 'modern' && $is_show_pop_up) {?>
                            <div class="dropdown-modern__popup custom-popup" style="display: none;">
                            <p>Checkout our new collection!</p>
                            <button class="new-popup-close-button">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.304 2.23484C10.7097 1.82912 10.7097 1.17355 10.304 0.767822C9.89823 0.362099 9.24266 0.362099 8.83693 0.767822L5.53613 4.06862L2.23533 0.767822C1.82961 0.362099 1.17403 0.362099 0.768311 0.767822C0.362587 1.17355 0.362587 1.82912 0.768311 2.23484L4.06911 5.53564L0.768311 8.83644C0.362588 9.24217 0.362588 9.89774 0.768311 10.3035C1.17403 10.7092 1.82961 10.7092 2.23533 10.3035L5.53613 7.00267L8.83693 10.3035C9.24266 10.7092 9.89823 10.7092 10.304 10.3035C10.7097 9.89774 10.7097 9.24217 10.304 8.83644L7.00316 5.53564L10.304 2.23484Z" fill="white" fill-opacity="0.5"/>
                                </svg>                  
                            </button>
                        </div>
                        <?php } ?>
                    </span>
                    <?php 
                    $modern_cat_args = array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'parent' => 0,
                        'parent'   => $modern_product_cat_parent->term_id,
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'meta_key' => 'is_new',
                    );
                    $modern_product_cats = get_terms( $modern_cat_args );
                    ?>
                    <ol <?php if($active_collection == 'modern_children' || $active_collection == 'modern_parent'): echo 'style="display:block;"'; endif; ?>>
                        <li>
                            <a id="<? echo $modern_product_cat_parent->term_id; ?>"<?php if( ($current_product_cat && $current_product_cat->term_id == $modern_product_cat_parent->term_id) || $collection_id == $modern_product_cat_parent->term_id): echo 'class="active_collection"'; endif; ?> href="<?php echo get_term_link( $modern_product_cat_parent );?>">All</a>
                        </li>
                        <?php foreach ($modern_product_cats as $modern_product_cat) {?>
                        <li>
                            <a id="<? echo $modern_product_cat->term_id; ?>" <?php if( ($current_product_cat && $current_product_cat->term_id == $modern_product_cat->term_id) || $collection_id == $modern_product_cat->term_id): echo 'class="active_collection"'; endif; ?>href="<?php echo get_term_link( $modern_product_cat );?>"><? echo $modern_product_cat->name; ?></a>
                            <?php if(get_field('is_new', $modern_product_cat)){ ?>
                                <span>NEW!</span>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    </ol>

                </div>
                <div class="dropdown-modern  <?php if($active_collection == 'classical_children' || $active_collection == 'classical_parent'): echo 'active'; endif; ?>">
                    <?php $classical_product_cat_parent = get_term_by( 'slug', 'classical', 'product_cat' ); ?>
                    <span>
                        <a <?php if( $active_collection == 'classical_parent'): echo 'class="active"'; endif; ?> href="<?php echo get_term_link( $classical_product_cat_parent );?>">Classical</a><button></button>
                        
                        <?php if($where_to_show_new_collection_pop_up == 'classical' && $is_show_pop_up) {?>

                        <div class="dropdown-modern__popup custom-popup" style="display: none;">
                            <p>Checkout our new collection!</p>
                            <button class="new-popup-close-button">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.304 2.23484C10.7097 1.82912 10.7097 1.17355 10.304 0.767822C9.89823 0.362099 9.24266 0.362099 8.83693 0.767822L5.53613 4.06862L2.23533 0.767822C1.82961 0.362099 1.17403 0.362099 0.768311 0.767822C0.362587 1.17355 0.362587 1.82912 0.768311 2.23484L4.06911 5.53564L0.768311 8.83644C0.362588 9.24217 0.362588 9.89774 0.768311 10.3035C1.17403 10.7092 1.82961 10.7092 2.23533 10.3035L5.53613 7.00267L8.83693 10.3035C9.24266 10.7092 9.89823 10.7092 10.304 10.3035C10.7097 9.89774 10.7097 9.24217 10.304 8.83644L7.00316 5.53564L10.304 2.23484Z" fill="white" fill-opacity="0.5"/>
                                </svg>                  
                            </button>
                        </div>
                        <?php } ?>

                    </span>

                    <?php 
                    $classical_cat_args = array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'parent' => 0,
                        'parent'   => $classical_product_cat_parent->term_id,
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'meta_key' => 'is_new',
                    );
                    $classical_product_cats = get_terms( $classical_cat_args );
                    ?>
                    <ol <?php if($active_collection == 'classical_children' || $active_collection == 'classical_parent'): echo 'style="display:block;"'; endif; ?>>
                    <li>
                        <a id="<? echo $classical_product_cat_parent->term_id; ?>" <?php if( ($current_product_cat && $current_product_cat->term_id == $classical_product_cat_parent->term_id) || $collection_id == $classical_product_cat_parent->term_id): echo 'class="active_collection"'; endif; ?>href="<?php echo get_term_link( $classical_product_cat_parent );?>">All</a>
                    </li>
                    <?php foreach ($classical_product_cats as $classical_product_cat) {?>
                        <li>
                            <a id="<? echo $classical_product_cat->term_id; ?>"<?php if( ($current_product_cat && $current_product_cat->term_id == $classical_product_cat->term_id) || $collection_id == $classical_product_cat->term_id): echo 'class="active_collection"'; endif; ?>href="<?php echo get_term_link( $classical_product_cat );?>"><? echo $classical_product_cat->name; ?></a>
                            <?php if(get_field('is_new', $classical_product_cat)){ ?>
                                <span>NEW!</span>
                            <?php } ?>
                        </li>
                        <?php 
                    } ?>
                    </ol>
                </div>
            </div>
            <div class="price-container">
                <div class="price-container__head">
                    <p class="ff-ms fs-4 fc-blue-2 fw-7 ta-start uppercase">Price</p>
                    <button id="price_filter_button_desktop" class="search-btn" type="button">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.7"
                        d="M13.8132 6.90524C13.8132 8.42904 13.3184 9.83664 12.485 10.9787L16.6887 15.1849C17.1038 15.5999 17.1038 16.2738 16.6887 16.6888C16.2736 17.1037 15.5996 17.1037 15.1845 16.6888L10.9808 12.4825C9.83857 13.3191 8.43069 13.8105 6.90659 13.8105C3.09136 13.8105 0 10.7197 0 6.90524C0 3.09076 3.09136 0 6.90659 0C10.7218 0 13.8132 3.09076 13.8132 6.90524ZM6.90659 11.6858C9.54636 11.6858 11.6881 9.5445 11.6881 6.90524C11.6881 4.26598 9.54636 2.12469 6.90659 2.12469C4.26681 2.12469 2.1251 4.26598 2.1251 6.90524C2.1251 9.5445 4.26681 11.6858 6.90659 11.6858Z"
                        fill="currentColor" />
                    </svg>
                    </button>
                </div>
                <div class="range">
                    <div class="range__slider">
                        <span class="range__selected"></span>
                    </div>
                    <div class="range__input">
                        <input type="range" class="min" min="<?php echo $min_price_default; ?>" max="<?php echo $max_price_default; ?>" value="<?php echo $min_price; ?>" step="10">
                        <input type="range" class="max" min="<?php echo $min_price_default; ?>" max="<?php echo $max_price_default; ?>" value="<?php echo $max_price; ?>" step="10">
                    </div>
                    <div class="range__price">
                        <label>$ <input id="min_price_desktop" type="number" name="min" value="<?php echo $min_price; ?>"></label>
                        <p>-</p>
                        <label>$ <input id="max_price_desktop" type="number" name="max" value="<?php echo $max_price; ?>"></label>
                    </div>
                </div>
            </div>
            <div class="categories-container">
                <h4 class="ff-ms fs-4 fc-blue-2 fw-7 my-1">Categories</h4>
                <ul class="link-category-list" id="filter-products-desktop"> 
                    <?php
                    $category_waiting = get_term_by( 'slug', 'waiting', 'product_cat' );
                    $category_collections = get_term_by( 'slug', 'collections', 'product_cat' );
                    
                    $cat_args = array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'exclude'  => array($category_waiting->term_id, $category_collections->term_id),
                        'parent' => 0,
                    );
                    $product_cats = get_terms( $cat_args );
                    foreach ($product_cats as $product_cat) { ?>

                        <li>
                        <div class="link-category-div">
                            <a class="link-category <?php if($current_product_cat && ($current_product_cat->term_id == $product_cat->term_id || wp_get_term_taxonomy_parent_id( $current_product_cat->term_id, 'product_cat') == $product_cat->term_id)) : echo 'active'; endif;?>" value="desktop_<?php echo $product_cat->term_id; ?>"></a>
                            <a class="ff-ms fs-5 ta-center category-label" href = "<?php echo get_term_link( $product_cat );?>" ><? echo $product_cat->name; ?></a>
                        
                        </div>
                        <?php
                            $parent_product_cat = get_term_by( 'id', $product_cat->term_id, 'product_cat' );
                            if(!empty($place_types)){
                                $cat_args1 = array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => true,
                                        'parent'   => $parent_product_cat->term_id,
                                        'include'  => $place_types
                                    );
                                $child_product_cats1 = get_terms( $cat_args1 );
                            }
                            
                            ?>
                            <ol class="link-category-list <?php if(($current_product_cat && ($current_product_cat->term_id == $product_cat->term_id || wp_get_term_taxonomy_parent_id( $current_product_cat->term_id, 'product_cat') == $product_cat->term_id) ) || !empty($child_product_cats1) || in_array($product_cat->term_id ,$place_types )) : echo 'active'; endif;?>" id="desktop_<?php echo $product_cat->term_id; ?>">
                                <?php
                                    $cat_args = array(
                                                'taxonomy' => 'product_cat',
                                                'hide_empty' => true,
                                                'parent'   => $parent_product_cat->term_id
                                            );
                                    $child_product_cats = get_terms( $cat_args );
                                    ?>
                                    <li class="form-filter">
                                        <label><input type="checkbox" name="place-type" value="<?php echo $parent_product_cat->term_id; ?>" <?php if(in_array($parent_product_cat->term_id ,$place_types ) || ($current_product_cat  && $current_product_cat->term_id == $parent_product_cat->term_id)): echo 'checked';endif; ?>></label><a class="label" href = "<?php echo get_term_link( $parent_product_cat );?>">All types</a>
                                    </li>
                                    <?php
                                    foreach ($child_product_cats as $child_product_cat) { ?>

                                        <li class="form-filter">
                                            <label><input type="checkbox" name="place-type" value="<?php echo $child_product_cat->term_id; ?>" <?php if(in_array($child_product_cat->term_id ,$place_types ) || ($current_product_cat  && $current_product_cat->term_id == $child_product_cat->term_id)): echo 'checked';endif; ?> ></label><a class="label" href = "<?php echo get_term_link( $child_product_cat );?>"><? echo $child_product_cat->name; ?></a>
                                        </li>
                                    
                                    <?php } 
                                ?>
                            </ol>
                        </li>
                    
                    <?php } ?>

                    <li class="form-checkbox">
                        <label><input type="checkbox" name="sale" <?php if($sale == 'true'): echo 'checked'; endif;?>>Sale</label>
                    </li>
                </ul>
            </div>
        </aside>
        <section>
            <div class="breadcrumb my-2">
                <div class="breadcrumb__item"><a href="<?php echo home_url();?>" class="link">Home</a></div>
                <div class="breadcrumb__item"><a href="<?php echo $shop_page_url ?>" class="link">Catalog</a></div>
            </div>
            <article>
                <section class="d-flex jc-between g-1 jc-sm-end px-2">
                    <div class="dropdown d-sm-none">
                        <div class="dropdown__trigger filter">Filter</div>
                        <div class="dropdown__content filter__content">
                            <div class="collections-container">
                                <p class="ff-ms fs-4 fc-blue-2 fw-7 ta-start uppercase">Collections</p>
                                <div class="dropdown-modern">
                                    <?php $modern_product_cat_parent = get_term_by( 'slug', 'modern', 'product_cat' ); ?>
                                    <span>
                                        <a href="<?php echo get_term_link( $modern_product_cat_parent );?>">Modern</a><button></button>
                                        
                                    </span>
                                    <?php 
                                    $modern_cat_args = array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => true,
                                        'parent' => 0,
                                        'parent'   => $modern_product_cat_parent->term_id,
                                        'orderby' => 'meta_value_num',
                                        'order' => 'DESC',
                                        'meta_key' => 'is_new',
                                    );
                                    $modern_product_cats = get_terms( $modern_cat_args );
                                    ?>
                                    <ol>
                                        <li>
                                            <a id="<? echo $modern_product_cat_parent->term_id; ?>"<?php if( ($current_product_cat && $current_product_cat->term_id == $modern_product_cat_parent->term_id) || $collection_id == $modern_product_cat_parent->term_id): echo 'class="active_collection"'; endif; ?> href="<?php echo get_term_link( $modern_product_cat_parent );?>">All</a>
                                        </li>
                                        <?php foreach ($modern_product_cats as $modern_product_cat) {?>
                                        <li>
                                            <a id="<? echo $modern_product_cat->term_id; ?>" <?php if( ($current_product_cat && $current_product_cat->term_id == $modern_product_cat->term_id) || $collection_id == $modern_product_cat->term_id): echo 'class="active_collection"'; endif; ?>href="<?php echo get_term_link( $modern_product_cat );?>"><? echo $modern_product_cat->name; ?></a>
                                            <?php if(get_field('is_new', $modern_product_cat)){ ?>
                                                <span>NEW!</span>
                                            <?php } ?>
                                        </li>
                                        <?php } ?>
                                    </ol>

                                </div>
                                <div class="dropdown-modern">
                                    <?php $classical_product_cat_parent = get_term_by( 'slug', 'classical', 'product_cat' ); ?>
                                    <span>
                                        <a href="<?php echo get_term_link( $classical_product_cat_parent );?>">Classical</a><button></button>
                                        
                                    </span>

                                    <?php 
                                    $classical_cat_args = array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => true,
                                        'parent' => 0,
                                        'parent'   => $classical_product_cat_parent->term_id,
                                        'orderby' => 'meta_value_num',
                                        'order' => 'DESC',
                                        'meta_key' => 'is_new',
                                    );
                                    $classical_product_cats = get_terms( $classical_cat_args );
                                    ?>
                                    <ol>
                                        <li>
                                            <a id="<? echo $classical_product_cat_parent->term_id; ?>" <?php if( ($current_product_cat && $current_product_cat->term_id == $classical_product_cat_parent->term_id) || $collection_id == $classical_product_cat_parent->term_id): echo 'class="active_collection"'; endif; ?>href="<?php echo get_term_link( $classical_product_cat_parent );?>">All</a>
                                        </li>
                                        <?php foreach ($classical_product_cats as $classical_product_cat) {?>
                                            <li>
                                                <a id="<? echo $classical_product_cat->term_id; ?>"<?php if( ($current_product_cat && $current_product_cat->term_id == $classical_product_cat->term_id) || $collection_id == $classical_product_cat->term_id): echo 'class="active_collection"'; endif; ?>href="<?php echo get_term_link( $classical_product_cat );?>"><? echo $classical_product_cat->name; ?></a>
                                                <?php if(get_field('is_new', $classical_product_cat)){ ?>
                                                    <span>NEW!</span>
                                                <?php } ?>
                                            </li>
                                            <?php 
                                        } ?>
                                    </ol>
                                </div>
                            </div>
                            <div class="price-container">
                                <div class="price-container__head">
                                    <p class="ff-ms fs-4 fc-blue-2 fw-7 ta-start uppercase">Price</p>
                                    <button id="price_filter_button_mobile"class="search-btn" type="button">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.7"
                                        d="M13.8132 6.90524C13.8132 8.42904 13.3184 9.83664 12.485 10.9787L16.6887 15.1849C17.1038 15.5999 17.1038 16.2738 16.6887 16.6888C16.2736 17.1037 15.5996 17.1037 15.1845 16.6888L10.9808 12.4825C9.83857 13.3191 8.43069 13.8105 6.90659 13.8105C3.09136 13.8105 0 10.7197 0 6.90524C0 3.09076 3.09136 0 6.90659 0C10.7218 0 13.8132 3.09076 13.8132 6.90524ZM6.90659 11.6858C9.54636 11.6858 11.6881 9.5445 11.6881 6.90524C11.6881 4.26598 9.54636 2.12469 6.90659 2.12469C4.26681 2.12469 2.1251 4.26598 2.1251 6.90524C2.1251 9.5445 4.26681 11.6858 6.90659 11.6858Z"
                                        fill="currentColor" />
                                    </svg>
                                    </button>
                                </div>
                                <div class="range">
                                    <div class="range__slider">
                                        <span class="range__selected"></span>
                                    </div>
                                    <div class="range__input">
                                        <input type="range" class="min" min="<?php echo $min_price_default; ?>" max="<?php echo $max_price_default; ?>" value="<?php echo $min_price; ?>" step="10">
                                        <input type="range" class="max" min="<?php echo $min_price_default; ?>" max="<?php echo $max_price_default; ?>" value="<?php echo $max_price; ?>" step="10">
                                    </div>
                                    <div class="range__price">
                                        <label>$ <input id="min_price_mobile" type="number" name="min" value="<?php echo $min_price; ?>"></label>
                                        <p>-</p>
                                        <label>$ <input id="max_price_mobile" type="number" name="max" value="<?php echo $max_price; ?>"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="categories-container">
                                <p class="ff-ms fs-4 fc-blue-2 fw-7 ta-start uppercase">Categories</p>
                                <ul class="link-category-list" id="filter-products-mobile">
                                <?php
                                $category_waiting = get_term_by( 'slug', 'waiting', 'product_cat' );
                                $category_collections = get_term_by( 'slug', 'collections', 'product_cat' );
                                
                                $cat_args = array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'exclude'  => array($category_waiting->term_id, $category_collections->term_id),
                                    'parent' => 0,
                                );
                                $product_cats = get_terms( $cat_args );
                                foreach ($product_cats as $product_cat) { ?>

                                    <li>
                                        <div class="link-category-div ff-ms fs-5 ta-center">
                                            <a class="link-category  <?php if($current_product_cat && ($current_product_cat->term_id == $product_cat->term_id || wp_get_term_taxonomy_parent_id( $current_product_cat->term_id, 'product_cat') == $product_cat->term_id)) : echo 'active'; endif;?>" value="mobile_<?php echo $product_cat->term_id; ?>"></a>
                                            <a class=" category-label" href = "<?php echo get_term_link( $product_cat );?>" ><? echo $product_cat->name; ?></a>
                                        </div>
                                        <?php
                                        $parent_product_cat = get_term_by( 'id', $product_cat->term_id, 'product_cat' );
                                        if(!empty($place_types)){
                                            $cat_args1 = array(
                                                    'taxonomy' => 'product_cat',
                                                    'hide_empty' => true,
                                                    'parent'   => $parent_product_cat->term_id,
                                                    'include'  => $place_types
                                                );
                                            $child_product_cats1 = get_terms( $cat_args1 );
                                        }
                                        ?>
                                        <ol class="link-category-list <?php if(($current_product_cat && ($current_product_cat->term_id == $product_cat->term_id || wp_get_term_taxonomy_parent_id( $current_product_cat->term_id, 'product_cat') == $product_cat->term_id) ) || !empty($child_product_cats1) || in_array($product_cat->term_id ,$place_types )) : echo 'active'; endif;?>"  id="mobile_<?php echo $product_cat->term_id; ?>">
                                            <?php
                                                $cat_args = array(
                                                            'taxonomy' => 'product_cat',
                                                            'hide_empty' => true,
                                                            'parent'   => $parent_product_cat->term_id
                                                        );
                                                $child_product_cats = get_terms( $cat_args );
                                            ?>
                                            <li class="form-filter">
                                                <label><input type="checkbox" name="place-type" value="<?php echo $parent_product_cat->term_id; ?>" <?php if(in_array($parent_product_cat->term_id ,$place_types ) || ($current_product_cat  && $current_product_cat->term_id == $parent_product_cat->term_id)): echo 'checked';endif; ?>></label><a class="label" href = "<?php echo get_term_link( $parent_product_cat );?>">All types</a>                                
                                            </li>
                                            <?php
                                            foreach ($child_product_cats as $child_product_cat) { ?>

                                                <li class="form-filter">
                                                    <label><input type="checkbox" name="place-type" value="<?php echo $child_product_cat->term_id; ?>" <?php if(in_array($child_product_cat->term_id ,$place_types ) || ($current_product_cat  && $current_product_cat->term_id == $child_product_cat->term_id)): echo 'checked';endif; ?> ></label><a class="label" href = "<?php echo get_term_link( $child_product_cat );?>"><? echo $child_product_cat->name; ?></a>
                                                </li>
                                
                                            <?php } ?>
                                        </ol>
                                    </li>
                
                                <?php } ?>

                                    <li class="form-checkbox">
                                        <label><input type="checkbox" name="sale" <?php if($sale == 'true'): echo 'checked'; endif;?>>Sale</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown__trigger sort">Sort by: <?php 
                            if($sort=='rating'){
                                echo "rating";
                            }elseif($sort=='date'){
                                echo "date";
                            }elseif($sort=='price'){
                                echo "price: low to high";
                            }elseif($sort=='price-desc'){
                                echo "price: high to low";
                            }else{
                                echo "popularity";
                            }
                                ?></div>
                        <div class="dropdown__content">
                            <!-- <p id="current_sort" class="link"></p> -->
                            <ul id="sort_product">
                                <li><a value="popularity" class="link">popularity</a></li>
                                <li><a value="rating" class="link">rating</a></li>
                                <li><a value="date" class="link">date</a></li>
                                <li><a value="price" class="link">price: low to high</a></li>
                                <li><a value="price-desc" class="link">price: high to low</a></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <section class="grid-container py-2" id="products-loop">
                    <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                        'posts_per_page' => $posts_per_page,
                        'post_type'      => 'product',
                        'paged'          => $paged,
                        's'             => $_GET['s'],
                        
                        'tax_query' => array(
                            'relation' => 'AND',
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'slug',
                                    'terms'    => array( 'waiting', 'uncategorized' ),
                                    'operator' => 'NOT IN',
                                ),
                        ),
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => '_price',
                                'value' => array($min_price, $max_price),
                                'compare' => 'BETWEEN',
                                'type' => 'NUMERIC'
                                ),
                            ),
                    );
                    // if(!empty($item_types)){
                    //     $args['tax_query'][] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $item_types);
                    // }
                    // if(!empty($brands)){
                    //     $args['tax_query'][] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $brands);
                    // }
                    // $place_types_and_collections = array_merge($collections, $place_types);
                    // if(!empty($place_types_and_collections)){
                    //     $args['tax_query'][] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $place_types_and_collections);
                    // }
                    
                    if(!empty($place_types)){
                        $args['tax_query'][] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $place_types);
                    }
                    if($collection_id != 0){
                        $args['tax_query'][] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $collection_id);
                    }
                    if($current_product_cat){
                        $args['tax_query'][] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $current_product_cat->term_id);
                    }
                    if($sale == 'true'){
                        $on_sale_products = wc_get_product_ids_on_sale();
                        if(count($on_sale_products) == 0){
                            $args['post__in'] =  ['-1'];
                        }else{
                            $args['post__in'] =  wc_get_product_ids_on_sale();
                        } 
                    }
                    if($sort == 'rating'){
                        // $args['meta_query']= array(
                        //     'relation' => 'OR',
                        //     array(
                        //         'key'     => '_wc_average_rating',
                        //         'value'   => '',
                        //         'compare' => 'NOT EXISTS'
                        //     ),
                        //     array(
                        //         'key'     => '_wc_average_rating',
                        //         'compare' => 'EXISTS'
                        //     )
                        // ); 
                        
                        // $args['orderby'] = 'meta_value_num';
                        // $args['order'] = 'DESC';
                        // $args['meta_key'] = '_wc_average_rating';

                        $args['meta_query'][] = array(
                            'relation' => 'AND',
                            'raiting' => array(
                                'key'     => '_wc_average_rating',
                                'compare' => 'EXISTS', 
                            ),
                            'status' => array(
                                'key' => '_stock_status',
                                'compare' => 'EXISTS',
                            ),
                            
                        );
                        $args['orderby'] = array(
                            'status' => 'ASC',
                            'raiting' =>'DESC',
                        );
                    }
                    elseif($sort == 'date'){
                        // $args['orderby'] = 'date';
                        // $args['order'] = 'desc';
                        $args['meta_key'] = '_stock_status';
                        $args['orderby'] = array(
                            'meta_value' => 'ASC',
                            'date' => 'DESC',
                        );
                    }
                    elseif($sort == 'price'){
                        // $args['orderby'] = 'meta_value_num';
                        // $args['meta_key'] = '_price';
                        // $args['order'] = 'asc';
                        $args['meta_query'][] = array(
                            'relation' => 'AND',
                            'price' => array(
                                'key'     => '_price',
                                'compare' => 'EXISTS', 
                                'type' => 'NUMERIC',
                            ),
                            'status' => array(
                                'key' => '_stock_status',
                                'compare' => 'EXISTS',
                            ),
                            
                        );
                        $args['orderby'] = array(
                            'status' => 'ASC',
                            'price' =>'ASC',
                        );
                        
                    }
                    elseif($sort == 'price-desc'){
                        // $args['orderby'] = 'meta_value_num';
                        // $args['meta_key'] = '_price';
                        // $args['order'] = 'desc';
                        $args['meta_query'][] = array(
                            'relation' => 'AND',
                            'price' => array(
                                'key'     => '_price',
                                'compare' => 'EXISTS', 
                                'type' => 'NUMERIC',
                            ),
                            'status' => array(
                                'key' => '_stock_status',
                                'compare' => 'EXISTS',
                            ),
                            
                        );
                        $args['orderby'] = array(
                            'status' => 'ASC',
                            'price' =>'DESC',
                        );
                        
                    }
                    else{
                        // $args['orderby'] = 'popularity';
                        // $args['order'] = 'desc';
                        $args['meta_key'] = '_stock_status';
                        $args['orderby'] = array(
                            'meta_value' => 'ASC',
                            'popularity' => 'DESC',
                        );
                       
                    }
                    $products = new WP_Query( $args );

                    while ( $products->have_posts() ) : $products->the_post();
                        global $product;
                        $product_id = $product->get_id();
                        $product_name = $product->get_name();
                        $product_url = get_permalink( $product_id );
                        $product_thumbnail = $product->get_image();
                        $product_rating = $product->get_average_rating();
                        $product_price = $product->get_price_html();
                        $terms = get_the_terms( $product_id, 'product_cat' );
                        $product_cart_id = WC()->cart->generate_cart_id( $product_id );
                        $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );
                        $stock_status = $product->get_stock_status();
                        ?>

                        <div class="grid-item-shop <?php if($stock_status == 'outofstock'): echo 'outofstock_shop_item'; endif;?>">
                            <div class="grid-item-shop__header changing-color-item">
                                <figure>
                                    <a href="<?php echo $product_url?>">
                                        <?php if ($product->is_on_sale()) {?>
                                            <span class="onsale">Sale!</span>
                                        <?php }?>
                                        <?php echo $product_thumbnail ?>
                                    </a>
                                </figure>
                            </div>
                            <a href="<?php echo $product_url?>">
                                <p class="ff-ms fs-5 fg-1 product_name"><?php echo $product_name ?></p>
                            </a>
                            <?php if($stock_status == 'outofstock'):?>
                                <p class="ff-ms fs-5 fg-1 outofstock_text">Out of stock</p>
                            <?php endif;?>
                            
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
                                <p class="grid-item-shop__price ff-ms m-0 <?php if($stock_status == 'outofstock'): echo 'outofstock_shop_item_price'; endif;?>" ><?php echo $product_price ?></p>
                                <?php
                                if ( $product->is_type( 'variable' ) ) {
                                    if( in_array( $product_id, array_column( WC()->cart->get_cart(), 'product_id' ) ) ) {?>
                                        <div class="grid-item-shop__buttons colorful_add_to_cart"><a href="<?php echo $product_url ?>" class="link fs-3"><i class="icon-cart-icon active"></i></a></div>
                                    <?php }else{?>
                                        <div class="grid-item-shop__buttons"><a href="<?php echo $product_url ?>" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                                    <?php }
                                }else{?>
                                        <form class="cart without-variation-cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                                            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                                            <?php
                                            do_action( 'woocommerce_before_add_to_cart_quantity' );

                                            woocommerce_quantity_input(
                                                array(
                                                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                                                )
                                            );

                                            do_action( 'woocommerce_after_add_to_cart_quantity' );
                                            if ( $in_cart ) {?>
                                                <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="related_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><a  class="link fs-3"><i class="icon-cart-icon active"></i></a></button>
                                            <?php }else{?>
                                                <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="related_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><a  class="link fs-3"><i class="icon-cart-icon"></i></a></button>
                                                <?php }?>
                                                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                                        </form>
                                    <?php }?>
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
            <div id="posts_per_page_select" class="posts_per_page_select posts_per_page_select-desktop">
                <p>Per page:</p>
                <?php foreach($posts_per_page_veriants as $variant):?>
                    <a value="<?php echo $variant; ?>" <?php if($variant == $posts_per_page): echo 'class="current"'; endif; ?>><?php echo $variant; ?></a>
                <?php endforeach; ?> 
            </div>
            <?php
            $total= $products -> max_num_pages;
            $previous_posts_link = previous_posts(false);
            $next_posts_link = next_posts( $total, false);
            if($total == 0){
                $total = 1;
            }
            ?>
            
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
                <?php 
                $big = 999999999;
                if( $total> 1  )  {
                    $paginate_links = paginate_links(array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => 'page/%#%/',
                        'current'    => max( 1, get_query_var('paged') ),
                        'total'     => $total,
                        'mid_size'    => 3,
                        'type'       => 'plain',
                        'prev_next' => false,
                    ) );
                
            ?>   
            <div class="page-number page-number-mobile">
                <div><?php  echo $paginate_links; ?></div>
            </div>
            <?php } ?>
                <?php if($next_posts_link && $paged!=$total):?>
                    <a href="<?php echo $next_posts_link; ?>" class="link fs-3" aria-label="back">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php else :?>
                    <a class="link fs-3 disabled" aria-label="back">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php endif;?>
            </div>
            <?php 
                $big = 999999999;
                if( $total> 1  )  {
                    $paginate_links = paginate_links(array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => 'page/%#%/',
                        'current'    => max( 1, get_query_var('paged') ),
                        'total'     => $total,
                        'mid_size'    => 3,
                        'type'       => 'plain',
                        'prev_next' => false,
                    ) );
                
            ?>   
            <div class="page-number page-number-desktop">
                <div><?php  echo $paginate_links; ?></div>
            </div>
            <?php } ?>
            <div id="posts_per_page_select" class="posts_per_page_select posts_per_page_select-mobile">
                <p>Per page:</p>
                <?php foreach($posts_per_page_veriants as $variant):?>
                    <a value="<?php echo $variant; ?>" <?php if($variant == $posts_per_page): echo 'class="current"'; endif; ?>><?php echo $variant; ?></a>
                <?php endforeach; ?> 
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
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default_img.png" alt="item image">                                        <?php endif;?>
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


    }
}
?>

