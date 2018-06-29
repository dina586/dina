var xhrFrom = null;
$(document).on('click', '.a-get_view_preview', function() {
	var id = $(this).attr('data-number');
	
	$.ajax({
		type : 'POST',
		url : '/video/view/preview',
		data: {'id':id},
		beforeSend:  function() {
			if(xhrFrom!= null){
				return false;
			}
			xhrFrom = 'not allow';
			$("#j-video_modal").modal("show");
			$("#j-video_modal .modal-body").html('We are loading a video for you. Please, wait...');
		},
		success: function(data) {
			$("#j-video_modal .modal-body").html(data);
			
		},
		error: function(data){
			$("#j-video_modal .modal-body").html(data);
		},
		complete: function(responseText, statusText, xhr) {
			xhrFrom = null;
		}
		
	})
	return false;
})
