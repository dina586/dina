<?php
$catalogs = Yii::app()->getModule('design')->catalog;
foreach ($catalogs as $i => $catalog) {
	$dataProvider = Design::model()->findAll(['order' => 'catalog_id, position', 'condition' => 'catalog_id=:catalog_id', 'params' => [':catalog_id' => $i]]);
	$n = $i + 1;
	?>
	<div class = "b-design_list j-design" style = "border-color: #<?=$this->border[$i] ?>">
		<div class = "b-design_list_header">
			<div class = "b-design_list_header_img">
				<img src = "/images/icons/graf_icon<?=$n; ?>.jpg" alt ="<?=$catalog ?>"/>
			</div>
			<a class = "j-design_link" href = "#" data-id = "<?=$n ?>"><?=$catalog; ?></a>
		</div>
		<div class = "g-clear_fix"></div>
		<?php if (count($dataProvider) > 0): ?>
		<ul>
			<?php foreach($dataProvider as $data) { ?>
				<li><?=$data->name; ?></li>
			<?php } ?>
		</ul>
		<?php endif; ?>

	</div>
	<?php
}
?>