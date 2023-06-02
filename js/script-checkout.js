function firstOrderDiscount(email){
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: {
            action: 'first_order_dicount',
            email: email,
        },
        success: function(response) {
            // Reload the page to update the cart
            // location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle errors
            console.log(errorThrown);
        }

    });
    
}

// function checkFirstOrderCoupon(){
//     $.ajax({
//         type: "POST",
//         dataType: "html",
//         url: ajax_posts.ajaxurl,
//         data: {
//             action: 'check_first_order_coupon',
//         },
//         success: function(response) {
//             // Reload the page to update the cart
//             location.reload();
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             // Handle errors
//             console.log(errorThrown);
//         }

//     });
    
// }

$(function () {
    // if ($(".cart-discount ").length){ 
    //     $("#first_order_discount a").hide();
    // }
    // else{
    //     $("#first_order_discount a").hide();
    // }
    $(".order-detail-shipping p").each(function() {
        // Some Vars
        var elText,
            openSpan = '<span class="order-detail-shipping-first-word">',
            closeSpan = '</span>';
        
        // Make the text into array
        elText = $(this).text().split("\n");
        
        // Adding the open span to the beginning of the array
        elText.unshift(openSpan);
        
        // Adding span closing after the first word in each sentence
        elText.splice(2, 0, closeSpan);
        
        // Make the array into string 
        elText = elText.join(" ");
        
        // Change the html of each element to style it
        $(this).html(elText);
      });

    $(document).on("click","#toggle_pwd",function(){
        $(this).toggleClass("fa-eye fa-eye-slash");
       var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password").attr("type", type);
        $("#password_current").attr("type", type);
        $("#reg_password").attr("type", type);
    });

    // $( '#billing_email' ).on( 'change', function() {
    //     var billing_email = $( this ).val();
    //     if( billing_email ) {
    //         console.log(billing_email);
    //         $( this ).attr("value", billing_email);
    //         // $(document.body).trigger('update_checkout');
    //         // jQuery('body').trigger('update_checkout');
    //         // location.reload(); 
    //         // firstOrderDiscount(billing_email)
    //         // $( '.billing-email-value' ).html( billing_email );
    //     } else {
    //         // $( '.billing-email-value' ).html( '' );
    //     }
    // });
    // $(document).on("click","#first_order_discount a",function(){
    //     var billing_email = $( '#billing_email' ).val();
    //     console.log(billing_email);
    //     // Trigger the AJAX update to recalculate the fees


    //     // location.reload();
    //     // firstOrderDiscount(billing_email);
    //     $(document.body).trigger('update_checkout');
    //     $(document.body).trigger('woocommerce-update-totals');

    // });
        if($('.fee').length){
            $('#first_order_discount').html("");
        }
        $(document).on("click","#first_order_discount a", function(e) {
            e.preventDefault();
            var billing_email = $( '#billing_email' ).val();
            // Set the flag to apply the custom fee
            custom_fees_params.apply_custom_fee = true;
            custom_fees_params.email_for_fee = billing_email;
            // Trigger the AJAX request to update the fees
            $.ajax({
                type: 'POST',
                url: custom_fees_params.ajaxurl,
                data: {
                    email_for_fee: billing_email,
                    action: 'update_custom_fees',
                    nonce: custom_fees_params.nonce,
                },
                success: function(response) {
                    // Handle the response if needed
                    console.log(response);
                    // Trigger the update_checkout event to recalculate totals
                    
                    $(document.body).trigger('update_checkout');
                    $('#first_order_discount').html("");
                },
            });
        });
    
    // $('.woocommerce-form-coupon form').on('submit', function(){
    //     var code = $('.woocommerce-form-coupon form :input[name=coupon_code]').val()
    //     if(code == 'firstorder'){
    //         checkFirstOrderCoupon();
    //     }
    // });
});
