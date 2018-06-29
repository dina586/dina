
<span class = "label label-success label-form"><?=$model->start_date?></span>
- 
<span class = "label label-success label-form"><?=$model->end_date?></span>
<br/><br/>
<p><?=$model->content;?></p>
<?php if($model->user_name != '') {?>
<p><?=$model->user_name;?></p>
<?php } ?>
<?php if($model->model_name == 'UserService') {?>
	<p><b>Phone:</b> <?=$model->user->profile->mobile;?></p>
	<p><b>Email:</b> <a href = "mailto:<?=$model->user->email;?>"><?=$model->user->email;?></a></p>
<?php } ?>
