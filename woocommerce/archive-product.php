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
if (isset($_GET['collections'])) {
    $collections = json_decode(urldecode($_GET['collections']), true);
} else {
    $collections = [];
}
if (isset($_GET['item_types'])) {
    $item_types = json_decode(urldecode($_GET['item_types']), true);
} else {
    $item_types = [];
}
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
    $sort = '';
}

?>
<main class="header-padding">
    <article class="catalog px-2 px-md-4 pt-2">
        <aside  >
            <h4 class="ff-ms fs-4 fc-blue-2 fw-7 my-1">Categories</h4>
            <ul class="link-category-list" id="filter-products-desktop"> 
                <li>    
                    <a class="link-category ff-ms fs-5 fc-blue-2 ta-center">Collections</a>
                        <ol class="link-category-list">
                            <?php
                                $parent_product_cat = get_term_by( 'slug', 'collection', 'product_cat' );
                                $cat_args = array(
                                            'taxonomy' => 'product_cat',
                                            'hide_empty' => true,
                                            'parent'   => $parent_product_cat->term_id
                                        );
                                $child_product_cats = get_terms( $cat_args );
                                foreach ($child_product_cats as $child_product_cat) { ?>

                                    <li class="form-filter">
                                        
                                            <label><input type="checkbox" name="<?php echo $parent_product_cat->slug; ?>" value="<?php echo $child_product_cat->term_id; ?>" <?php if(in_array($child_product_cat->term_id ,$collections )): echo 'checked';endif; ?> ><? echo $child_product_cat->name; ?></label>
                                        
                                    </li>
                                
                                <?php } 
                            ?>
                        </ol>
                </li>
                <li>
                    <a class="link-category ff-ms fs-5 fc-blue-2 ta-center">Item types</a>
                    <ol class="link-category-list">
                        <?php
                            $parent_product_cat = get_term_by( 'slug', 'item-type', 'product_cat' );
                            $cat_args = array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => true,
                                        'parent'   => $parent_product_cat->term_id
                                    );
                            $child_product_cats = get_terms( $cat_args );
                            foreach ($child_product_cats as $child_product_cat) { ?>

                                <li class="form-filter">
                                    <label><input type="checkbox" name="<?php echo $parent_product_cat->slug; ?>" value="<?php echo $child_product_cat->term_id; ?>" <?php if(in_array($child_product_cat->term_id ,$item_types )): echo 'checked';endif; ?> ><? echo $child_product_cat->name; ?></label>
                                </li>
                            
                            <?php } 
                        ?>
                    </ol>
                </li>
                <li>
                    <a class="link-category ff-ms fs-5 fc-blue-2 ta-center">Place types</a>
                    <ol class="link-category-list">
                        <?php
                            $parent_product_cat = get_term_by( 'slug', 'place-type', 'product_cat' );
                            $cat_args = array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => true,
                                        'parent'   => $parent_product_cat->term_id
                                    );
                            $child_product_cats = get_terms( $cat_args );
                            foreach ($child_product_cats as $child_product_cat) { ?>

                                <li class="form-filter">
                                    <label><input type="checkbox" name="<?php echo $parent_product_cat->slug; ?>" value="<?php echo $child_product_cat->term_id; ?>" <?php if(in_array($child_product_cat->term_id ,$place_types )): echo 'checked';endif; ?> ><? echo $child_product_cat->name; ?></label>
                                </li>
                            
                            <?php } 
                        ?>
                    </ol>
                </li>           
                <li class="form-checkbox">
                    <label><input type="checkbox" name="sale" <?php if($sale == 'true'): echo 'checked'; endif;?>>Sale</label>
                </li>
            </ul>
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
                        <ul class="link-category-list" id="filter-products-mobile">
                            <li>    
                                <a class="link-category ff-ms fc-blue-2 ta-center">Collections</a>
                                <ol class="link-category-list">
                                    <?php
                                        $parent_product_cat = get_term_by( 'slug', 'collection', 'product_cat' );
                                        $cat_args = array(
                                                    'taxonomy' => 'product_cat',
                                                    'hide_empty' => true,
                                                    'parent'   => $parent_product_cat->term_id
                                                );
                                        $child_product_cats = get_terms( $cat_args );
                                        foreach ($child_product_cats as $child_product_cat) { ?>

                                            <li class="form-filter">
                                                <label><input type="checkbox" name="<?php echo $parent_product_cat->slug; ?>" value="<?php echo $child_product_cat->term_id; ?>" <?php if(in_array($child_product_cat->term_id ,$collections )): echo 'checked';endif; ?> ><? echo $child_product_cat->name; ?></label>
                                            </li>
                                        
                                        <?php } 
                                    ?>
                                </ol>
                            </li>
                            <li>
                                <a class="link-category ff-ms  fc-blue-2 ta-center">Item types</a>
                                <ol class="link-category-list">
                                    <?php
                                        $parent_product_cat = get_term_by( 'slug', 'item-type', 'product_cat' );
                                        $cat_args = array(
                                                    'taxonomy' => 'product_cat',
                                                    'hide_empty' => true,
                                                    'parent'   => $parent_product_cat->term_id
                                                );
                                        $child_product_cats = get_terms( $cat_args );
                                        foreach ($child_product_cats as $child_product_cat) { ?>

                                            <li class="form-filter">
                                                <label><input type="checkbox" name="<?php echo $parent_product_cat->slug; ?>" value="<?php echo $child_product_cat->term_id; ?>" <?php if(in_array($child_product_cat->term_id ,$item_types )): echo 'checked';endif; ?> ><? echo $child_product_cat->name; ?></label>
                                            </li>
                                        
                                        <?php } 
                                    ?>
                                </ol>
                            </li>
                            <li>
                                <a class="link-category ff-ms  fc-blue-2 ta-center">Place types</a>
                                <ol class="link-category-list">
                                    <?php
                                        $parent_product_cat = get_term_by( 'slug', 'place-type', 'product_cat' );
                                        $cat_args = array(
                                                    'taxonomy' => 'product_cat',
                                                    'hide_empty' => true,
                                                    'parent'   => $parent_product_cat->term_id
                                                );
                                        $child_product_cats = get_terms( $cat_args );
                                        foreach ($child_product_cats as $child_product_cat) { ?>

                                            <li class="form-filter">
                                                <label><input type="checkbox" name="<?php echo $parent_product_cat->slug; ?>" value="<?php echo $child_product_cat->term_id; ?>" <?php if(in_array($child_product_cat->term_id ,$place_types )): echo 'checked';endif; ?> ><? echo $child_product_cat->name; ?></label>
                                            </li>
                                        
                                        <?php } 
                                    ?>
                                </ol>
                            </li>           
                            <li class="form-checkbox">
                                <label><input type="checkbox" name="sale" <?php if($sale == 'true'): echo 'checked'; endif;?>>Sale</label>
                            </li>
                        </ul>
                        </div>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown__trigger sort">Sort by</div>
                        <div class="dropdown__content">
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
                        'posts_per_page' => 12,
                        'post_type'      => 'product',
                        'paged'          => $paged,
