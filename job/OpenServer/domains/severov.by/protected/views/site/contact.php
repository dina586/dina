
<?php 
$this->widget('application.components.BreadCrumb', 
    array('crumbs' => array(
             array('name' => 'Контакты'),
    ) ));
?>

<div class="wrapper">
	<div class="container">
    	<div class="page_title_block">
            <div class="bg_title">
                <h1><?=$content->name;?></h1>
            </div>
        </div>
    	<div class="content_block row no-sidebar">
        	<div class="fl-container">
            	<div class="posts-block">
                    <div class="contentarea">                        	
                        <div class="row">
						                       <div class="col-sm-9 module_cont pb20 animate" data-anim-type="fadeInLeft" data-anim-delay="300">
                           								<span style="font-size:120%">
								<p><strong><span style="color:black">Психолог:</span></strong> Северов Денис Анатольевич</p>
                                <p><strong><span style="color:black">Консультации проходят по адресу:</span></strong> г.Минск, М.Танка 20 пом. 101</p>
								<p><strong><span style="color:black">Телефон:</span></strong> +375 29 121-50-00</p>
								<p><strong><span style="color:black">График работы:</span></strong>8.00-22.00 по предварительной записи (без перерывов и выходных)</p>									
                                <p class="mb29"><strong><span style="color:black">Email:</span></strong> <a href="mailto:#"> severov-consult@mail.ru </a></p> 
								<p><strong><span style="color:black">Skype:</span></strong><a href="skype:denis_severov?userinfo"> Denis_severov</a></p></span>
								<h2>Схема проезда</h2>		
								<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=-ORJT9o4sd8QxDGC-4zvIeRGzqhV4kXF&width=600&height=450"></script>	
								
								<br/>
								<h3 class="mb27 mt_5">Напишите Нам</h3>
                            	<div class="module_content contact_form">
                                    <div id="note"></div>
                                    <div id="fields"> 
                                        <?php if(Yii::app()->user->hasFlash('contact')): ?>

                                    		<div class="l-system_message">
                                    			<?php echo Yii::app()->user->getFlash('contact'); ?>
                                    		</div>
                                    	
                                    	<?php endif; ?>
                                    		
                                    	<div class="l-form">
                                    		
                                    		<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                    		'id'=>'contact-form',
                                    		'enableClientValidation'=>false,
                                    			'clientOptions'=>array(
                                    			'validateOnSubmit'=>false,
                                    		),
                                    	)); 
                                    	?>
                                    		<div class="l-row">
                                    			<?php echo $form->textFieldControlGroup($model,'name'); ?>
                                    		</div>
                                    		
                                    		<div class="l-row">
                                    			<?php echo $form->emailFieldControlGroup($model,'email'); ?>
                                    		</div>
                                    		
                                    		<div class="l-row">
                                    			<?php echo $form->textFieldControlGroup($model,'subject'); ?>
                                    		</div>
                                    		
                                    		<div class="l-row">
                                    			<?php echo $form->textAreaControlGroup($model,'message'); ?>
                                    		</div>
                                    			
                                    		<?php $this->renderPartial('helper_view.parts._captcha', array('model'=>$model, 'form'=>$form, 'field'=>'verifyCode'));?>
                                    			
                                    		<div class = "g-clear_fix"></div>
                                    					
                                    		<?=Fields::submitBtn( Yii::t('main','Send'), BsHtml::GLYPHICON_ENVELOPE);?>
                                    	
                                    	<?php $this->endWidget(); ?>
                                    		
                                    	</div><!-- l-form --> 
                                    </div>
                                </div>                                
                            </div>
                        	
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="clear"></div>
<?=Helper::editLink(Yii::app()->createUrl('page/view/update', array('id'=>$content->id)));?>
