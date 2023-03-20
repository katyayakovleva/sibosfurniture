

function filterProducts(selected){

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
                $('#filter-checkout').append(data)
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
        url.searchParams.set("categories", selected.join(','));
        window.history.pushState({}, "", url);
        // filterProducts(selected);
        // console.log(selected);
    });
    
});