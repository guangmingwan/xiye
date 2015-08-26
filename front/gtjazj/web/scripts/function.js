var posturl="http://115.28.214.155:80/gtjazj/index.php";

function main(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var async = arguments[2] ? arguments[2] : "false";
	var extend = arguments[3] ? arguments[3] : "";
	
	$.ajax({
		async: async,
		type: 'post',
		data: 'cmd='+cmd+'&'+cmdlist,
		timeout:'30000',
		url: posturl,
		success: function(result) {
			if (result) {
				var jsonobj=json_decode(result);
				var retcode=jsonobj.errcode;
				var retmsg=decodeURIComponent(jsonobj.errmsg);
				if(retcode=="0"){	
					if (cmd=="querylist"){
						if(extend=="1"){
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
	
								$("[name='reply_title']").html(jsonobj.data[i].reply_title);
								$("[name='reply_date']").html(jsonobj.data[i].reply_date);
								$("[name='reply_list']").html(str_replace("\n","<br>",str_replace("\r","<br>",jsonobj.data[i].reply_list)));
	
							}
						}
						else if(extend=="2"){
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
	
								$("#media img").attr("src",jsonobj.data[i].reply_picurl);
								$("#activity-name").html(jsonobj.data[i].reply_title);
								$("#post-date").html(jsonobj.data[i].reply_date);
								$(".text").html(str_replace("\n","<br>",str_replace("\r","<br>",jsonobj.data[i].reply_list)));
	
							}
						}
						else if(extend=="3"){
							$("#wxgl tbody").empty();
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
								
								var dbclickstr='dbclick("querylist","action_id='+jsonobj.data[i].action_id+'")';
								var delclickstr='del("del_action","action_id='+jsonobj.data[i].action_id+'")';
	
								var str="<tr ondblclick='"+dbclickstr+"'>";
								str+="<td class='action_id'>" + jsonobj.data[i].action_id + "</td>";
								str+="<td class='get_type_name'>" + jsonobj.data[i].get_type_name + "</td>";
								str+="<td class='reply_title'>" + jsonobj.data[i].reply_title + "</td>";
								str+="<td class='reply_date'>" + jsonobj.data[i].reply_date + "</td>";
								str+="<td class='btn-link' ><a onClick='"+dbclickstr+"'>" + "编辑" + "</a>"+"|"+"<a onClick='"+delclickstr+"'>" + "删除" + "</a></td>";
								str+="</tr>";
						
								$("#wxgl tbody").append(str);
							}
							
							tablePaging2("wxgl",0,"8",true,"desc",".action_id","number","");
						}
						else if(extend=="4"){
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
								
								reset_2();
								
								$("[name='action_id']").val(jsonobj.data[i].action_id);
								$("[name='get_type_id']").val(jsonobj.data[i].get_type_id);
								change("get_type_id");
								$("[name='reply_msgtype_id']").val(jsonobj.data[i].reply_msgtype_id);
								$("[name='reply_date']").val(jsonobj.data[i].reply_date);
								$("[name='get_event_key']").val(jsonobj.data[i].get_event_key);
								$("[name='get_event']").val(jsonobj.data[i].get_event);
								$("[name='reply_title']").val(jsonobj.data[i].reply_title);
								$("[name='reply_url']").val(jsonobj.data[i].reply_url);
								$("[name='reply_description']").val(jsonobj.data[i].reply_description);
								$("[name='reply_list']").val(jsonobj.data[i].reply_list);
								
								$("img[name='action_pic']").attr("src",jsonobj.data[i].reply_picurl);
														
							}
						}
						else{
							$("table tbody").empty();
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
	
								var str="<tr>";
								str+="<td class='reply_title'><a href=\"report.html?action_id="+jsonobj.data[i].action_id+"\">" + jsonobj.data[i].reply_title + "</a></td>";
								str+="<td class='reply_date'>" + jsonobj.data[i].reply_date + "</td>";
								str+="</tr>";
						
								$("table tbody").append(str);
							}
						}
               	
					}
					else if (cmd=="query_get_type"){
						$("[name='select_get_type_id']").empty();
						$("[name='get_type_id']").empty();
						var str="";
						
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}

							str+="<option value=\""+jsonobj.data[i].get_type_id+"\">"+jsonobj.data[i].get_type_name+"</option>"
						}
						
						$("[name='get_type_id']").append(str);
												
						str="<option value=\"\">全部</option>"+str;
						
						$("[name='select_get_type_id']").append(str);
						
					}
					else if (cmd=="queryuserinfo"){
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}

							$("[name='user_name']").html(jsonobj.data[i].user_name);
						}
					}
					else if (cmd=="del_action"){
						alert(retmsg);
						query('action');
					}
					else if (cmd=="query_maxid"){
						var max_action_id=jsonobj.max_action_id?jsonobj.max_action_id:"";
						$("[name='action_id']").val(parseInt(max_action_id)+1);
					}
					else if (cmd=="query_user_record"){
						$("#lhgl tbody").empty();
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}

							var str="<tr>";
							str+="<td class='user_record_id' style='display:none'>" + jsonobj.data[i].user_record_id + "</td>";
							str+="<td class='custid'>" + jsonobj.data[i].custid + "</td>";
							str+="<td class='user_name'>" + jsonobj.data[i].user_name + "</td>";
							str+="<td class='brhid'>" + jsonobj.data[i].brhid + "</td>";
							str+="<td class='get_type_name'>" + jsonobj.data[i].get_type_name + "</td>";
							str+="<td class='get_content'>" + jsonobj.data[i].get_content + "</td>";
							str+="<td class='last_time'>" + jsonobj.data[i].last_time + "</td>";
							str+="<td class='count'>" + jsonobj.data[i].count + "</td>";
							str+="</tr>";
					
							$("#lhgl tbody").append(str);
						}
						
						tablePaging2("lhgl",0,"8",true,"desc",".user_record_id","number","");
					}
					else if (cmd=="adminlogin"){
						window.location.href="manage.html";
					}
					else if (cmd=="adminloginout"){
						window.location.href="index.html";
					}
					else if (cmd=="queryadmininfo"){
						var admin_id=jsonobj.admin_id?jsonobj.admin_id:"";
						var admin_name=jsonobj.admin_name?jsonobj.admin_name:"";
						$("#admin_id").val(admin_id);
						$("#admin_name").val(admin_name);
						if(admin_id==""){
							alert("请先登陆");
							window.location.href="index.html";
						}
					}
					else{					
						alert(retmsg);
					}
				}
				else{
					if(cmd=="adminlogin"){
						alert(retmsg);
					}
					else{
						alert(retmsg);
					}					
				}
			}
			else {
			   alert("操作失败");
			}
		}
	});
}

