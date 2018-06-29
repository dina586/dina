
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
				$("#j-get_"+css_class+"_dialog").modal("hide");
				var json = $.parseJSON(data);
				
				$("#j-message_dialog .modal-body").html(json.message);
				$("#j-message_dialog").modal("show");
			},
			complete: function(responseText, statusText, xhr) {
				form.clearForm();
				xhrFrom = null;
			}
		})
	});
}
