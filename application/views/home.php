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
	<style type="text/css">
		nav {text-align: center;}
		nav a{text-decoration: none; font-size:20px;margin:0 10px 0 0;}
		nav a:hover{text-decoration: underline;}
	</style>
</head>
<body>

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
</article>
</body>
</html>