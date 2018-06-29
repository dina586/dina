<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout;
	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	
	/**
	 * 
	 */
	public function init(){
		//Подключение сторонней каптчи
		Yii::$classMap = array_merge( Yii::$classMap, array(
			'CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captcha').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
			'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captcha').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
		));
	}
	
	/*
	 * Вывод контента через аякс 
	 * */
	public function ajaxBeginContent($view=null,$data=array()) {
		if(Yii::app()->request->isAjaxRequest) {
			return false;
		} else {
			$this->beginWidget('CContentDecorator',array('view'=>$view, 'data'=>$data));
		}
	}
	public function ajaxEndContent()
	{
		if(Yii::app()->request->isAjaxRequest) {
			return false;
		} else {
			$this->endWidget('CContentDecorator');
		}
	}
	/*Функция аякс вывода данных, заменяет стандартный render*/
	public function ajaxRender($view,$data=null,$return=false, $processOutput=false){
		if(Yii::app()->request->isAjaxRequest) {
			$this->renderPartial($view,$data,$return,$processOutput);
			JS::view();
		}
		else {
			$this->render($view,$data,$return);
		}
	}
	
	/*Блок для изменения СЕО на странице*/
	public function seo($title=null, $seoKeywords=null, $seoDescription=null, $name=null) {
		
		if($title != '') {
			$this->pageTitle = $title;
		} else
			$this->pageTitle = $name;
		
		if($seoKeywords) {
			$this->metaKeywords = $seoKeywords;
		}
		
		if($seoDescription) {
			$this->metaDescription = $seoDescription;
		}
		
		if(Yii::app()->request->isAjaxRequest)
		JS::add('page_seo', '
			$("title").text("'.addslashes(strip_tags($this->pageTitle)).'");
			$("meta[name=description]").attr("content", "'.addslashes($this->metaDescription).'");
			$("meta[name=keywords]").attr("content", "'.addslashes($this->metaKeywords).'");
		');
	}
	
	/*Инициализация сео модуля для всего сайта*/
	public function behaviors(){
	    return array(
	        'seo'=>array('class'=>'ext.seo.components.SeoControllerBehavior'),
	    );
	}
	
	public function registerAllScripts() {
		$cs = Yii::app()->clientScript;
		Yii::app()->getClientScript()->registerCoreScript('jquery');
	}
}