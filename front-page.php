<?php
/**
 * The main template file
 *
 * @package Sibosfurniture
 */

get_header();
?>
<main>
    <article class="swiper-full-height">
        <!-- <menu class="swiper-menu">
            <li><a href="shop-page.html" class="link sm">Living room</a></li>
            <li><a href="shop-page.html" class="link sm">Bedroom</a></li>
            <li><a href="shop-page.html" class="link sm">Dinning room</a></li>
            <li><a href="shop-page.html" class="link sm">Accent furniture</a></li>
            <li><a href="shop-page.html" class="link sm">Office</a></li>
            <li><a href="shop-page.html" class="link sm">Outdoor</a></li>
            <li><a href="shop-page.html" class="link sm">Sale</a></li>
        </menu> -->
        <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'home-page-menu',
                    'menu_id'        => 'home-page-menu',
                    'container'            => '',
                    'container_class'      => '',
                    'container_id'         => '',
                    'container_aria_label' => '',
                    'menu_class'           => '',
                    'menu_id'              => '',
                    'echo'                 => true,
                    'fallback_cb'          => 'wp_page_menu',
                    'before'               => '',
                    'after'                => '',
                    'link_before'          => '',
                    'link_after'           => '',
                    'items_wrap'           => '<menu class=" swiper-menu %2$s">%3$s</menu>',
                    'item_spacing'         => 'preserve',
                    'depth'                => 0,
                    'walker'               => '',
                    'link_class'     => 'link sm',
                    
                )
            );
        ?>
        <?php
            $slider_1 = get_field('slider_1');
            $slider_2 = get_field('slider_2');
            $slider_3 = get_field('slider_3');
        ?>
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="<?php echo esc_url($slider_1['image']); ?>" alt="slide 1 background">
                <div>
                    <h2 class="ff-ms fs-2 fw-7 fc-blue-2 m-0"><?php echo esc_attr($slider_1['title']); ?></h2>
                    <p class="ff-ms fs-5 fc-dark"><?php echo esc_attr($slider_1['text']); ?></p>
                </div>
                <div class="swiper-slide__number">
                    <p>01</p>
                </div>
            </div>
            <div class="swiper-slide"><img src="<?php echo esc_url($slider_2['image']); ?>" alt="slide 2 background">
                <div>
                    <h2 class="ff-ms fs-2 fw-7 fc-blue-2 m-0"><?php echo esc_attr($slider_2['title']); ?></h2>
                    <p class="ff-ms fs-5 fc-dark"><?php echo esc_attr($slider_2['text']); ?></p>
                </div>
                <div class="swiper-slide__number">
                    <p>02</p>
                </div>
            </div>
            <div class="swiper-slide"><img src="<?php echo esc_url($slider_3['image']); ?>" alt="slide 3 background">
                <div>
                    <h2 class="ff-ms fs-2 fw-7 fc-blue-2 m-0"><?php echo esc_attr($slider_3['title']); ?></h2>
                    <p class="ff-ms fs-5 fc-dark"><?php echo esc_attr($slider_3['text']); ?></p>
                </div>
                <div class="swiper-slide__number">
                    <p>03</p>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </article>
    <?php 
        $our_advantages = get_field('our_advantages');
        $advantage_1 = $our_advantages['advantage_1'];
        $advantage_2 = $our_advantages['advantage_2'];
        $advantage_3 = $our_advantages['advantage_3'];
    ?>
    <article class="advantages"><img src="<?php echo esc_url($our_advantages['our_advantages_background']); ?>" alt="advantages background">
        <header class="bg-blue-2 pt-2">
            <h1 class="offset ff-ms fs-1 fc-white">Our<br>advantages</h1>
        </header>

        <section>
            <article class="advantages-post">
                <p class="fs-5 fc-white ff-ms"><?php echo esc_attr($advantage_1['text']); ?></p>
                <p class="fs-3 fc-white ff-ms"><?php echo esc_attr($advantage_1['title']); ?></p>
            </article>
            <article class="advantages-post">
                <p class="fs-5 fc-white ff-ms"><?php echo esc_attr($advantage_2['text']); ?></p>
                <p class="fs-3 fc-white ff-ms"><?php echo esc_attr($advantage_2['title']); ?></p>
            </article>
            <article class="advantages-post">
                <p class="fs-5 fc-white ff-ms"><?php echo esc_attr($advantage_3['text']); ?></p>
                <p class="fs-3 fc-white ff-ms"><?php echo esc_attr($advantage_3['title']); ?></p>
            </article>
        </section>
    </article>
    <article>
        <h2 class="w-sm-75 ta-sm-center ff-ms fs-2 fc-blue-2 fw-7 px-1 mx-auto mt-1 mb-0">Customize & Decorate Your Home With Our Furniture!</h2>
        <section class="grid-container">
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
            <a href="shop-page.html" class="grid-item-w-header"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rectangle-43.jpg" alt="grid item image">
                <p class="fs-2 fc-white ff-ms fw-7 ta-center">LIVING ROOM</p>
            </a>
        </section>
    </article>
    <?php
            $galleries = get_post_galleries(get_the_ID(), false);
            $first_gallery = $galleries[0];
            $second_gallery = $galleries[1];
        ?>
    <article class="cam" data-toggle="carousel" data-interval="1000">
        <section>
            <h2 class="ff-ms fs-1 fw-7 fc-white">CHOOSE<br>COLOR<br>AND<br>MATERIAL</h2>
            <div class="cam-colors-images">
                <?php if($first_gallery): 
                    $number = 1;
                    foreach($first_gallery['src'] as $src):?>
                        <img aria-current="<?php if($number== 1): echo "true"; endif; ?>" src="<?php echo $src; ?>" alt="material blue image"> 

                <?php endforeach;
                endif;?>
            </div>
        </section>
        <?php
            $page_template = get_pages( array(
                'post_type' => 'page',
                'meta_key' => '_wp_page_template',
                'meta_value' => 'page-templates/page-template-colors-and-materials.php',
                ));
        ?>  
        
        <section>
            <div class="cam-materials-images">
                <?php if($second_gallery): 
                    $number = 1;
                    foreach($second_gallery['src'] as $src):?>
                        <img aria-current="<?php if($number== 1): echo "true"; endif; ?>" src="<?php echo $src; ?>" alt="material blue image"> 

                    <?php endforeach;
                    endif;
                    ?>
            </div>
            <a href="<?php echo get_permalink( $page_template[0]->ID ); ?>" class="btn mt-1">Colors & Materials</a>
        </section>
        <?php
            $colors_and_materials_gallery =  get_field('colors_and_materials_gallery');
        ?>
        <div class="cam-controll">
            <div>
                <span aria-current="true" type="button" style="background-color: <?php echo esc_attr($colors_and_materials_gallery['color_1']); ?>"></span> 
                <span type="button" style="background-color: <?php echo esc_attr($colors_and_materials_gallery['color_2']); ?>"></span> 
                <span type="button" style="background-color: <?php echo esc_attr($colors_and_materials_gallery['color_3']); ?>"></span> 
                <span type="button" style="background-color: <?php echo esc_attr($colors_and_materials_gallery['color_4']); ?>"></span>
            </div>
            <span>
                <a href="<?php echo get_permalink( $page_template[0]->ID ); ?>" class="btn my-1 mx-auto">Colors & Materials</a>
            </span>
        </div>
    </article>
    <article id="reviews" class="px-2 px-sm-4">
        <h2 class="w-75 w-sm-100 ff-ms fs-2 fc-blue-2 ta-center mx-auto">GOOGLE REVIEWS</h2>
        <div class="swiper-per-view">
        <?php 
        $args = array(
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'post_type' => 'review',
        );
        query_posts( $args );
        ?>
            <div class="swiper-wrapper">
            <?php 
                if ( have_posts() ):
                    while ( have_posts() ) : the_post(); ?>
                        <div class="swiper-slide comment">

                            <figure>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php echo get_the_post_thumbnail(); ?>
                                <?php else:?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Default_avatar.jpg" alt="avatar">
                                <?php endif;?>
                            </figure>
                            <div>
                                <?php $rating = get_field('review_rating'); ?>
                                <div>
                                <?php
                                    for ($i=0; $i < $rating; $i++) : ?>
                                        <span class="checked"></span>
                                    <?php endfor;
                                ?> 
                                </div>   
                                <p class="ff-ms fs-5 fc-blue-2"><?php the_field('review_text'); ?></p>
                            </div>
                        </div>
                <?php 
                    endwhile; 
                ?>
                        
                <?php wp_reset_postdata();
                    wp_reset_query();

                endif;
            ?>
            </div>
            <!-- <div class="swiper-pagination"></div> -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </article>
</main>
<?php get_footer();?>
