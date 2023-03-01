<?php
/**
 * The template for displaying the footer
 *
 * @package Sibosfurniture
 */

?>
    <footer id="contact-us" class="bg-blue-2">
        <div class="cols">
            <div class="col-1 col-sm-2-3">
                <figure class="pb-2 pb-sm-3">
                    <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-sibos-white.svg" alt="logo"></a>
                </figure>
                <div class="cols">
                    <div class="col-1 col-sm-1-2 col-xl-1-3 d-flex fd-col ai-center ai-sm-start">
                        <figure class="ratio-1x1"><iframe title="Google Map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3302.192895292898!2d-118.27097618454735!3d34.14140678058167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c0f660a90fe9%3A0xf0862d924c6291dc!2s4916%20San%20Fernando%20Rd%2C%20Glendale%2C%20CA%2091204%2C%20USA!5e0!3m2!1sen!2sua!4v1676455524341!5m2!1sen!2sua"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></figure><a href="#" class="link white py-2 py-sm-1 ta-center ta-sm-start">4916 San Fernando Rd Glendale Ca 91204</a></div>
                    <div class="col-1 col-sm-1-2">
                        <div class="cols">
                            <div class="col-1 col-sm-1-2">
                                <ul class="d-flex fd-col g-2 p-0 pl-sm-3 ai-center ai-sm-start">
                                    <li><a href="blog.html" class="link white">Blog</a></li>
                                    <li><a href="#" class="link white">FAQ</a></li>
                                    <li><a href="#" class="link white">Shipping</a></li>
                                    <li><a href="#" class="link white">Terms and Conditions</a></li>
                                </ul>
                            </div>
                            <div class="col-1 col-sm-1-2">
                                <ul class="d-flex fd-col g-2 p-0 pl-sm-2 ai-center ai-sm-start">
                                    <li><a href="#" class="link white">Link</a></li>
                                    <li><a href="#" class="link white">Link</a></li>
                                    <li><a href="#" class="link white">Link</a></li>
                                    <li><a href="#" class="link white">Link</a></li>
                                </ul>
                            </div>
                            <div class="col-1 my-2 mt-sm-0">
                                <ul class="d-flex g-4 g-sm-2 p-0 pl-sm-3 jc-center jc-sm-start">
                                    <li><a href="#" class="link blue fs-4" aria-label="Facebook"><i class="fa-brands fa-square-facebook fa-3x"></i></a></li>
                                    <li><a href="#" class="link blue fs-4" aria-label="Instagram"><i class="fa-brands fa-instagram fa-3x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 col-sm-1-3">
                <h3 class="w-100 w-sm-75 fs-4 mt-0 ta-center ta-sm-start fc-white">Leave your quote to create your dream furniture with us!</h3>
<!--                <form class="d-flex fd-col g-1">-->
<!--                    <div class="form-control white"><label for="name">Name</label> <input type="text" id="name" name="name" aria-label="Name" placeholder=" "></div>-->
<!--                    <div class="form-control white"><label for="email">Email</label> <input type="email" id="email" name="email" aria-label="Email" placeholder=" "></div>-->
<!--                    <div class="form-control white"><label for="phone">Phone</label> <input type="tel" id="phone" name="phone" aria-label="Phone" placeholder=" "></div>-->
<!--                    <div class="form-control white"><label for="interest">I'm interested in</label> <input type="text" id="interest" name="interest" aria-label="Interest" placeholder=" "></div><button type="submit" class="btn white mt-1 as-center as-sm-start">Call me</button>-->
<!--                </form>-->
                <?php echo do_shortcode( '[contact-form-7 id="11" title="Contact form"]' );?>
            </div>
        </div>
        <div class="cols mt-3">
            <div class="col-1">
                <ul class="footer-reorder w-100 d-flex fd-col fd-sm-row m-0 p-0 jc-between ai-center g-1 ta-center">
                    <li><a href="#" class="link blue sm">FAQ</a></li>
                    <li><a href="#" class="link blue sm">Privacy policy</a></li>
                    <li><a href="mailto:orders@sibosfurniture.com" class="link blue sm">orders@sibosfurniture.com</a></li>
                    <li><a href="tel:+1818-696-3839" class="link blue sm">+1818-696-3839</a></li>
                    <li><a href="#" class="link blue sm">Copyright (c) SIBOSFURNITURE. All rights reserved</a></li>
                    <li><a href="#" class="link blue sm">by LIDDWEB</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<?php wp_footer(); ?>

</body>
</html>
