<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CPTB_Taxonomies {
    // Register custom taxonomies dynamically
    public static function register_dynamic( $taxonomy ) {
        $labels = array(
            'name'              => $taxonomy['name'] . 's',
            'singular_name'     => $taxonomy['name'],
            'search_items'      => 'Search ' . $taxonomy['name'] . 's',
            'all_items'         => 'All ' . $taxonomy['name'] . 's',
            'parent_item'       => 'Parent ' . $taxonomy['name'],
            'parent_item_colon' => 'Parent ' . $taxonomy['name'] . ':',
            'edit_item'         => 'Edit ' . $taxonomy['name'],
            'update_item'       => 'Update ' . $taxonomy['name'],
            'add_new_item'      => 'Add New ' . $taxonomy['name'],
            'new_item_name'     => 'New ' . $taxonomy['name'] . ' Name',
            'menu_name'         => $taxonomy['name'] . 's',
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => $taxonomy['slug'] ),
        );
        // Register the taxonomy
        register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], $args );
    }
}
