<?php

/**
 * This is the model class for table "{{blocks}}".
 *
 * The followings are the available columns in table '{{blocks}}':
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $content
 * @property integer $position
 * @property string $page_position
 * @property integer $is_view
 * @property integer $view_title
 */
class Blocks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Blocks the static model class
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
		return '{{blocks}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, title, content, position, page_position, is_view, view_title', 'required'),
			array('position, is_view, view_title', 'numerical', 'integerOnly'=>true),
			array('name, title, page_position', 'length', 'max'=>255),
			array('id, name, title, content, position, page_position, is_view, view_title', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('admin', 'Name'),
			'title' => Yii::t('admin', 'Title'),
			'content' => Yii::t('admin', 'Content'),
			'position' => Yii::t('admin', 'Position'),
			'page_position' => Yii::t('admin', 'Page Position'),
			'is_view' => Yii::t('admin', 'Is View'),
			'view_title' => Yii::t('admin', 'View Title'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('page_position',$this->page_position,true);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('view_title',$this->view_title);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}