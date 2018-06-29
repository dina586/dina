<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Chance extends CActiveRecord {

        const WIDTH = 300;
	const HEIGHT = 150;
	
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{chance}}';
	}

	public function rules() {

		return array(
			['name, title, alt, is_view', 'required'],		
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
						'folder'=> Yii::app()->getModule('chance')->folder,
					),
				),
			),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Name'),			
			'title' => Yii::t('admin', 'Title'),
			'alt' => Yii::t('main', 'Alt'),
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
