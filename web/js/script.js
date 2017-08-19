angular.module('Topper', [])

.controller('scroll', function(){        

        $(window).scroll(function () {
         if ($(this).scrollTop() > 100) {
         $('.btn-scroll-up').addClass('display');
         } else {
         $('.btn-scroll-up').removeClass('display');
         }
        });

        $('.goToTop').click(function () {
            $(window).scrollTop(0,0);
            return false;
        });
    })