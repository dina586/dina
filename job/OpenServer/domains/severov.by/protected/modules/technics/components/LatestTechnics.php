<?php
Yii::import('application.modules.technics.models.Technics');

/*Виджет для вывода последних новостей*/
class LatestTechnics extends CWidget {
	
	/*Выбор количество выводимых новостей*/
	public $newsNumber = 4;
	
	/*Количество выводимых слов*/
	public $wordsNumber = 30;
	
    public function run() {
   		$this->viewTechnics();
    }

	private function viewTechnics() {
		$dataProvider=new CActiveDataProvider('Technics', array(
			'criteria'=>array(
				"condition"=>"is_view = 1",
				'order'=>'date DESC, id DESC',
				//'limit'=>$this->newsNumber,
			),
			//'pagination'=>array(
	        //  'pageSize'=>$this->newsNumber,
	     	//),
		));
		$this->render('preview', array(
			'dataProvider'=>$dataProvider,
		));
	}

}