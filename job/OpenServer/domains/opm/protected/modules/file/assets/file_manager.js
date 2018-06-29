var xhr = null;
//Удаление позиции
$(document).on('click', '.a-file_manager_item_delete', function() {
	var img = $(this);
	var url = $(this).attr('href');

	$.ajax({
		type: 'POST',
		url: url,
		success: function(data) {
			img.parents('.d-file_manager_item').remove();
		},
	})
	return false;
})

$(document).ready(function(){
	//Сохранение описания
	$(document).on('keypress', '.j-file_manager_description', throttle(function () {
		var data = new Object();
		var index = $('.j-file_manager_description').index(this);
		data['id'] = $('.d-file_manager_item').eq(index).attr('data-item-id');
		data['value'] = $(this).val();
		
		if(xhr!=null){
			xhr.abort();           
		}
		xhr = $.ajax({
			type: 'POST',
			data: data,
			url: '/file/upload/description',
			success: function(data) {
			},
		})
	}));
})

//Перемещаем изображение вниз нажатием
$(document).on('click', '.j-file_manager_move_bottom', function() {
	var index = $('.j-file_manager_move_bottom').index(this);
	var clone = $(this).parents('.d-file_manager_item').clone();
	$(clone).insertAfter($('.d-file_manager_item').eq(index+1));
	$(this).parents('.d-file_manager_item').remove();
	
	sendImagesPosion();
	return false;
})

//Перемещаем изображение вверх нажатием
$(document).on('click', '.j-file_manager_move_top', function() {
	var index = $('.j-file_manager_move_top').index(this);
	var clone = $(this).parents('.d-file_manager_item').clone();
	$(clone).insertBefore($('.d-file_manager_item').eq(index-1));
	$(this).parents('.d-file_manager_item').remove();

	sendImagesPosion();
	return false;
})

//Устанавливаем изображение на обложку
$(document).on('click', '.d-file_manager_item .a-file_manager_cover', function() {
	if(xhr!=null){
		xhr.abort();           
	}
	var url = $(this).attr('href');
	var index = $('.d-file_manager_item .a-file_manager_cover').index(this);
	xhr = $.ajax({
		type: 'POST',
		url: url,
		success: function(data) {
			$('.d-file_manager_item .j-file_manager_cover').remove();
			$('.d-file_manager_item .j-file_manager_file').eq(index).prepend(data);
		},
	});
	return false;
})
//Изменение позиции изображений
function sendImagesPosion() {
	if(xhr!=null){
		xhr.abort();           
	}
	var images = new Object();
	$('#d-file_manager_items .d-file_manager_item').each(function() {
		var index = $('#d-file_manager_items .d-file_manager_item').index(this);
		var currentId = $(this).attr('data-item-id');
		images[currentId] = index;
	});

	xhr = $.ajax({
		type: 'POST',
		data: images,
		url: '/file/upload/position',
		success: function(data) {
		},
	})
}