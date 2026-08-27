<?php
function cptb_get_collections()
{

    $endpoint_url = CPTB_MAIN_URL . 'getCollections';

    $options = [
        'body' => [],
        'headers' => [
            'Content-Type' => 'application/json'
        ]
    ];
    $response = wp_remote_post($endpoint_url, $options);

    if (!is_wp_error($response)) {
        $response_body = wp_remote_retrieve_body($response);
        $response_body = json_decode($response_body);

        if (isset($response_body->data) && !empty($response_body->data)) {
            return $response_body->data;
        }
        return [];
    }

    return [];
}

function cptb_get_filtered_products($cursor = '', $search = '', $collection = 'premium-wordpress-templates')
{
    $endpoint_url = CPTB_MAIN_URL . 'getFilteredProducts';

    $remote_post_data = array(
        'collectionHandle' => $collection,
        'productHandle' => $search,
        'paginationParams' => array(
            "first" => 12,
            "afterCursor" => $cursor,
            "beforeCursor" => "",
            "reverse" => true
        )
    );

    $body = wp_json_encode($remote_post_data);

    $options = [
        'body' => $body,
        'headers' => [
            'Content-Type' => 'application/json'
        ]
    ];
    $response = wp_remote_post($endpoint_url, $options);

    if (!is_wp_error($response)) {
        $response_body = wp_remote_retrieve_body($response);
        $response_body = json_decode($response_body);

        if (isset($response_body->data) && !empty($response_body->data)) {
            if (isset($response_body->data->products) && !empty($response_body->data->products)) {
                return array(
                    'products' => $response_body->data->products,
                    'pagination' => $response_body->data->pageInfo
                );
            }
        }
        return [];
    }

    return [];
}

function cptb_get_filtered_products_ajax()
{
    $cursor = isset($_POST['cursor']) ? sanitize_text_field(wp_unslash($_POST['cursor'])) : '';
    $search = isset($_POST['search']) ? sanitize_text_field(wp_unslash($_POST['search'])) : '';
    $collection = isset($_POST['collection']) ? sanitize_text_field(wp_unslash($_POST['collection'])) : 'premium-wordpress-templates';

    check_ajax_referer('cptb_create_pagination_nonce_action', 'cptb_pagination_nonce');

    $get_filtered_products = cptb_get_filtered_products($cursor, $search, $collection);
    ob_start();
    if (isset($get_filtered_products['products']) && !empty($get_filtered_products['products'])) {
        foreach ($get_filtered_products['products'] as $product) {

            $product_obj = $product->node;

            if (isset($product_obj->inCollection) && !$product_obj->inCollection) {
                continue;
            }

            if ('Test Product' == $product_obj->title) {
                continue;
            }

            $product_obj = $product->node;

            $demo_url = isset($product->node->metafield->value) ? $product->node->metafield->value : '';
            $product_url = isset($product->node->onlineStoreUrl) ? $product->node->onlineStoreUrl : '';
            $image_src = isset($product->node->images->edges[0]->node->src) ? $product->node->images->edges[0]->node->src : ''; ?>

            <div class="cptb-item cptb-filter-free col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                <div class="cptb-item-inner-box">
                    <div class="cptb-item-preview">
                        <div class="cptb-item-screenshot">
                            <?php
                            // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                            echo '<img src="' . esc_url($image_src) . '" loading="lazy" alt="' . esc_attr($product_obj->title) . '">';
                            ?>

                            <div class="cptb-item-overlay">
                                <?php if ($demo_url != '') { ?>
                                    <a class="button cptb-item-demo-link" href="<?php echo esc_attr($demo_url); ?>"
                                        target="_blank"><?php echo esc_html('Demo'); ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="cptb-item-footer">
                        <div class="cptb-item-footer_meta">
                            <h3 class="theme-name"><?php echo esc_html($product_obj->title); ?></h3>
                            <div class="cptb-item-footer-actions">
                                <a class="button cptb-buy-now" target="_blank" href="<?php echo esc_attr($product_url); ?>"
                                    aria-label="Buy Now"><?php echo esc_html('Buy Now'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
    $output = ob_get_clean();

    $pagination = isset($get_filtered_products['pagination']) ? $get_filtered_products['pagination'] : [];
    wp_send_json(array(
        'content' => $output,
        'pagination' => $pagination
    ));
}

add_action('wp_ajax_cptb_get_filtered_products', 'cptb_get_filtered_products_ajax');
add_action('wp_ajax_nopriv_cptb_get_filtered_products', 'cptb_get_filtered_products_ajax');


// ajax handler for ads notice
add_action('wp_ajax_cptb_dismiss_notice', 'cptb_dismiss_notice_callback');
function cptb_dismiss_notice_callback()
{
    check_ajax_referer('cptb_dismiss_notice_nonce', 'nonce');
    $user_id = get_current_user_id();
    if ($user_id) {
        update_user_meta($user_id, 'cptb_notice_dismissed_at', current_time('timestamp'));
    }
    wp_send_json_success();
}
