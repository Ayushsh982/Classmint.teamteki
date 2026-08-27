<div class="theme-offer">
	<?php
        // Check if the demo import has been completed
        $learnpress_coaching_demo_import_completed = get_option('learnpress_coaching_demo_import_completed', false);

        // If the demo import is completed, display the "View Site" button
        if ($learnpress_coaching_demo_import_completed) {
        echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'learnpress-coaching') . '</p>';
        echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('VIEW SITE', 'learnpress-coaching') . '</a></span>';
        }


		//POST and update the customizer and other related data of POLITICAL CAMPAIGN
        if (isset($_POST['submit'])) {

            // Check if ace-post-type-builder is installed and activated
            if (!is_plugin_active('ace-post-type-builder/ace-post-type-builder.php')) {
                // Install the plugin if it doesn't exist
                $learnpress_coaching_plugin_slug = 'ace-post-type-builder';
                $learnpress_coaching_plugin_file = 'ace-post-type-builder/ace-post-type-builder.php';

                // Check if plugin is installed
                $learnpress_coaching_installed_plugins = get_plugins();
                if (!isset($learnpress_coaching_installed_plugins[$learnpress_coaching_plugin_file])) {
                    include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
                    include_once(ABSPATH . 'wp-admin/includes/file.php');
                    include_once(ABSPATH . 'wp-admin/includes/misc.php');
                    include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

                    // Install the plugin
                    $learnpress_coaching_upgrader = new Plugin_Upgrader();
                    $learnpress_coaching_upgrader->install('https://downloads.wordpress.org/plugin/ace-post-type-builder.latest-stable.zip');
                }
                // Activate the plugin
                activate_plugin($learnpress_coaching_plugin_file);
            }

            // ------- Create Nav Menu --------
            $learnpress_coaching_menuname = 'Primary Menu';
            $learnpress_coaching_bpmenulocation = 'primary';
            $learnpress_coaching_menu_exists = wp_get_nav_menu_object($learnpress_coaching_menuname);

            if (!$learnpress_coaching_menu_exists) {
                $learnpress_coaching_menu_id = wp_create_nav_menu($learnpress_coaching_menuname);

                // Create Home Page
                $learnpress_coaching_home_title = 'Home';
                $learnpress_coaching_home = array(
                    'post_type' => 'page',
                    'post_title' => $learnpress_coaching_home_title,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'home'
                );
                $learnpress_coaching_home_id = wp_insert_post($learnpress_coaching_home);
                // Assign Home Page Template
                add_post_meta($learnpress_coaching_home_id, '_wp_page_template', 'page-template/home-page.php');
                // Update options to set Home Page as the front page
                update_option('page_on_front', $learnpress_coaching_home_id);
                update_option('show_on_front', 'page');
                // Add Home Page to Menu
                wp_update_nav_menu_item($learnpress_coaching_menu_id, 0, array(
                    'menu-item-title' => __('Home', 'learnpress-coaching'),
                    'menu-item-classes' => 'home',
                    'menu-item-url' => home_url('/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $learnpress_coaching_home_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create about Page with Dummy Content
                $learnpress_coaching_about_title = 'About Us';
                $learnpress_coaching_about_content = '
                Explore all the about we have on our website. Find information about our services, company, and more. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>
                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $learnpress_coaching_about = array(
                    'post_type' => 'page',
                    'post_title' => $learnpress_coaching_about_title,
                    'post_content' => $learnpress_coaching_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about'
                );
                $learnpress_coaching_about_id = wp_insert_post($learnpress_coaching_about);
                // Add about Page to Menu
                wp_update_nav_menu_item($learnpress_coaching_menu_id, 0, array(
                    'menu-item-title' => __('About Us', 'learnpress-coaching'),
                    'menu-item-classes' => 'about',
                    'menu-item-url' => home_url('/about/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $learnpress_coaching_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create About Us Page with Dummy Content
                $learnpress_coaching_services_title = 'Services';
                $learnpress_coaching_services_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>
                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br>
                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $learnpress_coaching_services = array(
                    'post_type' => 'page',
                    'post_title' => $learnpress_coaching_services_title,
                    'post_content' => $learnpress_coaching_services_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'services'
                );
                $learnpress_coaching_services_id = wp_insert_post($learnpress_coaching_services);
                // Add services Us Page to Menu
                wp_update_nav_menu_item($learnpress_coaching_menu_id, 0, array(
                    'menu-item-title' => __('Services', 'learnpress-coaching'),
                    'menu-item-classes' => 'services',
                    'menu-item-url' => home_url('/services-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $learnpress_coaching_services_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                  // Create Blog Page 
                $learnpress_coaching_blog_page_title = 'Blog';

                $learnpress_coaching_blog_page_query = new WP_Query(array(
                    'post_type'      => 'page',
                    'name'           => sanitize_title($learnpress_coaching_blog_page_title),
                    'post_status'    => 'publish',
                    'posts_per_page' => 1
                ));
                if (!$learnpress_coaching_blog_page_query->have_posts()) {
                    $learnpress_coaching_blog_page = array(
                        'post_type'   => 'page',
                        'post_title'  => $learnpress_coaching_blog_page_title,
                        'post_status' => 'publish',
                        'post_author' => 1,
                    );
                    $learnpress_coaching_blog_page_id = wp_insert_post($learnpress_coaching_blog_page);
                    update_option('page_for_posts', $learnpress_coaching_blog_page_id);

                    wp_update_nav_menu_item($learnpress_coaching_menu_id, 0, array(
                        'menu-item-title'      => __('Blog', 'learnpress-coaching'),
                        'menu-item-url'        => get_permalink($learnpress_coaching_blog_page_id),
                        'menu-item-status'     => 'publish',
                        'menu-item-object-id'  => $learnpress_coaching_blog_page_id,
                        'menu-item-object'     => 'page',
                        'menu-item-type'       => 'post_type',
                    ));
                }

                // Create coaching Page with Dummy Content
                $learnpress_coaching_coaching_title = 'Coaching';
                $learnpress_coaching_coaching_content = '
                Find the best coaching here.
                Lorem Ipsum is simply dummy text...';
                $learnpress_coaching_coaching = array(
                    'post_type' => 'page',
                    'post_title' => $learnpress_coaching_coaching_title,
                    'post_content' => $learnpress_coaching_coaching_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'coaching'
                );
                $learnpress_coaching_coaching_id = wp_insert_post($learnpress_coaching_coaching);
                // Add coaching Page to Menu
                wp_update_nav_menu_item($learnpress_coaching_menu_id, 0, array(
                    'menu-item-title' => __('Coaching', 'learnpress-coaching'),
                    'menu-item-classes' => 'coaching',
                    'menu-item-url' => home_url('/coaching/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $learnpress_coaching_coaching_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create Contact Us Page with Dummy Content
                $learnpress_coaching_contact_title = 'Contact Us';
                $learnpress_coaching_contact_content = 'Get in touch with us for coaching programs, courses, or any queries.<br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
                You can contact us via email, phone, or by filling out the contact form on this page.';

                $learnpress_coaching_contact = array(
                    'post_type'    => 'page',
                    'post_title'   => $learnpress_coaching_contact_title,
                    'post_content' => $learnpress_coaching_contact_content,
                    'post_status'  => 'publish',
                    'post_author'  => 1,
                    'post_slug'    => 'contact-us'
                );

                $learnpress_coaching_contact_id = wp_insert_post($learnpress_coaching_contact);

                // Add Contact Us Page to Menu
                wp_update_nav_menu_item($learnpress_coaching_menu_id, 0, array(
                    'menu-item-title'   => __('Contact Us', 'learnpress-coaching'),
                    'menu-item-classes' => 'contact-us',
                    'menu-item-url'     => home_url('/contact-us/'),
                    'menu-item-status'  => 'publish',
                    'menu-item-object-id' => $learnpress_coaching_contact_id,
                    'menu-item-object'  => 'page',
                    'menu-item-type'    => 'post_type'
                ));

                // Set the menu location if it's not already set
                if (!has_nav_menu($learnpress_coaching_bpmenulocation)) {
                    $learnpress_coaching_locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
                    if (empty($learnpress_coaching_locations)) {
                        $learnpress_coaching_locations = array();
                    }
                    $learnpress_coaching_locations[$learnpress_coaching_bpmenulocation] = $learnpress_coaching_menu_id;
                    set_theme_mod('nav_menu_locations', $learnpress_coaching_locations);
                }

            }

            // Set the demo import completion flag
    		update_option('learnpress_coaching_demo_import_completed', true);
    		// Display success message and "View Site" button
    		echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'learnpress-coaching') . '</p>';
    		echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('VIEW SITE', 'learnpress-coaching') . '</a></span>';
            //end

            // Top Bar //
            set_theme_mod( 'learnpress_coaching_show_top_header', true );
            set_theme_mod( 'learnpress_coaching_email_icon', 'far fa-envelope' );
            set_theme_mod( 'learnpress_coaching_email_address', 'info@coaching.com' );
            set_theme_mod( 'learnpress_coaching_time_icon', 'far fa-clock' );
            set_theme_mod( 'learnpress_coaching_time1', 'Monday to Friday 8.00 - 18.00' );
            set_theme_mod( 'learnpress_coaching_location_icon', 'fas fa-map-marker-alt' );
            set_theme_mod( 'learnpress_coaching_location1', 'lorem ipsum is dummy text' );
            set_theme_mod( 'learnpress_coaching_location', 'Address ' );
            set_theme_mod( 'learnpress_coaching_phone_icon', 'fas fa-phone' );
            set_theme_mod( 'learnpress_coaching_call1', 'Have any questions? Call us now!' );
            set_theme_mod( 'learnpress_coaching_call', '+00 123 456 789' );
            set_theme_mod( 'learnpress_coaching_free1', 'Free Consultation' );
            set_theme_mod( 'learnpress_coaching_free', '#' );

            // social icons
            set_theme_mod( 'learnpress_coaching_show_icons', true );
            set_theme_mod( 'learnpress_coaching_facebook_icon', 'fab fa-facebook-f' );
            set_theme_mod( 'learnpress_coaching_facebook_link', 'https://www.facebook.com' );
            set_theme_mod( 'learnpress_coaching_twitter_icon', 'fab fa-twitter' );
            set_theme_mod( 'learnpress_coaching_twitter_link', 'https://www.twitter.com' );
            set_theme_mod( 'learnpress_coaching_linkdin_icon', 'fab fa-linkedin-in' );
            set_theme_mod( 'learnpress_coaching_linkdin_link', 'https://www.linkedin.com' );
            set_theme_mod( 'learnpress_coaching_twitter_icon', 'fab fa-instagram' );
            set_theme_mod( 'learnpress_coaching_instagram_link', 'https://www.instagram.com' );
            set_theme_mod( 'learnpress_coaching_pintrest_icon', 'fab fa-pinterest-p' );
            set_theme_mod( 'learnpress_coaching_pintrest_link', 'https://www.pinterest.com' );

            // slider section start //
            set_theme_mod( 'learnpress_coaching_slider_hide', true );
            set_theme_mod( 'learnpress_coaching_slider_button_text', 'SHOP NOW' );

            $learnpress_coaching_slider_titles = array(
                'Expert Coaching',
                'Interactive Learning',
                'Skill Development',
                'Career Advancement'
            );         
            for ($learnpress_coaching_i = 0; $learnpress_coaching_i < 4; $learnpress_coaching_i++) {
                $learnpress_coaching_slider_title = $learnpress_coaching_slider_titles[$learnpress_coaching_i];
                $learnpress_coaching_slider_content = 'Lorem ipsum is simply dummy text of the printing and typesetting industry.';
                
                // Create post object
                $learnpress_coaching_my_post = array(
                    'post_title'    => wp_strip_all_tags($learnpress_coaching_slider_title),
                    'post_content'  => $learnpress_coaching_slider_content,
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                );
            
                // Insert the post into the database
                $learnpress_coaching_post_id = wp_insert_post($learnpress_coaching_my_post);
            
                if ($learnpress_coaching_post_id) {
                    // Set the theme mod for the slider page
                    set_theme_mod('learnpress_coaching_slider_setting' . ($learnpress_coaching_i + 1), $learnpress_coaching_post_id);
            
                    $learnpress_coaching_image_url = get_template_directory_uri() . '/images/slider' . ($learnpress_coaching_i + 1) . '.png';
                    $learnpress_coaching_image_id = media_sideload_image($learnpress_coaching_image_url, $learnpress_coaching_post_id, null, 'id');
            
                    if (!is_wp_error($learnpress_coaching_image_id)) {
                        // Set the downloaded image as the post's featured image
                        set_post_thumbnail($learnpress_coaching_post_id, $learnpress_coaching_image_id);
                    }
                }
            }            

            // services
            set_theme_mod( 'learnpress_coaching_ourservices_enable', true );
            set_theme_mod('learnpress_coaching_ourservices', 'postcategory1' );
            // Define post category names and post titles
            $learnpress_coaching_category_names = array('postcategory1', 'postcategory2', 'postcategory3', 'postcategory4');
            $learnpress_coaching_title_array = array(
                array("Lorem ipsum is simply ", "Lorem ipsum", "Lorem ipsum is simply", "Lorem ipsum is simply"),
                array("Lorem ipsum is simply ", "Lorem ipsum", "Lorem ipsum is simply", "Lorem ipsum is simply"),
                array("Lorem ipsum is simply ", "Lorem ipsum", "Lorem ipsum is simply", "Lorem ipsum is simply"),
                array("Lorem ipsum is simply ", "Lorem ipsum", "Lorem ipsum is simply", "Lorem ipsum is simply")
            );

            foreach ($learnpress_coaching_category_names as $learnpress_coaching_index => $learnpress_coaching_category_name) {
                // Create or retrieve the post category term ID
                $learnpress_coaching_term = term_exists($learnpress_coaching_category_name, 'category');
                if ($learnpress_coaching_term === 0 || $learnpress_coaching_term === null) {
                    // If the term does not exist, create it
                    $learnpress_coaching_term = wp_insert_term($learnpress_coaching_category_name, 'category');
                }
                if (is_wp_error($learnpress_coaching_term)) {
                    error_log('Error creating category: ' . $learnpress_coaching_term->get_error_message());
                    continue; // Skip to the next iteration if category creation fails
                }

                for ($learnpress_coaching_i = 0; $learnpress_coaching_i < 4; $learnpress_coaching_i++) {
                    // Create post content
                    $learnpress_coaching_title = $learnpress_coaching_title_array[$learnpress_coaching_index][$learnpress_coaching_i];

                    // Create post post object
                    $learnpress_coaching_my_post = array(
                        'post_title'    => wp_strip_all_tags($learnpress_coaching_title),
                        'post_status'   => 'publish',
                        'post_type'     => 'post', // Post type set to 'post'
                    );

                    // Insert the post into the database
                    $learnpress_coaching_post_id = wp_insert_post($learnpress_coaching_my_post);


                    if (is_wp_error($learnpress_coaching_post_id)) {
                        error_log('Error creating post: ' . $learnpress_coaching_post_id->get_error_message());
                        continue; // Skip to the next post if creation fails
                    }

                    // Assign the category to the post
                    wp_set_post_categories($learnpress_coaching_post_id, array((int)$learnpress_coaching_term['term_id']));

                    // Handle the featured image using media_sideload_image
                    $learnpress_coaching_image_url = get_template_directory_uri() . '/images/post' . ($learnpress_coaching_i + 1) . '.png';
                    $learnpress_coaching_image_id = media_sideload_image($learnpress_coaching_image_url, $learnpress_coaching_post_id, null, 'id');

                    if (is_wp_error($learnpress_coaching_image_id)) {
                        error_log('Error downloading image: ' . $learnpress_coaching_image_id->get_error_message());
                        continue; // Skip to the next post if image download fails
                    }
                    // Assign featured image to post
                    set_post_thumbnail($learnpress_coaching_post_id, $learnpress_coaching_image_id);
                }
            }

            // about
            set_theme_mod( 'learnpress_coaching_about_title', 'About Us' );
            $learnpress_coaching_post_title = "OUR SERVICE";
            $learnpress_coaching_post_content = 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type .';
            $learnpress_coaching_image_url = get_template_directory_uri() . '/images/about.png';

            // Create post object
            $learnpress_coaching_post_data = array(
                'post_title'    => wp_strip_all_tags($learnpress_coaching_post_title),
                'post_content'  => $learnpress_coaching_post_content,
                'post_status'   => 'publish',
                'post_type'     => 'post', // Set post type to 'post'
            );
            set_theme_mod('learnpress_coaching_single_post', $learnpress_coaching_post_title);

            // Insert the post into the database
            $learnpress_coaching_post_id = wp_insert_post($learnpress_coaching_post_data);

            if (is_wp_error($learnpress_coaching_post_id)) {
                error_log('Error creating post: ' . $learnpress_coaching_post_id->get_error_message());
            } else {
                // Handle the featured image
                $learnpress_coaching_image_id = media_sideload_image($learnpress_coaching_image_url, $learnpress_coaching_post_id, null, 'id');

                if (is_wp_error($learnpress_coaching_image_id)) {
                    error_log('Error downloading image: ' . $learnpress_coaching_image_id->get_error_message());
                } else {
                    // Assign featured image to post
                    set_post_thumbnail($learnpress_coaching_post_id, $learnpress_coaching_image_id);
                }
            }

            //Copyright Text
            set_theme_mod( 'learnpress_coaching_footer_text', 'By Buywptemplate' );
        }
    ?>

    <form action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php?page=learnpress-coaching-guide-page" method="POST" onsubmit="return validate(this);">
    <?php if (!get_option('learnpress_coaching_demo_import_completed')) : ?>
        <div class="demo-btn">
        <h3><?php esc_html_e( 'Click the below run importer button to import demo content', 'learnpress-coaching' ); ?></h3>
        <form method="post">
            <input class= "run-import" type="submit" name="submit" value="<?php esc_attr_e('Run Importer','learnpress-coaching'); ?>" class="button button-primary button-large">
        </form>
        </div>
    <?php endif; ?>
    </form>
	<script type="text/javascript">
		function validate(valid) {
			if (confirm("Do you really want to import the theme demo content?")) {
                // Show loader
                document.getElementById('demo-import-loader').style.display = 'block';
                
                // Submit form
                document.forms[0].submit();
            } else {
                return false;
            }
		}
	</script>
</div>
