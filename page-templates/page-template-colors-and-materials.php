<?php
/**
 * Template Name: Colors and materials
 * 
 * The main template file
 *
 * @package Sibosfurniture
 */

get_header();
?>

<main>
        <article class="hero">
            <div class="hero__left">
                <h1>Colors<br>and<br>materials</h1>
            </div>
            <div class="hero__right"><span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span></div>
        </article>
        <article class="materials px-2 px-sm-4">
            <h2>Premium quality<br>materials</h2>
            <p>Forem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum
                velit, sit amet feugiat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus
                nisl, eu tempor urna. Curabitur vel bibendum lorem. Morbi convallis convallis diam sit amet lacinia. Aliquam in elementum tellus. Curabitur tempor quis eros tempus lacinia. Nam bibendum pellentesque quam a convallis. Sed ut vulputate nisi.
                Integer in felis sed leo vestibulum venenatis. Suspendisse quis arcu sem. Aenean feugiat ex eu vestibulum vestibulum. Morbi a eleifend magna. Nam metus lacus, porttitor eu mauris a, blandit ultrices nibh. Mauris sit amet magna non ligula
                vestibulum eleifend. Nulla varius volutpat turpis sed lacinia. Nam eget mi in purus lobortis eleifend. Sed nec ante dictum sem condimentum ullamcorper quis venenatis nisi. Proin vitae facilisis nisi, ac posuere leo.</p>
            <div class="grid-container">
            <?php 
               $materials = new WP_Query( array(
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'post_type' => 'material',
                    )
                );  
            ?>
            <?php if ( $materials->have_posts() ):
                while ( $materials->have_posts() ) : $materials->the_post(); ?>
                    <article class="material-item">
                    <figure><img src="<?php the_post_thumbnail_url();?>" alt="material item">
                        <figcaption><?php the_title();?></figcaption>
                    </figure>
                </article>
            <?php 
            endwhile; 
                ?>
                        
            <?php wp_reset_postdata();
            endif;
            ?>
            </div>
        </article>
        <article class="colors px-2 px-sm-4">
            <h2>Colors</h2><q class="mb-3">There are no limitations in color, you can type you favorite and desire one in your notes for the item while making the order.</q>
            <div class="grid-colors">
                <?php 
                $color_categories = get_terms( array(
                    'taxonomy' => 'color_category',
                    'hide_empty' => true,
                ) );
                ?>
                <?php if ( !empty($color_categories) ) :
	                foreach( $color_categories as $category ) :?>
                
                <div class="grid-colors__row">
                    <h3><?php echo $category->name;?></h3>
                    <div class="grid-colors__body active">

                        <?php
                        $colors = new WP_Query( array(
                            'posts_per_page' => -1,
                            'post_type' => 'color',
                            'tax_query' => array(
                            array(
                                'taxonomy' => 'color_category',
                                'field' => 'term_id', 
                                'terms' => $category->term_id, 
                                'include_children' => false
                            )
                            )
                        ));
                        
                        ?>
                        <?php if ( $colors->have_posts() ):
                            while ( $colors->have_posts() ) : $colors->the_post(); ?>
                            <div class="grid-colors__item"><span style="background-color: <?php the_title();?>;"></span>
                                <p><?php the_title();?></p>
                            </div>
                        <?php 
                        endwhile; 
                            ?>
                                    
                        <?php wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
                <?php endforeach;
                endif;
                ?>
            </div>
        </article>
    <article class="px-3 px-sm-4 bg-blue-5 related products">
        <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
        <?php get_template_part('template-parts/content', 'popular-products');?>
    </article>    </main>
<?php get_footer();?>
