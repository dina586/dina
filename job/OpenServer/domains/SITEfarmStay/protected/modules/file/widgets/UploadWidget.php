<?php 
class UploadWidget extends CWidget {
	
	public $action = '';
	
	public $id = "a_upload_file";
	
	public $postParams = array();
	
	//максимальный размер файла в байтах (10 Мб по умолчанию)
	public $sizeLimit = 10485760;
	
	public $multiple = true;
	
	public $allowedExt = array();
			
	//Генерируем полный конфиг для виджета
	protected function config() {
		if(!$this->action)
			$this->action = Yii::app()->createUrl('file/upload/base');
		$debug = DEV_MODE == true?true:false;
		if(empty($this->allowedExt))
			$this->allowedExt = Yii::app()->getModule('file')->getAllowedExt($this->postParams['file_type']);
		return array(
			'template'=>'<div class="qq-uploader"><div class="qq-upload-drop-area"><span>'.Yii::t('admin', 'Drop files here to upload').'</span></div><div class="qq-upload-button">'.Yii::t('main', 'Upload Files').'</div><ul class="qq-upload-list"></ul></div>',
			'fileTemplate'=>'<li><span class="qq-progress-bar"></span><span class="qq-upload-file"></span><span class="qq-upload-spinner"></span><span class="qq-upload-size"></span><a class="qq-upload-cancel" href="#">'.Yii::t('main', 'Cancel').'</a><span class="qq-upload-failed-text">'.Yii::t('main', 'Upload error').'</span></li>',
			'action'=>$this->action,
			'multiple'=> $this->multiple,
			'debug' => $debug,
			'allowedExtensions'=>$this->allowedExt,
			'sizeLimit'=>$this->sizeLimit,
			'minSizeLimit'=>5120,
			'onComplete'=>"js:function(id, fileName, responseJSON){
				$('#d-file_manager_items').append(responseJSON.imagedata); 
				$('.qq-upload-success').remove();
			}",
			'onError'=> "js:function(id, fileName, responseJSON){
				$('#j-error_message').html(responseJSON.responseText);
			}",
			'messages'=>array(
				'typeError'=>Yii::t('admin', "{file} has an invalid extension. Only expansion {extensions} are allowed."),
				'sizeError'=>Yii::t('admin', "{file} too big. The maximum size of {sizeLimit}."),
				'minSizeError'=>Yii::t('admin', "{file} too small. The minimum size {minSizeLimit}."),
				'emptyError'=>Yii::t('admin', "{file} empty. Please try again"),
				'onLeave'=>Yii::t('admin', "Files downloaded if you leave now, the download will be stopped.")
			),
			'showMessage'=>'js:function(message){$("#j-error_message").text(message)}'
		);
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
		
		$setup = array(
			'element'=>'js:document.getElementById("'.$this->id.'")',
		);
		
		$setup = array_merge($setup, $config);
		$setup['params'] = $postParams;
		$setup = CJavaScript::encode($setup);
		JS::add('ajaxFileUpload'.$this->id, "var FileUploader_".$this->id." = new qq.FileUploader(".$setup.");");
		
		$view = '<div id="'.$this->id.'"><noscript><p>'.Yii::t('admin', 'In order to use the plugin, enable javascript').'</p></noscript></div>';
		if($this->multiple == true)
			$view .= '<p class = "l-hint">'.Yii::t('admin', 'You can upload multiple files simultaneously holding down the shift or ctrl when selecting').'</p>';
		$view .= '<div id = "j-error_message" class = "l-system_message"></div>';
		echo $view;
	}
	
	protected function publishAssets() {
		Yii::app()->clientScript->packages['ajaxFileUpload'] = array(
			'basePath'=>'application.modules.file.assets',
			'js' => array('fileuploader.js', 'file_manager.js'),
			'css' => array('fileuploader.css', 'file_manager.css'),
		);
		Yii::app()->clientScript->registerPackage('ajaxFileUpload');
	}
}
?>