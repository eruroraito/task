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
	<script type="text/javascript" src="../common/jquery.lightbox-0.5.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="../pics/favicon.ico" media="screen" />
	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<link type="text/css" rel="stylesheet" href="../css/question.css" />
	<link rel="stylesheet" href="../common/jquery.lightbox-0.5.css" type="text/css">
</head>
<body>

<article id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>
	<section class="body">
		<form action="question/addQuestion" enctype="multipart/form-data" method="post" id="myForm" >
			<h4>添加题目</h4>
			<label for="question_type" class="question_type">请选择题目类型:</label>
			<select id="question_type" name="question_type">
				<option value ="0">文字题</option>
				<option value ="1">看图题</option>
				<option value="2">填空题</option>
				<option value="3">触摸题</option>
			</select>
			<br />
			<label for="question_name" class="question_name">问题:</label>
			<textarea class="first" name="question_name" id="question_name" placeholder="请输入问题" maxlength="42"></textarea>
  				<div id="question_image" style="display:none;">
  				<label for="upload_iamge" class="upload_iamge">请上传图片</label>
  				<input id="upload_iamge" type="file" name="image" />
  			</div>
  			<br />
  			<label class="answer">答案:</label>
  			<div id="optionfour" >			
	  			<label for="optin_1" class="option_one">选项1:</label>
	  			<input class="answer_four" type="text" name="option_one" id="optin_1" placeholder="请输入选项1" maxlength="12" />
	 			<br />
	  			<label for="optin_2" class="option_two">选项2:</label>
	  			<input class="answer_four" type="text" name="option_two" id="optin_2" placeholder="请输入选项2" maxlength="12" />
	 			<br />
	 			<label for="optin_3" class="option_three">选项3:</label>
	  			<input class="answer_four" type="text" name="option_three" id="optin_3" placeholder="请输入选项3" maxlength="12" />
	 			<br />
	 			<label for="optin_4" class="option_four">选项4:</label>
	  			<input class="answer_four" type="text" name="option_four" id="optin_4" placeholder="请输入选项4" maxlength="12" />
	 			<br />
  			</div>
  			<div id="optioneight" style="display:none">
	  			<label class="fill_optin_1" for="fill_optin_1">选项1:</label>
	  			<input type="text" name="fill_option_one" id="fill_optin_1" placeholder="请输入" maxlength="1"/>
	  			<label class="fill_optin_5" for="fill_optin_5">选项5:</label>
	  			<input type="text" name="fill_option_five" id="fill_optin_5" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="fill_optin_2" for="fill_optin_2">选项2:</label>
	  			<input type="text" name="fill_option_two" id="fill_optin_2" placeholder="请输入" maxlength="1"/>
	 			<label class="fill_optin_6" for="fill_optin_6">选项6:</label>
	  			<input type="text" name="fill_option_six" id="fill_optin_6" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="fill_optin_3" for="fill_optin_3">选项3:</label>
	  			<input type="text" name="fill_option_three" id="fill_optin_3" placeholder="请输入" maxlength="1"/>
	  			<label class="fill_optin_7" for="fill_optin_7">选项7:</label>
	  			<input type="text" name="fill_option_seven" id="fill_optin_7" placeholder="请输入" maxlength="1"/>
	 			<br />
	 			<label class="fill_optin_4" for="fill_optin_4">选项4:</label>
	  			<input type="text" name="fill_option_four" id="fill_optin_4" placeholder="请输入" maxlength="1"/>
	 			<label class="fill_optin_8" for="fill_optin_8">选项8:</label>
	  			<input type="text" name="fill_option_eight" id="fill_optin_8" placeholder="请输入" maxlength="1"/>
	 			<br />
		 		<label for="true_num" class="true_num">正确答案字数</label>
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
				<br />
  			</div>

 			<label for="question_difficulty" class="question_difficulty">题目难度:</label>
  			<select id="question_difficulty" name="question_difficulty">
				<option value ="1">新手</option>
				<option value ="2">熟练</option>
				<option value ="3">高手</option>
			</select>
			<br />
			<label for="type" class="type">题库类型:</label>
			<select id="type" name="type">
				<?php foreach ($type as $key => $value) {
					$option_value = $value['type_id'];
					echo "<option value =".$option_value.">".$value['type_name']."</option>";
				}
				?>					
			</select>
			<br />
			<input class="submit" type="submit" value="提交" />
	    </form>
	    <section class="new_preview" id="new_preview_section">
	    	<div class="question" id="new_question">点击预览可以预览</div>
	    	<div id="new_four">
	    		<div class="one" id="one"></div>
	    		<div class="two" id="two"></div>
	    		<div class="three" id="three"></div>
	    		<div class="four" id="four"></div>
	    	</div>
	    	<div id="new_eight">
		    	<div class="answer1" id="answer1">我</div>
		    	<div class="answer2" id="answer2">我</div>
		    	<div class="answer3" id="answer3">我</div>
		    	<div class="answer4" id="answer4">我</div>
		    	<div class="answer5" id="answer5">我</div>
		    	<div class="answer6" id="answer6">我</div>
		    	<div class="answer7" id="answer7">我</div>
		    	<div class="answer8" id="answer8">我</div>
	    	</div>
		</section>
	    <button class="button_preview" id="button_preview">预览</button>

	</section>
	

	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>

<script type="text/javascript" src="../js/question.js"></script>
</body>
</html>