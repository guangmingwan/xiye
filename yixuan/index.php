<?php
error_reporting(0);
if(!isset($_SESSION)){
    session_start();
}

ini_set ('memory_limit', '512M');
//ini_set ('post_max_size', '150M');
//ini_set ('upload_max_filesize', '100M');
ini_set ('max_input_time', '1800');
ini_set ('max_execution_time', '1800');
include_once(dirname(__FILE__)."/config.php");
include_once(dirname(__FILE__)."/comm.php");
include_once(dirname(__FILE__)."/func.php");

//include_once(dirname(__FILE__).'/SinaEditor/sinaEditor.class.php');

date_default_timezone_set('Etc/GMT-8');
set_time_limit(0);
header("Access-Control-Allow-Origin:*");
//header("Connection: Keep-Alive");
//header("Proxy-Connection: Keep-Alive");
header("Content-type: text/html;charset=utf-8");
//header("From:zhengsheng");

$db = getResource();


$postStr =  file_get_contents("php://input");

$postStr = $postStr ? $postStr : $_SERVER["QUERY_STRING"] ;  


$filestr="";
$arr=array();
if ($postStr){
	$len=strlen($postStr);
	$pos=strpos($postStr,"cmd=");
	$filestr=substr($postStr,0,$pos);
	$cmdstr=substr($postStr,$pos,$len);
	$cmdstr=strstr($postStr,"cmd=");
	parse_str($cmdstr,$arr);
}
else{
	$arr=$_REQUEST;
}
//$arr=$_REQUEST;
//print_r($_FILES);


//---------------------------------------	
//only web begin
/*
if(isset($_SESSION)){
	if (isset($_SESSION['admin_username'])){
		$arr['admin_username']=$arr['admin_username'] ? $arr['admin_username'] : $_SESSION['admin_username'];
	}
	
	if (isset($_SESSION['admin_password'])){
		$arr['admin_password']=$arr['admin_password'] ? $arr['admin_password'] : $_SESSION['admin_password'];
	}

	if (isset($_SESSION['admin_id'])){
		$arr['admin_id']=$arr['admin_id'] ? $arr['admin_id'] : $_SESSION['admin_id'];
	}
	
	if (isset($_SESSION['admin_type'])){
		$arr['admin_type']=$arr['admin_type'] ? $arr['admin_type'] : $_SESSION['admin_type'];
	}
}
elseif (isset($_COOKIE)){
	if (isset($_COOKIE['admin_username'])){
		$arr['admin_username']=$arr['admin_username'] ? $arr['admin_username'] : $_COOKIE['admin_username'];
	}
	
	if (isset($_COOKIE['admin_password'])){
		$arr['admin_password']=$arr['admin_password'] ? $arr['admin_password'] : $_COOKIE['admin_password'];
	}
	
}*/

//---------------------------------------	

$reply=array();


if(isset($arr['cmd'])){
	
	$reply=main($db,$filestr,$arr);
}
else
{
	$reply["errcode"]="-1";
	$reply["errmsg"]=urlencode("功能号为空");
	//$reply["errmsg"]="功能号为空";
}

$base= json_encode($reply);
//$base= urldecode($base);

echo $base;

if (_Islog=="1"){
	$nowdate = date("Y-m-d H");
	$nowdatetime =date("Y-m-d H:i:s");
	$log= "time: ".$nowdatetime."\n\n";
	$log.="request: \n";
	//$log.=$postStr."\n";
	$log.=print_r($arr,true)."\n";
	if(!empty($_FILES)){
		$filestr = print_r($_FILES, true);
		$log.="file:\n".$filestr."\n";
	}

	
	$log.="reply: \n";
	$log.=$base."\n\n\n";
	
	$logdir = dirname(__FILE__)."/log";
	if (!is_dir($logdir))
	{
		mkdir($logdir);
	}

	$files = scandir($logdir);
	//$log.="del: \n";

	foreach ($files as $filename){
		$thisfile=$logdir.'/'.$filename;
		//$log.=$thisfile."\n";
		if(($thisfile!='.') && ($thisfile!='..') && ((time()-filemtime($thisfile)) >3600*24*7) ) {

			unlink($thisfile);//删除此次遍历到的文件

		}
	}

	$fp = fopen($logdir."/".$nowdate.".txt","a");
	fwrite($fp,$log."\n");
	fclose($fp);
}

?>