//                        'meta_key' => 'views_total',
                        // 'orderby' => 'popularity',
                        // 'order' => 'DESC',
                        'tax_query' => array(
                            'relation' => 'AND',
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'slug',
                                    'terms'    => array( 'waiting', 'uncategorized' ),
                                    'operator' => 'NOT IN',
                                ),
                        ),
                       
                    );
                    if(!empty($item_types)){
                        $args['tax_query'][] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $item_types);
                    }
                    $place_types_and_collections = array_merge($collections, $place_types);
                    if(!empty($place_types_and_collections)){
                        $args['tax_query'][] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $place_types_and_collections);
                    }
                    if($sale == 'true'){
                        $args['post__in'] =  wc_get_product_ids_on_sale();
                    }
                    if($sort == 'rating'){
                        
                        $args['meta_query']= array(
                            'relation' => 'OR',
                            array(
                                'key'     => '_wc_average_rating',
                                'value'   => '',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key'     => '_wc_average_rating',
                                'compare' => 'EXISTS'
                            )
                        ); 
                        
                        $args['orderby'] = 'meta_value_num';
                        $args['order'] = 'DESC';
                        $args['meta_key'] = '_wc_average_rating';

                    }elseif($sort == 'date'){
                        $args['orderby'] = 'date';
                        $args['order'] = 'desc';
                    }elseif($sort == 'price'){
                        $args['orderby'] = 'meta_value_num';
                        $args['meta_key'] = '_price';
                        $args['order'] = 'asc';
                    }
                    elseif($sort == 'price-desc'){
                        $args['orderby'] = 'meta_value_num';
                        $args['meta_key'] = '_price';
                        $args['order'] = 'desc';
                    }
                    else{
                        $args['orderby'] = 'popularity';
                        $args['order'] = 'desc';
                    }
                    $products = new WP_Query( $args );
//                    $products = $products->get_products();
                    while ( $products->have_posts() ) : $products->the_post();
                        global $product;
                        $product_id = $product->get_id();
                        $product_name = $product->get_name();
                        $product_url = get_permalink( $product_id );
                        $product_thumbnail = $product->get_image();
                        $product_rating = $product->get_average_rating();
                        $product_price = $product->get_price_html();
                        $terms = get_the_terms( $product_id, 'product_cat' );?>
                        <div class="grid-item-shop">
                            <?php
                            //  foreach($terms as $term){
                            //     echo '<p>'.$term->name.'</p>';
                            // }
                            ?>
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
