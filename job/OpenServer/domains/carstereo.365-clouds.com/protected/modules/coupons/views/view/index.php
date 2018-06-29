<?php 
	Yii::app()->getClientScript()->registerCoreScript('jquery');
	$cs=Yii::app()->clientScript;
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/coupon.css'); 
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/system.css');
?>

<div class="l-base_wraper">
    <div class="rg"></div>
    <h1 class = "l-page_title"><?=$this->pageTitle?></h1>
</div>

<div class="body">
     <div class="body-round"></div>
     <div class="body-wrapper">
         <div class="body-page">
            <?php $this->widget('bootstrap.widgets.BsListView', array(
                            'dataProvider'=>$dataProvider,
                            'itemView'=>'_view',
                        )); ?>
         </div>
    </div>
</div>
<div class ="clearfix"></div>