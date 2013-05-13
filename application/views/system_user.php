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
		span.left{float:left;width:160px;height:940px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		span.right{float:right;width:160px;height:940px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		section.middle {background:#cfcfcf;padding:55px;}
		section.content{background:url(../pics/system.png) no-repeat;width:853px;height:394px;margin:0 auto;padding-top:100px;}
		section.middle ul{width:520px;margin:0 auto;}
		section.middle ul li{float:left;background:url(../pics/canvas.png) 0 -407px no-repeat;height:28px;width:115px;margin:-27px 0 0 10px;text-align: center;line-height: 28px;font-size:16px;font-weight:bold;}
		button.selected,button:hover{background: url(../pics/canvas.png) -959px -3px no-repeat;}
		section.setting{background: url(../pics/add_user.png) no-repeat;width:292px;height:229px;margin:0 auto;}
		h2{margin: 0 auto;width:100px;padding-top:10px;color:#fff;}
		form label{width:58px;display: inline-block;margin:15px 0 0 30px;}
		input.add_user{background: url(../pics/canvas.png) -190px 0px no-repeat;width:71px;height:31px;border:none;color:#fff;margin-left:20px;}
		ul li a{color:#000;}
		ul li a:hover{text-decoration: underline;}
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
			<a href="personal" id="personal">个人账号</a>
			<a href="system" id="system" class="selected">系统</a>
		</nav>
	</header>
	<span class="left"></span>
	<span class="right"></span>
	<section class="middle">
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
		<section class="content">
			<section id="setsec" class="setting">
				<h2>添加新用户</h2>
				<form action="system/addUser" method="post" id="addUserForm">
					<label for="user_name">用户名:</label>
					<input id="user_name" type="text" name="user_name" placeholder="请输入用户名"/>
					<br />
					<label for="user_realname">昵称:</label>
					<input id="user_realname" type="text" name="user_realname" placeholder="请输入昵称"/>
					<br />
					<label for="user_password">密码:</label>
					<input id="user_password" type="password" autocomplete="off" name="user_password" placeholder="请输入密码"/>
					<br />
					<label for="user_rept_password">确认密码:</label>
					<input id="user_rept_password" type="password" name="user_rept_password" placeholder="请再次输入密码"/>
					<br />
					<label for="permission">权限</label>
					<select id="permission" name="permission">
						<option value="3">出题者</option>
						<?php 
							if($permission['group_id']==1){
								echo '<option value="2">审核员</option>';
							}
						?>
					</select> 
					<input type="submit"  value="创建" class="add_user" />
			    </form>
			</section>
		</section>	
	</section>
</article>
<script type="text/javascript">
	
</script>
</body>
</html>