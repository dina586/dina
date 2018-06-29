<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Page extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{page}}';
	}

	public function rules() {
		return array(
			['name, content, url', 'required'],
			['description, keywords, title', 'safe'],
			['name, url, title', 'length', 'max' => 255],
			['url', 'unique'],
		);
	}

	public function behaviors() {
		return array(
			'cacheBehavior' => array(
				'class' => 'application.components.behavior.CacheBehavior',
			),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Name'),
			'content' => Yii::t('admin', 'Content'),
			'url' => Yii::t('admin', 'Page Url'),
			'title' => Yii::t('admin', 'Page Title'),
			'description' => Yii::t('admin', 'Page Description'),
			'keywords' => Yii::t('admin', 'Page Keywords'),
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('url', $this->url, true);


		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'criteria' => $criteria,
		));
	}
	
	public static function getUrl($id, $url = '') {
		if (key_exists($id, Yii::app()->getModule('page')->redirectLinks))
			$link = Yii::app()->createUrl(Yii::app()->getModule('page')->redirectLinks[$id]);
		else {
			if($url == '') {
				$model = System::loadModel('Page', $id);
				$url = $model->url;
			}
			$link = Yii::app()->createUrl('page/view/view', ['url'=>$url]);
		}
		return $link;
		
	}

}
