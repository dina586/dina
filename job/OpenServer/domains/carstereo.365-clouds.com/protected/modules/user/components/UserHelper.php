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
	
	/**
	 * Проверка доспупа при существовании id 
	 * @param int $id
	 * @param bool $bool если true то ф-ция вернет true/false иначе id
	 * @return mixed int/bool
	 * @throws CHttpException
	 */
	public static function checkAccess($id, $bool = false) {
		if ($bool === false) {
			if (($id != '' && $id != Yii::app()->user->id) && !Yii::app()->user->checkAccess('admin'))
				throw new CHttpException(403);
			else {
				if ($id == '')
					$id = Yii::app()->user->id;
				return $id;
			}
		} else {
			if ($id == Yii::app()->user->id || Yii::app()->user->checkAccess('admin'))
				return true;
			else
				return false;
		}
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
	
	/**
	 * Удаление аватара пользователя
	 * @param type $id
	 */
	public static function deleteAvatarImg($id) {
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('user')->avatarFolder.DS.$id.DS;
		Yii::app()->cFile->set($dir, true)->delete($dir);
		return $dir;
	}
	
	/**
	 * Ф-ция загрузки модели Profile
	 * Может принимать значения id пользователя, объект User
	 * Если $user === false, загрузит объект текущекого залогиненного пользователя
	 * @param mixed $user 
	 * @return type
	 */
	public static function getProfileModel($user = false) {
		$model = $user;
		if($user === false || $user === null) {
			$model = System::loadModel('Profile', Yii::app()->user->id, '', 'user_id');
		}
		elseif (is_int($user)) {
			$model = System::loadModel('Profile', $user, '', 'user_id');
		} 
		elseif (get_class($user) == 'User')
			$model = $user->profile;
		return $model;
	}
	
	public static function getBackground($user = false, $type = "original", $imageOptions = []) {
		Yii::import('application.modules.file.models.FileManager');
		$user = self::getProfileModel($user);

		$fileModel = FileManager::model()->find(array(
			'condition' => 'model_id=:model_id AND model_name=:model_name AND file_type=:file_type',
			'params' => array(':model_id' => $user->user_id, ':model_name' => 'UserBackground', ':file_type' => 'image')
		));
		
		$imagePath = self::getBackgroundNoImg($type);
		
		if ($fileModel !== null) {
			$cFile = Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$fileModel->folder.DS.$type.DS.$fileModel->file);
			
			if ($cFile->exists)
				$imagePath = '/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$fileModel->folder.'/'.$type.'/'.$fileModel->file;
		}
		
		if ($imagePath == '')
			return '';
		else
			return CHtml::image($imagePath, CHtml::encode(self::getName($user)), $imageOptions);
	}

	/**
	 * Картинка при отсуствии background
	 * @param string $type
	 * @return string
	 */
	protected static function getBackgroundNoImg($type) {
		if ($type == 'original')
			$imagePath = '/images/system/user/profile_background.jpg';
		else
			$imagePath = '';
		return $imagePath;
	}

}