function bclick(cmd,cmdlist){
	$("form").show();
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	if (cmd=="query_auction"){
		$("#auction").hide();
		
		$("#auction_mx_form").show();
		$("#auction_mx_table").hide();
		$("form")[0].reset();
		
		var auction_id=cmdarr["auction_id"] ? cmdarr["auction_id"] : "";
		var product_type_mx_id=cmdarr["product_type_mx_id"] ? cmdarr["product_type_mx_id"] : "";
		var auction=cmdarr["auction"] ? cmdarr["auction"] : "";
		var auction_price=cmdarr["auction_price"] ? cmdarr["auction_price"] : "";
		var auction_count=cmdarr["auction_count"] ? cmdarr["auction_count"] : "";

		$("input[name='auction_id']").val(auction_id);
		$("input[name='product_type_mx_id']").val(product_type_mx_id);
		$("input[name='auction']").val(auction);
		$("input[name='auction_price']").val(auction_price);
		$("input[name='auction_count']").val(auction_count);
	}
}

function dbclick(cmd,cmdlist){
	$("form").show();
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	if(cmd=="querylist"){
		$("#wxgl").hide();
		
		var action_id=cmdarr["action_id"] ? cmdarr["action_id"] : "";
		
		main("querylist","action_id="+action_id,"false","4");
	}
	
}


function newadd(cmd){
	$("form").show();
	if(cmd=="wxgl"){
		$("#wxgl").hide();
		
		reset_2();
		$("input[name='dh_wp_type_id']").focus();
		
		main("query_maxid");
		change("get_type_id");
	}
	
}

function save(cmd){
	if(cmd=="wxgl"){
		var action_id=$("[name='action_id']").val();
		var get_type_id=$("[name='get_type_id']").val();
		var reply_msgtype_id=$("[name='reply_msgtype_id']").val();
		var get_msgtype_id=$("[name='get_msgtype_id']").val();
		var reply_date=$("[name='reply_date']").val();
		var get_event_key=$("[name='get_event_key']").val();
		var get_event=$("[name='get_event']").val();
		var reply_title=$("[name='reply_title']").val();
		var reply_url=$("[name='reply_url']").val();
		reply_url=encodeURIComponent(reply_url);
		var reply_description=$("[name='reply_description']").val();
		var reply_list=$("[name='reply_list']").val();
		if(action_id==""){
			alert("编号不能为空");
			return;
		}
		main("add_action","action_id="+action_id+"&get_type_id="+get_type_id+"&reply_msgtype_id="+reply_msgtype_id+"&get_msgtype_id="+get_type_id+"&get_msgtype_id="+get_msgtype_id+"&reply_date="+reply_date+"&get_event_key="+get_event_key+"&get_event="+get_event+"&reply_title="+reply_title+"&reply_url="+reply_url+"&reply_description="+reply_description+"&reply_list="+reply_list);
	}
}

function del(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	if(confirm("是否确认删除")){
		if(cmd=="del_action"){
			var action_id=cmdarr["action_id"] ? cmdarr["action_id"] : "";
			if(action_id==""){
				alert("编号不能为空");
				return;
			}
			main("del_action","action_id="+action_id);
		}
	}
}

function cancel(cmd){
	$("form").hide();
	if(cmd=="wxgl"){
		$("#wxgl").show();	
		query('action');
	}
	
}

function table_refresh(cmd){
	if (cmd=="dd"){
		main("queryddglmx","dd_id="+$("#dd_id").val(),"false","1");	
	}
}

function query(cmd){
	if (cmd=="action"){
		main("querylist","action_id="+$("[name='select_action_id']").val()+"&get_type_id="+$("[name='select_get_type_id']").val()+"&reply_title="+$("[name='select_reply_title']").val()+"&reply_description="+$("[name='select_reply_description']").val()+"&begin_date="+$("[name='select_begin_date']").val()+"&end_date="+$("[name='select_end_date']").val(),"false","3");
	}
	else if(cmd=="user_record"){
		main("query_user_record","custid="+$("[name='select_custid']").val()+"&get_type_id="+$("[name='select_get_type_id']").val()+"&user_name="+$("[name='select_user_name']").val()+"&brhid="+$("[name='select_brhid']").val()+"&begin_date="+$("[name='select_begin_date']").val()+"&end_date="+$("[name='select_end_date']").val());
	}
}

function change(cmd){
	if (cmd=="get_type_id"){
		var get_type_id=$("[name='get_type_id']").val();
		var reply_msgtype_id=$("[name='reply_msgtype_id']").val();
		$(".dmmc").hide();
		if(get_type_id=="1"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_1_1");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="2"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_1_2");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="3"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_1_3");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="4"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_1_4");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="5"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_2_1");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="6"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_2_2");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="7"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_2_3");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="8"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_3_1");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="9"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_3_2");
			$("[name='get_event']").val("click");
		}
		else if(get_type_id=="10"){
			if(reply_msgtype_id=="3"){
				$("[name='get_msgtype_id']").val("1");
				$(".dmmc").show();
				$("[name='get_event_key']").val("");
				$("[name='get_event']").val("");
			}
			else if(reply_msgtype_id=="1"){
				$("[name='get_msgtype_id']").val("2");
				$(".dmmc").hide();
				$("[name='get_event_key']").val("gtjazj_3_3");
				$("[name='get_event']").val("click");
			}
		}
		else if(get_type_id=="11"){
			if(reply_msgtype_id=="3"){
				$("[name='get_msgtype_id']").val("1");
				$(".dmmc").show();
				$("[name='get_event_key']").val("");
				$("[name='get_event']").val("");
			}
			else if(reply_msgtype_id=="1"){
				$("[name='get_msgtype_id']").val("2");
				$("[name='get_event_key']").val("gtjazj_3_4");
				$("[name='get_event']").val("click");
			}
		}
		else if(get_type_id=="12"){
			$("[name='get_msgtype_id']").val("2");
			$("[name='get_event_key']").val("gtjazj_3_5");
			$("[name='get_event']").val("click");
		}
	}
}

