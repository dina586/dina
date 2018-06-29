<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Design extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{design}}';
	}

	public function rules()
	{

		return array(
			['name, catalog_id, position', 'required'],
			['catalog_id, position', 'numerical', 'integerOnly'=>true],
			['name', 'length', 'max'=>255],
			['id, name, catalog_id, position', 'safe', 'on'=>'search'],
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
			'id' => Yii::t('admin', 'ID'),
			'name' => Yii::t('admin', 'Name'),
			'catalog_id' => Yii::t('admin', 'Каталог'),
			'position' => Yii::t('admin', 'Position'),
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('catalog_id',$this->catalog_id);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder' => 'catalog_id ASC, position',
			),
		));
	}
}