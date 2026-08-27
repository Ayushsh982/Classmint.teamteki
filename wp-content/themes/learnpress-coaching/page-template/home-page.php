<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main role="main" id="skip_content">
  <?php do_action( 'learnpress_coaching_above_slider' ); ?>
  <?php if( get_theme_mod('learnpress_coaching_slider_hide', false) != '' || get_theme_mod( 'learnpress_coaching_display_slider',false) != ''){ ?>
    <section id="slider" class="m-auto p-0 mw-100">
      <?php $learnpress_coaching_slider_speed = get_theme_mod('learnpress_coaching_slider_speed', 3000); ?>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-interval="<?php echo esc_attr($learnpress_coaching_slider_speed); ?>"> 
        <?php $learnpress_coaching_slider_page = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'learnpress_coaching_slider_setting' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $learnpress_coaching_slider_page[] = $mod;
            }
          }
          if( !empty($learnpress_coaching_slider_page) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $learnpress_coaching_slider_page,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php if(has_post_thumbnail()){
                  the_post_thumbnail();
              } else{?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slider.png" alt="<?php echo esc_attr( 'slider', 'learnpress-coaching'); ?>" />
              <?php } ?>
              <?php if( get_theme_mod('learnpress_coaching_slider_heading',true) != '' || get_theme_mod('learnpress_coaching_slider_text',true) != '' ){ ?>
                <div class="carousel-caption">
                  <div class="inner_carousel">
                    <div class="carousel-content wow zoomIn">
                      <?php if( get_theme_mod('learnpress_coaching_slider_heading',true) != ''){ ?>
                        <h1 class="mt-3 mb-0"><?php the_title(); ?></h1>
                      <?php } ?>
                      <?php if( get_theme_mod('learnpress_coaching_slider_text',true) != ''){ ?>
                        <p><?php $learnpress_coaching_excerpt = get_the_excerpt(); echo esc_html( learnpress_coaching_string_limit_words( $learnpress_coaching_excerpt, esc_attr(get_theme_mod('learnpress_coaching_slider_excerpt_number','15')))); ?></p>
                      <?php } ?>
                      <?php if (get_theme_mod( 'learnpress_coaching_show_slider_button',true) != ''){ ?>
                        <?php if( get_theme_mod('learnpress_coaching_slider_button_text','READ MORE') != '' || get_theme_mod('learnpress_coaching_slider_button_link') != ''){ ?>
                          <div class="more-btn mt-0 mt-md-4">
                            <a href="<?php echo esc_url(get_theme_mod('learnpress_coaching_slider_button_link')!= '') ? esc_url(get_theme_mod('learnpress_coaching_slider_button_link')) : esc_url(get_permalink()); ?>"><?php echo esc_html( get_theme_mod('learnpress_coaching_slider_button_text',__('READ MORE','learnpress-coaching'))); ?><i class="fas fa-caret-right"></i><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('learnpress_coaching_slider_button_text',__('READ MORE','learnpress-coaching'))); ?></span></a>
                          </div>
                        <?php }?>  
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_slider_previous_icon','fas fa-chevron-left')); ?>"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','learnpress-coaching' );?></span>
        </a>
        <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_slider_next_icon','fas fa-chevron-right')); ?>"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','learnpress-coaching' );?></span>
        </a>
      </div>  
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php do_action( 'learnpress_coaching_below_slider' ); ?>

  <?php if( get_theme_mod( 'learnpress_coaching_ourservices_enable', false) != '') { ?>
    <section id="our-services">
      <div class="container">
        <div class="row service-layout wow zoomInDown">
          <?php 
            $catData = get_theme_mod('learnpress_coaching_ourservices');
            if($catData){              
            $page_query = new WP_Query(array(  'category_name' => esc_html( $catData ,'learnpress-coaching')));?>
            <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?> 
              <div class="col-lg-3 col-md-3 p-0">
                  <div class="text-content">
                    <div class="imagebox">
                      <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                    </div>
                    <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                  </div>
              </div>             
            <?php endwhile;
            wp_reset_postdata();
            }?>
          <div class="clearfix"></div>
        </div>  
      </div>
    </section>
  <?php } ?> 

  <?php if (get_theme_mod( 'learnpress_coaching_show_about_section',true) != ''){ ?>
    <?php if( get_theme_mod('learnpress_coaching_single_post') != '' || get_theme_mod( 'learnpress_coaching_about_title' )!= ''){ ?>
      <section id="about">
        <div class="container wow fadeInDown">
          <?php
            $postData =  get_theme_mod('learnpress_coaching_single_post');
            if($postData){
            $args = array( 'name' => esc_html($postData ,'learnpress-coaching'));
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="row">
                  <div class="col-lg-7 col-md-7">
                  <?php if( get_theme_mod('learnpress_coaching_about_title') != ''){ ?>
                    <h3><?php echo esc_html(get_theme_mod('learnpress_coaching_about_title','')); ?></h3>
                  <?php }?>
                    <div class="about-text-box">
                      <h4><?php the_title(); ?></h4>
                      <p><?php $learnpress_coaching_excerpt = get_the_excerpt(); echo esc_html( learnpress_coaching_string_limit_words( $learnpress_coaching_excerpt,30 ) ); ?></p>
                      <div class="more-btn">              
                        <a href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','learnpress-coaching'); ?><i class="fas fa-caret-right"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5">
                    <div class="about-img-box"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?></div>
                  </div>
                </div>
              <?php endwhile; 
              wp_reset_postdata();?>
              <?php else : ?>
                <div class="no-postfound"></div>
              <?php
          endif;} ?>
        </div>
      </section>
    <?php } ?>
  <?php } ?>

  <div class="container front-page-content">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="new-text"><?php the_content(); ?></div>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>

<?php get_footer(); ?>