function choose(cmd){
	if (cmd=="price"){
		if($("#price :checkbox").is(":checked")){
			$("#price :checkbox").prop("checked",false);
		}
		else{
			$("#price :checkbox").prop("checked","checked");
		}
	}
}




function logininit(){
	var admin_name=getCookie("admin_name");
	var admin_pwd=getCookie("admin_pwd");
	var admin_remenber=getCookie("admin_remenber");
	var admin_autologin=getCookie("admin_autologin");
	if(admin_name){
		$("#admin_name").val(admin_name);
	}
	if(admin_pwd){
		$("#admin_pwd").val(admin_pwd);
	}
	if(admin_remenber){
		if(admin_remenber=="1"){
			$("#admin_remenber").attr("checked","checked");
		}
	}
	if(admin_autologin){
		if(admin_autologin=="1"){
			$("#admin_autologin").attr("checked","checked");
			login();
		}
	}
	
}

function login() {
	main("adminlogin","admin_name="+$("#admin_name").val()+"&admin_pwd="+base64_encode($("#admin_pwd").val()));
}

function loginout(){
	if(confirm("是否确认退出")){
		main("adminloginout","admin_id="+$("#admin_id").val());
    }
}

function action_init(){
	//main("queryddgl");
	action_upload();
}

function action_upload() {
	$('#action_form').fileupload({
		url: posturl,
		dataType: 'json',
		autoUpload: false,
		replaceFileInput: false,
		acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
		// Enable image resizing, except for Android and Opera,
		// which actually support image resizing, but fail to
		// send Blob objects via XHR requests:
		disableImageResize: /Android(?!.*Chrome)|Opera/
			.test(window.navigator.userAgent),
		previewMaxWidth: 140,
		previewMaxHeight: 140,
		previewMinWidth: 140,
		previewMinHeight: 140,
		previewCrop: true,
		processstart: function (e, data) {
			$("#pic_progress .progress-bar").css(
				'width',
				'0%'
			);
		},
		progress: function (e, data) {
			$("#pic_progress").show();
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$("#pic_progress .progress-bar").css(
				'width',
				progress + '%'
			);
		},
		always:function (e, data) {
			var jqXHR=data.jqXHR;
			var result2=data.result;
			if(jqXHR.status == 200  || jqXHR.status == 0) {
				 var result=jqXHR.responseText;
				 if (result) {
					var jsonobj=eval('('+result+')');
					var retcode=jsonobj.errcode;
					var retmsg=decodeURIComponent(jsonobj.errmsg);
					$("#pic_progress").hide();
					if(retcode=="0"){
						alert(retmsg);
					}
					else{
						alert(retmsg);
					}
				}
				else {
					if(result2){
						var retcode=result2.errcode;
						var retmsg=decodeURIComponent(result2.errmsg);
						$("#pic_progress").hide();
						if(retcode=="0"){
							alert(retmsg);
						}
						else{
							alert(retmsg);
						}
					}
					else{
						alert("操作失败");
					}
				}
			}
		}
    }).on('fileuploadadd', function (e, data) {
		$("img[name='action_pic']").hide();
		$("#files").empty();
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>').append("");
            node.appendTo(data.context);	
        });
		$("#save").removeAttr("onclick");
		$("#save").unbind("click");
		$("#save").on('click', function () {
           	var action_id=$("input[name='action_id']").val();
	
			if(action_id==""){
				alert("编号不能为空");
				return;
			}
 
            var form = $("#action_form");
            form.attr('method', 'post');
            form.attr('enctype', 'multipart/form-data');
            form.attr('action', posturl);
			 data.submit();
		});
    }).on('fileuploadprocessalways', function (e, data) {
		var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node.prepend('<br>').prepend(file.preview);
			$("canvas").addClass("img-thumbnail");
        }
        if (file.error) {
            node.append('<br>').append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button').text('Upload').prop('disabled', !! data.files.error);
        }
    });
}

function reset_2() {
    $("form")[0].reset();
    $("[name='action_pic']").attr("src","");
	$("img").show();
	$("#files").empty();
	$("#pic_progress").hide();
}

function reset() {
    $("#admin_name").val("");
    $("#admin_pwd").val("");
    $("#admin_remenber").removeAttr("checked");
    $("#admin_autologin").removeAttr("checked");
}

function ifts(ts){
	if(ts=="1"){
		return "是";
	}
	else{
		return "否";
	}
}

function showhtml(html){
	window.location.href=html;
}

function goto(nexthtml){
	$("#subframe").attr("src",nexthtml);
}

function goback(main){
	$("#"+main).show();
	$("#"+main+"mx").hide();
}

function check(id){
	if ($("#"+id).attr("checked")=="checked"){
		return "1";
	}
	else{
		return "0";
	}
}

