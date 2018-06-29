<div class="wrapper">
    <div class="breadcrumbs">
    	<div class="container">
            <h1 class="title-page"><?=$model->name;?></h1>
        </div>
    </div>
	<div class="container">
    	<div class="content_block row no-sidebar">
        	<div class="fl-container">
            	<div class="posts-block">
                    <div class="contentarea">
                    	<div class="row">
                            <p><?=$model->content;?></p>        	
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div> 
    <?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>
</div>