var xhr = null;

//Make seo block active
$(document).on('click', '.j-show_seo', function() {
	$('.j-seo_block').stop(false, true).slideDown(200);
	$('.j-hide_seo').removeClass('l-hidden').show();
	$(this).hide();
	return false;
})

$(document).on('click', '.j-hide_seo', function() {
	$('.j-seo_block').slideUp(200);
	$('.j-show_seo').show();
	$(this).hide();
	return false;
})

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

//Img delete
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

function callForm() {
	
	var xhrFrom = null;
	$(document).on('click', '.j-show_call_dialog', function() {
		$("#j-get_call_dialog").modal("show");
		return false;
	});
	
	$(document).on('click', '.a-get_call', function() {
		alert('tt');
		return;
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
				$("#j-get_call_dialog").modal("hide");
				form.clearForm();
				xhrFrom = null;
			}
		})
	});
}