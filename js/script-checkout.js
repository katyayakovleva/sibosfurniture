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
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle errors
            console.log(errorThrown);
        }

    });
    
}


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

    $( '#billing_email' ).on( 'change', function() {
        var billing_email = $( this ).val();
        if( billing_email ) {
            console.log(billing_email);
            $( this ).attr("value", billing_email);
            // jQuery('body').trigger('update_checkout');
            // location.reload(); 
            // firstOrderDiscount(billing_email)
            // $( '.billing-email-value' ).html( billing_email );
        } else {
            // $( '.billing-email-value' ).html( '' );
        }
    });
    $(document).on("click","#first_order_discount a",function(){
        var billing_email = $( '#billing_email' ).val();
        firstOrderDiscount(billing_email);

    });
});
