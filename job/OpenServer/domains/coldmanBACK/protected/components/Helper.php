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
}
