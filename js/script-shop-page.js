function categoryLink() {
    $(".link-category-list").each(function() {
        const t = $(this).find(".link-category");
        t.click(function() { t.filter(".active").not($(this)).removeClass("active").next().animate({ opacity: "toggle", height: "toggle" }, 200), $(this).toggleClass("active"), $(this).next().animate({ opacity: "toggle", height: "toggle" }, 200) })
    })
}
$(document).ready(function() { categoryLink() });