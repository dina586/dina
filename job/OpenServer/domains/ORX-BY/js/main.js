jQuery(document).ready(function() {
	$('.g-slider')
		.on('jcarousel:reload jcarousel:create', function () {
			var carousel = $(this);
			width = carousel.innerWidth();

			carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
		})
		.jcarousel({ wrap: 'both'})
		.jcarouselAutoscroll({
			interval: 10000,
			target: '+=1',
			autostart: true
		});	
		
         $('#women_slider, #child_slider, #man_slider, #partners_slider').jcarousel({ wrap: 'both'})
		.jcarouselAutoscroll({
			interval: 5000,
			target: '+=1',
			autostart: true
		});       
                
         $('.jcarousel-prev').jcarouselControl({
            target: '-=1'
        });

        $('.jcarousel-next').jcarouselControl({
            target: '+=1'
        });    
    
	$('.j-lightbox_link').lightBox({
		imageLoading:  '/images/lightbox-ico-loading.gif',
		imageBtnClose: '/images/lightbox-btn-close.gif',
		imageBtnPrev:  '/images/lightbox-btn-prev.gif',
		imageBtnNext:  '/images/lightbox-btn-next.gif',
		txtImage: 'Изображение',
		txtOf: 'из'
	});
	
	var i = 0;
	var linkHeight = 0;
	var descrHeight = 0;
	var costHeight = 0;
	$('.l-material .b-product_preview').each(function(){
		var index = $('.l-material .b-product_preview').index(this);
		
		/*Высота ссылки*/
		if($('.slider_link', this).height() > linkHeight) {
			linkHeight = $('.slider_link', this).height(); 
		}
		/*Высота описания*/
		if($('.j-product_preview_descr', this).height() > descrHeight) {
			descrHeight = $('.j-product_preview_descr', this).height(); 
		}
		/*Высота цены*/
		if($('.j-price_wrap', this).height() > costHeight) {
			costHeight = $('.j-price_wrap', this).height(); 
		}
		i++;
		/*Если это последний товар, то присаиваем параметры для товара*/
		if(i == 5) {
			for(var k = index; k > index - 5; k--) {
				$('.l-material .j-add_to_cart').eq(k).css({'margin-top': '5px'});
				$('.l-material .slider_link').eq(k).css({'height': ''+linkHeight+'px'});
				$('.l-material .j-product_preview_descr').eq(k).css({'height': ''+descrHeight+'px'});
				$('.l-material .j-price_wrap').eq(k).css({'height': ''+costHeight+'px'});
			}
			/*Обнуляем параметры*/
			linkHeight = descrHeight = costHeight = i = 0;
		}
	})
	
	var eq = -1;
	$('.b-main_sliders .j-slider').each(function () {
	eq++;
	var number = $('.b-product_view', this).size();
	i = linkHeight = descrHeight = costHeight = 0;
		$('.j-slider:eq('+eq+') .b-product_view').each(function() {
			var index = $('j-slider:eq('+eq+') .b-product_view').index(this);
			
			/*Высота ссылки*/
			if($('.slider_link', this).height() > linkHeight) {
				linkHeight = $('.slider_link', this).height(); 
			}
			/*Высота описания*/
			if($('.j-product_preview_descr', this).height() > descrHeight) {
				descrHeight = $('.j-product_preview_descr', this).height(); 
			}
			/*Высота цены*/
			if($('.j-price_wrap', this).height() > costHeight) {
				costHeight = $('.j-price_wrap', this).height(); 
			}
			i++;
			/*Если это последний товар, то присаиваем параметры для товара*/
			if(i == number) {
				for(var k = 0; k < number; k++) {
					$('.j-slider:eq('+eq+') .j-add_to_cart').eq(k).css({'margin-top': '5px'});
					$('.j-slider:eq('+eq+') .slider_link').eq(k).css({'height': ''+linkHeight+'px'});
					$('.j-slider:eq('+eq+') .j-product_preview_descr').eq(k).css({'height': ''+descrHeight+'px'});
					$('.j-slider:eq('+eq+') .j-price_wrap').eq(k).css({'height': ''+costHeight+'px'});
				}
				/*Обнуляем параметры*/
				linkHeight = descrHeight = costHeight = i = 0;
			}
		})
	})
});

//Инициализация акции
function stock_init(year, month, day) {
	var countdownLayout = '{desc}'+
		'<ul>' + 
			'{d<}<li><span>{dn}</span><b>:</b><p>{dl}</p></li>{d>}'+
			'{h<}<li><span>{hn}</span><b>:</b><p>{hl}</p></li>{h>}'+ 
			'{m<}<li><span>{mn}</span><b>:</b><p>{ml}</p></li>{m>}'+
			'{s<}<li><span>{sn}</span><p>{sl}</p></li>{s>}'+
		'</ul>';
	month--;
	austDay = new Date(year, month, day);
	$('#j-countdown').countdown({until: austDay, alwaysExpire: true, layout: countdownLayout, description: '<h3>До конца акции осталось:</h3>'});
	$.countdown.setDefaults($.countdown.regional['ru']);
	//$('#j-countdown').countdown('pause'); 
}