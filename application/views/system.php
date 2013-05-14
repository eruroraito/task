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
		span.left{float:left;width:160px;height:680px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		span.right{float:right;width:160px;height:680px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		section.middle {background:#cfcfcf;padding:55px;}
		section.content{background:url(../pics/system.png) no-repeat;width:853px;height:494px;margin:0 auto;}
		section.middle ul{width:520px;margin:0 auto;}
		section.middle ul li{float:left;background:url(../pics/canvas.png) 0 -407px no-repeat;height:28px;width:115px;margin:-27px 0 0 10px;text-align: center;line-height: 28px;font-size:16px;font-weight:bold;}
		section.logsec,section.subsec,section.offsec{padding: 15px 15px;}
		table{width:100%;margin-top:10px;}
		table th{background:#4f81bd;border-bottom:5px solid #fff;height:24px;line-height:24px;padding:0 8px;color:#fff;font-weight:bold;}
		table td{border-bottom: 2px solid #fff;height:20px;line-height: 20px;padding:0 8px;}
		table tr.odd{background:#d0d8e8;}
		table tr.even{background:#e9edf4;}
		button {background: url(../pics/canvas.png) -959px -37px no-repeat;width:51px;height:22px;border:none;text-align: center;padding:0px;line-height: 22px;color:#fff;}
		button.selected,button:hover{background: url(../pics/canvas.png) -959px -3px no-repeat;}
		div.touse{width:100%;text-align: center;}
		input.touse{background: url(../pics/canvas.png) 0 -52px no-repeat;width:126px;height:40px;border:none;color:#fff;margin:9px auto;}
		ul li a{color:#000;}
		ul li a:hover{text-decoration: underline;}
		footer{width:948px;margin:10px auto -10px;text-align: center;}
	</style>

</head>
<body>
<article id="container">
	<header>
		<div id="div_logout">
			<a href="login/logout" id="logout">注销</a>
		</div>
		<span class="current_user">您好!<?php echo $this->session->userdata('user')['user_realname']?></span>
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
			<section id="logsec" class="logsec">
				<table>
					<tr>
						<th>操作日志</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				<?php 
					foreach ($log as $key => $value) {
						$clasname = "odd";
						if($key%2==0) $clasname = "even";
						echo '<tr class='.$clasname.'>';
							echo '<td>'.$value['time_submit'].'</td>';
							echo '<td>'.$value['name_submit'].'</td>';
							echo '<td>提交</td>';
							echo '<td>'.$value['question_num'].'</td>';
							echo '<td>道题到使用题库中</td>';
						echo '</tr>';
					}
				?>
				</table>
			</section>
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