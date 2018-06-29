$(document).ready(function() {
	$('#a-images_delete li .a-img_delete').click(function(){
	var index = $('#a-images_delete li .a-img_delete').index(this);
	var link = $(this).attr('href');
	
	$.ajax({
		type: "GET",
		url: link,
		success: function(data){
			$('#a-images_delete li').eq(index).hide();
		}
		});
	return false;	
	});
	
	
});