<div class = "b-site_calendar">
	<div class ="col-md-4">
		<h1 class = "l-page_title">Service Registration</h1>
		<div class = "b-site_calendar_steps">
			<div class ="b-site_calendar_step">
				<p class = "site_calendar_step_title">Step one:</p>
				<?=BsHtml::dropDownList('service', $id, $services, ['empty' => 'Choose Service', 'class'=>'j-site_service', 'data-link'=>'serviceInfo']) ?>
				<div class = "b-site_calendar_step_details d-calendar_step_details g-styles"></div>
			</div>

			<div class ="b-site_calendar_step">
				<p class = "site_calendar_step_title">Step two:</p>
				<?=BsHtml::dropDownList('worker', '', $workers, ['empty' => 'Choose your Master', 'class'=>'j-site_worker', 'data-link'=>'workerInfo']) ?>
				<div class = "b-site_calendar_step_details d-calendar_step_details g-styles"></div>
			</div>
		</div>
		<div class = "b-site_calendar_info">
			<h2 class = "l-page_title">How to register on service?</h2>
			<p>To schedule a visit, please, select your master and click in the white or gray cell.
				Choose the best time in the calendar for your visit.</p>
			<p class = "calendar_info_green">Red cells show that it’s already occupied or not available for an appointment.</p>
			<p>Fill out a registration form to register for the service!</p>
			<p class = "calendar_info_green">Thank You!</p>
		</div>
	</div>
	<div class = "col-md-8 pull-right">
		<div class = "j-site_calendar_message b-site_calendar_message"></div>
		<div class = "j-site_calendar">
			<?php
			$this->widget('ext.calendar.EFullCalendar', array(
				'id' => 'j-site_calendar',
				'autoInit'=>false,
				'options' => array(
					'header' => array(
						'left' => 'prev,next today',
						'center' => 'title',
						'right' => '',
					),
					'allDaySlot' => false,
					//'weekends' => false,
					'lazyFetching' => true,
					'defaultView' => 'agendaWeek',
					'slotEventOverlap' => true,
					'minTime' => '10:00:00',
					'maxTime' => '20:00:00',
					'weekMode' => 'liquid',
					'axisFormat' => 'hh:mm tt',
					'timeFormat' => array('agenda' => ''),
					'slotMinutes' => 15,
					'snapMinutes' => 15,
					'slotDuration' => '00:15:00',
					'events' => Yii::app()->createUrl('calendar/site/getEvents'),
					'viewRender' => 'js:function(view, element) {
					$("#j-site_calendar").fullCalendar("option", "contentHeight", (view.name === "month")? NaN : 9999);
					var minDate = moment();
					if (minDate >= view.start && minDate <= view.end) {
						$(".fc-button-prev").prop("disabled", true); 
						$(".fc-button-prev").addClass("fc-state-disabled"); 
					}
					else {
						$(".fc-button-prev").removeClass("fc-state-disabled"); 
						$(".fc-button-prev").prop("disabled", false); 
					}
				}',
					//Selection 
					'selectable' => true,
					'selectHelper' => false,
					'selectOverlap' => false,
					'select' => 'js:function() {
				}',
				'eventRender' => 'js:function(event, element) {
					$(".fc-event").removeClass("fc-event-start").removeClass("fc-event-end");
					var width = $(".b-site_calendar .fc-agenda-days thead > tr > th:eq(2)").width();
					$(".fc-event-inner").css({"width":width+"px"});

				}',
				)
			));
			?>
		</div>
	</div>
	<div class ="g-clear_fix"></div>
</div>
<?php
JS::add('initSiteCalendar', 'initSiteCalendar()');
$this->widget('application.modules.calendar.widgets.SiteRegistrationWidget');
?>

