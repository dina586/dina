var xhrFrom = null;
$(document).on('click', '.j-open_form', function() {
	$("#j-call_dialog").modal("show");
	return false;
})


$(document).on('click', ".a-order_form button", function() { 
	var formAction = $(this).parents('form').attr("action");
		
	$(this).parents('form').ajaxForm({
		beforeSubmit:  function() {
			if(xhrFrom!= null){
				return false;
			}
			xhrFrom = 'not allow';
		},
	error: function(data){
	},
	success: function(data) {
		$("#j-message_dialog .modal-body").html(data);
		$("#j-order_dialog, #j-call_dialog").modal("hide");
		$("#j-message_dialog").modal("show");
		},
		complete: function(responseText, statusText, xhr) {
			xhrFrom = null;
		}
	})
}); 

//Загрузка списка каталогов
$(document).on('click', '.j-abc_letters a', function() {
	var url = $(this).attr('data-link');
	$('.j-abc_details').slideDown(300);
	$('.j-abc_letter').text($(this).text());
	var position = $(this).position();
	position = parseInt(position.left)-1; //91;
	$('.j-abc_corner').show().css({'left': ''+position+'px'});
	$.ajax({
		beforeSend:  function() {
			if(xhrFrom!= null){
				return false;
			}
			xhrFrom = 'not allow';
			$('.d-abc_list').addClass('l-align_center').html('<img src = "/images/catalog_loader.gif" alt = "Загружаю..." />');
		},
		url: url,
		error: function(data){
		},
		success: function(data) {
			$('.d-abc_list').html(data);
		},
		complete: function(responseText, statusText, xhr) {
			xhrFrom = null;
			$('.d-abc_list').removeClass('l-align_center');
		},
		error: function() {
			$('.d-abc_list').html('<p>Ошибка при запросе данных. Пожалуйста, попробуйте еще раз!</p>');
		},
	})
	return false;
})
$(function() {
	$(document).click(function (event) {
        if ($(event.target).closest('.j-abc_details').length == 0) {
            $('.j-abc_details, .j-abc_corner').hide();
        }
    });
})

function init_lightbox() {
	
}
jQuery(document).ready(function() {	
		
         $('#production-slider, #certificate-slider, #gallery-slider, #opinion-slider').jcarousel({ wrap: 'both'})
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
        
		windowResize();		
        
        $('.fancybox').fancybox();
        
        stock_init(2015, 12, 25);
        
        $("#modal_request_form_button").click(function(){
           $('#a-response_form_modal-dialog').hide();
		   $('#a-request_form_modal-dialog').show();
		   $('#recipient-name').val('Ваше имя');
		   $('#recipient-phone').val('Контактый телефон');
		   $('#modal_request_form').modal();
        });
		
		$("#modal_request-footer_form_button").click(function(){
           $('#a-response_form_modal-dialog').hide();
		   $('#a-request_form_modal-dialog').show();
		   $('#recipient-name').val('Ваше имя');
		   $('#recipient-phone').val('Контактый телефон');
		   $('#modal_request_form').modal();
        });
		$("#modal_request_logo_area_order").click(function(){
           $('#a-response_form_modal-dialog').hide();
		   $('#a-request_form_modal-dialog').show();
		   $('#recipient-name').val('Ваше имя');
		   $('#recipient-phone').val('Контактый телефон');
		   $('#modal_request_form').modal();
        });
}) ;

$(window).resize(function(){
	windowResize();
})

