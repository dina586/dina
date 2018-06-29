<?php 
    $cs=Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/system.css');  
?>
<!--<div class="header">
    <div class="container">
        <div class="page-title">
            <div class="rg"></div>
            <h1><?=$content->name;?></h1>
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
             
             <div class="content">
                <div class="container">                   	
                    <div class="contact eleven columns">
                        <div class="standard-form compressed style-2">
                            <h5 class="semi title style-2">Contact Form</h5>
                            <div class="form-result"></div>

                                <?php if(Yii::app()->user->hasFlash('contact')): ?>

                               <div class="flash-success">
                                   <?php echo Yii::app()->user->getFlash('contact'); ?>
                               </div>

                               <?php else: ?>

                               <div class="l-form">

                                   <?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                       'id'=>'contact-form',
                                       'enableClientValidation'=>false,
                                       'clientOptions'=>array(
                                       'validateOnSubmit'=>false,
                                      ),
                                                   ));    ?>
								<?php echo $form->errorSummary($model); ?>
								
                               <div class="l-row">
                                   <?php echo $form->textFieldControlGroup($model,'name'); ?>
                               </div>

                               <div class="l-row">
                                   <?php echo $form->textFieldControlGroup($model,'email'); ?>
                               </div>

                               <div class="l-row">
                                   <?php echo $form->textFieldControlGroup($model,'subject'); ?>
                               </div>

                               <div class="l-row">
                                   <?php echo $form->textAreaControlGroup($model,'body'); ?>
                               </div>

                               <?php Yii::app()->controller->renderPartial('helper.parts._captcha', array('model'=>$model, 'form'=>$form, 'field'=>'verifyCode'));?>

                               <div class = "g-clear_fix"></div>

                               <?=Fields::submitBtn( Yii::t('main','Send'), BsHtml::GLYPHICON_ENVELOPE);?>

                               <?php $this->endWidget(); ?>

                               </div><!-- form -->

                               <?php endif; ?>

                        </div>
                    </div>

                    <div class="five columns">
                        <h5 class="semi">On the Map</h5>
                        <div class="maps">
                            <iframe width="100%" height="140" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=810+W+Katella+Ave,+Orange,+CA+92867&amp;aq=&amp;sll=33.80875,-117.8609811,17z&amp;output=embed"></iframe>
                            <div class="clear"></div>
                        </div>

                        <h5 class="semi">Contact Info</h5>
                        <?=$content->content;?>                        
                    </div>
                    <div class="clear"></div>

                </div>
            </div>
        </div>
    </div>
</div>
   