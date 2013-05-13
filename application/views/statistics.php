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
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/header.css" />
	<style type="text/css">
		article {width:946px;height:550px;margin:0 auto; padding-top: 20px;position:relative;}
		span.left{float:left;width:160px;height: 670px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		span.right{float:right;width:160px;height: 670px;background:url(../pics/home_side.jpg) no-repeat #093d86;}
		footer{width:948px;margin:23px auto;text-align: center;}
	</style>
</head>
<body id="container">
	<header>
		<div id="div_logout">
			<a href="login/logout" id="logout">注销</a>
		</div>
		<nav>
			<a href="home" id="home">首页</a>
			<a href="question" id="question">添加题目</a>
			<a href="question_scan" id="question_scan">浏览题目</a>
			<a href="statistics" id="statistics" class="selected">统计数据</a>
			<a href="download" id="download" >资料下载</a>
			<a href="personal" id="personal">个人账号</a>
			<a href="system" id="system">系统</a>
		</nav>
	</header>
	<span class="left"></span>
	<span class="right"></span>
	<ul>
		<li>按照题库来分</li>
		<li>按照日期来分</li>
		<li>审核题库详情</li>
		<li>按照出题人</li>
		<li>按照题库类型</li>
		<li>按照难度类型来分</li>
		<li>按照题目类型来分</li>
		<li>按照题目题材来分</li>
		<li>图片题目统计信息</li>
	</ul>
	<article id="body_container">

		<section>
			<h3>按照题库来分</h3>
			<table>
				<tr>
					<th>审核题库中的题目总数</th>
					<th>使用题库中的题目总数</th>
				</tr>
				<tr>
					<td><?php echo $exam['audit'];?></td>	
					<td><?php echo $exam['use'];?></td>	
				</tr>
			</table>
		</section>

		<section>
			<h3>按照日期来分</h3>
			<table>
				<tr>
					<th></th>
					<th>新增加到审核题库中的题目总数</th>
					<th>新增加到使用题库中的题目总数</th>
				</tr>
				<tr>
					<td>今天</td>
					<td><?php echo $date['today_audit'];?></td>	
					<td><?php echo $date['today_use'];?></td>	
				</tr>
				<tr>
					<td>本周</td>
					<td><?php echo $date['week_audit_num'];?></td>	
					<td><?php echo $date['week_use_num'];?></td>	
				</tr>
				<tr>
					<td>本月</td>
					<td><?php echo $date['month_audit_num'];?></td>	
					<td><?php echo $date['month_use_num'];?></td>	
				</tr>
				<tr>
					<td>三个月内</td>
					<td><?php echo $date['three_month_audit_num'];?></td>	
					<td><?php echo $date['three_month_use_num'];?></td>	
				</tr>
				<tr>
					<td>半年内</td>
					<td><?php echo $date['half_year_audit_num'];?></td>	
					<td><?php echo $date['half_year_use_num'];?></td>	
				</tr>
				<tr>
					<td>今年</td>
					<td><?php echo $date['year_audit_num'];?></td>	
					<td><?php echo $date['year_use_num'];?></td>	
				</tr>
			</table>
		</section>

		<section>
			<h3>审核题库详情</h3>
			<table>
				<tr>
					<th>未审核的题目总数</th>
					<th>已审核通过的题目总数</th>
					<th>不通过的题目总数</th>
				</tr>
				<tr>
					<td><?php echo $audit_exam['need'];?></td>	
					<td><?php echo $audit_exam['pass'];?></td>	
					<td><?php echo $audit_exam['not_pass'];?></td>	
				</tr>
			</table>
		</section>

		<section>
			<h3>按照出题人</h3>
			<table>
				<tr>
					<th>人名</th>
					<th>未审核的题目总数</th>
					<th>已审核的题目总数</th>
					<th>不通过的题目总数</th>
				</tr>
				<?php 
					foreach ($origin_user_audit_exam as $key => $value) {
						echo '<tr>';
						echo '<td>'.$value['realname'].'</td>';
						echo '<td>'.$value['need'].'</td>';
						echo '<td>'.$value['pass'].'</td>';
						echo '<td>'.$value['not_pass'].'</td>';
						echo '</tr>';
					}
				?>
			</table>
		</section>

		<section>
			<h3>按照题库类型</h3>
			<table>
				<tr>
					<th>题库</th>
					<th>审核题库中的题目总数</th>
					<th>审核题库中待审核的题目总数</th>
					<th>审核题库中审核已通过的题目总数</th>
					<th>审核题库中审核未通过的题目总数</th>
					<th>使用题库中的题目总数</th>
				</tr>
				<?php 
					foreach ($details_in_all_exams as $key => $value) {
						echo '<tr>';
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

		<section>
			<h3>按照难度类型来分</h3>
			<table>
				<tr>
					<th>题目难度值</th>
					<th>题目总数(审核题库)</th>
					<th>待审核题目总数(审核题库)</th>
					<th>审核通过题目总数(审核题库)</th>
					<th>审核不通过题目总数(审核题库)</th>
					<th>使用题库中的题目总数</th>
				</tr>
				<tr>
					<td>新手</td>	
					<td><?php echo $difficluty[1]['audit_total'];?></td>	
					<td><?php echo $difficluty[1]['need'];?></td>	
					<td><?php echo $difficluty[1]['pass'];?></td>	
					<td><?php echo $difficluty[1]['not_pass'];?></td>	
					<td><?php echo $difficluty[1]['use'];?></td>	
				</tr>
				<tr>
					<td>熟练</td>	
					<td><?php echo $difficluty[2]['audit_total'];?></td>	
					<td><?php echo $difficluty[2]['need'];?></td>	
					<td><?php echo $difficluty[2]['pass'];?></td>	
					<td><?php echo $difficluty[2]['not_pass'];?></td>	
					<td><?php echo $difficluty[2]['use'];?></td>	
				</tr>
				<tr>
					<td>高手</td>	
					<td><?php echo $difficluty[3]['audit_total'];?></td>	
					<td><?php echo $difficluty[3]['need'];?></td>	
					<td><?php echo $difficluty[3]['pass'];?></td>	
					<td><?php echo $difficluty[3]['not_pass'];?></td>	
					<td><?php echo $difficluty[3]['use'];?></td>	
				</tr>
			</table>
		</section>

		<section>
			<h3>按照题目类型来分</h3>
			<table>
				<tr>
					<th>题目类型</th>
					<th>待审核的题目总数(审核题库)</th>
					<th>审核通过的题目总数(审核题库)</th>
					<th>审核未通过的题目总数(审核题库)</th>
					<th>题目总数(审核题库)</th>
					<th>使用题库中的题目总数</th>
				</tr>
				<tr>
					<td>文字题</td>	
					<td><?php echo $question_type[0]['need'];?></td>	
					<td><?php echo $question_type[0]['pass'];?></td>
					<td><?php echo $question_type[0]['not_pass'];?></td>	
					<td><?php echo $question_type[0]['audit_total'];?></td>
					<td><?php echo $question_type[0]['use'];?></td>
				</tr>
				<tr>
					<td>看图题</td>	
					<td><?php echo $question_type[1]['need'];?></td>	
					<td><?php echo $question_type[1]['pass'];?></td>
					<td><?php echo $question_type[1]['not_pass'];?></td>	
					<td><?php echo $question_type[1]['audit_total'];?></td>
					<td><?php echo $question_type[1]['use'];?></td>
				</tr>
				<tr>
					<td>填空题</td>	
					<td><?php echo $question_type[2]['need'];?></td>	
					<td><?php echo $question_type[2]['pass'];?></td>
					<td><?php echo $question_type[2]['not_pass'];?></td>	
					<td><?php echo $question_type[2]['audit_total'];?></td>
					<td><?php echo $question_type[2]['use'];?></td>	
				</tr>
				<tr>
					<td>触摸题</td>	
					<td><?php echo $question_type[3]['need'];?></td>	
					<td><?php echo $question_type[3]['pass'];?></td>
					<td><?php echo $question_type[3]['not_pass'];?></td>	
					<td><?php echo $question_type[3]['audit_total'];?></td>
					<td><?php echo $question_type[3]['use'];?></td>
				</tr>
			</table>
		</section>

		<section>
			<h3>按照题目题材来分</h3>

			<label for="question_exam">选择题库</label>
			<select id="question_exam">
				<option value="0">审核题库</option>
				<option value="3">使用题库</option>
			</select>
			
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
					<th>看图</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
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
					foreach ($question_type_and_type as $q_type => $q_value) {
						echo '<tr>';
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
					<th>看图</th>
					<th></th>
					<th></th>
				</tr>
				<tr>
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
					foreach ($question_type_and_type as $q_type => $q_value) {
						echo '<tr>';
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

		<section>
			<h3>图片题目统计信息</h3>
			<label for="question_exam_image">选择题库</label>
			<select id="question_exam_image">
				<option value="0">审核题库</option>
				<option value="3">使用题库</option>
			</select>
			<table id="pic_audit">
				<tr>
					<th>题库</th>
					<th>题目编号</th>
					<th>题目难度</th>
					<th>题库用途</th>
					<th>题目</th>
					<th>图片编号</th>
					<th>图片大小</th>
					<th>出题人</th>
					<th>最后修改人</th>
					<th>最后修改时间</th>
				</tr>
				<?php 
					foreach ($pic['audit'] as $key => $value) {
						echo '<tr>';
						echo '<td>'.$value['type'].'</td>';
						echo '<td>'.$value['id'].'</td>';
						echo '<td>'.$value['difficulty'].'</td>';
						echo '<td>'.$value['purpose'].'</td>';
						echo '<td>'.$value['question'].'</td>';
						echo '<td>'.$value['icon'].'</td>';
						echo '<td>'.''.'</td>';
						echo '<td>'.$value['name_origin'].'</td>';
						echo '<td>'.$value['name_update'].'</td>';
						echo '<td>'.$value['time_update'].'</td>';
						echo '</tr>';
					}		
				?>
			</table>
			<table id="pic_use">
				<tr>
					<th>题库</th>
					<th>题目编号</th>
					<th>题目难度</th>
					<th>题库用途</th>
					<th>题目</th>
					<th>图片编号</th>
					<th>图片大小</th>
					<th>出题人</th>
					<th>最后修改人</th>
					<th>最后修改时间</th>
				</tr>
				<?php 
					foreach ($pic['use'] as $key => $value) {
						echo '<tr>';
						echo '<td>'.$value['type'].'</td>';
						echo '<td>'.$value['id'].'</td>';
						echo '<td>'.$value['difficulty'].'</td>';
						echo '<td>'.$value['purpose'].'</td>';
						echo '<td>'.$value['question'].'</td>';
						echo '<td>'.$value['icon'].'</td>';
						echo '<td>'.''.'</td>';
						echo '<td>'.$value['name_origin'].'</td>';
						echo '<td>'.$value['name_update'].'</td>';
						echo '<td>'.$value['time_update'].'</td>';
						echo '</tr>';
					}		
				?>
			</table>
		</section>

		<footer>
			<p>沪ICP备08009851号</p>
			<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
		</footer>
	</article>

<script type="text/javascript">
	$('#body_container').children().eq(0).show().siblings().hide();
	$("li").click(function(){
		var num =  $(this).index();
	    $('#body_container').children().eq(num).show().siblings().hide();

	}); 
	$("#use").hide();
	$("#question_exam").change( 
		function() { 
			if($(this).val()==0)
			{
				$("#use").hide();
				$("#audit").show();				
			}else{
				$("#use").show();
				$("#audit").hide();	
			}
		} 
	); 

	$("#pic_use").hide();
	$("#question_exam_image").change( 
		function() { 
			if($(this).val()==0)
			{
				$("#pic_use").hide();
				$("#pic_audit").show();				
			}else{
				$("#pic_use").show();
				$("#pic_audit").hide();	
			}
		} 
	); 
</script>

</body>
</html>