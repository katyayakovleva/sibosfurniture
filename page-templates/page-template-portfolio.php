<?php
/**
 * Template Name: Portfolio
 * 
 * The main template file
 *
 * @package Sibosfurniture
 */

get_header();
?>
 <main class="header-padding">
        <article class="px-2 px-sm-4 mb-2">
            <header class="header-primary">
                <h1 class="ff-ms fs-2 fc-blue-2 fw-7">Portfolio</h1>
            </header>
            <section class="grid-container">
            <?php //echo do_shortcode(get_field('gallery_shortcode') );?>
            <?php 
            if ( $gallery = get_post_gallery( get_the_ID(), false ) ) :
                foreach ( $gallery['src'] as $src ) {
                            ?>                
                           <a href="#" class="grid-item"> <img src="<?php echo $src; ?>"alt="portfolio"  /></a>
                    <?php
                }
            endif;
            ?>
                <!-- <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-1.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-2.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-3.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-1.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-2.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-3.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-1.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-2.jpg" alt="grid item image"> </a>
                <a href="#" class="grid-item"><img src="assets/images/trend-K9pU2u0Z5WU-unsplash-3.jpg" alt="grid item image"></a> -->
            </section>
        </article>
        <article class="px-3 px-sm-4 bg-blue-5">
            <h2 class="ff-ms fs-4 fc-blue-2 my-1">Top sellings</h2>
            <div class="swiper-per-view">
                <div class="swiper-wrapper">
                    <div class="swiper-slide grid-item-shop">
                        <div class="grid-item-shop__header changing-color-item">
                            <figure><img src="assets/images/cm-br1855a-29-1-1.jpg" class="active" data-color="beige" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="green" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg"
                                    data-color="red" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="blue" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg" data-color="purple" alt="item image"> <img src="assets/images/cm-br1855a-29-1-1.jpg"
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
        </article>
    </main>
<?php get_footer();?>
