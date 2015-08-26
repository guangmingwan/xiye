var posturl="http://120.27.97.213:8080/yixuan/index.php";
var downloadurl="http://120.27.97.213:8080/yixuan/download.php";
var xiangxiurl="xiangxi.html?url=";

var zhengsheng_pic="http://120.27.97.213:8080/front/images/zhengsheng.png";
var kcburl="http://120.27.97.213:8080/front/images/kcb.jpg";
var videourl="video.html";
var lxwm_url="http://120.27.97.213:8080/yixuan/uploadfile/zcfw/%E8%81%94%E7%B3%BB%E6%88%91%E4%BB%AC%E6%96%B0.jpg";

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
					if (cmd=="querykc"){
						if(extend=="1"){
							$("#kc_list").empty();
							var str="";
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
								if(i%2==1){							
									str+="<a href=\"gerenzhongxinkejian.html?kc_id="+jsonobj.data[i].kc_id+"\" class=\"w123\">"+jsonobj.data[i].kc_name+"</a><br>";
								}
								else{
									str+="<a href=\"gerenzhongxinkejian.html?kc_id="+jsonobj.data[i].kc_id+"\" class=\"w123\">"+jsonobj.data[i].kc_name+"</a>";
								}
							}				
							$("#kc_list").append(str);
							
							
							
						}
						else{
							$("#menu-item-11 ul").empty();
							$(".pic_news_title a").remove();						
							var str="";	
							var str2="";
							var yxzpmenu="";
							for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}							
								str+="<li  class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children\"><a target=\"_blank\" href=\"youxiuzuopin.html?yxzp_type_id="+jsonobj.data[i].kc_id+"\" class=\"sf-with-ul\">"+jsonobj.data[i].kc_name+"</a>";
								str2+="<a target=\"_blank\" href=\"youxiuzuopin.html?yxzp_type_id="+jsonobj.data[i].kc_id+"\">"+jsonobj.data[i].kc_name+"</a>";
								if(yxzpmenu!=""){
									yxzpmenu+="|"+jsonobj.data[i].kc_id+"/"+jsonobj.data[i].kc_name;
								}
								else{
									yxzpmenu+=jsonobj.data[i].kc_id+"/"+jsonobj.data[i].kc_name;
								}
							}				
							$("#menu-item-11 ul").append(str);
							$(".pic_news_title").append(str2);
							
							setCookie_time("yxzpmenu",yxzpmenu,"h2");
						}
               	
					}
					else if (cmd=="querykcmx"){
						if(extend=="1"){
							$("[name='kj_id']").empty();
							var str="";
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}						
								str+="<option value=\""+jsonobj.data[i].kj_id+"\">"+jsonobj.data[i].kj_name+"</option>";
							}
							$("[name='kj_id']").append(str);	
						}
						else{
							$(".kssz").empty();
							var str="";
							var kc_jj="";
							var kc_id=getQueryStringByName("kc_id");
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}						
								//str+="<a href='"+videourl+"?url="+base64_encode(encodeURIComponent(jsonobj.data[i].kj))+"' target=\"_blank\">"+jsonobj.data[i].kj_name+"</a>";
								str+="<a target=\"_blank\" onclick=\"kj_qx("+jsonobj.data[i].kj_id+","+kc_id+",'"+base64_encode(encodeURIComponent(jsonobj.data[i].kj))+"')\">"+jsonobj.data[i].kj_name+"</a>";
								kc_jj=jsonobj.data[i].kc_js;
							}				
							$(".kssz").append(str);	
							$("#kejianjianjie").html(kc_jj);
						}
               	
					}
					else if(cmd=="querykcb"){
						$(".zy_left").empty();
						var str="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
							for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
							}
							str+="<img src=\""+jsonobj.data[i].zk+"\" width=\"682\" class=\"mar\">";
							
						}
						$(".zy_left").append(str);
					}
					else if(cmd=="queryjs"){
						$(".zy_left").empty();
						var str="";	
						
						var ncount=5;
						for (var i = 0; i < jsonobj.data.length; i++) {
               				for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							if(i<ncount){
								str+="<div class=\"r4\">";
							}
							else{
								str+="<div class=\"r4\" style=\"display:none\">";
							}
							str+="<input name='admin_id' style='display:none' value='"+jsonobj.data[i].admin_id+"'>";	
							str+="<div class=\"r2 fl\">";
							str+="<a href=\""+jsonobj.data[i].admin_pic+"\"  target=\"_blank\"><img src=\""+jsonobj.data[i].admin_pic+"\" width=\"198\" height=\"176\"></a>";
							str+="</div>";
							str+="<div class=\"a4 fr\">";
							str+="<p>"+jsonobj.data[i].admin_grjs+"</p>";
							str+="</div>";
							str+="<div class=\"clear\"></div>";
							str+="<form class=\"fbd\">";
							if(jsonobj.data[i].ifgz=="1"){
								str+="关注<input name=\"ifgz\" type=\"checkbox\" onclick=\"choose('ifgz','"+i+"')\" checked=\"checked\">";
							}
							else{
								str+="关注<input name=\"ifgz\" type=\"checkbox\" onclick=\"choose('ifgz','"+i+"')\">";
							}
							
							if(jsonobj.data[i].pj_type=="1"){
								str+="喜欢<input name=\"pj_type\" type=\"radio\" value=\"2\" checked> 一般<input name=\"pj_type\" type=\"radio\" value=\"3\"> 不满意<input name=\"pj_type\" type=\"radio\" value=\"4\">";
							}
							else if(jsonobj.data[i].pj_type=="2"){
								str+="喜欢<input name=\"pj_type\" type=\"radio\" value=\"2\" > 一般<input name=\"pj_type\" type=\"radio\" value=\"3\" checked> 不满意<input name=\"pj_type\" type=\"radio\" value=\"4\">";
							}
							else if(jsonobj.data[i].pj_type=="3"){
								str+="喜欢<input name=\"pj_type\" type=\"radio\" value=\"2\" > 一般<input name=\"pj_type\" type=\"radio\" value=\"3\"> 不满意<input name=\"pj_type\" type=\"radio\" value=\"4\" checked>";
							}
							else{
								str+="喜欢<input name=\"pj_type\" type=\"radio\" value=\"2\" > 一般<input name=\"pj_type\" type=\"radio\" value=\"3\"> 不满意<input name=\"pj_type\" type=\"radio\" value=\"4\">";
							}
							str+="</form>";
							str+="</div>";

						}
						
						str+="<div class=\"fenye\">";
						var j=1;
						
						j=Math.ceil(i/ncount);
						str+="<a id=\"page_before\" onclick=\"getindex('.zy_left .r1','before',"+ncount+","+j+","+i+")\">《上一页</a>";
						for (var k = 1; k <= j; k++) {
							if(k<=6){
								str+="<a id=\"page_"+k+"\" onclick=\"getindex('.zy_left .r1',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
							}
							else{
								str+="<a  style=\"display:none\" id=\"page_"+k+"\" onclick=\"getindex('.zy_left .r1',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
							}
						}
						str+="<a id=\"page_next\"  onclick=\"getindex('.zy_left .r1','next',"+ncount+","+j+","+i+")\" >下一页》</a>";
						str+="<a onclick=\"save('pj')\">提交</a>";
						str+="<div>";
							
						$(".zy_left").append(str);

					}
					else if(cmd=="studentkj_qx"){
						//window.open(videourl+"?url="+extend, "_blank");
						var today_count=getCookie("today_count")?parseInt(getCookie("today_count")):0;
						if(today_count<1){
							today_count=parseInt(today_count)+1;
							setCookie_time("today_count",today_count,"h48");
							setCookie_time("today_count2",2,"h48");
							window.location.href=videourl+"?url="+extend;
						}
						else{
							var today_count2=getCookie("today_count2")?parseInt(getCookie("today_count2")):2;
							if(today_count2>0){
								today_count2=parseInt(today_count2)-1;
								setCookie_time("today_count2",today_count2,"h48");
								window.location.href=videourl+"?url="+extend;
							}
							else{
								alert("课件48小时之内只能看三次");
							}
						}
						
					}
					else if(cmd=="queryzsjj"){
						var gsjjurl="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}							
							gsjjurl=jsonobj.data[i].zsjj;
						}		
						$("#gsjj").attr("href",xiangxiurl+base64_encode(encodeURIComponent(gsjjurl))+'&log_type_id=8');		
						
						setCookie_time("gsjjurl",gsjjurl,"h2");
					}
					else if(cmd=="querygy"){
						var gyzsurl="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}							
							gyzsurl=jsonobj.data[i].gy;
						}		
						$("#gyzs").attr("href",xiangxiurl+base64_encode(encodeURIComponent(gyzsurl))+'&log_type_id=19');		
						
						setCookie_time("gyzsurl",gyzsurl,"h2");
					}
					else if(cmd=="querykktz"){
						var kktzurl="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}							
							kktzurl=jsonobj.data[i].kktz;
						}		
						$("#kktz").attr("href",xiangxiurl+base64_encode(encodeURIComponent(kktzurl))+'&log_type_id=20');		
						
						setCookie_time("kktzurl",kktzurl,"h2");
					}
					else if(cmd=="queryzcfw"){
						var zcfwurl="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}							
							zcfwurl=jsonobj.data[i].zcfw;
						}		
						$("#zcfw").attr("href",xiangxiurl+base64_encode(encodeURIComponent(zcfwurl))+'&log_type_id=21');		
						
						setCookie_time("zcfwurl",zcfwurl,"h2");
					}
					else if(cmd=="querybmlc"){
						var kcxxurl="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}							
							kcxxurl=jsonobj.data[i].bmlc;
						}	
						$("#kcxx").attr("href",xiangxiurl+base64_encode(encodeURIComponent(kcxxurl))+'&log_type_id=5');		
						
						setCookie_time("kcxxurl",kcxxurl,"h2");
					}
					else if(cmd=="queryyxzp"){
						if(extend=="1"){
							$(".box").empty();
							var str="";
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
								if(i>=jsonobj.data.length-5 && i<jsonobj.data.length){						
									str+="<div class=\"aabb\">";
									str+="<div class=\"hua1\">";
									str+="<li>";
									str+="<a target=\"_blank\"  href=\"youxiuzuopin.html?yxzp_type_id="+jsonobj.data[i].yxzp_type+"\" title=\""+getyxzptype(jsonobj.data[i].yxzp_type)+"\" style=\"top: 0px; \">";
									str+="<div class=\"toll_img\"><img  target=\"_blank\" src=\""+jsonobj.data[i].yxzp+"\" width=\"188px\" height=\"157px\"></div>";
									str+="<div class=\"toll_info\"><p>"+getyxzptype(jsonobj.data[i].yxzp_type)+"</p></div>";
									str+="</a></li></div></div>";
								}

							}				
							$(".box").append(str);	
							$('.box a').mouseover(function(){
								$(this).stop().animate({"top":"-178px"}, 200); 
							})
							$('.box a').mouseout(function(){
								$(this).stop().animate({"top":"0"}, 200); 
							})
							main("querysybzbh","sybzbh_type_max=1","false","1");
						}
						else{
							$(".zy_left").empty();
							var str="";	
							var ncount=16;
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
								if(i<ncount){
									str+="<a  target=\"_blank\" href=\""+jsonobj.data[i].yxzp+"\"><img src=\""+jsonobj.data[i].yxzp+"\" width=\"165\" height=\"138\">";
								}
								else{
									str+="<a  target=\"_blank\" href=\""+jsonobj.data[i].yxzp+"\" style=\"display:none\"><img src=\""+jsonobj.data[i].yxzp+"\" width=\"165\" height=\"138\">";
								}
							}
							
							str+="<div class=\"fenye\">";
							var j=1;
							j=Math.ceil(i/ncount);
							str+="<a id=\"page_before\" onclick=\"getindex('.zy_left a','before',"+ncount+","+j+","+i+")\">《上一页</a>";
							for (var k = 1; k <= j; k++) {
								str+="<a id=\"page_"+k+"\" onclick=\"getindex('.zy_left a',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
							}
							str+="<a id=\"page_next\"  onclick=\"getindex('.zy_left a','next',"+ncount+","+j+","+i+")\" >下一页》</a>";
							str+="<div>";
								
							$(".zy_left").append(str);
							
							$(".fenye a").hide();
							$(".fenye a[id]").show();
						}

					}
					else if(cmd=="querysybzbh"){
						if(extend=="1"){
							//$(".box").empty();
							var str="";
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
								if(i>=jsonobj.data.length-5 && i<jsonobj.data.length){						
									str+="<div class=\"aabb\">";
									str+="<div class=\"hua1\">";
									str+="<li>";
									str+="<a target=\"_blank\"  href=\"bianzoubianhua.html?sybzbh_type_id="+jsonobj.data[i].sybzbh_type+"\" title=\""+getvalue(jsonobj.data[i].sybzbh_type,"1|2|3|4|5","博物馆写生|户外写生|艺术家互动|每日一画|边走边画")+"\" style=\"top: 0px; \">";
									str+="<div class=\"toll_img\"><img  target=\"_blank\" src=\""+jsonobj.data[i].sybzbh+"\" width=\"188px\" height=\"157px\"></div>";
									str+="<div class=\"toll_info\"><p>"+getvalue(jsonobj.data[i].sybzbh_type,"1|2|3|4|5","博物馆写生|户外写生|艺术家互动|每日一画|边走边画")+"</p></div>";
									str+="</a></li></div></div>";
								}

							}				
							$(".box").append(str);	
							$('.box a').mouseover(function(){
								$(this).stop().animate({"top":"-178px"}, 200); 
							})
							$('.box a').mouseout(function(){
								$(this).stop().animate({"top":"0"}, 200); 
							})
						}
						else{
							$(".zy_left").empty();
							var str="";	
							var ncount=16;
							for (var i = 0; i < jsonobj.data.length; i++) {
								for(var e in jsonobj.data[i]){
									jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
								}
								if(i<ncount){
									str+="<a target=\"_blank\" href=\""+jsonobj.data[i].sybzbh+"\"><img src=\""+jsonobj.data[i].sybzbh+"\" width=\"165\" height=\"138\">";
								}
								else{
									str+="<a target=\"_blank\" href=\""+jsonobj.data[i].sybzbh+"\" style=\"display:none\"><img  src=\""+jsonobj.data[i].sybzbh+"\" width=\"165\" height=\"138\">";
								}
							}
							
							str+="<div class=\"fenye\">";
							var j=1;
							
							j=Math.ceil(i/ncount);
							str+="<a id=\"page_before\" onclick=\"getindex('.zy_left a','before',"+ncount+","+j+","+i+")\">《上一页</a>";
							for (var k = 1; k <= j; k++) {
								str+="<a id=\"page_"+k+"\" onclick=\"getindex('.zy_left a',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
							}
							str+="<a id=\"page_next\"  onclick=\"getindex('.zy_left a','next',"+ncount+","+j+","+i+")\" >下一页》</a>";
							str+="<div>";
								
							$(".zy_left").append(str);
							
							$(".fenye a").hide();
							$(".fenye a[id]").show();
						}

					}
					else if(cmd=="queryzp"){
						$(".zy_left").empty();
						var str="";	

						str+="<div class=\"r3\"><div style=\"font-size:15px\">";
						str+="<p>起始日期：<input name=\"begindate\" type=\"text\"  class=\"Wdate\"> 结束日期：<input name=\"enddate\" type=\"text\"  class=\"Wdate\"> <input onClick=\"query('zuoyedianping')\" name=\"\" type=\"image\" src=\"images/cx.jpg\" style=\"float:right;margin-right:150px;margin-top:-2px;\"></p><br></div></div>";
						
						var ncount=5;
						for (var i = 0; i < jsonobj.data.length; i++) {
               				for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							if(i<ncount){
								str+="<div class=\"r1\">";
							}
							else{
								str+="<div class=\"r1\" style=\"display:none\">";
							}
								
							str+="<div class=\"r2 fl\">";
							str+="<a href=\""+jsonobj.data[i].zp+"\"  target=\"_blank\"><img src=\""+jsonobj.data[i].zp+"\" width=\"198\" height=\"176\"></a>";
							str+="<p>课程："+jsonobj.data[i].kc_name+"</p>";
							str+="<p>课件："+jsonobj.data[i].kj_name+"</p>";
							str+="</div>";
							str+="<div class=\"a3 fr\">";
							str+="<textarea  style=\"width:458px;height:175px;\">"+jsonobj.data[i].zpdp+"</textarea>";
        					str+="<p>点评老师：<a href=\"laoshixinxi.html\">"+jsonobj.data[i].admin_name+"<a></p>";
							str+="</div>";
							str+="</div>";

						}
						
						str+="<div class=\"fenye\">";
						var j=1;
						
						j=Math.ceil(i/ncount);
						str+="<a id=\"page_before\" onclick=\"getindex('.zy_left .r1','before',"+ncount+","+j+","+i+")\">《上一页</a>";
						for (var k = 1; k <= j; k++) {
							if(k<=6){
								str+="<a id=\"page_"+k+"\" onclick=\"getindex('.zy_left .r1',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
							}
							else{
								str+="<a  style=\"display:none\" id=\"page_"+k+"\" onclick=\"getindex('.zy_left .r1',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
							}
						}
						str+="<a id=\"page_next\"  onclick=\"getindex('.zy_left .r1','next',"+ncount+","+j+","+i+")\" >下一页》</a>";
						str+="<div>";
							
						$(".zy_left").append(str);
						
						$(".Wdate").click(function(){
							WdatePicker();
						});
						$(".Wdate").attr("readonly","readonly");
						
						//$(".fenye a").hide();
						//$(".fenye a[id]").show();
					}
					else if(cmd=="querybzbh"){
						$(".zy_left").empty();
						var str="";	
						
						str+="<div class=\"r1\"><div style=\"font-size:15px\">";
						str+="<p>起始日期：<input name=\"begindate\" type=\"text\"  class=\"Wdate\"> 结束日期：<input name=\"enddate\" type=\"text\"  class=\"Wdate\"> <input onClick=\"query('zuoyedianping')\" name=\"\" type=\"image\" src=\"images/cx.jpg\" style=\"float:right;margin-right:150px;margin-top:-2px;\"></p><br></div></div>";
						
						var ncount=16;
						for (var i = 0; i < jsonobj.data.length; i++) {
               				for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							if(i<ncount){
								str+="<a href=\""+jsonobj.data[i].bzbh+"\"   target=\"_blank\"><img src=\""+jsonobj.data[i].bzbh+"\" width=\"165\" height=\"138\">";
							}
							else{
								str+="<a href=\""+jsonobj.data[i].bzbh+"\"   target=\"_blank\" style=\"display:none\"><img src=\""+jsonobj.data[i].bzbh+"\" width=\"165\" height=\"138\">";
							}
						}
						
						str+="<div class=\"fenye\">";
						var j=1;
						
						j=Math.ceil(i/ncount);
						str+="<a id=\"page_before\" onclick=\"getindex('.zy_left a','before',"+ncount+","+j+","+i+")\">《上一页</a>";
						for (var k = 1; k <= j; k++) {
							str+="<a id=\"page_"+k+"\" onclick=\"getindex('.zy_left a',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
						}
						str+="<a id=\"page_next\"  onclick=\"getindex('.zy_left a','next',"+ncount+","+j+","+i+")\" >下一页》</a>";
						str+="<div>";
							
						$(".zy_left").append(str);
						
						$(".Wdate").click(function(){
							WdatePicker();
						});
						$(".Wdate").attr("readonly","readonly");
						
						$(".fenye a").hide();
						$(".fenye a[id]").show();

					}
					else if(cmd=="queryxygl"){
						if(extend=="1"){
							$("#show_student_name").html(decodeURIComponent(jsonobj.data[0].student_name));
							$("#student_birthday").html(decodeURIComponent(jsonobj.data[0].student_birthday));
							$("#rx_time").html(decodeURIComponent(jsonobj.data[0].rx_time));
							$("#student_sex").html(decodeURIComponent(jsonobj.data[0].student_sex));
							$("#student_address").html(decodeURIComponent(jsonobj.data[0].student_address));
							$("#zpcount").html(decodeURIComponent(jsonobj.data[0].zpcount));
							$("#yskc").html(decodeURIComponent(jsonobj.data[0].yskc));
							$("#sykc").html(decodeURIComponent(jsonobj.data[0].sykc));
							$("#dqkc").html(decodeURIComponent(jsonobj.data[0].dqkc));
							$("#student_pic").attr("src",decodeURIComponent(jsonobj.data[0].student_pic));
						}
						else{
							$("[name='username']").val(decodeURIComponent(jsonobj.data[0].username));
							$("[name='student_name']").val(decodeURIComponent(jsonobj.data[0].student_name));
							$("[name='student_sex']").val(decodeURIComponent(jsonobj.data[0].student_sex));
							$("[name='student_birthday']").val(decodeURIComponent(jsonobj.data[0].student_birthday));
							$("[name='student_address']").val(decodeURIComponent(jsonobj.data[0].student_address));
							$("[name='student_parent']").val(decodeURIComponent(jsonobj.data[0].student_parent));
							$("[name='student_phone']").val(decodeURIComponent(jsonobj.data[0].student_phone));
							$("[name='student_email']").val(decodeURIComponent(jsonobj.data[0].student_email));
							$("[name='student_weibo']").val(decodeURIComponent(jsonobj.data[0].student_weibo));
							$("[name='student_qq']").val(decodeURIComponent(jsonobj.data[0].student_qq));
							$("[name='student_nickname']").val(decodeURIComponent(jsonobj.data[0].student_nickname));
							$("[name='student_xgjg']").val(decodeURIComponent(jsonobj.data[0].student_xgjg));
							$("[name='student_xgpxb']").val(decodeURIComponent(jsonobj.data[0].student_xgpxb));
							$("[name='student_xqah']").val(decodeURIComponent(jsonobj.data[0].student_xqah));
							$("[name='student_jrxgzy']").val(decodeURIComponent(jsonobj.data[0].student_jrxgzy));
							$("[name='student_cz']").val(decodeURIComponent(jsonobj.data[0].student_cz));
							$("[name='student_qd']").val(decodeURIComponent(jsonobj.data[0].student_qd));
						}
					}
					else if(cmd=="querywtdy"){
						$("thead").empty();
						var str="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							str+="<tr>";
							str+="<td width=\"35\">问：</td>";
							str+="<td width=\"566\">"+jsonobj.data[i].wt_content+"</td>";
							str+="<td width=\"67\"><input type=\"image\" src=\"images/sc.jpg\" onclick=\"del('wtdy','wtdy_id="+jsonobj.data[i].wtdy_id+"')\"></td>";
							str+="</tr>";
							str+="<tr>";
							str+="<td>答：</td>";
							str+="<td>"+jsonobj.data[i].dy_content+"</td>";
							str+="</tr>";
						}
						
						$("thead").append(str);
					}
					else if(cmd=="addwt"){
						var username=getCookie("username"); 
						main("querywtdy","username="+username);
						$("[name='wt_content']").val("");
					}
					else if(cmd=="delwtdy"){
						var username=getCookie("username"); 
						main("querywtdy","username="+username);
					}
					else if(cmd=="queryyjfk"){
						$("thead").empty();
						var str="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							str+="<tr>";
							str+="<td width=\"80\">意见：</td>";
							str+="<td width=\"500\">"+jsonobj.data[i].yjfk_content+"</td>";
							str+="<td width=\"67\"><input type=\"image\" src=\"images/sc.jpg\" onclick=\"del('yjfk','yjfk_id="+jsonobj.data[i].yjfk_id+"')\"></td>";
							str+="</tr>";
						}
						
						$("thead").append(str);
					}
					else if(cmd=="yjfk"){
						var username=getCookie("username"); 
						main("queryyjfk","username="+username);
						$("[name='yjfk_content']").val("");
					}
					else if(cmd=="delyjfk"){
						var username=getCookie("username"); 
						main("queryyjfk","username="+username);
					}
					else if(cmd=="querybirthday"){
						$("[name='student_birthday']").empty();
						var str="";	
						str+="<option>"+"</option>";
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							str+="<option>"+jsonobj.data[i].student_birthday+"</option>";
						}
						
						$("[name='student_birthday']").append(str);
					}
					else if(cmd=="queryaddress"){
						$("[name='student_address']").empty();
						var str="";	
						str+="<option>"+"</option>";
						for (var i = 0; i < jsonobj.data.length; i++) {
               			for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							str+="<option>"+jsonobj.data[i].student_address+"</option>";
						}
						
						$("[name='student_address']").append(str);
					}
					else if(cmd=="querybjdp"){
						$("tfoot").empty();
						var str="";							
						
						var ncount=16;
						for (var i = 0; i < jsonobj.data.length; i++) {
               				for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							if(i<ncount){
								str+="<tr>";
								str+="<td>"+jsonobj.data[i].kc_name+"</td>";
								str+="<td>"+jsonobj.data[i].bj_name+"</td>";
								str+="<td>"+jsonobj.data[i].admin_name+"</td>";
								str+="<td>"+jsonobj.data[i].kj_name+"</td>";
								str+="<td><a href=\""+videourl+"?url="+base64_encode(encodeURIComponent(jsonobj.data[i].bjdp))+"\" target=\"_blank\"><img src=\"images/bf.png\" width=30px height=30px ></a></td>";
								str+="<td><a href=\""+posturl+"?cmd=download&url="+base64_encode(encodeURIComponent(jsonobj.data[i].bjdp))+"\" target=\"_blank\"><img src=\"images/xz.png\"  width=30px height=30px></a></td>";

								//str+="<td><a href=\"bianzoubianhua1.html?username="+base64_encode(jsonobj.data[i].username)+"\"><img src=\""+jsonobj.data[i].bzbh+"\" width=\"60\" height=\"45\"></a></td>";
								str+="</tr>";
							}
							else{
								str+="<tr style=\"display:none\">";
								str+="<td>"+jsonobj.data[i].username+"</td>";
								str+="<td>"+jsonobj.data[i].student_name+"</td>";
								str+="<td>"+jsonobj.data[i].student_birthday+"</td>";
								str+="<td>"+jsonobj.data[i].student_address+"</td>";
								str+="<td><a href=\"zuoyedianping.html?username="+base64_encode(jsonobj.data[i].username)+"\"><img src=\""+jsonobj.data[i].zp+"\" width=\"60\" height=\"45\"></a></td>";
								//str+="<td><a href=\"bianzoubianhua1.html?username="+base64_encode(jsonobj.data[i].username)+"\"><img src=\""+jsonobj.data[i].bzbh+"\" width=\"60\" height=\"45\"></a></td>";
								str+="</tr>";
							}
						}
						
						$("tfoot").append(str);
						
						$(".fenye").empty();
						
						var j=1;
						
						j=Math.ceil(i/ncount);
						str="<a id=\"page_before\" onclick=\"getindex('.zy_left tfoot tr','before',"+ncount+","+j+","+i+")\">《上一页</a>";
						for (var k = 1; k <= j; k++) {
							str+="<a id=\"page_"+k+"\" onclick=\"getindex('.zy_left tfoot tr',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
						}
						str+="<a id=\"page_next\"  onclick=\"getindex('.zy_left tfoot tr','next',"+ncount+","+j+","+i+")\" >下一页》</a>";
						
						$(".fenye").append(str);
							
						
												
						$(".fenye a").hide();
						$(".fenye a[id]").show();
					}
					else if(cmd=="queryhy"){
						$("tfoot").empty();
						var str="";							
						
						var ncount=16;
						for (var i = 0; i < jsonobj.data.length; i++) {
               				for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							if(i<ncount){
								str+="<tr>";
								str+="<td>"+jsonobj.data[i].username+"</td>";
								str+="<td>"+jsonobj.data[i].student_name+"</td>";
								str+="<td>"+jsonobj.data[i].student_birthday+"</td>";
								str+="<td>"+jsonobj.data[i].student_address+"</td>";
								str+="<td><a href=\"zuoyedianping.html?username="+base64_encode(jsonobj.data[i].username)+"\"><img src=\""+jsonobj.data[i].zp+"\" width=\"60\" height=\"45\"></a></td>";
								//str+="<td><a href=\"bianzoubianhua1.html?username="+base64_encode(jsonobj.data[i].username)+"\"><img src=\""+jsonobj.data[i].bzbh+"\" width=\"60\" height=\"45\"></a></td>";
								str+="</tr>";
							}
							else{
								str+="<tr style=\"display:none\">";
								str+="<td>"+jsonobj.data[i].username+"</td>";
								str+="<td>"+jsonobj.data[i].student_name+"</td>";
								str+="<td>"+jsonobj.data[i].student_birthday+"</td>";
								str+="<td>"+jsonobj.data[i].student_address+"</td>";
								str+="<td><a href=\"zuoyedianping.html?username="+base64_encode(jsonobj.data[i].username)+"\"><img src=\""+jsonobj.data[i].zp+"\" width=\"60\" height=\"45\"></a></td>";
								//str+="<td><a href=\"bianzoubianhua1.html?username="+base64_encode(jsonobj.data[i].username)+"\"><img src=\""+jsonobj.data[i].bzbh+"\" width=\"60\" height=\"45\"></a></td>";
								str+="</tr>";
							}
						}
						
						$("tfoot").append(str);
						
						$(".fenye").empty();
						
						var j=1;
						
						j=Math.ceil(i/ncount);
						str="<a id=\"page_before\" onclick=\"getindex('.zy_left tfoot tr','before',"+ncount+","+j+","+i+")\">《上一页</a>";
						for (var k = 1; k <= j; k++) {
							str+="<a id=\"page_"+k+"\" onclick=\"getindex('.zy_left tfoot tr',"+k+","+ncount+","+j+","+i+")\">"+k+"</a>";
						}
						str+="<a id=\"page_next\"  onclick=\"getindex('.zy_left tfoot tr','next',"+ncount+","+j+","+i+")\" >下一页》</a>";
						
						$(".fenye").append(str);
							
						
												
						$(".fenye a").hide();
						$(".fenye a[id]").show();
					}
					else if(cmd=="queryzxgg"){
						
						var str="";	
						var str2="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               				for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}

							str+="<div class=\"nr_big\">";
							str+="<div class=\"tu1\"><div id=\"demo"+i+"\" class=\"flexslider\">";
							str+="<ul class=\"slides\">";
							str+="<li><div class=\"img\"><img src=\""+jsonobj.data[i].zxgg+"\" height=\"640\" width=\"350\" alt=\"\" /></div></li>";
							str+="</ul>";
							str+="</div></div>";
							str+="<div class=\"y_nr\">";
							str+="<h1 class=\"h1\">"+jsonobj.data[i].zxgg_title+"</h1>";
							str+="<p class=\"gly\"  style=\"display:none\">归类于  <a href=\"/sort/shidi/\" rel=\"tag\">史地</a></p><div class=\"gly_zi\">";
							str+="<p>"+jsonobj.data[i].zxgg_content+"</p>";
							str+="<a  class=\"button\">阅读</a>";
							str+="</div></div></div>";
							
							str2+="<dl>";
							str2+="<dt><img src=\""+jsonobj.data[i].zxgg+"\" width=\"220\" height=\"129\"></dt>";
							str2+="<dd><a href=\"\">"+jsonobj.data[i].zxgg_id+"</a></dd>";
							str2+="<dd class=\"hui\">"+jsonobj.data[i].zxgg_title+"</dd>";
							str2+="<dd><p>"+jsonobj.data[i].zxgg_content.substring(0,38)+"</p></dd>";
							str2+="<dd  class=\"bai\"><a target=\"_blank\" href=\"zhengshengzixun.html?zxgg="+base64_encode(encodeURIComponent(jsonobj.data[i].zxgg))+"&zxgg_content="+base64_encode(encodeURIComponent(jsonobj.data[i].zxgg_content))+"\" class=\"button\">阅读</a></dd>";
							str2+="</dl>";

						}
						
						$(".ydd").empty();
						$(".ydd").append(str2);
						
					}
					else if(cmd=="queryzsxw"){
						
						var str="";	
						var str2="";	
						for (var i = 0; i < jsonobj.data.length; i++) {
               				for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}

							str+="<div class=\"nr_big\">";
							str+="<div class=\"tu1\"><div id=\"demo"+i+"\" class=\"flexslider\">";
							str+="<ul class=\"slides\">";
							str+="<li><div class=\"img\"><img src=\""+jsonobj.data[i].zsxw+"\" width=\"640\" height=\"350\" alt=\"\" /></div></li>";
							str+="</ul>";
							str+="</div></div>";
							str+="<div class=\"y_nr\">";
							str+="<h1 class=\"h1\">"+jsonobj.data[i].zsxw_title+"</h1>";
							str+="<p class=\"gly\"  style=\"display:none\">归类于  <a href=\"/sort/shidi/\" rel=\"tag\">史地</a></p><div class=\"gly_zi\">";
							str+="<p>"+jsonobj.data[i].zsxw_content+"</p>";
							str+="<a href=\"\" class=\"button\" style=\"display:none\">阅读</a>";
							str+="</div></div></div>";
							
							str2+="<dl>";
							str2+="<dt><img src=\""+jsonobj.data[i].zsxw+"\" width=\"220\" height=\"129\"></dt>";
							str2+="<dd><a href=\"\">"+jsonobj.data[i].zsxw_id+"</a></dd>";
							str2+="<dd class=\"hui\">"+jsonobj.data[i].zsxw_title+"</dd>";
							str2+="<dd><p>"+jsonobj.data[i].zsxw_content+"</p></dd>";
							str2+="<dd class=\"bai\"><a class=\"button\">阅读</a></dd>";
							str2+="</dl>";

						}
						$("#qsdg_tab_tu").empty();
						$("#qsdg_tab_tu").append(str);
						
						var scrollPic1 = new ScrollPic();
						scrollPic1.scrollContId   = "qsdg_tab_tu";
						scrollPic1.arrLeftId      = "left_button";
						scrollPic1.arrRightId     = "right_button";
						
						scrollPic1.frameWidth     = 940;
						scrollPic1.pageWidth      = 940; 
						
						scrollPic1.speed          = 10;
						scrollPic1.space          = 20; 
						scrollPic1.autoPlay       = false; 
						scrollPic1.autoPlayTime   = 2;
						
						scrollPic1.initialize();
						
						for (var i = 0; i < jsonobj.data.length; i++) {
						
							$('#demo'+i).flexslider({
								animation: "slide",
								direction:"horizontal",
								easing:"swing"
							});
						}
					}
					else if(cmd=="changepwd"){
						alert(retmsg);
					}
					else if(cmd=="del_admin"){
						alert(retmsg);
						$("form")[0].reset();
					}
					else if (cmd=="login"){
						var username=$("[name='username']").val();
						var password=$("[name='password']").val();
						var admin_remenber=check("[name='admin_remenber']");
						var admin_autologin=check("[name='admin_autologin']");
						setCookie_time("username",username,"d30");
						setCookie_time("password",password,"d30");
						setCookie_time("admin_remenber",admin_remenber,"d30");
						setCookie_time("admin_autologin",admin_autologin,"d30");
						
						var student_id="";
						var student_name="";
						var kc_id="";
						for (var i = 0; i < jsonobj.data.length; i++) {
               				for(var e in jsonobj.data[i]){
								jsonobj.data[i][e]=decodeURIComponent(jsonobj.data[i][e]);	
		  					}
							student_id=jsonobj.data[i].student_id;
							student_name=jsonobj.data[i].student_name;
							kc_id=jsonobj.data[i].kc_id;
							setCookie_time("student_id",student_id,"h2");
							setCookie_time("student_name",student_name,"h2");
							setCookie_time("kc_id",kc_id,"h2");
						}
						
						window.location.href="gerenzhongxinkecheng.html";
					}
					else if (cmd=="loginout"){
						delCookie("student_id");
						delCookie("student_name");
						window.location.href="index.html";
					}
					else if (cmd=="queryadmininfo"){
						var admin_id=jsonobj.admin_id?jsonobj.admin_id:"";
						var username=jsonobj.username?jsonobj.username:"";
						$("#admin_id").val(admin_id);
						$("[name='username']").val(username);
						if(admin_id==""){
							alert("请先登陆");
							window.location.href="index.html";
						}
					}
					else if (cmd=="bm"){				
						alert(retmsg);
						window.location.href="index.html";
					}
					else if (cmd=="add_log"){
						if(extend=='1'){
							window.location.href="bbs/forum.php";
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
	
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	if (cmd=="query_product_price"){
		var product_price_id=cmdarr["product_price_id"] ? cmdarr["product_price_id"] : "";
		if(confirm("是否确认删除")){
			main("del_product_price","product_price_id="+product_price_id);
		}
	}
}

function dbclick(cmd,cmdlist){
	$("form").show();
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	if(cmd=="query_product_type_zl"){
		$("#product_type_zl").hide();
		
		var product_type_zl_id=cmdarr["product_type_zl_id"] ? cmdarr["product_type_zl_id"] : "";
		var product_type_zl=cmdarr["product_type_zl"] ? cmdarr["product_type_zl"] : "";
		$("input[name='product_type_zl_id']").val(product_type_zl_id);
		$("input[name='product_type_zl']").val(product_type_zl);
	}
	
}


function newadd(cmd){
	$("form").show();
	if(cmd=="product_type_zl"){
		$("#product_type_zl").hide();
		
		$("form")[0].reset();
		$("input[name='product_type_zl_id']").focus();
	}
	else if(cmd=="pic_file"){
		var pic_count=$(".pic_file").length?$(".pic_file").length:0;
		var file_mx_id=$(".file_mx_id").html();
		if(pic_count>=3){
			alert("上传的作品不能超过3个");
		}
		else{
			var str="";
			file_mx_id=parseInt(file_mx_id)+1;
			str+="<div class=\"pic_file\" id=\"pic_index_"+file_mx_id+"\">";
			str+="<input name=\"files["+file_mx_id+"]\"  type=\"file\" multiple>";
			str+="<img src=\"images/sc.jpg\" style=\"float:right;margin-right:80px;margin-top:-15px\" onclick=\"del('pic_file','pic_index="+file_mx_id+"')\">";
			str+="</div>";
			$(".files").append(str);
			$(".scts").html("本地上传，还可以上传"+(2-parseInt(pic_count))+"张作业");
			$(".file_mx_id").html(file_mx_id);
		}
	}
	
}

function save(cmd){
	if(cmd=="bm"){
		var username=$("[name='username']").val();
		var sex=$("[name='sex']:checked").val();
		var birthday=$("[name='birthday']").val();
		var parent=$("[name='parent']").val();
		var phone=$("[name='phone']").val();
		//var address_gj=$("[name='address_gj']").val();
		//var address_sf=$("[name='address_sf']").val();
		//var address_cs=$("[name='address_cs']").val();
		//var address=((typeof(address_gj)!="undefined")?address_gj:"")+((typeof(address_sf)!="undefined")?(address_gj+"省"):"")+((typeof(address_cs)!="undefined")?address_cs:"");
		var address=$("[name='address']").val();
		var email=$("[name='email']").val();
		var weibo=$("[name='weibo']").val();
		var qq=$("[name='qq']").val();
		var nickname=$("[name='nickname']").val();
		var xgjg=$("[name='xgjg']").val();
		var xgpxb=$("[name='xgpxb']").val();
		var xqah=$("[name='xqah']").val();
		var jrxgzy=$("[name='jrxgzy']").val();
		var cz=$("[name='cz']").val();
		var qd=$("[name='qd']").val();	
		main("bm","username="+username+"&sex="+sex+"&birthday="+birthday+"&parent="+parent+"&phone="+phone+"&address="+address+"&email="+email+"&weibo="+weibo+"&qq="+qq+"&nickname="+nickname+"&xgjg="+xgjg+"&xgpxb="+xgpxb+"&xqah="+xqah+"&jrxgzy="+jrxgzy+"&cz="+cz+"&qd="+qd+"&from=web");
	}
	else if(cmd=="xiugaimima"){
		var username=getCookie("username");
		var password=$("[name='password']").val();
		var newpassword=$("[name='newpassword']").val();
		var newpassword_confirm=$("[name='newpassword_confirm']").val();
		main("changepwd","username="+username+"&password="+password+"&newpassword="+newpassword+"&newpassword_confirm="+newpassword_confirm);
	}
	else if(cmd=="gerenxinxi"){
		var student_id=$("#student_id").html();
		var username=$("[name='username']").val();
		var student_name=$("[name='student_name']").val();
		var student_sex=$("[name='student_sex']").val();
		var student_birthday=$("[name='student_birthday']").val();
		var student_parent=$("[name='student_parent']").val();
		var student_phone=$("[name='student_phone']").val();
		var student_address=$("[name='student_address']").val();
		var student_email=$("[name='student_email']").val();
		var student_weibo=$("[name='student_weibo']").val();
		var student_qq=$("[name='student_qq']").val();
		var student_nickname=$("[name='student_nickname']").val();
		var student_xgjg=$("[name='student_xgjg']").val();
		var student_xgpxb=$("[name='student_xgpxb']").val();
		var student_xqah=$("[name='student_xqah']").val();
		var student_jrxgzy=$("[name='student_jrxgzy']").val();
		var student_cz=$("[name='student_cz']").val();
		var student_qd=$("[name='student_qd']").val();
	
		main("addxygl_2","student_id="+student_id+"&username="+username+"&student_sex="+student_sex+"&student_birthday="+student_birthday+"&student_parent="+student_parent+"&student_phone="+student_phone+"&student_address="+student_address+"&student_email="+student_email+"&student_weibo="+student_weibo+"&student_qq="+student_qq+"&student_nickname="+student_nickname+"&student_xgjg="+student_xgjg+"&student_xgpxb="+student_xgpxb+"&student_xqah="+student_xqah+"&student_jrxgzy="+student_jrxgzy+"&student_cz="+student_cz+"&student_qd="+student_qd);
	}
	else if(cmd=="wentidayi"){
		var username=getCookie("username");
		var wt_content=$("[name='wt_content']").val();
		main("addwt","username="+username+"&wt_content="+wt_content);
	}
	else if(cmd=="yijianfankui"){
		var username=getCookie("username");
		var yjfk_content=$("[name='yjfk_content']").val();
		main("yjfk","username="+username+"&yjfk_content="+yjfk_content);
	}
	else if(cmd=="zp"){
		var form = $("form");
		form.attr('method', 'post');
		form.attr('enctype', 'multipart/form-data');
		form.attr('target', '_blank');
		form.attr('action', posturl);
		form.submit();
	}
	else if(cmd=="pj"){
		var admin_list="";
		var username=getCookie("username");
		var trs=$(".r4");
		var tr_count=trs.length;
		for(var i=0;i<tr_count;i++){
			var admin_id=trs.eq(i).find("[name='admin_id']").val();
			var ifgz=check(trs.eq(i).find("[name='ifgz']"));
			var pj_type=trs.eq(i).find("[name='pj_type']:checked").val();
			var pj_type=typeof(pj_type)!="undefined" ? pj_type:"";
			if(admin_list==""){
				admin_list+=admin_id+"/"+ifgz+"/"+pj_type;
			}
			else{
				admin_list+="|"+admin_id+"/"+ifgz+"/"+pj_type;
			}
		}
		main("addpj_2","username="+username+"&admin_list="+admin_list);
	}
	
}

function del(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	var cmdarr=new Array();
	parse_str(cmdlist,cmdarr);
	
	if(confirm("是否确认删除")){
		if(cmd=="wtdy"){
			var wtdy_id=cmdarr["wtdy_id"] ? cmdarr["wtdy_id"] : "";
			if(wtdy_id==""){
				alert("编号不能为空");
				return;
			}
			main("delwtdy","wtdy_id="+wtdy_id);
		}
		else if(cmd=="yjfk"){
			var yjfk_id=cmdarr["yjfk_id"] ? cmdarr["yjfk_id"] : "";
			if(yjfk_id==""){
				alert("编号不能为空");
				return;
			}
			main("delyjfk","yjfk_id="+yjfk_id);
		}
		else if(cmd=="pic_file"){
			var pic_index=cmdarr["pic_index"] ? cmdarr["pic_index"] : "";
			$("#pic_index_"+pic_index).remove();
			
		}
		
	}
}

function cancel(cmd){
	$("form").hide();
	if(cmd=="product_type_zl"){
		$("#product_type_zl").show();	
		main("query_product_type_zl");	
	}
	
}

function table_refresh(cmd){
	if (cmd=="dd"){
		main("queryddglmx","dd_id="+$("#dd_id").val(),"false","1");	
	}
}

function query(cmd){
	if (cmd=="zuoyedianping"){
		var student_id=$("#student_id").html();		
		var username=getQueryStringByName("username");
		username=username ? base64_decode(username) : getCookie("username");
		if(student_id && username){
			main("queryzp","username="+username+"&begindate="+$("[name='begindate']").val()+"&enddate="+$("[name='enddate']").val());
		}
		else{
			alert("请先登录");
		}
	}
	else if (cmd=="banjidianping"){
		var student_id=$("#student_id").html();		
		var username=getQueryStringByName("username");
		username=username ? base64_decode(username) : getCookie("username");
		if(student_id && username){
			main("querybjdp","username="+username+"&begindate="+$("[name='begindate']").val()+"&enddate="+$("[name='enddate']").val());
		}
		else{
			alert("请先登录");
		}
	}
	else if (cmd=="bianzoubianhua1"){
		var student_id=$("#student_id").html();		
		var username=getQueryStringByName("username");
		username=username ? base64_decode(username) : getCookie("username");
		if(student_id && username){
			main("querybzbh","username="+username+"&begindate="+$("[name='begindate']").val()+"&enddate="+$("[name='enddate']").val());
		}
		else{
			alert("请先登录");
		}
	}
	else if(cmd=="zhengshenghuayou"){
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			main("queryhy","username="+username+"&student_birthday="+$("[name='student_birthday']").val()+"&student_address="+$("[name='student_address']").val());
			main("add_log","username="+username+"&log_type_id=18");
		}
	}
	
}

