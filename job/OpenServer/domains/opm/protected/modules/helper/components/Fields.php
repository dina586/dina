<?php
class Fields {
	
	
	public static function gridImage($path, $url = '', $name = '') {
		$cFile = Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').$path);
		
		if($cFile->exists)
			$image = '<img src = "'.$path.'" alt = "'.$name.'"/>';
		else
			$image = '<img src = "/images/'.Yii::app()->getModule('file')->noImage.'" alt = "'.$name.'"/>';
		
		if($url != '')
			$view = '<a href = "'.$url.'" target = "_blank">'.$image.'</a>';
		else
			$view = $image;
		echo $view;
	}
	
	//Базовый редактор в админке
	public static function editor($model, $form, $attribute = 'content'){
		$view = $form->labelEx($model, $attribute);
		$view .= '<div class = "b-ckeditor">';
		$view .= Yii::app()->controller->widget('ext.editor.CKeditor', array(
			'model'=>$model,
			'attribute'=>$attribute,
		), true);
		$view .= '</div>';
		$view .= $form->error($model, $attribute);
		return $view;
	}
	
	public static function textArea($model, $form, $attribute = 'description') {
		$breaks = array("<br />","<br>","<br/>");
		$model->{$attribute} = str_ireplace($breaks, "", $model->{$attribute});
		return $form->textAreaControlGroup($model, $attribute);
	}
	
