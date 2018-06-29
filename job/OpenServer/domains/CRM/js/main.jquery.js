var xhrFrom = null;
$(function(){
            function onScrollInit( items, trigger ) {
                items.each( function() {
                var osElement = $(this),
                    osAnimationClass = osElement.attr('data-os-animation'),
                    osAnimationDelay = osElement.attr('data-os-animation-delay');
                  
                    osElement.css({
                        '-webkit-animation-delay':  osAnimationDelay,
                        '-moz-animation-delay':     osAnimationDelay,
                        'animation-delay':          osAnimationDelay
                    });

                    var osTrigger = ( trigger ) ? trigger : osElement;
                    
                    osTrigger.waypoint(function() {
                        osElement.addClass('animated').addClass(osAnimationClass);
                        },{
                            triggerOnce: true,
                            offset: '90%'
                    });
                });
            }

            onScrollInit( $('.os-animation') );
            onScrollInit( $('.staggered-animation'), $('.staggered-animation-container') );
});//]]>  

window.addEventListener("orientationchange", function() {
	
	$('.j-header_about').css({'height': 'auto'});
	calculateHeight();
	capabilitiesHeight();
	calculateDesign();
	calculateSolutions();
	calculateForm();
	calculateYandex();
	$("#my-video").css({'height': $(window).height()+'px', 'width': $(window).width()+'px'});
}, false);

$(document).ready(function() {
	
	//$("#my-video").width($(window).width());
	//$("#my-video").height($(window).height()).css({'display':'block'});
	calculateHeight();
	capabilitiesHeight();
	calculateDesign();
	calculateSolutions();
	calculateForm();
	calculateYandex();
	var linkHash = window.location.hash.replace("#","");
	if(linkHash != '')
		 $.scrollTo('#j-'+linkHash+'');
	
	_V_("example_video_1").ready(function(){

    var myPlayer = this;    // Store the video object
    var aspectRatio = 9/16; // Make up an aspect ratio

    function resizeVideoJS(){
      // Get the parent element's actual width
      var width = document.getElementById(myPlayer.id).parentElement.offsetWidth;
      // Set width to fill parent element, Set height
	if($(document).width() < 780)
		myPlayer.width(width).height( width * aspectRatio );
	else
      myPlayer.width(width).height( $(window).height() );
    }

    resizeVideoJS(); // Initialize the function
    window.onresize = resizeVideoJS; // Call the function on resize
  });
})

$(function() {
	$("#toTop").scrollToTop(1000);
});

$(document).on('click', '.j-main_menu a', function() {
	if($(this).attr('data-hash')) {
		var linkHash = $(this).attr('data-hash');
		if(!$('#j-'+linkHash+'').length) {
			return true;
		}
		if(linkHash != '') {
			 $.scrollTo('#j-'+linkHash+'');
			 return false;
		}
	} else {
	return true;
	}
})

$(document).on('click', '.j-header_menu', function() {
	if($(this).hasClass('j-open_menu')) {
		hideMenu();
	} else {
		showMenu();
	}
	return false;
})

function showMenu() {
	$('.j-header_menu span').eq(0).rotate({
      animateTo: 45
	})
	$('.j-header_menu span').eq(0).css({'margin': '40px 0 0'});
	$('.j-header_menu span').eq(1).css({'margin': '0 0 0 0'});
	
	$('.j-header_menu span').eq(1).rotate({
		animateTo: 135
	})
	$('.j-header_menu span').eq(2).hide();
	$('.j-header_menu').addClass('j-open_menu');

	$('.j-main_menu').slideDown(500);
	$('.j-header_about').slideUp(500);
	
}

function hideMenu() {
	$('.j-header_menu span').rotate({
      animateTo: 0,
	})
	$('.j-header_menu span').css({'margin': '18px 0 0'}); 
	$('.j-header_menu span').eq(2).show();
	$('.j-header_menu').removeClass('j-open_menu');
	
	$('.j-main_menu').slideUp(500);
	$('.j-header_about').slideDown(500);
}

