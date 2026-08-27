<?php

add_action( 'admin_menu', 'learnpress_coaching_gettingstarted' );
function learnpress_coaching_gettingstarted() {    	
	add_theme_page( esc_html__('About Theme', 'learnpress-coaching'), esc_html__('Theme Demo Import', 'learnpress-coaching'), 'edit_theme_options', 'learnpress-coaching-guide-page', 'learnpress_coaching_guide');   
}

function learnpress_coaching_admin_theme_style() {
   wp_enqueue_style('learnpress-coaching-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/get_started_info.css');
   wp_enqueue_script('learnpress-coaching-tab', esc_url( get_template_directory_uri() ) . '/inc/dashboard/js/get_started_tab.js');
   // Admin notice code START
	wp_register_script('learnpress-coaching-notice', esc_url(get_template_directory_uri()) . '/inc/dashboard/js/notice.js', array('jquery'), time(), true);
	wp_enqueue_script('learnpress-coaching-notice');
	// Admin notice code END
}
add_action('admin_enqueue_scripts', 'learnpress_coaching_admin_theme_style');

// Notice after Theme Activation
function learnpress_coaching_notice(){
    // Hide permanently if dismissed
    if ( get_option('learnpress_coaching_admin_notice') == 1 ) {
        return;
    }
    // Hide ONLY on Get Started page
    if ( isset($_GET['page']) && $_GET['page'] === 'learnpress-coaching-guide-page' ) {
        return;
    }  {?>
    <div id="learnpress-coaching-welcome-notice" class="notice notice-success is-dismissible getting_started activation-notice">
		<div class="notice-info">
			<div class="notice-image">
				<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
			</div>
			<div class="notice-content">
				<h2><?php esc_html_e( 'Thanks For Installing Learnpress Coaching, You Rock!', 'learnpress-coaching' ) ?> </h2>
				<p><?php esc_html_e( 'Take benefit of a variety of features, functionalities, elements, and an exclusive set of customization options to build your own professional charity website. Please Click on the link below to know the theme setup information.', 'learnpress-coaching' ) ?></p>
				<div style="display: grid;">
					<a class="button notice-btn" href="<?php echo esc_url( admin_url( 'themes.php?page=learnpress-coaching-guide-page' )); ?>"><?php esc_html_e( 'Get Started', 'learnpress-coaching' ) ?></a>
					<a class="button notice-btn" target="_blank" href="<?php echo esc_url( LEARNPREE_COACHING_LIVE_DEMO ); ?>"><?php esc_html_e('Pro Demo', 'learnpress-coaching') ?></a>
					<a  class="button notice-btn" target="_blank" href="<?php echo esc_url( LEARNPREE_COACHING_BUY_PRO ); ?>"><?php esc_html_e('Upgrade To Pro', 'learnpress-coaching') ?></a>
					<a  class="button notice-btn" target="_blank" href="<?php echo esc_url( LEARNPREE_COACHING_FREE_DOC ); ?>"><?php esc_html_e('Free Doc', 'learnpress-coaching') ?></a>
				</div>

			</div>
		</div>
	</div>
	<?php }
}
//Hook (VERY IMPORTANT)
add_action('admin_notices', 'learnpress_coaching_notice');

// Admin notice code START
add_action('wp_ajax_learnpress_coaching_dismiss_notice', 'learnpress_coaching_dismiss_notice');
function learnpress_coaching_dismiss_notice() {
    update_option('learnpress_coaching_admin_notice', 1);
    wp_die();
}

//After Switch theme function
add_action('after_switch_theme', 'learnpress_coaching_getstart_setup_options');
function learnpress_coaching_getstart_setup_options () {
    delete_option('learnpress_coaching_admin_notice');
}
// Admin notice code END

/**
 * Theme Info Page
 */
