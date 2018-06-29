/*------------------------------------------------------------------------

//GENERAL FUNCTONS ///////////////////////////////////////////////////////

-------------------------------------------------------------------------*/

jQuery(document).ready(function($) {

	/*vars used throughout*/
	var toggleMenu = $('.mobileMenuToggle'),			//Mobile menu ref.
		menuLink = $('ul.menu li, .menu ul li').not('.widget_nav_menu .menu li'),
		lightboxTransition = 'fade',				//Fancybox transition type
		overlayOpacity =0.8,						//Fancybox overlay opacity
		overlayColor = '#000',						//Fancybox overlay color	
		videoWidth = 663,							//Fancybox video width
		videoHeight = 374;							//Fancybox video height
		lazyload = true;							//Whether to use lazy load or not
	
	//MOBILE MENU ---------------------------------------------------------------------------/
	/* Clone navigation for mobile */
	$('#header-inner header nav').clone().addClass('mobile-nav').appendTo('#header-inner header');
	$('.mobile-nav').find('ul').addClass('mobile-navigation');
	
	/* Use mobile navigation on iPad Landscape */
	if(navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/Android/i)) {
		$('body, #header-inner').addClass('is_tablet');
		$('#header-inner .mobile-nav').css('display','block');
		$('#header-inner ul.navigation, #header-inner ul.mobile-navigation').css('display','none');
		$('#header-inner .mobileMenuToggle').css('display','block');
		$('.menu').not('.mobile-nav .menu').css('display','none');
	}
	$('.mobileMenuToggle').on('click', function() {
		if($(this).hasClass('open')) {
			$('ul.mobile-navigation').slideUp('normal','easeInOutQuint');
			$(this).removeClass('open');
		} else {
			$('ul.mobile-navigation').slideDown('normal','easeInOutQuint');
			$(this).addClass('open');
		}
		return false;
	});

	//VIDEO RESIZE -------------------------------------------------------------------------/
	var resizeVideos = function() {
		$('.video').not('.project-display .video').each(function() {
			$(this).height(($(this).width()/1.777)+'px');
			$(this).find('embed, object, iframe').height(($(this).width()/1.777)+'px').width($(this).width()+'px');
		});
	};
	
	$(window).bind('resize', function() {
		resizeVideos();
	});
	resizeVideos();

	//LIGHTBOX SPECIFIC ---------------------------------------------------------------------/
	var udt_use_fancybox = true;
	if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i)){
			udt_use_fancybox = false;
	}
	if(udt_use_fancybox==true) {
		/*lightbox-img
		-------------------------------*/
		$('a.lightbox').fancybox({
			'transitionIn'		: lightboxTransition,
			'transitionOut'		: lightboxTransition,
			'titlePosition'		: 'over',
			'padding'			: '0',
			'overlayOpacity'	: overlayOpacity,
			'overlayColor'		: overlayColor,
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
				var obj = currentArray[ currentIndex ];
				var target = $(obj).parent();
				if($(target).next().hasClass('fancybox-html')) {
					if ($(target).next().length && $(obj).attr('rel')) {
						return  '<span id="fancybox-title-over">' + '<div class="fancybox-num"> Image:'+(currentIndex + 1) + ' / ' + currentArray.length+'</div>'+($(target).next().html()) + '</span>';
					} else {
						return  '<span id="fancybox-title-over">' + ($(target).next().html()) + '</span>';
					}
				} else if($(obj).attr('rel') && $(obj).attr('title')) {
					return  '<span id="fancybox-title-over">' + '<div class="fancybox-num"> Image:'+ (currentIndex + 1) + ' / ' + currentArray.length + '</div> '+ (title.length?''+title:'') + '</span>';
				} else if($(obj).attr('rel')) {
					return  '<span id="fancybox-title-over">' + '<div class="fancybox-num" style="margin-bottom:0px"> Image:'+(currentIndex + 1) + ' / ' + currentArray.length+'</div>'+'</span>';
				} else if($(obj).attr('title')) {
					return  '<span id="fancybox-title-over">' +(title.length ?''+title :'') + '</span>';
				} else {
					$('#fancybox-title-over').hide();
				}
			},
			'onComplete' : function() {
				if($(window).width()<=767) {
					$('.fancybox-title-over').css({display:'none'});
				} else {
					$('.fancybox-title-over').hide().fadeIn('slow');
				}
			}
		});
		/*lightbox-gallery
		-------------------------------*/
		$('.gallery-icon a').filter(function() { return $(this).attr('href').match(/([a-z\-_0-9\/\:\.]*\.(jpg|jpeg|png|gif))/i); }).fancybox({
			'transitionIn'		: lightboxTransition,
			'transitionOut'		: lightboxTransition,
			'titlePosition'		: 'over',
			'padding'			: '0',
			'overlayOpacity'	: overlayOpacity,
			'overlayColor'		: overlayColor,
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
				var obj = currentArray[ currentIndex ];
				var target = $(obj).parent();
				
				if($(target).next().hasClass('fancybox-html')) {
					if ($(target).next().length && $(obj).attr('rel')) {
						return  '<span id="fancybox-title-over">' + '<div class="fancybox-num"> Image:'+(currentIndex + 1) + ' / ' + currentArray.length+'</div>'+($(target).next().html()) + '</span>';
					} else {
						return  '<span id="fancybox-title-over">' + ($(target).next().html()) + '</span>';
					}
				} else if($(target).parent().children('dd.wp-caption-text.gallery-caption').length!=0) {
					return  '<span id="fancybox-title-over">' + $(target).parent().children('dd.wp-caption-text.gallery-caption').html() + '</span>';
				} else {
					$('#fancybox-title-over').hide();
				}
			},
			'onComplete' : function() {
				if($(window).width()<=767) {
					$('.fancybox-title-over').css({display:'none'});
				} else {
					$('.fancybox-title-over').hide().fadeIn('slow');
				}
			}
		});
		
		/*lightbox-media
		-------------------------------*/
		$('a.lightbox-iframe').fancybox({
			'transitionIn'		: lightboxTransition,
			'transitionOut'		: lightboxTransition,
			'padding'			: '0',	
			'titlePosition'		: 'outside',
			'width'				: videoWidth,
			'height'			: videoHeight,
			'overlayOpacity'	: overlayOpacity,
			'overlayColor'		: overlayColor,
			'autoscale'			: false,
			'type'				: 'iframe',
			'swf'				: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'},
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
				var obj = currentArray[ currentIndex ];
				var target = $(obj).parent();
				if($(target).next().hasClass('fancybox-html')) {
					return  '<span>' + ($(target).next().html()) + '</span>';
				}
			},
			'onComplete':function(){
				if($(window).width()<=767) {
					$('.fancybox-title-outside').css({display:'none'});
				} else {
					$('.fancybox-title-outside').hide().fadeIn('slow').removeClass('fancybox-title-over');
				}
			}
		});
		$('a.lightbox-soundcloud').fancybox({
			'transitionIn' : lightboxTransition,
			'transitionOut' : lightboxTransition,
			'padding' : '0',
			'titlePosition' : 'outside',
			'width' : videoWidth,
			'height' : 166,
			'overlayOpacity' : overlayOpacity,
			'overlayColor' : overlayColor,
			'autoscale' : false,
			'type' : 'iframe',
			'swf' : {
			'wmode' : 'transparent',
			'allowfullscreen' : 'true'},
			'titleFormat' : function(title, currentArray, currentIndex, currentOpts){
				var obj = currentArray[ currentIndex ];
				var target = $(obj).parent(); 
				if($(target).next().hasClass('fancybox-html')) {
				return '<div>' + ($(target).next().html()) + '</div>';
				}
			},
			'onComplete':function(){
				if($(window).width()<=767){
					$('.fancybox-title-outside').css({display:'none'});
				} else {
					$('.fancybox-title-outside').hide().fadeIn('slow').removeClass('fancybox-title-over');
				}
			}
		});
	}

	//TO TOP BUTTON ---------------------------------------------------------------------/
	var scrollSpeed='normal';
	
	if(udt_global_vars.scrollToTopSpeed==1) {
		scrollSpeed='slow';
	} else if(udt_global_vars.scrollToTopSpeed==2) {
		scrollSpeed='fast';
	}
	
	jQuery('.back-to-top').click(function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, scrollSpeed);
		return false;
	});


	// Map -------------------------------------------------------------------------------/
	function initializeMap() {
		$('.map').each(function() {
			
			var map_id, map_lat, map_long, map_zoom, map_marker, map_info_title='', map_info_content='', m_controls=true;

			if(udt_global_vars.map_controls==0) {
				m_controls=false;
			}
			
			if($(this).attr('id')!='') {
				map_id=$(this).attr('id');
			}
			if($(this).attr('data-map-lat')!='') {
				map_lat=$(this).attr('data-map-lat');
			}
			if($(this).attr('data-map-long')!='') {
				map_long=$(this).attr('data-map-long');
			}
			if($(this).attr('data-map-zoom')!='') {
				map_zoom=parseInt($(this).attr('data-map-zoom'));
			}
			if($(this).attr('data-map-marker')!='') {
				map_marker=$(this).attr('data-map-marker');
			}
			if($(this).attr('data-map-info-title')!='') {
				map_info_title=$(this).attr('data-map-info-title');
			}
			if($(this).attr('data-map-info-content')!='') {
				map_info_content=$(this).attr('data-map-info-content');
			}
			
			var myLatlng = new google.maps.LatLng(map_lat, map_long);
			var myOptions = {
				zoom: map_zoom,
				center: myLatlng,
				mapTypeControl: m_controls,
				zoomControl: m_controls,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById(map_id),myOptions);
			
			if(map_marker=='custom') {
				var image = new google.maps.MarkerImage(
					udt_global_vars.map_image_marker, 
					null, 
					null, 
					null, 
					new google.maps.Size(44,32)
				);  
				var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
					icon: image
				});
			} else {
				var marker = new google.maps.Marker({
					position: myLatlng,
					map: map
				});
			}
			
			if(map_info_title!='' || map_info_content!='') {
				var contentString = '<p style="margin-bottom:0px"><strong>'+map_info_title+'</strong></p><p>'+map_info_content+'</p>';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
			}

		});
	}
	initializeMap();
});

