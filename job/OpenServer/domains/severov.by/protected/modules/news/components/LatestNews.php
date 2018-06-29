<?php
Yii::import('application.modules.news.models.News');

/*Виджет для вывода последних новостей*/
class LatestNews extends CWidget {
	
	/*Выбор количество выводимых новостей*/
	public $newsNumber = 4;
	
	/*Количество выводимых слов*/
	public $wordsNumber = 30;
	
    public function run() {
   		$this->viewNews();
    }

	private function viewNews() {
		$dataProvider=new CActiveDataProvider('News', array(
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