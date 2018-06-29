//City list
$(document).on('change','.a-country', function() {
	var val = $(this).val();
	var name = $(this).attr('id');
	var url = '/helper/default/getCity';
	
	$.ajax({
		url: url,
		type: 'POST',
		data: {'country_id': val, 'name': name},
		beforeSend: function() {
			$('<div class = "j-city_loader"><img class = "" src = "/images/system/loading.gif"/></div>').insertAfter('.d-choosen_city .form-group div:eq(2)');
		},
		success: function(data) {

			$('.d-choosen_city .form-group div').html(data);

			$('.j-choosen_city').chosen({
				'search_contains':true,
				'width': '100%'
			});
		},
		error: function(jqXHR, textStatus, errorThrown) {
				
		}
	})

});

/* Back to top */
$(window).load(function(){
	$().UItoTop({ easingType: 'easeOutQuart' });
})