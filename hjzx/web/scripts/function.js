var posturl="http://120.27.97.213:8080/hjzx/index.php";

function main(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var async = arguments[2] ? arguments[2] : "false";
	var extend = arguments[3] ? arguments[3] : "";
	
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
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
					else if (cmd=="del_action"){
						alert(retmsg);
						query('action');
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
					else if(cmd=="queryjrjc"){
						var title=jsonobj.title?jsonobj.title:"";
						var show_array=new Array();
						if(title!=""){
							show_array=explode("|",title);
							$("table thead tr").empty();
							var str="";
							for(var j in show_array){
								var show_mx=new Array();
								show_mx=explode("/",show_array[j]);
								var isshow=show_mx[0];
								var titlename=show_mx[1];
								var fieldname=show_mx[2];
								if(isshow=="1"){
									if(fieldname=="user_phone"){
										str="<th>"+titlename+"</th>"+str;
									}
									else{
										str+="<th>"+titlename+"</th>";
									}
								}
							}
							str+="<th width=\"200px\">接触情况</th>";
							str+="<th>录音上传</th>";
							str+="<th>提交</th>";
							
							$("table thead tr").append(str);
							
						}
						
						var contact_list=$("[name='contact_list']").val();
						
						$("table tbody").empty();
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}
							
							var str="<tr>";
							var str2="";
							for(var j in show_array){
								var show_mx=new Array();
								show_mx=explode("/",show_array[j]);
								var isshow=show_mx[0];
								var titlename=show_mx[1];
								var fieldname=show_mx[2];
								if(isshow=="1"){
									if(fieldname=="user_phone"){
										str2="<td class='"+fieldname+"'>" + jsonobj.data[i][fieldname] + "</td>"+str2;
									}
									else{
										str2+="<td class='"+fieldname+"'>" + jsonobj.data[i][fieldname] + "</td>";
									}
								}
								
								
							}
							
							str2+="<td class='id' style='display:none'>" + jsonobj.data[i]["id"] + "</td>";
							
							str+=str2;
							
							str+="<td>"+"<select class=\"form-control-5\"  onChange=\"change('contact','index="+i+"')\" name=\"contact_id\">"+contact_list+"</select><input type=\"text\" class=\"form-control-4 col-sm-offset-1 hidden\"  name=\"contact_bz\">"+"</td>";
							str+="<td>"+upload_str('record_'+i,'上传')+"</td>";
							str+="<td><button type=\"button\" class=\"btn btn-xs btn-warning\" onclick=\"save('contact','index="+i+"')\">提交</button></td>";
							str+="<td class='hidden' name='record'></td>";

							str+="</tr>";
												
							$("table tbody").append(str);
							
							binduploadauto('record_'+i,{"cmd":"upload_record","admin_id":$("#admin_id").html(),"proj_id":$("#proj_id").html(),"user_phone":jsonobj.data[i].user_phone,"id":jsonobj.data[i].id,"index":i});
							
						}
						
					}
					else if (cmd=="adminlogin"){
						var admin_id=jsonobj.admin_id?jsonobj.admin_id:"";
						var admin_type_id=jsonobj.admin_type_id?jsonobj.admin_type_id:"";
						if(admin_type_id=='2'){
							window.location.href="index.html";
						}
						else{
							window.location.href="admin/index.html";
						}
					}
					else if (cmd=="adminloginout"){
						var admin_type_id=jsonobj.admin_type_id?jsonobj.admin_type_id:"";
						if(admin_type_id=='2'){
							window.location.href="login.html";
						}
						else{
							window.location.href="../login.html";
						}
					}
					else if (cmd=="queryadmininfo"){
						var admin_id=jsonobj.admin_id?jsonobj.admin_id:"";
						var admin_name=jsonobj.admin_name?jsonobj.admin_name:"";
						var admin_type_id=jsonobj.admin_type_id?jsonobj.admin_type_id:"";
						var check=jsonobj.check?jsonobj.check:"0";
						$("#admin_id").html(admin_id);
						
						if(admin_type_id=='2'){
							$("#checklist").show();
							checkin(check);
						}
						else{
							$("#checklist").hide();
						}
						if(admin_id==""){
							alert("请先登陆");
							if(extend=="admin_index" || extend=="admin_project" || extend=="admin_staff" || extend=="admin_log" || extend=="admin_admin"){
								window.location.href="../login.html";
							}
							else{
								window.location.href="login.html";
							}
						}
						else{
							if(admin_type_id=="0"){
								$("#admin_right").show();
							}
							else{
								$("#admin_right").hide();
							}
							
							if(extend=="index"){
								main("get_proj_id","","false",extend);
							}
							else if(extend=="audit"){
								main("get_proj_id","","false",extend);
								main("query_audit_result","audit_result_type_id=0");
							}
							else if(extend=="statistical"){
								main("get_proj_id","","false",extend);
								main("query_tj","admin_id="+admin_id);
							}
							else if(extend=="admin_index"){
								main("query_proj");
							}
							else if(extend=="admin_staff"){
								main("query_admin_group");
								main("query_admin","admin_type_id=2");
							}
							else if(extend=="admin_admin"){
								main("query_admin","admin_type_id=1");
							}

						}
					}
					else if (cmd=="get_proj_id"){
						var proj_id=jsonobj.proj_id?jsonobj.proj_id:"";
						var proj_name=jsonobj.proj_name?jsonobj.proj_name:"";
						if(proj_id!=""){
							$("#proj_id").html(proj_id);
							$("#proj_name").html(proj_name);
							if(extend=="index"){
								main("query_contact");
							}
						}
						else{
							if(extend=="index"){
								main("query_proj_list","admin_id="+$("#admin_id").html());
							}
						}
					}
					else if (cmd=="query_proj_list"){
						var cnt=jsonobj.cnt?jsonobj.cnt:"0";
						var proj_list=jsonobj.proj_list?jsonobj.proj_list:"";
						if(cnt=="0"){
							alert("该员工没有对应的项目");
							window.location.href="login.html";
						}
						else if(cnt=="1"){
							var proj_array=new Array();
							proj_array=explode("/",proj_list);
							var proj_id=proj_array[0];
							var proj_name=proj_array[1];
							
							main("set_proj_id","proj_id="+proj_id+"&proj_name="+proj_name);
						}
						else{
							var get_proj_id=prompt("请输入项目编号("+proj_list+")","");
							if(get_proj_id){
								var proj_array=new Array();
								proj_array=explode(",",proj_list);
								var str="";
								for(var i in proj_array){
									var proj_mx=new Array();
									proj_mx=explode("/",proj_array[i]);
									var proj_id=proj_mx[0];
									var proj_name=proj_mx[1];
									if(get_proj_id==proj_id){
										str=proj_name;
									}
								}
								if(str==""){
									alert("输入项目编号不存在");
									return;
								}
								else{
									main("set_proj_id","proj_id="+get_proj_id+"&proj_name="+proj_name);
								}
							}
						}
					}
					else if (cmd=="set_proj_id"){
						var proj_id=cmdarr["proj_id"];
						var proj_name=cmdarr["proj_name"];
						
						$("#proj_id").html(proj_id);
						$("#proj_name").html(proj_name);
						
						main("query_contact");
					}
					else if (cmd=="query_contact"){
						var str="<option value=''></option>";
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}

							str+="<option value=\""+jsonobj.data[i].contact_id+"\">"+jsonobj.data[i].contact_name+"</option>"
						}
						
						$("[name='contact_list']").val(str);
						
						main("queryjrjc","admin_id="+$("#admin_id").html()+"&proj_id="+$("#proj_id").html());
																		
					}
					else if (cmd=="query_audit_result"){
						var str="<option value=''></option>";
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}

							str+="<option value=\""+jsonobj.data[i].audit_result_id+"\">"+jsonobj.data[i].audit_result_name+"</option>"
						}
						
						$("[name='audit_result_list']").val(str);
						
						main("queryjrsh","admin_id="+$("#admin_id").html()+"&proj_id="+$("#proj_id").html());
																		
					}
					else if(cmd=="queryjrsh"){
						var title=jsonobj.title?jsonobj.title:"";
						var show_array=new Array();
						if(title!=""){
							show_array=explode("|",title);
							$("table thead tr").empty();
							var str="";
							for(var j in show_array){
								var show_mx=new Array();
								show_mx=explode("/",show_array[j]);
								var isshow=show_mx[0];
								var titlename=show_mx[1];
								var fieldname=show_mx[2];
								if(isshow=="1"){
									if(fieldname=="user_phone"){
										str="<th>"+titlename+"</th>"+str;
									}
									else{
										str+="<th>"+titlename+"</th>";
									}
								}
							}
							str+="<th>在线审核</th>";
							str+="<th width=\"200px\">审核结果</th>";
							str+="<th>提交</th>";
							
							$("table thead tr").append(str);
							
						}
						
						var audit_result_list=$("[name='audit_result_list']").val();
						
						$("table tbody").empty();
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}
							
							var str="<tr>";
							var str2="";
							for(var j in show_array){
								var show_mx=new Array();
								show_mx=explode("/",show_array[j]);
								var isshow=show_mx[0];
								var titlename=show_mx[1];
								var fieldname=show_mx[2];
								if(isshow=="1"){
									if(fieldname=="user_phone"){
										str2="<td class='"+fieldname+"'>" + jsonobj.data[i][fieldname] + "</td>"+str2;
									}
									else{
										str2+="<td class='"+fieldname+"'>" + jsonobj.data[i][fieldname] + "</td>";
									}
								}
								
								
							}
							
							str2+="<td class='id' style='display:none'>" + jsonobj.data[i]["id"] + "</td>";
							str2+="<td class='last_record' style='display:none'>" + jsonobj.data[i]["last_record"] + "</td>";
							
							str+=str2;
							
							str+="<td><button type=\"button\" class=\"btn btn-xs btn-danger\" onclick=\"bclick('audit','index="+i+"')\">审核</button></td>";
							str+="<td>"+"<select class=\"form-control-5\"  onChange=\"change('audit','index="+i+"')\" name=\"audit_id\">"+audit_result_list+"</select><input type=\"text\" class=\"form-control-4 col-sm-offset-1 hidden\"  name=\"audit_bz\">"+"</td>";
							
							str+="<td><button type=\"button\" class=\"btn btn-xs btn-warning\" onclick=\"save('audit','index="+i+"')\">提交</button></td>";

							str+="</tr>";
												
							$("table tbody").append(str);
							
							
						}
						
					}
					else if (cmd=="query_tj"){
						var jr_zj=jsonobj.jr_zj?jsonobj.jr_zj:"0";
						var jr_fwcg=jsonobj.jr_fwcg?jsonobj.jr_fwcg:"0";
						var jr_yyfw=jsonobj.jr_yyfw?jsonobj.jr_yyfw:"0";
						var jr_ztjf=jsonobj.jr_ztjf?jsonobj.jr_ztjf:"0";
						var jr_kcjf=jsonobj.jr_kcjf?jsonobj.jr_kcjf:"0";
						var jr_qtqk=jsonobj.jr_qtqk?jsonobj.jr_qtqk:"0";
						var jr_cgl=jsonobj.jr_cgl?jsonobj.jr_cgl:"0%";
						$("#jr_zj").html(jr_zj);
						$("#jr_fwcg").html(jr_fwcg);
						$("#jr_yyfw").html(jr_yyfw);
						$("#jr_ztjf").html(jr_ztjf);
						$("#jr_kcjf").html(jr_kcjf);
						$("#jr_qtqk").html(jr_qtqk);
						$("#jr_cgl").html(jr_cgl);
						
						var ls_zj=jsonobj.ls_zj?jsonobj.ls_zj:"0";
						var ls_fwcg=jsonobj.ls_fwcg?jsonobj.ls_fwcg:"0";
						var ls_yyfw=jsonobj.ls_yyfw?jsonobj.ls_yyfw:"0";
						var ls_ztjf=jsonobj.ls_ztjf?jsonobj.ls_ztjf:"0";
						var ls_kcjf=jsonobj.ls_kcjf?jsonobj.ls_kcjf:"0";
						var ls_qtqk=jsonobj.ls_qtqk?jsonobj.ls_qtqk:"0";
						var ls_cgl=jsonobj.ls_cgl?jsonobj.ls_cgl:"0%";
						$("#ls_zj").html(ls_zj);
						$("#ls_fwcg").html(ls_fwcg);
						$("#ls_yyfw").html(ls_yyfw);
						$("#ls_ztjf").html(ls_ztjf);
						$("#ls_kcjf").html(ls_kcjf);
						$("#ls_qtqk").html(ls_qtqk);
						$("#ls_cgl").html(ls_cgl);
						
						$("#jrcg tbody").empty();
						if(jsonobj.data.jrcg){
							var str="";
							for (var i = 0; i < jsonobj.data.jrcg.length; i++) {
								for(var e in jsonobj.data.jrcg[i]){
									jsonobj.data.jrcg[i][e]=decodeURIComponent(jsonobj.data.jrcg[i][e]);	
								}
								str+="<tr>";
								str+="<td class='admin_id'>" + jsonobj.data.jrcg[i].admin_id + "</td>";
								str+="<td class='cnt'>" + jsonobj.data.jrcg[i].cnt + "</td>";
							
								str+="</tr>";
						
							}
							$("#jrcg tbody").append(str);
						}
						
						$("#lscg tbody").empty();
						if(jsonobj.data.lscg){
							var str="";
							for (var i = 0; i < jsonobj.data.lscg.length; i++) {
								for(var e in jsonobj.data.lscg[i]){
									jsonobj.data.lscg[i][e]=decodeURIComponent(jsonobj.data.lscg[i][e]);	
								}
								str+="<tr>";
								str+="<td class='admin_id'>" + jsonobj.data.lscg[i].admin_id + "</td>";
								str+="<td class='cnt'>" + jsonobj.data.lscg[i].cnt + "</td>";
							
								str+="</tr>";
						
							}
							$("#lscg tbody").append(str);
						}
						
						var jr_shzj=jsonobj.jr_shzj?jsonobj.jr_shzj:"0";
						var jr_shcg=jsonobj.jr_shcg?jsonobj.jr_shcg:"0";
						var jr_shsb=jsonobj.jr_shsb?jsonobj.jr_shsb:"0";
						$("#jr_shzj").html(jr_shzj);
						$("#jr_shcg").html(jr_shcg);
						$("#jr_shsb").html(jr_shsb);
						
						var ls_shzj=jsonobj.ls_shzj?jsonobj.ls_shzj:"0";
						var ls_shcg=jsonobj.ls_shcg?jsonobj.ls_shcg:"0";
						var ls_shsb=jsonobj.ls_shsb?jsonobj.ls_shsb:"0";
						$("#ls_shzj").html(ls_shzj);
						$("#ls_shcg").html(ls_shcg);
						$("#ls_shsb").html(ls_shsb);
						
						$("#jrsh tbody").empty();
						if(jsonobj.data.jrsh){
							var str="";
							for (var i = 0; i < jsonobj.data.jrsh.length; i++) {
								for(var e in jsonobj.data.jrsh[i]){
									jsonobj.data.jrsh[i][e]=decodeURIComponent(jsonobj.data.jrsh[i][e]);	
								}
								str+="<tr>";
								str+="<td class='admin_id'>" + jsonobj.data.jrsh[i].admin_id + "</td>";
								str+="<td class='cnt'>" + jsonobj.data.jrsh[i].cnt + "</td>";
							
								str+="</tr>";
						
							}
							$("#jrsh tbody").append(str);
						}
						
						$("#lssh tbody").empty();
						if(jsonobj.data.lssh){
							var str="";
							for (var i = 0; i < jsonobj.data.lssh.length; i++) {
								for(var e in jsonobj.data.lssh[i]){
									jsonobj.data.lssh[i][e]=decodeURIComponent(jsonobj.data.lssh[i][e]);	
								}
								str+="<tr>";
								str+="<td class='admin_id'>" + jsonobj.data.lssh[i].admin_id + "</td>";
								str+="<td class='cnt'>" + jsonobj.data.lssh[i].cnt + "</td>";
							
								str+="</tr>";
						
							}
							$("#lssh tbody").append(str);
						}
					}
					else if (cmd=="query_proj"){
						$("#proj tbody").empty();
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}

							var str="<tr>";
							str+="<td class='proj_id'>" + jsonobj.data[i].proj_id + "</td>";
							str+="<td class='proj_name'><a  data-toggle='modal' data-target='#myModal'  onclick=\"bclick('proj','index="+i+"')\">" + jsonobj.data[i].proj_name + "</a></td>";
							str+="<td class='proj_bz'>" + jsonobj.data[i].proj_bz + "</td>";
							str+="<td class='proj_zxcount'>" + jsonobj.data[i].proj_zxcount + "</td>";
							str+="<td class='status_id' style='display:none'>" + jsonobj.data[i].status_id + "</td>";
							str+="<td class='status_name'>" + jsonobj.data[i].status_name + "</td>";
							str+="<td> <button type='button' class='btn btn-xs btn-warning' data-toggle='modal' data-target='#myModal2' onclick=\"bclick('proj_user','index="+i+"')\">查询</button></td>";
							str+="<td> <button type='button' class='btn btn-xs btn-warning' data-toggle='modal' data-target='#myModal3' onclick=\"bclick('proj_contact','index="+i+"')\">查询</button></td>";
							str+="</tr>";
					
							$("#proj tbody").append(str);
						}
						
					}
					else if (cmd=="query_proj_mx"){
						var proj_id=jsonobj.proj_id?jsonobj.proj_id:"";
						var proj_name=jsonobj.proj_name?jsonobj.proj_name:"";
						var proj_bz=jsonobj.proj_bz?jsonobj.proj_bz:"";
						var status_id=jsonobj.status_id?jsonobj.status_id:"";
						var title=jsonobj.proj_list?jsonobj.proj_list:"";
						var group_id=jsonobj.group_id?jsonobj.group_id:"";
						var ip=jsonobj.ip?jsonobj.ip:"";
						var port=jsonobj.port?jsonobj.port:"";
						var name=jsonobj.name?jsonobj.name:"";
						var pwd=jsonobj.pwd?jsonobj.pwd:"";
						
						$("[name='proj_id']").val(proj_id);
						$("[name='proj_name']").val(proj_name);
						$("[name='proj_bz']").val(proj_bz);
						$("[name='status_id']").val(status_id);
						$("[name='group_id']").val(group_id);
						$("[name='ip']").val(ip);
						$("[name='port']").val(port);
						$("[name='name']").val(name);
						$("[name='pwd']").val(pwd);
						
						var show_array=new Array();
						if(title!=""){
							show_array=explode("|",title);
							var str="";
							for(var j in show_array){
								var show_mx=new Array();
								show_mx=explode("/",show_array[j]);
								var isshow=show_mx[0];
								var titlename=show_mx[1];
								var fieldname=show_mx[2];
								if(isshow=="1"){
									$("[name='"+fieldname+"']").prop("checked","checked");
								}
								else{
									$("[name='"+fieldname+"']").prop("checked",false);
								}
							}
						}
						
					}
					else if (cmd=="query_proj_contact"){
						var zyb=jsonobj.zyb?jsonobj.zyb:"0";
						var jcyb=jsonobj.jcyb?jsonobj.jcyb:"0";
						var wjcyb=jsonobj.wjcyb?jsonobj.wjcyb:"0";
						var jr_fwcg=jsonobj.jr_fwcg?jsonobj.jr_fwcg:"0";
						var jr_yyfw=jsonobj.jr_yyfw?jsonobj.jr_yyfw:"0";
						var jr_kcjf=jsonobj.jr_kcjf?jsonobj.jr_kcjf:"0";
						var jr_ztjf=jsonobj.jr_ztjf?jsonobj.jr_ztjf:"0";
						var jr_sb=jsonobj.jr_sb?jsonobj.jr_sb:"0";
						var ls_fwcg=jsonobj.ls_fwcg?jsonobj.ls_fwcg:"0";
						var ls_yyfw=jsonobj.ls_yyfw?jsonobj.ls_yyfw:"0";
						var ls_kcjf=jsonobj.ls_kcjf?jsonobj.ls_kcjf:"0";
						var ls_ztjf=jsonobj.ls_ztjf?jsonobj.ls_ztjf:"0";
						var ls_sb=jsonobj.ls_sb?jsonobj.ls_sb:"0";
						
						$("#zyb").html(zyb);
						$("#jcyb").html(jcyb);
						$("#wjcyb").html(wjcyb);
						$("#jr_fwcg").html(jr_fwcg);
						$("#jr_yyfw").html(jr_yyfw);
						$("#jr_kcjf").html(jr_kcjf);
						$("#jr_ztjf").html(jr_ztjf);
						$("#jr_sb").html(jr_sb);
						$("#ls_fwcg").html(ls_fwcg);
						$("#ls_yyfw").html(ls_yyfw);
						$("#ls_kcjf").html(ls_kcjf);
						$("#ls_ztjf").html(ls_ztjf);
						$("#ls_sb").html(ls_sb);
						
					}
					else if (cmd=="query_proj_user_2"){
						var contact_name=jsonobj.contact_name?jsonobj.contact_name:"";
						$("#contact_name").html(contact_name);
					}
					else if (cmd=="query_admin"){
						var admin_type_id=cmdarr["admin_type_id"];
						if(admin_type_id=='2'){
							$("#admin_staff tbody").empty();
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
	
								var str="<tr>";
								str+="<td><input type='checkbox'></td>";
								str+="<td class='admin_id' style='display:none'>" + jsonobj.data[i].admin_id + "</td>";
								str+="<td class='admin_name'>" + jsonobj.data[i].admin_name + "</td>";
								str+="<td class='admin_pwd'>" + jsonobj.data[i].admin_pwd + "</td>";
								str+="<td class='group_name' onKeyDown='keydown(\"add_staff\",\"index="+i+"\")'>" + jsonobj.data[i].group_name + "</td>";
								str+="</tr>";
						
								$("#admin_staff tbody").append(str);
							}
						}
						else if(admin_type_id=='1'){
							$("#admin_admin tbody").empty();
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
	
								var str="<tr>";
								str+="<td><input type='checkbox'></td>";
								str+="<td class='admin_id' style='display:none'>" + jsonobj.data[i].admin_id + "</td>";
								str+="<td class='admin_name'>" + jsonobj.data[i].admin_name + "</td>";
								str+="<td class='admin_pwd' onKeyDown='keydown(\"add_admin_admin\",\"index="+i+"\")'>" + jsonobj.data[i].admin_pwd + "</td>";
								str+="</tr>";
						
								$("#admin_admin tbody").append(str);
							}
						}
					}
					else if (cmd=="query_admin_group"){
						$("#admin_group tbody").empty();
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}

							var str="<tr>";
							str+="<td><input type='checkbox'></td>";
							str+="<td class='group_id' style='display:none'>" + jsonobj.data[i].group_id + "</td>";
							str+="<td class='group_name'>" + jsonobj.data[i].group_name + "</td>";
							str+="<td class='group_bz'>" + jsonobj.data[i].group_bz + "</td>";
							str+="<td class='group_pwd'>" + jsonobj.data[i].group_pwd + "</td>";
							str+="<td class='admin_name' onKeyDown='keydown(\"add_admin_group\",\"index="+i+"\")'>" + jsonobj.data[i].admin_name + "</td>";
							str+="</tr>";
					
							$("#admin_group tbody").append(str);
						}
					}
					else if (cmd=="add_admin_staff"){
						var admin_id=jsonobj.admin_id?jsonobj.admin_id:"";
						
						var index=extend;
						
						var admin_name=$("#admin_staff tbody tr:eq("+index+") .admin_name input").val();
						var admin_pwd=$("#admin_staff tbody tr:eq("+index+") .admin_pwd input").val();
						var group_name=$("#admin_staff tbody tr:eq("+index+") .group_name input").val();
						$("#admin_staff tbody tr:eq("+index+") .admin_id").html(admin_id);
						$("#admin_staff tbody tr:eq("+index+") .admin_name").html(admin_name);
						$("#admin_staff tbody tr:eq("+index+") .admin_pwd").html(admin_pwd);
						$("#admin_staff tbody tr:eq("+index+") .group_name").html(group_name);
						
						alert(retmsg);
						
					}
					else if (cmd=="del_admin_staff"){
						var index=extend;
						$("#admin_staff tbody tr:eq("+index+")").addClass("hidden");
						
					}
					else if (cmd=="add_admin_group"){
						var group_id=jsonobj.group_id?jsonobj.group_id:"";
						
						var index=extend;
						
						var group_name=$("#admin_group tbody tr:eq("+index+") .group_name input").val();
						var group_bz=$("#admin_group tbody tr:eq("+index+") .group_bz input").val();
						var group_pwd=$("#admin_group tbody tr:eq("+index+") .group_pwd input").val();
						var admin_name=$("#admin_group tbody tr:eq("+index+") .admin_name input").val();
						$("#admin_group tbody tr:eq("+index+") .group_id").html(group_id);
						$("#admin_group tbody tr:eq("+index+") .group_name").html(group_name);
						$("#admin_group tbody tr:eq("+index+") .group_bz").html(group_bz);
						$("#admin_group tbody tr:eq("+index+") .group_pwd").html(group_pwd);
						$("#admin_group tbody tr:eq("+index+") .admin_name").html(admin_name);
						
						alert(retmsg);
						
					}
					else if (cmd=="del_admin_group"){
						var index=extend;
						$("#admin_group tbody tr:eq("+index+")").addClass("hidden");
						
					}
					else if (cmd=="add_admin_admin"){
						var admin_id=jsonobj.admin_id?jsonobj.admin_id:"";
						
						var index=extend;
						
						var admin_name=$("#admin_admin tbody tr:eq("+index+") .admin_name input").val();
						var admin_pwd=$("#admin_admin tbody tr:eq("+index+") .admin_pwd input").val();
						$("#admin_admin tbody tr:eq("+index+") .admin_id").html(admin_id);
						$("#admin_admin tbody tr:eq("+index+") .admin_name").html(admin_name);
						$("#admin_admin tbody tr:eq("+index+") .admin_pwd").html(admin_pwd);
						
						alert(retmsg);
						
					}
					else if (cmd=="del_admin_admin"){
						var index=extend;
						$("#admin_admin tbody tr:eq("+index+")").addClass("hidden");
						
					}
					else if (cmd=="checkin"){
						alert(retmsg);
						checkin("1");
						main("queryjrjc","admin_id="+$("#admin_id").html()+"&proj_id="+$("#proj_id").html());
						
					}
					else if (cmd=="checkout"){
						alert(retmsg);
						checkin("0");
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

function bclick(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	$("form").show();
	if (cmd=="checkin"){
		var admin_id=$("#admin_id").html();
		main("checkin","admin_id="+admin_id);
	}
	else if (cmd=="checkout"){
		var admin_id=$("#admin_id").html();
		main("checkout","admin_id="+admin_id);
	}
	else if (cmd=="audit"){
		var i=cmdarr["index"];
		var last_record=$("tbody tr:eq("+i+") .last_record").html();
		$("audio").attr("src",last_record);
		//$("audio").attr("src","file/1.mp3"); 
		var myVid=document.getElementById("audio");
		myVid.play();
	}
	else if (cmd=="proj"){
		var i=cmdarr["index"];
		var proj_id=$("#proj tbody tr:eq("+i+") .proj_id").html();
		$("#proj_model")[0].reset();
		main("query_proj_mx","proj_id="+proj_id);
	}
	else if (cmd=="connect"){
		var ip=$("[name='ip']").val();
		var port=$("[name='port']").val();
		var name=$("[name='name']").val();
		var pwd=$("[name='pwd']").val();
		
		main("connect_db","ip="+ip+"&port="+port+"&name="+name+"&pwd="+pwd);
	}
	else if (cmd=="proj_user"){
		var i=cmdarr["index"];
		var proj_id=$("#proj tbody tr:eq("+i+") .proj_id").html();
		var proj_name=$("#proj tbody tr:eq("+i+") .proj_name a").html();
		$("#myModalLabel2").html("项目名称 "+proj_name);
		$("#proj_id_2").val(proj_id);
	}
	else if (cmd=="proj_contact"){
		var i=cmdarr["index"];
		var proj_id=$("#proj tbody tr:eq("+i+") .proj_id").html();
		var proj_name=$("#proj tbody tr:eq("+i+") .proj_name a").html();
		$("#myModalLabel3").html("项目名称 "+proj_name);
		$("#proj_id_3").val(proj_id);
		$("#contact_name").html("");
		
		main("query_proj_contact","proj_id="+proj_id);
	}
}

function dbclick(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	$("form").show();
	if(cmd=="querylist"){
		$("#wxgl").hide();
		
		var action_id=cmdarr["action_id"] ? cmdarr["action_id"] : "";
		
		main("querylist","action_id="+action_id,"false","4");
	}
	
}


function newadd(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	if(cmd=="wxgl"){
		$("form").show();
		
		$("#wxgl").hide();
		
		reset_2();
		$("input[name='dh_wp_type_id']").focus();
		
		main("query_maxid");
		change("get_type_id");
	}
	else if(cmd=="admin_staff"){
		var index=$("#admin_staff tbody tr").length;
		var str="<tr>";
		str+="<td><input type='checkbox'></td>";
		str+="<td class='admin_id' style='display:none'></td>";
		str+="<td class='admin_name'>" + input("") + "</td>";
		str+="<td class='admin_pwd'>" + input("") + "</td>";
		str+="<td class='group_name' onKeyDown='keydown(\"add_staff\",\"index="+index+"\")'>" + input("") + "</td>";
		str+="</tr>";

		$("#admin_staff tbody").append(str);
	}
	else if(cmd=="admin_staff_2"){
		var count=prompt("请输入个数","");
		if(count){
			var index=$("#admin_staff tbody tr").length;
			for(var i=0;i<count;i++){
				var str="<tr>";
				str+="<td><input type='checkbox'></td>";
				str+="<td class='admin_id' style='display:none'></td>";
				str+="<td class='admin_name'>" + input("") + "</td>";
				str+="<td class='admin_pwd'>" + input("") + "</td>";
				str+="<td class='group_name' onKeyDown='keydown(\"add_staff\",\"index="+(index+i)+"\")'>" + input("") + "</td>";
				str+="</tr>";
				$("#admin_staff tbody").append(str);
			}
		}
	}
	else if(cmd=="admin_staff_edit"){
		var trs="#admin_staff tbody tr";
		for(var i=0;i<$(trs).length;i++){
			if (check($(trs+":eq("+i+") :checkbox"))=="1"){
				var admin_name=$(trs+":eq("+i+") .admin_name").html();
				var admin_pwd=$(trs+":eq("+i+") .admin_pwd").html();
				var group_name=$(trs+":eq("+i+") .group_name").html();
				
				if(admin_name.indexOf("input")<=0){
					$(trs+":eq("+i+") .admin_name").html(input(admin_name));
				}
				if(admin_pwd.indexOf("input")<=0){
					$(trs+":eq("+i+") .admin_pwd").html(input(admin_pwd));
				}
				if(group_name.indexOf("input")<=0){
					$(trs+":eq("+i+") .group_name").html(input(group_name));
				}
			}
		}
	}
	else if(cmd=="admin_admin"){
		var index=$("#admin_admin tbody tr").length;
		var str="<tr>";
		str+="<td><input type='checkbox'></td>";
		str+="<td class='admin_id' style='display:none'></td>";
		str+="<td class='admin_name'>" + input("") + "</td>";
		str+="<td class='admin_pwd' onKeyDown='keydown(\"add_admin_admin\",\"index="+index+"\")'>" + input("") + "</td>";
		str+="</tr>";

		$("#admin_admin tbody").append(str);
	}
	else if(cmd=="admin_admin_2"){
		var count=prompt("请输入个数","");
		if(count){
			var index=$("#admin_admin tbody tr").length;
			for(var i=0;i<count;i++){
				var str="<tr>";
				str+="<td><input type='checkbox'></td>";
				str+="<td class='admin_id' style='display:none'></td>";
				str+="<td class='admin_name'>" + input("") + "</td>";
				str+="<td class='admin_pwd' onKeyDown='keydown(\"add_admin_admin\",\"index="+(index+i)+"\")'>" + input("") + "</td>";
				str+="</tr>";
				$("#admin_admin tbody").append(str);
			}
		}
	}
	else if(cmd=="admin_admin_edit"){
		var trs="#admin_admin tbody tr";
		for(var i=0;i<$(trs).length;i++){
			if (check($(trs+":eq("+i+") :checkbox"))=="1"){
				var admin_name=$(trs+":eq("+i+") .admin_name").html();
				var admin_pwd=$(trs+":eq("+i+") .admin_pwd").html();
				
				if(admin_name.indexOf("input")<=0){
					$(trs+":eq("+i+") .admin_name").html(input(admin_name));
				}
				if(admin_pwd.indexOf("input")<=0){
					$(trs+":eq("+i+") .admin_pwd").html(input(admin_pwd));
				}
			}
		}
	}
	else if(cmd=="admin_group"){
		var index=$("#admin_group tbody tr").length;
		
		var str="<tr>";
		str+="<td><input type='checkbox'></td>";
		str+="<td class='group_id' style='display:none'></td>";
		str+="<td class='group_name'>" + input("") + "</td>";
		str+="<td class='group_bz'>" + input("") + "</td>";
		str+="<td class='group_pwd'>" + input("") + "</td>";
		str+="<td class='admin_name' onKeyDown='keydown(\"add_admin_group\",\"index="+index+"\")'>" + input("") + "</td>";
		str+="</tr>";

		$("#admin_group tbody").append(str);
	}
	else if(cmd=="admin_group_edit"){
		var trs="#admin_group tbody tr";
		for(var i=0;i<$(trs).length;i++){
			if (check($(trs+":eq("+i+") :checkbox"))=="1"){
				var group_name=$(trs+":eq("+i+") .group_name").html();
				var group_bz=$(trs+":eq("+i+") .group_bz").html();
				var group_pwd=$(trs+":eq("+i+") .group_pwd").html();
				var admin_name=$(trs+":eq("+i+") .admin_name").html();
				
				if(group_name.indexOf("input")<=0){
					$(trs+":eq("+i+") .group_name").html(input(group_name));
				}
				if(group_bz.indexOf("input")<=0){
					$(trs+":eq("+i+") .group_bz").html(input(group_bz));
				}
				if(group_pwd.indexOf("input")<=0){
					$(trs+":eq("+i+") .group_pwd").html(input(group_pwd));
				}
				if(admin_name.indexOf("input")<=0){
					$(trs+":eq("+i+") .admin_name").html(input(admin_name));
				}
			}
		}
	}
	
}

function save(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	if(cmd=="contact"){
		if(confirm("是否确认")){
			var i=cmdarr["index"];
			var contact_id=$("tbody tr:eq("+i+") [name='contact_id']").val();
			var contact_bz=$("tbody tr:eq("+i+") [name='contact_bz']").val();
			var record=$("tbody tr:eq("+i+") [name='record']").html();
			var admin_id=$("#admin_id").html();
			var id=$("tbody tr:eq("+i+") .id").html();
			
			if(admin_id==""){
				alert("用户id不能为空");
				return;
			}
			if(record==""){
				alert("请先上传录音");
				return;
			}
			if(contact_id==""){
				alert("请先选择接触情况");
				return;
			}
			main("add_contact","id="+id+"&admin_id="+admin_id+"&contact_id="+contact_id+"&contact_bz="+contact_bz+"&record="+record);
		}
	}
	else if(cmd=="audit"){
		if(confirm("是否确认")){
			var i=cmdarr["index"];
			var audit_id=$("tbody tr:eq("+i+") [name='audit_id']").val();
			var audit_bz=$("tbody tr:eq("+i+") [name='audit_bz']").val();
			var admin_id=$("#admin_id").html();
			var id=$("tbody tr:eq("+i+") .id").html();
			
			if(admin_id==""){
				alert("用户id不能为空");
				return;
			}
			if(audit_id==""){
				alert("请先选择审核结果");
				return;
			}
			main("add_audit","id="+id+"&admin_id="+admin_id+"&audit_id="+audit_id+"&audit_bz="+audit_bz);
		}
	}
	else if(cmd=="proj"){
		if(confirm("是否确认")){
			var proj_id=$("[name='proj_id']").val();
			var proj_name=$("[name='proj_name']").val();
			var proj_bz=$("[name='proj_bz']").val();
			var status_id=$("[name='status_id']").val();
			var group_id=$("[name='group_id']").val();
			var ip=$("[name='ip']").val();
			var port=$("[name='port']").val();
			var name=$("[name='name']").val();
			var pwd=$("[name='pwd']").val();
			
			var trs="#showlist tbody tr";
			var proj_list="";
			for(var i=0;i<$(trs).length;i++){
				var isshow=check($(trs+":eq("+i+") td:eq(1) :checkbox"));
				var titlename=$(trs+":eq("+i+") td:eq(0)").html();
				var fieldname=$(trs+":eq("+i+") td:eq(1) :checkbox").attr("name");
				if(proj_list==""){
					proj_list+=isshow+"/"+titlename+"/"+fieldname;
				}
				else{
					proj_list+="|"+isshow+"/"+titlename+"/"+fieldname;
				}
			}
			main("add_proj","proj_id="+proj_id+"&proj_name="+proj_name+"&proj_bz="+proj_bz+"&status_id="+status_id+"&group_id="+group_id+"&ip="+ip+"&port="+port+"&name="+name+"&pwd="+pwd+"&proj_list="+proj_list);

		}
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
		else if(cmd=="admin_staff"){
			var trs="#admin_staff tbody tr";
			for(var i=0;i<$(trs).length;i++){
				if (check($(trs+":eq("+i+") :checkbox"))=="1"){
					var admin_id=$(trs+":eq("+i+") .admin_id").html();
					if(admin_id!=""){
						main("del_admin_staff","admin_id="+admin_id,"false",i);
					}
					else{
						$("#admin_staff tbody tr:eq("+i+")").addClass("hidden");
					}
				}
			}
		}
		else if(cmd=="admin_admin"){
			var trs="#admin_admin tbody tr";
			for(var i=0;i<$(trs).length;i++){
				if (check($(trs+":eq("+i+") :checkbox"))=="1"){
					var admin_id=$(trs+":eq("+i+") .admin_id").html();
					if(admin_id!=""){
						main("del_admin_admin","admin_id="+admin_id,"false",i);
					}
					else{
						$("#admin_admin tbody tr:eq("+i+")").addClass("hidden");
					}
				}
			}
		}
		else if(cmd=="admin_group"){
			var trs="#admin_group tbody tr";
			for(var i=0;i<$(trs).length;i++){
				if (check($(trs+":eq("+i+") :checkbox"))=="1"){
					var group_id=$(trs+":eq("+i+") .group_id").html();
					if(group_id!=""){
						main("del_admin_group","group_id="+group_id,"false",i);
					}
					else{
						$("#admin_group tbody tr:eq("+i+")").addClass("hidden");
					}
				}
			}
		}
	}
}

function cancel(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	$("form").hide();
	if(cmd=="wxgl"){
		$("#wxgl").show();	
		query('action');
	}
	
}

function pageinit(page){
	
	if(page=="login"){
		var admin_name=getCookie("admin_name");
		var admin_remenber=getCookie("admin_remenber");
		if(admin_name){
			$("#admin_name").val(admin_name);
		}

		if(admin_remenber){
			if(admin_remenber=="1"){
				$("#admin_remenber").prop("checked","checked");
			}
		}

	}
	else {
		main("queryadmininfo","","false",page);
	}

}

function table_refresh(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	if (cmd=="dd"){
		main("queryddglmx","dd_id="+$("#dd_id").val(),"false","1");	
	}
}

function query(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	if(cmd=="user_record"){
		main("query_user_record","custid="+$("[name='select_custid']").val()+"&get_type_id="+$("[name='select_get_type_id']").val()+"&user_name="+$("[name='select_user_name']").val()+"&brhid="+$("[name='select_brhid']").val()+"&begin_date="+$("[name='select_begin_date']").val()+"&end_date="+$("[name='select_end_date']").val());
	}
	else if(cmd=="proj_user_2"){
		main("query_proj_user_2","proj_id="+$("#proj_id_3").val()+"&user_phone="+$("#user_phone").val());
	}
}

function change(){
	
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	if (cmd=="contact"){
		var i=cmdarr["index"];
		var contact_id=$("tbody tr:eq("+i+") [name='contact_id']").val();
		if(contact_id=="5"){
			$("tbody tr:eq("+i+") [name='contact_bz']").removeClass('hidden');
		}
		else{
			$("tbody tr:eq("+i+") [name='contact_bz']").addClass('hidden');
		}
	}
	else if(cmd=="audit"){
		var i=cmdarr["index"];
		var audit_id=$("tbody tr:eq("+i+") [name='audit_id']").val();
		if(audit_id=="3"){
			$("tbody tr:eq("+i+") [name='audit_bz']").removeClass('hidden');
		}
		else{
			$("tbody tr:eq("+i+") [name='audit_bz']").addClass('hidden');
		}
	}
	else if(cmd=="status"){
		var index=cmdarr["index"];
		var trs="#proj tbody tr";
		for(var i=0;i<$(trs).length;i++ ){
			var status_id=$(trs+":eq("+i+") .status_id").html();
			if(status_id!=index){
				$(trs+":eq("+i+")").hide();
			}
			else{
				$(trs+":eq("+i+")").show();
			}
		}
	}
}

function choose(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	if (cmd=="price"){
		if($("#price :checkbox").is(":checked")){
			$("#price :checkbox").prop("checked",false);
		}
		else{
			$("#price :checkbox").prop("checked","checked");
		}
	}
}

function keydown(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	if(event.keyCode == 13){
		
		if(cmd=="add_staff"){
			var index=cmdarr["index"];
			var admin_id=$("#admin_staff tbody tr:eq("+index+") .admin_id").html();
			var admin_name=$("#admin_staff tbody tr:eq("+index+") .admin_name input").val();
			var admin_pwd=$("#admin_staff tbody tr:eq("+index+") .admin_pwd input").val();
			var group_name=$("#admin_staff tbody tr:eq("+index+") .group_name input").val();
			
			var trs="#admin_group tbody tr:visible";
			var group_id="";
			for(var i=0;i<$(trs).length;i++){
				var group_name_2=$(trs+":eq("+i+") .group_name").html();
				if(group_name==group_name_2){
					group_id=$(trs+":eq("+i+") .group_id").html();
				}
			}
			if((group_name!="") && (group_id=="")){
				alert("该员工组不存在");
				return;
				
			}
			if(confirm("是否确认保存")){
				main("add_admin_staff","admin_id="+admin_id+"&admin_name="+admin_name+"&admin_pwd="+admin_pwd+"&group_id="+group_id+"&admin_type_id=2","false",index);
			}
		}
		else if(cmd=="add_admin_admin"){
			var index=cmdarr["index"];
			var admin_id=$("#admin_admin tbody tr:eq("+index+") .admin_id").html();
			var admin_name=$("#admin_admin tbody tr:eq("+index+") .admin_name input").val();
			var admin_pwd=$("#admin_admin tbody tr:eq("+index+") .admin_pwd input").val();
			

			if(confirm("是否确认保存")){
				main("add_admin_admin","admin_id="+admin_id+"&admin_name="+admin_name+"&admin_pwd="+admin_pwd+"&admin_type_id=1","false",index);
			}
		}
		else if(cmd=="add_admin_group"){
			var index=cmdarr["index"];
			var group_id=$("#admin_group tbody tr:eq("+index+") .group_id").html();
			var group_name=$("#admin_group tbody tr:eq("+index+") .group_name input").val();
			var group_bz=$("#admin_group tbody tr:eq("+index+") .group_bz input").val();
			var group_pwd=$("#admin_group tbody tr:eq("+index+") .group_pwd input").val();
			var admin_name=$("#admin_group tbody tr:eq("+index+") .admin_name input").val();
			
			var trs="#admin_staff tbody tr:visible";
			var admin_id="";
			for(var i=0;i<$(trs).length;i++){
				var admin_name_2=$(trs+":eq("+i+") .admin_name").html();
				var group_name_2=$(trs+":eq("+i+") .group_name").html();
				if((group_name==group_name_2) &&(admin_name==admin_name_2)){
					admin_id=$(trs+":eq("+i+") .admin_id").html();
				}
			}
			if((admin_name!="") && (admin_id=="")){
				alert("该员工不属于本组");
				return;
				
			}
			if(confirm("是否确认保存")){
				main("add_admin_group","group_id="+group_id+"&group_name="+group_name+"&group_bz="+group_bz+"&group_pwd="+group_pwd+"&admin_id="+admin_id,"false",index);
			}
		}
	}
	
}




function logininit(){
	var admin_name=getCookie("admin_name");
	var admin_remenber=getCookie("admin_remenber");
	if(admin_name){
		$("#admin_name").val(admin_name);
	}

	if(admin_remenber){
		if(admin_remenber=="1"){
			$("#admin_remenber").prop("checked","checked");
		}
	}

	
}

function login() {
	main("adminlogin","admin_name="+$("#admin_name").val()+"&admin_pwd="+base64_encode($("#admin_pwd").val())+"&admin_remenber="+check("#admin_remenber"));
}

function loginout(){
	if(confirm("是否确认退出")){
		main("adminloginout","admin_id="+$("#admin_id").html());
    }
}


function upload_str(id,name){
	var str="";
	str='<div class="caption"><div class="col-sm-1"><span class="btn btn-xs btn-primary fileinput-button"><span>'+name+'</span><input id="'+id+'_upload" name="'+id+'_upload" type="file" multiple></span></div><div class="fileupload-progress col-sm-8 col-sm-offset-1" id="'+id+'_progress" style="display:none"><div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"> <div class="progress-bar progress-bar-success" style="width:0%;"></div></div></div><div id="files" class="files"></div></div>';
	return str;
}

function binduploadauto(id,formData){
	$("#"+id+"_upload").fileupload({
		url: posturl,
		formData:formData,
		processstart: function (e, data) {
			$("#"+id+"_progress").show();
		},
		progress: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$("#"+id+"_progress .progress-bar").css(
				'width',
				progress + '%'
			);
		},
		always:function (e, data) {
			$("#"+id+"_progress").hide();
			var result=data.result;
			if (result) {
				var jsonobj=json_decode(result);
				var retcode=jsonobj.errcode;
				var retmsg=decodeURIComponent(jsonobj.errmsg);
				if(retcode=="0"){	
					var url=jsonobj.url;
					var i=formData.index;
					
					$("tbody tr:eq("+i+") [name='record']").html(url);
					
					/*if(id=="cardenglishcontext"){
						$("#"+id).attr("href",url);
					}
					else{
						$("#"+id).attr("src",url);
					}*/
				}
				else{
					alert(retmsg);
				}
		   }
		   else {
			   alert("操作失败");
		   }
		}
		
	})
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
    $("#admin_remenber").prop("checked","");
    $("#admin_autologin").prop("checked","");
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
	if ($(id).prop("checked")==true){
		return "1";
	}
	else{
		return "0";
	}
}

function checkin(check){
	if(check=="1"){
		$("#checkin").removeClass("btn-success").addClass("btn-default");
		$("#checkout").removeClass("btn-default").addClass("btn-success");
	}
	else{
		$("#checkout").removeClass("btn-success").addClass("btn-default");
		$("#checkin").removeClass("btn-default").addClass("btn-success");
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
	str="<input  class=\"form-control-10\" value='" + data + "'/>";
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
