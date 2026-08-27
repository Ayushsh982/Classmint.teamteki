<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'ace-post-type-builder' ) );
}
?>
<div class="wrap">
    <h1><?php esc_html_e( 'Post Type Builder Dashboard', 'ace-post-type-builder' ); ?></h1>
    <p><?php esc_html_e( 'Welcome to the Post Type Builder Plugin! Create, manage, and customize your post types effortlessly.', 'ace-post-type-builder' ); ?></p>

    <div class="cptb-dashboard">
        <div class="cptb-dashboard-widget">
            <h2><?php esc_html_e( 'Quick Links', 'ace-post-type-builder' ); ?></h2>
            <ul>
                <li><a href="<?php echo esc_url( admin_url( 'admin.php?page=cptb-post-types' ) ); ?>"><?php esc_html_e( 'Add New Post Types', 'ace-post-type-builder' ); ?></a></li>
                <li><a href="<?php echo esc_url( admin_url( 'admin.php?page=cptb-taxonomies' ) ); ?>"><?php esc_html_e( 'Add New Taxonomy', 'ace-post-type-builder' ); ?></a></li>
            </ul>
        </div>

        <div class="cptb-dashboard-widget">
            <h2><?php esc_html_e( 'Plugin Features', 'ace-post-type-builder' ); ?></h2>
            <ul>
                <li><?php esc_html_e( 'Advanced Field Management', 'ace-post-type-builder' ); ?></li>
                <li><?php esc_html_e( 'Taxonomy Support', 'ace-post-type-builder' ); ?></li>
                <li><?php esc_html_e( 'Page Builder Compatibility (Elementor, Gutenberg, etc.)', 'ace-post-type-builder' ); ?></li>
                <li><?php esc_html_e( 'SEO Features', 'ace-post-type-builder' ); ?></li>
                <li><?php esc_html_e( 'WooCommerce Support', 'ace-post-type-builder' ); ?></li>
            </ul>
        </div>

    </div>
</div>


