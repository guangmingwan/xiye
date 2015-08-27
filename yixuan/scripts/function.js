var posturl="index.php";
//var posturl="http://42.121.28.128:8080/zhengsheng/index.php";

function logininit(){
	if(getCookie("admin_username")){
		$("#u111").val(getCookie("admin_username"));
	}
	if(getCookie("admin_password")){
		$("#u113").val(getCookie("admin_password"));
	}
	if(getCookie("admin_remenber")){
		if(getCookie("admin_remenber")=="1"){
			$("#admin_remenber").attr("checked","checked");
		}
	}
	if(getCookie("admin_autologin")){
		if(getCookie("admin_autologin")=="1"){
			$("#admin_autologin").attr("checked","checked");
			login();
			
		}
	}
	
}

function login() {
   	$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=adminlogin&admin_username='+document.getElementById("u111").value+'&admin_password='+document.getElementById("u113").value+'&admin_remenber='+check("admin_remenber")+'&admin_autologin='+check("admin_autologin"),
        url: posturl,
        success: function(data) {
            if (data) {
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		window.location.href="manage.html";
               		
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               		//document.getElementById("result").innerHTML="登陆失败："+decodeURIComponent(jsonobj.errmsg);
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function check(id){
	if ($("#"+id).attr("checked")=="checked"){
		return "1";
	}
	else{
		return "0";
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

function reset() {
    $("#u111").val("");
    $("#u113").val("");
    $("#admin_remenber").removeAttr("checked");
    $("#admin_autologin").removeAttr("checked");
}

function queryzsjj() {

	$("#u1058").hide();
	$("#u1115").hide();
	$("#u1134").hide();
	$("#u1138").hide();
	$("#u1142").hide();
	$("#u1145").hide();
	$("#u1147").hide();
	$("#u1149").hide();
	$("#u1151").hide();
	$("#u1153").hide();
	$("#u1155").hide();
	$("#u1157").hide();
	$("#u1159").hide();
	$("#u1161").hide();
	$("#u1163").hide();
	$("#u1165").hide();
	$("#u1167").hide();
	$("#u1169").hide();
	$("#u1171").hide();
	$("#u1171-7").hide();
	$("#u1173").hide();
	$("#u1175").hide();
	$("#u1177").hide();
	$("#u1179").hide();
	$("#u1181").hide();
	$("#kktz_bt").hide();
	$("#xysk_bt").hide();
	//$("#u1163").css({"top":"640px"});
   	$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryzsjj&user_check=1&',
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#zsjj_content").val("");
               	var jsonobj=eval('('+data+')'); 
               	if (jsonobj.errcode=="0"){
						$("#user_id").val(jsonobj.admin_id);
						$("#user_type").val(jsonobj.admin_type);
						
						$("#u3445-3").empty();
						var str="";					
						
						if(jsonobj.admin_type=="2"){
							$("#u3447-4").hide();
							//$("#u1065").hide();					
							//$("#u1150").show();
							//goback('zpdp');
							
							$("#u1058").show();
							$("#u1151").show();
							$("#u1153").show();
							$("#u1159").show();	
							$("#u1161").show();	
							$("#u1163").show();	
							$("#u1165").show();
							$("#u1167").show();
							$("#u1169").show();
							$("#u1173").show();
							$("#u1175").show();
							$("#u1177").show();
							$("#u1179").show();
							$("#u1181").show();
							$("#kktz_bt").show();
							$("#xysk_bt").show();
							$("#u1171").show();	
							$("#u1171-7").show();			
							
							$("#u1058").css({"top":"-4px"});
							$("#u1151").css({"top":"45px"});
							$("#u1153").css({"top":"93px"});
							$("#u1159").css({"top":"142px"});
							$("#u1161").css({"top":"191px"});
							$("#u1163").css({"top":"240px"});
							$("#u1165").css({"top":"289px"});
							$("#u1167").css({"top":"338px"});
							$("#u1169").css({"top":"387px"});
							$("#u1173").css({"top":"436px"});
							$("#u1175").css({"top":"485px"});
							$("#u1177").css({"top":"534px"});
							$("#u1179").css({"top":"583px"});
							$("#u1181").css({"top":"632px"});
							$("#kktz_bt").css({"top":"681px"});
							$("#xysk_bt").css({"top":"730px"});
							$("#u1171").css({"top":"779px"});
							$("#u1171-7").css({"top":"828px"});
							
							
							str+="<option value=\"2\">教师</option>";
							/*$("#u1058").hide();
							$("#u1115").hide();
							$("#u1134").hide();
							$("#u1138").hide();
							$("#u1142").hide();
							$("#u1145").hide();
							$("#u1147").hide();
							$("#u1149").hide();
							$("#u1155").hide();
							$("#u1157").hide();
							$("#u1159").hide();
							$("#u1161").hide();*/
						
							
						}
						else if(jsonobj.admin_type=="1"){
							//$("#u1149").hide();
							
							$("#u1058").show();
							$("#u1115").show();
							$("#u1134").show();
							$("#u1138").show();
							$("#u1142").show();
							$("#u1145").show();
							$("#u1147").show();
							$("#u1151").show();
							$("#u1153").show();
							$("#u1155").show();
							$("#u1157").show();
							$("#u1159").show();
							$("#u1161").show();
							//$("#u1163").show();
							//$("#u1165").show();
							//$("#u1167").show();
							$("#u1169").show();
							$("#u1173").show();
							$("#u1175").show();
							$("#u1177").show();
							$("#u1179").show();
							$("#u1181").show();
							$("#kktz_bt").show();
							$("#xysk_bt").show();
							$("#u1171").show();
							$("#u1171-7").show();	
	
							$("#u1151").css({"top":"337px"});
							$("#u1153").css({"top":"386px"});
							$("#u1155").css({"top":"435px"});
							$("#u1157").css({"top":"483px"});
							$("#u1159").css({"top":"532px"});
							$("#u1161").css({"top":"581px"});
							$("#u1169").css({"top":"630px"});
							$("#u1173").css({"top":"679px"});
							$("#u1175").css({"top":"728px"});
							$("#u1177").css({"top":"777px"});
							$("#u1179").css({"top":"826px"});
							$("#u1181").css({"top":"875px"});
							$("#kktz_bt").css({"top":"924px"});
							$("#xysk_bt").css({"top":"973px"});
							$("#u1171").css({"top":"1022px"});
							$("#u1171-7").css({"top":"1071px"});
							
							str+="<option value=\"-1\">全部</option>";
							str+="<option value=\"1\">教务员</option>";
							str+="<option value=\"2\">教师</option>";
							
						}
						else if(jsonobj.admin_type=="0"){
							$("#u1058").show();
							$("#u1115").show();
							$("#u1134").show();
							$("#u1138").show();
							$("#u1142").show();
							$("#u1145").show();
							$("#u1147").show();
							$("#u1149").show();
							$("#u1151").show();
							$("#u1153").show();
							$("#u1155").show();
							$("#u1157").show();
							$("#u1159").show();
							$("#u1161").show();
							//$("#u1163").show();
							//$("#u1165").show();
							//$("#u1167").show();
							$("#u1169").show();
							$("#u1173").show();
							$("#u1175").show();
							$("#u1177").show();
							$("#u1179").show();
							$("#u1181").show();
							$("#kktz_bt").show();
							$("#xysk_bt").show();
							$("#u1171").show();	
							$("#u1171-7").show();	
							
							$("#u1169").css({"top":"679px"});
							$("#u1173").css({"top":"728px"});
							$("#u1175").css({"top":"777px"});
							$("#u1177").css({"top":"826px"});
							$("#u1179").css({"top":"875px"});
							$("#u1181").css({"top":"924px"});
							$("#kktz_bt").css({"top":"973px"});
							$("#xysk_bt").css({"top":"1022px"});
							$("#u1171").css({"top":"1071px"});
							$("#u1171-7").css({"top":"1120px"});
							
							str+="<option value=\"-1\">全部</option>";
							str+="<option value=\"0\">管理员</option>";
							str+="<option value=\"1\">教务员</option>";
							str+="<option value=\"2\">教师</option>";
							
						}
						else{
							alert("请先登陆");
							window.location.href="index.html";
						}
						for(var e in jsonobj.data[0]){
							jsonobj.data[0][e]=decodeURIComponent(jsonobj.data[0][e]);	
			  			}
						$("#zsjj_content").val(jsonobj.data[0].zsjj_content);
							
						$("#u3445-3").append(str);	
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
    });
}

function addzsjj() {
	var zsjj_content=$("#zsjj_content").val();
	if(zsjj_content==""){
		alert("内容不能为空");
		return;
	}
	$("#zsjj_form").submit();
	
	//alert("提交成功");
	
	/*$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=addzsjj&zsjj_content'+$("#zsjj_content").val()+'&zsjj_file='+$("#zsjj_file").val(),
        url: posturl,
        success: function(data) {
        	alert(data);
            if (data) {
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		document.getElementById("zsjj_content").innerHTML=jsonobj.data[0].zsjj_content;
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });*/
	
}

function queryzsxw() {
	goback("zsxw");
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryzsxw&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#zsxwmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
                	jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
      }
               			var dbclickstr='zsxwdbclick("'+jsonobj.data[i].zsxw_id+'","'+encodeURIComponent(jsonobj.data[i].zsxw_title)+'","'+encodeURIComponent(jsonobj.data[i].zsxw_content)+'")';
               			var str="<tr ondblclick='"+dbclickstr+"'>";
               			str+="<td class='zsxw_id'>" + input(jsonobj.data[i].zsxw_id) + "</td>";
               			str+="<td class='zsxw_title'>" + input(jsonobj.data[i].zsxw_title) + "</td>";
               			str+="<td class='zsxw_content'>" + input(jsonobj.data[i].zsxw_content) + "</td>";
               			str+="<td class='zsxw'>" + img(jsonobj.data[i].zsxw) + "</td>";
               			str+="</tr>";
						$("#zsxwmain").append(str);
					}
					tablePaging("zsxwmainTable",0,"",true,"",".zsxw_id","number","");
				}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function zsxwdbclick(zsxw_id,zsxw_title,zsxw_content){
	$("#zsxw").hide();
	$("#zsxwmx").show();
	document.getElementById("zsxwmx").reset();
	$("#u1326-3").val(zsxw_id);
	zsxw_title=decodeURIComponent(zsxw_title);
	$("#zsxw_title").val(zsxw_title);
	zsxw_content=decodeURIComponent(zsxw_content);
	$("#u1325-3").val(zsxw_content);
}

function addzsxw(){
	var zsxw_id=$("#u1326-3").val();
	if(zsxw_id==""){
		alert("编号不能为空");
		return;
	}
	var zsxw_title=$("#zsxw_title").val();
	if(zsxw_title==""){
		alert("标题不能为空");
		return;
	}
	var zsxw_content=$("#u1325-3").val();
	if(zsxw_content==""){
		alert("内容不能为空");
		return;
	}
	$("#zsxwmx").submit();	
}

function newzsxw(){
	$("#zsxw").hide();$("#zsxwmx").show();document.getElementById("zsxwmx").reset();	
}

function delzsxw(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delzsxw&zsxw_id='+$("#u1326-3").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("zsxwmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}


function queryzxgg() {
	goback("zxgg");
   $.ajax({
		async: false,
		type: 'post',
		data: 'cmd=queryzxgg&',
		url: posturl,
		success: function(data) {
			if (data) {
				 $("#zxggmain").empty();
				var jsonobj=eval('('+data+')'); 
				if (jsonobj.errcode=="0"){
					for (var i = 0; i < jsonobj.data.length; i++) {
						for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }
						var dbclickstr='zxggdbclick("'+jsonobj.data[i].zxgg_id+'","'+encodeURIComponent(jsonobj.data[i].zxgg_title)+'","'+encodeURIComponent(jsonobj.data[i].zxgg_content)+'")';
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='zxgg_id'>" + input(jsonobj.data[i].zxgg_id) + "</td>";
						str+="<td class='zxgg_title'>" + input(jsonobj.data[i].zxgg_title) + "</td>";
						str+="<td class='zxgg_content'>" + input(jsonobj.data[i].zxgg_content) + "</td>";
						str+="<td class='zxgg'>" + img(jsonobj.data[i].zxgg) + "</td>";
						str+="</tr>";
					
						$("#zxggmain").append(str);
					}

					 tablePaging("zxggmainTable",0,"",true,"",".zxgg_id","number","");
				}
				else{
					alert(decodeURIComponent(jsonobj.errmsg));
				}
			}
			else {
				alert("操作失败");
			}
		}
	});
}

function zxggdbclick(zxgg_id,zxgg_title,zxgg_content){
	$("#zxgg").hide();
	$("#zxggmx").show();
	document.getElementById("zxggmx").reset();
	$("#u1494-3").val(zxgg_id);
	zxgg_title=decodeURIComponent(zxgg_title);
	$("#zxgg_title").val(zxgg_title);
	zxgg_content=decodeURIComponent(zxgg_content);
	$("#u1493-3").val(zxgg_content);
}

function addzxgg(){
	var zxgg_id=$("#u1494-3").val();
	if(zxgg_id==""){
		alert("编号不能为空");
		return;
	}
	var zxgg_title=$("#zxgg_title").val();
	if(zxgg_title==""){
		alert("标题不能为空");
		return;
	}
	var zxgg_content=$("#u1493-3").val();
	if(zxgg_content==""){
		alert("内容不能为空");
		return;
	}
	$("#zxggmx").submit();	
}


function newzxgg(){
	$("#zxgg").hide();$("#zxggmx").show();document.getElementById("zxggmx").reset();	
}

function delzxgg(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delzxgg&zxgg_id='+$("#u1494-3").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("zxggmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}

function querysybzbh() {
	goback("sybzbh");
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querysybzbh&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#sybzbhmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						var dbclickstr='sybzbhdbclick("'+jsonobj.data[i].sybzbh_id+'","'+jsonobj.data[i].sybzbh_type+'","'+jsonobj.data[i].sybzbh_time+'","'+jsonobj.data[i].sybzbh_mc+'","'+encodeURIComponent(jsonobj.data[i].sybzbh_jj)+'")';
						//var dbclickstr='$("#sybzbh").hide();$("#sybzbhmx").show();document.getElementById("sybzbhmx").reset();$("#u1432-3").val("'+jsonobj.data[i].sybzbh_id+'");$("#u1434-3").val("'+jsonobj.data[i].sybzbh_type+'");$("#u1441-3").val("'+jsonobj.data[i].sybzbh_time+'");$("#u1438-3").val("'+jsonobj.data[i].sybzbh_mc+'");$("#u1437-3").val("'+jsonobj.data[i].sybzbh_jj+'");';
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='sybzbh_id'>" + input(jsonobj.data[i].sybzbh_id) + "</td>";
						str+="<td class='sybzbh_type'>" + input(jsonobj.data[i].sybzbh_type) + "</td>";
						str+="<td class='sybzbh_time'>" + input(jsonobj.data[i].sybzbh_time) + "</td>";
						str+="<td class='sybzbh_mc'>" + input(jsonobj.data[i].sybzbh_mc) + "</td>";
						str+="<td class='sybzbh_jj'>" + input(jsonobj.data[i].sybzbh_jj) + "</td>";
						str+="<td class='sybzbh'>" + img(jsonobj.data[i].sybzbh) + "</td>";
						str+="</tr>";
					
						$("#sybzbhmain").append(str);
					}
					tablePaging("sybzbhmainTable",0,"",true,"",".sybzbh_id","number","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function sybzbhdbclick(sybzbh_id,sybzbh_type,sybzbh_time,sybzbh_mc,sybzbh_jj){
	$("#sybzbh").hide();
	$("#sybzbhmx").show();
	document.getElementById("sybzbhmx").reset();
	$("#u1432-3").val(sybzbh_id);
	$("#u1434-3").val(sybzbh_type);
	$("#u1441-3").val(sybzbh_time);
	$("#u1438-3").val(sybzbh_mc);
	$("#u1437-3").val(decodeURIComponent(sybzbh_jj));
}

function addsybzbh(){
	var sybzbh_id=$("#u1432-3").val();
	if(sybzbh_id==""){
		alert("编号不能为空");
		return;
	}
	var sybzbh_type=$("#u1432-3").val();
	if(sybzbh_type==""){
		alert("类型不能为空");
		return;
	}
	var sybzbh_time=$("#u1441-3").val();
	if(sybzbh_time==""){
		alert("时间不能为空");
		return;
	}
	var sybzbh_mc=$("#u1438-3").val();
	if(sybzbh_mc==""){
		alert("名称不能为空");
		return;
	}
	var sybzbh_jj=$("#u1437-3").val();
	if(sybzbh_jj==""){
		alert("简介不能为空");
		return;
	}
	$("#sybzbhmx").submit();	
}


function newsybzbh(){
	$("#sybzbh").hide();$("#sybzbhmx").show();document.getElementById("sybzbhmx").reset();	
}

function delsybzbh(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delsybzbh&sybzbh_id='+$("#u1432-3").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("sybzbhmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}


function querysyzsxb() {
	goback("syzsxb");
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querysyzsxb&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#syzsxbmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               									for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						 //$("#syzsxbmain").append("<tr><td class='syzsxb_id'>" + input(jsonobj.data[i].syzsxb_id) + "</td><td class='syzsxb_mc'>" + input(jsonobj.data[i].syzsxb_mc) + "</td><td class='syzsxb_pic'>" + img(jsonobj.data[i].syzsxb_pic) + "</td><td class='syzsxb'>" + frame(jsonobj.data[i].syzsxb) + "</td></tr>");
						 
						 var dbclickstr='$("#syzsxb").hide();$("#syzsxbmx").show();document.getElementById("syzsxbmx").reset();$("#u1692-3").val("'+jsonobj.data[i].syzsxb_id+'");$("#u1695-3").val("'+jsonobj.data[i].syzsxb_mc+'");';
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='syzsxb_id'>" + input(jsonobj.data[i].syzsxb_id) + "</td>";
						str+="<td class='syzsxb_mc'>" + input(jsonobj.data[i].syzsxb_mc) + "</td>";
						str+="<td class='syzsxb_pic'>" + img(jsonobj.data[i].syzsxb_pic) + "</td>";
						str+="<td class='syzsxb'>" + input(jsonobj.data[i].syzsxb) + "</td>";
						str+="</tr>";
					
						$("#syzsxbmain").append(str);
					}
					tablePaging("syzsxbmainTable",0,"",true,"",".syzsxb_id","number","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function addsyzsxb(){
	var syzsxb_id=$("#u1692-3").val();
	if(syzsxb_id==""){
		alert("编号不能为空");
		return;
	}
	var syzsxb_mc=$("#u1695-3").val();
	if(syzsxb_mc==""){
		alert("名称不能为空");
		return;
	}
	
	$("#syzsxbmx").submit();	
}


function newsyzsxb(){
	$("#syzsxb").hide();$("#syzsxbmx").show();document.getElementById("syzsxbmx").reset();	
}

function delsyzsxb(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delsyzsxb&syzsxb_id='+$("#u1692-3").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("syzsxbmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}

function queryyxzp() {
	goback("yxzp");
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryyxzp&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#yxzpmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               									for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						 //$("#yxzpmain").append("<tr><td class='yxzp_id'>" + input(jsonobj.data[i].yxzp_id) + "</td><td class='yxzp_type'>" + input(jsonobj.data[i].yxzp_type) + "</td><td class='yxzp_time'>" + input(jsonobj.data[i].yxzp_time) + "</td><td class='yxzp_mc'>" + input(jsonobj.data[i].yxzp_mc) + "</td><td class='yxzp_jj'>" + input(jsonobj.data[i].yxzp_jj) + "</td><td class='yxzp'>" + img(jsonobj.data[i].yxzp) + "</td></tr>");
						 var dbclickstr='yxzpdbclick("'+jsonobj.data[i].yxzp_id+'","'+jsonobj.data[i].yxzp_type+'","'+jsonobj.data[i].yxzp_time+'","'+jsonobj.data[i].yxzp_mc+'","'+encodeURIComponent(jsonobj.data[i].yxzp_jj)+'")';
						 //var dbclickstr='$("#yxzp").hide();$("#yxzpmx").show();document.getElementById("yxzpmx").reset();$("#u1786-3").val("'+jsonobj.data[i].yxzp_id+'");$("#u1789-3").val("'+jsonobj.data[i].yxzp_type+'");$("#u1792-3").val("'+jsonobj.data[i].yxzp_time+'");$("#u1795-3").val("'+jsonobj.data[i].yxzp_mc+'");$("#u1798-3").val("'+jsonobj.data[i].yxzp_jj+'");';
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='yxzp_id'>" + input(jsonobj.data[i].yxzp_id) + "</td>";
						str+="<td class='yxzp_type'>" + input(jsonobj.data[i].yxzp_type) + "</td>";
						str+="<td class='yxzp_time'>" + input(jsonobj.data[i].yxzp_time) + "</td>";
						str+="<td class='yxzp_mc'>" + input(jsonobj.data[i].yxzp_mc) + "</td>";
						str+="<td class='yxzp_jj'>" + input(jsonobj.data[i].yxzp_jj) + "</td>";
						str+="<td class='yxzp'>" + img(jsonobj.data[i].yxzp) + "</td>";
						str+="</tr>";
					
						$("#yxzpmain").append(str);
					}
					tablePaging("yxzpmainTable",0,"",true,"",".yxzp_id","number","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function yxzpdbclick(yxzp_id,yxzp_type,yxzp_time,yxzp_mc,yxzp_jj){
	$("#yxzp").hide();
	$("#yxzpmx").show();
	document.getElementById("yxzpmx").reset();
	$("#u1786-3").val(yxzp_id);
	$("#u1789-3").val(yxzp_type);
	$("#u1792-3").val(yxzp_time);
	$("#u1795-3").val(yxzp_mc);
	$("#u1798-3").val(decodeURIComponent(yxzp_jj));
}


function addyxzp(){
	var yxzp_id=$("#u1786-3").val();
	if(yxzp_id==""){
		alert("编号不能为空");
		return;
	}
	var yxzp_type=$("#u1789-3").val();
	if(yxzp_type==""){
		alert("类型不能为空");
		return;
	}
	var yxzp_time=$("#u1792-3").val();
	if(yxzp_time==""){
		alert("时间不能为空");
		return;
	}
	var yxzp_mc=$("#u1795-3").val();
	if(yxzp_mc==""){
		alert("名称不能为空");
		return;
	}
	var yxzp_jj=$("#u1798-3").val();
	if(yxzp_jj==""){
		alert("简介不能为空");
		return;
	}
	
	$("#yxzpmx").submit();	
}


function newyxzp(){
	$("#yxzp").hide();$("#yxzpmx").show();document.getElementById("yxzpmx").reset();	
}

function delyxzp(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delyxzp&yxzp_id='+$("#u1786-3").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("yxzpmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}


function querybmlc() {
	goback("bmlc");
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querybmlc&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#bmlcmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               								for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						 //$("#bmlcmain").append("<tr><td class='bmlc_content'>" + input(jsonobj.data[i].bmlc_content) + "</td><td class='bmlc'>" + frame(jsonobj.data[i].bmlc) + "</td></tr>");
						 var dbclickstr='bmlcdbclick("'+encodeURIComponent(jsonobj.data[i].bmlc_content)+'")';
						//var dbclickstr="$(\"#bmlc\").hide();$(\"#bmlcmx\").show();document.getElementById(\"bmlcmx\").reset();$(\"#u1891-3\").val(\""+jsonobj.data[i].bmlc_content+"\");";
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='bmlc_content'>" + input(jsonobj.data[i].bmlc_content) + "</td>";
						str+="<td class='bmlc'>" + input(jsonobj.data[i].bmlc) + "</td>";
						str+="</tr>";
						
						$("#bmlcmain").append(str);
					}
					tablePaging("bmlcmainTable",0,"",true,"",".bmlc_content","string","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function bmlcdbclick(bmlc_content){
	$("#bmlc").hide();
	$("#bmlcmx").show();
	document.getElementById("bmlcmx").reset();
	$("#u1891-3").val(decodeURIComponent(bmlc_content));
}


function addbmlc(){
	var bmlc_content=$("#u1891-3").val();
	if(bmlc_content==""){
		alert("内容不能为空");
		return;
	}
	
	$("#bmlcmx").submit();	
}


function newbmlc(){
	$("#bmlc").hide();$("#bmlcmx").show();document.getElementById("bmlcmx").reset();	
}
function querybjgl_init() {
	$("#bjgl").show();
	$("#bjglmx").hide();
	//querybj();
}
function queryxygl_init(){
	$("#xygl").show();
	$("#xyglmx").hide();
	querybj();
	
}

function queryzpdp_init(){
	$("#zpdp").show();
	$("#zpdpmx").hide();
	querybj();
}


function querykc() {
	$("#kcgl").show();
	$("#kcglmx").hide();
	$("#kjgl").hide();
	$("#kjglmx").hide();
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querykc&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#kcglmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               								for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						//$("#bmlcmain").append("<tr><td class='bmlc_content'>" + input(jsonobj.data[i].bmlc_content) + "</td><td class='bmlc'>" + frame(jsonobj.data[i].bmlc) + "</td></tr>");
						var dbclickstr='querykj("'+jsonobj.data[i].kc_id+'");';
						var clickstr='kcclick("'+jsonobj.data[i].kc_id+'","'+jsonobj.data[i].kc_name+'","'+encodeURIComponent(jsonobj.data[i].kc_js)+'")';
						//var clickstr='$("#kcgl").hide();$("#kcglmx").show();$("#kjgl").hide();$("#kjglmx").hide();document.getElementById("kcglmx").reset();$("#u2318-3").val("'+jsonobj.data[i].kc_id+'");$("#u2324-3").val("'+jsonobj.data[i].kc_name+'");$("#u2330-3").val("'+turn(jsonobj.data[i].kc_js)+'");';
						
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='kc_id'>" + input(jsonobj.data[i].kc_id) + "</td>";
						str+="<td class='kc_name'>" + input(jsonobj.data[i].kc_name) + "</td>";
						str+="<td class='kc_js'>" + input(jsonobj.data[i].kc_js) + "</td>";
						str+="<td class='kcgl_bj' href='#' onclick ='" + clickstr + "'>编辑</td>";
						str+="</tr>";
						
						$("#kcglmain").append(str);
					}
					tablePaging("kcglmainTable",0,"10",true,"",".kc_id","number","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function kcclick(kc_id,kc_name,kc_js){
	$("#kcgl").hide();
	$("#kcglmx").show();
	$("#kjgl").hide();
	$("#kjglmx").hide();
	document.getElementById("kcglmx").reset();
	$("#u2318-3").val(kc_id);
	$("#u2324-3").val(kc_name);
	$("#u2330-3").val(decodeURIComponent(kc_js));
}

function addkc(){
	var kc_id=$("#u2318-3").val();
	if(kc_id==""){
		alert("编号不能为空");
		return;
	}
	var kc_name=$("#u2324-3").val();
	if(kc_name==""){
		alert("名称不能为空");
		return;
	}
	var kc_js=$("#u2330-3").val();
	if(kc_js==""){
		alert("介绍不能为空");
		return;
	}
	
	$("#kcglmx").submit();	
}


function newkc(){
	$("#kcgl").hide();$("#kcglmx").show();$("#kjgl").hide();$("#kjglmx").hide();document.getElementById("kcglmx").reset();	
}

function delkc(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delkc&kc_id='+$("#u2318-3").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("kcglmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}

function querykj(kc_id) {	
$("#kcgl").hide();
$("#kcglmx").hide();
$("#kjgl").show();
$("#kjglmx").hide();
$("#kjgl_kc_id").val(kc_id);
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querykcmx&kc_id='+kc_id,
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#kjglmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               								for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						var dbclickstr='$("#kcgl").hide();$("#kcglmx").hide();$("#kjgl").hide();$("#kjglmx").show();	var html=$("#u2349").html();$("#u2349").html(html);$("#kjglmx_kc_id").val("'+kc_id+'");$("#u2335-3").val("'+jsonobj.data[i].kj_id+'");$("#u2338-3").val("'+jsonobj.data[i].kj_name+'");$("#u2341-3").val("'+jsonobj.data[i].zs_id+'");';
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='kj_id'>" + input(jsonobj.data[i].kj_id) + "</td>";
						str+="<td class='kj_name'>" + input(jsonobj.data[i].kj_name) + "</td>";
						str+="<td class='zs_id'>" + input(jsonobj.data[i].zs_id) + "</td>";
						//str+="<td class='kj_js'>" + input(jsonobj.data[i].kj_js) + "</td>";
						str+="<td class='kj'>" + input(jsonobj.data[i].kj) + "</td>";
						str+="<td class='zk'>" + input(jsonobj.data[i].zk) + "</td>";
						str+="</tr>";
						
						$("#kjglmain").append(str);
					}
					tablePaging("kjglmainTable",0,"10",true,"",".kj_id","number","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function addkj(){
	var kj_id=$("#u2335-3").val();
	if(kj_id==""){
		alert("编号不能为空");
		return;
	}
	var kj_name=$("#u2338-3").val();
	if(kj_name==""){
		alert("名称不能为空");
		return;
	}
	var zs_id=$("#u2341-3").val();
	if(zs_id==""){
		alert("位置不能为空");
		return;
	}
	
	var kc_id=$("#kjglmx_kc_id").val();
	if(kc_id==""){
		alert("所属课程不能为空");
		return;
	}
	
	
	$("#kjglmx").submit();	
}


function newkj(){
	$("#kcgl").hide();$("#kcglmx").hide();$("#kjgl").hide();$("#kjglmx").show();document.getElementById("kjglmx").reset();	var html=$("#u2349").html();
$("#u2349").html(html); var kc_id=$("#kjgl_kc_id").val();$("#kjglmx_kc_id").val(kc_id);
}

function delkj(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delkj&kj_id='+$("#u2335-3").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("kjglmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}


function queryzpdp() {
goback("zpdp");	
$("#u2520").show();
var admin_id=$("#u2510-3").val();
var username=$("#u2512-3").val();
var dplx=$("#u2514-3").val();
var cxlx=$("#u2516-3").val();
var begindate=$("#u2510-5").val();
var enddate=$("#u2512-5").val();
var bj_id=$("#u2510-7").val();

   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryzpdp&admin_id='+admin_id+'&username='+username+'&dplx='+dplx+'&cxlx='+cxlx+'&begindate='+begindate+'&enddate='+enddate+'&bj_id='+bj_id,
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#zpdpth").empty();
            	$("#zpdpmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
                	if(cxlx=="1"){
						var zpdpth="<tr><th>学号</th><th>姓名</th><th>生日</th><th>时间</th><th>课件</th><th>课程</th><th>点评老师</th><th>操作</th></tr>";
						$("#zpdpth").append(zpdpth);
					
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							var dbclickstr='queryzpdpmx("'+jsonobj.data[i].username+'","'+jsonobj.data[i].kj_id+'","'+jsonobj.data[i].student_name+'","'+jsonobj.data[i].student_birthday+'","'+jsonobj.data[i].student_address+'","'+jsonobj.data[i].admin_name+'","'+jsonobj.data[i].kj_name+'","'+jsonobj.data[i].zpdp_time+'")';
							var str="<tr ondblclick='"+dbclickstr+"'>";
							str+="<td class='username'>" + input(jsonobj.data[i].username) + "</td>";
							str+="<td class='student_name'>" + input(jsonobj.data[i].student_name) + "</td>";
							str+="<td class='student_birthday'>" + input(jsonobj.data[i].student_birthday) + "</td>";
							str+="<td class='add_time'>" + input(jsonobj.data[i].add_time) + "</td>";
							str+="<td class='kj_name'>" + input(jsonobj.data[i].kj_name) + "</td>";
							str+="<td class='kc_name'>" + input(jsonobj.data[i].kc_name) + "</td>";
							str+="<td class='admin_name'>" + input(jsonobj.data[i].admin_name) + "</td>";
							str+="<td class='admin_bj' onclick ='" + dbclickstr + "' width='50'>编辑</td>";
							str+="</tr>";
						
							$("#zpdpmain").append(str);
						}
						tablePaging("zpdpmainTable",0,"10",true,"desc",".add_time","string","");
					}
					else{
					
						var zpdpth="<tr><th>教师编号</th><th>姓名</th><th>点评个数</th></tr>";
						$("#zpdpth").append(zpdpth);
					
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							var str="<tr>";
							str+="<td class='admin_id'>" + input(jsonobj.data[i].admin_id) + "</td>";			
							str+="<td class='admin_name'>" + input(jsonobj.data[i].admin_name) + "</td>";
							str+="<td class='count'>" + input(jsonobj.data[i].count) + "</td>";
							str+="</tr>";
						
							$("#zpdpmain").append(str);
						}
						tablePaging("zpdpmainTable",0,"10",true,"",".admin_name","string","");

					}
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function queryzpdpmx(username,kj_id,student_name,student_birthday,student_address,admin_name,kj_name,zpdp_time) {
	$("#zpdp").hide();
	$("#zpdpmx").show();
	$("#u2535-3").val(username);
	$("#u2537-3").val(student_name);
	$("#u2539-3").val(student_birthday);
	$("#u2541-3").val(student_address);
	$("#u2543-3").val(admin_name);
	$("#u2545-3").val(kj_name);
	$("#u2543-6").val(zpdp_time);
	$("#zpdp_kj_id").val(kj_id);
	
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryzpdp&username='+username+'&kj_id='+kj_id+'&dplx=2&cxlx=3',
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#zpdpmxmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){					
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							var str="<tr>";
							str+="<td class='zp_id' style='display:none'>" + input(jsonobj.data[i].zp_id) + "</td>";
							str+="<td class='zp'>" + img(jsonobj.data[i].zp) + "</td>";
							str+="<td class='zpdp'>" + textarea(jsonobj.data[i].zpdp) + "</td>";
							str+="<td class='kjgl_sc' href='#' onclick ='delzpdp(\""+jsonobj.data[i].zp_id+"\",\""+ username+"\",\""+kj_id+"\",\""+student_name+"\",\""+student_birthday+"\",\""+student_address+"\",\""+admin_name+"\",\""+kj_name+"\",\""+zpdp_time+"\")'>删除</td>";
							str+="</tr>";
						
							$("#zpdpmxmain").append(str);
						}
						tablePaging("zpdpmxmainTable",0,"3",true,"",".zp_id","number","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function zpdpgoback(){
	var username=$("#u2535-3").val();
	var kj_id=$("#zpdp_kj_id").val();
	
	$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=zpdpover&username='+username+'&kj_id='+kj_id+'&',
        url: posturl,
        success: function(data) {
            if (data) {
            }
            else {
                alert("操作失败");
            }
        }
    });
    
	goback('zpdp');
	queryzpdp();
}

function addzpdp(){
	var username=$("#u2535-3").val();
	if(username==""){
		alert("学号不能为空");
		return;
	}
	var student_name=$("#u2537-3").val();
	if(student_name==""){
		alert("姓名不能为空");
		return;
	}
	var student_birthday=$("#u2539-3").val();
	if(student_birthday==""){
		alert("生日不能为空");
		return;
	}
	var student_address=$("#u2541-3").val();
	if(student_address==""){
		alert("地址不能为空");
		return;
	}
	var kj_name=$("#u2545-3").val();
	if(kj_name==""){
		alert("课件不能为空");
		return;
	}
	
	var len=$("#zpdpmxmain tr").length;
	var index=0;
	function newrequest(){
		if(index>=len){
			alert("保存成功");
			return;
		}
		var tritem=$("#zpdpmxmain tr").eq(index);
		var zp_id=$(tritem).find(".zp_id").find("input").val();
		var zpdp=$(tritem).find(".zpdp").find("textarea").val();
		$.ajax({
        async: true,
        type: 'post',
        data: 'cmd=addzpdp&zp_id='+zp_id+'&zpdp='+zpdp,
        url: posturl,
        success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){					
						index++;
						newrequest();	
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
	}
	newrequest();
	/*$("#zpdpmxmain tr").each(function(trindex,tritem){
		var zp_id=$(tritem).find(".zp_id").find("input").val();
		var zpdp=$(tritem).find(".zpdp").find("textarea").val();
		$.ajax({
        async: true,
        type: 'post',
        data: 'cmd=addzpdp&zp_id='+zp_id+'&zpdp='+zpdp,
        url: posturl,
        success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){					
							
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
						return false;
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
	});
	alert("保存成功");*/
	
}

function delzpdp(zp_id,username,kj_id,student_name,student_birthday,student_address,admin_name,kj_name,zpdp_time){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delzp2&zp_id='+zp_id,
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						queryzpdpmx(username,kj_id,student_name,student_birthday,student_address,admin_name,kj_name,zpdp_time);
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}


function queryzsxb() {
	goback("zsxb");	
    $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryzsxb_web',
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#zsxbmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							 var dbclickstr='queryzsxbmx("'+jsonobj.data[i].zsxb_mc+'","'+jsonobj.data[i].zsxb_date+'")';
							var str="<tr ondblclick='"+dbclickstr+"'>";
							str+="<td class='zsxb_mc'>" + input(jsonobj.data[i].zsxb_mc) + "</td>";
							str+="<td class='zsxb_date'>" + input(jsonobj.data[i].zsxb_date) + "</td>";
							str+="</tr>";
						
							$("#zsxbmain").append(str);
						}
						tablePaging("zsxbmainTable",0,"10",true,"",".zsxb_mc","string","");

               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}


function queryzsxbmx(zsxb_mc,zsxb_date) {
	$("#zsxb").hide();
	$("#zsxbmx").show();
	$("#u3088-3").val(zsxb_mc);	
	$("#u3090-3").val(zsxb_date);
	$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryzsxb_web&zsxb_mc='+zsxb_mc+'&zsxb_date='+zsxb_date,
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#zsxbmxmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							var str="<tr>";
							str+="<td class='zsxb_id' style='display:none'>" + input(jsonobj.data[i].zsxb_id) + "</td>";
							str+="<td class='zsxb'>" + jsonobj.data[i].zsxb + "</br>"+file("zsxb",jsonobj.data[i].zsxb_id)+"</td>";
							str+="<td class='zsxb_pic'>" + img(jsonobj.data[i].zsxb_pic) + "</br>"+file("zsxb_pic",jsonobj.data[i].zsxb_id)+"</td>";
							
							str+="<td class='zsxb_sc' href='#' onclick ='delzsxb(\""+jsonobj.data[i].zsxb_id+"\",\""+ zsxb_mc+"\",\""+zsxb_date+"\")'>删除</td>";
							str+="</tr>";
							$("#zsxbmxmain").append(str);
						}
						/*if(jsonobj.data.length<8){
							for(i=(jsonobj.data.length-1);i<8 ;i++){
								var str="<tr>";
							str+="<td class='zsxb_id' style='display:none'></td>";
							str+="<td class='zsxb'>" +file("zsxbnew","")+"</td>";
							str+="<td class='zsxb_pic'>"+file("zsxb_picnew","")+"</td>";
	
							str+="<td class='zsxb_sc'>删除</td>";
							str+="</tr>";
						
							$("#zsxbmxmain").append(str);
							}
						}*/
						tablePaging("zsxbmxmainTable",0,"3",true,"",".zsxb_id","number","");

               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function addzsxb(){
	var zsxb_mc=$("#u3088-3").val();
	if(zsxb_mc==""){
		alert("名称不能为空");
		return;
	}
	var zsxb_date=$("#u3090-3").val();
	if(zsxb_date==""){
		alert("时间不能为空");
		return;
	}
	
	$("#zsxbmx").submit();	
}


function newzsxb(){
$("#zsxb").hide();$("#zsxbmx").show();document.getElementById("zsxbmx").reset();
$("#zsxbmxmain").empty();
	var str="<tr>";
	str+="<td class='zsxb_id' style='display:none'></td>";
	str+="<td class='zsxb'>" +file("zsxbnew","")+"</td>";
	str+="<td class='zsxb_pic'>"+file("zsxb_picnew","")+"</td>";
	
	str+="<td class='zsxb_sc'>删除</td>";
	str+="</tr>";
	$("#zsxbmxmain").append(str);		
}

function delzsxb(zsxb_id,zsxb_mc,zsxb_time){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delzsxb&zsxb_id='+zsxb_id,
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						queryzsxbmx(zsxb_mc,zsxb_time);
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}

function newbjdp(){
	$("#bjdp").hide();$("#bjdpmx").show();document.getElementById("bjdpmx").reset();	
}

function querybjdp() {
	goback("bjdp");	
	
	/*$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querybj',
        url: posturl,
        success: function(data) {
            if (data) {
				var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){ 
				
					$("[name='bjdp_bj_id']").empty();
					var str="";
					
					for (var i = 0; i < jsonobj.data.length; i++) {
						for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
						}

						str+="<option value=\""+jsonobj.data[i].bj_id+"\">"+jsonobj.data[i].bj_name+"</option>"
					}
					
					$("[name='bjdp_bj_id']").append(str);
						
				}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
						
            }
            else {
                alert("操作失败");
            }
        }
    });*/
	//querybj();
	
	$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querykc',
        url: posturl,
        success: function(data) {
            if (data) {
				var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){ 
				
					$("[name='bjdp_kc_id']").empty();
					var str="";
					
					for (var i = 0; i < jsonobj.data.length; i++) {
						for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
						}
						if(i==0){
							str+="<option value=\""+jsonobj.data[i].kc_id+"\" selected>"+jsonobj.data[i].kc_name+"</option>";
						}
						else{
							str+="<option value=\""+jsonobj.data[i].kc_id+"\">"+jsonobj.data[i].kc_name+"</option>";
						}
					}
					
					$("[name='bjdp_kc_id']").append(str);
						
				}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
						
            }
            else {
                alert("操作失败");
            }
        }
    });
	
	$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querykcmx&kc_id='+$("[name='bjdp_kc_id']").val(),
        url: posturl,
        success: function(data) {
            if (data) {
				var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){ 
				
					$("[name='bjdp_kj_id']").empty();
					var str="";
					
					for (var i = 0; i < jsonobj.data.length; i++) {
						for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
						}
						if(i==0){
							str+="<option value=\""+jsonobj.data[i].kj_id+"\" selected>"+jsonobj.data[i].kj_name+"</option>"
						}
						else{
							str+="<option value=\""+jsonobj.data[i].kj_id+"\" >"+jsonobj.data[i].kj_name+"</option>"
						}

					}
					
					$("[name='bjdp_kj_id']").append(str);
						
				}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
						
            }
            else {
                alert("操作失败");
            }
        }
    });
	
	var bj_id=$("[name='select_bjdp_bj_id']").val();	
	
    $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querybjdp&bj_id='+bj_id,
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#bjdpmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}

							var dbclickstr='querybjdpmx("'+jsonobj.data[i].bjdp_id+'","'+jsonobj.data[i].bj_id+'","'+jsonobj.data[i].kj_id+'","'+jsonobj.data[i].kc_id+'","'+jsonobj.data[i].zs_id+'","'+jsonobj.data[i].kj_name+'")';
							var str="<tr ondblclick='"+dbclickstr+"'>";
							str+="<td class='bj_name'>" + input(jsonobj.data[i].bj_name) + "</td>";
							str+="<td class='kj_name'>" + input(jsonobj.data[i].kj_name) + "</td>";
							str+="<td class='admin_name'>" + input(jsonobj.data[i].admin_name) + "</td>";
							str+="<td class='bjdp'>" + input(jsonobj.data[i].bjdp) + "</td>";
							str+="<td class='add_time'>" + input(jsonobj.data[i].add_time) + "</td>";
							str+="</tr>";
						
							$("#bjdpmain").append(str);
						}
						tablePaging("bjdpmainTable",0,"10",true,"desc",".bjdp_id","number","");

               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function change(cmd){
	if(cmd=='kc_id'){
		$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querykcmx&kc_id='+$("[name='bjdp_kc_id']").val(),
        url: posturl,
        success: function(data) {
            if (data) {
				var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){ 
				
					$("[name='bjdp_kj_id']").empty();
					var str="";
					
					for (var i = 0; i < jsonobj.data.length; i++) {
						for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
						}

						if(i==0){
							str+="<option value=\""+jsonobj.data[i].kj_id+"\" selected>"+jsonobj.data[i].kj_name+"</option>"
						}
						else{
							str+="<option value=\""+jsonobj.data[i].kj_id+"\" >"+jsonobj.data[i].kj_name+"</option>"
						}
					}
					
					$("[name='bjdp_kj_id']").append(str);
						
				}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
						
            }
            else {
                alert("操作失败");
            }
        }
    });
	}
}

