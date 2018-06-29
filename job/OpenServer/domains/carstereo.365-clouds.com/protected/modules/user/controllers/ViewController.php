<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class ViewController extends Controller {

	public $defaultAction = 'profile';
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
				'actions' => array('profile', 'edit', 'changePassword', 'index', 'avatar', 'background'),
				'users' => array('@'),
			],
			[
				'deny',
				'users' => array('*'),
			],
		];
	}

	protected function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'profile':
				return Yii::t('admin', 'Profile');
				break;

			case 'avatar':
				return Yii::t('admin', 'Upload avatar');
				break;
			
			case 'background':
				return Yii::t('admin', 'Upload background');
				break;
			
			case 'edit':
				return Yii::t('admin', 'Edit Profile');
				break;

			case 'changePassword':
				return Yii::t('admin', 'Change password');
				break;

			case 'index':
				return Yii::t('admin', 'Users');
				break;
			
			case 'manage':
				return Yii::t('admin', 'Manage Users');
				break;
		}
	}

	protected function beforeAction($event) {
		$this->seo($this->titles());
		return true;
	}

	/**
	 * Профиль пользователя
	 * @param int $id
	 */
	public function actionProfile($id = '') {
		$this->layout = '//layouts/templates/admin_main';
		if ($id != '' && $id == Yii::app()->user->id)
			$this->redirect(['/user/view/profile']);
		elseif($id == '')
			$id = Yii::app()->user->id;
		
		$model = System::loadModel('User', $id);
		$this->render('profile', array('model' => $model));
	}

	/**
	 * Редактирование профиля пользователя
	 * @param int $id
	 */
	public function actionEdit($id = '') {
		$id = UserHelper::checkAccess($id);
		
		$model = System::loadModel('User', $id);
		$profile = $model->profile;
		if (isset($_POST['User'])) {
			$model->attributes = array_map('trim', $_POST['User']);
			$profile->attributes = $_POST['Profile'];
			if ($model->saveData($model, $profile) === true) {
				Yii::app()->user->setFlash('profile', Yii::t('admin', 'Profile information successfully updated!'));
				$this->redirect(array(UserHelper::link('user/view/profile')));
			}
		}
		$this->render('edit', array('model' => $model, 'profile' => $profile));
	}

	/**
	 * Изменение пароля пользователем
	 */
	public function actionChangePassword($id = '') {
		$id = UserHelper::checkAccess($id);
		$model = System::loadModel('User', $id);
		$model->scenario = 'change_password';

		if (isset($_POST['ajax'])) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['User'])) {
			$model->attributes = array_map('trim', $_POST['User']);
			if ($model->validate()) {
				$model->password = $model->new_password;
				$model->activkey = md5(microtime());
				if ($model->save(false)) {
					Yii::app()->user->setFlash('profile', Yii::t('admin', 'New password changed successfully!'));
					$this->redirect([UserHelper::link('/user/view/profile')]);
				}
			}
		}

		$this->render('change_password', array('model' => $model));
	}

	/**
	 * Вывод списка пользователей
	 */
	public function actionIndex() {
		$criteria = User::model()->listCriteria();

		$count = User::model()->count($criteria);

		$pages = new CPagination($count);
		$pages->pageSize = 21;
		$pages->applyLimit($criteria);

		$dataProvider = User::model()->findAll($criteria);
		$this->render('index', array('dataProvider' => $dataProvider, 'pages'=>$pages));
	}
		
	/**
	 * Страница работы с аватарами пользователя
	 * @param int $id
	 */
	public function actionAvatar($id = '') {
		$id = UserHelper::checkAccess($id);
		Yii::app()->clientScript->registerPackage('jscrop');
		if(isset($_POST['ImgSize'])) {
			$imgSize = $_POST['ImgSize'];
			
			$dir = UserHelper::deleteAvatarImg($id);
			Yii::app()->cFile->createDir($dir, Yii::app()->params['createFolderPermission']);
			Yii::app()->cFile->set($dir, true)->setPermissions(Yii::app()->params['setFolderPermission']);
			
			$avatarName = UserHelper::cropAvatar($dir, $imgSize);
			Profile::model()->updateByPk($id, ['avatar_img'=>$avatarName]);
			$this->redirect([UserHelper::link('/user/view/profile')]);
		}
		
		$this->render('avatar');
	}
	
	/**
	 * Страница загрузки background для профайла
	 * @param int $id
	 */
	public function actionBackground($id = '') {
		$id = UserHelper::checkAccess($id);
		$model = System::loadModel('User', $id);
		if(isset($_POST['ImgSize'])) {
			$imgSize = $_POST['ImgSize'];
			
			$dir = UserHelper::deleteAvatarImg($id);
			Yii::app()->cFile->createDir($dir, Yii::app()->params['createFolderPermission']);
			Yii::app()->cFile->set($dir, true)->setPermissions(Yii::app()->params['setFolderPermission']);
			
			$avatarName = UserHelper::cropAvatar($dir, $imgSize);
			Profile::model()->updateByPk($id, ['avatar_img'=>$avatarName]);
			$this->redirect([UserHelper::link('/user/view/profile')]);
		}
		
		$this->render('background', ['model'=>$model]);
	}
	

}