function change(cmd){
	if (cmd=="price"){
		$("#product").hide();
		$("#product_form").hide();
		$("#price").show();
		main("query_company","","false","1");
		main("query_product_type","","false","1");
		main("query_product_type_mx","","false","1");	
	}
	
}

function choose(){
	var cmd = arguments[0] ? arguments[0] : "";
	var cmdlist = arguments[1] ? arguments[1] : "";
	
	if (cmd=="price"){
		if($("#price :checkbox").is(":checked")){
			$("#price :checkbox").prop("checked",false);
		}
		else{
			$("#price :checkbox").prop("checked","checked");
		}
	}
	else if (cmd=="ifgz"){
		var i=parseInt(cmdlist);
		$("[name='ifgz']").removeAttr("checked");
		$("[name='ifgz']").prop("checked","");
		$("[name='ifgz']").eq(i).prop("checked","checked");
	}
}

function init(){
	var yxzpmenu=getCookie("yxzpmenu");
	var bzbhmenu=getCookie("bzbhmenu");
	var kcxxurl=getCookie("kcxxurl");
	var lxwmurl=getCookie("lxwmurl");
	var gsjjurl=getCookie("gsjjurl");
	var gyzsurl=getCookie("gyzsurl");
	var kktzurl=getCookie("kktzurl");
	var zcfwurl=getCookie("zcfwurl");
	
	var student_id=getCookie("student_id");
	var student_name=getCookie("student_name");
	
	//student_id="90";
	//student_name="正声测试";
	
	if(yxzpmenu){
		$("#menu-item-11 ul").empty();
		$(".pic_news_title a").remove();
		var yxzpmenu_array = new Array();
		yxzpmenu_array=explode("|",yxzpmenu);
		
		var str="";	
		var str2="";					
		for (var i = 0; i < yxzpmenu_array.length; i++) {
			var yxzpmenu_mx_array = new Array();
			yxzpmenu_mx_array=explode("/",yxzpmenu_array[i]);
			var kc_id=yxzpmenu_mx_array[0];
			var kc_name=yxzpmenu_mx_array[1];
			
			str+="<li  class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children\"><a  target=\"_blank\" href=\"youxiuzuopin.html?yxzp_type_id="+kc_id+"\" class=\"sf-with-ul\">"+kc_name+"</a>";
			str2+="<a target=\"_blank\" href=\"youxiuzuopin.html?yxzp_type_id="+kc_id+"\">"+kc_name+"</a>";
		}
		
		$("#menu-item-11 ul").append(str);
		$(".pic_news_title").append(str2);
		
		
	}
	else{
		main("querykc");
	}
	
	if(!bzbhmenu){
		bzbhmenu="1/博物馆写生|2/户外写生|3/艺术家互动|4/每日一画|5/边走边画";
		setCookie_time("bzbhmenu",bzbhmenu,"h2");
	}
	$("#menu-item-1342 ul").empty();
	var bzbhmenu_array = new Array();
	bzbhmenu_array=explode("|",bzbhmenu);
	
	var str="";					
	for (var i = 0; i < bzbhmenu_array.length; i++) {
		var bzbhmenu_mx_array = new Array();
		bzbhmenu_mx_array=explode("/",bzbhmenu_array[i]);
		var bzbh_type_id=bzbhmenu_mx_array[0];
		var bzbh_type=bzbhmenu_mx_array[1];
		
		str+="<li  class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children\"><a  target=\"_blank\" href=\"bianzoubianhua.html?sybzbh_type_id="+bzbh_type_id+"\" class=\"sf-with-ul\">"+bzbh_type+"</a>";
	}
	
	$("#menu-item-1342 ul").append(str);
	
	/*if(!kcxxurl){
		kcxxurl=kcburl;
		setCookie_time("kcxxurl",kcxxurl,"h2");
	}*/
	
	
	
	if(!kcxxurl){
		main("querybmlc");
	}
	else{	
		$("#kcxx").attr("href",xiangxiurl+base64_encode(encodeURIComponent(kcxxurl))+'&log_type_id=5');
	}
	
	//if(!lxwmurl){
		lxwmurl=lxwm_url;
		setCookie_time("lxwmurl",lxwmurl,"h2");
	//}
	
	$("#lxwm").attr("href",xiangxiurl+base64_encode(encodeURIComponent(lxwmurl))+'&log_type_id=7');
	
	if(!gsjjurl){
		main("queryzsjj");
	}
	else{	
		$("#gsjj").attr("href",xiangxiurl+base64_encode(encodeURIComponent(gsjjurl))+'&log_type_id=8');
	}
	
	if(!gyzsurl){
		main("querygy");
	}
	else{	
		$("#gyzs").attr("href",xiangxiurl+base64_encode(encodeURIComponent(gyzsurl))+'&log_type_id=19');
	}
	
	if(!kktzurl){
		main("querykktz");
	}
	else{	
		$("#kktz").attr("href",xiangxiurl+base64_encode(encodeURIComponent(kktzurl))+'&log_type_id=20');
	}
	
	if(!zcfwurl){
		main("queryzcfw");
	}
	else{	
		$("#zcfw").attr("href",xiangxiurl+base64_encode(encodeURIComponent(zcfwurl))+'&log_type_id=21');
	}
	
	$("#student_name").attr("href","gerenzhongxinkecheng.html");
	if(student_id){
		$("#login").hide();
		$("#student_name").show();
		$("#loginout").show();
		$("#student_id").html(student_id);
		$("#student_name").html(student_name);
	}
	else{
		$("#login").show();
		$("#student_name").hide();
		$("#loginout").hide();
	}

}


