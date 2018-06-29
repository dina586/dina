<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Slider extends CActiveRecord
{
	public $image;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{slider}}';
	}

	public function rules()
	{

		return array(
			['name, position', 'required'],
			['img_name', 'safe'],
			['position', 'numerical', 'integerOnly'=>true],
			['name', 'length', 'max'=>255],
			['id, name, position', 'safe', 'on'=>'search'],
			array('image', 'file',
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 3,
				'allowEmpty'=>true,
				'tooLarge'=>Yii::t('admin', 'File size should not exceed').' 3 MB',
			),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('admin', 'ID'),
			'name' => Yii::t('admin', 'Name'),
			'position' => Yii::t('admin', 'Position'),
			'image'=>'Изображение',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'position ASC, id DESC',	
			),
		));
	}
	
	protected function afterSave() {
		Yii::import('application.modules.file.components.Image');
		$file = CUploadedFile::getInstance($this, 'image');
		$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS;
	
		if($file) {
			$image = $path.'temp'.DS.$file->name;
			$file->saveAs($image);

			$cFile = Yii::app()->cFile->set($image);
			$newName = $this->id.'.'.$cFile->getExtension();
			$cFile->copy($path.Yii::app()->controller->module->folder.DS.$newName, Yii::app()->params['folderPermission']);
			
			
			self::model()->updateByPk($this->id, array('img_name'=>$newName));
			Yii::app()->cFile->set($image)->delete();
		}
		parent::afterSave();
	}
	
	protected function afterDelete() {
		$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS;
		Yii::app()->cFile->set($path.Yii::app()->controller->module->folder.DS.$this->img_name)->delete();
		parent::afterDelete();
	}
}