<?php 	
	$cs=Yii::app()->clientScript;
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-1-8-2.js');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/gallery.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/camera.css');  
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/gallery.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/camera.js');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/system.css');
?>
<?php Yii::import('application.modules.file.models.FileManager'); ?>

<div class="l-base_wraper">
    <div class="rg"></div>
    <h1 class = "l-page_title"><?=$this->pageTitle?></h1>
</div>
<div class="body">
     <div class="body-round"></div>
     <div class="body-wrapper">
         <div class="body-page">
             
             <div class="row-fluid">
                <div class="entry">
                    <div class="gallery gallery-images">
                        <div class="fluid_container"> 
                            <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">                                
                                <?php   foreach ($dataProvider as $data)
                                        {?>
                                <?php 
                                        
                                $file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$data->folder.DS.$this->type.DS;
                                if(Yii::app()->cFile->set($file.$data->file)->exists)
                                    $src = '"/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/thumbnail/'.$data->file.'"';    
                                    
                                else
                                    $src = '';
	         
                                ?>
                                <div data-thumb= "<?=$src?>" title = "<?=$data->name?>" alt = "<?=$data->name?>" data-src="<?=Yii::app()->getModule('file')->uploadFolder;?>/<?=$data->folder;?>/original/<?=$data->file;?>">
                                <div class="camera_caption fadeFromBottom"><?=$data->content;?></div>
                            </div>
                                <?php   }?> 
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>
<div class ="clearfix"></div>