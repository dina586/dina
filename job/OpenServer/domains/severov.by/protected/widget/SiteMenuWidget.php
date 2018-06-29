<?php 
Yii::import('application.modules.service.models.*');
Yii::import('application.modules.technics.models.*');


class SiteMenuWidget extends CWidget {       
    public $modelName;
	public function run() {
        $model= new $this->modelName;
		$dataProvider=$model::model()->findAll(array('order'=>'date DESC', 'condition'=>'is_view=1'));
		$this->render('service_menu', array('dataProvider'=>$dataProvider));
    } 
}
?>