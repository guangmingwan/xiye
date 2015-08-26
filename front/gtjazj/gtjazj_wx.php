<?php
/**
  * wechat php test
  */
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE );
include_once(dirname(__FILE__)."/config.php");
include_once(dirname(__FILE__)."/comm.php");
include_once(dirname(__FILE__)."/func.php");

header("Content-type: text/html;charset=utf-8");
date_default_timezone_set('Etc/GMT-8');

define("TOKEN", "gtjazj");


$wechatObj = new wechatCallbackapiTest();

if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
	public function valid()
    {

		
        $echoStr = $_GET["echostr"];

        if($this->checkSignature()){
        
        	$postStr =  file_get_contents("php://input");

			$postStr = $postStr ? $postStr : $_SERVER["QUERY_STRING"] ;  
			

				
        	echo $echoStr;
        	exit;
        }
    }
    
    public function language_text($url)   
	{
		  if(!function_exists('file_get_contents')) {
		   $file_contents = file_get_contents($url);
		  } else {
		  $ch = curl_init();
		  $timeout = 5;
		  curl_setopt ($ch, CURLOPT_URL, $url);
		  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		  $file_contents = curl_exec($ch);
		  curl_close($ch);
		  }
		return $file_contents;
	}
    
    public function language($value,$from="zh-CHS",$to="en")
	{
		$value_code=urlencode($value); 
		$appid="78280AF4DFA1CE1676AFE86340C690023A5AC139";  
		//$appid="T6NTnVrl0UdjSEGXmhIG980nh4mAvPFD56-pHyv3odXk*";
		$languageurl = "http://api.microsofttranslator.com/v2/Http.svc/Translate?appId=" . $appid ."&text=" .$value_code. "&from=". $from ."&to=" . $to;
		$text = file_get_contents($languageurl);
		//$text=$this->language_text($languageurl); 
		//preg_match_all("/>(.+)</i",$text,$text_ok,PREG_SET_ORDER); 
		$xmlObj = simplexml_load_string($text);
		$translatedStr="";
		foreach ((array)$xmlObj[0] as $val) {
			$translatedStr = $val;
		}
		//$ru=$text_ok[0][1];
		return $translatedStr;
	}


    public function responseMsg()
    {
		//get post data, May be due to the different environments
		//$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		$postStr =  file_get_contents("php://input");

		$postStr = $postStr ? $postStr : $_SERVER["QUERY_STRING"] ;
		
		$resultStr = "";
		$temp = "";
		$db = getResource();
		$time = time();
		$nowdate = date("Y-m-d");
		$nowdatenum = date("Ymd");
		$nowdatetime =date("Y-m-d H:i:s");
		$nowtime=date("H:i:s");

		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                
                $getmsgType = $postObj->MsgType;
				
                if ($getmsgType=='text'){
					$keyword = trim($postObj->Content)?trim($postObj->Content):"";
					
					if(!empty( $keyword))
					{
						$msgType = "text";
						$firstword=substr($keyword,0,1);
						$subword=trim(substr($keyword,1,strlen($keyword)));
						if(substr($keyword,0,6)=="申请"){
							$subword=trim(substr($keyword,6,strlen($keyword)));
							$temp.=substr($keyword,0,6)."/".$subword;
							$userinfo=explode("+",$subword);
							if($userinfo[0] && $userinfo[1]){
								$sql="select * from userinfo where 1=1 and custid='{$userinfo[0]}' and user_name='{$userinfo[1]}'";
								$res=mysql_query($sql,$db);
								$row = mysql_fetch_array($res);
								$db_user_id=$row["user_id"];
								$db_user_wx_bs=$row["user_wx_bs"]?$row["user_wx_bs"]:"";
								if($db_user_id){
									if($db_user_wx_bs==""){
										$sql="UPDATE userinfo set user_wx_bs='{$fromUsername}' WHERE user_id='{$db_user_id}'";
										$res=mysql_query($sql,$db);
										$msgType = "text";
										$contentStr="绑定成功";
										$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
									}
									else{
										$msgType = "text";
										$contentStr="您已经绑定过微信号，请勿重复绑定";
										$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
									}
								}
								else{
									$msgType = "text";
									$contentStr="尊敬的客户，您好，很抱歉，您还不是本服务号认证客户，服务仅向身份验证过的客户开放，请与您国泰君安当地营业部联系";
									$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
								}
							}
							else{
								$msgType = "text";
								$contentStr="填写的信息有误，请核实";
								$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							}
						}
						else{
							$sql="select * from userinfo where 1=1 and user_wx_bs='{$fromUsername}'";
							$res=mysql_query($sql,$db);
							$row = mysql_fetch_array($res);
							$db_user_id=$row["user_id"]?$row["user_id"]:"";
							$db_user_name=$row["user_name"];
							if($db_user_id==""){
								$msgType = "text";
								$contentStr="尊敬的客户，您好，很抱歉，您还不是本服务号认证客户，服务仅向身份验证过的客户开放，请发送'申请客户号+客户姓名(如:申请000001+张三)'进行验证";
								$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							}
							else{
								if(substr($keyword,0,6)=="公司" or substr($keyword,0,6)=="行业"){								
									$subword=trim(substr($keyword,6,strlen($keyword)));

									if($subword){
										$sql="select a.*,b.get_type_name from action a left join get_type b on a.get_type_id=b.get_type_id where 1=1 and a.get_msgtype_id='1' and (a.get_event like '%{$subword}%' or a.get_event_key like '%{$subword}%' ) order by a.action_id desc limit 1";
										$temp.=$sql."|";
										$res=mysql_query($sql,$db);
										$row = mysql_fetch_array($res);
										$get_type_id=$row['get_type_id']?$row['get_type_id']:"";
										$get_type_name=$row['get_type_name']?$row['get_type_name']:"";
										if($get_type_id!=""){										
											$sql="select * from user_record where 1=1 and user_wx_bs='{$fromUsername}' and get_content='{$keyword}' and last_time like '{$nowdate}%'";
											$temp.=$sql."|";
											$res=mysql_query($sql,$db);
											$row = mysql_fetch_array($res);
											$user_record_id=$row['user_record_id']?$row['user_record_id']:"";
											if($user_record_id!=""){
												$sql="update user_record set last_time='{$nowdatetime}',count=count+1 where user_record_id='{$user_record_id}'";
												$temp.=$sql."|";
												$res=mysql_query($sql,$db);
											}
											else{
												$sql="INSERT INTO user_record(get_type_id,get_type_name,get_content,user_wx_bs,last_time,count)VALUES('{$get_type_id}','{$get_type_name}','{$keyword}','{$fromUsername}','{$nowdatetime}','1')";
												$temp.=$sql."|";
												$res=mysql_query($sql,$db);
											}


										}


										$sql="select * from action where 1=1 and get_msgtype_id='1' and (get_event like '%{$subword}%' or get_event_key like '%{$subword}%' ) order by action_id desc";
										$res=mysql_query($sql,$db);

										$i=0;
										$reply_msgtype_id="";
										$reply_list="";
										
										while($row = mysql_fetch_array($res, MYSQL_ASSOC))
										{
											if($i==1){
												break;
											}
											$action_id=$row['action_id'];
											$reply_msgtype_id=$row['reply_msgtype_id'];
											$reply_url=($row['reply_url'] and $row['reply_url']!="")?$row['reply_url']:(_Host."web/report.html?action_id=".$action_id."&fromusername=".$fromUsername);

											if($reply_msgtype_id=="3"){
												if($reply_list==""){
													//$reply_list=$row['reply_list'];
													$reply_list.=$row['reply_title']."|||".$row['reply_description']."|||".$row['reply_picurl']."|||".$reply_url;
												}
												else{
													$reply_list.=",,,".$row['reply_title']."|||".$row['reply_description']."|||".$row['reply_picurl']."|||".$reply_url;
												}
											}
											elseif($reply_msgtype_id=="1"){
												if($reply_list==""){
													$reply_list=$row['reply_list'];
												}
												else{
													$reply_list.=",,,".$row['reply_list'];
												}
											}

											$i=$i+1;
										}

										$temp.=$reply_msgtype_id."|".$reply_list."|";

										//$reply_list="尊敬的'$db_user_name'客户，您好，您所查找的报告为：\n".$reply_list;
										if($reply_msgtype_id && $reply_list){
											$resultStr = replylist($reply_msgtype_id,$reply_list, $fromUsername, $toUsername, $time);
										}
										else{
											$msgType = "text";
											$contentStr="尊敬的客户，很抱歉，您所搜寻的报告暂时无法找到，您可以直接与范寅 （0571-87245610）进行联系。";
											$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
										}
									}
									else{
										$msgType = "text";
										$contentStr="填写的信息有误，请核实";
										$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
									}
								}
								else
								{
									if($keyword=='test'){
										$Articlecount=1;
										$Article[0]=array("test1","test\nhaha\nceshi","http://tuanimg3.baidu.com/data/2_8df83ddc294f486f990c706a8270a1a6","https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx22464c90a1af1d67&redirect_uri=http%3A%2F%2F114.141.166.14%2Fwx%2Fcompanyviwedetail.jsp%3Faccountid%3D6%26id%3D50000472%26type%3D3&response_type=code&scope=snsapi_base&state=weixin#wechat_redirect");
										$Article[1]=array("test2","","","http://42.121.28.128:8080/wxservice/showmap.php?startlocation=120.095078,30.328026&endlocation=120.093338,30.327613&");
										$Article[2]=array("test3","","","http://42.121.28.128:8080/wxservice/showmap.php?startlocation=120.095078,30.328026&endlocation=120.095078,30.328026&");
										$ArticleString="";
										for ($i=0;$i<=$Articlecount-1;$i++){
											$ArticleItemString=sprintf(ARTICLEITEM,$Article[$i][0], $Article[$i][1], $Article[$i][2], $Article[$i][3]);
											$ArticleString=$ArticleString.$ArticleItemString."\n";
										}
										
										$msgType = "news";								
										$resultStr = sprintf(ARTICLETPL, $fromUsername, $toUsername, $time, $msgType, $Articlecount, $ArticleString);
									}
									else{
										$msgType = "text";
										$contentStr="感谢您的关注，有任何疑问欢迎留言！同时留下您的姓名、联系方式以及对应的客户经理姓名，我们会尽快安排专人为您提供服务！";
										$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
									}
								}
							}
						}
						
					}else{
						echo "Input something...";
					}
                }
                elseif($getmsgType=='event'){
                	$event = $postObj->Event?$postObj->Event:"";
					$eventkey = $postObj->EventKey?$postObj->EventKey:"";

					$temp.=$event."|".$eventkey."|";
                	if($event=='subscribe'){
                		$msgType = "text";
                		$contentStr="\"国泰君安证券浙江分公司\"欢迎您，我们为您提供最及时、最符合市场动向的资讯服务，让您体验国泰君安证券的特色高端服务！ 精彩信息欢迎点击下方菜单。";
						$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	}
					elseif($event=='CLICK'){

						$sql="select * from userinfo where 1=1 and user_wx_bs='{$fromUsername}'";
						$res=mysql_query($sql,$db);
						$row = mysql_fetch_array($res);
						$db_user_id=$row["user_id"]?$row["user_id"]:"";
						$db_user_name=$row["user_name"];
						if($db_user_id==""){
							$msgType = "text";
							$contentStr="尊敬的客户，您好，很抱歉，您还不是本服务号认证客户，服务仅向身份验证过的客户开放，请发送'申请客户号+客户姓名(如:申请000001+张三)'进行验证";
							$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						}
						else{
		

							{
							
								if($eventkey!=""){
									$sql="select * from get_type where 1=1 and get_event_key='{$eventkey}'";
									$temp.=$sql."|";
									$res=mysql_query($sql,$db);
									$row = mysql_fetch_array($res);
									$get_type_id=$row['get_type_id']?$row['get_type_id']:"";
									$get_type_name=$row['get_type_name']?$row['get_type_name']:"";
									if($get_type_id!=""){										
										$sql="select * from user_record where 1=1 and user_wx_bs='{$fromUsername}' and get_event_key='{$eventkey}' and last_time like '{$nowdate}%'";
										$temp.=$sql."|";
										$res=mysql_query($sql,$db);
										$row = mysql_fetch_array($res);
										$user_record_id=$row['user_record_id']?$row['user_record_id']:"";
										if($user_record_id!=""){
											$sql="update user_record set last_time='{$nowdatetime}',count=count+1 where user_record_id='{$user_record_id}'";
											$temp.=$sql."|";
											$res=mysql_query($sql,$db);
										}
										else{
											$sql="INSERT INTO user_record(get_type_id,get_type_name,get_event_key,user_wx_bs,last_time,count)VALUES('{$get_type_id}','{$get_type_name}','{$eventkey}','{$fromUsername}','{$nowdatetime}','1')";
											$temp.=$sql."|";
											$res=mysql_query($sql,$db);
										}


									}


									if(($eventkey=="gtjazj_1_1") and (strtotime($nowtime)<strtotime("08:45:00"))){
										$msgType = "text";
										$contentStr="对不起，本栏目请于8点45分后查询";
										$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
									}
									else{
										if($eventkey=="gtjazj_3_1"){
											$reply_msgtype_id="3";
											$reply_list="宏观报告"."|||".""."|||".(_Host."web/img/hongguan.gif")."|||".(_Host."web/list.html?get_event_key=".$eventkey);
											$resultStr = replylist($reply_msgtype_id,$reply_list, $fromUsername, $toUsername, $time);
										}
										elseif($eventkey=="gtjazj_3_2"){
											$reply_msgtype_id="3";
											$reply_list="策略报告"."|||".""."|||".(_Host."web/img/celue.jpg")."|||".(_Host."web/list.html?get_event_key=".$eventkey);
											$resultStr = replylist($reply_msgtype_id,$reply_list, $fromUsername, $toUsername, $time);
										}
										elseif($eventkey=="gtjazj_3_3"){
											$reply_msgtype_id="3";
											$reply_list="公司报告"."|||".""."|||".(_Host."web/img/gsyjbg.jpg")."|||".(_Host."web/list.html?get_type_id=10");
											$resultStr = replylist($reply_msgtype_id,$reply_list, $fromUsername, $toUsername, $time);
										}
										elseif($eventkey=="gtjazj_3_4"){
											$reply_msgtype_id="3";
											$reply_list="行业报告"."|||".""."|||".(_Host."web/img/hyyjbg.jpg")."|||".(_Host."web/list.html?get_type_id=11");
											$resultStr = replylist($reply_msgtype_id,$reply_list, $fromUsername, $toUsername, $time);
										}
										elseif($eventkey=="gtjazj_1_3"){
											$reply_msgtype_id="3";
											$reply_list="特别报道"."|||".""."|||".(_Host."web/img/tbbd.jpg")."|||".(_Host."web/list.html?get_type_id=3");
											$resultStr = replylist($reply_msgtype_id,$reply_list, $fromUsername, $toUsername, $time);
										}
										else{
											$sql="select * from action where 1=1 and get_msgtype_id='2' and get_event='click' and get_event_key='{$eventkey}' order by action_id desc";
											$temp.=$sql."|";

											$res=mysql_query($sql,$db);

											$i=0;
											$reply_msgtype_id="";
											$reply_list="";
										
											while($row = mysql_fetch_array($res, MYSQL_ASSOC))
											{
												if($i==1){
													break;
												}
												$action_id=$row['action_id'];
												$reply_msgtype_id=$row['reply_msgtype_id'];
												$reply_url=($row['reply_url'] and $row['reply_url']!="")?$row['reply_url']:(_Host."web/reply.html?action_id=".$action_id);

												if($reply_msgtype_id=="3"){
													if($reply_list==""){
														//$reply_list=$row['reply_list'];
														$reply_list.=$row['reply_title']."|||".$row['reply_description']."|||".$row['reply_picurl']."|||".$reply_url;
													}
													else{
														$reply_list.=",,,".$row['reply_title']."|||".$row['reply_description']."|||".$row['reply_picurl']."|||".$reply_url;
													}
												}
												elseif($reply_msgtype_id=="1"){
													if($reply_list==""){
														$reply_list=$row['reply_list'];
													}
													else{
														$reply_list.=",,,".$row['reply_list'];
													}
												}

												$i=$i+1;
											}

											$temp.=$reply_msgtype_id."|".$reply_list."|";


											if($reply_msgtype_id){
												$resultStr = replylist($reply_msgtype_id,$reply_list, $fromUsername, $toUsername, $time);
											}
											else{
												if($eventkey=="gtjazj_1_4"){
													if($db_user_id){
														$msgType = "text";
														$contentStr="尊敬的'$db_user_name'客户，您好，您已经通过申请认证。";
														$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
													}
												}
												else{
													$msgType = "text";
													$temp.="该菜单对应事件'$eventkey'不存在,请核对eventkey";
													$contentStr="该功能还在建设中，敬请期待";
													$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
												}
											}
										}
									}
								}
								else{
									$msgType = "text";
									$temp.="该菜单对应事件为空,请核对eventkey";
									$contentStr="该功能还在建设中，敬请期待";
									$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
								}
							}

						}
                	}
                	else
                	{
                		$msgType = "text";
                		$contentStr="该功能还在建设中，敬请期待";
						$resultStr = sprintf(TEXTTPL, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	}
                }

        }

		echo $resultStr;

		if (_Islog=="1"){
			$nowdate = date("Y-m-d H");
			$nowdatetime =date("Y-m-d H:i:s");
			$log= "time: ".$nowdatetime."\n\n";
			$log.="request: \n";
			$log.=$postStr."\n";
			$log.=print_r($_REQUEST,true)."\n";
			if(!empty($_FILES)){
				$filestr = print_r($_FILES, true);
				$log.="file:\n".$filestr."\n";
			}
			$log.="reply: \n";
			$log.=$resultStr."\n";

			$log.=$temp."\n\n\n";
			
			$logdir = dirname(__FILE__)."/log";
			if (!is_dir($logdir))
			{
				mkdir($logdir);
			}
			$files = scandir($logdir);
			$log.="del: \n";

			foreach ($files as $filename){
				$thisfile=$logdir.'/'.$filename;
				$log.=$thisfile."\n";
				if(($thisfile!='.') && ($thisfile!='..') && ((time()-filemtime($thisfile)) >3600*24*7) ) {

					unlink($thisfile);//删除此次遍历到的文件

				}
			}
			$fp = fopen($logdir."/".$nowdate.".txt","a");
			fwrite($fp,$log."\n");
			fclose($fp);

		}

		exit;
        
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	

	public function check_str($str=''){
		if(trim($str)==''){
			return '';
		}
		$m=mb_strlen($str,'utf-8');
		$s=strlen($str);
		if($s==$m){
			return 1;
		}
		if($s%$m==0&&$s%3==0){
			return 2;
		}
		return 3;
	}
	
}


?>