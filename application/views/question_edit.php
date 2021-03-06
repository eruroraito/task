<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>编辑题目</title>
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
	<link type="text/css" rel="stylesheet" href="../css/question_edit.css" />
	<link rel="stylesheet" href="../common/jquery.lightbox-0.5.css" type="text/css">
</head>
<body>

<article id="container">
	<?php require_once 'common/header.php';?>
	<span class="left" id="left"></span>
	<span class="right" id="right"></span>
	<section class="body" id="body">
		<form  action="question_edit/editQuestion" enctype="multipart/form-data" method="post" id="myForm" class="edit">
			<h4>修改题目</h4>
			<input type="hidden" name="question_type" value=<?php echo $edit['question_type'];?> />
			<input type="hidden" name="type" value=<?php echo $edit['type'];?> />
			<input type="hidden" name="question_id" value=<?php echo $edit['id'];?> />
			<label for="question_type" class="question_type">请选择题目类型:</label>
			<select id="question_type" disabled="disabled">
				<?php 
					switch ($edit['question_type']) {
						case '0':
							echo '<option value ="0">文字题</option>';
							break;
						case '1':
							echo '<option value ="1">看图题</option>';
							break;
						case '2':
							echo '<option value="2">填空题</option>';
							break;
						case '3':
							echo '<option value="3">触摸题</option>';
							break;
						default:
							echo '<option value ="0">文字题</option>';
							break;
					}
				?>
			</select>
			<br />
			<label for="question_name" class="question_name">问题:</label>
			<textarea class="first" name="question_name" id="question_name" placeholder="请输入问题" maxlength="42"><?php echo $edit['question'];?></textarea>
  			<div id="question_image" <?php if($edit['question_type']==0) echo 'style="display:none;"'?>>
  				<label for="upload_iamge" class="upload_iamge">请上传图片</label>
  				<input id="upload_iamge" type="file" name="edit_image" />
  			</div>
  			<br />
  			<label class="answer">答案:</label>
  			<div id="optionfour" <?php if($edit['question_type']==2) echo 'style="display:none;"'?>>			
	  			<label for="optin_1" class="option_one">选项1:</label>
	  			<input class="answer_four" type="text" name="option_one" id="optin_1" placeholder="请输入选项1" maxlength="12" value=<?php echo $edit['answer_1'];?> />
	 			<br />
	  			<label for="optin_2" class="option_two">选项2:</label>
	  			<input class="answer_four" type="text" name="option_two" id="optin_2" placeholder="请输入选项2" maxlength="12" value=<?php echo $edit['answer_2'];?> />
	 			<br />
	 			<label for="optin_3" class="option_three">选项3:</label>
	  			<input class="answer_four" type="text" name="option_three" id="optin_3" placeholder="请输入选项3" maxlength="12" value=<?php echo $edit['answer_3'];?> />
	 			<br />
	 			<label for="optin_4" class="option_four">选项4:</label>
	  			<input class="answer_four" type="text" name="option_four" id="optin_4" placeholder="请输入选项4" maxlength="12" value=<?php echo $edit['answer_4'];?> />
	 			<br />
  			</div>
  			<div id="optioneight" <?php if($edit['question_type']!=2) echo 'style="display:none;"'?>>
	  			<label class="fill_optin_1" for="fill_optin_1">选项1:</label>
	  			<input value=<?php echo $edit['answer_1'];?> type="text" name="fill_option_one" id="fill_optin_1" placeholder="请输入" maxlength="1"/>
	  			<label class="fill_optin_5" for="fill_optin_5">选项5:</label>
	  			<input type="text" name="fill_option_five" id="fill_optin_5" placeholder="请输入" maxlength="1" value=<?php echo $edit['answer_5'];?> />
	 			<br />
	 			<label class="fill_optin_2" for="fill_optin_2">选项2:</label>
	  			<input value=<?php echo $edit['answer_2'];?> type="text" name="fill_option_two" id="fill_optin_2" placeholder="请输入" maxlength="1"/>
	 			<label class="fill_optin_6" for="fill_optin_6">选项6:</label>
	  			<input  type="text" name="fill_option_six" id="fill_optin_6" placeholder="请输入" maxlength="1" value=<?php echo $edit['answer_6'];?> />
	 			<br />
	 			<label class="fill_optin_3" for="fill_optin_3">选项3:</label>
	  			<input value=<?php echo $edit['answer_3'];?> type="text" name="fill_option_three" id="fill_optin_3" placeholder="请输入" maxlength="1"/>
	  			<label class="fill_optin_7" for="fill_optin_7">选项7:</label>
	  			<input  type="text" name="fill_option_seven" id="fill_optin_7" placeholder="请输入" maxlength="1" value=<?php echo $edit['answer_7'];?> />
	 			<br />
	 			<label class="fill_optin_4" for="fill_optin_4">选项4:</label>
	  			<input value=<?php echo $edit['answer_4'];?> type="text" name="fill_option_four" id="fill_optin_4" placeholder="请输入" maxlength="1"/>
	 			<label class="fill_optin_8" for="fill_optin_8">选项8:</label>
	  			<input  type="text" name="fill_option_eight" id="fill_optin_8" placeholder="请输入" maxlength="1" value=<?php echo $edit['answer_8'];?> />
	 			<br />
		 		<label for="true_num" class="true_num">正确答案字数</label>
	  			<select id="true_num" name="true_num">
	  				<?php 
	  					for($i=1;$i<=8;$i++){
	  						if($edit['answer_num']==$i) 
	  						echo '<option value ='.$i.' selected="selected">'.$i.'</option>';
	  						else echo '<option value ='.$i.'>'.$i.'</option>';
	  					}
	  				?>	
				</select>
				<br />
  			</div>

 			<label for="question_difficulty" class="question_difficulty">题目难度:</label>
  			<select id="question_difficulty" name="question_difficulty">
  				<?php 
  					for($i=1;$i<=3;$i++){
  						if($i==1) $value = "新手";
  						elseif($i==2) $value = "熟练";
  						elseif($i==3) $value = "高手";
  						if($edit['difficulty']==$i) 
  						echo '<option value ='.$i.' selected="selected">'.$value.'</option>';
  						else echo '<option value ='.$i.'>'.$value.'</option>';
  					}
	  			?>
			</select>
			<br />
			<label for="type" class="type">题库类型:</label>
			<select id="type" name="type" disabled="disabled">
				<?php foreach ($type as $key => $value) {
					$option_value = $key+1;
					if($edit['type']==$option_value)
					echo "<option value =".$option_value.">".$value['type_name']."</option>";
				}
				?>					
			</select>
			<br />
			<input class="submit" type="submit" value="修改" />
	    </form>
	    <section class="new_preview" id="new_preview">

	    	<div class="question" id="new_question">点击预览可以预览</div>
	    	<a title="" href="" id="img_a">
				<img class="img_preview" src="" width="216" height="110" id="img_img" />
			</a>
	    	<div id="new_four">
	    		<div class="one" id="one"></div>
	    		<div class="two" id="two"></div>
	    		<div class="three" id="three"></div>
	    		<div class="four" id="four"></div>
	    	</div>
	    	<div id="new_eight">
		    	<div class="answer1" id="answer1"></div>
		    	<div class="answer2" id="answer2"></div>
		    	<div class="answer3" id="answer3"></div>
		    	<div class="answer4" id="answer4"></div>
		    	<div class="answer5" id="answer5"></div>
		    	<div class="answer6" id="answer6"></div>
		    	<div class="answer7" id="answer7"></div>
		    	<div class="answer8" id="answer8"></div>
	    	</div>
	    	<button class="button_preview" id="button_preview">预览</button>
		</section>
	    
	    <form action="question_edit/deleteQuestion" method="post" id="deleteFrom">
	    	<input type="hidden" name="id" value=<?php echo $edit['id'];?> />
	    	<input type="hidden" name="type" value=<?php echo $edit['type'];?> />
	    	<input type="submit" value="删除" class="deleteSubmit" />
	    </form>
	    <section class="suggestion" id="sec_suggestion">
	    	<form action="question_scan/doAudit" method="post" id="suggestion_form">
		    	<h3>审核不通过(意见)</h3>
		    	<input type="hidden" name="audit" value="1" />
		    	<input type="hidden" name="id" value=<?php echo $edit['id'];?> />
		    	<input type="hidden" name="type" value=<?php echo $edit['type'];?> />
		    	<textarea id="textarea_suggestion" class="suggestion" maxlength="200" name="suggestion"><?php echo $edit['suggestion'];?></textarea>
		    	<br />
		    	<input type="submit" value="确定审核" class="suggestion" id="suggestion_submit"/>
	   		</form>
    	</section>
	</section>
	

	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>
