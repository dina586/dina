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
	public static function dateField($model, $form, $attribute = 'date') {
		if(!isset($model->{$attribute})) 
			$model->{$attribute} = date('Y-m-d');
		$view = $form->labelEx($model, $attribute);
		
		$view .= Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model,
			'attribute'=> $attribute,
			'htmlOptions'=>array('class'=>'form-control'),
		), true); 
		
		$view .= $form->error($model, $attribute);
		
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
				'color' => BsHtml::BUTTON_COLOR_INFO,
				'size' => BsHtml::BUTTON_SIZE_SMALL,
				'icon' => $icon,
			), $htmlOptions)
		);
		
	}
}