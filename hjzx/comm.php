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
	$return["retcode"]="-1";
	$return=array();
	$uploaddir = _File.$pathfile;
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	
	$uploaddir = $uploaddir.'/'.$path;//文件存放目录
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	
	if(!checkArray($file)){
		$return["retcode"]="-2";
		$return["errmsg"]='没有文件被上传';
	}

	$piece = explode('.',$file['name']);
	$uploadfile = $uploaddir . '/'.$piece[0].'.'.$piece[1];
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
	$return=array();
	$return["retcode"]="-1";
	$uploaddir = _File.$pathfile;
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	
	$uploaddir = $uploaddir.'/'.$path;//文件存放目录
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	
	if(!checkArray($file)){
		$return["retcode"]="-2";
		$return["retmsg"]='没有文件被上传';
	}

	$piece = explode('.',$file['name'][$i]);
	$uploadfile = $uploaddir . '/'.$piece[0].'.'.$piece[1];
	
	/*if (file_exists($uploadfile)){
		 $return["retcode"]="-1";
		 $return["retmsg"]="该文件已经存在";
	}
	else*/
	if ($file["error"][$i] == UPLOAD_ERR_OK) 
	{
		$result = move_uploaded_file($file['tmp_name'][$i], $uploadfile);
		if(!$result){
			$return["retmsg"]="上传失败".$uploadfile;
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

function upload2($pathfile,$path,$file,$newfile){

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
	if(!checkArray($file)){
		$return["retcode"]="-2";
		$return["retmsg"]='没有文件被上传';
		return $return;
	}
	/*$uploaddir = './'.$pathfile_cn;
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	
	$uploaddir = $uploaddir.'/'.$path_cn;//文件存放目录
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}*/
	
	//$uploadfile = $uploaddir . '/'.$piece[0].'.'.$piece[1];
	/*if (file_exists($uploadfile)){
		 $return["retcode"]="-1";
		 $return["retmsg"]="该文件已经存在";
	}
	else*/
	if ($file["error"] == UPLOAD_ERR_OK) 
	{
		path(_File.$pathfile_cn,$path_cn);

		$piece = explode('.',$file['name']);
		$filename=$piece[0].'.'.$piece[1];	
		if(isChinese($filename) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
			$filename = iconv("UTF-8","gb2312",$filename);
		}
		$uploadfile = _File.$pathfile_cn .'/'.$path_cn. '/'.$newfile.'.'.$piece[1];
		
		$result = move_uploaded_file($file['tmp_name'], $uploadfile);
		if(!$result){
			$return["retmsg"]="上传失败";
		}
		else{
			$return["retcode"]="0";
			$return["url"]=_Host.$pathfile."/".$path."/".$newfile.'.'.$piece[1];
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


function upload_multi2($pathfile,$path,$file,$newfile,$i){
	
	$pathfile_cn=$pathfile;
	$path_cn=$path;
	if(isChinese($pathfile) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		$pathfile_cn = iconv("UTF-8","gb2312",$pathfile);
	}
	if(isChinese($path) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
		$path_cn = iconv("UTF-8","gb2312",$path);
	}
	
	$return=array();
	$return["retcode"]="0";
	
	if(!checkArray($file)){
		$return["retcode"]="-2";
		$return["retmsg"]='没有文件被上传';
		return $return;
	}
	
	//$uploaddir = './'.$pathfile_cn;
	/*if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}
	
	$uploaddir = $uploaddir.'/'.$path_cn;//文件存放目录
	if (!is_dir($uploaddir))
	{
		mkdir($uploaddir);
	}*/
	
	
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
		path(_File.$pathfile_cn,$path_cn);
	
		$piece = explode('.',$file['name'][$i]);
		$filename=$piece[0].'.'.$piece[1];	
		if(isChinese($filename) and (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')){
			//$filename = urlencode($filename);
			$filename = iconv("UTF-8","gb2312",$filename);
		}
		$uploadfile = _File.$pathfile_cn .'/'.$path_cn. '/'.$newfile.'_'.$i.'.'.$piece[1];
	
		$result = move_uploaded_file($file['tmp_name'][$i], $uploadfile);
		if(!$result){
			$return["retmsg"]="上传失败";
		}
		else{
			$return["retcode"]="0";
			$return["url"]=_Host.$pathfile."/".$path."/".$newfile.'_'.$i.'.'.$piece[1];
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

function path($pathfile,$path){
	if (!is_dir($pathfile))
	{
		mkdir($pathfile);
	}
	$pathpiece = explode('/',$path);
	
	foreach($pathpiece as $key=>$value){
		$pathfile=$pathfile."/".$value;
		if (!is_dir($pathfile))
		{
			mkdir($pathfile);
		}
	}
	
}


function toexcelnum($i){
	$result="";
	while($i!=-1){
		$j=fmod($i,26);
		$result=chr(65+$j).$result;
		$i=floor(($i)/26-1);
	}

	return $result;
}


function isChinese($getStr)
{
	return (preg_match("/[\x80-\xff]./", $getStr));
}

function checkArray($array){

	if(count($array)>0){
		return true;
	}
	else{
		return false;
	}
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


function checkphone($str){
	if(strlen($str) == "11") 
	{ 
		//上面部分判断长度是不是11位 
		$n = preg_match_all("/^1[3458][0-9]{9}$/",$str,$array); 
		if($n){
			return true;
		}
		else{
			return false;
		}

	}
	else 
	{ 
		return false;
	} 
}

function getdistance($lng1,$lat1,$lng2,$lat2)//根据经纬度计算距离
{
	//将角度转为弧度 
	$radLat1=deg2rad($lat1);
	$radLat2=deg2rad($lat2);
	$radLng1=deg2rad($lng1);
	$radLng2=deg2rad($lng2);
	$a=$radLat1-$radLat2;//两纬度之差,纬度<90
	$b=$radLng1-$radLng2;//两经度之差纬度<180
	$s=2*asin(sqrt(pow(sin($a/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137;
	return $s;
}

function do_mencrypt($input, $key)
{
	$input = str_replace("\n", "", $input);
	$input = str_replace("\t", "", $input);
	$input = str_replace("\r", "", $input);
	$key = substr(md5($key), 0, 24);
	$td = mcrypt_module_open('tripledes', '', 'ecb', '');
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	mcrypt_generic_init($td, $key, $iv);
	$encrypted_data = mcrypt_generic($td, $input);
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	return trim(chop(base64_encode($encrypted_data)));
}

//$input - stuff to decrypt
//$key - the secret key to use

function do_mdecrypt($input, $key)
{
	$input = str_replace("\n", "", $input);
	$input = str_replace("\t", "", $input);
	$input = str_replace("\r", "", $input);
	$input = trim(chop(base64_decode($input)));
	$td = mcrypt_module_open('tripledes', '', 'ecb', '');
	$key = substr(md5($key), 0, 24);
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	mcrypt_generic_init($td, $key, $iv);
	$decrypted_data = mdecrypt_generic($td, $input);
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	return trim(chop($decrypted_data));
 }

 
function getArray($node) {
	$array = false;

	if ($node->hasAttributes()) {
		foreach ($node->attributes as $attr) {
			$array[$attr->nodeName] = $attr->nodeValue;
		}
	}

	if ($node->hasChildNodes()) {
		if ($node->childNodes->length == 1) {
			$array[$node->firstChild->nodeName] = getArray($node->firstChild);
		} else {
			foreach ($node->childNodes as $childNode) {
				if ($childNode->nodeType != XML_TEXT_NODE) {
					$array[$childNode->nodeName][] = getArray($childNode);
				}
			}
		}
	} else {
		return $node->nodeValue;
	}
	return $array;
}
 
 

?>