<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>浏览审核</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../common/jquery.form.js"></script>
	<script type="text/javascript" src="../common/jquery.confirm/jquery.confirm.js"></script>
	<script type="text/javascript" src="../common/jquery.date_input.js"></script>  
	<script type="text/javascript" src="../common/jquery.lightbox-0.5.js"></script> 
	
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link rel="stylesheet" href="../common/date_input.css" type="text/css">
	<link rel="stylesheet" href="../common/jquery.lightbox-0.5.css" type="text/css">
	<style type="text/css">
		div.select{ float:left;margin-right:20px;}
		table,table th,table td {border:1px solid;}
		table tr:hover{background:yellow;}
		table td.hidden {display: none;}
		#preview {display: none;position:relative;}
		#edit {background:#000; position:absolute;z-index:999;width:100px;height:200px;}
		input.preview_submit{display: none;}
		#question_type_title{display: none;}
		#question_id{display: none;}

		nav {text-align: center;}
		nav a{text-decoration: none; font-size:20px;margin:0 10px 0 0;}
		nav a:hover{text-decoration: underline;}
		#redirect {width:30px;}
		span{cursor: default;}
		#final_preview{background:url(../pics/iphone5_bg.jpg) no-repeat;width:319px;height:508px;position: relative;}
		#img_pre{position: absolute;left:76px;top:178px;}
	</style>

	<script>  
		jQuery.extend(DateInput.DEFAULT_OPTS, {   
		month_names: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],   
		short_month_names: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],   
		short_day_names: ["一", "二", "三", "四", "五", "六", "日"],  
		 dateToString: function(date) {  
		    var month = (date.getMonth() + 1).toString();  
		    var dom = date.getDate().toString();  
		    if (month.length == 1) month = "0" + month;  
		    if (dom.length == 1) dom = "0" + dom;  
		    return date.getFullYear() + "-" + month + "-" + dom;  
		  }  
		  
		});   
		  
		$(function() {   
			$(".biuuu1").date_input();   
			$(".biuuu2").date_input();   
		});   
	</script> 

