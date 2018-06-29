$(document).on('change','.a-procedure select', function() {
	
	var val = $(this).val();
	var url = '/service/procedure/getPrice';
	$.ajax({
		url: url,
		type: 'POST',
		data: {'procedure_id': val},
		beforeSend: function() {
		},
		success: function(data) {
			
			var json = $.parseJSON(data);
			$('.d-procedure_price input').val(json.price);
			$('.j-procedure_length, .j-procedure_length_text').text(json.procedure_length);
			$('.j-show_procedure').show();
		},
		error: function(jqXHR, textStatus, errorThrown) {
				
		}
	})
	

});

	$(document).on('change', '.j-show_worker input', function() {
		$('.j-view_service_worker').hide();
		if($(this).is(':checked'))
			$('.j-view_service_worker').show();
		else
			$('.j-view_service_worker').hide();
		
	})