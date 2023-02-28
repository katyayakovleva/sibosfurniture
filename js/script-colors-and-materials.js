function colorRowCollapse() {
    var o = $(".grid-colors__row").find("h3");
    const i = $(".grid-colors__body");
    i.filter(":not(.active)").css("display", "none"), o.off(), window.matchMedia("screen and (min-width: 35.5em)").matches || o.click(function() {
        var o = $(this).parent().find(".grid-colors__body");
        o.hasClass("active") || i.filter(".active").removeClass("active").animate({ opacity: "toggle", height: "toggle", padding: "toggle" }, { duration: 200, start: function() { $(this).css("display", "grid") } }), o.animate({ opacity: "toggle", height: "toggle", padding: "toggle" }, { duration: 200, start: function() { $(this).css("display", "grid") } }), o.toggleClass("active")
    })
}
$(document).ready(function() { colorRowCollapse(), $(window).resize($.debounce(250, function() { colorRowCollapse() })) });