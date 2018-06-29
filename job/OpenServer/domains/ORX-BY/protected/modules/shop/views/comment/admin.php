<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('comment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Управление комментариями</h3>
<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'product_id',
			'type' => 'raw',
			'filter' => CHtml::listData(Product::model()->findAll(), 'id', 'name'),
			'value' => '$data->adminSearchProduct($data->product->id, $data->product->name)',
		),
		'comment',
		'create_time',
		array(
			'name'=> 'is_new',
			'filter'=> array('1'=>'Новый', '0' => 'Утвержден'),
			'type' => 'raw',
			'value'=>'$data->adminSearchIsNew($data->id, $data->is_new)',
		),
		'star',
		'user_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<script type = "text/javascript">
	$(document).ready(function() {
		$('.b-admin .comment_status').live('click', function(){
			var index = $('.b-admin .comment_status').index(this);
			var url = $(this).attr("href");
			var text = $(this).text();
			if(text == 'Новый') {
				var returnText = 'Утвержден';
			} else {
				var returnText = 'Новый';
			}
			var c = '';
			$.ajax({
				url: url,
				success: function(data){
					$('.b-admin .comment_status').eq(index).attr("href", data);
				}
			})
			$(this).text(returnText);
			return false;
		})
	})
</script>
