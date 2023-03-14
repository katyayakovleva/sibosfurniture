<?php
/**
 * Template Name: About us
 * 
 * The main template file
 *
 * @package Sibosfurniture
 */

get_header();
?>
<?php

?>
<main class="header-padding">
    <article class="hero" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center/cover;">
        <div>
            <h1><?php the_title();?></h1>
        </div>
        <div></div>
    </article>
    <?php
    $about_us_advantages = get_field('about_us_advantages');
    $first_block = $about_us_advantages['first_block'];
    $second_block = $about_us_advantages['second_block'];
    $third_block = $about_us_advantages['third_block'];
    ?>
    <article class="cols">
        <article class="col-1 col-sm-1-3 advantages-post">
            <p class="fs-5 fc-dark ff-ms"><?php echo esc_attr($first_block['text']); ?></p>
            <p class="fs-3 fc-dark ff-ms m-0"><?php echo esc_attr($first_block['title']); ?></p>
        </article>
        <article class="col-1 col-sm-1-3 advantages-post">
            <p class="fs-5 fc-white ff-ms"><?php echo esc_attr($second_block['text']); ?></p>
            <p class="fs-3 fc-white ff-ms m-0"><?php echo esc_attr($second_block['title']); ?></p>
        </article>
        <article class="col-1 col-sm-1-3 advantages-post">
            <p class="fs-5 fc-white ff-ms"><?php echo esc_attr($third_block['text']); ?></p>
            <p class="fs-3 fc-white ff-ms m-0"> <?php echo esc_attr($third_block['title']); ?></p>
        </article>
    </article>
    <?php 
    $about_us_way_we_work = get_field('about_us_way_we_work');
    $way_we_work_title = $about_us_way_we_work['way_we_work_title'];
    $way_we_work_image = $about_us_way_we_work['way_we_work_image'];
    $first_block = $about_us_way_we_work['first_block'];
    $second_block = $about_us_way_we_work['second_block'];
    $third_block = $about_us_way_we_work['third_block'];
    $our_goal_title = $about_us_way_we_work['our_goal_title'];
    $our_goal_text = $about_us_way_we_work['our_goal_text'];
    ?>
    <section class="hidden-work"><span style="background: rgba(0,73,175,.3) url(<?php  echo esc_url($way_we_work_image);?>) no-repeat center/cover;"></span>
        <h1 class="ff-ms fs-2 fw-7 fc-blue-2 px-1"><?php echo esc_attr($way_we_work_title); ?></h1>
    </section>
    <article class="numbers">
        <div style="background: rgba(0,73,175,.3) url(<?php echo esc_url($way_we_work_image); ?>) no-repeat center/cover;">
            <div><img class="d-none d-sm-block" src="<?php echo get_template_directory_uri(); ?>/assets/images/1.svg" alt="number 1"> <img class="d-block d-sm-none" src="<?php echo get_template_directory_uri(); ?>/assets/images/1-mob.svg" alt="number 1">
                <p><?php echo esc_attr($first_block['text']); ?></p>
            </div>
        </div>
        <div>
            <div><img class="d-none d-sm-block" src="<?php echo get_template_directory_uri(); ?>/assets/images/2.svg" alt="number 2"> <img class="d-block d-sm-none" src="<?php echo get_template_directory_uri(); ?>/assets/images/2-mob.svg" alt="number 2">
                <p><?php echo esc_attr($second_block['text']); ?></p>
            </div>
        </div>
        <div>
            <div><img class="d-none d-sm-block" src="<?php echo get_template_directory_uri(); ?>/assets/images/3.svg" alt="number 3"> <img class="d-block d-sm-none" src="<?php echo get_template_directory_uri(); ?>/assets/images/3-mob.svg" alt="number 3">
                <p><?php echo esc_attr($third_block['text']); ?></p>
            </div>
        </div>
    </article>
    <article class="work px-2 px-sm-4">
        <h1 class="ff-ms fs-1 fw-7 fc-blue-2 w-75 m-0 d-none d-sm-block"><?php echo esc_attr($way_we_work_title); ?></h1>
        <div class="my-3">
            <h2 class="ff-ms fc-blue-2 fw-7"><?php echo esc_attr($our_goal_title); ?></h2>
            <p class="ff-ms fs-5 fc-dark"><?php echo esc_attr($our_goal_text); ?></p>
        </div>
    </article>
    <article class="px-3 px-sm-4 bg-blue-5 related products">
        <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
        <?php get_template_part('template-parts/content', 'popular-products');?>
    </article>    <!-- <article class="px-3 px-sm-4 bg-blue-5 pb-sm-4">
        <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
        <div class="swiper-per-view">
            <div class="swiper-wrapper">
                <div class="swiper-slide grid-item-shop">
                    <div class="grid-item-shop__header changing-color-item">
                        <figure><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg"
                                data-color="red" alt="item image"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg"
                                data-color="dark-red" alt="item image"></figure>
                        <div class="colors"><span role="button" aria-label="beige" data-color="beige"></span> <span role="button" aria-label="green" data-color="green"></span> <span role="button" aria-label="red" data-color="red"></span> <span role="button" aria-label="blue"
                                data-color="blue"></span> <span role="button" aria-label="purple" data-color="purple"></span> <span role="button" aria-label="dark-red" data-color="dark-red"></span></div>
                    </div>
                    <p class="ff-ms fs-5 fg-1">Modrest Cartier - Modern Beige Velvet and Brushed Brass Bed</p>
                    <p class="ff-ms d-sm-none fs-5 fc-blue-4">Lorem ipsum dolor sit amet, adipiscing elit</p>
                    <div class="d-flex ai-center jc-between mt-2">
                        <p class="grid-item-shop__price ff-ms m-0">679$</p>
                        <div class="grid-item-shop__buttons"><a href="#" class="link fs-3 d-none d-sm-inline"><i class="icon-heart-icon"></i></a> <a href="item-page.html" class="link fs-3"><i class="icon-cart-icon"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <p class="ff-ms fs-5 fc-blue-2 d-none d-sm-inline">Forem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum
            velit, sit amet feugiat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus
            nisl, eu tempor urna. Curabitur vel bibendum lorem. Morbi convallis convallis diam sit amet lacinia. Aliquam in elementum tellus.</p>
    </article> -->
    <article class="px-3 px-sm-4 bg-blue-5 pb-sm-4">
        <p class="ff-ms fs-5 fc-blue-2 d-none d-sm-inline"><?php the_field('after_top_sellings_text'); ?> </p>
    </article>
</main>

<?php
get_footer();?>
