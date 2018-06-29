var xhr = null;

//Make seo block active
function seoInit(wordShow, wordHide, extraClass) {
	$('.j-admin_seo').ready(function() {
		$('.j-admin_post_seo > *').hide();
		$('.j-admin_post_seo').append('<a class = "'+extraClass+'" href = "#" id = "j-admin_post_seo_show_toggle">'+wordShow+'</a>');
		$('#j-admin_post_seo_show_toggle').toggle(
			function() {
				$(this).text(wordHide);
				$('.j-admin_post_seo > div').stop(false, true).slideDown(200);
			},
			function() {
				$(this).text(wordShow);
				$('.j-admin_post_seo > div').fadeOut(200);
			}
		)
	})
}

function stockInit(sid) {
	jQuery('#'+sid+'').jcarousel({
		wrap: 'circular',
		scroll: 1,
		auto: 20,
	});
}

// View blocks under slider on hover
function mainHover() {
	$(document).on('mouseenter', '.j-hover_area', function() {
		$('.j-hover_view').stop(true, true).hide();
		$('.j-hover_view', this).height(0).show().css({'top': '100px'}).animate({
			height: 500,
			top: -400,
		}, 500);
	});
	$(document).on('mouseleave', '.j-hover_area', function() {
		$('.j-hover_view', this).animate({
			height: 0,
			top: 100,
		}, 500, function() {
			$('.j-hover_view').hide();
		});
	});
}

//Удаление изображения
$(document).on('click', '.a-delete_image', function() {
	var url = $(this).attr('href');
	var index = $('.a-delete_image').index(this);
	var link = $(this);
	if(xhr != null)
		xhr.abort();           
	xhr = $.ajax({
		url: url,
		type: 'POST',
		success: function(data) {
			$(link).parents('.j-image_admin_field').remove();
		}
	})
	return false;
})

//jcarousel front page
function jcarousel_init(id, interval) {
	
	$(id).jcarousel({
		wrap: 'circular',
		animation: {
			duration: 500,
		}
	}).jcarouselAutoscroll({
        interval: interval,
        target: '+=1',
        autostart: true
    });
		
	$(''+id+'-control-prev')
		.on('jcarouselcontrol:active', function() {
			$(this).removeClass('inactive');
		})
		.on('jcarouselcontrol:inactive', function() {
			$(this).addClass('inactive');
		})
		.jcarouselControl({
			target: '-=1'
		});

	$(''+id+'-control-next')
		.on('jcarouselcontrol:active', function() {
			$(this).removeClass('inactive');
		})
		.on('jcarouselcontrol:inactive', function() {
			$(this).addClass('inactive');
		})
		.jcarouselControl({
			target: '+=1'
		});
		
	$(''+id+'-pagination')
		.on('jcarouselpagination:active', 'a', function() {
			$(this).addClass('active');
		})
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination();
}

/*
 * Делаем delay при отправке аякса
 */
function throttle(f, delay) {
    var timer = null;
    return function(){
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = window.setTimeout(function(){
            f.apply(context, args);
        },
        delay || 500);
    };
}

$(document).ready(function() {
	try{
		$(".j-colobox").colorbox({rel:'colobox', maxWidth:'75%',maxHeight:'75%', current:'"Image {current} from {total}"'});
	}
	catch(e){ }

})