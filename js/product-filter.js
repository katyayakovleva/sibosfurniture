var $ = jQuery.noConflict();

$(document).ready(function() {

    var url = new URL(window.location.href);
    
    var place_types = [];
    var sale = 'false';
    var sort = 'popularity';
    var posts_per_page = '12';
    //Mobile
    $('#filter-products-mobile input[type="checkbox"]').on('change', function(){
        url = new URL($('#catalog_link').attr('href'));

        $("#filter-products-mobile input:checkbox[name=place-type]:checked").each(function(){
            place_types.push($(this).val());
        });

        if($('#filter-products-mobile input:checkbox[name="sale"]').is(':checked')){
            sale = 'true';
        }else{
            sale = 'false';
        }
        

        let place_typesArrayString = JSON.stringify(place_types);

        let encodedplace_typesArrayString = encodeURIComponent(place_typesArrayString);

        url.searchParams.set("place_types", encodedplace_typesArrayString);
        url.searchParams.set("sale", sale);
        window.history.pushState({}, "", url);
        
        window.location.href = window.location.href.replace(/\/page\/\d+\//, '/');     

        place_types = [];

        
    });
    //Desktop
    $('#filter-products-desktop input[type="checkbox"]').on('change', function(){
        url = new URL($('#catalog_link').attr('href'));

        $("#filter-products-desktop input:checkbox[name=place-type]:checked").each(function(){
            place_types.push($(this).val());
        });

        if($('#filter-products-desktop input:checkbox[name="sale"]').is(':checked')){
            sale = 'true';
        }else{
            sale = 'false';
        }

        let place_typesArrayString = JSON.stringify(place_types);

        let encodedplace_typesArrayString = encodeURIComponent(place_typesArrayString);

        url.searchParams.set("place_types", encodedplace_typesArrayString);
        url.searchParams.set("sale", sale);
        window.history.pushState({}, "", url);
        
        window.location.href = window.location.href.replace(/\/page\/\d+\//, '/');     
        place_types = [];        
    });
    $('#sort_product a').click( function(){
        sort = $(this).attr('value');
        url.searchParams.set("sort", sort);
        window.history.pushState({}, "", url);
        window.location.href = window.location.href.replace(/\/page\/\d+\//, '/');  
    });
    $('#posts_per_page_select a').click( function(){
        posts_per_page = $(this).attr('value');
        url.searchParams.set("posts_per_page", posts_per_page);
        window.history.pushState({}, "", url);
        window.location.href = window.location.href.replace(/\/page\/\d+\//, '/');  
    });
    $('#price_filter_button_desktop').click( function(){
        min_price = $('#min_price_desktop').val();
        max_price = $('#max_price_desktop').val();
        // console.log(min_price);
        // console.log(max_price);
        url.searchParams.set("min", min_price);
        url.searchParams.set("max", max_price);
        window.history.pushState({}, "", url);
        window.location.href = window.location.href.replace(/\/page\/\d+\//, '/');  
    });
    $('#price_filter_button_mobile').click( function(){
        min_price = $('#min_price_mobile').val();
        max_price = $('#max_price_mobile').val();
        // console.log(min_price);
        // console.log(max_price);
        url.searchParams.set("min", min_price);
        url.searchParams.set("max", max_price);
        window.history.pushState({}, "", url);
        window.location.href = window.location.href.replace(/\/page\/\d+\//, '/');  
    });
    
});