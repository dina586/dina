<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class EmailConnect extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{email_tag_connect}}';
	}

	public function rules() {

		return array(
			['email_id, tag_id', 'required'],
			['email_id, tag_id', 'numerical', 'integerOnly' => true],
			['id, email_id, tag_id', 'safe', 'on' => 'search'],
		);
	}

	public function relations() {
		return array(
			'email_message' => array(self::BELONGS_TO, 'EmailMessage', 'email_id'),
			'email_tag' => array(self::BELONGS_TO, 'EmailTags', 'tag_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('admin', 'ID'),
			'email_id' => Yii::t('admin', 'Email'),
			'tag_id' => Yii::t('admin', 'Tag'),
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('email_id', $this->email_id);
		$criteria->compare('tag_id', $this->tag_id);

		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'criteria' => $criteria,
		));
	}

}
