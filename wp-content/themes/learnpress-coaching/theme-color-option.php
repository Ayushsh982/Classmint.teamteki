<?php

	$learnpress_coaching_first_color = get_theme_mod('learnpress_coaching_first_color');

	$learnpress_coaching_custom_css ='';

	/*------------------ Global First Color -----------*/

	$learnpress_coaching_custom_css .='.primary-navigation ul ul a:hover, #slider .carousel-control-prev-icon, #slider .carousel-control-next-icon, #slider .more-btn a, #about h3:before, #about .more-btn a, .footer-wp h3:after, .woocommerce a.button, .footer-wp input[type="submit"], .footer-wp button, #sidebar button, .metabox i:before, .postbtn a, .tags a:hover, .nav-next a:hover, .nav-previous a:hover, #comments input[type="submit"].submit, #comments a.comment-reply-link, .bradcrumbs a, .bradcrumbs span, .woocommerce button.button, .woocommerce button.button, .woocommerce a.button.alt, .woocommerce button.button.alt, nav.woocommerce-MyAccount-navigation ul li, .woocommerce span.onsale, .woocommerce a.added_to_cart, #sidebar ul li:before, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, .woocommerce #respond input#submit, .pagination .current, .pagination a:hover, .postbtn:hover i, .woocommerce nav.woocommerce-pagination ul li a, #sidebar input[type="submit"], #sidebar input[type="submit"]:hover, .widget_calendar tbody a, .footer-wp .tagcloud a:hover, .page-links .post-page-numbers.current span, .page-content .read-moresec a.button, input[type="submit"], .single-post-page .category a, .wp-block-woocommerce-empty-cart-block .wp-block-button a, .wp-block-woocommerce-cart .wc-block-components-totals-coupon a, .wp-block-woocommerce-cart .wc-block-cart__submit-container a, .wp-block-woocommerce-checkout .wc-block-components-totals-coupon a, .wp-block-woocommerce-checkout .wc-block-checkout__actions_row a{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_first_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.free-btn, .woocommerce span.posted_in a{';
			$learnpress_coaching_custom_css .='background: '.esc_attr($learnpress_coaching_first_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='#header, .fixed-header {';
			$learnpress_coaching_custom_css .='background: '.esc_attr($learnpress_coaching_first_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.top-header .mail i, .top-header .time i, .social-icons i:hover, .location i, .call i, .footer-wp h3, .footer-wp li a:hover, .metabox a:hover, #sidebar ul li a:hover, td.product-name a:hover, .blog-section h2 a:hover, .footer-wp a.rsswidget, input[type="search"]{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_first_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.metabox a:hover{';
		$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_first_color).'!important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='#scrollbutton i, .wp-block-woocommerce-empty-cart-block .wc-block-grid__product-onsale {';
			$learnpress_coaching_custom_css .='border-color: '.esc_attr($learnpress_coaching_first_color).'!important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='#slider .more-btn a i {';
		$learnpress_coaching_custom_css .='border-left: 1px solid'.esc_attr($learnpress_coaching_first_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.page-content .read-moresec a.button, input[type="search"], .wp-block-woocommerce-empty-cart-block .wp-block-button a {';
			$learnpress_coaching_custom_css .='border-color: '.esc_attr($learnpress_coaching_first_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='#scrollbutton i, .copyright-wrapper, .wp-block-woocommerce-empty-cart-block .wc-block-grid__product-onsale, #slider .more-btn a {';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_first_color).'!important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='
	@media screen and (max-width:1000px) {
		.toggle-menu i{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_first_color).' !important;';
	$learnpress_coaching_custom_css .='} }';

	/*------------------ Global Second Color -----------*/

	$learnpress_coaching_second_color = get_theme_mod('learnpress_coaching_second_color');

	$learnpress_coaching_custom_css .='.top-header{';
			$learnpress_coaching_custom_css .='background: linear-gradient( 90deg, '.esc_attr($learnpress_coaching_second_color).'  78%, transparent 10%);';
	$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='
	@media screen and (max-width:720px) {
		.top-header{';
			$learnpress_coaching_custom_css .='background: '.esc_attr($learnpress_coaching_second_color).';';
	$learnpress_coaching_custom_css .='} }';

	$learnpress_coaching_custom_css .='.primary-navigation ul ul a, #slider .more-btn a:hover, #about .more-btn a:hover, .postbtn:hover a, .nav-previous a, .nav-next a, #comments input[type="submit"].submit:hover, #sidebar button:hover, .footer-wp button:hover, .bradcrumbs a:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce .product a.button:hover, input#submit:hover, .woocommerce #respond input#submit:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .page-links a:hover, .page-content .read-moresec a.button:hover, input[type="submit"]:hover, #sidebar .widget_block .wp-block-tag-cloud a:hover, .content_box .tag-test-tag .wp-block-tag-cloud a:hover, #sidebar .tagcloud a:hover, .single-post-page .category a:hover, .wp-block-woocommerce-cart .wc-block-components-totals-coupon a:hover, .wp-block-woocommerce-cart .wc-block-cart__submit-container a:hover, .wp-block-woocommerce-checkout .wc-block-components-totals-coupon a:hover, .wp-block-woocommerce-checkout .wc-block-checkout__actions_row a:hover{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_second_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.wp-block-woocommerce-empty-cart-block .wp-block-button a:hover, #slider .more-btn a:hover{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_second_color).'!important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.footer-wp{';
		$learnpress_coaching_custom_css .='background: '.esc_attr($learnpress_coaching_second_color).'!important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.wp-block-woocommerce-empty-cart-block .wp-block-button a:hover{';
			$learnpress_coaching_custom_css .='border-color: '.esc_attr($learnpress_coaching_second_color).'!important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.postbtn a i {';
		$learnpress_coaching_custom_css .='border-left: 1px solid'.esc_attr($learnpress_coaching_second_color).'!important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='a, a:hover, .new-text p a, .pagination .current, .pagination a, .category span, .tags, td.product-name a, .woocommerce .quantity .qty, #sidebar .wp-block-latest-comments li a:hover, .woocommerce nav.woocommerce-pagination ul li a, .page-links .page-links-title, .page-links a, .page-links .post-page-numbers.current span{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_second_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.wp-block-button__link{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_second_color).'!important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_custom_css .='.woocommerce .quantity .qty, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a, .wp-block-button__link, .page-content .read-moresec a.button:hover{';
			$learnpress_coaching_custom_css .='border-color: '.esc_attr($learnpress_coaching_second_color).';';
	$learnpress_coaching_custom_css .='}';

	/*---------------------------Width Layout -------------------*/
	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_width_layout_options','Default');
    if($learnpress_coaching_theme_lay == 'Default'){
		$learnpress_coaching_custom_css .='body{';
			$learnpress_coaching_custom_css .='max-width: 100%;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Container Layout'){
		$learnpress_coaching_custom_css .='body{';
			$learnpress_coaching_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Box Layout'){
		$learnpress_coaching_custom_css .='body{';
			$learnpress_coaching_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='.search-box input[type="search"]{';
			$learnpress_coaching_custom_css .='width: 75%;';
		$learnpress_coaching_custom_css .='}';
	}

	/*---------------------------Slider Content Layout -------------------*/
	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_slider_content_layout','Left');
    if($learnpress_coaching_theme_lay == 'Left'){
		$learnpress_coaching_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn {';
			$learnpress_coaching_custom_css .='text-align:left; left:15%; right:50%;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Center'){
		$learnpress_coaching_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$learnpress_coaching_custom_css .='text-align:center; left:30%; right:30%;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Right'){
		$learnpress_coaching_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn {';
			$learnpress_coaching_custom_css .='text-align:right; left:50%; right:15%;';
		$learnpress_coaching_custom_css .='}';
	}

	// slider condition
	$learnpress_coaching_slider_hide = get_theme_mod( 'learnpress_coaching_slider_hide', false);
	if($learnpress_coaching_slider_hide == true){
		$learnpress_coaching_custom_css .='#site-navigation li a{';
			$learnpress_coaching_custom_css .='color:#fff;';
		$learnpress_coaching_custom_css .='} ';
		$learnpress_coaching_custom_css .='.primary-navigation ul ul a{';
			$learnpress_coaching_custom_css .='color:#fff !important;';
		$learnpress_coaching_custom_css .='} ';
	}

	/*------------ Slider Opacity -------------------*/
	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_slider_opacity','0.6');
	if($learnpress_coaching_theme_lay == '0'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.1'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.1';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.2'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.2';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.3'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.3';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.4'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.4';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.5'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.5';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.6'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.6';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.7'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.7';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.8'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.8';
	$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == '0.9'){
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='opacity:0.9';
	$learnpress_coaching_custom_css .='}';
	}

	// Header Contact Icons Font Size
    $learnpress_coaching_header_icons_size = get_theme_mod('learnpress_coaching_header_icons_size', '16');
    $learnpress_coaching_custom_css .='.location i, .call i,.top-header .mail i, .top-header .time i{';
        $learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_header_icons_size).'px;';
    $learnpress_coaching_custom_css .='}';

	//slider heading color
	$learnpress_coaching_slider_slider_heading_color = get_theme_mod('learnpress_coaching_slider_slider_heading_color');
	$learnpress_coaching_custom_css .='#slider .inner_carousel h1{';
		$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_slider_slider_heading_color).';';
	$learnpress_coaching_custom_css .='}';

	//slider text color
	$learnpress_coaching_slider_slider_text_color = get_theme_mod('learnpress_coaching_slider_slider_text_color');
	$learnpress_coaching_custom_css .='#slider .inner_carousel p{';
		$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_slider_slider_text_color).';';
	$learnpress_coaching_custom_css .='}';

	//slider button text color
	$learnpress_coaching_slider_btn_text_color = get_theme_mod('learnpress_coaching_slider_btn_text_color');
	$learnpress_coaching_custom_css .='#slider .more-btn a{';
		$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_slider_btn_text_color).';';
	$learnpress_coaching_custom_css .='}';

	//slider button bg color
	$learnpress_coaching_slider_btn_bg_color = get_theme_mod('learnpress_coaching_slider_btn_bg_color');
	$learnpress_coaching_custom_css .='#slider .more-btn a{';
		$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_slider_btn_bg_color).';';
	$learnpress_coaching_custom_css .='}';

	/*-------------- Footer Text -------------------*/
	$learnpress_coaching_footer_text_align = get_theme_mod('learnpress_coaching_footer_text_align');
	$learnpress_coaching_custom_css .='.copyright-wrapper{';
		$learnpress_coaching_custom_css .='text-align: '.esc_attr($learnpress_coaching_footer_text_align).';';
	$learnpress_coaching_custom_css .='}';
	$learnpress_coaching_custom_css .='
	@media screen and (max-width:575px) {
		.copyright-wrapper{';
			$learnpress_coaching_custom_css .='text-align: center;'.esc_attr($learnpress_coaching_footer_text_align).'';
	$learnpress_coaching_custom_css .='} }';

	$learnpress_coaching_footer_text_padding = get_theme_mod('learnpress_coaching_footer_text_padding');
	$learnpress_coaching_custom_css .='.copyright-wrapper{';
		$learnpress_coaching_custom_css .='padding-top: '.esc_attr($learnpress_coaching_footer_text_padding).'px !important; padding-bottom: '.esc_attr($learnpress_coaching_footer_text_padding).'px !important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_footer_bg_color = get_theme_mod('learnpress_coaching_footer_bg_color');
	$learnpress_coaching_custom_css .='.footer-wp{';
		$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_footer_bg_color).';';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_footer_bg_image = get_theme_mod('learnpress_coaching_footer_bg_image');
	if($learnpress_coaching_footer_bg_image != false){
		$learnpress_coaching_custom_css .='.footer-wp{';
			$learnpress_coaching_custom_css .='background: url('.esc_attr($learnpress_coaching_footer_bg_image).'); background-size: cover;';
		$learnpress_coaching_custom_css .='}';
	}

	// Footer Attatchment
	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_footer_attatchment','scroll');
	if($learnpress_coaching_theme_lay == 'fixed'){
		$learnpress_coaching_custom_css .='.footer-wp{';
			$learnpress_coaching_custom_css .='background-attachment: fixed;';
		$learnpress_coaching_custom_css .='}';
	}elseif ($learnpress_coaching_theme_lay == 'scroll'){
		$learnpress_coaching_custom_css .='.footer-wp{';
			$learnpress_coaching_custom_css .='background-attachment: scroll;';
		$learnpress_coaching_custom_css .='}';
	}

    // footer image position
	$learnpress_coaching_footer_img_position = get_theme_mod('learnpress_coaching_footer_img_position','center center');
	if($learnpress_coaching_footer_img_position != false){
		$learnpress_coaching_custom_css .='.footer-wp{';
			$learnpress_coaching_custom_css .='background-position: '.esc_attr($learnpress_coaching_footer_img_position).'!important;';
		$learnpress_coaching_custom_css .='}';
	}

   //Footer Style 
   $learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_footer_template','learnpress_coaching-footer-one');
   if($learnpress_coaching_theme_lay == 'learnpress_coaching-footer-one'){
	   $learnpress_coaching_custom_css .='.footer-wp{';
		   $learnpress_coaching_custom_css .='';
	   $learnpress_coaching_custom_css .='}';
   }else if($learnpress_coaching_theme_lay == 'learnpress_coaching-footer-two'){
	   $learnpress_coaching_custom_css .='.footer-wp {';
		   $learnpress_coaching_custom_css .='background: #E3F2FD !important;';
	   $learnpress_coaching_custom_css .='}';
	   $learnpress_coaching_custom_css .='.footer-wp p,.footer-wp span,.footer-wp li a,.footer-wp #wp-calendar caption,.footer-wp #wp-calendar td,.footer-wp #wp-calendar th, .footer-wp, .footer-wp h3, .footer-wp a.rsswidget, .footer-wp #wp-calendar a, .copyright a, .footer-wp .custom_details, .footer-wp ins span, .footer-wp .tagcloud a, .main-inner-box span.entry-date a, nav.woocommerce-MyAccount-navigation ul li:hover a, .footer-wp ul li a, .footer-wp table, .footer-wp th, .footer-wp td, .footer-wp caption, #sidebar caption,.footer-wp nav.wp-calendar-nav a,.footer-wp .search-form .search-field, .footer-wp .rssSummary, .footer-wp ul li{';
		   $learnpress_coaching_custom_css .='color:#000 !important;';
	   $learnpress_coaching_custom_css .='}';
	   $learnpress_coaching_custom_css .='.footer-wp p{';
		   $learnpress_coaching_custom_css .='color:#000 !important;';
	   $learnpress_coaching_custom_css .='}';
	   $learnpress_coaching_custom_css .='.footer-wp ul li::before{';
		   $learnpress_coaching_custom_css .='background:#000;';
	   $learnpress_coaching_custom_css .='}';
	   $learnpress_coaching_custom_css .='.footer-wp table, .footer-wp th, .footer-wp td,.footer-wp.search-form .search-field,.footer-wp .tagcloud a{';
		   $learnpress_coaching_custom_css .='border: 1px solid #000;';
	   $learnpress_coaching_custom_css .='}';

   }else if($learnpress_coaching_theme_lay == 'learnpress_coaching-footer-three'){
	   $learnpress_coaching_custom_css .='.footer-wp {';
		   $learnpress_coaching_custom_css .='background: #0A0A1F !important;;';
	   $learnpress_coaching_custom_css .='}';
   }
   else if($learnpress_coaching_theme_lay == 'learnpress_coaching-footer-four'){
	   $learnpress_coaching_custom_css .='.footer-wp {';
		   $learnpress_coaching_custom_css .='background: #F5F5DC !important;;';
	   $learnpress_coaching_custom_css .='}';
	   $learnpress_coaching_custom_css .='.footer-wp p,.footer-wp span,.footer-wp li a,.footer-wp #wp-calendar caption,.footer-wp #wp-calendar td,.footer-wp #wp-calendar th, .footer-wp, .footer-wp h3, .footer-wp a.rsswidget, .footer-wp #wp-calendar a, .copyright a, .footer-wp .custom_details, .footer-wp ins span, .footer-wp .tagcloud a, .main-inner-box span.entry-date a, nav.woocommerce-MyAccount-navigation ul li:hover a, .footer-wp ul li a, .footer-wp table, .footer-wp th, .footer-wp td, .footer-wp caption, #sidebar caption,.footer-wp nav.wp-calendar-nav a,.footer-wp .search-form .search-field, .footer-wp .rssSummary, .footer-wp ul li{';
		   $learnpress_coaching_custom_css .='color:#000 !important;';
	   $learnpress_coaching_custom_css .='}';
	   $learnpress_coaching_custom_css .='.footer-wp p{';
		   $learnpress_coaching_custom_css .='color:#000 !important;';
	   $learnpress_coaching_custom_css .='}';
	   $learnpress_coaching_custom_css .='.footer-wp ul li::before{';
		   $learnpress_coaching_custom_css .='background:#000;';
	   $learnpress_coaching_custom_css .='}';
	   $learnpress_coaching_custom_css .='.footer-wp table, .footer-wp th, .footer-wp td,.footer-wp.search-form .search-field,.footer-wp .tagcloud a{';
		   $learnpress_coaching_custom_css .='border: 1px solid #000;';
	   $learnpress_coaching_custom_css .='}';
   }
   else if($learnpress_coaching_theme_lay == 'learnpress_coaching-footer-five'){
   $learnpress_coaching_custom_css .='.footer-wp {';
	   $learnpress_coaching_custom_css .='background: #333333 !important;;';
   $learnpress_coaching_custom_css .='}';
  }	

	// footer heading font size
	$learnpress_coaching_footer_heading_font_size = get_theme_mod('learnpress_coaching_footer_heading_font_size');
	$learnpress_coaching_custom_css .='.footer-wp h3{';
		$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_footer_heading_font_size).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_footer_text_tranform','Capitalize');
    if($learnpress_coaching_theme_lay == 'Uppercase'){
		$learnpress_coaching_custom_css .='.footer-wp h3{';
			$learnpress_coaching_custom_css .='text-transform: Uppercase;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Lowercase'){
		$learnpress_coaching_custom_css .='.footer-wp h3{';
			$learnpress_coaching_custom_css .='text-transform: Lowercase;';
		$learnpress_coaching_custom_css .='}';
	}
	else if($learnpress_coaching_theme_lay == 'Capitalize'){
		$learnpress_coaching_custom_css .='.footer-wp h3{';
			$learnpress_coaching_custom_css .='text-transform: Capitalize;';
		$learnpress_coaching_custom_css .='}';
	}

	// letter spacing
	$learnpress_coaching_footer_heading_letter_spacing = get_theme_mod('learnpress_coaching_footer_heading_letter_spacing');
	$learnpress_coaching_custom_css .='.footer-wp h3{';
	$learnpress_coaching_custom_css .='letter-spacing: '.esc_attr($learnpress_coaching_footer_heading_letter_spacing).'px;';
	$learnpress_coaching_custom_css .='}';	

	$learnpress_coaching_footer_heading_font_weight = get_theme_mod( 'learnpress_coaching_footer_heading_font_weight','500');
	if($learnpress_coaching_footer_heading_font_weight != ''){
		$learnpress_coaching_custom_css .='.footer-wp h3, .footer-wp .wp-block-heading{';
			$learnpress_coaching_custom_css .='font-weight: '.esc_attr($learnpress_coaching_footer_heading_font_weight).';';
		$learnpress_coaching_custom_css .='}';
	}

	// footer padding
	$learnpress_coaching_footer_padding = get_theme_mod('learnpress_coaching_footer_padding');
	$learnpress_coaching_custom_css .='.footer-wp{';
		$learnpress_coaching_custom_css .='padding: '.esc_attr($learnpress_coaching_footer_padding).'px !important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_copyright_text_font_size = get_theme_mod('learnpress_coaching_copyright_text_font_size', 15);
	$learnpress_coaching_custom_css .='.copyright-wrapper p, .copyright-wrapper a{';
		$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_copyright_text_font_size).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_footer_heading = get_theme_mod( 'learnpress_coaching_footer_heading','Left');
    if($learnpress_coaching_footer_heading == 'Left'){
		$learnpress_coaching_custom_css .='.footer-wp h3, .footer-wp .wp-block-search .wp-block-search__label{';
		$learnpress_coaching_custom_css .='text-align: left;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_footer_heading == 'Center'){
		$learnpress_coaching_custom_css .='.footer-wp h3, .footer-wp .wp-block-search .wp-block-search__label{';
			$learnpress_coaching_custom_css .='text-align: center;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='.footer-wp h3:after, .footer-wp .wp-block-heading:after{';
			$learnpress_coaching_custom_css .='margin: 7px auto;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='
		@media screen and (max-width:767px) {
			.footer-wp h3, .footer-wp .wp-block-search .wp-block-search__label{';
				$learnpress_coaching_custom_css .='text-align: left;';
				$learnpress_coaching_custom_css .='}
			.footer-wp h3:after, .footer-wp .wp-block-heading:after{';
				$learnpress_coaching_custom_css .='margin: 7px 0 0;';
				$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_footer_heading == 'Right'){
		$learnpress_coaching_custom_css .='.footer-wp h3, .footer-wp .wp-block-search .wp-block-search__label{';
			$learnpress_coaching_custom_css .='text-align: right; padding-bottom: 25px;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='.footer-wp .widget, .footer-wp aside{';
			$learnpress_coaching_custom_css .='position: relative;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='.footer-wp h3:after, .footer-wp .wp-block-heading:after{';
			$learnpress_coaching_custom_css .='position: absolute; right: 0;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='
		@media screen and (max-width:767px) {
			.footer-wp h3, .footer-wp .wp-block-search .wp-block-search__label{';
				$learnpress_coaching_custom_css .='text-align: left;';
				$learnpress_coaching_custom_css .='}
			.footer-wp h3:after, .footer-wp .wp-block-heading:after{';
				$learnpress_coaching_custom_css .='left: 0;';
				$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_footer_content = get_theme_mod( 'learnpress_coaching_footer_content','Left');
    if($learnpress_coaching_footer_content == 'Left'){
		$learnpress_coaching_custom_css .='.footer-wp .widget,.footer-wp caption{';
		$learnpress_coaching_custom_css .='text-align: left;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_footer_content == 'Center'){
		$learnpress_coaching_custom_css .='.footer-wp .widget,.footer-wp caption{';
			$learnpress_coaching_custom_css .='text-align: center;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='
		@media screen and (max-width:767px) {
			.footer-wp .widget,.footer-wp caption{';
				$learnpress_coaching_custom_css .='text-align: left;';
				$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_footer_content == 'Right'){
		$learnpress_coaching_custom_css .='.footer-wp .widget,.footer-wp caption{';
			$learnpress_coaching_custom_css .='text-align: right;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='
		@media screen and (max-width:767px) {
			.footer-wp .widget,.footer-wp caption{';
				$learnpress_coaching_custom_css .='text-align: left;';
				$learnpress_coaching_custom_css .='} }';
	}
	
	//Footer social icons font size
	$learnpress_coaching_footer_social_icons_size = get_theme_mod('learnpress_coaching_footer_social_icons_size', 15);
	$learnpress_coaching_custom_css .='.copyright-wrapper a i{';
		$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_footer_social_icons_size).'px;';
	$learnpress_coaching_custom_css .='}';	

	//Footer Social Icon Alignment
	$learnpress_coaching_footer_icon_alignment = get_theme_mod( 'learnpress_coaching_footer_icon_alignment','center');
    if($learnpress_coaching_footer_icon_alignment == 'left'){
		$learnpress_coaching_custom_css .='footer .socialicons{';
			$learnpress_coaching_custom_css .='text-align:left !important;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_footer_icon_alignment == 'center'){
		$learnpress_coaching_custom_css .='footer .socialicons{';
			$learnpress_coaching_custom_css .='text-align:center !important;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_footer_icon_alignment == 'right'){
		$learnpress_coaching_custom_css .='footer .socialicons{';
			$learnpress_coaching_custom_css .='text-align:right !important;';
		$learnpress_coaching_custom_css .='}';
	}		

	//Footer Social Icon Top Bottom padding 
	$learnpress_coaching_footer_icon_to_top_padding = get_theme_mod('learnpress_coaching_footer_icon_to_top_padding');
	$learnpress_coaching_custom_css .='footer .socialicons a i{';
	$learnpress_coaching_custom_css .='padding-top: '.esc_attr($learnpress_coaching_footer_icon_to_top_padding).'px;!important;';
	$learnpress_coaching_custom_css .='padding-bottom: '.esc_attr($learnpress_coaching_footer_icon_to_top_padding).'px;!important;';
	$learnpress_coaching_custom_css .='}';

	//Social icon color
	$learnpress_coaching_social_icon_color = get_theme_mod('learnpress_coaching_social_icon_color');
	$learnpress_coaching_custom_css .='.social-icons i{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_social_icon_color).' !important;';
	$learnpress_coaching_custom_css .='}';  	

	/*------------- Back to Top  -------------------*/
	$learnpress_coaching_back_to_top_border_radius = get_theme_mod('learnpress_coaching_back_to_top_border_radius');
	$learnpress_coaching_custom_css .='#scrollbutton i{';
		$learnpress_coaching_custom_css .='border-radius: '.esc_attr($learnpress_coaching_back_to_top_border_radius).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_scroll_icon_font_size = get_theme_mod('learnpress_coaching_scroll_icon_font_size', 22);
	$learnpress_coaching_custom_css .='#scrollbutton i{';
		$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_scroll_icon_font_size).'px;';
	$learnpress_coaching_custom_css .='}';

	// back to top icon color
	$learnpress_coaching_scroll_icon_color = get_theme_mod('learnpress_coaching_scroll_icon_color');
	if($learnpress_coaching_scroll_icon_color != false){
		$learnpress_coaching_custom_css .='#scrollbutton i{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_scroll_icon_color).';';
		$learnpress_coaching_custom_css .='}';
	}

	// back to top icon hover color
	$learnpress_coaching_scroll_icon_hover_color = get_theme_mod('learnpress_coaching_scroll_icon_hover_color');
	if($learnpress_coaching_scroll_icon_hover_color != false){
		$learnpress_coaching_custom_css .='#scrollbutton i:hover{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_scroll_icon_hover_color).';';
		$learnpress_coaching_custom_css .='}';
	}

	// back to top bg color
	$learnpress_coaching_scroll_icon_bg_color = get_theme_mod('learnpress_coaching_scroll_icon_bg_color');
	if($learnpress_coaching_scroll_icon_bg_color != false){
		$learnpress_coaching_custom_css .='#scrollbutton i{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_scroll_icon_bg_color).';';
			$learnpress_coaching_custom_css .='border-color: '.esc_attr($learnpress_coaching_scroll_icon_bg_color).';';
		$learnpress_coaching_custom_css .='}';
	}

	// back to top bg hover color
	$learnpress_coaching_scroll_icon_bg_hover_color = get_theme_mod('learnpress_coaching_scroll_icon_bg_hover_color');
	if($learnpress_coaching_scroll_icon_bg_hover_color != false){
		$learnpress_coaching_custom_css .='#scrollbutton i:hover{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_scroll_icon_bg_hover_color).';';
			$learnpress_coaching_custom_css .='border-color: '.esc_attr($learnpress_coaching_scroll_icon_bg_hover_color).';';
		$learnpress_coaching_custom_css .='}';
	}

	$learnpress_coaching_top_bottom_scroll_padding = get_theme_mod('learnpress_coaching_top_bottom_scroll_padding', 12);
	$learnpress_coaching_custom_css .='#scrollbutton i{';
		$learnpress_coaching_custom_css .='padding-top: '.esc_attr($learnpress_coaching_top_bottom_scroll_padding).'px; padding-bottom: '.esc_attr($learnpress_coaching_top_bottom_scroll_padding).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_left_right_scroll_padding = get_theme_mod('learnpress_coaching_left_right_scroll_padding', 17);
	$learnpress_coaching_custom_css .='#scrollbutton i{';
		$learnpress_coaching_custom_css .='padding-left: '.esc_attr($learnpress_coaching_left_right_scroll_padding).'px; padding-right: '.esc_attr($learnpress_coaching_left_right_scroll_padding).'px;';
	$learnpress_coaching_custom_css .='}';

	//First Cap
	$learnpress_coaching_show_first_caps = get_theme_mod('learnpress_coaching_show_first_caps', 'false');
	if($learnpress_coaching_show_first_caps == 'true' ){
	$learnpress_coaching_custom_css .='.blog-section .mainbox .new-text p:nth-of-type(1)::first-letter{';
	$learnpress_coaching_custom_css .=' font-size: 55px; font-weight: 600;';
	$learnpress_coaching_custom_css .=' margin-right: 6px;';
	$learnpress_coaching_custom_css .=' line-height: 1;';
	$learnpress_coaching_custom_css .='}';
	}elseif($learnpress_coaching_show_first_caps == 'false' ){
	$learnpress_coaching_custom_css .='.blog-section .mainbox .new-text p:nth-of-type(1)::first-letter {';
	$learnpress_coaching_custom_css .='display: none;';
	$learnpress_coaching_custom_css .='}';
	}

	/*-------------- Post Button -------------------*/

	$learnpress_coaching_btn_font_size_option = get_theme_mod('learnpress_coaching_btn_font_size_option');
	$learnpress_coaching_custom_css .='.postbtn a{';
		$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_btn_font_size_option).'px !important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_button_text_tranform','Capitalize');
    if($learnpress_coaching_theme_lay == 'Uppercase'){
		$learnpress_coaching_custom_css .='.postbtn a{';
			$learnpress_coaching_custom_css .='text-transform: uppercase;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Lowercase'){
		$learnpress_coaching_custom_css .='.postbtn a{';
			$learnpress_coaching_custom_css .='text-transform: lowercase;';
		$learnpress_coaching_custom_css .='}';
	}
	else if($learnpress_coaching_theme_lay == 'Capitalize'){
		$learnpress_coaching_custom_css .='.postbtn a{';
			$learnpress_coaching_custom_css .='text-transform: capitalize;';
		$learnpress_coaching_custom_css .='}';
	}

	// button font weight
	$learnpress_coaching_button_font_weight = get_theme_mod( 'learnpress_coaching_button_font_weight','600');
	if($learnpress_coaching_button_font_weight != ''){
		$learnpress_coaching_custom_css .='.postbtn a{';
			$learnpress_coaching_custom_css .='font-weight: '.esc_attr($learnpress_coaching_button_font_weight).';';
		$learnpress_coaching_custom_css .='}';
	}

	// button letter spacing
	$learnpress_coaching_button_letter_spacing = get_theme_mod('learnpress_coaching_button_letter_spacing', '0');
	$learnpress_coaching_custom_css .='.postbtn a {';
		$learnpress_coaching_custom_css .='letter-spacing: '.esc_attr($learnpress_coaching_button_letter_spacing).'px;';
	$learnpress_coaching_custom_css .='}';			

	$learnpress_coaching_post_button_padding_top = get_theme_mod('learnpress_coaching_post_button_padding_top');
	$learnpress_coaching_custom_css .='.postbtn a, #comments input[type="submit"].submit{';
		$learnpress_coaching_custom_css .='padding-top: '.esc_attr($learnpress_coaching_post_button_padding_top).'px; padding-bottom: '.esc_attr($learnpress_coaching_post_button_padding_top).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_post_button_padding_right = get_theme_mod('learnpress_coaching_post_button_padding_right');
	$learnpress_coaching_custom_css .='.postbtn a, #comments input[type="submit"].submit{';
		$learnpress_coaching_custom_css .='padding-left: '.esc_attr($learnpress_coaching_post_button_padding_right).'px; padding-right: '.esc_attr($learnpress_coaching_post_button_padding_right).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_post_button_border_radius = get_theme_mod('learnpress_coaching_post_button_border_radius');
	$learnpress_coaching_custom_css .='.postbtn a, #comments input[type="submit"].submit,.postbtn a:hover{';
		$learnpress_coaching_custom_css .='border-radius: '.esc_attr($learnpress_coaching_post_button_border_radius).'px;';
	$learnpress_coaching_custom_css .='}';

	//Button Shape
	$learnpress_coaching_btn_shape = get_theme_mod('learnpress_coaching_btn_shape', 'Round');
	if($learnpress_coaching_btn_shape == 'Square' ){
		$learnpress_coaching_custom_css .='.inner-service .mainbox .postbtn a{';
			$learnpress_coaching_custom_css .=' border-radius: 0';
		$learnpress_coaching_custom_css .='}';
	}elseif($learnpress_coaching_btn_shape == 'Round' ){
		$learnpress_coaching_custom_css .='.inner-service .mainbox .postbtn a{';
			$learnpress_coaching_custom_css .=' border-radius: .3em';
		$learnpress_coaching_custom_css .='}';
	}elseif($learnpress_coaching_btn_shape == 'Pill' ){
		$learnpress_coaching_custom_css .='.inner-service .mainbox .postbtn a{';
			$learnpress_coaching_custom_css .=' border-radius: 2em;';
		$learnpress_coaching_custom_css .='}';
	}

	$learnpress_coaching_post_comment_enable = get_theme_mod('learnpress_coaching_post_comment_enable',true);
	if($learnpress_coaching_post_comment_enable == false){
		$learnpress_coaching_custom_css .='#comments{';
			$learnpress_coaching_custom_css .='display: none;';
		$learnpress_coaching_custom_css .='}';
	}

	// preloader background image
	$learnpress_coaching_preloader_bg_image = get_theme_mod('learnpress_coaching_preloader_bg_image');
	if($learnpress_coaching_preloader_bg_image != false){
		$learnpress_coaching_custom_css .='.frame{';
			$learnpress_coaching_custom_css .='background: url('.esc_attr($learnpress_coaching_preloader_bg_image).'); background-size: cover;';
		$learnpress_coaching_custom_css .='}';
	}

	/*----------- Preloader Color Option  ----------------*/
	$learnpress_coaching_preloader_bg_color_option = get_theme_mod('learnpress_coaching_preloader_bg_color_option');
	$learnpress_coaching_preloader_icon_color_option = get_theme_mod('learnpress_coaching_preloader_icon_color_option');
	$learnpress_coaching_custom_css .='.frame{';
		$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_preloader_bg_color_option).';';
	$learnpress_coaching_custom_css .='}';
	$learnpress_coaching_custom_css .='.dot-1,.dot-2,.dot-3{';
		$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_preloader_icon_color_option).';';
	$learnpress_coaching_custom_css .='}';

	// preloader type
	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_preloader_type','First Preloader Type');
    if($learnpress_coaching_theme_lay == 'First Preloader Type'){
		$learnpress_coaching_custom_css .='.dot-1, .dot-2, .dot-3{';
			$learnpress_coaching_custom_css .='';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Second Preloader Type'){
		$learnpress_coaching_custom_css .='.dot-1, .dot-2, .dot-3{';
			$learnpress_coaching_custom_css .='border-radius:0;';
		$learnpress_coaching_custom_css .='}';
	}

	/*------------------ Skin Option  -------------------*/
	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_background_skin','Without Background');
    if($learnpress_coaching_theme_lay == 'With Background'){
		$learnpress_coaching_custom_css .='.inner-service,#sidebar .widget,.woocommerce ul.products li.product, .woocommerce-page ul.products li.product,.front-page-content,.background-img-skin{';
			$learnpress_coaching_custom_css .='background-color: #fff; padding:20px;';
		$learnpress_coaching_custom_css .='}';
		$learnpress_coaching_custom_css .='.login-box a{';
			$learnpress_coaching_custom_css .='background-color: #fff;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Without Background'){
		$learnpress_coaching_custom_css .='{';
			$learnpress_coaching_custom_css .='background-color: transparent;';
		$learnpress_coaching_custom_css .='}';
	}

	/*-------------- Woocommerce Button  -------------------*/
	$learnpress_coaching_woocommerce_button_padding_top = get_theme_mod('learnpress_coaching_woocommerce_button_padding_top',15);
	$learnpress_coaching_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
		$learnpress_coaching_custom_css .='padding-top: '.esc_attr($learnpress_coaching_woocommerce_button_padding_top).'px; padding-bottom: '.esc_attr($learnpress_coaching_woocommerce_button_padding_top).'px;';
	$learnpress_coaching_custom_css .='}';


	$learnpress_coaching_woocommerce_button_padding_right = get_theme_mod('learnpress_coaching_woocommerce_button_padding_right',15);
	$learnpress_coaching_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
		$learnpress_coaching_custom_css .='padding-left: '.esc_attr($learnpress_coaching_woocommerce_button_padding_right).'px; padding-right: '.esc_attr($learnpress_coaching_woocommerce_button_padding_right).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_woocommerce_button_border_radius = get_theme_mod('learnpress_coaching_woocommerce_button_border_radius',6);
	$learnpress_coaching_custom_css .='.woocommerce ul.products li.product .button, a.checkout-button.button.alt.wc-forward,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
		$learnpress_coaching_custom_css .='border-radius: '.esc_attr($learnpress_coaching_woocommerce_button_border_radius).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_related_product_enable = get_theme_mod('learnpress_coaching_related_product_enable',true);
	if($learnpress_coaching_related_product_enable == false){
		$learnpress_coaching_custom_css .='.related.products{';
			$learnpress_coaching_custom_css .='display: none;';
		$learnpress_coaching_custom_css .='}';
	}

	$learnpress_coaching_woocommerce_product_border_enable = get_theme_mod('learnpress_coaching_woocommerce_product_border_enable',true);
	if($learnpress_coaching_woocommerce_product_border_enable == false){
		$learnpress_coaching_custom_css .='.products li{';
			$learnpress_coaching_custom_css .='border: none;';
		$learnpress_coaching_custom_css .='}';
	}

	$learnpress_coaching_woocommerce_product_padding_top = get_theme_mod('learnpress_coaching_woocommerce_product_padding_top',10);
	$learnpress_coaching_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$learnpress_coaching_custom_css .='padding-top: '.esc_attr($learnpress_coaching_woocommerce_product_padding_top).'px !important; padding-bottom: '.esc_attr($learnpress_coaching_woocommerce_product_padding_top).'px !important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_woocommerce_product_padding_right = get_theme_mod('learnpress_coaching_woocommerce_product_padding_right',10);
	$learnpress_coaching_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$learnpress_coaching_custom_css .='padding-left: '.esc_attr($learnpress_coaching_woocommerce_product_padding_right).'px !important; padding-right: '.esc_attr($learnpress_coaching_woocommerce_product_padding_right).'px !important;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_woocommerce_product_border_radius = get_theme_mod('learnpress_coaching_woocommerce_product_border_radius',3);
	$learnpress_coaching_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$learnpress_coaching_custom_css .='border-radius: '.esc_attr($learnpress_coaching_woocommerce_product_border_radius).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_woocommerce_product_box_shadow = get_theme_mod('learnpress_coaching_woocommerce_product_box_shadow', 5);
	$learnpress_coaching_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$learnpress_coaching_custom_css .='box-shadow: '.esc_attr($learnpress_coaching_woocommerce_product_box_shadow).'px '.esc_attr($learnpress_coaching_woocommerce_product_box_shadow).'px '.esc_attr($learnpress_coaching_woocommerce_product_box_shadow).'px #eee;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_woo_product_sale_top_bottom_padding = get_theme_mod('learnpress_coaching_woo_product_sale_top_bottom_padding', 0);
	$learnpress_coaching_woo_product_sale_left_right_padding = get_theme_mod('learnpress_coaching_woo_product_sale_left_right_padding', 0);
	$learnpress_coaching_custom_css .='.woocommerce span.onsale{';
		$learnpress_coaching_custom_css .='padding-top: '.esc_attr($learnpress_coaching_woo_product_sale_top_bottom_padding).'px; padding-bottom: '.esc_attr($learnpress_coaching_woo_product_sale_top_bottom_padding).'px; padding-left: '.esc_attr($learnpress_coaching_woo_product_sale_left_right_padding).'px; padding-right: '.esc_attr($learnpress_coaching_woo_product_sale_left_right_padding).'px; display:inline-block;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_woo_product_sale_border_radius = get_theme_mod('learnpress_coaching_woo_product_sale_border_radius',6);
	$learnpress_coaching_custom_css .='.woocommerce span.onsale {';
		$learnpress_coaching_custom_css .='border-radius: '.esc_attr($learnpress_coaching_woo_product_sale_border_radius).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_woo_product_sale_position = get_theme_mod('learnpress_coaching_woo_product_sale_position', 'Right');
	if($learnpress_coaching_woo_product_sale_position == 'Right' ){
		$learnpress_coaching_custom_css .='.woocommerce ul.products li.product .onsale{';
			$learnpress_coaching_custom_css .=' left:auto; right:0;';
		$learnpress_coaching_custom_css .='}';
	}elseif($learnpress_coaching_woo_product_sale_position == 'Left' ){
		$learnpress_coaching_custom_css .='.woocommerce ul.products li.product .onsale{';
			$learnpress_coaching_custom_css .=' left:0; right:auto;';
		$learnpress_coaching_custom_css .='}';
	}

	$learnpress_coaching_wooproduct_sale_font_size = get_theme_mod('learnpress_coaching_wooproduct_sale_font_size',14);
	$learnpress_coaching_custom_css .='.woocommerce span.onsale{';
		$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_wooproduct_sale_font_size).'px;';
	$learnpress_coaching_custom_css .='}';

	// Responsive Media
	$learnpress_coaching_post_date = get_theme_mod( 'learnpress_coaching_display_post_date',true);
	if($learnpress_coaching_post_date == true && get_theme_mod( 'learnpress_coaching_metafields_date',true) != true){
    	$learnpress_coaching_custom_css .='.metabox .entry-date{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_post_date == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='.metabox .entry-date{';
			$learnpress_coaching_custom_css .='display:inline-block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_post_date == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='.metabox .entry-date{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_post_author = get_theme_mod( 'learnpress_coaching_display_post_author',true);
	if($learnpress_coaching_post_author == true && get_theme_mod( 'learnpress_coaching_metafields_author',true) != true){
    	$learnpress_coaching_custom_css .='.metabox .entry-author{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_post_author == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='.metabox .entry-author{';
			$learnpress_coaching_custom_css .='display:inline-block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_post_author == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='.metabox .entry-author{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_post_comment = get_theme_mod( 'learnpress_coaching_display_post_comment',true);
	if($learnpress_coaching_post_comment == true && get_theme_mod( 'learnpress_coaching_metafields_comment',true) != true){
    	$learnpress_coaching_custom_css .='.metabox .entry-comments{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_post_comment == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='.metabox .entry-comments{';
			$learnpress_coaching_custom_css .='display:inline-block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_post_comment == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='.metabox .entry-comments{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_post_time = get_theme_mod( 'learnpress_coaching_display_post_time',true);
	if($learnpress_coaching_post_time == true && get_theme_mod( 'learnpress_coaching_metafields_time',true) != true){
    	$learnpress_coaching_custom_css .='.metabox .entry-time{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_post_time == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='.metabox .entry-time{';
			$learnpress_coaching_custom_css .='display:inline-block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_post_time == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='.metabox .entry-time{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	if($learnpress_coaching_post_date == false && $learnpress_coaching_post_author == false && $learnpress_coaching_post_comment == false && $learnpress_coaching_post_time == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
    	$learnpress_coaching_custom_css .='.metabox {';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_metafields_date = get_theme_mod( 'learnpress_coaching_metafields_date',true);
	$learnpress_coaching_metafields_author = get_theme_mod( 'learnpress_coaching_metafields_author',true);
	$learnpress_coaching_metafields_comment = get_theme_mod( 'learnpress_coaching_metafields_comment',true);
	$learnpress_coaching_metafields_time = get_theme_mod( 'learnpress_coaching_metafields_time',true);
	if($learnpress_coaching_metafields_date == false && $learnpress_coaching_metafields_author == false && $learnpress_coaching_metafields_comment == false && $learnpress_coaching_metafields_time == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width: 1440px) and (min-width:576px) {';
    	$learnpress_coaching_custom_css .='.metabox {';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_slider = get_theme_mod( 'learnpress_coaching_display_slider',false);
	if($learnpress_coaching_slider == true && get_theme_mod( 'learnpress_coaching_slider_hide', false) == false){
    	$learnpress_coaching_custom_css .='#slider{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_slider == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='#slider{';
			$learnpress_coaching_custom_css .='display:block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_slider == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='#slider{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_sidebar = get_theme_mod( 'learnpress_coaching_display_sidebar',true);
    if($learnpress_coaching_sidebar == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='#sidebar{';
			$learnpress_coaching_custom_css .='display:block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_sidebar == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='#sidebar{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_scroll = get_theme_mod( 'learnpress_coaching_display_scrolltop',true);
	if($learnpress_coaching_scroll == true && get_theme_mod( 'learnpress_coaching_hide_show_scroll',true) != true){
    	$learnpress_coaching_custom_css .='#scrollbutton i{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_scroll == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='#scrollbutton i{';
			$learnpress_coaching_custom_css .='display:block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_scroll == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='#scrollbutton i{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_preloader = get_theme_mod( 'learnpress_coaching_display_preloader',false);
	if($learnpress_coaching_preloader == true && get_theme_mod( 'learnpress_coaching_preloader',false) != true){
    	$learnpress_coaching_custom_css .='.frame{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_preloader == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='.frame{';
			$learnpress_coaching_custom_css .='display:block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_preloader == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='.frame{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_search = get_theme_mod( 'learnpress_coaching_display_search_category',true);
	if($learnpress_coaching_search == true && get_theme_mod( 'learnpress_coaching_search_enable_disable',true) != true){
    	$learnpress_coaching_custom_css .='.search-cat-box{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_search == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='.search-cat-box{';
			$learnpress_coaching_custom_css .='display:block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_search == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='.search-cat-box{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	$learnpress_coaching_myaccount = get_theme_mod( 'learnpress_coaching_display_myaccount',true);
	if($learnpress_coaching_myaccount == true && get_theme_mod( 'learnpress_coaching_myaccount_enable_disable',true) != true){
    	$learnpress_coaching_custom_css .='.login-box{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_myaccount == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='.login-box{';
			$learnpress_coaching_custom_css .='display:block;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_myaccount == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='.login-box{';
			$learnpress_coaching_custom_css .='display:none;';
		$learnpress_coaching_custom_css .='} }';
	}

	// menu settings
	$learnpress_coaching_menu_font_size_option = get_theme_mod('learnpress_coaching_menu_font_size_option',14);
	$learnpress_coaching_custom_css .='.primary-navigation a, .primary-navigation ul li a{';
		$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_menu_font_size_option).'px;';
	$learnpress_coaching_custom_css .='}';

	// menu top-bottom padding
	$learnpress_coaching_menu_top_bottom_padding = get_theme_mod('learnpress_coaching_menu_top_bottom_padding');
	$learnpress_coaching_custom_css .='.primary-navigation li{';
		$learnpress_coaching_custom_css .='padding-top: '.esc_attr($learnpress_coaching_menu_top_bottom_padding).'px;';
		$learnpress_coaching_custom_css .='padding-bottom: '.esc_attr($learnpress_coaching_menu_top_bottom_padding).'px;';
	$learnpress_coaching_custom_css .='}';

	// menu left-right padding
	$learnpress_coaching_menu_left_right_padding = get_theme_mod('learnpress_coaching_menu_left_right_padding');
	$learnpress_coaching_custom_css .='.primary-navigation li{';
		$learnpress_coaching_custom_css .='padding-left: '.esc_attr($learnpress_coaching_menu_left_right_padding).'px;';
		$learnpress_coaching_custom_css .='padding-right: '.esc_attr($learnpress_coaching_menu_left_right_padding).'px;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_theme_lay = get_theme_mod( 'learnpress_coaching_text_tranform_menu','Capitalize');
    if($learnpress_coaching_theme_lay == 'Uppercase'){
		$learnpress_coaching_custom_css .='.primary-navigation a, .primary-navigation ul li a{';
			$learnpress_coaching_custom_css .='text-transform: uppercase;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_theme_lay == 'Lowercase'){
		$learnpress_coaching_custom_css .='.primary-navigation a, .primary-navigation ul li a{';
			$learnpress_coaching_custom_css .='text-transform: lowercase;';
		$learnpress_coaching_custom_css .='}';
	}
	else if($learnpress_coaching_theme_lay == 'Capitalize'){
		$learnpress_coaching_custom_css .='.primary-navigation a, .primary-navigation ul li a{';
			$learnpress_coaching_custom_css .='text-transform: capitalize;';
		$learnpress_coaching_custom_css .='}';
	}

	// menu font weight
	$learnpress_coaching_font_weight_option_menu = get_theme_mod( 'learnpress_coaching_font_weight_option_menu','500');
	if($learnpress_coaching_font_weight_option_menu != ''){
		$learnpress_coaching_custom_css .='.primary-navigation a, .primary-navigation ul li a{';
			$learnpress_coaching_custom_css .='font-weight: '.esc_attr($learnpress_coaching_font_weight_option_menu).';';
		$learnpress_coaching_custom_css .='}';
	}

	// Menu Item Hover Style	
	$learnpress_coaching_menus_item = get_theme_mod( 'learnpress_coaching_menus_item_style','None');
	if($learnpress_coaching_menus_item == 'None'){
		$learnpress_coaching_custom_css .='.primary-navigation ul li a{';
			$learnpress_coaching_custom_css .='';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_menus_item == 'Zoom In'){
		$learnpress_coaching_custom_css .='.primary-navigation ul li a:hover{';
			$learnpress_coaching_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important;';
		$learnpress_coaching_custom_css .='}';
	}

	// slider height
	$learnpress_coaching_option_slider_height = get_theme_mod('learnpress_coaching_option_slider_height', 600);
	$learnpress_coaching_custom_css .='#slider img{';
		$learnpress_coaching_custom_css .='height: '.esc_attr($learnpress_coaching_option_slider_height).'px;';
	$learnpress_coaching_custom_css .='}';

	// slider content spacing
	$learnpress_coaching_slider_content_top_padding = get_theme_mod('learnpress_coaching_slider_content_top_padding');
	$learnpress_coaching_slider_content_left_padding = get_theme_mod('learnpress_coaching_slider_content_left_padding');
	$learnpress_coaching_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .readbutton{';
		$learnpress_coaching_custom_css .='top: '.esc_attr($learnpress_coaching_slider_content_top_padding).'%; bottom: '.esc_attr($learnpress_coaching_slider_content_top_padding).'%;left: '.esc_attr($learnpress_coaching_slider_content_left_padding).'%;right: '.esc_attr($learnpress_coaching_slider_content_left_padding).'%;';
	$learnpress_coaching_custom_css .='}';

	// slider overlay
	$learnpress_coaching_enable_slider_overlay = get_theme_mod('learnpress_coaching_enable_slider_overlay', true);
	if($learnpress_coaching_enable_slider_overlay == false){
		$learnpress_coaching_custom_css .='#slider image{';
			$learnpress_coaching_custom_css .='opacity:1;';
		$learnpress_coaching_custom_css .='}';
	}
	$learnpress_coaching_slider_overlay_color = get_theme_mod('learnpress_coaching_slider_overlay_color', true);
	if($learnpress_coaching_enable_slider_overlay != false){
		$learnpress_coaching_custom_css .='#slider{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_slider_overlay_color).';';
		$learnpress_coaching_custom_css .='}';
	}

	//  comment form width
	$learnpress_coaching_comment_form_width = get_theme_mod( 'learnpress_coaching_comment_form_width');
	$learnpress_coaching_custom_css .='#comments textarea{';
		$learnpress_coaching_custom_css .='width: '.esc_attr($learnpress_coaching_comment_form_width).'%;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_title_comment_form = get_theme_mod('learnpress_coaching_title_comment_form', 'Leave a Reply');
	if($learnpress_coaching_title_comment_form == ''){
		$learnpress_coaching_custom_css .='#comments h2#reply-title {';
			$learnpress_coaching_custom_css .='display: none;';
		$learnpress_coaching_custom_css .='}';
	}

	$learnpress_coaching_comment_form_button_content = get_theme_mod('learnpress_coaching_comment_form_button_content', 'Post Comment');
	if($learnpress_coaching_comment_form_button_content == ''){
		$learnpress_coaching_custom_css .='#comments p.form-submit {';
			$learnpress_coaching_custom_css .='display: none;';
		$learnpress_coaching_custom_css .='}';
	}

	// featured image setting
	$learnpress_coaching_image_border_radius = get_theme_mod('learnpress_coaching_image_border_radius', 0);
	$learnpress_coaching_custom_css .='.layout2 .box-image img,.layout1 .box-image img,.layout3 .box-image img{';
		$learnpress_coaching_custom_css .='border-radius: '.esc_attr($learnpress_coaching_image_border_radius).'%;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_image_box_shadow = get_theme_mod('learnpress_coaching_image_box_shadow',0);
	$learnpress_coaching_custom_css .='.layout2 .box-image img,.layout1 .box-image img,.layout3 .box-image img{';
		$learnpress_coaching_custom_css .='box-shadow: '.esc_attr($learnpress_coaching_image_box_shadow).'px '.esc_attr($learnpress_coaching_image_box_shadow).'px '.esc_attr($learnpress_coaching_image_box_shadow).'px #b5b5b5;';
	$learnpress_coaching_custom_css .='}';

	// blog post Pagination Alignment
	$learnpress_coaching_post_pagination_alignment = get_theme_mod( 'learnpress_coaching_post_pagination_option','Left');
	if($learnpress_coaching_post_pagination_alignment == 'Left'){
		$learnpress_coaching_custom_css .='.navigation nav.pagination{';
			$learnpress_coaching_custom_css .='justify-content: left;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_post_pagination_alignment == 'Center'){
		$learnpress_coaching_custom_css .='.navigation nav.pagination{';
			$learnpress_coaching_custom_css .='justify-content: center;';
		$learnpress_coaching_custom_css .='}';
	}else if($learnpress_coaching_post_pagination_alignment == 'Right'){
		$learnpress_coaching_custom_css .='.navigation nav.pagination{';
			$learnpress_coaching_custom_css .='justify-content: right;';
		$learnpress_coaching_custom_css .='}';
	}

	// grid post image setting
	$learnpress_coaching_grid_image_border_radius = get_theme_mod('learnpress_coaching_grid_image_border_radius', 0);
	$learnpress_coaching_custom_css .='.gridbox .inner-service .box-image img{';
		$learnpress_coaching_custom_css .='border-radius: '.esc_attr($learnpress_coaching_grid_image_border_radius).'%;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_grid_image_box_shadow = get_theme_mod('learnpress_coaching_grid_image_box_shadow',0);
	$learnpress_coaching_custom_css .='.gridbox .inner-service .box-image img{';
		$learnpress_coaching_custom_css .='box-shadow: '.esc_attr($learnpress_coaching_grid_image_box_shadow).'px '.esc_attr($learnpress_coaching_grid_image_box_shadow).'px '.esc_attr($learnpress_coaching_grid_image_box_shadow).'px #b5b5b5;';
	$learnpress_coaching_custom_css .='}';

	// single featured image setting
	$learnpress_coaching_single_image_border_radius = get_theme_mod('learnpress_coaching_single_image_border_radius', 0);
	$learnpress_coaching_custom_css .='.feature-box img{';
		$learnpress_coaching_custom_css .='border-radius: '.esc_attr($learnpress_coaching_single_image_border_radius).'%;';
	$learnpress_coaching_custom_css .='}';

	$learnpress_coaching_single_image_box_shadow = get_theme_mod('learnpress_coaching_single_image_box_shadow',0);
	$learnpress_coaching_custom_css .='.feature-box img{';
		$learnpress_coaching_custom_css .='box-shadow: '.esc_attr($learnpress_coaching_single_image_box_shadow).'px '.esc_attr($learnpress_coaching_single_image_box_shadow).'px '.esc_attr($learnpress_coaching_single_image_box_shadow).'px #b5b5b5;';
	$learnpress_coaching_custom_css .='}';

	// single featured image dimention
	$learnpress_coaching_single_post_featured_image_dimention = get_theme_mod('learnpress_coaching_single_post_featured_image_dimention', 'Default');
	$learnpress_coaching_single_post_featured_image_custom_width = get_theme_mod('learnpress_coaching_single_post_featured_image_custom_width');
	$learnpress_coaching_single_post_featured_image_custom_height = get_theme_mod('learnpress_coaching_single_post_featured_image_custom_height');
	if($learnpress_coaching_single_post_featured_image_dimention == 'Custom'){
		$learnpress_coaching_custom_css .='.single-post-page .feature-box img{';
			$learnpress_coaching_custom_css .='width: '.esc_attr($learnpress_coaching_single_post_featured_image_custom_width).'px!important; height: '.esc_attr($learnpress_coaching_single_post_featured_image_custom_height).'px!important;';
		$learnpress_coaching_custom_css .='}';
	}

	// category color
	$learnpress_coaching_category_color = get_theme_mod('learnpress_coaching_category_color');
	$learnpress_coaching_custom_css .='.type-post .category ul li a{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_category_color).';';
	$learnpress_coaching_custom_css .='}';

	// category hover color
	$learnpress_coaching_category_hover_color = get_theme_mod('learnpress_coaching_category_hover_color');
	$learnpress_coaching_custom_css .='.type-post .category ul li a:hover{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_category_hover_color).';';
	$learnpress_coaching_custom_css .='}';

	// Post Block
	$learnpress_coaching_post_block_option = get_theme_mod( 'learnpress_coaching_post_block_option','By Block');
    if($learnpress_coaching_post_block_option == 'By Without Block'){
		$learnpress_coaching_custom_css .='.related-inner-box, .mainbox-post, .layout2 .mainbox,.layout3.mainbox, .layout1.mainbox, .post_format-post-format-video,.post_format-post-format-image,.post_format-post-format-audio, .post_format-post-format-gallery{';
			$learnpress_coaching_custom_css .='border:none; margin:30px 0;';
		$learnpress_coaching_custom_css .='}';
	}

	//Grid Post Block
	$learnpress_coaching_grid_post_block_option = get_theme_mod( 'learnpress_coaching_grid_post_block_option','By Block');
    if($learnpress_coaching_grid_post_block_option == 'By Without Block'){
		$learnpress_coaching_custom_css .='.gridbox .inner-service {';
			$learnpress_coaching_custom_css .='border:none; margin:30px 0;';
		$learnpress_coaching_custom_css .='}';
	}

	// post image
	$learnpress_coaching_post_featured_color = get_theme_mod('learnpress_coaching_post_featured_color', 'var(--first-theme-color)');
	$learnpress_coaching_post_featured_image = get_theme_mod('learnpress_coaching_post_featured_image','Image');
	if($learnpress_coaching_post_featured_image == 'Color'){
		$learnpress_coaching_custom_css .='.post-color{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_post_featured_color).';';
		$learnpress_coaching_custom_css .='}';
	}

	// featured image dimention
	$learnpress_coaching_post_featured_image_dimention = get_theme_mod('learnpress_coaching_post_featured_image_dimention', 'Default');
	$learnpress_coaching_post_featured_image_custom_width = get_theme_mod('learnpress_coaching_post_featured_image_custom_width');
	$learnpress_coaching_post_featured_image_custom_height = get_theme_mod('learnpress_coaching_post_featured_image_custom_height');
	if($learnpress_coaching_post_featured_image_dimention == 'Custom'){
		$learnpress_coaching_custom_css .='.box-image img{';
			$learnpress_coaching_custom_css .='width: '.esc_attr($learnpress_coaching_post_featured_image_custom_width).'px; height: '.esc_attr($learnpress_coaching_post_featured_image_custom_height).'px;';
		$learnpress_coaching_custom_css .='}';
	}

	// featured image dimention
	$learnpress_coaching_custom_post_color_width = get_theme_mod('learnpress_coaching_custom_post_color_width');
	$learnpress_coaching_custom_post_color_height = get_theme_mod('learnpress_coaching_custom_post_color_height');
	if($learnpress_coaching_post_featured_image == 'Color'){
		$learnpress_coaching_custom_css .='.post-color{';
			$learnpress_coaching_custom_css .='width: '.esc_attr($learnpress_coaching_custom_post_color_width).'px; height: '.esc_attr($learnpress_coaching_custom_post_color_height).'px;';
		$learnpress_coaching_custom_css .='}';
	}

	// site title font size
	$learnpress_coaching_site_title_font_size = get_theme_mod('learnpress_coaching_site_title_font_size', 30);
	$learnpress_coaching_custom_css .='.logo h1, .site-title a, .logo .site-title a{';
	$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_site_title_font_size).'px;';
	$learnpress_coaching_custom_css .='}';

	// site tagline font size
	$learnpress_coaching_site_tagline_font_size = get_theme_mod('learnpress_coaching_site_tagline_font_size', 15);
	$learnpress_coaching_custom_css .='p.site-description{';
	$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_site_tagline_font_size).'px;';
	$learnpress_coaching_custom_css .='}';

	// site logo padding
	$learnpress_coaching_logo_padding = get_theme_mod('learnpress_coaching_logo_padding', '');
	$learnpress_coaching_custom_css .='.logo{';
	$learnpress_coaching_custom_css .='padding: '.esc_attr($learnpress_coaching_logo_padding).'px !important;';
	$learnpress_coaching_custom_css .='}';

	// woocommerce Product Navigation
	$learnpress_coaching_wooproducts_nav = get_theme_mod('learnpress_coaching_wooproducts_nav', 'Yes');
	if($learnpress_coaching_wooproducts_nav == 'No'){
		$learnpress_coaching_custom_css .='.woocommerce nav.woocommerce-pagination{';
			$learnpress_coaching_custom_css .='display: none;';
		$learnpress_coaching_custom_css .='}';
	}

	/*------ copyright text color -------*/
	$learnpress_coaching_footer_text_color = get_theme_mod('learnpress_coaching_footer_text_color');
	if($learnpress_coaching_footer_text_color != false){
		$learnpress_coaching_custom_css .='.copyright-wrapper p, .copyright-wrapper p a{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_footer_text_color).';';
		$learnpress_coaching_custom_css .='}';
	}

	/*------ copyright background css -------*/
	$learnpress_coaching_footer_text_bg_color = get_theme_mod('learnpress_coaching_footer_text_bg_color');
	if($learnpress_coaching_footer_text_bg_color != false){
		$learnpress_coaching_custom_css .='.copyright-wrapper{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_footer_text_bg_color).';';
		$learnpress_coaching_custom_css .='}';
	}

	// social icons font size
	$learnpress_coaching_social_icons_size = get_theme_mod('learnpress_coaching_social_icons_size', 13);
	$learnpress_coaching_custom_css .='.social-icons i{';
		$learnpress_coaching_custom_css .='font-size: '.esc_attr($learnpress_coaching_social_icons_size).'px;';
	$learnpress_coaching_custom_css .='}';

	// site toggle button color
	$learnpress_coaching_toggle_button_color = get_theme_mod('learnpress_coaching_toggle_button_color');
	$learnpress_coaching_custom_css .='.toggle-menu i{';
		$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_toggle_button_color).' !important;';
	$learnpress_coaching_custom_css .='}';

	// menu color
	$learnpress_coaching_menu_color = get_theme_mod('learnpress_coaching_menu_color');
	$learnpress_coaching_custom_css .='.primary-navigation a, .primary-navigation ul li a{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_menu_color).' !important;';
	$learnpress_coaching_custom_css .='}';

	// Sub menu color
	$learnpress_coaching_sub_menu_color = get_theme_mod('learnpress_coaching_sub_menu_color');
	$learnpress_coaching_custom_css .='.primary-navigation ul.sub-menu a, .primary-navigation ul.sub-menu li a{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_sub_menu_color).' !important;';
	$learnpress_coaching_custom_css .='}';

	// menu hover color
	$learnpress_coaching_menu_hover_color = get_theme_mod('learnpress_coaching_menu_hover_color');
	$learnpress_coaching_custom_css .='.primary-navigation a:hover, .primary-navigation ul li a:hover{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_menu_hover_color).' !important;';
	$learnpress_coaching_custom_css .='}';

	// submenu hover color
	$learnpress_coaching_sub_menu_hover_color = get_theme_mod('learnpress_coaching_sub_menu_hover_color');
	$learnpress_coaching_custom_css .='.primary-navigation a:hover, .primary-navigation ul.sub-menu li a:hover{';
			$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_sub_menu_hover_color).' !important;';
	$learnpress_coaching_custom_css .='}';

	// Sub menu bg color
	$learnpress_coaching_sub_menu_bg_color = get_theme_mod('learnpress_coaching_sub_menu_bg_color');
	$learnpress_coaching_custom_css .='.primary-navigation ul.sub-menu li a{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_sub_menu_bg_color).';';
	$learnpress_coaching_custom_css .='}';

	// Sub menu bg hover color
	$learnpress_coaching_sub_menu_bg_hover_color = get_theme_mod('learnpress_coaching_sub_menu_bg_hover_color');
	$learnpress_coaching_custom_css .='.primary-navigation ul.sub-menu li a:hover{';
			$learnpress_coaching_custom_css .='background-color: '.esc_attr($learnpress_coaching_sub_menu_bg_hover_color).';';
	$learnpress_coaching_custom_css .='}';

	// site title color
	$learnpress_coaching_site_title_color = get_theme_mod('learnpress_coaching_site_title_color');
	$learnpress_coaching_custom_css .='.logo h1 a, .logo p.site-title a{';
		$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_site_title_color).' !important;';
	$learnpress_coaching_custom_css .='}';

	// site tagline color
	$learnpress_coaching_site_tagline_color = get_theme_mod('learnpress_coaching_site_tagline_color');
	$learnpress_coaching_custom_css .='.logo p.site-description{';
		$learnpress_coaching_custom_css .='color: '.esc_attr($learnpress_coaching_site_tagline_color).' !important;';
	$learnpress_coaching_custom_css .='}';

	// site logo margin
	$learnpress_coaching_logo_margin = get_theme_mod('learnpress_coaching_logo_margin', '');
	$learnpress_coaching_custom_css .='.logo{';
	$learnpress_coaching_custom_css .='margin: '.esc_attr($learnpress_coaching_logo_margin).'px ;';
	$learnpress_coaching_custom_css .='}';

	// Fixed Copyright
	$learnpress_coaching_fixed_copyright = get_theme_mod( 'learnpress_coaching_display_fixed_copyright',false);
	if($learnpress_coaching_fixed_copyright == true && get_theme_mod( 'learnpress_coaching_sticky_copyright',false) != true){
    	$learnpress_coaching_custom_css .='.fixed-copyright{';
			$learnpress_coaching_custom_css .='position:static;';
		$learnpress_coaching_custom_css .='} ';
	}
    if($learnpress_coaching_fixed_copyright == true){
    	$learnpress_coaching_custom_css .='@media screen and (max-width:575px) {';
		$learnpress_coaching_custom_css .='.fixed-copyright{';
			$learnpress_coaching_custom_css .='position:fixed;';
		$learnpress_coaching_custom_css .='} }';
	}else if($learnpress_coaching_fixed_copyright == false){
		$learnpress_coaching_custom_css .='@media screen and (max-width:575px){';
		$learnpress_coaching_custom_css .='.fixed-copyright{';
			$learnpress_coaching_custom_css .='position:static;';
		$learnpress_coaching_custom_css .='} }';
	}

	// Hover effect on single post featured image (FIXED)

	$learnpress_coaching_show_featured = get_theme_mod(
		'learnpress_coaching_featured_image_hide_show',
		1
	);

	$learnpress_coaching_hover_effect = get_theme_mod(
		'learnpress_coaching_featured_image_hover',
		'none'
	);

	$learnpress_coaching_hover_duration = get_theme_mod(
		'learnpress_coaching_featured_image_hover_duration',
		0.4
	);

	if ( $learnpress_coaching_show_featured && $learnpress_coaching_hover_effect !== 'none' ) {

		/* BASE RESET (MOST IMPORTANT PART) */
		$learnpress_coaching_custom_css .= '
		.learnpress-coaching-featured-image{
			overflow: hidden;
		}
		.learnpress-coaching-featured-image img{
			transform: scale(1);
			filter: none;
			transition:
				transform ' . esc_attr( $learnpress_coaching_hover_duration ) . 's ease,
				filter ' . esc_attr( $learnpress_coaching_hover_duration ) . 's ease;
			will-change: transform, filter;
		}';

		/* ZOOM IN */
		if ( $learnpress_coaching_hover_effect === 'zoom-in' ) {
			$learnpress_coaching_custom_css .= '
			.learnpress-coaching-featured-image img:hover{
				transform: scale(1.2);
			}';
		}

		/* ZOOM OUT */
		if ( $learnpress_coaching_hover_effect === 'zoom-out' ) {
			$learnpress_coaching_custom_css .= '
			.learnpress-coaching-featured-image img{
				transform: scale(1.2);
			}
			.learnpress-coaching-featured-image img:hover{
				transform: scale(1);
			}';
		}

		/* GRAYSCALE (NORMAL → COLOR ON HOVER) */
		if ( $learnpress_coaching_hover_effect === 'grayscale' ) {
			$learnpress_coaching_custom_css .= '
			.learnpress-coaching-featured-image img{
				filter: grayscale(0%);
			}
			.learnpress-coaching-featured-image img:hover{
				filter: grayscale(100%);
			}';
		}

		/* SEPIA */
		if ( $learnpress_coaching_hover_effect === 'sepia' ) {
			$learnpress_coaching_custom_css .= '
			.learnpress-coaching-featured-image img:hover{
				filter: sepia(100%);
			}';
		}

		/* BLUR */
		if ( $learnpress_coaching_hover_effect === 'blur' ) {
			$learnpress_coaching_custom_css .= '
			.learnpress-coaching-featured-image img:hover{
				filter: blur(3px);
			}';
		}

		/* BRIGHT */
		if ( $learnpress_coaching_hover_effect === 'bright' ) {
			$learnpress_coaching_custom_css .= '
			.learnpress-coaching-featured-image img:hover{
				filter: brightness(1.3);
			}';
		}

		/* TRANSLATE */
		if ( $learnpress_coaching_hover_effect === 'translate' ) {
			$learnpress_coaching_custom_css .= '
			.learnpress-coaching-featured-image img:hover{
				transform: translateY(-10px);
			}';
		}
	}
 