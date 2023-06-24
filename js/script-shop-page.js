var $ = jQuery.noConflict();

function categoryLink() {
    $(".link-category-list").each(function() {
        const t = $(this).find(".link-category");
        t.click(function() {
            // if($(this).hasClass('active')){
            //     // $(this).removeClass("active").next().animate({
            //     //     opacity: "toggle",
            //     //     height: "toggle"
            //     // }, 200)
            // }else{
                $(this).toggleClass("active")
                // $(this).next().animate({
                //     opacity: "toggle",
                //     height: "toggle"
                // }, 200)
            // }
                
        })
    })
    
    $(".place_types").each(function() {
        const t = $(this).find(".link-category-place_types");
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
    $(".link-category").click(function(){
        var val = $(this).attr('value')
        const t = $("#"+val);
        if($(t).hasClass('active')){
            $(t).removeClass("active").next().animate({
                opacity: "toggle",
                height: "toggle"
            }, 200)
        }else{
            $(t).toggleClass("active"),
            $(t).next().animate({
                opacity: "toggle",
                height: "toggle"
            }, 200)
        }
    });
    categoryLink()
});