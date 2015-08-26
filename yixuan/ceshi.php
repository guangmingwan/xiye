<?php

define('_MYSQL_LOCALHOST', 'localhost'); // 数据库地址
define('_MYSQL_USER', 'root'); // 连接数据库的账号
define('_MYSQL_PASSWORD', '123123'); // 连接数据库的密码
define('_MYSQL_NAME', 'zhengsheng'); // 使用的库名

/*								
$var1 = 9;
$var2 = 7;

echo floor($var1 / $var2); //Returns 1
echo fmod($var1,$var2); //Returns the same
*/
/*$time =time();
$nowdate = date("Y-m-d");
$timestr="2013-07-05 23:00:00";
$timestr=substr($timestr,0,10);
echo ((strtotime($nowdate)-strtotime($timestr))/24/3600)."\n";*/



$db = getResource();

for ($i=13;$i<=18;$i++){
	$kj_name="第".$i."课";
	$kj="http://115.28.39.216:8080/zhengsheng/zp/test/一年级色彩课/第".$i."课.mp4";
	$kc_id="2";
	$zs_id=$i;
	
	
	$sql="INSERT INTO kj(kj_id, kj_name, kj, kc_id, zs_id) VALUES ('{$kj_id}','{$kj_name}','{$kj}','{$kc_id}','{$zs_id}')";
	$res=mysql_query($sql,$db);
}

for ($i=13;$i<=22;$i++){
	$kj_name="第".$i."课";
	$kj="http://115.28.39.216:8080/zhengsheng/zp/test/二年级造型课/第".$i."课.mp4";
	$kc_id="3";
	$zs_id=$i;
	
	
	$sql="INSERT INTO kj(kj_id, kj_name, kj, kc_id, zs_id) VALUES ('{$kj_id}','{$kj_name}','{$kj}','{$kc_id}','{$zs_id}')";
	$res=mysql_query($sql,$db);
}

for ($i=13;$i<=15;$i++){
	$kj_name="第".$i."课";
	$kj="http://115.28.39.216:8080/zhengsheng/zp/test/二年级色彩课/第".$i."课.mp4";
	$kc_id="4";
	$zs_id=$i;
	
	
	$sql="INSERT INTO kj(kj_id, kj_name, kj, kc_id, zs_id) VALUES ('{$kj_id}','{$kj_name}','{$kj}','{$kc_id}','{$zs_id}')";
	$res=mysql_query($sql,$db);
}



function getResource($db_name=_MYSQL_NAME)
{
	$db = mysql_connect(_MYSQL_LOCALHOST, _MYSQL_USER, _MYSQL_PASSWORD);
	if (!$db)
	{
		$contentStr="连接数据库失败";
		$msgType = "text";
		$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		echo $resultStr;
		exit;
	}
	mysql_select_db($db_name, $db);
	mysql_query("SET NAMES 'utf8';",$db);
	return $db;  
}

?>
