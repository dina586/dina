var xhrFrom = null;
/*$(document).on('click', '.j-caledar_form_show', function() {
	$('.a-caledar_form').slideDown(500);
	$('.d-calendar_request').html('');
	return false;
})

$(document).on('click', '.j-caledar_form_hide', function() {
	$('.a-caledar_form').slideUp(500);
	return false;
})
//Добавление нового события

$(document).on('click', ".a-caledar_form .a-add_event", function() { 
	var formAction = $(this).parents('form').attr("action");
		
	$(this).parents('form').ajaxForm({
		beforeSubmit:  function() {
			if(xhrFrom!= null){
				return false;
			}
			xhrFrom = 'not allow';
			$('.d-calendar_request').html('Loading...');
		},
		error: function(data){
		},
		success: function(data) {
			$('.a-caledar_form').slideUp(200);
			$('.a-caledar_form input').eq(0).val('');
			$('.d-calendar_request').html(data);
			viewNeededWorkers();
		},
		complete: function(responseText, statusText, xhr) {
			xhrFrom = null;
		}
	})
});
*/
//Загрузка данных о событии
$(document).on('click', 'a.fc-event', function() {
	var link = $(this).attr('href');
	var id = link.replace('#', '');
	$.ajax({
		type : 'POST',
		url : '/calendar/view/eventData',
		data: {'id':id},
		beforeSend:  function() {
			if(xhrFrom!= null){
				return false;
			}
			xhrFrom = 'not allow';
			$("#j-calendar_modal").modal("show");
			$("#j-calendar_modal .modal-header h3").html('Loading event details...');
			$("#j-calendar_modal .modal-body").html('');
		},
		success: function(data) {
			var json = $.parseJSON(data);
			$("#j-calendar_modal .d-calendar_edit").removeClass('j-new_tab_event_edit').removeAttr('target');
			if(json.status == 'ok') {
				$("#j-calendar_modal .modal-header h3").html(json.name);
				$("#j-calendar_modal .d-calendar_edit").show().attr('href', json.link);
				if(json.link_new_tab == 1)
					$("#j-calendar_modal .d-calendar_edit").addClass('j-new_tab_event_edit').attr('target', '_blank');
			} else {
				$("#j-calendar_modal .modal-header h3").html('Event Information');
				$("#j-calendar_modal .d-calendar_edit").hide();
			}
			$("#j-calendar_modal .modal-body").html(json.content);
			
		},
		error: function(data){
			$("#j-calendar_modal .modal-body").html(data);
		},
		complete: function(responseText, statusText, xhr) {
			xhrFrom = null;
		}
		
	})
	return false;
})

//Отметить или убрать чекбоксы работников в календаре
$(document).on('change', '.j-filter_check_status input', function() {
	var name = $(this).attr('name');
	if($(this).is(':checked')) {
		if(name == 'k-check_all_workers') {
			$('.a-filter_workers input').prop('checked', true); 
			$('#k-uncheck_all').prop('checked', false); 
		} else {
			$('.a-filter_workers input').prop('checked', false); 
			$('#k-check_all_workers').prop('checked', false); 
		}
	}
	viewNeededWorkers();
})

$(document).on('change', '.a-filter_workers input', function() {
	$('#k-uncheck_all, #k-check_all_workers').prop('checked', false); 
	viewNeededWorkers();
})

//Сбор данных из фильтров и повторная инициализация календаря
function viewNeededWorkers() {
	var formData = new Array();
	$('.a-filter_workers input').each(function () {
		if($(this).is(':checked')) {
			var val = $(this).attr('name').replace('workers_', '');
			formData['Workers['+val+']'] = val;
		}
	})
	
	JSON.stringify(formData);
	
	$("#yw0").fullCalendar('destroy').fullCalendar({'header':{'left':'prev,next today','center':'title','right':'month,agendaWeek,agendaDay'},'selectHelper':true,'lazyFetching':true,'defaultView':'agendaWeek','slotEventOverlap':true,'minTime':'08:00:00','maxTime':'19:00:00','weekMode':'liquid','axisFormat':'hh:mm tt','timeFormat':{'agenda':'H:mm - H:mm'},'slotMinutes':15,'events':'/calendar/view/getEvents'});
}

function initSiteCalendar() {
	var service = $('.j-site_service').val();
	var worker = $('.j-site_worker').val();
	
	if(service != '' && worker != '') {
		$('.j-site_calendar').show().css({'opacity':'1'});
		$('.j-site_calendar_message').hide(); 
		return true;
	} else {
		$('.j-site_calendar').hide();
		$('.j-site_calendar_message').show();
		if(service == '' && worker == '')
			$('.j-site_calendar_message').html('Choose Service and your Master');
		else if(service != '')
			$('.j-site_calendar_message').html('Choose your Master');
		else
			$('.j-site_calendar_message').html('Choose Service');
		return false;
	}
		
}

