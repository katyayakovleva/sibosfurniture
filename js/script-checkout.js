$(function () {

    $(".order-detail-shipping p").each(function() {
        // Some Vars
        var elText,
            openSpan = '<span class="order-detail-shipping-first-word">',
            closeSpan = '</span>';
        
        // Make the text into array
        elText = $(this).text().split("\n");
        
        // Adding the open span to the beginning of the array
        elText.unshift(openSpan);
        
        // Adding span closing after the first word in each sentence
        elText.splice(2, 0, closeSpan);
        
        // Make the array into string 
        elText = elText.join(" ");
        
        // Change the html of each element to style it
        $(this).html(elText);
      });
});
