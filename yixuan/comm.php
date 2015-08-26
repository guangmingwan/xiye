<?php

function curlget($url)
{
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL,$url);

	curl_setopt($curl, CURLOPT_HEADER, 0);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$data = curl_exec($curl);

	curl_close($curl);

	return $data;
}

function check_date($date)

 { $dateArr = explode("-", $date);
   if (is_numeric($dateArr[0]) && is_numeric($dateArr[1]) && is_numeric($dateArr[2]))

 {
    return checkdate($dateArr[1],$dateArr[2],$dateArr[0]);
 }
 return false;
}

function check_time($time)

 { $timeArr = explode(":", $time);
   if (is_numeric($timeArr[0]) && is_numeric($timeArr[1]) && is_numeric($timeArr[2]))

   {
    if (($timeArr[0] >= 0 && $timeArr[0] <= 23) && ($timeArr[1] >= 0 && $timeArr[1] <= 59) && ($timeArr[2] >= 0 && $timeArr[2] <= 59))
    return true;
    else
    return false;
   }
  return false;
}

function makefile($filename,$username,$contentname,$filestr)
{
	$content=_Host.$filename."/".$username."/".$contentname;
	$file=_File.$filename;
	$userfile=_File.$filename."/".$username;
	if (!is_dir($file))
	{
		mkdir($file);
	}
	if ($filestr!=""){
		if (!is_dir($userfile))
		{
			mkdir($userfile);
		}
		$fp = fopen($userfile."/".$contentname,"w");
		if(!$fp){
			return "";
		}else {
				fwrite($fp,$filestr);
				fclose($fp);
				return $content;
		}
	}
	else{
		return "";
	}
}


function keyED($txt,$encrypt_key)
{
	$encrypt_key = md5($encrypt_key);
	$ctr=0;
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)
	{
		if ($ctr==strlen($encrypt_key)) $ctr=0;
		$tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1);
		$ctr++;
	}
	return $tmp;
}
function encrypt($txt,$key)
{
	srand((double)microtime()*1000000);
	$encrypt_key = md5(rand(0,32000));
	$ctr=0;
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)
	{
		if ($ctr==strlen($encrypt_key)) $ctr=0;
		$tmp.= substr($encrypt_key,$ctr,1) .
		(substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
		$ctr++;
	}
	return keyED($tmp,$key);
}
function decrypt($txt,$key)
{
	$txt = keyED($txt,$key);
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)
	{
		$md5 = substr($txt,$i,1);
		$i++;
		$tmp.= (substr($txt,$i,1) ^ $md5);
	}
	return $tmp;
}


function unicode_encode($name)
{
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2)
    {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0)
        {   //两个字节的文字
            $str .= '\u'.base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
        }
        else
        {
            $str .= $c2;
        }
    }
    return $str;
}

//将UNICODE编码后的内容进行解码
function unicode_decode($name)
{
    //转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches))
    {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++)
        {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0)
            {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            }
            else
            {
                $name .= $str;
            }
        }
    }
    return $name;
}

function sexname($sex)
{
	if ($sex=="m"){
		return "男";
	}
	else{
		return "女";
	}
}

function upload($pathfile,$path,$file){
	$pathfile_cn=$pathfile;
	$path_cn=$path;
	if(isChinese($pathfile) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		$pathfile_cn = iconv("UTF-8","gb2312",$pathfile);
	}
	if(isChinese($path) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		$path_cn = iconv("UTF-8","gb2312",$path);
	}
	
	$return["retcode"]="-1";
	$return=array();
	$uploaddir = './'.$pathfile_cn;
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	
	$uploaddir = $uploaddir.'/'.$path_cn;//文件存放目录
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}

	$piece = explode('.',$file['name']);
	$filename=$piece[0].'.'.$piece[1];	
	if(isChinese($filename) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		$filename = iconv("UTF-8","gb2312",$filename);
	}
	$uploadfile = './'.$pathfile_cn .'/'.$path_cn. '/'.$filename;
	//$uploadfile = $uploaddir . '/'.$piece[0].'.'.$piece[1];
	/*if (file_exists($uploadfile)){
		 $return["retcode"]="-1";
		 $return["retmsg"]="该文件已经存在";
	}
	else*/
	if ($file["error"] == UPLOAD_ERR_OK) 
	{
		$result = move_uploaded_file($file['tmp_name'], $uploadfile);
		if(!$result){
			$return["retmsg"]="上传失败";
		}
		else{
			$return["retcode"]="0";
			$return["url"]=_Host.$pathfile."/".$path."/".$piece[0].'.'.$piece[1];
		}
	}
	elseif($file["error"] == UPLOAD_ERR_INI_SIZE){
		$return["retmsg"]='文件超出服务器端大小限制';
	}
	elseif($file["error"] == UPLOAD_ERR_FORM_SIZE){
		$return["retmsg"]='文件超出表单大小限制';
	}
	elseif($file["error"] == UPLOAD_ERR_PARTIAL){
		$return["retmsg"]='文件只有部分被上传';
	}
	elseif($file["error"] == UPLOAD_ERR_NO_FILE){
		$return["retcode"]="-2";
		$return["retmsg"]='没有文件被上传';
	}
	elseif($file["error"] == UPLOAD_ERR_NO_TMP_DIR){
		$return["retmsg"]='找不到临时文件夹';
	}
	elseif($file["error"] == UPLOAD_ERR_CANT_WRITE){
		$return["retmsg"]='文件写入失败';
	}
	

	return $return;
}


