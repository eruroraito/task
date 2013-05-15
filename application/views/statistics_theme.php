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
	<style type="text/css">
		section.content{background-image:url(../pics/statics_bg.png);height:569px;padding-top:12px;}
		li.statistics{margin-top: 38px;}
		span.left{height:738px;}
		span.right{height:738px;}
		div.select{margin: 0 73px 8px 0px;text-align: right;}
	</style>
</head>
<body id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>

	<article id="body_container" >
		<section class="middle">
			<section class="content">
				<h3>题目题材</h3>
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
				<div class="select">				
					<label for="question_exam">选择题库</label>
					<select id="question_exam">
						<option value="0">审核题库</option>
						<option value="3">使用题库</option>
					</select>
				</div>
				<table id="audit">
					<tr>
						<th></th>
						<th>文字</th>
						<th></th>
						<th></th>
						<th>看图</th>
						<th></th>
						<th></th>
						<th>填空</th>
						<th></th>
						<th></th>
						<th>触摸</th>
						<th></th>
						<th></th>
					</tr>
					<tr class="odd">
						<td>题材类型</td>
						<td>新手</td>
						<td>熟练</td>
						<td>高手</td>
						<td>新手</td>
						<td>熟练</td>
						<td>高手</td>
						<td>新手</td>
						<td>熟练</td>
						<td>高手</td>
						<td>新手</td>
						<td>熟练</td>
						<td>高手</td>
					</tr>
					<?php 
						$i=1;
						foreach ($question_type_and_type as $q_type => $q_value) {
							$i++;
							$name = 'odd';
							if($i%2==0) $name = 'even';
							echo '<tr class='.$name.'>';
							echo '<td>'.$q_type.'</td>';
							foreach ($q_value as $key => $value) {
								echo '<td>'.$value[1]['audit'].'</td>';
								echo '<td>'.$value[2]['audit'].'</td>';
								echo '<td>'.$value[3]['audit'].'</td>';
							}
							echo '</tr>';
						}
					?>
				</table>
				<table id="use">
					<tr>
						<th></th>
						<th>文字</th>
						<th></th>
						<th></th>
						<th>看图</th>
						<th></th>
						<th></th>
						<th>填空</th>
						<th></th>
						<th></th>
						<th>触摸</th>
						<th></th>
						<th></th>
					</tr>
					<tr class="odd">
						<td>题材类型</td>
						<td>新手</td>
						<td>熟练</td>
						<td>高手</td>
						<td>新手</td>
						<td>熟练</td>
						<td>高手</td>
						<td>新手</td>
						<td>熟练</td>
						<td>高手</td>
						<td>新手</td>
						<td>熟练</td>
						<td>高手</td>
					</tr>
					<?php 
						$i=1;
						foreach ($question_type_and_type as $q_type => $q_value) {
							$i++;
							$name = 'odd';
							if($i%2==0) $name = 'even';
							echo '<tr class='.$name.'>';
							echo '<td>'.$q_type.'</td>';
							foreach ($q_value as $key => $value) {
								echo '<td>'.$value[1]['use'].'</td>';
								echo '<td>'.$value[2]['use'].'</td>';
								echo '<td>'.$value[3]['use'].'</td>';
							}
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
	$('#statistics').addClass('selected');
	$('#use').hide();
	$('#question_exam').change(function(){
		if($(this).val()=='0') $('#audit').show().siblings('table').hide();
		else $('#use').show().siblings('table').hide();
	});
</script>

</body>
</html>