<?php

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
		);
		


		$this->checkAvailable();

		$this->configure($config);
	}

	/**
	 * Проверка блокировки сайта
	 */
	protected function checkAvailable() {

		if (Settings::getVal('block_site') == 1 && trim($_SERVER['REQUEST_URI'], '/') != 'system/default/block')
			header('Refresh: 0; url=/system/default/block');
	}


}

