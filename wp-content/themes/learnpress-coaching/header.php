<?php
/**
 * The Header for our theme.
 * @package LearnPress Coaching
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open(); 
  } else { 
    do_action( 'wp_body_open' ); 
  } ?>
  <?php if(get_theme_mod('learnpress_coaching_preloader',false) != '' || get_theme_mod( 'learnpress_coaching_display_preloader',false) != ''){ ?>
    <div class="frame w-100 h-100">
      <div class="loader">
        <div class="dot-1"></div>
        <div class="dot-2"></div>
        <div class="dot-3"></div>
      </div>
    </div>
  <?php }?>
  <header role="banner" class="header-box">
    <a class="screen-reader-text skip-link" href="#skip_content"><?php esc_html_e( 'Skip to content', 'learnpress-coaching' ); ?></a>
    <?php if( get_theme_mod('learnpress_coaching_show_top_header', false) != ''){ ?>
      <div class="top-header">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-3 align-self-center">
              <div class="mail">
                <?php if ( get_theme_mod('learnpress_coaching_email_address','') != "" ) {?>
                  <span class="me-3 mb-2 mb-md-0"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_email_icon','far fa-envelope')); ?> me-2 icon-color"></i><a href="mailto:<?php echo esc_attr( get_theme_mod('learnpress_coaching_email_address','' )); ?>"><?php echo esc_html( get_theme_mod('learnpress_coaching_email_address','') ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('learnpress_coaching_email_address','') ); ?></span></a></span>
                <?php }?>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 align-self-center">
              <div class="time">
                <?php if ( get_theme_mod('learnpress_coaching_time1','') != "" ) {?>
                  <span class="me-3 mb-2 mb-md-0"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_time_icon','far fa-clock')); ?> me-2 icon-color"></i><?php echo esc_html( get_theme_mod('learnpress_coaching_time1','') ); ?></span>
                <?php }?>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 align-self-center">
            <?php if (get_theme_mod('learnpress_coaching_show_icons', false)){ ?> 
                <div class="social-icons mb-2 mb-md-0">
                  <?php if ( get_theme_mod('learnpress_coaching_facebook_link','') != "" ) {?>
                    <a target="_blank" href="<?php echo esc_attr( get_theme_mod('learnpress_coaching_facebook_link','' )); ?>"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_facebook_icon','fab fa-facebook-f')); ?> me-3"></i></a>
                  <?php }?>
                  <?php if ( get_theme_mod('learnpress_coaching_twitter_link','') != "" ) {?>
                    <a target="_blank" href="<?php echo esc_attr( get_theme_mod('learnpress_coaching_twitter_link','' )); ?>"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_twitter_icon','fab fa-twitter')); ?> me-3"></i></a>
                  <?php }?>
                  <?php if ( get_theme_mod('learnpress_coaching_linkdin_link','') != "" ) {?>
                    <a target="_blank" href="<?php echo esc_attr( get_theme_mod('learnpress_coaching_linkdin_link','' )); ?>"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_linkdin_icon','fab fa-linkedin-in')); ?> me-3"></i></a>
                  <?php }?>
                  <?php if ( get_theme_mod('learnpress_coaching_instagram_link','') != "" ) {?>
                    <a target="_blank" href="<?php echo esc_attr( get_theme_mod('learnpress_coaching_instagram_link','' )); ?>"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_instagram_icon','fab fa-instagram')); ?> me-3"></i></a>
                  <?php }?>
                  <?php if ( get_theme_mod('learnpress_coaching_pintrest_link','') != "" ) {?>
                    <a target="_blank" href="<?php echo esc_attr( get_theme_mod('learnpress_coaching_pintrest_link','' )); ?>"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_pintrest_icon','fab fa-pinterest-p')); ?>"></i></a>
                  <?php }?>
                </div> 
            <?php }?>   
            </div>
            <div class="col-lg-3 col-md-3 align-self-center text-center">
              <div class="free-btn">
                <?php if ( get_theme_mod('learnpress_coaching_free1','') != "" || get_theme_mod('learnpress_coaching_free','') != "") {?>
                   <a href="<?php echo esc_html(get_theme_mod('learnpress_coaching_free')); ?>"><?php echo esc_html(get_theme_mod('learnpress_coaching_free1','')); ?></a>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-12"></div>
        <div class="col-lg-4 col-md-6 align-self-center">
          <?php if( get_theme_mod('learnpress_coaching_location') != ''||get_theme_mod('learnpress_coaching_location1') != ''){ ?>
          <div class="location">
              <div class="phone p-0">
                <i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_location_icon','fas fa-map-marker-alt')); ?>"></i>
              </div>
              <div class="location-text ms-3">
                <p><?php echo esc_html( get_theme_mod('learnpress_coaching_location','')); ?></p>
                <p class="color"><?php echo esc_html( get_theme_mod('learnpress_coaching_location1','')); ?></p>
              </div>
          </div>
          <?php } ?>
        </div>
        <div class="col-lg-5 col-md-6 align-self-center">
          <?php if( get_theme_mod('learnpress_coaching_call1') != ''||get_theme_mod('learnpress_coaching_call') != ''){ ?>
            <div class="call">
                <div class="phone p-0">
                  <i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_phone_icon','fas fa-phone')); ?>"></i>
                </div>
                <div class="phone-text ms-3">
                  <p><?php echo esc_html( get_theme_mod('learnpress_coaching_call1','')); ?></p>
                  <p class="color call-no"><a href="tel:<?php echo esc_attr( get_theme_mod('learnpress_coaching_call','' )); ?>"><?php echo esc_html( get_theme_mod('learnpress_coaching_call','')); ?></a></p>
                </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div id="header">
      <div class="menu-header py-2">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-8 col-9 align-self-center">
              <div class="logo pb-md-0 align-self-center">
                <div class="row">
                  <div class="<?php if( get_theme_mod( 'learnpress_coaching_site_logo_inline') != '') { ?>col-lg-5 col-md-5 col-5"<?php } else { ?>col-lg-12 col-md-12  <?php } ?>">
                    <?php if ( has_custom_logo() ) : ?>
                      <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="<?php if( get_theme_mod( 'learnpress_coaching_site_logo_inline') != '') { ?>col-lg-7 col-md-7 col-7 site-logo-inline"<?php } else { ?>col-lg-12 col-md-12 <?php } ?>">
                    <?php $blog_info = get_bloginfo( 'name' ); ?>
                    <?php if ( ! empty( $blog_info ) ) : ?>
                      <?php if( get_theme_mod('learnpress_coaching_site_title_enable',true) != ''){ ?>
                        <?php if ( is_front_page() && is_home() ) : ?>
                          <h1 class="site-title pb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                          <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif; ?>
                      <?php }?>
                    <?php endif; ?>
                    <?php
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                      <?php if( get_theme_mod('learnpress_coaching_site_tagline_enable',false) != ''){ ?>
                        <p class="site-description"><?php echo esc_html($description); ?></p>
                      <?php }?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-4 col-3 align-self-center <?php if( get_theme_mod( 'learnpress_coaching_sticky_header', false) != '') { ?> sticky-header<?php } else { ?>close-sticky <?php } ?>">
              <div class="toggle-menu responsive-menu">
                <button role="tab" onclick="learnpress_coaching_menu_open()" class="mobiletoggle"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_responsive_menu_open_icon','fas fa-bars')); ?>"></i><?php echo esc_html( get_theme_mod('learnpress_coaching_open_menu_label')); ?><span class="screen-reader-text"><?php esc_html_e('Open Menu','learnpress-coaching'); ?></span>
                </button>
              </div>
              <div id="navbar-header text-center" class="menu-brand primary-nav">
                <nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'learnpress-coaching' ); ?>">
                  <?php
                    wp_nav_menu( array( 
                      'theme_location' => 'primary',
                      'container_class' => 'main-menu-navigation clearfix' ,
                      'menu_class' => 'main-menu-navigation clearfix',
                      'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav m-0 ps-0 text-start">%3$s</ul>',
                      'fallback_cb' => 'wp_page_menu',
                    ) );
                  ?>
                </nav>
                <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="learnpress_coaching_menu_close()"><?php echo esc_html( get_theme_mod('learnpress_coaching_close_menu_label')); ?><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_responsive_menu_close_icon','fas fa-times')); ?>"></i>
                  <span class="screen-reader-text"><?php esc_html_e('Close Menu','learnpress-coaching'); ?></span></a>
              </div>
            </div>

          <?php if(get_theme_mod('learnpress_coaching_display_search',true) != ''){ ?>
              <div class="col-lg-1 col-md-1 col-6 align-self-center">
                <div class="main-search my-4 pl-2 align-self-center">
                  <span><a href="#"><i class="<?php echo esc_attr(get_theme_mod('learnpress_coaching_search_icon','fas fa-search')); ?>"></i></a></span>
                </div>
              </div>
          <?php }?>
          <div class="searchform_page w-100 h-100">
            <div class="close w-100 text-end me-4"><a href="#maincontent"><i class="fa fa-times"></i></a></div>
            <div class="search_input w-100">
              <?php get_search_form(); ?>
            </div>
          </div>

          </div>
        </div>
      </div>
    </div>
  </header>