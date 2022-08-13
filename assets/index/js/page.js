$(document).ready(function () {
    $('.banner .owl-demo').owlCarousel({
        items: 1,
        singleItem: true,
        autoPlay: true,
        navigation: true,
        navigationText: ["", ""],
        lazyLoad: true,
        scrollPerPage: false,
        slideSpeed: 800,
    });
    $(window).scroll(function () {
        if (jQuery(this).scrollTop() > 1) {
            $(".header").addClass("header_scroll");
        } else {
            $(".header").removeClass("header_scroll");
        }
    });
    $(".aside ul li.consulting").click(function () {
        $(".aside ul li.consulting").addClass("active");
        $(".consulting_box").css("right", "40px");
    });
    $(".consulting_box .close").click(function () {
        $(".aside ul li.consulting").removeClass("active");
        $(".consulting_box").css("right", "-250px");
    });
    $(".header .mobileMenuBtn").click(function () {
        $(".header .mobileMenuBtn").toggleClass("active");
        $(".header .header_menu").toggleClass("active");
        $(".header .mobileMenuBtn_shad").toggleClass("active");
    });
    $(".header .mobileMenuBtn_shad").click(function () {
        $(".header .mobileMenuBtn").toggleClass("active");
        $(".header .header_menu").toggleClass("active");
        $(".header .mobileMenuBtn_shad").toggleClass("active");
    });
    var w_width = $(window).width();
    if (w_width < 767) {
        $(".technical_support_type .title").click(function () {
            $(".technical_support_type ul").slideToggle();
            $(".technical_support_type .title span").toggleClass("active");
        });
    } else {
    }
    if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))) {
        var wow = new WOW({boxClass: 'wow', animateClass: 'animated', offset: 150, mobile: true, live: true});
        wow.init();
    }
    ;var win_width = $(window).width();
    jQuery(window).resize(function () {
        var win_width = $(window).width();
    });
});