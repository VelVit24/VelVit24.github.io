function updprice() {
    let count = document.getElementsByName("count");
    let result = document.getElementById("result");
    let m = count[0].value.match(/^\d+$/);
    if (m == null) {
        result.innerHTML = "Ошибка ввода количества товара";
    }
    else {
        let product = document.getElementsByName("product_type");
        let prices = getprice();
        let price = 0;
        let i = parseInt(product[0].value)-1;
        if (i >= 0) price = prices.product_type[i];

        let div_prop = document.getElementById("product_properties");
        div_prop.style.display = (i == 1 ? "block" : "none");

        let select_prop = document.querySelectorAll("#product_properties input");
        select_prop.forEach(function(checkbox) {
            if (checkbox.checked) {
                let price_sv = prices.product_properties[checkbox.name];
                if (price_sv !== undefined) {
                    price += price_sv;
                    console.log("pr");
            }
            }
        });

        let div_opt = document.getElementById("product_options");
        div_opt.style.display = (i == 2 ? "block" : "none");
        
        let selected_opt = document.getElementsByName("product_opt");
        selected_opt.forEach(function(radio) {
            if (radio.checked) {
                let price_opt = prices.product_opt[radio.value];
                if (price_opt !== undefined) {
                    price += price_opt;
                    console.log("opt");
                }
            }
        });
        
        price *= count[0].value;
        result.innerHTML = price + " рублей";
    }
}

function getprice() {
    return {
        product_type: [100,200,300],
        product_opt: {
            opt1: 20,
            opt2: 40,
            opt3: 72,
        },
        product_properties: {
            prop1: 100,
            prop2: 200,
        }
    };
}

document.addEventListener("DOMContentLoaded", function (event) {

    console.log("DOM fully loaded and parsed");
    document.getElementById("product_options").style.display = "none";
    document.getElementById("product_properties").style.display = "none";

    let count = document.getElementsByName("count");
    count[0].addEventListener("change", function(event) {updprice();})

    let select = document.getElementsByName("product_type");
    select[0].addEventListener("change", function(event){updprice();})

    let checkboxes = document.querySelectorAll("#product_properties input");
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", function(event){updprice();})
    })

    let radios = document.getElementsByName("product_opt");
    radios.forEach(function(radio) {
        radio.addEventListener("change", function(event){updprice();})
    })
    updprice();
});