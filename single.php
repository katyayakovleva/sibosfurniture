<?php
/**
 * The template for displaying all single posts
 *
 * @package Sibosfurniture
 */

get_header();
?>

<main class="header-padding">
        <article class="primary-header px-2 px-md-4 pt-2 pb-1">
            <div class="d-flex fd-col">
                <h1 class="ff-ms fs-1 fw-7 fc-blue-2 m-0">Name of the article</h1>
                <div class="breadcrumb my-1">
                    <div class="breadcrumb__item"><a href="#" class="link">Home</a></div>
                    <div class="breadcrumb__item"><a href="#" class="link">Blog</a></div>
                    <div class="breadcrumb__item"><a href="#" class="link">Name of article</a></div>
                </div>
            </div>
            <div class="d-flex fd-col pl-sm-1">
                <p class="ff-ms fs-5 fc-blue-4 m-0">03/09</p>
                <p class="ff-ms fs-5 fc-blue-4 m-0">2023</p>
            </div>
        </article>
        <section class="px-2 px-sm-4 pb-3 pb-sm-4">
            <article class="article-block">
                <p class="ff-ms fs-5 fc-dark">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                    book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                    more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The
                    point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors
                    now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected
                    humour and the like).</p>
                <figure><img src="assets/images/ruslan-bardash-4kTbAMRAHtQ-unsplash-1.jpg" alt="article image"></figure>
            </article>
        </section>
        <article class="px-3 px-sm-4 bg-blue-5">
            <h2 class="ff-ms fs-4 fc-blue-2 my-1">You might also like...</h2>
            <div class="swiper-per-view">
                <div class="swiper-wrapper">
                    <div class="swiper-slide item-blog">
                        <div>
                            <div class="d-flex jc-between">
                                <figure class="ratio-4x3"><img src="assets/images/spacejoy-IH7wPsjwomc-unsplash-4.jpg" alt="item image"></figure>
                                <div class="d-flex fd-col pl-1">
                                    <p class="ff-ms fs-1-25 fc-blue-4 m-0">03/09</p>
                                    <p class="ff-ms fs-1-25 fc-blue-4 m-0">2023</p>
                                </div>
                            </div>
                            <p class="ff-ms fs-5">A subtitle</p>
                            <p class="ff-ms fs-5 fc-dark">Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolvore magna aliqua.</p>
                        </div><a href="news-page.html" class="btn">Read more</a></div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </article>
    </main>
<?php
get_footer();
