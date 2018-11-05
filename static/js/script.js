
$(document).ready(function () {
    var showed = true;
    if (showed) {
        $('.hamburger').on('click', function () {
            if (showed) {
                $("#menu").css("transform", "translateY(0)");
                $('body').toggleClass("is-active");
                $("#menu").css("z-index", "10");
                showed = false;
            } else {
                $("#menu").css("transform", "translateY(-100%)");
                $('body').toggleClass("is-active");
                $("#menu").css("z-index", "-1");
                showed = true;
            }

        });
    }
    /*$('#scroll-down').click(function () {
        $("html, body").animate({
            scrollTop: $(".header").height() + $(".header").offset().top
        }, "slow");
    })*/

    var waypoints = $('.from-left-mover').waypoint({
        handler: function (direction) {
            $(this.element).addClass('visible animated fadeInLeft');
        },
        offset: '80%'

    })

    var waypoints = $('.from-right-mover').waypoint({
        handler: function (direction) {
            $(this.element).addClass('visible animated fadeInRight');
        },
        offset: '80%'

    });

    // window.onscroll = function () { scrollFunction() };

    // function scrollFunction() {
    //     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    //         $('#toTop').show();
    //     } else {
    //         $('#toTop').hide();
    //     }
    // }

    // When the user clicks on the button, scroll to the top of the document
    $('#toTop').on('click', function () {
        $('html,body').animate({ scrollTop: 0 }, 'slow');
    });

    $('#showGallery').on('click', function () {
        $('#form-gallery').addClass("display-block");
    });

});




