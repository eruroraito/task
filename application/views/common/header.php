<header>
	<div id="div_logout">
		<a href="login/logout" id="logout">注销</a>
	</div>
	<span class="current_user">您好!<?php echo $this->session->userdata('user')['user_realname']?></span>
	<nav>
		<a href="home" id="home">首页</a>
		<a href="question" id="question">添加题目</a>
		<a href="question_scan" id="question_scan">浏览题目</a>
		<a href="statistics" id="statistics">统计数据</a>
		<a href="download" id="download">资料下载</a>
		<a href="personal" id="personal">个人账号</a>
		<a href="system_log" id="system">系统</a>
	</nav>
</header>