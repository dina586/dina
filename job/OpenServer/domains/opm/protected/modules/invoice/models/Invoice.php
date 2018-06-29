<?php

/**
 * This is the model class for table "{{invoice}}".
 *
 * The followings are the available columns in table '{{invoice}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $invoice_data
 * @property double $total_cost
 * @property string $due_date
 * @property double $discount
 * @property double $tax
 * @property double $shipping
 * @property double $paid
 * @property double $unpaid
 * @property string $create_date
 * @property integer $invoice_type
 * @property integer $status
 */
class Invoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
	 */
	public $s_name;
	
	public $start_date;
	public $end_date;
	
	public $s_total;
	
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{invoice}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, phone, address, create_date, invoice_type, status', 'required'),
			array('invoice_name, s_name, user_id, email, total_cost, due_date, deposit, invoice_data, model_id', 'safe'),
			array('email', 'email'),
			array('user_id, invoice_type, status', 'numerical', 'integerOnly'=>true),
			array('total_cost, discount, tax, shipping', 'numerical'),
			array('name, email, phone', 'length', 'max'=>255),
			array('s_total, start_date, end_date, id, user_id, name, email, phone, address, invoice_data, total_cost, due_date, discount, tax, shipping, create_date, invoice_type, status', 'safe', 'on'=>'search'),
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
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}
	public function behaviors(){
		return array(
			'dateBehavior' =>array(
				'class' => 'application.components.behavior.DateBehavior',
				'datetime'=>array('create_date'),
				'date'=>array('due_date', 'start_date', 'end_date'),
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('admin', 'ID'),
			'user_id' => Yii::t('admin', 'Customer ID'),
			'name' => Yii::t('admin', 'Customer name'),
			'email' => Yii::t('admin', 'Customer Email'),
			'phone' => Yii::t('admin', 'Customer phone'),
			'address' => Yii::t('admin', 'Customer address'),
			'invoice_data' => Yii::t('admin', 'Invoice Data'),
			'total_cost' => Yii::t('admin', 'Total Cost'),
			'due_date' => Yii::t('admin', 'Due Date'),
			'discount' => Yii::t('admin', 'Discount'),
			'tax' => Yii::t('admin', 'Tax'),
			'shipping' => Yii::t('admin', 'Shipping'),
			'paid' => Yii::t('admin', 'Paid'),
			'unpaid' => Yii::t('admin', 'Unpaid'),
			'create_date' => Yii::t('admin', 'Order Date'),
			'invoice_type' => Yii::t('admin', 'Invoice Type'),
			'status' => Yii::t('admin', 'Status'),
			'deposit' => Yii::t('admin', 'Deposit'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($model)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = $this->criteria($model);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
		));
	}
	
	
	public function criteria($model){
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$model->id);
		$criteria->compare('user_id',$model->user_id);
		//$criteria->compare('total_cost',$model->total_cost);
		$criteria->compare('invoice_type',$model->invoice_type);
		
		//Если статус 100, то выводим все просроченные инвойсы
		if($model->status == 100) {
			$criteria->addCondition('due_date < :due_date AND status = 0');
			$criteria->params = array_merge($criteria->params, array(':due_date'=>date('Y-m-d')));
		} else
			$criteria->compare('status',$model->status);
		
		if($model->start_date != '' && $model->end_date!= '')
			$criteria->addBetweenCondition('create_date', System::saveDate($model->start_date, 'datetime'), System::saveDate($model->end_date, 'datetime'));
		elseif($model->start_date != '' || $model->end_date != '') {
			
			if($model->start_date != ''){
				$criteria->addCondition('create_date >= :create_date');
				$createDate = $model->start_date;
				echo System::saveDate($model->start_date, 'datetime');
			} elseif($model->end_date != '') {
				$criteria->addCondition('create_date <= :create_date');
				$createDate = $model->end_date;
			}
			$criteria->params = array_merge($criteria->params, array(':create_date'=>System::saveDate($createDate, 'datetime')));
		}
		
		return $criteria;
	}
	
	public function invoiceTotalSum($model, $paid = false){
		$criteria = $this->criteria($model);
		if($paid === 1)
			$criteria->compare('status', 1);
		elseif($paid === 0)
			$criteria->compare('status', 0);

		$criteria->select = 'sum(total_cost) as s_total';
		
		$price = Helper::viewPrice(self::model()->find($criteria)->getAttribute('s_total')); 
		if($price == '')
			$price = 0;
		return $price;
	}
	
	public function invoiceCount($model, $paid = false){
		$criteria = $this->criteria($model);
		if($paid === 1)
			$criteria->compare('status', 1);
		elseif($paid === 0)
			$criteria->compare('status', 0);
		
		return self::model()->count($criteria); 

	}
	
	
	
	
	public function beforeValidate() {
		if(isset($_POST['invoice']))
			$this->invoice_data = serialize($_POST['invoice']);
		
		parent::beforeValidate();
		return true;
	}
	public function beforeSave() {
		$this->address = nl2br($this->address);
		if($this->invoice_type !=0)
			$this->invoice_name = Yii::app()->getModule('invoice')->type[$this->invoice_type];
		
		if($this->invoice_type == 2)
			$this->tax_percent = 0;
		
		parent::beforeSave();
		return true;	
	}
	
	public static function getInvoice($type, $modelId){
		$invoice = Invoice::model()->find('model_id=:model_id AND invoice_type=:type', array(':type'=>$type, ':model_id'=>$modelId));
		return $invoice;
	}

}