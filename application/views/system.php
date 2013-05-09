<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>个人账号</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../common/jquery.form.js"></script>
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<style type="text/css">
		span.name_submit{color:red;}
		nav {text-align: center;}
		nav a{text-decoration: none; font-size:20px;margin:0 10px 0 0;}
		nav a:hover{text-decoration: underline;}
	</style>

</head>
<body>
<?php require_once 'header.php';?>
<article id="container">

	<ul>
		<li id="log">操作记录</li>	
		<?php 
			if($permission['group_id'] ==1){
				echo '<li id="submit">提交到使用题库</li>';
				echo '<li id="off">下架</li>';
				echo '<li id="setting">账户设置</li>';	
			}else if($permission['group_id'] ==2){
				echo '<li id="setting">账户设置</li>';	
			}else{

			}
		?>			
	</ul>

	<section id="subsec">
		<button id="selectall">全选</button>
		<button id="selectnone">全不选</button>
		<button id="selectreverse">反选</button>
		<form action="system/submitToUseExam" method="post" id="question_id" >
		<table>
			<tr>
				<th></th>
				<th>题库类型</th>
				<th>题目类型</th>
				<th>题目</th>
				<th>审核状态</th>
				<th>审核人</th>
			</tr>
			<?php foreach ($submit as $key => $value) {
				echo '<tr>';
				echo '<th><input type="checkbox" value='.$value['id'].' name='.'question_'.$value['type'].'[]'.' /></th>';
				echo '<th>'.$value['type_name'].'</th>';
				echo '<th>'.$value['question_type'].'</th>';
				echo '<th>'.$value['question'].'</th>';
				echo '<th>'.$value['status'].'</th>';
				echo '<th>'.$value['name_audit'].'</th>';
				echo '</tr>';
			}
			?>	
		</table>
		<input type="submit" id="submit_questions" value="更新到使用题库" />
	</form>
	</section>

	<section id="offsec">
		<button id="offselectall">全选</button>
		<button id="offselectnone">全不选</button>
		<button id="offselectreverse">反选</button>
		<form action="system/offUseExam" method="post" id="off_question_id" >
		<table>
			<tr>
				<th></th>
				<th>题库类型</th>
				<th>题目类型</th>
				<th>题目</th>
			</tr>
			<?php foreach ($off as $key => $value) {
				echo '<tr>';
				echo '<th><input type="checkbox" value='.$value['id'].' name='.'uestion_'.$value['type'].'[]'.' /></th>';
				echo '<th>'.$value['type_name'].'</th>';
				echo '<th>'.$value['question_type'].'</th>';
				echo '<th>'.$value['question'].'</th>';
				echo '</tr>';
			}
			?>	
		</table>
		<input type="submit" id="off_questions" value="下架" />
	</form>
	</section>

	<section id="logsec">
		<h3>操作日志</h3>
		<?php 
			foreach ($log as $key => $value) {
				echo '<time>'.$value['time_submit'].'</time>';
				echo '<span class="name_submit">'.$value['name_submit'].'</span>';
				echo '提交';
				echo '<span>'.$value['question_num'].'</span>';
				echo '道题到使用题库中';
				echo '<br />';
			}
		?>
	</section>

	<section id="setsec" class="setting">
		<h2>添加新用户</h2>
		<form action="system/addUser" method="post" id="addUserForm">
			<label for="user_name">用户名</label>
			<input id="user_name" type="text" name="user_name" placeholder="请输入用户名"/>
			<br />
			<label for="user_realname">昵称</label>
			<input id="user_realname" type="text" name="user_realname" placeholder="请输入昵称"/>
			<br />
			<label for="user_password">密码</label>
			<input id="user_password" type="password" name="user_password" placeholder="请输入密码"/>
			<br />
			<label for="user_rept_password">确认密码</label>
			<input id="user_rept_password" type="password" name="user_rept_password" placeholder="请再次输入密码"/>
			<br />
			<select id="permission" name="permission">
				<option value="3">出题者</option>
				<?php 
					if($permission['group_id']==1){
						echo '<option value="2">审核员</option>';
					}
				?>
			</select> 
			<input type="submit"  value="创建" />
	    </form>
	</section>
</article>


<script type="text/javascript">
	$('#subsec').hide();
	$('#setsec').hide();
	$('#offsec').hide();
	$('#submit').click(function(){
		$('#subsec').show();
		$('#logsec').hide();
		$('#setsec').hide();
		$('#offsec').hide();
	});

	$('#setting').click(function(){
		$('#setsec').show();
		$('#logsec').hide();
		$('#subsec').hide();
		$('#offsec').hide();
	});

	$('#log').click(function(){
		$('#logsec').show();
		$('#subsec').hide();
		$('#setsec').hide();
		$('#offsec').hide();
	});

	$('#off').click(function(){
		$('#offsec').show();
		$('#logsec').hide();
		$('#subsec').hide();
		$('#setsec').hide();
	});

	$('#addUserForm').submit(function() {
		$(this).ajaxSubmit(); 
		alert("添加成功");
		return false;
	}); 

	$('#selectall').click(function(){

		for(var i=1;i<=20;i++){
			var checkboxname = 'input[name='+'"question_'+i+'[]"]';
			if($(checkboxname)){
				$(checkboxname).attr('checked',true);
			}
		}
	});

	$('#selectnone').click(function(){

		for(var i=1;i<=20;i++){
			var checkboxname = 'input[name='+'"question_'+i+'[]"]';
			if($(checkboxname)){
				$(checkboxname).attr('checked',false);
			}
		}
	});

	$('#selectreverse').click(function(){

		for(var i=1;i<=20;i++){
			var checkboxname = 'input[name='+'"question_'+i+'[]"]';
			if($(checkboxname)){
				$(checkboxname).each(function(){
					$(this).attr('checked',!this.checked);					
				});			
			}
		}
	});

	$('#offselectall').click(function(){

		for(var i=1;i<=20;i++){
			var checkboxname = 'input[name='+'"uestion_'+i+'[]"]';
			if($(checkboxname)){
				$(checkboxname).attr('checked',true);
			}
		}
	});

	$('#offselectnone').click(function(){

		for(var i=1;i<=20;i++){
			var checkboxname = 'input[name='+'"uestion_'+i+'[]"]';
			if($(checkboxname)){
				$(checkboxname).attr('checked',false);
			}
		}
	});

	$('#offselectreverse').click(function(){

		for(var i=1;i<=20;i++){
			var checkboxname = 'input[name='+'"uestion_'+i+'[]"]';
			if($(checkboxname)){
				$(checkboxname).each(function(){
					$(this).attr('checked',!this.checked);					
				});			
			}
		}
	});

	$('#question_id').submit(function() {
		$(this).ajaxSubmit(); 
		alert("提交到使用题库");
		return false;
	}); 


	$('#off_question_id').submit(function() {
		$(this).ajaxSubmit(); 
		alert("成功下架");
		return false;
	}); 
</script>
</body>
</html>