<?php 
Yii::app()->clientScript->registerPackage('mask');
JS::add('mobilemask', '$(".j-mobile_field").mask("(999) 999-9999");');
?>

<div class = "b-shopping_cart">
	<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	
	<div class = "g-clear_fix"></div>
	
	<div class="table-responsive">
		<table class = "table table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Cost for month</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?=$model->name;?></td>
					<td class = "l-no-wrap">$ <?=Helper::viewPrice($model->price)?></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<?php $this->renderPartial('application.modules.user.widgets.views.registration', array('model'=>$order))?>
       
		
</div>
