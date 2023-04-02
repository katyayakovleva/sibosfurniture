function categoryLink() {
    $(".link-category-list").each(function() {
        const t = $(this).find(".link-category");
        t.click(function() {
            if($(this).hasClass('active')){
                $(this).removeClass("active").next().animate({
                    opacity: "toggle",
                    height: "toggle"
                }, 200)
            }else{
                $(this).toggleClass("active"),
                $(this).next().animate({
                    opacity: "toggle",
                    height: "toggle"
                }, 200)
            }
                
        })
    })
}
$(document).ready(function() {
    categoryLink()
});