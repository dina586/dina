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