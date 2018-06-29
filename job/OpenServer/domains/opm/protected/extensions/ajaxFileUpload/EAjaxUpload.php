<?php
class EAjaxUpload extends CWidget
{
    public $id="a_upload_file";
	public $postParams=array();
	public $config=array();
	public $css=null;
        
        public function run()
        {
		if(empty($this->config['action']))
		{
		      throw new CException('EAjaxUpload: param "action" cannot be empty.');
		}

		if(empty($this->config['allowedExtensions']))
		{
		      throw new CException('EAjaxUpload: param "allowedExtensions" cannot be empty.');
		}
		
		if(empty($this->config['sizeLimit']))
		{
		      throw new CException('EAjaxUpload: param "sizeLimit" cannot be empty.');
		}

                unset($this->config['element']);

        echo '<div id="'.$this->id.'"><noscript><p>Для того, что бы воспользоваться плагином, включите javascript</p></noscript></div>';
		$assets = dirname(__FILE__).'/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);

		Yii::app()->clientScript->registerScriptFile($baseUrl . '/fileuploader.js', CClientScript::POS_HEAD);

        $this->css=(!empty($this->css))?$this->css:$baseUrl.'/fileuploader.css';
        Yii::app()->clientScript->registerCssFile($this->css);

		$postParams = array('PHPSESSID'=>session_id(),'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken);
		if(isset($this->postParams))
		{
			$postParams = array_merge($postParams, $this->postParams);
		}

		$config = array(
			'element'=>'js:document.getElementById("'.$this->id.'")',
 			'debug'=>false,
			'multiple'=>true
		);
		$config = array_merge($config, $this->config);
		$config['params']=$postParams;
		$config = CJavaScript::encode($config);
      		echo "<script type = 'text/javascript'>var FileUploader_".$this->id." = new qq.FileUploader($config); </script>";
			echo '<div class = "b-file_upload_error_message" id = "j-error_message"></div>';
        }
        

}