</head>
<body>
<?php require_once 'header.php';?>
<article id="container">
	<section>
		<form action="question_scan/getQuestionList" method="post" id="myForm">
			<div class="select">
				<label for="tk_type">题库类型</label><br />
				<select id="tk_type" name="type">
					<option value ="9999">全部</option>
					<?php foreach ($type as $key => $value) {
						$option_value = $key+1;
						echo "<option value =".$option_value.">".$value['type_name']."</option>";
					}
					?>					
				</select>
			</div>
			<div class="select">
				<label for="question_type">题目类型</label><br />
				<select id="question_type" name="question_type">
					<option value ="9999">全部</option>
					<option value ="0">文字题</option>
					<option value ="1">图片题</option>
					<option value ="2">填空题</option>
					<option value ="3">触摸题</option>
				</select>
			</div>
			<div class="select">
				<label for="user">出题人</label><br />
				<select id="user" name="user">
					<option value ="all">全部</option>
					<?php foreach ($userlist as $key => $value) {
						//$option_value = $key+1;
						echo "<option value =".$value['user_name'].">".$value['user_realname']."</option>";
					}
					?>	
				</select>
			</div>
			<div class="select">
				<label for="auditer">审核人</label><br />
				<select id="auditer" name="auditer">
					<option value ="all">全部</option>
					<?php foreach ($auditerlist as $key => $value) {
						//$option_value = $key+1;
						echo "<option value =".$value['user_name'].">".$value['user_realname']."</option>";
					}
					?>	
				</select>
			</div>
			<div class="select">
				<label for="status">状态</label><br />
				<select id="status" name="status">
					<option value ="9999">全部</option>
					<option value ="0">未审核</option>
					<option value ="1">审核通过</option>
					<option value ="2">审核不通过</option>
				</select>
			</div>
			<div class="select">
				<label for="difficult">难度</label><br />
				<select id="difficult" name="difficult">
					<option value ="9999">全部</option>
					<option value ="1">新手</option>
					<option value ="2">熟练</option>
					<option value ="3">高手</option>
				</select>
			</div>
			<div class="select" style="width:40px;">
				<label for="pagination">显示</label><br />
				<input id="pagination" name="pagination" placeholder="20" maxlength="2" style="width:40px;">
			</div>
			<br />
			<div class="select">
				<input id="search" name="search" />
				<select id="condition" name="condition">
					<option value ="1">文字题目</option>
					<option value ="2">图片编号</option>
					<option value ="3">题目编号</option>
				</select>
			</div>
			<div class="select">
				<label for="date_start">起始日期</label>
				<input id="date_start" type="text" class="biuuu1" name="date_start" />
				<label for="date_end">结束日期</label>
				<input id="date_end" type="text" class="biuuu2" name="date_end" />
			</div>

			<div class="select">
				<select id="order_item" name="order_item">
					<option value ="1">上次更新</option>
					<option value ="2">题目编号</option>
				</select>
			</div>
			<div class="select">
				<select id="order" name="order">
					<option value ="1">升序</option>
					<option value ="2">降序</option>
				</select>
			</div>


			<input class="submit" type="submit" value="搜索" />
		</form>
		<table id="table_content">
		</table>
		<section id="footer" style="display:none;">
			<label for="redirect" >跳转到第</label>
			<input type="text" id="redirect" />
			<em>页</em>
			<span id="redirect_direct">跳转</span>
		    <span id="first">首页</span>
		    <span id="pre" style="display:none;">上一页</span>
		    <span id="next">下一页</span>
		    <span id="last">末页</span>
		</section>
	</section>

	<section id="preview">
		<span id="pre_pre">上一条</span>
		<span id="pre_next">下一条</span>
		<span id="close">关闭</span>
		<form action="question_scan/deleteQuestion" method="post" id="deleteform" style="display:none;">
			<input type="hidden" name="type" id="delete_type"/>
			<input type="hidden" name="question_id" id="delete_question_id"/>
			<input type="submit" value="删除" />
		</form>

		<form  action="question_scan/editQuestion" enctype="multipart/form-data" method="post" id="preview_id" >
			<label id="type_label">文字题</label>
			<input id="question_type_title" name="question_type" value="">
			<input id="question_id" name="question_id" value="" />
			<br />
			<label for="question_name">问题</label>
  			<input name="question_name" id="question_name" placeholder="请输入问题" maxlength="14" />
  			<div id="question_image" style="display:none;">
  				<label for="upload_iamge">请上传图片</label>
  				<input id="upload_iamge" type="file" name="edit_image" />
  			</div>
  			<br />
  			<div id="optionfour">
	  			<label class="login" for="optin_1">选项1</label>
	  			<input class="login" type="text" name="option_one" id="optin_1" placeholder="请输入"  maxlength="12"/>
	 			<br />
	  			<label class="login" for="optin_2">选项2</label>
	  			<input class="login" type="text" name="option_two" id="optin_2" placeholder="请输入"  maxlength="12"/>
	 			<br />
	 			<label class="login" for="optin_3">选项3</label>
	  			<input class="login" type="text" name="option_three" id="optin_3" placeholder="请输入"  maxlength="12"/>
	 			<br />
	 			<label class="login" for="optin_4">选项4</label>
	  			<input class="login" type="text" name="option_four" id="optin_4" placeholder="请输入"  maxlength="12"/>
	 			<br />
  			</div>
  			<div id="optioneight" style="display:none">
	  			<label class="login" for="fill_optin_1">选项1</label>
	  			<input class="login" type="text" name="fill_option_one" id="fill_optin_1" placeholder="请输入" maxlength="1"/>
	  			<label class="login" for="fill_optin_5">选项5</label>
	  			<input class="login" type="text" name="fill_option_five" id="fill_optin_5" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="login" for="fill_optin_2">选项2</label>
	  			<input class="login" type="text" name="fill_option_two" id="fill_optin_2" placeholder="请输入" maxlength="1"/>
	 			<label class="login" for="fill_optin_6">选项6</label>
	  			<input class="login" type="text" name="fill_option_six" id="fill_optin_6" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="login" for="fill_optin_3">选项3</label>
	  			<input class="login" type="text" name="fill_option_three" id="fill_optin_3" placeholder="请输入" maxlength="1"/>
	  			<label class="login" for="fill_optin_7">选项7</label>
	  			<input class="login" type="text" name="fill_option_seven" id="fill_optin_7" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="login" for="fill_optin_4">选项4</label>
	  			<input class="login" type="text" name="fill_option_four" id="fill_optin_4" placeholder="请输入" maxlength="1"/>
	 			<label class="login" for="fill_optin_8">选项8</label>
	  			<input class="login" type="text" name="fill_option_eight" id="fill_optin_8" placeholder="请输入" maxlength="1"/>
	 			<br />
		 		<label for="true_num">正确答案字数</label>
	  			<select id="true_num" name="true_num">
					<option value ="1">1</option>
					<option value ="2">2</option>
					<option value ="3">3</option>
					<option value ="4">4</option>
					<option value ="5">5</option>
					<option value ="6">6</option>
					<option value ="7">7</option>
					<option value ="8">8</option>
				</select>
				<br />
  			</div>

 			<label for="question_difficulty">难度</label>
  			<select id="question_difficulty" name="question_difficulty">
				<option value ="1">新手</option>
				<option value ="2">熟练</option>
				<option value ="3">高手</option>
			</select>
			<br />
			<label for="type">请选择题库类型</label>
			<select id="type" name="type">
				<?php foreach ($type as $key => $value) {
					$option_value = $key+1;
					echo "<option value =".$option_value.">".$value['type_name']."</option>";
				}
				?>					
			</select>
			<br />
			<label for="exam_use">题库用途</label>
			<select disabled="disabled" id="exam_use">
				<option value ="0">0</option>
			</select>
			<br />
			<input id="edit_submit" class="preview_submit" type="submit" value="保存" />
	    </form>
	    	<input id="edit_button" type="button" value="修改" style="display:none;"/>
	    	<h3 id="lastmodifiedperson">最后修改人:</h3>
	    	<h3 id='lastmodifiedtime'>最后修改时间:</h3>	    	
	</section>

	<section id="final_preview" style="display:none;">
		<h5>点击图片预览</h5>
		<a title="" href="" id="question_pre">
			<img src="" width="164" height="87" id="img_pre">
		</a>
	</section>
	<section id="ifdoaudit" style="display:none;">
		<h5>审核</h5>
		<form action="question_scan/doAudit" method="post" id="auditForm">
			<input type="hidden" name="type" id="audit_type" />
			<input type="hidden" name="id" id="audit_id" />
			<label for="audit_pass">审核通过</label>
				<input type="radio" name="audit" value="2" id="audit_pass" />
			<label for="audit_not_pass">审核不通过</label>
				<input type="radio" name="audit" value="1" id="audit_not_pass" />
				<textarea placeholder ="请输入修改意见" name="suggestion" id="suggestion">
				</textarea>
			<input type="submit" value="确认审核" />
		</form>
	</section>


