/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************!*\
  !*** ./src/block.js ***!
  \**********************/
(function ($) {
  'use strict';

  function jbSliderBlock() {
    if ($('.jb-slider-inner').length > 0) {
      var slidestoshow = 1,
          arrowcontrol = false,
          slideSpeed = 1000,
          slidestosroll = 1;
      $('.jb-slider-inner').each(function (e) {
        slidestoshow = parseInt($(this).attr('data-slidetoshow')), arrowcontrol = $(this).attr('data-arrowcontrol'), slideSpeed = parseInt($(this).attr('data-sliderspeed')), slidestosroll = parseInt($(this).attr('data-slidestoscroll'));

        if (arrowcontrol == "true") {
          arrowcontrol = true;
        } else {
          arrowcontrol = false;
        }

        $(this).slick({
          autoplay: true,
          arrows: arrowcontrol,
          slidestosroll: slidestosroll,
          slidesToShow: slidestoshow,
          speed: slideSpeed
        });
      });
    }
  }

  function jbTestimonial() {
    if ($('.jb-testimonial-list-wrapper').length > 0) {
      $('.jb-testimonial-list-wrapper').each(function (e) {
        $(this).slick({
          autoplay: true,
          arrows: false,
          dots: true,
          slidesToShow: 1
        });
      });
    }
  }

  function fixedHeader() {
    if ($('.home').length > 0) {
      $(window).scroll(function () {
        if (window.pageYOffset > 0) {
          $('.site-header').addClass('fixed-header');
          $('#site-navigation').addClass('navbar-light');
          $('#site-navigation').removeClass('navbar-dark');
        } else {
          $('.site-header').removeClass('fixed-header');
          $('#site-navigation').removeClass('navbar-light');
          $('#site-navigation').addClass('navbar-dark');
        }
      });
      $('.menu-item-has-children').on('mouseover', function () {
        if (window.pageYOffset == 0) {
          $('.site-header').addClass('fixed-header');
        }
      });
      $('.site-header').on('mouseout', function () {
        if (window.pageYOffset == 0) {
          $('.site-header').removeClass('fixed-header');
        }
      });
    } else {
      $('.site-header').addClass('fixed-header');
    }
  }

  function defaultPostList() {
    if ($('.wp-block-post-template').length > 0) {
      $('.wp-block-post-template').find('time').each(function (e) {
        if ($(this).find('i').length == 0) {
          $(this).prepend('<i class="far fa-calendar-alt"></i>');
        }
      });
    }
  }

  function smoothScroll() {
    // Select all links with hashes
    $('a[href*="#"]') // Remove links that don't actually link to anything
    .not('[href="#"]').not('[href="#0"]').click(function (event) {
      // On-page links
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']'); // Does a scroll target exist?

        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          //	event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top - 80
          }, 500, function () {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();

            if ($target.is(":focus")) {
              // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable

              $target.focus(); // Set focus again
            }

            ;
          });
        }
      }
    });
  }

  $(window).load(function () {
    $('body').addClass('loaded');
    ScrollOut({
      onShown(el) {
        if (el.classList.contains('fadeInUp')) {
          el.classList.add("animate__fadeInUp");
        } else if (el.classList.contains('fadeInLeft')) {
          el.classList.add("animate__fadeInLeft");
        } else if (el.classList.contains('fadeInRight')) {
          el.classList.add("animate__fadeInRight");
        }
      }

    });
  });
  $(document).ready(function () {
    smoothScroll();
    fixedHeader();
    defaultPostList();
    jbSliderBlock();
    jbTestimonial();
  });
})(jQuery);
/******/ })()
;
//# sourceMappingURL=block.js.map