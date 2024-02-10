function click1(event) {
    event.preventDefault();
    let count = document.getElementsByName("count");
    let result = document.getElementById("result");
    let m = count[0].value.match(/^\d+$/);
    if (m == null) {
        result.innerHTML = "Ошибка ввода количества товара";
        return false
    }
    let product = document.getElementsByName("goods");
    result.innerHTML = "Стоимость: " + parseInt(count[0].value) * parseInt(product[0].value);
    return false;
}
document.addEventListener("DOMContentLoaded", function (event) {
    console.log("DOM fully loaded and parsed");
    let a = document.getElementById("button1");
    a.addEventListener("click", click1);
});