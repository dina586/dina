/*
=================================================================
						АВАТАРЫ
=================================================================
*/

/**
 * Аватар появление ссылок при наведении
 */
$(document).on('mouseenter', '#j-avatar_controls', function() {
	$('#a-avatar_delete, #j-avatar_links').stop(true, true);
	$('#a-avatar_delete').fadeIn(300);
	$('#j-avatar_links').css({'height': '0px'}).show().animate({height: "54px"}, 300);
})

/**
 * Аватар сокрытие ссылок при наведении
 */
$(document).on('mouseleave', '#j-avatar_controls', function() {
	$('#a-avatar_delete').fadeOut(300);
	$('#j-avatar_links').animate({height: "0px"}, 300);
})

/**
 * Вырезка первичного изображения аватара
 */
function crop_avatar(id, fileName, responseJSON) {
	$('#j-avatar_block').removeClass('l-hidden');
	
	if(responseJSON.success != true) {
		responseJSON.responseText = responseJSON.message;
		error_avatar_upload(id, fileName, responseJSON)
		return false;
	}
		
	$('#j-avatar_img_container').html('<img src = "'+responseJSON.imagepath+'" alt = "" id = "j-avatar_img" class = ""/>'); 
	$('.qq-upload-success').remove();
	
	$('#j-avatar_success_upload').show();
	$('#j-avatar_error_upload').hide();
	var size = [];
	
	$('#j-avatar_img_container img').load(function() {
		size = setCropArea($('#j-avatar_img_container img').width(), $('#j-avatar_img_container img').height(), 
		this.naturalWidth, this.naturalHeight);
		
		size['name']  = responseJSON.image_name;
		updateCoords(size);
		console.log(size);
		$('#j-avatar_img').Jcrop({
			setSelect: [size['x'], size['y'], size['w'], size['h']],
			aspectRatio: 1,
			onSelect: updateCoords,
			minSize: [ size['min_size_x'], size['min_size_y'] ],
		});
	});

}

/**
 * Генерация границ областей и минимальной ширины обрезки изображения
 */
function setCropArea(imgWidth, imgHeight, naturalWidth, naturalHeight) {
	var size = [];
	
	size['custom_width'] = imgWidth;
	size['custom_height'] = imgHeight;
	
	var line, c = 1;
	
	if(imgWidth > imgHeight) {
		c = naturalHeight;
		line = imgHeight;
	}
	else {
		c = imgWidth;
		line = imgWidth;
	}
		
	size['min_size_x'] = parseInt(line/c*400);
	size['min_size_y'] = parseInt(line/c*400);

	/*if(line > 250) {
		size['x'] = 50;
		size['y'] = 50;
		size['w'] = line - size['x']*2;
		size['h'] = line - size['y']*2;
	} else {*/
		size['x'] = 0;
		size['y'] = 0;
		size['w'] = line;
		size['h'] = line;
	//}
	return size;
}

/**
 * Ошибка при загрузке аватара
 */
function error_avatar_upload(id, fileName, responseJSON) {
	$('#j-avatar_success_upload').hide();
	$('#j-avatar_error_upload').show();
	$('#j-avatar_error_upload p').html(responseJSON.responseText);
}

/**
 * Запись координат обрезки в форму
 */
function updateCoords(c)
{
	for (var key in c) {
		$('.j-img_size_'+key+'').val(c[key]);
	}
};