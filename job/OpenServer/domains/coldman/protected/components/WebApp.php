<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class WebApp extends CWebApplication {

	public function init() {
		parent::init();

		$lang = Yii::app()->language;
		
		$config = array(
			'name' => Settings::getVal('site_name'),
			'components' => [
				'widgetFactory' => [
					'widgets' => [
						'CLinkPager' => [
							'prevPageLabel' => Yii::t('admin', 'previous'),
							'nextPageLabel' => Yii::t('admin', 'next'),
						],
						'CJuiDatePicker' => [
							'options' => [
								'dateFormat' => strtolower(Yii::app()->locale->getDateFormat('short')),
							]
						],
					],
				],
				
			],
			'onBeginRequest' => function($event) {
				$route = Yii::app()->getRequest()->getPathInfo();
				$pathArr = explode('/', $route);
				$path = array_diff($pathArr, array(''));
				
				if (count($path) <= 2) {
					Yii::import('application.modules.seo.models.SeoModel');
					$model = SeoModel::model()->find('url=:url', [':url'=>$route]);
					if($model !== null) {
						$route = $model->module_name.'/'.$model->controller_name.'/'.$model->action_name;
						Yii::app()->getUrlManager()->addRules(
							[
								$model->url => [$route, 'defaultParams' => ['id'=>$model->model_id]]
							]
						);
						SeoHelper::getInstance()->init($model->title, $model->description, $model->keywords);
					}
					
					
				}
				return true;
			},
		);
		
		$this->checkAvailable();

		$this->configure($config);
	}

	/**
	 * Проверка блокировки сайта
	 */
	protected function checkAvailable() {

		if (Settings::getVal('block_site') == 1 && trim($_SERVER['REQUEST_URI'], '/') != 'settings/default/block')
			header('Refresh: 0; url=/settings/default/block');
	}


}

