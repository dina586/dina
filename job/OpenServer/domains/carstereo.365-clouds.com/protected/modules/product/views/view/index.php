<?php 
	Yii::app()->getClientScript()->registerCoreScript('jquery');
	$cs=Yii::app()->clientScript; 
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/system.css');
?>
<!--<div class="header">
    <div class="container">
        <div class="page-title">
            <div class="rg"></div>
            <h1>Huge Discounts on all Car Audio With MJ Car Stereo | Orange, CA</h1>
        </div>
    </div>
</div>-->
<div class="l-base_wraper">
    <div class="rg"></div>
    <h1 class = "l-page_title"><?=$this->pageTitle?></h1>
</div>
<div class="body">
    <div class="body-round"></div>
    <div class="body-wrapper">
        <div class="body-page">
            <p></p>
            <div class="body-wrapper-images">
                <?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'header')); ?>
            </div>
            <br/>
            <div class="container-fluid content page-content">
                 <div class="row-fluid">
                
<?php $this->widget('bootstrap.widgets.BsListView', array(
                            'dataProvider'=>$dataProvider,
                            'itemView'=>'_view',
                        )); ?>
                </div>     
            </div>
        </div>
    </div>
</div>