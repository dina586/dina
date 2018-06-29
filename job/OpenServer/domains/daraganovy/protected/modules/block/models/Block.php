<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Block extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{blocks}}';
	}

	public function rules() {

		return array(
			['name, content, position, page_position, is_view, view_title', 'required'],
			['title', 'safe'],
			['position, is_view, view_title', 'numerical', 'integerOnly' => true],
			['name, title, page_position', 'length', 'max' => 255],
			['id', 'safe'],
		);
	}

	public function attributeLabels() {
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Name of block in Admin Panel'),
			'title' => Yii::t('admin', 'Title of block shown on the page'),
			'content' => Yii::t('admin', 'Content'),
			'position' => Yii::t('admin', 'Page position'),
			'page_position' => Yii::t('admin', 'View Posion'),
			'is_view' => Yii::t('admin', 'View block'),
			'view_title' => Yii::t('admin', 'Show the name of the block in deriving'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('position', $this->position);
		$criteria->compare('page_position', $this->page_position, true);
		$criteria->compare('is_view', $this->is_view);
		$criteria->compare('view_title', $this->view_title);

		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'criteria' => $criteria,
		));
	}

	protected function afterSave() {
		//Обновление кеша для блоков
		System::deleteCache($this->page_position, 'block_render_');
		parent::afterSave();
		return true;
	}

	protected function afterDelete() {
		//Обновление кеша для блоков
		System::deleteCache($this->page_position, 'block_render_');
		parent::afterDelete();
		return true;
	}

}
