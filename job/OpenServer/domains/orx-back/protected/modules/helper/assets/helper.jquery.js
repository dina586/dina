$('.j-exel_link').live('click', function() {
	var url = $(this).attr('href');
	if($('#files').is(':checked')) {
		var withFiles = 1;
	} else {
		var withFiles = 0;
	}
	if($('#old').is(':checked')) {
		var old = 1;
	} else {
		var old = 0;
	}
	$.ajax({
		type: "POST",
		url: url,
		data: ({withFiles : withFiles, old : old}),
		beforeSend: function() {
			$('#j-success_message').html('Идет загрузка... <br/> <img src = "/images/page_preloader.gif" />');
		},
		success: function(data){
			$('#j-success_message').html('Загрузка успешно завершена');
		},
		error: function(data) {
			$('#j-success_message').html(data);
		}
	})
	return false;
})