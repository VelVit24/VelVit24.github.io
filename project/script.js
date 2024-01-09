$(document).ready(function () {
    $('.reviews-slider').slick({
        infinite: true,
        speed: 500,
        fade: true,
        prevArrow: $('.reviews-prev'),
        nextArrow: $('.reviews-next'),
        adaptiveHeight: true
    });
    $('.slider-customers-1').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        centerMode: true,
        arrows: false,
        autoplay: true,
        centerPadding: "10%",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    centerPadding: "14%",
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    })
    $('.slider-customers-2').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 6,
        centerMode: true,
        arrows: false,
        autoplay: true,
        adaptiveHeight: false,
        centerPadding: "1%",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    centerPadding: "0",
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerPadding: "29%",
                }
            }
        ]
    })
});

$('.reviews-slider').on('init reInit afterChange', function(event, slick, direction, currentSlide, slideCount) {
    let i = (direction == undefined ? 1 : direction+1);
    i = i > 10 ? i : '0' + i;
    let count = slick.slideCount > 10 ? slick.slideCount : '0' + slick.slideCount;
    $('.slider-num').html('<span class="slider-num-cur">' + i + '</span>' + ' / ' + count);
});

$(document).ready(function() {
    $('.faq-wrap .grey-text').css("display","none");
    $(".faq-cont-box").on("click", function() {
        if ($(this).children(".grey-text").css("display") == "none") {
            $(this).children(".grey-text").css("display", "block");
            $(this).css("border", "3px solid #F14D34");
        }
        else {
            $(this).children(".grey-text").css("display", "none");
            $(this).css("border", "none");
        }
    });
    $('.nav-bar-drop').hover(function () {
        if ($(document).width() > 768)
            $(this).children('.drop-menu').toggleClass("nav-bar-hide");
    }, function () {
        if ($(document).width() > 768)
            $(this).children('.drop-menu').toggleClass("nav-bar-hide");
    });
    $('.nav-bar li').hover(function () {
        if ($(document).width() > 768 && !$(this).hasClass("nav-active"))
            $(this).css("border-bottom", "3px solid #F14D34");
    }, function () {
        if ($(document).width() > 768 && !$(this).hasClass("nav-active"))
            $(this).css("border", "none");
    });
    $('.nav-mobile').on("click", function () {
        $('.nav-bar').toggleClass("nav-bar-hide");
    });
    $('.tarif-button').on("click", function (){
        location.href = "#id-tariffs";
    });
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
                }
            });
        });
    });
})
