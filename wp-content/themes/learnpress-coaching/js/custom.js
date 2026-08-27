jQuery(function($){
	"use strict";
	jQuery('.main-menu-navigation > ul').superfish({
		delay:       500,                            
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'                        
	});

});

function learnpress_coaching_menu_open() {
	jQuery(".menu-brand.primary-nav").addClass('show');
}
function learnpress_coaching_menu_close() {
	jQuery(".menu-brand.primary-nav").removeClass('show');
}

var learnpress_coaching_Keyboard_loop = function (elem) {

    var learnpress_coaching_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');

    var learnpress_coaching_firstTabbable = learnpress_coaching_tabbable.first();
    var learnpress_coaching_lastTabbable = learnpress_coaching_tabbable.last();

    /*redirect last tab to first input*/
    learnpress_coaching_lastTabbable.on('keydown', function (e) {
        if ((e.which === 9 && !e.shiftKey)) {
            e.preventDefault();
            learnpress_coaching_firstTabbable.focus();
        }
    });

    /*redirect first shift+tab to last input*/
    learnpress_coaching_firstTabbable.on('keydown', function (e) {
        if ((e.which === 9 && e.shiftKey)) {
            e.preventDefault();
            learnpress_coaching_lastTabbable.focus();
        }
    });

    /* allow escape key to close insiders div */
    elem.on('keyup', function (e) {
        if (e.keyCode === 27) {
            elem.hide();
        }
        ;
    });
};

/**** Hidden search box ***/
jQuery('document').ready(function($){
    $('.main-search span a').click(function(){
        $(".searchform_page").slideDown(500);
        learnpress_coaching_Keyboard_loop($('.searchform_page'));
    });

    $('.close a').click(function(){
        $(".searchform_page").slideUp(0);
    });
}); 

// scroll
jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 0) {
	        jQuery('#scrollbutton').fadeIn();
	    } else {
	        jQuery('#scrollbutton').fadeOut();
	    }
	});
	jQuery(window).on("scroll", function () {
	   document.getElementById("scrollbutton").style.display = "block";
	});
	jQuery('#scrollbutton').click(function () {
	    jQuery("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});
});

jQuery(function($){
	$('.mobiletoggle').click(function () {
        learnpress_coaching_Keyboard_loop($('.menu-brand.primary-nav'));
    });
});

// preloader
jQuery(function($){
    setTimeout(function(){
        $(".frame").delay(1000).fadeOut("slow");
    });
});

// sticky header
(function( $ ) {

    $(window).scroll(function(){
        var sticky = $('.sticky-header'),
        scroll = $(window).scrollTop();

        if (scroll >= 100) sticky.addClass('fixed-header');
        else sticky.removeClass('fixed-header');
    });

})( jQuery );

// sticky copyright
(function ($) {
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        var sticky = $('.sticky-copyright');

        if (sticky.length) {
            if (scroll >= 100) {
                sticky.addClass('fixed-copyright');
            } else {
                sticky.removeClass('fixed-copyright');
            }
        }
    });
})(jQuery);

/* Progress Bar */
document.addEventListener("DOMContentLoaded", function () {
    const learnpress_coaching_progressBar =
        document.getElementById("learnpress_coaching_elemento_progress_bar");
    if (!learnpress_coaching_progressBar) return;
    window.addEventListener("scroll", function () {
        const learnpress_coaching_scrollTop =
            document.documentElement.scrollTop || document.body.scrollTop;
        const learnpress_coaching_height =
            document.documentElement.scrollHeight -
            document.documentElement.clientHeight;
        const learnpress_coaching_scrolled =
            (learnpress_coaching_scrollTop / learnpress_coaching_height) * 100;
        learnpress_coaching_progressBar.style.width =
            learnpress_coaching_scrolled + "%";
    });
});

