<?php
ini_set ('memory_limit', '512M');
include_once(dirname(__FILE__)."/config.php");
include_once(dirname(__FILE__)."/comm.php");
include_once(dirname(__FILE__)."/func.php");

date_default_timezone_set('Etc/GMT-8');
header("Content_Type: text/php;charset=utf-8");
$reply=array();
$reply["errcode"]="-1";
$reply["errmsg"]="功能号为空";

//$reply["errmsg"]=urlencode("功能号为空");

$base= json_encode($reply);
$base= urldecode($base);
//$base= iconv('UTF-8', 'gb2312', $base);

echo $base;

?>
