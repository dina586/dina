<?php
/**
 * EAjaxUpload class file.
 * This extension is a wrapper of http://valums.com/ajax-upload/
 *
 * @author Vladimir Papaev <kosenka@gmail.com>
 * @version 0.1
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
        How to use:

        view:
		 $this->widget('ext.EAjaxUpload.EAjaxUpload',
                 array(
                       'id'=>'uploadFile',
                       'config'=>array(
                                       'action'=>'/controller/upload',
                                       'allowedExtensions'=>array("jpg"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                       'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                                       //'onComplete'=>"js:function(id, fileName, responseJSON){ alert(fileName); }",
                                       //'messages'=>array(
                                       //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                       //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                       //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                       //                  'emptyError'=>"{file} is empty, please select files again without it.",
                                       //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                       //                 ),
                                       //'showMessage'=>"js:function(message){ alert(message); }"
                                      )
                      ));

        controller:

	public function actionUpload()
	{
	        Yii::import("ext.EAjaxUpload.qqFileUploader");
	        
                $folder='upload/';// folder for uploaded files
                $allowedExtensions = array("jpg"),//array("jpg","jpeg","gif","exe","mov" and etc...
                $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                $result = $uploader->handleUpload($folder);
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;// it's array
	}

*/
Yii::import("ext.EAjaxUpload.qqFileUploader");

class EAjaxUploadAction extends CAction
{

        public function run()
        {
                // list of valid extensions, ex. array("jpeg", "xml", "bmp")
                $allowedExtensions = array("jpg");
                // max file size in bytes
                $sizeLimit = 1 * 1024 * 1024;

                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                $result = $uploader->handleUpload('upload/');
                // to pass data through iframe you will need to encode all html tags
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
        }
}