function querybjdpmx(bjdp_id,bj_id,kj_id,kc_id,zs_id,kj_name) {
	$("#bjdp").hide();
	$("#bjdpmx").show();
	$("[name='bjdp_id']").val(bjdp_id);	
	$("[name='bjdp_bj_id']").val(bj_id);	
	$("[name='bjdp_kj_id']").val(kj_id);	
	$("[name='bjdp_kc_id']").val(kc_id);	
}

function addbjdp(){
	var bjdp_id=$("[name='bjdp_id']").val();
	if(bjdp_id==""){
		alert("编号不能为空");
		return;
	}
	var bj_id=$("[name='bjdp_bj_id']").val();
	if(bj_id==""){
		alert("班级不能为空");
		return;
	}
	var kj_id=$("[name='bjdp_kj_id']").val();
	if(kj_id==""){
		alert("课件不能为空");
		return;
	}
	var kc_id=$("[name='bjdp_kc_id']").val();
	if(kc_id==""){
		alert("课程不能为空");
		return;
	}
	
	$("#bjdpmx").submit();	
}

function delbjdp(){
	var bjdp_id=$("[name='bjdp_id']").val();
	if(bjdp_id==""){
		alert("编号不能为空");
		return;
	}
	
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delbjdp&bjdp_id='+bjdp_id,
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("bjdpmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}

function queryxygl() {
goback("xygl");	
$("#u3183").show();
var username=$("#u3178-3").val();
var shlx=$("#u3180-3").val();
var bj_id=$("#u3178-5").val();

   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryxygl&username='+username+'&shlx='+shlx+'&bj_id='+bj_id,
        url: posturl,
        success: function(data) {
            if (data) {
            	//alert(data);
            	$("#xyglmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							var dbclickstr='queryxyglmx("'+jsonobj.data[i].student_id+'")';
							var str="<tr ondblclick='"+dbclickstr+"'>";
							str+="<td class='username'>" + input(jsonobj.data[i].username) + "</td>";
							str+="<td class='student_name'>" + input(jsonobj.data[i].student_name) + "</td>";
							str+="<td class='student_birthday'>" + input(jsonobj.data[i].student_birthday) + "</td>";
							str+="<td class='student_sex'>" + input(jsonobj.data[i].student_sex) + "</td>";
							str+="<td class='student_address'>" + input(jsonobj.data[i].student_address) + "</td>";
							str+="<td class='kc_name'>" + input(jsonobj.data[i].kc_name) + "</td>";
							str+="<td class='zpcount'>" + input(jsonobj.data[i].zpcount) + "</td>";
							str+="<td class='bzbhcount'>" + input(jsonobj.data[i].bzbhcount) + "</td>";
							str+="<td class='yskc'>" + input(jsonobj.data[i].yskc) + "</td>";
							str+="<td class='sykc'>" + input(jsonobj.data[i].sykc) + "</td>";
							str+="<td class='dqkc'>" + input(jsonobj.data[i].dqkc) + "</td>";
							str+="<td class='xygl_bj' onclick ='" + dbclickstr + "' width='50'>编辑</td>";
							str+="</tr>";
						
							$("#xyglmain").append(str);
						}
						tablePaging("xyglmainTable",0,"10",true,"",".username","string","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function queryxyglmx(student_id) {
	$("#xygl").hide();
	$("#xyglmx").show();
	document.getElementById("xyglmx").reset();
	$("#student_id").val(student_id);
	$("#u3327-3").empty();
	$.ajax({
		async: false,
		type: 'post',
		data: 'cmd=querykc&',
		url: posturl,
		success: function(data) {
			if (data) {
				var jsonobj=eval('('+data+')'); 
				if (jsonobj.errcode=="0"){          	
					for (var i = 0; i < jsonobj.data.length; i++) {
											for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }
						$("#u3327-3").append("<option value="+jsonobj.data[i].kc_id+">"+jsonobj.data[i].kc_name+"</option>");						
					}						
				}
				else{
					alert(decodeURIComponent(jsonobj.errmsg));
				}
			}
			else {
				alert("操作失败");
			}
		}
	});
	
	queryzs();
	queryadmin();
	
	if(student_id!=""){

	   $.ajax({
			async: false,
			type: 'post',
			data: 'cmd=queryxygl&student_id='+student_id,
			url: posturl,
			success: function(data) {
				if (data) {
					//alert(data);
					//$("#xyglmx").reset();
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){          	
							for (var i = 0; i < jsonobj.data.length; i++) {
													for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

								$("#u3249-3").val(jsonobj.data[i].username);
								$("#u3252-3").val(jsonobj.data[i].userpwd);
								$("#u3254-3").val(jsonobj.data[i].userpwd);
								$("#u3327-3").val(jsonobj.data[i].kc_id);
								$("#u3328-3").val(jsonobj.data[i].qs_zs_id);
								$("#u3329-3").val(jsonobj.data[i].rx_time);
								$("#ifsd").val(jsonobj.data[i].ifsd);
								$("#u3284-3").val(jsonobj.data[i].student_name);
								$("#u3256-3").val(jsonobj.data[i].student_sex);
								$("#u3281-3").val(jsonobj.data[i].student_nickname);
								$("#u3258-3").val(jsonobj.data[i].student_address);
								$("#u3270-3").val(jsonobj.data[i].student_xgpxb);
								$("#u3260-3").val(jsonobj.data[i].student_birthday);
								$("#u3272-3").val(jsonobj.data[i].student_xgjg);
								$("#u3262-3").val(jsonobj.data[i].student_parent);
								$("#u3264-3").val(jsonobj.data[i].student_phone);
								$("#u3274-3").val(jsonobj.data[i].student_xqah);
								$("#u3266-3").val(jsonobj.data[i].student_weibo);
								$("#u3268-3").val(jsonobj.data[i].student_qq);
								$("#u3276-3").val(jsonobj.data[i].student_jrxgzy);
								$("#u3286-3").val(jsonobj.data[i].student_email);
								$("#u3278-3").val(jsonobj.data[i].student_cz);
								$("#u3280-3").val(jsonobj.data[i].student_qd);
								$("#u3280-5").val(jsonobj.data[i].bj_id);
								$("[name='admin_id']").val(jsonobj.data[i].admin_id);
								
							}						
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
		
	}
}

function queryzs(){
	var kc_id=$("#u3327-3").val();
	$("#u3328-3").empty();
	$.ajax({
		async: false,
		type: 'post',
		data: 'cmd=querykcmx&kc_id='+kc_id,
		url: posturl,
		success: function(data) {
			if (data) {
				var jsonobj=eval('('+data+')'); 
				if (jsonobj.errcode=="0"){          	
					for (var i = 0; i < jsonobj.data.length; i++) {
											for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						$("#u3328-3").append("<option value="+jsonobj.data[i].zs_id+">"+jsonobj.data[i].zs_id+"</option>");							
					}						
				}
				else{
					alert(decodeURIComponent(jsonobj.errmsg));
				}
			}
			else {
				alert("操作失败");
			}
		}
	});
}


function queryadmin(){
	$("#u3256-5").empty();
	$("#u3256-5").append("<option value=\"\">"+"</option>");	
	$.ajax({
		async: false,
		type: 'post',
		data: 'cmd=queryjsgl_web&admin_type=2',
		url: posturl,
		success: function(data) {
			if (data) {
				var jsonobj=eval('('+data+')'); 
				if (jsonobj.errcode=="0"){          	
					for (var i = 0; i < jsonobj.data.length; i++) {
											for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						$("#u3256-5").append("<option value="+jsonobj.data[i].admin_id+">"+jsonobj.data[i].admin_name+"</option>");							
					}						
				}
				else{
					alert(decodeURIComponent(jsonobj.errmsg));
				}
			}
			else {
				alert("操作失败");
			}
		}
	});
}

function querybj(){
	$("#u3280-5").empty();
	$("#u3280-5").append("<option value=\"\">"+"</option>");	
	$("#u3178-5").empty();
	$("#u3178-5").append("<option value=\"\">"+"</option>");
	$("#u2510-7").empty();
	$("#u2510-7").append("<option value=\"\">"+"</option>");
	$("[name='bjdp_bj_id']").empty();
	$("[name='bjdp_bj_id']").append("<option value=\"\">"+"</option>");
	$("[name='xysk_bj_id']").empty();
	$("[name='xysk_bj_id']").append("<option value=\"\">"+"</option>");
	$("[name='select_bjdp_bj_id']").empty();
	$("[name='select_bjdp_bj_id']").append("<option value=\"\">"+"</option>");
	
	$.ajax({
		async: false,
		type: 'post',
		data: 'cmd=querybj',
		url: posturl,
		success: function(data) {
			if (data) {
				var jsonobj=eval('('+data+')'); 
				if (jsonobj.errcode=="0"){          	
					for (var i = 0; i < jsonobj.data.length; i++) {
						for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  				}

						$("#u3280-5").append("<option value="+jsonobj.data[i].bj_id+">"+jsonobj.data[i].bj_name+"</option>");	
						$("#u3178-5").append("<option value="+jsonobj.data[i].bj_id+">"+jsonobj.data[i].bj_name+"</option>");	
						$("#u2510-7").append("<option value="+jsonobj.data[i].bj_id+">"+jsonobj.data[i].bj_name+"</option>");	
						$("[name='bjdp_bj_id']").append("<option value="+jsonobj.data[i].bj_id+">"+jsonobj.data[i].bj_name+"</option>");
						$("[name='xysk_bj_id']").append("<option value="+jsonobj.data[i].bj_id+">"+jsonobj.data[i].bj_name+"</option>");
						$("[name='select_bjdp_bj_id']").append("<option value="+jsonobj.data[i].bj_id+">"+jsonobj.data[i].bj_name+"</option>");						
					}						
				}
				else{
					alert(decodeURIComponent(jsonobj.errmsg));
				}
			}
			else {
				alert("操作失败");
			}
		}
	});
}


function addxygl(){
	var username=$("#u3249-3").val();
	var userpwd=$("#u3252-3").val();
	var userpwd_confirm=$("#u3254-3").val();
	var kc_id=$("#u3327-3").val();
	var qs_zs_id=$("#u3328-3").val();
	var rx_time=$("#u3329-3").val();
	var ifsd=$("#ifsd").val();
	var student_name=$("#u3284-3").val();
	var student_sex=$("#u3256-3").val();
	var student_nickname=$("#u3281-3").val();
	var student_address=$("#u3258-3").val();
	var student_xgpxb=$("#u3270-3").val();
	var student_birthday=$("#u3260-3").val();
	var student_xgjg=$("#u3272-3").val();
	var student_parent=$("#u3262-3").val();
	var student_phone=$("#u3264-3").val();
	var student_xqah=$("#u3274-3").val();
	var student_weibo=$("#u3266-3").val();
	var student_qq=$("#u3268-3").val();
	var student_jrxgzy=$("#u3276-3").val();
	var student_email=$("#u3286-3").val();
	var student_cz=$("#u3278-3").val();
	var student_qd=$("#u3280-3").val();
	if(username==""){
		alert("学号不能为空");
		return;
	}
	if(userpwd==""){
		alert("密码不能为空");
		return;
	}
	if(userpwd!=userpwd_confirm){
		alert("两次输入密码不一致");
		return;
	}
	if(kc_id==""){
		alert("课程不能为空");
		return;
	}
	if(qs_zs_id==""){
		alert("起始课件位置不能为空");
		return;
	}
	if(rx_time==""){
		alert("入学时间不能为空");
		return;
	}
	if(ifsd==""){
		alert("用户状态不能为空");
		return;
	}
	if(student_name==""){
		alert("学员姓名不能为空");
		return;
	}
	if(student_sex==""){
		alert("学员性别不能为空");
		return;
	}
	if(student_address==""){
		alert("地址不能为空");
		return;
	}
	if(student_birthday==""){
		alert("出生日期不能为空");
		return;
	}
	if(student_parent==""){
		alert("联系人不能为空");
		return;
	}
	if(student_phone==""){
		alert("手机不能为空");
		return;
	}
	if(!checknumber(student_phone)){
		alert("请输入有效的手机");
		return;
	}
	if(student_qq==""){
		alert("qq不能为空");
		return;
	}
	if(!checknumber(student_qq)){
		alert("请输入有效的qq");
		return;
	}
	if(student_email==""){
		alert("email不能为空");
		return;
	}
	if(!checkemail(student_email)){
		alert("请输入有效的email");
		return;
	}
	
	$("#xyglmx").submit();	
}

function exportxy() {
	window.open("index.php?cmd=exportxy");
}
function newxygl(){
	$("#xygl").hide();$("#xyglmx").show();document.getElementById("xyglmx").reset();
	$("#u3327-3").empty();
	$.ajax({
		async: false,
		type: 'post',
		data: 'cmd=querykc&',
		url: posturl,
		success: function(data) {
			if (data) {
				var jsonobj=eval('('+data+')'); 
				if (jsonobj.errcode=="0"){          	
					for (var i = 0; i < jsonobj.data.length; i++) {
											for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						$("#u3327-3").append("<option value="+jsonobj.data[i].kc_id+">"+jsonobj.data[i].kc_name+"</option>");							
					}						
				}
				else{
					alert(decodeURIComponent(jsonobj.errmsg));
				}
			}
			else {
				alert("操作失败");
			}
		}
	});
	
	queryzs();
	queryadmin();
	
}

function delxygl(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delxygl&student_id='+$("#student_id").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("xyglmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}


function querybzbh() {
	goback("bzbh");	
	$("#u3343").show();
	var username=$("#u3344-5").val();
	var begindate=$("#u3430-5").val();
	var enddate=$("#u3431-5").val();
    $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querybzbh_web&begindate='+begindate+"&enddate="+enddate+'&username='+username,
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#bzbhmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							var dbclickstr='querybzbhmx("'+jsonobj.data[i].bzbh_mc+'","'+jsonobj.data[i].bzbh_time+'","'+jsonobj.data[i].username+'","'+jsonobj.data[i].student_name+'","'+encodeURIComponent(jsonobj.data[i].bzbh_jj)+'")';
							var str="<tr ondblclick='"+dbclickstr+"'>";
							str+="<td class='username'>" + input(jsonobj.data[i].username) + "</td>";
							str+="<td class='student_name'>" + input(jsonobj.data[i].student_name) + "</td>";
							str+="<td class='bzbh_mc'>" + input(jsonobj.data[i].bzbh_mc) + "</td>";
							str+="<td class='bzbh_time'>" + input(jsonobj.data[i].bzbh_time) + "</td>";
							str+="<td class='bzbh_jj'>" + input(jsonobj.data[i].bzbh_jj) + "</td>";
							str+="</tr>";
						
							$("#bzbhmain").append(str);
						}
						tablePaging("bzbhmainTable",0,"10",true,"",".username","number","");

               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}


function querybzbhmx(bzbh_mc,bzbh_time,username,student_name,bzbh_jj) {
	$("#bzbh").hide();
	$("#bzbhmx").show();
	document.getElementById("bzbhmx").reset();
	$("#u3422-3").val(username);	
	$("#u3424-3").val(student_name);
	$("#u3426-3").val(bzbh_mc);
	$("#u3428-3").val(bzbh_time);
	$("#u3430-3").val(decodeURIComponent(bzbh_jj));
	$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querybzbh_web&bzbh_mc='+bzbh_mc+'&bzbh_time='+bzbh_time,
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#bzbhmxmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							var str="<tr>";
							str+="<td class='bzbh_id' style='display:none'>" + input(jsonobj.data[i].bzbh_id) + "</td>";
							str+="<td class='bzbh'>" + img(jsonobj.data[i].bzbh) + "</td>";
							str+="<td class='file'>" + file("bzbh",jsonobj.data[i].bzbh_id) + "</td>";
							
							str+="<td class='bzbh_sc' href='#' onclick ='delbzbh(\""+jsonobj.data[i].bzbh_id+"\",\""+ bzbh_mc+"\",\""+bzbh_time+"\",\""+username+"\",\""+student_name+"\",\""+bzbh_jj+"\")'>删除</td>";
							str+="</tr>";
							$("#bzbhmxmain").append(str);
						}
						/*if(jsonobj.data.length<8){
							for(i=(jsonobj.data.length-1);i<8 ;i++){
								var str="<tr>";
							str+="<td class='bzbh_id' style='display:none'></td>";
							str+="<td class='bzbh'></td>";
							str+="<td class='file'>" + file() + "</td>";
							str+="</tr>";
						
							$("#bzbhmxmain").append(str);
							}
						}*/
						tablePaging("bzbhmxmainTable",0,"3",true,"",".bzbh_id","number","");

               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function addbzbh(){
	var username=$("#u3422-3").val();
	if(username==""){
		alert("学号不能为空");
		return;
	}
	var student_name=$("#u3424-3").val();
	if(student_name==""){
		alert("姓名不能为空");
		return;
	}
	var bzbh_mc=$("#u3426-3").val();
	if(bzbh_mc==""){
		alert("名称不能为空");
		return;
	}
	var bzbh_time=$("#u3428-3").val();
	if(bzbh_time==""){
		alert("时间不能为空");
		return;
	}
	var bzbh_jj=$("#u3430-3").val();
	if(bzbh_jj==""){
		alert("简介不能为空");
		return;
	}
	
	$("#bzbhmx").submit();	
}


function newbzbh(){
$("#bzbh").hide();$("#bzbhmx").show();document.getElementById("bzbhmx").reset();	
}

function delbzbh(bzbh_id,bzbh_mc,bzbh_time,username,student_name,bzbh_jj){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delbzbh&bzbh_id='+bzbh_id,
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						querybzbhmx(bzbh_mc,bzbh_time,username,student_name,bzbh_jj);
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}

function queryjsgl() {
	goback("jsgl");	
	$("#u3441").show();
	var admin_username=$("#u3443-3").val();
	var admin_type=$("#u3445-3").val();
	if(admin_type=="-1"){
		admin_type="";
	}
	var cxlx=$("#cxlx_select").val();
	
	var begindate=$("#u3443-5").val();
	var enddate=$("#u3448-5").val();
	
    $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryjsgl_web&admin_username='+admin_username+'&admin_type='+admin_type+'&cxlx='+cxlx+'&begindate='+begindate+'&enddate='+enddate,
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#jsglth").empty();
            	$("#jsglmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){  
                	if(cxlx=="0"){
						var jsglth="<tr><th>账号</th><th>姓名</th><th>性别</th><th>个人介绍</th></tr>";
							$("#jsglth").append(jsglth);        	
							for (var i = 0; i < jsonobj.data.length; i++) {
													for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
			  }

								var dbclickstr='queryjsglmx("'+jsonobj.data[i].admin_id+'")';
								var str="<tr ondblclick='"+dbclickstr+"'>";
								str+="<td class='admin_username'>" + input(jsonobj.data[i].admin_username) + "</td>";
								str+="<td class='admin_name'>" + input(jsonobj.data[i].admin_name) + "</td>";
								str+="<td class='admin_sex'>" + input(jsonobj.data[i].admin_sex) + "</td>";
								str+="<td class='admin_grjs'>" + input(jsonobj.data[i].admin_grjs) + "</td>";
								str+="</tr>";
						
								$("#jsglmain").append(str);
							}
							tablePaging("jsglmainTable",0,"10",true,"",".admin_username","string","");
					}
					else{
						var jsglth="<tr><th>账号</th><th>姓名</th><th>关注</th><th>喜欢</th><th>一般</th><th>不满意</th><th>点评数量</th></tr>";
							$("#jsglth").append(jsglth);        	
							for (var i = 0; i < jsonobj.data.length; i++) {
													for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
			  }

								var str="<tr>";
								str+="<td class='admin_username'>" + input(jsonobj.data[i].admin_username) + "</td>";
								str+="<td class='admin_name'>" + input(jsonobj.data[i].admin_name) + "</td>";
								str+="<td class='gz_count'>" + input(jsonobj.data[i].gz_count) + "</td>";
								str+="<td class='xh_count'>" + input(jsonobj.data[i].xh_count) + "</td>";
								str+="<td class='yb_count'>" + input(jsonobj.data[i].yb_count) + "</td>";
								str+="<td class='bxh_count'>" + input(jsonobj.data[i].bxh_count) + "</td>";
								str+="<td class='zpdp_count'>" + input(jsonobj.data[i].zpdp_count) + "</td>";
								str+="</tr>";
						
								$("#jsglmain").append(str);
							}
							tablePaging("jsglmainTable",0,"10",true,"",".admin_username","string","");
					}	

               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function queryjsglmx(admin_id) {
	$("#jsgl").hide();
	$("#jsglmx").show();
	document.getElementById("jsglmx").reset();
	$("#admin_id").val(admin_id);
	var user_type=$("#user_type").val();
	$("#u3564-3").empty();
	var str="";
	if(user_type=="1"){
		str+="<option value=\"1\">教务员</option>";
		str+="<option value=\"2\">教师</option>";
	}
	else if (user_type=="2"){
		str+="<option value=\"2\">教师</option>";
	}
	else{
		str+="<option value=\"0\">管理员</option>";
		str+="<option value=\"1\">教务员</option>";
		str+="<option value=\"2\">教师</option>";
		
	}	
	$("#u3564-3").append(str);	
	/*$.ajax({
		async: false,
		type: 'post',
		data: 'cmd=queryjsgl_web&admin_id='+admin_id,
		url: posturl,
		success: function(data) {
			if (data) {
				var jsonobj=eval('('+data+')'); 
				if (jsonobj.errcode=="0"){          	
					for (var i = 0; i < jsonobj.data.length; i++) {
						$("#u3327-3").append("<option value="+jsonobj.data[i].kc_id+">"+jsonobj.data[i].kc_name+"</option>");							
					}						
				}
				else{
					alert(decodeURIComponent(jsonobj.errmsg));
				}
			}
			else {
				alert("操作失败");
			}
		}
	});*/
	
	if(admin_id!=""){

	   $.ajax({
			async: false,
			type: 'post',
			data: 'cmd=queryjsgl_web&admin_id='+admin_id,
			url: posturl,
			success: function(data) {
				if (data) {
					//$("#xyglmx").reset();
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){          	
							for (var i = 0; i < jsonobj.data.length; i++) {
													for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

								$("#u3525-3").val(jsonobj.data[i].admin_username);
								$("#u3528-3").val(jsonobj.data[i].admin_password);
								$("#u3530-3").val(jsonobj.data[i].admin_password);
								$("#u3564-3").val(jsonobj.data[i].admin_type);
								$("#u3560-3").val(jsonobj.data[i].admin_name);
								$("#u3532-3").val(jsonobj.data[i].admin_sex);
								$("#u3557-3").val(jsonobj.data[i].admin_nickname);
								$("#u3534-3").val(jsonobj.data[i].admin_address);
								$("#u3546-3").val(jsonobj.data[i].admin_grjs);
								$("#u3536-3").val(jsonobj.data[i].admin_birthday);
								$("#u3540-3").val(jsonobj.data[i].admin_phone);
								$("#u3542-3").val(jsonobj.data[i].admin_weibo);
								$("#u3544-3").val(jsonobj.data[i].admin_qq);
								$("#u3562-3").val(jsonobj.data[i].admin_email);
								$("#admin_pic").attr("src",jsonobj.data[i].admin_pic);
								$("#admin_pic_a").attr("href",jsonobj.data[i].admin_pic);
								$("#admin_pic_a").attr("target","_blank");								
							}						
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
		
	}
}

function addjsgl(){
	var admin_username=$("#u3525-3").val();
	var admin_password=$("#u3528-3").val();
	var admin_password_confirm=$("#u3530-3").val();
	var admin_type=$("#u3564-3").val();
	var admin_name=$("#u3560-3").val();
	var admin_sex=$("#u3532-3").val();
	var admin_nickname=$("#u3557-3").val();
	var admin_address=$("#u3534-3").val();
	var admin_grjs=$("#u3546-3").val();
	var admin_birthday=$("#u3536-3").val();
	var admin_phone=$("#u3540-3").val();
	var admin_weibo=$("#u3542-3").val();
	var admin_qq=$("#u3544-3").val();
	var admin_email=$("#u3562-3").val();
	if(admin_username==""){
		alert("账号不能为空");
		return;
	}
	if(admin_password==""){
		alert("密码不能为空");
		return;
	}
	if(admin_password!=admin_password_confirm){
		alert("两次输入密码不一致");
		return;
	}
	if(admin_type==""){
		alert("用户类型不能为空");
		return;
	}
	if(admin_name==""){
		alert("用户名不能为空");
		return;
	}
	if(admin_sex==""){
		alert("性别不能为空");
		return;
	}
	if(admin_phone==""){
		alert("手机不能为空");
		return;
	}
	if(!checknumber(admin_phone)){
		alert("请输入有效的手机");
		return;
	}
	if(admin_address==""){
		alert("地址不能为空");
		return;
	}
	if(admin_birthday==""){
		alert("生日不能为空");
		return;
	}
	if(admin_qq==""){
		alert("qq不能为空");
		return;
	}
	if(!checknumber(admin_qq)){
		alert("请输入有效的qq");
		return;
	}
	if(admin_email==""){
		alert("email不能为空");
		return;
	}
	if(!checkemail(admin_email)){
		alert("请输入有效的email");
		return;
	}
	if(admin_grjs==""){
		alert("个人介绍不能为空");
		return;
	}
	
	
	$("#jsglmx").submit();	
}


function newjsgl(){
	$("#jsgl").hide();$("#jsglmx").show();document.getElementById("jsglmx").reset();
	var user_type=$("#user_type").val();
	$("#u3564-3").empty();
	var str="";
	if(user_type=="1"){
		str+="<option value=\"1\">教务员</option>";
		str+="<option value=\"2\">教师</option>";
	}
	else if (user_type=="2"){
		str+="<option value=\"2\">教师</option>";
	}
	else{
		str+="<option value=\"0\">管理员</option>";
		str+="<option value=\"1\">教务员</option>";
		str+="<option value=\"2\">教师</option>";
	}
	$("#u3564-3").append(str);	
}

function deljsgl(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=deljsgl&admin_id='+$("#admin_id").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("jsglmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}

function admin_pic_show(){
	/*if (document.all){       
		document.getElementById("admin_pic").src = document.getElementById("admin_pic_url").value;
	}
    else{
		if (window.createObjectURL!=undefined) { // basic
			document.getElementById("admin_pic").src = window.createObjectURL(document.getElementById("admin_pic_url").files[0]) ;
		} else if (window.URL!=undefined) { // mozilla(firefox)
			document.getElementById("admin_pic").src = window.URL.createObjectURL(document.getElementById("admin_pic_url").files[0]) ;
		} else if (window.webkitURL!=undefined) { // webkit or chrome
			document.getElementById("admin_pic").src = window.webkitURL.createObjectURL(document.getElementById("admin_pic_url").files[0]) ;
		}
	}*/
	document.getElementById("admin_pic").src=getObjectURL(document.getElementById("admin_pic_url"));
}


function queryyjfk(){
	$("#u3922").show();
	var username=$("#u3914-3").val();
	var add_time=$("#u3917-3").val();
	

   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryyjfk&username='+username+'&add_time='+add_time,
        url: posturl,
        success: function(data) {
            if (data) {
            	//alert(data);
            	$("#yjfkmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
												for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

							var str="<tr>";
							str+="<td class='username'>" + input(jsonobj.data[i].username) + "</td>";					
							str+="<td class='yjfk_content'>" + input(jsonobj.data[i].yjfk_content) + "</td>";
							str+="<td class='add_time'>" + input(jsonobj.data[i].add_time) + "</td>";
							str+="</tr>";
						
							$("#yjfkmain").append(str);
						}
						tablePaging("yjfkmainTable",0,"10",true,"",".username","string","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function addtz(){
	var tz_title=$("#tz_bt").val();
	if(tz_title==""){
		alert("标题不能为空");
		return;
	}
	var tz_content=$("#tz_nr").val();
	if(tz_content==""){
		alert("内容不能为空");
		return;
	}
	//$("#tz").submit();	
	$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=addtz&tz_title='+tz_title+'&tz_content='+tz_content,
        url: posturl,
        success: function(data) {
            if (data) { 
				var jsonobj=eval('('+data+')');          	
            	alert(decodeURIComponent(jsonobj.errmsg));
            }
            else {
            	alert("操作失败");
            }
        }
    });
}


function querywtdy(){
	$("#wtdy_table").show();
	var username=$("#wtdy_xsxh").val();
	var admin_id=$("#wtdy_jsbh").val();
	
	var begindate=$("#wtdy_qsrq").val();
	var enddate=$("#wtdy_jsrq").val();

   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querywtdy&username='+username+'&admin_id='+admin_id+'&begindate='+begindate+'&enddate='+enddate,
        url: posturl,
        success: function(data) {
            if (data) {
            	//alert(data);
            	$("#wtdymain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}

							var dbclickstr='querywtdymx("'+jsonobj.data[i].wtdy_id+'","'+jsonobj.data[i].username+'","'+jsonobj.data[i].student_name+'","'+jsonobj.data[i].student_birthday+'","'+jsonobj.data[i].student_address+'","'+jsonobj.data[i].admin_id+'","'+jsonobj.data[i].admin_username+'","'+encodeURIComponent(jsonobj.data[i].wt_content)+'")';
							var str="<tr ondblclick='"+dbclickstr+"'>";
							str+="<td class='wtdy_id' style='display:none'>" + input(jsonobj.data[i].wtdy_id) + "</td>";
							str+="<td class='username'>" + input(jsonobj.data[i].username) + "</td>";					
							str+="<td class='student_name'>" + input(jsonobj.data[i].student_name) + "</td>";
							str+="<td class='student_birthday'>" + input(jsonobj.data[i].student_birthday) + "</td>";
							str+="<td class='student_address'>" + input(jsonobj.data[i].student_address) + "</td>";
							str+="<td class='wt_content'>" + input(jsonobj.data[i].wt_content) + "</td>";
							str+="<td class='admin_username'>" + input(jsonobj.data[i].admin_username) + "</td>";
							str+="</tr>";
						
							$("#wtdymain").append(str);
						}
						tablePaging("wtdymainTable",0,"10",true,"",".wtdy_id","number","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function querywtdymx(wtdy_id,username,student_name,student_birthday,student_address,admin_id,admin_username,wt_content) {
	$("#wtdy").hide();
	$("#wtdymx").show();
	document.getElementById("wtdymx").reset();
	$("#wtdymx_xh").val(username);
	$("#wtdymx_xm").val(student_name);
	$("#wtdymx_sr").val(student_birthday);
	$("#wtdymx_dz").val(student_address);
	$("#wtdymx_js").val(admin_username);
	$.ajax({
		async: false,
		type: 'post',
		data: 'cmd=querywtdy&username='+username+'&admin_id='+admin_id,
		url: posturl,
		success: function(data) {
			if (data) {
				var jsonobj=eval('('+data+')'); 
				if (jsonobj.errcode=="0"){ 
					$("#wtdymxmain").empty();         	
					for (var i = 0; i < jsonobj.data.length; i++) {
						for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
						}
						var str="<tr>";
						str+="<td class='wtdy_id' style='display:none'>" + input(jsonobj.data[i].wtdy_id) + "</td>";					
						str+="<td class='wt_content'>" + textarea(jsonobj.data[i].wt_content) + "</td>";
						str+="<td class='wt_time'>" + input(jsonobj.data[i].wt_time) + "</td>";
						str+="<td class='dy_content'>" + textarea(jsonobj.data[i].dy_content) + "</td>";
						str+="<td class='wtdy_sc' onclick ='delwtdy(\""+jsonobj.data[i].wtdy_id+"\",\""+jsonobj.data[i].username+"\",\""+jsonobj.data[i].student_name+"\",\""+jsonobj.data[i].student_birthday+"\",\""+jsonobj.data[i].student_address+"\",\""+jsonobj.data[i].admin_id+"\",\""+jsonobj.data[i].admin_username+"\",\""+jsonobj.data[i].wt_content+"\")'>删除</td>";
						str+="</tr>";
							
						$("#wtdymxmain").append(str);				
					}	
					tablePaging("wtdymxmainTable",0,"10",true,"",".wtdy_id","number","");					
				}
				else{
					alert(decodeURIComponent(jsonobj.errmsg));
				}
			}
			else {
				alert("操作失败");
			}
		}
	});

}


function adddy(){	
	var admin_id=$("#user_id").val();
	$("#wtdymxmain tr").each(function(trindex,tritem){
		var wtdy_id=$(tritem).find(".wtdy_id").find("input").val();
		var dy_content=$(tritem).find(".dy_content").find("textarea").val();
		$.ajax({
        async: false,
        type: 'post',
        data: 'cmd=adddy&wtdy_id='+wtdy_id+'&dy_content='+dy_content+'&admin_id='+admin_id,
        url: posturl,
        success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){					
							
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
						return ;
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
	});
	alert("保存成功");
	
}


function delwtdy(wtdy_id,username,student_name,student_birthday,student_address,admin_id,admin_username,wt_content){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delwtdy&wtdy_id='+wtdy_id,
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						querywtdymx(wtdy_id,username,student_name,student_birthday,student_address,admin_id,admin_username,wt_content);
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}

function queryxhrz(){
	$("#xhrz_table").show();
	var username=$("#xhrz_xh").val();
	var student_address=$("#xhrz_dz").val();
	
	var begindate=$("#xhrz_qsrq").val();
	var enddate=$("#xhrz_jsrq").val();

   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryxhrz&username='+username+'&student_address='+student_address+'&begindate='+begindate+'&enddate='+enddate,
        url: posturl,
        success: function(data) {
            if (data) {
            	//alert(data);
            	$("#xhrzmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){          	
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}

							var dbclickstr='queryxhrzmx("'+jsonobj.data[i].xhrz_id+'","'+jsonobj.data[i].username+'","'+jsonobj.data[i].student_name+'","'+jsonobj.data[i].student_birthday+'","'+jsonobj.data[i].student_address+'","'+jsonobj.data[i].xhrz_title+'","'+encodeURIComponent(jsonobj.data[i].xhrz_content)+'","'+jsonobj.data[i].xhrz_time+'","'+jsonobj.data[i].xhrz_pic+'")';
							var str="<tr ondblclick='"+dbclickstr+"'>";
							str+="<td class='xhrz_id' style='display:none'>" + input(jsonobj.data[i].xhrz_id) + "</td>";
							str+="<td class='username'>" + input(jsonobj.data[i].username) + "</td>";					
							str+="<td class='student_name'>" + input(jsonobj.data[i].student_name) + "</td>";
							str+="<td class='student_birthday'>" + input(jsonobj.data[i].student_birthday) + "</td>";
							str+="<td class='student_address'>" + input(jsonobj.data[i].student_address) + "</td>";
							str+="<td class='xhrz_title'>" + input(jsonobj.data[i].xhrz_title) + "</td>";
							str+="<td class='xhrz_content'>" + input(jsonobj.data[i].xhrz_content) + "</td>";
							str+="</tr>";
						
							$("#xhrzmain").append(str);
						}
						tablePaging("xhrzmainTable",0,"10",true,"",".xhrz_id","number","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function queryxhrzmx(xhrz_id,username,student_name,student_birthday,student_address,xhrz_title,xhrz_content,xhrz_time,xhrz_pic) {
	$("#xhrz").hide();
	$("#xhrzmx").show();
	document.getElementById("xhrzmx").reset();
	$("#xhrzmx_id").val(xhrz_id);
	$("#xhrzmx_xh").val(username);
	$("#xhrzmx_xm").val(student_name);
	$("#xhrzmx_sr").val(student_birthday);
	$("#xhrzmx_dz").val(student_address);
	$("#xhrzmx_sj").val(xhrz_time);
	$("#xhrzmx_bt").val(xhrz_title);
	$("#xhrzmx_nr").val(decodeURIComponent(xhrz_content));
	
	if(xhrz_pic!=""){
		var ch = xhrz_pic.split("|");
		$("#xhrzmxmain").empty();
		var str="<tr>";
				
		for(i=0;i<ch.length;i++){
			if(ch[i]!=""){
				str+="<td class='xhrzmx_pic'>" + img(ch[i]) + "</td>";
			}
		}
		
		str+="</tr>";
		$("#xhrzmxmain").append(str);
		
	}

}

function delxhrz(){
	if(confirm("是否确认删除"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=delxhrz&xhrz_id='+$("#xhrzmx_id").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					var jsonobj=eval('('+data+')'); 
					if (jsonobj.errcode=="0"){
						alert(decodeURIComponent(jsonobj.errmsg));
						document.getElementById("xhrzmx").reset();
					}
					else{
						alert(decodeURIComponent(jsonobj.errmsg));
					}
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}


function queryzcfw() {
	goback("zcfw");
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryzcfw&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#zcfwmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               								for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						 //$("#zcfwmain").append("<tr><td class='zcfw_content'>" + input(jsonobj.data[i].zcfw_content) + "</td><td class='zcfw'>" + frame(jsonobj.data[i].zcfw) + "</td></tr>");
						 var dbclickstr='zcfwdbclick("'+encodeURIComponent(jsonobj.data[i].zcfw_content)+'")';
						//var dbclickstr="$(\"#zcfw\").hide();$(\"#zcfwmx\").show();document.getElementById(\"zcfwmx\").reset();$(\"#u1891-3\").val(\""+jsonobj.data[i].zcfw_content+"\");";
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='zcfw_content'>" + input(jsonobj.data[i].zcfw_content) + "</td>";
						str+="<td class='zcfw'>" + input(jsonobj.data[i].zcfw) + "</td>";
						str+="</tr>";
						
						$("#zcfwmain").append(str);
					}
					tablePaging("zcfwmainTable",0,"",true,"",".zcfw_content","string","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function zcfwdbclick(zcfw_content){
	$("#zcfw").hide();
	$("#zcfwmx").show();
	document.getElementById("zcfwmx").reset();
	$("#zcfw_content").val(decodeURIComponent(zcfw_content));
}


function addzcfw(){
	var zcfw_content=$("#zcfw_content").val();
	if(zcfw_content==""){
		alert("内容不能为空");
		return;
	}
	
	$("#zcfwmx").submit();	
}


function newzcfw(){
	$("#zcfw").hide();$("#zcfwmx").show();document.getElementById("zcfwmx").reset();	
}



function querygy() {
	goback("gy");
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querygy&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#gymain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               								for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						 //$("#gymain").append("<tr><td class='gy_content'>" + input(jsonobj.data[i].gy_content) + "</td><td class='gy'>" + frame(jsonobj.data[i].gy) + "</td></tr>");
						 var dbclickstr='gydbclick("'+encodeURIComponent(jsonobj.data[i].gy_content)+'")';
						//var dbclickstr="$(\"#gy\").hide();$(\"#gymx\").show();document.getElementById(\"gymx\").reset();$(\"#u1891-3\").val(\""+jsonobj.data[i].gy_content+"\");";
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='gy_content'>" + input(jsonobj.data[i].gy_content) + "</td>";
						str+="<td class='gy'>" + input(jsonobj.data[i].gy) + "</td>";
						str+="</tr>";
						
						$("#gymain").append(str);
					}
					tablePaging("gymainTable",0,"",true,"",".gy_content","string","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function gydbclick(gy_content){
	$("#gy").hide();
	$("#gymx").show();
	document.getElementById("gymx").reset();
	$("#gy_content").val(decodeURIComponent(gy_content));
}


function addgy(){
	var gy_content=$("#gy_content").val();
	if(gy_content==""){
		alert("内容不能为空");
		return;
	}
	
	$("#gymx").submit();	
}


function newgy(){
	$("#gy").hide();$("#gymx").show();document.getElementById("gymx").reset();	
}


function querykktz() {
	goback("kktz");
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=querykktz&',
        url: posturl,
        success: function(data) {
            if (data) {
            	 $("#kktzmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               								for(var e in jsonobj.data[i]){
						jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  }

						 //$("#kktzmain").append("<tr><td class='kktz_content'>" + input(jsonobj.data[i].kktz_content) + "</td><td class='kktz'>" + frame(jsonobj.data[i].kktz) + "</td></tr>");
						 var dbclickstr='kktzdbclick("'+encodeURIComponent(jsonobj.data[i].kktz_content)+'")';
						//var dbclickstr="$(\"#kktz\").hide();$(\"#kktzmx\").show();document.getElementById(\"kktzmx\").reset();$(\"#u1891-3\").val(\""+jsonobj.data[i].kktz_content+"\");";
						var str="<tr ondblclick='"+dbclickstr+"'>";
						str+="<td class='kktz_content'>" + input(jsonobj.data[i].kktz_content) + "</td>";
						str+="<td class='kktz'>" + input(jsonobj.data[i].kktz) + "</td>";
						str+="</tr>";
						
						$("#kktzmain").append(str);
					}
					tablePaging("kktzmainTable",0,"",true,"",".kktz_content","string","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}

function kktzdbclick(kktz_content){
	$("#kktz").hide();
	$("#kktzmx").show();
	document.getElementById("kktzmx").reset();
	$("#kktz_content").val(decodeURIComponent(kktz_content));
}


function addkktz(){
	var kktz_content=$("#kktz_content").val();
	if(kktz_content==""){
		alert("内容不能为空");
		return;
	}
	
	$("#kktzmx").submit();	
}


function newkktz(){
	$("#kktz").hide();$("#kktzmx").show();document.getElementById("kktzmx").reset();	
}

function query_init(cmd){
	if(cmd=='xysk'){
		querybj();
		goback('xysk');
	}
	
	if(cmd=='bjdp'){
		querybj();
		goback('bjdp');
	}
}

function queryxysk() {
	$("#u3923").show();
	var username=$("#u3915-3").val();
	var jgts=$("#u3918-3").val();
	var bj_id=$("#u3915-6").val();
   $.ajax({
        async: false,
        type: 'post',
        data: 'cmd=queryxygl&username='+username+'&jgts='+jgts+'&bj_id='+bj_id,
        url: posturl,
        success: function(data) {
            if (data) {
            	$("#xyskmain").empty();
                var jsonobj=eval('('+data+')'); 
                if (jsonobj.errcode=="0"){
               		for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
							jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  				}

						var str="<tr>";
						str+="<td class='username'>" + input(jsonobj.data[i].username) + "</td>";
						str+="<td class='student_name'>" + input(jsonobj.data[i].student_name) + "</td>";
						str+="<td class='student_birthday'>" + input(jsonobj.data[i].student_birthday) + "</td>";
						str+="<td class='add_time'>" + input(jsonobj.data[i].add_time) + "</td>";
						str+="<td class='kc_name'>" + input(jsonobj.data[i].kc_name) + "</td>";
						str+="<td class='zpcount'>" + input(jsonobj.data[i].zpcount) + "</td>";
						str+="<td class='yskc'>" + input(jsonobj.data[i].yskc) + "</td>";
						str+="<td class='sykc'>" + input(jsonobj.data[i].sykc) + "</td>";
						str+="<td class='dqkc'>" + input(jsonobj.data[i].dqkc) + "</td>";
						str+="</tr>";
						
						$("#xyskmain").append(str);
					}
					tablePaging("xyskmainTable",0,"10",true,"desc",".add_time","string","");
               	}
               	else{
               		alert(decodeURIComponent(jsonobj.errmsg));
               	}
            }
            else {
                alert("操作失败");
            }
        }
    });
}



function adminloginout(){
	if(confirm("是否确认退出"))
	{
		$.ajax({
			async: false,
			type: 'post',
			data: 'cmd=adminloginout&admin_id='+$("#user_id").val(),
			url: posturl,
			success: function(data) {
				if (data) {
					window.location.href="index.html";
				}
				else {
					alert("操作失败");
				}
			}
		});
    }
}


function test(){
	alert("111");
	document.getElementById("zsjj_content").innerHTML="222";
	//$("#u602").load("manage.html");
	//document.getElementById("u602").innerHTML="<iframe src='manage.html' width='100%' height='100%' marginWidth='0' marginHeight='0'  frameBorder='0' scrolling='auto'</iframe>";
	//document.getElementById("u600").src="manage.html";
	//var index_dialog=document.getElementById("u600");
	//index_dialog.empty();
}


function goback(main){
	$("#"+main).show();
	$("#"+main+"mx").hide();
}

function input(data){
	str="<input readonly='readonly' value='" + data + "'/>";
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


function img(){
	var url = arguments[0] ? arguments[0] : "";
	var width = arguments[1] ? arguments[1] : "200px";
	var height = arguments[2] ? arguments[2] : "200px";
	str="<a href='"+url+"' target=\"_blank\"><image src='"+url+"' width='"+width+"' height='"+height+"'/></a>";
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

function getObjectURL(file) {
	var url = null ;
	if (document.all){       
		url = file.value;
	}
    else{
		if (window.createObjectURL!=undefined) { // basic
			url = window.createObjectURL(file.files[0]) ;
		} else if (window.URL!=undefined) { // mozilla(firefox)
			url = window.URL.createObjectURL(file.files[0]) ;
		} else if (window.webkitURL!=undefined) { // webkit or chrome
			url = window.webkitURL.createObjectURL(file.files[0]) ;
		}
	}
	return url ;
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
	return Date.parse(date);
    //return Date.parse(convertDateFormat(date)); // from en-GB format to en-US format,must greater than 01/01/1970;
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