	/**
	 * Поле с датой 
	 * @param obj $model
	 * @param string $attribute
	 * @return string
	 */
	public static function dateField($model, $form, $attribute = 'date', $viewDefault = true) {
		if(!isset($model->{$attribute}) && $viewDefault == true) 
			$model->{$attribute} = System::viewDate(date('Y-m-d'));
		$view = $form->labelEx($model, $attribute, array('class'=>'control-label'));
		$view .= '<div>';
		$view .= Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model,
			'attribute'=> $attribute,
			'htmlOptions'=>array('class'=>'form-control'),
		), true); 
		
		$view .= $form->error($model, $attribute);
		$view .= '</div>';
		return $view;
	}
	
	/**
	 * Поле с датой 
	 * @param obj $model
	 * @param string $attribute
	 * @return string
	 */
	public static function dateTimeField($model, $form, $attribute = 'date', $viewDefault = true) {
		if(!isset($model->{$attribute}) && $viewDefault == true) 
			$model->{$attribute} = System::viewDate(date("Y-m-d H:i:s"), 'datetime');
		elseif($model->{$attribute} == '0000-00-00 00:00:00')
			$model->{$attribute} = '';
		
		$view = $form->labelEx($model, $attribute, array('class'=>'control-label'));
		$view .= '<div>';
		
		$view .= Yii::app()->controller->widget('ext.YiiDateTimePicker.jqueryDateTime',array(
			'model'=>$model, 
			'attribute'=>$attribute,
			'htmlOptions'=>array('class'=>'form-control'),
		), true);
		
		$view .= $form->error($model, $attribute);
		$view .= '</div>';
		
		return $view;
	}
	
	public static function dateTimeFieldOld($model, $form, $attribute = 'date', $viewDefault = true) {
		if(!isset($model->{$attribute}) && $viewDefault == true) 
			$model->{$attribute} = System::viewDate(date("Y-m-d H:i:s"), 'datetime');
		elseif($model->{$attribute} == '0000-00-00 00:00:00')
			$model->{$attribute} = '';
		
		$view = $form->labelEx($model, $attribute, array('class'=>'control-label'));
		$view .= '<div>';
		
		$view .= Yii::app()->controller->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			'model'=>$model, 
			'attribute'=>$attribute,
			'htmlOptions'=>array('class'=>'form-control'),
		), true);
		
		$view .= $form->error($model, $attribute);
		$view .= '</div>';
		
		return $view;
	}
	
	public static function birthdayField($model, $form, $attribute = 'birthday') {
		if($model->$attribute == '0000-00-00')
			$model->$attribute = '';
		
		if($attribute == '')
			$placehoder = 'Date of birth';
		else $placehoder = '';
		
		$view = $form->labelEx($model, $attribute, array('class'=>'control-label'));
		$view .= '<div>';
				
		$view .= Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=> $attribute,
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'constrainInput'=> true,
					'changeMonth'=> true,
					'changeYear'=> true,
					'yearRange' => '1920:'.date('Y'),
				),
				'htmlOptions'=>array('placeholder'=>$placehoder, 'class'=>'form-control')
		), true);

		$view .= $form->error($model, $attribute);
		$view .= '</div>';
		
		return $view;
	}
	
	/**
	 * Поле для загрузки изображения
	 * @param obj $model
	 * @param obj $form
	 * @param string $folder
	 * @param string $attribute
	 */
	public static function fileField($model, $form, $folder, $attribute = 'image') {
		$view = $form->labelEx($model,'image');
		$view .= $form->fileField($model, $attribute);
		$path = Yii::getPathOfAlias('webroot').DS."upload".DS.$folder.DS.$model->id.".jpg";
		if(file_exists($path)){
			$url = Yii::app()->createUrl('file/image/imgDelete', array('image'=>$model->id.".jpg", 'folder'=>$folder));
			$view .= '<div class = "g-clear_fix"></div>
				<div class = "b-image_admin_field l-inline_block j-image_admin_field">
				<img src = "/upload/'.$folder.'/'.$model->id.'.jpg?rnd='.time().'" alt = "'.$model->name.'" /><br/>
				<a href = "'.$url.'" class = "a-delete_image">'.Yii::t('main', 'Delete').'</a>';
			$view .= '</div>';
		}
		echo $view;
	}
	
	/**
	 * Кнопка в формах админа
	 * @param string $name
	 * @param obj $icon
	 * @return string
	 */
	public static function submitBtn($name, $icon = BsHtml::GLYPHICON_FLOPPY_SAVE, $htmlOptions = array()) {
		return BsHtml::submitButton($name, 
			array_merge(array(
				'color' => BsHtml::BUTTON_COLOR_SUCCESS,
				'size' => BsHtml::BUTTON_SIZE_SMALL,
				'icon' => $icon,
			), $htmlOptions)
		);
		
	}
	
	//Country Field
	public static function countryAdmin($model, $form, $attribute = 'country_id') {
		Yii::import('application.modules.helper.models.Country');
		$view = $form->dropDownListControlGroup(
			$model,
			$attribute,
			CHtml::listData(Country::model()->findAll(array('order'=>'country_name_en')), 'id', 'country_name_en'),
			array('class'=>'a-country', 'empty'=>Yii::t('user', 'Choose Country'))
		);
	
		Yii::app()->clientScript->registerPackage('choosen');
	
		JS::add('country_choose',
		"$('.a-country').chosen({
			'search_contains':true,
			'width': '100%'
		});");
	
		return $view;
	}
	
	//City Field
	public static function cityAdmin($model, $form, $attribute = 'city_id', $countryId = 372) {
		Yii::import('application.modules.helper.models.City');
		$view = $form->dropDownListControlGroup(
			$model,
			$attribute,
			CHtml::listData(City::model()->findAll(
					array(
						'order'=>'city_name_en', 
						'condition'=>'id_country=:id_country', 
						'group'=>'city_name_en',
						'params'=>array(':id_country'=>$countryId)
					)), 
				'id', 'city_name_en'),
			array('class'=>'j-choosen_city', 'empty'=>Yii::t('user', 'Choose City'))
		);
	
		Yii::app()->clientScript->registerPackage('choosen');
	
		JS::add('city_choose',
		"$('.j-choosen_city').chosen({
			'search_contains':true,
			'width': '100%'
		});");
	
		return $view;
	}
	
	//Country Field
	public static function stateAdmin($model, $form, $attribute = 'state_id') {
		Yii::import('application.modules.helper.models.UsaStates');
		$view = $form->dropDownListControlGroup(
				$model,
				$attribute,
				CHtml::listData(UsaStates::model()->findAll(array('order'=>'state_name')), 'id', 'state_name'),
				array('class'=>'j-choosen', 'empty'=>Yii::t('user', 'Choose State'))
		);
	
		Yii::app()->clientScript->registerPackage('choosen');
	
		JS::add('choosen',
		"$('.j-choosen').chosen({
			'search_contains':true,
			'width': '100%'
		});");
	
		return $view;
	}
	
	public static function listBox($model, $form, $data, $attribute = '') {
		$options = array();
		if(isset($model->$attribute)) {
			$m = explode(",", $model->$attribute);
			foreach ($m as $v) {
				$options[$v] = array('selected'=>'selected');
			}
		}
		Yii::app()->clientScript->registerPackage('choosen');
	
		$view = $form->listBoxControlGroup($model,$attribute,
				$data,
				array('multiple'=>'multiple','size'=>count($data),'options'=>$options, 'class'=>'j-choosen')
		);
	
		JS::add('choosen',
		"$('.j-choosen').chosen({
				'search_contains':true,
				'width': '100%'
			});");
		return $view;
	}
	
	public static function checkboxList($model, $form, $data, $attribute = '') {
		$dataArr = explode(",", $model->$attribute);
		$checked = array_diff(array_map('trim', $dataArr), array(''));
		return BsHtml::checkBoxList($attribute, $checked, $data);
	}
	
	//Procedure Field
	public static function procedureField($model, $form, $attribute = 'procedure_id', $empty = false) {
		Yii::import('application.modules.service.models.*');
		$sqlData = ServiceProcedure::model()->findAll(array('order'=>'number, name'));
		foreach($sqlData as $data) {
			$arr[] = array('id'=>$data->id, 'name'=>$data->name, 'group'=>$data->service->name);
		}
		$htmlOptions = array();
		if($empty === true)
			$htmlOptions = array('empty'=>'Choose Procedure');
		
		$view = $form->dropDownListControlGroup(
			$model,
			$attribute,
			CHtml::listData($arr, 'id', 'name', 'group'),
			$htmlOptions
		);
		
		return $view;
	}
}