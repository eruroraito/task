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
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<link type="text/css" rel="stylesheet" href="../css/system_log.css" />

</head>
<body>
<article id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>
	<section class="middle">
		<ul>
			<li id="log" class="log"><a href="system_log" class="selected">操作记录</a></li>	
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
	$('#system').addClass('selected');
</script>
</body>
</html>