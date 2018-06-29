<?php

/**
 * This is the model class for table "{{shop_history}}".
 *
 * The followings are the available columns in table '{{shop_history}}':
 * @property integer $id
 * @property string $email
 * @property integer $user_id
 * @property string $date
 * @property string $order_code
 * @property double $total_cost
 * @property integer $status
 * @property string $prod_data
 * @property string $user_ip
 * @property string $user_agent
 * @property string $user_comment
 * @property string $order_data
 */
class ProdHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SHistory the static model class
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
		return '{{shop_history}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('email, date, order_code, total_cost, status, prod_data', 'required'),
			array('user_ip, user_agent, user_comment, order_data, is_paid, payment_system', 'safe'),
			array('user_id, status, is_paid, payment_system', 'numerical', 'integerOnly'=>true),
			array('total_cost', 'numerical'),
			array('email, order_code', 'length', 'max'=>255),
			array('user_ip', 'length', 'max'=>50),
			array('user_agent', 'length', 'max'=>100),
			array('id, email, user_id, date, order_code, total_cost, status, prod_data, user_ip, user_agent, user_comment, order_data', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('admin', 'ID'),
			'email' => Yii::t('main', 'Email'),
			'user_id' => Yii::t('shop', 'Buyer'),
			'date' => Yii::t('shop', 'Date and time of order'),
			'order_code' => Yii::t('shop', 'Order Code'),
			'total_cost' => Yii::t('shop', 'Total Cost'),
			'status' => Yii::t('main', 'Status'),
			'prod_data' => Yii::t('shop', 'Prod Data'),
			'user_ip' => Yii::t('shop', 'User Ip'),
			'user_agent' => Yii::t('shop', 'User Agent'),
			'user_comment' => Yii::t('shop', 'Buyer Comment'),
			'order_data' => Yii::t('shop', 'Order Data'),
			'is_paid' => Yii::t('shop', 'Payment status'),
			'payment_system' => Yii::t('shop', 'Payment system'),
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('order_code',$this->order_code,true);
		$criteria->compare('total_cost',$this->total_cost);
		$criteria->compare('status',$this->status);
		$criteria->compare('prod_data',$this->prod_data,true);
		$criteria->compare('user_ip',$this->user_ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('user_comment',$this->user_comment,true);
		$criteria->compare('order_data',$this->order_data,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'status, date DESC',
			),
		));
	}
	
	public function beforeValidate() {
		
		if($this->isNewRecord) {
			$this->user_ip = Helper::getRealIp();
			$this->user_agent = $_SERVER['HTTP_USER_AGENT'];
			$this->date = date("Y-m-d H:i:s");
			$this->order_code = date('YmdHis').cText::cropStr(md5(date("YmdHis").rand(1,1000)), 5);
			$this->status = 1;
		}
		
		parent::beforeValidate();
		return true;
	}
	
	/**
	 * Сохранение нового заказа в базе данных
	 * @param string $email пользователя
	 * @param array $orderDetails сборка из полей, отправляемых через форму
	 * @param string $comment пользовательский комментарий к заказу
	 * @return boolean|string
	 */
	public static function saveOrder($email, $orderDetails, $comment) {
		
		if(Yii::app()->shoppingCart->isEmpty(1) == true)
			return false;
		
		$cart = Yii::app()->shoppingCart->getPositions();
		$prodData = array();
		
		foreach($cart as $product) {
			$prodData[] = array(
				'id'=>$product['id'],
				'name'=>$product['name'],
				'cost'=>$product->getPrice(),
				'quantity'=>$product->getQuantity(),
			);
		}
			
		$model = new self;
		$model->email = $email;
		$model->total_cost = Yii::app()->shoppingCart->getCost();
		$model->prod_data = serialize($prodData);
		$model->order_data = serialize($orderDetails);
		$model->user_comment = $comment;
		
		if(!Yii::app()->user->isGuest)
			$model->user_id = Yii::app()->user->id;
		else
			$model->user_id = 0;

		if($model->save()) {
			return $model->order_code;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Получения списка новых заказов
	 * @return string
	 */
	public static function getNewOrders() {
		$count = self::model()->count('status = 1');
		if($count == 0)
			return '';
		else return
			' ('.$count.')';
	}
}