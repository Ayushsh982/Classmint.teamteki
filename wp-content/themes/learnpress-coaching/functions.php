<?php
/**
 * LearnPress Coaching functions and definitions
 * @package LearnPress Coaching
 */
 /* Breadcrumb Begin */
  function learnpress_coaching_the_breadcrumb() {
  	if (!is_home()) {
  		echo '<a href="';
  			echo esc_url( home_url() );
  		echo '">';
  			bloginfo('name');
  		echo "</a> ";
  		if (is_category() || is_single()) {
  			the_category(',');
  			if (is_single()) {
  				echo "<span> ";
  					the_title();
  				echo "</span> ";
  			}
  		} elseif (is_page()) {
  			echo "<span> ";
  				the_title();
  		}
  	}
  }
/* Theme Setup */
if ( ! function_exists( 'learnpress_coaching_setup' ) ) :

function learnpress_coaching_setup() {

	$GLOBALS['content_width'] = apply_filters( 'learnpress_coaching_content_width', 640 );

	load_theme_textdomain( 'learnpress-coaching', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('learnpress-coaching-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'learnpress-coaching' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );

	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support('responsive-embeds');
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', learnpress_coaching_font_url() ) );
}
endif; // learnpress_coaching_setup
add_action( 'after_setup_theme', 'learnpress_coaching_setup' );

/* Theme Widgets Setup */
function learnpress_coaching_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'learnpress-coaching' ),
		'description'   => __( 'Appears on posts and pages', 'learnpress-coaching' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Posts and Pages Sidebar', 'learnpress-coaching' ),
		'description'   => __( 'Appears on posts and pages', 'learnpress-coaching' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Third Column Sidebar', 'learnpress-coaching' ),
		'description'   => __( 'Appears on posts and pages', 'learnpress-coaching' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$learnpress_coaching_widget_areas = get_theme_mod('learnpress_coaching_footer_widget_areas', '4');
	for ($learnpress_coaching_i=1; $learnpress_coaching_i <= 4; $learnpress_coaching_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'learnpress-coaching' ) . $learnpress_coaching_i,
			'id'            => 'footer-' . $learnpress_coaching_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'learnpress-coaching' ),
		'description'   => __( 'Appears on shop page', 'learnpress-coaching' ),
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Single Product Page Sidebar', 'learnpress-coaching' ),
		'description'   => __( 'Appears on single product page', 'learnpress-coaching' ),
		'id'            => 'woocommerce-single-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'learnpress_coaching_widgets_init' );

/* Footer Widget */
add_theme_support( 'starter-content', array(
	'widgets' => array(
		'footer-1' => array(
			'archives',
		),
		'footer-2' => array(
			'meta',
		),
		'footer-3' => array(
			'categories',
		),
		'footer-4' => array(
			'search',
		),
	),
));

// edit
if (!function_exists('learnpress_coaching_edit_link')) :
    function learnpress_coaching_edit_link($view = 'default')
    {
        global $post;
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'learnpress-coaching'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link"><i class="fa-solid fa-pen mx-2"></i>',
                '</span>'
            );
    }
endif;

/* Theme Font URL */
function learnpress_coaching_font_url() {
	$font_family   = array(
		'ABeeZee:ital@0;1',
		'Abril Fatface',
		'Acme',
		'Allura',
		'Anton',
		'Architects Daughter',
		'Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Arsenal:ital,wght@0,400;0,700;1,400;1,700',
		'Arvo:ital,wght@0,400;0,700;1,400;1,700',
		'Alegreya:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
		'Alfa Slab One',
		'Averia Serif Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
		'Bangers',
		'Boogaloo',
		'Bad Script',
		'Barlow Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Bree Serif',
		'BenchNine:wght@300;400;700',
		'Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Cardo:ital,wght@0,400;0,700;1,400',
		'Courgette',
		'Caveat Brush',
		'Cherry Swash:wght@400;700',
		'Cormorant Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700',
		'Crimson Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700',
		'Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Cookie',
		'Coming Soon',
		'Charm:wght@400;700',
		'Chewy',
		'Days One',
		'Dosis:wght@200;300;400;500;600;700;800',
		'DM Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700',
		'EB Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800',
		'Economica:ital,wght@0,400;0,700;1,400;1,700',
		'Fira Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Fredoka One',
		'Fjalla One',
		'Francois One',
		'Frank Ruhl Libre:wght@300;400;500;700;900',
		'Gabriela',
		'Gloria Hallelujah',
		'Great Vibes',
		'Handlee',
		'Hammersmith One',
		'Heebo:wght@100;200;300;400;500;600;700;800;900',
		'Hind:wght@300;400;500;600;700',
		'Inconsolata:wght@200;300;400;500;600;700;800;900',
		'Indie Flower',
		'IM Fell English SC',
		'Julius Sans One',
		'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700',
		'Lobster',
		'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900',
		'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Libre Baskerville:ital,wght@0,400;0,700;1,400',
		'Lobster Two:ital,wght@0,400;0,700;1,400;1,700',
		'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900',
		'Marck Script',
		'Marcellus',
		'Merienda One',
		'Monda:wght@400;700',
		'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000',
		'Noto Serif:ital,wght@0,400;0,700;1,400;1,700',
		'Nunito Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900',
		'Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Overpass Mono:wght@300;400;500;600;700',
		'Oxygen:wght@300;400;700',
		'Oswald:wght@200;300;400;500;600;700',
		'Orbitron:wght@400;500;600;700;800;900',
		'Patua One',
		'Pacifico',
		'Padauk:wght@400;700',
		'Playball',
		'Playfair Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
		'Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'PT Sans:ital,wght@0,400;0,700;1,400;1,700',
		'PT Serif:ital,wght@0,400;0,700;1,400;1,700',
		'Philosopher:ital,wght@0,400;0,700;1,400;1,700',
		'Permanent Marker',
		'Poiret One',
		'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Prata',
		'Quicksand:wght@300;400;500;600;700',
		'Quattrocento Sans:ital,wght@0,400;0,700;1,400;1,700',
		'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900',
		'Roboto Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
	 	'Rokkitt:wght@100;200;300;400;500;600;700;800;900',
	 	'Russo One',
	 	'Righteous',
	 	'Saira:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Satisfy',
	 	'Sen:wght@400;700;800',
	 	'Slabo 13px',
	 	'Source Sans Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900',
	 	'Shadows Into Light Two',
	 	'Shadows Into Light',
	 	'Sacramento',
	 	'Sail',
	 	'Shrikhand',
	 	'League Spartan:wght@100;200;300;400;500;600;700;800;900',
	 	'Staatliches',
	 	'Stylish',
	 	'Tangerine:wght@400;700',
	 	'Titillium Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700',
	 	'Trirong:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700',
	 	'Unica One',
	 	'VT323',
	 	'Varela Round',
	 	'Vampiro One',
	 	'Vollkorn:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Volkhov:ital,wght@0,400;0,700;1,400;1,700',
	 	'Work Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Yanone Kaffeesatz:wght@200;300;400;500;600;700',
	 	'ZCOOL XiaoWei',
	 	'Open Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800',
		'Josefin Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
		'Josefin Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700'

	);

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

/* Theme enqueue scripts */
function learnpress_coaching_scripts() {
	wp_enqueue_style( 'learnpress-coaching-font', learnpress_coaching_font_url(), array() );
	// blocks-css
	wp_enqueue_style( 'learnpress-coaching-block-style', get_theme_file_uri('/css/blocks.css') );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style( 'learnpress-coaching-basic-style', get_stylesheet_uri() );
	wp_style_add_data( 'learnpress-coaching-style', 'rtl', 'replace' );
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/css/fontawesome-all.css' );
	if (get_theme_mod('learnpress_coaching_sidebar_animation', true) == true){
	wp_enqueue_script( 'jquery-wow', get_template_directory_uri() . '/js/wow.js', array('jquery') );
	wp_enqueue_style( 'animate-css', get_template_directory_uri().'/css/animate.css' );
    }

	// Body
	$learnpress_coaching_body_color       = get_theme_mod('learnpress_coaching_body_color', '');
	$learnpress_coaching_body_font_family = get_theme_mod('learnpress_coaching_body_font_family', '');
	$learnpress_coaching_body_font_size   = get_theme_mod('learnpress_coaching_body_font_size', '');
	$learnpress_coaching_body_font_weight   = get_theme_mod('learnpress_coaching_body_font_weight', '');

	// Paragraph
	$learnpress_coaching_paragraph_color       = get_theme_mod('learnpress_coaching_paragraph_color', '');
	$learnpress_coaching_paragraph_font_family = get_theme_mod('learnpress_coaching_paragraph_font_family', '');
	$learnpress_coaching_paragraph_font_size   = get_theme_mod('learnpress_coaching_paragraph_font_size', '');
	$learnpress_coaching_paragraph_font_weight   = get_theme_mod('learnpress_coaching_paragraph_font_weight', '');
	// "a" tag
	$learnpress_coaching_atag_color       = get_theme_mod('learnpress_coaching_atag_color', '');
	$learnpress_coaching_atag_font_family = get_theme_mod('learnpress_coaching_atag_font_family', '');
	// "li" tag
	$learnpress_coaching_li_color       = get_theme_mod('learnpress_coaching_li_color', '');
	$learnpress_coaching_li_font_family = get_theme_mod('learnpress_coaching_li_font_family', '');

	// H1
	$learnpress_coaching_h1_color       = get_theme_mod('learnpress_coaching_h1_color', '');
	$learnpress_coaching_h1_font_family = get_theme_mod('learnpress_coaching_h1_font_family', '');
	$learnpress_coaching_h1_font_size   = get_theme_mod('learnpress_coaching_h1_font_size', '');
	$learnpress_coaching_h1_font_weight   = get_theme_mod('learnpress_coaching_h1_font_weight', '');
	// H2
	$learnpress_coaching_h2_color       = get_theme_mod('learnpress_coaching_h2_color', '');
	$learnpress_coaching_h2_font_family = get_theme_mod('learnpress_coaching_h2_font_family', '');
	$learnpress_coaching_h2_font_size   = get_theme_mod('learnpress_coaching_h2_font_size', '');
	$learnpress_coaching_h2_font_weight   = get_theme_mod('learnpress_coaching_h2_font_weight', '');
	// H3
	$learnpress_coaching_h3_color       = get_theme_mod('learnpress_coaching_h3_color', '');
	$learnpress_coaching_h3_font_family = get_theme_mod('learnpress_coaching_h3_font_family', '');
	$learnpress_coaching_h3_font_size   = get_theme_mod('learnpress_coaching_h3_font_size', '');
	$learnpress_coaching_h3_font_weight   = get_theme_mod('learnpress_coaching_h3_font_weight', '');
	// H4
	$learnpress_coaching_h4_color       = get_theme_mod('learnpress_coaching_h4_color', '');
	$learnpress_coaching_h4_font_family = get_theme_mod('learnpress_coaching_h4_font_family', '');
	$learnpress_coaching_h4_font_size   = get_theme_mod('learnpress_coaching_h4_font_size', '');
	$learnpress_coaching_h4_font_weight   = get_theme_mod('learnpress_coaching_h4_font_weight', '');
	// H5
	$learnpress_coaching_h5_color       = get_theme_mod('learnpress_coaching_h5_color', '');
	$learnpress_coaching_h5_font_family = get_theme_mod('learnpress_coaching_h5_font_family', '');
	$learnpress_coaching_h5_font_size   = get_theme_mod('learnpress_coaching_h5_font_size', '');
	$learnpress_coaching_h5_font_weight   = get_theme_mod('learnpress_coaching_h5_font_weight', '');
	// H6
	$learnpress_coaching_h6_color       = get_theme_mod('learnpress_coaching_h6_color', '');
	$learnpress_coaching_h6_font_family = get_theme_mod('learnpress_coaching_h6_font_family', '');
	$learnpress_coaching_h6_font_size   = get_theme_mod('learnpress_coaching_h6_font_size', '');
	$learnpress_coaching_h6_font_weight   = get_theme_mod('learnpress_coaching_h6_font_weight', '');

	$learnpress_coaching_custom_css = '
		body{
		    color:'.esc_html($learnpress_coaching_body_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_body_font_family).';
		    font-size: '.esc_html($learnpress_coaching_body_font_size).'px;
			font-weight: '.esc_html($learnpress_coaching_body_font_weight).'!important;
		}
		p,span{
		    color:'.esc_html($learnpress_coaching_paragraph_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_paragraph_font_family).';
		    font-size: '.esc_html($learnpress_coaching_paragraph_font_size).'px;
			font-weight: '.esc_html($learnpress_coaching_paragraph_font_weight).'!important;
		}
		a{
		    color:'.esc_html($learnpress_coaching_atag_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_atag_font_family).';
		}
		li{
		    color:'.esc_html($learnpress_coaching_li_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_li_font_family).';
		}
		h1{
		    color:'.esc_html($learnpress_coaching_h1_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_h1_font_family).'!important;
		    font-size: '.esc_html($learnpress_coaching_h1_font_size).'px !important;
			font-weight: '.esc_html($learnpress_coaching_h1_font_weight).'!important;
		}
		h2{
		    color:'.esc_html($learnpress_coaching_h2_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_h2_font_family).'!important;
		    font-size: '.esc_html($learnpress_coaching_h2_font_size).'px !important;
			font-weight: '.esc_html($learnpress_coaching_h2_font_weight).'!important;
		}
		h3{
		    color:'.esc_html($learnpress_coaching_h3_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_h3_font_family).'!important;
		    font-size: '.esc_html($learnpress_coaching_h3_font_size).'px !important;
			font-weight: '.esc_html($learnpress_coaching_h3_font_weight).'!important;
		}
		h4{
		    color:'.esc_html($learnpress_coaching_h4_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_h4_font_family).'!important;
		    font-size: '.esc_html($learnpress_coaching_h4_font_size).'px !important;
			font-weight: '.esc_html($learnpress_coaching_h4_font_weight).'!important;
		}
		h5{
		    color:'.esc_html($learnpress_coaching_h5_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_h5_font_family).'!important;
		    font-size: '.esc_html($learnpress_coaching_h5_font_size).'px !important;
			font-weight: '.esc_html($learnpress_coaching_h5_font_weight).'!important;
		}
		h6{
		    color:'.esc_html($learnpress_coaching_h6_color).'!important;
		    font-family: '.esc_html($learnpress_coaching_h6_font_family).'!important;
		    font-size: '.esc_html($learnpress_coaching_h6_font_size).'px !important;
			font-weight: '.esc_html($learnpress_coaching_h6_font_weight).'!important;
		}
	';
	wp_add_inline_style('learnpress-coaching-basic-style', $learnpress_coaching_custom_css);

	/* Theme Color sheet */
	require get_parent_theme_file_path( '/theme-color-option.php' );
	wp_add_inline_style( 'learnpress-coaching-basic-style',$learnpress_coaching_custom_css );
	wp_enqueue_script( 'tether-js', get_template_directory_uri() . '/js/tether.js', array('jquery') ,'',true);
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery') ,'',true);
	wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery') ,'',true);
	wp_enqueue_script( 'learnpress-coaching-custom-scripts-jquery', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'learnpress_coaching_scripts' );

function learnpress_coaching_sanitize_dropdown_pages( $page_id, $setting ) {
  	// Ensure $input is an absolute integer.
  	$page_id = absint( $page_id );
  	// If $page_id is an ID of a published page, return it; otherwise, return the default.
  	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/* Excerpt Limit Begin */
function learnpress_coaching_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

/*radio button sanitization*/
function learnpress_coaching_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function learnpress_coaching_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function learnpress_coaching_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function learnpress_coaching_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

/**
* Switch sanitization
*/
if ( ! function_exists( 'learnpress_coaching_switch_sanitization' ) ) {
	function learnpress_coaching_switch_sanitization( $input ) {
		if ( true === $input ) {
			return 1;
		} else {
			return 0;
		}
	}
}

/**
 * Integer sanitization
 */
if ( ! function_exists( 'learnpress_coaching_sanitize_integer' ) ) {
	function learnpress_coaching_sanitize_integer( $input ) {
		return (int) $input;
	}
}

// Change number or products per row to 4
add_filter('loop_shop_columns', 'learnpress_coaching_loop_columns');
if (!function_exists('learnpress_coaching_loop_columns')) {
	function learnpress_coaching_loop_columns() {
		$columns = get_theme_mod( 'learnpress_coaching_per_columns', 4 );
		return $columns; // 4 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'learnpress_coaching_shop_per_page', 20 );
function learnpress_coaching_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'learnpress_coaching_product_per_page', 9 );
	return $cols;
}

//Display the related posts
if ( ! function_exists( 'learnpress_coaching_related_posts' ) ) {
	function learnpress_coaching_related_posts() {
		wp_reset_postdata();
		global $post;
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => absint( get_theme_mod( 'learnpress_coaching_related_posts_count_number', '3' ) ),
		);
		// Categories
		if ( get_theme_mod( 'learnpress_coaching_related_posts_taxanomies', 'categories' ) == 'categories' ) {

			$cats = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $cats ) {
				$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Tags
		if ( get_theme_mod( 'learnpress_coaching_related_posts_taxanomies', 'categories' ) == 'tags' ) {

			$tags = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $tags ) {
				$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode( ',', $tags );
			}
			if ( ! $tags ) {
				$break = true;
			}
		}
		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();
		return $query;
	}
}

function learnpress_coaching_enable_post_featured_image(){
	if(get_theme_mod('learnpress_coaching_post_featured_image') == 'Image' ) {
		return true;
	}
	return false;
}

function learnpress_coaching_post_color_enabled(){
	if(get_theme_mod('learnpress_coaching_post_featured_image') == 'Color' ) {
		return true;
	}
	return false;
}

function learnpress_coaching_enable_post_image_custom_dimention(){
	if(get_theme_mod('learnpress_coaching_post_featured_image_dimention') == 'Custom' ) {
		return true;
	}
	return false;
}

function learnpress_coaching_enable_single_post_image_custom_dimention(){
	if(get_theme_mod('learnpress_coaching_single_post_featured_image_dimention') == 'Custom' ) {
		return true;
	}
	return false;
}

function learnpress_coaching_show_post_color(){
	if(get_theme_mod('learnpress_coaching_post_featured_image') == 'Color' ) {
		return true;
	}
	return false;
}

// Reset all theme settings
function learnpress_coaching_reset_demo_import_settings() {
    if (current_user_can('manage_options')) {
        // List only demo import-related settings to reset
        remove_theme_mod('learnpress_coaching_email_icon');
		remove_theme_mod('learnpress_coaching_email_address');
		remove_theme_mod('learnpress_coaching_time_icon');
		remove_theme_mod('learnpress_coaching_time1');
		remove_theme_mod('learnpress_coaching_location_icon');
		remove_theme_mod('learnpress_coaching_location1');
		remove_theme_mod('learnpress_coaching_location');
		remove_theme_mod('learnpress_coaching_phone_icon');
		remove_theme_mod('learnpress_coaching_call1');
		remove_theme_mod('learnpress_coaching_call');
		remove_theme_mod('learnpress_coaching_free1');
		remove_theme_mod('learnpress_coaching_free');
		remove_theme_mod('learnpress_coaching_facebook_icon');
		remove_theme_mod('learnpress_coaching_facebook_link');
		remove_theme_mod('learnpress_coaching_twitter_icon');
		remove_theme_mod('learnpress_coaching_twitter_link');
		remove_theme_mod('learnpress_coaching_linkdin_icon');
		remove_theme_mod('learnpress_coaching_linkdin_link');
		remove_theme_mod('learnpress_coaching_twitter_icon');
		remove_theme_mod('learnpress_coaching_instagram_link');
		remove_theme_mod('learnpress_coaching_pintrest_icon');
		remove_theme_mod('learnpress_coaching_pintrest_link');
		remove_theme_mod('learnpress_coaching_slider_button_text');
		for ( $count = 1; $count <= 4; $count++ ) {
			remove_theme_mod('learnpress_coaching_slider_setting' . $count);
		}		
		remove_theme_mod('learnpress_coaching_ourservices');
		remove_theme_mod('learnpress_coaching_about_title');
		remove_theme_mod('learnpress_coaching_single_post');
		remove_theme_mod('learnpress_coaching_show_top_header');
		remove_theme_mod('learnpress_coaching_show_icons');
		remove_theme_mod('learnpress_coaching_slider_hide');
		remove_theme_mod('learnpress_coaching_ourservices_enable');

        wp_send_json_success(array('message' => __('Demo import settings have been reset.', 'learnpress-coaching')));
    } else {
        wp_send_json_error(array('message' => __('Permission denied.', 'learnpress-coaching')));
    }
}
add_action('wp_ajax_learnpress_coaching_reset_demo_import_settings', 'learnpress_coaching_reset_demo_import_settings'); 

function learnpress_coaching_theme_setup() {
	define('LEARNPREE_COACHING_LIVE_DEMO',__('https://demos.buywptemplates.com/bwt-coaching-pro/', 'learnpress-coaching'));
	define('LEARNPREE_COACHING_BUY_PRO',__('https://www.buywptemplates.com/products/coaching-wordpress-template', 'learnpress-coaching'));
	define('LEARNPREE_COACHING_PRO_DOC',__('https://demos.buywptemplates.com/demo/docs/bwt-coaching-pro/', 'learnpress-coaching'));
	define('LEARNPREE_COACHING_FREE_DOC',__('https://demos.buywptemplates.com/demo/docs/free-learnpress-coaching/', 'learnpress-coaching'));
	define('LEARNPREE_COACHING_PRO_SUPPORT',__('https://buywptemplates.com/pages/community/', 'learnpress-coaching'));
	define('LEARNPREE_COACHING_FREE_SUPPORT',__('https://wordpress.org/support/theme/learnpress-coaching/', 'learnpress-coaching'));
	define('LEARNPREE_COACHING_REVIEW',__('https://wordpress.org/support/theme/learnpress-coaching/reviews/', 'learnpress-coaching'));
	define('LEARNPREE_COACHING_CREDIT',__('https://www.buywptemplates.com/products/free-coaching-wordpress-template', 'learnpress-coaching'));
}
add_action( 'after_setup_theme', 'learnpress_coaching_theme_setup' );

if ( ! function_exists( 'LEARNPREE_COACHING_CREDIT' ) ) {
	function learnpress_coaching_credit(){
		echo "<a href=".esc_url(LEARNPREE_COACHING_CREDIT)." target='_blank'>".esc_html__('LearnPress Coaching WordPress Theme ','learnpress-coaching')."</a>";
	}
}

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Load Customizer file. */
require get_template_directory() . '/inc/customizer.php';

/* About Widget */
require get_template_directory() . '/inc/about.php';

/* Contact Widget */
require get_template_directory() . '/inc/contact.php';

/* Load welcome message.*/
require get_template_directory() . '/inc/dashboard/get_started_info.php';

/* Webfonts */
require get_template_directory() . '/wptt-webfont-loader.php';

/* TGM Plugin Activation */
require get_template_directory() . '/inc/tgm/tgm.php';