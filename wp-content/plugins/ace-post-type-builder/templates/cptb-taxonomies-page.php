<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    cptb_handle_taxonomy_submission();
}


if (isset($_GET['message']) && $_GET['message'] == 1): ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e('taxonomy created successfully!', 'ace-post-type-builder'); ?></p>
    </div>
<?php elseif (isset($_GET['message']) && $_GET['message'] == 2): ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e('Taxonomy updated successfully!', 'ace-post-type-builder'); ?></p>
    </div>
<?php endif;

if (isset($_GET['deletemessage'])): ?>
    <div class="notice notice-success is-dismissible">
        <?php if ($_GET['deletemessage'] == 2): ?>
            <p><?php esc_html_e('Taxonomy deleted successfully!', 'ace-post-type-builder'); ?></p>
        <?php elseif ($_GET['deletemessage'] == 3): ?>
            <p><?php esc_html_e('Error: Taxonomy not found!', 'ace-post-type-builder'); ?></p>
        <?php elseif ($_GET['deletemessage'] == 4): ?>
            <p><?php esc_html_e('Error: Missing taxonomy slug!', 'ace-post-type-builder'); ?></p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<div class="wrap">
    <h1><?php esc_html_e('Create New Taxonomy', 'ace-post-type-builder'); ?></h1>

    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php?action=cptb_save_taxonomy')); ?>">
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="taxonomy_slug"><?php esc_html_e('Taxonomy Slug', 'ace-post-type-builder'); ?></label>
                </th>
                <td>
                    <input type="text" name="taxonomy_slug" id="taxonomy_slug" required
                        placeholder="<?php esc_attr_e('Enter taxonomy slug', 'ace-post-type-builder'); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label
                        for="taxonomy_singular"><?php esc_html_e('Singular Name', 'ace-post-type-builder'); ?></label>
                </th>
                <td>

                    <input type="text" name="taxonomy_singular" id="taxonomy_singular" required
                        placeholder="<?php esc_attr_e('Enter singular name', 'ace-post-type-builder'); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="taxonomy_plural"><?php esc_html_e('Plural Name', 'ace-post-type-builder'); ?></label>
                </th>
                <td>
                    <input type="text" name="taxonomy_plural" id="taxonomy_plural" required
                        placeholder="<?php esc_attr_e('Enter plural name', 'ace-post-type-builder'); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="post_type"><?php esc_html_e('Post Type', 'ace-post-type-builder'); ?></label>
                </th>
                <td>
                    <select name="post_type" id="post_type" required>
                        <?php
                        $cptb_post_types = get_post_types(array('public' => true), 'objects');
                        foreach ($cptb_post_types as $post_type) {
                            echo '<option value="' . esc_attr($post_type->name) . '">' . esc_html($post_type->labels->singular_name) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="hierarchical"><?php esc_html_e('Hierarchical', 'ace-post-type-builder'); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="hierarchical" id="hierarchical">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="public"><?php esc_html_e('Public', 'ace-post-type-builder'); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="public" id="public" checked>
                </td>
            </tr>
        </table>
        <?php wp_nonce_field('cptb_save_taxonomy', 'cptb_nonce'); ?>
        <p class="submit">
            <input type="submit" class="button-primary"
                value="<?php esc_html_e('Save Taxonomy', 'ace-post-type-builder'); ?>">
        </p>
    </form>
</div>

<?php
// Fetch existing taxonomies from the options table
$cptb_existing_taxonomies = get_option('cptb_custom_taxonomies', array());

if (!empty($cptb_existing_taxonomies)) {
    echo '<h2>' . esc_html__('Existing Taxonomies', 'ace-post-type-builder') . '</h2>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>' . esc_html__('Taxonomy Name', 'ace-post-type-builder') . '</th>';
    echo '<th>' . esc_html__('Post Type', 'ace-post-type-builder') . '</th>';
    echo '<th>' . esc_html__('Slug', 'ace-post-type-builder') . '</th>';
    echo '<th>' . esc_html__('Actions', 'ace-post-type-builder') . '</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($cptb_existing_taxonomies as $taxonomy) {
        if (isset($taxonomy['singular'], $taxonomy['plural'], $taxonomy['slug'], $taxonomy['post_type'])) {
            echo '<tr>';
            echo '<td>' . esc_html($taxonomy['singular']) . '</td>';
            echo '<td>' . esc_html($taxonomy['post_type']) . '</td>';
            echo '<td>' . esc_html($taxonomy['slug']) . '</td>';
            echo '<td>';
            echo '<a href="' . esc_url(admin_url('admin.php?page=cptb-taxonomies&edit_taxonomy=' . $taxonomy['slug'])) . '">' . esc_html__('Edit', 'ace-post-type-builder') . '</a> | ';
            $cptb_delete_nonce = wp_create_nonce('cptb_delete_taxonomy');
            $cptb_delete_url = add_query_arg(array(
                'action' => 'cptb_delete_taxonomy',
                'taxonomy' => $taxonomy['slug'],
                'cptb_nonce' => $cptb_delete_nonce,
            ), admin_url('admin-post.php'));

            echo '<a href="' . esc_url($cptb_delete_url) . '" onclick="return confirm(\'Are you sure you want to delete this taxonomy?\')">' . esc_html__('Delete', 'ace-post-type-builder') . '</a>';

            echo '</td>';
            echo '</tr>';
        }
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>' . esc_html__('No taxonomies found.', 'ace-post-type-builder') . '</p>';
}
?>


<?php
if (isset($_GET['edit_taxonomy'])) {
    $cptb_taxonomy_slug = sanitize_text_field(wp_unslash($_GET['edit_taxonomy']));
    $cptb_taxonomy_to_edit = $cptb_existing_taxonomies[$cptb_taxonomy_slug] ?? null;

    if ($cptb_taxonomy_to_edit) {
        // Pre-populate form with existing data
        ?>
        <hr>
        <h2><?php esc_html_e('Edit Taxonomy', 'ace-post-type-builder'); ?></h2>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php?action=cptb_update_taxonomy')); ?>">
            <input type="hidden" name="original_taxonomy_slug" value="<?php echo esc_attr($cptb_taxonomy_to_edit['slug']); ?>">
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="taxonomy_slug"><?php esc_html_e('Taxonomy Slug', 'ace-post-type-builder'); ?></label>
                    </th>
                    <td>

                        <input type="text" name="taxonomy_slug" id="taxonomy_slug"
                            value="<?php echo esc_attr($cptb_taxonomy_to_edit['slug']); ?>" required
                            placeholder="<?php esc_attr_e('Enter taxonomy slug', 'ace-post-type-builder'); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="taxonomy_singular"><?php esc_html_e('Singular Name', 'ace-post-type-builder'); ?></label>
                    </th>
                    <td>

                        <input type="text" name="taxonomy_singular" id="taxonomy_singular"
                            value="<?php echo esc_attr($cptb_taxonomy_to_edit['singular']); ?>" required
                            placeholder="<?php esc_attr_e('Enter singular name', 'ace-post-type-builder'); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="taxonomy_plural"><?php esc_html_e('Plural Name', 'ace-post-type-builder'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="taxonomy_plural" id="taxonomy_plural"
                            value="<?php echo esc_attr($cptb_taxonomy_to_edit['plural']); ?>" required
                            placeholder="<?php esc_attr_e('Enter plural name', 'ace-post-type-builder'); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="post_type"><?php esc_html_e('Post Type', 'ace-post-type-builder'); ?></label>
                    </th>
                    <td>
                        <select name="post_type" id="post_type" required>
                            <?php
                            foreach ($cptb_post_types as $post_type) {
                                $cptb_selected = $cptb_taxonomy_to_edit['post_type'] === $post_type->name ? 'selected' : '';
                                echo '<option value="' . esc_attr($post_type->name) . '" ' . esc_attr($cptb_selected) . '>' . esc_html($post_type->labels->singular_name) . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="hierarchical"><?php esc_html_e('Hierarchical', 'ace-post-type-builder'); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="hierarchical" id="hierarchical" <?php checked($cptb_taxonomy_to_edit['hierarchical'], true); ?>>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="public"><?php esc_html_e('Public', 'ace-post-type-builder'); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="public" id="public" <?php checked($cptb_taxonomy_to_edit['public'], true); ?>>
                    </td>
                </tr>
            </table>
            <?php wp_nonce_field('cptb_update_taxonomy', 'cptb_nonce'); ?>
            <p class="submit">
                <input type="submit" class="button-primary"
                    value="<?php esc_html_e('Update Taxonomy', 'ace-post-type-builder'); ?>">
            </p>
        </form>
        <?php
    }
}
?>