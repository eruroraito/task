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
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/header.css" />
	<style type="text/css">
		header{background-image:url(../pics/login_header.png);}
		section.body {width:946px;height:472px;margin:0 auto; background:url(../pics/login_bg.jpg) no-repeat;padding-top: 30px;position: relative;}
		h2 {color: #fff;font-size:30px;position: absolute;top:30px;left:45px;font-weight: normal;line-height: 30px;}
		img {width:100%;}	
		h1{padding-top:108px;font-size:20px; line-height:20px;color:#fff;}
		footer{width:948px;margin:10px auto -10px;text-align: center;}
		span.left{float:left;width:160px;height: 560px;background:url(../pics/home_side.jpg);}
		span.right{float:right;width:160px;height: 560px;background:url(../pics/home_side.jpg);}	
		section.login {position:absolute;top:50%;left:50%;background: #f1f1f1;width:360px;height:160px;border-radius: 5px; -moz-border-radius: 5px;  -webkit-border-radius: 5px;margin:-80px 0 0 -180px;border:1px solid #bcdefd; }
		h3 {background:#dcdcdc;height:25px;line-height:25px;padding-left:10px;border-radius: 5px; -moz-border-radius: 5px;  -webkit-border-radius: 5px;}
		input.login {width:220px;height:20px;border:solid 1px #c1c1c1;padding: 0 3px;}
		label.login {width:95px;height:20px;line-height:20px;text-align:right;display:inline-block;}
		span {color:#ff0000;}
		div.username {margin:25px 0 5px 0;}
		form{position: relative;}
		strong{position: absolute;top:82px;left:119px;color:#f00;font-size:14px;}
		input.submit {background: #0ca1cb;border-radius: 5px; -moz-border-radius: 5px;  -webkit-border-radius: 5px;width:75px;height:20px;border:1px solid #8e8f8f;color:#fff;margin :32px 0 0 265px;}
		input.error {border:1px solid #cc3300;}
		input.focus {border:1px solid #777;}
		
		#captcha_div{position: relative}
		#captcha{width:55px;height:21px;position: absolute;top:5px;left:199px;}
		#captcha_id{width:80px;position:absolute;top:5px;left:99px;}				
		#captcha_label{position: absolute;top:5px;left:1px;}
	</style>

</head>
<body>
<article id="container">
	<header>
		<div id="div_logout">
			<a href="login/logout" id="logout">注销</a>
		</div>
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
	  				<input class="login" type="password" name="user_password" id="password" placeholder="请输入密码" />
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

<script type="text/javascript">
	$('strong').hide();
	$('#loginform').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				location.href='home';
			}else{
				$('strong').text(response.detail).show();
			}
		} }; 
		$('#loginform').ajaxSubmit(options); 		
		return false;
	});
	$('#captcha').click(function(){
		var src ="login/captcha?"+(new Date().getTime());
		$(this).attr('src',src);
	});

	$('#username').focus(function(){
		$(this).addClass('focus');
		$(this).removeClass('error');
	});
	$('#username').blur(function(){
		$(this).removeClass('focus');
	});
	$('#password').focus(function(){
		$(this).addClass('focus');
		$(this).removeClass('error');
	});
	$('#password').blur(function(){
		$(this).removeClass('focus');
	});
	$('#captcha_id').focus(function(){
		$(this).addClass('focus');
		$(this).removeClass('error');
	});
	$('#captcha_id').blur(function(){
		$(this).removeClass('focus');
	});
	$('#submit').click(function(){
		if($('#username').val()==""){
			$('#username').addClass('error');
			$('strong').text("请输入用户名").show();
			return false;
		}else{
			$('#username').removeClass('error');
		}
		if($('#password').val()==""){
			$('#password').addClass('error');
			$('strong').text("请输入密码").show();
			return false;
		}else{
			$('#password').removeClass('error');
		}
		if($('#captcha_id').val()==""){
			$('#captcha_id').addClass('error');
			$('strong').text("请输入验证码").show();
			return false;
		}else{
			$('#captcha_id').removeClass('error');
		}
	});
</script>

</body>
</html>