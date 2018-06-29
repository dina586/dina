<?php 
$this->widget('application.components.BreadCrumb', 
    array('crumbs' => array(
             array('name' => ''.$model->name.''),
    ) ));
?>
<div class="wraper">
	<div class="container">
        <div class="b-page">
            <div class="page_title_block">
                <div class="bg_title">
                    <h1><?=$model->name;?></h1>
                </div>
        	</div>
        </div>
    	<div class = "clear"></div>
    	
    	<article class = "g-styles">
    		<?=$model->content;?>
    	</article>
    <div class = "clear"></div>
    </div>
    <div class = "clear"></div>
</div>

<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>