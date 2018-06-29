<?php

/**
 * This is the model class for table "{{video_codes}}".
 *
 * The followings are the available columns in table '{{video_codes}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $video_id
 * @property string $code
 * @property string $create_date
 */
class VideoCodes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VideoCodes the static model class
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
		return '{{video_codes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('user_id, video_id, code, create_date, invoice_id', 'required'),
			array('user_id, video_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>255),
			array('id, user_id, video_id, code, create_date', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('admin', 'ID'),
			'user_id' => Yii::t('admin', 'User'),
			'video_id' => Yii::t('admin', 'Video'),
			'code' => Yii::t('admin', 'Code'),
			'create_date' => Yii::t('admin', 'Create Date'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('video_id',$this->video_id);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}