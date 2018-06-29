<h4>About service</h4>
<p>
	Service length: <b><?=$procedure->procedure_length; ?> minutes</b>
</p>
<p><?=$model->description ?></p>
<a href="<?=Yii::app()->createUrl('service/view/view', ['url' => $model->url]) ?>" class="btn" target = "_blank">View service details</a>
