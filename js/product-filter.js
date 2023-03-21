

function filterProducts(collections, item_types, place_types, sale, sort){
    var products_loop_content = $("#products-loop");
    var collectionsStr = JSON.stringify(collections);
    var item_typesStr = JSON.stringify(item_types);
    var place_typesStr = JSON.stringify(place_types);
    // var str = '&collections='+ collectionsStr + '&item_types=' + item_typesStr + '&place_types=' + place_typesStr +'&sale='+ sale + '&action=filter_product_ajax';
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_filter_products.ajaxurl,
        data: {action: 'filter_product_ajax', collections: collectionsStr, item_types: item_typesStr, place_types:place_typesStr, sale:sale, sort:sort},
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
function getChecked(name) {
    checked[name] = Array.from(document.querySelectorAll('input[name=' + name + ']:checked')).map(function (el) {
      return el.value;
    });
  }
$(document).ready(function() {
    var filterCheckboxes = $('#filter-products input[type="checkbox"]');
    var sortProducts = $('#sort-products a');
    var collections = [];
    var item_types = [];
    var place_types = [];
    var sale = false;
    var sort = '';
    filterCheckboxes.on('change', function(){
        $("input:checkbox[name=collection]:checked").each(function(){
            collections.push($(this).val());
        });
        $("input:checkbox[name=item-type]:checked").each(function(){
            item_types.push($(this).val());
        });
        $("input:checkbox[name=place-type]:checked").each(function(){
            place_types.push($(this).val());
        });
        if($('input:checkbox[name="sale"]').is(':checked')){
            sale = true;
        }else{
            sale = false;
        }
        filterProducts(collections, item_types, place_types, sale, sort);
       
        const url = new URL(window.location);
        let collectionsArrayString = JSON.stringify(collections);
        let item_typesArrayString = JSON.stringify(item_types);
        let place_typesArrayString = JSON.stringify(place_types);
        
        let encodedcollectionsArrayString = encodeURIComponent(collectionsArrayString);
        let encodeditem_typesArrayString = encodeURIComponent(item_typesArrayString);
        let encodedplace_typesArrayString = encodeURIComponent(place_typesArrayString);

        url.searchParams.set("collections", encodedcollectionsArrayString);
        url.searchParams.set("item_types", encodeditem_typesArrayString);
        url.searchParams.set("place_types", encodedplace_typesArrayString);
        url.searchParams.set("sale", sale);
        window.history.pushState({}, "", url);
        // const queryString = window.location.search;
        // const urlParams = new URLSearchParams(queryString);
        // const categories = urlParams.get('categories');
       
        // let decodedArrayString = decodeURIComponent(categories);
        //  console.log(decodedArrayString);
        // console.log(decodedArray);
        
        collections = [];
        item_types = [];
        place_types = [];
    });
    $('a').click( function(){
        sort = $(this).attr('value');
        // console.log(sort);
        filterProducts(collections, item_types, place_types, sale, sort);
    });
    
});