<div id="main">
    <?php
    $this->pageTitle=Yii::app()->name . ' - Контакты';
    $this->breadcrumbs=array(
            'Контакты',
    );
    ?>
<div class = "l-page_title_wrap">
    <h1 class = "l-page_title">Контакты</h1>
</div>
    <?php if(Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

    <?php else: ?>

    <!--<p>
    If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>-->

    <div class="form">

    <?php $form=$this->beginWidget('CActiveForm'); ?>

            <p class="note">Поля с <span class="required">*</span> обяательные для заполнения.</p>

            <?php echo $form->errorSummary($model); ?>
            
            <div class="row form-group">
                <div class="row">
                        <?php echo $form->labelEx($model,'name'); ?>
                        <?php echo $form->textField($model,'name'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model,'email'); ?>
                </div>
            </div>
             <div class="row form-cent">
                <div class="row">
                        <?php echo $form->labelEx($model,'subject'); ?>
                        <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'body'); ?>
                        <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
                </div>

                <?php if(CCaptcha::checkRequirements()): ?>
                <div class="row div">
                        <?php echo $form->labelEx($model,'verifyCode'); ?>
                        <div>
                        <?php $this->widget('CCaptcha'); ?>
                        <?php echo $form->textField($model,'verifyCode'); ?>
                        </div>
                        <div class="hint">Пожалуйста, введите результат полученный из выражения.</div>
                </div>
                <?php endif; ?>

                <div class="row submit">
                        <?php echo CHtml::submitButton('Отправить'); ?>
                </div>
            </div>
    <?php $this->endWidget(); ?>

    </div><!-- form -->

    <?php endif; ?>
</div>