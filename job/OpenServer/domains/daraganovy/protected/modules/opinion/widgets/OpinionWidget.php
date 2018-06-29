<?php
Yii::import('application.modules.opinion.models.Opinion');
//Виджет для вывода блоков на странице
class OpinionWidget extends CWidget {

	public function run() {
		$model = new Opinion('user_form');
		
		if(isset($_POST['Opinion']))
		{
			$model->attributes=$_POST['Opinion'];
			$model->is_view = 1;
			$model->is_new = 1;
			$model->create_date = date('Y-m-d');
			
			if($model->save()){
				Yii::app()->user->setFlash('save_opinion', 'Спасибо за Ваш отзыв! Он будет отображаться после проверки администратором!');
				Yii::app()->controller->refresh();
			}
		}
		
		$this->render('opinion', array(
			'model'=>$model,
		));
	}

}