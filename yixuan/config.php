<?php

define('_MYSQL_LOCALHOST', 'localhost'); // 数据库地址
define('_MYSQL_USER', 'root'); // 连接数据库的账号
define('_MYSQL_PASSWORD', '123123'); // 连接数据库的密码
define('_MYSQL_NAME', 'zhengsheng'); // 使用的库名

define('_Host', 'http://120.27.97.213:8080/yixuan/'); // 网络地址
define('_Form_file', 'http://120.27.97.213/form_file.html'); // 网络地址

define('_File', dirname(__FILE__)."/"); // 实际地址
define('_Upload_File', 'uploadfile2'); // 作品保存路径

define('_Islog', '1'); // 日志开启

function getResource($db_name=_MYSQL_NAME)
{
	$db = mysql_connect(_MYSQL_LOCALHOST, _MYSQL_USER, _MYSQL_PASSWORD);
	if (!$db)
	{
		$reply=array();
		$reply["errcode"]="-1";
		$reply["errmsg"]=urlencode("连接数据库失败");
		$base= json_encode($reply);
		$base= urldecode($base);
		echo $base;
		
		
		exit;
	}
	mysql_select_db($db_name, $db);
	mysql_query("SET NAMES 'utf8';",$db);
	return $db;
}



?>
