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
	<link type="text/css" rel="stylesheet" href="../css/system_off.css" />

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
					echo '<li id="off" class="off"><a href="system_off" class="selected">下架</a></li>';
					echo '<li id="setting" class="setting"><a href="system_user">账户设置</a></li>';
					echo '<li id="add" class="add"><a href="system_add">添加类型</a></li>';	
				}else if($permission['group_id'] ==2){
					echo '<li id="setting" class="setting"><a href="system_user">账户设置</a></li>';	
				}else{

				}
			?>			
		</ul>
		<section class="content">
			<section id="offsec" class="offsec">
				<button id="selectall">全选</button>
				<button id="selectnone">全不选</button>
				<button id="selectreverse">反选</button>
				<form action="system_off/offSearch" method="post" id="offSearchForm" class="search">
					<label for="search_question">搜索题目</label>
					<input type="text" name="keyword" id="search_question" maxlength="10" />
					<input type="submit" value="搜索" class="search_submit" />
				</form>
				<form action="system_off/offUseExam" method="post" id="question_id" >
				<table>
					<tr>
						<th></th>
						<th>题库类型</th>
						<th>题目类型</th>
						<th>题目</th>
						<th>出题人</th>
						<th>上架人</th>
						<th>上架时间</th>
					</tr>
					<?php foreach ($off['list'] as $key => $value) {
						if(mb_strlen($value['question'])>35) $value['question'] = mb_substr($value['question'], 0,35).'...';
						$clasname = "odd";
						if($key%2==0) $clasname = "even";
						echo '<tr class='.$clasname.'>';
						echo '<td><input type="checkbox" value='.$value['id'].' name='.'question[]'.' /></td>';
						echo '<td>'.$value['type_name'].'</td>';
						echo '<td>'.$value['question_type'].'</td>';
						echo '<td>'.$value['question'].'</td>';
						echo '<td>'.$value['name_origin'].'</td>';
						echo '<td>'.$value['name_audit'].'</td>';
						echo '<td>'.substr($value['time_update'],0,10).'</td>';
						echo '</tr>';
					}
					?>	
				</table>
				<input type="submit" id="submit_questions" value="下架" class="touse"/>
			</form>
			<form class="form_pagination" action="system_off/first_page" method="post" id="first_page_form">
				<input type="hidden" name="pagination_first" value="first" />
				<input type="submit" class="first" value="[首页]" />
			</form>
			<form class="form_pagination" action="system_off/pre_page" method="post" id="pre_page_form">
				<input type="hidden" name="pagination_pre" value="pre" />
				<input type="submit" class="pre" value="[上一页]" />
			</form>
			<form class="form_pagination" action="system_off/redirect" method="post" id="redirect_form">
				<input class="pagination" name="pagination" /> 
				<input type="submit" class="redirect" value="[跳转]" />
			</form>
			<form class="form_pagination" action="system_off/next_page" method="post" id="next_page_form">
				<input type="hidden" name="pagination_next" value="next" />
				<input type="submit" class="next" value="[下一页]" />
			</form>
			<form class="form_pagination" action="system_off/last_page" method="post" id="last_page_form">
				<input type="hidden" name="pagination_last" value="last" />
				<input type="submit" class="last" value="[末页]" />
				<span class="current">第<?php echo $offindex['offindex'];?>页</span>
				<span class="total">共<?php echo $off['count'];?>页</span>
			</form>
			</section>
		</section>
	</section>
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>

<script type="text/javascript" src="../js/system_off.js"></script>
</body>
</html>