<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Product extends CActiveRecord {

	const WIDTH = 212;
	const HEIGHT = 162;

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{product}}';
	}

	public function rules() {

		return array(
			['name, content, is_view', 'required'],		
			['description, keywords, title, price', 'safe'],
			['is_view', 'numerical', 'integerOnly' => true],
			['url', 'length', 'max' => 255],
		);
	}

	public function behaviors() {
		return array(
			'imageBehavior' => array(
				'class' => 'application.modules.file.components.ImageBehavior',
				'data'=>array(
					'image'=>array(
						'width'=> self::WIDTH,
						'height'=> self::HEIGHT,
						'folder'=> Yii::app()->getModule('product')->folder,
					),
				),
			),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Name'),			
			'content' => Yii::t('admin', 'Content'),
			'price' => Yii::t('main', 'Price'),
			'is_view' => Yii::t('main', 'Is view'),
            'url' => Yii::t('admin', 'Url'),
			'title' => Yii::t('admin', 'Title'),
			'description' => Yii::t('admin', 'Description'),
			'keywords' => Yii::t('admin', 'Keywords'),
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('is_view', $this->is_view);
                $criteria->compare('url', $this->url);

		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'sort' => array(
				'defaultOrder' => 'id DESC',
			),
			'criteria' => $criteria,
		));
	}

	protected function beforeValidate() {
		$this->description = nl2br($this->description);
		parent::beforeValidate();
		return true;
	}
	
	protected function beforeSave() {
		//$this->update_date = ;
		parent::beforeSave();
		return true;
	}
}
