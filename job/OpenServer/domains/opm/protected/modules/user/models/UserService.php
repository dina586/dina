<?php
Yii::import('application.modules.calendar.models.*');
class UserService extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserService the static model class
	 */
	public $multiple;
	public $isVisit = array(0=>'No', 1=>'Yes');
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_service}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('procedure_id, price, visit_date, user_id', 'required'),
			array('service_id, multiple, comment, worker_id, view_in_calendar, signature', 'safe'),
			array('service_id, procedure_id, is_visit, user_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('id, service_id, procedure_id, price, is_visit, visit_date, comment, user_id', 'safe', 'on'=>'search'),
			array('worker_id', 'required', 'on'=>'add_to_calendar'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
			'service'=>array(self::BELONGS_TO, 'Service', 'service_id'),
			'worker'=>array(self::BELONGS_TO, 'CalendarWorkers', 'worker_id'),
			'procedure'=>array(self::BELONGS_TO, 'ServiceProcedure', 'procedure_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'service_id' => 'Service',
			'procedure_id' => 'Procedure',
			'price' => 'Price',
			'is_visit' => 'Visited',
			'visit_date' => 'Visit date',
			'comment' => 'Comment',
			'user_id' => 'User',
			'multiple'=> 'Multiple procedures',
			'worker_id'=> 'Employee',
			'view_in_calendar'=> 'View In Calendar',
		);
	}
	
	public function behaviors(){
		return array(
			'dateBehavior' =>array(
				'class' => 'application.components.behavior.DateBehavior',
				'datetime'=>array('visit_date'),
			),
			'fileManagerBehavior' => array(
				'class'=> 'application.components.behavior.FileManagerBehavior',
			),
			'invoiceBehavior' => array(
				'class'=> 'application.modules.invoice.behavior.InvoiceBehavior',
				'type'=>2,
				'itemFields'=>
					array(
						'itemName'=>'name', 
						'itemQty'=>1, 
						'itemPrice'=>'price',
						'connect'=>'procedure',
					),
			),
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('procedure_id',$this->procedure_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('is_visit',$this->is_visit);
		$criteria->compare('visit_date',$this->visit_date,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	public function beforeValidate(){
		if($this->view_in_calendar == 0)
			$this->worker_id = '';
		parent::beforeValidate();
		return true;
	
	}
	protected function beforeSave(){
		$this->comment = nl2br($this->comment);
		$this->service_id = $this->procedure->service_id;
	
		parent::beforeSave();
		return true;
	}
	
	protected function afterSave() {
		$endDate = new DateTime($this->visit_date);
		$endDate->modify("+".$this->procedure->procedure_length." minutes");
		
		$comment = '<p><b>Client:</b> '.Helper::userLink($this->user_id, array('target'=>'_blank')).'</p>';
		$comment .= '<p><b>Service:</b> '.$this->procedure->service->name.'</p>';
		$comment .= '<p><b>Procedure:</b> '.$this->procedure->name.'</p>';
		if($this->comment != '')
			$comment .= '<p><b>Comment:</b> '.$this->comment.'</p>';
		
		if($this->view_in_calendar == 1)
			Calendar::saveCalendar($this->procedure->service->name.' for '.Helper::userName($this->user_id), $this->visit_date, $endDate->format('Y-m-d H:i:s'), $this->id, 'UserService', $this->worker_id, $comment, $this->user_id);
		else
			Calendar::deleteCalendar($this->id, 'UserService');
		
		parent::afterSave();
		return true;
	}
	
	protected function afterDelete() {
		Calendar::deleteCalendar($this->id, 'UserService');
		
		parent::afterDelete();
		return true;
	}
	
	/**
	 * Автодобавление доп процедур для пользователя
	 * @param int $id
	 * @param int $serviceId
	 * @param datetime $startDate
	 * @param int $userId
	 */
	protected function generateProcedures($id, $serviceId, $startDate, $userId) {
		$d = new DateTime($startDate);
		
		$model = ServiceProcedure::model()->findByPk($id);
		$sqlData = ServiceProcedure::model()->findAll(
			array(
				'condition'=>'service_id=:service_id AND number>:number', 
				'params'=>array(':service_id'=>$serviceId, ':number'=>$model->number),
				'order'=>'number ASC',
			));
		
		if(count($sqlData)>0){
			foreach($sqlData as $data){
				$procedure = new self;
				$procedure->service_id = $data->service_id;
				$procedure->procedure_id = $data->id;
				$procedure->price = $data->price;
				$procedure->is_visit = 0;
				$procedure->user_id = $userId;
				$d->modify( '+'.$data->days.' days' );
			
				$procedure->visit_date = $d->format(System::getDateTimeFormat());
				$procedure->save();
			}
		}
	}
}