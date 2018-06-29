<?php 
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'):
	// Если на локалке
	$db = array(
		'connectionString' => 'mysql:host=localhost;dbname=carstereo',
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
		'connectionString' => 'mysql:host=localhost;dbname=thrsixr3_mjcarstereo;',
		'username' => 'thrsixr3_never',
		'password' => '111wardraft123',
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