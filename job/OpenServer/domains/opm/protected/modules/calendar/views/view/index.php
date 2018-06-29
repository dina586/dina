<!-- START CONTENT FRAME LEFT -->

<div class = "l-form a-caledar_form">
	<?php $this->renderPartial('application.modules.calendar.views.view._form', array('model'=>$model));?>
</div>
			
<div class = "d-calendar_request"></div>
			
			
<div class = "block">
	<div class = "col-md-4">
		<div class = "b-calendar_add">
			<?=Helper::linkButton('Add Event', Yii::app()->createUrl('/calendar/view/create'), array('color' => BsHtml::BUTTON_COLOR_SUCCESS, 'class'=>'j-caledar_form_show'));?>
		</div>
		<div class = "b-calendar_add">
			<?=Helper::linkButton('Client List', Yii::app()->createUrl('/user/admin'), array('color' => BsHtml::BUTTON_COLOR_SUCCESS));?>
		</div>
		<div class = "b-calendar_add">
			<?=Helper::linkButton('Add New Client', Yii::app()->createUrl('/user/admin/create'), array('color' => BsHtml::BUTTON_COLOR_SUCCESS));?>
		</div>
		
		<div class = "b-calendar_add">
			<?=Helper::linkButton('Quick Client Registration', Yii::app()->createUrl('/user/admin/quick'), array('color' => BsHtml::BUTTON_COLOR_SUCCESS));?>
		</div>
		
		<div class = "panel panel-primary">
			
			<div class="panel-heading ui-draggable-handle">
				<h3 class="panel-title">OPM Employees</h3>
			</div>
			
			<div class = "panel-body b-calendar_workers">
				
				<div class = "b-filter_check_all j-filter_check_status">
					<div class = "col-md-6">
						<?php 
							echo BsHtml::checkBoxControlGroup('k-check_all_workers', true, array('label'=>'Check All'));
						?>
					</div>
					
					<div class = "col-md-6">
						<?php 
							echo BsHtml::checkBoxControlGroup('k-uncheck_all', false, array('label'=>'Uncheck All'));
						?>
					</div>
					<div class = "g-clear_fix"></div>
				</div>
				
				<div class = "a-filter_workers">
					<?php 
						$workers = CalendarWorkers::model()->findAll();
						foreach($workers as $worker) {
							echo '<div class = "col-md-6">';
								echo BsHtml::checkBoxControlGroup('workers_'.$worker->id, true, array('label'=>$worker->name, 'labelOptions'=>array('style'=>'color:'.$worker->color.'', 'value'=>$worker->id)));
							echo '</div>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<div class = "col-md-8 b-calendar">
		<?php $this->widget('ext.calendar.EFullCalendar', array(
		    'options'=>array(
		        'header'=>array(
		            'left'=>'prev,next today',
		            'center'=>'title',
		            'right'=>'month,agendaWeek,agendaDay',
		        ),
		    	'selectHelper'=> true,
		        'lazyFetching'=>true,
				'defaultView'=>'agendaWeek',
				'slotEventOverlap'=>true,
				'minTime' =>'08:00:00',
				'maxTime' =>'19:00:00',
				'weekMode'=>'liquid',
				'axisFormat'=>'hh:mm tt',
				'timeFormat'=>array('agenda'=>'H:mm - H:mm'),
				'slotMinutes'=>15,
		        'events'=>Yii::app()->createUrl('calendar/view/getEvents'), // action URL for dynamic events, or
		 		
		    )
		));
		
		?>
	</div>

</div>
<div class = "g-clear_fix"></div>

<?php
$this->widget('bootstrap.widgets.BsModal', array(
    'id' => 'j-calendar_modal',
    'header' => 'Event Information',
    'content' => '',
    'footer' => array(
        Helper::linkButton('Edit', '#', array(
			'class'=>'d-calendar_edit',
        )),
        BsHtml::button('Close', array(
            'data-dismiss' => 'modal'
        ))
    )
));
?>
 