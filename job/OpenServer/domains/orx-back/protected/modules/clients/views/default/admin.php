<?php
$this->seo('Управление');

$this->breadcrumbs=array(
	'Clients'=>array('index'),
	'Управление',
);?>

<h3 class = "admin_title"><?=$this->pageTitle;?></h3>

	<?php 
	echo CHtml::ajaxLink('Получить список клиентов', Yii::app()->createUrl('clients/default/export'),
		array(
			'beforeSend'=> "js:function() {
				$('#j-success_message').html('Пожалуйста, подождите... <br/> <img src = \"/images/page_preloader.gif\" />');
			}",
			'success'=>"js:function(data){
				$('#j-success_message').html(data);
				$('.j-exel_links').show();
			}"
		)
	);?>
<br/><br/>

<?php 
	$style = 'display:none;';
	if(Yii::app()->cFile->set(Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS.'clients.xlsx')->exists)
		$style = ''
?>
<div class="j-exel_links" style = "<?=$style;?>">
	<a href = "/upload/temp/clients.xlsx" class = "j-exel_link">Скачать файл</a><br/><br/>
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
</div>

<div id = "j-success_message"></div>

<br/><hr/><br/>

<p class = "hint">
Вы можете использовать (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) перез значениями фильтров (например, найти все номера, которые больше пяти: &gt;5).
</p>


<?php 
$pageSize=Yii::app()->user->getState('pageSize', 10);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'clients-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'email',
		'name',
		'address',
		'contacts',
 		array(
 			'type'=>'raw',
 			'header'=>'Покупки',
 			'value'=>'$data->adminSearchOrder($data)'
 		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10, 20=>20, 30=>30, 50=>50, 100=>100, 200=>200, 300=>300),array(
				'onchange'=>"$.fn.yiiGridView.update('clients-grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
