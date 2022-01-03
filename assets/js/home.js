$(document).ready(function() {
    // TRANSPARENT HEADER
    if($(document).scrollTop() < $('#header').outerHeight()) $('#header').addClass('bgTransparent');

    $(document).scroll(function() {
        if($(document).scrollTop() > $('#header').outerHeight()) $('#header').removeClass('bgTransparent');
        else $('#header').addClass('bgTransparent');
    });

    // SLIDESHOW
    $('.slide:not(:first)').hide();

    var sliderImages = $('.slide');
    var currentSlide = 0;
    var previousSlide;
    var sliderInterval = 5000;

    setInterval(changeSlide, sliderInterval);

    function changeSlide() {
        previousSlide = currentSlide;
        currentSlide++;
        if(currentSlide >= sliderImages.length) currentSlide = 0;
        $('.slide').eq(currentSlide).css('z-index', '-1').fadeIn(function() {
            $('.slide').eq(previousSlide).hide();
        });
        $('.slide').eq(previousSlide).css('z-index', '-2');
    }
});