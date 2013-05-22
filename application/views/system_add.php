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
	<link type="text/css" rel="stylesheet" href="../css/system_add.css" />

</head>
<body>
<div class="cover" id="cover"></div>
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
					echo '<li id="off" class="off"><a href="system_off">下架</a></li>';
					echo '<li id="setting" class="setting"><a href="system_user">账户设置</a></li>';	
					echo '<li id="add" class="add selected"><a href="system_add">添加类型</a></li>';
				}else if($permission['group_id'] ==2){
					echo '<li id="setting" class="setting"><a href="system_user">账户设置</a></li>';	
				}else{

				}
			?>			
		</ul>
		<section class="content" id="sec_content">
			<div class="edit" id="edit">
				<form action="system_add/editType" method="post" class="edit" id="editTypeForm">
					<input type="hidden" name="type_id" id="type_id"/>
					<label for="exam_type">题库类型</label>
					<input type="text" id="exam_type" name="type_name" /><br />
					<label for="start_section">开始章节</label>
					<input type="text" id="start_section" name="section" /><br /> 
					<input type="submit" value="保存" class="edit_submit" />
				</form>
				<button class="close" id="close">关闭</button>
			</div>
			<div class="edit_status" id="change_status">
				<form action="system_add/changeStatus" method="post" class="edit" id="changeStatusForm">
					<strong>确定要将以下题库置为无效?</strong>
					<input type="text" name="type_id" id="type_id_status" style="display:none;"/>
					<input type="text" name="status" id="type_status" style="display:none;"/>
					<label for="exam_type_status" id="label_type">题库类型</label>
					<input type="hidden" id="exam_type_status" name="type_name" /><br />
					<label for="start_section_status" id="label_section">开始章节</label>
					<input type="hidden" id="start_section_status" name="section"  /><br /> 
					<input type="submit" value="确定" class="edit_submit_status" />
				</form>
				<button class="close_status" id="close_status">取消</button>
			</div>
			<div class="delete" id="delete_div">
				<form action="system_add/deleteType" method="post" class="edit" id="deleteForm">
					<strong>确定要删除以下题库?</strong>
					<input type="text" name="type_id" id="delete_type_id" style="display:none;"/>
					<label for="delete_type" id="delete_label_type">题库类型</label><br />
					<label for="delete_start_section" id="delete_label_section">开始章节</label><br /> 
					<label for="user_password">密码:</label>
					<input type="password" name="user_password" id="user_password" placeholder="请输入账户密码" maxlength="11" />
					<input type="submit" value="确定" class="delete_submit_status" />
				</form>
				<button class="delete_status" id="delete_close">取消</button>
			</div>
			<section  class="add">
				<table>
					<tr>
						<th>编号</th>
						<th>题库类型</th>
						<th>开始章节</th>
						<th>题目数量</th>
						<th>创建时间</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
					<?php foreach ($type_list as $key => $value) {
						if($value['type_id']>2999) continue;
						if($value['visible']==0) continue;
						$clasname = "odd";
						if($key%2==0) $clasname = "even";
						$value_status  = '';
						$td_color = 'red';
						if($value['status']==1) {
							$value_status = '有效';
							$td_color = 'green';
						}
						else $value_status = '无效';
						echo '<tr class='.$clasname.'>';
						echo '<td>'.$value['type_id'].'</td>';
						echo '<td>'.$value['type_name'].'</td>';
						echo '<td>'.$value['section'].'</td>';
						echo '<td>'.$num[$value['type_id']].'</td>';
						echo '<td>'.$value['update_time'].'</td>';
						echo '<td class='.$td_color.'>'.$value_status.'</td>';
						echo '<td style="display:none;">'.$value['status'].'</td>';
						if($status[$value['type_id']]==0) {
							if($value['status']==1) echo '<td><button class="change_status edit">置为无效</button><button class="table_edit edit">修改</button></td>';
							else echo '<td><button class="change_status edit">置为有效</button><button class="table_edit edit">修改</button><button class="table_delete  edit">删除</button></td>';
						}else{
							if($value['status']==1) echo '<td><button class="change_status edit">置为无效</button><button class="table_edit edit">修改</button></td>';
							else echo '<td><button class="change_status edit">置为有效</button><button class="table_edit edit">修改</button></td>';
						}
						echo '</tr>';
					}
					?>
					<tr class="add">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><button id="button_add" class="edit">新增</button></td>
					</tr>
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
	$('#editTypeForm').submit(function() {
		if($('#exam_type').val()=='') {
			alert('题库类型不能为空');
			return false;
		}
		if($('#start_section').val()=='') {
			alert('开始章节不能为空');
			return false;
		}
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("成功");
				window.location.reload();
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 

	$('#changeStatusForm').submit(function() {
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("更改成功");
				window.location.reload();
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 

	var middle_height = ($('#sec_content').height()+190)+'px';
	$('span').height(middle_height);
	var docHeight = ($('#sec_content').height()+330)+'px'; 
	$('#cover').height(docHeight);
	$('#cover').hide();
	$('#edit').hide();
	$('#delete_div').hide();
	$('#change_status').hide();
	$('.change_status').click(function(){
		var data = new Array();
		$(this).parent().siblings().each(function(i){
			data[i] = $(this).text();
		});
		$('#type_id_status').val(data[0]);
		$('#exam_type_status').val(data[1]);
		$('#start_section_status').val(data[2]);
		$('#type_status').val(data[6]);
		if(data[6]==0) {
			$('strong').text('确定要将以下题库置为有效?');			
		}else{
			$('strong').text('确定要将以下题库置为无效?');	
		}
		var text = '题库类型:'+data[1];
		var text2 = '题库类型:'+data[2];
		$('#label_type').text(text);
		$('#label_section').text(text2);
		$('#cover').show('slow');
		$('#change_status').show('slow');
	});
	$('#close_status').click(function(){
		$('#cover').hide('slow');
		$('#change_status').hide('slow');
	});
	$('.table_edit').click(function(){
		var data = new Array();
		$(this).parent().siblings().each(function(i){
			data[i] = $(this).text();
		});
		$('#type_id').val(data[0]);
		$('#exam_type').val(data[1]);
		$('#start_section').val(data[2]);
		$('#cover').show('slow');
		$('#edit').show('slow');
	});
	$('#button_add').click(function(){
		$('#type_id').val("0");
		$('#exam_type').val('');
		$('#start_section').val('');
		$('#cover').show('slow');
		$('#edit').show('slow');
	});
	$('#close').click(function(){
		$('#cover').hide('slow');
		$('#edit').hide('slow');
	});

	$('.table_delete').click(function(){
		var data = new Array();
		$(this).parent().siblings().each(function(i){
			data[i] = $(this).text();
		});
		$('#delete_type_id').val(data[0]);
		$('#delete_label_type').text('题库类型:'+data[1]);
		$('#delete_label_section').text('开始章节:'+data[2]);
		$('#cover').show('slow');
		$('#delete_div').show('slow');
	});
	$('#delete_close').click(function(){
		$('#cover').hide('slow');
		$('#delete_div').hide('slow');
	});
	$('#deleteForm').submit(function() {
		if($('#user_password').val()=='') {
			alert('密码不能为空');
			return false;
		}
		var options = { success: function(responseText) { 
			var response = eval('(' + responseText + ')'); 
			if(response.success) {
				alert("删除成功");
				window.location.reload();
			}else{
				alert(response.detail);
				$('#user_password').val('');
			}
		} }; 
		$(this).ajaxSubmit(options); 		
		return false;
	}); 
</script>
</body>
</html>