$(document).on('click', '.j-design_link', function() {
	var parent = $(this).parents('.j-design');
	
	if($(this).hasClass('j-design_active')) {
		$('.j-design ul').stop(true, true).slideUp(500);
		$('.j-design_bg_inner').css({'background-image': 'none'});
		$('.j-design a').removeClass('j-design_active');
	} else {
		var eq = $('.j-design a').index($(this));
		$('.j-design ul').not(eq).slideUp(500);
		
		parent.find('ul').slideDown(500);
		var i = $(this).attr('data-id');
		$('.j-design_bg_inner').css({'background-image': 'url("/images/design_img'+i+'.png")'});
		$('.j-design a').not(eq).removeClass('j-design_active');
		$(this).addClass('j-design_active');
	}
	return false;
})


function formSubmit(container) {
	if(container == '') {
		container = $('.d-content');
	} else {
		container = $(''+container+'');
	}
	
	$(document).on('click', ".a-button", function() { 
		//Выбор формы
		var formAction = $(this).parents('form').attr("action");

		$(this).parents('form').attr("action", formAction);
		var index = $('.a-button').index(this);
		container.eq(index).show();
		//Отправка данных
		var form = $(this).parents('form');
		$(this).parents('form').ajaxForm({
			beforeSubmit:  function() {
				if(xhrFrom!=null){
					return false;
				}
				xhrFrom = 'not allow';
				container.eq(index).html('<img src = "/images/system/page_preloader.gif" alt = "loading..."/>');
			},
			error: function(data){
				form.clearForm();
				container.eq(index).empty().html(data);
			},
			success: function(data) {
				/*var json = $.parseJSON(data);
				container.eq(index).empty().html(json.message);
				form.clearForm();*/
				var json = $.parseJSON(data);
				
				$("#j-message_dialog .modal-body").html(json.message);
				$("#j-message_dialog").modal("show");
				form.clearForm();
			},
			complete: function(responseText, statusText, xhr) {
				xhrFrom = null;
				
			}
		})
		
	}); 
}


function callForm(css_class) {
	var xhrFrom = null;
	$(document).on('click', '.j-show_'+css_class+'_dialog', function() {
		$("#j-get_"+css_class+"_dialog").modal("show");
		return false;
	});
	
	$(document).on('click', '.a-get_'+css_class+'', function() {
		var formAction = $(this).parents('form').attr("action");
		var form = $(this).parents('form');
		form.ajaxForm({
			beforeSubmit:  function() {
				if(xhrFrom!= null){
					return false;
				}
				xhrFrom = 'not allow';
			},
			error: function(data){
				$("#j-message_dialog").modal("show");
				$("#j-message_dialog .modal-body").html(data);
			},
			success: function(data) {
				
				var json = $.parseJSON(data);
				
				$("#j-message_dialog .modal-body").html(json.message);
				$("#j-message_dialog").modal("show");
			},
			complete: function(responseText, statusText, xhr) {
				$("#j-get_"+css_class+"_dialog").modal("hide");
				form.clearForm();
				xhrFrom = null;
			}
		})
	});
}

function gallery_init() {
	Galleria.loadTheme('/packages/galleria/galleria.classic.min.js'); 
	$('#j-house_gallery').galleria({
		autoplay: 7000,
		imageCrop: true,
		lightbox: true,
		showInfo: false
	});
	$('#j-house_gallery').css({'opacity':'1'});
}

