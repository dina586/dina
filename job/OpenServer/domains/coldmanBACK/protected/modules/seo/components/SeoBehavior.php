<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('application.modules.seo.models.SeoModel');
Yii::import('application.modules.seo.components.Translit');

class SeoBehavior extends CActiveRecordBehavior {

	//Поля из которых берутся мета данные при их отсутствии
	public $titleField = 'name';
	public $descriptionField;
	public $keywordsField;
	public $urlField = 'name';
	//Переопределение базовых настроек при необходимости
	public $moduleName = '';
	public $controllerName = '';
	public $actionName = 'view';
	//Объект модели SeoBehaviour
	protected $model = null;

	public function beforeValidate($event) {
		$id = $this->owner->isNewRecord ? -1 : $this->owner->id;
		$this->getPostData($id, get_class($this->owner));

		$model = $this->model;

		//Подготавливаем title
		if ($model->title == '')
			$model->title = $this->owner->{$this->titleField};

		$model->title = cText::wordTrim($model->title, 255);
		$model->title = $this->compareCriteria($model, 'title');

		//Подготавливаем url
		if ($model->url == '')
			$model->url = $this->owner->{$this->urlField};

		$model->url = cText::wordTrim(Translit::asURLSegment(strtolower($model->url)), 100);
		$model->url = $this->compareCriteria($model, 'url');

		if ($model->description == '' && $this->descriptionField != '')
			$model->description = $this->owner->{$this->descriptionField};

		if ($model->keywords == '' && $this->keywordsField != '')
			$model->keywords = $this->owner->{$this->keywordsField};

		$this->model = $model;

		if (!$this->model->validate())
			$this->owner->addErrors($this->model->getErrors());
	}

	public function afterSave($event) {
		$model = $this->model;
		$model->model_id = $this->owner->id;
		$model->save();
	}

	/**
	 * Базовая загрузка модели с данными
	 * @param int $id
	 * @param string $modelName
	 */
	protected function getPostData($id, $modelName) {
		$model = SeoModel::getModel($id, $modelName);

		if ($model === null)
			$model = new SeoModel;

		$model->model_id = $id;
		$model->model_name = $modelName;

		if (isset($_POST['SeoModel'])) {
			$model->attributes = $_POST['SeoModel'];

			$model->controller_name = $this->controllerName == '' ? Yii::app()->controller->id : $this->controllerName;
			if (Yii::app()->controller->module)
				$model->module_name = $this->moduleName == '' ? Yii::app()->controller->module->id : $this->moduleName;
			$model->action_name = $this->actionName;
		}

		$this->model = $model;
	}

	/**
	 * Убираем совпадения в полях title и url 
	 * @param obj $model
	 * @param string $field
	 * @return string
	 */
	protected function compareCriteria($model, $field) {
		$criteria = new CDbCriteria;

		if ($model->model_id > 0) {
			$criteria->addCondition('id != :id');
			$criteria->params = array(':id' => $model->id);
		}

		$criteria->compare($field, $model->{$field});

		switch ($field) {
			case 'title':
				$newText = $this->generateTitle($model->{$field}, $criteria);
				break;
			case 'url':
				$newText = $this->generateUrl($model->{$field}, $criteria);
				break;
			default:
				$newText = $model->{$field};
		}

		return $newText;
	}

	/**
	 * Генерация и проверка нового заголовка
	 * @param sting $baseText
	 * @param obj $criteria
	 * @return string
	 */
	protected function generateTitle($baseText, $criteria) {
		$i = 1;
		$newText = $baseText;
		$compareModel = SeoModel::model()->find($criteria);
		if ($compareModel !== null) {
			do {
				$newText = $baseText . Yii::t('main', ' part - ') . $i;
				$criteria->compare('title', $newText);
				$data = $compareModel->find($criteria);
				$i++;
			} while ($data !== null);
		}
		return $newText;
	}

	/**
	 * Генерация и проверка нового url
	 * @param sting $baseText
	 * @param obj $criteria
	 * @return string
	 */
	protected function generateUrl($baseText, $criteria) {
		$i = 1;
		$newText = $baseText;
		$compareModel = SeoModel::model()->find($criteria);
		$currentRules = Yii::app()->components['urlManager']->rules;

		if ($compareModel !== null || key_exists($baseText, $currentRules)) {
			do {
				$newText = $baseText . $i;
				$criteria->compare('title', $newText);
				$data = SeoModel::model()->find($criteria);
				$i++;
			} while ($data !== null || key_exists($newText, $currentRules));
		}
		return $newText;
	}


}
