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
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/IMG_7727-1.jpg" alt="slide 1 background">
                <div>
                    <h2 class="ff-ms fs-2 fw-7 fc-blue-2 m-0">Discount for 1st order</h2>
                    <p class="ff-ms fs-5 fc-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="swiper-slide__number">
                    <p>01</p>
                </div>
            </div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/image_2023-01-25_19-47-462-1.jpg" alt="slide 2 background">
                <div>
                    <h2 class="ff-ms fs-2 fw-7 fc-blue-2 m-0">About us</h2>
                    <p class="ff-ms fs-5 fc-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolvore magna aliqua.</p>
                </div>
                <div class="swiper-slide__number">
                    <p>02</p>
                </div>
            </div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Untitled-1-1.jpg" alt="slide 3 background">
                <div>
                    <h2 class="ff-ms fs-2 fw-7 fc-blue-2 m-0">High-quality material</h2>
                    <p class="ff-ms fs-5 fc-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolvore magna aliqua.</p>
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
    <article class="advantages"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-4.jpg" alt="advantages background">
        <header class="bg-blue-2 pt-2">
            <h1 class="offset ff-ms fs-1 fc-white">Our<br>advantages</h1>
        </header>
        <section>
            <article class="advantages-post">
                <p class="fs-5 fc-white ff-ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p class="fs-3 fc-white ff-ms">Icon name</p>
            </article>
            <article class="advantages-post">
                <p class="fs-5 fc-white ff-ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p class="fs-3 fc-white ff-ms">Icon name</p>
            </article>
            <article class="advantages-post">
                <p class="fs-5 fc-white ff-ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p class="fs-3 fc-white ff-ms">Icon name</p>
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
    <article class="cam" data-toggle="carousel" data-interval="1000">
        <section>
            <h2 class="ff-ms fs-1 fw-7 fc-white">CHOOSE<br>COLOR<br>AND<br>MATERIAL</h2>
            <div class="cam-colors-images"><img aria-current="true" src="<?php echo get_template_directory_uri(); ?>/assets/images/alexander-pogorelsky-5woHQB_1LLk-unsplash-10.jpg" alt="colors blue image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/alexander-pogorelsky-5woHQB_1LLk-unsplash-11.jpg" alt="colors purple image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/alexander-pogorelsky-5woHQB_1LLk-unsplash-12.jpg"
                    alt="colors red image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/alexander-pogorelsky-5woHQB_1LLk-unsplash-13.jpg" alt="colors yellow image"></div>
        </section>
        <?php
            $page_template = get_pages( array(
                'post_type' => 'page',
                'meta_key' => '_wp_page_template',
                'meta_value' => 'page-templates/page-template-colors-and-materials.php',
                ));
        ?>  
        <section>
            <div class="cam-materials-images"><img aria-current="true" src="<?php echo get_template_directory_uri(); ?>/assets/images/stil4uk-8.png" alt="material blue image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stil4uk-9.png" alt="material purple image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stil4uk-10.png" alt="material red image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stil4uk-11.png"
                    alt="material yellow image"></div><a href="<?php echo get_permalink( $page_template[0]->ID ); ?>" class="btn mt-1">Colors and Materials</a></section>
        <div class="cam-controll">
            <div><span aria-current="true" type="button"></span> <span type="button"></span> <span type="button"></span> <span type="button"></span></div><span><a href="colors-and-materials.html" class="btn my-1 mx-auto">Colors & Materials</a></span></div>
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
