function loadDashboard() {
    const a = $(".menu__header").find("button"),
        e = $(".menu__body").children("div");
    a.click(function() {
        var t = $("#" + $(this).data("target"));
        t.hasClass("active") || (a.filter(".active").removeClass("active"), e.filter(".active").animate({ opacity: "toggle", height: "toggle" }, { duration: 200, complete: function() { $(this).removeClass("active") } }), t.animate({ opacity: "toggle", height: "toggle" }, { duration: 200 }), $(this).toggleClass("active"), t.toggleClass("active"))
    })
}
$(document).ready(function() { loadDashboard() });