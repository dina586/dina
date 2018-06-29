<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */

/**
 * Вспомогательный контроллер для модуля user.
 * Содержит экшены для загрузки/удаления аватараов и тд
 */
class AssistController extends Controller {

	public $layout = '//layouts/templates/admin';

	public function filters() {
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules() {
		return [
			[
				'allow',
				'actions' => array('avatar', 'deleteAvatar'),
				'users' => array('@'),
			],
			[
				'deny',
				'users' => array('*'),
			],
		];
	}

	/**
	 * Загрузка аватара на сервер и вывод пользователю
	 */
	public function actionAvatar() {
		Yii::import("application.modules.file.components.FileHelper");
		$uploadData = FileHelper::qqUploadTemp();
		$result = $uploadData['result']; 
		$tempFile = $uploadData['tempFile']; 

		if (isset($result['success'])) {
			if (DS == '/')
				$dir = '/upload/temp/';
			else
				$dir = $tempFile->getDirname();

			$fileName = strtolower(Yii::app()->getModule('file')->generateName($dir, $tempFile->getExtension()));

			$imgObj = new Image($tempFile->getRealPath());
			if ($imgObj->getWidth() < 400 || $imgObj->getheight() < 400) {
				$result['success'] = false;
				$result['message'] = Yii::t('admin', 'Min image width must be 400 pixels and height must be 400 pixels');
			} else {
				$imgName = $imgObj->resize(1024, 768, $dir, $fileName, 'auto');

				$result['image_name'] = $imgName;
				$result['imagepath'] = '/upload/temp/'.$imgName;
			}
			$tempFile->delete();
		}

		$result = json_encode($result);
		echo $result;
	}
	
	/**
	 * Удаление текущего аватара пользователем
	 * @param int $id
	 * @throws CHttpException/success
	 */
	public function actionDeleteAvatar($id) {
		$json = ['status'=>'error', 'message'=>''];
		if(!Yii::app()->request->isAjaxRequest) {
			$this->redirect(Yii::app()->user->returnUrl); 
		}
	
		$model = Profile::model()->findByPk($id);
		
		if($model === null)
			$json = ['status'=>'error', 'message'=>Yii::t('admin', 'Current user does not exists')];
		else {
			UserHelper::deleteAvatarImg($model->user_id);
			Profile::model()->updateByPk($model->user_id, ['avatar_img'=>'']);
			$json = ['status'=>'ok', 'message'=>CHtml::image(Yii::app()->getModule('user')->noAvatar, CHtml::encode(UserHelper::getName($model)))];
		}
		echo json_encode($json);
	}

}
