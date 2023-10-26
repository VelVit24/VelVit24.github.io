$(document).ready(function(){
    $('.slider').slick({
        //variableWidth: true,
        prevArrow:"<img class='a-left control-c prev slick-prev' src='images/left-arrow.jpg'>",
        nextArrow:"<img class='a-right control-c next slick-next' src='images/right-arrow.jpg'>",
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
})