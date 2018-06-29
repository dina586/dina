<?php
Yii::import('application.modules.info.models.Info');

/*Виджет для вывода последних новостей*/
class LatestInfo extends CWidget {
	
	/*Выбор количество выводимых новостей*/
	public $infoNumber = 4;
	
	/*Количество выводимых слов*/
	public $wordsNumber = 30;
	
    public function run() {
   		$this->viewInfo();
    }

	private function viewInfo() {
		$dataProvider=new CActiveDataProvider('Info', array(
			'criteria'=>array(
				"condition"=>"is_view = 1",
				'order'=>'date DESC, id DESC',
				'limit'=>$this->infoNumber,
			),
			'pagination'=>array(
	          'pageSize'=>$this->infoNumber,
	     	),
		));
		$this->render('preview', array(
			'dataProvider'=>$dataProvider,
		));
	}

}