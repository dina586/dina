<?php

/**
 * This is the model class for table "{{stock1}}".
 *
 * The followings are the available columns in table '{{stock1}}':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $date
 * @property integer $is_view
 */
class Stock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stock the static model class
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
		return '{{stock}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, date, is_view, refresh', 'required'),
			array('content', 'safe'),
			array('is_view', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('id, name, content, date, is_view, refresh', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => 'Название',
			'content' => 'Содержание',
			'date' => 'Дата оконочания',
			'is_view' => 'Статус активности',
			'refresh' => 'Автообновление',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('refresh',$this->refresh);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	public function adminSearchIsView($key){
		$isView = array('1'=>'Активна', '0' => 'Не активна');
		return $isView[$key];
	}
	public function adminSearchRefresh($key){
		$isView = array('1'=>'Да', '0' => 'Нет');
		return $isView[$key];
	}
	public static function getStock($id) {
		$model = self::model()->findByPk($id, 'date<=:date AND is_view = 1', array(':date'=>date("Y-m-d")));
		$date= self::stockDate($model->date, 1);
		
		if($model != null) {
			$content = str_replace('{date}', $date, $model->content); 
			return $content;
			}
		else
			return '';
	}
	
	public static function stockDate($date, $refresh = 0) {
		$newDate = new DateTime($date);
		$view = '';
		if($refresh == 1) {
			if($newDate->format('Y-m-d') <= date('Y-m-d')) {
				$newDate = new DateTime(date('Y-m-d'));
			}
			
			$end = ltrim($newDate->format('d'), '0');
			$endMonthNumber = (int)$newDate->format('n');
		
			$newDate->modify('-3 days');
			$startMonthNumber = (int)$newDate->format('n');
			$start = $newDate->format('d');
			
			if($startMonthNumber != $endMonthNumber)
				$view = ltrim($start, '0').' '.self::month($startMonthNumber).' - '.ltrim($end, '0').' '.self::month($endMonthNumber);
			else 
				$view = ltrim($start, '0').' - '.ltrim($end, '0').' '.self::month($endMonthNumber);

		}
		return $view;
	}
	
	public function month($name) {
		switch($name) {
			case '1': return 'января';
			case '2': return 'февраля';
			case '3': return 'марта';
			case '4': return 'апреля';
			case '5': return 'мая';
			case '6': return 'июня';
			case '7': return 'июля';
			case '8': return 'августа';
			case '9': return 'сентября';
			case '10': return 'октября';
			case '11': return 'ноября';
			case '12': return 'декабря';
		}
	}
}