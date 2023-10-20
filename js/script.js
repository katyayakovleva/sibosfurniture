var $ = jQuery.noConflict();

function collapseCross() {
    const a = $("body"),
        e = $('.navbar-burger[data-toggle="collapse"]');
    var t = $('.navbar-collapse-cross[data-toggle="collapse"]');
    t.off(),
        window.matchMedia("screen and (min-width: 35.5em)").matches || t.click(function() {
            a.toggleClass("fixed");
            var t = $("#" + $(this).data("target"));
            e.toggleClass("active"),
                t.animate({
                    width: "toggle"
                }, 400)
        })
}

function linkNavbar() {
    const a = $("button.link-navbar").filter("[href]").filter(":not([data-toggle])"),
        t = $('button.link-navbar[data-toggle="collapse"]'),
        e = $(".navbar-collapse-left");
    var i = $(".navbar-collapse-middle");
    a.off(), t.off(), t.filter(".active").removeClass("active").next().hide(), window.matchMedia("screen and (min-width: 35.5em)").matches ? (a.mouseenter(function () {
        a.filter(".active").not($(this)).removeClass("active"), $(this).toggleClass("active");
        var t = $(this).next();
        e.empty(), $(this).hasClass("active") && (e.append(t.clone()), e.find("ul").animate({
            opacity: "toggle"
        }, 200))
    }), a.click(function () {
        window.location.href = $(this).attr("href")
    }), t.click(function () {
        window.location.href = $(this).attr("href")
    })) : (t.parent().find("ul").empty().append(i.children().clone()), t.click(function () {
        t.filter(".active").not($(this)).removeClass("active").next().animate({
            opacity: "toggle",
            height: "toggle"
        }, 200), $(this).toggleClass("active"), $(this).next().animate({
            opacity: "toggle",
            height: "toggle"
        }, 200)
    }), t.parent().find("button.link-navbar").filter("[href]").filter(":not([data-toggle])").click(function () {
        window.location.href = $(this).attr("href")
    }), t.dblclick(function () {
        window.location.href = $(this).attr("href")
    }))
}

function navbarBurger() {
    const t = $("body");
    var a = $('.navbar-burger[data-toggle="collapse"]');
    a.off(),
        window.matchMedia("screen and (min-width: 35.5em)").matches ? a.click(function() {
            t.toggleClass("fixed"),
                $(this).toggleClass("active"),
                $("#" + $(this).data("target")).animate({
                    opacity: "toggle"
                }, {
                    duration: 400,
                    start: function() {
                        $(this).css("display", "flex")
                    }
                })
        }) : a.click(function() {
            t.toggleClass("fixed"),
                $(this).toggleClass("active"),
                $("#" + $(this).data("target")).animate({
                    width: "toggle"
                }, {
                    duration: 400,
                    start: function() {
                        $(this).css("display", "flex")
                    }
                })
        })
}
const body = $("body");
body.toggleClass("fixed");
let preloader_animation = new TimelineMax({
    repeat: -1
});

