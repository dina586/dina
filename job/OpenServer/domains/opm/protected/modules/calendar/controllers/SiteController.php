<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class SiteController extends Controller {

	public $layout = '//layouts/site';

	public function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'index':
				return Yii::t('admin', 'Calendar');
				break;
		}
	}

	protected function beforeAction($event) {
		$this->seo($this->titles());
		return true;
	}

	public function filters() {
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('index', 'getEvents', 'serviceInfo', 'workerInfo', 'registerEvent'),
				'users' => array('*'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	public function actionIndex($id = '') {
		Yii::app()->clientScript->registerPackage('ajaxForm');
		Yii::app()->clientScript->registerPackage('calendar_module');
		Yii::import('application.modules.service.models.*');
		$workers = CHtml::listData(CalendarWorkers::model()->findAll(), 'id', 'name');
		$services = CHtml::listData(Service::model()->findAll('is_view = 1 AND view_on_site = 1'), 'id', 'name');
		asort($services);
		
		$this->render('index', ['workers'=>$workers, 'services'=>$services, 'id'=>$id]);
	}
	
	/**
	 * Получаем информацию о сервисе
	 */
	public function actionServiceInfo() {
		$id = Yii::app()->request->getParam('id');
		Yii::import('application.modules.service.models.*');
		$model = Service::model()->findByPk($id);
		$view = '';
		if($model !== null) {
			$procedure = ServiceProcedure::model()->find('service_id=:service_id AND number = 1', [':service_id'=>$model->id]);
			if($procedure !== null) {
				$view = $this->renderPartial('_procedure_info', ['model'=>$model, 'procedure'=>$procedure], true);
			}
		}
		echo $view;
	}
	
	/**
	 * Получаем информацию о работнике
	 */
	public function actionWorkerInfo() {
		$id = Yii::app()->request->getParam('id');
		$model = CalendarWorkers::model()->findByPk($id);
		$view = '';
		if($model !== null) {
			$view = $model->description;
		}
		echo $view;
	}

	public function actionGetEvents() {
		Yii::import('application.modules.service.models.*');
		
		$startDate = date('Y-m-d', Yii::app()->request->getParam('start'));

		$endDate = date('Y-m-d', Yii::app()->request->getParam('end'));
		$workerId = Yii::app()->request->getParam('worker');
		$serviceId = Yii::app()->request->getParam('service');
		$events = array();
		
		//Поиск длительности процедуры
		$procedure = $this->getProcedure($serviceId);
		
		if($procedure === null)
			$procedureLength = 15;
		else
			$procedureLength = $procedure->procedure_length;
		
		//Даем возможность записаться на клетку впритык текущей процедуре
		$procedureLength = $procedureLength - 15;
		if($procedureLength<0)
			$procedureLength = 0;
		
		//Создаем массив событий
		if($workerId != '' && $serviceId != '') {
			$model = new Calendar();
			$criteria = Calendar::model()->searchEvents($model, $startDate, $endDate, $workerId);
			$sqlData = Calendar::model()->findAll($criteria);
			if (count($sqlData) > 0):
				foreach ($sqlData as $v) {
					$dateTime = new DateTime($v->start_date);
					$dateTime->modify("-".$procedureLength." minutes");
					
					$events[] = array(
						'start' => System::saveDate($dateTime->format('Y-m-d H:i:s'), 'datetime'),
						'end' => System::saveDate($v->end_date, 'datetime'),
						'color' => '#8d0e0e',
						'allDay' => false,
						'rendering' => 'background',
					);
				}
			endif;
		}
		
		//Приводим записи в нормальный вид, что бы не было наползаний
		for($i = 0; $i < count($events); $i++) {
			$j = $i + 1;
			if($j >= count($events))
				break;
			if($events[$j]['start'] < $events[$i]['end'])
				$events[$i]['end'] = $events[$j]['start'];
		}
	
		if(date('w', strtotime($startDate)) == 1)
			$monday = 'Monday this week';
		else
			$monday = 'next Monday';
		$monday = 'next Monday';
		//Понедельник - выходной
		$mondayStart = new DateTime(''.$startDate.' 00:00:00');
		//$mondayStart->modify('Monday this week');
		$mondayStart->modify($monday);
		
		$mondayEnd = new DateTime(''.$startDate.' 00:00:00');
		//$mondayEnd->modify('Monday this week');
		$mondayEnd->modify($monday);
		
		//Понедельник - выходной
		$events[] = array(
			'start' => $mondayStart->format('Y-m-d 00:00:00'),
			'end' => $mondayEnd->format('Y-m-d 23:00:00'),
			'color' => '#8d0e0e',
			'allDay' => false,
			'rendering' => 'background',
		);
	
		echo json_encode($events);
	}

	public function actionRegisterEvent() {
		if(!Yii::app()->request->isAjaxRequest) 
			throw new CHttpException(403, Yii::t('admin', 'Access denie'));
		Yii::import('application.modules.user.models.*');
		
		$startDate = Yii::app()->request->getParam('start_date');
		$workerId = Yii::app()->request->getParam('worker');
		$serviceId = Yii::app()->request->getParam('service');
		$json = ['status'=> 'error', 'message'=>'An error occupied. Please, try again!'];
		$model = new QuickRegistration();
		
		if(isset($_POST['QuickRegistration'])) {
			$model->attributes = $_POST['QuickRegistration']; 
			if($model->validate())	{
				$userId = User::model()->saveUser($model->attributes, [5]);
				
				$procedure = $this->getProcedure($serviceId);

				if($procedure !== null) {
					$service = new UserService();
					$service->user_id = $userId;
					$service->procedure_id = $procedure->id;
					$service->price = $procedure->price;
					$service->worker_id = $workerId;
					$service->view_in_calendar = 1;
					$service->visit_date = $startDate;
					$service->save();
					
					$json['message'] = Email::send('calendar_event', 
						array(
							'visit_date'=>  System::viewDate($startDate, 'datetime'),
							'link'=>Yii::app()->createAbsoluteUrl('service/view/view', ['url'=>$procedure->service->url]),
							'name' => $model->firstname.' '.$model->lastname,
							'service_name' => $procedure->service->site_name,
						), 
						$model->firstname.' '.$model->lastname, 
						$model->email
					);
					$json['status'] = 'ok';
					 
					
					Email::send('admin_calendar_event', array(
						'link'=>Yii::app()->createAbsoluteUrl('user/procedure/update', ['id'=>$service->id]),
						'user_link'=>Yii::app()->createAbsoluteUrl('user/admin/view', ['id'=>$userId]),
						'service_name'=>$procedure->service->name,
					));
				}
				else 
					$json['message'] = 'Sorry, this time you cant register on this procedure! Choose other or contact us! Thank you!';
			}
		}
		echo $json['message'];
	}
	
	protected function getProcedure($serviceId) {
		Yii::import('application.modules.service.models.*');

		//Поиск длительности процедуры
		$service = Service::model()->findByPk($serviceId);
		if ($service !== null)
			$procedure = ServiceProcedure::model()->find('service_id=:service_id AND number = 1', [':service_id' => $service->id]);
		else
			$procedure = null;
		return $procedure;
	}

}
