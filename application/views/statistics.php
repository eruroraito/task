<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>统计数据</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../common/jquery.form.js"></script>

	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<link type="text/css" rel="stylesheet" href="../css/statistics.css" />
</head>
<body id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>

	<article id="body_container" >
		<section class="middle">
			<section class="content" id="permission_content">
				<?php 
					if($permission['group_id']==1||$permission['group_id']==2){
						echo '<h3>按照题库来分</h3>';
						echo '<ul>';
							echo '<li class="statistics"><a href="statistics" >题库</a></li>';
							echo '<li class="statistics_date"><a href="statistics_date" >日期</a></li>';
							echo '<li class="statistics_auditexam"><a href="statistics_auditexam" >审核题库</a></li>';
							echo '<li class="statistics_origin"><a href="statistics_origin">出题人</a></li>';
							echo '<li class="statistics_type"><a href="statistics_type">题库类型</a></li>';
							echo '<li class="statistics_difficulty"><a href="statistics_difficulty">难度类型</a></li>';
							echo '<li class="statistics_questiontype"><a href="statistics_questiontype" >题目类型</a></li>';
							echo '<li class="statistics_theme"><a href="statistics_theme">题目题材</a></li>';
							echo '<li class="statistics_pics"><a href="statistics_pics">图片题目</a></li>';
						echo '</ul>';			
						echo '<table>';
							echo '<tr>';
								echo '<th>审核题库中的题目总数</th>';
								echo '<th>使用题库中的题目总数</th>';
							echo '</tr>';
							echo '<tr class="odd">';
								echo '<td>'.$exam['audit'].'</td>';
								echo '<td>'.$exam['use'].'</td>';
							echo '</tr>';
						echo '</table>';
					}else{
						echo '您没有相关权限';
					}
				?>
			</section>
		</section>
		<footer>
			<p>沪ICP备08009851号</p>
			<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
		</footer>
	</article>

<script type="text/javascript">
	$('#statistics').addClass('selected');
</script>

</body>
</html>