jQuery(document).ready(function($) {

	/*epic hover plugin
	---------------------*/
	$(function() {
		$('.thumb, .gallery-icon').epicHoverFadeZoom({
			overlayColor: udt_global_vars.thumb_rollover_color,					//Hex: #xxxx
			fontColor: udt_global_vars.thumb_rollover_text_color,				//Hex: #xxxx
			captionDirection: 'topToBottom', 									//String: caption slide in/out direction
			opacity: udt_global_vars.thumb_rollover_opacity,					//Integer: 0-1
			transitionSpeed: 600,												//Integer: transitions speed, in milliseconds
			easing: 'swing',													//String: easing method - see http://jqueryui.com/demos/effect/easing.html
			padding: parseFloat(udt_global_vars.thumb_rollover_padding),		//Integer: padding
			mobileActive:false,													//Boolean: whether to activate/deactivate for mobile
			zoomFactor: parseFloat(udt_global_vars.thumb_rollover_zoom_factor),	//Float: zoom factor
			rolloverLogo: udt_global_vars.rollover_graphic
		});
	});
});

jQuery(window).load(function(){
	jQuery('.epic-fullscreen').epicFullscreen({
		background:'transparent',
		opacity: udt_global_vars.background_image_opacity,
		pattern: parseInt(udt_global_vars.background_image_overlay_pattern_on_off)
	});
});

