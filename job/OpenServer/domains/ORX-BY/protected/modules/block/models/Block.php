<?php

/**
 * This is the model class for table "{{Sblock}}".
 *
 * The followings are the available columns in table '{{Sblock}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $block_id
 */
class Block extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Block the static model class
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
		return '{{Sblock}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, block_id', 'required'),
			array('block_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, block_id', 'safe', 'on'=>'search'),
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
			'description' => 'Описание',
			'block_id' => 'Блок',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('block_id',$this->block_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function viewBlock($blockId){
		$data = Yii::app()->db->createCommand()
	    ->select('*')
	    ->from(self::model()->tableName())
	    ->where('block_id =:block_id', array(':block_id'=>$blockId))
	    ->queryAll();
		return $data;
	}
}