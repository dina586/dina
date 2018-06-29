<?php
Yii::import('application.modules.blog.models.Blog');

/*Виджет для вывода последних новостей*/
class LatestBlog extends CWidget {
	
	/*Выбор количество выводимых новостей*/
	public $newsNumber = 4;
	
	/*Количество выводимых слов*/
	public $wordsNumber = 30;
	
    public function run() {
   		$this->viewBlog();
    }

	private function viewBlog() {
		$dataProvider=new CActiveDataProvider('Blog', array(
			'criteria'=>array(
				"condition"=>"is_view = 1",
				'order'=>'date DESC, id DESC',
				'limit'=>$this->newsNumber,
			),
			'pagination'=>array(
	          'pageSize'=>$this->newsNumber,
	     	),
		));
		$this->render('preview', array(
			'dataProvider'=>$dataProvider,
		));
	}

}