function descriptionInfo() {
    $(".description-info").each(function() {
        const n = $(this).find(".description-info__tabs").find(".link"),
            t = $(this).find(".description-info__info").find(".description-info__block");
        n.click(function() {
            n.removeClass("active"), $(this).toggleClass("active");
            var i = $(this).data("target");
            t.removeClass("active"), $("#" + i).toggleClass("active")
        })
    })
}
$(document).ready(function() { descriptionInfo() });