//setCookie(”name”,”hayden”);
function setCookie(name,value)
{
	var Days = 30;
	var exp = new Date(); 
	exp.setTime(exp.getTime() + Days*24*60*60*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

//setCookie(”name”,”hayden”,”s20″);
function setCookie_time(name,value,time){
	var strsec = getsec(time);
	var exp = new Date();
	exp.setTime(exp.getTime() + strsec*1);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function getsec(str){
	alert(str);
	var str1=str.substring(1,str.length)*1; 
	var str2=str.substring(0,1); 
	if (str2=="s"){
		return str1*1000;
	}else if (str2=="h"){
		return str1*60*60*1000;
	}else if (str2=="d"){
		return str1*24*60*60*1000;
	}
}

function getCookie(name)
{
  var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
  if(arr != null) return unescape(arr[2]); 
  return null;
}

function get_cookie(name) {
	var start = document.cookie.indexOf(name + "=");
	var len = start + name.length + 1;
	if ((!start) && (name != document.cookie.substring(0, name.length )))
	{
	  return null;
	}
	if (start == -1) return null;
	var end = document.cookie.indexOf(";", len);
	if (end == -1) end = document.cookie.length;
	return unescape(document.cookie.substring(len, end));
}

function delCookie(name)
{
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval=getCookie(name);
	if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}

function input(data){
	str="<input  class=\"form-control\" value='" + data + "'/>";
	return str;
}

function textarea(data){
	str="<textarea>"+data+"</textarea>";
	return str;
}

function order(data){
	str="<p href='#' onclick='" + data + "'></p>";
	return str;
}

function file(name,i){
	str="<file ><input type='file' name='"+name+"["+i+"]' style='width:200px' style='background-color:#FFFFFF'/></file>";
	return str;
}


function img(url){
	if(url!=""){
		str="<a href='"+url+"' target=\"_blank\"><image src='"+url+"'/></a>";
	}
	else{
		str="<a><image src='"+url+"'/></a>";
	}	
	return str;
}

function frame(url){	
	url=geturl(url);
	str="<iframe src = "+url+"></iframe>";
	return str;
	
	/*str="<object classid=\"clsid:CA8A9780-280D-11CF-A24D-444553540000\" width=\"200\" height=\"200\" border=\"0\">"  
	str+="<param name=\"_Version\" value=\"65539\">";  
	str+="<param name=\"_ExtentX\" value=\"20108\">";  
	str+="<param name=\"_ExtentY\" value=\"10866\">";  
	str+="<param name=\"_StockProps\" value=\"0\">";  
	str+="<param name=\"SRC\" value=\"1.pdf\">";  
	str+="<object data=\""+url+"\" type=\"application/pdf\" style=\"max-height:200px;max-width:200px;\" class=\"hiddenObjectForIE\">";   
	str+=" alt : <a href=\""+url+"\">"+url+"</a>";  
	str+="</object>";  
	str+="</object>";
	return str;*/
}

function geturl(url){
	str=""+url.substring(26,url.length);
	return str;
}

function tablePaging2(){
	var tmptable = arguments[0] ? arguments[0] : ""; 
	var pageIndex = arguments[1] ? arguments[1] : 0;
    var pageSize = arguments[2] ? arguments[2] : 3; 
    var sorting = arguments[3] ? arguments[3] : false;
    var sortDirection = arguments[4] ? arguments[4] : "asc";
    var sortSelector = arguments[5] ? arguments[5] : '';
    var sortType = arguments[6] ? arguments[6] : '';
    var onPaged = arguments[7] ? arguments[7] : null;
    
    //alert(table+"\n"+pageSize+"\n"+sorting+"\n"+sortDirection+"\n"+sortSelector+"\n"+sortType+"\n"+onPaged+"\n");
	
	if (sorting) {
		tableSort2(tmptable,sortSelector, sortType, sortDirection);

	}
	table='#'+tmptable;
	var pageSize = parseInt(pageSize);
	
	var trResult = $(table).find('tbody:first tr');
	var trLen = trResult.length;
	if (pageIndex * pageSize == trLen && trLen != 0) {
		pageIndex = pageIndex - 1; // make sure the last page will show right
	}
	var trs = $(table+" tbody").find('tr');
	var trsLen = trs.length;
	trs.hide();
	trs.slice(pageIndex * pageSize, (pageIndex + 1) * pageSize).show();

	var allPage = Math.ceil(parseInt(trLen) / pageSize);
	var tablepaging='#'+tmptable + ' .search-for';
	if (allPage > 1) {
		$(tablepaging).empty();
		queue = tablepaging;
		nowpageindex=pageIndex + 1;
		$(queue).append('<p class="paging text-center"><a id="prePage" >上一页</a> | ' + nowpageindex + '/' + allPage + ' | <a id="nextPage" >下一页</a></p>');
		$(tablepaging+" #prePage").bind("click",function () {
			var toPageIndex = pageIndex - 1;
			if (toPageIndex < 0){
				toPageIndex = 0;
			}
			else{
				tablePaging2(tmptable,toPageIndex,pageSize,sorting,sortDirection,sortSelector,sortType,onPaged);
			}
		});
		$(tablepaging+" #nextPage").bind("click",function () {
			var toPageIndex = pageIndex + 1;
			if (toPageIndex >= allPage){
				toPageIndex = allPage-1;
			}
			else{
				tablePaging2(tmptable,toPageIndex,pageSize,sorting,sortDirection,sortSelector,sortType,onPaged);
			}
		});
	}
	else {
		$(tablepaging).empty();
	}
}

function tableSort2() {
	var table = arguments[0] ? arguments[0] : ""; 
    var sortBySelector = arguments[1] ? arguments[1] : ""; 
    var type = arguments[2] ? arguments[2] : "number";
    var sortDirection = arguments[3] ? arguments[3] : "asc";
	$('#' + table).find('tbody').each(function (i, element) {
		var trs = $(element).find('tr');
		var tmp = [];
		for (var i = 0; i < trs.length; i++) {
			tmp.push(trs[i]);
		}
		if (type == "number") {
			tmp.sort(function (a, b) {
				var inta = Number($.trim($(a).find(sortBySelector).html()));
				var intb = Number($.trim($(b).find(sortBySelector).html()));
				//var inta = Number($.trim($(a).find(sortBySelector).val()));
				//var intb = Number($.trim($(b).find(sortBySelector).val()));
				//alert("inta="+inta+" intb="+intb);
				var returnValue = 0;
				if (inta > intb) returnValue = 1;
				else if (inta < intb) returnValue = -1;
				if (sortDirection == "desc") returnValue = -returnValue;
				return returnValue;
			});
		}
		else if (type === "date") {
			tmp.sort(function (a, b) {
				var datea = parseDate($.trim($(a).find(sortBySelector).html()));
				var dateb = parseDate($.trim($(b).find(sortBySelector).html()));
				var returnValue = 0;
				if (datea > dateb) returnValue = 1;
				else if (datea < dateb) returnValue = -1;
				if (sortDirection == "desc") returnValue = -returnValue;
				return returnValue;
			});
		}
		else {
			tmp.sort(function (a, b) {
				var stra = $.trim($(a).find(sortBySelector).html());
				var strb = $.trim($(b).find(sortBySelector).html());
				//alert("sortBySelector="+sortBySelector+"stra="+stra+" strb="+strb);
				var returnValue = 0;
				if (stra > strb) returnValue = 1;
				else if (stra < strb) returnValue = -1;
				if (sortDirection == "desc") returnValue = -returnValue;

				return returnValue;
			});
		}

		for (var i = 0; i < tmp.length; i++) {
			trs[i] = tmp[i];
		}

		$(element).empty().append(trs);
	});

}


function tablePaging(){
	var tmptable = arguments[0] ? arguments[0] : ""; 
	var pageIndex = arguments[1] ? arguments[1] : 0;
    var pageSize = arguments[2] ? arguments[2] : 3; 
    var sorting = arguments[3] ? arguments[3] : false;
    var sortDirection = arguments[4] ? arguments[4] : "asc";
    var sortSelector = arguments[5] ? arguments[5] : '';
    var sortType = arguments[6] ? arguments[6] : '';
    var onPaged = arguments[7] ? arguments[7] : null;
    
    //alert(table+"\n"+pageSize+"\n"+sorting+"\n"+sortDirection+"\n"+sortSelector+"\n"+sortType+"\n"+onPaged+"\n");
	
	if (sorting) {
		tableSort(tmptable,sortSelector, sortType, sortDirection);

	}
	table='#'+tmptable;
	var pageSize = parseInt(pageSize);
	
	var trResult = $(table).find('tbody:first tr');
	var trLen = trResult.length;
	if (pageIndex * pageSize == trLen && trLen != 0) {
		pageIndex = pageIndex - 1; // make sure the last page will show right
	}
	var trs = $(table+" tbody").find('tr');
	var trsLen = trs.length;
	trs.hide();
	trs.slice(pageIndex * pageSize, (pageIndex + 1) * pageSize).show();

	var allPage = Math.ceil(parseInt(trLen) / pageSize);
	if (allPage > 1) {
		$(table + "Paging").remove();
		$(table).after('<div id="' + tmptable + 'Paging" class="search-for"></div>');
		queue = table + 'Paging';
		nowpageindex=pageIndex + 1;
		$(queue).append('<p class="paging"><a id="prePage" >上一页</a> | ' + nowpageindex + '/' + allPage + ' | <a id="nextPage" >下一页</a></p>');
		$(table + "Paging").find("#prePage").bind("click",function () {
			var toPageIndex = pageIndex - 1;
			if (toPageIndex < 0){
				toPageIndex = 0;
			}
			else{
					tablePaging(tmptable,toPageIndex,pageSize,sorting,sortDirection,sortSelector,sortType,onPaged);
			}
		});
		$(table + "Paging").find("#nextPage").bind("click",function () {
			var toPageIndex = pageIndex + 1;
			if (toPageIndex >= allPage){
				toPageIndex = allPage-1;
			}
			else{
			tablePaging(tmptable,toPageIndex,pageSize,sorting,sortDirection,sortSelector,sortType,onPaged);
			}
		});
	}
	else {
		$("#" + $(table).attr('id') + "Paging").remove();
	}
}


function tableSort() {
	var table = arguments[0] ? arguments[0] : ""; 
    var sortBySelector = arguments[1] ? arguments[1] : ""; 
    var type = arguments[2] ? arguments[2] : "number";
    var sortDirection = arguments[3] ? arguments[3] : "asc";
	$('#' + table).find('tbody').each(function (i, element) {
		var trs = $(element).find('tr');
		var tmp = [];
		for (var i = 0; i < trs.length; i++) {
			tmp.push(trs[i]);
		}
		if (type == "number") {
			tmp.sort(function (a, b) {
				var inta = Number($.trim($(a).find(sortBySelector).find("input").val()));
				var intb = Number($.trim($(b).find(sortBySelector).find("input").val()));
				//var inta = Number($.trim($(a).find(sortBySelector).val()));
				//var intb = Number($.trim($(b).find(sortBySelector).val()));
				//alert("inta="+inta+" intb="+intb);
				var returnValue = 0;
				if (inta > intb) returnValue = 1;
				else if (inta < intb) returnValue = -1;
				if (sortDirection == "desc") returnValue = -returnValue;
				return returnValue;
			});
		}
		else if (type === "date") {
			tmp.sort(function (a, b) {
				var datea = parseDate($.trim($(a).find(sortBySelector).find("input").val()));
				var dateb = parseDate($.trim($(b).find(sortBySelector).find("input").val()));
				var returnValue = 0;
				if (datea > dateb) returnValue = 1;
				else if (datea < dateb) returnValue = -1;
				if (sortDirection == "desc") returnValue = -returnValue;
				return returnValue;
			});
		}
		else {
			tmp.sort(function (a, b) {
				var stra = $.trim($(a).find(sortBySelector).find("input").val());
				var strb = $.trim($(b).find(sortBySelector).find("input").val());
				//alert("sortBySelector="+sortBySelector+"stra="+stra+" strb="+strb);
				var returnValue = 0;
				if (stra > strb) returnValue = 1;
				else if (stra < strb) returnValue = -1;
				if (sortDirection == "desc") returnValue = -returnValue;

				return returnValue;
			});
		}

		for (var i = 0; i < tmp.length; i++) {
			trs[i] = tmp[i];
		}

		$(element).empty().append(trs);
	});

}

function parseDate(date) {
    return Date.parse(convertDateFormat(date)); // from en-GB format to en-US format,must greater than 01/01/1970;
}

function convertDateFormat(value) {
    return value = value.toString().replace(/\-/g, '/').replace(/\./g, '/').replace(/\s/g, '/');
}

function turn(str){
//下面的代码将字符串以正确方式显示（包括回车，换行，空格）
	while(str.indexOf("/n")!=-1){ 
		str = str.substring(0,str.indexOf("/n"))+"<br>"+str.substring(str.indexOf("/n")+1);
	} 
	while(str.indexOf(" ")!=-1){ 
		str = str.substring(0,str.indexOf(" "))+" "+str.substring(str.indexOf(" ")+1); 
	} 
	return str;
}

function checkemail(str){	
	var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	if(!myreg.test(str))
   	{
		return false;
   	}
   	else{
   		return true;
   	}
}

function checkmobile(str){
	var myreg = /^((13[0-9]{1})|159|153)+\d{8}$/;
	if(!myreg.test(str))
   	{
		return false;
   	}
   	else{
   		return true;
   	}
}

function checkphone(str){
	var myreg = /^\d{7,8}$/;
	if(!myreg.test(str))
   	{
		return false;
   	}
   	else{
   		return true;
   	}
}

function checkrq(str){
	var result = str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
	if (result == null)
		return false;
	var d = new Date(result[1], result[3] - 1, result[4]);
	return (d.getFullYear() == result[1] && (d.getMonth() + 1) == result[3] && d.getDate() == result[4]);
}

function checkDate(str){
  	var myreg = /^\d{4}-\d{2}-\d{2}$/;
  	//判断日期格式符合YYYY-MM-DD格式
  	if(myreg.test(str)){
		var dateArray = str.split("-");
		var dateElement = new Date(dateArray[0],parseInt(dateArray[1])-1,dateArray[2]);
	   //判断日期逻辑
		if(!((dateElement.getFullYear()==parseInt(dateArray[0]))&&((dateElement.getMonth()+1)==parseInt(dateArray[1]))&&(dateElement.getDate()==parseInt(dateArray[2]))))
		{
			return false;
		}
		else{
			return true;
		}
	}
	else{
		return false;
	}
}

function checknumber(str){
	if(!isNaN(str)){
	   return true;
	}else{
	   return false;
	}

}

function toexcel(table){
	var jsondata=new Array;
	/*jsondata[0]=['ceshi','haha','不知道'];
	jsondata[1]=['ceshi2','haha','不知道'];
	jsondata[2]=['ceshi3','haha3','不知道'];
	*/
	var ths=$('#' + table).find('thead tr th');
	if(ths.length>0){
		jsondata[0]=new Array;
		for (var i = 0; i < ths.length; i++) {
			jsondata[0][i]=ths[i].find("input").val();
		}
	}
	
	var trs=$('#' + table).find('tbody tr');
	if(trs.length>0){
		for (var j = 0; j < trs.length; j++) {	
			var tds=trs.find('td');
			if(tds.length>0){
				jsondata[j]=new Array;
				for (var k = 0; k < tds.length; k++) {
					jsondata[j][k]=tds[k].find("input").val();
				}
			}
		}
	}
	
	var jsonstr=JSON.stringify(jsondata);
	//main("phpexcel","filename="+"love"+"&jsondata="+jsonstr);
	
	var form = $("<form>");  
	form.attr('style','display:none');  
	form.attr('target','');  
	form.attr('method','post');  
	form.attr('action',posturl);  
	  
	var input1 = $('<input>');  
	input1.attr('type','hidden');  
	input1.attr('name','filename');  
	input1.attr('value','love');  
	  
	var input2 = $('<input>');  
	input2.attr('type','hidden');  
	input2.attr('name','jsondata');  
	input2.attr('value',jsonstr);  
	
	  
	var input3 = $('<input>');  
	input3.attr('type','hidden');  
	input3.attr('name','cmd');  
	input3.attr('value','phpexcel');
	
	$('body').append(form);  
	form.append(input1);
	form.append(input2);  
	form.append(input3);
	  
	form.submit();  
	form.remove();  
	
}

function base64_decode (data) {
  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    dec = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data += '';

  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;

    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);

  dec = tmp_arr.join('');

  return dec;
}


function base64_encode (data) {
  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    enc = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  do { // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);

    bits = o1 << 16 | o2 << 8 | o3;

    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;

    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);

  enc = tmp_arr.join('');

  var r = data.length % 3;

  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);

}

function json_decode (str_json) {

  var json = this.window.JSON;
  if (typeof json === 'object' && typeof json.parse === 'function') {
    try {
      return json.parse(str_json);
    } catch (err) {
      if (!(err instanceof SyntaxError)) {
        throw new Error('Unexpected error type in json_decode()');
      }
      this.php_js = this.php_js || {};
      this.php_js.last_error_json = 4; // usable by json_last_error()
      return null;
    }
  }

  var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
  var j;
  var text = str_json;

  // Parsing happens in four stages. In the first stage, we replace certain
  // Unicode characters with escape sequences. JavaScript handles many characters
  // incorrectly, either silently deleting them, or treating them as line endings.
  cx.lastIndex = 0;
  if (cx.test(text)) {
    text = text.replace(cx, function (a) {
      return '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
    });
  }

  // In the second stage, we run the text against regular expressions that look
  // for non-JSON patterns. We are especially concerned with '()' and 'new'
  // because they can cause invocation, and '=' because it can cause mutation.
  // But just to be safe, we want to reject all unexpected forms.
  // We split the second stage into 4 regexp operations in order to work around
  // crippling inefficiencies in IE's and Safari's regexp engines. First we
  // replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
  // replace all simple value tokens with ']' characters. Third, we delete all
  // open brackets that follow a colon or comma or that begin the text. Finally,
  // we look to see that the remaining characters are only whitespace or ']' or
  // ',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.
  if ((/^[\],:{}\s]*$/).
  test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@').
  replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
  replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

    // In the third stage we use the eval function to compile the text into a
    // JavaScript structure. The '{' operator is subject to a syntactic ambiguity
    // in JavaScript: it can begin a block or an object literal. We wrap the text
    // in parens to eliminate the ambiguity.
    j = eval('(' + text + ')');

    return j;
  }

  this.php_js = this.php_js || {};
  this.php_js.last_error_json = 4; // usable by json_last_error()
  return null;
}

