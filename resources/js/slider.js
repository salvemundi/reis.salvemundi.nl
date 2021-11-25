window.onload = function() {
    $('.imgSlider').slick({
        dots: false,
        infinite: true,
        autoplay: false,
        speed: 500,
        fade: true,
        arrows: true,
        cssEase: 'linear',
        nextArrow: '<button type="button" unselectable="on" class="slick-right"></button>',
        prevArrow: '<button type="button" unselectable="on" class="slick-left"></button>',
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    arrows: false,
                    fade: false
                }
            }
        ]
      });
}
