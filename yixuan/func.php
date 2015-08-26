<?php
function main($db,$filestr,$arr)
{
	$info=array();
	$info["errcode"]="-1";
	
	$nowdate = date("Y-m-d");
	$nowdatetime =date("Y-m-d H:i:s");
	$time =time();
	$getback_file =  file_get_contents("./ts.html");
	$form_file =  file_get_contents("./form_file.html");
	
	if($arr['cmd']=='login'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$password=isset($arr['password']) ?trim($arr['password']): '';
		$mac=isset($arr['mac']) ?trim($arr['mac']): '';
		$from=isset($arr['from']) ?trim($arr['from']): '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($password==''){
			$info["errmsg"]=rawurlencode('密码不能为空');
			return $info;
		    
		}
		if($from!="web"){
			if($mac==''){
				$info["errmsg"]=rawurlencode('mac不能为空');
				return $info;
			
			}
			$sql="SELECT * FROM student WHERE username='{$username}' and userpwd='{$password}'";
			$res=mysql_query($sql,$db);
			$row = mysql_fetch_array($res);
			$db_student_id=$row['student_id'];
			$db_mac=$row['mac']?$row['mac'] :"";
			if($db_student_id){
				if($db_mac==""){
					$sql="UPDATE student set mac='{$mac}' WHERE student_id='{$db_student_id}'";
					$res=mysql_query($sql,$db);
					$info["errcode"]="0";
					$info["errmsg"]=rawurlencode('登陆成功');
				
				
					$info["data"][0]["student_id"]=rawurlencode($row["student_id"]);
					$info["data"][0]["student_name"]=rawurlencode($row["student_name"]);
					$info["data"][0]["student_sex"]=rawurlencode($row["student_sex"]);
					$info["data"][0]["student_birthday"]=rawurlencode($row["student_birthday"]);
					$info["data"][0]["student_parent"]=rawurlencode($row["student_parent"]);
					$info["data"][0]["student_phone"]=rawurlencode($row["student_phone"]);
					$info["data"][0]["student_address"]=rawurlencode($row["student_address"]);
					$info["data"][0]["student_email"]=rawurlencode($row["student_email"]);
					$info["data"][0]["kc_id"]=rawurlencode($row["kc_id"]);
					$info["data"][0]["bj_id"]=rawurlencode($row["bj_id"]);
					$info["data"][0]["rx_time"]=rawurlencode($row["rx_time"]);

					$_SESSION['username']=$username;
					$_SESSION['log_from_id']='2';

					$arrlog = array( 
						'cmd' => 'add_log', 
						'log_type_id' => '23', 
						'username' => $username
					); 

					main($db,$filestr,$arrlog);
				}
				else{
					if($db_mac==$mac){
						$info["errcode"]="0";
						$info["errmsg"]=rawurlencode('登陆成功');
										
						$info["data"][0]["student_id"]=rawurlencode($row["student_id"]);
						$info["data"][0]["student_name"]=rawurlencode($row["student_name"]);
						$info["data"][0]["student_sex"]=rawurlencode($row["student_sex"]);
						$info["data"][0]["student_birthday"]=rawurlencode($row["student_birthday"]);
						$info["data"][0]["student_parent"]=rawurlencode($row["student_parent"]);
						$info["data"][0]["student_phone"]=rawurlencode($row["student_phone"]);
						$info["data"][0]["student_address"]=rawurlencode($row["student_address"]);
						$info["data"][0]["student_email"]=rawurlencode($row["student_email"]);
						$info["data"][0]["kc_id"]=rawurlencode($row["kc_id"]);
						$info["data"][0]["bj_id"]=rawurlencode($row["bj_id"]);
						$info["data"][0]["rx_time"]=rawurlencode($row["rx_time"]);

						$_SESSION['username']=$username;
						$_SESSION['log_from_id']='2';

						$arrlog = array( 
							'cmd' => 'add_log', 
							'log_type_id' => '23', 
							'username' => $username
						); 

						main($db,$filestr,$arrlog);

					}
					else{
						$info["errmsg"]=rawurlencode('ipad与第一次登陆的不匹配，请联系老师进行修改');
					}
				}		
			}
			else{
				$info["errmsg"]=rawurlencode('用户名或者密码错误');
			}
		}
		else{
			$sql="SELECT * FROM student WHERE username='{$username}' and userpwd='{$password}'";
			$res=mysql_query($sql,$db);
			$row = mysql_fetch_array($res);
			$db_student_id=$row['student_id'];
			if($db_student_id){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('登陆成功');
								
				$info["data"][0]["student_id"]=rawurlencode($row["student_id"]);
				$info["data"][0]["student_name"]=rawurlencode($row["student_name"]);
				$info["data"][0]["student_sex"]=rawurlencode($row["student_sex"]);
				$info["data"][0]["student_birthday"]=rawurlencode($row["student_birthday"]);
				$info["data"][0]["student_parent"]=rawurlencode($row["student_parent"]);
				$info["data"][0]["student_phone"]=rawurlencode($row["student_phone"]);
				$info["data"][0]["student_address"]=rawurlencode($row["student_address"]);
				$info["data"][0]["student_email"]=rawurlencode($row["student_email"]);
				$info["data"][0]["kc_id"]=rawurlencode($row["kc_id"]);
				$info["data"][0]["bj_id"]=rawurlencode($row["bj_id"]);
				$info["data"][0]["rx_time"]=rawurlencode($row["rx_time"]);
				
				$_SESSION['username']=$username;
				$_SESSION['log_from_id']='1';

				$arrlog = array( 
					'cmd' => 'add_log', 
					'log_type_id' => '1', 
					'username' => $username
				); 

				main($db,$filestr,$arrlog);
			}
			else{
				$info["errmsg"]=rawurlencode('用户名或者密码错误');
			}
		}
	}
	elseif($arr['cmd']=='changepwd'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$password=isset($arr['password']) ?trim($arr['password']): '';
		$newpassword=isset($arr['newpassword']) ?trim($arr['newpassword']): '';
		$newpassword_confirm=isset($arr['newpassword_confirm']) ?trim($arr['newpassword_confirm']): '';
		
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($password==''){
			$info["errmsg"]=rawurlencode('原密码不能为空');
			return $info;
		    
		}
		if($newpassword==''){
			$info["errmsg"]=rawurlencode('新密码不能为空');
			return $info;
		    
		}
		if($newpassword!=$newpassword_confirm){
			$info["errmsg"]=rawurlencode('两次输入密码不相同');
			return $info;
		    
		}
		$sql="SELECT * FROM student WHERE username='{$username}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_student_id=isset($row['student_id'])?$row['student_id'] :"";
		$userpwd=isset($row['userpwd'])?$row['userpwd'] :"";
		if($db_student_id){
			if($userpwd==$password){
				$sql="UPDATE student set userpwd='{$newpassword}' WHERE student_id='{$db_student_id}'";
				$res=mysql_query($sql,$db);
				if($res){
					$info["errcode"]="0";
					$info["errmsg"]=rawurlencode('密码修改成功');

					$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

					if($log_from_id=='1' && $username!=''){

						$arrlog = array( 
							'cmd' => 'add_log', 
							'log_type_id' => '16', 
							'username' => $username
						); 

						main($db,$filestr,$arrlog);
					}
					elseif($log_from_id=='2' && $username!=''){

						$arrlog = array( 
							'cmd' => 'add_log', 
							'log_type_id' => '30', 
							'username' => $username
						); 

						main($db,$filestr,$arrlog);

					}


				}
				else{
					$info["errmsg"]=rawurlencode('密码修改失败');
				}	

			}
			else{
				$info["errmsg"]=rawurlencode('原密码输入有误，请确认');
			}		
		}
		else{
			$info["errmsg"]=rawurlencode('用户名不存在');
		}
	}
	elseif ($arr['cmd']=='queryzsjj'){
		$user_check=isset($arr['user_check']) ? trim($arr['user_check']) : '';
		$sql="SELECT * FROM zsjj";
		$res=mysql_query($sql,$db);

		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["zsjj_content"]=rawurlencode($row["zsjj_content"]);
			$info["data"][$i]["zsjj"]=rawurlencode($row["zsjj"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
		if($user_check=="1"){
			$info["admin_id"]=$_SESSION['admin_id'];
			$info["admin_type"]=$_SESSION['admin_type'];
		}
	}
	elseif ($arr['cmd']=='queryzxgg'){
		$zxgg_id=isset($arr['zxgg_id']) ? trim($arr['zxgg_id']) : '';
		$sql="";
		
		if ($zxgg_id!='')
		{
			$sql.="and zxgg_id='{$zxgg_id}'";
		}
		$sql="SELECT * FROM zxgg WHERE 1=1 and ifgk=1 ".$sql." order by zxgg_id";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["zxgg_id"]=$row["zxgg_id"];
			$info["data"][$i]["zxgg_title"]=rawurlencode($row["zxgg_title"]);
			$info["data"][$i]["zxgg_content"]=rawurlencode($row["zxgg_content"]);
			$info["data"][$i]["zxgg"]=rawurlencode($row["zxgg"]);
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';
		$username=isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

		if($log_from_id=='1' && $username!=''){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '2', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}


	}
	elseif ($arr['cmd']=='queryzsxw'){
		$zsxw_id=isset($arr['zsxw_id']) ? trim($arr['zsxw_id']) : '';
		$sql="";
		
		if ($zsxw_id!='')
		{
			$sql.="and zsxw_id='{$zsxw_id}'";
		}
		$sql="SELECT * FROM zsxw WHERE 1=1 and ifgk=1 ".$sql." order by zsxw_id";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["zsxw_id"]=$row["zsxw_id"];
			$info["data"][$i]["zsxw_title"]=rawurlencode($row["zsxw_title"]);
			$info["data"][$i]["zsxw_content"]=rawurlencode($row["zsxw_content"]);
			$info["data"][$i]["zsxw"]=rawurlencode($row["zsxw"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='querysybzbh'){
		$sybzbh_time=isset($arr['sybzbh_time']) ? trim($arr['sybzbh_time']) : '';
		$sybzbh_mc=isset($arr['sybzbh_mc']) ? trim($arr['sybzbh_mc']) : '';
		$sybzbh_type=isset($arr['sybzbh_type']) ? trim($arr['sybzbh_type']) : '';
		$sybzbh_type_max=isset($arr['sybzbh_type_max']) ? trim($arr['sybzbh_type_max']) : '';
		
		$sql="";
		$sql2="";
		
		if ($sybzbh_type!='')
		{
			$sql.="and sybzbh_type='{$sybzbh_type}'";
		}		
		
		if ($sybzbh_time!='')
		{
			$sql.="and sybzbh_time='{$sybzbh_time}'";
		}
		if ($sybzbh_mc!='')
		{
			$sql.="and sybzbh_mc='{$sybzbh_mc}'";
		}
		if ($sybzbh_type_max=='1')
		{
			$sql.="and sybzbh_id in (select max(sybzbh_id) as sybzbh_id from sybzbh group by sybzbh_type)";
			$sql2.="sybzbh_type,";
		}
			
		$sql="SELECT * FROM sybzbh WHERE ifgk=1 ".$sql." order by ".$sql2."sybzbh_id";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["sybzbh_id"]=$row["sybzbh_id"];
			$info["data"][$i]["sybzbh_type"]=$row["sybzbh_type"];
			$info["data"][$i]["sybzbh_time"]=$row["sybzbh_time"];
			$info["data"][$i]["sybzbh_mc"]=rawurlencode($row["sybzbh_mc"]);
			$info["data"][$i]["sybzbh_jj"]=rawurlencode($row["sybzbh_jj"]);
			$info["data"][$i]["sybzbh"]=rawurlencode($row["sybzbh"]);
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';
		$username=isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

		if($log_from_id=='1' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '4', 
				'id' => $sybzbh_type, 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
	}
	elseif ($arr['cmd']=='querysybzbhml'){
			
		$sql="SELECT * FROM sybzbh WHERE ifgk=1 group by sybzbh_time,sybzbh_mc";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			//$info["data"][$i]["sybzbh_id"]=$row["sybzbh_id"];
			//$info["data"][$i]["sybzbh_type"]=$row["sybzbh_type"];
			$info["data"][$i]["sybzbh_time"]=$row["sybzbh_time"];
			$info["data"][$i]["sybzbh_mc"]=rawurlencode($row["sybzbh_mc"]);
			//$info["data"][$i]["sybzbh_jj"]=rawurlencode($row["sybzbh_jj"]);
			$info["data"][$i]["sybzbh"]=rawurlencode($row["sybzbh"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='querysyzsxb'){
			
		$sql="SELECT * FROM syzsxb WHERE ifgk=1 order by syzsxb_id";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["syzsxb_id"]=$row["syzsxb_id"];
			$info["data"][$i]["syzsxb_mc"]=rawurlencode($row["syzsxb_mc"]);
			$info["data"][$i]["syzsxb_pic"]=rawurlencode($row["syzsxb_pic"]);
			$info["data"][$i]["syzsxb"]=rawurlencode($row["syzsxb"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='queryyxzp'){
		$yxzp_type=isset($arr['yxzp_type']) ? trim($arr['yxzp_type']) : '';
		$yxzp_type_max=isset($arr['yxzp_type_max']) ? trim($arr['yxzp_type_max']) : '';
		
		$sql="";
		$sql2="";
		
		if ($yxzp_type!='')
		{
			$sql.="and yxzp_type='{$yxzp_type}'";
		}
		if ($yxzp_type_max=='1')
		{
			$sql.="and yxzp_id in (select max(yxzp_id) as yxzp_id from yxzp group by yxzp_type)";
			$sql2.="yxzp_type,";
		}		
			
		$sql="SELECT * FROM yxzp WHERE ifgk=1 ".$sql." order by ".$sql2."yxzp_id";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["yxzp_id"]=$row["yxzp_id"];
			$info["data"][$i]["yxzp_type"]=$row["yxzp_type"];
			$info["data"][$i]["yxzp_time"]=$row["yxzp_time"];
			$info["data"][$i]["yxzp_mc"]=rawurlencode($row["yxzp_mc"]);
			$info["data"][$i]["yxzp_jj"]=rawurlencode($row["yxzp_jj"]);
			$info["data"][$i]["yxzp"]=rawurlencode($row["yxzp"]);
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';
		$username=isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

		if($log_from_id=='1' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '3', 
				'id' => $yxzp_type, 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}

	}
	elseif ($arr['cmd']=='querybmlc'){
		$sql="SELECT * FROM bmlc";
		$res=mysql_query($sql,$db);

		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["bmlc_content"]=rawurlencode($row["bmlc_content"]);
			$info["data"][$i]["bmlc"]=rawurlencode($row["bmlc"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='queryzcfw'){
		$sql="SELECT * FROM zcfw";
		$res=mysql_query($sql,$db);

		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["zcfw_content"]=rawurlencode($row["zcfw_content"]);
			$info["data"][$i]["zcfw"]=rawurlencode($row["zcfw"]);
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';
		$username=isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

		if($log_from_id=='2' && $username!=''){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '31', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
	}
	elseif ($arr['cmd']=='querygy'){
		$sql="SELECT * FROM gy";
		$res=mysql_query($sql,$db);

		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["gy_content"]=rawurlencode($row["gy_content"]);
			$info["data"][$i]["gy"]=rawurlencode($row["gy"]);
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';
		$username=isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

		if($log_from_id=='2' && $username!=''){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '34', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
	}
	elseif ($arr['cmd']=='querykktz'){
		$sql="SELECT * FROM kktz";
		$res=mysql_query($sql,$db);

		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["kktz_content"]=rawurlencode($row["kktz_content"]);
			$info["data"][$i]["kktz"]=rawurlencode($row["kktz"]);
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';
		$username=isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

		if($log_from_id=='2' && $username!=''){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '32', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}

	}
	elseif ($arr['cmd']=='querybj'){
		$sql="SELECT * FROM bj";
		$res=mysql_query($sql,$db);

		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["bj_id"]=rawurlencode($row["bj_id"]);
			$info["data"][$i]["bj_name"]=rawurlencode($row["bj_name"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif($arr['cmd']=='bm'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$username=urldecode($username);
		$sex=isset($arr['sex']) ? trim($arr['sex']) : '';
		$sex=urldecode($sex);
		$birthday=isset($arr['birthday']) ?trim($arr['birthday']): '';
		$parent=isset($arr['parent']) ?trim($arr['parent']): '';
		$parent=urldecode($parent);
		$phone=isset($arr['phone']) ?trim($arr['phone']): '';
		$address=isset($arr['address']) ?trim($arr['address']): '';
		$address=urldecode($address);
		$email=isset($arr['email']) ?trim($arr['email']): '';
		$email=urldecode($email);
		$weibo=isset($arr['weibo']) ?trim($arr['weibo']): '';
		$weibo=urldecode($weibo);
		$qq=isset($arr['qq']) ?trim($arr['qq']): '';
		$qq=urldecode($qq);		
		$nickname=isset($arr['nickname']) ?trim($arr['nickname']): '';
		$nickname=urldecode($nickname);
		$xgjg=isset($arr['xgjg']) ?trim($arr['xgjg']): '';
		$xgjg=urldecode($xgjg);
		$xgpxb=isset($arr['xgpxb']) ?trim($arr['xgpxb']): '';
		$xgpxb=urldecode($xgpxb);
		$xqah=urldecode(isset($arr['xqah']) ?trim($arr['xqah']): '');
		$jrxgzy=urldecode(isset($arr['jrxgzy']) ?trim($arr['jrxgzy']): '');
		$cz=urldecode(isset($arr['cz']) ?trim($arr['cz']): '');
		$qd=urldecode(isset($arr['qd']) ?trim($arr['qd']): '');

		$from=isset($arr['from']) ?trim($arr['from']): '';
		
		if($username==''){
			$info["errmsg"]=rawurlencode('姓名不能为空');
			return $info;
		    
		}
		if($sex==''){
			$info["errmsg"]=rawurlencode('性别不能为空');
			return $info;
		    
		}
		if($birthday==''){
			$info["errmsg"]=rawurlencode('生日不能为空');
			return $info;
		    
		}
		if($parent==''){
			$info["errmsg"]=rawurlencode('父母不能为空');
			return $info;
		    
		}
		if($phone==''){
			$info["errmsg"]=rawurlencode('电话不能为空');
			return $info;
		    
		}
		if($address==''){
			$info["errmsg"]=rawurlencode('地址不能为空');
			return $info;
		    
		}
				
		$sql="SELECT * FROM student WHERE student_name='{$username}' and student_sex='{$sex}' and student_birthday='{$birthday}' and student_parent='{$parent}' and student_phone='{$phone}' and student_address='{$address}' ";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_student_id=$row['student_id']?$row['student_id']:"";
		if($db_student_id==""){
			$sql="insert into student(student_name,userpwd,student_sex,student_birthday,student_parent,student_phone,student_address,student_email,student_weibo,student_qq,student_nickname,student_xgjg,student_xgpxb,student_xqah,student_jrxgzy,student_cz,student_qd) values('{$username}','{$userpwd}','{$sex}','{$birthday}','{$parent}','{$phone}','{$address}','{$email}','{$weibo}','{$qq}','{$nickname}','{$xgjg}','{$xgpxb}','{$xqah}','{$jrxgzy}','{$cz}','{$qd}')";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('报名成功');


				if($from=='web' && $username!='' ){

					$arrlog = array( 
						'cmd' => 'add_log', 
						'log_type_id' => '6', 
						'username' => $username
					); 

					main($db,$filestr,$arrlog);
				}

			}else{
				$info["errmsg"]=rawurlencode('报名失败');
			}	
		}
		else{
			$info["errmsg"]=rawurlencode('该用户已报名，请勿重复');
		}
	}
	elseif($arr['cmd']=='yjfk'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$yjfk_content=isset($arr['yjfk_content']) ?trim($arr['yjfk_content']): '';
		$yjfk_content=urldecode($yjfk_content);
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($yjfk_content==''){
			$info["errmsg"]=rawurlencode('内容不能为空');
			return $info;
		    
		}
		$sql="insert into yjfk(yjfk_content,username,add_time) values('{$yjfk_content}','{$username}','{$nowdatetime}')";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('意见反馈成功');
		}else{
			$info["errmsg"]=rawurlencode('意见反馈失败');
		}	
	}
	elseif ($arr['cmd']=='querykcb'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		
		//$sql="SELECT a.zs_id,b.kc_type,b.kc_name,b.kc_id FROM student_kj a,kc b WHERE a.kc_id=b.kc_id  and a.username='{$username}' order by student_kj_id  desc limit 1";
		$sql="select c.zs_id,d.kc_type,d.kc_name,d.kc_id,e.zk from (select a.username,b.kc_type,b.kc_name,b.kc_id from student a,kc b where a.kc_id=b.kc_id and a.username='{$username}') d left join student_kj c on d.kc_id=c.kc_id and d.username=c.username left join kj e on c.kj_id=e.kj_id order by c.student_kj_id  desc limit 1";
		$res=mysql_query($sql,$db);		
		$row = mysql_fetch_array($res);	
		$i=0;
		$info["data"][$i]["kc_type"]=isset($row["kc_type"]) ? $row["kc_type"] : "";
		$info["data"][$i]["kc_name"]=isset($row["kc_name"]) ? rawurlencode($row["kc_name"]) : "";
		$info["data"][$i]["yskc"]=isset($row["zs_id"]) ? $row["zs_id"] : "";
		$info["data"][$i]["zk"]=isset($row["zs_id"]) ? $row["zk"] : "";
		$zs_id=isset($row["zs_id"]) ? $row["zs_id"] : "";
		$kc_id=isset($row["kc_id"]) ? $row["kc_id"] : "";
		
		$sql="SELECT count(*) as count FROM kj  WHERE kc_id='{$kc_id}'";
			
		$res=mysql_query($sql,$db);		
		$row = mysql_fetch_array($res);	
		
		$count=$row["count"];
		
		$info["data"][$i]["sykc"]=$count-$zs_id;
		$info["data"][$i]["dqkc"]=$zs_id+1;
		
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

		if($log_from_id=='1' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '13', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
		elseif($log_from_id=='2' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '25', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}


	}
	elseif ($arr['cmd']=='addzp'){
		/*$username=isset($arr['username']) ? trim($arr['username']) : '';
		$zp=isset($arr['zp']) ?trim($arr['zp']): '';
		$kj_id=isset($arr['kj_id']) ?trim($arr['kj_id']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($zp==''){
		    $info["errmsg"]=rawurlencode('作品名称不能为空');
			return $info;
		    
		}
		if($filestr==''){
		    $info["errmsg"]=rawurlencode('作品文件不能为空');
			return $info;
		    
		}
		
		$zp_url=makefile(_Upload_File,$username,$zp,$filestr);

		$sql="insert into zp(zp,username,kj_id,add_time) values('{$zp_url}','{$username}','{$kj_id}','{$nowdatetime}')";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('作品上传成功');
		}else{
			$info["errmsg"]=rawurlencode('作品上传失败');
		}*/
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$kj_id=isset($arr['kj_id']) ?trim($arr['kj_id']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($kj_id==''){
		    $info["errmsg"]=rawurlencode('课件id不能为空');
			return $info;
		    
		}
		
		$sql="SELECT count(*) as count FROM zp WHERE username='{$username}' and kj_id='{$kj_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_count=$row['count']?$row['count']:"0";
		
		if($db_count>0){
			$info["errmsg"]=rawurlencode('只能上传一次');
			return $info;
		}
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($filecount==0){
			$info["errmsg"]=rawurlencode('上传文件为空');
			return $info;
		}
		$count=$filecount+$db_count;
		if ($count>3){
			$info["errmsg"]=rawurlencode('超过3个,无法上传成功');
			return $info;
		}
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"zp_".$username."_".$kj_id,$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					$info["errmsg"]=rawurlencode($result["retmsg"]);
					return $info;
				}
				$url=$result["url"];
				$sql="insert into zp(zp,username,kj_id,add_time) values('{$url}','{$username}','{$kj_id}','{$nowdatetime}')";
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					$info["errmsg"]=rawurlencode('作品上传失败');
					return $info;
				}
			}
			$i++;
		}
		
		$info["errcode"]="0";
		$info["errmsg"]=rawurlencode('作品上传成功');

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

		if($log_from_id=='2' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '26', 
				'id' => $kj_id, 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}

	}
	elseif ($arr['cmd']=='addzp2'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$kj_id=isset($arr['kj_id']) ?trim($arr['kj_id']): '';

		if($username==''){
			echo str_replace("%s", '用户名不能为空', $form_file);
			exit;
		    
		}
		if($kj_id==''){
			echo str_replace("%s", '课件id不能为空', $form_file);
			exit;
		    
		}
		
		$sql="SELECT count(*) as count FROM zp WHERE username='{$username}' and kj_id='{$kj_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_count=$row['count']?$row['count']:"0";
		
		if($db_count>0){
			echo str_replace("%s", '只能上传一次', $form_file);
			exit;
		}
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($filecount==0){
			echo str_replace("%s", '上传文件为空', $form_file);
			exit;
		}
		$count=$filecount+$db_count;
		if ($count>3){
			echo str_replace("%s", '超过3个,无法上传成功', $form_file);
			exit;
		}
		
		//$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"zp_".$username."_".$kj_id,$_FILES["files"],$key);
				if($result["retcode"]!="0"){
					echo str_replace("%s", $result["retmsg"], $form_file);
					exit;
				}
				$url=$result["url"];
				$sql="insert into zp(zp,username,kj_id,add_time) values('{$url}','{$username}','{$kj_id}','{$nowdatetime}')";
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					echo str_replace("%s", '作品上传失败', $form_file);
					exit;
				}
			}
			//$i++;
		}
		echo str_replace("%s", '作品上传成功', $form_file);

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

		if($log_from_id=='1' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '10', 
				'id' => $kj_id, 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}


		exit;

	}
	elseif ($arr['cmd']=='queryzp'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$student_id=isset($arr['student_id']) ? trim($arr['student_id']) : '';
		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		if($username=='' && $student_id==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		}
		$sql="";
		
		if ($username!='')
		{
			$sql.="and a.username='{$username}'";
		}

		if($begindate!=""){
			$sql.="and a.add_time>='{$begindate} 00:00:00'";
		}
		
		if($enddate!=""){
			$sql.="and a.add_time<='{$enddate} 23:59:59'";
		}
		
		
		$sql="SELECT a.*,b.admin_name,c.kj_name,c.kc_name FROM zp a left join admin b on a.admin_id=b.admin_id left join (select kj.kj_id,kj.kj_name,kc.kc_id,kc.kc_name from kj , kc where kj.kc_id=kc.kc_id) c on a.kj_id=c.kj_id where 1=1 ".$sql;
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["zp_id"]=$row["zp_id"];
			$info["data"][$i]["zp"]=rawurlencode($row["zp"]);
			$info["data"][$i]["zpdp"]=rawurlencode($row["zpdp"]);
			$info["data"][$i]["zpdp_time"]=rawurlencode($row["zpdp_time"]);
			$info["data"][$i]["admin_id"]=isset($row["admin_id"])?$row["admin_id"]:"";
			$info["data"][$i]["admin_name"]=isset($row["admin_name"])?rawurlencode($row["admin_name"]):"";
			$info["data"][$i]["kj_id"]=isset($row["kj_id"])?rawurlencode($row["kj_id"]):"";
			$info["data"][$i]["kj_name"]=isset($row["kj_name"])?rawurlencode($row["kj_name"]):"";
			$info["data"][$i]["kc_name"]=isset($row["kc_name"])?rawurlencode($row["kc_name"]):"";
			$info["data"][$i]["add_time"]=$row["add_time"];
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

		if($log_from_id=='2' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '24', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
	}
	elseif ($arr['cmd']=='queryzp2'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$student_id=isset($arr['student_id']) ? trim($arr['student_id']) : '';
		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		if($username=='' && $student_id==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		}
		$sql="";
		
		if ($username!='')
		{
			$sql.="and a.username='{$username}'";
		}

		if($begindate!=""){
			$sql.="and a.add_time>='{$begindate} 00:00:00'";
		}
		
		if($enddate!=""){
			$sql.="and a.add_time<='{$enddate} 23:59:59'";
		}
		
		
		$sql="SELECT a.*,b.admin_name,c.kj_name,c.kc_name FROM zp a left join admin b on a.admin_id=b.admin_id left join (select kj.kj_id,kj.kj_name,kc.kc_id,kc.kc_name from kj , kc where kj.kc_id=kc.kc_id) c on a.kj_id=c.kj_id where 1=1 ".$sql."order by a.add_time desc,a.username";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["zp_id"]=$row["zp_id"];
			$info["data"][$i]["zp"]=rawurlencode($row["zp"]);
			$info["data"][$i]["zpdp"]=rawurlencode($row["zpdp"]);
			$info["data"][$i]["zpdp_time"]=rawurlencode($row["zpdp_time"]);
			$info["data"][$i]["admin_id"]=isset($row["admin_id"])?$row["admin_id"]:"";
			$info["data"][$i]["admin_name"]=isset($row["admin_name"])?rawurlencode($row["admin_name"]):"";
			$info["data"][$i]["kj_id"]=isset($row["kj_id"])?rawurlencode($row["kj_id"]):"";
			$info["data"][$i]["kj_name"]=isset($row["kj_name"])?rawurlencode($row["kj_name"]):"";
			$info["data"][$i]["kc_name"]=isset($row["kc_name"])?rawurlencode($row["kc_name"]):"";
			$info["data"][$i]["add_time"]=$row["add_time"];
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

		if($log_from_id=='2' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '24', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
	}
	elseif ($arr['cmd']=='querykc'){
		
		$sql="SELECT * FROM kc order by kc_id";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["kc_id"]=$row["kc_id"];
			$info["data"][$i]["kc_name"]=rawurlencode($row["kc_name"]);
			$info["data"][$i]["kc_type"]=$row["kc_type"]?$row["kc_type"]:"";
			$info["data"][$i]["kc_js"]=rawurlencode($row["kc_js"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='querykcmx'){
		$kc_id=isset($arr['kc_id']) ? trim($arr['kc_id']) : '';
		if($kc_id==''){
			$info["errmsg"]=rawurlencode('课程id不能为空');
			return $info;
		    
		}
		
		$sql="SELECT a.*,b.kc_name,b.kc_type,b.kc_js FROM kj a ,kc b where a.kc_id=b.kc_id  and a.kc_id='{$kc_id}' order by a.kc_id,a.zs_id";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["kj_id"]=$row["kj_id"];
			$info["data"][$i]["kj_name"]=rawurlencode($row["kj_name"]);
			$info["data"][$i]["kj"]=rawurlencode($row["kj"]);
			$info["data"][$i]["zk"]=rawurlencode($row["zk"]);
			$info["data"][$i]["kj_js"]=rawurlencode($row["kj_js"]);
			$info["data"][$i]["zs_id"]=rawurlencode($row["zs_id"]);		
			$info["data"][$i]["kc_type"]=$row["kc_type"]?rawurlencode($row["kc_type"]):"";
			$info["data"][$i]["kc_name"]=rawurlencode($row["kc_name"]);
			$info["data"][$i]["kc_js"]=rawurlencode($row["kc_js"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='querykcmxb'){
		
		$sql="SELECT a.*,b.kc_name,b.kc_type FROM kj a ,kc b where a.kc_id=b.kc_id order by a.kc_id,a.zs_id";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["kj_id"]=$row["kj_id"];
			$info["data"][$i]["kj_name"]=rawurlencode($row["kj_name"]);
			$info["data"][$i]["zs_id"]=rawurlencode($row["zs_id"]);	
			$info["data"][$i]["kc_id"]=rawurlencode($row["kc_id"]);		
			$info["data"][$i]["kc_name"]=rawurlencode($row["kc_name"]);
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='studentkj_qx'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$kc_id=isset($arr['kc_id']) ? trim($arr['kc_id']) : '';
		$kj_id=isset($arr['kj_id']) ? trim($arr['kj_id']) : '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($kc_id==''){
			$info["errmsg"]=rawurlencode('课程id不能为空');
			return $info;
		    
		}
		if($kj_id==''){
			$info["errmsg"]=rawurlencode('课件id不能为空');
			return $info;
		    
		}
		
		$sql="SELECT * FROM student WHERE username='{$username}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_ifsd=$row["ifsd"];
		$db_kc_id=isset($row["kc_id"]) ? $row["kc_id"] : "";
		$db_qs_zs_id=isset($row["qs_zs_id"]) ? $row["qs_zs_id"] : "1";
		
		if ($db_ifsd=="0"){
			if($kc_id==$db_kc_id){	
				$sql="SELECT kj_id,add_time,zs_id FROM student_kj WHERE username='{$username}' and kc_id='{$kc_id}' order by zs_id desc limit 1";
				$res=mysql_query($sql,$db);
				$row = mysql_fetch_array($res);
				$db_kj_id=isset($row["kj_id"]) ? $row["kj_id"] : "";
				$db_add_time=isset($row["add_time"]) ? $row["add_time"] : "";
				//$zs_id=isset($row["zs_id"]) ? $row["zs_id"] : "0";
				if ($db_kj_id!=$kj_id){	
					$sql="SELECT a.*,b.zs_id as zs_id_2 FROM (select kj.*,zp.zp_id,zp.username,min(zp.add_time) as zp_time ,d.add_time as xx_time from kj kj left join zp zp on kj.kj_id=zp.kj_id and kj.kj_id='{$db_kj_id}' and zp.username='{$username}' left join student_kj d on kj.kj_id=d.kj_id where kj.kj_id='{$db_kj_id}' and d.username='{$username}') a,(select * from kj where kj_id='{$kj_id}') b ";
					

					$res=mysql_query($sql,$db);
					$row = mysql_fetch_array($res);

					$db_zs_id_1=isset($row["zs_id"]) ? $row["zs_id"] : "0";
					$db_zp_id_1=isset($row["zp_id"]) ? $row["zp_id"] :"";
					$db_xx_time_1=isset($row["xx_time"]) ? $row["xx_time"] :"";
					$db_zp_time_1=isset($row["zp_time"]) ? $row["zp_time"] :"";
				
				
					$db_zs_id_2=isset($row["zs_id_2"]) ? $row["zs_id_2"] : "0";
					
					$info["num"]=(strtotime($nowdatetime)-strtotime($db_xx_time_1))/(2*24*3600);
												
					if ($db_qs_zs_id=="1"){
						if(($db_zs_id_1+1)==$db_zs_id_2){
							if($db_zs_id_2!=$db_qs_zs_id){
								if($db_zp_id_1!=""){			
									if ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<3*24*60*60){
										$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
										return $info;
								
									}
									/*elseif(((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=3*24*60*60) and ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<7*24*60*60)){
										$zs_id_3=$db_zs_id_1-1;
										if($zs_id_3>0){
											$sql="select kj.*,zp.zp_id,zp.username,min(zp.add_time) as zp_time ,d.add_time as xx_time from kj kj left join zp zp on kj.kj_id=zp.kj_id and kj.kj_id='{$db_kj_id}' and zp.username='{$username}' left join student_kj d on kj.kj_id=d.kj_id where kj.kj_id='{$db_kj_id}' and d.username='{$username}'";
											$res=mysql_query($sql,$db);
											$row = mysql_fetch_array($res);
											$db_zs_id_3=isset($row["zs_id"]) ? $row["zs_id"] : "0";
											$db_zp_id_3=isset($row["zp_id"]) ? $row["zp_id"] :"";
											$db_xx_time_3=isset($row["xx_time"]) ? $row["a.xx_time"] :"";
											$db_zp_time_3=isset($row["zp_time"]) ? $row["a.zp_time"] :"";
											if(((strtotime($db_zp_time_3)-strtotime($db_xx_time_3))<3*24*60*60) and ((strtotime($db_zp_time_1)-strtotime($db_xx_time_1))<3*24*60*60)){
												$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
												$res=mysql_query($sql,$db);
												if($res){
													$info["errcode"]="0";
													$info["errmsg"]=rawurlencode('可以查看');
												}else{
													$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
												}
											}
											else{
												$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
												return $info;
											}
									
										}
										else{
											$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
											return $info;
										}
									}*/
									elseif(((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=3*24*60*60) and ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<15*24*60*60)){
										$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
										$res=mysql_query($sql,$db);
										if($res){
											$info["errcode"]="0";
											$info["errmsg"]=rawurlencode('可以查看');

											$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

											if($log_from_id=='1' && $username!='' ){

												$arrlog = array( 
													'cmd' => 'add_log', 
													'log_type_id' => '9', 
													'id' => $kj_id, 
													'username' => $username
												); 

												main($db,$filestr,$arrlog);
											}
											elseif($log_from_id=='2' && $username!='' ){

												$arrlog = array( 
													'cmd' => 'add_log', 
													'log_type_id' => '35', 
													'id' => $kj_id, 
													'username' => $username
												); 

												main($db,$filestr,$arrlog);
											}
										}else{
											$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
										}
								
									}
									elseif((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=15*24*60*60){
										$sql="update student  set ifsd='1' WHERE username='{$username}'";
										$res=mysql_query($sql,$db);
										$info["errmsg"]=rawurlencode('该账户已经被锁定，请联系管理员');
										return $info;
									}
								}
								else{
									$info["errmsg"]=rawurlencode('请先提交作业');
									return $info;
								}
							}
							else{
								$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
								$res=mysql_query($sql,$db);
								if($res){
									$info["errcode"]="0";
									$info["errmsg"]=rawurlencode('可以查看');
									$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

									if($log_from_id=='1' && $username!='' ){

										$arrlog = array( 
											'cmd' => 'add_log', 
											'log_type_id' => '9', 
											'id' => $kj_id, 
											'username' => $username
										); 

										main($db,$filestr,$arrlog);
									}
									elseif($log_from_id=='2' && $username!='' ){

										$arrlog = array( 
											'cmd' => 'add_log', 
											'log_type_id' => '35', 
											'id' => $kj_id, 
											'username' => $username
										); 

										main($db,$filestr,$arrlog);
									}
								}else{
									$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
								}
							}
					
						}
						else{
							$info["errmsg"]=rawurlencode('不在指定时间内，不能查看');
						}
					}
					else{
						if($db_zs_id_1!="0"){
							if(($db_zs_id_1+1)==$db_zs_id_2){
								if($db_zs_id_2!=$db_qs_zs_id){
									if($db_zp_id_1!=""){			
										if ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<3*24*60*60){
											$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
											return $info;
							
										}
										/*elseif(((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=3*24*60*60) and ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<7*24*60*60)){
											$zs_id_3=$db_zs_id_1-1;
											if($zs_id_3>0){
												$sql="select kj.*,zp.zp_id,zp.username,min(zp.add_time) as zp_time ,d.add_time as xx_time from kj kj left join zp zp on kj.kj_id=zp.kj_id and kj.kj_id='{$db_kj_id}' and zp.username='{$username}' left join student_kj d on kj.kj_id=d.kj_id where kj.kj_id='{$db_kj_id}' and d.username='{$username}'";
												$res=mysql_query($sql,$db);
												$row = mysql_fetch_array($res);
												$db_zs_id_3=isset($row["zs_id"]) ? $row["zs_id"] : "0";
												$db_zp_id_3=isset($row["zp_id"]) ? $row["zp_id"] :"";
												$db_xx_time_3=isset($row["xx_time"]) ? $row["a.xx_time"] :"";
												$db_zp_time_3=isset($row["zp_time"]) ? $row["a.zp_time"] :"";
												if(((strtotime($db_zp_time_3)-strtotime($db_xx_time_3))<3*24*60*60) and ((strtotime($db_zp_time_1)-strtotime($db_xx_time_1))<3*24*60*60)){
													$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
													$res=mysql_query($sql,$db);
													if($res){
														$info["errcode"]="0";
														$info["errmsg"]=rawurlencode('可以查看');
													}else{
														$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
													}
												}
												else{
													$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
													return $info;
												}
								
											}
											else{
												$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
												return $info;
											}
										}*/
										elseif(((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=3*24*60*60) and ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<15*24*60*60)){
											$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
											$res=mysql_query($sql,$db);
											if($res){
												$info["errcode"]="0";
												$info["errmsg"]=rawurlencode('可以查看');

												$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

												if($log_from_id=='1' && $username!='' ){

													$arrlog = array( 
														'cmd' => 'add_log', 
														'log_type_id' => '9', 
														'id' => $kj_id, 
														'username' => $username
													); 

													main($db,$filestr,$arrlog);
												}
												elseif($log_from_id=='2' && $username!='' ){

													$arrlog = array( 
														'cmd' => 'add_log', 
														'log_type_id' => '35', 
														'id' => $kj_id, 
														'username' => $username
													); 

													main($db,$filestr,$arrlog);
												}

											}else{
												$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
											}
							
										}
										elseif((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=15*24*60*60){
											$sql="update student  set ifsd='1' WHERE username='{$username}'";
											$res=mysql_query($sql,$db);
											$info["errmsg"]=rawurlencode('该账户已经被锁定，请联系管理员');
											return $info;
										}
									}
									else{
										$info["errmsg"]=rawurlencode('请先提交作业');
										return $info;
									}
								}
								else{
									$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
									$res=mysql_query($sql,$db);
									if($res){
										$info["errcode"]="0";
										$info["errmsg"]=rawurlencode('可以查看');

										$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

										if($log_from_id=='1' && $username!='' ){

											$arrlog = array( 
												'cmd' => 'add_log', 
												'log_type_id' => '9', 
												'id' => $kj_id, 
												'username' => $username
											); 

											main($db,$filestr,$arrlog);
										}
										elseif($log_from_id=='2' && $username!='' ){

											$arrlog = array( 
												'cmd' => 'add_log', 
												'log_type_id' => '35', 
												'id' => $kj_id, 
												'username' => $username
											); 

											main($db,$filestr,$arrlog);
										}
									}else{
										$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
									}
								}
							}
							else{
								$info["errmsg"]=rawurlencode('不在指定时间内，不能查看');
							}	
						}
						else{
							if($db_zs_id_2!=$db_qs_zs_id){
								if($db_zp_id_1!=""){			
									if ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<3*24*60*60){
										$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
										return $info;
						
									}
									/*elseif(((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=3*24*60*60) and ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<7*24*60*60)){
										$zs_id_3=$db_zs_id_1-1;
										if($zs_id_3>0){
											$sql="select kj.*,zp.zp_id,zp.username,min(zp.add_time) as zp_time ,d.add_time as xx_time from kj kj left join zp zp on kj.kj_id=zp.kj_id and kj.kj_id='{$db_kj_id}' and zp.username='{$username}' left join student_kj d on kj.kj_id=d.kj_id where kj.kj_id='{$db_kj_id}' and d.username='{$username}'";
											$res=mysql_query($sql,$db);
											$row = mysql_fetch_array($res);
											$db_zs_id_3=isset($row["zs_id"]) ? $row["zs_id"] : "0";
											$db_zp_id_3=isset($row["zp_id"]) ? $row["zp_id"] :"";
											$db_xx_time_3=isset($row["xx_time"]) ? $row["a.xx_time"] :"";
											$db_zp_time_3=isset($row["zp_time"]) ? $row["a.zp_time"] :"";
											if(((strtotime($db_zp_time_3)-strtotime($db_xx_time_3))<3*24*60*60) and ((strtotime($db_zp_time_1)-strtotime($db_xx_time_1))<3*24*60*60)){
												$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
												$res=mysql_query($sql,$db);
												if($res){
													$info["errcode"]="0";
													$info["errmsg"]=rawurlencode('可以查看');
												}else{
													$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
												}
											}
											else{
												$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
												return $info;
											}
							
										}
										else{
											$info["errmsg"]=rawurlencode('不在指定时间内,请别着急');
											return $info;
										}
									}*/
									elseif(((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=3*24*60*60) and ((strtotime($nowdatetime)-strtotime($db_xx_time_1))<15*24*60*60)){
										$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
										$res=mysql_query($sql,$db);
										if($res){
											$info["errcode"]="0";
											$info["errmsg"]=rawurlencode('可以查看');

											$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

											if($log_from_id=='1' && $username!='' ){

												$arrlog = array( 
													'cmd' => 'add_log', 
													'log_type_id' => '9', 
													'id' => $kj_id, 
													'username' => $username
												); 

												main($db,$filestr,$arrlog);
											}
											elseif($log_from_id=='2' && $username!='' ){

												$arrlog = array( 
													'cmd' => 'add_log', 
													'log_type_id' => '35', 
													'id' => $kj_id, 
													'username' => $username
												); 

												main($db,$filestr,$arrlog);
											}
										}else{
											$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
										}
						
									}
									elseif((strtotime($nowdatetime)-strtotime($db_xx_time_1))>=15*24*60*60){
										$sql="update student  set ifsd='1' WHERE username='{$username}'";
										$res=mysql_query($sql,$db);
										$info["errmsg"]=rawurlencode('该账户已经被锁定，请联系管理员');
										return $info;
									}
								}
								else{
									$info["errmsg"]=rawurlencode('请先提交作业');
									return $info;
								}
							}
							else{
								$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
								$res=mysql_query($sql,$db);
								if($res){
									$info["errcode"]="0";
									$info["errmsg"]=rawurlencode('可以查看');

									$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

									if($log_from_id=='1' && $username!='' ){

										$arrlog = array( 
											'cmd' => 'add_log', 
											'log_type_id' => '9', 
											'id' => $kj_id, 
											'username' => $username
										); 

										main($db,$filestr,$arrlog);
									}
									elseif($log_from_id=='2' && $username!='' ){

										$arrlog = array( 
											'cmd' => 'add_log', 
											'log_type_id' => '35', 
											'id' => $kj_id, 
											'username' => $username
										); 

										main($db,$filestr,$arrlog);
									}
								}else{
									$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
								}
							}
						}	
					}
			
			
				}
				else{
					if((strtotime($nowdatetime)-strtotime($db_add_time))>=2*24*60*60){
						$info["errmsg"]=rawurlencode('已经超过48小时有效期，不能查看');
					}
					else{
						$info["errcode"]="0";
						$info["errmsg"]=rawurlencode('可以查看');
					}
			
				}
			}
			else{
				$info["errmsg"]=rawurlencode('不在指定时间内，不能查看');
			}
		}
		elseif($db_ifsd=="2"){
			if($kc_id==$db_kc_id){	
				$sql="SELECT zs_id,add_time,kj_id FROM student_kj WHERE username='{$username}' and kc_id='{$kc_id}' order by zs_id desc limit 1";
				$res=mysql_query($sql,$db);
				$row = mysql_fetch_array($res);
				$db_kj_id=isset($row["kj_id"]) ? $row["kj_id"] : "";
				$db_add_time=isset($row["add_time"]) ? $row["add_time"] : "";
				$zs_id=isset($row["zs_id"]) ? $row["zs_id"] : "0";
				if ($db_kj_id!=$kj_id){	
					$sql="";
					$sql="SELECT a.*,b.zs_id as zs_id_2 FROM (select kj.*,zp.zp_id,zp.username,min(zp.add_time) as zp_time ,d.add_time as xx_time from kj kj left join zp zp on kj.kj_id=zp.kj_id and kj.kj_id='{$db_kj_id}' and zp.username='{$username}' left join student_kj d on kj.kj_id=d.kj_id where kj.kj_id='{$db_kj_id}' and d.username='{$username}') a,(select * from kj where kj_id='{$kj_id}') b ";
					$res=mysql_query($sql,$db);
					$row = mysql_fetch_array($res);

					$db_zs_id_1=isset($row["zs_id"]) ? $row["zs_id"] : "0";
					$db_zp_id_1=isset($row["zp_id"]) ? $row["zp_id"] :"";
					$db_xx_time_1=isset($row["xx_time"]) ? $row["xx_time"] :"";
					$db_zp_time_1=isset($row["zp_time"]) ? $row["zp_time"] :"";
			
					$db_zs_id_2=isset($row["zs_id_2"]) ? $row["zs_id_2"] : "0";
			
			
					if(($db_zs_id_1+1)==$db_zs_id_2){
						if($db_zs_id_1!=""){			
							$sql="insert into student_kj(kj_id,kc_id,zs_id,username,add_time) values('{$kj_id}','{$kc_id}','{$db_zs_id_2}','{$username}','{$nowdatetime}')";
							$res=mysql_query($sql,$db);
							if($res){
								$info["errcode"]="0";
								$info["errmsg"]=rawurlencode('可以查看');
						
								$sql="update student  set ifsd='0' WHERE username='{$username}'";
								$res=mysql_query($sql,$db);

								$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

								if($log_from_id=='1' && $username!='' ){

									$arrlog = array( 
										'cmd' => 'add_log', 
										'log_type_id' => '9', 
										'id' => $kj_id, 
										'username' => $username
									); 

									main($db,$filestr,$arrlog);
								}
								elseif($log_from_id=='2' && $username!='' ){

									$arrlog = array( 
										'cmd' => 'add_log', 
										'log_type_id' => '35', 
										'id' => $kj_id, 
										'username' => $username
									); 

									main($db,$filestr,$arrlog);
								}
						
							}else{
								$info["errmsg"]=rawurlencode('用户课件添加失败，不能查看');
							}
						}
						else{
							$info["errmsg"]=rawurlencode('请先提交作业');
							return $info;
						}
				
					}
					else{
						$info["errmsg"]=rawurlencode('不在指定时间内，不能查看');
					}
		
		
				}
				else{
					$info["errmsg"]=rawurlencode('不在指定时间内，不能查看');	
				}
			}
			else{
				$info["errmsg"]=rawurlencode('不在指定时间内，不能查看');	
			}	
		}
		elseif($db_ifsd=="3"){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('可以查看');

			$sql="update student  set ifsd='0' WHERE username='{$username}'";
			$res=mysql_query($sql,$db);

			$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

			if($log_from_id=='1' && $username!='' ){

				$arrlog = array( 
					'cmd' => 'add_log', 
					'log_type_id' => '9', 
					'id' => $kj_id, 
					'username' => $username
				); 

				main($db,$filestr,$arrlog);
			}
			elseif($log_from_id=='2' && $username!='' ){

				$arrlog = array( 
					'cmd' => 'add_log', 
					'log_type_id' => '35', 
					'id' => $kj_id, 
					'username' => $username
				); 

				main($db,$filestr,$arrlog);
			}
		}
		else
		{
			$info["errmsg"]=rawurlencode('用户已经锁定，请联系管理员');
		}
		
		/*$info["errcode"]="0";
		$info["errmsg"]=rawurlencode('可以查看');*/
	}	
	elseif ($arr['cmd']=='addbzbh'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$bzbh_time=isset($arr['bzbh_time']) ?trim($arr['bzbh_time']): '';
		$bzbh_mc=isset($arr['bzbh_mc']) ?trim($arr['bzbh_mc']): '';
		$bzbh_jj=isset($arr['bzbh_jj']) ?trim($arr['bzbh_jj']): '';
		$ifgk=isset($arr['ifgk']) ?trim($arr['ifgk']): '1';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($bzbh_time==''){
		    $info["errmsg"]=rawurlencode('时间不能为空');
			return $info;
		    
		}
		if($bzbh_mc==''){
		    $info["errmsg"]=rawurlencode('名称不能为空');
			return $info;
		    
		}
		if($bzbh_jj==''){
		    $info["errmsg"]=rawurlencode('简介不能为空');
			return $info;
		    
		}
		
		$sql="SELECT count(*) as count FROM bzbh WHERE username='{$username}' and bzbh_time='{$bzbh_time}'  and bzbh_mc='{$bzbh_mc}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_count=$row['count']?$row['count']:"0";
		
		if ($db_count>0){
			$info["errmsg"]=rawurlencode('只能上传一次');
			return $info;
		}
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($filecount==0){
			$info["errmsg"]=rawurlencode('上传文件为空');
			return $info;
		}
		$count=$filecount+$db_count;
		if ($count>8){
			$info["errmsg"]=rawurlencode('超过8个,无法上传成功');
			return $info;
		}
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"bzbh_".$username."_".$bzbh_mc."_".$bzbh_time,$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					$info["errmsg"]=rawurlencode($result["retmsg"]);
					return $info;
				}
				$url=$result["url"];
				$sql="insert into bzbh(bzbh_type,bzbh_time,bzbh_mc,bzbh_jj,bzbh,username,ifgk) values('1','{$bzbh_time}','{$bzbh_mc}','{$bzbh_jj}','{$url}','{$username}','{$ifgk}')";
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					$info["errmsg"]=rawurlencode('边走边画上传失败');
					return $info;
				}
			}
			$i++;
		}
		
		$info["errcode"]="0";
		$info["errmsg"]=rawurlencode('边走边画上传成功');

	}
	elseif ($arr['cmd']=='querybzbh'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';

		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}

		if($begindate!=""){
			$sql.="and bzbh_time>='{$begindate}'";
		}
	
		if($enddate!=""){
			$sql.="and bzbh_time<='{$enddate}'";
		}
		
		$sql="SELECT * FROM bzbh WHERE username='{$username}' ".$sql." order by bzbh_id";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["bzbh_id"]=$row["bzbh_id"];
			$info["data"][$i]["bzbh_type"]=$row["bzbh_type"];
			$info["data"][$i]["bzbh_time"]=$row["bzbh_time"];
			$info["data"][$i]["bzbh_mc"]=rawurlencode($row["bzbh_mc"]);
			$info["data"][$i]["bzbh_jj"]=rawurlencode($row["bzbh_jj"]);
			$info["data"][$i]["bzbh"]=rawurlencode($row["bzbh"]);
			$info["data"][$i]["ifgk"]=$row["ifgk"];		
			$i=$i+1;
		}
		
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='queryzsxb'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}		
		//$sql="SELECT * FROM zsxb  where username='{$username}' order by zsxb_id";
		$sql="SELECT * FROM zsxb  where 1=1 order by zsxb_id";
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["zsxb_id"]=$row["zsxb_id"];		
			$info["data"][$i]["zsxb"]=rawurlencode($row["zsxb"]);
			$info["data"][$i]["zsxb_mc"]=rawurlencode($row["zsxb_mc"]);
			$info["data"][$i]["zsxb_date"]=rawurlencode($row["zsxb_date"]);
			$info["data"][$i]["zsxb_pic"]=rawurlencode($row["zsxb_pic"]);
			$info["data"][$i]["ifgk"]=$row["ifgk"];
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='querytlhy'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
				
		$sql="SELECT * FROM student  where username='{$username}'";			
		$res=mysql_query($sql,$db);
		$row =mysql_fetch_array($res);
		$birthday=$row["student_birthday"];
		$year=substr($birthday,0,4);
		
		$sql="SELECT a.*,b.zp,c.bzbh FROM student a,zp b,bzbh c where a.username=b.username and b.username=c.username and a.student_birthday like '{$year}%' and a.username!='{$username}' group by a.username";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);		
			$info["data"][$i]["birthday"]=$row["student_birthday"];
			$info["data"][$i]["address"]=rawurlencode($row["student_address"]);
			$info["data"][$i]["zp"]=rawurlencode($row["zp"]);
			$info["data"][$i]["bzbh"]=rawurlencode($row["bzbh"]);
			$info["data"][$i]["username"]=rawurlencode($row["username"]);	
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='queryjs'){
	
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		
		$sql="SELECT * FROM student where username='{$username}'";			
		$res=mysql_query($sql,$db);
		$row =mysql_fetch_array($res);
		$admin_id=$row["admin_id"];
				
		$sql="SELECT a.*,b.pj_type FROM admin a left join (select * from pj where username='{$username}') b on a.admin_id=b.admin_id where a.admin_type='2'";			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["admin_id"]=$row["admin_id"];
			$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
			$info["data"][$i]["admin_grjs"]=rawurlencode($row["admin_grjs"]);		
			$info["data"][$i]["admin_pic"]=rawurlencode($row["admin_pic"]);
			$info["data"][$i]["pj_type"]=isset($row["pj_type"]) ? $row["pj_type"] : "";
			
			$info["data"][$i]["ifgz"]=($row["admin_id"]==$admin_id)?"1" : "0";			
			
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='addpj'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$admin_id=isset($arr['admin_id']) ?trim($arr['admin_id']): '';
		$pj_type=isset($arr['pj_type']) ?trim($arr['pj_type']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($admin_id==''){
		    $info["errmsg"]=rawurlencode('老师id不能为空');
			return $info;
		    
		}
		if($pj_type==''){
		    $info["errmsg"]=rawurlencode('评价类型不能为空');
			return $info;
		    
		}
		$sql="";
		if ($pj_type==0){
			$sql="update student set admin_id='{$admin_id}' where username='{$username}'";
		}
		elseif($pj_type==1){
			$sql="update student set admin_id='' where username='{$username}'";
		}
		else{
			$sql="SELECT * FROM pj where username='{$username}' and admin_id='{$admin_id}'";			
			$res=mysql_query($sql,$db);
			$row = mysql_fetch_array($res);
			
			$pj_id=$row["pj_id"]?$row["pj_id"]:"";
			if($pj_id!=""){
				$sql="update pj set pj_type='{$pj_type}' where pj_id='{$pj_id}'";
			}
			else{
				$sql="insert into pj(username,admin_id,pj_type) values('{$username}','{$admin_id}','{$pj_type}')";
			}
		
			
		}
		
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('评价成功');
		}else{
			$info["errmsg"]=rawurlencode('评价失败');
		}

	}
	elseif ($arr['cmd']=='addpj_2'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$admin_list=isset($arr['admin_list']) ?trim($arr['admin_list']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($admin_list==''){
		    $info["errmsg"]=rawurlencode('评价不能为空');
			return $info;
		    
		}

		$admin_array=explode("|",$admin_list);

		foreach($admin_array as $key=>$value){
			$admin_mx=explode("/",$value);
			$admin_id=$admin_mx[0];
			$ifgz=$admin_mx[1];
			$pj_type=$admin_mx[2];

			$sql="";
			if ($ifgz==1){
				$sql="update student set admin_id='{$admin_id}' where username='{$username}'";
				$res=mysql_query($sql,$db);
			}
			
			$sql="";
			if($pj_type!="")
			{
				$sql="SELECT * FROM pj where username='{$username}' and admin_id='{$admin_id}'";			
				$res=mysql_query($sql,$db);
				$row = mysql_fetch_array($res);
				
				$pj_id=$row["pj_id"]?$row["pj_id"]:"";
				if($pj_id!=""){
					$sql="update pj set pj_type='{$pj_type}' where pj_id='{$pj_id}'";
				}
				else{
					$sql="insert into pj(username,admin_id,pj_type) values('{$username}','{$admin_id}','{$pj_type}')";
				}
			
				$res=mysql_query($sql,$db);
			}
			
		}

		$info["errcode"]="0";
		$info["errmsg"]=rawurlencode('评价成功');

	}
	elseif ($arr['cmd']=='querystudent'){
	
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}

		$sql="SELECT a.*,b.zpcount,c.bzbhcount from student a,(select count(*) as zpcount from zp where username='{$username}') b,(select count(*) as bzbhcount from bzbh where username='{$username}') c where a.username='{$username}'";			
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["username"]=$row["username"];
			$info["data"][$i]["rx_time"]=rawurlencode($row["rx_time"]);		
			$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);
			$info["data"][$i]["kc_id"]=$row["kc_id"];
			$info["data"][$i]["zpcount"]=$row["zpcount"];
			$info["data"][$i]["bzbhcount"]=$row["bzbhcount"];
			
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='querypj'){
	
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		
		$sql="SELECT * FROM pj where username='{$username}' order by pj_id desc";			
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["pj_id"]=$row["pj_id"];
			$info["data"][$i]["username"]=rawurlencode($row["username"]);		
			$info["data"][$i]["admin_id"]=rawurlencode($row["admin_id"]);
			$info["data"][$i]["pj_type"]=$row["pj_type"];
			
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	//----------------two --------------
	elseif ($arr['cmd']=='querytz'){
		$tz_id=isset($arr['tz_id']) ? trim($arr['tz_id']) : '';
		
		$sql="";
		if($tz_id!=""){
			$sql.="and tz_id ='{$tz_id}'";
		}
				
		$sql="SELECT * FROM tz where 1=1 ".$sql." order by tz_id desc limit 1";			
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["tz_id"]=$row["tz_id"];
			$info["data"][$i]["tz_title"]=rawurlencode($row["tz_title"]);		
			$info["data"][$i]["tz_content"]=rawurlencode($row["tz_content"]);
			$info["data"][$i]["tz_time"]=$row["tz_time"];
			
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='addtz'){
		$tz_title=isset($arr['tz_title']) ?trim($arr['tz_title']): '';
		$tz_content=isset($arr['tz_content']) ?trim($arr['tz_content']): '';

		if($tz_title==''){
			$info["errmsg"]=rawurlencode('通知标题不能为空');
			return $info;
		    
		}
		if($tz_content==''){
		    $info["errmsg"]=rawurlencode('通知内容不能为空');
			return $info;
		    
		}

		$sql="insert into tz(tz_title,tz_content,tz_time) values('{$tz_title}','{$tz_content}','{$nowdatetime}')";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('通知添加成功');
		}else{
			$info["errmsg"]=rawurlencode('通知添加失败');
		}		

	}
	elseif ($arr['cmd']=='addgz'){
		$username=isset($arr['username']) ?trim($arr['username']): '';
		$gz_username=isset($arr['gz_username']) ?trim($arr['gz_username']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($gz_username==''){
		    $info["errmsg"]=rawurlencode('被关注学生用户名不能为空');
			return $info;
		    
		}
		$sql="SELECT * FROM hygz where username='{$username}' and gz_username='{$gz_username}'";			
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$hygz_id=$row["hygz_id"]?$row["hygz_id"]:"";
		if($hygz_id==""){
			$sql="insert into hygz(username,gz_username) values('{$username}','{$gz_username}')";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('关注成功');
			}else{
				$info["errmsg"]=rawurlencode('关注失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('不能重复关注');
		}		

	}
	elseif ($arr['cmd']=='delgz'){
		$username=isset($arr['username']) ?trim($arr['username']): '';
		$gz_username=isset($arr['gz_username']) ?trim($arr['gz_username']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($gz_username==''){
		    $info["errmsg"]=rawurlencode('被关注学生用户名不能为空');
			return $info;
		    
		}
		$sql="SELECT * FROM hygz where username='{$username}' and gz_username='{$gz_username}'";			
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$hygz_id=$row["hygz_id"]?$row["hygz_id"]:"";
		if($hygz_id!=""){
			$sql="delete from hygz where hygz_id='{$hygz_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('取消关注成功');
			}else{
				$info["errmsg"]=rawurlencode('取消关注失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('没有该关注，不能取消');
		}		

	}
	elseif ($arr['cmd']=='querybirthday'){
		$sql="select student_birthday from student group by student_birthday";
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["student_birthday"]=rawurlencode($row["student_birthday"]);			
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='queryaddress'){
		$sql="select student_address from student group by student_address";
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["student_address"]=rawurlencode($row["student_address"]);			
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='queryhy'){
		$username=isset($arr['username']) ?trim($arr['username']): '';
		$student_birthday=isset($arr['student_birthday']) ?trim($arr['student_birthday']): '';
		$student_address=isset($arr['student_address']) ?trim($arr['student_address']): '';
		$ifgz=isset($arr['ifgz']) ? trim($arr['ifgz']) : '';
		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		}
		
		$sql="";
		
		if($ifgz=="1"){
			$sql.="and e.hygz_id is not null";
		}
		elseif($ifgz=="0"){
			$sql.="and e.hygz_id is null";
		}
		
		if($student_birthday!=""){
			$sql.="and d.student_birthday like '%{$student_birthday}%'";
		}
		if($student_address!=""){
			$sql.="and d.student_address = '{$student_address}'";
		}
		$sql="SELECT d.*,e.hygz_id FROM (select a.*,b.zp,c.bzbh from student a left join zp b on a.username=b.username left join bzbh c on a.username=c.username group by a.username) d left join  (select * from hygz where username='{$username}' ) e on d.username=e.gz_username where d.username!='{$username}' ".$sql." order by d.username ";			
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["username"]=rawurlencode($row["username"]);		
			$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);
			$info["data"][$i]["student_birthday"]=rawurlencode($row["student_birthday"]);
			$info["data"][$i]["student_address"]=rawurlencode($row["student_address"]);
			$info["data"][$i]["zp"]=rawurlencode($row["zp"]);
			$info["data"][$i]["bzbh"]=rawurlencode($row["bzbh"]);
			$info["data"][$i]["ifgz"]=$row["hygz_id"] ? "1" : "0";
			
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='querywtdy'){
		$wtdy_id=isset($arr['wtdy_id']) ?trim($arr['wtdy_id']): '';
		
		$username=isset($arr['username']) ?trim($arr['username']): '';
		
		$admin_id=isset($arr['admin_id']) ?trim($arr['admin_id']): '';
		
		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		
		$sql="";
		
		
		if($wtdy_id!=""){
			$sql.="and a.wtdy_id ='{$wtdy_id}'";
		}
		if($username!=""){
			$sql.="and a.username ='{$username}'";
		}
		if($admin_id!=""){
			$sql.="and a.admin_id ='{$admin_id}'";
		}
		if($begindate!=""){
			$sql.="and a.wt_time>='{$begindate} 00:00:00'";
		}
		
		if($enddate!=""){
			$sql.="and a.wt_time<='{$enddate} 23:59:59'";
		}
		
		$sql="SELECT a.*,b.student_name,b.student_birthday,b.student_address,c.admin_username  FROM wtdy a left join student b on a.username=b.username left join admin c on a.admin_id=c.admin_id where 1=1 ".$sql."group by a.wtdy_id  order by a.wtdy_id ";			
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["wtdy_id"]=rawurlencode($row["wtdy_id"]);		
			$info["data"][$i]["username"]=rawurlencode($row["username"]);
			$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);
			$info["data"][$i]["student_birthday"]=rawurlencode($row["student_birthday"]);
			$info["data"][$i]["student_address"]=rawurlencode($row["student_address"]);
			$info["data"][$i]["admin_id"]=rawurlencode($row["admin_id"]);
			$info["data"][$i]["admin_username"]=rawurlencode($row["admin_username"]);
			$info["data"][$i]["wt_content"]=rawurlencode($row["wt_content"]);
			$info["data"][$i]["wt_time"]=rawurlencode($row["wt_time"]);
			$info["data"][$i]["dy_content"]=rawurlencode($row["dy_content"]);
			$info["data"][$i]["dy_time"]=rawurlencode($row["dy_time"]);

			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';
		$username=isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

		if($log_from_id=='2' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '29', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
	}
	elseif ($arr['cmd']=='addwt'){
		$username=isset($arr['username']) ?trim($arr['username']): '';
		$wt_content=isset($arr['wt_content']) ?trim($arr['wt_content']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($wt_content==''){
		    $info["errmsg"]=rawurlencode('内容不能为空');
			return $info;
		    
		}
		
		$sql="insert into wtdy(username,wt_content,wt_time) values('{$username}','{$wt_content}','{$nowdatetime}')";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('提问成功');
		}else{
			$info["errmsg"]=rawurlencode('提问失败');
		}	

	}
	elseif ($arr['cmd']=='adddy'){
		$wtdy_id=isset($arr['wtdy_id']) ?trim($arr['wtdy_id']): '';
		$admin_id=isset($arr['admin_id']) ?trim($arr['admin_id']): '';
		$dy_content=isset($arr['dy_content']) ?trim($arr['dy_content']): '';

		if($wtdy_id==''){
			$info["errmsg"]=rawurlencode('问题答疑编号不能为空');
			return $info;
		    
		}
		if($admin_id==''){
		    $info["errmsg"]=rawurlencode('教师id不能为空');
			return $info;
		    
		}
		if($dy_content==''){
		    $info["errmsg"]=rawurlencode('答疑内容不能为空');
			return $info;
		    
		}
		
		$sql="update wtdy set admin_id='{$admin_id}',dy_content='{$dy_content}',dy_time='{$nowdatetime}' where wtdy_id='{$wtdy_id}'";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('提问成功');
		}else{
			$info["errmsg"]=rawurlencode('提问失败');
		}	

	}
	elseif ($arr['cmd']=='delwtdy'){
		$wtdy_id=isset($arr['wtdy_id']) ?trim($arr['wtdy_id']): '';

		if($wtdy_id==''){
			$info["errmsg"]=rawurlencode('问题答疑编号不能为空');
			return $info;
		    
		}

		$sql="SELECT * FROM wtdy where wtdy_id='{$wtdy_id}' ";			
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_wtdy_id=$row["wtdy_id"]?$row["wtdy_id"]:"";
		if($db_wtdy_id!=""){
			$sql="delete from wtdy where wtdy_id='{$wtdy_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('问题答疑删除成功');
			}else{
				$info["errmsg"]=rawurlencode('问题答疑删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该问题答疑不存在，无法删除');
		}		

	}
	elseif ($arr['cmd']=='addxhrz'){
		$username=isset($arr['username']) ?trim($arr['username']): '';
		$xhrz_title=isset($arr['xhrz_title']) ?trim($arr['xhrz_title']): '';
		$xhrz_content=isset($arr['xhrz_content']) ?trim($arr['xhrz_content']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($xhrz_title==''){
		    $info["errmsg"]=rawurlencode('标题不能为空');
			return $info;
		    
		}
		if($xhrz_content==''){
		    $info["errmsg"]=rawurlencode('内容不能为空');
			return $info;
		    
		}
		
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($filecount==0){
			$info["errmsg"]=rawurlencode('上传文件为空');
			return $info;
		}
		$count=$filecount;
		if ($count>3){
			$info["errmsg"]=rawurlencode('超过3个,无法上传成功');
			return $info;
		}
		
		$url="";
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"xhrz_".$username."_".$time,$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					$info["errmsg"]=rawurlencode($result["retmsg"]);
					return $info;
				}
				$url=$url.$result["url"]."|";
			}
			$i++;
		}

		$sql="insert into xhrz(username,xhrz_title,xhrz_content,xhrz_pic,xhrz_time) values('{$username}','{$xhrz_title}','{$xhrz_content}','{$url}','{$nowdatetime}')";
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('学画日志添加成功');
		}else{
			$info["errmsg"]=rawurlencode('学画日志添加失败');
		}	

	}
	elseif ($arr['cmd']=='delxhrz'){
		$xhrz_id=isset($arr['xhrz_id']) ?trim($arr['xhrz_id']): '';

		if($xhrz_id==''){
			$info["errmsg"]=rawurlencode('学画日志编号不能为空');
			return $info;
		    
		}

		$sql="SELECT * FROM xhrz where xhrz_id='{$xhrz_id}' ";			
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_xhrz_id=$row["xhrz_id"]?$row["xhrz_id"]:"";
		if($db_xhrz_id!=""){			
			
			$sql="delete from xhrz where xhrz_id='{$xhrz_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$sql="delete from xhrz_pl where xhrz_id='{$xhrz_id}'";
				$res=mysql_query($sql,$db);
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('学画日志删除成功');
			}else{
				$info["errmsg"]=rawurlencode('学画日志删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该学画日志不存在，无法删除');
		}		

	}
	elseif ($arr['cmd']=='queryxhrz'){
		$xhrz_id=isset($arr['xhrz_id']) ?trim($arr['xhrz_id']): '';
		
		$username=isset($arr['username']) ?trim($arr['username']): '';
		$student_address=isset($arr['student_address']) ?trim($arr['student_address']): '';
		
		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		
		$sql="";
		
		
		if($wtdy_id!=""){
			$sql.="and a.xhrz_id ='{$xhrz_id}'";
		}
		if($username!=""){
			$sql.="and a.username ='{$username}'";
		}
		if($student_address!=""){
			$sql.="and a.student_address ='{$student_address}'";
		}
		if($begindate!=""){
			$sql.="and xhrz_time>='{$begindate} 00:00:00'";
		}
		
		if($enddate!=""){
			$sql.="and xhrz_time<='{$enddate} 23:59:59'";
		}
		$sql="SELECT a.*,b.student_name,b.student_birthday,b.student_address,b.student_pic,c.kc_name  FROM xhrz a,student b,kc c where a.username=b.username and b.kc_id=c.kc_id ".$sql." order by a.xhrz_id ";			
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["xhrz_id"]=rawurlencode($row["xhrz_id"]);		
			$info["data"][$i]["username"]=rawurlencode($row["username"]);
			$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);
			$info["data"][$i]["student_birthday"]=rawurlencode($row["student_birthday"]);
			$info["data"][$i]["student_address"]=rawurlencode($row["student_address"]);
			$info["data"][$i]["student_pic"]=rawurlencode($row["student_pic"]);
			$info["data"][$i]["kc_name"]=rawurlencode($row["kc_name"]);
			$info["data"][$i]["xhrz_title"]=rawurlencode($row["xhrz_title"]);
			$info["data"][$i]["xhrz_content"]=rawurlencode($row["xhrz_content"]);
			$info["data"][$i]["xhrz_pic"]=rawurlencode($row["xhrz_pic"]);
			$info["data"][$i]["xhrz_time"]=rawurlencode($row["xhrz_time"]);
			$info["data"][$i]["zf_xhrz_id"]=rawurlencode($row["zf_xhrz_id"]);
			$info["data"][$i]["xhrz_zf_count"]=rawurlencode($row["xhrz_zf_count"]);
			$info["data"][$i]["xhrz_pl_count"]=rawurlencode($row["xhrz_pl_count"]);
			$info["data"][$i]["xhrz_yd_count"]=rawurlencode($row["xhrz_yd_count"]);

			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='addxhrz_yd'){
		$xhrz_id=isset($arr['xhrz_id']) ?trim($arr['xhrz_id']): '';

		if($xhrz_id==''){
			$info["errmsg"]=rawurlencode('学画日志编号不能为空');
			return $info;
		    
		}
		
		$sql="SELECT * FROM xhrz where xhrz_id='{$xhrz_id}' ";			
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_xhrz_id=$row["xhrz_id"]?$row["xhrz_id"]:"";
		if($db_xhrz_id!=""){
			$sql="update xhrz set xhrz_yd_count=xhrz_yd_count+1 where xhrz_id='{$xhrz_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('添加成功');
			}else{
				$info["errmsg"]=rawurlencode('添加失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该学画日志不存在，无法添加阅读记录');
		}	

	}
	elseif ($arr['cmd']=='addxhrz_pl'){

		$xhrz_id=isset($arr['xhrz_id']) ?trim($arr['xhrz_id']): '';
		$pl_username=isset($arr['pl_username']) ?trim($arr['pl_username']): '';
		$pl_title=isset($arr['pl_title']) ?trim($arr['pl_title']): '';
		$pl_title=isset($arr['pl_content']) ?trim($arr['pl_content']): '';

		
		if($xhrz_id==''){
			$info["errmsg"]=rawurlencode('学画日志编号不能为空');
			return $info;
		    
		}
		if($pl_username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($pl_title==''){
		    $info["errmsg"]=rawurlencode('标题不能为空');
			return $info;
		    
		}
		if($pl_title==''){
		    $info["errmsg"]=rawurlencode('内容不能为空');
			return $info;
		    
		}
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($filecount==0){
			$info["errmsg"]=rawurlencode('上传文件为空');
			return $info;
		}
		$count=$filecount;
		if ($count>3){
			$info["errmsg"]=rawurlencode('超过3个,无法上传成功');
			return $info;
		}
		
		$url="";
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"xhrz_pl_".$pl_username."_".$time,$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					$info["errmsg"]=rawurlencode($result["retmsg"]);
					return $info;
				}
				$url=$url.$result["url"]."|";
			}
			$i++;
		}

		$sql="insert into xhrz_pl(pl_username,pl_title,pl_content,pl_pic,pl_time,xhrz_id) values('{$pl_username}','{$pl_title}','{$pl_content}','{$url}','{$nowdatetime}','{$xhrz_id}')";
		$res=mysql_query($sql,$db);
		if($res){
			$sql="update xhrz set xhrz_pl_count=xhrz_pl_count+1 where xhrz_id='{$xhrz_id}'";
			$res=mysql_query($sql,$db);
			
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('学画日志评论添加成功');
		}else{
			$info["errmsg"]=rawurlencode('学画日志评论添加失败');
		}

	}
	elseif ($arr['cmd']=='delxhrz_pl'){
		$xhrz_pl_id=isset($arr['xhrz_pl_id']) ?trim($arr['xhrz_pl_id']): '';

		if($xhrz_pl_id==''){
			$info["errmsg"]=rawurlencode('学画日志评论编号不能为空');
			return $info;
		    
		}

		$sql="SELECT * FROM xhrz_pl where xhrz_pl_id='{$xhrz_pl_id}' ";			
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_xhrz_pl_id=$row["xhrz_pl_id"]?$row["xhrz_pl_id"]:"";
		$db_xhrz_id=$row["xhrz_id"]?$row["xhrz_id"]:"";
		if($db_xhrz_pl_id!=""){
			$sql="delete from xhrz_pl where xhrz_pl_id='{$xhrz_pl_id}'";
			$res=mysql_query($sql,$db);
		
			if($res){
				$sql="update xhrz set xhrz_pl_count=xhrz_pl_count-1 where xhrz_id='{$db_xhrz_id}'";
				$res=mysql_query($sql,$db);
				$info["errcode"]="0";
				$info["errmsg"]=rawurlencode('学画日志评论删除成功');
			}else{
				$info["errmsg"]=rawurlencode('学画日志评论删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该学画日志评论不存在，无法删除');
		}		

	}
	elseif ($arr['cmd']=='queryxhrz_pl'){
		$xhrz_pl_id=isset($arr['xhrz_pl_id']) ?trim($arr['xhrz_pl_id']): '';
		$xhrz_id=isset($arr['xhrz_id']) ?trim($arr['xhrz_id']): '';
		
		$sql="";
		
		
		if($xhrz_pl_id!=""){
			$sql.="and xhrz_pl_id ='{$xhrz_pl_id}'";
		}
		if($xhrz_id!=""){
			$sql.="and xhrz_id ='{$xhrz_id}'";
		}
		$sql="SELECT *  FROM xhrz_pl where 1=1 ".$sql." order by xhrz_pl_id ";			
		$res=mysql_query($sql,$db);
		
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["xhrz_pl_id"]=rawurlencode($row["xhrz_pl_id"]);		
			$info["data"][$i]["pl_username"]=rawurlencode($row["pl_username"]);
			$info["data"][$i]["pl_title"]=rawurlencode($row["pl_title"]);
			$info["data"][$i]["pl_content"]=rawurlencode($row["pl_content"]);
			$info["data"][$i]["pl_pic"]=rawurlencode($row["pl_pic"]);
			$info["data"][$i]["pl_time"]=rawurlencode($row["pl_time"]);
			$info["data"][$i]["hf_xhrz_pl_id"]=rawurlencode($row["hf_xhrz_pl_id"]);
			$info["data"][$i]["xhrz_id"]=rawurlencode($row["xhrz_id"]);

			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='addxhrz_zf'){
		$username=isset($arr['username']) ?trim($arr['username']): '';
		$xhrz_title=isset($arr['xhrz_title']) ?trim($arr['xhrz_title']): '';
		$xhrz_content=isset($arr['xhrz_content']) ?trim($arr['xhrz_content']): '';
		$zf_xhrz_id=isset($arr['zf_xhrz_id']) ?trim($arr['zf_xhrz_id']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($xhrz_title==''){
		    $info["errmsg"]=rawurlencode('标题不能为空');
			return $info;
		    
		}
		if($xhrz_content==''){
		    $info["errmsg"]=rawurlencode('内容不能为空');
			return $info;
		    
		}
		if($zf_xhrz_id==''){
		    $info["errmsg"]=rawurlencode('被转发学画日志编号不能为空');
			return $info;
		    
		}
		
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($filecount==0){
			$info["errmsg"]=rawurlencode('上传文件为空');
			return $info;
		}
		$count=$filecount;
		if ($count>3){
			$info["errmsg"]=rawurlencode('超过3个,无法上传成功');
			return $info;
		}
		
		$url="";
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"xhrz_zf_".$username."_".$time,$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					$info["errmsg"]=rawurlencode($result["retmsg"]);
					return $info;
				}
				$url=$url.$result["url"]."|";
			}
			$i++;
		}

		$sql="insert into xhrz(username,xhrz_title,xhrz_content,xhrz_pic,xhrz_time,zf_xhrz_id) values('{$username}','{$xhrz_title}','{$xhrz_content}','{$url}','{$nowdatetime}','{$zf_xhrz_id}')";
		$res=mysql_query($sql,$db);
		if($res){
			$sql="update xhrz set xhrz_zf_count=xhrz_zf_count+1 where xhrz_id='{$db_xhrz_id}'";
			$res=mysql_query($sql,$db);
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('学画日志添加成功');
		}else{
			$info["errmsg"]=rawurlencode('学画日志添加失败');
		}	

	}
	elseif ($arr['cmd']=='addxhrz_pl_hf'){

		$xhrz_id=isset($arr['xhrz_id']) ?trim($arr['xhrz_id']): '';
		$pl_username=isset($arr['pl_username']) ?trim($arr['pl_username']): '';
		$pl_title=isset($arr['pl_title']) ?trim($arr['pl_title']): '';
		$pl_title=isset($arr['pl_content']) ?trim($arr['pl_content']): '';
		$hf_xhrz_pl_id=isset($arr['hf_xhrz_pl_id']) ?trim($arr['hf_xhrz_pl_id']): '';
		
		if($xhrz_id==''){
			$info["errmsg"]=rawurlencode('学画日志编号不能为空');
			return $info;
		    
		}
		if($pl_username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($pl_title==''){
		    $info["errmsg"]=rawurlencode('标题不能为空');
			return $info;
		    
		}
		if($pl_title==''){
		    $info["errmsg"]=rawurlencode('内容不能为空');
			return $info;
		    
		}
		if($hf_xhrz_pl_id==''){
		    $info["errmsg"]=rawurlencode('被回复的评论编号不能为空');
			return $info;
		    
		}
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($filecount==0){
			$info["errmsg"]=rawurlencode('上传文件为空');
			return $info;
		}
		$count=$filecount;
		if ($count>3){
			$info["errmsg"]=rawurlencode('超过3个,无法上传成功');
			return $info;
		}
		
		$url="";
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"xhrz_pl_hf_".$pl_username."_".$time,$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					$info["errmsg"]=rawurlencode($result["retmsg"]);
					return $info;
				}
				$url=$url.$result["url"]."|";
			}
			$i++;
		}

		$sql="insert into xhrz_pl(pl_username,pl_title,pl_content,pl_pic,pl_time,hf_xhrz_pl_id,xhrz_id) values('{$pl_username}','{$pl_title}','{$pl_content}','{$url}','{$nowdatetime}','{$hf_xhrz_pl_id}','{$xhrz_id}')";
		$res=mysql_query($sql,$db);
		if($res){		
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('学画日志评论添加成功');
		}else{
			$info["errmsg"]=rawurlencode('学画日志评论添加失败');
		}

	}
	elseif ($arr['cmd']=='addstudent_headphoto'){
		$username=isset($arr['username']) ?trim($arr['username']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		
		$result=upload_multi(_Upload_File,"student_headphoto",$_FILES["files"],0);
		if($result["retcode"]=="-1"){
			$info["errmsg"]=rawurlencode($result["retmsg"]);
			return $info;
		}
		$url=$result["url"] ? $result["url"] : "";

		$sql="update student set student_pic='{$url}' where username='{$username}'";
		
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('头像添加成功');
		}else{
			$info["errmsg"]=rawurlencode('头像添加失败');
		}	

	}
	elseif ($arr['cmd']=='querystudent_headphoto'){
		$username=isset($arr['username']) ?trim($arr['username']): '';

		if($username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		

		$sql="select student_pic from  student  where username='{$username}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$student_pic=$row["student_pic"] ? $row["student_pic"] : "";
		$info["errcode"]="0";
		$info["student_headphoto"]=rawurlencode($student_pic);

	}
	
	//---------------------------------------	
	//only web begin
	elseif($arr['cmd']=='adminlogin'){
		$admin_username=isset($arr['admin_username']) ? trim($arr['admin_username']) : '';
		$admin_password=isset($arr['admin_password']) ?trim($arr['admin_password']): '';
		$admin_remenber=isset($arr['admin_remenber']) ?trim($arr['admin_remenber']): '0';
		$admin_autologin=isset($arr['admin_autologin']) ?trim($arr['admin_autologin']): '0';
		if($admin_username==''){
			$info["errmsg"]=rawurlencode('用户名不能为空');
			return $info;
		    
		}
		if($admin_password==''){
			$info["errmsg"]=rawurlencode('密码不能为空');
			return $info;
		    
		}

		$sql="SELECT * FROM admin WHERE admin_username='{$admin_username}' and admin_password='{$admin_password}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_admin_id=$row['admin_id'];
		$db_admin_type=$row['admin_type'];
		if($db_admin_id){
			$_SESSION['admin_username']=$admin_username;
			$_SESSION['admin_password']=$admin_password;
			$_SESSION['admin_id']=$db_admin_id;
			$_SESSION['admin_type']=$db_admin_type;
			
			
			if($admin_remenber==1)
			{
				setcookie("admin_username", $admin_username, time()+30*24*3600);
				setcookie("admin_password", $admin_password, time()+30*24*3600);
				setcookie("admin_remenber", $admin_remenber, time()+30*24*3600);
				
				//setcookie("admin_id", $db_admin_id, time()+30*24*3600);
				//setcookie("admin_type", $db_admin_type, time()+30*24*3600);
			}
			else{
				setcookie("admin_username", "", time()-3600);
				setcookie("admin_password", "", time()-3600);
				setcookie("admin_remenber", "", time()-3600);			
			}
			
			if($admin_autologin==1){
				setcookie("admin_autologin", $admin_autologin, time()+30*24*3600);
			}
			else{
				setcookie("admin_autologin", "", time()-3600);
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
			session_destroy();
			
			setcookie("admin_autologin", "", time()-3600);
				
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('退出成功');	
		}
		else{
			$info["errmsg"]=rawurlencode('该用户不存在');
		}
	}
	elseif($arr['cmd']=='loginout'){
		$student_id=isset($arr['student_id']) ? trim($arr['student_id']) : '';
		
		if($student_id==''){
			$info["errmsg"]=rawurlencode('用户id不能为空');
			return $info;
		    
		}

		$sql="SELECT * FROM student WHERE student_id='{$student_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_student_id=$row['student_id'];
		if($db_student_id){
			session_destroy();
							
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('退出成功');	
		}
		else{
			$info["errmsg"]=rawurlencode('该用户不存在');
		}
	}
	elseif ($arr['cmd']=='addzsjj'){
		/*print_r($arr);
		$content=isset($arr['content']) ? urldecode($arr['content']) : '';
		
		$content="<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv=\"Content-type\" content=\"text/html;charset=UTF-8\"/>
			</head>
		<body>".$content."</body>
		</html>";
		
		$file=_Upload_File."/zsjj/";
		if (!is_dir($file))
		{
			mkdir($file);
		}
		$file=$file.date('Ymd').time().".html";
		$fp = fopen("./".$file,"w");
		$url="";
		if($fp){
			fwrite($fp,$content);
			fclose($fp);
			$url=_Host.$file;
		}
		else{
			echo str_replace("%s", '打开失败', $getback_file);
			exit;
		}
		
		$url=makehtml();
		
		
		$sql="SELECT * FROM zsjj limit 1";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$zsjj_id=isset($row["zsjj_id"])?$row["zsjj_id"]:"";
		
		if ($zsjj_id!=""){
			$sql="update zsjj set zsjj='{$url}'";
		}
		else{
			$sql="insert into zsjj(zsjj) values('{$url}')";
		}
		$res=mysql_query($sql,$db);
		if($res){
			echo str_replace("%s", '保存成功', $getback_file);
			exit;
		}else{
			echo str_replace("%s", '保存失败', $getback_file);
			exit;
		}*/
		$zsjj_content=isset($arr['zsjj_content']) ? urldecode($arr['zsjj_content']) : '';
		$sql="SELECT * FROM zsjj limit 1";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zsjj_content=isset($row["zsjj_content"])?$row["zsjj_content"]:"";
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}

		if ($filecount==0){
			$sql="update zsjj set zsjj_content='{$zsjj_content}'";
			$res=mysql_query($sql,$db);
			if($res){
				echo str_replace("%s", '保存成功', $getback_file);
				exit;

			}else{
				//$info["errmsg"]=rawurlencode('保存失败');
				//return $info;
				echo str_replace("%s", '保存失败', $getback_file);
				exit;
			}
		}
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"zsjj",$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					//$info["errmsg"]=rawurlencode($result["retmsg"]);
					//return $info;
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$url=$result["url"];				
				if ($db_zsjj_content!=""){
					$sql="update zsjj set zsjj_content='{$zsjj_content}' ,zsjj='{$url}'";
				}
				else{
					$sql="insert into zsjj(zsjj_content,zsjj) values('{$zsjj_content}','{$url}')";
				}
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
			$i++;
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='addzsxw'){
		$zsxw_id=isset($arr['zsxw_id']) ? trim($arr['zsxw_id']) : '';
		$zsxw_title=isset($arr['zsxw_title']) ? trim($arr['zsxw_title']) : '';
		$zsxw_content=isset($arr['zsxw_content']) ? trim($arr['zsxw_content']) : '';
		
		
		$sql="SELECT * FROM zsxw where zsxw_id='{$zsxw_id}'";
		
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zsxw_id=isset($row["zsxw_id"])?$row["zsxw_id"]:"";
		
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($db_zsxw_id!=""){
			if ($filecount==0){
				$sql="update zsxw set zsxw_title='{$zsxw_title}',zsxw_content='{$zsxw_content}' where zsxw_id='{$zsxw_id}'";
				$res=mysql_query($sql,$db);
				if($res){
					echo str_replace("%s", '保存成功', $getback_file);
					exit;

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		
			$i=0;
			foreach((array)$_FILES["files"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"zsxw",$_FILES["files"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="update zsxw set zsxw_title='{$zsxw_title}',zsxw_content='{$zsxw_content}',zsxw='{$url}' where zsxw_id='{$zsxw_id}'";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}	
		else{
			if ($filecount==0){
				$sql="insert into zsxw(zsxw_id,zsxw_title,zsxw_content) values('{$zsxw_id}','{$zsxw_title}','{$zsxw_content}')";
				$res=mysql_query($sql,$db);
				if($res){
					echo str_replace("%s", '保存成功', $getback_file);
					exit;

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		
			$i=0;
			foreach((array)$_FILES["files"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"zsxw",$_FILES["files"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="insert into zsxw(zsxw_id,zsxw_title,zsxw_content,zsxw) values('{$zsxw_id}','{$zsxw_title}','{$zsxw_content}','{$url}')";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='delzsxw'){
		$zsxw_id=isset($arr['zsxw_id']) ? trim($arr['zsxw_id']) : '';
		
		$sql="SELECT * FROM zsxw where zsxw_id='{$zsxw_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zsxw_id=isset($row["zsxw_id"])?$row["zsxw_id"]:"";
		if ($db_zsxw_id!=""){
			$sql="delete FROM zsxw where zsxw_id='{$zsxw_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addzxgg'){
		$zxgg_id=isset($arr['zxgg_id']) ? trim($arr['zxgg_id']) : '';
		$zxgg_title=isset($arr['zxgg_title']) ? trim($arr['zxgg_title']) : '';
		$zxgg_content=isset($arr['zxgg_content']) ? trim($arr['zxgg_content']) : '';
		
		$sql="SELECT * FROM zxgg where zxgg_id='{$zxgg_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zxgg_id=isset($row["zxgg_id"])?$row["zxgg_id"]:"";
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($db_zxgg_id!=""){
			if ($filecount==0){
				$sql="update zxgg set zxgg_title='{$zxgg_title}',zxgg_content='{$zxgg_content}' where zxgg_id='{$zxgg_id}'";
				$res=mysql_query($sql,$db);
				if($res){
					echo str_replace("%s", '保存成功', $getback_file);
					exit;

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		
			$i=0;
			foreach((array)$_FILES["files"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"zxgg",$_FILES["files"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="update zxgg set zxgg_title='{$zxgg_title}',zxgg_content='{$zxgg_content}',zxgg='{$url}' where zxgg_id='{$zxgg_id}'";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}	
		else{
			if ($filecount==0){
				$sql="insert into zxgg(zxgg_id,zxgg_title,zxgg_content) values('{$zxgg_id}','{$zxgg_title}','{$zxgg_content}')";
				$res=mysql_query($sql,$db);
				if($res){
					echo str_replace("%s", '保存成功', $getback_file);
					exit;

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		
			$i=0;
			foreach((array)$_FILES["files"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"zxgg",$_FILES["files"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="insert into zxgg(zxgg_id,zxgg_title,zxgg_content,zxgg) values('{$zxgg_id}','{$zxgg_title}','{$zxgg_content}','{$url}')";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='delzxgg'){
		$zxgg_id=isset($arr['zxgg_id']) ? trim($arr['zxgg_id']) : '';
		
		$sql="SELECT * FROM zxgg where zxgg_id='{$zxgg_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zxgg_id=isset($row["zxgg_id"])?$row["zxgg_id"]:"";
		if ($db_zxgg_id!=""){
			$sql="delete FROM zxgg where zxgg_id='{$zxgg_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addsybzbh'){
		$sybzbh_id=isset($arr['sybzbh_id']) ? trim($arr['sybzbh_id']) : '';
		$sybzbh_type=isset($arr['sybzbh_type']) ? trim($arr['sybzbh_type']) : '';
		$sybzbh_time=isset($arr['sybzbh_time']) ? trim($arr['sybzbh_time']) : '';
		$sybzbh_mc=isset($arr['sybzbh_mc']) ? trim($arr['sybzbh_mc']) : '';
		$sybzbh_jj=isset($arr['sybzbh_jj']) ? trim($arr['sybzbh_jj']) : '';
		
		$sql="SELECT * FROM sybzbh where sybzbh_id='{$sybzbh_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_sybzbh_id=isset($row["sybzbh_id"])?$row["sybzbh_id"]:"";
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($db_sybzbh_id!=""){
			if ($filecount==0){
				$sql="update sybzbh set sybzbh_type='{$sybzbh_type}',sybzbh_time='{$sybzbh_time}',sybzbh_mc='{$sybzbh_mc}',sybzbh_jj='{$sybzbh_jj}' where sybzbh_id='{$sybzbh_id}'";
				$res=mysql_query($sql,$db);
				if($res){
					echo str_replace("%s", '保存成功', $getback_file);
					exit;

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		
			$i=0;
			foreach((array)$_FILES["files"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"sybzbh",$_FILES["files"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="update sybzbh set sybzbh_type='{$sybzbh_type}',sybzbh_time='{$sybzbh_time}',sybzbh_mc='{$sybzbh_mc}',sybzbh_jj='{$sybzbh_jj}',sybzbh='{$url}' where sybzbh_id='{$sybzbh_id}'";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}	
		else{
			if ($filecount==0){
				$sql="insert into sybzbh(sybzbh_id,sybzbh_type,sybzbh_time,sybzbh_mc,sybzbh_jj) values('{$sybzbh_id}','{$sybzbh_type}','{$sybzbh_time}','{$sybzbh_mc}','{$sybzbh_jj}')";
				$res=mysql_query($sql,$db);
				if($res){
					echo str_replace("%s", '保存成功', $getback_file);
					exit;

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		
			$i=0;
			foreach((array)$_FILES["files"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"sybzbh",$_FILES["files"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="insert into sybzbh(sybzbh_id,sybzbh_type,sybzbh_time,sybzbh_mc,sybzbh_jj,sybzbh) values('{$sybzbh_id}','{$sybzbh_type}','{$sybzbh_time}','{$sybzbh_mc}','{$sybzbh_jj}','{$url}')";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='delsybzbh'){
		$sybzbh_id=isset($arr['sybzbh_id']) ? trim($arr['sybzbh_id']) : '';
		
		$sql="SELECT * FROM sybzbh where sybzbh_id='{$sybzbh_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_sybzbh_id=isset($row["sybzbh_id"])?$row["sybzbh_id"]:"";
		if ($db_sybzbh_id!=""){
			$sql="delete FROM sybzbh where sybzbh_id='{$sybzbh_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addsyzsxb'){
		$syzsxb_id=isset($arr['syzsxb_id']) ? trim($arr['syzsxb_id']) : '';
		$syzsxb_mc=isset($arr['syzsxb_mc']) ? trim($arr['syzsxb_mc']) : '';
		
		$sql="SELECT * FROM syzsxb where syzsxb_id='{$syzsxb_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_syzsxb_id=isset($row["syzsxb_id"])?$row["syzsxb_id"]:"";
		
		$filecount1=0;
		foreach((array)$_FILES["syzsxb_pic"]["size"] as $key => $size) {
			if($size!=0){
				$filecount1+=1;
			}
		}
		$filecount2=0;
		foreach((array)$_FILES["syzsxb_file"]["size"] as $key => $size) {
			if($size!=0){
				$filecount2+=1;
			}
		}
		if ($db_syzsxb_id!=""){
			$sql="update syzsxb set syzsxb_mc='{$syzsxb_mc}' where syzsxb_id='{$syzsxb_id}'";
		}	
		else{
			$sql="insert into syzsxb(syzsxb_id,syzsxb_mc) values('{$syzsxb_id}','{$syzsxb_mc}')";		
		}
		
		$res=mysql_query($sql,$db);
		if($res){

		}else{
			//$info["errmsg"]=rawurlencode('保存失败');
			//return $info;
			echo str_replace("%s", '保存失败', $getback_file);
			exit;
		}
		
		if ($filecount1!=0){	
			$i=0;
			foreach((array)$_FILES["syzsxb_pic"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"syzsxb",$_FILES["syzsxb_pic"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="update syzsxb set syzsxb_pic='{$url}' where syzsxb_id='{$syzsxb_id}'";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}
		
		if ($filecount2!=0){
			$i=0;
			foreach((array)$_FILES["syzsxb_file"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"syzsxb",$_FILES["syzsxb_file"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="update syzsxb set syzsxb='{$url}' where syzsxb_id='{$syzsxb_id}'";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}
		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='delsyzsxb'){
		$syzsxb_id=isset($arr['syzsxb_id']) ? trim($arr['syzsxb_id']) : '';
		
		$sql="SELECT * FROM syzsxb where syzsxb_id='{$syzsxb_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_syzsxb_id=isset($row["syzsxb_id"])?$row["syzsxb_id"]:"";
		if ($db_syzsxb_id!=""){
			$sql="delete FROM syzsxb where syzsxb_id='{$syzsxb_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addyxzp'){
		$yxzp_id=isset($arr['yxzp_id']) ? trim($arr['yxzp_id']) : '';
		$yxzp_type=isset($arr['yxzp_type']) ? trim($arr['yxzp_type']) : '';
		$yxzp_time=isset($arr['yxzp_time']) ? trim($arr['yxzp_time']) : '';
		$yxzp_mc=isset($arr['yxzp_mc']) ? trim($arr['yxzp_mc']) : '';
		$yxzp_jj=isset($arr['yxzp_jj']) ? trim($arr['yxzp_jj']) : '';
		
		$sql="SELECT * FROM yxzp where yxzp_id='{$yxzp_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_yxzp_id=isset($row["yxzp_id"])?$row["yxzp_id"]:"";
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}
		if ($db_yxzp_id!=""){
			if ($filecount==0){
				$sql="update yxzp set yxzp_type='{$yxzp_type}',yxzp_time='{$yxzp_time}',yxzp_mc='{$yxzp_mc}',yxzp_jj='{$yxzp_jj}' where yxzp_id='{$yxzp_id}'";
				$res=mysql_query($sql,$db);
				if($res){
					echo str_replace("%s", '保存成功', $getback_file);
					exit;

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		
			$i=0;
			foreach((array)$_FILES["files"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"yxzp",$_FILES["files"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="update yxzp set yxzp_type='{$yxzp_type}',yxzp_time='{$yxzp_time}',yxzp_mc='{$yxzp_mc}',yxzp_jj='{$yxzp_jj}',yxzp='{$url}' where yxzp_id='{$yxzp_id}'";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}	
		else{
			if ($filecount==0){
				$sql="insert into yxzp(yxzp_id,yxzp_type,yxzp_time,yxzp_mc,yxzp_jj) values('{$yxzp_id}','{$yxzp_type}','{$yxzp_time}','{$yxzp_mc}','{$yxzp_jj}')";
				$res=mysql_query($sql,$db);
				if($res){
					echo str_replace("%s", '保存成功', $getback_file);
					exit;

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		
			$i=0;
			foreach((array)$_FILES["files"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"yxzp",$_FILES["files"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="insert into yxzp(yxzp_id,yxzp_type,yxzp_time,yxzp_mc,yxzp_jj,yxzp) values('{$yxzp_id}','{$yxzp_type}','{$yxzp_time}','{$yxzp_mc}','{$yxzp_jj}','{$url}')";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='delyxzp'){
		$yxzp_id=isset($arr['yxzp_id']) ? trim($arr['yxzp_id']) : '';
		
		$sql="SELECT * FROM yxzp where yxzp_id='{$yxzp_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_yxzp_id=isset($row["yxzp_id"])?$row["yxzp_id"]:"";
		if ($db_yxzp_id!=""){
			$sql="delete FROM yxzp where yxzp_id='{$yxzp_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addbmlc'){
		$bmlc_content=isset($arr['bmlc_content']) ? trim($arr['bmlc_content']) : '';
		
		$sql="SELECT * FROM bmlc limit 1";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_bmlc_content=isset($row["bmlc_content"])?$row["bmlc_content"]:"";
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}

		if ($filecount==0){
			$sql="update bmlc set bmlc_content='{$bmlc_content}'";
			$res=mysql_query($sql,$db);
			if($res){
				echo str_replace("%s", '保存成功', $getback_file);
				exit;

			}else{
				//$info["errmsg"]=rawurlencode('保存失败');
				//return $info;
				echo str_replace("%s", '保存失败', $getback_file);
				exit;
			}
		}
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"bmlc",$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					//$info["errmsg"]=rawurlencode($result["retmsg"]);
					//return $info;
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$url=$result["url"];				
				if ($db_bmlc_content!=""){
					$sql="update bmlc set bmlc_content='{$bmlc_content}' ,bmlc='{$url}'";
				}
				else{
					$sql="insert into bmlc(bmlc_content,bmlc) values('{$bmlc_content}','{$url}')";
				}
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
			$i++;
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='addzcfw'){
		$zcfw_content=isset($arr['zcfw_content']) ? trim($arr['zcfw_content']) : '';
		
		$sql="SELECT * FROM zcfw limit 1";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zcfw_content=isset($row["zcfw_content"])?$row["zcfw_content"]:"";
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}

		if ($filecount==0){
			$sql="update zcfw set zcfw_content='{$zcfw_content}'";
			$res=mysql_query($sql,$db);
			if($res){
				echo str_replace("%s", '保存成功', $getback_file);
				exit;

			}else{
				//$info["errmsg"]=rawurlencode('保存失败');
				//return $info;
				echo str_replace("%s", '保存失败', $getback_file);
				exit;
			}
		}
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"zcfw",$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					//$info["errmsg"]=rawurlencode($result["retmsg"]);
					//return $info;
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$url=$result["url"];				
				if ($db_zcfw_content!=""){
					$sql="update zcfw set zcfw_content='{$zcfw_content}' ,zcfw='{$url}'";
				}
				else{
					$sql="insert into zcfw(zcfw_content,zcfw) values('{$zcfw_content}','{$url}')";
				}
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
			$i++;
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='addgy'){
		$gy_content=isset($arr['gy_content']) ? trim($arr['gy_content']) : '';
		
		$sql="SELECT * FROM gy limit 1";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_gy_content=isset($row["gy_content"])?$row["gy_content"]:"";
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}

		if ($filecount==0){
			$sql="update gy set gy_content='{$gy_content}'";
			$res=mysql_query($sql,$db);
			if($res){
				echo str_replace("%s", '保存成功', $getback_file);
				exit;

			}else{
				//$info["errmsg"]=rawurlencode('保存失败');
				//return $info;
				echo str_replace("%s", '保存失败', $getback_file);
				exit;
			}
		}
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"gy",$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					//$info["errmsg"]=rawurlencode($result["retmsg"]);
					//return $info;
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$url=$result["url"];				
				if ($db_gy_content!=""){
					$sql="update gy set gy_content='{$gy_content}' ,gy='{$url}'";
				}
				else{
					$sql="insert into gy(gy_content,gy) values('{$gy_content}','{$url}')";
				}
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
			$i++;
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='addkktz'){
		$kktz_content=isset($arr['kktz_content']) ? trim($arr['kktz_content']) : '';
		
		$sql="SELECT * FROM kktz limit 1";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_kktz_content=isset($row["kktz_content"])?$row["kktz_content"]:"";
		
		$filecount=0;
		foreach((array)$_FILES["files"]["size"] as $key => $size) {
			if($size!=0){
				$filecount+=1;
			}
		}

		if ($filecount==0){
			$sql="update kktz set kktz_content='{$kktz_content}'";
			$res=mysql_query($sql,$db);
			if($res){
				echo str_replace("%s", '保存成功', $getback_file);
				exit;

			}else{
				//$info["errmsg"]=rawurlencode('保存失败');
				//return $info;
				echo str_replace("%s", '保存失败', $getback_file);
				exit;
			}
		}
		
		$i=0;
		foreach((array)$_FILES["files"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"kktz",$_FILES["files"],$i);
				if($result["retcode"]!="0"){
					//$info["errmsg"]=rawurlencode($result["retmsg"]);
					//return $info;
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$url=$result["url"];				
				if ($db_kktz_content!=""){
					$sql="update kktz set kktz_content='{$kktz_content}' ,kktz='{$url}'";
				}
				else{
					$sql="insert into kktz(kktz_content,kktz) values('{$kktz_content}','{$url}')";
				}
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
			$i++;
		}

		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='addkc'){
		$kc_id=isset($arr['kc_id']) ? trim($arr['kc_id']) : '';
		$kc_name=isset($arr['kc_name']) ? trim($arr['kc_name']) : '';
		$kc_js=isset($arr['kc_js']) ? trim($arr['kc_js']) : '';
		
		$sql="SELECT * FROM kc where kc_id='{$kc_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_kc_id=isset($row["kc_id"])?$row["kc_id"]:"";
		
		if ($db_kc_id!=""){
			$sql="update kc set kc_name='{$kc_name}',kc_js='{$kc_js}' where kc_id='{$kc_id}'";	
		}	
		else{
			$sql="insert into kc(kc_id,kc_name,kc_js) values('{$kc_id}','{$kc_name}','{$kc_js}')";
		}
		
		$res=mysql_query($sql,$db);
		if($res){
			echo str_replace("%s", '保存成功', $getback_file);
			exit;

		}else{
			//$info["errmsg"]=rawurlencode('保存失败');
			//return $info;
			echo str_replace("%s", '保存失败', $getback_file);
			exit;
		}

	}
	elseif ($arr['cmd']=='delkc'){
		$kc_id=isset($arr['kc_id']) ? trim($arr['kc_id']) : '';
		
		$sql="SELECT * FROM kc where kc_id='{$kc_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_kc_id=isset($row["kc_id"])?$row["kc_id"]:"";
		if ($db_kc_id!=""){
			$sql="delete FROM kc where kc_id='{$kc_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addkj'){
		$kj_id=isset($arr['kj_id']) ? trim($arr['kj_id']) : '';
		$kj_name=isset($arr['kj_name']) ? trim($arr['kj_name']) : '';
		$kc_id=isset($arr['kc_id']) ? trim($arr['kc_id']) : '';
		$zs_id=isset($arr['zs_id']) ? trim($arr['zs_id']) : '';
		$kj_js=isset($arr['kj_js']) ? trim($arr['kj_js']) : '';
		
		$sql="SELECT * FROM kj where kj_id='{$kj_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_kj_id=isset($row["kj_id"])?$row["kj_id"]:"";
		
		$filecount1=0;
		foreach((array)$_FILES["kj_file"]["size"] as $key => $size) {
			if($size!=0){
				$filecount1+=1;
			}
		}
		$filecount2=0;
		foreach((array)$_FILES["zk_file"]["size"] as $key => $size) {
			if($size!=0){
				$filecount2+=1;
			}
		}
		if ($db_kj_id!=""){
			$sql="update kj set kj_name='{$kj_name}', kc_id='{$kc_id}', zs_id='{$zs_id}', kj_js='{$kj_js}' where kj_id='{$kj_id}'";
		}	
		else{
			$sql="insert into kj(kj_id,kj_name,kc_id,zs_id,kj_js) values('{$kj_id}','{$kj_name}','{$kc_id}','{$zs_id}','{$kj_js}')";		
		}
		
		$res=mysql_query($sql,$db);
		if($res){

		}else{
			//$info["errmsg"]=rawurlencode('保存失败');
			//return $info;
			echo str_replace("%s", '保存失败', $getback_file);
			exit;
		}
		
		if ($filecount1!=0){	
			$i=0;
			foreach((array)$_FILES["kj_file"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"kj",$_FILES["kj_file"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="update kj set kj='{$url}' where kj_id='{$kj_id}'";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}
		
		if ($filecount2!=0){
			$i=0;
			foreach((array)$_FILES["zk_file"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$result=upload_multi(_Upload_File,"kj",$_FILES["zk_file"],$i);
					if($result["retcode"]!="0"){
						//$info["errmsg"]=rawurlencode($result["retmsg"]);
						//return $info;
						echo str_replace("%s",$result["retmsg"], $getback_file);
						exit;
					}
					$url=$result["url"];				
					$sql="update kj set zk='{$url}' where kj_id='{$kj_id}'";
					$res=mysql_query($sql,$db);
					if($res){

					}else{
						//$info["errmsg"]=rawurlencode('保存失败');
						//return $info;
						echo str_replace("%s", '保存失败', $getback_file);
						exit;
					}
				}
				$i++;
			}
		}
		//$info["errcode"]="0";
		//$info["errmsg"]=rawurlencode('保存成功');
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='delkj'){
		$kj_id=isset($arr['kj_id']) ? trim($arr['kj_id']) : '';
		
		$sql="SELECT * FROM kj where kj_id='{$kj_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_kj_id=isset($row["kj_id"])?$row["kj_id"]:"";
		if ($db_kj_id!=""){
			$sql="delete FROM kj where kj_id='{$kj_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addzpdp'){
		$zp_id=isset($arr['zp_id']) ? trim($arr['zp_id']) : '';
		$zpdp=isset($arr['zpdp']) ? trim($arr['zpdp']) : '';
		
		$admin_id=isset($_SESSION['admin_id']) ? trim($_SESSION['admin_id']) : '';
		
		$sql="SELECT * FROM zp where zp_id='{$zp_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zp_id=isset($row["zp_id"])?$row["zp_id"]:"";
		$db_admin_id=isset($row["admin_id"])?$row["admin_id"]:"";
		
		if ($db_zp_id!=""){
			if(($db_admin_id==$admin_id) or ($db_admin_id=="")){
				$sql="update zp set zpdp='{$zpdp}',admin_id='{$admin_id}',zpdp_time='{$nowdatetime}' where zp_id='{$zp_id}'";
			}
			else{
				$info["errmsg"]=rawurlencode('不能修改其他老师的点评');
				return $info;
			}
		}	
		else{
			$sql="insert into zp(zp_id,zpdp,zpdp_time,admin_id) values('{$zp_id}','{$zpdp}','{$nowdatetime}','{$admin_id}')";		
		}
		
		$res=mysql_query($sql,$db);
		if($res){
			$info["errcode"]="0";
			$info["errmsg"]=rawurlencode('保存成功');
			return $info;
		}else{
			$info["errmsg"]=rawurlencode('保存失败');
			return $info;
		}


	}
	elseif ($arr['cmd']=='delzp'){
		$zp_id=isset($arr['zp_id']) ? trim($arr['zp_id']) : '';


		$sql="SELECT * FROM zp where zp_id='{$zp_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zp_id=isset($row["zp_id"])?$row["zp_id"]:"";
		if ($db_zp_id!=""){
			$sql="delete FROM zp where zp_id='{$zp_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}


		
	}
	elseif ($arr['cmd']=='delzp2'){
		$zp_id=isset($arr['zp_id']) ? trim($arr['zp_id']) : '';
		$session_admin_type=isset($_SESSION['admin_type']) ? trim($_SESSION['admin_type']) : '';

		if($session_admin_type=='0'){
		
			$sql="SELECT * FROM zp where zp_id='{$zp_id}'";
			$res=mysql_query($sql,$db);
			$row = mysql_fetch_array($res);
			
			$db_zp_id=isset($row["zp_id"])?$row["zp_id"]:"";
			if ($db_zp_id!=""){
				$sql="delete FROM zp where zp_id='{$zp_id}'";
				$res=mysql_query($sql,$db);
				if($res){
					$info["errmsg"]=rawurlencode('删除成功');
					$info["errcode"]="0";
				}
				else{
					$info["errmsg"]=rawurlencode('删除失败');
				}
			}
			else{
				$info["errmsg"]=rawurlencode('该编号不存在');
			}

		}
		else{
			$info["errmsg"]=rawurlencode('无删除权限');
		}
		
	}
	elseif ($arr['cmd']=='queryzpdp'){
		$session_admin_id=isset($_SESSION['admin_id']) ? trim($_SESSION['admin_id']) : '';
		$session_admin_type=isset($_SESSION['admin_type']) ? trim($_SESSION['admin_type']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$dplx=isset($arr['dplx']) ? trim($arr['dplx']) : '';
		$cxlx=isset($arr['cxlx']) ? trim($arr['cxlx']) : '';
		$kj_id=isset($arr['kj_id']) ? trim($arr['kj_id']) : '';
		$bj_id=isset($arr['bj_id']) ? trim($arr['bj_id']) : '';
		
		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		
		//echo "kj_id=$kj_id";
		
		$sql="";
		if ($session_admin_type=='2')
		{
			$sql.="and (a.admin_id='{$session_admin_id}' or a.admin_id='' or a.admin_id is null) and (a.gz_admin_id='{$session_admin_id}' or a.gz_admin_id='' or a.gz_admin_id is null)";
		}
		else{
			if($admin_id!=""){
				$sql.="and (a.admin_id='{$admin_id}' or a.admin_id='' or a.admin_id is null) and (a.gz_admin_id='{$admin_id}' or a.gz_admin_id='' or a.gz_admin_id is null)";
			}
		}
		if ($username!='')
		{
			$sql.="and a.username='{$username}'";
		}
		if ($bj_id!='')
		{
			$sql.="and a.bj_id='{$bj_id}'";
		}
		if	($dplx=="0")
		{
			$sql.="and (a.zpdp='' or a.zpdp is null)";
		}
		elseif ($dplx=="1")
		{
			$sql.="and (a.zpdp!='')";
		}
		
		if($begindate!=""){
			$sql.="and a.add_time>='{$begindate} 00:00:00'";
		}
		
		if($enddate!=""){
			$sql.="and a.add_time<='{$enddate} 23:59:59'";
		}
		
		if ($kj_id!='')
		{
			if ($session_admin_type=='2'){
				$sql2="update zp set admin_id='{$session_admin_id}' where username='{$username}' and kj_id='{$kj_id}'";;
				$res=mysql_query($sql2,$db);
			}
			$sql.="and a.kj_id='{$kj_id}'";
		}
		else{
			if ($session_admin_type=='2'){
				$sql2="update zp a ,student b set a.admin_id=NULL where a.username=b.username and a.username='{$username}' and a.kj_id='{$kj_id}' and a.admin_id='{$session_admin_id}' and (a.zpdp='' or a.zpdp is null) and (b.admin_id ='' or b.admin_id is null)";
				$res=mysql_query($sql2,$db);
			}
		}
		
		if($cxlx=="1"){	
			$sql="select k.username,k.student_name,k.student_birthday,k.student_address,k.bj_id,k.add_time,k.kc_name,k.kj_id,k.kj_name,k.zpdp,k.zpdp_time,k.admin_name from (SELECT a.*,b.admin_name FROM (select zp.*,kc.kc_name,kj.kj_name,st.student_name ,st.student_birthday,st.student_address,st.admin_id as gz_admin_id,st.bj_id from zp zp,kc kc,kj kj,student st where zp.kj_id=kj.kj_id and kj.kc_id=kc.kc_id and zp.username=st.username) a left join admin b on a.admin_id=b.admin_id where 1=1 " .$sql." order by a.zp_id) k group by k.username,k.student_name,k.student_birthday,k.student_address,k.add_time,k.kc_name,k.kj_id,k.kj_name,k.zpdp,k.admin_name";
			$info["sql"]=$sql;
			$res=mysql_query($sql,$db);
			$i=0;
			while($row = mysql_fetch_array($res, MYSQL_ASSOC))
			{
				$info["data"][$i]["zp_id"]=$row["zp_id"];		
				$info["data"][$i]["username"]=rawurlencode($row["username"]);
				$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);
				$info["data"][$i]["student_birthday"]=rawurlencode($row["student_birthday"]);
				$info["data"][$i]["student_address"]=rawurlencode($row["student_address"]);
				$info["data"][$i]["bj_id"]=$row["bj_id"];
				$info["data"][$i]["add_time"]=rawurlencode($row["add_time"]);
				$info["data"][$i]["kc_name"]=rawurlencode($row["kc_name"]);
				$info["data"][$i]["kj_id"]=$row["kj_id"];
				$info["data"][$i]["kj_name"]=rawurlencode($row["kj_name"]);
				$info["data"][$i]["zp"]=rawurlencode($row["zp"]);
				$info["data"][$i]["zpdp"]=rawurlencode($row["zpdp"]);
				$info["data"][$i]["zpdp_time"]=rawurlencode($row["zpdp_time"]);
				$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
				$i=$i+1;
			}
		}
		elseif($cxlx=="0"){
			$sql="SELECT count(*) as count,a.admin_id,b.admin_name FROM (select zp.*,kj.kj_name,st.student_name ,st.student_birthday,st.student_address,st.bj_id from zp zp,kj kj,student st where zp.kj_id=kj.kj_id and zp.username=st.username) a left join admin b on a.admin_id=b.admin_id where 1=1 ".$sql." group by a.admin_id";
			$info["sql"]=$sql;
			$res=mysql_query($sql,$db);
			$i=0;
			while($row = mysql_fetch_array($res, MYSQL_ASSOC))
			{		
				$info["data"][$i]["count"]=$row["count"];
				$info["data"][$i]["admin_id"]=rawurlencode($row["admin_id"]);
				$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
				$i=$i+1;
			}
		}
		else{	
			$sql="SELECT a.*,b.admin_name FROM (select zp.*,kc.kc_name,kj.kj_name,st.student_name ,st.student_birthday,st.student_address,st.admin_id as gz_admin_id,st.bj_id from zp zp,kc kc,kj kj,student st where zp.kj_id=kj.kj_id and kj.kc_id=kc.kc_id and zp.username=st.username) a left join admin b on a.admin_id=b.admin_id where 1=1 " .$sql." order by a.zp_id";
			$info["sql"]=$sql;
			$res=mysql_query($sql,$db);
			$i=0;
			while($row = mysql_fetch_array($res, MYSQL_ASSOC))
			{
				$info["data"][$i]["zp_id"]=$row["zp_id"];		
				$info["data"][$i]["username"]=rawurlencode($row["username"]);
				$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);
				$info["data"][$i]["student_birthday"]=rawurlencode($row["student_birthday"]);
				$info["data"][$i]["student_address"]=rawurlencode($row["student_address"]);
				$info["data"][$i]["bj_id"]=rawurlencode($row["bj_id"]);
				$info["data"][$i]["add_time"]=rawurlencode($row["add_time"]);
				$info["data"][$i]["kc_name"]=rawurlencode($row["kc_name"]);
				$info["data"][$i]["kj_id"]=$row["kj_id"];
				$info["data"][$i]["kj_name"]=rawurlencode($row["kj_name"]);
				$info["data"][$i]["zp"]=rawurlencode($row["zp"]);
				$info["data"][$i]["zp_content"]=rawurlencode($row["zp_content"]);
				$info["data"][$i]["zpdp"]=rawurlencode($row["zpdp"]);
				$info["data"][$i]["zpdp_time"]=rawurlencode($row["zpdp_time"]);
				$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
				$i=$i+1;
			}
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='zpdpover'){
		$session_admin_id=isset($_SESSION['admin_id']) ? trim($_SESSION['admin_id']) : '';
		$session_admin_type=isset($_SESSION['admin_type']) ? trim($_SESSION['admin_type']) : '';
		
		if($session_admin_type=='2'){
			$username=isset($arr['username']) ? trim($arr['username']) : '';
			$kj_id=isset($arr['kj_id']) ? trim($arr['kj_id']) : '';
		
			if($username==""){
				$info["errmsg"]=rawurlencode('学号不能为空');
				return $info;
			}
		
			if($kj_id==""){
				$info["errmsg"]=rawurlencode('课件id不能为空');
				return $info;
			}
		
			$sql="select * from zp where username='{$username}' and kj_id='{$kj_id}'";
			$res=mysql_query($sql,$db);
			$i=0;
			while($row = mysql_fetch_array($res, MYSQL_ASSOC))
			{	
				$zpdp=isset($row["zpdp"])?$row["zpdp"]:"";	
				if($zpdp!=""){
					$i=1;
					break;
				}
			}
		
			if($i==0){
				$sql="update zp a ,student b set a.admin_id=NULL where a.username=b.username and a.username='{$username}' and a.kj_id='{$kj_id}' and a.admin_id='{$session_admin_id}' and (b.admin_id ='' or b.admin_id is null)";
				$res=mysql_query($sql,$db);
				if($res){
					$info["errcode"]="0";
					$info["errmsg"]=rawurlencode('更新成功');
				}
				else{
					$info["errmsg"]=rawurlencode('更新失败');
				}
			}
			else{
				$info["errmsg"]=rawurlencode('已经有作品点评，不需要更新');
			}		
		}
		else{
			$info["errmsg"]=rawurlencode('用户不是教师，不需要更新');
		}
		return $info;
	}
	elseif ($arr['cmd']=='addbjdp'){
		$bjdp_id=isset($arr['bjdp_id']) ? trim($arr['bjdp_id']) : '';
		$bj_id=isset($arr['bjdp_bj_id']) ? trim($arr['bjdp_bj_id']) : '';
		$kj_id=isset($arr['bjdp_kj_id']) ? trim($arr['bjdp_kj_id']) : '';
		$kc_id=isset($arr['bjdp_kc_id']) ? trim($arr['bjdp_kc_id']) : '';

		
		$admin_id=isset($_SESSION['admin_id']) ? trim($_SESSION['admin_id']) : '';
		
		$sql="SELECT * FROM bjdp where bjdp_id='{$bjdp_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_bjdp_id=isset($row["bjdp_id"])?$row["bjdp_id"]:"";
		$db_admin_id=isset($row["admin_id"])?$row["admin_id"]:"";
		
		$sql="SELECT * FROM bjdp where bj_id='{$bj_id}' and kj_id='{$kj_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_bjdp_id2=isset($row["bjdp_id"])?$row["bjdp_id"]:"";
		
		$result=upload(_Upload_File,"bjdp",$_FILES["bjdp"]);
		if($result["retcode"]=="-1"){
			echo str_replace("%s",$result["retmsg"], $getback_file);
			exit;
		}
		$url=$result["url"] ? $result["url"] : "";
		
		if ($bjdp_id!=""){
			if($db_bjdp_id==""){
				if($db_bjdp_id2==""){
					$sql="insert into bjdp(bjdp_id,bj_id,bjdp,admin_id,kj_id,add_time) values('{$bjdp_id}','{$bj_id}','{$url}','{$admin_id}','{$kj_id}','{$nowdatetime}')";
				}
				else{
					echo str_replace("%s", '该班级当前课件的点评已经存在', $getback_file);
					exit;
				}
			}
			else{
				if($db_admin_id==$admin_id){
					$sql="";
					if($url!=""){
						$sql=",bjdp='{$url}'";
					}
					$sql="update bjdp set bj_id='{$bj_id}',admin_id='{$admin_id}',kj_id='{$kj_id}',add_time='{$nowdatetime}'".$sql." where bjdp_id='{$bjdp_id}'";
				}
				else{
					echo str_replace("%s", '不能修改其他老师的点评', $getback_file);
					exit;
				}
			}
		}	
		else{
			echo str_replace("%s", '编号不能为空', $getback_file);
			exit;		
		}
		
		$res=mysql_query($sql,$db);
		if($res){
			echo str_replace("%s", '保存成功', $getback_file);
			exit;
		}else{
			echo str_replace("%s", '保存失败', $getback_file);
			exit;
		}


	}
	elseif ($arr['cmd']=='delbjdp'){
		$bjdp_id=isset($arr['bjdp_id']) ? trim($arr['bjdp_id']) : '';
		$session_admin_type=isset($_SESSION['admin_type']) ? trim($_SESSION['admin_type']) : '';

		if($session_admin_type=='0'){
			if($bjdp_id!=""){
				$sql="SELECT * FROM bjdp where bjdp_id='{$bjdp_id}'";
				$res=mysql_query($sql,$db);
				$row = mysql_fetch_array($res);
				
				$db_bjdp_id=isset($row["bjdp_id"])?$row["bjdp_id"]:"";
				if ($db_bjdp_id!=""){
					$sql="delete FROM bjdp where bjdp_id='{$bjdp_id}'";
					$res=mysql_query($sql,$db);
					if($res){
						$info["errmsg"]=rawurlencode('删除成功');
						$info["errcode"]="0";
					}
					else{
						$info["errmsg"]=rawurlencode('删除失败');
					}
				}
				else{
					$info["errmsg"]=rawurlencode('该编号不存在');
				}
			}
			else{
				$info["errmsg"]=rawurlencode('编号不能为空');
			}

		}
		else{
			$info["errmsg"]=rawurlencode('无删除权限');
		}
		
	}
	elseif ($arr['cmd']=='querybjdp'){	
		$bjdp_id=isset($arr['bjdp_id']) ? trim($arr['bjdp_id']) : '';
		$bj_id=isset($arr['bj_id']) ? trim($arr['bj_id']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		$sql="";
		if ($bjdp_id!='')
		{
			$sql.="and a.bjdp_id='{$bjdp_id}'";
		}
		if ($bj_id!='')
		{
			$sql.="and a.bj_id='{$bj_id}'";
		}
		if ($admin_id!='')
		{
			$sql.="and a.admin_id='{$admin_id}'";
		}
		if ($username!='')
		{
			$sql.="and f.username='{$username}'";
		}
		if($begindate!=""){
			$sql.="and a.add_time>='{$begindate} 00:00:00'";
		}
		
		if($enddate!=""){
			$sql.="and a.add_time<='{$enddate} 23:59:59'";
		}
		
		$sql="select a.bjdp_id,a.bj_id,a.bjdp,a.admin_id,a.kj_id,a.add_time,b.bj_name,c.kj_name,c.kc_id,c.zs_id,d.admin_name,e.kc_name from bjdp a left join bj b on a.bj_id=b.bj_id left join kj c on a.kj_id=c.kj_id left join admin d on a.admin_id=d.admin_id left join kc e on c.kc_id=e.kc_id left join student f on a.bj_id=f.bj_id where 1=1 ".$sql." group by a.bjdp_id,a.bj_id,a.bjdp,a.admin_id,a.kj_id,a.add_time,b.bj_name,c.kj_name,c.kc_id,c.zs_id,d.admin_name,e.kc_name order by a.add_time desc";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["bjdp_id"]=$row["bjdp_id"];		
			$info["data"][$i]["bj_id"]=rawurlencode($row["bj_id"]);
			$info["data"][$i]["bj_name"]=rawurlencode($row["bj_name"]);
			$info["data"][$i]["bjdp"]=rawurlencode($row["bjdp"]);
			$info["data"][$i]["admin_id"]=rawurlencode($row["admin_id"]);
			$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
			$info["data"][$i]["kj_id"]=rawurlencode($row["kj_id"]);
			$info["data"][$i]["kj_name"]=rawurlencode($row["kj_name"]);
			$info["data"][$i]["kc_id"]=rawurlencode($row["kc_id"]);
			$info["data"][$i]["kc_name"]=rawurlencode($row["kc_name"]);
			$info["data"][$i]["zs_id"]=rawurlencode($row["zs_id"]);
			$info["data"][$i]["add_time"]=rawurlencode($row["add_time"]);
			$i=$i+1;
		}
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';

		if($log_from_id=='2' && $username!='' ){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '27', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
	}
	elseif ($arr['cmd']=='queryzsxb_web'){	
		$zsxb_mc=isset($arr['zsxb_mc']) ? trim($arr['zsxb_mc']) : '';
		$zsxb_date=isset($arr['zsxb_date']) ? trim($arr['zsxb_date']) : '';
		//$sql="SELECT * FROM zsxb  where username='{$username}' order by zsxb_id";
		$sql="";
		if ($zsxb_mc=="" and $zsxb_date==""){
			$sql="SELECT * FROM zsxb group by zsxb_mc,zsxb_date order by zsxb_date";			
		}
		else{
			$sql="SELECT * FROM zsxb where  zsxb_mc='{$zsxb_mc}' and zsxb_date='{$zsxb_date}'";			
		}
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["zsxb_id"]=$row["zsxb_id"];		
			$info["data"][$i]["zsxb"]=rawurlencode($row["zsxb"]);
			$info["data"][$i]["zsxb_mc"]=rawurlencode($row["zsxb_mc"]);
			$info["data"][$i]["zsxb_date"]=rawurlencode($row["zsxb_date"]);
			$info["data"][$i]["zsxb_pic"]=rawurlencode($row["zsxb_pic"]);
			$info["data"][$i]["ifgk"]=$row["ifgk"];
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='addzsxb_web'){
		$zsxb_date=isset($arr['zsxb_date']) ? trim($arr['zsxb_date']) : '';
		$zsxb_mc=isset($arr['zsxb_mc']) ? trim($arr['zsxb_mc']) : '';
		
		$sql="SELECT count(*) as count FROM zsxb WHERE zsxb_date='{$zsxb_date}' and zsxb_mc='{$zsxb_mc}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		$db_count=$row['count']?$row['count']:"0";
		
		$filecount=0;
		for($i=0;$i<8;$i++){
			if(($_FILES["zsxbnew"]["size"][$i]>0) or ($_FILES["zsxb_picnew"]["size"][$i]>0)){
				
				$filecount+=1;
			}
		}
		$count=$filecount+$db_count;
		if ($count>8){
			echo str_replace("%s", '超过8个,无法上传成功', $getback_file);
			return $info;
		}
			
		$i=0;
		foreach((array)$_FILES["zsxb"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"zsxb_".$zsxb_mc."_".$zsxb_date,$_FILES["zsxb"],$key);
				if($result["retcode"]!="0"){
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$url=$result["url"];				
				$sql="update zsxb set zsxb_date='{$zsxb_date}',zsxb_mc='{$zsxb_mc}',zsxb='{$url}' where zsxb_id='{$key}'";
				echo $sql;
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
			$i++;
		}
		$i=0;
		foreach((array)$_FILES["zsxb_pic"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"zsxb_".$zsxb_mc."_".$zsxb_date,$_FILES["zsxb_pic"],$key);
				if($result["retcode"]!="0"){
					//$info["errmsg"]=rawurlencode($result["retmsg"]);
					//return $info;
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$url=$result["url"];				
				$sql="update zsxb set zsxb_date='{$zsxb_date}',zsxb_mc='{$zsxb_mc}',zsxb_pic='{$url}' where zsxb_id='{$key}'";
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
			$i++;
		}
		
		for($i=0;$i<8;$i++){
			$zsxburl="";
			$zsxb_picurl="";
			if(($_FILES["zsxbnew"]["error"][$i] == UPLOAD_ERR_OK) and ($_FILES["zsxbnew"]["size"][$i]>0)){
				$result=upload_multi(_Upload_File,"zsxb_".$zsxb_mc."_".$zsxb_date,$_FILES["zsxbnew"],$i);
				if($result["retcode"]!="0"){
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$zsxburl=$result["url"];
			}
			if(($_FILES["zsxb_picnew"]["error"][$i] == UPLOAD_ERR_OK) and ($_FILES["zsxb_picnew"]["size"][$i]>0)){
				$result=upload_multi(_Upload_File,"zsxb_".$zsxb_mc."_".$zsxb_date,$_FILES["zsxb_picnew"],$i);
				if($result["retcode"]!="0"){
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$zsxb_picurl=$result["url"];
			}
			if(($zsxburl!="") or ($zsxb_picurl!="")){
				$sql="insert into zsxb(zsxb_date,zsxb_mc,zsxb,zsxb_pic) values('{$zsxb_date}','{$zsxb_mc}','{$zsxburl}','{$zsxb_picurl}')";
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
		}

		
		
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='delzsxb'){
		$zsxb_id=isset($arr['zsxb_id']) ? trim($arr['zsxb_id']) : '';
		
		$sql="SELECT * FROM zsxb where zsxb_id='{$zsxb_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_zsxb_id=isset($row["zsxb_id"])?$row["zsxb_id"]:"";
		if ($db_zsxb_id!=""){
			$sql="delete FROM zsxb where zsxb_id='{$zsxb_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addxygl'){
								
		$student_id=isset($arr['student_id']) ? trim($arr['student_id']) : '';
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$userpwd=isset($arr['userpwd']) ? trim($arr['userpwd']) : '';
		$userpwdconfirm=isset($arr['userpwdconfirm']) ? trim($arr['userpwdconfirm']) : '';
		$kc_id=isset($arr['kc_id']) ? trim($arr['kc_id']) : '';
		$qs_zs_id=isset($arr['qs_zs_id']) ? trim($arr['qs_zs_id']) : '1';
		$rx_time=isset($arr['rx_time']) ? trim($arr['rx_time']) : '';
		$ifsd=isset($arr['ifsd']) ? trim($arr['ifsd']) : '';
		$student_name=isset($arr['student_name']) ? trim($arr['student_name']) : '';
		$student_sex=isset($arr['student_sex']) ? trim($arr['student_sex']) : '';
		$student_nickname=isset($arr['student_nickname']) ? trim($arr['student_nickname']) : '';
		$student_address=isset($arr['student_address']) ? trim($arr['student_address']) : '';
		$student_xgpxb=isset($arr['student_xgpxb']) ? trim($arr['student_xgpxb']) : '';
		$student_birthday=isset($arr['student_birthday']) ? trim($arr['student_birthday']) : '';
		$student_xgjg=isset($arr['student_xgjg']) ? trim($arr['student_xgjg']) : '';
		$student_parent=isset($arr['student_parent']) ? trim($arr['student_parent']) : '';
		$student_phone=isset($arr['student_phone']) ? trim($arr['student_phone']) : '';
		$student_xqah=isset($arr['student_xqah']) ? trim($arr['student_xqah']) : '';
		$student_weibo=isset($arr['student_weibo']) ? trim($arr['student_weibo']) : '';
		$student_qq=isset($arr['student_qq']) ? trim($arr['student_qq']) : '';
		$student_jrxgzy=isset($arr['student_jrxgzy']) ? trim($arr['student_jrxgzy']) : '';
		$student_email=isset($arr['student_email']) ? trim($arr['student_email']) : '';
		$student_cz=isset($arr['student_cz']) ? trim($arr['student_cz']) : '';
		$student_qd=isset($arr['student_qd']) ? trim($arr['student_qd']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$bj_id=isset($arr['bj_id']) ? trim($arr['bj_id']) : '';
		
		if($userpwd!=$userpwdconfirm){
			echo str_replace("%s", '两次输入密码不一致', $getback_file);
			exit;
		}
		
		$sql="SELECT * FROM student where student_id='{$student_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_student_id=isset($row["student_id"])?$row["student_id"]:"";
		
		if ($db_student_id!=""){
			$sql="update student set username='{$username}',userpwd='{$userpwd}',kc_id='{$kc_id}',qs_zs_id='{$qs_zs_id}',rx_time='{$rx_time}',ifsd='{$ifsd}',student_name='{$student_name}',student_sex='{$student_sex}',student_nickname='{$student_nickname}',student_address='{$student_address}',student_xgpxb='{$student_xgpxb}',student_birthday='{$student_birthday}',student_xgjg='{$student_xgjg}',student_parent='{$student_parent}',student_phone='{$student_phone}',student_xqah='{$student_xqah}',student_weibo='{$student_weibo}',student_qq='{$student_qq}',student_jrxgzy='{$student_jrxgzy}',student_email='{$student_email}',student_cz='{$student_cz}',student_qd='{$student_qd}',admin_id='{$admin_id}',bj_id='{$bj_id}' where student_id='{$student_id}'";
		}	
		else{
			$sql="SELECT * FROM student where username='{$username}'";
			$res=mysql_query($sql,$db);
			$row = mysql_fetch_array($res);
			$$db_student_id=isset($row["student_id"])?$row["student_id"]:"";
			if($$db_student_id!=""){
				echo str_replace("%s", '该学号已经存在', $getback_file);
				exit;
			}
			
			
			$sql="insert into student(student_id,username,userpwd,kc_id,qs_zs_id,rx_time,ifsd,student_name,student_sex,student_nickname,student_address,student_xgpxb,student_birthday,student_xgjg,student_parent,student_phone,student_xqah,student_weibo,student_qq,student_jrxgzy,student_email,student_cz,student_qd,admin_id,bj_id) values('{$student_id}','{$username}','{$userpwd}','{$kc_id}','{$qs_zs_id}','{$rx_time}','{$ifsd}','{$student_name}','{$student_sex}','{$student_nickname}','{$student_address}','{$student_xgpxb}','{$student_birthday}','{$student_xgjg}','{$student_parent}','{$student_phone}','{$student_xqah}','{$student_weibo}','{$student_qq}','{$student_jrxgzy}','{$student_email}','{$student_cz}','{$student_qd}','{$admin_id}','{$bj_id}')";		
		}
		
		$res=mysql_query($sql,$db);
		if($res){
			echo str_replace("%s", '保存成功', $getback_file);
			exit;
		}else{
			echo str_replace("%s", '保存失败', $getback_file);
			exit;
		}


	}
	elseif ($arr['cmd']=='addxygl_2'){
								
		$student_id=isset($arr['student_id']) ? trim($arr['student_id']) : '';
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$student_name=isset($arr['student_name']) ? trim($arr['student_name']) : '';
		$student_sex=isset($arr['student_sex']) ? trim($arr['student_sex']) : '';
		$student_nickname=isset($arr['student_nickname']) ? trim($arr['student_nickname']) : '';
		$student_address=isset($arr['student_address']) ? trim($arr['student_address']) : '';
		$student_xgpxb=isset($arr['student_xgpxb']) ? trim($arr['student_xgpxb']) : '';
		$student_birthday=isset($arr['student_birthday']) ? trim($arr['student_birthday']) : '';
		$student_xgjg=isset($arr['student_xgjg']) ? trim($arr['student_xgjg']) : '';
		$student_parent=isset($arr['student_parent']) ? trim($arr['student_parent']) : '';
		$student_phone=isset($arr['student_phone']) ? trim($arr['student_phone']) : '';
		$student_xqah=isset($arr['student_xqah']) ? trim($arr['student_xqah']) : '';
		$student_weibo=isset($arr['student_weibo']) ? trim($arr['student_weibo']) : '';
		$student_qq=isset($arr['student_qq']) ? trim($arr['student_qq']) : '';
		$student_jrxgzy=isset($arr['student_jrxgzy']) ? trim($arr['student_jrxgzy']) : '';
		$student_email=isset($arr['student_email']) ? trim($arr['student_email']) : '';
		$student_cz=isset($arr['student_cz']) ? trim($arr['student_cz']) : '';
		$student_qd=isset($arr['student_qd']) ? trim($arr['student_qd']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$bj_id=isset($arr['bj_id']) ? trim($arr['bj_id']) : '';
		
		$sql="SELECT * FROM student where student_id='{$student_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_student_id=isset($row["student_id"])?$row["student_id"]:"";
		
		if ($db_student_id!=""){
			$sql="update student set username='{$username}',student_name='{$student_name}',student_sex='{$student_sex}',student_nickname='{$student_nickname}',student_address='{$student_address}',student_xgpxb='{$student_xgpxb}',student_birthday='{$student_birthday}',student_xgjg='{$student_xgjg}',student_parent='{$student_parent}',student_phone='{$student_phone}',student_xqah='{$student_xqah}',student_weibo='{$student_weibo}',student_qq='{$student_qq}',student_jrxgzy='{$student_jrxgzy}',student_email='{$student_email}',student_cz='{$student_cz}',student_qd='{$student_qd}',admin_id='{$admin_id}',bj_id='{$bj_id}' where student_id='{$student_id}'";
			$res=mysql_query($sql,$db);
			$info["errmsg"]=rawurlencode('修改成功');
			$info["errcode"]="0";
		}	
		else{
			$info["errmsg"]=rawurlencode('该用户不存在');
		}


	}
	elseif ($arr['cmd']=='delxygl'){
		$student_id=isset($arr['student_id']) ? trim($arr['student_id']) : '';
		
		$sql="SELECT * FROM student where student_id='{$student_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_student_id=isset($row["student_id"])?$row["student_id"]:"";
		if ($db_student_id!=""){
			$sql="delete FROM student where student_id='{$student_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='queryxygl'){	
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$shlx=isset($arr['shlx']) ? trim($arr['shlx']) : '';
		$bj_id=isset($arr['bj_id']) ? trim($arr['bj_id']) : '';
		$student_id=isset($arr['student_id']) ? trim($arr['student_id']) : '';
		$jgts=isset($arr['jgts']) ? trim($arr['jgts']) : '';
		$sql="";
		
		if	($shlx=="0")
		{
			$sql.="and (a.username='' or a.username is null)";
		}
		elseif ($shlx=="1")
		{
			$sql.="and (a.username!='')";
		}
		if ($bj_id!='')
		{
			$sql.="and a.bj_id='{$bj_id}'";
		}
		if ($username!='')
		{
			$sql.="and a.username='{$username}'";
		}
		if ($student_id!='')
		{
			$sql.="and a.student_id='{$student_id}'";
		}
		if ($jgts!='')
		{
			$sql.="and datediff(NOW(),d.add_time)>='{$jgts}'";
		}
		
		$sql="SELECT a.*,b.zpcount,c.bzbhcount,e.kc_kj_count,e.kc_name,d.add_time,d.zs_id as yskc, (e.kc_kj_count-d.zs_id) as sykc,(d.zs_id+1) as dqkc from student a left join (select count(*) as zpcount,username from zp group by username) b on a.username=b.username left join (select count(*) as bzbhcount,username from bzbh  group by username) c  on a.username=c.username left join (SELECT max(zs_id) as zs_id ,max(add_time) as add_time,username,kc_id from student_kj group by username,kc_id) d on a.username=d.username and a.kc_id=d.kc_id left join (select count(*) as kc_kj_count,kc.kc_id,kc.kc_name from kc , kj where kc.kc_id=kj.kc_id group by kc.kc_id) e on a.kc_id=e.kc_id  where 1=1 " .$sql." order by a.student_id";
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{
			$info["data"][$i]["student_id"]=$row["student_id"];
			$info["data"][$i]["username"]=rawurlencode($row["username"]);	
			$info["data"][$i]["userpwd"]=rawurlencode($row["userpwd"]);	
			$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);
			$info["data"][$i]["student_sex"]=rawurlencode($row["student_sex"]);
			$info["data"][$i]["student_birthday"]=rawurlencode($row["student_birthday"]);
			$info["data"][$i]["student_address"]=rawurlencode($row["student_address"]);
			$info["data"][$i]["student_parent"]=rawurlencode($row["student_parent"]);
			$info["data"][$i]["student_phone"]=rawurlencode($row["student_phone"]);
			$info["data"][$i]["student_email"]=rawurlencode($row["student_email"]);
			$info["data"][$i]["student_weibo"]=rawurlencode($row["student_weibo"]);
			$info["data"][$i]["student_qq"]=rawurlencode($row["student_qq"]);
			$info["data"][$i]["student_nickname"]=rawurlencode($row["student_nickname"]);
			$info["data"][$i]["student_xgjg"]=rawurlencode($row["student_xgjg"]);
			$info["data"][$i]["student_xgpxb"]=rawurlencode($row["student_xgpxb"]);
			$info["data"][$i]["student_xqah"]=rawurlencode($row["student_xqah"]);
			$info["data"][$i]["student_jrxgzy"]=rawurlencode($row["student_jrxgzy"]);
			$info["data"][$i]["student_cz"]=rawurlencode($row["student_cz"]);
			$info["data"][$i]["student_qd"]=rawurlencode($row["student_qd"]);
			$info["data"][$i]["student_pic"]=rawurlencode($row["student_pic"]);
			$info["data"][$i]["bj_id"]=rawurlencode($row["bj_id"]);
			$info["data"][$i]["kc_id"]=$row["kc_id"];
			$info["data"][$i]["kc_name"]=rawurlencode($row["kc_name"]);
			$info["data"][$i]["rx_time"]=rawurlencode($row["rx_time"]);
			$info["data"][$i]["qs_zs_id"]=rawurlencode($row["qs_zs_id"]);
			$info["data"][$i]["ifsd"]=rawurlencode($row["ifsd"]);
			$info["data"][$i]["admin_id"]=rawurlencode($row["admin_id"]);
			$info["data"][$i]["zpcount"]=isset($row["zpcount"]) ? rawurlencode($row["zpcount"]) : "0";
			$info["data"][$i]["bzbhcount"]=isset($row["bzbhcount"]) ? rawurlencode($row["bzbhcount"]) : "0";
			$info["data"][$i]["kc_kj_count"]=isset($row["kc_kj_count"]) ? rawurlencode($row["kc_kj_count"]) : "0";
			$info["data"][$i]["add_time"]=rawurlencode($row["add_time"]);
			$info["data"][$i]["yskc"]=isset($row["yskc"]) ? rawurlencode($row["yskc"]) : "0";
			$info["data"][$i]["sykc"]=isset($row["sykc"]) ? rawurlencode($row["sykc"]) : "0";
			$info["data"][$i]["dqkc"]=isset($row["dqkc"]) ? rawurlencode($row["dqkc"]) : "0";
			$i=$i+1;
		}
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='querybzbh_web'){
		$bzbh_mc=isset($arr['bzbh_mc']) ? trim($arr['bzbh_mc']) : '';
		$bzbh_time=isset($arr['bzbh_time']) ? trim($arr['bzbh_time']) : '';
		
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		
		$sql="";
		if ($bzbh_mc=="" and $bzbh_date==""){
			if($username!=""){
				$sql.="and a.username='{$username}'";
			}
			if($begindate!=""){
				$sql.="and a.bzbh_time>='{$begindate}'";
			}
		
			if($enddate!=""){
				$sql.="and a.bzbh_time<='{$enddate}'";
			}
			$sql="SELECT a.*,b.student_name FROM bzbh a,student b where a.username=b.username ".$sql." group by a.bzbh_mc,a.bzbh_time order by a.bzbh_time";			
		}
		else{
			$sql="SELECT a.*,b.student_name FROM bzbh a,student b where a.username=b.username and  a.bzbh_mc='{$bzbh_mc}' and a.bzbh_time='{$bzbh_time}'";			
		}
			
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["bzbh_id"]=$row["bzbh_id"];
			$info["data"][$i]["bzbh_type"]=$row["bzbh_type"];
			$info["data"][$i]["bzbh_time"]=$row["bzbh_time"];
			$info["data"][$i]["bzbh_mc"]=rawurlencode($row["bzbh_mc"]);
			$info["data"][$i]["bzbh_jj"]=rawurlencode($row["bzbh_jj"]);
			$info["data"][$i]["bzbh"]=rawurlencode($row["bzbh"]);
			$info["data"][$i]["username"]=rawurlencode($row["username"]);
			$info["data"][$i]["student_name"]=rawurlencode($row["student_name"]);
			$info["data"][$i]["ifgk"]=$row["ifgk"];		
			$i=$i+1;
		}
		
		$info["errcode"]="0";
	}	
	elseif ($arr['cmd']=='addbzbh_web'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$bzbh_time=isset($arr['bzbh_time']) ? trim($arr['bzbh_time']) : '';
		$bzbh_mc=isset($arr['bzbh_mc']) ? trim($arr['bzbh_mc']) : '';
		$bzbh_jj=isset($arr['bzbh_jj']) ? trim($arr['bzbh_jj']) : '';
				
		$i=0;
		foreach((array)$_FILES["bzbh"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$result=upload_multi(_Upload_File,"bzbh_".$username."_".$bzbh_mc."_".$bzbh_time,$_FILES["bzbh"],$key);
				if($result["retcode"]!="0"){
					//$info["errmsg"]=rawurlencode($result["retmsg"]);
					//return $info;
					echo str_replace("%s",$result["retmsg"], $getback_file);
					exit;
				}
				$url=$result["url"];				
				$sql="update bzbh set username='{$username}',bzbh_time='{$bzbh_time}',bzbh_mc='{$bzbh_mc}',bzbh_jj='{$bzbh_jj}',bzbh='{$url}' where bzbh_id='{$key}'";
				$res=mysql_query($sql,$db);
				if($res){

				}else{
					//$info["errmsg"]=rawurlencode('保存失败');
					//return $info;
					echo str_replace("%s", '保存失败', $getback_file);
					exit;
				}
			}
			$i++;
		}
				
		echo str_replace("%s", '保存成功', $getback_file);
		exit;

	}
	elseif ($arr['cmd']=='delbzbh'){
		$bzbh_id=isset($arr['bzbh_id']) ? trim($arr['bzbh_id']) : '';
		
		$sql="SELECT * FROM bzbh where bzbh_id='{$bzbh_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_bzbh_id=isset($row["bzbh_id"])?$row["bzbh_id"]:"";
		if ($db_bzbh_id!=""){
			$sql="delete FROM bzbh where bzbh_id='{$bzbh_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='addjsgl'){
								
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$admin_username=isset($arr['admin_username']) ? trim($arr['admin_username']) : '';
		$admin_password=isset($arr['admin_password']) ? trim($arr['admin_password']) : '';
		$admin_passwordconfirm=isset($arr['admin_passwordconfirm']) ? trim($arr['admin_passwordconfirm']) : '';
		$admin_type=isset($arr['admin_type']) ? trim($arr['admin_type']) : '';
		$admin_name=isset($arr['admin_name']) ? trim($arr['admin_name']) : '';
		$admin_sex=isset($arr['admin_sex']) ? trim($arr['admin_sex']) : '';
		$admin_nickname=isset($arr['admin_nickname']) ? trim($arr['admin_nickname']) : '';
		$admin_address=isset($arr['admin_address']) ? trim($arr['admin_address']) : '';
		$admin_birthday=isset($arr['admin_birthday']) ? trim($arr['admin_birthday']) : '';
		$admin_phone=isset($arr['admin_phone']) ? trim($arr['admin_phone']) : '';
		$admin_weibo=isset($arr['admin_weibo']) ? trim($arr['admin_weibo']) : '';
		$admin_qq=isset($arr['admin_qq']) ? trim($arr['admin_qq']) : '';
		$admin_email=isset($arr['admin_email']) ? trim($arr['admin_email']) : '';
		$admin_grjs=isset($arr['admin_grjs']) ? trim($arr['admin_grjs']) : '';
		
		if($admin_password!=$admin_passwordconfirm){
			echo str_replace("%s", '两次输入密码不一致', $getback_file);
			exit;
		}
		
		$result=upload(_Upload_File,"headphoto",$_FILES["admin_pic_url"]);
		if($result["retcode"]=="-1"){
			echo str_replace("%s",$result["retmsg"], $getback_file);
			exit;
		}
		$url=$result["url"] ? $result["url"] : "";
		
		$sql="SELECT * FROM admin where admin_id='{$admin_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_admin_id=isset($row["admin_id"])?$row["admin_id"]:"";
		
		$sql="";
		if ($db_admin_id!=""){
			if ($url!=""){
				$sql.=",admin_pic='{$url}'";
			}
			$sql="update admin set admin_username='{$admin_username}',admin_password='{$admin_password}',admin_type='{$admin_type}',admin_name='{$admin_name}',admin_sex='{$admin_sex}',admin_nickname='{$admin_nickname}',admin_address='{$admin_address}',admin_birthday='{$admin_birthday}',admin_phone='{$admin_phone}',admin_weibo='{$admin_weibo}',admin_qq='{$admin_qq}',admin_email='{$admin_email}',admin_grjs='{$admin_grjs}'".$sql." where admin_id='{$admin_id}'";
		}	
		else{
			$sql="SELECT * FROM admin where admin_username='{$admin_username}'";
			$res=mysql_query($sql,$db);
			$row = mysql_fetch_array($res);
			$$db_admin_id=isset($row["admin_id"])?$row["admin_id"]:"";
			if($$db_admin_id!=""){
				echo str_replace("%s", '该用户名已经存在', $getback_file);
				exit;
			}
			if ($url!=""){
				$sql="insert into admin(admin_username,admin_password,admin_type,admin_name,admin_sex,admin_nickname,admin_address,admin_birthday,admin_phone,admin_weibo,admin_qq,admin_email,admin_grjs,admin_pic) values('{$admin_username}','{$admin_password}','{$admin_type}','{$admin_name}','{$admin_sex}','{$admin_nickname}','{$admin_address}','{$admin_birthday}','{$admin_phone}','{$admin_weibo}','{$admin_qq}','{$admin_email}','{$admin_grjs}','{$url}')";	
			}
			else{
				$sql="insert into admin(admin_username,admin_password,admin_type,admin_name,admin_sex,admin_nickname,admin_address,admin_birthday,admin_phone,admin_weibo,admin_qq,admin_email,admin_grjs) values('{$admin_username}','{$admin_password}','{$admin_type}','{$admin_name}','{$admin_sex}','{$admin_nickname}','{$admin_address}','{$admin_birthday}','{$admin_phone}','{$admin_weibo}','{$admin_qq}','{$admin_email}','{$admin_grjs}')";		
			}	
		}
		$res=mysql_query($sql,$db);
		if($res){
			echo str_replace("%s", '保存成功', $getback_file);
			exit;
		}else{
			echo str_replace("%s", '保存失败', $getback_file);
			exit;
		}


	}
	elseif ($arr['cmd']=='deljsgl'){
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		
		$sql="SELECT * FROM admin where admin_id='{$admin_id}'";
		$res=mysql_query($sql,$db);
		$row = mysql_fetch_array($res);
		
		$db_admin_id=isset($row["admin_id"])?$row["admin_id"]:"";
		if ($db_admin_id!=""){
			$sql="delete FROM admin where admin_id='{$admin_id}'";
			$res=mysql_query($sql,$db);
			if($res){
				$info["errmsg"]=rawurlencode('删除成功');
				$info["errcode"]="0";
			}
			else{
				$info["errmsg"]=rawurlencode('删除失败');
			}
		}
		else{
			$info["errmsg"]=rawurlencode('该编号不存在');
		}
		
	}
	elseif ($arr['cmd']=='queryjsgl_web'){
		$admin_username=isset($arr['admin_username']) ? trim($arr['admin_username']) : '';
		$admin_type=isset($arr['admin_type']) ? trim($arr['admin_type']) : '';
		$admin_id=isset($arr['admin_id']) ? trim($arr['admin_id']) : '';
		$cxlx=isset($arr['cxlx']) ? trim($arr['cxlx']) : '0';
		
		$begindate=isset($arr['begindate']) ? trim($arr['begindate']) : '';
		$enddate=isset($arr['enddate']) ? trim($arr['enddate']) : '';
		
		$session_admin_id=isset($_SESSION['admin_id']) ? trim($_SESSION['admin_id']) : '';
		$session_admin_type=isset($_SESSION['admin_type']) ? trim($_SESSION['admin_type']) : '';
		$sql="";
		
		if($session_admin_type=="2"){
			$sql.="and a.admin_type='2'";
			if($session_admin_id!=""){
				$sql.="and a.admin_id='{$session_admin_id}'";
			}
		}
		elseif($session_admin_type=="1"){
			$sql.="and a.admin_type!='0'";
		}
		if ($admin_username!='')
		{
			$sql.="and a.admin_username='{$admin_username}'";
		}
		if ($admin_type!='')
		{
			$sql.="and a.admin_type='{$admin_type}'";
		}
		if ($admin_id!=""){
			$sql.="and a.admin_id='{$admin_id}'";
		}
		if ($cxlx=='0'){
			$sql="select a.* from admin a where 1=1 ".$sql;
			
			$res=mysql_query($sql,$db);
			$i=0;
			while($row = mysql_fetch_array($res, MYSQL_ASSOC))
			{		
				$info["data"][$i]["admin_id"]=$row["admin_id"];
				$info["data"][$i]["admin_username"]=rawurlencode($row["admin_username"]);
				$info["data"][$i]["admin_password"]=$row["admin_password"];
				$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
				$info["data"][$i]["admin_sex"]=rawurlencode($row["admin_sex"]);
				$info["data"][$i]["admin_address"]=rawurlencode($row["admin_address"]);
				$info["data"][$i]["admin_birthday"]=rawurlencode($row["admin_birthday"]);
				$info["data"][$i]["admin_phone"]=rawurlencode($row["admin_phone"]);
				$info["data"][$i]["admin_email"]=rawurlencode($row["admin_email"]);
				$info["data"][$i]["admin_weibo"]=rawurlencode($row["admin_weibo"]);
				$info["data"][$i]["admin_qq"]=rawurlencode($row["admin_qq"]);
				$info["data"][$i]["admin_nickname"]=rawurlencode($row["admin_nickname"]);
				$info["data"][$i]["admin_grjs"]=rawurlencode($row["admin_grjs"]);	
				$info["data"][$i]["admin_pic"]=rawurlencode($row["admin_pic"]);	
				$info["data"][$i]["admin_type"]=$row["admin_type"];	
				$i=$i+1;
			}
		}
		else{
			
			$sql2="";
			if($begindate!=""){
				$sql2.="and zpdp_time>='{$begindate}'";
			}
			if($enddate!=""){
				$sql2.="and zpdp_time<='{$enddate}'";
			}
			
			$sql.="and a.admin_type='2'";
			$sql="select a.*,b.gz_count,c.xh_count,d.yb_count,e.bxh_count,f.zpdp_count from admin a left join (select count(*) as gz_count ,admin_id from student group by admin_id) b on a.admin_id=b.admin_id left join (select count(*) as xh_count,admin_id from pj  where pj_type=2 group by admin_id) c on a.admin_id=c.admin_id left join (select count(*) as yb_count,admin_id from pj  where pj_type=3 group by admin_id) d on a.admin_id=d.admin_id left join (select count(*) as bxh_count,admin_id from pj  where pj_type=4 group by admin_id) e on a.admin_id=e.admin_id left join (select count(*) as zpdp_count,admin_id from zp where 1=1 ".$sql2." group by admin_id) f on a.admin_id=f.admin_id where 1=1 ".$sql;
			$res=mysql_query($sql,$db);
			$i=0;
			while($row = mysql_fetch_array($res, MYSQL_ASSOC))
			{
				$info["data"][$i]["admin_id"]=$row["admin_id"];
				$info["data"][$i]["admin_username"]=rawurlencode($row["admin_username"]);
				$info["data"][$i]["admin_name"]=rawurlencode($row["admin_name"]);
				$info["data"][$i]["gz_count"]=isset($row["gz_count"]) ? $row["gz_count"] : "0";
				$info["data"][$i]["xh_count"]=isset($row["xh_count"]) ? $row["xh_count"] : "0";
				$info["data"][$i]["yb_count"]=isset($row["yb_count"]) ? $row["yb_count"] : "0";
				$info["data"][$i]["bxh_count"]=isset($row["bxh_count"]) ? $row["bxh_count"] : "0";
				$info["data"][$i]["zpdp_count"]=isset($row["zpdp_count"]) ? $row["zpdp_count"] : "0";
				$i=$i+1;
			}
		}	
		
		$info["errcode"]="0";
	}
	elseif ($arr['cmd']=='queryyjfk'){
		$username=isset($arr['username']) ? trim($arr['username']) : '';
		$add_time=isset($arr['add_time']) ? trim($arr['add_time']) : '';
		
		$sql="";
		if ($username!='')
		{
			$sql.="and username='{$username}'";
		}
		if ($add_time!='')
		{
			$sql.="and add_time like '%{$add_time}%'";
		}
	
		$sql="select * from yjfk where 1=1 ".$sql." order by yjfk_id desc";
		
		$res=mysql_query($sql,$db);
		$i=0;
		while($row = mysql_fetch_array($res, MYSQL_ASSOC))
		{		
			$info["data"][$i]["yjfk_id"]=$row["yjfk_id"];
			$info["data"][$i]["username"]=rawurlencode($row["username"]);
			$info["data"][$i]["add_time"]=rawurlencode($row["add_time"]);
			$info["data"][$i]["yjfk_content"]=rawurlencode($row["yjfk_content"]);
			$i=$i+1;
		}
		
		$info["errcode"]="0";

		$log_from_id=isset($_SESSION['log_from_id']) ? trim($_SESSION['log_from_id']) : '';
		$username=isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

		if($log_from_id=='2' && $username!=''){

			$arrlog = array( 
				'cmd' => 'add_log', 
				'log_type_id' => '33', 
				'username' => $username
			); 

			main($db,$filestr,$arrlog);
		}
	}
	elseif ($arr['cmd']=='add_log'){
		$log_type_id=isset($arr['log_type_id']) ?trim($arr['log_type_id']): '';
		$id=isset($arr['id']) ?trim($arr['id']): '';
		$username=isset($arr['username']) ?trim($arr['username']): '';


		if($log_type_id==''){
			$info["errmsg"]=rawurlencode('日志类型不能为空');
			return $info;
		    
		}
		

		$sql="insert into log (log_type_id,id,username,add_time) values('{$log_type_id}','{$id}','{$username}','{$nowdatetime}')";
		$res=mysql_query($sql,$db);

		$info["errcode"]="0";


	}
	elseif($arr['cmd']=='download'){
		$filename=isset($arr['url']) ? trim($arr['url']) : '';
		$filename=urldecode(base64_decode($filename));
		
		$fileExists = @file_get_contents($filename,null,null,-1,1) ? true : false ;
		
		if(!$fileExists)   {   //检查文件是否存在 
			echo str_replace("%s", '文件找不到', $form_file); 
			exit;    
		}
     
		// http headers 
		header('Content-Type: application-x/force-download'); 
		header('Content-Disposition: attachment; filename="' . get_basename($filename) .'"'); 
	 
		// for IE6 
		if (false === strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6')) { 
			header('Cache-Control: no-cache, must-revalidate'); 
		} 
		header('Pragma: no-cache'); 			 
		// read file content and output 
		return readfile($filename);

	}
	//only web end
	else
	{
		$info["errmsg"]=rawurlencode("该功能暂不支持");
	}
	return $info;
}


?>