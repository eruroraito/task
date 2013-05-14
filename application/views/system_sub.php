<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>系统</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../common/jquery.form.js"></script>
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/header.css" />
	<style type="text/css">
		span.left{float:left;width:160px;height:680px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		span.right{float:right;width:160px;height:680px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		section.middle {background:#cfcfcf;padding:55px;}
		section.content{background:url(../pics/system.png) no-repeat;width:853px;height:494px;margin:0 auto;position: relative;}
		section.middle ul{width:520px;margin:0 auto;}
		section.middle ul li{float:left;background:url(../pics/canvas.png) 0 -407px no-repeat;height:28px;width:115px;margin:-27px 0 0 10px;text-align: center;line-height: 28px;font-size:16px;font-weight:bold;}
		section.logsec,section.subsec,section.offsec{padding: 15px 15px;}
		table{width:100%;margin-top:10px;}
		table th{background:#4f81bd;border-bottom:5px solid #fff;height:24px;line-height:24px;padding:0 8px;color:#fff;font-weight:bold;}
		table td{border-bottom: 2px solid #fff;height:20px;line-height: 20px;padding:0 8px;}
		table tr.odd{background:#d0d8e8;}
		table tr.even{background:#e9edf4;}
		button {background: url(../pics/canvas.png) -959px -37px no-repeat;width:51px;height:22px;border:none;text-align: center;padding:0px;line-height: 22px;color:#fff;}
		button.selected,button:hover{background: url(../pics/canvas.png) -959px -3px no-repeat;}
		form{}
		input.touse{background: url(../pics/canvas.png) 0 -52px no-repeat;width:126px;height:40px;border:none;color:#fff;position:absolute;bottom:10px;right:33px}
		ul li a{color:#000;}
		ul li a:hover{text-decoration: underline;}
		input.first,input.last,input.pre,input.next,input.redirect,span.current,span.total{position:absolute;width:44px;bottom:22px;}
		input.first{left:20px;border:none;background:none;}
		input.last{left:246px;border:none;background:none;}
		input.pre{left:66px;border:none;background:none;width:54px;}
		input.next{left:192px;border:none;background:none;width:54px;}
		input.redirect{left:150px;border:none;background:none;}
		input.pagination{position:absolute;bottom:22px;width:20px;left:126px;height:12px;}
		span.current{left:438px;}
		span.total{left:484px;}
		footer{width:948px;margin:10px auto -10px;text-align: center;}
	</style>

</head>
<body>
<article id="container">
	<header>
		<div id="div_logout">
			<a href="login/logout" id="logout">注销</a>
		</div>
		<span class="current_user">您好!<?php echo $this->session->userdata('user')['user_realname']?></span>
		<nav>
			<a href="home" id="home" >首页</a>
			<a href="question" id="question">添加题目</a>
			<a href="question_scan" id="question_scan" >浏览题目</a>
			<a href="statistics" id="statistics">统计数据</a>
			<a href="download" id="download">资料下载</a>
			<a href="personal" id="personal">个人账号</a>
			<a href="system" id="system" class="selected">系统</a>
		</nav>
	</header>
	<span class="left"></span>
	<span class="right"></span>
	<section class="middle">
		<section class="content">
			<ul>
				<li id="log" class="log"><a href="system">操作记录</a></li>		
				<?php 
					if($permission['group_id'] ==1){
						echo '<li id="submit" class="submit"><a href="system_sub">上架</a></li>';
						echo '<li id="off" class="off"><a href="system_off">下架</a></li>';
						echo '<li id="setting" class="setting"><a href="system_user">账户设置</a></li>';	
					}else if($permission['group_id'] ==2){
						echo '<li id="setting" class="setting"><a href="system_user">账户设置</a></li>';	
					}else{

					}
				?>			
			</ul>
			<section id="subsec" class="subsec">
				<button id="selectall">全选</button>
				<button id="selectnone">全不选</button>
				<button id="selectreverse">反选</button>
				<form action="system/submitToUseExam" method="post" id="question_id" >
				<table>
					<tr>
						<th></th>
						<th>题库类型</th>
						<th>题目类型</th>
						<th>题目</th>
						<th>出题人</th>
						<th>审核人</th>
						<th>审核时间</th>
					</tr>
					<?php foreach ($submit['list'] as $key => $value) {
						if(mb_strlen($value['question'])>35) $value['question'] = mb_substr($value['question'], 0,35).'...';
						$clasname = "odd";
						if($key%2==0) $clasname = "even";
						echo '<tr class='.$clasname.'>';
						echo '<td><input type="checkbox" value='.$value['id'].' name='.'question[]'.' /></td>';
						echo '<td>'.$value['type_name'].'</td>';
						echo '<td>'.$value['question_type'].'</td>';
						echo '<td>'.$value['question'].'</td>';
						echo '<td>'.$value['name_origin'].'</td>';
						echo '<td>'.$value['name_audit'].'</td>';
						echo '<td>'.substr($value['time_update'],0,10).'</td>';
						echo '</tr>';
					}
					?>	
				</table>
				<input type="submit" id="submit_questions" value="上架" class="touse"/>
			</form>
			<form class="form_pagination" action="system_sub/first_page" method="post" id="first_page_form">
				<input type="hidden" name="pagination_first" value="first" />
				<input type="submit" class="first" value="[首页]" />
			</form>
			<form class="form_pagination" action="system_sub/pre_page" method="post" id="pre_page_form">
				<input type="hidden" name="pagination_pre" value="pre" />
				<input type="submit" class="pre" value="[上一页]" />
			</form>
			<form class="form_pagination" action="system_sub/redirect" method="post" id="redirect_form">
				<input class="pagination" name="pagination" /> 
				<input type="submit" class="redirect" value="[跳转]" />
			</form>
			<form class="form_pagination" action="system_sub/next_page" method="post" id="next_page_form">
				<input type="hidden" name="pagination_next" value="next" />
				<input type="submit" class="next" value="[下一页]" />
			</form>
			<form class="form_pagination" action="system_sub/last_page" method="post" id="last_page_form">
				<input type="hidden" name="pagination_last" value="last" />
				<input type="submit" class="last" value="[末页]" />
				<span class="current">第<?php echo $subindex;?>页</span>
				<span class="total">共<?php echo $submit['count'];?>页</span>
			</form>
			</section>
		</section>
	</section>
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>


<script type="text/javascript">
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

	$('#selectall').click(function(){
		var checkboxname = 'input[name='+'"question[]"]';
		if($(checkboxname)){
			$(checkboxname).attr('checked',true);
		}
	});

	$('#selectnone').click(function(){
		var checkboxname = 'input[name='+'"question[]"]';
		if($(checkboxname)){
			$(checkboxname).attr('checked',false);
		}
	});

	$('#selectreverse').click(function(){
		var checkboxname = 'input[name='+'"question[]"]';
		if($(checkboxname)){
			$(checkboxname).each(function(){
				$(this).attr('checked',!this.checked);					
			});			
		}
	});

	$('#question_id').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("提交到使用题库");
				window.location.reload();
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 

	$('button').click(function(){
		$('button').removeClass('selected');
		$(this).addClass('selected');
	});
</script>
</body>
</html>