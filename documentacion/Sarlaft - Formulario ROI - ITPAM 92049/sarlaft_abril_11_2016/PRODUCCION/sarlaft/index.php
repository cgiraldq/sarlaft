<?php 
//error_reporting(E_ALL ^ E_ERROR ^ E_WARNING ^ E_PARSE ^ E_NOTICE 
//^ E_STRICT ^ E_DEPRECATED); //(^)excluye; (|)incluye
//(^)excluye; (|)incluye
error_reporting(E_ERROR); 
// change the following paths if necessary
$yii=dirname(__FILE__).'../../yii/1_1_16/yii.php';
// $yii=dirname(__FILE__).'/fw/framework/yii.php';
$constant=dirname(__FILE__).'/protected/config/constant.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii); 
require_once($constant); 
Yii::createWebApplication($config)->run(); 