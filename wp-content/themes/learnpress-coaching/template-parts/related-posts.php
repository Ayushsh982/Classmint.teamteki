<?php 
$archive_year  = get_the_time('Y'); 
$archive_month = get_the_time('m'); 
$archive_day   = get_the_time('d');
?>
<?php $related_posts = learnpress_coaching_related_posts();
if(get_theme_mod('learnpress_coaching_related_enable_disable',true)==1){ ?>
<?php if ( $related_posts->have_posts() ): ?>
    <div class="related-posts">
        <h3 class="mb-3"><?php echo esc_html(get_theme_mod('learnpress_coaching_related_title',__('Related Post','learnpress-coaching')));?></h3>
        <div class="row">
            <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="related-inner-box mb-3 p-4">
                        <?php if (get_theme_mod('learnpress_coaching_related_post_featured_image', true) && has_post_thumbnail()) { ?>
                            <div class="box-image mb-3">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php }?>
                        <h4 class="mb-2 p-0"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h4>
                        <?php if( get_theme_mod( 'learnpress_coaching_related_metafields_date',true) != '' || get_theme_mod( 'learnpress_coaching_related_metafields_author',true) != '' || get_theme_mod( 'learnpress_coaching_related_metafields_comment',true) != '' || get_theme_mod( 'learnpress_coaching_related_metafields_time',true) != '') { ?>
                            <div class="metabox mb-3">
                                <?php if( get_theme_mod( 'learnpress_coaching_related_metafields_date',true) != '') { ?>
                                    <span class="entry-date me-1">
                                        <i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_post_date_icon','far fa-calendar-alt')); ?> me-1 my-2"></i> 
                                        <a href="<?php echo esc_url( get_day_link( $learnpress_coaching_archive_year, $learnpress_coaching_archive_month, $learnpress_coaching_archive_day)); ?>">
                                            <?php echo esc_html( get_the_date() ); ?>
                                            <span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span>
                                            <span class="ms-1"><?php echo esc_html( get_theme_mod('learnpress_coaching_related_post_meta_seperator','|') ); ?></span>
                                        </a>
                                    </span>
                                <?php }?>

                                <?php if( get_theme_mod( 'learnpress_coaching_related_metafields_author',true) != '') { ?>
                                    <span class="entry-author">
                                        <i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_post_author_icon','fas fa-user')); ?> me-1 my-2"></i> 
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>">
                                            <?php the_author(); ?>
                                            <span class="screen-reader-text"><?php the_title(); ?></span>
                                            <span class="ms-1"><?php echo esc_html( get_theme_mod('learnpress_coaching_related_post_meta_seperator','|') ); ?></span>
                                        </a>
                                    </span>
                                <?php }?>

                                <?php if( get_theme_mod( 'learnpress_coaching_related_metafields_comment',true) != '') { ?>
                                    <span class="entry-comments">
                                        <i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_post_comments_icon','fas fa-comments')); ?> me-1 my-2"></i>
                                        <a href="<?php echo esc_url(get_comments_link()); ?>">
                                            <?php echo esc_html( get_comments_number() ); ?> 
                                            <?php echo esc_html(_n('Comment', 'Comments', get_comments_number(), 'learnpress-coaching')); ?>
                                            <span class="ms-1"><?php echo esc_html( get_theme_mod('learnpress_coaching_related_post_meta_seperator','|') ); ?></span>
                                        </a>
                                    </span>
                                <?php }?>

                                <?php if( get_theme_mod( 'learnpress_coaching_related_metafields_time',true) != '') { ?>
                                    <span class="entry-time">
                                        <i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_post_time_icon','fas fa-clock')); ?> me-1 my-2"></i>
                                        <?php echo esc_html( get_the_time() ); ?>
                                    </span>
                                <?php }?>
                            </div>
                        <?php }?>
                        <?php $learnpress_coaching_excerpt = get_the_excerpt(); echo esc_html( learnpress_coaching_string_limit_words( $learnpress_coaching_excerpt, esc_attr(get_theme_mod('learnpress_coaching_related_post_excerpt_number','15')))); ?> <?php echo esc_html( get_theme_mod('learnpress_coaching_related_post_discription_suffix','[...]') ); ?>
                        <?php if( get_theme_mod('learnpress_coaching_button_text','View More') != ''){ ?>
                            <div class="postbtn mt-4 text-start">
                                <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('learnpress_coaching_button_text','View More'));?><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_button_icon','fas fa-long-arrow-alt-right')); ?> me-0 py-0 px-2"></i><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('learnpress_coaching_button_text','View More'));?></span></a>
                            </div>
                        <?php }?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_postdata(); }?>