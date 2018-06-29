<?php
Yii::import('application.modules.blog.models.Blog');

/*Виджет для вывода блога*/
class BlogWidget extends CWidget {
	
	/*Выбор количество выводимых новостей*/
	public $newsNumber = 3;
	
    public function run() {
   		$this->viewNews();
    }

	private function viewNews() {
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
		$this->render('blog', array(
			'dataProvider'=>$dataProvider,
		));
	}

}