var $ = jQuery.noConflict();

function changinColorItem() {
    $(".changing-color-item").each(function() {
        const i = $(this).find("figure").find("img");
        $(this).find(".colors").find('span[role="button"]').each(function() {
            $(this).on("click", function() {
                const n = $(this).data("color");
                var t = i.filter(function() { return $(this).data("color") === n }).first();
                t.length && (i.removeClass("active"), t.addClass("active"))
            })
        })
    })
}
$(document).ready(function() { changinColorItem() });