<?php

/**
 * This is the model class for table "{{Sproduct}}".
 *
 * The followings are the available columns in table '{{Sproduct}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property double $price
 * @property double $share_price
 * @property string $date
 * @property integer $position
 * @property integer $is_view
 * @property integer $in_stock
 * @property integer $catalog_id
 */
class Partner extends CActiveRecord implements IECartPosition 
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public $image;
	public $id;
	public function tableName()
	{
		return '{{spartner}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, position, is_view, link', 'required'),
			array('link', 'safe'),
			array('position, is_view', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500),
			array('image', 'file', 
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 2, 
				'allowEmpty'=>true,
				'tooLarge'=>'Файл должен быть не более 2MB'
			),
			array('url', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, position, is_view', 'safe', 'on'=>'search'),
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
			'name' => 'Название',
			'position' => 'Позиция',
			'is_view' => 'Статус',
                        'link'=>'Ссылка',
			'image' => 'Изображение для слайдера ('.Yii::app()->controller->module->thumbnailWidth.'x'.Yii::app()->controller->module->thumbnailHeight.')',
		);
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
		$criteria->compare('position',$this->position);
		$criteria->compare('is_view',$this->is_view);
                $criteria->compare('link',$this->link);

		 return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
        
        public function getId(){
            return self::model()->tableName().'_'.$this->id;
        }

        protected function beforeSave()
            {

                    if(parent::beforeSave())
                    {
                           
                            //Загрузка миниатюры
                            if($this->image){
                                    $file = ROOT_PATH . DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.'partner'.DIRECTORY_SEPARATOR. $this->image->name;
                                    $this->image->saveAs($file);
                            }
                            return true;
                    }
                    else
                            return false;
            }

        public function getPrice(){
           /* if(isset($this->share_price) && $this->share_price != 0)
                    return $this->share_price;
            else
             return $this->price;*/
        }
	public function adminSearchIsView($key){
		$isView = array('1'=>'Отображается', '0' => 'Скрыт');
		return $isView[$key];
	}
	
	
	
	
	
}