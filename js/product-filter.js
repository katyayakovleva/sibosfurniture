var $ = jQuery.noConflict();

$(document).ready(function() {
    // var hostname = window.location.origin;

    const url = new URL(window.location.href);
    // const url = hostname + '/catalog/';
    // console.log(url);
    // var sortProducts = $('#sort-products a');
    //var collections = [];
    // var item_types = [];
    var place_types = [];
    //var brands = [];
    var sale = 'false';
    var sort = 'popularity';
    var posts_per_page = '12';
    $('#filter-products-mobile input[type="checkbox"]').on('change', function(){
        // $("#filter-products-mobile input:checkbox[name=collection]:checked").each(function(){
        //     collections.push($(this).val());
            
        // });
        // $("#filter-products-mobile input:checkbox[name=item-type]:checked").each(function(){
        //     item_types.push($(this).val());
        // });
        $("#filter-products-mobile input:checkbox[name=place-type]:checked").each(function(){
            place_types.push($(this).val());
        });
        // $("#filter-products-mobile input:checkbox[name=brand]:checked").each(function(){
        //     brands.push($(this).val());
        // });
        if($('#filter-products-mobile input:checkbox[name="sale"]').is(':checked')){
            sale = 'true';
        }else{
            sale = 'false';
        }
        
        //let collectionsArrayString = JSON.stringify(collections);
        //let item_typesArrayString = JSON.stringify(item_types);
        let place_typesArrayString = JSON.stringify(place_types);
        //let brandsArrayString = JSON.stringify(brands);
        
        //let encodedcollectionsArrayString = encodeURIComponent(collectionsArrayString);
        //let encodeditem_typesArrayString = encodeURIComponent(item_typesArrayString);
        let encodedplace_typesArrayString = encodeURIComponent(place_typesArrayString);
        //let encodedbrandsArrayString = encodeURIComponent(brandsArrayString);
        
        //url.searchParams.set("collections", encodedcollectionsArrayString);
        //url.searchParams.set("item_types", encodeditem_typesArrayString);
        url.searchParams.set("place_types", encodedplace_typesArrayString);
        //url.searchParams.set("brands", encodedbrandsArrayString);
        url.searchParams.set("sale", sale);
        window.history.pushState({}, "", url);
        
        window.location.href = window.location.href.replace(/\/page\/\d+\//, '/');     
        //collections = [];
        //item_types = [];
        place_types = [];
        //brands = [];

        
    });
    $('#filter-products-desktop input[type="checkbox"]').on('change', function(){
        // $("#filter-products-desktop input:checkbox[name=collection]:checked").each(function(){
        //     collections.push($(this).val());
        // });
        // $("#filter-products-desktop input:checkbox[name=item-type]:checked").each(function(){
        //     item_types.push($(this).val());
        // });
        $("#filter-products-desktop input:checkbox[name=place-type]:checked").each(function(){
            place_types.push($(this).val());
        });
        // $("#filter-products-desktop input:checkbox[name=brand]:checked").each(function(){
        //     brands.push($(this).val());
        // });
        if($('#filter-products-desktop input:checkbox[name="sale"]').is(':checked')){
            sale = 'true';
        }else{
            sale = 'false';
        }

        //let collectionsArrayString = JSON.stringify(collections);
        //let item_typesArrayString = JSON.stringify(item_types);
        let place_typesArrayString = JSON.stringify(place_types);
        //let brandsArrayString = JSON.stringify(brands);

        
        //let encodedcollectionsArrayString = encodeURIComponent(collectionsArrayString);
        //let encodeditem_typesArrayString = encodeURIComponent(item_typesArrayString);
        let encodedplace_typesArrayString = encodeURIComponent(place_typesArrayString);
        //let encodedbrandsArrayString = encodeURIComponent(brandsArrayString);


        //url.searchParams.set("collections", encodedcollectionsArrayString);
        //url.searchParams.set("item_types", encodeditem_typesArrayString);
        url.searchParams.set("place_types", encodedplace_typesArrayString);
        //url.searchParams.set("brands", encodedbrandsArrayString);
        url.searchParams.set("sale", sale);
        window.history.pushState({}, "", url);
        
        window.location.href = window.location.href.replace(/\/page\/\d+\//, '/');     
        // collections = [];
        // item_types = [];
        place_types = [];
        //brands = [];

        
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
    
});