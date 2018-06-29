<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Gallery extends CActiveRecord {

	const WIDTH = 150;
	const HEIGHT = 150;

	public $image;
	
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{gallery}}';
	}

	public function rules() {

		return array(
			['content, is_view', 'required'],			
			['is_view', 'numerical', 'integerOnly' => true],
			['url', 'length', 'max' => 255],
			['image', 'file',
				'types' => 'jpg, gif, png, jpeg',
				'maxSize' => 1024 * 1024 * 3,
				'allowEmpty' => true,
				'tooLarge' => Yii::t('admin', 'File size should not exceed') . ' 3 MB',
			]
		);
	}

	public function behaviors() {
		return [
			'seoBehavior' => [
				'class' => 'application.modules.seo.components.SeoBehavior',
			],
			
		];
	}

	public function attributeLabels() {
		return array(
			'id' => '№',	
			'content' => Yii::t('admin', 'Content'),
			'is_view' => Yii::t('main', 'Is view'),
                        'url' => Yii::t('admin', 'Url'),
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


}
