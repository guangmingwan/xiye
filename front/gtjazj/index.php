<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE );
if(!isset($_SESSION)){
    session_start();
    set_time_limit(30);
}

ini_set ('memory_limit', '512M');
include_once(dirname(__FILE__)."/config.php");
include_once(dirname(__FILE__)."/comm.php");
include_once(dirname(__FILE__)."/func.php");

//include_once(dirname(__FILE__).'/SinaEditor/sinaEditor.class.php');

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Etc/GMT-8');
header("Content-type: text/html;charset=utf-8");

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
	//$cmdstr=strstr($postStr,"cmd=");
	parse_str($cmdstr,$arr);
}
else{
	$arr=$_REQUEST;
}


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
	$log.=$postStr."\n";
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
	$log.="del: \n";

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
