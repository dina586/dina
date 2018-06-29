<?php echo $form->errorSummary($model); ?>
								
	<div class="l-row">
		<div class = "col-md-6">
			<?php echo $form->textFieldControlGroup($model,'firstname'); ?>
		</div>
	
		<div class = "col-md-6">
			<?php echo $form->textFieldControlGroup($model,'lastname'); ?>
		</div>
	</div>
	
	<div class = "g-clear_fix"></div>
				
	<div class="l-row">
		
		<div class = "col-md-6">
			<?php echo $form->textFieldControlGroup($model,'email'); ?>
		</div>
					
		<div class = "col-md-6">
			<?php echo $form->textFieldControlGroup($model,'phone', array('class'=>'j-mobile_field')); ?>
		</div>
	</div>
				
	<div class = "l-row">
		<div class="col-md-12">
			<?php echo $form->textFieldControlGroup($model,'address'); ?>
			<p class = "l-hint">Example: 1010 Beadnell Way Apt 1010</p>
		</div>
	</div>
				
	<div class="l-row">
		<div class = "col-md-6">
			<div class = "form-group">
				<?php echo $form->labelEx($model,'city'); ?>
				<div>
					<?php 
						$this->widget('CAutoComplete', array(
							'model'=>$model,
							'attribute'=>'city',
							'url'=>Yii::app()->createUrl('helper/default/autocomlete', array('model'=>'City', 'field'=>'city_name_en')),
							'htmlOptions'=>array('placeholder'=>Yii::t('user','City'), 'class'=>'form-control'),
						));
					?>
				</div>
				<?php echo $form->error($model, 'city');?>
			</div>
		</div>
					
		<div class = "col-md-6">
			<?php echo $form->dropDownListControlGroup(
				$model,
				'state',
				CHtml::listData(UsaStates::model()->findAll(array('order'=>'state_name')), 'state_abbreviation', 'state_name'),
				array('empty'=>Yii::t('user', 'Choose State'))
			);?>
		</div>
	</div>
				
	<div class="l-row">
		<div class = "col-md-6">
			<?php echo $form->textFieldControlGroup($model,'zip'); ?>
		</div>
			
		<div class = "col-md-6">
			<div class = "form-group">
				<?php echo $form->labelEx($model,'country'); ?>
				<div>
					<?php 
						$this->widget('CAutoComplete', array(
							'model'=>$model,
							'attribute'=>'country',
							'url'=>Yii::app()->createUrl('helper/default/autocomlete', array('model'=>'Country', 'field'=>'country_name_en')),
							'htmlOptions'=>array('placeholder'=>Yii::t('user','Country'), 'class'=>'form-control'),
						));
					?>
				</div>
				<?php echo $form->error($model, 'country');?>
			</div>
		</div>
	</div>