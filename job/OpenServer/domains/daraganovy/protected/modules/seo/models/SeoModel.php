<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class SeoModel extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{seo}}';
	}

	public function rules() {

		return array(
			['title, description, keywords, model_name, model_id, controller_name, action_name, url', 'safe'],
			['model_id', 'numerical', 'integerOnly' => true],
			['title', 'length', 'max' => 255],
			['url', 'length', 'max' => 100],
			['model_name, module_name, controller_name, action_name', 'length', 'max' => 50],
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('admin', '№'),
			'title' => Yii::t('admin', 'Title'),
			'description' => Yii::t('admin', 'Description'),
			'keywords' => Yii::t('admin', 'Keywords'),
			'url' => Yii::t('admin', 'Url'),
			'model_name' => Yii::t('admin', 'Model Name'),
			'model_id' => Yii::t('admin', 'Model'),
			'module_name' => Yii::t('admin', 'Module Name'),
			'controller_name' => Yii::t('admin', 'Controller Name'),
			'action_name' => Yii::t('admin', 'Action Name'),
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('keywords', $this->keywords, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('model_name', $this->model_name, true);
		$criteria->compare('model_id', $this->model_id);

		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'criteria' => $criteria,
		));
	}

	/**
	 * Поиск записи в базе данных
	 * @param int $id
	 * @param string $modelName
	 * @return object/null
	 */
	public static function getModel($id, $modelName) {
		$criteria = new CDbCriteria;
		$criteria->compare('model_id', $id);
		$criteria->compare('model_name', $modelName);

		return self::model()->find($criteria);
	}

	/**
	 * Получение ссылки через путь для URL Manager
	 * @param string $path Путь module/controller/action
	 * @param string/int $url принимает url или model_id
	 * @return string
	 */
	public static function urlManager($path, $url) {

		$actionName = end($path);
		array_pop($path);

		$controllerName = end($path);
		array_pop($path);

		$moduleName = implode('/', $path);

		$criteria = new CDbCriteria;
		$criteria->compare('module_name', trim($moduleName));
		$criteria->compare('controller_name', $controllerName);
		$criteria->compare('action_name', $actionName);
		
		if(is_int($url))
			$criteria->compare('model_id', $url);
		else
			$criteria->compare('url', $url);

		$model = self::model()->find($criteria);
		if ($model === null)
			return '';
		else
			return ['url'=>$model->url, 'id'=>$model->model_id];
	}

}
