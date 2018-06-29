<?php 
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class UploadWidget extends CWidget {
	
	/**
	 * Основная конфигурация виджета
	 */
	public $action = '';
	
	public $id = "a_upload_file";
	
	public $postParams = array();
	
	//максимальный размер файла в байтах (10 Мб по умолчанию)
	public $sizeLimit = 10485760;
	
	public $multiple = true;
	
	public $maxConnections = 3;
	
	public $allowedExt = array();
	
	/**
	 * Сохранение оригинального имени файла
	 * Значения true/false
	 * @var type 
	 */
	public $originalName;
	
	/**
	 * Дополнительная конфигурация внешнего вида
	 */
	//Отображение dropdownarea
	public $hideShowDropArea = false;
	
	//Шаблон вывода кнопки и dropdownarea на страницу
	public $template = '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>{dragText}</span></div><div class="qq-upload-button">{uploadButtonText}</div><ul class="qq-upload-list"></ul></div>';
	
	//Текста для вывода
	public $dragText;
	public $uploadButtonText;
	public $cancelButtonText;
	public $failUploadText;
	
	//События
	public $onSubmit;
	public $onProgress;
	public $onComplete;
	public $onCancel;
	public $onError;
	
	//Генерируем полный конфиг для виджета
	protected function config() {
		if(!$this->action)
			$this->action = Yii::app()->createUrl('file/upload/base');
		
		$debug = DEV_MODE == true?true:false;
		
		if(empty($this->allowedExt))
			$this->allowedExt = Yii::app()->getModule('file')->getAllowedExt($this->postParams['file_type']);
		
		if($this->dragText == '')
			$this->dragText = Yii::t('admin', 'Drop files here to upload');
		
		if($this->uploadButtonText == '')
			$this->uploadButtonText = Yii::t('admin', 'Click here to upload files');
		
		if($this->cancelButtonText == '')
			$this->cancelButtonText = Yii::t('main', 'Cancel');
		
		if($this->failUploadText == '')
			$this->failUploadText = Yii::t('admin', 'Upload failed');
		
		if($this->onComplete == '')
			$this->onComplete = "js:function(id, fileName, responseJSON){
				$('#d-file_manager_items').append(responseJSON.imagedata); 
				$('.qq-upload-success').remove();
			}";
		
		if($this->onError == '')
			$this->onError = "js:function(id, fileName, responseJSON){
				$('#j-error_message').html(responseJSON.responseText);
			}";
		
		return [
			'template'=>$this->template,
			'hideShowDropArea'=>$this->hideShowDropArea,
			'action'=>$this->action,
			'multiple'=> $this->multiple,
			'maxConnections'=> $this->maxConnections,
			'debug' => $debug,
			'allowedExtensions'=>$this->allowedExt,
			'sizeLimit'=>$this->sizeLimit,
			'minSizeLimit'=>5120,
			'dragText' => $this->dragText,
			'uploadButtonText' => $this->uploadButtonText,
			'cancelButtonText' => $this->cancelButtonText,
			'failUploadText' => $this->failUploadText,
			'onComplete'=>$this->onComplete,
			'onError'=> $this->onError,
			//'onSubmit'=>$this->onSubmit,
			//'onProgress'=>$this->onProgress,
			//'onCancel'=>$this->onCancel,
			
			'messages'=>[
				'typeError'=>Yii::t('admin', "{file} has an invalid extension. Only expansion {extensions} are allowed."),
				'sizeError'=>Yii::t('admin', "{file} too big. The maximum size of {sizeLimit}."),
				'minSizeError'=>Yii::t('admin', "{file} too small. The minimum size {minSizeLimit}."),
				'emptyError'=>Yii::t('admin', "{file} empty. Please try again"),
				'onLeave'=>Yii::t('admin', "Files downloaded if you leave now, the download will be stopped.")
			],
			'showMessage'=>'js:function(message){$("#j-error_message").text(message)}'
		];
	}
	
	
	public function run()
	{
		$config = $this->config();
		if(empty($config['action']))
			throw new CException('File Upload: param "action" cannot be empty.');
		
		unset($config['element']);
			
		$this->publishAssets();
	
		$postParams = array('PHPSESSID'=>session_id(),'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken);
		if(isset($this->postParams))
			$postParams = array_merge($postParams, $this->postParams);

		$postParams['sizeLimit'] = $this->sizeLimit;
		
		if(!isset($postParams['cover']))
			$postParams['cover'] = true;
		
		if(!key_exists('file_type', $postParams))
			$postParams['file_type'] = 'image';
		
		if($this->originalName === true || $this->originalName === false)
			$postParams['originalName'] = $this->originalName;
		
		$setup = array(
			'element'=>'js:document.getElementById("'.$this->id.'")',
		);
		
		$setup = array_merge($setup, $config);
		$setup['params'] = $postParams;
		$setup = CJavaScript::encode($setup);

        JS::add('ajaxFileUpload'.$this->id, "var FileUploader_".$this->id." = initFileUpload(".$setup.");");
		
		$view = '<div class = "b-file_uploader"><div id="'.$this->id.'"><noscript><p>'.Yii::t('admin', 'In order to use the plugin, enable javascript').'</p></noscript></div>';
		$view .= '<div id = "j-error_message" class = "l-system_message"></div></div>';
		echo $view;
	}
	
	protected function publishAssets() {
		Yii::app()->clientScript->packages['ajaxFileUpload'] = array(
			'basePath'=>'application.modules.file.assets',
			'js' => array('fileuploader.js', 'file_manager.js'),
			'css' => array('fileuploader.css', 'file_manager.css'),
			'depends' => array('jquery'),
		);
		Yii::app()->clientScript->registerPackage('ajaxFileUpload');
	}
}
?>