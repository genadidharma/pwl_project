var index = 0;
var items = [];

var table = document.querySelector("#table");
var btnAddMore = document.querySelector("#add_more");

function addMoreClick() {
    let prevRow = table.rows[index];
    let prevSelect = prevRow.querySelector("select");
    let selectedValue = prevSelect.value;

    let prevChoices = prevRow.querySelector(".choices");
    prevChoices.setAttribute("aria-disabled", "true");
    prevChoices.classList.add("is-disabled");

    items.push(selectedValue);

    ++index;
    table
        .getElementsByTagName("tbody")[0]
        .insertAdjacentHTML("beforeend", rowTemplate(index));

    let choices = document.querySelectorAll(".new-choices");
    let currentRow = table.rows.length - 1;

    let select = choices[currentRow - 1];
    items.forEach((value) => {
        select.removeChild(select.querySelector(`option[value='${value}']`));
    });

    let maxValue = Object.values(JSON.parse(select.value))[1];
    table.rows[index]
        .querySelector(".input-number")
        .setAttribute("max", maxValue);

    if (select.options.length == 1) {
        btnAddMore.classList.add("d-none");
    }

    let initChoice = new Choices(choices[currentRow - 1]);
    feather.replace();
}

function removeItem(el) {
    let currentRow = el.parentNode.parentNode;

    let select = currentRow.querySelector("select");
    items.splice(items.indexOf(select.value), 1);

    let i = currentRow.rowIndex;
    table.deleteRow(i);
    --index;

    let prevRow = table.rows[index];
    let prevChoices = prevRow.querySelector(".choices");
    prevChoices.removeAttribute("aria-disabled");
    prevChoices.classList.remove("is-disabled");

    btnAddMore.classList.remove("d-none");
}
