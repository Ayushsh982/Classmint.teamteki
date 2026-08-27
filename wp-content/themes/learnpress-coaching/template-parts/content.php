<?php
/**
 * The template part for displaying content
 * @package LearnPress Coaching
 * @subpackage learnpress_coaching
 * @since 1.0
 */
?>

<?php $learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_post_layouts','Layout 2');
if($learnpress_coaching_theme_lay == 'Layout 1'){ 
	get_template_part('template-parts/Post-layouts/layout1'); 
}else if($learnpress_coaching_theme_lay == 'Layout 2'){ 
	get_template_part('template-parts/Post-layouts/layout2'); 
}else if($learnpress_coaching_theme_lay == 'Layout 3'){ 
	get_template_part('template-parts/Post-layouts/layout3'); 
}else{ 
	get_template_part('template-parts/Post-layouts/layout2'); 
}