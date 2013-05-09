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
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
<<<<<<< HEAD
	<link type="text/css" rel="stylesheet" href="../css/header.css" />
	<style type="text/css">
		section {width:946px;height:480px;margin:0 auto; background:#cfcfcf;padding-top: 60px;position: relative;}
		section dl{width:711px;height:327px;margin: auto;background:url(../pics/home_middle.png);}
		section h3{color:#fff;font-size:18px;padding:12px 0 8px 40px;}
		section dt{font-size: 22px;line-height:75px;margin:10px 0 10px 50px;}
		section dt a{background:url(../pics/canvas.png) 0 -52px;color:#fff;position:absolute;width:123px;height:39px;right:224px;line-height:36px;padding-left:16px;text-decoration: none;}
		section dt a:hover{background-position: 0 0;}
		#audit_pass{top:128px;}
		#audit_not_pass{top:212px;}
		#need_audit{top:295px;}
		a.more{position:absolute;bottom:168px;left:153px;color:#fff;}
		h4{width:220px;margin:0 auto;margin-top:124px;}
		footer{width:948px;margin:10px auto -10px;text-align: center;}
		span.left{float:left;width:160px;height: 600px;background:url(../pics/home_side.jpg);}
		span.right{float:right;width:160px;height: 600px;background:url(../pics/home_side.jpg);}
=======
	<style type="text/css">
		nav {text-align: center;}
		nav a{text-decoration: none; font-size:20px;margin:0 10px 0 0;}
		nav a:hover{text-decoration: underline;}
>>>>>>> 0c8e80f4f880af6b0917356900646d24ad02c9bd
	</style>
</head>
<body>

<<<<<<< HEAD
<article id="container">
	<header>
		<div id="div_logout">
			<a href="login/logout" id="logout">注销</a>
		</div>
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
			<dt>审核通过的题目数量:<?php echo $user_detail['pass'];?><a href="" id="audit_pass">点击查看</a></dt>
			<dd></dd>
			<dt>审核未通过的题目数量:<?php echo $user_detail['not_pass'];?><a href="" id="audit_not_pass">点击查看</a></dt>
			<dd></dd>
			<dt>需要审核的题目数量:<?php echo $user_detail['need'];?><a href="" id="need_audit">点击查看</a></dt>
			<dd></dd>
			<a class="more" href="">查看更多</a>
		</dl>	
		<h4>最后一次登录:<?php echo $user_detail['time'];?></h4>
	</section>
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
	
=======
<?php require_once 'header.php';?>

<article id="container">
	<section id="body">
	<!--
	<nav>
		<a href="home">首页</a>
		<a href="question">添加题目</a>
		<a href="question_scan">浏览题目</a>
		<a href="statistics">统计数据</a>
		<a href="download">资料下载</a>
		<a href="personal">个人账号</a>
		<a href="system">系统</a>
		<a href="login/logout">注销</a>
	</nav>
	-->

	<dl>
		<dt>审核通过的题目数量:<?php echo $user_detail['pass'];?></dt>
		<dd></dd>
		<dt>审核未通过的题目数量:<?php echo $user_detail['not_pass'];?></dt>
		<dd></dd>
		<dt>需要审核的题目数量:<?php echo $user_detail['need'];?></dt>
		<dd></dd>
		<dt>最后一次登录:<?php echo $user_detail['time'];?></dt>
		<dd></dd>
	</dl>	
	</section>
>>>>>>> 0c8e80f4f880af6b0917356900646d24ad02c9bd
</article>
</body>
</html>