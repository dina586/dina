<h1><?=Yii::t('main', 'Error').' - '.$code?></h1>
<img src = "<?=Yii::app()->baseUrl?>/images/system/errors/404.jpg" alt = "<?=Yii::t('main', 'Error').' - '.$code?>"/>
<br/>
<a href = "<?=Yii::app()->user->returnUrl;?>"><?=Yii::t('main', 'Return To Site');?></a>