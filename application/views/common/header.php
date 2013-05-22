<?php 
	echo '<header>';
	echo '<div id="div_logout">';
	echo	'<a href="login/logout" id="logout">注销</a>';
	echo '</div>';
	$user_realname = $this->session->userdata('user');
	echo '<span class="current_user">您好!'.$user_realname['user_realname'].'</span>';
	echo '<nav>';
	echo	'<a href="home" id="home">首页</a>';
	echo	'<a href="question" id="question">添加题目</a>';
	echo	'<a href="question_scan" id="question_scan">浏览题目</a>';
	echo	'<a href="statistics" id="statistics">统计数据</a>';
	echo	'<a href="download" id="download">资料下载</a>';
	echo	'<a href="personal" id="personal">个人账号</a>';
	echo	'<a href="system_log" id="system">系统</a>';
	echo '</nav>';
	echo '</header>';
?>