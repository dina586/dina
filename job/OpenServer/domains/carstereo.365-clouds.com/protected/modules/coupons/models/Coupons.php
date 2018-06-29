<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Coupons extends CActiveRecord {

	const WIDTH = 162;
	const HEIGHT = 112;

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{coupons}}';
	}

	public function rules() {

		return array(
			['name, content, is_view', 'required'],			
			['description, keywords, title, code, expire_date', 'safe'],
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
						'folder'=> Yii::app()->getModule('coupons')->folder,
					),
				),
			),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => '№',	
			'content' => Yii::t('admin', 'Content'),
			'is_view' => Yii::t('main', 'Is view'),
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
				'defaultOrder' => 'id DESC',
			),
			'criteria' => $criteria,
		));
	}


}