preloader_animation.fromTo($("#preloader_animation"), 2, {
        transformOrigin: "center",
        autoAlpha: 1,
        scalX: 1,
        scalY: 1
    }, {
        autoAlpha: 0,
        scaleX: 5,
        scaleY: 5
    }),
    $(document).ready(function() {

        $('.cookie_settings').click(function(){
            $('.cky-consent-container').toggleClass("cky-hide");
        });
        $('.catalog_page').append('<ul></ul>');
        $('#contact-us form').addClass('d-flex fd-col g-1');
        $('#contact-us form .form-control').addClass('form-control-without-value');
        $(".wpcf7-form input").focus(function() {
            $(this).parent().siblings('label').addClass('has-value');
            $(this).parent().parent().removeClass('form-control-without-value');

        })
            .blur(function() {
                var text_val = $(this).val();
                if (text_val === "") {
                    $(this).parent().siblings('label').removeClass('has-value');
                    $(this).parent().parent().addClass('form-control-without-value');
                }
            });
        // $('.navbar-collapse-middle li:has(ul)>a').each(function (index){
        //     var href_middle = this.href
        //     $(this).replaceWith($('<button href = "' + href_middle +'" class="link link-navbar">' + this.innerHTML + '</button>'));
        // })
        // $('.navbar-collapse-right li:has(ul)>a').each(function (index){
        //     var href_right = this.href
        //     $(this).replaceWith($('<button href = "' + href_right +'" class="link link-navbar" data-toggle="collapse">' + this.innerHTML + '</button>'));
        // })
        $('i.flaticon-right-arrow.slick-arrow').each(function (index){
            $(this).replaceWith($('<div class="swiper-button-next"></div>'))
        })
        $('.navbar-collapse-middle.place-type-section >li').each(function () {
            let href = $(this).find('>a').get(0).href;
            let words= href.split("/");
            
            let a = words.pop();
            let slug = words.pop();
            
            var url = words.slice(0, 3).join('/');

            if(slug === "sale"){
                $(this).append('<ul></ul>')
                url = url + '/catalog?sale=true';
                $(this).find('a').attr("href", url); 
                // var str1 = '&action=get_ajax_menu_popular_item_sales_category';
                // $.ajax({
                //     type: "POST",
                //     dataType: "html",
                //     url: ajax_menu_popular_items.ajaxurl,
                //     data: str1,
                //     success: (data) => {
                //         var data_parse = JSON.parse(data)
                //         if (Object.keys(data_parse).length >= 1) {
                //             $count = 0;
                //             for (const [key, value] of Object.entries(data_parse)) {

                //                 // var item_type_param = [];
                //                 // item_type_param.push(value[0]);
                //                 // let itemTypesJson = JSON.stringify(item_type_param);
                //                 // var item_url = url + '&place_types=' + encodeURIComponent(encodeURIComponent(itemTypesJson)); 

                //                 var newListItem = $("<li><a href='" + value[0] + "' class='link link-navbar'>" + value[1] + "</a></li>");
                //                 $(this).find('ul').append(newListItem);
                //                 $count++;
                //                 if($count >= 8){
                //                    break
                //                 }
                //             }
                //         }
                //         if(Object.keys(data_parse).length > 8){
                //             var newListItem = $("<li><a href='" + url + "' class='link link-navbar'>More</a></li>");
                //             $(this).find('ul').append(newListItem);
                //         }
                //     },
                //     error : function(jqXHR, textStatus, errorThrown) {
                //         console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                //     }
                // });
            }else{
                // var id = $('#'+slug).val();
                // var place_type_param = [];
                // place_type_param.push(id);
                // let placeTypesJson = JSON.stringify(place_type_param);
                // url1 = url + '/catalog?place_types=' + encodeURIComponent(encodeURIComponent(placeTypesJson));
                // $(this).find('>a').attr("href", url1);
                // $(this).find('ul li:not(.more_cat)').each(function () {
                //     let sub_href = $(this).find('>a').get(0).href;
                //     let sub_words= sub_href.split("/");
                //     let sub_a = sub_words.pop();
                //     let sub_slug = sub_words.pop();
                //     var sub_url = sub_words.slice(0, 3).join('/');
                //     var sub_id = $('#'+sub_slug).val();
                //     var sub_category_param = [];
                //     sub_category_param.push(sub_id);
                //     let subCategoryJson = JSON.stringify(sub_category_param);
                //     url2 = sub_url + '/catalog?place_types=' + encodeURIComponent(encodeURIComponent(subCategoryJson));
                //     $(this).find('>a').attr("href", url2);
                // });
                // $(this).find('ul li.more_cat').each(function () {
                //     $(this).find('>a').attr("href", url1);
                // });
            }
               
        });
        $('.navbar-collapse-middle li:has(ul)>a').each(function (index){
            var href_middle = this.href
            $(this).replaceWith($('<button href = "' + href_middle +'" class="link link-navbar">' + this.innerHTML + '</button>'));
        })
        $('.navbar-collapse-right li:has(ul)>a').each(function (index){
            var href_right = this.href
            $(this).replaceWith($('<button href = "' + href_right +'" class="link link-navbar" data-toggle="collapse">' + this.innerHTML + '</button>'));
        })

        $("#preloader").fadeOut({
                duration: 400,
                complete: function() {
                    body.toggleClass("fixed")
                }
            }),
            collapseCross(),
            linkNavbar(),
            navbarBurger(),
            $(window).resize($.debounce(250, function() {
                collapseCross(),
                    linkNavbar(),
                    navbarBurger()
        }))
        $('.article-block p').addClass('ff-ms fs-5 fc-dark');
        $('.woocommerce-privacy-policy-text').addClass('ff-ms fs-5 fc-dark');

        $('.form_edit .form-row:not(:has(select))').addClass('form-control');
        $('.form_edit .form-row:has(select)').addClass('select-form-control');

        $('.checkout-form-adresses .form-row').addClass('form-group');
        $('.checkout-form-adresses .form-row').addClass('form-control');
        $('.checkout-form-adresses .form-row').addClass('dark');

        $('.form-row:has(textarea)').addClass('checkout-note');
        $('#note-checkbox').change(function () {
            if (this.checked) 
               $('#note-content').show();
            else 
                $('#note-content').hide();
        });
        $('.fa-magnifying-glass').click(function () {
            $('#searchform').submit();
        });
    });
$( document.body ).on( 'updated_cart_totals added_to_cart removed_from_cart', function(){
    console.log('update cart');
    $(document.body).trigger('wc_fragment_refresh');
});