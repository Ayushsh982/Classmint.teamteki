<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

if (isset($_GET['message']) && $_GET['message'] == 1): ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e('Custom post type created successfully!', 'ace-post-type-builder'); ?></p>
    </div>
<?php elseif (isset($_GET['message']) && $_GET['message'] == 2): ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e('Custom post type updated successfully!', 'ace-post-type-builder'); ?></p>
    </div>
<?php elseif (isset($_GET['message']) && $_GET['message'] == 3): ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e('Custom post type deleted successfully!', 'ace-post-type-builder'); ?></p>
    </div>
<?php endif;

$cptb_editing = false;
$cptb_edit_post_type = null;

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $cptb_edit_post_type_slug = sanitize_text_field(wp_unslash($_GET['edit']));
    $cptb_post_types = get_option('cptb_custom_post_types', array());

    if (isset($cptb_post_types[$cptb_edit_post_type_slug])) {
        $cptb_edit_post_type = $cptb_post_types[$cptb_edit_post_type_slug];
        $cptb_editing = true;
    }
}
?>
<form method="post"
    action="<?php echo esc_url(admin_url($cptb_editing ? 'admin-post.php?action=cptb_update_post_type' : 'admin-post.php?action=cptb_save_post_type')); ?>">
    <?php wp_nonce_field($cptb_editing ? 'cptb_update_post_type' : 'cptb_save_post_type', 'cptb_nonce'); ?>

    <?php if ($cptb_editing): ?>
        <input type="hidden" name="original_post_type_slug" value="<?php echo esc_attr($cptb_edit_post_type['slug']); ?>">
        <h2><?php esc_html_e('Edit Custom Post Type', 'ace-post-type-builder'); ?></h2>
    <?php else: ?>
        <h2><?php esc_html_e('Create New Custom Post Type', 'ace-post-type-builder'); ?></h2>
    <?php endif; ?>

    <table class="form-table">
        <tr>
            <th><label for="post_type_name"><?php esc_html_e('Post Type Name', 'ace-post-type-builder'); ?></label>
            </th>
            <td><input type="text" name="post_type_name" id="post_type_name" class="regular-text"
                    value="<?php echo $cptb_editing ? esc_attr($cptb_edit_post_type['name']) : ''; ?>" required
                    placeholder="<?php esc_attr_e('Enter Post Type Name', 'ace-post-type-builder'); ?>"></td>
        </tr>
        <tr>
            <th><label for="post_type_slug"><?php esc_html_e('Post Type Slug', 'ace-post-type-builder'); ?></label>
            </th>
            <td><input type="text" name="post_type_slug" id="post_type_slug" class="regular-text"
                    value="<?php echo $cptb_editing ? esc_attr($cptb_edit_post_type['slug']) : ''; ?>" required
                    placeholder="<?php esc_attr_e('Enter Post Type Slug', 'ace-post-type-builder'); ?>"></td>
        </tr>
        <tr>
            <th><label
                    for="post_type_label_name"><?php esc_html_e('Label Name (Plural)', 'ace-post-type-builder'); ?></label>
            </th>
            <td>
                <input type="text" name="post_type_label_name" id="post_type_label_name" class="regular-text"
                    value="<?php echo isset($cptb_edit_post_type['labels']['name']) ? esc_attr($cptb_edit_post_type['labels']['name']) : ''; ?>"
                    required
                    placeholder="<?php esc_attr_e('Enter Label Name For Menue (Plural)', 'ace-post-type-builder'); ?>">
            </td>
        </tr>
        <tr>
            <th><label
                    for="post_type_singular_name"><?php esc_html_e('Singular Name', 'ace-post-type-builder'); ?></label>
            </th>
            <td>
                <input type="text" name="post_type_singular_name" id="post_type_singular_name" class="regular-text"
                    value="<?php echo isset($cptb_edit_post_type['labels']['singular_name']) ? esc_attr($cptb_edit_post_type['labels']['singular_name']) : ''; ?>"
                    required placeholder="<?php esc_attr_e('Enter Singular Name', 'ace-post-type-builder'); ?>">
            </td>
        </tr>

        <tr>
            <th><label for="supports"><?php esc_html_e('Supports', 'ace-post-type-builder'); ?></label></th>
            <td>
                <label>
                    <input type="checkbox" name="supports[]" value="title" checked readonly onclick="return false;">
                    <?php esc_html_e('Title', 'ace-post-type-builder'); ?>
                </label><br>

                <label>
                    <input type="checkbox" name="supports[]" value="editor" <?php echo (!$cptb_editing || ($cptb_editing && in_array('editor', $cptb_edit_post_type['supports'] ?? array(), true))) ? 'checked' : ''; ?>>
                    <?php esc_html_e('Editor', 'ace-post-type-builder'); ?>
                </label><br>

                <label>
                    <input type="checkbox" name="supports[]" value="thumbnail" <?php echo ($cptb_editing && in_array('thumbnail', $cptb_edit_post_type['supports'] ?? array(), true)) ? 'checked' : ''; ?>>
                    <?php esc_html_e('Featured Image', 'ace-post-type-builder'); ?>
                </label><br>

                <label>
                    <input type="checkbox" name="supports[]" value="excerpt" <?php echo ($cptb_editing && in_array('excerpt', $cptb_edit_post_type['supports'] ?? array(), true)) ? 'checked' : ''; ?>>
                    <?php esc_html_e('Excerpt', 'ace-post-type-builder'); ?>
                </label><br>

                <label>
                    <input type="checkbox" name="supports[]" value="comments" <?php echo ($cptb_editing && in_array('comments', $cptb_edit_post_type['supports'] ?? array(), true)) ? 'checked' : ''; ?>>
                    <?php esc_html_e('Comments', 'ace-post-type-builder'); ?>
                </label><br>

                <label>
                    <input type="checkbox" name="supports[]" value="author" <?php echo ($cptb_editing && in_array('author', $cptb_edit_post_type['supports'] ?? array(), true)) ? 'checked' : ''; ?>>
                    <?php esc_html_e('Author', 'ace-post-type-builder'); ?>
                </label><br>

                <label>
                    <input type="checkbox" name="supports[]" value="revisions" <?php echo ($cptb_editing && in_array('revisions', $cptb_edit_post_type['supports'] ?? array(), true)) ? 'checked' : ''; ?>>
                    <?php esc_html_e('Revisions', 'ace-post-type-builder'); ?>
                </label><br>

                <label>
                    <input type="checkbox" name="supports[]" value="custom-fields" <?php echo ($cptb_editing && in_array('custom-fields', $cptb_edit_post_type['supports'] ?? array(), true)) ? 'checked' : ''; ?>>
                    <?php esc_html_e('Custom Fields', 'ace-post-type-builder'); ?>
                </label><br>
            </td>
        </tr>
        <tr>
            <th><label for="public"><?php esc_html_e('Public', 'ace-post-type-builder'); ?></label></th>
            <td>
                <select name="public" id="public">
                    <option value="true" <?php selected($cptb_editing && isset($cptb_edit_post_type['public']) && $cptb_edit_post_type['public'] === true); ?>>
                        <?php esc_html_e('True', 'ace-post-type-builder'); ?>
                    </option>
                    <option value="false" <?php selected($cptb_editing && isset($cptb_edit_post_type['public']) && $cptb_edit_post_type['public'] === false); ?>>
                        <?php esc_html_e('False', 'ace-post-type-builder'); ?>
                    </option>
                </select>
            </td>
        </tr>

        <tr>
            <th><label for="has_archive"><?php esc_html_e('Has Archive', 'ace-post-type-builder'); ?></label></th>
            <td>
                <select name="has_archive" id="has_archive">
                    <option value="true" <?php selected($cptb_editing && isset($cptb_edit_post_type['has_archive']) && $cptb_edit_post_type['has_archive'] === true); ?>>
                        <?php esc_html_e('True', 'ace-post-type-builder'); ?>
                    </option>
                    <option value="false" <?php selected($cptb_editing && isset($cptb_edit_post_type['has_archive']) && $cptb_edit_post_type['has_archive'] === false); ?>>
                        <?php esc_html_e('False', 'ace-post-type-builder'); ?>
                    </option>
                </select>
                <p class="description">
                    <?php esc_html_e('Whether post type archives are enabled. If true, a post type archive will be publicly accessible.', 'ace-post-type-builder'); ?>
                </p>
            </td>
        </tr>

        <tr>
            <th><label for="rewrite_slug"><?php esc_html_e('Rewrite Slug', 'ace-post-type-builder'); ?></label></th>
            <td>
                <input type="text" name="rewrite_slug" id="rewrite_slug" class="regular-text"
                    value="<?php echo $cptb_editing && isset($cptb_edit_post_type['rewrite_slug']) ? esc_attr($cptb_edit_post_type['rewrite_slug']) : ''; ?>"
                    placeholder="<?php echo $cptb_editing ? '' : esc_attr__('Defaults to post type slug', 'ace-post-type-builder'); ?>">
                <p class="description">
                    <?php esc_html_e('Custom slug for URLs. Leave empty to use post type slug. This affects the URL structure for this post type.', 'ace-post-type-builder'); ?>
                </p>
            </td>
        </tr>

        <tr>
            <th><label for="show_in_nav_menus"><?php esc_html_e('Show in Menus', 'ace-post-type-builder'); ?></label>
            </th>
            <td>
                <select name="show_in_nav_menus" id="show_in_nav_menus">
                    <option value="true" <?php selected($cptb_editing && isset($cptb_edit_post_type['show_in_nav_menus']) && $cptb_edit_post_type['show_in_nav_menus'] === true); ?>>
                        <?php esc_html_e('True', 'ace-post-type-builder'); ?>
                    </option>
                    <option value="false" <?php selected($cptb_editing && isset($cptb_edit_post_type['show_in_nav_menus']) && $cptb_edit_post_type['show_in_nav_menus'] === false); ?>>
                        <?php esc_html_e('False', 'ace-post-type-builder'); ?>
                    </option>
                </select>
            </td>
        </tr>



        <tr>
            <th><label for="menu_position"><?php esc_html_e('Menu Position', 'ace-post-type-builder'); ?></label></th>
            <td><input type="number" name="menu_position" id="menu_position"
                    value="<?php echo $cptb_editing ? esc_attr($cptb_edit_post_type['menu_position']) : '20'; ?>"
                    class="small-text"></td>
        </tr>

        <!-- new  start -->
        <tr>
            <th><label
                    for="menu_icon"><?php esc_html_e('Menu Icon (Dashicon Class)', 'ace-post-type-builder'); ?></label>
            </th>
            <td>
                <input type="text" name="menu_icon" id="menu_icon" class="regular-text"
                    value="<?php echo $cptb_editing && isset($cptb_edit_post_type['menu_icon']) ? esc_attr($cptb_edit_post_type['menu_icon']) : ''; ?>"
                    placeholder="e.g. dashicons-admin-post">
                <p class="description">
                    <?php esc_html_e('Enter a Dashicon class. See full list at:', 'ace-post-type-builder'); ?>
                    <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank">Dashicons
                        Reference</a>
                </p>
            </td>
        </tr>


        <tr>
            <th><label for="editor_type"><?php esc_html_e('Editor Type', 'ace-post-type-builder'); ?></label></th>
            <td>
                <select name="editor_type" id="editor_type">
                    <option value="block" <?php selected($cptb_editing && isset($cptb_edit_post_type['editor_type']) && $cptb_edit_post_type['editor_type'] === 'block'); ?>>
                        <?php esc_html_e('Block Editor (Gutenberg)', 'ace-post-type-builder'); ?>
                    </option>
                    <option value="classic" <?php selected($cptb_editing && isset($cptb_edit_post_type['editor_type']) && $cptb_edit_post_type['editor_type'] === 'classic'); ?>>
                        <?php esc_html_e('Classic Editor', 'ace-post-type-builder'); ?>
                    </option>
                </select>
                <p class="description">
                    <?php esc_html_e('Choose which editor to use when editing posts of this type.', 'ace-post-type-builder'); ?>
                </p>
            </td>
        </tr>

        <tr>
            <th><label for="capability_type"><?php esc_html_e('Capability Type', 'ace-post-type-builder'); ?></label>
            </th>
            <td>
                <select name="capability_type" id="capability_type">
                    <option value="post" <?php selected($cptb_editing && isset($cptb_edit_post_type['capability_type']) && $cptb_edit_post_type['capability_type'] === 'post'); ?>>
                        <?php esc_html_e('Post', 'ace-post-type-builder'); ?>
                    </option>
                    <option value="page" <?php selected($cptb_editing && isset($cptb_edit_post_type['capability_type']) && $cptb_edit_post_type['capability_type'] === 'page'); ?>>
                        <?php esc_html_e('Page', 'ace-post-type-builder'); ?>
                    </option>
                    <option value="custom" <?php selected($cptb_editing && isset($cptb_edit_post_type['capability_type']) && $cptb_edit_post_type['capability_type'] === 'custom'); ?>>
                        <?php esc_html_e('Custom', 'ace-post-type-builder'); ?>
                    </option>
                </select>
                <p class="description">
                    <?php esc_html_e('Controls the capabilities for this post type. "Custom" will use the post type slug as capability type.', 'ace-post-type-builder'); ?>
                </p>
            </td>
        </tr>

        <tr>
            <th><label for="post_type_description"><?php esc_html_e('Description', 'ace-post-type-builder'); ?></label>
            </th>
            <td>
                <textarea name="post_type_description" id="post_type_description" class="regular-text" rows="3"
                    placeholder="<?php esc_attr_e('Enter a description for this post type', 'ace-post-type-builder'); ?>"><?php echo $cptb_editing && isset($cptb_edit_post_type['description']) ? esc_textarea($cptb_edit_post_type['description']) : ''; ?></textarea>
                <p class="description">
                    <?php esc_html_e('A short descriptive summary of the post type.', 'ace-post-type-builder'); ?></p>
            </td>
        </tr>

        <!-- end -->

    </table>

    <p class="submit">
        <input type="submit" class="button-primary"
            value="<?php echo $cptb_editing ? esc_html_e('Update Post Type', 'ace-post-type-builder') : esc_html_e('Create Post Type', 'ace-post-type-builder'); ?>">
    </p>
