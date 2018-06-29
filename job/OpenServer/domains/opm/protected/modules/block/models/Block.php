<?php

/**
 * This is the model class for table "{{blocks}}".
 *
 * The followings are the available columns in table '{{blocks}}':
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $content
 * @property integer $position
 * @property integer $page_position
 * @property integer $is_view
 * @property integer $view_title
 */
class Block extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Block the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{blocks}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, content, position, page_position, is_view, view_title', 'required'),
			array('title', 'safe'),
			array('position, is_view, view_title', 'numerical', 'integerOnly'=>true),
			array('name, title, page_position', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, title, content, position, page_position, is_view, view_title', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Name of block in Admin Panel'),
			'title' => Yii::t('admin','Title of block shown on the page'),
			'content' => Yii::t('admin','Content'),
			'position' => Yii::t('admin','Page position'),
			'page_position' => Yii::t('admin','View Posion'),
			'is_view' => Yii::t('admin','View block'),
			'view_title' => Yii::t('admin','Show the name of the block in deriving'),
		);
	}
	
	public function behaviors(){
		return array();
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('page_position',$this->page_position, true);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('view_title',$this->view_title);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	protected function afterSave() {
		//Обновление кеша для блоков
		System::deleteCache($this->page_position, 'block_render_');
		parent::afterSave();
		return true;
	}
	
	protected function afterDelete() {
		//Обновление кеша для блоков
		System::deleteCache($this->page_position, 'block_render_');
		parent::afterDelete();
		return true;
	}

}