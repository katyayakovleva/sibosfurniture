var $ = jQuery.noConflict();

function stepperInput() {
    $(".stepper-input").each(function() {
        let n = $(this).find(".stepper-input__input"),
            e = $(this).find(".stepper-input__container").find("input");
        console.log(e.attr("value"));
        var t = $(this).find(".stepper-input__button--left"),
            i = $(this).find(".stepper-input__button--right");
        t.click(function() {
                var t = parseInt(n.text());
                n.text(t + 1),
                    e.attr("value", t + 1)
            }),
            i.click(function() {
                var t = parseInt(n.text());
                1 < t && (n.text(t - 1),
                    e.attr("value", t - 1))
            })
    })
}
$(document).ready(function() {
    stepperInput()
});