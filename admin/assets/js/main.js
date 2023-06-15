//top-button
$('.btnTop').click(function () {
    $(window).scrollTop(0);
});
$(window).scroll(function () {
    let t = $(window).scrollTop();

    if (t >= 300) {
        $('.btnTop').css('display', 'block');
    }
    else {
        $('.btnTop').css('display', 'none');
    }
});

// navbar-color
$(window).scroll(function () {
    let t = $(window).scrollTop();

    if (t >= 50) {
        $('.navbar').addClass('fixed-top');
        $('.navbar').addClass('z-3');
        $('.navbar').css('transition', '5s');
    }
    else {
        $('.navbar').removeClass('fixed-top');
    }
});