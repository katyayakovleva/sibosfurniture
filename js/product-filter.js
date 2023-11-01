var $ = jQuery.noConflict();

function setParamsToNewURL(old_url, new_url){
    if($('a.active_collection').length){
        collection = $('a.active_collection').attr('value');
        new_url.searchParams.set("collection", collection);
    }
    if(old_url.searchParams.has('posts_per_page')){
        const posts_per_page = old_url.searchParams.get('posts_per_page')
        new_url.searchParams.set("posts_per_page", posts_per_page);
    }
    if(old_url.searchParams.has('sort')){
        const sort = old_url.searchParams.get('sort')
        new_url.searchParams.set("sort", sort);
    }
    if(old_url.searchParams.has('min')){
        const min = old_url.searchParams.get('min')
        new_url.searchParams.set("min", min);
    }
    if(old_url.searchParams.has('max')){
        const max = old_url.searchParams.get('max')
        new_url.searchParams.set("max", max);
    }
    if(old_url.searchParams.has('sale')){
        const sale = old_url.searchParams.get('sale')
        new_url.searchParams.set("sale", sale);
    }
    return new_url;
}

$(document).ready(function() {

    var url = new URL(window.location.href.replace(/\/page\/\d+\//, '/'));


    $('input:checkbox[name=place-type]').on('change', function(){

        if($(this).is(':checked')){
            var parentOl = $(this).closest('ol');
            if ($(this).hasClass('sub_product_cat')) {
                var allCheckbox = parentOl.find('.all');
                allCheckbox.prop('checked', false);
            }
            else {
                var subProductCatCheckboxes = parentOl.find('.sub_product_cat');
                subProductCatCheckboxes.prop('checked', false);        
            } 
        }
        new_url = setParamsToNewURL(url, new URL($('#catalog_link').attr('href')));
        var place_types = [];
        $("#filter-products input:checkbox[name=place-type]:checked").each(function(){
            place_types.push($(this).val());
        });
        

        let place_typesArrayString = JSON.stringify(place_types);
        let encodedplace_typesArrayString = encodeURIComponent(place_typesArrayString);
        
        new_url.searchParams.set("place_types", encodedplace_typesArrayString);

    
        window.history.pushState({}, "", new_url);
        window.location.href = window.location.href;  
    });
    $('input:checkbox[name="sale"]').on('change', function(){
   
        if($('#filter-products input:checkbox[name="sale"]').is(':checked')){
            url.searchParams.set("sale", 'true');
        }else{
            url.searchParams.delete("sale");
        }
        window.history.pushState({}, "", url);
        window.location.href = window.location.href;  

    });
    $('a.product_cat ').on('click', function(){
        const href = $(this).data("href")
        new_url = new URL(href);
        window.history.pushState({}, "", new_url);   
        window.location.href = window.location.href;  
    });
    $('a.product_collection').click( function(){
        const href = $(this).data("href")
        new_url = new URL(href);
        window.history.pushState({}, "", new_url);   
        window.location.href = window.location.href;  
        // collection = $(this).attr('value');
        // url.searchParams.set("collection", collection);
        // window.history.pushState({}, "", url);
        // window.location.href = window.location.href;  
    });
    $('#sort_product a').click( function(){
        const sort = $(this).attr('value');
        url.searchParams.set("sort", sort);
        window.history.pushState({}, "", url);
        window.location.href = window.location.href;  
    });
    $('#posts_per_page_select a').click( function(){
        const posts_per_page = $(this).attr('value');
        url.searchParams.set("posts_per_page", posts_per_page);
        window.history.pushState({}, "", url);
        window.location.href = window.location.href;  
    });
    $('#price_filter_button').click( function(){
        const min_price = $('#min_price').val();
        const max_price = $('#max_price').val();
        url.searchParams.set("min", min_price);
        url.searchParams.set("max", max_price);
        window.history.pushState({}, "", url);
        window.location.href = window.location.href;  
    });

    
});