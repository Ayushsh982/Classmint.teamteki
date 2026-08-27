<?php
/**
 * The template part for displaying grid layout
 * @package LearnPress Coaching
 * @subpackage learnpress_coaching
 * @since 1.0
 */
?>
<?php
  $archive_year  = get_the_time('Y');
  $archive_month = get_the_time('m');
  $archive_day   = get_the_time('d');
?>
<div class="col-lg-4 col-md-4 gridbox">
  <article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>   
    <div class="box-image">
      <?php if( get_theme_mod( 'learnpress_coaching_post_featured_image',true) != '') { ?>
        <div class="box-image mb-3">
          <?php the_post_thumbnail(); ?>
        </div>
      <?php }?>
    </div>
    <h2 class="p-0 my-2"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>   
    <?php if( get_theme_mod( 'learnpress_coaching_grid_post_date',true) != '' || get_theme_mod( 'learnpress_coaching_grid_post_author',true) != '' || get_theme_mod( 'learnpress_coaching_grid_post_comment',true) != '' || get_theme_mod( 'learnpress_coaching_grid_post_time',true) != '') { ?>
      <div class="metabox py-2 mb-1">
        <?php if( get_theme_mod( 'learnpress_coaching_grid_post_date',true) != '') { ?>
          <span class="entry-date me-1 py-1"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_grid_post_date_icon','far fa-calendar-alt')); ?> me-2"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span class="ms-1"><?php echo esc_html( get_theme_mod('learnpress_coaching_grid_post_meta_seperator','|') ); ?></span>
        <?php }?>
        <?php if( get_theme_mod( 'learnpress_coaching_grid_post_author',true) != '') { ?>
          <span class="entry-author mx-1 py-1"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_grid_post_author_icon','fas fa-user')); ?> me-2"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></span><span class="ms-1"><?php echo esc_html( get_theme_mod('learnpress_coaching_grid_post_meta_seperator','|') ); ?></span>
        <?php }?>
        <?php if( get_theme_mod( 'learnpress_coaching_grid_post_comment',true) != '') { ?>
          <span class="entry-comments mx-1 py-1"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_grid_post_comment_icon','fas fa-comments')); ?> me-2"></i> <?php comments_number( __('0 Comment', 'learnpress-coaching'), __('0 Comments', 'learnpress-coaching'), __('% Comments', 'learnpress-coaching') ); ?></span><span class="ms-1"><?php echo esc_html( get_theme_mod('learnpress_coaching_grid_post_meta_seperator','|') ); ?></span>
        <?php }?>
        <?php if( get_theme_mod( 'learnpress_coaching_grid_post_time',true) != '' ) { ?>
            <span class="entry-time mx-1 py-1"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_grid_post_time_icon','fas fa-clock')); ?> me-2"></i> <?php echo esc_html( get_the_time() ); ?></span>
        <?php }?>
      </div>
    <?php }?>
    <div class="new-text">
				<p>
					<?php $learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_grid_post_content','Post Excerpt');
						if($learnpress_coaching_theme_lay == 'Post Content'){ ?>
							<?php the_content(); ?>
				    	<?php }
						if($learnpress_coaching_theme_lay == 'Post Excerpt'){ ?>
						  <?php $learnpress_coaching_excerpt = get_the_excerpt(); echo esc_html( learnpress_coaching_string_limit_words( $learnpress_coaching_excerpt, esc_attr(get_theme_mod('learnpress_coaching_grid_post_excerpt_number','30')))); ?>  <?php echo esc_html( get_theme_mod('learnpress_coaching_grid_excerpt_suffix','[...]') ); ?>
					<?php }?>
				</p>
			</div>
    <?php if( get_theme_mod('learnpress_coaching_button_text','View More') != ''){ ?>
      <div class="postbtn mt-4 text-start">
        <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('learnpress_coaching_button_text','View More'));?><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_button_icon','fas fa-long-arrow-alt-right')); ?> me-0 py-0 px-2"></i><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('learnpress_coaching_button_text','View More'));?></span></a>
      </div>
    <?php }?>
  </article>
</div>