function windowResize(){
	var width = $(window).width();
	if(width < 950) { 
		var newWidth = $(window).width()*0.76;
		$('#production-slider li').width(newWidth);
		$('#gallery-slider li').width(newWidth);
	}
	else{
		$('#production-slider li').width("375px");
		$('#gallery-slider li').width("375px");
	}
	
	if(width < 980 && width >= 690) { 
		var newWidth = $(window).width()*0.41;
		$('#certificate-slider li').width(newWidth);
	}
	else if(width < 690){
		var newWidth = $(window).width()*0.82;
		$('#certificate-slider li').width(newWidth);		
	}
	else{
		$('#certificate-slider li').width("275px");
	}

	if(width < 980 && width >= 830 ) { 
		var newWidth = $(window).width()*0.15;
		$('#opinion-slider li').width(newWidth);
	}
	else if(width < 830 && width >= 665){
		var newWidth = $(window).width()*0.1886;
		$('#opinion-slider li').width(newWidth);		
	}
	else if(width < 665 && width >= 505){
		var newWidth = $(window).width()*0.2514;
		$('#opinion-slider li').width(newWidth);		
	}
	else if(width < 505 && width >= 360 ){
		var newWidth = $(window).width()*0.3772;
		$('#opinion-slider li').width(newWidth);		
	}
	else if(width < 360 ){
		var newWidth = $(window).width()*0.7544;
		$('#opinion-slider li').width(newWidth);		
	}
	else{
		$('#opinion-slider li').width("122px");
	}
	
	if(width < 550){
		var newHeight = $(window).height()/2;
		$(".map").height(newHeight);
	}
	else{
		$(".map").height("650px");
	}
}


jQuery(document).ready(function(){
    $('#a-response_form').hide();
        $('#a-response_form_gallery').hide();
        $('#a-response_form_offer').hide();
        $('#a-response_form_modal-dialog').hide();
        
       
        $('#a-request').ajaxForm({    beforeSubmit: validate,
                                    success: showResponse  
                }); 
        $('#a-gallery').ajaxForm({    beforeSubmit: validate,
                                    success: showResponseGallery  
                });
        $('#a-offer').ajaxForm({    beforeSubmit: validate,
                                    success: showResponseOffer  
                });
        $('#a-request_modal-dialog').ajaxForm({    beforeSubmit: validatemodal,
                                    success: showResponseModal 
                });
})
        
               
 
function showResponse(){
    $('#a-request_form').hide();
    $('#a-response_form').show(); 
}

function showResponseOffer(){
    
    $('#a-request_form_offer').hide();
    $('#a-response_form_offer').show();
}

function showResponseGallery(){
    
    $('#a-request_form_gallery').hide();
    $('#a-response_form_gallery').show();
}
function showResponseModal(){
    
    $('#a-request_form_modal-dialog').hide();
    $('#a-response_form_modal-dialog').show();
}
function validate(formData, jqForm, options){
    var valid = true;
    if (validateEmail(formData[2].value)==false){
            $(jqForm).find("[name = email]").addClass('edit_f_error');
            valid = false;
    }
    
    if (validatePhone(formData[1].value)==false){
            $(jqForm).find("[name = phone]").addClass('edit_f_error');
            valid = false;
    }    
    
    return valid;
}

function validatemodal(formData, jqForm, options){
    var valid = true;
        
    if (validatePhone(formData[1].value)==false){
            $(jqForm).find("[name = phone]").addClass('edit_f_error');
            valid = false;
    }    
    
    return valid;
}

function validateEmail(address) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(address) == false) {
          return false;
   }
   return true;
}


function validatePhone(phone) {
        var reg = /^\+?[+\-()\s\d]+$/;
        return reg.test(phone);
}



function stock_init (year, month, day) {
            
    var countdownLayout = '{desc}'+
            '<ul>' + 
                    '{d<}<li><span>{dn}</span><b>:</b><br/><span class="b-offer_timer">{dl}</span></li>{d>}'+
                    '{h<}<li><span>{hn}</span><b>:</b><br/><span class="b-offer_timer">{hl}</span></li>{h>}'+ 
                    '{m<}<li><span>{mn}</span><b>:</b><br/><span class="b-offer_timer">{ml}</span></li>{m>}'+
                    '{s<}<li><span>{sn}</span><br/><span class="b-offer_timer">{sl}</span></li>{s>}'+
            '</ul>';
    month--;
    austDay = new Date(year, month, day);
    $('#j-countdown').countdown({until: austDay, alwaysExpire: true, layout: countdownLayout});
    $.countdown.setDefaults($.countdown.regional['ru']);
    //$('#j-countdown').countdown('pause'); 
}