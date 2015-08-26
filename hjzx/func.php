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
	elseif ($arr['cmd']=='queryadmininfo'){
	
		$info["errcode"]="0";
		$info["admin_name"]=isset($_SESSION['admin_name']) ? trim($_SESSION['admin_name']) : '';
		$info["admin_id"]=isset($_SESSION['admin_id']) ? trim($_SESSION['admin_id']) : '';
		$info["admin_type_id"]=isset($_SESSION['admin_type_id']) ? trim($_SESSION['admin_type_id']) : '';
		$info["check"]=isset($_SESSION['check']) ? trim($_SESSION['check']) : '0';
		
	}
	elseif($arr['cmd']=='adminlogin'){
		$admin_name=isset($arr['admin_name']) ? trim($arr['admin_name']) : '';
		$admin_pwd=isset($arr['admin_pwd']) ?trim($arr['admin_pwd']): '';
		$admin_remenber=isset($arr['admin_remenber']) ?trim($arr['admin_remenber']): '0';
		$admin_autologin=isset($arr['admin_autologin']) ?trim($arr['admin_autologin']): '0';
		if($admin_name==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($admin_pwd==''){
			$info["errmsg"]=rawurlencode('密码不能为空');
			return $info;
		    
		}
		$admin_pwd=base64_decode($admin_pwd);
		$encrypt_password=$admin_pwd;
	
		$sql="SELECT * FROM admin WHERE admin_name='{$admin_name}' and admin_pwd='{$encrypt_password}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_admin_id=isset($row['admin_id']) ? $row['admin_id'] : "";
		$db_admin_type_id=isset($row['admin_type_id']) ? $row['admin_type_id'] : "";
		if($db_admin_id){
			
			$info["admin_id"]=rawurlencode($db_admin_id);
			$info["admin_type_id"]=rawurlencode($db_admin_type_id);
			$_SESSION['admin_name']=$admin_name;
			$_SESSION['admin_id']=$db_admin_id;
			$_SESSION['admin_type_id']=$db_admin_type_id;

			if($admin_remenber==1)
			{
				setcookie("admin_name", $admin_name, time()+30*24*3600);
				setcookie("admin_remenber", $admin_remenber, time()+30*24*3600);
				
			}
			else{
				setcookie("admin_name", "", time()-3600);
				setcookie("admin_remenber", "", time()-3600);			
			}

			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('登陆成功');

		}
		else{
			$info["errmsg"]=rawurlencode('用户名或者密码错误');
		}

	}
	elseif($arr['cmd']=='adminloginout'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		
		if($admin_id==''){
			$info["errmsg"]=rawurlencode('用户id不能为空');
			return $info;
		    
		}

		$sql="SELECT * FROM admin WHERE admin_id='{$admin_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_admin_id=$row['admin_id'];
		if($db_admin_id){
			$sql="update admin set admin_check_time=NULL where admin_id='{$admin_id}'";
			$res=mysql_query($sql,$db);
			$info['admin_type_id']=$_SESSION['admin_type_id'];

			session_destroy();
							
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('退出成功');	
		}
		else{
			$info["errmsg"]=rawurlencode('该用户不存在');
		}
	}
	elseif($arr['cmd']=='checkin'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		if($admin_id==''){
			$info["errmsg"]=rawurlencode('用户id不能为空');
			return $info;
		    
		}
		$sql="SELECT * FROM admin WHERE admin_id='{$admin_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_admin_id=$row['admin_id']?$row['admin_id']:"";
		$db_admin_check_time=$row['admin_check_time']?$row['admin_check_time']:"";
		if($db_admin_id){
			if($db_admin_check_time==""){
				$_SESSION['check']="1";

				$sql="update admin set admin_check_time='{$nowdatetime}' where admin_id='{$admin_id}'";
				$res=mysql_query($sql,$db);

				$sql="update proj a,(select last_allo_employee_id,proj_id from user where last_allo_employee_id='{$admin_id}' group by last_allo_employee_id,proj_id) b set a.proj_zxcount=a.proj_zxcount+1 where a.proj_id=b.proj_id";
				$res=mysql_query($sql,$db);
								
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('签入成功');	
			}
			elseif($time-strtotime($db_admin_check_time)>3600){
				$_SESSION['check']="1";

				$sql="update admin set admin_check_time='{$nowdatetime}' where admin_id='{$admin_id}'";
				$res=mysql_query($sql,$db);

				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('签入成功');	
			}
			else{
				$info["errmsg"]=rawurlencode('该用户之前未进行签出操作,请先签出');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该用户不存在');
		}

	}
	elseif($arr['cmd']=='checkout'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		if($admin_id==''){
			$info["errmsg"]=rawurlencode('用户id不能为空');
			return $info;
		    
		}
		$sql="SELECT * FROM admin WHERE admin_id='{$admin_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_admin_id=$row['admin_id']?$row['admin_id']:"";
		$db_admin_check_time=$row['admin_check_time']?$row['admin_check_time']:"";
		if($db_admin_id!=""){
			if($db_admin_check_time!=""){
				$_SESSION['check']="0";
				
				$sql="update admin set admin_check_time=NULL where admin_id='{$admin_id}'";
				$res=mysql_query($sql,$db);

				$sql="update proj a,(select last_allo_employee_id,proj_id from user where last_allo_employee_id='{$admin_id}' group by last_allo_employee_id,proj_id) b set a.proj_zxcount=a.proj_zxcount-1 where a.proj_id=b.proj_id";
				$res=mysql_query($sql,$db);
								
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('签出成功');	
			}
			else{
				$info["errmsg"]=rawurlencode('该用户还未签入');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该用户不存在');
		}

	}
	elseif($arr['cmd']=='query_proj_list'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		if($admin_id==''){
			$info["errmsg"]=rawurlencode('用户id不能为空');
			return $info;
		}

		$sql="select b.proj_id,b.proj_name from admin a left join proj b on a.group_id=b.group_id where a.admin_id='{$admin_id}' and b.status_id='1' group by b.proj_id,b.proj_name";
		$res=mysql_query($sql,$db);

		$i=0;
		$result="";
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["proj_id"]=rawurlencode($row["proj_id"]);
			$info["data"][$i]["proj_name"]=rawurlencode($row["proj_name"]);

			if($result==""){
				$result.=$row["proj_id"]."/".$row["proj_name"];
			}
			else{
				$result.=",".$row["proj_id"]."/".$row["proj_name"];
			}

			$i=$i+1;
		}
		$info["cnt"]=$i;
		$info["proj_list"]=$result;
		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='set_proj_id'){
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';
		$proj_name=isset($arr['proj_name']) ? trim($arr['proj_name']) : '';
		if($proj_id==''){
			$info["errmsg"]=rawurlencode('项目编号不能为空');
			return $info;
		}
		if($proj_name==''){
			$info["errmsg"]=rawurlencode('项目名称不能为空');
			return $info;
		}
		$_SESSION['proj_id']=$proj_id;
		$_SESSION['proj_name']=$proj_name;

		$info["errcode"]="0";
	}
	elseif($arr['cmd']=='get_proj_id'){
		$info['proj_id']=$_SESSION['proj_id']?$_SESSION['proj_id']:"";
		$info['proj_name']=$_SESSION['proj_name']?$_SESSION['proj_name']:"";

		$info["errcode"]="0";
	}
	elseif($arr['cmd']=='queryjrjc'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';
		if($admin_id==''){
			$info["errmsg"]=rawurlencode('用户id不能为空');
			return $info;
		}
		if($proj_id==''){
			$info["errcode"]="0";
			return $info;
		}
		
		$check=$_SESSION['check']?$_SESSION['check']:"0";
		if($check=="1"){
			$sql="SELECT * FROM proj WHERE proj_id='{$proj_id}'";
			$res=mysql_query($sql,$db);
			$row = mysql_fetch_array($res);
			$db_proj_id=$row['proj_id']?$row['proj_id']:"";
			if($db_proj_id){
				$db_proj_ymcount=$row['proj_ymcount']?$row['proj_ymcount']:"5";
				$db_proj_list=$row['proj_list']?$row['proj_list']:_showlist;

				$show_array=explode("|",$db_proj_list);

				$info["title"]=$db_proj_list;

				$sql="SELECT * FROM user WHERE last_allo_employee_id='{$admin_id}' and proj_id='{$proj_id}' and (last_contact_id is NULL or last_contact_id='2') order by id limit  {$db_proj_ymcount}";
				$res=mysql_query($sql,$db);

				$i=0;
				while($row = mysql_fetch_array($res, MYSQL_ASSOC))
				{
					foreach($show_array as $key=>$value){
						$show_mx=explode("/",$value);
						$isshow=$show_mx[0];
						$titlename=$show_mx[1];
						$fieldname=$show_mx[2];
						if($isshow=="1"){
							$info["data"][$i]["{$fieldname}"]=rawurlencode($row["{$fieldname}"]);
						}
					}

					$info["data"][$i]["id"]=rawurlencode($row["id"]);
					$info["data"][$i]["user_id"]=rawurlencode($row["user_id"]);
					$info["data"][$i]["user_phone"]=rawurlencode($row["user_phone"]);

					$i=$i+1;
				}

				if($i==0){
					$sql="SELECT id FROM user WHERE last_allo_employee_id is null and proj_id='{$proj_id}' and (last_contact_id is NULL or last_contact_id='2') order by id ";
					$res=mysql_query($sql,$db);
					$cnt=mysql_num_rows($res);
					if($cnt>0){
						$sql="update user set last_allo_employee_id='{$admin_id}' where id in (".$sql.")";
						$info["sql"]=$sql;
						$res=mysql_query($sql,$db);

						$sql="SELECT * FROM user WHERE last_allo_employee_id='{$admin_id}' and proj_id='{$proj_id}' and (last_contact_id is NULL or last_contact_id='2') order by id limit  {$db_proj_ymcount}";
						$res=mysql_query($sql,$db);

						$i=0;
						while($row = mysql_fetch_array($res, MYSQL_ASSOC))
						{
							foreach($show_array as $key=>$value){
								$show_mx=explode("/",$value);
								$isshow=$show_mx[0];
								$titlename=$show_mx[1];
								$fieldname=$show_mx[2];
								if($isshow=="1"){
									$info["data"][$i]["{$fieldname}"]=rawurlencode($row["{$fieldname}"]);
								}
							}

							$info["data"][$i]["id"]=rawurlencode($row["id"]);
							$info["data"][$i]["user_id"]=rawurlencode($row["user_id"]);
							$info["data"][$i]["user_phone"]=rawurlencode($row["user_phone"]);

							$i=$i+1;
						}

					}
				}

				$info["errcode"]="0";



			}
			else{
				$info["errmsg"]=rawurlencode('该项目不存在');
				return $info;
			}
		}
		else{
			$info["errmsg"]=rawurlencode('请先签入');
			return $info;
		}


	}
	elseif($arr['cmd']=='query_contact'){
		$contact_id=isset($arr['contact_id']) ? trim($arr['contact_id']) : '';
		
		$sql="";
		if ($contact_id!='')
		{
			$sql.=" and contact_id='{$contact_id}'";
		}
		
		$sql="SELECT * FROM contact where 1=1 ".$sql;
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["contact_id"]=$row["contact_id"];
			$info["data"][$i]["contact_name"]=rawurlencode($row["contact_name"]);

			$i=$i+1;
		}
		$info["errcode"]="0";

	}
	elseif($_REQUEST['cmd']=='upload_record'){
		$id=isset($arr['id']) ? trim($arr['id']) : '';
		$index=isset($arr['index']) ? trim($arr['index']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';	
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';
		$user_phone=isset($arr['user_phone']) ? trim($arr['user_phone']) : '';
		
		if($admin_id==''){
			$info["errmsg"]='用户id不能为空';
			return $info;
		}
		if($id==''){
			$info["errmsg"]='编号不能为空';
			return $info;
		}
		if($proj_id==''){
			$info["errmsg"]='项目id不能为空';
			return $info;
		}
		if($user_phone==''){
			$info["errmsg"]='用户手机号不能为空';
			return $info;
		}

		$sql="SELECT id FROM user WHERE id='{$id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_id=$row["id"];
		$sql="";
		if($db_id){
			$first_record=$row["first_record"];
			$second_record=$row["second_record"];
			$third_record=$row["third_record"];

			$i=$first_record?($second_record?($third_record?4:3):2):1;

			if($i!=4){

				$result=upload2("record",$admin_id,$_FILES["record_".$index."_upload"],$proj_id."_".$admin_id."_".$user_phone."_".$i);
				if($result["retcode"]=="-1"){
					$info["errmsg"]=$result["retmsg"];
					return $info;
				}
				$url=$result["url"] ? $result["url"] : "";

				$info["errcode"]="0";
				$info["errmsg"]='保存成功';
				$info["url"]=$url;
			}
			else{
				$info["errmsg"]='不能上传3次以上';
			}
		}
		else{
			$info["errmsg"]='该用户不存在';
		}	
	}
	elseif($arr['cmd']=='add_contact'){
		$id=isset($arr['id']) ? trim($arr['id']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$contact_id=isset($arr['contact_id']) ? trim($arr['contact_id']) : '';
		$contact_bz=isset($arr['contact_bz']) ? trim($arr['contact_bz']) : '';
		$record=isset($arr['record']) ? trim($arr['record']) : '';
		
		if($id==''){
			$info["errmsg"]=rawurlencode('编号不能为空');
			return $info;
		}

		if($admin_id==''){
			$info["errmsg"]='用户id不能为空';
			return $info;
		}
		if($contact_id==''){
			$info["errmsg"]='接触情况不能为空';
			return $info;
		}
		if($record==''){
			$info["errmsg"]='录音不能为空';
			return $info;
		}

		
				
		$sql="SELECT * FROM user where id='{$id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_id=isset($row["id"])? $row["id"]: "";
		if($db_id!=""){

			$first_contact_id=$row["first_contact_id"];
			$second_contact_id=$row["second_contact_id"];
			$third_contact_id=$row["third_contact_id"];
			$last_allo_employee_id=$row["last_allo_employee_id"];

			if($admin_id==$last_allo_employee_id){

				$sql="select b.admin_id as gly_admin_id from admin a left join admin_group b on a.group_id=b.group_id where a.admin_id='{$admin_id}'";
				$res=mysql_query($sql,$db);
				$row = mysql_fetch_array($res);
				$db_gly_admin_id=isset($row["gly_admin_id"])? $row["gly_admin_id"]: "";


				$sql=$first_contact_id?($second_contact_id?($third_contact_id?"":",third_allo_employee_id='{$admin_id}',third_contact_time='{$nowdatetime}',third_contact_id='{$contact_id}',third_contact_bz='{$contact_bz}',third_record='{$record}'"):",second_allo_employee_id='{$admin_id}',second_contact_time='{$nowdatetime}',second_contact_id='{$contact_id}',second_contact_bz='{$contact_bz}',second_record='{$record}'"):",first_allo_employee_id='{$admin_id}',first_contact_time='{$nowdatetime}',first_contact_id='{$contact_id}',first_contact_bz='{$contact_bz}',first_record='{$record}'";
				
				if($sql!=""){
					$sql="update user set last_allo_employee_id='{$admin_id}',last_contact_time='{$nowdatetime}',last_contact_id='{$contact_id}',last_contact_bz='{$contact_bz}',last_record='{$record}',last_audit_employee_id='{$db_gly_admin_id}'".$sql." where id='{$id}'";
					$res=mysql_query($sql,$db);
					if($res){
						$info["errcode"]="0";
						$info["errmsg"]=rawurlencode('提交成功');
					}else{
						$info["errmsg"]=rawurlencode('提交失败');
					}
				}
				else{
					$info["errmsg"]=rawurlencode('提交不能超过3次');
				}

			}
			else{
				$info["errmsg"]=rawurlencode('不能重复提交');
			}
		
		}
		else{

			$info["errmsg"]=rawurlencode('该客户不存在');
		}
	}
	elseif($arr['cmd']=='queryjrsh'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';
		if($admin_id==''){
			$info["errmsg"]=rawurlencode('用户id不能为空');
			return $info;
		}
		if($proj_id==''){
			$info["errcode"]="0";
			return $info;
		}
		
		$check=$_SESSION['check']?$_SESSION['check']:"0";
		if($check=="1"){
			$sql="SELECT * FROM proj WHERE proj_id='{$proj_id}'";
			$res=mysql_query($sql,$db);
			$row = mysql_fetch_array($res);
			$db_proj_id=$row['proj_id']?$row['proj_id']:"";
			if($db_proj_id){
				$db_proj_list=$row['proj_list']?$row['proj_list']:_showlist;

				$show_array=explode("|",$db_proj_list);

				$info["title"]=$db_proj_list;

				$sql="SELECT * FROM user WHERE last_audit_employee_id='{$admin_id}' and proj_id='{$proj_id}' and last_audit_id is null order by last_audit_time ";
				$info['sql']=$sql;
				$res=mysql_query($sql,$db);

				$i=0;
				while($row = mysql_fetch_array($res, MYSQL_ASSOC))
				{
					foreach($show_array as $key=>$value){
						$show_mx=explode("/",$value);
						$isshow=$show_mx[0];
						$titlename=$show_mx[1];
						$fieldname=$show_mx[2];
						if($isshow=="1"){
							$info["data"][$i]["{$fieldname}"]=rawurlencode($row["{$fieldname}"]);
						}
					}

					$info["data"][$i]["id"]=rawurlencode($row["id"]);
					$info["data"][$i]["user_id"]=rawurlencode($row["user_id"]);
					$info["data"][$i]["user_phone"]=rawurlencode($row["user_phone"]);
					$info["data"][$i]["last_record"]=rawurlencode($row["last_record"]);

					$i=$i+1;
				}
				$info["errcode"]="0";



			}
			else{
				$info["errmsg"]=rawurlencode('该项目不存在');
				return $info;
			}
		}
		else{
			$info["errmsg"]=rawurlencode('请先签入');
			return $info;
		}


	}
	elseif($arr['cmd']=='query_audit_result'){
		$audit_result_id=isset($arr['audit_result_id']) ? trim($arr['audit_result_id']) : '';
		$audit_result_type_id=isset($arr['audit_result_type_id']) ? trim($arr['audit_result_type_id']) : '';
		
		$sql="";
		if ($audit_result_id!='')
		{
			$sql.=" and audit_result_id='{$audit_result_id}'";
		}
		if ($audit_result_type_id!='')
		{
			$sql.=" and audit_result_type_id='{$audit_result_type_id}'";
		}
		
		$sql="SELECT * FROM audit_result where 1=1 ".$sql;
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["audit_result_id"]=$row["audit_result_id"];
			$info["data"][$i]["audit_result_name"]=rawurlencode($row["audit_result_name"]);

			$i=$i+1;
		}
		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='add_audit'){
		$id=isset($arr['id']) ? trim($arr['id']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$audit_id=isset($arr['audit_id']) ? trim($arr['audit_id']) : '';
		$audit_bz=isset($arr['audit_bz']) ? trim($arr['audit_bz']) : '';
		
		if($id==''){
			$info["errmsg"]=rawurlencode('编号不能为空');
			return $info;
		}

		if($admin_id==''){
			$info["errmsg"]='用户id不能为空';
			return $info;
		}
		if($audit_id==''){
			$info["errmsg"]='审核结果不能为空';
			return $info;
		}

		
				
		$sql="SELECT * FROM user where id='{$id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_id=isset($row["id"])? $row["id"]: "";
		if($db_id!=""){

			$last_audit_employee_id=$row["last_audit_employee_id"];
			$info["admin_id"]=$admin_id;
			$info["last_audit_employee_id"]=$last_audit_employee_id;

			if($admin_id==$last_audit_employee_id){

				$sql="update user set last_audit_time='{$nowdatetime}',last_audit_id='{$audit_id}',last_audit_bz='{$audit_bz}' where id='{$id}'";
				$res=mysql_query($sql,$db);
				if($res){
					$info["errcode"]="0";
					$info["errmsg"]=rawurlencode('提交成功');
				}else{
					$info["errmsg"]=rawurlencode('提交失败');
				}


			}
			else{
				$info["errmsg"]=rawurlencode('审核人与督导不一致');
			}
		
		}
		else{

			$info["errmsg"]=rawurlencode('该客户不存在');
		}
	}
	elseif($arr['cmd']=='query_tj'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		if($admin_id==''){
			$info["errmsg"]='用户id不能为空';
			return $info;
		}

		$sql="select a.contact_id,b.cnt from contact a left join (SELECT last_contact_id,count(*) as cnt FROM user where last_allo_employee_id='{$admin_id}' and last_contact_time like '{$nowdate}%' group by last_contact_id) b on a.contact_id=b.last_contact_id order by a.contact_id";
		$res=mysql_query($sql,$db);
		$i=0;
		$cnt=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		

			$cnt+=$row["cnt"];

			if($row["contact_id"]=='1'){
				$info['jr_fwcg']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='2'){
				$info['jr_yyfw']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='3'){
				$info['jr_kcjf']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='4'){
				$info['jr_ztjf']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='5'){
				$info['jr_qtqk']=$row["cnt"]?$row["cnt"]:"0";
			}

			$i=$i+1;
		}

		$info['jr_zj']=$cnt;
		$info['jr_cgl']=round($info['jr_fwcg']/$info['jr_zj']*100,2);
		$info['jr_cgl']=$info['jr_cgl']."%";

		$sql="select a.contact_id,(ifnull(b.cnt,0)+ifnull(c.cnt,0)+ifnull(d.cnt,0)) as cnt from contact a left join (SELECT first_contact_id,count(*) as cnt FROM user where first_allo_employee_id='{$admin_id}' group by first_contact_id) b on a.contact_id=b.first_contact_id left join (SELECT second_contact_id,count(*) as cnt FROM user where second_allo_employee_id='{$admin_id}' group by second_contact_id) c  on a.contact_id=c.second_contact_id left join (SELECT third_contact_id,count(*) as cnt FROM user where third_allo_employee_id='{$admin_id}' group by third_contact_id) d on a.contact_id=d.third_contact_id order by a.contact_id";

		$res=mysql_query($sql,$db);
		$i=0;
		$cnt=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		

			$cnt+=$row["cnt"];

			if($row["contact_id"]=='1'){
				$info['ls_fwcg']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='2'){
				$info['ls_yyfw']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='3'){
				$info['ls_kcjf']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='4'){
				$info['ls_ztjf']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='5'){
				$info['ls_qtqk']=$row["cnt"]?$row["cnt"]:"0";
			}

			$i=$i+1;
		}

		$info['ls_zj']=$cnt;
		$info['ls_cgl']=round($info['ls_fwcg']/$info['ls_zj']*100,2);
		$info['ls_cgl']=$info['ls_cgl']."%";

		$sql="select a.admin_id,b.cnt from admin a left join (select last_allo_employee_id,count(*) as cnt from user where last_contact_time like '{$nowdate}%' and last_contact_id='1' group by last_allo_employee_id ) b on a.admin_id=b.last_allo_employee_id where a.admin_type_id='2' order by b.cnt desc";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"]["jrcg"][$i]["admin_id"]=$row["admin_id"];
			$info["data"]["jrcg"][$i]["cnt"]=$row["cnt"]?$row["cnt"]:'0';

			$i=$i+1;
		}

		$sql="select a.admin_id,(ifnull(b.cnt,0)+ifnull(c.cnt,0)+ifnull(d.cnt,0)) as hz_cnt from admin a left join (select first_allo_employee_id,count(*) as cnt from user where first_contact_id='1' group by first_allo_employee_id) b on a.admin_id=b.first_allo_employee_id left join (select second_allo_employee_id,count(*) as cnt from user where second_contact_id='1' group by second_allo_employee_id) c on a.admin_id=c.second_allo_employee_id left join (select third_allo_employee_id,count(*) as cnt from user where third_contact_id='1' group by third_allo_employee_id) d on a.admin_id=d.third_allo_employee_id where a.admin_type_id='2' order by hz_cnt desc";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"]["lscg"][$i]["admin_id"]=$row["admin_id"];
			$info["data"]["lscg"][$i]["cnt"]=$row["hz_cnt"];

			$i=$i+1;
		}

		$sql="select a.audit_result_id,b.cnt from audit_result a left join (SELECT last_audit_id,count(*) as cnt FROM user where last_audit_employee_id='{$admin_id}' and last_audit_time like '{$nowdate}%' group by last_audit_id) b on a.audit_result_id=b.last_audit_id where audit_result_type_id='0' order by a.audit_result_id";
		$res=mysql_query($sql,$db);
		$i=0;
		$cnt=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		

			$cnt+=$row["cnt"];

			if($row["audit_result_id"]=='1'){
				$info['jr_shcg']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["audit_result_id"]=='2'){
				$info['jr_shsb']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["audit_result_id"]=='3'){
				$info['jr_shqt']=$row["cnt"]?$row["cnt"]:"0";
			}

			$i=$i+1;
		}

		$info['jr_shzj']=$cnt;


		$sql="select a.audit_result_id,b.cnt from audit_result a left join (SELECT last_audit_id,count(*) as cnt FROM user where last_audit_employee_id='{$admin_id}' group by last_audit_id) b on a.audit_result_id=b.last_audit_id where audit_result_type_id='0' order by a.audit_result_id";
		$res=mysql_query($sql,$db);
		$i=0;
		$cnt=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		

			$cnt+=$row["cnt"];

			if($row["audit_result_id"]=='1'){
				$info['ls_shcg']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["audit_result_id"]=='2'){
				$info['ls_shsb']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["audit_result_id"]=='3'){
				$info['ls_shqt']=$row["cnt"]?$row["cnt"]:"0";
			}

			$i=$i+1;
		}

		$info['ls_shzj']=$cnt;

		$sql="select a.admin_id,b.cnt from admin a left join (select last_audit_employee_id,count(*) as cnt from user where last_audit_time like '{$nowdate}%' and last_audit_id='1' group by last_audit_employee_id ) b on a.admin_id=b.last_audit_employee_id where a.admin_type_id='2' order by b.cnt desc";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"]["jrsh"][$i]["admin_id"]=$row["admin_id"];
			$info["data"]["jrsh"][$i]["cnt"]=$row["cnt"]?$row["cnt"]:'0';

			$i=$i+1;
		}

		$sql="select a.admin_id,b.cnt from admin a left join (select last_audit_employee_id,count(*) as cnt from user where last_audit_id='1' group by last_audit_employee_id ) b on a.admin_id=b.last_audit_employee_id where a.admin_type_id='2' order by b.cnt desc";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"]["lssh"][$i]["admin_id"]=$row["admin_id"];
			$info["data"]["lssh"][$i]["cnt"]=$row["cnt"]?$row["cnt"]:'0';

			$i=$i+1;
		}


		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='query_proj'){
		$sql="select a.*,b.status_name from proj a left join proj_status b on a.status_id=b.status_id";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["proj_id"]=rawurlencode($row["proj_id"]);
			$info["data"][$i]["proj_name"]=rawurlencode($row["proj_name"]);
			$info["data"][$i]["proj_bz"]=rawurlencode($row["proj_bz"]);
			$info["data"][$i]["proj_zxcount"]=rawurlencode($row["proj_zxcount"]);
			$info["data"][$i]["proj_ymcount"]=rawurlencode($row["proj_ymcount"]);
			$info["data"][$i]["status_id"]=rawurlencode($row["status_id"]);
			$info["data"][$i]["status_name"]=rawurlencode($row["status_name"]);
			$info["data"][$i]["proj_list"]=rawurlencode($row["proj_list"]);
			$info["data"][$i]["group_id"]=rawurlencode($row["group_id"]);
			$info["data"][$i]["ip"]=rawurlencode($row["ip"]);
			$info["data"][$i]["port"]=rawurlencode($row["port"]);
			$info["data"][$i]["name"]=rawurlencode($row["name"]);
			$info["data"][$i]["pwd"]=rawurlencode($row["pwd"]);

			$i=$i+1;
		}

		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='query_proj_mx'){
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';
		if($proj_id==''){
			$info["errmsg"]='项目id不能为空';
			return $info;
		}

		$sql="select * from proj where proj_id='{$proj_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_proj_id=$row["proj_id"];
		if($db_proj_id){
			$info["proj_id"]=$row["proj_id"];
			$info["proj_name"]=$row["proj_name"];
			$info["proj_bz"]=$row["proj_bz"];
			$info["proj_zxcount"]=$row["proj_zxcount"];
			$info["proj_ymcount"]=$row["proj_ymcount"];
			$info["status_id"]=$row["status_id"];
			$info["proj_list"]=$row["proj_list"]?$row["proj_list"]:_showlist;
			$info["group_id"]=$row["group_id"];
			$info["ip"]=$row["ip"];
			$info["port"]=$row["port"];
			$info["name"]=$row["name"];
			$info["pwd"]=$row["pwd"];

			$info["errcode"]="0";
		}
		else{
			$info["errmsg"]='该项目不存在';
			return $info;
		}

	}
	elseif($arr['cmd']=='connect_db'){
		$ip=isset($arr['ip']) ? trim($arr['ip']) : '';
		$port=isset($arr['port']) ? trim($arr['port']) : '3306';
		$name=isset($arr['name']) ? trim($arr['name']) : '';
		$pwd=isset($arr['pwd']) ? trim($arr['pwd']) : '';

		if($ip==''){
			$info["errmsg"]='地址不能为空';
			return $info;
		}
		if($name==''){
			$info["errmsg"]='账号不能为空';
			return $info;
		}
		if($pwd==''){
			$info["errmsg"]='密码不能为空';
			return $info;
		}

		$link = mysql_connect($ip, $name, $pwd, $port) or die("连接失败2");

		if($link){
			$info["errcode"]="0";
			$info["errmsg"]='连接成功';
		}else{
			$info["errmsg"]='连接失败';
		}
	}
	elseif($arr['cmd']=='add_proj'){
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';
		$proj_name=isset($arr['proj_name']) ? trim($arr['proj_name']) : '';
		$proj_bz=isset($arr['proj_bz']) ? trim($arr['proj_bz']) : '';
		$status_id=isset($arr['status_id']) ? trim($arr['status_id']) : '';
		$group_id=isset($arr['group_id']) ? trim($arr['group_id']) : '';
		$proj_list=isset($arr['proj_list']) ? trim($arr['proj_list']) : _showlist;
		$ip=isset($arr['ip']) ? trim($arr['ip']) : '';
		$port=isset($arr['port']) ? trim($arr['port']) : '';
		$name=isset($arr['name']) ? trim($arr['name']) : '';
		$pwd=isset($arr['pwd']) ? trim($arr['pwd']) : '';

		if($proj_name==''){
			$info["errmsg"]='项目名称不能为空';
			return $info;
		}

		$sql="select * from proj where proj_name='{$proj_name}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_proj_id=$row["proj_id"];
		if($db_proj_id and ($db_proj_id!=$proj_id)){
			$info["errmsg"]='该项目名称已经存在';
			return $info;
		}

		if($proj_id!=''){
			$sql="update proj set proj_name='{$proj_name}',proj_bz='{$proj_bz}',status_id='{$status_id}',group_id='{$group_id}',proj_list='{$proj_list}',ip='{$ip}',port='{$port}',name='{$name}',pwd='{$pwd}' where proj_id='{$proj_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('提交成功');
			}else{
				$info["errmsg"]=rawurlencode('提交失败');
			}

		}
		else{
			$sql="insert into proj(proj_name,proj_bz,status_id,group_id,proj_list,ip,port,name,pwd)VALUES('{$proj_name}','{$proj_bz}','{$status_id}','{$group_id}','{$proj_list}','{$ip}','{$port}','{$name}','{$pwd}')";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('提交成功');
			}else{
				$info["errmsg"]=rawurlencode('提交失败');
			}
		}

	}
	elseif($arr['cmd']=='query_user'){
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';
		$sql=isset($arr['sql']) ? trim($arr['sql']) : '';

		if($proj_id==''){
			$info["errmsg"]='项目编号不能为空';
			return $info;
		}

		$sql="select * from user where proj_id='{$proj_id}' ".$sql;
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["id"]=rawurlencode($row["id"]);
			$info["data"][$i]["user_id"]=rawurlencode($row["user_id"]);
			$info["data"][$i]["user_name"]=rawurlencode($row["user_name"]);
			$info["data"][$i]["user_phone"]=rawurlencode($row["user_phone"]);

			$i=$i+1;
		}

		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='query_proj_user_2'){
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';
		$user_phone=isset($arr['user_phone']) ? trim($arr['user_phone']) : '';

		if($proj_id==''){
			$info["errmsg"]='项目编号不能为空';
			return $info;
		}

		if($user_phone==''){
			$info["errmsg"]='号码不能为空';
			return $info;
		}

		$sql="select a.*,b.contact_name from user a left join contact b on a.last_contact_id=b.contact_id where a.proj_id='{$proj_id}' and a.user_phone='{$user_phone}' ";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_id=$row["id"];
		if($db_id){
			$info["contact_name"]=$row["contact_name"]?$row["contact_name"]:"";
			$info["errcode"]="0";
		}
		else{
			$info["errmsg"]='该号码不存在';
		}

	}
	elseif($arr['cmd']=='query_proj_contact'){
		$proj_id=isset($arr['proj_id']) ? trim($arr['proj_id']) : '';

		if($proj_id==''){
			$info["errmsg"]='项目编号不能为空';
			return $info;
		}

		$sql="select a.cnt,b.cnt2 from (select count(*) as cnt from user where proj_id='{$proj_id}' and last_contact_id is null) a ,(select count(*) as cnt2 from user where proj_id='{$proj_id}' and last_contact_id is not null) b";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$info["jcyb"]=$row["cnt2"]?$row["cnt2"]:"0";
		$info["wjcyb"]=$row["cnt"]?$row["cnt"]:"0";
		$info["zyb"]=$info["jcyb"]+$info["wjcyb"];


		$sql="select a.contact_id,b.cnt from contact a left join (SELECT last_contact_id,count(*) as cnt FROM user where proj_id='{$proj_id}' and last_contact_time like '{$nowdate}%' group by last_contact_id) b on a.contact_id=b.last_contact_id order by a.contact_id";
		$res=mysql_query($sql,$db);
		$i=0;
		$cnt=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		

			$cnt+=$row["cnt"];

			if($row["contact_id"]=='1'){
				$info['jr_fwcg']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='2'){
				$info['jr_yyfw']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='3'){
				$info['jr_kcjf']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='4'){
				$info['jr_ztjf']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='5'){
				$info['jr_qtqk']=$row["cnt"]?$row["cnt"]:"0";
			}

			$i=$i+1;
		}

		$info['jr_sb']=$info['jr_kcjf']+$info['jr_ztjf']+$info['jr_qtqk'];

		$sql="select a.contact_id,(ifnull(b.cnt,0)+ifnull(c.cnt,0)+ifnull(d.cnt,0)) as cnt from contact a left join (SELECT first_contact_id,count(*) as cnt FROM user where proj_id='{$proj_id}' group by first_contact_id) b on a.contact_id=b.first_contact_id left join (SELECT second_contact_id,count(*) as cnt FROM user where proj_id='{$proj_id}' group by second_contact_id) c  on a.contact_id=c.second_contact_id left join (SELECT third_contact_id,count(*) as cnt FROM user where proj_id='{$proj_id}' group by third_contact_id) d on a.contact_id=d.third_contact_id order by a.contact_id";

		$res=mysql_query($sql,$db);
		$i=0;
		$cnt=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		

			$cnt+=$row["cnt"];

			if($row["contact_id"]=='1'){
				$info['ls_fwcg']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='2'){
				$info['ls_yyfw']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='3'){
				$info['ls_kcjf']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='4'){
				$info['ls_ztjf']=$row["cnt"]?$row["cnt"]:"0";
			}
			elseif($row["contact_id"]=='5'){
				$info['ls_qtqk']=$row["cnt"]?$row["cnt"]:"0";
			}

			$i=$i+1;
		}

		$info['ls_sb']=$info['ls_kcjf']+$info['ls_ztjf']+$info['ls_qtqk'];

		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='query_admin'){
		$admin_type_id=isset($arr['admin_type_id']) ? trim($arr['admin_type_id']) : '';
		if($admin_type_id!=''){
			$sql=" and a.admin_type_id='{$admin_type_id}'";
		}

		$sql="select a.*,b.group_name from admin a left join admin_group b on a.group_id=b.group_id where 1=1".$sql;
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{	
			$info["data"][$i]["admin_id"]=rawurlencode($row["admin_id"]);
			$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
			$info["data"][$i]["admin_pwd"]=rawurlencode($row["admin_pwd"]);
			$info["data"][$i]["group_id"]=rawurlencode($row["group_id"]);
			$info["data"][$i]["group_name"]=rawurlencode($row["group_name"]);
			$i=$i+1;
		}

		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='query_admin_group'){
		$sql="select a.*,b.admin_name from admin_group a left join admin b on a.admin_id=b.admin_id where 1=1";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{	
			$info["data"][$i]["group_id"]=rawurlencode($row["group_id"]);
			$info["data"][$i]["group_name"]=rawurlencode($row["group_name"]);
			$info["data"][$i]["group_bz"]=rawurlencode($row["group_bz"]);
			$info["data"][$i]["group_pwd"]=rawurlencode($row["group_pwd"]);
			$info["data"][$i]["admin_id"]=rawurlencode($row["admin_id"]);
			$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
			$i=$i+1;
		}

		$info["errcode"]="0";

	}
	elseif($arr['cmd']=='add_admin_staff'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$admin_name=isset($arr['admin_name']) ? trim($arr['admin_name']) : '';
		$admin_pwd=isset($arr['admin_pwd']) ? trim($arr['admin_pwd']) : '';
		$group_id=isset($arr['group_id']) ? trim($arr['group_id']) : '';
		$admin_type_id=isset($arr['admin_type_id']) ? trim($arr['admin_type_id']) : '2';

		if($admin_name==''){
			$info["errmsg"]='编号不能为空';
			return $info;
		}

		if($admin_pwd==''){
			$info["errmsg"]='密码不能为空';
			return $info;
		}

		if($group_id==''){
			$info["errmsg"]='用户分组不能为空';
			return $info;
		}

		if($admin_type_id==''){
			$info["errmsg"]='用户类型不能为空';
			return $info;
		}

		$sql="select * from admin where admin_name='{$admin_name}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_admin_id=$row["admin_id"];
		if($db_admin_id and ($db_admin_id!=$admin_id)){
			$info["errmsg"]='该编号已经存在';
			return $info;
		}

		if($admin_id!=''){
			$sql="update admin set admin_name='{$admin_name}',admin_pwd='{$admin_pwd}',group_id='{$group_id}',admin_type_id='{$admin_type_id}' where admin_id='{$admin_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('提交成功');
			}else{
				$info["errmsg"]=rawurlencode('提交失败');
			}

		}
		else{
			$sql="insert into admin(admin_name,admin_pwd,group_id,admin_type_id)VALUES('{$admin_name}','{$admin_pwd}','{$group_id}','{$admin_type_id}')";
			$res=mysql_query($sql,$db);
			if($res){
				$sql="select * from admin where admin_name='{$admin_name}'";
				$res=mysql_query($sql,$db);
				$row = mysql_fetch_array($res);
				$info["admin_id"]=$row["admin_id"];

				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('提交成功');

			}else{
				$info["errmsg"]=rawurlencode('提交失败');
			}
		}

	}
	elseif($arr['cmd']=='del_admin_staff'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';

		if($admin_id==''){
			$info["errmsg"]='id不能为空';
			return $info;
		}

		$sql="delete from admin where admin_id='{$admin_id}'";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('删除成功');
		}
		else{
			$info["errmsg"]=rawurlencode('删除失败');
		}

	}
	elseif($arr['cmd']=='add_admin_admin'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$admin_name=isset($arr['admin_name']) ? trim($arr['admin_name']) : '';
		$admin_pwd=isset($arr['admin_pwd']) ? trim($arr['admin_pwd']) : '';
		$admin_type_id=isset($arr['admin_type_id']) ? trim($arr['admin_type_id']) : '1';

		if($admin_name==''){
			$info["errmsg"]='编号不能为空';
			return $info;
		}

		if($admin_pwd==''){
			$info["errmsg"]='密码不能为空';
			return $info;
		}

		if($admin_type_id==''){
			$info["errmsg"]='用户类型不能为空';
			return $info;
		}

		$sql="select * from admin where admin_name='{$admin_name}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_admin_id=$row["admin_id"];
		if($db_admin_id and ($db_admin_id!=$admin_id)){
			$info["errmsg"]='该编号已经存在';
			return $info;
		}

		if($admin_id!=''){
			$sql="update admin set admin_name='{$admin_name}',admin_pwd='{$admin_pwd}',admin_type_id='{$admin_type_id}' where admin_id='{$admin_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('提交成功');
			}else{
				$info["errmsg"]=rawurlencode('提交失败');
			}

		}
		else{
			$sql="insert into admin(admin_name,admin_pwd,admin_type_id)VALUES('{$admin_name}','{$admin_pwd}','{$admin_type_id}')";
			$res=mysql_query($sql,$db);
			if($res){
				$sql="select * from admin where admin_name='{$admin_name}'";
				$res=mysql_query($sql,$db);
				$row = mysql_fetch_array($res);
				$info["admin_id"]=$row["admin_id"];

				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('提交成功');

			}else{
				$info["errmsg"]=rawurlencode('提交失败');
			}
		}

	}
	elseif($arr['cmd']=='del_admin_admin'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';

		if($admin_id==''){
			$info["errmsg"]='id不能为空';
			return $info;
		}

		$sql="delete from admin where admin_id='{$admin_id}'";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('删除成功');
		}
		else{
			$info["errmsg"]=rawurlencode('删除失败');
		}

	}
	elseif($arr['cmd']=='add_admin_group'){
		$group_id=isset($arr['group_id']) ? trim($arr['group_id']) : '';
		$group_name=isset($arr['group_name']) ? trim($arr['group_name']) : '';
		$group_bz=isset($arr['group_bz']) ? trim($arr['group_bz']) : '';
		$group_pwd=isset($arr['group_pwd']) ? trim($arr['group_pwd']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';

		if($group_name==''){
			$info["errmsg"]='组名称不能为空';
			return $info;
		}

		if($group_bz==''){
			$info["errmsg"]='组备注不能为空';
			return $info;
		}

		if($group_pwd==''){
			$info["errmsg"]='管理密码不能为空';
			return $info;
		}

		$sql="select * from admin_group where group_name='{$group_name}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_group_id=$row["group_id"];
		if($db_group_id and ($db_group_id!=$group_id)){
			$info["errmsg"]='该组名称已经存在';
			return $info;
		}

		if($group_id!=''){
			$sql="update admin_group set group_name='{$group_name}',group_bz='{$group_bz}',group_pwd='{$group_pwd}',admin_id='{$admin_id}' where group_id='{$group_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('提交成功');
			}else{
				$info["errmsg"]=rawurlencode('提交失败');
			}

		}
		else{
			$sql="insert into admin_group(group_name,group_bz,group_pwd,admin_id)VALUES('{$group_name}','{$group_bz}','{$group_pwd}','{$admin_id}')";
			$res=mysql_query($sql,$db);
			if($res){
				$sql="select * from admin_group where group_name='{$group_name}'";
				$res=mysql_query($sql,$db);
				$row = mysql_fetch_array($res);
				$info["group_id"]=$row["group_id"];

				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('提交成功');

			}else{
				$info["errmsg"]=rawurlencode('提交失败');
			}
		}

	}
	elseif($arr['cmd']=='del_admin_group'){
		$group_id=isset($arr['group_id']) ? trim($arr['group_id']) : '';

		if($group_id==''){
			$info["errmsg"]='id不能为空';
			return $info;
		}

		$sql="delete from admin_group where group_id='{$group_id}'";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('删除成功');
		}
		else{
			$info["errmsg"]=rawurlencode('删除失败');
		}

	}
	else
	{
		$info["errmsg"]=rawurlencode("该功能暂不支持");
	}
	return $info;
}


?>