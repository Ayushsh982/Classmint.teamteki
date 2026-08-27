jQuery(document).ready(function($){

    $(document).on('click', '#ac-repairing-services-welcome-notice .notice-dismiss', function(){

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'sirat_dismiss_notice'
            }
        });

    });

});