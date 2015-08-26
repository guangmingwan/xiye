<?php

define('_MYSQL_LOCALHOST', 'localhost'); // 数据库地址
define('_MYSQL_USER', 'root'); // 连接数据库的账号
define('_MYSQL_PASSWORD', '123123'); // 连接数据库的密码
define('_MYSQL_NAME', 'gtjazj'); // 使用的库名

define('_Host', 'http://115.28.214.155:80/gtjazj/'); // 网络地址

define('_File', dirname(__FILE__)."/"); // 实际地址
define('_Upload_File', 'uploadfile'); // 上传文件保存路径

define('_key', 'gtjazj'); // key

//define your token
define("TOKEN", "gtjazj");

//textreply
define("TEXTTPL","<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>0</FuncFlag>
</xml>");

//musicreply
define("MUSICTPL","<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Music>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<MusicUrl><![CDATA[%s]]></MusicUrl>
<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>
<FuncFlag>0</FuncFlag>
</xml>");

define("MUSICTPLNEW","<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Music>
<MusicUrl><![CDATA[%s]]></MusicUrl>
<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>
<FuncFlag>0</FuncFlag>
</xml>");

//Articlereply
define("ARTICLETPL","<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
%s
</Articles>
<FuncFlag>1</FuncFlag>
</xml>");

//ArticleItem
define("ARTICLEITEM","<item>
<Title><![CDATA[%s]]></Title> 
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>");

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
