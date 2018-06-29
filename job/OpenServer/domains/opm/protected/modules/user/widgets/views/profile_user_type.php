<?php
$lastGroup = 0;
$i = 0;
foreach($groups as $group){ 
	if($i%4 == 0 && $i != 0 && $i != count($groups))
		echo '<div class = "g-clear_fix"></div><hr/>';
	echo '<div class = "col-md-3">';
		echo '<h3>'.$group->name.'</h3>';
		$dataProvider = UserRegType::model()->findAll('group_id=:group_id', array(':group_id'=>$group->id));
		if(count($dataProvider)>0)
			foreach($dataProvider as $data) {
				echo '<div class = "l-row checkbox">';
					if(in_array($data->id, $checked))
						$c = true;
					else
						$c = false;
						echo BsHtml::checkBox('UserType['.$data->id.']', $c, array('label'=>$data->name));
				echo '</div>';
			}
	echo '</div>';
	$i++;
}
