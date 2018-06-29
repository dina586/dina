<?php

/**
 * This is the model class for table "{{opinions}}".
 *
 * The followings are the available columns in table '{{opinions}}':
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $date
 * @property integer $is_view
 */
class Opinions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Opinions the static model class
	 */
	public $image;
	public $verifyCode;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{opinions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, text, date, is_view, is_new', 'required'),
			array('is_view, is_new', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('image', 'file',
				'types'=>'jpg, gif, png',
				'allowEmpty'=>'true',
				'maxSize'=>1024 * 1024 * 1, // 1MB
				'tooLarge'=>'Размер загружаемого файла не должен превышать 1 Мегабайта!',
			),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, text, date, is_view', 'safe', 'on'=>'search'),
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
			'name' => 'Имя',
			'text' => 'Комментарий',
			'date' => 'Дата',
			'is_view' => 'Отображение',
			'image'=>'Аватар 125x85',
			'verifyCode'=>'Код проверки',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('is_view',$this->is_view);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function checkNew($id) {
		Yii::app()->db->createCommand()->update(
	   		self::model()->tableName(),  
		   	array( 'is_new'=> '0',), 
		   	'id = :id', 
		   	array(':id'=>$id, )
		);
	}
	public static function lastOpinions(){
		$data = Yii::app()->db->createCommand()
	    ->select('*')
	    ->from(self::model()->tableName())
	    ->order('date DESC')
	    ->where('is_view  = 1 AND is_new = 0')
	    ->limit(4)
	    ->queryAll();
		return $data;
	}
}