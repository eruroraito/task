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
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<link type="text/css" rel="stylesheet" href="../css/personal.css" />

</head>
<body>
<article id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>
	<section id="body" class="main">
		<section class="password">
			<form action="personal/changeUserPassword" method="post">
	  			<label class="old" for="old_pass">原密码<span>*</span></label>
	  			<input class="login" type="password" autocomplete = "off" name="old_user_password" id="old_pass" placeholder="请输入原密码"  />
	 			<br />
	  			<label class="new" for="password">新密码<span>*</span></label>
	  			<input class="login" type="password" autocomplete="off" name="user_password" id="password" placeholder="请输入密码" />
	  			<br />
	  			<label class="new_rept" for="rept_password">新密码确认<span>*</span></label>
	  			<input class="login" type="password" autocomplete="off" name="password_confirm" id="rept_password" placeholder="请再次输入密码" />
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
	$('#personal').addClass('selected');
</script>
</body>
</html>