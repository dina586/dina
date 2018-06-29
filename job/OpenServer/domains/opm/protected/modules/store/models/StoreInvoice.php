<?php

/**
 * This is the model class for table "{{store_invoice}}".
 *
 * The followings are the available columns in table '{{store_invoice}}':
 * @property integer $id
 * @property integer $history_id
 * @property string $client_name
 * @property string $address
 * @property string $due_date
 * @property double $tax
 * @property double $payment
 * @property double $shipping
 */
class StoreInvoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StoreInvoice the static model class
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
		return '{{store_invoice}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('history_id', 'required'),
			array('client_name, address, due_date, tax, payment, shipping', 'safe'),
			array('history_id', 'numerical', 'integerOnly'=>true),
			array('tax, payment, shipping', 'numerical'),
			array('client_name, address', 'length', 'max'=>255),
			array('id, history_id, client_name, address, due_date, tax, payment, shipping', 'safe', 'on'=>'search'),
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
			'history'=>array(self::HAS_ONE, 'ProdHistory', 'history_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('admin', 'ID'),
			'history_id' => Yii::t('admin', 'History'),
			'client_name' => Yii::t('admin', 'Client Name'),
			'address' => Yii::t('admin', 'Address'),
			'due_date' => Yii::t('admin', 'Due Date'),
			'tax' => Yii::t('admin', 'Tax'),
			'payment' => Yii::t('admin', 'Payment'),
			'shipping' => Yii::t('admin', 'Shipping'),
		);
	}
	
	public function behaviors(){
		return array(
			'dateBehavior' =>array(
				'class' => 'application.components.behavior.DateBehavior',
				'date'=>array('due_date'),
			),
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
		$criteria->compare('history_id',$this->history_id);
		$criteria->compare('client_name',$this->client_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('payment',$this->payment);
		$criteria->compare('shipping',$this->shipping);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}