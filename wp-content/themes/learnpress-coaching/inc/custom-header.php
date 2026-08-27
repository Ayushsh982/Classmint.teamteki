<?php
/**
 * @package LearnPress Coaching
 * @subpackage learnpress-coaching
 * @since learnpress-coaching 1.0
 * Setup the WordPress core custom header feature.
 * @uses learnpress_coaching_header_style()
*/

function learnpress_coaching_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'learnpress_coaching_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 200,
		'flex-width'         	=> true,
        'flex-height'        	=> true,
		'wp-head-callback'       => 'learnpress_coaching_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'learnpress_coaching_custom_header_setup' );

if ( ! function_exists( 'learnpress_coaching_header_style' ) ) :

add_action( 'wp_enqueue_scripts', 'learnpress_coaching_header_style' );
function learnpress_coaching_header_style() {
	if ( get_header_image() ) :
	$learnpress_coaching_custom_css = "
        .header-box{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
			background-size:cover;
		}";
	   	wp_add_inline_style( 'learnpress-coaching-basic-style', $learnpress_coaching_custom_css );
	endif;
}
endif;