$(document).ready(function() {
    $('.product-quantity .quantity').addClass('quantity_cart');
    // $('form').load(function (){
    //     addQuantityButtons();
    // })
    // $('.quantity').each(function() {
    //     var spinner = jQuery(this),
    //         input = spinner.find('input[type="number"]'),
    //         btnUp = spinner.find('.fa-chevron-up'),
    //         btnDown = spinner.find('.fa-chevron-down'),
    //         min = input.attr('min');
    //     // max = input.attr('max');
    //     // spinner.find("input").val(1);
    //     // spinner.find("input").trigger("change");
    //     btnUp.click(function() {
    //         var oldValue = parseFloat(input.val());
    //         var newVal = oldValue + 1;
    //         spinner.find("input").val(newVal);
    //         spinner.find("input").trigger("change");
    //     });
    //
    //     btnDown.click(function() {
    //         var oldValue = parseFloat(input.val());
    //         if (oldValue <= min) {
    //             var newVal = oldValue;
    //         } else {
    //             var newVal = oldValue - 1;
    //         }
    //         spinner.find("input").val(newVal);
    //         spinner.find("input").trigger("change");
    //     });
    // });
    // $('.reset_variations').click(function () {
    //     $(".var_info").css("visibility", "hidden");
    // });
    // $('section.related.products .woocommerce-LoopProduct-link').addClass('disabled-link');
    // // $('section.related.products ul.products li.product .woocommerce-LoopProduct-link').removeClass('disabled-link');
    // // $('.disabled-link').removeAttr('href');
    // var products = $('section.related.products ul.products li.product');
    // products.each(function () {
    //     var href = $(this).find('>a').get(0).href;
    //     console.log(href);
    //     var cart = $(this).find('.cart-link');
    //     cart.attr("href", href);
    // })
    // $('.disabled-link').removeAttr('href');
})