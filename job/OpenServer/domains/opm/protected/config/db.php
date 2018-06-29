<?php 
if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'):
	// Если на локалке
	$db = array(
		'connectionString' => 'mysql:host=localhost;dbname=opm',
		'emulatePrepare' => true,
		'enableProfiling'=>true,
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',
		'tablePrefix' => 'tbl_',
	);

else:
	// Если на сервере
	$db = array( 
		'connectionString' => 'mysql:host=localhost;dbname=xanalyti_opm;',
		'username' => 'xanalyti_root',
		'password' => 'erXJ{D11UHL0',
		'charset' => 'utf8',
		'tablePrefix' => 'tbl_',
		'emulatePrepare' => true,
	);
endif;

if(DEV_MODE != true) 
	$db['schemaCachingDuration'] = 36000;

return $db;

?>