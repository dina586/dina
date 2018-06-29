<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class FileManager extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{file_manager}}';
	}

	public function rules()
	{

		return array(
			['file, folder, model_id, model_name', 'required'],
			['model_id, description, position, cover, date', 'safe'],
			['position, cover, model_id', 'numerical', 'integerOnly'=>true],
			['file, folder, description', 'length', 'max'=>255],
			['file_type', 'length', 'max'=>15],
			['model_name', 'length', 'max'=>20],
			['id, file, file_type, folder, description, position, cover, date, model_id, model_name', 'safe', 'on'=>'search'],
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'file' => Yii::t('admin', 'File name'),
			'file_type' => Yii::t('admin', 'File Type'),
			'folder' => Yii::t('admin', 'Folder'),
			'description' => Yii::t('admin', 'Description'),
			'position' => Yii::t('admin', 'Position'),
			'cover' => Yii::t('admin', 'Cover'),
			'date' => Yii::t('admin', 'Date'),
			'model_id' => Yii::t('admin', 'Model'),
			'model_name' => Yii::t('admin', 'Model Name'),
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('file_type',$this->file_type,true);
		$criteria->compare('folder',$this->folder,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('cover',$this->cover);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('model_name',$this->model_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Функция для поиска при создании новой папки
	 * @param int $id
	 * @param string $modelName
	 * @return CDbCriteria
	 */
	public static function getSearchCriteria($id, $modelName)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('model_id',$id);
		$criteria->compare('model_name',$modelName);
		$criteria->order = 'position DESC, date DESC';
		return $criteria;
	}
	
	protected function beforeSave() {
		if($this->isNewRecord) {
			$this->date = date("Y-m-d H:i:s");
		}
		$this->description = nl2br($this->description);
			
		parent::beforeSave();
		return true;
	}
	
	public static function saveModel($fileName, $folder, $id, $modelName, $cover = false, $type = 'image')  {
		if($cover) {
			$criteria = self::getSearchCriteria($id, $modelName);
			$criteria->compare('cover', 1);
			$criteria->compare('folder', $folder);
			$criteria->compare('file_type', 'image');
			$sql = self::model()->find($criteria);
			if($sql === null) 
				$cover = 1;
			else
				$cover = 0;
		} else $cover = 0;
		
		$model = new self();
		$model->file = $fileName;
		$model->folder = $folder;
		$model->model_id = $id;
		$model->model_name = $modelName;
		$model->file_type = $type;
		$model->cover = $cover;
		$model->position = Yii::app()->controller->itemPosition;
		if($model->save())
			return $model->id;
		else
			return false;
	}
}