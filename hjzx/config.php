<?php

define('_MYSQL_LOCALHOST', 'localhost'); // 数据库地址
define('_MYSQL_USER', 'root'); // 连接数据库的账号
define('_MYSQL_PASSWORD', '123123'); // 连接数据库的密码
define('_MYSQL_NAME', 'hjzx'); // 使用的库名

define('_Host', 'http://120.27.97.213:8080/hjzx/'); // 网络地址

define('_File', dirname(__FILE__)."/"); // 实际地址
define('_Upload_File', 'uploadfile'); // 上传文件保存路径

define('_key', 'hjzx'); // key

define('_showlist', '1/姓名/user_name|0/性别/user_sex|0/年龄/user_age|1/省份/user_prov|1/城市/user_city|1/电话号码/user_phone|0/个人年收入/user_pre_income|0/家庭年收入/user_fam_income|0/婚姻状态/user_is_marry|0/报名时间/user_regtime|0/针对项目字段1/zdxmzd1|0/针对项目字段2/zdxmzd2|0/针对项目字段3/zdxmzd3|0/针对项目字段4/zdxmzd4|0/针对项目字段5/zdxmzd5'); 

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
