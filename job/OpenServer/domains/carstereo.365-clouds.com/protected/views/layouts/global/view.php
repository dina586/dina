<?php 
    $cs=Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/system.css'); 
?>
<!--<div class="header">
    <div class="container">
        <div class="page-title">-->
        <div class="l-base_wraper">
            <div class="rg"></div>
            <h1 class = "l-page_title"><?=$this->pageTitle?></h1>
        </div>
        <!--</div>
    </div>
</div>-->

<div class="body">
    <div class="body-round"></div>
     <div class="body-wrapper">
        <div class="body-page">
        <!--<div class="g-content">
            <div class="g-content-round"></div>
            <div class="comment-text">-->
                <?=$model->content;?>
                <?=Helper::editLink(Yii::app()->user->checkAccess('admin'));?>
            <!--</div>
        </div>    -->
            
	</div>
    </div>
</div>
<div class ="clearfix"></div>