function json_encode (mixed_val) {

  var retVal, json = this.window.JSON;
  try {
    if (typeof json === 'object' && typeof json.stringify === 'function') {
      retVal = json.stringify(mixed_val); // Errors will not be caught here if our own equivalent to resource
      //  (an instance of PHPJS_Resource) is used
      if (retVal === undefined) {
        throw new SyntaxError('json_encode');
      }
      return retVal;
    }

    var value = mixed_val;

    var quote = function (string) {
      var escapable = /[\\\"\u0000-\u001f\u007f-\u009f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
      var meta = { // table of character substitutions
        '\b': '\\b',
        '\t': '\\t',
        '\n': '\\n',
        '\f': '\\f',
        '\r': '\\r',
        '"': '\\"',
        '\\': '\\\\'
      };

      escapable.lastIndex = 0;
      return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
        var c = meta[a];
        return typeof c === 'string' ? c : '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
      }) + '"' : '"' + string + '"';
    };

    var str = function (key, holder) {
      var gap = '';
      var indent = '    ';
      var i = 0; // The loop counter.
      var k = ''; // The member key.
      var v = ''; // The member value.
      var length = 0;
      var mind = gap;
      var partial = [];
      var value = holder[key];

      // If the value has a toJSON method, call it to obtain a replacement value.
      if (value && typeof value === 'object' && typeof value.toJSON === 'function') {
        value = value.toJSON(key);
      }

      // What happens next depends on the value's type.
      switch (typeof value) {
      case 'string':
        return quote(value);

      case 'number':
        // JSON numbers must be finite. Encode non-finite numbers as null.
        return isFinite(value) ? String(value) : 'null';

      case 'boolean':
      case 'null':
        // If the value is a boolean or null, convert it to a string. Note:
        // typeof null does not produce 'null'. The case is included here in
        // the remote chance that this gets fixed someday.
        return String(value);

      case 'object':
        // If the type is 'object', we might be dealing with an object or an array or
        // null.
        // Due to a specification blunder in ECMAScript, typeof null is 'object',
        // so watch out for that case.
        if (!value) {
          return 'null';
        }
        if ((this.PHPJS_Resource && value instanceof this.PHPJS_Resource) || (window.PHPJS_Resource && value instanceof window.PHPJS_Resource)) {
          throw new SyntaxError('json_encode');
        }

        // Make an array to hold the partial results of stringifying this object value.
        gap += indent;
        partial = [];

        // Is the value an array?
        if (Object.prototype.toString.apply(value) === '[object Array]') {
          // The value is an array. Stringify every element. Use null as a placeholder
          // for non-JSON values.
          length = value.length;
          for (i = 0; i < length; i += 1) {
            partial[i] = str(i, value) || 'null';
          }

          // Join all of the elements together, separated with commas, and wrap them in
          // brackets.
          v = partial.length === 0 ? '[]' : gap ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']' : '[' + partial.join(',') + ']';
          gap = mind;
          return v;
        }

        // Iterate through all of the keys in the object.
        for (k in value) {
          if (Object.hasOwnProperty.call(value, k)) {
            v = str(k, value);
            if (v) {
              partial.push(quote(k) + (gap ? ': ' : ':') + v);
            }
          }
        }

        // Join all of the member texts together, separated with commas,
        // and wrap them in braces.
        v = partial.length === 0 ? '{}' : gap ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}' : '{' + partial.join(',') + '}';
        gap = mind;
        return v;
      case 'undefined':
        // Fall-through
      case 'function':
        // Fall-through
      default:
        throw new SyntaxError('json_encode');
      }
    };

    // Make a fake root object containing our value under the key of ''.
    // Return the result of stringifying the value.
    return str('', {
      '': value
    });

  } catch (err) { // Todo: ensure error handling above throws a SyntaxError in all cases where it could
    // (i.e., when the JSON global is not available and there is an error)
    if (!(err instanceof SyntaxError)) {
      throw new Error('Unexpected error type in json_encode()');
    }
    this.php_js = this.php_js || {};
    this.php_js.last_error_json = 4; // usable by json_last_error()
    return null;
  }
}

