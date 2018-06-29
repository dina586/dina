<?php $term = CHtml::encode($term);
	$this->seo('Резулаты поиска для '. $term);
?>
<div class = "b-search_results">
<h1 class = "l-page_title">Результаты поиска для: "<b><?php echo $term; ?></b>"</h1>
<section class = "b-main_search">
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'search-form',
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>
	
	<?php echo $form->textFieldControlGroup($search,'term', array('class'=>'search_field')); ?>
	
	<?=Fields::submitBtn( Yii::t('main','Найти'), BsHtml::GLYPHICON_SEARCH);?>
	
	<div class = "g-clear_fix"></div>
		
	<?php $this->endWidget(); ?>
</section>

<?php 
if(strlen($term)> 3):
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->userSearch(),
	'htmlOptions'=>array('class'=>'grid-view b-search_grid'),
	'columns'=>array(
		array(
			'name' => 'image',
			'type' => 'raw',
			'filter' => '',
			'value' => 'Helper::getCover($data->id, get_class($data), Yii::app()->createUrl("store/product/view", array("url"=>$data->url)), "thumbnail")',
			'htmlOptions'=>array('class'=>'l-align_center l-grid_cover_column'),
			'header'=>Yii::t('main', 'Image'),
		),
		array(
			'name'=>'name',
			'value'=>'"<a href = \"".Yii::app()->createUrl("store/product/view", array("url"=>$data->url))."\">".$data->name."</a>"',
			'type'=>'raw',		
		),
		array(
			'name'=>'articul',
			'value'=>'$data->articul',
			'htmlOptions'=>array('class'=>'l-align_center l-nowrap', 'style'=>'width:100px;'),
		),
		array(
			'name'=>'price',
			'value'=>'StoreHelper::viewPrice($data->price)',
			'htmlOptions'=>array('class'=>'l-align_center l-nowrap', 'style'=>'width:100px;'),
		),
	),
));
else: ?>
	<p class="error">Запрос должен состоять минимум из 3-х символов</p>
<?php endif; ?>


