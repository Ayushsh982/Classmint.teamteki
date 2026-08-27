<div class="theme-offer">
	<?php 
        // Check if the demo import has been completed
        $sirat_demo_import_completed = get_option('sirat_demo_import_completed', false);

        // If the demo import is completed, display the "View Site" button
        if ($sirat_demo_import_completed) {
        echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'sirat') . '</p>';
        echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('View Site', 'sirat') . '</a></span>';
        echo '<span><a href="'. esc_url(admin_url('customize.php') ) .'" class="button button-primary demo-btn" target=_blank>'. esc_html__( 'Customize Your Site', 'sirat' ) .'</a></span>';
        echo '<span><a href="'. esc_url( 'https://preview.vwthemesdemo.com/docs/free-sirat/' ) .'" class="button button-primary doc-btn" target=_blank>'. esc_html__( 'Free Theme Documentation', 'sirat' ) .'</a></span>';
        }

		//POST and update the customizer and other related data
        if (isset($_POST['submit'])) {

            // Check if ibtana visual editor is installed and activated
            if (!is_plugin_active('ibtana-visual-editor/plugin.php')) {
              // Install the plugin if it doesn't exist
              $sirat_plugin_slug = 'ibtana-visual-editor';
              $sirat_plugin_file = 'ibtana-visual-editor/plugin.php';

              // Check if plugin is installed
              $sirat_installed_plugins = get_plugins();
              if (!isset($sirat_installed_plugins[$sirat_plugin_file])) {
                  include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
                  include_once(ABSPATH . 'wp-admin/includes/file.php');
                  include_once(ABSPATH . 'wp-admin/includes/misc.php');
                  include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

                  // Install the plugin
                  $sirat_upgrader = new Plugin_Upgrader();
                  $sirat_upgrader->install('https://downloads.wordpress.org/plugin/ibtana-visual-editor.latest-stable.zip');
              }
              // Activate the plugin
              activate_plugin($sirat_plugin_file);
            }

            // ------- Create Nav Menu --------
            $sirat_menuname = 'Main Menus';
            $sirat_bpmenulocation = 'primary';
            $sirat_menu_exists = wp_get_nav_menu_object($sirat_menuname);

            if (!$sirat_menu_exists) {
                $sirat_menu_id = wp_create_nav_menu($sirat_menuname);

                // Create Home Page
                $sirat_home_title = 'Home';
                $sirat_home = array(
                    'post_type' => 'page',
                    'post_title' => $sirat_home_title,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'home'
                );
                $sirat_home_id = wp_insert_post($sirat_home);
                // Assign Home Page Template
                add_post_meta($sirat_home_id, '_wp_page_template', 'page-template/custom-home-page.php');
                // Update options to set Home Page as the front page
                update_option('page_on_front', $sirat_home_id);
                update_option('show_on_front', 'page');
                // Add Home Page to Menu
                wp_update_nav_menu_item($sirat_menu_id, 0, array(
                    'menu-item-title' => __('Home', 'sirat'),
                    'menu-item-classes' => 'home',
                    'menu-item-url' => home_url('/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $sirat_home_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create Pages Page with Dummy Content
                $sirat_pages_title = 'Pages';
                $sirat_pages_content = '
                <p>Explore all the pages we have on our website. Find information about our services, company, and more.</p>

                 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                  All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $sirat_pages = array(
                    'post_type' => 'page',
                    'post_title' => $sirat_pages_title,
                    'post_content' => $sirat_pages_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'pages'
                );
                $sirat_pages_id = wp_insert_post($sirat_pages);
                // Add Pages Page to Menu
                wp_update_nav_menu_item($sirat_menu_id, 0, array(
                    'menu-item-title' => __('Pages', 'sirat'),
                    'menu-item-classes' => 'pages',
                    'menu-item-url' => home_url('/pages/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $sirat_pages_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create About Us Page with Dummy Content
                $sirat_about_title = 'About Us';
                $sirat_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $sirat_about = array(
                    'post_type' => 'page',
                    'post_title' => $sirat_about_title,
                    'post_content' => $sirat_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $sirat_about_id = wp_insert_post($sirat_about);
                // Add About Us Page to Menu
                wp_update_nav_menu_item($sirat_menu_id, 0, array(
                    'menu-item-title' => __('About Us', 'sirat'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $sirat_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                                //SERVICES PAGE 
                $sirat_services = array(
                    'post_type'   => 'page',
                    'post_title'  => 'Services',
                    'post_content'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. We provide high quality services tailored to your needs.',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name'   => 'services'
                );
                $sirat_services_id = wp_insert_post($sirat_services);

                wp_update_nav_menu_item($sirat_menu_id, 0, array(
                    'menu-item-title'  => __('Services', 'sirat'),
                    'menu-item-classes'=> 'services',
                    'menu-item-url'    => home_url('/services/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $sirat_services_id,
                    'menu-item-object' => 'page',
                    'menu-item-type'   => 'post_type'
                ));

                //PROJECTS PAGE
                $sirat_projects = array(
                    'post_type'   => 'page',
                    'post_title'  => 'Projects',
                    'post_content'=> 'Explore our completed and ongoing projects showcasing our expertise and commitment.',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name'   => 'projects'
                );
                $sirat_projects_id = wp_insert_post($sirat_projects);

                wp_update_nav_menu_item($sirat_menu_id, 0, array(
                    'menu-item-title'  => __('Projects', 'sirat'),
                    'menu-item-classes'=> 'projects',
                    'menu-item-url'    => home_url('/projects/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $sirat_projects_id,
                    'menu-item-object' => 'page',
                    'menu-item-type'   => 'post_type'
                ));

                // TEAM PAGE 
                $sirat_team = array(
                    'post_type'   => 'page',
                    'post_title'  => 'Our Team',
                    'post_content'=> 'Meet our experienced and dedicated team members who drive our success.',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name'   => 'team'
                );
                $sirat_team_id = wp_insert_post($sirat_team);

                wp_update_nav_menu_item($sirat_menu_id, 0, array(
                    'menu-item-title'  => __('Our Team', 'sirat'),
                    'menu-item-classes'=> 'team',
                    'menu-item-url'    => home_url('/team/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $sirat_team_id,
                    'menu-item-object' => 'page',
                    'menu-item-type'   => 'post_type'
                ));

                // TESTIMONIALS PAGE
                $sirat_testimonial = array(
                    'post_type'   => 'page',
                    'post_title'  => 'Testimonials',
                    'post_content'=> 'What our clients say about us. Read genuine feedback from our valued customers.',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name'   => 'testimonials'
                );
                $sirat_testimonial_id = wp_insert_post($sirat_testimonial);

                wp_update_nav_menu_item($sirat_menu_id, 0, array(
                    'menu-item-title'  => __('Testimonials', 'sirat'),
                    'menu-item-classes'=> 'testimonials',
                    'menu-item-url'    => home_url('/testimonials/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $sirat_testimonial_id,
                    'menu-item-object' => 'page',
                    'menu-item-type'   => 'post_type'
                ));

                // Create Blog Page 
                $sirat_blog_page_title = 'Blog';

                $sirat_blog_page_query = new WP_Query(array(
                    'post_type'      => 'page',
                    'name'           => sanitize_title($sirat_blog_page_title),
                    'post_status'    => 'publish',
                    'posts_per_page' => 1
                ));
                if (!$sirat_blog_page_query->have_posts()) {
                    $sirat_blog_page = array(
                        'post_type'   => 'page',
                        'post_title'  => $sirat_blog_page_title,
                        'post_status' => 'publish',
                        'post_author' => 1,
                    );
                    $sirat_blog_page_id = wp_insert_post($sirat_blog_page);
                    update_option('page_for_posts', $sirat_blog_page_id);

                    wp_update_nav_menu_item($sirat_menu_id, 0, array(
                        'menu-item-title'      => __('Blog', 'sirat'),
                        'menu-item-url'        => get_permalink($sirat_blog_page_id),
                        'menu-item-status'     => 'publish',
                        'menu-item-object-id'  => $sirat_blog_page_id,
                        'menu-item-object'     => 'page',
                        'menu-item-type'       => 'post_type',
                    ));
                }

                    // CONTACT US PAGE
                    $sirat_contact = array(
                        'post_type'   => 'page',
                        'post_title'  => 'Contact Us',
                        'post_content'=> 'Get in touch with us for inquiries, support, or collaboration. We’d love to hear from you.',
                        'post_status' => 'publish',
                        'post_author' => 1,
                        'post_name'   => 'contact-us'
                    );
                    $sirat_contact_id = wp_insert_post($sirat_contact);

                    wp_update_nav_menu_item($sirat_menu_id, 0, array(
                        'menu-item-title'  => __('Contact Us', 'sirat'),
                        'menu-item-classes'=> 'contact-us',
                        'menu-item-url'    => home_url('/contact-us/'),
                        'menu-item-status' => 'publish',
                        'menu-item-object-id' => $sirat_contact_id,
                        'menu-item-object' => 'page',
                        'menu-item-type'   => 'post_type'
                    ));

                // Set the menu location if it's not already set
                if (!has_nav_menu($sirat_bpmenulocation)) {
                    $locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
                    if (empty($locations)) {
                        $locations = array();
                    }
                    $locations[$sirat_bpmenulocation] = $sirat_menu_id;
                    set_theme_mod('nav_menu_locations', $locations);
                }
                
        }

           
            // Set the demo import completion flag
    		update_option('sirat_demo_import_completed', true);
    		// Display success message and "View Site" button
    		echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'sirat') . '</p>';
    		echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('View Site', 'sirat') . '</a></span>';
            echo '<span><a href="'. esc_url(admin_url('customize.php') ) .'" class="button button-primary demo-btn" target=_blank>'. esc_html__( 'Customize Your Site', 'sirat' ) .'</a></span>';
            echo '<span><a href="'. esc_url( 'https://preview.vwthemesdemo.com/docs/free-sirat/' ) .'" class="button button-primary doc-btn" target=_blank>'. esc_html__( 'Free Theme Documentation', 'sirat' ) .'</a></span>';
            //end 


            // Top Bar //
            set_theme_mod( 'sirat_search_icon', 'fas fa-search' );  
            set_theme_mod( 'sirat_search_close_icon', 'fa fa-window-close' );  
            set_theme_mod( 'sirat_search_placeholder', 'Search' );  

            set_theme_mod( 'sirat_phone_icon', 'fas fa-phone' );  
            set_theme_mod( 'sirat_contact_call', '+00 987 654 1230' );  
            set_theme_mod( 'sirat_contact_email_icon', 'far fa-envelope' );  
            set_theme_mod( 'sirat_contact_email', 'example@gmail.com' );  

            // slider section start // 
            set_theme_mod( 'sirat_events_small_heading', 'TE OBTINUIT UT ADEPTO SATIS SOMNO. ALIISQUE' );
            set_theme_mod( 'sirat_slider_button_text', 'Read More' );
            set_theme_mod( 'sirat_top_button_url', '#' );
            
            for($sirat_i=1;$sirat_i<=3;$sirat_i++){
               $sirat_slider_title = 'TE OBTINUIT UT ADEPTO SATIS SOMNO. ALIISQUE';
               $sirat_slider_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum.';
                  // Create post object
               $my_post = array(
               'post_title'    => wp_strip_all_tags( $sirat_slider_title ),
               'post_content'  => $sirat_slider_content,
               'post_status'   => 'publish',
               'post_type'     => 'page',
               );

               // Insert the post into the database
               $sirat_post_id = wp_insert_post( $my_post );

               if ($sirat_post_id) {
                 // Set the theme mod for the slider page
                 set_theme_mod('sirat_slider_page' . $sirat_i, $sirat_post_id);

                  $sirat_image_url = get_template_directory_uri().'/assets/images/slider'.$sirat_i.'.png';

                $sirat_image_id = media_sideload_image($sirat_image_url, $sirat_post_id, null, 'id');

                    if (!is_wp_error($sirat_image_id)) {
                        // Set the downloaded image as the post's featured image
                        set_post_thumbnail($sirat_post_id, $sirat_image_id);
                    }
                }
            }    
            

            // Our Services Section //
            set_theme_mod( 'sirat_section_title', 'AWESOME SERVICES' );
            set_theme_mod( 'sirat_section_text', 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum.' );
            set_theme_mod( 'sirat_about_button_text', 'Read More' );
            set_theme_mod('sirat_our_services', 'servicecategory1');

            // Define post category names and post titles
            $sirat_category_names = array('servicecategory1', 'servicecategory2', 'servicecategory3', 'servicecategory4');
            $sirat_title_array = array(
                array("Service Title 1", "Service Title 2", "Service Title 3"),
                array("Service Title 1", "Service Title 2", "Service Title 3"),
                array("Service Title 1", "Service Title 2", "Service Title 3"),
                array("Service Title 1", "Service Title 2", "Service Title 3")
            );

            foreach ($sirat_category_names as $sirat_index => $sirat_category_name) {
                // Create or retrieve the post category term ID
                $sirat_term = term_exists($sirat_category_name, 'category');
                if ($sirat_term === 0 || $sirat_term === null) {
                    // If the term does not exist, create it
                    $sirat_term = wp_insert_term($sirat_category_name, 'category');
                }
                if (is_wp_error($sirat_term)) {
                    error_log('Error creating category: ' . $sirat_term->get_error_message());
                    continue; // Skip to the next iteration if category creation fails
                }

                for ($sirat_i = 0; $sirat_i < 3; $sirat_i++) {
                    // Create post content
                    $sirat_title = $sirat_title_array[$sirat_index][$sirat_i];
                    $sirat_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus.';

                    // Create post post object
                    $sirat_my_post = array(
                        'post_title'    => wp_strip_all_tags($sirat_title),
                        'post_content'  => $sirat_content,
                        'post_status'   => 'publish',
                        'post_type'     => 'post', // Post type set to 'post'
                    );

                    // Insert the post into the database
                    $sirat_post_id = wp_insert_post($sirat_my_post);

                    if (is_wp_error($sirat_post_id)) {
                        error_log('Error creating post: ' . $sirat_post_id->get_error_message());
                        continue; // Skip to the next post if creation fails
                    }

                    // Assign the category to the post
                    wp_set_post_categories($sirat_post_id, array((int)$sirat_term['term_id']));

                    // Handle the featured image using media_sideload_image
                    $sirat_image_url = get_template_directory_uri() . '/inc/block-patterns/images/services' . ($sirat_i + 1) . '.png';
                    $sirat_image_id = media_sideload_image($sirat_image_url, $sirat_post_id, null, 'id');

                    if (is_wp_error($sirat_image_id)) {
                        error_log('Error downloading image: ' . $sirat_image_id->get_error_message());
                        continue; // Skip to the next post if image download fails
                    }
                    // Assign featured image to post
                    set_post_thumbnail($sirat_post_id, $sirat_image_id);
                }
            }  


                $sirat_about_page_title = 'About Us';
                $sirat_about_page_content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita';

                // Create post object
                $my_post = array(
                    'post_title'    => wp_strip_all_tags($sirat_about_page_title),
                    'post_content'  => $sirat_about_page_content,
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                );

                // Insert the post into the database
                $sirat_post_id = wp_insert_post($my_post);

                if ($sirat_post_id) {
                    // Set the theme mod for the slider page
                    set_theme_mod('sirat_about_page', $sirat_post_id);

                    // Set the image URL (assuming there's only one image now)
                    $sirat_image_url = get_template_directory_uri().'/inc/block-patterns/images/about-us.png';

                    // Download and attach the image
                    $sirat_image_id = media_sideload_image($sirat_image_url, $sirat_post_id, null, 'id');

                    if (!is_wp_error($sirat_image_id)) {
                        // Set the downloaded image as the post's featured image
                        set_post_thumbnail($sirat_post_id, $sirat_image_id);
                    }
                }
              
            //Copyright Text
            set_theme_mod( 'sirat_footer_text', 'By VWThemes' );  
     
        }
    ?>
  
	
    <form action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php?page=sirat_guide" method="POST" onsubmit="return validate(this);">
        <?php if (!get_option('sirat_demo_import_completed')) : ?>
             <form method="post">
                 <p class="run-import-text"><?php esc_html_e('Click On The Below Run Importer Button To Import Demo Content Of Sirat', 'sirat'); ?></p>
                <p><?php esc_html_e('Please back up your website if it’s already live with data. This importer will overwrite your existing settings with the new customizer values for Sirat', 'sirat'); ?></p>
            <input class="run-import" type="submit" name="submit" value="<?php esc_attr_e('Run Importer', 'sirat'); ?>" class="button button-primary button-large">
              </form>   
            <?php endif; ?>
        <div id="spinner" style="display:none;">         
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/spinner.png" alt="" />
        </div>
    </form>
    <script type="text/javascript">
        function validate(form) {
            if (confirm("Do you really want to import the theme demo content?")) {
                // Show the spinner
                document.getElementById('spinner').style.display = 'block';
                // Allow the form to be submitted
                return true;
            } 
            else {
                return false;
            }
        }
    </script>
</div>

