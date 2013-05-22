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
	<link rel="shortcut icon" type="image/x-icon" href="../pics/favicon.ico" media="screen" />
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<link type="text/css" rel="stylesheet" href="../css/statistics.css" />
	<style type="text/css">
		section.content{background:#fff;padding-top:12px;border-radius: 5px; -moz-border-radius: 5px;  -webkit-border-radius: 5px;}
		li.statistics{margin-top: 38px;}
		span.left{height:746px;}
		span.right{height:746px;}
	</style>
</head>
<body id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>

	<article id="body_container" >
		<section class="middle">
			<section class="content" id="section_content">
				<h3>按照题库类型</h3>
				<ul>
					<li class="statistics"><a href="statistics" >题库</a></li>
					<li class="statistics_date"><a href="statistics_date" >日期</a></li>
					<li class="statistics_auditexam"><a href="statistics_auditexam" >审核题库</a></li>
					<li class="statistics_origin"><a href="statistics_origin">出题人</a></li>
					<li class="statistics_type"><a href="statistics_type">题库类型</a></li>
					<li class="statistics_difficulty"><a href="statistics_difficulty">难度类型</a></li>
					<li class="statistics_questiontype"><a href="statistics_questiontype" >题目类型</a></li>
					<li class="statistics_theme"><a href="statistics_theme">题目题材</a></li>
					<li class="statistics_pics"><a href="statistics_pics">图片题目</a></li>
				</ul>				
				<table id="table_type">
					<tr>
						<th>题库</th>
						<th>审核题库题目总数</th>
						<th>待审核的题目总数</th>
						<th>审核通过题目总数</th>
						<th>审核未通过题目总数</th>
						<th>上架题目总数</th>
					</tr>
					<?php 
						$i=0;
						foreach ($details_in_all_exams as $key => $value) {
							if($value['name']=='not_active') continue;
							$name='odd';
							$i++;
							if($i%2!=0) $name='even';
							echo '<tr class='.$name.'>';
							echo '<td>'.$value['name'].'</td>';
							$total_questions_in_audit_exam = $value['need']+$value['pass']+$value['not_pass'];
							echo '<td>'.$total_questions_in_audit_exam.'</td>';
							echo '<td>'.$value['need'].'</td>';
							echo '<td>'.$value['pass'].'</td>';
							echo '<td>'.$value['not_pass'].'</td>';
							echo '<td>'.$value['use'].'</td>';
							echo '</tr>';
						}
					?>
				</table>
			</section>
		</section>
		<footer>
			<p>沪ICP备08009851号</p>
			<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
		</footer>
	</article>

<script type="text/javascript">
	var section_content_height = ($('#table_type').height()+30)+'px';
	$('#section_content').height(section_content_height);

	var middle_height = ($('#section_content').height()+170)+'px';
	$('span').height(middle_height);

	$('#statistics').addClass('selected');
</script>

</body>
</html>