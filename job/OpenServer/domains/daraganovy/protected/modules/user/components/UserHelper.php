<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class UserHelper {

	/**
	 * Получение имени пользователя
	 * @param mixed $user может принимать id или объект User/Profile
	 * @return string
	 */
	public static function getName($user = false) {
		if($user === false && !Yii::app()->user->isGuest)
			return Yii::app()->user->firstname.' '. Yii::app()->user->lastname;
		$model = self::getProfileModel($user);

		return $model->firstname . ' ' . $model->lastname;
	}

	/**
	 * Получение роли пользователя на сайте
	 * @param int $id
	 * @return string
	 */
	public static function getRole($id) {
		$model = System::loadModel('Roles', $id, '', 'user_id');
		return $model->role_name;
	}
	
	public static function avatar($user=false, $type = "", $linkOnly = false) {
		$model = self::getProfileModel($user);
		if($type != '')
			$type = $type.'__';

		if($model->avatar_img != '')
			$imgPath = '/upload/avatars/'.$model->user_id.'/'.$type.$model->avatar_img;
		else
			$imgPath = '/images/avatar.png';
		if($linkOnly)
			return $imgPath;
		return CHtml::image($imgPath, self::getName($model));
	}
	
	/**
	 * Проверка доспупа при существовании id 
	 * @param int $id
	 * @return int
	 * @throws CHttpException
	 */
	public static function checkAccess($id) {
		if (($id != '' && $id != Yii::app()->user->id) || !Yii::app()->user->checkAccess('admin'))
			throw new CHttpException(403);
		if ($id == '')
			$id = Yii::app()->user->id;
		return $id;

	}
	
	/**
	 * Генерация ссылки при существовании id
	 * @param int $url
	 * @return string
	 */	
	public static function link($url) {
		if(Yii::app()->request->getParam('id')){
			return Yii::app()->createUrl($url, ['id'=>Yii::app()->request->getParam('id')]);
		}
		return Yii::app()->createUrl($url);
	}
	
	/**
	 * Вырезка аватара
	 * @param string $path
	 * @param array $imgSize
	 * @return string
	 */
	public static function cropAvatar($path, $imgSize) {
		$temp = Yii::getPathOfAlias('webroot') . DS . 'upload' . DS . 'temp' . DS;
		$cFile = Yii::app()->cFile->set($temp.$imgSize['img_name'], true);
				
		$image = new Imagick($cFile->getRealPath());

		$image->cropImage($imgSize['w'],$imgSize['h'], $imgSize['x'], $imgSize['y']);
		$image->adaptiveResizeImage(400, 400);

		$image->writeImage($path .'medium__'.$imgSize['img_name']);
		
		$image->adaptiveResizeImage(100, 100);
		$image->writeImage($path .'thumbnail__'.$imgSize['img_name']);
		
		$cFile->copy($path.$imgSize['img_name'], Yii::app()->params['setFolderPermission']);
		Yii::app()->cFile->set($temp.$imgSize['img_name'])->delete();
		
		return $imgSize['img_name'];
	}
	
	public static function getProfileModel($user = false) {
		$model = $user;
		if($user === false) {
			$model = System::loadModel('Profile', Yii::app()->user->id, '', 'user_id');
		}
		elseif (get_class($user) == 'Profile') {
			$model = $user;
		}
		elseif (is_int($user)) {
			$model = System::loadModel('Profile', $user, '', 'user_id');
		} 
		elseif (get_class($user) == 'User')
			$model = $user->profile;
		return $model;
	}

}