function learnpress_coaching_guide() {

	// Theme info
	$learnpress_coaching_return = add_query_arg( array()) ;
	$learnpress_coaching_theme = wp_get_theme( 'learnpress-coaching' ); ?>

	<div class="wrap getting-started">
		<div class="getting-started__header">
		    <div>
                <h2 class="tgmpa-notice-warning"></h2>
            </div>
		</div>
		<div class="tab-sec">
			<div class="tab">
				<button role="tab" class="tablinks home" onclick="learnpress_coaching_openCity(event, 'bwp_getstart')"><?php esc_html_e( 'Theme Demo Import', 'learnpress-coaching' ); ?></button>
				<button role="tab" class="tablinks" onclick="learnpress_coaching_openCity(event, 'bwp_setup')"><?php esc_html_e( 'Free Theme Information', 'learnpress-coaching' ); ?></button>
				<button role="tab" class="tablinks" onclick="learnpress_coaching_openCity(event, 'bwp_premium_info')"><?php esc_html_e( 'Premium Theme Information', 'learnpress-coaching' ); ?></button>
				<a class="tablinks" role="tab" href="<?php echo esc_url( LEARNPREE_COACHING_LIVE_DEMO ); ?>" target="_blank">
					<?php esc_html_e( 'Live Demo', 'learnpress-coaching' ); ?>
				</a>
				<a class="tablinks" role="tab" href="<?php echo esc_url( LEARNPREE_COACHING_BUY_PRO ); ?>" target="_blank">
					<?php esc_html_e( 'Buy Pro', 'learnpress-coaching' ); ?>
				</a>
			</div>
			<div  id="bwp_getstart" class="tabcontent">
				<div class="row">
					<div class="col-md-5 intro">
						<div class="pad-box">
							<h2><?php esc_html_e( 'Welcome to Learnpress Coaching ', 'learnpress-coaching' ); ?>
							<span><?php esc_html_e( 'Version: ', 'learnpress-coaching' ); ?><?php echo esc_html($learnpress_coaching_theme['Version']);?></span>
							</h2>
							<span class="intro__version"><?php esc_html_e( 'Congratulations! You are about to use the most easy to use and flexible WordPress theme.', 'learnpress-coaching' ); ?>
							</span>
							<div class="powered-by">
								<p><strong><?php esc_html_e( 'Theme created by Buy WP Templates', 'learnpress-coaching' ); ?></strong></p>
								<p>
									<img class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/theme-logo.png'); ?>"/>
								</p>
								<div class="demo-content">
									<?php
										/* Demo Import */
										require get_parent_theme_file_path( '/inc/dashboard/demo-content.php' );
									?>
								</div>

								<div id="demo-import-loader">
									<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/spinner.gif'); ?>" alt="<?php echo esc_attr( 'Loading...', 'learnpress-coaching'); ?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="install-plugins">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/responsive1.png'); ?>" alt="<?php echo esc_attr( 'responsive-image', 'learnpress-coaching'); ?>" />
						</div>
					</div>
				</div>
				<div class="dashboard__blocks">
					<div class="row">
						<div class="col-md-3">
							<h3><?php esc_html_e( 'Get Support','learnpress-coaching'); ?></h3>
							<ol>
								<li><a target="_blank" href="<?php echo esc_url( LEARNPREE_COACHING_FREE_SUPPORT ); ?>"><?php esc_html_e( 'Free Theme Support','learnpress-coaching'); ?></a></li>
								<li><a target="_blank" href="<?php echo esc_url( LEARNPREE_COACHING_PRO_SUPPORT ); ?>"><?php esc_html_e( 'Premium Theme Support','learnpress-coaching'); ?></a></li>
							</ol>
						</div>
						<div class="col-md-3">
							<h3><?php esc_html_e( 'Getting Started','learnpress-coaching'); ?></h3>
							<ol>
								<li><?php esc_html_e( 'Start','learnpress-coaching'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','learnpress-coaching'); ?></a> <?php esc_html_e( 'your website.','learnpress-coaching'); ?> </li>
							</ol>
						</div>
						<div class="col-md-3">
							<h3><?php esc_html_e( 'Help Docs','learnpress-coaching'); ?></h3>
							<ol>
								<li><a target="_blank" href="<?php echo esc_url( LEARNPREE_COACHING_FREE_DOC ); ?>"><?php esc_html_e( 'Free Theme Documentation','learnpress-coaching'); ?></a></li>
								<li><a target="_blank" href="<?php echo esc_url( LEARNPREE_COACHING_PRO_DOC ); ?>"><?php esc_html_e( 'Premium Theme Documentation','learnpress-coaching'); ?></a></li>
							</ol>
						</div>
						<div class="col-md-3">
							<h3><?php esc_html_e( 'Buy Premium','learnpress-coaching'); ?></h3>
							<ol>
								<a href="<?php echo esc_url( LEARNPREE_COACHING_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'learnpress-coaching'); ?></a>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div  id="bwp_setup" class="tabcontent">
				<h2 class="tg-docs-section intruction-title" id="section-4"><?php esc_html_e( '1) Setup Learnpress Coaching Theme', 'learnpress-coaching' ); ?></h2>
				<div class="row">
					<div class="theme-instruction-block col-md-7">
						<div class="pad-box">
							<p><?php esc_html_e( 'LearnPress Coaching is a beautiful and modern coacher theme designed for educators, tutors, coaches, mentors, and training institutes who want to build a powerful e-learning platform. This versatile coacher theme is ideal for online courses, e-learning platforms, coaching centers, education management systems, professional development programs, certification courses, mentorship, corporate training, webinars, and digital workshops. Built with the LearnPress LMS plugin, it provides powerful tools for course creation, student management, instructor dashboards, quizzes, assignments, certifications, curriculum management, and multilingual support. Whether you’re running online classes, skill development programs, or university-level training, this theme simplifies course setup, payment gateway integration, and interactive learning experiences. With a responsive and minimal design, your website will look stunning on any device, making it a perfect e-learning solution. It includes multiple header layouts, a drag-and-drop page builder for easy customization, and WooCommerce compatibility for selling courses or educational materials. The coacher-focused design ensures better engagement, while demo import functionality, RTL translation support, and SEO optimization help improve Google rankings. With access to 800+ Google Fonts, Live Customizer, Trending Posts widget, and related posts module, this theme enhances user experience, branding, and visibility, making LearnPress Coaching an ideal coacher theme for modern education websites and scalable e-learning platforms.', 'learnpress-coaching' ); ?><p><br>
							<ol>
								<li><?php esc_html_e( 'Start','learnpress-coaching'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','learnpress-coaching'); ?></a> <?php esc_html_e( 'your website.','learnpress-coaching'); ?> </l>
								<li><?php esc_html_e( 'Learnpress Coaching','learnpress-coaching'); ?> <a target="_blank" href="<?php echo esc_url( LEARNPREE_COACHING_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation','learnpress-coaching'); ?></a> </li>
							</ol>
						</div>
					</div>
					<div class="col-md-5">
						<div class="pad-box">
								<img class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/screenshot.png'); ?>"/>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-md-12 text-block tabcontent"  id="bwp_premium_info">
				<h2 class="dashboard-install-title"><?php esc_html_e( '2) Premium Theme Information.','learnpress-coaching'); ?></h2>
				<div class="row">
					<div class="col-md-7">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/responsive.png'); ?>" alt="<?php echo esc_attr( 'responsive-image', 'learnpress-coaching'); ?>">
						<div class="pad-box">
							<h3><?php esc_html_e( 'Pro Theme Description','learnpress-coaching'); ?></h3>
							<p class="pad-box-p"><?php esc_html_e( 'LearnPress Coaching is a beautiful and modern coacher theme designed for educators, tutors, coaches, mentors, and training institutes who want to build a powerful e-learning platform. This versatile coacher theme is ideal for online courses, e-learning platforms, coaching centers, education management systems, professional development programs, certification courses, mentorship, corporate training, webinars, and digital workshops. Built with the LearnPress LMS plugin, it provides powerful tools for course creation, student management, instructor dashboards, quizzes, assignments, certifications, curriculum management, and multilingual support. Whether you’re running online classes, skill development programs, or university-level training, this theme simplifies course setup, payment gateway integration, and interactive learning experiences. With a responsive and minimal design, your website will look stunning on any device, making it a perfect e-learning solution. It includes multiple header layouts, a drag-and-drop page builder for easy customization, and WooCommerce compatibility for selling courses or educational materials. The coacher-focused design ensures better engagement, while demo import functionality, RTL translation support, and SEO optimization help improve Google rankings. With access to 800+ Google Fonts, Live Customizer, Trending Posts widget, and related posts module, this theme enhances user experience, branding, and visibility, making LearnPress Coaching an ideal coacher theme for modern education websites and scalable e-learning platforms.', 'learnpress-coaching' ); ?><p>
						</div>
					</div>
					<div class="col-md-5 install-plugin-right">
						<div class="pad-box">
							<h3><?php esc_html_e( 'Pro Theme Features','learnpress-coaching'); ?></h3>
							<div class="dashboard-install-benefit">
								<ul>
									<li><?php esc_html_e( 'Car listing Shortcode with category','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Car listing Shortcode','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Multiple image feature for each property with slider.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Brand Listing Section','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Car Brand(categories) Option','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Car Tags(categories) Option','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Testimonial listing.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Testimonial shortcode.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Social icons widget.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Latest post with the image widget.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Live customize editor for the About US section.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Font Awesome integrated.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Advanced Color options and color pallets.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( '100+ Font Family Options.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Enable-Disable options on All sections.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Well sanitized as per WordPress standards.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Allow to set site title, tagline, logo.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Sticky post & Comment threads.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Left and Right Sidebar.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Customizable Home Page.','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Footer Widgets & Editor style','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Gallery & Banner functionality','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Multiple inner page templates','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Full-width Template','learnpress-coaching'); ?></li>
									<li><?php esc_html_e( 'Custom Menu, Colors Editor','learnpress-coaching'); ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php }?>