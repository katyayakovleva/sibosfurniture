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


// jQuery(document).ready(function($) {
    function loadDashboard2(dashboard_menu_item){
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
                        duration: 100,

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
    function loadDashboard(){
        
        const a = $(".menu__header").find("button");

        a.click(function() {
            var dashboard_menu_item = $(this).data("target");
            var dasboard_content_class = $("#dashboard-content");
            var dasboard_content = $("#dashboard-content div");

            if(!dasboard_content_class.hasClass(dashboard_menu_item)){

                a.filter(".active").removeClass("active");
                
                dasboard_content.animate({
                    opacity: "toggle",
                    height: "toggle"
                }, {
                    duration: 100,
                }),
                dasboard_content.html("");
                dasboard_content_class.attr('class', '');
                $(this).toggleClass("active");

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
                                duration: 100,

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

        })
        
    }
    $(document).ready(function() {
        const a = $(".menu__header").find("button");
        a.click(function() {
            var dashboard_menu_item = $(this).data("target");
            var dasboard_content_class = $("#dashboard-content");
            var dasboard_content = $("#dashboard-content div");

            if(!dasboard_content_class.hasClass(dashboard_menu_item)){
                a.filter(".active").removeClass("active");
                loadDashboard2(dashboard_menu_item);
                $(this).toggleClass("active");
            }
        });
        $(".dashboard").on("click","a",function() {
            console.log('click');
            a.filter(".active").removeClass("active");
            var dashboard_menu_item = $(this).data("target");
            loadDashboard2(dashboard_menu_item);
            a.filter("#" + dashboard_menu_item).toggleClass("active");
        });
    });
// });
