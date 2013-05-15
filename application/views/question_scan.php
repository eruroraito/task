<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>浏览审核</title>
	<!--[if IE]>
		<script type="text/javascript" src="../common/html5.js"></script>
		<link type="text/css" rel="stylesheet" href="../common/ie.min.css" />
		<link type="text/css" rel="stylesheet" href="../common/ie6.min.css" />
	<![endif]-->

	<script type="text/javascript" src="../common/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../common/jquery.form.js"></script>
	<script type="text/javascript" src="../common/jquery.confirm/jquery.confirm.js"></script>
	<script type="text/javascript" src="../common/jquery.date_input.js"></script>  
	<script type="text/javascript" src="../common/jquery.lightbox-0.5.js"></script> 
	<script type="text/javascript" src="../js/date_input.js"></script> 

	<link type="text/css" rel="stylesheet" href="../common/style.css" />
	<link rel="stylesheet" href="../common/date_input.css" type="text/css">
	<link type="text/css" rel="stylesheet" href="../css/common/header.css" />
	<link rel="stylesheet" href="../common/jquery.lightbox-0.5.css" type="text/css">
	<link type="text/css" rel="stylesheet" href="../css/question_scan.css" />

</head>
<body>
<article id="container">
	<?php require_once 'common/header.php';?>
	<span class="left"></span>
	<span class="right"></span>
	<section class="que_fliter">
		<form action="question_scan/getQuestionList" method="post" id="myForm" class="myForm">
			<div class="select">
				<label for="tk_type">题库类型:</label>
				<select id="tk_type" name="type">
					<option value ="9999">全部</option>
					<?php foreach ($type as $key => $value) {
						$option_value = $key+1;
						echo "<option value =".$option_value.">".$value['type_name']."</option>";
					}
					?>					
				</select>
			</div>
			<div class="select type">
				<label for="question_type">题目类型:</label>
				<select id="question_type" name="question_type">
					<option value ="9999">全部</option>
					<option value ="0">文字题</option>
					<option value ="1">图片题</option>
					<option value ="2">填空题</option>
					<option value ="3">触摸题</option>
				</select>
			</div>
			<div class="select difficulty">
				<label for="difficult">难度:</label>
				<select id="difficult" name="difficult">
					<option value ="9999">全部</option>
					<option value ="1">新手</option>
					<option value ="2">熟练</option>
					<option value ="3">高手</option>
				</select>
			</div>
			<div class="select user">
				<label for="user">出题人:</label>
				<select id="user" name="user">
					<option value ="all">全部</option>
					<?php foreach ($userlist as $key => $value) {
						echo "<option value =".$value['user_name'].">".$value['user_realname']."</option>";
					}
					?>	
				</select>
			</div>
			<div class="select auditer" >
				<label for="auditer">审核人:</label>
				<select id="auditer" name="auditer">
					<option value ="all">全部</option>
					<?php foreach ($auditerlist as $key => $value) {
						echo "<option value =".$value['user_name'].">".$value['user_realname']."</option>";
					}
					?>	
				</select>
			</div>

			<div class="select">
				<label for="status">状态:</label>
				<select id="status" name="status">
					<option value ="9999">全部</option>
					<option value ="0">未审核</option>
					<option value ="1">审核通过</option>
					<option value ="2">审核不通过</option>
					<option value ="3">已上架</option>
					<option value ="-1">已删除</option>
				</select>
			</div>

			<div class="select">
				<label for="order_status">排序方式:</label>
				<select id="order_item" name="order_item">
					<option value ="1">上次更新</option>
					<option value ="2">题目编号</option>
				</select>
				<select id="order" name="order">
					<option value ="1">升序</option>
					<option value ="2">降序</option>
				</select>
			</div>
			<div class="select date">
				<label for="date_start">起始日期:</label>
				<input id="date_start" type="text" class="biuuu1" name="date_start" />
				<label for="date_end">结束日期:</label>
				<input id="date_end" type="text" class="biuuu2" name="date_end" />
			</div>

			<div class="select condition">				
				<select id="condition" name="condition">
					<option value ="1">文字题目</option>
					<option value ="2">图片编号</option>
					<option value ="3">题目编号</option>
				</select>
				<input id="search" name="search" />
			</div>
			<input class="submit" type="submit" value="确定筛选" />
		</form>

		<section class="scan">
			<h4>筛选的题目</h4>
			<table class="scan">
				<tr class="th" id="tr0">
					<th class="first">编号</th>
					<th class="second">题目概要</th>
					<th class="third">更新时间</th>
					<th class="fourth">状态</th>
					<th class="fifth">出题人</th>
					<th class="sixth">审核人</th>
				</tr>
				<?php foreach ($scan['list'] as $key => $value) {
					$key = $key+1;
					$tr_id = 'tr'.$key;
					$origin_status = $value['status'];
					switch ($value['status']) {
							case 0:
								$value['status'] = "待审核";
								echo '<tr class="need_audit preview" id='.$tr_id.'>';
								break;
							case 1:							
								$value['status'] = "审核不通过";
								echo '<tr class="not_audit preview" id='.$tr_id.'>';
								break;
							case 2:						
								$value['status'] = "审核通过";
								echo '<tr class="pass_audit preview" id='.$tr_id.'>';
								break;
							case 3:							
								$value['status'] = "已上架";
								echo '<tr class="use preview" id='.$tr_id.'>';
								break;
							case -1:						
								$value['status'] = "已删除";
								echo '<tr class="delete preview" id='.$tr_id.'>';
								break;
							default:
								$value['status'] = "已删除";
								echo '<tr class="delete preview" id='.$tr_id.'>';
								break;
						}
						echo '<td>'.$value['id'].'</td>';
						$question_rogin = $value['question'];
						if(mb_strlen($value['question'])>10) $value['question'] = mb_substr($value['question'], 0,9).'...';
						echo '<td>'.$value['question'].'</td>';
						echo '<td>'.substr($value['time_update'],0,10).'</td>';
						echo '<td class="">'.$value['status'].'</td>';
						echo '<td>'.$value['name_origin'].'</td>';
						echo '<td>'.$value['name_audit'].'</td>';
						echo '<td style="display:none;">'.$value['question_type'].'</td>';
						echo '<td style="display:none;">'.$value['type'].'</td>';
						echo '<td style="display:none;">'.$value['answer_1'].'</td>';
						echo '<td style="display:none;">'.$value['answer_2'].'</td>';
						echo '<td style="display:none;">'.$value['answer_3'].'</td>';
						echo '<td style="display:none;">'.$value['answer_4'].'</td>';
						echo '<td style="display:none;">'.$value['answer_5'].'</td>';
						echo '<td style="display:none;">'.$value['answer_6'].'</td>';
						echo '<td style="display:none;">'.$value['answer_7'].'</td>';
						echo '<td style="display:none;">'.$value['answer_8'].'</td>';
						echo '<td style="display:none;">'.$question_rogin.'</td>';
						echo '<td style="display:none;">'.$value['icon'].'</td>';
						echo '<td style="display:none;">'.$origin_status.'</td>';
					echo '</tr>';
				}?>
			</table>
			<form class="form_pagination" action="question_scan/first_page" method="post" id="first_page_form">
				<input type="hidden" name="pagination_first" value="first" />
				<input type="submit" class="first" value="[首页]" />
			</form>
			<form class="form_pagination" action="question_scan/pre_page" method="post" id="pre_page_form">
				<input type="hidden" name="pagination_pre" value="pre" />
				<input type="submit" class="pre" value="[上一页]" />
			</form>
			<form class="form_pagination" action="question_scan/redirect" method="post" id="redirect_form">
				<input class="pagination" name="pagination" /> 
				<input type="submit" class="redirect" value="[跳转]" />
			</form>
			<form class="form_pagination" action="question_scan/next_page" method="post" id="next_page_form">
				<input type="hidden" name="pagination_next" value="next" />
				<input type="submit" class="next" value="[下一页]" />
			</form>
			<form class="form_pagination" action="question_scan/last_page" method="post" id="last_page_form">
				<input type="hidden" name="pagination_last" value="last" />
				<input type="submit" class="last" value="[末页]" />
				<span class="current">第<?php echo $scan['pagination'];?>页</span>
				<span class="total">共<?php echo $scan['count'];?>页</span>
			</form>

			<div class="table_footer">
				<table class="footer">
					<tr>
						<th class="need_audit">待审核</th>
						<th class="not_audit">审核不通过</th>
						<th class="pass_audit">审核通过</th>
						<th class="use">已上架</th>
						<th class="delete" style="border-right:none;">已删除</th>
					</tr>
				</table>
			</div>
		</section>

		<section class="question_scan" id="new_question_scan">
			<div class="question" id="new_question">点击题目可以预览</div>
			<a title="" href="" id="img_a">
				<img class="img_preview" src="" width="216" height="110" id="img_img" />
			</a>
	    	<div id="new_four">
	    		<div class="one" id="as1"></div>
	    		<div class="two" id="as2"></div>
	    		<div class="three" id="as3"></div>
	    		<div class="four" id="as4"></div>
	    	</div>
	    	<div id="new_eight" style="display:none;">
		    	<div class="answer1" id="answer1"></div>
		    	<div class="answer2" id="answer2"></div>
		    	<div class="answer3" id="answer3"></div>
		    	<div class="answer4" id="answer4"></div>
		    	<div class="answer5" id="answer5"></div>
		    	<div class="answer6" id="answer6"></div>
		    	<div class="answer7" id="answer7"></div>
		    	<div class="answer8" id="answer8"></div>
	    	</div>
	    	<form action="question_scan/doAudit" method="post" id="audit_form_pass">
	    		<input type="hidden" name="audit" value="2" />
	    		<input type="hidden" name="type" id="audit_type" />
	    		<input type="hidden" name="id" id="audit_question_id" />
	    		<input type="submit" value="通过" class="audit_form_pass_submit disabled" id="pass_audit" disabled="disabled">
	    	</form>
	    	<form action="question_edit" method="post" >
	    		<input type="hidden" name="type" id="audit_type_edit" />
	    		<input type="hidden" name="id" id="audit_question_id_deit" />
	    		<input type="submit" value="不通过" class="audit_not_pass disabled" id="notpass_audit" disabled="disabled">
	    		<input type="submit" value="修改/删除" class="audit_edit disabled" id="edit_scan" disabled="disabled">
	    	</form>
			<div class="hidden"></div>
		</section>

	</section>
	<footer>
		<p>沪ICP备08009851号</p>
		<p>Copyright 2007-2010上海佳游网络 Corporation All rights reserved.</p>
	</footer>
