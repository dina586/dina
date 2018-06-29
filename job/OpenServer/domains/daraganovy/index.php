<?php
defined('DEV_MODE') or define('DEV_MODE', true);
$yiiPath = dirname(__FILE__) . '/../framework/';

if (DEV_MODE === true):
    error_reporting(E_ALL);
    $yii = $yiiPath . 'yii.php';
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
else:
    $yii = $yiiPath . 'yiilite.php';
endif;

$config = dirname(__FILE__) . '/protected/config/main.php';
$WebApp = dirname(__FILE__) . '/protected/components/WebApp.php';

require_once($yii);
require_once($WebApp);
Yii::createApplication('WebApp', $config)->run();
