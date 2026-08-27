<div class="wrap cptb-templates-wrap">
    <div class="cptb-loader"></div>
    <div class="cptb-loader-overlay"></div>
    <div class="cptb-templates-main">
        <div class="cptb-templates-search-content-box">
            <div class="d-flex justify-content-between mb-3">
                <div class="cptb-filter-categories-wrapper">
                        <div class="cptb-filter-category-select">
                            <span class="cptb-filter-category-select-content">All Categories</span>
                            <span class="dashicons dashicons-arrow-down-alt2"></span>
                        </div>
                        <ul class="cptb-templates-collections-group">
                            <?php $cptb_collections_arr = cptb_get_collections(); ?>
                            <?php foreach ( $cptb_collections_arr as $cptb_collection ) {

                                if ($cptb_collection->handle != 'free' && $cptb_collection->handle != 'uncategorized' && $cptb_collection->handle != 'bwt-free') { ?>
                                    <li data-value="<?php echo esc_attr($cptb_collection->handle); ?>"><?php echo esc_html($cptb_collection->title); ?></li>
                                <?php } ?>

                            <?php } ?>
                        </ul>
                    </div>
                <div class="cptb-templates-collections-search">
                    <input type="text" name="cptb-templates-search" autocomplete="off" placeholder="Search Templates...">
                </div>
            </div>
           
            <div class="cptb-filter-content cptb-main-grid row" id="cptb-filter-content">
                <?php $cptb_get_filtered_products = cptb_get_filtered_products();
                    if (isset($cptb_get_filtered_products['products']) && !empty($cptb_get_filtered_products['products'])) {
                        foreach ( $cptb_get_filtered_products['products'] as $cptb_product ) {

                            $cptb_product_obj = $cptb_product->node;

                            if (isset($cptb_product_obj->inCollection) && !$cptb_product_obj->inCollection) {
                                continue;
                            }

                            $cptb_bundle_class = $cptb_product_obj->handle == 'wp-theme-bundle' ? 'is-bundle' : '';

                            $cptb_demo_url = isset($cptb_product->node->metafield->value) ? $cptb_product->node->metafield->value : '';
                            $cptb_product_url = isset($cptb_product->node->onlineStoreUrl) ? $cptb_product->node->onlineStoreUrl : '';
                            $cptb_image_src = isset($cptb_product->node->images->edges[0]->node->src) ? $cptb_product->node->images->edges[0]->node->src : ''; ?>

                            <div class="cptb-item cptb-filter-free col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
                                <div class="cptb-item-inner-box">
                                    <div class="cptb-item-preview">
                                        <div class="cptb-item-screenshot">
                                            <img class="<?php echo esc_attr($cptb_bundle_class); ?>" src="<?php echo esc_url($cptb_image_src); ?>" loading="lazy" alt="<?php echo esc_attr($cptb_product_obj->title); ?>">
                                            <div class="cptb-item-overlay">
                                                <?php if ( $cptb_demo_url != '' ) { ?>
                                                    <a class="button cptb-item-demo-link" href="<?php echo esc_attr($cptb_demo_url); ?>" target="_blank"><?php echo esc_html('Demo'); ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cptb-item-footer">
                                        <div class="cptb-item-footer_meta">
                                            <h3 class="theme-name"><?php echo esc_html($cptb_product_obj->title); ?></h3>
                                            <div class="cptb-item-footer-actions">
                                                <a class="button cptb-buy-now" target="_blank" href="<?php echo esc_attr($cptb_product_url); ?>" aria-label="Buy Now"><?php echo esc_html('Buy Now'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                ?>
            </div>
        </div>
     
        <?php if (isset($cptb_get_filtered_products['pagination']->hasNextPage) && $cptb_get_filtered_products['pagination']->hasNextPage) { ?>
            <input type="hidden" name="cptb-end-cursor" value="<?php echo esc_attr(isset($cptb_get_filtered_products['pagination']->endCursor) ? $cptb_get_filtered_products['pagination']->endCursor : '') ?>">
        <?php } ?>
    </div>
</div>