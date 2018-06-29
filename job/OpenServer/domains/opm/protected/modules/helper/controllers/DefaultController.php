<?php

class DefaultController extends Controller
{
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('getCity', 'autocomplete'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionGetCity()
	{
		$countryId = (int)Yii::app()->request->getParam('country_id');
		
		if($countryId != 0) {
			$text = 'Choose City';
		}
		else {
			$countryId = 1000000;
			$text = 'Choose Country First';
		}
		
		$name = str_replace('_city_id', '', Yii::app()->request->getParam('name'));
		
		echo BsHtml::dropDownList(
			$name.'[city_id]',
			'',
			CHtml::listData(City::model()->findAll(
				array(
					'order'=>'city_name_en', 
					'condition'=>'id_country=:id_country', 
					'group'=>'city_name_en',
					'params'=>array(':id_country'=>$countryId)
				)), 
			'id', 'city_name_en'),
			array('class'=>'j-choosen_city', 'empty'=>$text)
		);
	}
	
	/**
	 * Autocomlete
	 */
	public function actionAutocomlete()
	{
		$model = Yii::app()->request->getParam('model');
		$field = Yii::app()->request->getParam('field');
		Yii::import('application.modules.cbc.models.Cbc');
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags = $model::model()->findAll(array(
				'condition'=>$field.' LIKE :keyword',
				'order'=>$field,
				'distinct'=>true,
				'select'=>$field,
				'limit'=>20,
				'params'=>array(
					':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
				),
			));
		$names=array();
			foreach($tags as $tag)
				$names[]=$tag->$field;
	
			if($names!==array())
				echo implode("\n",$names);
		}
	}
	

}