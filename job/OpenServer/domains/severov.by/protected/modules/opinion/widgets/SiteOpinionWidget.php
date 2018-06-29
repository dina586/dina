<?php
Yii::import('application.modules.opinion.models.Opinion');
//Виджет для вывода блоков на странице
class SiteOpinionWidget extends CWidget {

	public $modelName;
	
	//public $newsNumber = 3;
	
	public function run() {
		
        $model= new $this->modelName;
		
		$dataProvider=$model::model()->findAll(array('condition'=>'view_on_main=1', 'order'=>'create_date'));
		
		$this->render('siteopinion', array('dataProvider'=>$dataProvider));
    } 

}

