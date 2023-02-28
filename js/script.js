function collapseCross() {
    const a = $("body"),
        e = $('.navbar-burger[data-toggle="collapse"]');
    var t = $('.navbar-collapse-cross[data-toggle="collapse"]');
    t.off(), window.matchMedia("screen and (min-width: 35.5em)").matches || t.click(function() {
        a.toggleClass("fixed");
        var t = $("#" + $(this).data("target"));
        e.toggleClass("active"), t.animate({ width: "toggle" }, 400)
    })
}

function linkNavbar() {
    const a = $("button.link-navbar").filter("[href]").filter(":not([data-toggle])"),
        t = $('button.link-navbar[data-toggle="collapse"]'),
        e = $(".navbar-collapse-left");
    var i = $(".navbar-collapse-middle");
    a.off(), t.off(), t.filter(".active").removeClass("active").next().hide(), window.matchMedia("screen and (min-width: 35.5em)").matches ? (a.click(function() {
        a.filter(".active").not($(this)).removeClass("active"), $(this).toggleClass("active");
        var t = $(this).next();
        e.empty(), $(this).hasClass("active") && (e.append(t.clone()), e.find("ul").animate({ opacity: "toggle" }, 200))
    }), a.dblclick(function() { window.location.href = $(this).attr("href") }), t.click(function() { window.location.href = $(this).attr("href") })) : (t.parent().find("ul").empty().append(i.children().clone()), t.click(function() { t.filter(".active").not($(this)).removeClass("active").next().animate({ opacity: "toggle", height: "toggle" }, 200), $(this).toggleClass("active"), $(this).next().animate({ opacity: "toggle", height: "toggle" }, 200) }), t.parent().find("button.link-navbar").filter("[href]").filter(":not([data-toggle])").click(function() { window.location.href = $(this).attr("href") }), t.dblclick(function() { window.location.href = $(this).attr("href") }))
}

function navbarBurger() {
    const t = $("body");
    var a = $('.navbar-burger[data-toggle="collapse"]');
    a.off(), window.matchMedia("screen and (min-width: 35.5em)").matches ? a.click(function() { t.toggleClass("fixed"), $(this).toggleClass("active"), $("#" + $(this).data("target")).animate({ opacity: "toggle" }, { duration: 400, start: function() { $(this).css("display", "flex") } }) }) : a.click(function() { t.toggleClass("fixed"), $(this).toggleClass("active"), $("#" + $(this).data("target")).animate({ width: "toggle" }, { duration: 400, start: function() { $(this).css("display", "flex") } }) })
}
const body = $("body");
body.toggleClass("fixed");
let preloader_animation = new TimelineMax({ repeat: -1 });
preloader_animation.fromTo($("#preloader_animation"), 2, { transformOrigin: "center", autoAlpha: 1, scalX: 1, scalY: 1 }, { autoAlpha: 0, scaleX: 5, scaleY: 5 }), $(document).ready(function() { $("#preloader").fadeOut({ duration: 400, complete: function() { body.toggleClass("fixed") } }), collapseCross(), linkNavbar(), navbarBurger(), $(window).resize($.debounce(250, function() { collapseCross(), linkNavbar(), navbarBurger() })) });