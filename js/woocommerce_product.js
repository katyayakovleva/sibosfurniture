$(document).ready(function() {
    $('.related.products .woocommerce-LoopProduct-link').addClass('disabled-link');
    // $('section.related.products ul.products li.product .woocommerce-LoopProduct-link').removeClass('disabled-link');
    // $('.disabled-link').removeAttr('href');
    var products = $('.related.products li.product');
    products.each(function () {
        var href = $(this).find('>a').get(0).href;
        console.log(href);
        var cart = $(this).find('.cart-link');
        cart.attr("href", href);
    })
    $('.disabled-link').removeAttr('href');
})