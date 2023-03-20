

function filterProducts(selected){
    var products_loop_content = $("#products-loop");
    var jsonString = JSON.stringify(selected);
    var str = '&selected='+ jsonString + '&action=filter_product_ajax';
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_filter_products.ajaxurl,
        data: str,
        success: function(data){
            var data = $(data);
            if(data.length){
                products_loop_content.html("");
                products_loop_content.append(data);
            } else{
                console.log('error');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    
}
$(document).ready(function() {
    var $filterCheckboxes = $('input[type="checkbox"]');
    var selected = [];
    $filterCheckboxes.on('change', function(){
        if(this.checked) {
            selected.push($(this).data("category_id"));
        }else{
            const filtered = selected.filter((num) => num != $(this).data("category_id"));
            selected = filtered;
        }
        const url = new URL(window.location);
        let myArrayString = JSON.stringify(selected);
        let encodedArray = encodeURIComponent(myArrayString);
        url.searchParams.set("categories", encodedArray);
        window.history.pushState({}, "", url);
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const categories = urlParams.get('categories');
       
        let decodedArrayString = decodeURIComponent(categories);
         console.log(decodedArrayString);
        // console.log(decodedArray);
        filterProducts(selected);
        // console.log(selected);
    });
    
});