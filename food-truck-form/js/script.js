// <!-- Implemented by - Richard Yoshioka  -->

function clearOrder() {
    document.querySelector("#orderForm").reset();
}

document.addEventListener("DOMContentLoaded", function () {

    var tacoSelect = document.querySelector("#item");
    var drink = document.querySelector("#drink");
    var quantityMul = document.querySelector("#quantity");
    var priceContent = document.querySelector("#price");

    function changePrice() {
    // tacoSelect.addEventListener("change", function () {
        // Get the selected option value from "taco" select element
        var selectedTaco = tacoSelect.value;

        // Update the price based on the selected taco
        price = 0;
        switch (selectedTaco) {
            case "vegan_taco":
                price = 1.99;
                break;
            case "mega_taco":
                price = 2.99;
                break;
            case "ultra_taco":
                price = 10.99;
                break;
            case "uber_taco":
                price = 50.99;
                break;
            default:
                price = 0;
        }
        price = price * quantityMul.value;
        if (drink.value === "tea") {
            price = price + 1.99;
        } else if (drink.value === "water") {
            price = price + 0.99;
        } else if (drink.value === "coke") {
            price = price + 1.49;
        } else if (drink.value === "drpepper") {
            price = price + 1.49;
        } else if (drink.value === "orange") {
            price = price + 2.99;
        }
        priceContent.value = price.toFixed(2).toString();

        tacoResult = document.querySelector("#taco-result");
        quantityResult = document.querySelector("#quantity-result");
        drinkResult = document.querySelector("#drink-result");
        
        tacoResult.value = tacoSelect.value;
        quantityResult.value = quantityMul.value;
        drinkResult.value = drink.value;
    }

    tacoSelect.addEventListener("change", changePrice);
    drink.addEventListener("change", changePrice);
    quantityMul.addEventListener("change", changePrice);

    // Get the submit button element
    var submitBtn = document.getElementById("submit-btn");


});
