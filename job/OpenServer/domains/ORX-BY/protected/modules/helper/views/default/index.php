<h3>Работа с товаром</h3>
<p><b>Структура эксель файла:</b></p>
<p>A - Артикул;</p>
<p>B - Каталог;</p>
<p>C - Наименование;</p>
<p>D - Цена;</p>
<br/><br/>

<?php 
	$this->widget('ext.EAjaxUpload.EAjaxUpload',
	array(
		'id'=>'uploadFile',
		'config'=>array(
			'action'=>Yii::app()->createUrl('helper/default/upload'),
			'multiple'=> true,
			'debug' => true,
			'allowedExtensions'=>array("xls"),
			'sizeLimit'=>9*1024*1024,// maximum file size in bytes
			'minSizeLimit'=>1*1024,// minimum file size in bytes
			'onComplete'=>"js:function(id, fileName, responseJSON){
				$('#j-success_message').text('Загрузка прайса завершена успешно!');
				$('.j-exel_links').show();
			}",
			'messages'=>array(
				'typeError'=>"{file} имеет недопустимое расширение. Только расширения {extensions} разрешены.",
				'sizeError'=>"{file} слишком большой. Максимальный размер {sizeLimit}.",
				'minSizeError'=>"{file} слишком маленький. Минимальный размер {minSizeLimit}.",
				'emptyError'=>"{file} пуст. Пожалуйста, повторите попытку",
				'onLeave'=>"Файлы загружаются, если Вы уйдете сейчас, то загрузка будет прекращена"
			),
			'showMessage'=>'js:function(message){$("#j-error_message").text(message)  }'
		)
));

?>
<?php 
	$style = 'display:none;';
	if(Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.'catalog.xls')->exists)
		$style = ''
?>
<div class="form j-exel_links" style = "<?=$style;?>">
	
	<div class="row checkbox">
		<?php echo CHtml::checkBox('files', true, array('id'=>'files')); ?>
		<?php echo CHtml::label('Требуется загрузка файлов', 'files') ?>
	</div>
	<div class = "g-clear_fix"></div>
	
	<div class="row checkbox">
		<?php echo CHtml::checkBox('old', false, array('id'=>'old')); ?>
		<?php echo CHtml::label('Удалить старые записи из базы', 'old') ?>
	</div>
	<div class = "g-clear_fix"></div>
	
	<br/>
	<a href = "<?=Yii::app()->createUrl('helper/default/chagePrice')?>" class = "j-exel_link">Добавить данные из файла в базу</a><br/><br/>
	<hr/>
	<?php 
	echo CHtml::ajaxLink('Удалить файл', Yii::app()->createUrl('site/clear'),
		array(
			'success'=>"js:function(data){
				$('#j-success_message').html('Файл удален');
				$('.j-exel_links').hide();
			}",
			'error'=>"js:function(data){
				$('#j-success_message').html(data);
			}"
		)
	);?>
	
	<br/>
</div>

<hr/>
	<?php 
	echo CHtml::ajaxLink('Получить список позиций без картинок', Yii::app()->createUrl('helper/default/getEmpty'),
		array(
			'success'=>"js:function(data){
				$('#j-success_message').html(data);
			}"
		)
	);?>
<br/>
<hr/>
<?php 
	echo CHtml::ajaxLink('Пересоздать миниатюры', Yii::app()->createUrl('helper/default/mini'),
		array(
			'beforeSend'=> "js:function() {
				$('#j-success_message').html('Пожалуйста, подождите... <br/> <img src = \"/images/page_preloader.gif\" />');
			}",
			'success'=>"js:function(data){
				$('#j-success_message').html('Миниатюры были изменены');
			}",
			'error'=>"js:function(data){
				$('#j-success_message').html(data);
			}"
		)
	);?>
<br/>
<hr/>

<?php 
	echo CHtml::ajaxLink('Удалить из базы все позиции без картинок', Yii::app()->createUrl('helper/default/clear'),
		array(
			'beforeSend'=> "js:function() {
				$('#j-success_message').html('Пожалуйста, подождите... <br/> <img src = \"/images/page_preloader.gif\" />');
			}",
			'success'=>"js:function(data){
				$('#j-success_message').html('Позиции были удалены');
			}",
			'error'=>"js:function(data){
				$('#j-success_message').html(data);
			}"
		)
	);?>
<br/>
<hr/>
<?php 
	echo CHtml::ajaxLink('Нанести водяные знаки на изображения', Yii::app()->createUrl('helper/default/write'),
		array(
			'beforeSend'=> "js:function() {
				$('#j-success_message').html('Пожалуйста, подождите... <br/> <img src = \"/images/page_preloader.gif\" />');
			}",
			'success'=>"js:function(data, fileName, responseJSON){
				$('#j-success_message').html(data);
			}",
			'error'=>"js:function(data){
				$('#j-success_message').html(data);
			}"
		)
	);?>

<hr/>
<p class = "hint">Загрузить водяной знак</p> <br/>
<?php 
	$this->widget('ext.EAjaxUpload.EAjaxUpload',
	array(
		'id'=>'uploadWatermark',
		'config'=>array(
			'action'=>Yii::app()->createUrl('helper/default/uploadWatermark'),
			'multiple'=> false,
			'debug' => true,
			'allowedExtensions'=>array("png"),
			'sizeLimit'=>2*1024*1024,// maximum file size in bytes
			'minSizeLimit'=>1*1024,// minimum file size in bytes
			'success'=>"js:function(id, fileName, responseJSON){
				$('#j-success_message').text('Изображение успешно загружено');
				$('.j-images').show();
			}",
			'messages'=>array(
				'typeError'=>"{file} имеет недопустимое расширение. Только расширения {extensions} разрешены.",
				'sizeError'=>"{file} слишком большой. Максимальный размер {sizeLimit}.",
				'minSizeError'=>"{file} слишком маленький. Минимальный размер {minSizeLimit}.",
				'emptyError'=>"{file} пуст. Пожалуйста, повторите попытку",
				'onLeave'=>"Файлы загружаются, если Вы уйдете сейчас, то загрузка будет прекращена"
			),
			'error'=>"js:function(data){
				$('#j-success_message').html(data);
			}",
			'onComplete'=>"js:function(data, fileName, responseJSON){
				$('#j-success_message').html('Водяной знак был загружен');
				$('.j-images').html('<img src = \"/images/watermark.png?'+responseJSON.random+'\" />').show();
			}",
			'showMessage'=>'js:function(message){$("#j-error_message").text(message)  }'
		)
));
?>
<?php 
	$style = 'display:none;';
	if(Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').DS.'images'.DS.'watermark.png')->exists)
		$style = ''
?>
<div class="j-images" style = "<?=$style;?>">
	<img src = "/images/watermark.png" alt = "Водяной знак"/>
</div>
<br/><br/>
<?php 
	echo CHtml::ajaxLink('Протестировать водяной знак', Yii::app()->createUrl('helper/default/watermarkTest'),
		array(
			'beforeSend'=> "js:function() {
				$('#j-success_message').html('Пожалуйста, подождите... <br/> <img src = \"/images/page_preloader.gif\" />');
			}",
			'success'=>"js:function(data){
				$('#j-success_message').html(data);
			}",
			'error'=>"js:function(data){
				$('#j-success_message').html(data);
			}"
		)
	);?>
<br/><hr/><br/>

<div id = "j-success_message"></div>