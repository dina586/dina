<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Product extends CActiveRecord {

	const WIDTH = 419;
	const HEIGHT = 300;

	public $image;

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{product}}';
	}

	public function rules() {

		return array(
			['name, is_view, content', 'required'],
                        ['description, keywords, title', 'safe'],
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
						'folder' => Yii::app()->getModule('product')->folder,
					],
				),
			),
			
		];
	}

	public function attributeLabels() {
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Name'),
			'title' => Yii::t('admin', 'Page Title'),
			'description' => Yii::t('admin', 'Page Description'),
			'keywords' => Yii::t('admin', 'Page Keywords'),
			'content' => Yii::t('admin', 'Content'),			
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
