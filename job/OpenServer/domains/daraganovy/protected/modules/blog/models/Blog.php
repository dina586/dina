<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Blog extends CActiveRecord {

	const WIDTH = 130;
	const HEIGHT = 130;

	public $image;

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{blog}}';
	}

	public function rules() {

		return array(
			['name, create_date, is_view, description, content', 'required'],
			['update_date', 'safe'],
			['is_view', 'numerical', 'integerOnly' => true],
			['name', 'length', 'max' => 255],
			['image', 'file',
				'types' => 'jpg, gif, png, jpeg',
				'maxSize' => 1024 * 1024 * 3,
				'allowEmpty' => true,
				'tooLarge' => Yii::t('admin', 'File size should not exceed') . ' 3 MB',
			],
		);
	}

	public function behaviors() {
		return [
			'seoBehavior' => [
				'class' => 'application.modules.seo.components.SeoBehavior',
			],
			'imageBehavior' => array(
				'class' => 'application.modules.file.components.ImageBehavior',
				'data' => array(
					'image' => [
						'width' => self::WIDTH,
						'height' => self::HEIGHT,
						'folder' => Yii::app()->getModule('blog')->folder,
					],
				),
			),
			'dateBehavior' => array(
				'class' => 'application.components.behavior.DateBehavior',
				'date' => array('create_date'),
				'datetime' => array('update_date'),
			),
		];
	}

	public function attributeLabels() {
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Name'),
			'description' => Yii::t('admin', 'Description'),
			'content' => Yii::t('admin', 'Content'),
			'create_date' => Yii::t('main', 'Date'),
			'is_view' => Yii::t('main', 'Is view'),
			'image' => Yii::t('admin', 'Image size in pixels') . ' ' . self::WIDTH . 'x' . self::HEIGHT,
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('is_view', $this->is_view);

		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'sort' => array(
				'defaultOrder' => 'create_date DESC',
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
