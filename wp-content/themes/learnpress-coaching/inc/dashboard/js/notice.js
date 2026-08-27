jQuery(document).ready(function($){

    $(document).on('click', '#learnpress-coaching-welcome-notice .notice-dismiss', function(){

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'learnpress_coaching_dismiss_notice'
            }
        });

    });

});