function calculateHeight() {
	var delicimor;
	
	if($(document).width() > 1400) {
		delicimor = 90
		var liHeight = 70;
	}
	else {
		delicimor = 70;
		var liHeight = 55;
	}
	var sliderHeight = (height - 500) / 20+delicimor;
	
	$('.b-slider_carousel .l-jcarousel li').css({'height':liHeight+'px'});
	
	if($(window).width() <= 770 || ($(window).width() < $(window).height())) {
		$('.j-header_about').css({'opacity':'1'});
		return true;
	}
	var windowHeight = $(window).height();
	var headerHeight = $('.g-header').height();
	var height = windowHeight - headerHeight;
	if(height < 500)
		height = 500;

	var articleHeight = $('.b-header_about article').height();	
	var persents = parseInt(height*50/(874+articleHeight));
	var left = 100-68+persents/2+10;
	$('.b-header_about_hands').css({'background-size': ''+persents+'%', 'background-position': ''+left+'% bottom'});
	
	var padding = (sliderHeight - 90)/2;
	if(padding < 10) 
		padding = 10;
	var paddingTop = padding+5;
	var paddingBottom = padding-5;
	
	
	$('.b-header_about_slider').css({'height':sliderHeight+'px', 'padding': ''+paddingTop+'px 0'+paddingBottom+'px'});
	$('.j-header_about').height(height).css({'opacity':'1'});
}

function capabilitiesHeight() {
	if($(window).width() > 600) { 
		$(".b-capabilities").height($(window).height());
	} else {
		var height = $(window).height()/2;
		if(height < 300)
			height = 300;
		$(".b-capabilities").height(height);
	}
}
function calculateDesign() {
	var height = $('.b-design').height();
	var windowHeight = $(window).height();
	if($(window).width() > 1000 && windowHeight >= 714) {
			
		$('.j-design_bg_inner, .b-design_bg_base, .b-design').css({'min-height':windowHeight+'px'})//height(windowHeight);
		var totalHeight = 0;
		$('.j-design').each(function(){
			totalHeight = totalHeight + $(this).height() + 10;
		})
		var margin = parseInt((windowHeight - totalHeight)/8/3);
		if(margin < 10)
			margin = 10;
		$('.j-design').css({'margin': ''+margin+'px 0'});

	}
}
function calculateSolutions() {
	var height = $('.b-solutions').height();
	var windowHeight = $(window).height();
	if($(window).width() > 600 && windowHeight > height) {
		$('.b-solutions').height(windowHeight);
		var totalHeight = $('.soluionts_for').height() + $('.b-solutions_images').height();
		var margin = (windowHeight - totalHeight)/3;
		$('.b-solutions .soluionts_for').css({'margin': margin+'px 0'});
	}
}

function calculateForm() {
	var height = $('.b-site_form').height();
	var windowHeight = $(window).height();
	
	if($(window).width() > 600 && windowHeight > height) {
		var padding = (windowHeight - height)/2;
		$('.b-site_form').css({'padding': padding+'px 0'});
	}
}

function calculateYandex() {
	if($(window).width() <= 650) {
		var windowHeight = $(window).height()/2;
		$('.b-map .b-show_right').height(windowHeight);
	}
}

function initFancy(data, id) {
	$(document).on('click', '.j-open_fancy'+id+'', function(){
		$.fancybox.open(data);
		return false;
	})
}

/*
    jQuery Masked Input Plugin
    Copyright (c) 2007 - 2015 Josh Bush (digitalbush.com)
    Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
    Version: 1.4.1
*/
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(o&&o.length&&o.length>a.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){B.get(0)===document.activeElement&&(z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a))},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});

/*!
    jQuery scrollTopTop v1.0 - 2013-03-15
    (c) 2013 Yang Zhao - geniuscarrier.com
    license: http://www.opensource.org/licenses/mit-license.php
*/
(function(a){a.fn.scrollToTop=function(c){var d={speed:800};c&&a.extend(d,{speed:c});return this.each(function(){var b=a(this);a(window).scroll(function(){100<a(this).scrollTop()?b.fadeIn():b.fadeOut()});b.click(function(b){b.preventDefault();a("body, html").animate({scrollTop:0},d.speed)})})}})(jQuery);