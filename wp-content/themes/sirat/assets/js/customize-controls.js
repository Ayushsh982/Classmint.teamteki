( function( api ) {

	// Extends our custom "sirat" section.
	api.sectionConstructor['sirat'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

// Override change-theme button behavior - Show popup only first time
document.addEventListener('DOMContentLoaded', function() {
	// Use capture phase to intercept clicks BEFORE WordPress handlers
	document.addEventListener('click', function(e) {
		var target = e.target;

		// Check if clicked element is or is within a .change-theme button
		if (target && (target.classList.contains('change-theme') || target.closest('.change-theme'))) {
			// Check if popup has been shown and closed
			var popupShown = (typeof siratCustomizer !== 'undefined') ? siratCustomizer.popupShown : '0';

			if (popupShown === '1') {
				// Popup already shown, let button work normally
				// Don't prevent default, let WordPress handle it
				return true;
			} else {
				// First time - show popup
				e.preventDefault();
				e.stopPropagation();
				e.stopImmediatePropagation();

				// Show Buy Pro popup
				var popup = document.getElementById('buy-pro-popup');
				if (popup) {
					jQuery(popup).fadeIn(300);
				}
				return false;
			}
		}
	}, true); // TRUE = capture phase (runs before bubble phase and other handlers)
});

jQuery( document ).ready(function($) {
	var this_obj = sirat_customizer_params;
  	var api = wp.customize;

	// Reset options
	$('.refresh-btn').on('click', function() {
		var dataValue = $(this).attr('data-value');
		$.get( sirat_customizer_params.ajaxurl + '?action=' + dataValue, function( data ) {
	  		window.location.reload();
		});
	});

	$('.reset-button').on('click', function() {
		var $this = $(this);
		$this.closest('.customize-control').find('.kt-modal').show();
	});

	$('.close').on('click', function() {
		$(this).closest('.kt-modal').hide();
	});

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if ($(event.target).hasClass('kt-modal')) {
		  $('.kt-modal').hide();
		}
	}

	// Create popup HTML
	var popupHTML = '<div id="theme-change-popup" class="theme-popup-overlay" style="display:none;">' +
		'<div class="theme-popup-content">' +
		'<span class="theme-popup-close">&times;</span>' +
		'<h2>Change Theme</h2>' +
		'<div class="theme-popup-body">' +
		'<p>Are you sure you want to change the theme?</p>' +
		'<p>This will take you to the themes page where you can select a new theme.</p>' +
		'<div class="theme-popup-buttons">' +
		'<button class="button button-primary theme-confirm-change">Yes, Change Theme</button>' +
		'<button class="button theme-cancel-change">Cancel</button>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>';

	// Append popup to body if not exists
	if ($('#theme-change-popup').length === 0) {
		$('body').append(popupHTML);
	}

	// Handle close button
	$(document).on('click', '.theme-popup-close, .theme-cancel-change', function() {
		$('#theme-change-popup').fadeOut(300);
	});

	// Handle confirm button
	$(document).on('click', '.theme-confirm-change', function() {
		$('#theme-change-popup').fadeOut(300);
		// Navigate to themes page after popup closes
		setTimeout(function() {
			window.location.href = $('.change-theme').attr('href');
		}, 300);
	});

	// Create Buy Pro popup HTML
	var buyProPopupHTML = '<div id="buy-pro-popup" class="theme-popup-overlay buy-pro-overlay" style="display:none;">' +
		'<div class="theme-popup-content buy-pro-content">' +
		'<span class="theme-popup-close buy-pro-close">&times;</span>' +
		'<div class="welcome-notice-popup">' +
		'<div class="notice-text">' +
		'<p class="welcome-text1">🎉Before Switching Sirat…</p>' +
		'<p class="welcome-text2">Unlock its Premium Version for more power, features, and design control.</p>' +
		'<p class="welcome-text3">Or get 485+ themes in one bundle at $99</p>' +
		'<div class="pro-popup-buttons">' +
		'<a href="https://www.vwthemes.com/products/multipurpose-wordpress-theme" class="button button-primary upgrade-pro-btn" target="_blank">UPGRADE TO PRO</a>' +
		'<a href="https://www.vwthemes.com/products/wp-theme-bundle" class="button button-primary bundle-btn" target="_blank">BUNDLE OF 485+ THEMES</a>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>' +
		'</div>';

	// Append Buy Pro popup to body if not exists
	if ($('#buy-pro-popup').length === 0) {
		$('body').append(buyProPopupHTML);
	}

	// Prevent default action on pro popup buttons inside popup
	$(document).on('click', '.pro-popup-buttons a', function(e) {
		// Allow the link to open in new tab
		if ($(this).attr('target') === '_blank') {
			// Let it work normally
		} else {
			// For demo import, navigate
			window.location.href = $(this).attr('href');
			e.preventDefault();
		}
	});

	// Handle close button for Buy Pro popup
	$(document).on('click', '.buy-pro-close', function() {
		// Mark popup as shown in database via AJAX
		$.ajax({
			url: siratCustomizer.ajaxUrl,
			type: 'POST',
			data: {
				action: 'sirat_customizer_popup_shown',
				nonce: siratCustomizer.nonce
			},
			success: function() {
				// Update the flag so next click works immediately
				siratCustomizer.popupShown = '1';
			}
		});
		$('#buy-pro-popup').fadeOut(300);
	});

	// Close Buy Pro popup when clicking outside
	$(document).on('click', '.buy-pro-overlay', function(e) {
		if (e.target === this) {
			// Mark popup as shown in database via AJAX
			$.ajax({
				url: siratCustomizer.ajaxUrl,
				type: 'POST',
				data: {
					action: 'sirat_customizer_popup_shown',
					nonce: siratCustomizer.nonce
				},
				success: function() {
					// Update the flag so next click works immediately
					siratCustomizer.popupShown = '1';
				}
			});
			$(this).fadeOut(300);
		}
	});

	// Additional jQuery handler for change-theme button
	$(document).on('click', '.change-theme', function(e) {
		var popupShown = siratCustomizer.popupShown;

		if (popupShown === '1') {
			// Popup already shown, let button work normally
			return true;
		} else {
			// First time - show popup
			e.preventDefault();
			e.stopPropagation();
			e.stopImmediatePropagation();
			$('#buy-pro-popup').fadeIn(300);
			return false;
		}
	});

	// Wait for customizer and override any WordPress handlers
	if (typeof wp !== 'undefined' && typeof wp.customize !== 'undefined') {
		wp.customize.bind('ready', function() {
			setTimeout(function() {
				// Remove WordPress default handlers
				$('.change-theme').off('click');

				// Re-attach our handler with database check
				$('.change-theme').on('click', function(e) {
					var popupShown = siratCustomizer.popupShown;

					if (popupShown === '1') {
						// Popup already shown, let button work normally
						return true;
					} else {
						// First time - show popup
						e.preventDefault();
						e.stopPropagation();
						e.stopImmediatePropagation();
						$('#buy-pro-popup').fadeIn(300);
						return false;
					}
				});
			}, 100);
		});
	}

});