<?php
/**
 * The template part for header
 *
 * @package Sirat 
 * @subpackage sirat
 * @since Sirat 1.0
 */
?>

<?php if( get_theme_mod( 'sirat_contact_text') != '' || get_theme_mod( 'sirat_contact_call') != '' || get_theme_mod( 'sirat_header_search') != '' ) { ?>

<?php if( get_theme_mod( 'sirat_topbar_hide_show', true) == 1 || get_theme_mod( 'sirat_resp_topbar_hide_show', true) == 1) { ?>
	<div class="top-bar">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3">
				    <?php if( get_theme_mod( 'sirat_contact_call') != '') { ?>
	          			<p><a href="tel:<?php echo esc_attr( get_theme_mod('sirat_contact_call','') ); ?>"><i class="<?php echo esc_attr(get_theme_mod('sirat_phone_icon','fas fa-phone')); ?>"></i><?php echo esc_html(get_theme_mod('sirat_contact_call',''));?></a></p>
	    			<?php } ?>
			    </div>
			    <div class="col-lg-4 col-md-4">
				    <?php if( get_theme_mod( 'sirat_contact_email') != '') { ?>
	          			<p><a href="mailto:<?php echo esc_attr( get_theme_mod('sirat_contact_email','') ); ?>"><i class="<?php echo esc_attr(get_theme_mod('sirat_contact_email_icon','far fa-envelope')); ?>"></i><?php echo esc_html(get_theme_mod('sirat_contact_email',''));?></a></p>
	        		<?php }?>
			    </div>
			    <div class="<?php if(get_theme_mod('sirat_header_search',true)) { ?>col-lg-4 col-md-4" <?php } else { ?>col-lg-5 col-md-5 "<?php } ?> >
			    	<?php if (is_active_sidebar('social-links')) : ?>
				    	<?php dynamic_sidebar('social-links'); ?>
				    <?php else : ?>
					  <!-- Default Social Icons Widgets -->
					    <div class="widget">
					        <ul class="custom-social-icons" >
					          <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li> 
					          <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li> 
					          <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li> 
					          <li><a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a></li> 
					          <li><a href="https://pinterest.com" target="_blank"><i class="fab fa-pinterest"></i></a></li> 
					          <li><a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a></li>                     
					        </ul>
					    </div>
					<?php endif; ?> 	
			    </div>
			    <?php if( get_theme_mod( 'sirat_header_search',true) == 1 || get_theme_mod( 'sirat_resp_search_hide_show',true) == 1) { ?>
		        	<div class="col-lg-1 col-md-1">
		          		<div class="search-box">
	                      <span><a href="#"><i class="<?php echo esc_attr(get_theme_mod('sirat_search_icon','fas fa-search')); ?>"></i></a></span>
	                    </div>
			        </div>
		      	<?php }?>
			</div>
			<div class="serach_outer">
	          <div class="closepop"><a href="#maincontent"><i class="<?php echo esc_attr(get_theme_mod('sirat_search_close_icon','fa fa-window-close')); ?>"></i></a></div>
	          <div class="serach_inner">
	            <?php get_search_form(); ?>
	          </div>
	        </div>
		</div>
	</div>
<?php } ?>

<?php }?>