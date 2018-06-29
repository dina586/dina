<?php 
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'):
	// Если на локалке
	$db = array(
		'connectionString' => 'mysql:host=localhost;dbname=farmstay',
		'emulatePrepare' => true,
		'enableProfiling'=>true,
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',
		'tablePrefix' => 'tbl_',
	);

else:
	// Если на сервере
	return array( 
		'connectionString' => 'mysql:host=localhost;dbname=user1173540_crm',
		'username' => 'dvn_root',
		'password' => 'dvnroot123',
		'charset' => 'utf8',
		'tablePrefix' => 'tbl_',
		'schemaCachingDuration' => 3600,
		'emulatePrepare' => true,
	);
endif;

if(DEV_MODE != true) 
	$db['schemaCachingDuration'] = 36000;

return $db;

?>