function  pageinit(page){
	init();
	if(page=="login"){
		var username=getCookie("username");
		var password=getCookie("password");
		var admin_remenber=getCookie("admin_remenber");
		var admin_autologin=getCookie("admin_autologin");
		if(username){
			$("[name='username']").val(username);
		}
		if(password){
			$("[name='#password']").val(password);
		}
		if(admin_remenber){
			if(admin_remenber=="1"){
				$("#admin_remenber").prop("checked","checked");
			}
		}
		if(admin_autologin){
			if(admin_autologin=="1"){
				$("#admin_autologin").prop("checked","checked");
				login();
			}
		}
	}
	else if(page=="xiangxi"){
		var url =getQueryStringByName("url");
		var log_type_id =getQueryStringByName("log_type_id");
		if(url==""){
			alert("该url地址不存在");
			return;
		}
		else{
			url=base64_decode(url);
			url=decodeURIComponent(url);
			$(".tuttt img").attr("src",url);
			
			var username=getCookie("username"); 
			var student_id=getCookie("student_id");
			if(student_id && username && log_type_id){
				main("add_log","username="+username+"&log_type_id="+log_type_id);
			}
		}
	}
	else if(page=="youxiuzuopin"){
		var yxzpmenu=getCookie("yxzpmenu");
		
		if(yxzpmenu){
			$(".zy_right ul").empty();
			var yxzpmenu_array = new Array();
			yxzpmenu_array=explode("|",yxzpmenu);
			
			var str="";	
			str+="<li>资源分类</li>";
			for (var i = 0; i < yxzpmenu_array.length; i++) {
				var yxzpmenu_mx_array = new Array();
				yxzpmenu_mx_array=explode("/",yxzpmenu_array[i]);
				var kc_id=yxzpmenu_mx_array[0];
				var kc_name=yxzpmenu_mx_array[1];
				
				str+="<li><a target=\"_blank\" href=\"youxiuzuopin.html?yxzp_type_id="+kc_id+"\">"+kc_name+"</a></li>";
			}
			
			$(".zy_right ul").append(str);			
			
		}
		var yxzp_type_id =getQueryStringByName("yxzp_type_id");
		main("queryyxzp","yxzp_type="+yxzp_type_id);
	}
	else if(page=="bianzoubianhua"){
		var bzbhmenu=getCookie("bzbhmenu");
		
		if(!bzbhmenu){
			bzbhmenu="1/博物馆写生|2/户外写生|3/艺术家互动|4/每日一画|5/边走边画";
		}
		$(".zy_right ul").empty();
		var bzbhmenu_array = new Array();
		bzbhmenu_array=explode("|",bzbhmenu);
		
		var str="";		
		str+="<li>资源分类</li>";			
		for (var i = 0; i < bzbhmenu_array.length; i++) {
			var bzbhmenu_mx_array = new Array();
			bzbhmenu_mx_array=explode("/",bzbhmenu_array[i]);
			var bzbh_type_id=bzbhmenu_mx_array[0];
			var bzbh_type=bzbhmenu_mx_array[1];
			
			str+="<li><a target=\"_blank\" href=\"bianzoubianhua.html?sybzbh_type_id="+bzbh_type_id+"\">"+bzbh_type+"</a></li>";
		}
		
		$(".zy_right ul").append(str);
		var sybzbh_type_id =getQueryStringByName("sybzbh_type_id");
		main("querysybzbh","sybzbh_type="+sybzbh_type_id);
	}
	else if(page=="gerenzhongxinkecheng"){
		
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			main("querykc","","false","1");
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
		
	}
	else if(page=="zhengshengzixun"){
		var zxgg=getQueryStringByName("zxgg");
		var zxgg_content=getQueryStringByName("zxgg_content");
		zxgg=decodeURIComponent(base64_decode(zxgg));
		zxgg_content=decodeURIComponent(base64_decode(zxgg_content));
		$("#zxgg").attr("src",zxgg);
		$("#zxgg_content").html(zxgg_content);
	}
	else if(page=="gerenzhongxinkejian"){
		var kc_id=getQueryStringByName("kc_id");
		
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			main("querykcmx","kc_id="+kc_id);
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="zuoyedianping"){
		var student_id=$("#student_id").html();		
		var username=getQueryStringByName("username");
		username=username ? base64_decode(username) : getCookie("username");
		if(student_id && username){
			main("add_log","username="+username+"&log_type_id=11");
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="banjidianping"){
		var student_id=$("#student_id").html();		
		var username=getQueryStringByName("username");
		username=username ? base64_decode(username) : getCookie("username");
		if(student_id && username){
			//main("queryzp","username="+username);
			
			main("add_log","username="+username+"&log_type_id=12");
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="xuexizhoukan"){

		
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			main("querykcb","username="+username);
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
		
	}
	else if(page=="bianzoubianhua1"){
		var username=getQueryStringByName("username");
		username=username ? base64_decode(username) : getCookie("username");
		var student_id=getCookie("student_id");
		if(student_id && username){
			//main("querybzbh","username="+username);
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="gerenxinxi"){
		var username=$("[name='username']").val();
		var student_name=$("[name='student_name']").val();
		var student_sex=$("[name='student_sex']").val();
		var student_birthday=$("[name='student_birthday']").val();
		var student_parent=$("[name='student_parent']").val();
		var student_phone=$("[name='student_phone']").val();
		var student_address=$("[name='student_address']").val();
		var student_email=$("[name='student_email']").val();
		var student_weibo=$("[name='student_weibo']").val();
		var student_qq=$("[name='student_qq']").val();
		var student_nickname=$("[name='student_nickname']").val();
		var student_xgjg=$("[name='student_xgjg']").val();
		var student_xgpxb=$("[name='student_xgpxb']").val();
		var student_xqah=$("[name='student_xqah']").val();
		var student_jrxgzy=$("[name='student_jrxgzy']").val();
		var student_cz=$("[name='student_cz']").val();
		var student_qd=$("[name='student_qd']").val();
		
		var student_id=$("#student_id").html();
		if(student_id){
			main("queryxygl","student_id="+student_id);
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="gerenxinxi2"){
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			main("queryxygl","username="+username,"false","1");
			main("add_log","username="+username+"&log_type_id=14");
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="zhengshenghuayou"){
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			//main("queryhy","username="+username);
			main("querybirthday");
			main("queryaddress");
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="wentidayi"){
		var username=getCookie("username"); 
		var student_id=getCookie("student_id"); 
		if(student_id && username){
			main("querywtdy","username="+username);
			main("add_log","username="+username+"&log_type_id=17");
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="yijianfankui"){
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			main("queryyjfk","username="+username);
			main("add_log","username="+username+"&log_type_id=22");
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="shangchuanzuoye"){
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		var kc_id=getCookie("kc_id");
		if(student_id && username){
			main("querykcmx","kc_id="+kc_id,"fasle","1");
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
		$("[name='username']").val(username);
		//file_upload("form",".fileupload-progress","#pic","shangchuanzuoye");
	}
	else if(page=="laoshixinxi"){
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			main("queryjs","username="+username);
		}
		else{
			alert("请先登录");
			window.location.href="login.html";
		}
	}
	else if(page=="index"){
		$("#qsdg_tab_tu").empty();
		$(".ydd").empty();
		main("queryzxgg");
		main("queryzsxw");
		main("queryyxzp","yxzp_type_max=1","false","1");
		
	}
	
}

function getindex(id,index,ncount,maxpage,maxcount){
	var pageindex=$("#pageindex").html();
	$(id).hide();
	if(index=="before"){
		pageindex=parseInt(pageindex)-1;
		if(pageindex<1){
			pageindex=1;
		}
	}
	else if(index=="next"){
		pageindex=parseInt(pageindex)+1;
		if(pageindex>maxpage){
			pageindex=maxpage;
		}
	}
	else{
		pageindex=index;		
	}
		
	$("#pageindex").html(pageindex);
	
	var begin=ncount*(parseInt(pageindex)-1);
	var end=ncount*pageindex;
	end=(end>maxcount)?maxcount:end;
	for(var i=begin;i<end;i++){
		$(id).eq(i).show();
	}
	
	$(".fenye a").hide();


	$("#page_before").show();
	$("#page_next").show();
	
	var pagebegin=parseInt(pageindex)-3;
	var pageend=parseInt(pageindex)+2;
	if(parseInt(pageindex)-3<=1){
		pagebegin=1;
		pageend=6;
	}
	if(pageend>=maxcount){
		pagebegin=parseInt(maxcount)-6;
		pageend=maxcount;
	}
	for(var j=pagebegin;j<=pageend;j++){
		$("#page_"+j).show();
	}
		
}

function getyxzptype(type_id){
	if(type_id=='1'){
		return "一年级造型课";
	}
	else if(type_id=='2'){
		return "一年级色彩课";
	}
	else if(type_id=='3'){
		return "二年级色彩课";
	}
	else if(type_id=='4'){
		return "二年级色彩课";
	}
	else if(type_id=='5'){
		return "中国绘画史";
	}
}

function getvalue(id,keylist,valuelist){
	if(id && keylist && keylist!="" && valuelist && valuelist!=""){
		var idarr=new Array();
		idarr=explode("|",id);
		var keyarr=new Array();
		keyarr=explode("|",keylist);
		var valuearr=new Array();
		valuearr=explode("|",valuelist);
		if(keyarr.length==valuearr.length){
			var result="";
			for(var j=0;j<idarr.length;j++){
				for(var i=0;i<keyarr.length;i++){
					if(keyarr[i]==idarr[j]){
						if(result==""){
							result+=valuearr[i];
						}
						else{
							result+="|"+valuearr[i];
						}
					}
				}
			}
			return result;
		}
		else{
			alert("输入的key和value个数不同");
		}
	}
	else{
		alert("输入参数有误");
	}
}

function kj_qx(kj_id,kc_id,url){
	var username=getCookie("username");
	main("studentkj_qx","username="+username+"&kj_id="+kj_id+"&kc_id="+kc_id,"false",url);
}

function show(cmd){
	if(cmd=="kejianjianjie"){
		$("#kejianjianjie").show();
		$(".kssz").hide();
	}
	else if(cmd=="kssz"){
		$(".kssz").show();
		$("#kejianjianjie").hide();
	}
}

function login() {
	main("login","username="+$("[name='username']").val()+"&password="+$("[name='password']").val()+"&from=web");
}

function loginout(){
	if(confirm("是否确认退出")){
		main("loginout","student_id="+$("#student_id").html());
    }
}


function file_upload(form,progress,show_pic,upload_type) {
	$(form).fileupload({
		url: posturl,
		dataType: 'json',
		autoUpload: false,
		replaceFileInput:false,
		paramName:'files[]',
		singleFileUploads:false,
		limitMultiFileUploads:3,
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
			$(progress).show();
			$(progress+" .progress-bar").css(
				'width',
				'0%'
			);
		},
		progress: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$(progress+" .progress-bar").css(
				'width',
				progress + '%'
			);
		},
		always:function (e, data) {
			var jqXHR=data.jqXHR;
			if(jqXHR.status == 200  || jqXHR.status == 0) {
				 var result=jqXHR.responseText;
				 if (result) {
					var jsonobj=eval('('+result+')');
					var retcode=jsonobj.errcode;
					var retmsg=decodeURIComponent(jsonobj.errmsg);
					if(retcode=="0"){
						$(progress).hide();
						alert(retmsg);
					}
					else{
						alert(retmsg);
					}
				}
				else {
					alert("操作失败");
				}
			}
		}
    }).on('fileuploadadd', function (e, data) {
		$(show_pic).hide();
		//$("#files").empty();
       /* data.context = $('<span/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>').append("");
            node.appendTo(data.context);	
        });*/
		var count=$("canvas").length;
		
		if(count>=3){
			alert("上传的作品不能超过3个");
		}
		else{
			$(".scts").html("本地上传，还可以上传"+(2-parseInt(count))+"张作业");
			data.context = $('<span/>').appendTo('#files');
			$("#save").removeAttr("onclick");
			$("#save").unbind("click");
			$("#save").on('click', function () {
				if(upload_type=="shangchuanzuoye"){ 
	
				}
				var form = $(form);
				form.attr('method', 'post');
				form.attr('enctype', 'multipart/form-data');
				form.attr('target', '_blank');
				form.attr('action', posturl);
				data.submit();
				//form.submit();
			});
		}
		
		
		
    }).on('fileuploadprocessalways', function (e, data) {
		var index = data.index,
            file = data.files[index],
            node = $(data.context);
        if (file.preview) {
            //node.prepend('<br>').prepend(file.preview);
			node.prepend('&nbsp;&nbsp;').prepend(file.preview);
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

function dd_init(){
	//main("queryddgl");
	main("query_dd_zt_type","","false","2");
	dd_upload();
}

function dd_upload() {
	$('#dd_form').fileupload({
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
			$("#pic_progress").show();
			$("#pic_progress .progress-bar").css(
				'width',
				'0%'
			);
		},
		progress: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$("#pic_progress .progress-bar").css(
				'width',
				progress + '%'
			);
		},
		always:function (e, data) {
			var jqXHR=data.jqXHR;
			if(jqXHR.status == 200  || jqXHR.status == 0) {
				 var result=jqXHR.responseText;
				 if (result) {
					var jsonobj=eval('('+result+')');
					var retcode=jsonobj.errcode;
					var retmsg=decodeURIComponent(jsonobj.errmsg);
					if(retcode=="0"){
						$("#pic_progress").hide();
						alert(retmsg);
					}
					else{
						alert(retmsg);
					}
				}
				else {
					alert("操作失败");
				}
			}
		}
    }).on('fileuploadadd', function (e, data) {
		$("img[name='dd_pic']").hide();
		$("#files").empty();
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>').append("");
            node.appendTo(data.context);	
        });
		$("#save").removeAttr("onclick");
		$("#save").unbind("click");
		$("#save").on('click', function () {
           var dd_id=$("input[name='dd_id']").val();
			var wl_price=$("input[name='wl_price']").val();
			var dd_isconfirm=$("input[name='dd_isconfirm']").val();
			var dd_zt_type=$("select[name='dd_zt_type_id']").val();
	
			if(dd_id==""){
				alert("订单id不能为空");
				return;
			}
			if(wl_price==""){
				alert("物流价格不能为空");
				return;
			}
			if(dd_isconfirm==""){
				alert("订单是否确认不能为空");
				return;
			}
			if(dd_zt_type==""){
				alert("订单状态不能为空");
				return;
			}
 
            var form = $("#dd_form");
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
	var html = $("[name='product_pic']").html();
    $("[name='product_pic']").html(html);
	$("img").show();
	$("#files").empty();
	$("#pic_progress").hide();
}

function login_reset() {
    $("[name='username']").val("");
    $("[name='password']").val("");
    $("[name='admin_remenber']").prop("checked",false);
    $("[name='admin_autologin']").prop("checked",false);
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
				var ret=$(result).find("ret");
				var data=$(result).find("data");
				var retcode=ret.attr("retcode");
				var retmsg=ret.attr("retmsg");
				if(retcode=="0"){	
					var url=ret.attr("url");
					if(id=="cardenglishcontext"){
						$("#"+id).attr("href",url);
					}
					else{
						$("#"+id).attr("src",url);
					}
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


function test(){
	document.getElementById("zsjj_content").innerHTML="222";
}

function ifts(ts){
	if(ts=="1"){
		return "是";
	}
	else{
		return "否";
	}
}

function goto(nexthtml){
	$("#subframe").attr("src",nexthtml);
}

function goback(main){
	$("#"+main).show();
	$("#"+main+"mx").hide();
}

function check(id){
	if ($(id).is(':checked')){
		return "1";
	}
	else{
		return "0";
	}
}

function radio_check(id){
	if ($(id).is(':checked')){
		$(id).prop("checked",false);
	}
	else{
		$(id).prop("checked","checked");
	}
}

function getQueryStringByName(name){

	var result = location.search.match(new RegExp("[\?\&]" + name+ "=([^\&]+)","i"));
	
	if(result == null || result.length < 1){
	
	 return "";
	
	}
	return result[1];
	

}

//setCookie(”name”,”hayden”);
function setCookie(name,value)
{
	var Days = 30;
	var exp = new Date(); 
	exp.setTime(exp.getTime() + Days*24*60*60*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

//setCookie_time("name","hayden","s20");
function setCookie_time(name,value,time){
	var strsec = getsec(time);
	var exp = new Date();
	exp.setTime(exp.getTime() + strsec*1);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function getsec(str){
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

function video(url){	
	var str="";
	if((url!="") && (typeof(url)!="undefined")){
		url=encodeURIComponent(url);
		url=base64_encode(url);
		str="<a href='"+videourl+"?url="+url+"' target=\"_blank\"></a>";
	}
	return str;
}

function download(){
	var url =getQueryStringByName("url");
	if(url==""){
		alert("该文件不存在");
	}
	else{
		url=decodeURIComponent(base64_decode(url));
 
		if (false == file_exists($filename)) { 
			return false; 
		} 
     
		header('Content-Type: application-x/force-download'); 
		header('Content-Disposition: attachment; filename="'+$url+'"'); 
		                
		if (false === strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6')) { 
			header('Cache-Control: no-cache, must-revalidate'); 
		} 
		header('Pragma: no-cache'); 
				 
			// read file content and output 
		return readfile($url);
	}

}

function gotohtml(page){
	if(page=='xiyeshequ'){
		var username=getCookie("username"); 
		var student_id=getCookie("student_id");
		if(student_id && username){
			main("add_log","username="+username+"&log_type_id=15","false","1");
		}
		else{
			window.location.href="bbs/forum.php";
		}
	}
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

function accDiv(arg1,arg2){
  var t1=0,t2=0,r1,r2;
  try{t1=arg1.toString().split(".")[1].length}catch(e){}
  try{t2=arg2.toString().split(".")[1].length}catch(e){}
  with(Math){
  r1=Number(arg1.toString().replace(".",""))
  r2=Number(arg2.toString().replace(".",""))
  return (r1/r2)*pow(10,t2-t1);
  }
}

function accMul(arg1,arg2)
{
  var m=0,s1=arg1.toString(),s2=arg2.toString();
  try{m+=s1.split(".")[1].length}catch(e){}
  try{m+=s2.split(".")[1].length}catch(e){}
  return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
}

function accAdd(arg1,arg2){
  var r1,r2,m;
  try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}
  try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}
  m=Math.pow(10,Math.max(r1,r2))
  return (arg1*m+arg2*m)/m
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
