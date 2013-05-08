<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>出题</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../common/jquery.form.js"></script>
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<style type="text/css">
		nav {text-align: center;}
		nav a{text-decoration: none; font-size:20px;margin:0 10px 0 0;}
		nav a:hover{text-decoration: underline;}
	</style>

</head>
<body>
<?php require_once 'header.php';?>
<article id="container">
	<section id="body">
		<form  action="question/addQuestion" enctype="multipart/form-data" method="post" id="myForm" >
			<label for="question_type">请选择题目类型</label>
			<select id="question_type" name="question_type">
				<option value ="0">文字题</option>
				<option value ="1">看图题</option>
				<option value="2">填空题</option>
				<option value="3">触摸题</option>
			</select>
			<br />
			<label for="question_name">问题</label>
			<textarea name="question_name" id="question_name" placeholder="请输入问题" maxlength="42"></textarea>
  			<div id="question_image" style="display:none;">
  				<label for="upload_iamge">请上传图片</label>
  				<input id="upload_iamge" type="file" name="image" />
  			</div>
  			<br />
  			<div id="optionfour">
	  			<label class="login" for="optin_1">选项1</label>
	  			<input class="login" type="text" name="option_one" id="optin_1" placeholder="请输入"  maxlength="12" />
	 			<br />
	  			<label class="login" for="optin_2">选项2</label>
	  			<input class="login" type="text" name="option_two" id="optin_2" placeholder="请输入"  maxlength="12" />
	 			<br />
	 			<label class="login" for="optin_3">选项3</label>
	  			<input class="login" type="text" name="option_three" id="optin_3" placeholder="请输入"  maxlength="12" />
	 			<br />
	 			<label class="login" for="optin_4">选项4</label>
	  			<input class="login" type="text" name="option_four" id="optin_4" placeholder="请输入"  maxlength="12" />
	 			<br />
  			</div>
  			<div id="optioneight" style="display:none">
	  			<label class="login" for="fill_optin_1">选项1</label>
	  			<input class="login" type="text" name="fill_option_one" id="fill_optin_1" placeholder="请输入" maxlength="1"/>
	  			<label class="login" for="fill_optin_5">选项5</label>
	  			<input class="login" type="text" name="fill_option_five" id="fill_optin_5" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="login" for="fill_optin_2">选项2</label>
	  			<input class="login" type="text" name="fill_option_two" id="fill_optin_2" placeholder="请输入" maxlength="1"/>
	 			<label class="login" for="fill_optin_6">选项6</label>
	  			<input class="login" type="text" name="fill_option_six" id="fill_optin_6" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="login" for="fill_optin_3">选项3</label>
	  			<input class="login" type="text" name="fill_option_three" id="fill_optin_3" placeholder="请输入" maxlength="1"/>
	  			<label class="login" for="fill_optin_7">选项7</label>
	  			<input class="login" type="text" name="fill_option_seven" id="fill_optin_7" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="login" for="fill_optin_4">选项4</label>
	  			<input class="login" type="text" name="fill_option_four" id="fill_optin_4" placeholder="请输入" maxlength="1"/>
	 			<label class="login" for="fill_optin_8">选项8</label>
	  			<input class="login" type="text" name="fill_option_eight" id="fill_optin_8" placeholder="请输入" maxlength="1"/>
	 			<br />
		 		<label for="true_num">正确答案字数</label>
	  			<select id="true_num" name="true_num">
					<option value ="1">1</option>
					<option value ="2">2</option>
					<option value ="3">3</option>
					<option value ="4">4</option>
					<option value ="5">5</option>
					<option value ="6">6</option>
					<option value ="7">7</option>
					<option value ="8">8</option>
				</select>
				</br />
  			</div>


 			<label for="question_difficulty">难度</label>
  			<select id="question_difficulty" name="question_difficulty">
				<option value ="1">新手</option>
				<option value ="2">熟练</option>
				<option value ="3">高手</option>
			</select>
			<br />
			<label for="type">请选择题库类型</label>
			<select id="type" name="type">
				<?php foreach ($type as $key => $value) {
					$option_value = $key+1;
					echo "<option value =".$option_value.">".$value['type_name']."</option>";
				}
				?>					
			</select>
			<br />
			<label for="exam_use">题库用途</label>
			<select disabled="disabled" id="exam_use">
				<option value ="0">0</option>
			</select>
			<br />
			<input class="submit" type="submit" value="添加" />

	    </form>
	</section>
</article>
</body>
<script type="text/javascript">
	$("#question_type").change( 
		function() { 
			$('#optin_1').val('');
			$('#optin_2').val('');
			$('#optin_3').val('');
			$('#optin_4').val('');	
			$('#fill_optin_1').val('');
			$('#fill_optin_2').val('');
			$('#fill_optin_3').val('');
			$('#fill_optin_4').val('');
			$('#fill_optin_5').val('');
			$('#fill_optin_6').val('');
			$('#fill_optin_7').val('');
			$('#fill_optin_8').val('');
			$('#question_name').val('');
			$('#upload_iamge').val('');
			if($(this).val()==2)
			{
				$("#optionfour").hide();
				$("#optioneight").show();
				$('#question_name').attr('maxlength','42');		
			}else
			{
				$("#optionfour").show();
				$("#optioneight").hide();	
				if($(this).val()==1||$(this).val()==3)
				{
					$('#question_name').attr('maxlength','14');			
				}else{
					$('#question_name').attr('maxlength','42');
				}
			}
			if($(this).val()==1||$(this).val()==3||$(this).val()==2)
			{
				$("#question_image").show();				
			}else
			{
				$("#question_image").hide();	
			}
		} 
	); 

	$('#myForm').submit(function() {
		var type = $('#question_type').val();
		if($('#question_name').val()=='') {alert('请输入问题');return false;}
		if(type==1||type==3){
			if($('#upload_iamge').val()=='') {alert('请上传图片');return false;}
		}
		if(type==2){
			if($('#fill_optin_1').val()=='') {alert('请输入选项1');return false;}
			if($('#fill_optin_2').val()=='') {alert('请输入选项2');return false;}
			if($('#fill_optin_3').val()=='') {alert('请输入选项3');return false;}
			if($('#fill_optin_4').val()=='') {alert('请输入选项4');return false;}
			if($('#fill_optin_5').val()=='') {alert('请输入选项5');return false;}
			if($('#fill_optin_6').val()=='') {alert('请输入选项6');return false;}
			if($('#fill_optin_7').val()=='') {alert('请输入选项7');return false;}
			if($('#fill_optin_8').val()=='') {alert('请输入选项8');return false;}
			if(($('#upload_iamge').val()!='')&&($('#question_name').val().length>14)){
				{alert('题目长度不能超过14');return false;}
			}
		}else{
			if($('#optin_1').val()=='') {alert('请输入选项1');return false;}
			if($('#optin_2').val()=='') {alert('请输入选项2');return false;}
			if($('#optin_3').val()=='') {alert('请输入选项3');return false;}
			if($('#optin_4').val()=='') {alert('请输入选项4');return false;}

		}
		$(this).ajaxSubmit(); 
		alert("添加成功");
		return false;
	}); 

</script>
</html>