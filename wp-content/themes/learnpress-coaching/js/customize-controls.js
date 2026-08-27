( function( api ) {

	// Extends our custom "learnpress-coaching" section.
	api.sectionConstructor['learnpress-coaching'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

(function ($) {
    function ResetDemoSettings() {
        if (!confirm("Are you sure you want to reset demo import settings?")) return;

        $.post(ajaxurl, { action: 'learnpress_coaching_reset_demo_import_settings' }, function () {
            location.reload();
        });
    }

    window.ResetDemoSettings = ResetDemoSettings;
})(jQuery);

(function ($, wp) {
    function ResetGlobalColor() {
        if (confirm("Are you sure you want to reset global color settings?")) {
            wp.customize.instance("learnpress_coaching_first_color").set("#8b6aff");
            wp.customize.instance("learnpress_coaching_second_color").set("#1a3e58");
        }
    }

    window.ResetGlobalColor = ResetGlobalColor;
})(jQuery, wp);
