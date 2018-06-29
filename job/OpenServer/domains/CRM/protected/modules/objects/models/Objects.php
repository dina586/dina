<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Objects extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{objects}}';
	}

	public function rules()
	{

		return array(
			['name, position', 'required'],
			['content', 'safe'],
			['position', 'numerical', 'integerOnly'=>true],
			['name', 'length', 'max'=>255],
			['id, name, content, position', 'safe', 'on'=>'search'],
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('admin', '№'),
			'name' => Yii::t('admin', 'Name'),
			'content' => Yii::t('admin', 'Content'),
			'position' => Yii::t('admin', 'Position'),
		);
	}
	public function behaviors() {
		return [
			'cacheBehavior' => [
				'class' => 'application.components.behavior.CacheBehavior',
			],
			'fileManagerBehavior' => array(
				'class' => 'application.modules.file.components.FileManagerBehavior',
			),
		];
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'position ASC, id DESC',	
			),
		));
	}
}