<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Helper {

	/**
	 * Получение сео ссылки через id и имя модели
	 * @param int $id
	 * @param string $modelName
	 * @return string
	 */
	  public static function getPageLink($id) {
		Yii::import('application.modules.page.models.Page');
		$c = System::loadModel('Page', $id);
		return Yii::app()->createUrl('page/view/view', array('url'=>$c->url));
	}
	 
	public static function seoLink($id, $modelName) {
		$model = SeoModel::getModel($id, $modelName);
		if ($model !== null) {
			$route = $model->module_name.'/'.$model->controller_name.'/'.$model->action_name;
			Yii::app()->getUrlManager()->addRules(
				[
					$model->url => [$route, 'defaultParams' => ['id'=>$model->model_id]]
				],
				false
			);
			$link = Yii::app()->createUrl($route, array('id'=>$model->model_id));
		} else
			$link = '#';
		return $link;
	}

	/**
	 * Вывод ссылки внизу раздела для редактирования
	 * @param type $url
	 * @return string
	 */
	public static function editLink($url) {
		$view = '';
		if(Yii::app()->user->checkAccess('admin')){
			$view .= '<div class = "b-admin_edit">';
			$view .= BsHtml::link(Yii::t('main', 'Edit'), $url,
				array(
					'icon' => BsHtml::GLYPHICON_PENCIL,
					'class' => 'btn btn-default btn-sm',
				)
			);
			$view .= '</div>';
		}
		return $view;
	}
	
	//Создание кнопки - ссыкли
	public static function linkButton($label = 'Submit', $url = '#', $htmlOptions = array()) {
		$btn = BsHtml::linkButton($label, $htmlOptions);
		$btn = str_replace('"#"', '"'.$url.'"', $btn);
		return $btn;
	}
	
		//Формирование сео заголовков для разделов с сео страницами
	public static function seoPage($title, $param = 'page')
	{
		$page = (int)Yii::app()->request->getQuery($param, 1);
		$title .= $page > 1 ? ' - '.Yii::t('admin', 'page').' ' . $page : '';
		return $title;
	}
	
	public static function getCover($id, $name, $type = 'thumbnail'){
		Yii::import('application.modules.file.models.FileManager');
		$view = '';
		$data = FileManager::model()->find('model_name=:model_name AND model_id = :model_id AND cover = 1', array(':model_id'=>$id, ':model_name'=>$name));
		
		if($data === null):
			return false;
		else:
			$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$data->folder.DS.$type.DS.$data->file;
				
			if(Yii::app()->cFile->set($file)->exists)
				return '/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/'.$type.'/'.$data->file;
			else
				return false;
		endif;
		
		return $view;
	}
}