jQuery(window).load(function() {

	// Frontpage slider
	var frontpage_direction_nav=true;
	if(udt_global_vars.frontpage_slider_navigation_style=='bullets'){
		frontpage_direction_nav=false;
	}
	jQuery('.home .epic-slider').epicSlider({
		loop : true,																			//Boolean: whether slideshow should loop or not	
		slideShow: udt_global_vars.frontpage_slider_slideshow,									//Boolean: use slideshow or not
		autoPlay: udt_global_vars.frontpage_slider_autoplay,									//Boolean: autoplay uplon load or not
		slideShowInterval : parseInt(udt_global_vars.frontpage_slider_slide_timer, 10),			//Integer: slideshow cycling speed, in milliseconds
		transitionSpeed : parseInt(udt_global_vars.frontpage_slider_slide_animation_speed, 10),	//Integer: transitions speed, in milliseconds
		shuffleSlides:false,																	//Boolean: shuffle slides or not
		stack:false,																			//Boolean: whether slides should stack
		parallax:false,																			//Boolean: whether parallax effect should be used or not
		parallaxFactor:.2,																		//Integer:0-.4
		fullscreenControl: udt_global_vars.frontpage_slider_fullscreen_button,
		imageScaling: udt_global_vars.frontpage_slider_crop_to_fit,
		easing : udt_global_vars.frontpage_slider_easing,										//String: easing method - see http://jqueryui.com/demos/effect/easing.html
		fx : udt_global_vars.frontpage_slider_slide_animation,									//String: none, fade, leftToRight, topToBottom 
		fxmobile : udt_global_vars.frontpage_slider_mobile_slide_animation,						//String: mobile effect -  none, fade, leftToRight, topToBottom 
		pattern : udt_global_vars.frontpage_slider_overlay_pattern_on_off,						//Boolean: add pattern or not
		directionNav: frontpage_direction_nav,													//Boolean: direction nav or control nav
		muteBackgroundVideo: udt_global_vars.frontpage_slider_mute_background_video
	});
	
	// Blog Slider
	var post_direction_nav=true;
	if(udt_global_vars.post_slider_navigation_style=='bullets'){
		post_direction_nav=false;
	}
	jQuery('.blog .epic-slider').epicSlider({
		loop : true,																			//Boolean: whether slideshow should loop or not	
		slideShow: udt_global_vars.post_slider_slideshow,										//Boolean: use slideshow or not
		autoPlay: udt_global_vars.post_slider_autoplay,											//Boolean: autoplay uplon load or not
		slideShowInterval : parseInt(udt_global_vars.post_slider_slide_timer, 10),				//Integer: slideshow cycling speed, in milliseconds
		transitionSpeed : parseInt(udt_global_vars.post_slider_slide_animation_speed, 10),		//Integer: transitions speed, in milliseconds
		shuffleSlides:false,																	//Boolean: shuffle slides or not
		stack:false,																			//Boolean: whether slides should stack
		parallax:false,																			//Boolean: whether parallax effect should be used or not
		parallaxFactor:.2,																		//Integer:0-.4
		fullscreenControl: udt_global_vars.post_slider_fullscreen_button,
		imageScaling: udt_global_vars.post_slider_crop_to_fit,
		easing : udt_global_vars.post_slider_easing,											//String: easing method - see http://jqueryui.com/demos/effect/easing.html
		fx : udt_global_vars.post_slider_slide_animation,										//String: none, fade, leftToRight, topToBottom 
		fxmobile : udt_global_vars.post_slider_mobile_slide_animation,							//String: mobile effect -  none, fade, leftToRight, topToBottom 
		pattern : udt_global_vars.post_slider_overlay_pattern_on_off,							//Boolean: add pattern or not
		directionNav: post_direction_nav,														//Boolean: direction nav or control nav
		muteBackgroundVideo: udt_global_vars.post_slider_mute_background_video
	});

	// Portfolio slider
	var epic_direction_nav=true;
	if(udt_global_vars.epic_slider_navigation_style=='bullets'){
		epic_direction_nav=false;
	}
	jQuery('.epic-slider').not('.home .epic-slider, .blog .epic-slider').epicSlider({
		loop : true,																			//Boolean: whether slideshow should loop or not	
		slideShow: udt_global_vars.epic_slider_slideshow,										//Boolean: use slideshow or not
		autoPlay: udt_global_vars.epic_slider_autoplay,											//Boolean: autoplay uplon load or not
		slideShowInterval : parseInt(udt_global_vars.epic_slider_slide_timer, 10),				//Integer: slideshow cycling speed, in milliseconds
		transitionSpeed : parseInt(udt_global_vars.epic_slider_slide_animation_speed, 10),		//Integer: transitions speed, in milliseconds
		shuffleSlides:false,																	//Boolean: shuffle slides or not
		stack:false,																			//Boolean: whether slides should stack
		parallax:false,																			//Boolean: whether parallax effect should be used or not
		parallaxFactor:.2,																		//Integer:0-.4
		fullscreenControl: udt_global_vars.epic_slider_fullscreen_button,
		imageScaling: udt_global_vars.epic_slider_crop_to_fit,
		easing : udt_global_vars.epic_slider_easing,											//String: easing method - see http://jqueryui.com/demos/effect/easing.html
		fx : udt_global_vars.epic_slider_slide_animation,										//String: none, fade, leftToRight, topToBottom 
		fxmobile : udt_global_vars.epic_slider_mobile_slide_animation,							//String: mobile effect -  none, fade, leftToRight, topToBottom 
		pattern : udt_global_vars.epic_slider_overlay_pattern_on_off,							//Boolean: add pattern or not
		directionNav: epic_direction_nav,														//Boolean: direction nav or control nav
		muteBackgroundVideo: udt_global_vars.epic_slider_mute_background_video
	});
});