function json_last_error () {
  // http://kevin.vanzonneveld.net
  // +   original by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: json_last_error();
  // *     returns 1: 0
/*
  JSON_ERROR_NONE = 0
  JSON_ERROR_DEPTH = 1 // max depth limit to be removed per PHP comments in json.c (not possible in JS?)
  JSON_ERROR_STATE_MISMATCH = 2 // internal use? also not documented
  JSON_ERROR_CTRL_CHAR = 3 // [\u0000-\u0008\u000B-\u000C\u000E-\u001F] if used directly within json_decode(),
                                  // but JSON functions auto-escape these, so error not possible in JavaScript
  JSON_ERROR_SYNTAX = 4
  */
  return this.php_js && this.php_js.last_error_json ? this.php_js.last_error_json : 0;
}

function prepareJSON(input) {

    //This will convert ASCII/ISO-8859-1 to UTF-8.
    //Be careful with the third parameter (encoding detect list), because
    //if set wrong, some input encodings will get garbled (including UTF-8!)
    imput = mb_convert_encoding(input, 'UTF-8', 'ASCII,UTF-8,ISO-8859-1');

    //Remove UTF-8 BOM if present, json_decode() does not like it.
    if(substr(input, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) input = substr(input, 3);

    return input;
}

function parse_str (str, array) {
  var strArr = String(str).replace(/^&/, '').replace(/&$/, '').split('&'),
    sal = strArr.length,
    i, j, ct, p, lastObj, obj, lastIter, undef, chr, tmp, key, value,
    postLeftBracketPos, keys, keysLen,
    fixStr = function (str) {
      return decodeURIComponent(str.replace(/\+/g, '%20'));
    };

  if (!array) {
    array = this.window;
  }

  for (i = 0; i < sal; i++) {
    tmp = strArr[i].split('=');
    key = fixStr(tmp[0]);
    value = (tmp.length < 2) ? '' : fixStr(tmp[1]);

    while (key.charAt(0) === ' ') {
      key = key.slice(1);
    }
    if (key.indexOf('\x00') > -1) {
      key = key.slice(0, key.indexOf('\x00'));
    }
    if (key && key.charAt(0) !== '[') {
      keys = [];
      postLeftBracketPos = 0;
      for (j = 0; j < key.length; j++) {
        if (key.charAt(j) === '[' && !postLeftBracketPos) {
          postLeftBracketPos = j + 1;
        }
        else if (key.charAt(j) === ']') {
          if (postLeftBracketPos) {
            if (!keys.length) {
              keys.push(key.slice(0, postLeftBracketPos - 1));
            }
            keys.push(key.substr(postLeftBracketPos, j - postLeftBracketPos));
            postLeftBracketPos = 0;
            if (key.charAt(j + 1) !== '[') {
              break;
            }
          }
        }
      }
      if (!keys.length) {
        keys = [key];
      }
      for (j = 0; j < keys[0].length; j++) {
        chr = keys[0].charAt(j);
        if (chr === ' ' || chr === '.' || chr === '[') {
          keys[0] = keys[0].substr(0, j) + '_' + keys[0].substr(j + 1);
        }
        if (chr === '[') {
          break;
        }
      }

      obj = array;
      for (j = 0, keysLen = keys.length; j < keysLen; j++) {
        key = keys[j].replace(/^['"]/, '').replace(/['"]$/, '');
        lastIter = j !== keys.length - 1;
        lastObj = obj;
        if ((key !== '' && key !== ' ') || j === 0) {
          if (obj[key] === undef) {
            obj[key] = {};
          }
          obj = obj[key];
        }
        else { // To insert new dimension
          ct = -1;
          for (p in obj) {
            if (obj.hasOwnProperty(p)) {
              if (+p > ct && p.match(/^\d+$/g)) {
                ct = +p;
              }
            }
          }
          key = ct + 1;
        }
      }
      lastObj[key] = value;
    }
  }
}

function str_replace (search, replace, subject, count) {
  var i = 0,
    j = 0,
    temp = '',
    repl = '',
    sl = 0,
    fl = 0,
    f = [].concat(search),
    r = [].concat(replace),
    s = subject,
    ra = Object.prototype.toString.call(r) === '[object Array]',
    sa = Object.prototype.toString.call(s) === '[object Array]';
  s = [].concat(s);
  if (count) {
    this.window[count] = 0;
  }

  for (i = 0, sl = s.length; i < sl; i++) {
    if (s[i] === '') {
      continue;
    }
    for (j = 0, fl = f.length; j < fl; j++) {
      temp = s[i] + '';
      repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
      s[i] = (temp).split(f[j]).join(repl);
      if (count && s[i] !== temp) {
        this.window[count] += (temp.length - s[i].length) / f[j].length;
      }
    }
  }
  return sa ? s : s[0];
}

function trim (str, charlist) {

  var whitespace, l = 0,
    i = 0;
  str += '';

  if (!charlist) {
    // default list
    whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
  } else {
    // preg_quote custom list
    charlist += '';
    whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
  }

  l = str.length;
  for (i = 0; i < l; i++) {
    if (whitespace.indexOf(str.charAt(i)) === -1) {
      str = str.substring(i);
      break;
    }
  }

  l = str.length;
  for (i = l - 1; i >= 0; i--) {
    if (whitespace.indexOf(str.charAt(i)) === -1) {
      str = str.substring(0, i + 1);
      break;
    }
  }

  return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
}

function print_r (array, return_val) {
  var output = '',
    pad_char = ' ',
    pad_val = 4,
    d = this.window.document,
    getFuncName = function (fn) {
      var name = (/\W*function\s+([\w\$]+)\s*\(/).exec(fn);
      if (!name) {
        return '(Anonymous)';
      }
      return name[1];
    },
    repeat_char = function (len, pad_char) {
      var str = '';
      for (var i = 0; i < len; i++) {
        str += pad_char;
      }
      return str;
    },
    formatArray = function (obj, cur_depth, pad_val, pad_char) {
      if (cur_depth > 0) {
        cur_depth++;
      }

      var base_pad = repeat_char(pad_val * cur_depth, pad_char);
      var thick_pad = repeat_char(pad_val * (cur_depth + 1), pad_char);
      var str = '';

      if (typeof obj === 'object' && obj !== null && obj.constructor && getFuncName(obj.constructor) !== 'PHPJS_Resource') {
        str += 'Array\n' + base_pad + '(\n';
        for (var key in obj) {
          if (Object.prototype.toString.call(obj[key]) === '[object Array]') {
            str += thick_pad + '[' + key + '] => ' + formatArray(obj[key], cur_depth + 1, pad_val, pad_char);
          }
          else {
            str += thick_pad + '[' + key + '] => ' + obj[key] + '\n';
          }
        }
        str += base_pad + ')\n';
      }
      else if (obj === null || obj === undefined) {
        str = '';
      }
      else { // for our "resource" class
        str = obj.toString();
      }

      return str;
    };

  output = formatArray(array, 0, pad_val, pad_char);

  if (return_val !== true) {
    if (d.body) {
      this.echo(output);
    }
    else {
      try {
        d = XULDocument; // We're in XUL, so appending as plain text won't work; trigger an error out of XUL
        this.echo('<pre xmlns="http://www.w3.org/1999/xhtml" style="white-space:pre;">' + output + '</pre>');
      } catch (e) {
        this.echo(output); // Outputting as plain text may work in some plain XML
      }
    }
    return true;
  }
  return output;
}

function explode (delimiter, string, limit) {
  // From: http://phpjs.org/functions
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // *     example 1: explode(' ', 'Kevin van Zonneveld');
  // *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}

  if ( arguments.length < 2 || typeof delimiter === 'undefined' || typeof string === 'undefined' ) return null;
  if ( delimiter === '' || delimiter === false || delimiter === null) return false;
  if ( typeof delimiter === 'function' || typeof delimiter === 'object' || typeof string === 'function' || typeof string === 'object'){
    return { 0: '' };
  }
  if ( delimiter === true ) delimiter = '1';

  // Here we go...
  delimiter += '';
  string += '';

  var s = string.split( delimiter );


  if ( typeof limit === 'undefined' ) return s;

  // Support for limit
  if ( limit === 0 ) limit = 1;

  // Positive limit
  if ( limit > 0 ){
    if ( limit >= s.length ) return s;
    return s.slice( 0, limit - 1 ).concat( [ s.slice( limit - 1 ).join( delimiter ) ] );
  }

  // Negative limit
  if ( -limit >= s.length ) return [];

  s.splice( s.length + limit );
  return s;
}

function getQueryStringByName(name){

	var result = location.search.match(new RegExp("[\?\&]" + name+ "=([^\&]+)","i"));
	
	if(result == null || result.length < 1){
	
	 return "";
	
	}
	return result[1];	
}

function showmessage(){
	var msg= arguments[0] ? arguments[0] : "";
	var type = arguments[1] ? arguments[1] : "info";
	var time = arguments[2] ? arguments[2] : "5";
	Messenger().post({
		message: msg,
		type: type,
		hideAfter: time,
		showCloseButton: true
	});
}

function addxx(cmd){
	$(".add_tab").removeClass("add_tab_active");
	$(".add_tab").eq(cmd-1).addClass("add_tab_active");
}