/*
 * Код инициализации календаря на сайте
 */
function siteCalendarCode() {
	var service = $('.j-site_service').val();
	var worker = $('.j-site_worker').val();
	var currentDate = new Date();

	$("#j-site_calendar").fullCalendar('destroy').fullCalendar({
		'header': {
			'left': 'prev,next today',
			'center': 'title',
			'right': ''
		},
		'allDaySlot': false,
		'lazyFetching': true,
		'defaultView': 'agendaWeek',
		'slotEventOverlap': true,
		'minTime': '10:00:00',
		'maxTime': '20:00:00',
		'weekMode': 'liquid',
		'axisFormat': 'hh:mm tt',
		'timeFormat': {
			'agenda': ''
		},
		'firstDay': currentDate.getDay(),
		'slotMinutes': 15,
		'snapMinutes': 15,
		'slotDuration': '00:15:00',
		'events': {
			url: '/calendar/site/getEvents',
			type: 'POST',
			data: {
				service: service,
				worker: worker
			}
		},
		'viewRender': function(view, element) {
			$("#j-site_calendar").fullCalendar("option", "contentHeight", (view.name === "month") ? NaN : 9999);
			var minDate = moment();
			if (minDate >= view.start && minDate <= view.end) {
				$(".fc-button-prev").prop("disabled", true);
				$(".fc-button-prev").addClass("fc-state-disabled");
			} else {
				$(".fc-button-prev").removeClass("fc-state-disabled");
				$(".fc-button-prev").prop("disabled", false);
			}
		},
		'selectable': true,
		'selectHelper': false,
		'selectOverlap': false,
		'select': function( startDate, endDate, allDay, jsEvent, view ) {
			$("#j-calendar_registration_dialog").modal("show");
			$('.j-calendar_start_date').val(startDate);
		},
		'eventRender': function(event, element) {
			$(".fc-event").removeClass("fc-event-start").removeClass("fc-event-end");
			var width = $(".b-site_calendar .fc-agenda-days thead > tr > th:eq(2)").width();
			$(".fc-event-inner").css({
				"width": width + "px"
			});
		}
	});
	
	var cellCount = parseInt($('.fc-agenda-days > thead > tr > th').length) - 2;
	var width = 100/cellCount;
	var extraCell = '<span class = "j-extra_table_cell b-extra_table_cell" style = "width:'+width+'%;"></span>';
	var insertTable = '';
	for(var i = 0; i<cellCount; i++) {
		insertTable = insertTable + extraCell;
	}
	$("table.fc-agenda-slots td.fc-widget-content div").each(function () { 
		$(this).html(""+insertTable+""); 
	});
	
	$('.j-extra_table_cell').hover(
		function() {
			$(this).html($(this).parents('tr').find('th').html());
		}, function() {
			$(this).html('');
		}
	)
}

/*
 * Подгрузка данных при изменении выбора полей и показ календаря
 */
$(document).on('change', '.j-site_service, .j-site_worker', function() {
	var isInit = initSiteCalendar();
	var id = $(this).val();
	var select = $(this);
	var link = $(this).attr('data-link');
	ajaxServiceInfo(link, select, id);
	
	if(isInit == true){
		siteCalendarCode();
	}
	
})

/*
 * Изменение значения поля сервиса на сайте
 */
function ajaxServiceInfo(link, select, id) {
	$.ajax({
		type : 'POST',
		url : '/calendar/site/'+link+'',
		data: {'id':id},
		beforeSend:  function() {
			if(xhrFrom!= null){
				return false;
			}
			xhrFrom = 'not allow';
			select.siblings( ".d-calendar_step_details" ).html('<img src = "/images/system/page_preloader.gif" alt = "Loading..."/>');
		},
		success: function(data) {
			select.siblings( ".d-calendar_step_details" ).html(data);
		},
		error: function(data){
			select.siblings( ".d-calendar_step_details" ).html(data);
		},
		complete: function(responseText, statusText, xhr) {
			xhrFrom = null;
		}
		
	})
}

$(document).on('click', '.a-register_event', function() {
	var formAction = $(this).parents('form').attr("action");
	var form = $(this).parents('form');
	
	var service = $('.j-site_service').val();
	var worker = $('.j-site_worker').val();
	form.ajaxForm({
		beforeSubmit:  function() {
			if(xhrFrom!= null){
				return false;
			}
			xhrFrom = 'not allow';
		},
		data: { service:service, worker:worker},
		error: function(data){
			$("#j-message_dialog").modal("show");
			$("#j-message_dialog .modal-body").html('An error occupied. Try again!');
		},
		success: function(data) {
			$("#j-message_dialog .modal-body").html(data);
			$("#j-message_dialog").modal("show");
		},
		complete: function(responseText, statusText, xhr) {
			$("#j-calendar_registration_dialog").modal("hide");
			form.clearForm();
			xhrFrom = null;
			siteCalendarCode();
		}
	})
});