function upload_multi($pathfile,$path,$file,$i){
	
	$pathfile_cn=$pathfile;
	$path_cn=$path;
	if(isChinese($pathfile) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		$pathfile_cn = iconv("UTF-8","gb2312",$pathfile);
	}
	if(isChinese($path) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		$path_cn = iconv("UTF-8","gb2312",$path);
	}
	
	$return=array();
	$return["retcode"]="-1";
	$uploaddir = './'.$pathfile_cn;
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	
	$uploaddir = $uploaddir.'/'.$path_cn;//文件存放目录
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	$piece = explode('.',$file['name'][$i]);
	$filename=$piece[0].'.'.$piece[1];	
	if(isChinese($filename) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		//$filename = urlencode($filename);
		$filename = iconv("UTF-8","gb2312",$filename);
	}
	$uploadfile = './'.$pathfile_cn .'/'.$path_cn. '/'.$filename;
	/*if (file_exists($uploadfile)){
		 $return["retcode"]="-1";
		 $return["retmsg"]="该文件已经存在";
	}
	else*/
	/*{
		$result = move_uploaded_file($file['tmp_name'][$i], $uploadfile);
		if(!$result){
			$return["retcode"]="-1";
			$return["retmsg"]="上传失败";
		}
	}
	$return["url"]=_Host.$pathfile .'/'.$path. '/'.$piece[0].'.'.$piece[1];
	*/
	
	if ($file["error"][$i] == UPLOAD_ERR_OK) 
	{
		$result = move_uploaded_file($file['tmp_name'][$i], $uploadfile);
		if(!$result){
			$return["retmsg"]="上传失败";
		}
		else{
			$return["retcode"]="0";
			$return["url"]=_Host.$pathfile."/".$path."/".$piece[0].'.'.$piece[1];
		}
	}
	elseif($file["error"][$i] == UPLOAD_ERR_INI_SIZE){
		$return["retmsg"]='文件超出服务器端大小限制';
	}
	elseif($file["error"][$i] == UPLOAD_ERR_FORM_SIZE){
		$return["retmsg"]='文件超出表单大小限制';
	}
	elseif($file["error"][$i] == UPLOAD_ERR_PARTIAL){
		$return["retmsg"]='文件只有部分被上传';
	}
	elseif($file["error"][$i] == UPLOAD_ERR_NO_FILE){
		$return["retcode"]="-2";
		$return["retmsg"]='没有文件被上传';
	}
	elseif($file["error"][$i] == UPLOAD_ERR_NO_TMP_DIR){
		$return["retmsg"]='找不到临时文件夹';
	}
	elseif($file["error"][$i] == UPLOAD_ERR_CANT_WRITE){
		$return["retmsg"]='文件写入失败';
	}

	return $return;
}

function makehtml($file,$content){
	$content="<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv=\"Content-type\" content=\"text/html;charset=UTF-8\"/>
			</head>
		<body>".$content."</body>
		</html>";
		
		$file=_Upload_File."/".$file."/";
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
		return $url;
}

function isChinese($getStr)
{
	return (preg_match("/[\x80-\xff]./", $getStr));
}

function get_basename($filename){  
	return preg_replace('/^.+[\\\\\\/]/', '', $filename);  
} 

?>