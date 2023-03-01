// $ = jQuery.noConflict(true);

function swiperMenuLink() {
    var e = $(".swiper-menu").find(".link");
    e.mouseenter(function() {
            $(this).css("opacity", "1"),
                $(this).parent().prev().children(".link").css("opacity", "0.5"),
                $(this).parent().next().children(".link").css("opacity", "0.5")
        }),
        e.mouseleave(function() {
            $(this).css("opacity", ""),
                $(this).parent().prev().children(".link").css("opacity", ""),
                $(this).parent().next().children(".link").css("opacity", "")
        })
}

function camCarousel() {
    var e = $('.cam[data-toggle="carousel"]');
    e.length && e.each(function() {
        let r = $(this),
            a = r.find(".cam-colors-images").children("img"),
            n = r.find(".cam-materials-images").children("img"),
            t = r.find(".cam-controll").find('span[type="button"]');
        clearInterval(void 0);
        setInterval(function() {
            var e, t;
            r.hasClass("freeze") ? r.removeClass("freeze") : (t = (e = a.filter('[aria-current="true"]')).next().length ? e.next() : a.first(),
                e.attr("aria-current", "false"),
                t.attr("aria-current", "true"),
                t = (e = n.filter('[aria-current="true"]')).next().length ? e.next() : n.first(),
                e.attr("aria-current", "false"),
                t.attr("aria-current", "true"))
        }, r.data("interval"));
        t.click($.debounce(250, function() {
            var e = t.index($(this));
            a.attr("aria-current", "false"),
                a.eq(e).attr("aria-current", "true"),
                n.attr("aria-current", "false"),
                n.eq(e).attr("aria-current", "true"),
                r.addClass("freeze")
        }))
    })
}
$(document).ready(function() {
    swiperMenuLink(),
        camCarousel()
});