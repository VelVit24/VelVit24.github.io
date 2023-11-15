let modal = document.getElementById("modal_1");
let button_form = document.getElementById("button1");

window.addEventListener('popstate',function(){
    modal.style.display="none";
})

button_form.addEventListener('click', function() {
    history.pushState({page:2}, "title 2", "?form");
    document.getElementById("name1").value = localStorage.getItem("field-name-1");
    document.getElementById("tel1").value = localStorage.getItem("field-tel");
    document.getElementById("email1").value = localStorage.getItem("field-email");
    document.getElementById("org1").value = localStorage.getItem("field-org");
    document.getElementById("mess1").value = localStorage.getItem("field-messege");
    modal.style.display="block";
})

let but2 = document.getElementById("button3");
but2.addEventListener('click', function() {
    history.back();
})

let name2 = document.getElementById("name1");
name2.addEventListener("change", function() {
    localStorage.setItem("field-name-1", name2.value);
})

let tel2 = document.getElementById("tel1");
tel2.addEventListener("change", function() {
    localStorage.setItem("field-tel", tel2.value);
})

let email2 = document.getElementById("email1");
email2.addEventListener("change", function() {
    localStorage.setItem("field-email", email2.value);
})

let org2 = document.getElementById("org1");
org2.addEventListener("change", function() {
    localStorage.setItem("field-org", org2.value);
})

let mess2 = document.getElementById("mess1");
mess2.addEventListener("change", function() {
    localStorage.setItem("field-messege", mess2.value);
})

$(function(){
    $(".formcarryForm").submit(function(e){
      e.preventDefault();
      var href = $(this).attr("action");
      $.ajax({
          type: "POST",
          url: href,
          data: new FormData(this),
          dataType: "json",
          processData: false,
          contentType: false,
          success: function(response){
            if(response.status == "success"){
                alert("We received your submission, thank you!");
            }
            else if(response.code === 422){
              alert("Field validation failed");
              $.each(response.errors, function(key) {
                $('[name="' + key + '"]').addClass('formcarry-field-error');
              });
            }
            else{
              alert("An error occured: " + response.message);
            }
          },
          error: function(jqXHR, textStatus){
            const errorObject = jqXHR.responseJSON
  
            alert("Request failed, " + errorObject.title + ": " + errorObject.message);
          },
          complete: function(){
            history.back();
            localStorage.removeItem("field-name-1");
            localStorage.removeItem("field-tel");
            localStorage.removeItem("field-email");
            localStorage.removeItem("field-org");
            localStorage.removeItem("field-messege");
          }
      });
    });
  });