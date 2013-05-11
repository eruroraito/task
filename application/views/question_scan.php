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
	<link type="text/css" rel="stylesheet" href="../css/header.css" />
	<link rel="stylesheet" href="../common/jquery.lightbox-0.5.css" type="text/css">
	<style type="text/css">
		tr.selected{background:#f00;}
		section.que_fliter{width:926px;height:860px;margin:0 auto; background:#c0c0c0;padding: 10px;}
		span.left{float:left;width:160px;height:940px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		span.right{float:right;width:160px;height:940px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		form.myForm{background:url(../pics/scan_fliter.png) no-repeat;width:853px;height:144px;margin:0 auto;}
		form.myForm label{font-size:15px;margin-right:5px;font-weight: bold;}
		div.select{ float:left;margin:16px 16px 10px 60px;}
		#select_status{position: absolute;top:240px;left:283px;}
		#select_condition{position: absolute;top:241px;left:496px;}
		#select_order{position: absolute;top:240px;left:780px;}
		input.biuuu1,input.biuuu2{width:100px;}
		input.biuuu1{margin-right:65px;}
		input.submit{margin:66px 362px;background: url(../pics/canvas.png) 0 -52px no-repeat;width:126px;height:40px;border:none;color:#fff;font-size:20px;line-height: 20px;font-weight:bold;}
		section.scan{background: url(../pics/question_scan.png) no-repeat;width:551px;height:594px;margin-top: 50px;position:relative;float:left;}
		table.scan{width:527px;}
		table.scan,table.scan th,table.scan td {border:1px solid #fff;padding:0 3px;text-align: center;font-weight:bold;}
		table.scan{position:absolute;top:39px;left:11px;}
		table.scan tr.th th{background:#4f81bd;color:#fff;height:24px;line-height: 24px;}
		table.scan tr:hover{background:yellow;}
		table.scan tr td{height:24px;line-height: 24px;}
		table.scan tr.th th.first{width:50px;}
		table.scan tr.th th.second{width:160px;}
		table.scan tr.th th.third{width:80px;}
		table.scan tr.th th.fourth{width:65px;}
		table.scan tr.th th.fifth{width:65px;}
		table.scan tr.th th.sixth{width:65px;}
		.not_audit{background: #ff50a8;}
		.pass_audit{background: #ffd850;}
		.need_audit{background: #ffa0a0;}
		.use{background: #cceedd;}
		.delete{background: #c8c8ff;}
		table.scan tr.th{border-bottom: 5px solid #fff;}
		input.first,input.last,input.pre,input.next,input.redirect,span.current,span.total{position:absolute;width:44px;bottom:45px;}
		input.first{left:20px;border:none;background:none;}
		input.last{left:246px;border:none;background:none;}
		input.pre{left:66px;border:none;background:none;width:54px;}
		input.next{left:192px;border:none;background:none;width:54px;}
		input.redirect{left:150px;border:none;background:none;}
		span.current{left:438px;}
		span.total{left:484px;}
		table.footer{hieght:24px;line-height: 24px;width:523px;}
		table.footer tr th{border:1px solid #fff;text-align: center;}
		div.table_footer{border:1px solid #000;border-right: none;position: absolute;bottom:15px;left:10px;width:523px;height:26px;}
		section.question_scan{background: url(../pics/four.jpg) no-repeat;width:371px;height:605px;float:right;margin:42px 0 0 0px;position: relative;color:#4d2828;font-weight:bold;}
		h4{width:94px;margin:0 auto;font-weight:normal;font-size:16px;height:20px;line-height:20px;}
		input.pagination{position:absolute;bottom:45px;width:20px;left:126px;height:12px;}
		div.hidden{position:absolute;width:100px;height:20px;bottom:45px;left:126px;background: #fafafa;}
		div.answer1,div.answer2,div.answer3,div.answer4,div.answer5,div.answer6,div.answer7,div.answer8{position:absolute;text-align: center;}
		div.question{width:14em;height:110px;position:absolute;top:168px;left:90px;font-size:14px;line-height: 24px;}
		div.answer1{top:375px;left:67px;}
		div.answer2{top:375px;left:142px;}
		div.answer3{top:375px;left:217px;}
		div.answer4{top:375px;left:291px;}
		div.answer5{top:433px;left:67px;}
		div.answer6{top:433px;left:142px;}
		div.answer7{top:433px;left:217px;}
		div.answer8{top:433px;left:291px;}
		div.one,div.two,div.three,div.four{position:absolute;width:6em;text-align: center;}
		div.one{top:375px;left:77px;}
		div.two{top:375px;left:219px;}
		div.three{top:431px;left:77px;}
		div.four{top:431px;left:219px;}
		input.audit_form_pass_submit{position:absolute;left:32px;top:552px;background:url(../pics/canvas.png) 0 -288px no-repeat;width:96px;height:31px;border:none;color:#fff;line-height: 31px;font-weight:bold;padding-bottom:4px;}
		input.audit_not_pass,input.audit_edit{background:url(../pics/canvas.png) 0 -288px no-repeat;width:96px;height:31px;color:#fff;position: absolute;left:100px;top:552px;z-index: 9;line-height: 30px;border:none;font-weight:bold;padding-bottom:4px;}
		input.audit_not_pass{left:138px;}
		input.audit_edit{left:247px;}
		img.img_preview{position:absolute;top:200px;left:78px;width:216px;height:110px;}
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
<article id="container">
	<header>
		<div id="div_logout">
			<a href="login/logout" id="logout">注销</a>
		</div>
		<nav>
			<a href="home" id="home" >首页</a>
			<a href="question" id="question">添加题目</a>
			<a href="question_scan" id="question_scan" class="selected">浏览题目</a>
			<a href="statistics" id="statistics">统计数据</a>
			<a href="download" id="download">资料下载</a>
			<a href="personal" id="personal">个人账号</a>
			<a href="system" id="system">系统</a>
		</nav>
	</header>
	<span class="left"></span>
	<span class="right"></span>
	<section class="que_fliter">
		<form action="question_scan/getQuestionList" method="post" id="myForm" class="myForm">
			<div class="select">
				<label for="tk_type">题库类型:</label>
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
				<label for="question_type">题目类型:</label>
				<select id="question_type" name="question_type">
					<option value ="9999">全部</option>
					<option value ="0">文字题</option>
					<option value ="1">图片题</option>
					<option value ="2">填空题</option>
					<option value ="3">触摸题</option>
				</select>
			</div>
			<div class="select">
				<label for="difficult">难度:</label>
				<select id="difficult" name="difficult">
					<option value ="9999">全部</option>
					<option value ="1">新手</option>
					<option value ="2">熟练</option>
					<option value ="3">高手</option>
				</select>
			</div>
			<div class="select">
				<label for="user">出题人:</label>
				<select id="user" name="user">
					<option value ="all">全部</option>
					<?php foreach ($userlist as $key => $value) {
						//$option_value = $key+1;
						echo "<option value =".$value['user_name'].">".$value['user_realname']."</option>";
					}
					?>	
				</select>
			</div>
			<br />
			<div class="select last" >
				<label for="auditer">审核人:</label>
				<select id="auditer" name="auditer">
					<option value ="all">全部</option>
					<?php foreach ($auditerlist as $key => $value) {
						echo "<option value =".$value['user_name'].">".$value['user_realname']."</option>";
					}
					?>	
				</select>
			</div>
			<div class="select">
				<label for="date_start">起始日期:</label>
				<input id="date_start" type="text" class="biuuu1" name="date_start" />
				<label for="date_end">结束日期:</label>
				<input id="date_end" type="text" class="biuuu2" name="date_end" />
			</div>
			<br />
			<div class="select last" id="select_status">
				<label for="status">状态:</label>
				<select id="status" name="status">
					<option value ="9999">全部</option>
					<option value ="0">未审核</option>
					<option value ="1">审核通过</option>
					<option value ="2">审核不通过</option>
					<option value ="3">已上架</option>
					<option value ="-1">已删除</option>
				</select>
			</div>
			<div class="select" id="select_condition">				
				<select id="condition" name="condition">
					<option value ="1">文字题目</option>
					<option value ="2">图片编号</option>
					<option value ="3">题目编号</option>
				</select>
				<input id="search" name="search" />
			</div>
			<div class="select" id="select_order">
				<label for="order_status">排序方式:</label>
				<select id="order_item" name="order_item">
					<option value ="1">上次更新</option>
					<option value ="2">题目编号</option>
				</select>
				<select id="order" name="order">
					<option value ="1">升序</option>
					<option value ="2">降序</option>
				</select>
			</div>

			<input class="submit" type="submit" value="确定筛选" />
		</form>

		<section class="scan">
			<h4>筛选的题目</h4>
			<table class="scan">
				<tr class="th" id="tr0">
					<th class="first">编号</th>
					<th class="second">题目概要</th>
					<th class="third">更新时间</th>
					<th class="fourth">状态</th>
					<th class="fifth">出题人</th>
					<th class="sixth">审核人</th>
				</tr>
				<?php foreach ($scan['list'] as $key => $value) {
					$key = $key+1;
					$tr_id = 'tr'.$key;
					switch ($value['status']) {
							case 0:
								$value['status'] = "待审核";
								echo '<tr class="need_audit preview" id='.$tr_id.'>';
								break;
							case 1:							
								$value['status'] = "审核不通过";
								echo '<tr class="not_audit preview" id='.$tr_id.'>';
								break;
							case 2:						
								$value['status'] = "审核通过";
								echo '<tr class="pass_audit preview" id='.$tr_id.'>';
								break;
							case 3:							
								$value['status'] = "已上架";
								echo '<tr class="use preview" id='.$tr_id.'>';
								break;
							case -1:						
								$value['status'] = "已删除";
								echo '<tr class="delete preview" id='.$tr_id.'>';
								break;
							default:
								$value['status'] = "已删除";
								echo '<tr class="delete preview" id='.$tr_id.'>';
								break;
						}
						echo '<td>'.$value['id'].'</td>';
						$question_rogin = $value['question'];
						if(mb_strlen($value['question'])>10) $value['question'] = mb_substr($value['question'], 0,9).'...';
						echo '<td>'.$value['question'].'</td>';
						echo '<td>'.substr($value['time_update'],0,10).'</td>';
						echo '<td class="">'.$value['status'].'</td>';
						echo '<td>'.$value['name_origin'].'</td>';
						echo '<td>'.$value['name_audit'].'</td>';
						echo '<td style="display:none;">'.$value['question_type'].'</td>';
						echo '<td style="display:none;">'.$value['type'].'</td>';
						echo '<td style="display:none;">'.$value['answer_1'].'</td>';
						echo '<td style="display:none;">'.$value['answer_2'].'</td>';
						echo '<td style="display:none;">'.$value['answer_3'].'</td>';
						echo '<td style="display:none;">'.$value['answer_4'].'</td>';
						echo '<td style="display:none;">'.$value['answer_5'].'</td>';
						echo '<td style="display:none;">'.$value['answer_6'].'</td>';
						echo '<td style="display:none;">'.$value['answer_7'].'</td>';
						echo '<td style="display:none;">'.$value['answer_8'].'</td>';
						echo '<td style="display:none;">'.$question_rogin.'</td>';
						echo '<td style="display:none;">'.$value['icon'].'</td>';
					echo '</tr>';
				}?>
			</table>
			<form class="form_pagination" action="question_scan/first_page" method="post" id="first_page_form">
				<input type="hidden" name="pagination_first" value="first" />
				<input type="submit" class="first" value="[首页]" />
			</form>
			<form class="form_pagination" action="question_scan/pre_page" method="post" id="pre_page_form">
				<input type="hidden" name="pagination_pre" value="pre" />
				<input type="submit" class="pre" value="[上一页]" />
			</form>
			<form class="form_pagination" action="question_scan/redirect" method="post" id="redirect_form">
				<input class="pagination" name="pagination" /> 
				<input type="submit" class="redirect" value="[跳转]" />
			</form>
			<form class="form_pagination" action="question_scan/next_page" method="post" id="next_page_form">
				<input type="hidden" name="pagination_next" value="next" />
				<input type="submit" class="next" value="[下一页]" />
			</form>
			<form class="form_pagination" action="question_scan/last_page" method="post" id="last_page_form">
				<input type="hidden" name="pagination_last" value="last" />
				<input type="submit" class="last" value="[末页]" />
				<span class="current">第<?php echo $scan['pagination']?>页</span>
				<span class="total">共<?php echo $scan['count']?>页</span>
			</form>

			<div class="table_footer">
				<table class="footer">
					<tr>
						<th class="need_audit">待审核</th>
						<th class="not_audit">审核不通过</th>
						<th class="pass_audit">审核通过</th>
						<th class="use">已上架</th>
						<th class="delete" style="border-right:none;">已删除</th>
					</tr>
				</table>
			</div>
		</section>

		<section class="question_scan" id="new_question_scan">
			<div class="question" id="new_question">点击题目可以预览</div>
			<a title="" href="" id="img_a">
				<img class="img_preview" src="" width="216" height="110" id="img_img" />
			</a>
	    	<div id="new_four">
	    		<div class="one" id="as1"></div>
	    		<div class="two" id="as2"></div>
	    		<div class="three" id="as3"></div>
	    		<div class="four" id="as4"></div>
	    	</div>
	    	<div id="new_eight" style="display:none;">
		    	<div class="answer1" id="answer1"></div>
		    	<div class="answer2" id="answer2"></div>
		    	<div class="answer3" id="answer3"></div>
		    	<div class="answer4" id="answer4"></div>
		    	<div class="answer5" id="answer5"></div>
		    	<div class="answer6" id="answer6"></div>
		    	<div class="answer7" id="answer7"></div>
		    	<div class="answer8" id="answer8"></div>
	    	</div>
	    	<form action="question_scan/doAudit" method="post" id="audit_form_pass">
	    		<input type="hidden" name="audit" value="2" />
	    		<input type="hidden" name="type" id="audit_type" />
	    		<input type="hidden" name="id" id="audit_question_id" />
	    		<input type="submit" value="通过" class="audit_form_pass_submit">
	    	</form>
	    	<form action="question_edit" method="post" >
	    		<input type="hidden" name="type" id="audit_type_edit" />
	    		<input type="hidden" name="id" id="audit_question_id_deit" />
	    		<input type="submit" value="不通过" class="audit_not_pass">
	    		<input type="submit" value="修改/删除" class="audit_edit">
	    	</form>
			<div class="hidden"></div>
		</section>

	</section>

</article>

<script type="text/javascript">
	$(function() {
		$('#new_question_scan a').lightBox({fixedNavigation:true});
	});
	$('#first_page_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#first_page_form').ajaxSubmit(options); 		
		return false;
	}); 
	$('#pre_page_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#pre_page_form').ajaxSubmit(options); 		
		return false;
	}); 
	$('#next_page_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#next_page_form').ajaxSubmit(options); 		
		return false;
	}); 
	$('#last_page_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#last_page_form').ajaxSubmit(options); 		
		return false;
	}); 
	$('#redirect_form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#redirect_form').ajaxSubmit(options); 		
		return false;
	}); 

	$('#myForm').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				window.location.reload();
			}
		} }; 
		$('#myForm').ajaxSubmit(options); 		
		return false;
	}); 

	$('.preview').click(function(){
		$(this).addClass('selected').siblings().removeClass('selected');
		var data = new Array();
		$(this).children().each(function(i){
			data[i] = $(this).text();
		});
		var question_id = data[0];
		var question_type = data[6];
		var type = data[7];
		var answer = new Array();
		for(var i=1;i<=8;i++){
			answer[i] = data[i+7];
		}
		var question = data[16];
		var icon = data[17];
		if(icon!=0){
			var imagepath = '../uploads/'+icon+'.jpg';
			$('#img_a').attr('title',question);
			$('#img_a').attr('href',imagepath);
			$('#img_img').attr('src',imagepath);
		}else{
			$('#img_a').removeAttr('title');
			$('#img_a').removeAttr('href');
			$('#img_img').removeAttr('src');
		}
		if(question_type==2){
			$('#new_question_scan').css('background-image','url(../pics/eight.jpg)');
			$('#new_eight').show();
			$('#new_four').hide();
			for(var y=1;y<=8;y++){
				var answer_name = "#answer"+y.toString();
				$(answer_name).text(answer[y]);
			}
		}else{
			$('#new_question_scan').css('background-image','url(../pics/four.jpg)');
			$('#new_four').show();
			$('#new_eight').hide();
			for(var j=1;j<=4;j++){
				var answer_name = "#as"+j.toString();
				$(answer_name).text(answer[j]);
			}
		}
		$('#new_question').text(question);
		$('#audit_type').val(type);
		$('#audit_question_id').val(question_id);
		$('#audit_type_edit').val(type);
		$('#audit_question_id_deit').val(question_id);
		

	});
</script>
</body>

</html>