</article>

<script type="text/javascript" src="../js/question_scan.js"></script> 
<script type="text/javascript">
	$('.preview').click(function(){
		$(this).addClass('selected').siblings().removeClass('selected');
		var data = new Array();
		$(this).children().each(function(i){
			data[i] = $(this).text();
		});
		var question_id = data[0];
		var name_origin = data[4];
		var question_type = data[6];
		var type = data[7];
		var answer = new Array();
		for(var i=1;i<=8;i++){
			answer[i] = data[i+7];
		}
		var question = data[16];
		var icon = data[17];
		var status = data[18];
		var permission = <?php echo $permission;?>;
		var current_user = "<?php echo $current_user;?>";
		if(permission==1||permission==2){
			if(status==0){
				$('#pass_audit').removeClass('disabled');
				$('#pass_audit').removeAttr('disabled');
				$('#notpass_audit').removeClass('disabled');
				$('#notpass_audit').removeAttr('disabled');
			}else{
				$('#pass_audit').addClass('disabled','disabled');
				$('#pass_audit').attr('disabled','disabled');
				$('#notpass_audit').addClass('disabled','disabled');
				$('#notpass_audit').attr('disabled','disabled');
			}
			if(status==0||status==1){
				$('#edit_scan').removeClass('disabled');				
				$('#edit_scan').removeAttr('disabled');
			}else{
				$('#edit_scan').addClass('disabled','disabled');				
				$('#edit_scan').attr('disabled','disabled');
			}
		}else if(current_user==name_origin){
			if(status==0||status==1){
				$('#edit_scan').removeClass('disabled');				
				$('#edit_scan').removeAttr('disabled');
			}else{
				$('#edit_scan').addClass('disabled','disabled');				
				$('#edit_scan').attr('disabled','disabled');
			}
		}				

		if(icon!=0){
			var imagepath = '../uploads/'+icon+'.jpg';
			$('#img_a').attr('title',question);
			$('#img_a').attr('href',imagepath);
			$('#img_img').attr('src',imagepath);
			$('#img_a').show();
		}else{
			$('#img_a').removeAttr('title');
			$('#img_a').removeAttr('href');
			$('#img_img').removeAttr('src');
			$('#img_a').hide();
		}
		if(question_type==2){
			$('#new_question_scan').css('background-image','url(../pics/eight.jpg)');
			$('#new_eight').show();
			$('#new_four').hide();
			for(var y=1;y<=8;y++){
				var answer_name = "#answer"+y.toString();
				$(answer_name).text(answer[y]);
			}
		}else{
			$('#new_question_scan').css('background-image','url(../pics/four.jpg)');
			$('#new_four').show();
			$('#new_eight').hide();
			for(var j=1;j<=4;j++){
				var answer_name = "#as"+j.toString();
				$(answer_name).text(answer[j]);
			}
		}
		$('#new_question').text(question);
		$('#audit_type').val(type);
		$('#audit_question_id').val(question_id);
		$('#audit_type_edit').val(type);
		$('#audit_question_id_deit').val(question_id);
	});
	</script> 
</body>

</html>