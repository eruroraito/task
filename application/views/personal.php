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
	<style type="text/css">
		section {margin:200px 0 0 500px;}
		form label.login {width: 70px;height: 12px;line-height: 12px;display: block;margin:20px 0 5px 0;}
		form input.login {width: 220px;height: 30px;border: 1px solid #d9d9d9;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius:5px;padding: 0 3px;}
		form span {color: #f00;}
		form input.submit {margin:20px 0 0 0px;font-weight:bold;color:#fff;background:url(../pics/sprite.png) -158px -222px; no-repeat;width:65px;height:30px;line-height:30px;border: none;}
		form {padding-left:13px;}
		section {border:2px solid #d9d9d9;width:260px;height:270px;}
		nav {text-align: center;}
		nav a{text-decoration: none; font-size:20px;margin:0 10px 0 0;}
		nav a:hover{text-decoration: underline;}
	</style>
</head>
<body>
<?php require_once 'header.php';?>
<article id="container">
	<section id="body">
		<form action="personal/changeUserPassword" method="post">
  			<label class="login" for="old_pass">原密码<span>*</span></label>
  			<input class="login" type="password" name="old_user_password" id="old_pass" placeholder="请输入原密码"  />
 			<br />
  			<label class="login" for="password">新密码<span>*</span></label>
  			<input class="login" type="password" name="user_password" id="password" placeholder="请输入密码" />
  			<br />
  			<label class="login" for="rept_password">新密码确认<span>*</span></label>
  			<input class="login" type="password" name="password_confirm" id="rept_password" placeholder="请再次输入密码" />
  			<br />
  			<input class="submit" type="submit" value="保存" />
	    </form>
	</section>
</article>
</body>
</html>