jQuery(document).ready(function() {
    // Add WP Data Access dashboard to Freemius pages
    jQuery("#screen-meta").after(dashboard.content)

    // Run "wpda_dashboard.js" main function to show toolbar
    jQuery(window).on("resize", function() { setDashboardWidth() });
    setDashboardWidth();
    makeSortable();
})