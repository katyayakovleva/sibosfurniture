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
    a.off(),
        t.off(),
        t.filter(".active").removeClass("active").next().hide(),
        window.matchMedia("screen and (min-width: 35.5em)").matches ? (a.click(function() {
                a.filter(".active").not($(this)).removeClass("active"),
                    $(this).toggleClass("active");
                var t = $(this).next();
                e.empty(),
                    $(this).hasClass("active") && (e.append(t.clone()),
                        e.find("ul").animate({
                            opacity: "toggle"
                        }, 200))
            }),
            a.dblclick(function() {
                window.location.href = $(this).attr("href")
            }),
            t.click(function() {
                window.location.href = $(this).attr("href")
            })) : (t.parent().find("ul").empty().append(i.children().clone()),
            t.click(function() {
                t.filter(".active").not($(this)).removeClass("active").next().animate({
                        opacity: "toggle",
                        height: "toggle"
                    }, 200),
                    $(this).toggleClass("active"),
                    $(this).next().animate({
                        opacity: "toggle",
                        height: "toggle"
                    }, 200)
            }),
            t.parent().find("button.link-navbar").filter("[href]").filter(":not([data-toggle])").click(function() {
                window.location.href = $(this).attr("href")
            }),
            t.dblclick(function() {
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
        $('.navbar-collapse-middle li:has(ul)>a').each(function (index){
            var href_middle = this.href
            $(this).replaceWith($('<button href = "' + href_middle +'" class="link link-navbar">' + this.innerHTML + '</button>'));
        })
        $('.navbar-collapse-right li:has(ul)>a').each(function (index){
            var href_right = this.href
            $(this).replaceWith($('<button href = "' + href_right +'" class="link link-navbar" data-toggle="collapse">' + this.innerHTML + '</button>'));
        })
        $('i.flaticon-right-arrow.slick-arrow').each(function (index){
            $(this).replaceWith($('<div class="swiper-button-next"></div>'))
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
        
    });