<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>个人账号</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/header.css" />
	<style type="text/css">
		section.main{width:946px;height:469px;margin:0 auto; background:#c0c0c0;padding-top: 156px;}
		section.password {margin:0 auto;width:272px;height:286px;background:url(../pics/pass_edit.png) no-repeat;}
		form label.old,form label.new,form label.new_rept {width: 70px;height: 12px;line-height: 12px;display: block;margin:10px 0 5px 0;}
		form label.old{padding: 40px 0 0 0;}
		form input.login {width: 220px;height: 30px;border: 1px solid #d9d9d9;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius:5px;padding: 0 3px;}
		form span {color: #f00;}
		form input.submit {margin:20px 0 0 59px;font-weight:bold;color:#fff;background:url(../pics/canvas.png) 0 -52px; no-repeat;width:126px;height:40px;line-height:30px;border: none;}
		form {padding: 0 13px;}
		footer{width:948px;margin:10px auto -10px;text-align: center;}
		span.left{float:left;width:160px;height:680px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		span.right{float:right;width:160px;height:680px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
	</style>
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
			<a href="question_scan" id="question_scan" >浏览题目</a>
			<a href="statistics" id="statistics">统计数据</a>
			<a href="download" id="download">资料下载</a>
			<a href="personal" id="personal" class="selected">个人账号</a>
			<a href="system" id="system">系统</a>
		</nav>
	</header>
	<span class="left"></span>
	<span class="right"></span>
	<section id="body" class="main">
		<section class="password">
			<form action="personal/changeUserPassword" method="post">
	  			<label class="old" for="old_pass">原密码<span>*</span></label>
	  			<input class="login" type="password" autocomplete = "off" name="old_user_password" id="old_pass" placeholder="请输入原密码"  />
	 			<br />
	  			<label class="new" for="password">新密码<span>*</span></label>
	  			<input class="login" type="password" name="user_password" id="password" placeholder="请输入密码" />
	  			<br />
	  			<label class="new_rept" for="rept_password">新密码确认<span>*</span></label>
	  			<input class="login" type="password" name="password_confirm" id="rept_password" placeholder="请再次输入密码" />
	  			<br />
	  			<input class="submit" type="submit" value="保存" />
		    </form>
		</section>
	</section>
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>
<script type="text/javascript">
	
</script>
</body>
</html>