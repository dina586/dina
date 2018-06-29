<?php

/**
 * This is the model class for table "{{about}}".
 *
 * The followings are the available columns in table '{{about}}':
 * @property integer $id
 * @property string $name
 * @property string $brief_descr
 * @property string $description
 * @property string $date
 * @property integer $slider_view
 * @property integer $position
 */
class About extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return About the static model class
	 */
	public $image;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{about}}';
	}
	
	
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('name, brief_descr, description, date, position', 'required'),
			array('seo_description, seo_title, seo_keywords', 'safe'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('image',  'file',
				'types'=>'jpg, gif, png, jpeg',
				'allowEmpty'=>'true',
				'maxSize'=>1024 * 1024 * 1, // 1MB
				'tooLarge'=>'Размер загружаемого файла не должен превышать 1 Мегабайта!',
			),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, brief_descr, description, date, slider_view, position', 'safe', 'on'=>'search'),
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
			'brief_descr' => 'Краткое описание',
			'description' => 'Текст',
			'date' => 'Дата',
			'position' => 'Позиция',
			'seo_title'=> 'Заголовок  страницы (title)',
			'seo_keywords' => 'Ключевые слова (keywords)',
			'seo_description' => 'Описание страницы (description)',
			'image' => 'Миниатюра (135x90)',
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
		$criteria->compare('brief_descr',$this->brief_descr,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function sliderData(){
		$data = Yii::app()->db->createCommand()
	    ->select('*')
	    ->from(self::tableName())
	    ->order('position, RAND()')
	    ->where('slider_view = 1')
	    ->queryAll();
		return $data;
	}
}