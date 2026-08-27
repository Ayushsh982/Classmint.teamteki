function sirat_menu_open_nav() {
	window.sirat_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function sirat_menu_close_nav() {
	window.sirat_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'
   	});
});

jQuery(document).ready(function () {
	window.sirat_currentfocus=null;
  	sirat_checkfocusdElement();
	var sirat_body = document.querySelector('body');
	sirat_body.addEventListener('keyup', sirat_check_tab_press);
	var sirat_gotoHome = false;
	var sirat_gotoClose = false;
	window.sirat_responsiveMenu=false;
 	function sirat_checkfocusdElement(){
	 	if(window.sirat_currentfocus=document.activeElement.className){
		 	window.sirat_currentfocus=document.activeElement.className;
	 	}
 	}
 	function sirat_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.sirat_responsiveMenu){
			if (!e.shiftKey) {
				if(sirat_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				sirat_gotoHome = true;
			} else {
				sirat_gotoHome = false;
			}

		}else{

			if(window.sirat_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.sirat_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.sirat_responsiveMenu){
				if(sirat_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					sirat_gotoClose = true;
				} else {
					sirat_gotoClose = false;
				}
			
			}else{

			if(window.sirat_responsiveMenu){
			}}}}
		}
	 	sirat_checkfocusdElement();
	}
});

(function( $ ) {
	jQuery(document).ready(function () {
		$(window).scroll(function () {
		    if ($(this).scrollTop() > 100) {
		        $('.scrollup').fadeIn();
		    } else {
		        $('.scrollup').fadeOut();
		    }
		});
		$('.scrollup').click(function () {
		    $("html, body").animate({
		        scrollTop: 0
		    }, 600);
		    return false;
		});
	});

	jQuery('document').ready(function($){
	    setTimeout(function () {
    		jQuery("#preloader").fadeOut("slow");
	    },1000);
	});
	
	$(window).scroll(function(){
		var sticky = $('.header-sticky'),
			scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('header-fixed');
		else sticky.removeClass('header-fixed');
	});
})( jQuery );

/*sticky sidebar*/
window.addEventListener('scroll', function() {
  var sticky = document.querySelector('.sidebar-sticky');
  if (!sticky) return;

  var scrollTop = window.scrollY || document.documentElement.scrollTop;
  var windowHeight = window.innerHeight;
  var documentHeight = document.documentElement.scrollHeight;

  var isBottom = scrollTop + windowHeight >= documentHeight-100;

  if (scrollTop >= 100 && !isBottom) {
    sticky.classList.add('sidebar-fixed');
  } else {
    sticky.classList.remove('sidebar-fixed');
  }
});

/*sticky copyright*/
window.addEventListener('scroll', function() {
  var sticky = document.querySelector('.copyright-sticky');
  if (!sticky) return;

  var scrollTop = window.scrollY || document.documentElement.scrollTop;
  var windowHeight = window.innerHeight;
  var documentHeight = document.documentElement.scrollHeight;

  var isBottom = scrollTop + windowHeight >= documentHeight-100;

  if (scrollTop >= 100 && !isBottom) {
    sticky.classList.add('copyright-fixed');
  } else {
    sticky.classList.remove('copyright-fixed');
  }
});

jQuery(document).ready(function () {
	  function sirat_search_loop_focus(element) {
	  var sirat_focus = element.find('select, input, textarea, button, a[href]');
	  var sirat_firstFocus = sirat_focus[0];  
	  var sirat_lastFocus = sirat_focus[sirat_focus.length - 1];
	  var KEYCODE_TAB = 9;

	  element.on('keydown', function sirat_search_loop_focus(e) {
	    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	    if (!isTabPressed) { 
	      return; 
	    }

	    if ( e.shiftKey ) /* shift + tab */ {
	      if (document.activeElement === sirat_firstFocus) {
	        sirat_lastFocus.focus();
	          e.preventDefault();
	        }
	      } else /* tab */ {
	      if (document.activeElement === sirat_lastFocus) {
	        sirat_firstFocus.focus();
	          e.preventDefault();
	        }
	      }
	  });
	}
	jQuery('.search-box span a').click(function(){
        jQuery(".serach_outer").slideDown(1000);
    	sirat_search_loop_focus(jQuery('.serach_outer'));
    });

    jQuery('.closepop a').click(function(){
        jQuery(".serach_outer").slideUp(1000);
    });
});

/* Progress Bar */
document.addEventListener("DOMContentLoaded", function () {
    const sirat_progressBar =
        document.getElementById("sirat_elemento_progress_bar");
    if (!sirat_progressBar) return;
    window.addEventListener("scroll", function () {
        const sirat_scrollTop =
            document.documentElement.scrollTop || document.body.scrollTop;
        const sirat_height =
            document.documentElement.scrollHeight -
            document.documentElement.clientHeight;
        const sirat_scrolled =
            (sirat_scrollTop / sirat_height) * 100;
        sirat_progressBar.style.width =
            sirat_scrolled + "%";
    });
});