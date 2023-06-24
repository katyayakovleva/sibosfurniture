// function loadDashboard() {
//     const a = $(".menu__header").find("button");
//     const e = $(".menu__body").children("div");
//     a.click(function() {
//         var t = $("#" + $(this).data("target"));
//         t.hasClass("active") || (a.filter(".active").removeClass("active"),
//         e.filter(".active").animate({
//             opacity: "toggle",
//             height: "toggle"
//         }, {
//             duration: 200,
//             complete: function() {
//                 $(this).removeClass("active")
//             }
//         }),
//         t.animate({
//             opacity: "toggle",
//             height: "toggle"
//         }, {
//             duration: 200
//         }),
//         $(this).toggleClass("active"),
//         t.toggleClass("active"))
//     })
// }
// $(document).ready(function() {
//     loadDashboard()
// });



// function orderDetailToggle() {
//     const orderDetailBtn = $('.actions').find('a[data-toggle="order-detail"]');
//     orderDetailBtn.click(function () {
//         const container = $(this).parent().parent().parent().parent();
//         const orderDetailBlock = container.find('.orders-detail');
//         orderDetailBlock.toggleClass('active');
//         if (!window.matchMedia('screen and (min-width: 35.5em)').matches) {
//             $('html,body').animate({scrollTop: container.offset().top});
//         }
//     });
// }
// function orderPaymentToggle() {
//     const orderPaymentBtn = $('.actions').find('a[data-toggle="order-payment"]');
//     orderPaymentBtn.click(function () {
//         const container = $(this).parent().parent().parent().parent();
//         const orderPaymentBlock = container.find('.orders-payment');
//         orderPaymentBlock.toggleClass('active');
//         if (!window.matchMedia('screen and (min-width: 35.5em)').matches) {
//             $('html,body').animate({scrollTop: container.offset().top});
//         }
//     });
    
// }

var $ = jQuery.noConflict();

function loadOrderDetails(action, order_id){
    var str = '&order_action='+ action +  '&order_id='+ order_id + '&action=order_details_ajax';
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function(data){
            var $data = $(data);
            if($data.length){     
                $("#"+ order_id).append($data);   
                $("#"+ order_id).addClass('active_order');                    
            } else{
                console.log('error');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    
}
function loadDashboard(dashboard_menu_item){
    var dasboard_content_class = $("#dashboard-content");
    var dasboard_content = $("#dashboard-content div");
    
    dasboard_content.animate({
        opacity: "toggle",
        height: "toggle"
    }, {
        duration: 100,
    }),
    dasboard_content.html("");
    dasboard_content_class.attr('class', '');
    // $(this).toggleClass("active");

    var str = '&dashboard_menu_item='+ dashboard_menu_item  + '&action=more_post_ajax';
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function(data){
            var $data = $(data);
            if($data.length){

                dasboard_content.animate({
                    opacity: "toggle",
                    height: "toggle"
                }, {
                    // duration: 100,

                }),
                dasboard_content_class.toggleClass("active");
                dasboard_content_class.toggleClass(dashboard_menu_item);
                dasboard_content.append($data);
                
            } else{
                console.log('error');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    
}

$(document).ready(function() {
    const a = $(".menu__header").find("button");
    a.click(function() {
        var dashboard_menu_item = $(this).data("target");
        var dasboard_content_class = $("#dashboard-content");
        var dasboard_content = $("#dashboard-content div");

        if(!dasboard_content_class.hasClass(dashboard_menu_item)){
            a.filter(".active").removeClass("active");
            loadDashboard(dashboard_menu_item);
            $(this).toggleClass("active");
        }
    });
    
    $(document).on("click",".dashboard a",function() {
        a.filter(".active").removeClass("active");
        var dashboard_menu_item = $(this).data("target");
        loadDashboard(dashboard_menu_item);
        a.filter("#" + dashboard_menu_item).toggleClass("active");
    });

    $(document).on("click",".actions a",function(){
        var action = $(this).data("action");
        var order_id = $(this).data("order_id");
        var order_container = $("#"+ order_id);
        if(!order_container.hasClass('active_order')){
            // console.log(order_id);
            loadOrderDetails(action, order_id); 
        }else{
            var old_order = $(".active_order section");
            old_order.remove();
            order_container.removeClass('active_order');
        }
        

    });
});

