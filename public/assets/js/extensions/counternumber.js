function initMax(el){
    alert('hey')
}

function onBtnNumberClick(e, el) {
    e.preventDefault();

    fieldName = $(el).attr("data-field");
    type = $(el).attr("data-type");
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type == "minus") {
            if (currentVal > input.attr("min")) {
                input.val(currentVal - 1).change();
            }
            if (parseInt(input.val()) == input.attr("min")) {
                $(el).attr("disabled", true);
            }
        } else if (type == "plus") {
            if (currentVal < input.attr("max")) {
                input.val(currentVal + 1).change();
            }
            if (parseInt(input.val()) == input.attr("max")) {
                $(el).attr("disabled", true);
            }
        }
    } else {
        input.val(0);
    }
}
function onChoicesChange(e, el) {
    e.preventDefault();

    parent = $(el).parents(".choices-col").next()

    inputNumber = parent.find(".input-number");
    parent.find(".btn-number[data-type='minus']").attr("disabled", true);
    parent.find(".btn-number[data-type='plus']").removeAttr("disabled");
    inputNumber.val(1);

    obj = JSON.parse($("option:selected", el).val().toString());
    maxValue = Object.values(obj)[1];

    inputNumber.attr("max", parseInt(maxValue));
}
function onInputNumberFocusIn(el) {
    $(el).data("oldValue", $(el).val());
}
function onInputNumberChange(el) {
    minValue = parseInt($(el).attr("min"));
    maxValue = parseInt($(el).attr("max"));
    valueCurrent = parseInt($(el).val());

    name = $(el).attr("name");
    if (valueCurrent >= minValue) {
        $(
            ".btn-number[data-type='minus'][data-field='" + name + "']"
        ).removeAttr("disabled");
    } else {
        alert("Sorry, the minimum value was reached");
        $(el).val($(el).data("oldValue"));
    }
    if (valueCurrent <= maxValue) {
        $(
            ".btn-number[data-type='plus'][data-field='" + name + "']"
        ).removeAttr("disabled");
    } else {
        alert("Sorry, the maximum value was reached");
        $(el).val($(el).data("oldValue"));
    }
}
function onInputNumberKeydown(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if (
        $.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)
    ) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if (
        (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
        (e.keyCode < 96 || e.keyCode > 105)
    ) {
        e.preventDefault();
    }
}