<script type="text/javascript" src="../js/question_edit.js"></script>
<script type="text/javascript">
	$(function(){
		$('#one').css('top','375px');
		$('#two').css('top','375px');
		$('#three').css('top','435px');
		$('#four').css('top','435px');
		var type = $("#question_type").val();
		var icon = <?php echo $edit['icon'];?>;
		var pic_size = <?php echo $edit['pic_size'];?>;
		var question = "<?php echo $edit['question'];?>";
		if(icon!=0){
			var imagepath = '../uploads/'+icon+'.jpg';
			var a_title = question+'(图片:'+pic_size+'K)';
			$('#img_a').attr('title',a_title);
			$('#img_a').attr('href',imagepath);
			$('#img_img').attr('src',imagepath);
			$('#img_a').show();
		}else{
			$('#img_a').removeAttr('title');
			$('#img_a').removeAttr('href');
			$('#img_img').removeAttr('src');
			$('#img_a').hide();
		}
		if(type==2){
			$('#new_four').hide();
			$('#new_eight').show();
			$('#answer1').text($('#fill_optin_1').val());
			$('#answer2').text($('#fill_optin_2').val());
			$('#answer3').text($('#fill_optin_3').val());
			$('#answer4').text($('#fill_optin_4').val());
			$('#answer5').text($('#fill_optin_5').val());
			$('#answer6').text($('#fill_optin_6').val());
			$('#answer7').text($('#fill_optin_7').val());
			$('#answer8').text($('#fill_optin_8').val());
		}else{
			$('#new_eight').hide();
			$('#new_four').show();
			if($('#optin_1').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_1').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_1').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#one').html(data1);
				$('#one').css('top','367px');
			}else{
				$('#one').html($('#optin_1').val());
			}
			if($('#optin_2').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_2').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_2').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#two').html(data1);
				$('#two').css('top','367px');
			}else{
				$('#two').html($('#optin_2').val());
			}
			if($('#optin_3').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_3').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_3').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#three').html(data1);
				$('#three').css('top','428px');
			}else{
				$('#three').html($('#optin_3').val());
			}
			if($('#optin_4').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_4').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_4').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#four').html(data1);
				$('#four').css('top','428px');
			}else{
				$('#four').html($('#optin_4').val());
			}
		}
		$('#new_question').text($('#question_name').val());
	});

	var status = <?php echo $edit['status'];?>;
	var permission  = <?php echo $permission;?>;
	if(permission==3){
		if(status==1){
			$('#suggestion_submit').attr('disabled','disabled').hide();
			$('#textarea_suggestion').attr('disabled','disabled');	
		}else if(status==0){
			$('#suggestion_submit').attr('disabled','disabled').hide();
			$('#textarea_suggestion').attr('disabled','disabled');
			$('#sec_suggestion').hide();
			$('#left').addClass('edit');
			$('#right').addClass('edit');
			$('#body').addClass('edit');
		}
	}

	$('#button_preview').click(function(){
		var type = $("#question_type").val();
		var icon = <?php echo $edit['icon'];?>;
		var pic_size = <?php echo $edit['pic_size'];?>;
		var question = "<?php echo $edit['question'];?>";
		if(icon!=0){
			var imagepath = '../uploads/'+icon+'.jpg';
			var a_title = question+'(图片:'+pic_size+'K)';
			$('#img_a').attr('title',a_title);
			$('#img_a').attr('href',imagepath);
			$('#img_img').attr('src',imagepath);
			$('#img_a').show();
		}else{
			$('#img_a').removeAttr('title');
			$('#img_a').removeAttr('href');
			$('#img_img').removeAttr('src');
			$('#img_a').hide();
		}
		if(type==2){
			$('#new_four').hide();
			$('#new_eight').show();
			$('#answer1').text($('#fill_optin_1').val());
			$('#answer2').text($('#fill_optin_2').val());
			$('#answer3').text($('#fill_optin_3').val());
			$('#answer4').text($('#fill_optin_4').val());
			$('#answer5').text($('#fill_optin_5').val());
			$('#answer6').text($('#fill_optin_6').val());
			$('#answer7').text($('#fill_optin_7').val());
			$('#answer8').text($('#fill_optin_8').val());
		}else{
			$('#new_eight').hide();
			$('#new_four').show();
			if($('#optin_1').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_1').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_1').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#one').html(data1);
				$('#one').css('top','367px');
			}else{
				$('#one').html($('#optin_1').val());
			}
			if($('#optin_2').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_2').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_2').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#two').html(data1);
				$('#two').css('top','367px');
			}else{
				$('#two').html($('#optin_2').val());
			}
			if($('#optin_3').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_3').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_3').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#three').html(data1);
				$('#three').css('top','423px');
			}else{
				$('#three').html($('#optin_3').val());
			}
			if($('#optin_4').val().length>6){
				var str1 = new Array();
				str1 = $('#optin_4').val().split("");
				var data1 = "";
				for(var i=0;i<=5;i++){
					data1 = data1 + str1[i];
				}
				data1 = data1 +'<br />';
				for(var k=6;k<$('#optin_4').val().length;k++){
					data1 = data1 + str1[k];
				}
				$('#four').html(data1);
				$('#four').css('top','423px');
			}else{
				$('#four').html($('#optin_4').val());
			}
		}
		$('#new_question').text($('#question_name').val());
	});
				
	$(function() { 
			var quesiont_type = <?php echo $edit['question_type'];?>;
			if(quesiont_type==2)
			{
				$("#optionfour").hide();
				$("#optioneight").show();
				$('#question_name').attr('maxlength','42');		
				$('#new_preview').css('background-image','url(../pics/eight.jpg)');
			}else
			{
				$('#new_preview').css('background-image','url(../pics/four.jpg)');
				$("#optionfour").show();
				$("#optioneight").hide();	
				if(quesiont_type==1||quesiont_type==3)
				{
					$('#question_name').attr('maxlength','14');			
				}else{
					$('#question_name').attr('maxlength','42');
				}
			}
			if(quesiont_type==1||quesiont_type==3||quesiont_type==2)
			{
				$("#question_image").show();				
			}else
			{
				$("#question_image").hide();	
			}
		}
	); 
</script> 
</body>

</html>