<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>佳游网络任务系统</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../common/jquery.form.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="../pics/favicon.ico" media="screen" />
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<link type="text/css" rel="stylesheet" href="../css/login.css" />

</head>
<body>
<article id="container">
	<header>
		<h1>题库管理系统-网页版</h1>
	</header>
	<span class="left"></span>
	<span class="right"></span>
	<section id="body" class="body">
		<section class="login">
		<h3>登录</h3>
			<form action="login/authenticate" method="post" id="loginform">
				<div class="username">
	  				<label class="login" for="username">用户名<span>*</span>:</label>
	  				<input class="login" type="text" name="user_name" id="username" placeholder="请输入用户名"  />
	  			</div>
	  			<div class="password">
	  				<label class="login" for="password">密码<span>*</span>:</label>
	  				<input class="login" type="password" name="user_password" id="password" placeholder="请输入密码" maxlength="11" />
	  			</div>
	  			<div id="captcha_div">
	  				<label class="login" for="captcha" id="captcha_label">验证码<span>*</span>:</label>
	  				<input class="login" type="text" maxlength="5" id="captcha_id" name="captcha" placeholder="请输入验证码">
	  				<img id="captcha" src='<?php echo "login/captcha?".time();?>'>
	  			</div>
	  			<strong>错误</strong>
	  			<input class="submit" type="submit" value="登录" id="submit"/>
		    </form>
		</section>
	</section>
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>

<script type="text/javascript" src="../js/login.js"></script>

</body>
</html>