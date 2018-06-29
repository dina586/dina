<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class EmailTags extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{email_tags}}';
	}

	public function rules() {

		return array(
			['name, tag, tag_type', 'required'],
			['tag', 'unique'],
			['tag_type', 'numerical', 'integerOnly' => true],
			['name, tag', 'length', 'max' => 255],
			['id, name, tag, tag_type', 'safe', 'on' => 'search'],
		);
	}

	public function attributeLabels() {
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Tag name'),
			'tag' => Yii::t('admin', 'Tag code'),
			'tag_type' => Yii::t('admin', 'Tag type'),
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('tag', $this->tag, true);
		$criteria->compare('tag_type', $this->tag_type);

		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'criteria' => $criteria,
		));
	}

	public function beforeSave() {
		$this->tag = strtoupper($this->tag);
		parent::beforeSave();
		return true;
	}

	public function afterDelete() {
		EmailConnect::model()->deleteAll('tag_id=:tag_id', array(':tag_id' => $this->id));
		parent::afterDelete();
		return true;
	}

}
