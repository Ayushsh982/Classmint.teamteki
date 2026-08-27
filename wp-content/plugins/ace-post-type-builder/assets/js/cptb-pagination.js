jQuery(document).ready(function($) {
 
    var page = 1;
    var isLoading = false;

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !isLoading) {            
            loadMoreProducts();
        }
    });

    function productsAjax( endCursor, templateSearch, collection, actionValue ) {

        var progress = 0;
        var progressInterval = setInterval(function() {
            progress += 10;
            if (progress >= 100) {
                clearInterval(progressInterval);
            }
        }, 300);

        $.ajax({
            url: cptb_pagination_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'cptb_get_filtered_products',
                cursor: endCursor,
                search: templateSearch,
                collection: collection,
                cptb_pagination_nonce: cptb_pagination_object.nonce
            },
            success: function (response) {

                clearInterval(progressInterval);
                jQuery('.cptb-loader').hide();
                jQuery('.cptb-loader-overlay').hide();

                if (response.content) {

                    isLoading = false;

                    if ( actionValue != 'load' ) {
                        jQuery('.cptb-filter-content.cptb-main-grid').empty();
                    }
                    jQuery('.cptb-filter-content.cptb-main-grid').append(response.content);

                    const hasNextPage = response?.pagination?.hasNextPage;
                    const endCursor = response?.pagination?.endCursor;

                    jQuery('[name="cptb-end-cursor"]').val(endCursor);
                    if (!hasNextPage) {
                        jQuery('[name="cptb-end-cursor"]').val('');
                        isLoading = true
                    }
                }
            },
            error: function () {
                
                clearInterval(progressInterval);
                jQuery('.cptb-loader').hide();
                jQuery('.cptb-loader-overlay').hide();

                console.log('Error loading products');
            }
        });
    }

    function loadMoreProducts() {
        isLoading = true;
        page++;

        const endCursor = jQuery('[name="cptb-end-cursor"]').val();
        const templateSearch = jQuery('[name="cptb-templates-search"]').val();
        const collection = jQuery('[name="cptb-collections"]').val();

        productsAjax( endCursor, templateSearch, collection, 'load' );
    }

    function debounce(func, delay) {
        let timeoutId;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                func.apply(context, args);
            }, delay);
        };
    }

    jQuery('.cptb-templates-collections-group li').on('click', function() {

        jQuery('.cptb-loader').show();
        jQuery('.cptb-loader-overlay').show();

        let category = '';
        if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active');
        } else {
            jQuery('.cptb-templates-collections-group li').removeClass('active');
            jQuery(this).addClass('active');
            
            category = jQuery(this).attr('data-value');
        }

        jQuery('.cptb-templates-collections-group').removeClass('active');

        productsAjax( '', '', category, 'category' );
    });

    $('body').on("input", '[name="cptb-templates-search"]', debounce(function (event) {

        const templateSearch = $('[name="cptb-templates-search"]').val();

        jQuery('.cptb-loader').show();
        jQuery('.cptb-loader-overlay').show();
        
        productsAjax( '', templateSearch, '', 'search' );
        
    }, 1000));

    $('body').on("click", '.cptb-filter-category-select', function (event) {
        $('.cptb-templates-collections-group').toggleClass('active');
    });
});