/*grid
---------------------*/
jQuery(function($) {

	// grid
	var $container = $('.masonry');

	imagesLoaded( $container, function() {

		// set category
		$container.children().each( function(){
			var category = $(this).attr('data-project-categories');
			$(this).addClass(category);
		});
		$('.portfolio-filter-wrapper a').each(function() {
			var category = $(this).attr('data-category-slug');
			$(this).attr('data-filter', '.' + category);
		});
		$('.portfolio-filter-wrapper a:first-child').attr( 'data-filter', '*');
		
		// init
		$container.isotope({
			filter: '*',
			itemSelector: '.masonry .masonry-item', 
			layoutMode: 'fitRows'
		});
	});

	// filter items when filter link is clicked
	$('.portfolio-filter-wrapper a').click(function(){
		if(navigator.userAgent.match(/Android/i) || 
		navigator.userAgent.match(/webOS/i) || 
		navigator.userAgent.match(/iPhone/i) || 
		navigator.userAgent.match(/iPod/i) || 
		navigator.userAgent.match(/BlackBerry/i)) {
			return;
		}
		$('.portfolio-filter-wrapper a').each(function() {
			$(this).removeClass('active');
		});
		var selector = $(this).attr('data-filter');
		$(this).addClass('active');
		$container.isotope({ filter: selector });
		return false;
	});
});

/* Add rel attribute to link in WP Galleries */
jQuery(document).ready(function($) {
	$('.gallery').each(function() {
		if($(this).attr('id')) {
			$(this).find('dl dt a').attr('rel',$(this).attr('id'));
		}
	});
});

/* Fade in effect */
$(document).ready(function() {
	if( !navigator.userAgent.match(/Android/i) && !navigator.userAgent.match(/webOS/i) && !navigator.userAgent.match(/iPhone/i) && !navigator.userAgent.match(/iPad/i) && !navigator.userAgent.match(/iPod/i) && !navigator.userAgent.match(/BlackBerry/i)) {
		$('.fade-in').css('opacity',0);
		$('.fade-in').bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
			if (isInView) {
				if (visiblePartY == 'both') {
					$(this).animate({'opacity':1}, 600, function() {
						$(this).unbind('inview');
					});
				}
			}
		});
	}
});