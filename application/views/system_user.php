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
	<link rel="shortcut icon" type="image/x-icon" href="../pics/favicon.ico" media="screen" />
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<link type="text/css" rel="stylesheet" href="../css/system_user.css" />

</head>
<body>
<article id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>
	<section class="middle">
		<ul>
			<li id="log" class="log"><a href="system_log">操作记录</a></li>		
			<?php 
				if($permission['group_id'] ==1){
					echo '<li id="submit" class="submit"><a href="system_sub">上架</a></li>';
					echo '<li id="off" class="off"><a href="system_off">下架</a></li>';
					echo '<li id="setting" class="setting"><a href="system_user" class="selected">账户设置</a></li>';	
					echo '<li id="add" class="add"><a href="system_add">添加类型</a></li>';
				}else if($permission['group_id'] ==2){
					echo '<li id="setting" class="setting"><a href="system_user" class="selected">账户设置</a></li>';	
				}else{

				}
			?>			
		</ul>
		<section class="content">
			<strong>错误</strong>
			<section id="setsec" class="setting">
				<h2>添加新用户</h2>
				<form action="system_user/addUser" method="post" id="addUserForm">
					<label for="user_name">用户名:</label>
					<input id="user_name" type="text" autocomplete="off" name="user_name" placeholder="请输入用户名" maxlength="10" />
					<br />
					<label for="user_realname">真实姓名:</label>
					<input id="user_realname" type="text" autocomplete="off" name="user_realname" placeholder="请输入昵称" maxlength="10" />
					<br />
					<label for="user_password">密码:</label>
					<input id="user_password" type="password" autocomplete="off" name="user_password" placeholder="请输入密码" maxlength="11" />
					<br />
					<label for="user_rept_password">确认密码:</label>
					<input id="user_rept_password" type="password" autocomplete="off" name="user_rept_password" placeholder="请再次输入密码" maxlength="11" />
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
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>
	<script type="text/javascript" src="../js/system_user.js"></script>
</body>
</html>