</article>

<script type="text/javascript">
	$(function() {
		$('#final_preview a').lightBox({fixedNavigation:true});
	});

	$('#myForm').submit(function() {
		var options = { success: function(responseText) { 
			var tr_id = -1;
			var permission = <?php echo $permission;?>;
			var current_user = "<?php echo $current_user;?>";
			$('#ifdoaudit').hide();
			$('#preview').hide();
			$("#table_content").empty();
			$("#table_content").append('<tr id="tr-1"><th style="display:none;">全选</th><th>题目编号</th><th>文字题目</th><th>更新时间</th><th>状态</th><th>出题人</th><th>审核人</th></tr>');
			var response = eval('(' + responseText + ')'); 
			var pagination = $('#pagination').val();
			if(pagination=="") pagination =20;
			var now_start = 0;
			var max  =parseInt(response.addon.length/pagination)+1;
			for(var i=0;i<response.addon.length;i++){
				$("#table_content").append(
					'<tr class="need_to_see" style="display:none;" id="tr'+i+'"><td style="display:none;"><input type="checkbox" value="" /></td>'+
						'<td>'+response.addon[i]["id"]+'</td>'+
						'<td>'+response.addon[i]["question"]+'</td>'+
						'<td>'+response.addon[i]["time_update"]+'</td>'+
						'<td>'+response.addon[i]["status"]+'</td>'+
						'<td>'+response.addon[i]["name_origin"]+'</td>'+
						'<td>'+response.addon[i]["name_audit"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["question_type"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_num"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_1"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_2"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_3"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_4"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_5"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_6"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_7"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["answer_8"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["difficulty"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["type"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["name_update"]+'</td>'+
						'<td class="hidden">'+response.addon[i]["icon"]+'</td></tr>'
					); 
				
			}

			$('#footer').show();
			var index_start = 0;
			var index_end = pagination;
			for(var x =index_start;x<index_end;x++ )
			{
				var name = '#tr'+x;
				$(name).show();			
			}

			$('#next').click(function(){
				for(var t= 0;t<response.addon.length;t++){
					var name = '#tr'+t;
					$(name).hide();
				}
				now_start =now_start+pagination;
				var end = now_start+pagination;
				if(end>=response.addon.length){
					end = response.addon.length;
					$('#next').hide();
				}
				for(var s=now_start;s<now_start+pagination;s++){
					var name = '#tr'+s;
					$(name).show();
				}

				$('#pre').show();
			});

			$('#pre').click(function(){
				for(var t= 0;t<response.addon.length;t++){
					var name = '#tr'+t;
					$(name).hide();
				}
				now_start = now_start-pagination;
				if(now_start<=0){
					now_start = 0;
					$('#pre').hide();
				}
				for(var s=now_start;s<now_start+pagination;s++){
					var name = '#tr'+s;
					$(name).show();
				}
				$('#next').show();
			});
			
			$('#redirect_direct').click(function(){
				for(var t= 0;t<response.addon.length;t++){
					var name = '#tr'+t;
					$(name).hide();
				}
				var direct_pagination = parseInt($('#redirect').val());
				now_start = (direct_pagination-1)*pagination;
				$('#next').show();
				$('#pre').show();
				if(direct_pagination>=max) {
					direct_pagination=max;
					$('#redirect').val(max);
					now_start = (max-1)*pagination;
					$('#next').hide();
				}
				if(direct_pagination<=1) {
					direct_pagination =1;
					$('#redirect').val(1);
					now_start = 0;
					$('#pre').hide();
				}
				var start_index = pagination*(direct_pagination-1);
				var end_index = pagination*direct_pagination;
				if(end_index >=response.addon.length) end_index=response.addon.length;
				for(var y =start_index;y<end_index;y++){
					var name = '#tr'+y;
					$(name).show();	
				}
			});
			
			$('#first').click(function(){
				for(var t= 0;t<response.addon.length;t++){
					var name = '#tr'+t;
					$(name).hide();
				}
				for(var y =0;y<pagination;y++){
					var name = '#tr'+y;
					$(name).show();	
				}
				now_start = 0;
				$('#next').show();
				$('#pre').hide();
			});

			$('#last').click(function(){
				for(var t= 0;t<response.addon.length;t++){
					var name = '#tr'+t;
					$(name).hide();
				}
				var start = (max-1)*pagination;
				for(var y =start;y<response.addon.length;y++){
					var name = '#tr'+y;
					$(name).show();	
				}
				now_start = (max-1)*pagination;
				$('#next').hide();
				$('#pre').show();
			});

			$('#pre_pre').click(function(){
				$('#pre_next').show();
				$('#edit_submit').hide();
				var values = new Array();
				var count = 1;
				var id = parseInt(tr_id)-1;
				if(id==0) $('#pre_pre').hide();
				var id_name = '#tr'+id;
				$(id_name).children().each(function(){
					values[count] = $(this).text();
					count++;
				});
				tr_id = $(id_name).attr('id');
				tr_id = tr_id.substring(2);
				var question_id = values[2];
				var question = values[3];
				var time_update = values[4];
				var question_type = values[8];
				var status = values[5];
				var name_origin = values[6];
				var answer_num = values[9];
				var answer_1 = values[10];
				var answer_2 = values[11];
				var answer_3 = values[12];
				var answer_4 = values[13];
				var answer_5 = values[14];
				var answer_6 = values[15];
				var answer_7 = values[16];
				var answer_8 = values[17];

				var difficult = values[18];
				var type = values[19];
				var name_update = values[20];

				if(status=='未审核'||status=='审核不通过')
				{
					<?php 
						if($permission==1||$permission==2)
						{
							echo '$("#ifdoaudit").show();';
							echo '$("#audit_type").attr("value",type);';
							echo '$("#audit_id").attr("value",question_id)';
						}

					?>
				}
				var last_person = '最后修改人:'+name_update;
				var last_time = '最后修改时间'+time_update;
				$('#lastmodifiedperson').text(last_person);
				$('#lastmodifiedtime').text(last_time);

				if(question_type==0){
					$('#type_label').text("文字题");
					$('#question_type_title').attr("value",0);
					$('#optionfour').show();
					$('#optioneight').hide();
					$('#question_image').hide();
				}else if(question_type==1){
					$('#type_label').text("图片题");
					$('#question_type_title').attr("value",1);
					$('#question_image').show();
					$('#optionfour').show();
					$('#optioneight').hide();
				}else if(question_type==2){
					$('#type_label').text("填空题");
					$('#question_type_title').attr("value",2);
					$('#optioneight').show();
					$('#optionfour').hide();
					$('#question_image').show();
				}else{
					$('#type_label').text("触摸题");
					$('#question_type_title').attr("value",3);
					$('#optionfour').show();
					$('#optioneight').hide();
					$('#question_image').show();
				}

				if(question_type==2){
					//$('#fill_optin_1').text(answer_1);
					$('#fill_optin_1').attr("value",answer_1);
					$('#fill_optin_2').attr("value",answer_2);
					$('#fill_optin_3').attr("value",answer_3);
					$('#fill_optin_4').attr("value",answer_4);
					$('#fill_optin_5').attr("value",answer_5);
					$('#fill_optin_6').attr("value",answer_6);
					$('#fill_optin_7').attr("value",answer_7);
					$('#fill_optin_8').attr("value",answer_8);
					$('#fill_optin_1').attr("disabled","disabled");
					$('#fill_optin_2').attr("disabled","disabled");
					$('#fill_optin_3').attr("disabled","disabled");
					$('#fill_optin_4').attr("disabled","disabled");	
					$('#fill_optin_5').attr("disabled","disabled");
					$('#fill_optin_6').attr("disabled","disabled");
					$('#fill_optin_7').attr("disabled","disabled");
					$('#fill_optin_8').attr("disabled","disabled");	
					var true_index = answer_num-1;
					var child_th = ':eq('+true_index+')';
					$('#true_num').children(child_th).attr("selected","selected");
					$('#true_num').attr("disabled","disabled");
				}else{
					$('#optin_1').attr("value",answer_1);
					$('#optin_2').attr("value",answer_2);
					$('#optin_3').attr("value",answer_3);
					$('#optin_4').attr("value",answer_4);	
					$('#optin_1').attr("disabled","disabled");
					$('#optin_2').attr("disabled","disabled");
					$('#optin_3').attr("disabled","disabled");
					$('#optin_4').attr("disabled","disabled");				
				}

				$('#upload_iamge').attr("disabled","disabled");	
				$('#question_id').attr("value",question_id);
				$('#question_name').attr("value",question);
				$('#question_name').attr("disabled","disabled");	
				var d_index = difficult-1;
				var d_child_th = ':eq('+d_index+')';
				$('#question_difficulty').children(d_child_th).attr("selected","selected");
				$('#question_difficulty').attr("disabled","disabled");
				var q_index = type-1;
				var q_child_th = ':eq('+q_index+')';
				$('#type').children(q_child_th).attr("selected","selected");
				$('#type').attr("disabled","disabled");
				if(permission==1||permission==2||current_user==name_origin){
					$('#deleteform').show();
					$('#edit_button').show();
				}
				$('#preview').show("slow");

			});

			$('#pre_next').click(function(){
				$('#pre_pre').show();
				$('#edit_submit').hide();
				var values = new Array();
				var count = 1;
				var id = parseInt(tr_id)+1;
				if(id==response.addon.length-1) $('#pre_next').hide();
				var id_name = '#tr'+id;
				$(id_name).children().each(function(){
					values[count] = $(this).text();
					count++;
				});
				tr_id = $(id_name).attr('id');
				tr_id = tr_id.substring(2);
				var question_id = values[2];
				var question = values[3];
				var time_update = values[4];
				var question_type = values[8];
				var status = values[5];
				var name_origin = values[6];
				var answer_num = values[9];
				var answer_1 = values[10];
				var answer_2 = values[11];
				var answer_3 = values[12];
				var answer_4 = values[13];
				var answer_5 = values[14];
				var answer_6 = values[15];
				var answer_7 = values[16];
				var answer_8 = values[17];

				var difficult = values[18];
				var type = values[19];
				var name_update = values[20];

				if(status=='未审核'||status=='审核不通过')
				{
					<?php 
						if($permission==1||$permission==2)
						{
							echo '$("#ifdoaudit").show();';
							echo '$("#audit_type").attr("value",type);';
							echo '$("#audit_id").attr("value",question_id)';
						}

					?>
				}
				var last_person = '最后修改人:'+name_update;
				var last_time = '最后修改时间'+time_update;
				$('#lastmodifiedperson').text(last_person);
				$('#lastmodifiedtime').text(last_time);

				if(question_type==0){
					$('#type_label').text("文字题");
					$('#question_type_title').attr("value",0);
					$('#optionfour').show();
					$('#optioneight').hide();
					$('#question_image').hide();
				}else if(question_type==1){
					$('#type_label').text("图片题");
					$('#question_type_title').attr("value",1);
					$('#question_image').show();
					$('#optionfour').show();
					$('#optioneight').hide();
				}else if(question_type==2){
					$('#type_label').text("填空题");
					$('#question_type_title').attr("value",2);
					$('#optioneight').show();
					$('#optionfour').hide();
					$('#question_image').show();
				}else{
					$('#type_label').text("触摸题");
					$('#question_type_title').attr("value",3);
					$('#optionfour').show();
					$('#optioneight').hide();
					$('#question_image').show();
				}

				if(question_type==2){
					//$('#fill_optin_1').text(answer_1);
					$('#fill_optin_1').attr("value",answer_1);
					$('#fill_optin_2').attr("value",answer_2);
					$('#fill_optin_3').attr("value",answer_3);
					$('#fill_optin_4').attr("value",answer_4);
					$('#fill_optin_5').attr("value",answer_5);
					$('#fill_optin_6').attr("value",answer_6);
					$('#fill_optin_7').attr("value",answer_7);
					$('#fill_optin_8').attr("value",answer_8);
					$('#fill_optin_1').attr("disabled","disabled");
					$('#fill_optin_2').attr("disabled","disabled");
					$('#fill_optin_3').attr("disabled","disabled");
					$('#fill_optin_4').attr("disabled","disabled");	
					$('#fill_optin_5').attr("disabled","disabled");
					$('#fill_optin_6').attr("disabled","disabled");
					$('#fill_optin_7').attr("disabled","disabled");
					$('#fill_optin_8').attr("disabled","disabled");	
					var true_index = answer_num-1;
					var child_th = ':eq('+true_index+')';
					$('#true_num').children(child_th).attr("selected","selected");
					$('#true_num').attr("disabled","disabled");
				}else{
					$('#optin_1').attr("value",answer_1);
					$('#optin_2').attr("value",answer_2);
					$('#optin_3').attr("value",answer_3);
					$('#optin_4').attr("value",answer_4);	
					$('#optin_1').attr("disabled","disabled");
					$('#optin_2').attr("disabled","disabled");
					$('#optin_3').attr("disabled","disabled");
					$('#optin_4').attr("disabled","disabled");				
				}

				$('#upload_iamge').attr("disabled","disabled");	
				$('#question_id').attr("value",question_id);
				$('#question_name').attr("value",question);
				$('#question_name').attr("disabled","disabled");	
				var d_index = difficult-1;
				var d_child_th = ':eq('+d_index+')';
				$('#question_difficulty').children(d_child_th).attr("selected","selected");
				$('#question_difficulty').attr("disabled","disabled");
				var q_index = type-1;
				var q_child_th = ':eq('+q_index+')';
				$('#type').children(q_child_th).attr("selected","selected");
				$('#type').attr("disabled","disabled");
				if(permission==1||permission==2||current_user==name_origin){
					$('#deleteform').show();
					$('#edit_button').show();
				}
				$('#preview').show("slow");

			});

			$('.need_to_see').click(function(){
				$('#final_preview').hide();
				tr_id = $(this).attr('id');
				tr_id = tr_id.substring(2);
				if(tr_id==-1) return false;
				$('#edit_submit').hide();
				var values = new Array();
				var count = 1;
				$(this).children().each(function(){
					values[count] = $(this).text();
					count++;
				});

				if(parseInt(tr_id)==0) $('#pre_pre').hide();
				else $('#pre_pre').show();
				if(parseInt(tr_id)==response.addon.length-1) $('#pre_next').hide();
				else $('#pre_next').show();
				var question_id = values[2];
				var question = values[3];
				var time_update = values[4];
				var name_origin = values[6];
				var question_type = values[8];
				var status = values[5];
				var answer_num = values[9];
				var answer_1 = values[10];
				var answer_2 = values[11];
				var answer_3 = values[12];
				var answer_4 = values[13];
				var answer_5 = values[14];
				var answer_6 = values[15];
				var answer_7 = values[16];
				var answer_8 = values[17];

				var difficult = values[18];
				var type = values[19];
				var name_update = values[20];
				var icon = values[21];
				$('#delete_type').attr('value',type);
				$('#delete_question_id').attr('value',question_id);

				$('#question_pre').attr('title',question);

				var img_path = '../uploads/'+icon+'.jpg';
				if(icon!=0) {
					$('#img_pre').attr('src',img_path);
					$('#question_pre').attr('href',img_path);
					$('#final_preview').show();
				}

				if(status=='未审核'||status=='审核不通过')
				{
					<?php 
						if($permission==1||$permission==2)
						{
							echo '$("#ifdoaudit").show();';
							echo '$("#audit_type").attr("value",type);';
							echo '$("#audit_id").attr("value",question_id)';
						}

					?>
				}

				var last_person = '最后修改人:'+name_update;
				var last_time = '最后修改时间'+time_update;
				$('#lastmodifiedperson').text(last_person);
				$('#lastmodifiedtime').text(last_time);

				if(question_type==0){
					$('#type_label').text("文字题");
					$('#question_type_title').attr("value",0);
					$('#optionfour').show();
					$('#optioneight').hide();
					$('#question_image').hide();
				}else if(question_type==1){
					$('#type_label').text("图片题");
					$('#question_type_title').attr("value",1);
					$('#question_image').show();
					$('#optionfour').show();
					$('#optioneight').hide();
				}else if(question_type==2){
					$('#type_label').text("填空题");
					$('#question_type_title').attr("value",2);
					$('#optioneight').show();
					$('#optionfour').hide();
					$('#question_image').show();
				}else{
					$('#type_label').text("触摸题");
					$('#question_type_title').attr("value",3);
					$('#optionfour').show();
					$('#optioneight').hide();
					$('#question_image').show();
				}

				if(question_type==2){
					//$('#fill_optin_1').text(answer_1);
					$('#fill_optin_1').attr("value",answer_1);
					$('#fill_optin_2').attr("value",answer_2);
					$('#fill_optin_3').attr("value",answer_3);
					$('#fill_optin_4').attr("value",answer_4);
					$('#fill_optin_5').attr("value",answer_5);
					$('#fill_optin_6').attr("value",answer_6);
					$('#fill_optin_7').attr("value",answer_7);
					$('#fill_optin_8').attr("value",answer_8);
					$('#fill_optin_1').attr("disabled","disabled");
					$('#fill_optin_2').attr("disabled","disabled");
					$('#fill_optin_3').attr("disabled","disabled");
					$('#fill_optin_4').attr("disabled","disabled");	
					$('#fill_optin_5').attr("disabled","disabled");
					$('#fill_optin_6').attr("disabled","disabled");
					$('#fill_optin_7').attr("disabled","disabled");
					$('#fill_optin_8').attr("disabled","disabled");	
					var true_index = answer_num-1;
					var child_th = ':eq('+true_index+')';
					$('#true_num').children(child_th).attr("selected","selected");
					$('#true_num').attr("disabled","disabled");
				}else{
					$('#optin_1').attr("value",answer_1);
					$('#optin_2').attr("value",answer_2);
					$('#optin_3').attr("value",answer_3);
					$('#optin_4').attr("value",answer_4);	
					$('#optin_1').attr("disabled","disabled");
					$('#optin_2').attr("disabled","disabled");
					$('#optin_3').attr("disabled","disabled");
					$('#optin_4').attr("disabled","disabled");				
				}

				$('#upload_iamge').attr("disabled","disabled");	
				$('#question_id').attr("value",question_id);
				$('#question_name').attr("value",question);
				$('#question_name').attr("disabled","disabled");	
				var d_index = difficult-1;
				var d_child_th = ':eq('+d_index+')';
				$('#question_difficulty').children(d_child_th).attr("selected","selected");
				$('#question_difficulty').attr("disabled","disabled");
				var q_index = type-1;
				var q_child_th = ':eq('+q_index+')';
				$('#type').children(q_child_th).attr("selected","selected");
				$('#type').attr("disabled","disabled");

				if(permission==1||permission==2||current_user==name_origin){
					$('#deleteform').show();
					$('#edit_button').show();
				}

				$('#preview').show("slow");


			});} }; 
		$(this).ajaxSubmit(options); 
		//var s = $('#date_start').val();
		//alert(s);
		//location.reload();
		return false;
	});
	
	$('#edit_button').click(function(){
		$('#fill_optin_1').removeAttr("disabled");
		$('#fill_optin_2').removeAttr("disabled");
		$('#fill_optin_3').removeAttr("disabled");
		$('#fill_optin_4').removeAttr("disabled");	
		$('#fill_optin_5').removeAttr("disabled");
		$('#fill_optin_6').removeAttr("disabled");
		$('#fill_optin_7').removeAttr("disabled");
		$('#fill_optin_8').removeAttr("disabled");	
		$('#optin_1').removeAttr("disabled");
		$('#optin_2').removeAttr("disabled");
		$('#optin_3').removeAttr("disabled");
		$('#optin_4').removeAttr("disabled");	
		$('#question_name').removeAttr("disabled");
		$('#question_difficulty').removeAttr("disabled");
		//$('#type').removeAttr("disabled");
		$('#true_num').removeAttr("disabled");
		$(this).hide();
		$('#upload_iamge').removeAttr("disabled");	
		$('#edit_submit').show();
	});

	$('#preview_id').submit(function() {
		$(this).ajaxSubmit(); 
		alert("修改成功");
		return false;
	}); 

	$('#close').click(function(){
		$('#preview').hide('slow');
		$('#ifdoaudit').hide('slow');
	});

	$('#auditForm').submit(function() {
		$(this).ajaxSubmit(); 
		alert("审核成功");
		return false;
	});

	$('#deleteform').submit(function() {
		var r=confirm("确认删除!?");
		if (r==true){
			$(this).ajaxSubmit();
		 	alert("删除成功!");
		 	location.reload();
		}
		else{
		  	alert("取消删除!");
		}

		return false;
	});

	$('#date_start').focus(function(){
		$(this).attr("readonly",'readonly');
	});

	$('#date_end').focus(function(){
		$(this).attr("readonly",'readonly');
	});

</script>
</body>

</html>