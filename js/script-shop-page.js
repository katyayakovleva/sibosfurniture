var $ = jQuery.noConflict();


function modernDropdown() {
  const button = $(".dropdown-modern .dropdown-button")

  button.click(function () {
    const button = $(this),
      dropdown = button.parent().parent(),
      menu = dropdown.children("ol");
    dropdown.toggleClass("active");
    menu.animate(
      {
        opacity: "toggle",
        height: "toggle",
        margin: "toggle",
      },
      200
    );
  });
}
  
function modernPopUp() {
  const button = $(".dropdown-modern__popup").children("button");

  button.click(function () {
    const button = $(this),
      popup = button.parent();

      popup.animate(
      {
        opacity: "0",
        width: "0",
        margin: "0",
      },
      200);
      setTimeout(() => {
        popup.hide();
      }, 200);
  });
}
  
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


function priceSlider() {
  let rangeMin = 100;
  let rangeMax = 100000;

  const range = document.querySelectorAll('.range');
  range.forEach((slider) => {
    const range = slider.querySelector(".range__selected");
    const rangeInput = slider.querySelectorAll(".range__input input");
    const rangePrice = slider.querySelectorAll(".range__price input");

    // console.log(range, rangeInput, rangePrice);
    
    rangeInput.forEach((input) => {
      input.addEventListener("input", (e) => {
        let minRange = parseInt(rangeInput[0].value);
        let maxRange = parseInt(rangeInput[1].value);
        if (maxRange - minRange < rangeMin) {
          if (e.target.className === "min") {
            rangeInput[0].value = maxRange - rangeMin;
          } else {
            rangeInput[1].value = minRange + rangeMin;
          }
        } else {
          rangePrice[0].value = minRange;
          rangePrice[1].value = maxRange;
          range.style.left = (minRange / rangeInput[0].max) * 100 + "%";
          range.style.right = 100 - (maxRange / rangeInput[1].max) * 100 + "%";
        }
      });
    });
    
    rangePrice.forEach((input) => {
      // start setup
      let minPrice = rangePrice[0].value;
      let maxPrice = rangePrice[1].value;
      rangeInput[0].value = minPrice;
      range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      rangeInput[1].value = maxPrice;
      range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
    
      input.addEventListener("input", (e) => {
        let minPrice = parseInt(rangePrice[0].value);
        let maxPrice = parseInt(rangePrice[1].value);
    
        if (maxPrice - minPrice >= rangeMin && maxPrice <= rangeInput[1].max) {
          if (e.target.className === "min") {
            rangeInput[0].value = minPrice;
            range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
          } else {
            rangeInput[1].value = maxPrice;
            range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
          }
        }
      });
    });
  });
}
function moveFilters() {
  if (window.matchMedia("screen and (max-width: 64em)").matches) {
    $("#mobile_filters").prepend($("#filters"));
  } else {
    $("#desktop_filters").prepend($("#filters"));
  }
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
    modernDropdown();
    // modernPopUp();
    priceSlider();
    moveFilters(),
    $(window).resize(
      $.debounce(250, function () {
        moveFilters();
      })
    );
});


jQuery(document).ready(function($) {
  $('.dropdown').click( function(){
    if($('.dropdown__content.active').length > 0){
      $('.dropdown__content.active').toggleClass('active')
    }
    var content = $(this).find('.dropdown__content')
    content.toggleClass('active')
  })
  $(document).on("click", function(event){
    var $trigger = $(".dropdown");
    if($trigger !== event.target && !$trigger.has(event.target).length){
      $('.dropdown__content.active').removeClass("active");
    }
  });
  // Check if the popup should be shown (based on sessionStorage)
  if (!sessionStorage.getItem('popup_shown')) {
      // Add your additional condition check here if needed

      // Show the popup
      $('.custom-popup').show();

      // Set a sessionStorage item to prevent the popup from showing again in this session
      sessionStorage.setItem('popup_shown', 'true');
  }

  // Close the popup when the close button is clicked
  $('.custom-popup .new-popup-close-button').click(function() {
    const button = $(this),
    popup = button.parent();

    popup.animate(
    {
      opacity: "0",
      width: "0",
      margin: "0",
    },
    200);
    setTimeout(() => {
      popup.hide();
    }, 200);
    });
});