</form>


<?php
$cptb_post_types = get_option('cptb_custom_post_types');

if (isset($cptb_post_types) && is_array($cptb_post_types)): ?>
    <h2><?php esc_html_e('Existing Custom Post Types', 'ace-post-type-builder'); ?></h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php esc_html_e('Post Type Name', 'ace-post-type-builder'); ?></th>
                <th><?php esc_html_e('Post Type Slug', 'ace-post-type-builder'); ?></th>
                <th><?php esc_html_e('Description', 'ace-post-type-builder'); ?></th>
                <th><?php esc_html_e('Actions', 'ace-post-type-builder'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cptb_post_types as $post_type): ?>
                <tr>
                    <td><?php echo esc_html($post_type['name']); ?></td>
                    <td><?php echo esc_html($post_type['slug']); ?></td>
                    <td><?php echo isset($post_type['description']) ? esc_html($post_type['description']) : ''; ?></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="<?php echo esc_url(admin_url('admin.php?page=cptb-post-types&edit=' . esc_attr($post_type['slug']))); ?>"
                            class="button button-primary">
                            <?php esc_html_e('Edit', 'ace-post-type-builder'); ?>
                        </a>
                        <!-- Delete Button -->
                        <a href="<?php echo esc_url(admin_url('admin-post.php?action=cptb_delete_post_type&post_type=' . esc_attr($post_type['slug']) . '&_wpnonce=' . wp_create_nonce('cptb_delete_post_type_' . esc_attr($post_type['slug'])))); ?>"
                            class="button button-secondary">
                            <?php esc_html_e('Delete', 'ace-post-type-builder'); ?>
                        </a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p><?php esc_html_e('No custom post types found.', 'ace-post-type-builder'); ?></p>
<?php endif; ?>