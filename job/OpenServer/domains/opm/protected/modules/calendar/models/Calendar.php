<?php

/**
 * This is the model class for table "{{calendar}}".
 *
 * The followings are the available columns in table '{{calendar}}':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $start_date
 * @property string $end_date
 * @property integer $user_id
 * @property integer $worker_id
 * @property integer $status
 */
class Calendar extends CActiveRecord
{
	public $f_start_date;
	public $f_end_date;
	public $f_start_time;
	public $f_end_time;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Calendar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{calendar}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, start_date, end_date, worker_id', 'required'),
			array('user_name, procedure_id, f_start_date, f_end_date, f_start_time, f_end_time, start_date, end_time, status, user_id, content, model_id, model_name', 'safe'),
			array('user_id, worker_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('id, name, content, start_date, end_date, user_id, worker_id, status', 'safe', 'on'=>'search'),
		);
	}
	
	public function checkExist($attribute) {
		$searchAttr = trim($attribute, '_id');
		$model =  ucfirst($searchAttr);
		if($this->$searchAttr != '') {
			if($model::model()->count('user_name_en=:search', array(':search'=>$this->{$searchAttr})) == 0) {
				$message = strtr('This {attribute} does not exists in database. Please, select correct {attribute}', array('{attribute}'=>$this->getAttributeLabel($attribute)));
				$this->addError($attribute, $message);
			}
		}
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
			'worker'=>array(self::BELONGS_TO, 'CalendarWorkers', 'worker_id'),
		);
	}
	
	public function behaviors(){
		return array(
			'dateBehavior' =>array(
				'class' => 'application.components.behavior.DateBehavior',
				'datetime'=>array('end_date', 'start_date'),
			),
		);
	}
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('admin', '№'),
			'name' => Yii::t('admin', 'Event Name'),
			'content' => Yii::t('admin', 'Description'),
			'start_date' => Yii::t('admin', 'Start Date'),
			'f_start_date' => Yii::t('admin', 'Start'),
			'f_start_time' => Yii::t('admin', ''),
			'f_end_time' => Yii::t('admin', 'End'),
			'f_end_date' => Yii::t('admin', ''),
			'end_date' => Yii::t('admin', 'Ent Date'),
			'user_id' => Yii::t('admin', 'User'),
			'worker_id' => Yii::t('admin', 'Worker'),
			'status' => Yii::t('admin', 'Status'),
			'procedure_id' => Yii::t('admin', 'Choose Procedure'),
			'user_name' => Yii::t('admin', 'Client name'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('worker_id',$this->worker_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	public function searchEvents($model, $startDate, $endDate, $workers = array()){
		$criteria = new CDbCriteria();
		$criteria->addCondition("end_date >= :end_date AND start_date <= :start_date");
		$criteria->order = 'start_date, worker_id';
		$criteria->params = array(':end_date'=>$startDate, ':start_date'=>$endDate);
		if(!empty($workers))
			if(is_numeric($workers))
				$criteria->compare('worker_id', $workers);
			else
				$criteria->addInCondition('worker_id', $workers);
		return $criteria;
	}
	
	public function beforeSave() {
		if($this->isNewRecord)
			$this->user_id = Yii::app()->user->id;
		parent::beforeSave();
		return true;
	}
	
	public function beforeValidate() {
		if($this->f_start_date != '')
			$this->start_date = $this->f_start_date.' '.$this->f_start_time;
		if($this->f_end_date != '')
			$this->end_date = $this->f_end_date.' '.$this->f_end_time;
		parent::beforeValidate();
		return true;
	}
	
	public static function saveCalendar($name, $startDate, $endDate, $modelId, $modelName, $worker_id = '', $content = '', $user_id = 1) {
		$model = new self;
		if($modelId != '' && $modelName != '') {
			$model = self::model()->find('model_id=:model_id AND model_name = :model_name', array(':model_id'=>$modelId, ':model_name'=>$modelName));
			if($model === null)
				$model = new self;
		}
		
		$model->name = $name;
		$model->content = $content;
		$model->start_date = $startDate;
		$model->end_date = $endDate;
		if($worker_id =='')
			$worker_id = 0;
		$model->worker_id = $worker_id;
		$model->model_id = $modelId;
		$model->model_name = $modelName;
		$model->user_id = $user_id;
		$model->save();
	}
	
	public static function deleteCalendar($modelId, $modelName){
		$model = self::model()->find('model_id=:model_id AND model_name = :model_name', array(':model_id'=>$modelId, ':model_name'=>$modelName));
		if($model !== null)
			$model->delete();
	}
	
}