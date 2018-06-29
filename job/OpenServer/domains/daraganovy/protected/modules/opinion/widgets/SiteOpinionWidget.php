<?php

Yii::import('application.modules.opinion.models.Opinion');

//Виджет для вывода блоков на странице
class SiteOpinionWidget extends CWidget {

	public function run() {

		$dataProvider = Opinion::model()->findAll(array('condition' => 'view_on_main=1', 'limit' => 3));

		$this->render('siteopinion', array('dataProvider' => $dataProvider));
	}

}
