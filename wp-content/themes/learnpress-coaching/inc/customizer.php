<?php
/**
 * LearnPress Coaching Theme Customizer
 * @package LearnPress Coaching
 */

load_template( trailingslashit( get_template_directory() ) . '/inc/logo-sizer.php' );
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function learnpress_coaching_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/custom-control.php' );
	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-changer.php' );

	$wp_customize->add_setting( 'learnpress_coaching_logo_sizer',array(
		'default' => 50,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_logo_sizer',array(
		'label' => esc_html__( 'Logo Sizer','learnpress-coaching' ),
		'section' => 'title_tagline',
		'priority'    => 9,
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting('learnpress_coaching_logo_padding',array(
		'default'=> '',
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_logo_padding',array(
		'label' => esc_html__( 'Logo Padding (px)','learnpress-coaching' ),
		'section'=> 'title_tagline',
		'input_attrs' => array(
         'step'  => 1,
			'min'   => 0,
			'max'   => 100,
     	),
	)));

	$wp_customize->add_setting('learnpress_coaching_logo_margin',array(
		'default'=> '',
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_logo_margin',array(
		'label' => esc_html__( 'Logo Margin  (px)','learnpress-coaching' ),
		'section'=> 'title_tagline',
		'input_attrs' => array(
         'step'  => 1,
			'min'   => 0,
			'max'   => 100,
        ),
	)));

	$wp_customize->add_setting('learnpress_coaching_site_title_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_site_title_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Site Title','learnpress-coaching'),
       'section' => 'title_tagline'
    ));

    $wp_customize->add_setting('learnpress_coaching_site_title_font_size',array(
		'default'=> 30,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_site_title_font_size',array(
		'label' => esc_html__( 'Site Title Font Size (px)','learnpress-coaching' ),
		'section'=> 'title_tagline',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

	// site title color
   $wp_customize->add_setting('learnpress_coaching_site_title_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_site_title_color', array(
		'label'    => __('Site Title Color', 'learnpress-coaching'),
		'section'  => 'title_tagline',
		'settings' => 'learnpress_coaching_site_title_color',
	)));

    $wp_customize->add_setting('learnpress_coaching_site_tagline_enable',array(
       'default' => false,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_site_tagline_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Site Tagline','learnpress-coaching'),
       'section' => 'title_tagline'
    ));

    $wp_customize->add_setting('learnpress_coaching_site_tagline_font_size',array(
		'default'=> 12,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_site_tagline_font_size',array(
		'label' => esc_html__( 'Site Tagline Font Size (px)','learnpress-coaching' ),
		'section'=> 'title_tagline',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

	// site tagline font color
	$wp_customize->add_setting('learnpress_coaching_site_tagline_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_site_tagline_color', array(
		'label'    => __(' Site Tagline Color', 'learnpress-coaching'),
		'section'  => 'title_tagline',
		'settings' => 'learnpress_coaching_site_tagline_color',
	)));

    $wp_customize->add_setting('learnpress_coaching_site_logo_inline',array(
       'default' => false,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_site_logo_inline',array(
       'type' => 'checkbox',
       'label' => __('Site logo inline with site title','learnpress-coaching'),
       'section' => 'title_tagline',
    ));

    $wp_customize->add_setting('learnpress_coaching_background_skin',array(
        'default' => 'Without Background',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_background_skin',array(
        'type' => 'radio',
        'label' => __('Background Skin','learnpress-coaching'),
        'description' => __('Here you can add the background skin along with the background image.','learnpress-coaching'),
        'section' => 'background_image',
        'choices' => array(
            'With Background' => __('With Background Skin','learnpress-coaching'),
            'Without Background' => __('Without Background Skin','learnpress-coaching'),
        ),
	) );

	//Important Links
	$wp_customize->add_section( 'learnpress_coaching_important_links' , array(
    	'title' => esc_html__( 'Important Links', 'learnpress-coaching' ),
    	'priority' => 10,
	) );

	$wp_customize->add_setting('learnpress_coaching_doc_link',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_doc_link',array(
		'type'=> 'hidden',
		'description' => "<a target='_blank' href='". esc_url(LEARNPREE_COACHING_FREE_DOC) ." '>". esc_html('Documentation','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_important_links'
	));

	$wp_customize->add_setting('learnpress_coaching_demo_links',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_demo_links',array(
		'type'=> 'hidden',
		'description' => "<a target='_blank' href='". esc_url(LEARNPREE_COACHING_LIVE_DEMO) ." '>". esc_html('Demo','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_important_links'
	));

	$wp_customize->add_setting('learnpress_coaching_forum_links',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_forum_links',array(
		'type'=> 'hidden',
		'section'=> 'learnpress_coaching_important_links',
		'description' => "<a target='_blank' href='". esc_url(LEARNPREE_COACHING_FREE_SUPPORT) ." '>". esc_html('Support Forum','learnpress-coaching') ."</a>",
	));

	$wp_customize->add_setting('learnpress_coaching_review_links',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_review_links',array(
		'type'=> 'hidden',
		'section'=> 'learnpress_coaching_important_links',
		'description' => "<a target='_blank' href='". esc_url(LEARNPREE_COACHING_REVIEW) ." '>". esc_html('Review','learnpress-coaching') ."</a>",
	));

	//add home page setting pannel
	$wp_customize->add_panel( 'learnpress_coaching_panel_id', array(
	    'priority' => 11,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'learnpress-coaching' ),
	    'description' => __( 'Description of what this panel does.', 'learnpress-coaching' ),
	) );

	$learnpress_coaching_font_array = array(
		''                       => 'No Fonts',
		'Abril Fatface'          => 'Abril Fatface',
		'Acme'                   => 'Acme',
		'Anton'                  => 'Anton',
		'Architects Daughter'    => 'Architects Daughter',
		'Arimo'                  => 'Arimo',
		'Arsenal'                => 'Arsenal',
		'Arvo'                   => 'Arvo',
		'Alegreya'               => 'Alegreya',
		'Alfa Slab One'          => 'Alfa Slab One',
		'Averia Serif Libre'     => 'Averia Serif Libre',
		'Bangers'                => 'Bangers',
		'Boogaloo'               => 'Boogaloo',
		'Bad Script'             => 'Bad Script',
		'Bitter'                 => 'Bitter',
		'Bree Serif'             => 'Bree Serif',
		'BenchNine'              => 'BenchNine',
		'Cabin'                  => 'Cabin',
		'Cardo'                  => 'Cardo',
		'Courgette'              => 'Courgette',
		'Cherry Swash'           => 'Cherry Swash',
		'Cormorant Garamond'     => 'Cormorant Garamond',
		'Crimson Text'           => 'Crimson Text',
		'Cuprum'                 => 'Cuprum',
		'Cookie'                 => 'Cookie',
		'Chewy'                  => 'Chewy',
		'Days One'               => 'Days One',
		'Dosis'                  => 'Dosis',
		'Droid Sans'             => 'Droid Sans',
		'Economica'              => 'Economica',
		'Fredoka One'            => 'Fredoka One',
		'Fjalla One'             => 'Fjalla One',
		'Francois One'           => 'Francois One',
		'Frank Ruhl Libre'       => 'Frank Ruhl Libre',
		'Gloria Hallelujah'      => 'Gloria Hallelujah',
		'Great Vibes'            => 'Great Vibes',
		'Handlee'                => 'Handlee',
		'Hammersmith One'        => 'Hammersmith One',
		'Inconsolata'            => 'Inconsolata',
		'Indie Flower'           => 'Indie Flower',
		'IM Fell English SC'     => 'IM Fell English SC',
		'Julius Sans One'        => 'Julius Sans One',
		'Josefin Slab'           => 'Josefin Slab',
		'Josefin Sans'           => 'Josefin Sans',
		'Kanit'                  => 'Kanit',
		'Lobster'                => 'Lobster',
		'Lato'                   => 'Lato',
		'Lora'                   => 'Lora',
		'Libre Baskerville'      => 'Libre Baskerville',
		'Lobster Two'            => 'Lobster Two',
		'Merriweather'           => 'Merriweather',
		'Monda'                  => 'Monda',
		'Montserrat'             => 'Montserrat',
		'Muli'                   => 'Muli',
		'Marck Script'           => 'Marck Script',
		'Noto Serif'             => 'Noto Serif',
		'Open Sans'              => 'Open Sans',
		'Overpass'               => 'Overpass',
		'Overpass Mono'          => 'Overpass Mono',
		'Oxygen'                 => 'Oxygen',
		'Orbitron'               => 'Orbitron',
		'Patua One'              => 'Patua One',
		'Pacifico'               => 'Pacifico',
		'Padauk'                 => 'Padauk',
		'Playball'               => 'Playball',
		'Playfair Display'       => 'Playfair Display',
		'PT Sans'                => 'PT Sans',
		'Philosopher'            => 'Philosopher',
		'Permanent Marker'       => 'Permanent Marker',
		'Poiret One'             => 'Poiret One',
		'Quicksand'              => 'Quicksand',
		'Quattrocento Sans'      => 'Quattrocento Sans',
		'Raleway'                => 'Raleway',
		'Rubik'                  => 'Rubik',
		'Rokkitt'                => 'Rokkitt',
		'Russo One'              => 'Russo One',
		'Righteous'              => 'Righteous',
		'Slabo'                  => 'Slabo',
		'Source Sans Pro'        => 'Source Sans Pro',
		'Shadows Into Light Two' => 'Shadows Into Light Two',
		'Shadows Into Light'     => 'Shadows Into Light',
		'Sacramento'             => 'Sacramento',
		'Shrikhand'              => 'Shrikhand',
		'Tangerine'              => 'Tangerine',
		'Ubuntu'                 => 'Ubuntu',
		'VT323'                  => 'VT323',
		'Varela Round'           => 'Varela Round',
		'Vampiro One'            => 'Vampiro One',
		'Vollkorn'               => 'Vollkorn',
		'Volkhov'                => 'Volkhov',
		'Yanone Kaffeesatz'      => 'Yanone Kaffeesatz'
	);

	//Typography
	$wp_customize->add_section('learnpress_coaching_typography', array(
		'title'    => __('Typography', 'learnpress-coaching'),
		'panel'    => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_typography_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_typography_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_typography'
	));

	//This is body FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_body_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_body_color', array(
		'label'    => __('Body Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_body_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_body_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control(	'learnpress_coaching_body_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('Body Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	$wp_customize->add_setting('learnpress_coaching_body_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_body_font_size', array(
		'label'   => __('Body Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'setting' => 'learnpress_coaching_body_font_size',
		'type'    => 'text',
	));

	$wp_customize->add_setting('learnpress_coaching_body_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_body_font_weight',array(
		'type' => 'select',
		'label' => __('Body Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );		

	// This is Paragraph Color picker setting
	$wp_customize->add_setting('learnpress_coaching_paragraph_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_paragraph_color', array(
		'label'    => __('Paragraph Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_paragraph_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control(	'learnpress_coaching_paragraph_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('Paragraph Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	$wp_customize->add_setting('learnpress_coaching_paragraph_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_paragraph_font_size', array(
		'label'   => __('Paragraph Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'setting' => 'learnpress_coaching_paragraph_font_size',
		'type'    => 'text',
	));

	$wp_customize->add_setting('learnpress_coaching_paragraph_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_paragraph_font_weight',array(
		'type' => 'select',
		'label' => __('Paragraph Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );	

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting('learnpress_coaching_atag_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_atag_color', array(
		'label'    => __('"a" Tag Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_atag_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control(	'learnpress_coaching_atag_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('"a" Tag Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting('learnpress_coaching_li_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_li_color', array(
		'label'    => __('"li" Tag Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_li_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control(	'learnpress_coaching_li_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('"li" Tag Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting('learnpress_coaching_h1_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_h1_color', array(
		'label'    => __('H1 Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_h1_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control('learnpress_coaching_h1_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('H1 Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('learnpress_coaching_h1_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_h1_font_size', array(
		'label'   => __('H1 Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'setting' => 'learnpress_coaching_h1_font_size',
		'type'    => 'text',
	));

	//This is H1 FontWeight setting	
	$wp_customize->add_setting('learnpress_coaching_h1_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_h1_font_weight',array(
		'type' => 'select',
		'label' => __('H1 Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );		

	// This is H2 Color picker setting
	$wp_customize->add_setting('learnpress_coaching_h2_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_h2_color', array(
		'label'    => __('H2 Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_h2_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control(
	'learnpress_coaching_h2_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('H2 Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('learnpress_coaching_h2_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_h2_font_size', array(
		'label'   => __('H2 Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'setting' => 'learnpress_coaching_h2_font_size',
		'type'    => 'text',
	));

	//This is H2 FontWeight setting	
	$wp_customize->add_setting('learnpress_coaching_h2_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_h2_font_weight',array(
		'type' => 'select',
		'label' => __('H2 Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );	

	// This is H3 Color picker setting
	$wp_customize->add_setting('learnpress_coaching_h3_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_h3_color', array(
		'label'    => __('H3 Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_h3_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control(
	'learnpress_coaching_h3_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('H3 Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('learnpress_coaching_h3_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_h3_font_size', array(
		'label'   => __('H3 Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'setting' => 'learnpress_coaching_h3_font_size',
		'type'    => 'text',
	));

	//This is H3 FontWeight setting	
	$wp_customize->add_setting('learnpress_coaching_h3_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_h3_font_weight',array(
		'type' => 'select',
		'label' => __('H3 Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );		

	// This is H4 Color picker setting
	$wp_customize->add_setting('learnpress_coaching_h4_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_h4_color', array(
		'label'    => __('H4 Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_h4_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control('learnpress_coaching_h4_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('H4 Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('learnpress_coaching_h4_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_h4_font_size', array(
		'label'   => __('H4 Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'setting' => 'learnpress_coaching_h4_font_size',
		'type'    => 'text',
	));

	//This is H4 FontWeight setting	
	$wp_customize->add_setting('learnpress_coaching_h4_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_h4_font_weight',array(
		'type' => 'select',
		'label' => __('H4 Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );	

	// This is H5 Color picker setting
	$wp_customize->add_setting('learnpress_coaching_h5_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_h5_color', array(
		'label'    => __('H5 Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_h5_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control('learnpress_coaching_h5_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('H5 Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('learnpress_coaching_h5_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_h5_font_size', array(
		'label'   => __('H5 Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'setting' => 'learnpress_coaching_h5_font_size',
		'type'    => 'text',
	));

	//This is H5 FontWeight setting	
	$wp_customize->add_setting('learnpress_coaching_h5_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_h5_font_weight',array(
		'type' => 'select',
		'label' => __('H5 Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );		

	// This is H6 Color picker setting
	$wp_customize->add_setting('learnpress_coaching_h6_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_h6_color', array(
		'label'    => __('H6 Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_typography',
		'settings' => 'learnpress_coaching_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('learnpress_coaching_h6_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control('learnpress_coaching_h6_font_family', array(
		'section' => 'learnpress_coaching_typography',
		'label'   => __('H6 Fonts', 'learnpress-coaching'),
		'type'    => 'select',
		'choices' => $learnpress_coaching_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('learnpress_coaching_h6_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_h6_font_size', array(
		'label'   => __('H6 Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'setting' => 'learnpress_coaching_h6_font_size',
		'type'    => 'text',
	));

	//This is H6 FontWeight setting	
	$wp_customize->add_setting('learnpress_coaching_h6_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_h6_font_weight',array(
		'type' => 'select',
		'label' => __('H6 Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_typography',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );		

	//Top Bar Section
	$wp_customize->add_section('learnpress_coaching_topbar',array(
		'title'	=> __('Topbar','learnpress-coaching'),
		'description'	=> __('Add contact us here','learnpress-coaching'),
		'priority'	=> null,
		'panel' => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_topbar_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_topbar_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_topbar'
	));

	//Show /Hide Topbar
	$wp_customize->add_setting( 'learnpress_coaching_show_top_header',array(
		'default' => false,
      	'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ) );
    $wp_customize->add_control('learnpress_coaching_show_top_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Topbar','learnpress-coaching' ),
        'section' => 'learnpress_coaching_topbar'
    ));

	$wp_customize->add_setting( 'learnpress_coaching_sticky_header',array(
		'default'	=> false,
      	'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
 	) );
 	$wp_customize->add_control('learnpress_coaching_sticky_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Enable / Disable Sticky Header','learnpress-coaching' ),
        'section' => 'learnpress_coaching_topbar'
 	));

	$wp_customize->add_setting('learnpress_coaching_display_search',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_display_search',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Search','learnpress-coaching'),
		'section' => 'learnpress_coaching_topbar'
	));

    $wp_customize->add_setting('learnpress_coaching_email_icon',array(
		'default'	=> 'far fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
      $wp_customize,'learnpress_coaching_email_icon',array(
		'label'	=> __('Email Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_email_address',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));
	$wp_customize->add_control('learnpress_coaching_email_address',array(
		'label'	=> __('Add Email Address','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
      $wp_customize,'learnpress_coaching_time_icon',array(
		'label'	=> __('Time Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_time1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_time1',array(
		'label'	=> __('Add Time','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'text'
	));

   $wp_customize->add_setting('learnpress_coaching_location_icon',array(
		'default'	=> 'fas fa-map-marker-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
      $wp_customize,'learnpress_coaching_location_icon',array(
		'label'	=> __('Location Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_location',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_location',array(
		'label' => __('Add Location Address Text','learnpress-coaching'),
		'section' => 'learnpress_coaching_topbar',
		'type'    => 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_location1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_location1',array(
		'label'	=> __('Add Location Address','learnpress-coaching'),
		'section' => 'learnpress_coaching_topbar',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
      $wp_customize,'learnpress_coaching_phone_icon',array(
		'label'	=> __('Phone Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_call1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_call1',array(
		'label'	=> __('Add Phone Text','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_call',array(
		'default'	=> '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_phone_number'
	));
	$wp_customize->add_control('learnpress_coaching_call',array(
		'label'	=> __('Add Phone Number','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_free1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_free1',array(
		'label'	=> __('Add Button Text','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_free',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_free',array(
		'label'	=> __('Add Button Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_topbar',
		'type'		=> 'url'
	));
	
	$wp_customize->add_setting('learnpress_coaching_header_icons_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_header_icons_size', array(
		'label'   => __('Icon Font Size', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_topbar',
		'setting' => 'learnpress_coaching_header_icons_size',
		'type'    => 'number',
		'input_attrs' => array(
        'min'  => 10,
        'max'  => 40,
        'step' => 1,
		)
	));

	//Menu Settings
	$wp_customize->add_section( 'learnpress_coaching_menu_setting' , array(
    	'title'      => __( 'Menus Settings', 'learnpress-coaching' ),
    	'priority'	=> null,
		'panel' => 'learnpress_coaching_panel_id'
	) );

	$wp_customize->add_setting('learnpress_coaching_menus_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_menus_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_menu_setting'
	));

	$wp_customize->add_setting('learnpress_coaching_menu_font_size_option',array(
		'default'=> 14,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,'learnpress_coaching_menu_font_size_option',array(
		'label'	=> __('Menu Font Size ','learnpress-coaching'),
		'section'=> 'learnpress_coaching_menu_setting',
		'input_attrs' => array(
         'step' => 1,
			'min'  => 0,
			'max'  => 50,
     	),
	)));

	$wp_customize->add_setting('learnpress_coaching_menu_top_bottom_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,'learnpress_coaching_menu_top_bottom_padding',array(
		'label'	=> __('Menu Top-Bottom Padding','learnpress-coaching'),
		'section'=> 'learnpress_coaching_menu_setting',
		'input_attrs' => array(
         'step' => 1,
			'min'  => 0,
			'max'  => 50,
      ),
	)));

	$wp_customize->add_setting('learnpress_coaching_menu_left_right_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,'learnpress_coaching_menu_left_right_padding',array(
		'label'	=> __('Menu Left-Right Padding','learnpress-coaching'),
		'section'=> 'learnpress_coaching_menu_setting',
		'input_attrs' => array(
         'step' => 1,
			'min'  => 0,
			'max'  => 50,
      ),
	)));

	$wp_customize->add_setting('learnpress_coaching_text_tranform_menu',array(
		'default' => 'Capitalize',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_text_tranform_menu',array(
		'type' => 'select',
		'label' => __('Menu Text Transform','learnpress-coaching'),
		'section' => 'learnpress_coaching_menu_setting',
		'choices' => array(
		   'Uppercase' => __('Uppercase','learnpress-coaching'),
		   'Lowercase' => __('Lowercase','learnpress-coaching'),
		   'Capitalize' => __('Capitalize','learnpress-coaching'),
		),
	) );

	$wp_customize->add_setting('learnpress_coaching_font_weight_option_menu',array(
		'default' => '500',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_font_weight_option_menu',array(
		'type' => 'select',
		'label' => __('Menu Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_menu_setting',
		'choices' => array(
		   '100' => __('100','learnpress-coaching'),
         '200' => __('200','learnpress-coaching'),
         '300' => __('300','learnpress-coaching'),
         '400' => __('400','learnpress-coaching'),
         '500' => __('500','learnpress-coaching'),
         '600' => __('600','learnpress-coaching'),
         '700' => __('700','learnpress-coaching'),
         '800' => __('800','learnpress-coaching'),
         '900' => __('900','learnpress-coaching'),
		),
	) );

	$wp_customize->add_setting('learnpress_coaching_menus_item_style',array(
        'default' => '',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_menus_item_style',array(
        'type' => 'select',
		'label' => __('Menu Item Hover Style','learnpress-coaching'),
		'section' => 'learnpress_coaching_menu_setting',
		'choices' => array(
            'None' => __('None','learnpress-coaching'),
            'Zoom In' => __('Zoom In','learnpress-coaching'),
        ),
	));

	$wp_customize->add_setting('learnpress_coaching_menu_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_menu_color', array(
		'label'    => __('Menu Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_menu_setting',
		'settings' => 'learnpress_coaching_menu_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_sub_menu_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_sub_menu_color', array(
		'label'    => __('Submenu Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_menu_setting',
		'settings' => 'learnpress_coaching_sub_menu_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_menu_hover_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_menu_hover_color', array(
		'label'    => __('Menu Hover Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_menu_setting',
		'settings' => 'learnpress_coaching_menu_hover_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_sub_menu_hover_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_sub_menu_hover_color', array(
		'label'    => __('Submenu Hover Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_menu_setting',
		'settings' => 'learnpress_coaching_sub_menu_hover_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_sub_menu_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_sub_menu_bg_color', array(
		'label'    => __('Submenu Background Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_menu_setting',
		'settings' => 'learnpress_coaching_sub_menu_bg_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_sub_menu_bg_hover_color', array(
		'default'           => '#976aff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_sub_menu_bg_hover_color', array(
		'label'    => __('Submenu Background Hover Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_menu_setting',
		'settings' => 'learnpress_coaching_sub_menu_bg_hover_color',
	)));

	//Social Media Section
	$wp_customize->add_section( 'learnpress_coaching_social_section' , array(
    	'title'      => __( 'Social Media Section', 'learnpress-coaching' ),
		'priority'   => null,
		'panel' => 'learnpress_coaching_panel_id'
	) );

	$wp_customize->add_setting('learnpress_coaching_social_icons_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_social_icons_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_social_section'
	));

	$wp_customize->add_setting('learnpress_coaching_show_icons',array(
		'default' => false,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_show_icons',array(
		'type' => 'checkbox',
		'label' => __('Show/Hide Social Icons','learnpress-coaching'),
		'section' => 'learnpress_coaching_social_section'
	));

    $wp_customize->add_setting('learnpress_coaching_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_facebook_icon',array(
		'label'	=> __('Facebook Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_facebook_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_facebook_link',array(
		'label'	=> __('Add Facebook Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'url'
	));

   $wp_customize->add_setting('learnpress_coaching_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_twitter_icon',array(
		'label'	=> __('Twitter Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_twitter_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_twitter_link',array(
		'label'	=> __('Add Twitter Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'url'
	));

   $wp_customize->add_setting('learnpress_coaching_linkdin_icon',array(
		'default'	=> 'fab fa-linkedin-in',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_linkdin_icon',array(
		'label'	=> __('Linkedin Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_linkdin_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_linkdin_link',array(
		'label'	=> __('Add Linkdin Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'url'
	));

   $wp_customize->add_setting('learnpress_coaching_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_instagram_icon',array(
		'label'	=> __('Instagram Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_instagram_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_instagram_link',array(
		'label'	=> __('Add Instagram Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'url'
	));

   $wp_customize->add_setting('learnpress_coaching_pintrest_icon',array(
		'default'	=> 'fab fa-pinterest-p',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_pintrest_icon',array(
		'label'	=> __('Pintrest Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_pintrest_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_pintrest_link',array(
		'label'	=> __('Add Pintrest Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_social_section',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('learnpress_coaching_social_icons_size',array(
		'default'=> 13,
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_social_icons_size',array(
		'label'	=> __('Social Icons Size ','learnpress-coaching'),
		'section'=> 'learnpress_coaching_social_section',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'type'=> 'number'
	));

	$wp_customize->add_setting('learnpress_coaching_social_icon_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_social_icon_color', array(
		'label'    => __('Social Icon Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_social_section',
		'settings' => 'learnpress_coaching_social_icon_color',
	)));	

	//Slider Section
	$wp_customize->add_section( 'learnpress_coaching_slider_section' , array(
    	'title'      => __( 'Slider Section', 'learnpress-coaching' ),
		'priority'   => null,
		'panel' => 'learnpress_coaching_panel_id'
	) );

	$wp_customize->add_setting('learnpress_coaching_slider_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_slider_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('You can change how many slides there are.','learnpress-coaching') ."</li><li>". esc_html('You can change the font family and the colours of headings and subheadings.','learnpress-coaching') ."</li><li>". esc_html('And so on...','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_slider_section'
	));

	$wp_customize->add_setting('learnpress_coaching_slider_hide',array(
       'default' => false,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_slider_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable slider','learnpress-coaching'),
       'section' => 'learnpress_coaching_slider_section',
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'learnpress_coaching_slider_setting' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'learnpress_coaching_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'learnpress_coaching_slider_setting' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'learnpress-coaching' ),
			'description' => __('Slider image size (1500 x 600)','learnpress-coaching'),
			'section'  => 'learnpress_coaching_slider_section',
			'allow_addition' => true,
			'type'     => 'dropdown-pages'
		) );

	}

	$wp_customize->add_setting('learnpress_coaching_slider_heading',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_slider_heading',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Slider Heading','learnpress-coaching'),
		'section' => 'learnpress_coaching_slider_section'
	));

	$wp_customize->add_setting('learnpress_coaching_slider_slider_heading_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_slider_slider_heading_color', array(
		'label'    => __('Slider Heading Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_slider_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_slider_text',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_slider_text',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Slider Text','learnpress-coaching'),
		'section' => 'learnpress_coaching_slider_section'
	));

	$wp_customize->add_setting('learnpress_coaching_slider_slider_text_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_slider_slider_text_color', array(
		'label'    => __('Slider Text Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_slider_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_show_slider_button',array(
	 'default' => true,
	 'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_show_slider_button',array(
	 'type' => 'checkbox',
	 'label' => __('Show / Hide Slider Button','learnpress-coaching'),
	 'section' => 'learnpress_coaching_slider_section'
	));

	$wp_customize->add_setting('learnpress_coaching_slider_button_text',array(
		'default'	=> __('Read More','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_slider_button_text',array(
		'label'	=> __('Slider Button Text','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_slider_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_slider_button_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_slider_button_link',array(
		'label'	=> esc_html__('Add Button Link','learnpress-coaching'),
		'section'=> 'learnpress_coaching_slider_section',
		'type'=> 'url'
	));

	$wp_customize->add_setting('learnpress_coaching_slider_btn_text_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_slider_btn_text_color', array(
		'label'    => __('Slider Button Text Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_slider_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_slider_btn_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_slider_btn_bg_color', array(
		'label'    => __('Slider Button Background Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_slider_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_enable_slider_overlay',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_enable_slider_overlay',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Slider Image Overlay','learnpress-coaching'),
		'section' => 'learnpress_coaching_slider_section'
	));

   $wp_customize->add_setting('learnpress_coaching_slider_overlay_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_slider_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_slider_section',
		'settings' => 'learnpress_coaching_slider_overlay_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_slider_previous_icon',array(
		'default'	=> 'fas fa-chevron-left',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new learnpress_coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_slider_previous_icon',array(
		'label'	=> __('Slider Previous Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_slider_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_slider_next_icon',array(
		'default'	=> 'fas fa-chevron-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new learnpress_coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_slider_next_icon',array(
		'label'	=> __('Slider Next Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_slider_section',
		'type'		=> 'icon'
	)));

	//Opacity
	$wp_customize->add_setting('learnpress_coaching_slider_opacity',array(
		'default'              => 0.6,
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control( 'learnpress_coaching_slider_opacity', array(
		'label'       => esc_html__( 'Slider Image Opacity','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_slider_section',
		'type'        => 'select',
		'settings'    => 'learnpress_coaching_slider_opacity',
		'choices' => array(
			'0' =>  esc_attr('0','learnpress-coaching'),
			'0.1' =>  esc_attr('0.1','learnpress-coaching'),
			'0.2' =>  esc_attr('0.2','learnpress-coaching'),
			'0.3' =>  esc_attr('0.3','learnpress-coaching'),
			'0.4' =>  esc_attr('0.4','learnpress-coaching'),
			'0.5' =>  esc_attr('0.5','learnpress-coaching'),
			'0.6' =>  esc_attr('0.6','learnpress-coaching'),
			'0.7' =>  esc_attr('0.7','learnpress-coaching'),
			'0.8' =>  esc_attr('0.8','learnpress-coaching'),
			'0.9' =>  esc_attr('0.9','learnpress-coaching')
		),
	));

	//content layout
    $wp_customize->add_setting('learnpress_coaching_slider_content_layout',array(
    	'default' => 'Left',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_slider_content_layout',array(
        'type' => 'radio',
        'label' => __('Slider Content Layout','learnpress-coaching'),
        'section' => 'learnpress_coaching_slider_section',
        'choices' => array(
            'Center' => __('Center','learnpress-coaching'),
            'Left' => __('Left','learnpress-coaching'),
            'Right' => __('Right','learnpress-coaching'),
        ),
	) );

	$wp_customize->add_setting('learnpress_coaching_option_slider_height',array(
		'default'=> __('600','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_option_slider_height',array(
		'label'	=> __('Slider Height','learnpress-coaching'),
		'section'=> 'learnpress_coaching_slider_section',
		'type'=> 'number'
	));

	$wp_customize->add_setting('learnpress_coaching_slider_content_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,  'learnpress_coaching_slider_content_top_padding',array(
		'label'	=> __('Top Bottom Slider Content Spacing','learnpress-coaching'),
		'section'=> 'learnpress_coaching_slider_section',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

	$wp_customize->add_setting('learnpress_coaching_slider_content_left_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,  'learnpress_coaching_slider_content_left_padding',array(
		'label'	=> __('Left Right Slider Content Spacing','learnpress-coaching'),
		'section'=> 'learnpress_coaching_slider_section',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

	//Slider excerpt
	$wp_customize->add_setting( 'learnpress_coaching_slider_excerpt_number', array(
		'default'              => 15,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'	=> 'absint'
	) );
	$wp_customize->add_control( 'learnpress_coaching_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Content Limit','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_slider_section',
		'type'        => 'number',
		'settings'    => 'learnpress_coaching_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'learnpress_coaching_slider_speed',array(
		'default' => 3000,
		'transport' => 'refresh',
		'type' => 'theme_mod',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_slider_speed',array(
		'label' => esc_html__( 'Slider Slide Speed','learnpress-coaching' ),
		'section' => 'learnpress_coaching_slider_section',
		'input_attrs' => array(
			'min' => 1000,
			'max' => 5000,
			'step' => 500,
		),
	)));

	//Our Services
  	$wp_customize->add_section('learnpress_coaching_category_section',array(
		'title' => __('Our Services','learnpress-coaching'),
		'description' => '',
		'priority'  => null,
		'panel' => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_ourservices_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_ourservices_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Includes settings to set section title.','learnpress-coaching') ."</li><li>". esc_html('Contains settings for the background colour.','learnpress-coaching') ."</li><li>". esc_html('And so on...','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_category_section'
	));

	$wp_customize->add_setting('learnpress_coaching_ourservices_enable',array(
		'default' => false,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_ourservices_enable',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Services','learnpress-coaching'),
		'section' => 'learnpress_coaching_category_section'
	));

	// category
	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cat_post[$category->slug] = $category->name;
	}

   $wp_customize->add_setting('learnpress_coaching_ourservices',array(
		'default' => 'select',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
  	));
  	$wp_customize->add_control('learnpress_coaching_ourservices',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Latest Post','learnpress-coaching'),
		'section' => 'learnpress_coaching_category_section',
	));

	//About Us
	$wp_customize->add_section('learnpress_coaching_about',array(
		'title'	=> __('About Us','learnpress-coaching'),
		'description'	=> __('Add About Us below.','learnpress-coaching'),
		'panel' => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_about_us_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_about_us_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_about'
	));

	$wp_customize->add_setting('learnpress_coaching_show_about_section',array(
	 'default' => true,
	 'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_show_about_section',array(
	 'type' => 'checkbox',
	 'label' => __('Show / Hide About Us Section','learnpress-coaching'),
	 'section' => 'learnpress_coaching_about'
	));

	$wp_customize->add_setting('learnpress_coaching_about_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_about_title',array(
		'label'	=> __('Section Title','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_about',
		'setting'	=> 'learnpress_coaching_about_title',
		'type'		=> 'text'
	));

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$i = 0;
	$posts[]='Select';
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('learnpress_coaching_single_post',array(
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control('learnpress_coaching_single_post',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','learnpress-coaching'),
		'section' => 'learnpress_coaching_about',
	));

	//layout setting
	$wp_customize->add_section( 'learnpress_coaching_option', array(
    	'title'      => __( 'Layout Settings', 'learnpress-coaching' ),
    	'panel'    => 'learnpress_coaching_panel_id',
	));

	// animation 
	$wp_customize->add_setting( 'learnpress_coaching_sidebar_animation',array(
	    'default' => true,
    	'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
  	) );
	$wp_customize->add_control('learnpress_coaching_sidebar_animation',array(
	    	'type' => 'checkbox',
	       'label' => __( 'Show / Hide Animations','learnpress-coaching' ),
	       'section' => 'learnpress_coaching_option'
	));

	// Progress Bar
	$wp_customize->add_setting( 'learnpress_coaching_progress_bar',array(
	    'default' => false,
    	'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
  	));
	$wp_customize->add_control('learnpress_coaching_progress_bar',array(
		'type' => 'checkbox',
		'label' => __( 'Show / Hide Progress Bar','learnpress-coaching' ),
		'section' => 'learnpress_coaching_option'
	));

	$wp_customize->add_setting('learnpress_coaching_layout_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_layout_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_option'
	));

	$wp_customize->add_setting( 'learnpress_coaching_single_page_breadcrumb',array(
		'default' => false,
	  	'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
   ) );
   $wp_customize->add_control('learnpress_coaching_single_page_breadcrumb',array(
	  	'type' => 'checkbox',
	   'label' => __( 'Show / Hide Single Page Breadcrumb','learnpress-coaching' ),
	   'section' => 'learnpress_coaching_option'
   ));

	$wp_customize->add_setting('learnpress_coaching_preloader',array(
       'default' => false,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_preloader',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Preloader','learnpress-coaching'),
       'section' => 'learnpress_coaching_option'
    ));

    $wp_customize->add_setting('learnpress_coaching_preloader_type',array(
        'default' => 'First Preloader Type',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_preloader_type',array(
        'type' => 'radio',
        'label' => __('Preloader Types','learnpress-coaching'),
        'section' => 'learnpress_coaching_option',
        'choices' => array(
            'First Preloader Type' => __('First Preloader Type','learnpress-coaching'),
            'Second Preloader Type' => __('Second Preloader Type','learnpress-coaching'),
        ),
	) );

	$wp_customize->add_setting('learnpress_coaching_preloader_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'learnpress_coaching_preloader_bg_image',array(
        'label' => __('Preloader Background Image','learnpress-coaching'),
        'section' => 'learnpress_coaching_option'
	)));

	$wp_customize->add_setting('learnpress_coaching_preloader_bg_color_option', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_preloader_bg_color_option', array(
		'label'    => __('Preloader Background Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_option',
	)));

	$wp_customize->add_setting('learnpress_coaching_preloader_icon_color_option', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_preloader_icon_color_option', array(
		'label'    => __('Preloader Icon Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_option',
	)));

	$wp_customize->add_setting('learnpress_coaching_width_layout_options',array(
        'default' => 'Default',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_width_layout_options',array(
        'type' => 'radio',
        'label' => __('Container Box','learnpress-coaching'),
        'description' => __('Here you can change the Width layout. ','learnpress-coaching'),
        'section' => 'learnpress_coaching_option',
        'choices' => array(
            'Default' => __('Default','learnpress-coaching'),
            'Container Layout' => __('Container Layout','learnpress-coaching'),
            'Box Layout' => __('Box Layout','learnpress-coaching'),
        ),
	) );

	// Add Page Sidebar Layout
	$wp_customize->add_setting('learnpress_coaching_page_sidebar_options',array(
        'default' => 'One Column',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	) );
	$wp_customize->add_control('learnpress_coaching_page_sidebar_options', array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','learnpress-coaching'),
        'section' => 'learnpress_coaching_option',
        'choices' => array(
            'One Column' => __('One Column','learnpress-coaching'),
            'Left Sidebar' => __('Left Sidebar','learnpress-coaching'),
            'Right Sidebar' => __('Right Sidebar','learnpress-coaching')
        ),
	)   );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('learnpress_coaching_layout_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	) );
	$wp_customize->add_control('learnpress_coaching_layout_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','learnpress-coaching'),
        'section' => 'learnpress_coaching_option',
        'choices' => array(
            'One Column' => __('One Column','learnpress-coaching'),
            'Three Columns' => __('Three Columns','learnpress-coaching'),
            'Four Columns' => __('Four Columns','learnpress-coaching'),
            'Grid Layout' => __('Grid Layout','learnpress-coaching'),
            'Left Sidebar' => __('Left Sidebar','learnpress-coaching'),
            'Right Sidebar' => __('Right Sidebar','learnpress-coaching')
        ),
	)   );

	$wp_customize->add_setting('learnpress_coaching_sidebar_size',array(
        'default' => 'Sidebar 1/3',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_sidebar_size',array(
        'type' => 'radio',
        'label' => __('Sidebar Size Option','learnpress-coaching'),
        'section' => 'learnpress_coaching_option',
        'choices' => array(
            'Sidebar 1/3' => __('Sidebar 1/3','learnpress-coaching'),
            'Sidebar 1/4' => __('Sidebar 1/4','learnpress-coaching'),
        ),
	) );

   //Global Color
	$wp_customize->add_section('learnpress_coaching_global_color', array(
		'title'    => __('Theme Color Option', 'learnpress-coaching'),
		'panel'    => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_global_color_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_global_color_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_global_color'
	));

	$wp_customize->add_setting('learnpress_coaching_first_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_first_color', array(
		'label'    => __('First Highlight Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_global_color',
		'settings' => 'learnpress_coaching_first_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_second_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_second_color', array(
		'label'    => __('Second Highlight Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_global_color',
		'settings' => 'learnpress_coaching_second_color',
	)));

	//Blog Post Settings
	$wp_customize->add_section('learnpress_coaching_post_settings', array(
		'title'    => __('Post General Settings', 'learnpress-coaching'),
		'panel'    => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_blog_post_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_blog_post_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_post_settings'
	));

	$wp_customize->add_setting('learnpress_coaching_post_layouts',array(
     'default' => 'Layout 2',
     'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Image_Radio_Control($wp_customize, 'learnpress_coaching_post_layouts', array(
        'type' => 'select',
        'label' => __('Post Layouts','learnpress-coaching'),
        'description' => __('Here you can change the 3 different layouts of post','learnpress-coaching'),
        'section' => 'learnpress_coaching_post_settings',
        'choices' => array(
            'Layout 1' => esc_url(get_template_directory_uri()).'/images/layout1.png',
            'Layout 2' => esc_url(get_template_directory_uri()).'/images/layout2.png',
            'Layout 3' => esc_url(get_template_directory_uri()).'/images/layout3.png',
    ))));

	$wp_customize->add_setting('learnpress_coaching_metafields_date',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_metafields_date',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Date ','learnpress-coaching'),
       'section' => 'learnpress_coaching_post_settings'
    ));

	$wp_customize->add_setting('learnpress_coaching_post_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_post_date_icon',array(
		'label'	=> __('Post Date Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('learnpress_coaching_metafields_author',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_metafields_author',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Author','learnpress-coaching'),
       'section' => 'learnpress_coaching_post_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_post_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_post_author_icon',array(
		'label'	=> __('Post Author Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('learnpress_coaching_metafields_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_metafields_comment',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Comments','learnpress-coaching'),
       'section' => 'learnpress_coaching_post_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_post_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_post_comment_icon',array(
		'label'	=> __('Post Comment Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('learnpress_coaching_metafields_time',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_metafields_time',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Time','learnpress-coaching'),
       'section' => 'learnpress_coaching_post_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_post_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_post_time_icon',array(
		'label'	=> __('Post Time Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_post_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_post_block_option',array(
        'default' => 'By Block',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_post_block_option',array(
        'type' => 'select',
        'label' => __('Blog Post Shown','learnpress-coaching'),
        'section' => 'learnpress_coaching_post_settings',
        'choices' => array(
            'By Block' => __('By Block','learnpress-coaching'),
            'By Without Block' => __('By Without Block','learnpress-coaching'),
        ),
	) );

	$wp_customize->add_setting('learnpress_coaching_post_featured_image',array(
       'default' => 'Image',
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices'
   ));
   $wp_customize->add_control('learnpress_coaching_post_featured_image',array(
       'type' => 'select',
       'label'	=> __('Post Image Options','learnpress-coaching'),
       'choices' => array(
            'Image' => __('Image','learnpress-coaching'),
            'Color' => __('Color','learnpress-coaching'),
            'None' => __('None','learnpress-coaching'),
        ),
      	'section'	=> 'learnpress_coaching_post_settings',
   ));

   $wp_customize->add_setting( 'learnpress_coaching_image_border_radius', array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,  'learnpress_coaching_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_post_settings',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	)) );

	$wp_customize->add_setting( 'learnpress_coaching_image_box_shadow',array(
		'default' => 0,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,  'learnpress_coaching_image_box_shadow',array(
		'label' => esc_html__( 'Featured Image Shadow','learnpress-coaching' ),
		'section' => 'learnpress_coaching_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type'		=> 'range'
	)));

   $wp_customize->add_setting('learnpress_coaching_post_featured_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_post_featured_color', array(
		'label'    => __('Post Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_post_settings',
		'settings' => 'learnpress_coaching_post_featured_color',
		'active_callback' => 'learnpress_coaching_post_color_enabled'
	)));

	$wp_customize->add_setting( 'learnpress_coaching_custom_post_color_width',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_custom_post_color_width',	array(
		'label' => esc_html__( 'Color Post Custom Width','learnpress-coaching' ),
		'section' => 'learnpress_coaching_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 500,
			'step' => 1,
		),
		'active_callback' => 'learnpress_coaching_show_post_color'
	)));

	$wp_customize->add_setting( 'learnpress_coaching_custom_post_color_height',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_custom_post_color_height',array(
		'label' => esc_html__( 'Color Post Custom Height','learnpress-coaching' ),
		'section' => 'learnpress_coaching_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 350,
			'step' => 1,
		),
		'active_callback' => 'learnpress_coaching_show_post_color'
	)));

	$wp_customize->add_setting('learnpress_coaching_post_featured_image_dimention',array(
       'default' => 'Default',
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices'
    ));
    $wp_customize->add_control('learnpress_coaching_post_featured_image_dimention',array(
       'type' => 'select',
       'label'	=> __('Post Featured Image Dimention','learnpress-coaching'),
       'choices' => array(
            'Default' => __('Default','learnpress-coaching'),
            'Custom' => __('Custom','learnpress-coaching'),
        ),
      	'section'	=> 'learnpress_coaching_post_settings',
      	'active_callback' => 'learnpress_coaching_enable_post_featured_image'
    ));

    $wp_customize->add_setting( 'learnpress_coaching_post_featured_image_custom_width',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_post_featured_image_custom_width',	array(
		'label' => esc_html__( 'Post Featured Image Custom Width','learnpress-coaching' ),
		'section' => 'learnpress_coaching_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 500,
			'step' => 1,
		),
		'active_callback' => 'learnpress_coaching_enable_post_image_custom_dimention'
	)));

	$wp_customize->add_setting( 'learnpress_coaching_post_featured_image_custom_height',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_post_featured_image_custom_height',	array(
		'label' => esc_html__( 'Post Featured Image Custom Height','learnpress-coaching' ),
		'section' => 'learnpress_coaching_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 350,
			'step' => 1,
		),
		'active_callback' => 'learnpress_coaching_enable_post_image_custom_dimention'
	)));

	$wp_customize->add_setting('learnpress_coaching_show_first_caps',array(
      'default' => false,
      'sanitize_callback' => 'learnpress_coaching_sanitize_checkbox',
   ));
	$wp_customize->add_control( 'learnpress_coaching_show_first_caps',array(
		'label' => esc_html__('First Cap (First Capital Letter)', 'learnpress-coaching'),
		'type' => 'checkbox',
		'section' => 'learnpress_coaching_post_settings',
	));

    //Post excerpt
	$wp_customize->add_setting( 'learnpress_coaching_post_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'learnpress_coaching_post_excerpt_number', array(
		'label'       => esc_html__( 'Blog Post Content Limit','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_post_settings',
		'type'        => 'number',
		'settings'    => 'learnpress_coaching_post_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('learnpress_coaching_content_settings',array(
        'default' =>'Excerpt',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_content_settings',array(
        'type' => 'radio',
        'label' => __('Content Settings','learnpress-coaching'),
        'section' => 'learnpress_coaching_post_settings',
        'choices' => array(
            'Excerpt' => __('Excerpt','learnpress-coaching'),
            'Content' => __('Content','learnpress-coaching'),
        ),
	) );

	$wp_customize->add_setting( 'learnpress_coaching_post_discription_suffix', array(
		'default'   => __('[...]','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'learnpress_coaching_post_discription_suffix', array(
		'label'       => esc_html__( 'Post Excerpt Suffix','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_post_settings',
		'type'        => 'text',
		'settings'    => 'learnpress_coaching_post_discription_suffix',
	) );

	$wp_customize->add_setting( 'learnpress_coaching_blog_post_meta_seperator', array(
		'default'   => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'learnpress_coaching_blog_post_meta_seperator', array(
		'label'       => esc_html__( 'Meta Box','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_post_settings',
		'description' => __('Here you can add the seperator for meta box. e.g. "|",  ",", "/", etc. ','learnpress-coaching'),
		'type'        => 'text',
		'settings'    => 'learnpress_coaching_blog_post_meta_seperator',
	) );

	$wp_customize->add_setting('learnpress_coaching_enable_post_pagination',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_enable_post_pagination',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Blog Page Pagination','learnpress-coaching'),
       'section' => 'learnpress_coaching_post_settings'
    ));

    $wp_customize->add_setting( 'learnpress_coaching_post_pagination_position', array(
        'default'			=>  'Bottom',
        'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices'
    ));
    $wp_customize->add_control( 'learnpress_coaching_post_pagination_position', array(
        'section' => 'learnpress_coaching_post_settings',
        'type' => 'select',
        'label' => __( 'Post Pagination Position', 'learnpress-coaching' ),
        'choices'		=> array(
            'Top'  => __( 'Top', 'learnpress-coaching' ),
            'Bottom' => __( 'Bottom', 'learnpress-coaching' ),
            'Both Top & Bottom' => __( 'Both Top & Bottom', 'learnpress-coaching' ),
    )));

	$wp_customize->add_setting('learnpress_coaching_post_pagination_option',array(
		'default' => 'Left',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_post_pagination_option',array(
		'type' => 'select',
		'label' => __('Post Pagination Alignment','learnpress-coaching'),
		'section' => 'learnpress_coaching_post_settings',
		'choices' => array(
			'Center' => __('Center','learnpress-coaching'),
			'Left' => __('Left','learnpress-coaching'),
			'Right' => __('Right','learnpress-coaching'),
		),
	) );

	$wp_customize->add_setting( 'learnpress_coaching_pagination_settings', array(
        'default'			=> 'Numeric Pagination',
        'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices'
   ));
   $wp_customize->add_control( 'learnpress_coaching_pagination_settings', array(
        'section' => 'learnpress_coaching_post_settings',
        'type' => 'radio',
        'label' => __( 'Post Pagination', 'learnpress-coaching' ),
        'choices'		=> array(
            'Numeric Pagination'  => __( 'Numeric Pagination', 'learnpress-coaching' ),
            'next-prev' => __( 'Next / Previous', 'learnpress-coaching' ),
   )));

	//Button Settings
	$wp_customize->add_section('learnpress_coaching_button_settings', array(
		'title'    => __('Post Button Settings', 'learnpress-coaching'),
		'panel'    => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_button_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_button_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_button_settings'
	));

	$wp_customize->add_setting('learnpress_coaching_button_text',array(
		'default'=> __('View More','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_button_text',array(
		'label'	=> __('Add Button Text','learnpress-coaching'),
		'section'=> 'learnpress_coaching_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_btn_font_size_option',array(
		'default'=> 12,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,'learnpress_coaching_btn_font_size_option',array(
		'label'	=> __('Button Font Size','learnpress-coaching'),
		'section'=> 'learnpress_coaching_button_settings',
		'input_attrs' => array(
         'step' => 1,
			'min'  => 0,
			'max'  => 50,
     	),
	)));

	$wp_customize->add_setting('learnpress_coaching_button_text_tranform',array(
		'default' => 'Capitalize',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_button_text_tranform',array(
		'type' => 'select',
		'label' => __('Button Text Transform','learnpress-coaching'),
		'section' => 'learnpress_coaching_button_settings',
		'choices' => array(
		   'Uppercase' => __('Uppercase','learnpress-coaching'),
		   'Lowercase' => __('Lowercase','learnpress-coaching'),
		   'Capitalize' => __('Capitalize','learnpress-coaching'),
		),
	) );

	$wp_customize->add_setting('learnpress_coaching_button_font_weight',array(
		'default' => '600',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_button_font_weight',array(
		'type' => 'select',
		'label' => __('Button Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_button_settings',
		'choices' => array(
			'100' => __('100','learnpress-coaching'),
			'200' => __('200','learnpress-coaching'),
			'300' => __('300','learnpress-coaching'),
			'400' => __('400','learnpress-coaching'),
			'500' => __('500','learnpress-coaching'),
			'600' => __('600','learnpress-coaching'),
			'700' => __('700','learnpress-coaching'),
			'800' => __('800','learnpress-coaching'),
			'900' => __('900','learnpress-coaching'),
		),
	) );

	// button letter spacing
	$wp_customize->add_setting( 'learnpress_coaching_button_letter_spacing',array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new  Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_button_letter_spacing', array(
		'label'  =>  esc_html__('Button Letter Spacing (px)','learnpress-coaching'),
		'section'  => 'learnpress_coaching_button_settings',
		'input_attrs' => array(
		   'min' => 0,
		   'max' => 50,
		   'step' => 1,
		)
 	)));	

	$wp_customize->add_setting('learnpress_coaching_button_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_button_icon',array(
		'label'	=> __('Button Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_button_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'learnpress_coaching_post_button_padding_top',array(
		'default' => 15,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_post_button_padding_top',	array(
		'label' => esc_html__( 'Button Top Bottom Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_button_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_post_button_padding_right',array(
		'default' => 15,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_post_button_padding_right',	array(
		'label' => esc_html__( 'Button Right Left Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_button_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_post_button_border_radius',array(
		'default' => 5,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_post_button_border_radius',array(
		'label' => esc_html__( 'Button Border Radius (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_button_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	// Button Shape
	$wp_customize->add_setting('learnpress_coaching_btn_shape',array(
		'default'=> 'Round',
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control('learnpress_coaching_btn_shape',array(
		'label'	=> __('Button Shape','learnpress-coaching'),
		'section'=> 'learnpress_coaching_button_settings',
		'type' => 'select',
		'choices' => array(
			'Square' => __('Square','learnpress-coaching'),
			'Round' => __('Round','learnpress-coaching'),
			'Pill' => __('Pill','learnpress-coaching'),
		),
	));	

   //Single Post Settings
	$wp_customize->add_section('learnpress_coaching_single_post_settings', array(
		'title'    => __('Single Post Settings', 'learnpress-coaching'),
		'panel'    => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_single_post_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_single_post_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_single_post_settings'
	));

	$wp_customize->add_setting('learnpress_coaching_single_post_bradcrumb',array(
 		'default' => false,
 		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
 	));
 	$wp_customize->add_control('learnpress_coaching_single_post_bradcrumb',array(
 		'type' => 'checkbox',
 		'label' => __('Enable / Disable Breadcrumb','learnpress-coaching'),
 		'section' => 'learnpress_coaching_single_post_settings',
 	));

	$wp_customize->add_setting('learnpress_coaching_single_post_date',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_single_post_date',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Date ','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_single_post_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_single_post_date_icon',array(
		'label'	=> __('Single Post Date Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_single_post_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_single_post_author',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_single_post_author',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Author','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_single_post_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_single_post_author_icon',array(
		'label'	=> __('Single Post Author Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_single_post_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_single_post_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_single_post_comment',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Comments','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_single_post_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_single_post_comment_icon',array(
		'label'	=> __('Single Post Comment Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_single_post_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_single_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_single_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','learnpress-coaching'),
		'section' => 'learnpress_coaching_single_post_settings',
	));

   $wp_customize->add_setting('learnpress_coaching_single_post_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_single_post_time_icon',array(
		'label'	=> __('Single Post Time Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_single_post_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_post_comment_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
   ));
   $wp_customize->add_control('learnpress_coaching_post_comment_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable post comment','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings',
   ));

	$wp_customize->add_setting('learnpress_coaching_single_post_featured_image',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
   ));
   $wp_customize->add_control('learnpress_coaching_single_post_featured_image',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Featured image','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings',
   ));

   // Featured Image Hover Effect
	$wp_customize->add_setting(
		'learnpress_coaching_featured_image_hover',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'learnpress_coaching_featured_image_hover',
		array(
			'label'   => __( 'Featured Image Hover Effect', 'learnpress-coaching' ),
			'section' => 'learnpress_coaching_single_post_settings',
			'type'    => 'select',
			'choices' => array(
				'none'      => __( 'None', 'learnpress-coaching' ),
				'zoom-in'   => __( 'Zoom In', 'learnpress-coaching' ),
				'zoom-out'  => __( 'Zoom Out', 'learnpress-coaching' ),
				'grayscale' => __( 'Grayscale', 'learnpress-coaching' ),
				'blur'      => __( 'Blur', 'learnpress-coaching' ),
				'bright'    => __( 'Bright', 'learnpress-coaching' ),
				'sepia'     => __( 'Sepia', 'learnpress-coaching' ),
				'translate' => __( 'Translate', 'learnpress-coaching' ),
			),
		)
	);

   	$wp_customize->add_setting('learnpress_coaching_single_post_featured_image_dimention',array(
	'default' => 'Default',
	'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_single_post_featured_image_dimention',array(
		'type' => 'select',
		'label'	=> __('Single Post Featured Image Dimention','learnpress-coaching'),
		'choices' => array(
			'Default' => __('Default','learnpress-coaching'),
			'Custom' => __('Custom','learnpress-coaching'),
		),
		'section'	=> 'learnpress_coaching_single_post_settings',
	));

	$wp_customize->add_setting( 'learnpress_coaching_single_post_featured_image_custom_width',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_single_post_featured_image_custom_width',	array(
		'label' => esc_html__( 'Single Post Featured Image Custom Width','learnpress-coaching' ),
		'section' => 'learnpress_coaching_single_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 800,
			'step' => 1,
		),
		'active_callback' => 'learnpress_coaching_enable_single_post_image_custom_dimention'
	)));

	$wp_customize->add_setting( 'learnpress_coaching_single_post_featured_image_custom_height',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_single_post_featured_image_custom_height',	array(
		'label' => esc_html__( 'Single Post Featured Image Custom Height','learnpress-coaching' ),
		'section' => 'learnpress_coaching_single_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 800,
			'step' => 1,
		),
		'active_callback' => 'learnpress_coaching_enable_single_post_image_custom_dimention'
	)));

   $wp_customize->add_setting( 'learnpress_coaching_single_image_border_radius', array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,  'learnpress_coaching_single_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_single_post_settings',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	)) );

	$wp_customize->add_setting( 'learnpress_coaching_single_image_box_shadow',array(
		'default' => 0,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,  'learnpress_coaching_single_image_box_shadow',array(
		'label' => esc_html__( 'Featured Image Shadow','learnpress-coaching' ),
		'section' => 'learnpress_coaching_single_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type'		=> 'range'
	)));

	$wp_customize->add_setting('learnpress_coaching_single_post_tags',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_single_post_tags',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Tags','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
    ));

	$wp_customize->add_setting('learnpress_coaching_show_hide_single_post_categories',array(
			'default' => true,
			'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_show_hide_single_post_categories',array(
			'type' => 'checkbox',
			'label' => __('Single Post Categories','learnpress-coaching'),
			'section' => 'learnpress_coaching_single_post_settings'
	));

	$wp_customize->add_setting('learnpress_coaching_category_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_category_color', array(
		'label'    => __('Category Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_single_post_settings',
		'settings' => 'learnpress_coaching_category_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_category_hover_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_category_hover_color', array(
		'label'    => __('Category Hover Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_single_post_settings',
		'settings' => 'learnpress_coaching_category_hover_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_single_post_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	) );
	$wp_customize->add_control('learnpress_coaching_single_post_layout', array(
        'type' => 'select',
        'label' => __('Select different Single post sidebar layout','learnpress-coaching'),
        'section' => 'learnpress_coaching_single_post_settings',
        'choices' => array(
            'One Column' => __('One Column','learnpress-coaching'),
            'Left Sidebar' => __('Left Sidebar','learnpress-coaching'),
            'Right Sidebar' => __('Right Sidebar','learnpress-coaching')
        ),
	)   );

	$wp_customize->add_setting( 'learnpress_coaching_single_post_meta_seperator', array(
		'default'   => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'learnpress_coaching_single_post_meta_seperator', array(
		'label'       => esc_html__( 'Single Post Meta Box Seperator','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_single_post_settings',
		'description' => __('Here you can add the seperator for meta box. e.g. "|",  ",", "/", etc. ','learnpress-coaching'),
		'type'        => 'text',
		'settings'    => 'learnpress_coaching_single_post_meta_seperator',
	) );

	$wp_customize->add_setting( 'learnpress_coaching_comment_form_width',array(
		'default' => 100,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_comment_form_width',	array(
		'label' => esc_html__( 'Comment Form Width','learnpress-coaching' ),
		'section' => 'learnpress_coaching_single_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting('learnpress_coaching_title_comment_form',array(
       'default' => __('Leave a Reply','learnpress-coaching'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('learnpress_coaching_title_comment_form',array(
       'type' => 'text',
       'label' => __('Comment Form Heading Text','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_comment_form_button_content',array(
       'default' => __('Post Comment','learnpress-coaching'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('learnpress_coaching_comment_form_button_content',array(
       'type' => 'text',
       'label' => __('Comment Form Button Text','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
    ));

	$wp_customize->add_setting('learnpress_coaching_enable_single_post_pagination',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_enable_single_post_pagination',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Single Post Pagination','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
    ));

   $wp_customize->add_setting('learnpress_coaching_prev_text',array(
       'default' => 'Previous page',
       'sanitize_callback'	=> 'sanitize_text_field'
   ));
   $wp_customize->add_control('learnpress_coaching_prev_text',array(
       'type' => 'text',
       'label' => __('Previous Navigation Text','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
   ));

   $wp_customize->add_setting('learnpress_coaching_next_text',array(
       'default' => 'Next page',
       'sanitize_callback'	=> 'sanitize_text_field'
   ));
   $wp_customize->add_control('learnpress_coaching_next_text',array(
       'type' => 'text',
       'label' => __('Next Navigation Text','learnpress-coaching'),
       'section' => 'learnpress_coaching_single_post_settings'
   )); 

	//Grid Post Settings
	$wp_customize->add_section('learnpress_coaching_grid_settings', array(
		'title'    => __('Grid Post Settings', 'learnpress-coaching'),
		'panel'    => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_grid_post_date',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_grid_post_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date','learnpress-coaching'),
		'section' => 'learnpress_coaching_grid_settings',
	));

	$wp_customize->add_setting('learnpress_coaching_grid_post_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_grid_post_date_icon',array(
		'label'	=> __('Post Date Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_grid_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_grid_post_author',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_grid_post_author',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Author','learnpress-coaching'),
		'section' => 'learnpress_coaching_grid_settings',
	));

	$wp_customize->add_setting('learnpress_coaching_grid_post_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_grid_post_author_icon',array(
		'label'	=> __('Post Author Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_grid_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_grid_post_comment',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_grid_post_comment',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Comment','learnpress-coaching'),
		'section' => 'learnpress_coaching_grid_settings',
	));

	$wp_customize->add_setting('learnpress_coaching_grid_post_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_grid_post_comment_icon',array(
		'label'	=> __('Post Comment Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_grid_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_grid_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_grid_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','learnpress-coaching'),
		'section' => 'learnpress_coaching_grid_settings',
	));

	$wp_customize->add_setting('learnpress_coaching_grid_post_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_grid_post_time_icon',array(
		'label'	=> __('Post Time Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_grid_settings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'learnpress_coaching_grid_post_meta_seperator', array(
		'default'   => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control( 'learnpress_coaching_grid_post_meta_seperator', array(
		'label'       => esc_html__( 'Meta Box','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_grid_settings',
		'description' => __('Here you can add the seperator for meta box. e.g. "|",  ",", "/", etc. ','learnpress-coaching'),
		'type'        => 'text',
		'settings'    => 'learnpress_coaching_grid_post_meta_seperator',
	));

	$wp_customize->add_setting( 'learnpress_coaching_grid_image_border_radius', array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,  'learnpress_coaching_grid_image_border_radius', array(
		'label'       => esc_html__( 'Image Border Radius','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_grid_settings',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	)) );

	$wp_customize->add_setting( 'learnpress_coaching_grid_image_box_shadow',array(
		'default' => 0,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,  'learnpress_coaching_grid_image_box_shadow',array(
		'label' => esc_html__( 'Image Shadow','learnpress-coaching' ),
		'section' => 'learnpress_coaching_grid_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type'		=> 'range'
	)));

	$wp_customize->add_setting('learnpress_coaching_grid_post_content',array(
    	'default'   => 'Post Excerpt',
     	'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_grid_post_content',array(
		'type' => 'radio',
		'label' => __('Grid Post Content Settings','learnpress-coaching'),
		'section' => 'learnpress_coaching_grid_settings',
		'choices' => array(
		   'None' => __('None','learnpress-coaching'),
		   'Post Excerpt' => __('Post Excerpt','learnpress-coaching'),
		   'Post Content' => __('Post Content','learnpress-coaching'),
		),
	) );

	$wp_customize->add_setting( 'learnpress_coaching_grid_post_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	));
	$wp_customize->add_control( 'learnpress_coaching_grid_post_excerpt_number', array(
		'label'       => esc_html__( 'Grid Post Content Limit','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_grid_settings',
		'type'        => 'number',
		'settings'    => 'learnpress_coaching_grid_post_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting( 'learnpress_coaching_grid_excerpt_suffix', array(
		'default'   => __('[...]','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'learnpress_coaching_grid_excerpt_suffix', array(
		'label'       => esc_html__( 'Grid Post Excerpt Suffix','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_grid_settings',
		'type'        => 'text',
		'settings'    => 'learnpress_coaching_grid_excerpt_suffix',
	) );

	$wp_customize->add_setting('learnpress_coaching_grid_post_block_option',array(
        'default' => 'By Block',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_grid_post_block_option',array(
        'type' => 'select',
        'label' => __('Grid Post Shown','learnpress-coaching'),
        'section' => 'learnpress_coaching_grid_settings',
        'choices' => array(
            'By Block' => __('By Block','learnpress-coaching'),
            'By Without Block' => __('By Without Block','learnpress-coaching'),
        ),
	) );

	//Related Post Settings
	$wp_customize->add_section('learnpress_coaching_related_settings', array(
		'title'    => __('Related Post Settings', 'learnpress-coaching'),
		'panel'    => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_related_post_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_related_post_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_related_settings'
	));

	$wp_customize->add_setting( 'learnpress_coaching_related_enable_disable',array(
		'default' => true,
      	'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ) );
    $wp_customize->add_control('learnpress_coaching_related_enable_disable',array(
    	'type' => 'checkbox',
        'label' => __( 'Enable / Disable Related Post','learnpress-coaching' ),
        'section' => 'learnpress_coaching_related_settings'
    ));


	$wp_customize->add_setting('learnpress_coaching_related_metafields_date',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_related_metafields_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date','learnpress-coaching'),
		'section' => 'learnpress_coaching_related_settings'
	));

    $wp_customize->add_setting('learnpress_coaching_related_metafields_author',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_related_metafields_author',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Author','learnpress-coaching'),
       'section' => 'learnpress_coaching_related_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_related_metafields_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_related_metafields_comment',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Comments','learnpress-coaching'),
       'section' => 'learnpress_coaching_related_settings'
    ));

    $wp_customize->add_setting('learnpress_coaching_related_metafields_time',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_related_metafields_time',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Time','learnpress-coaching'),
       'section' => 'learnpress_coaching_related_settings'
    ));

	$wp_customize->add_setting( 'learnpress_coaching_related_post_meta_seperator', array(
		'default'   => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'learnpress_coaching_related_post_meta_seperator', array(
		'label'       => esc_html__( 'Meta Box Separator','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_related_settings',
		'description' => __('Here you can add the seperator for meta box. e.g. "|",  ",", "/", etc. ','learnpress-coaching'),
		'type'        => 'text',
		'settings'    => 'learnpress_coaching_related_post_meta_seperator',
	) );

    $wp_customize->add_setting('learnpress_coaching_related_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_related_title',array(
		'label'	=> __('Add Section Title','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_related_settings',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'learnpress_coaching_related_posts_count_number', array(
		'default'              => 3,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'learnpress_coaching_related_posts_count_number', array(
		'label'       => esc_html__( 'Related Post Count','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_related_settings',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 10,
		),
	) );

	$wp_customize->add_setting('learnpress_coaching_related_posts_taxanomies',array(
        'default' => 'categories',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_related_posts_taxanomies',array(
        'type' => 'radio',
        'label' => __('Post Taxonomies','learnpress-coaching'),
        'section' => 'learnpress_coaching_related_settings',
        'choices' => array(
            'categories' => __('Categories','learnpress-coaching'),
            'tags' => __('Tags','learnpress-coaching'),
        ),
	) );

	$wp_customize->add_setting( 'learnpress_coaching_related_post_excerpt_number',array(
		'default' => 15,
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_related_post_excerpt_number',	array(
		'label' => esc_html__( 'Content Limit','learnpress-coaching' ),
		'section' => 'learnpress_coaching_related_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_related_post_discription_suffix', array(
		'default'   => __('[...]','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'learnpress_coaching_related_post_discription_suffix', array(
		'label'       => esc_html__( 'Post Excerpt Suffix','learnpress-coaching' ),
		'section'     => 'learnpress_coaching_related_settings',
		'type'        => 'text',
		'settings'    => 'learnpress_coaching_related_post_discription_suffix',
	) );

	$wp_customize->add_setting('learnpress_coaching_related_post_featured_image',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_related_post_featured_image',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Featured image','learnpress-coaching'),
		'section' => 'learnpress_coaching_related_settings',
	)); 

	//Responsive Media Settings
	$wp_customize->add_section('learnpress_coaching_responsive_media',array(
		'title'	=> __('Responsive Media','learnpress-coaching'),
		'panel' => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_responsive_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_responsive_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_responsive_media'
	));

	$wp_customize->add_setting('learnpress_coaching_responsive_menu_open_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_responsive_menu_open_icon',array(
		'label'	=> __('Responsive Open Menu Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_responsive_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_open_menu_label',array(
       'default' => __('','learnpress-coaching'),
       'sanitize_callback'	=> 'sanitize_text_field'
   ));
   $wp_customize->add_control('learnpress_coaching_open_menu_label',array(
       'type' => 'text',
       'label' => __('Open Menu Label','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
   ));

	$wp_customize->add_setting('learnpress_coaching_responsive_menu_close_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_responsive_menu_close_icon',array(
		'label'	=> __('Responsive Close Menu Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_responsive_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_close_menu_label',array(
       'default' => __('','learnpress-coaching'),
       'sanitize_callback' => 'sanitize_text_field'
   ));
   $wp_customize->add_control('learnpress_coaching_close_menu_label',array(
       'type' => 'text',
       'label' => __('Close Menu Label','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
   ));

	// site toggle button color
	$wp_customize->add_setting('learnpress_coaching_toggle_button_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_toggle_button_color', array(
		'label'    => __('Toggle Button Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_responsive_media',
		'settings' => 'learnpress_coaching_toggle_button_color',
	)));

	$wp_customize->add_setting('learnpress_coaching_display_post_date',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_display_post_date',array(
       'type' => 'checkbox',
       'label' => __('Display Post Date','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
    ));

    $wp_customize->add_setting('learnpress_coaching_display_post_author',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_display_post_author',array(
       'type' => 'checkbox',
       'label' => __('Display Post Author','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
    ));

    $wp_customize->add_setting('learnpress_coaching_display_post_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_display_post_comment',array(
       'type' => 'checkbox',
       'label' => __('Display Post Comment','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
    ));

	$wp_customize->add_setting('learnpress_coaching_display_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_display_post_time',array(
		'type' => 'checkbox',
		'label' => __('Display Post Time','learnpress-coaching'),
		'section' => 'learnpress_coaching_responsive_media'
	));

    $wp_customize->add_setting('learnpress_coaching_display_slider',array(
       'default' => false,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_display_slider',array(
       'type' => 'checkbox',
       'label' => __('Display Slider','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
    ));

	$wp_customize->add_setting('learnpress_coaching_display_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_display_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Display Sidebar','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
    ));

    $wp_customize->add_setting('learnpress_coaching_display_scrolltop',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_display_scrolltop',array(
       'type' => 'checkbox',
       'label' => __('Display Scroll To Top','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
    ));

    $wp_customize->add_setting('learnpress_coaching_display_preloader',array(
       'default' => false,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_display_preloader',array(
       'type' => 'checkbox',
       'label' => __('Display Preloader','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
    ));

	$wp_customize->add_setting('learnpress_coaching_res_search',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_res_search',array(
       'type' => 'checkbox',
       'label' => __('Display Search','learnpress-coaching'),
       'section' => 'learnpress_coaching_responsive_media'
    ));

    //404 Page Setting
	$wp_customize->add_section('learnpress_coaching_page_not_found',array(
		'title'	=> __('404 Page Not Found / No Result','learnpress-coaching'),
		'panel' => 'learnpress_coaching_panel_id',
	));

	$wp_customize->add_setting('learnpress_coaching_page_not_found_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_page_not_found_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_page_not_found'
	));

	$wp_customize->add_setting('learnpress_coaching_page_not_found_heading',array(
		'default'=> __('404 Not Found','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_page_not_found_heading',array(
		'label'	=> __('404 Heading','learnpress-coaching'),
		'section'=> 'learnpress_coaching_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_page_not_found_text',array(
		'default'=> __('Looks like you have taken a wrong turn. Dont worry it happens to the best of us.','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_page_not_found_text',array(
		'label'	=> __('404 Content','learnpress-coaching'),
		'section'=> 'learnpress_coaching_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_page_not_found_button',array(
		'default'=>  __('Back to Home Page','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_page_not_found_button',array(
		'label'	=> __('404 Button','learnpress-coaching'),
		'section'=> 'learnpress_coaching_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_no_search_result_heading',array(
		'default'=> __('Nothing Found','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_no_search_result_heading',array(
		'label'	=> __('No Search Results Heading','learnpress-coaching'),
		'description'=>__('The search page heading display when no results are found.','learnpress-coaching'),
		'section'=> 'learnpress_coaching_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_no_search_result_text',array(
		'default'=> __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','learnpress-coaching'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_no_search_result_text',array(
		'label'	=> __('No Search Results Text','learnpress-coaching'),
		'description'=>__('The search page text display when no results are found.','learnpress-coaching'),
		'section'=> 'learnpress_coaching_page_not_found',
		'type'=> 'text'
	));

	//Woocommerce Section
	$wp_customize->add_section( 'learnpress_coaching_woocommerce_section' , array(
    	'title'      => __( 'Woocommerce Settings', 'learnpress-coaching' ),
    	'description'=>__('The below settings are apply on woocommerce pages.','learnpress-coaching'),
		'priority'   => null,
		'panel' => 'learnpress_coaching_panel_id'
	) );

	$wp_customize->add_setting('learnpress_coaching_woocommerce_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_woocommerce_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_woocommerce_section'
	));

	/**
	 * Product Columns
	 */
	$wp_customize->add_setting( 'learnpress_coaching_per_columns' , array(
		'default'           => 4,
		'transport'         => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'learnpress_coaching_per_columns', array(
		'label'    => __( 'Product per columns', 'learnpress-coaching' ),
		'section'  => 'learnpress_coaching_woocommerce_section',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
		),
	) ) );

	$wp_customize->add_setting('learnpress_coaching_product_per_page',array(
		'default'	=> 9,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_product_per_page',array(
		'label'	=> __('Product per page','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_woocommerce_section',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('learnpress_coaching_shop_sidebar_enable',array(
       'default' => false,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
   ));
   $wp_customize->add_control('learnpress_coaching_shop_sidebar_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable shop page sidebar','learnpress-coaching'),
       'section' => 'learnpress_coaching_woocommerce_section',
   ));

   // shop page sidebar alignment
   $wp_customize->add_setting('learnpress_coaching_shop_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control('learnpress_coaching_shop_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Layout', 'learnpress-coaching'),
		'section'        => 'learnpress_coaching_woocommerce_section',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'learnpress-coaching'),
			'Right Sidebar' => __('Right Sidebar', 'learnpress-coaching'),
		),
	));

   $wp_customize->add_setting('learnpress_coaching_product_page_sidebar_enable',array(
       'default' => false,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
   ));
   $wp_customize->add_control('learnpress_coaching_product_page_sidebar_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Single Product Page Sidebar','learnpress-coaching'),
       'section' => 'learnpress_coaching_woocommerce_section',
   ));

   // single product page sidebar alignment
   $wp_customize->add_setting('learnpress_coaching_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
	));
	$wp_customize->add_control('learnpress_coaching_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single Product Page Layout', 'learnpress-coaching'),
		'section'        => 'learnpress_coaching_woocommerce_section',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'learnpress-coaching'),
			'Right Sidebar' => __('Right Sidebar', 'learnpress-coaching'),
		),
	));

   $wp_customize->add_setting('learnpress_coaching_related_product_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
   ));
   $wp_customize->add_control('learnpress_coaching_related_product_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related product','learnpress-coaching'),
       'section' => 'learnpress_coaching_woocommerce_section',
   ));

   $wp_customize->add_setting( 'learnpress_coaching_woo_product_sale_border_radius',array(
		'default' => 6,
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woo_product_sale_border_radius', array(
        'label'  => __('Woocommerce Product Sale Border Radius','learnpress-coaching'),
        'section'  => 'learnpress_coaching_woocommerce_section',
        'type'        => 'number',
        'input_attrs' => array(
        	'step'=> 1,
            'min' => 0,
            'max' => 50,
        )
   )));

   $wp_customize->add_setting('learnpress_coaching_wooproduct_sale_font_size',array(
		'default'=> 14,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_wooproduct_sale_font_size',array(
		'label'	=> __('Woocommerce Product Sale Font Size','learnpress-coaching'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'learnpress_coaching_woocommerce_section',
	)));

   $wp_customize->add_setting('learnpress_coaching_woo_product_sale_top_bottom_padding',array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woo_product_sale_top_bottom_padding',array(
		'label'	=> __('Woocommerce Product Sale Top Bottom Padding ','learnpress-coaching'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'learnpress_coaching_woocommerce_section',
		'type'=> 'number'
	)));

	$wp_customize->add_setting('learnpress_coaching_woo_product_sale_left_right_padding',array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woo_product_sale_left_right_padding',array(
		'label'	=> __('Woocommerce Product Sale Left Right Padding','learnpress-coaching'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'learnpress_coaching_woocommerce_section',
		'type'=> 'number'
	)));

	$wp_customize->add_setting('learnpress_coaching_woo_product_sale_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_woo_product_sale_position',array(
        'type' => 'select',
        'label' => __('Woocommerce Product Sale Position','learnpress-coaching'),
        'section' => 'learnpress_coaching_woocommerce_section',
        'choices' => array(
            'Right' => __('Right','learnpress-coaching'),
            'Left' => __('Left','learnpress-coaching'),
        ),
	));

	$wp_customize->add_setting( 'learnpress_coaching_woocommerce_button_padding_top',array(
		'default' => 15,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woocommerce_button_padding_top',	array(
		'label' => esc_html__( 'Button Top Bottom Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_woocommerce_button_padding_right',array(
		'default' => 15,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woocommerce_button_padding_right',	array(
		'label' => esc_html__( 'Button Right Left Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_woocommerce_button_border_radius',array(
		'default' => 6,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woocommerce_button_border_radius',array(
		'label' => esc_html__( 'Button Border Radius (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

    $wp_customize->add_setting('learnpress_coaching_woocommerce_product_border_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ));
    $wp_customize->add_control('learnpress_coaching_woocommerce_product_border_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable product border','learnpress-coaching'),
       'section' => 'learnpress_coaching_woocommerce_section',
    ));

	$wp_customize->add_setting( 'learnpress_coaching_woocommerce_product_padding_top',array(
		'default' => 10,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woocommerce_product_padding_top',	array(
		'label' => esc_html__( 'Product Top Bottom Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_woocommerce_product_padding_right',array(
		'default' => 10,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woocommerce_product_padding_right',	array(
		'label' => esc_html__( 'Product Right Left Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_woocommerce_product_border_radius',array(
		'default' => 3,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woocommerce_product_border_radius',array(
		'label' => esc_html__( 'Product Border Radius (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_woocommerce_product_box_shadow',array(
		'default' => 5,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_woocommerce_product_box_shadow',array(
		'label' => esc_html__( 'Product Box Shadow (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting('learnpress_coaching_wooproducts_nav',array(
       'default' => 'Yes',
       'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices'
    ));
    $wp_customize->add_control('learnpress_coaching_wooproducts_nav',array(
       'type' => 'select',
       'label' => __('Shop Page Products Navigation','learnpress-coaching'),
       'choices' => array(
            'Yes' => __('Yes','learnpress-coaching'),
            'No' => __('No','learnpress-coaching'),
        ),
       'section' => 'learnpress_coaching_woocommerce_section',
    ));

	//footer text
	$wp_customize->add_section('learnpress_coaching_footer_section',array(
		'title'	=> __('Footer Text','learnpress-coaching'),
		'panel' => 'learnpress_coaching_panel_id'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_footer_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_footer_section'
	));

	$wp_customize->add_setting('learnpress_coaching_show_hide_footer',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_show_hide_footer',array(
     	'type' => 'checkbox',
      'label' => __('Enable / Disable Footer','learnpress-coaching'),
      'section' => 'learnpress_coaching_footer_section',
	));

  	$wp_customize->add_setting('learnpress_coaching_footer_template',array(
      'default'	=> esc_html('learnpress_coaching-footer-one'),
      'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_footer_template',array(
		'label'	=> esc_html__('Footer style','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_footer_section',
		'setting'	=> 'learnpress_coaching_footer_template',
		'type' => 'select',
		'choices' => array(
          'learnpress_coaching-footer-one' => esc_html__('Style 1', 'learnpress-coaching'),
          'learnpress_coaching-footer-two' => esc_html__('Style 2', 'learnpress-coaching'),
          'learnpress_coaching-footer-three' => esc_html__('Style 3', 'learnpress-coaching'),
          'learnpress_coaching-footer-four' => esc_html__('Style 4', 'learnpress-coaching'),
          'learnpress_coaching-footer-five' => esc_html__('Style 5', 'learnpress-coaching'),
          )
	));		

	$wp_customize->add_setting('learnpress_coaching_footer_bg_color', array(
		'default'           => '#2c4058',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_footer_bg_color', array(
		'label'    => __('Footer Background Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_footer_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_footer_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'learnpress_coaching_footer_bg_image',array(
      'label' => __('Footer Background Image','learnpress-coaching'),
      'section' => 'learnpress_coaching_footer_section'
	)));
	
	$wp_customize->add_setting('learnpress_coaching_footer_attatchment',array(
		'default'=> 'scroll',
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_footer_attatchment',array(
		'type' => 'select',
		'label'	=> __('Footer Background Attatchment','learnpress-coaching'),
		'choices' => array(
            'fixed' => __('fixed','learnpress-coaching'),
            'scroll' => __('scroll','learnpress-coaching'),
        ),
		'section'=> 'learnpress_coaching_footer_section',
	));

	$wp_customize->add_setting('learnpress_coaching_footer_img_position',array(
		'default' => 'center center',
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	  ));
	  $wp_customize->add_control('learnpress_coaching_footer_img_position',array(
		  'type' => 'select',
		  'label' => __('Footer Image Position','learnpress-coaching'),
		  'section' => 'learnpress_coaching_footer_section',
		  'choices' 	=> array(
			  'left top' 		=> esc_html__( 'Top Left', 'learnpress-coaching' ),
			  'center top'   => esc_html__( 'Top', 'learnpress-coaching' ),
			  'right top'   => esc_html__( 'Top Right', 'learnpress-coaching' ),
			  'left center'   => esc_html__( 'Left', 'learnpress-coaching' ),
			  'center center'   => esc_html__( 'Center', 'learnpress-coaching' ),
			  'right center'   => esc_html__( 'Right', 'learnpress-coaching' ),
			  'left bottom'   => esc_html__( 'Bottom Left', 'learnpress-coaching' ),
			  'center bottom'   => esc_html__( 'Bottom', 'learnpress-coaching' ),
			  'right bottom'   => esc_html__( 'Bottom Right', 'learnpress-coaching' ),
		  ),
	  ));

	$wp_customize->add_setting('learnpress_coaching_footer_widget_areas',array(
      'default'           => 4,
      'sanitize_callback' => 'learnpress_coaching_sanitize_choices',
   ));
   $wp_customize->add_control('learnpress_coaching_footer_widget_areas',array(
      'type'        => 'radio',
      'label'       => __('Footer widget area', 'learnpress-coaching'),
      'section'     => 'learnpress_coaching_footer_section',
      'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'learnpress-coaching'),
      'choices' => array(
         '1'     => __('One', 'learnpress-coaching'),
         '2'     => __('Two', 'learnpress-coaching'),
         '3'     => __('Three', 'learnpress-coaching'),
         '4'     => __('Four', 'learnpress-coaching')
      ),
   ));

	$wp_customize->add_setting('learnpress_coaching_footer_heading',array(
		'default' => 'Left',
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_footer_heading',array(
		'type' => 'select',
		'label' => __('Footer Heading Alignment','learnpress-coaching'),
		'section' => 'learnpress_coaching_footer_section',
		'choices' => array(
			'Left' => __('Left','learnpress-coaching'),
			'Center' => __('Center','learnpress-coaching'),
			'Right' => __('Right','learnpress-coaching')
		),
	) );

	$wp_customize->add_setting('learnpress_coaching_footer_heading_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_footer_heading_letter_spacing',array(
		'label'	=> __('Footer Heading Letter Spacing','learnpress-coaching'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
	),
		'section'=> 'learnpress_coaching_footer_section',
	));	

	$wp_customize->add_setting('learnpress_coaching_footer_content',array(
		'default' => 'Left',
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_footer_content',array(
		'type' => 'select',
		'label' => __('Footer Content Alignment','learnpress-coaching'),
		'section' => 'learnpress_coaching_footer_section',
		'choices' => array(
			'Left' => __('Left','learnpress-coaching'),
			'Center' => __('Center','learnpress-coaching'),
			'Right' => __('Right','learnpress-coaching')
		),
	) );

	$wp_customize->add_setting('learnpress_coaching_footer_heading_font_size',array(
		'default'=> 20,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_footer_heading_font_size',array(
		'label' => esc_html__( 'Footer Heading Font Size','learnpress-coaching' ),
		'section'=> 'learnpress_coaching_footer_section',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

	$wp_customize->add_setting('learnpress_coaching_footer_text_tranform',array(
		'default' => 'Capitalize',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_footer_text_tranform',array(
		'type' => 'select',
		'label' => __('Footer Widget Text Transform','learnpress-coaching'),
		'section' => 'learnpress_coaching_footer_section',
		'choices' => array(
		   'Uppercase' => __('Uppercase','learnpress-coaching'),
		   'Lowercase' => __('Lowercase','learnpress-coaching'),
		   'Capitalize' => __('Capitalize','learnpress-coaching'),
		),
	) );

	$wp_customize->add_setting('learnpress_coaching_footer_heading_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
 	));
 	$wp_customize->add_control('learnpress_coaching_footer_heading_font_weight',array(
		'type' => 'select',
		'label' => __('Footer Heading Font Weight','learnpress-coaching'),
		'section' => 'learnpress_coaching_footer_section',
		'choices' => array(
			'100' => __('100','learnpress-coaching'),
			'200' => __('200','learnpress-coaching'),
			'300' => __('300','learnpress-coaching'),
			'400' => __('400','learnpress-coaching'),
			'500' => __('500','learnpress-coaching'),
			'600' => __('600','learnpress-coaching'),
			'700' => __('700','learnpress-coaching'),
			'800' => __('800','learnpress-coaching'),
			'900' => __('900','learnpress-coaching'),
		),
	) );

   $wp_customize->add_setting('learnpress_coaching_footer_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize,'learnpress_coaching_footer_padding',array(
		'label'	=> __('Footer Widget Padding','learnpress-coaching'),
		'section'=> 'learnpress_coaching_footer_section',
		'input_attrs' => array(
         'step' => 1,
			'min'  => 0,
			'max'  => 100,
      ),
	)));

   $wp_customize->add_setting('learnpress_coaching_hide_show_scroll',array(
        'default' => true,
        'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_hide_show_scroll',array(
     	'type' => 'checkbox',
      	'label' => __('Enable / Disable Back To Top','learnpress-coaching'),
      	'section' => 'learnpress_coaching_footer_section',
	));

	$wp_customize->add_setting('learnpress_coaching_back_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_back_to_top_icon',array(
		'label'	=> __('Back to Top Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_footer_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('learnpress_coaching_scroll_icon_font_size',array(
		'default'=> 22,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_scroll_icon_font_size',array(
		'label'	=> __('Back To Top Icon Font Size','learnpress-coaching'),
		'section'=> 'learnpress_coaching_footer_section',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

	$wp_customize->add_setting('learnpress_coaching_scroll_icon_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_scroll_icon_color', array(
		'label'    => __('Back to Top Icon Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_footer_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_scroll_icon_hover_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_scroll_icon_hover_color', array(
		'label'    => __('Back to Top Icon Hover Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_footer_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_scroll_icon_bg_color', array(
		'default'           => '#976aff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_scroll_icon_bg_color', array(
		'label'    => __('Back to Top Background Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_footer_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_scroll_icon_bg_hover_color', array(
		'default'           => '#976aff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_scroll_icon_bg_hover_color', array(
		'label'    => __('Back to Top Background Hover Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_footer_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_footer_options',array(
        'default' => 'Right align',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_footer_options',array(
        'type' => 'radio',
        'label' => __('Back To Top Alignment','learnpress-coaching'),
        'section' => 'learnpress_coaching_footer_section',
        'choices' => array(
            'Left align' => __('Left Align','learnpress-coaching'),
            'Right align' => __('Right Align','learnpress-coaching'),
            'Center align' => __('Center Align','learnpress-coaching'),
        ),
	) );

	$wp_customize->add_setting( 'learnpress_coaching_top_bottom_scroll_padding',array(
		'default' => 12,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_top_bottom_scroll_padding',	array(
		'label' => esc_html__( 'Top Bottom Scroll Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_footer_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_left_right_scroll_padding',array(
		'default' => 17,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_left_right_scroll_padding',	array(
		'label' => esc_html__( 'Left Right Scroll Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_footer_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_back_to_top_border_radius',array(
		'default' => 6,
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_back_to_top_border_radius', array(
		'label' => esc_html__( 'Back to Top Border Radius (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_footer_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting('learnpress_coaching_show_hide_copyright',array(
		'default' => true,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_show_hide_copyright',array(
     	'type' => 'checkbox',
      'label' => __('Enable / Disable Copyright','learnpress-coaching'),
      'section' => 'learnpress_coaching_footer_section',
	));

	$wp_customize->add_setting('learnpress_coaching_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_footer_copy',array(
		'label'	=> __('Copyright Text','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_footer_section',
		'description'	=> __('Add some text for footer like copyright etc.','learnpress-coaching'),
		'type'		=> 'text'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_text_align',array(
        'default' => 'center',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_footer_text_align',array(
        'type' => 'radio',
        'label' => __('Copyright Text Alignment ','learnpress-coaching'),
        'section' => 'learnpress_coaching_footer_section',
        'choices' => array(
            'left' => __('Left Align','learnpress-coaching'),
            'right' => __('Right Align','learnpress-coaching'),
            'center' => __('Center Align','learnpress-coaching'),
        ),
	) );

	$wp_customize->add_setting('learnpress_coaching_copyright_text_font_size',array(
		'default'=> 15,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_copyright_text_font_size',array(
		'label' => esc_html__( 'Copyright Font Size (px)','learnpress-coaching' ),
		'section'=> 'learnpress_coaching_footer_section',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

	$wp_customize->add_setting( 'learnpress_coaching_footer_text_padding',array(
		'default' => 20,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_footer_text_padding',	array(
		'label' => esc_html__( 'Copyright Text Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_footer_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting('learnpress_coaching_footer_text_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_footer_text_color', array(
		'label'    => __('Copyright Text Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_footer_section',
	)));

	$wp_customize->add_setting('learnpress_coaching_footer_text_bg_color', array(
		'default'           => '#976aff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'learnpress_coaching_footer_text_bg_color', array(
		'label'    => __('Copyright Background Color', 'learnpress-coaching'),
		'section'  => 'learnpress_coaching_footer_section',
	)));

	//Sticky copyright
	$wp_customize->add_setting( 'learnpress_coaching_sticky_copyright',array(
		'default'=> false,
      	'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
    ) );
    $wp_customize->add_control('learnpress_coaching_sticky_copyright',array(
    	'type' => 'checkbox',
        'label' => __( 'Enable / Disable Sticky copyright','learnpress-coaching' ),
        'section' => 'learnpress_coaching_footer_section'
    ));

	//Social Media Section
	$wp_customize->add_section( 'learnpress_coaching_footer_social_section' , array(
    	'title'      => __( 'Footer Social Media', 'learnpress-coaching' ),
		'priority'   => null,
		'panel' => 'learnpress_coaching_panel_id'
	) );

	$wp_customize->add_setting('learnpress_coaching_footer_social_icons_premium_info',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('learnpress_coaching_footer_social_icons_premium_info',array(
		'type'=> 'hidden',
		'label'	=> __('Premium Features','learnpress-coaching'),
		'description' => "<ul><li>". esc_html('Please explore our premium theme for additional settings and features.','learnpress-coaching') ."</li></ul><a target='_blank' href='". esc_url(LEARNPREE_COACHING_BUY_PRO) ." '>". esc_html('Upgrade to Pro','learnpress-coaching') ."</a>",
		'section'=> 'learnpress_coaching_footer_social_section'
	));

	$wp_customize->add_setting('learnpress_coaching_show_footer_icons',array(
		'default' => false,
		'sanitize_callback'	=> 'learnpress_coaching_sanitize_checkbox'
	));
	$wp_customize->add_control('learnpress_coaching_show_footer_icons',array(
		'type' => 'checkbox',
		'label' => __('Show/Hide Footer Social Icons','learnpress-coaching'),
		'section' => 'learnpress_coaching_footer_social_section'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_footer_facebook_icon',array(
		'label'	=> __('Facebook Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'icon'
	)));	

	$wp_customize->add_setting('learnpress_coaching_footer_facebook_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_footer_facebook_link',array(
		'label'	=> __('Add Facebook Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_footer_twitter_icon',array(
		'label'	=> __('Twitter Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'icon'
	)));	

	$wp_customize->add_setting('learnpress_coaching_footer_twitter_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_footer_twitter_link',array(
		'label'	=> __('Add Twitter Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_linkdin_icon',array(
		'default'	=> 'fab fa-linkedin-in',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_footer_linkdin_icon',array(
		'label'	=> __('Linkedin Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'icon'
	)));	

	$wp_customize->add_setting('learnpress_coaching_footer_linkdin_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_footer_linkdin_link',array(
		'label'	=> __('Add Linkedin Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_footer_instagram_icon',array(
		'label'	=> __('Instagram Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'icon'
	)));	

	$wp_customize->add_setting('learnpress_coaching_footer_instagram_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_footer_instagram_link',array(
		'label'	=> __('Add Instagram Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_pintrest_icon',array(
		'default'	=> 'fab fa-pinterest-p',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Learnpress_Coaching_Icon_Changer(
        $wp_customize,'learnpress_coaching_footer_pintrest_icon',array(
		'label'	=> __('Pintrest Icon','learnpress-coaching'),
		'transport' => 'refresh',
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'icon'
	)));	

	$wp_customize->add_setting('learnpress_coaching_footer_pintrest_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('learnpress_coaching_footer_pintrest_link',array(
		'label'	=> __('Add Pintrest Link','learnpress-coaching'),
		'section'	=> 'learnpress_coaching_footer_social_section',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_social_icons_size',array(
		'default'=> 13,
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('learnpress_coaching_footer_social_icons_size',array(
		'label'	=> __('Footer Social Icons Size ','learnpress-coaching'),
		'section'=> 'learnpress_coaching_footer_social_section',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'type'=> 'number'
	));

	$wp_customize->add_setting('learnpress_coaching_footer_icon_alignment',array(
        'default' => 'center',
        'sanitize_callback' => 'learnpress_coaching_sanitize_choices'
	));
	$wp_customize->add_control('learnpress_coaching_footer_icon_alignment',array(
        'type' => 'radio',
        'label' => __('Icon Alignment ','learnpress-coaching'),
        'section' => 'learnpress_coaching_footer_social_section',
        'choices' => array(
            'left' => __('Left Align','learnpress-coaching'),
            'right' => __('Right Align','learnpress-coaching'),
            'center' => __('Center Align','learnpress-coaching'),
        ),
	) );

	// Top Bottom padding footer icon 
	$wp_customize->add_setting( 'learnpress_coaching_footer_icon_to_top_padding',array(
		'default' => 7,
		'transport' => 'refresh',
		'sanitize_callback' => 'learnpress_coaching_sanitize_integer'
	));
	$wp_customize->add_control( new Learnpress_Coaching_Custom_Control( $wp_customize, 'learnpress_coaching_footer_icon_to_top_padding',	array(
		'label' => esc_html__( 'Top Bottom icon Padding (px)','learnpress-coaching' ),
		'section' => 'learnpress_coaching_footer_social_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	//Reset All Settings
	$wp_customize->add_section( 'learnpress_coaching_reset_section', array(
        'title'    => __( 'Reset Theme Settings', 'learnpress-coaching' ),
        'priority'	=> null,
		'panel' => 'learnpress_coaching_panel_id',
    ) );

	//Reset Demo Import
    $wp_customize->add_setting( 'learnpress_coaching_reset_demo_import_settings', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control('learnpress_coaching_reset_demo_import_settings',array(
            'label'   => __( 'Reset Demo Import', 'learnpress-coaching' ),
            'section' => 'learnpress_coaching_reset_section',
            'type'    => 'button',
            'input_attrs' => array(
                'onclick' => 'ResetDemoSettings()',
            ),
    ));

	//Reset Global Color
	$wp_customize->add_setting('learnpress_coaching_reset_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	
	$wp_customize->add_control('learnpress_coaching_reset_color', array(
		'type'    => 'button',
		'label'   => __('Reset Global Color', 'learnpress-coaching'),
		'section' => 'learnpress_coaching_reset_section',
		'input_attrs' => array(
			'onclick' => 'ResetGlobalColor()',
		),
	));

}
add_action( 'customize_register', 'learnpress_coaching_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Learnpress_Coaching_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Learnpress_Coaching_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Learnpress_Coaching_Customize_Section_Pro(
				$manager,
				'learnpress_coaching_example_1',
				array(
					'title'   =>  esc_html__( 'LearnPress Coaching Pro', 'learnpress-coaching' ),
					'pro_text' => esc_html__( 'Get Pro', 'learnpress-coaching' ),
					'pro_url'  => esc_url( 'https://www.buywptemplates.com/products/coaching-wordpress-template' ),
					'priority'   => 9
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'learnpress-coaching-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'learnpress-coaching-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/css/customize-controls.css' );
	}

	//Footer widget areas
	function learnpress_coaching_sanitize_choices( $input ) {
	    $valid = array(
	        '1'     => __('One', 'learnpress-coaching'),
	        '2'     => __('Two', 'learnpress-coaching'),
	        '3'     => __('Three', 'learnpress-coaching'),
	        '4'     => __('Four', 'learnpress-coaching')
	    );
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
}

// Doing this customizer thang!
Learnpress_Coaching_Customize::get_instance();
