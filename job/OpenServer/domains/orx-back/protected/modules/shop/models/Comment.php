<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property integer $product_id
 * @property string $comment
 * @property string $create_time
 * @property integer $is_new
 * @property integer $star
 * @property string $user_name
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public $image;
	public $verifyCode;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, comment, star, user_name', 'required'),
			array('create_time, is_new,', 'safe'),
			array('product_id, is_new, star', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>100),
			array('image',  'file',
				'types'=>'jpg, gif, png, jpeg',
				'allowEmpty'=>'true',
				'maxSize'=>1024 * 1024 * 1, // 1MB
				'tooLarge'=>'Размер загружаемого файла не должен превышать 1 Мегабайта!',
			),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, comment, create_time, is_new, star, user_name', 'safe', 'on'=>'search'),
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
			'product'=>array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'product_id' => 'Товар',
			'comment' => 'Комментарий',
			'create_time' => 'Дата добавления',
			'is_new' => 'Статус',
			'star' => 'Рейтинг',
			'user_name' => 'Ваше имя',
			'image' => 'Миниатюра (135x90)',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('star',$this->star);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->order='is_new DESC, create_time DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
			
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->create_time = date("Y-m-d H:i:s");
				$this->is_new = 1;
			} 
			//Загрузка миниатюры
			if($this->image){
				$file = ROOT_PATH . DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR. $this->image->name;
				$this->image->saveAs($file);
			}
			return true;
		}
		else
			return false;
	}
	public function adminSearchIsNew($id, $key){
		$isView = array('1'=>'Новый', '0' => 'Утвержден');
		if($key == 1) {
			$return = 0;
		} else {
			$return = 1;
		}
		$url = Yii::app()->createUrl('/shop/comment/status', array('id'=>$id, 'is_new'=>$return));
		$link = '<a class = "comment_status" href = "'.$url.'">'.$isView[$key].'</a>';
		return $link;
	}
	public function adminSearchProduct($postUrl, $postName) {
		$url = Yii::app()->createUrl('shop/product/view', array('id'=>$postUrl));
		$post = '<a href = "'.$url.'">'.$postName.'</a>';
		return $post;
	}
}