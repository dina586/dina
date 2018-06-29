<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('application.modules.user.components.UserHelper');

class AvatarWidget extends CWidget {

	//Модель User/Profile
	public $model = false;
	
	/**
	 * Тип картинки. Для вывода оригинала оставить пустым
	 * Может принимать значения 
	 * thumbnail - вывод миниатюры размер 100х100
	 * medium - квардрат размером 400х400
	 * @var type string
	 */
	public $type;

	/**
	 * Варианты вывода виджета. Может принимать 4 типа - path, image, link, popup
	 * path - возвращает путь к картинке
	 * image - возвращает просто готовое изображение для аватара
	 * link - возвращает ссылку на профайл пользователя
	 * popup - возвращает картинку со ссылкой типа lightbox
	 * @var type string
	 */
	public $renderType = 'path';

	/**
	 * Html опции для изображения
	 * @var type 
	 */
	public $imgOptions = [];

	/**
	 * Html опции для ссылки
	 * @var type 
	 */
	public $linkOptions = [];
	
	public function run() {
		$this->model = $model = UserHelper::getProfileModel($this->model);

		if ($this->type != '')
			$this->type = $this->type.'__';

		$cFile = Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('user')->avatarFolder.DS.$model->user_id.DS.$this->type.$model->avatar_img);

		if ($model->avatar_img != '' && $cFile->exists)
			$imgPath = '/upload/'.Yii::app()->getModule('user')->avatarFolder.'/'.$model->user_id.'/'.$this->type.$model->avatar_img;
		else
			$imgPath = Yii::app()->getModule('user')->noAvatar;

		$image = CHtml::image($imgPath, UserHelper::getName($model), $this->imgOptions);

		switch ($this->renderType) {

			case 'image' :
				echo $image;
				break;

			case 'link':
				if($model->user_id == Yii::app()->user->id)
					echo CHtml::link($image, Yii::app()->createUrl('user/view/profile'), $this->linkOptions);
				else
					echo CHtml::link($image, Yii::app()->createUrl('user/view/profile', ['id'=>$model->user_id]), $this->linkOptions);
				break;

			case 'popup':
				if ($imgPath == Yii::app()->getModule('user')->noAvatar)
					echo $image;
				else {
					$linkOptions = array_merge(['data-toggle'=>'lightbox-image'], $this->linkOptions);
					echo CHtml::link($image, '/upload/'.Yii::app()->getModule('user')->avatarFolder.'/'.$model->user_id.'/'.$model->avatar_img, $linkOptions);
				}
				break;

			default:
				echo $imgPath;
		}
	}

}
