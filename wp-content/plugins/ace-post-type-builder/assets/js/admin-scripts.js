jQuery(document).ready(function($) {
    //console.log('Admin scripts loaded');
});

jQuery(document).ready(function($) {
    $(document).on('click', '.notice.is-dismissible', function() {
        $.post(cptb_ajax_object.ajax_url, {
            action: 'cptb_dismiss_notice',
            nonce: cptb_ajax_object.nonce
        });
    });
});
