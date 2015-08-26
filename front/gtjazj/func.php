<?php

function main($db,$filestr,$arr)
{
	$info=array();
	$info["errcode"]="-1";
	
	$nowdate = date("Y-m-d");
	$nowdatenum = date("Ymd");
	$nowdatetime =date("Y-m-d H:i:s");
	$time =time();
	
	if($arr['cmd']=='get_check_code'){
		$img_height=80;
		$img_width=30;
		
		$nmsg="";
		for($Tmpa=0;$Tmpa<4;$Tmpa++)
		{
			$nmsg.=dechex(rand(0,15)); // 生成随机数，并转成十六进制
		}
		$_SESSION["check_code"] = $nmsg;
		$aimg = imageCreate($img_height,$img_width); //生成图片
		ImageColorAllocate($aimg, 255,255,255); //图片底色，ImageColorAllocate第1次定义颜色PHP就认为是底色了
		$black = ImageColorAllocate($aimg, 0,0,0); //定义需要的黑色
		ImageRectangle($aimg,0,0,$img_height-1,$img_width-1,$black);//先成一黑色的矩形把图片包围
		//下面该生成雪花背景了，其实就是在图片上生成一些符号
		for ($i=1; $i<=100; $i++)//先用100个做测试
		{
			imageString($aimg,1,mt_rand(1,$img_height),mt_rand(1,$img_width),"*",imageColorAllocate($aimg,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255)));
			//就是生成＊号而已。为了使它们看起来"杂乱无章、5颜6色"，就得在1个1个生成它们的时候，让它们的位置、颜色，甚至大小都用随机数，rand()或mt_rand都可以完成。
		}
		//上面生成了背景，现在就该把已经生成的随机数放上来了。道理和上面差不多，随机数1个1个地放，同时让他们的位置、大小、颜色都用成随机数~~
		//为了区别于背景，这里的颜色不超过200，上面的不小于200
		for ($i=0;$i<strlen($_SESSION["check_code"]);$i++)
		{
			imageString($aimg, mt_rand(8,10),$i*$img_height/4+mt_rand(1,10),mt_rand(1,$img_width/4), $_SESSION["check_code"][$i],imageColorAllocate($aimg,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200)));
		}
		Header("Content-type: image/png"); //告诉浏览器，下面的数据是图片，而不要按文字显示
		ImagePng($aimg); //生成png格式
		ImageDestroy($aimg);
		
		exit;

	}
	elseif($arr['cmd']=='querylist'){
		$get_event_key=isset($arr['get_event_key']) ? trim($arr['get_event_key']) : '';
		$action_id=isset($arr['action_id']) ? trim($arr['action_id']) : '';
		$get_type_id=isset($arr['get_type_id']) ? trim($arr['get_type_id']) : '';
		$reply_title=isset($arr['reply_title']) ? trim($arr['reply_title']) : '';
		$reply_description=isset($arr['reply_description']) ? trim($arr['reply_description']) : '';
		$begin_date=isset($arr['begin_date']) ? trim($arr['begin_date']) : '';
		$end_date=isset($arr['end_date']) ? trim($arr['end_date']) : '';
		
		$sql="";
		if ($get_event_key!='')
		{
			$sql.=" and a.get_event_key='{$get_event_key}'";
		}
		if ($action_id!='')
		{
			$sql.=" and a.action_id='{$action_id}'";
		}
		if ($get_type_id!='')
		{
			$sql.=" and a.get_type_id='{$get_type_id}'";
		}
		if ($reply_title!='')
		{
			$sql.=" and a.reply_title='%{$reply_title}%'";
		}
		if ($reply_description!='')
		{
			$sql.=" and a.reply_description like '%{$reply_description}%'";
		}
		if ($begin_date!='')
		{
			$sql.=" and a.reply_date>='{$begin_date}'";
		}
		if ($end_date!='')
		{
			$sql.=" and a.reply_date<='{$end_date}'";
		}
		
		$sql="SELECT a.*,b.get_type_name FROM action a left join get_type b on a.get_type_id=b.get_type_id where 1=1 ".$sql." order by a.reply_date desc";
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["action_id"]=$row["action_id"];
			$info["data"][$i]["get_msgtype_id"]=rawurlencode($row["get_msgtype_id"]);
			$info["data"][$i]["get_event"]=rawurlencode($row["get_event"]);
			$info["data"][$i]["get_event_key"]=rawurlencode($row["get_event_key"]);
			$info["data"][$i]["get_type_id"]=rawurlencode($row["get_type_id"]);
			$info["data"][$i]["get_type_name"]=rawurlencode($row["get_type_name"]);
			$info["data"][$i]["reply_msgtype_id"]=rawurlencode($row["reply_msgtype_id"]);
			$info["data"][$i]["reply_list"]=rawurlencode($row["reply_list"]);
			$info["data"][$i]["reply_title"]=rawurlencode($row["reply_title"]);
			$info["data"][$i]["reply_description"]=rawurlencode($row["reply_description"]);
			$info["data"][$i]["reply_picurl"]=rawurlencode($row["reply_picurl"]);
			$info["data"][$i]["reply_url"]=rawurlencode($row["reply_url"]);
			$info["data"][$i]["reply_date"]=rawurlencode($row["reply_date"]);

			$i=$i+1;
		}
		$info["errcode"]="0";
		
	}
	elseif($arr['cmd']=='queryuserinfo'){
		$user_wx_bs=isset($arr['user_wx_bs']) ? trim($arr['user_wx_bs']) : '';
		
		$sql="";
		if ($user_wx_bs!='')
		{
			$sql.=" and user_wx_bs='{$user_wx_bs}'";
		}
		else{
			$info["errmsg"]=rawurlencode("用户标识不能为空");
			return $info;
		}
		
		$sql="SELECT * FROM userinfo where 1=1 ".$sql;
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["user_id"]=$row["user_id"];
			$info["data"][$i]["user_name"]=rawurlencode($row["user_name"]);

			$i=$i+1;
		}
		$info["errcode"]="0";
		
	}
	elseif($arr['cmd']=='query_get_type'){
		$get_type_id=isset($arr['get_type_id']) ? trim($arr['get_type_id']) : '';
		
		$sql="";
		if ($get_type_id!='')
		{
			$sql.=" and get_type_id='{$get_type_id}'";
		}
		
		$sql="SELECT * FROM get_type where 1=1 ".$sql;
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["get_type_id"]=$row["get_type_id"];
			$info["data"][$i]["get_type_name"]=rawurlencode($row["get_type_name"]);

			$i=$i+1;
		}
		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='query_maxid'){
				
		$sql="SELECT max(action_id) as max_action_id FROM action where 1=1 ";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$info["max_action_id"]=isset($row["max_action_id"])? $row["max_action_id"]: "0";
		
		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='add_action'){
		$action_id=isset($arr['action_id']) ? trim($arr['action_id']) : '';	
		$get_type_id=isset($arr['get_type_id']) ? trim($arr['get_type_id']) : '';
		$reply_msgtype_id=isset($arr['reply_msgtype_id']) ? trim($arr['reply_msgtype_id']) : '';
		$get_msgtype_id=isset($arr['get_msgtype_id']) ? trim($arr['get_msgtype_id']) : '';
		$reply_date=isset($arr['reply_date']) ? trim($arr['reply_date']) : '';
		$get_event_key=isset($arr['get_event_key']) ? trim($arr['get_event_key']) : '';
		$get_event=isset($arr['get_event']) ? trim($arr['get_event']) : '';
		$reply_title=isset($arr['reply_title']) ? trim($arr['reply_title']) : '';
		$reply_url=isset($arr['reply_url']) ? trim($arr['reply_url']) : '';
		$reply_url=urldecode($reply_url);
		$reply_description=isset($arr['reply_description']) ? trim($arr['reply_description']) : '';
		$reply_list=isset($arr['reply_list']) ? trim($arr['reply_list']) : '';
		if($action_id==''){
			$info["errmsg"]=rawurlencode('编号不能为空');
			return $info;
		}
		
		$result=upload2(_Upload_File,"action",$_FILES["action_pic_upload"],"action_".$action_id);
		if($result["retcode"]=="-1"){
			$info["errmsg"]=$result["retmsg"];
			return $info;
		}
		$url=$result["url"] ? $result["url"] : "";
				
		$sql="SELECT * FROM action where action_id='{$action_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_action_id=isset($row["action_id"])? $row["action_id"]: "";
		if($db_action_id!=""){
			$sql="";
			if($url!=""){
				$sql=",reply_picurl='{$url}'";
			}
			$sql="update action set get_type_id='{$get_type_id}',reply_msgtype_id='{$reply_msgtype_id}',get_msgtype_id='{$get_msgtype_id}',reply_date='{$reply_date}',get_event_key='{$get_event_key}',get_event='{$get_event}',reply_title='{$reply_title}',reply_url='{$reply_url}',reply_description='{$reply_description}',reply_list='{$reply_list}'".$sql." where action_id='{$action_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('微信功能更新成功');
			}else{
				$info["errmsg"]=rawurlencode('微信功能更新失败');
			}
		
		}
		else{
			$sql="INSERT INTO action(action_id,get_type_id,reply_msgtype_id,get_msgtype_id,reply_date,get_event_key,get_event,reply_title,reply_url,reply_description,reply_list,reply_picurl)VALUES('{$action_id}','{$get_type_id}','{$reply_msgtype_id}','{$get_msgtype_id}','{$reply_date}','{$get_event_key}','{$get_event}','{$reply_title}','{$reply_url}','{$reply_description}','{$reply_list}','{$url}')";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('微信功能添加成功');
			}else{
				$info["errmsg"]=rawurlencode('微信功能添加失败');
			}
		}
	}
	elseif ($arr['cmd']=='del_action'){
		$action_id=isset($arr['action_id']) ? trim($arr['action_id']) : '';		
	
		if($action_id==''){
			$info["errmsg"]=rawurlencode('编号不能为空');
			return $info;
		    
		}
		
		$sql="SELECT * FROM action where action_id='{$action_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_action_id=isset($row["action_id"])? $row["action_id"]: "";
		if($db_action_id!=""){
			$sql="delete from  action  where action_id='{$action_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('微信功能删除成功');
			}else{
				$info["errmsg"]=rawurlencode('微信功能删除失败');
			}
		
		}
		else{
			$info["errmsg"]=rawurlencode('该微信功能不存在');
		}

	}
	elseif($arr['cmd']=='query_user_record'){
		$custid=isset($arr['custid']) ? trim($arr['custid']) : '';
		$get_type_id=isset($arr['get_type_id']) ? trim($arr['get_type_id']) : '';
		$user_name=isset($arr['user_name']) ? trim($arr['user_name']) : '';
		$brhid=isset($arr['brhid']) ? trim($arr['brhid']) : '';
		$begin_date=isset($arr['begin_date']) ? trim($arr['begin_date']) : '';
		$end_date=isset($arr['end_date']) ? trim($arr['end_date']) : '';
		
		$sql="";
		if ($custid!='')
		{
			$sql.=" and a.custid='{$custid}'";
		}
		if ($get_type_id!='')
		{
			$sql.=" and b.get_type_id='{$get_type_id}'";
		}
		if ($user_name!='')
		{
			$sql.=" and a.user_name like '%{$user_name}%'";
		}
		if ($brhid!='')
		{
			$sql.=" and a.brhid='{$brhid}'";
		}
		if ($begin_date!='')
		{
			$sql.=" and b.last_time>='{$begin_date} 00:00:00'";
		}
		if ($end_date!='')
		{
			$sql.=" and b.last_time<='{$end_date} 23:59:59'";
		}
		
		$sql="SELECT b.*,a.custid,a.brhid,a.user_name FROM userinfo a ,user_record b where a.user_wx_bs=b.user_wx_bs ".$sql." order by b.last_time desc";
		$info["sql"]=$sql;
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["user_record_id"]=$row["user_record_id"];
			$info["data"][$i]["get_type_name"]=rawurlencode($row["get_type_name"]);
			$info["data"][$i]["get_event_key"]=rawurlencode($row["get_event_key"]);
			$info["data"][$i]["get_type_id"]=rawurlencode($row["get_type_id"]);
			$info["data"][$i]["get_content"]=rawurlencode($row["get_content"]);
			$info["data"][$i]["last_time"]=rawurlencode($row["last_time"]);
			$info["data"][$i]["count"]=rawurlencode($row["count"]);
			$info["data"][$i]["custid"]=rawurlencode($row["custid"]);
			$info["data"][$i]["brhid"]=rawurlencode($row["brhid"]);
			$info["data"][$i]["user_name"]=rawurlencode($row["user_name"]);

			$i=$i+1;
		}
		$info["errcode"]="0";
		
	}
	else
	{
		$info["errmsg"]=rawurlencode("该功能暂不支持");
	}
	return $info;
}


?>