<?php
class ImageController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', 
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('imgDelete'),
				'users'=>array('*'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	
	//Удаление изображения
	public function actionImgDelete($image, $folder){
		if(Yii::app()->request->isAjaxRequest)
			Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').DS.'upload'.DS.$folder.DS.$image)->delete();
		else
			throw new CHttpException('403', 'Denied');
			
	}
}