var xhr = null;
(function(window,undefined){
    var History = window.history; 
    if ( !History.enabled ) {
        return false;
    }
})(window);

function ajaxRender(url) {
	if(xhr!=null){
		xhr.abort();           
	}
	xhr = $.ajax({
		type: 'POST',
		beforeSend: function() {
			$('.d-content').html('<img src = "/images/page_preloader.gif" alt = "loading..."/>');
		},
		url: url,
		data: ({ajax_render:1}),
		success: function(data, status, jqXHR) {
			History.pushState({ajaxData:data}, null, url);
			$('.d-content').html(data);
		},
		complete: function() {
		}
	})
}
/*Фукнция для формирования параметров, инициалируется при обновлении грида*/
function updateGrid() {
	var params = {};
	var url = 'http://'+window.location.hostname + $('input[name=page_url]').val();
	var urlParams = '';
	$('#a-admin_grid_view .filters input, #a-admin_grid_view .filters select, .a-grid_filter').each(function() {
		var name = $(this).attr('name');
		params[name] = $(this).val();
		if(urlParams != '') {
			urlParams = urlParams+'&'+name+'='+$(this).val();
		} else {
			urlParams = urlParams+'?'+name+'='+$(this).val();
		}
		params.ajax_render = 1;
	});
	
	$.ajax({
		type: 'GET',
		beforeSend: function() {
			//$('.d-content').html('<img src = "/images/page_preloader.gif" alt = "loading..."/>');
		},
		url: url,
		data: (params),
		success: function(data, status, jqXHR) {
			History.pushState({ajaxData:data}, null, url+urlParams);
			$('.d-content').html(data);
		},
		complete: function() {
		}
	})

}
$(document).ready(function() {
	
	/*Первая загрузка страницы*/
	var firtContent = $('.d-content').html();
	var State = History.getState();
	if(State.data.ajaxData != firtContent) {
		History.pushState({ajaxData:firtContent}, null, window.location.href);
	}

	/*Обработка нажатия клавиш браузера "вперед" и "назад"*/
	window.setTimeout(function()  { 
		window.addEventListener("popstate", function(e) { 
			var State = History.getState();
			$('.d-content').html(State.data.ajaxData);
			e.preventDefault(); 
		}, false); 
	},1);  

	/*Аякс загрузка страниц*/
	$('.a-links_container a:not(.a-no_link), .a-link:not(.b-admin .a-link)').live('click', function(){
		var url = $(this).attr('href');
		ajaxRender(url);
		return false;
	})
})
/*Обновление грида при использовании фильтров*/
$('#a-admin_grid_view .filters input, #a-admin_grid_view .filters select, .a-grid_filter').live('change', function() {
	updateGrid();
})

/*Удаление записей из базы*/
$('.a-delete').live('click', function() {
	var url = $(this).attr('href');
	if(url.indexOf('?ajax=a-admin_grid_view') == -1) {
		url = url+ '?ajax=a-admin_grid_view';
	}
	if (confirm("Подтверждаете удаление ?")) {
		$.ajax({
			type: 'POST',
			url: url,
			success: function(data, status, jqXHR) {
				ajaxRender(document.location.href);
			},
		})
	}
	return false;
})
