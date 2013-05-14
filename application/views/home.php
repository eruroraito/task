<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>首页</title>
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
		section {width:946px;height:480px;margin:0 auto; background:#cfcfcf;padding-top: 60px;position: relative;}
		section dl{width:711px;height:327px;margin: auto;background:url(../pics/home_middle.png);}
		section h3{color:#fff;font-size:18px;padding:12px 0 8px 40px;}
		section dt{font-size: 22px;line-height:75px;margin:10px 0 10px 50px;}
		section dt input{background:url(../pics/canvas.png) 0 -52px;color:#fff;position:absolute;width:123px;height:39px;right:224px;line-height:36px;padding-left:16px;text-decoration: none;border:none;text-indent: -10px;}
		section dt input:hover{background-position: 0 0;cursor:pointer;}
		#audit_pass{top:128px;}
		#audit_not_pass{top:212px;}
		#need_audit{top:295px;}
		a.more{position:absolute;bottom:168px;left:153px;color:#fff;}
		a.more:hover{cursor:pointer;text-decoration: underline;}
		h4{width:220px;margin:0 auto;margin-top:124px;}
		footer{width:948px;margin:10px auto -10px;text-align: center;}
		span.left{float:left;width:160px;height: 600px;background:url(../pics/home_side.jpg);}
		span.right{float:right;width:160px;height: 600px;background:url(../pics/home_side.jpg);}
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
			<a href="home" id="home" class="selected">首页</a>
			<a href="question" id="question">添加题目</a>
			<a href="question_scan" id="question_scan">浏览题目</a>
			<a href="statistics" id="statistics">统计数据</a>
			<a href="download" id="download">资料下载</a>
			<a href="personal" id="personal">个人账号</a>
			<a href="system" id="system">系统</a>
		</nav>
	</header>
	<span class="left"></span>
	<span class="right"></span>
	<section>
		<dl>
			<h3>题目管理</h3>
			<dt>审核通过的题目数量:<?php echo $user_detail['pass'];?>
				<form action="home/auditPass" method="post" >
					<input type="submit" value="点击查看" id="audit_pass" />
				</form>
			</dt>
			<dd></dd>
			<dt>审核未通过的题目数量:<?php echo $user_detail['not_pass'];?>
				<form action="home/notPass" method="post" >
					<input type="submit" value="点击查看" id="audit_not_pass" />
				</form>
			</dt>
			<dd></dd>
			<dt>需要审核的题目数量:<?php echo $user_detail['need'];?>
				<form action="home/needAudit" method="post" >
					<input type="submit" value="点击查看" id="need_audit" />
				</form>
			</dt>
			<dd></dd>
			<a class="more" href="">查看更多</a>
		</dl>	
		<h4>最后一次登录:<?php echo $user_detail['time'];?></h4>
	</section>
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
	
</article>
<script type="text/javascript">
	$('form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				location.href='question_scan';
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	});
</script>
</body>
</html>