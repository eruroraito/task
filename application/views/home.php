<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>首页</title>
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
	<link type="text/css" rel="stylesheet" href="../css/home.css" />
	<style type="text/css">

	</style>
</head>
<body>

<article id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>
	<section>
		<dl>
			<h3>题目管理</h3>
			<dt>审核通过的题目数量:<?php echo $user_detail['pass'];?>
				<form action="home/auditPass" method="post" >
					<input type="submit" value="点击查看" id="audit_pass" />
				</form>
			</dt>
			<dd></dd>
			<dt>审核未通过的题目数量:<?php echo $user_detail['not_pass'];?>
				<form action="home/notPass" method="post" >
					<input type="submit" value="点击查看" id="audit_not_pass" />
				</form>
			</dt>
			<dd></dd>
			<dt>需要审核的题目数量:<?php echo $user_detail['need'];?>
				<form action="home/needAudit" method="post" >
					<input type="submit" value="点击查看" id="need_audit" />
				</form>
			</dt>
			<dd></dd>
			<a class="more" href="">查看更多</a>
		</dl>	
		<h4>最后一次登录:<?php echo $user_detail['time'];?></h4>
	</section>
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
	
</article>
<script type="text/javascript">
	$('#home').addClass('selected');
	$('form').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				location.href='question_scan';
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	});
</script>
</body>
</html>