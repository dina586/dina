<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Portfolio extends CActiveRecord {

    private $_oldTags;
    const STATUS_PUBLISHED=2;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{portfolio}}';
    }

    public function rules() {

        return array(
            ['name, is_view, description, create_date', 'required'],
            ['content, radiobutton, tags', 'safe'],
            ['content, radiobutton, tags', 'safe', 'on'=>'search'],
            ['is_view', 'numerical', 'integerOnly' => true],
            ['name', 'length', 'max' => 255],
            ['tags', 'match', 'pattern'=>'~^(\p{L}|\p{Zs}|,)+$~u',
            'message'=>'В тегах можно использовать только буквы.'],
            ['tags', 'normalizeTags'],
        );
    }

    public function behaviors() {
        return [
            'seoBehavior' => [
                    'class' => 'application.modules.seo.components.SeoBehavior',
					//'controller'=>'',
            ],
            'dateBehavior' => array(
                    'class' => 'application.components.behavior.DateBehavior',
				'date' => array('create_date'),
            ),
            'fileManagerBehavior' => [
                    'class'=> 'application.modules.file.behavior.FileManagerBehavior',
            ],
        ];
    }

    public function attributeLabels() {
        return array(
            'id' => '№',
            'name' => Yii::t('admin', 'Name'),
            'description' => Yii::t('admin', 'Description'),
            'content' => Yii::t('admin', 'Content'),			
            'is_view' => Yii::t('main', 'Is view'),	
			'tags' => Yii::t('admin', 'Тэги'),
			'create_date' => Yii::t('admin', 'Дата добавления'),
            
        );
    }

    public function search() {

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('is_view', $this->is_view);	
        $criteria->compare('radiobutton', $this->radiobutton);
		$criteria->compare('tags', $this->tags);

        return new CActiveDataProvider(get_class($this), array(
            'pagination' => array(
                    'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
            'sort' => array(
                    'defaultOrder' => 'id DESC',
            ),
            'criteria' => $criteria,
        ));
    }

    protected function beforeValidate() {
        $this->description = nl2br($this->description);
        parent::beforeValidate();
        return true;
    }

    protected function beforeSave() {
        parent::beforeSave();
        return true;
    }

    protected function afterDelete() {

		Tag::model()->updateFrequency($this->tags, '');

		Yii::import('application.modules.file.models.FileManager');

		$model = FileManager::model()->find(array(
			'condition' => 'model_id=:model_id AND model_name=:model_name',
			'params' => array(':model_id' => $this->id, ':model_name' => 'Porfolio_Beauty')
		));

		if ($model !== null) {
			$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$model->folder;
			Yii::app()->cFile->set($dir)->delete();
		}

		FileManager::model()->deleteAll(array(
			'condition' => 'model_id=:model_id AND model_name=:model_name',
			'params' => array(':model_id' => $this->id, ':model_name' => 'Porfolio_Beauty')
		));
		parent::afterDelete();
		return true;
	}

	public function getUrl()
    {
        return Yii::app()->createUrl('portfolio/view', array(
            'id'=>$this->id,
            'title'=>$this->title,
        ));
    }
   
    public function normalizeTags($attribute,$params){        
        $this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
    }
	
    protected function afterFind(){        
        parent::afterFind();
        $this->_oldTags=$this->tags;
    }
    
    protected function afterSave(){
        parent::afterSave();
        Tag::model()->updateFrequency($this->_oldTags, $this->tags, $this->radiobutton);
    }
    
    
}
