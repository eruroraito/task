<?php
    //ini_set("display_errors", 0);
	require_once 'callgs.php';
	require_once 'config.php';
	require_once 'question.php';
	session_start();	
	$_SESSION['qlist'] = $qlist;
	//$qlist = $_SESSION['qlist'];
	//print_r($_SESSION['qlist']);
	$_SESSION['start_time'] = time();//答题开始时间
?>
<?php require_once 'header.php';?>
	<link type="text/css" rel="stylesheet" href="css/carnival_main.css" />
	<style type="text/css">
		div.word_mask,div.fill_mask,div.non_mask{background:url(material/challenger_mask.png) no-repeat;width:600px;height:276px;position: absolute;top:-10px;left:-18px;}
		div.fill_mask{top:-24px;}
		div.non_mask{top:-50px;left:-24px;}
		
	</style>
</head>
<body ontouchmove="event.preventDefault()">

	<div class="sky_blue"></div>
	<div class="dark_blue"></div>

	<section class="name" id="name">
		<h2 class="myname">我</h2>
		<h2 class="challengername"><?php echo $qlist['challenger_name'];?></h2>
	</section>

	<form action="carnival_exchange_result.php" method="post" id="result_form">
		<input type ="hidden" name="answer_option" />
		<input type ="hidden" name="right_number" />
	</form>
	<?php 
		foreach ($qlist['recipient'] as $key => $value) {
			echo '<div class="main" id="main_'.$key.'">';
			echo '<section class="blackboard_one" id="blackboard_one_'.$key.'">';
				
				if($value['type']==TYPE_WORD){
					echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
				}elseif($value['type']==TYPE_IMAGE){
					echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
					echo '<div class="image">';
						echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
					echo '</div>';
				}elseif($value['type']==TYPE_FILL){
					if($value['pic_serial']==0){
						echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
					}else{
						echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
						echo '<div class="image">';
							echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
							echo '<img class="right" id="'.$key.'_image_right" src="material/right.png" alt="图片无法显示" />';
							echo '<img class="wrong" id="'.$key.'_image_wrong" src="material/wrong.png" alt="图片无法显示" />';
						echo '</div>';
						echo '<button class="rechoose" id="rechoose_'.$key.'">重选</button>';
					}
				}elseif($value['type']==TYPE_NON){
					if($value['pic_serial']==0){
						echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
					}else{
						echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
						echo '<div class="image">';
							echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
						echo '</div>';
					}
				}elseif($value['type']==TYPE_TOUCH){
					echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
					echo '<div class="image">';
						echo '<canvas id="canvas_'.$key.'" width="500" height="266">浏览器不支持html5</canvas>';
						echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
					echo '</div>';
				}
			echo '</section>';
			echo '<section class="blackboard_two" id="blackboard_two_'.$key.'">';
				echo '<h3>第'.($key+1).'题</h3>';
				echo '<strong id="time_'.($key+1).'">'.$value['ptime'].'</strong>';
			echo '</section>';
			echo '<section class="answer">';
			if($value['type']==TYPE_FILL){
				echo '<table class="fill" id="'.$key.'_'.$value['answer'].'">';
					echo '<tr>';
				       echo '<td class="fill_click" id="'.$key.'_1">'.$value['sellist']['1'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="'.$key.'_2">'.$value['sellist']['2'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="'.$key.'_3">'.$value['sellist']['3'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="'.$key.'_4">'.$value['sellist']['4'].'</td>';
				    echo '</tr>';
				    echo '<tr class="none">';
				       echo '<td></td>';
				       echo '<td class="none"></td>';
				       echo '<td></td>';
				       echo '<td class="none"></td>';
				       echo '<td></td>';
				       echo '<td class="none"></td>';
				       echo '<td></td>';
				    echo '</tr>';
				    echo '<tr>';
				       echo '<td class="fill_click" id="'.$key.'_5">'.$value['sellist']['5'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="'.$key.'_6">'.$value['sellist']['6'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="'.$key.'_7">'.$value['sellist']['7'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="'.$key.'_8">'.$value['sellist']['8'].'</td>';
				    echo '</tr>';
			    echo '</table>';
			}elseif($value['type']==TYPE_NON){
				$image_src1 = "material/answer_wrong.png";
				$image_src2 = "material/answer_wrong.png";
				switch (intval($value['answer'])) {
					case '1':
						$image_src1 = "material/answer_right.png";
						break;
					case '2':
						$image_src2 = "material/answer_right.png";
						break;
					default:
						$image_src1 = "material/answer_right.png";
						break;
				}
				echo '<img class="non_answer non_answer_one" id="'.$key.'_1_non_answer" src="'.$image_src1.'" alt="图片无法显示" />';
				echo '<img class="non_answer non_answer_two" id="'.$key.'_2_non_answer" src="'.$image_src2.'" alt="图片无法显示" />';
				echo '<table class="non" id="non_'.$key.'_'.$value['answer'].'">';
				    echo '<tr>';
				       echo '<td class="non_click" id="'.$key.'_1">是</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="non_click" id="'.$key.'_2">否</td>';
				    echo '</tr>';
				echo '</table>';
			}else{
				$image_src1 = "material/answer_wrong.png";
				$image_src2 = "material/answer_wrong.png";
				$image_src3 = "material/answer_wrong.png";
				$image_src4 = "material/answer_wrong.png";

				switch (intval($value['answer'])) {
					case '1':
						$image_src1 = "material/answer_right.png";
						break;
					case '2':
						$image_src2 = "material/answer_right.png";
						break;
					case '3':
						$image_src3 = "material/answer_right.png";
						break;
					case '4':
						$image_src4 = "material/answer_right.png";
						break;
					default:
						$image_src1 = "material/answer_right.png";
						break;
				}
				echo '<img class="word_answer one" id="'.$key.'_1_word_answer" src="'.$image_src1.'" alt="图片无法显示" />';
				echo '<img class="word_answer two" id="'.$key.'_2_word_answer" src="'.$image_src2.'" alt="图片无法显示" />';
				echo '<img class="word_answer three" id="'.$key.'_3_word_answer" src="'.$image_src3.'" alt="图片无法显示" />';
				echo '<img class="word_answer four" id="'.$key.'_4_word_answer" src="'.$image_src4.'" alt="图片无法显示" />';
				echo '<table class="word" id="word_'.$key.'_'.$value['answer'].'">';

					echo '<tr>';
				       echo '<td class="word_click" id="'.$key.'_1">'.$value['sellist']['1'].'</td>';
				       
				       echo '<td class="none"></td>';
				       echo '<td class="word_click" id="'.$key.'_2">'.$value['sellist']['2'].'</td>';
				       
				    echo '</tr>';
				    echo '<tr class="none">';
				      echo '<td></td>';
				      echo '<td class="none"></td>';
				      echo '<td></td>';
				    echo '</tr>';
				    echo '<tr>';
				      echo '<td class="word_click" id="'.$key.'_3">'.$value['sellist']['3'].'</td>';
				      
				      echo '<td class="none"></td>';
				      echo '<td class="word_click" id="'.$key.'_4">'.$value['sellist']['4'].'</td>';
				      
				   echo '</tr>';
				echo '</table>';
			}
			echo '</section>';
			echo '</div>';
		}
	?>
	<?php 
		foreach ($qlist['challenger'] as $key => $value) {
			echo '<div class="main" id="challenger_main_'.$key.'">';
			echo '<section class="blackboard_one" id="challenger_blackboard_one_'.$key.'">';
				
				if($value['type']==TYPE_WORD){
					echo '<div class="question" id="challenger_question_'.$key.'">'.$value['ques'].'</div>';
				}elseif($value['type']==TYPE_IMAGE){
					echo '<div class="question" id="challenger_question_'.$key.'">'.$value['ques'].'</div>';
					echo '<div class="image">';
						echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
					echo '</div>';
				}elseif($value['type']==TYPE_FILL){
					if($value['pic_serial']==0){
						echo '<div class="question" id="challenger_question_'.$key.'">'.$value['ques'].'</div>';
					}else{
						echo '<div class="question" id="challenger_question_'.$key.'">'.$value['ques'].'</div>';
						echo '<div class="image">';
							echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
							echo '<img class="right" id="challenger_'.$key.'_image_right" src="material/right.png" alt="图片无法显示" />';
							echo '<img class="wrong" id="challenger_'.$key.'_image_wrong" src="material/wrong.png" alt="图片无法显示" />';
						echo '</div>';
					}
				}elseif($value['type']==TYPE_NON){
					if($value['pic_serial']==0){
						echo '<div class="question" id="challenger_challenger_question_'.$key.'">'.$value['ques'].'</div>';
					}else{
						echo '<div class="question" id="challenger_question_'.$key.'">'.$value['ques'].'</div>';
						echo '<div class="image">';
							echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
						echo '</div>';
					}
				}elseif($value['type']==TYPE_TOUCH){
					echo '<div class="question" id="challenger_question_'.$key.'">'.$value['ques'].'</div>';
					echo '<div class="image">';
						echo '<canvas id="challenger_canvas_'.$key.'" width="500" height="266">浏览器不支持html5</canvas>';
						echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
					echo '</div>';
				}
			echo '</section>';
			echo '<section class="blackboard_two" id="challenger_blackboard_two_'.$key.'">';
				echo '<h3>第'.($key+1).'题</h3>';
				echo '<strong id="challenger_time_'.($key+1).'">'.$value['ptime'].'</strong>';
			echo '</section>';

			echo '<section class="answer">';
			
			if($value['type']==TYPE_FILL){
				echo '<div class="fill_mask"></div>';
				echo '<table class="fill" id="challenger_'.$key.'_'.$value['answer'].'">';
					echo '<tr>';
				       echo '<td class="fill_click" id="challenger_'.$key.'_1">'.$value['sellist']['1'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="challenger_'.$key.'_2">'.$value['sellist']['2'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="challenger_'.$key.'_3">'.$value['sellist']['3'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="challenger_'.$key.'_4">'.$value['sellist']['4'].'</td>';
				    echo '</tr>';
				    echo '<tr class="none">';
				       echo '<td></td>';
				       echo '<td class="none"></td>';
				       echo '<td></td>';
				       echo '<td class="none"></td>';
				       echo '<td></td>';
				       echo '<td class="none"></td>';
				       echo '<td></td>';
				    echo '</tr>';
				    echo '<tr>';
				       echo '<td class="fill_click" id="challenger_'.$key.'_5">'.$value['sellist']['5'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="challenger_'.$key.'_6">'.$value['sellist']['6'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="challenger_'.$key.'_7">'.$value['sellist']['7'].'</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="fill_click" id="challenger_'.$key.'_8">'.$value['sellist']['8'].'</td>';
				    echo '</tr>';
			    echo '</table>';
			}elseif($value['type']==TYPE_NON){
				echo '<div class="non_mask"></div>';
				$image_src1 = "material/answer_wrong.png";
				$image_src2 = "material/answer_wrong.png";
				switch (intval($value['answer'])) {
					case '1':
						$image_src1 = "material/answer_right.png";
						break;
					case '2':
						$image_src2 = "material/answer_right.png";
						break;
					default:
						$image_src1 = "material/answer_right.png";
						break;
				}
				echo '<img class="non_answer non_answer_one" id="challenger_'.$key.'_1_non_answer" src="'.$image_src1.'" alt="图片无法显示" />';
				echo '<img class="non_answer non_answer_two" id="challenger_'.$key.'_2_non_answer" src="'.$image_src2.'" alt="图片无法显示" />';
				echo '<table class="non" id="challenger_non_'.$key.'_'.$value['answer'].'">';
				    echo '<tr>';
				       echo '<td class="non_click" id="challenger_'.$key.'_1">是</td>';
				       echo '<td class="none"></td>';
				       echo '<td class="non_click" id="challenger_'.$key.'_2">否</td>';
				    echo '</tr>';
				echo '</table>';
			}else{
				echo '<div class="word_mask"></div>';
				$image_src1 = "material/answer_wrong.png";
				$image_src2 = "material/answer_wrong.png";
				$image_src3 = "material/answer_wrong.png";
				$image_src4 = "material/answer_wrong.png";

				switch (intval($value['answer'])) {
					case '1':
						$image_src1 = "material/answer_right.png";
						break;
					case '2':
						$image_src2 = "material/answer_right.png";
						break;
					case '3':
						$image_src3 = "material/answer_right.png";
						break;
					case '4':
						$image_src4 = "material/answer_right.png";
						break;
					default:
						$image_src1 = "material/answer_right.png";
						break;
				}
				echo '<img class="word_answer one" id="challenger_'.$key.'_1_word_answer" src="'.$image_src1.'" alt="图片无法显示" />';
				echo '<img class="word_answer two" id="challenger_'.$key.'_2_word_answer" src="'.$image_src2.'" alt="图片无法显示" />';
				echo '<img class="word_answer three" id="challenger_'.$key.'_3_word_answer" src="'.$image_src3.'" alt="图片无法显示" />';
				echo '<img class="word_answer four" id="challenger_'.$key.'_4_word_answer" src="'.$image_src4.'" alt="图片无法显示" />';
				echo '<table class="word" id="challenger_word_'.$key.'_'.$value['answer'].'">';

					echo '<tr>';
				       echo '<td class="word_click" id="challenger_'.$key.'_1">'.$value['sellist']['1'].'</td>';
				       
				       echo '<td class="none"></td>';
				       echo '<td class="word_click" id="challenger_'.$key.'_2">'.$value['sellist']['2'].'</td>';
				       
				    echo '</tr>';
				    echo '<tr class="none">';
				      echo '<td></td>';
				      echo '<td class="none"></td>';
				      echo '<td></td>';
				    echo '</tr>';
				    echo '<tr>';
				      echo '<td class="word_click" id="challenger_'.$key.'_3">'.$value['sellist']['3'].'</td>';
				      
				      echo '<td class="none"></td>';
				      echo '<td class="word_click" id="challenger_'.$key.'_4">'.$value['sellist']['4'].'</td>';
				      
				   echo '</tr>';
				echo '</table>';
			}
			echo '</section>';
			echo '</div>';
		}
	?>	
<script type="text/javascript" src="js/auto.js"></script>
<script type="text/javascript">
	var current_key = 0;//当前序号
	var challenger_current_key = 0;//挑战者当前序号
	var timeout = false;//是否超时
	var time_stop = false;//是否停止计时
	var max_number = 10;//题目数量
	var right_number = 0;//正确题数
	var answer_option = '';//选择的答案
	var qid = <?php echo $qlist['recipient']['0']['qid']?>//题目(套)编号
	var challenger_answers = new Array();//挑战者题目答案
	var challenger_types = new Array();//挑战者题目类型

	$(function(){
		<?php 
			foreach ($qlist['challenger'] as $key => $value) {
				echo 'challenger_answers['.$key.']='.$value['q_option'].';';
			}
		?>
	});
	$(function(){
		<?php 
			foreach ($qlist['challenger'] as $key => $value) {
				echo 'challenger_types['.$key.']='.$value['type'].';';
			}
		?>
	});
	//宽高自适应
	var height = $(document).height();
	var thingsheight = 707;
	var separated = ((height-thingsheight)/3)+'px';
	$('.answer').css('bottom',separated);
	separated = ((height-thingsheight)/3)+'px';
	$('.blackboard_one').css('top',separated);
	$('.blackboard_two').css('top',separated);
	//隐藏
	$('.main').hide();
	$('.right').hide();
	$('.wrong').hide();
	$('#main_0').show();
	$('.word_answer').hide();
	$('.non_answer').hide();
    //计时器
    function time(time_id){
    	var first_enter = true;
    	var remain_time =parseInt($(time_id).text());
    	var set_id = self.setInterval(SetRemainTime,10);
    	function SetRemainTime(){
    		if(!time_stop){
    			if(remain_time>0.00){
	       			if((remain_time-0.01)<10) $(time_id).html('0'+(remain_time-0.01).toFixed(2));  
	        		else $(time_id).html((remain_time-0.01).toFixed(2));  
	        		remain_time=remain_time-0.01;
		        }else{
		        	if(!first_enter) return;
		        	first_enter = false;
		        	$(time_id).html('00.00');
		        	var main_id = '#main_'+current_key;
		        	if(answer_option == '') answer_option = qid+"|"+'1';
					else answer_option = answer_option+"|"+qid+"|"+'1';
					$(main_id).hide('slow',function(){
						var challenger_id = '#challenger_main_'+challenger_current_key;
						$(challenger_id).show('slow',function(){
							var type=challenger_types[challenger_current_key];
							var challenger_time_id = challenger_current_key+1;
							challenger_time_id = '#challenger_time_'+challenger_time_id;
							time(challenger_time_id);
							if(type==2){
								setTimeout(function(){
									time_stop = true;
									var challenger_fill_image_id = '#challenger_'+challenger_current_key+'_image_wrong';
									$(challenger_fill_image_id).show('slow',function(){
										var challenger_main_id = '#challenger_main_'+challenger_current_key;
										$(challenger_main_id).hide('slow',function(){
											challenger_current_key++;
											current_key++;
											var next_main_id = '#main_'+current_key;
											$(next_main_id).show('slow',function(){
												time_stop = false;
												key_toInt = parseInt(current_key)+1;
												var time_id = '#time_'+key_toInt;
												time(time_id);
											});
										});
									});									
								},5000);
							}else if(type==4){
								setTimeout(function(){
									time_stop = true;
									var challenger_answer_id = '#challenger_'+challenger_current_key+'_'+challenger_answers[challenger_current_key]+'_non_answer';
									$(challenger_answer_id).show('slow',function(){
										var challenger_main_id = '#challenger_main_'+challenger_current_key;
										$(challenger_main_id).hide('slow',function(){
											challenger_current_key++;
											current_key++;
											var next_main_id = '#main_'+current_key;
											$(next_main_id).show('slow',function(){
												time_stop = false;
												key_toInt = parseInt(current_key)+1;
												var time_id = '#time_'+key_toInt;
												time(time_id);
											});
										});
									});									
								},5000);
							}else{
								setTimeout(function(){
									time_stop = true;
									var challenger_answer_id = '#challenger_'+challenger_current_key+'_'+challenger_answers[challenger_current_key]+'_word_answer';
									$(challenger_answer_id).show('slow',function(){
										var challenger_main_id = '#challenger_main_'+challenger_current_key;
										$(challenger_main_id).hide('slow',function(){
											challenger_current_key++;
											current_key++;
											var next_main_id = '#main_'+current_key;
											$(next_main_id).show('slow',function(){
												time_stop = false;
												key_toInt = parseInt(current_key)+1;
												var time_id = '#time_'+key_toInt;
												time(time_id);
											});
										});
									});									
								},5000);
							}
						});

					});

					/*
		        	$(main_id).hide('slow').next().show('slow',function(){
		        		current_key++;
		        		if(current_key<max_number){
		        			var next_time_id = current_key+1;
		        			next_time_id = '#time_'+next_time_id;
		        			time(next_time_id);  
		        		}else{
		        			$("form")[0].answer_option.value = answer_option;
    						$("form")[0].right_number.value = right_number;
    						$("form")[0].submit(); 
		        		}
      		
		        	});*/
		        }
    		}else{
    			window.clearInterval(set_id);
    		}
    	}
    };
    //第一题计时器
    time('#time_1');

    //是非题
    $('.non_click').click(function(){
		time_stop = true;
		current_key++;
		var answer = $(this).parents('.non').attr('id').substring(2);
		var key = $(this).parents('.non').attr('id').substring(4,5);
		var choose = $(this).attr('id').substring(2);
		var image_name = '#'+key+'_'+choose+'_non_answer';
		var main_id = '#main_'+key;
		if(answer_option == '') answer_option = qid+"|"+choose;
		else answer_option = answer_option+"|"+qid+"|"+choose;
		if(choose==answer){
			right_number++;
		}
		$(image_name).show('slow',function(){
			if(challenger_current_key<=max_number){
				time_stop=false;
				$(this).parents(main_id).hide('slow');
				var challenger_current_main_id = '#challenger_main_'+challenger_current_key;
				var current_main_id = '#main_'+current_key;
				$(challenger_current_main_id).show('slow',function(){
					var challenger_answer_choose_id = '#challenger_'+challenger_current_key+'_'+challenger_answers[challenger_current_key]+'_non_answer';
					var challenger_time_id  = challenger_current_key+1;
					challenger_time_id = '#challenger_time_'+challenger_time_id;
					time(challenger_time_id);
					challenger_current_key++;
					setTimeout(function(){
						time_stop=true;
						$(challenger_answer_choose_id).show('slow',function(){
							$(challenger_current_main_id).hide('slow',function(){
								$(current_main_id).show('slow',function(){
									time_stop = false;
									key_toInt = parseInt(key)+2;
									var time_id = '#time_'+key_toInt;
									time(time_id);
								});
							});
						});
					},4000);
				});
			}else{
				$("form")[0].answer_option.value = answer_option;
    			$("form")[0].right_number.value = right_number;
    			$("form")[0].submit(); 
			}
		});
	})
	//普通题
	$('.word_click').click(function(){
		time_stop = true;
		current_key++;
		var answer = $(this).parents('.word').attr('id').substring(2);
		var key = $(this).parents('.word').attr('id').substring(5,6);
		var choose = $(this).attr('id').substring(2);
		var image_name = '#'+key+'_'+choose+'_word_answer';
		var main_id = '#main_'+key;
		if(answer_option == '') answer_option = qid+"|"+choose;
		else answer_option = answer_option+"|"+qid+"|"+choose;
		if(choose==answer){
			right_number++;
		}
		$(image_name).show('slow',function(){
			if(challenger_current_key<=max_number){
				time_stop=false;
				$(this).parents(main_id).hide('slow');
				var challenger_current_main_id = '#challenger_main_'+challenger_current_key;
				var current_main_id = '#main_'+current_key;
				$(challenger_current_main_id).show('slow',function(){
					var challenger_answer_choose_id = '#challenger_'+challenger_current_key+'_'+challenger_answers[challenger_current_key]+'_word_answer';
					challenger_current_key++;
					var challenger_time_id = '#challenger_time_'+challenger_current_key;
					time(challenger_time_id);
					setTimeout(function(){
						time_stop=true;
						$(challenger_answer_choose_id).show('slow',function(){
							$(challenger_current_main_id).hide('fast',function(){
								$(current_main_id).show('slow',function(){
									time_stop = false;
									key_toInt = parseInt(key)+2;
									var time_id = '#time_'+key_toInt;
									time(time_id);
								});
							});
						});
					},5000);
				});
			}else{
				$("form")[0].answer_option.value = answer_option;
    			$("form")[0].right_number.value = right_number;
    			$("form")[0].submit(); 
			}
		});
	});
	//填空题
	var fill_click_num =0;
	var fill_choose = '';
	var fill_choose_value = '';
	$('.fill_click').click(function(){
		fill_click_num++;
		var fill_answer = $(this).parents('.fill').attr('id').substring(2);
		var fill_key = $(this).parents('.fill').attr('id').substring(0,1);
		var main_id = '#main_'+fill_key;
		fill_choose = fill_choose+$(this).attr('id').substring(2);
		fill_choose_value = fill_choose_value+$(this).text();
		var question_id = '#question_'+fill_key;
		var question = $(question_id).text().substr(0,$(question_id).text().length-fill_answer.toString().length);
		question = question+fill_choose_value;
		for(var k=0;k<fill_answer.toString().length-fill_click_num;k++){
			question = question+'＿';
		}
		$(question_id).text(question);
		if(fill_click_num==fill_answer.toString().length){
			if(answer_option == '') answer_option = qid+"|"+fill_choose;
			else answer_option = answer_option+"|"+qid+"|"+fill_choose;
			time_stop = true;
			current_key++;
			if(fill_choose==fill_answer){
				right_number++;
				var image_name = '#'+fill_key+'_image_right';
			}else{
				var image_name = '#'+fill_key+'_image_wrong';
			}
			$(image_name).show('slow',function(){
				if(challenger_current_key<=max_number){
					time_stop=false;

					$(this).parents(main_id).hide('slow');
					var challenger_current_main_id = '#challenger_main_'+challenger_current_key;
					var current_main_id = '#main_'+current_key;
					$(challenger_current_main_id).show('slow',function(){
						var challenger_answer_choose_id = '#challenger_'+challenger_current_key+'_image_wrong';
						challenger_current_key++;
						var challenger_time_id = '#challenger_time_'+challenger_current_key;
						time(challenger_time_id);
						setTimeout(function(){
							time_stop=true;
							$(challenger_answer_choose_id).show('slow',function(){
								$(challenger_current_main_id).hide('slow',function(){
									$(current_main_id).show('slow',function(){
										time_stop = false;
										var key_toInt = parseInt(fill_key)+2;
										var time_id = '#time_'+key_toInt;
										time(time_id);
										fill_click_num=0;
										fill_choose='';
										fill_choose_value='';
									});
								});
							});
						},5000);
					});
					/*
					$(this).parents('.main').hide('slow').next().show('slow');
					time_stop = false;
					key_toInt = parseInt(fill_key)+2;
					var time_id = '#time_'+key_toInt;
					time(time_id);
					fill_click_num=0;
					fill_choose='';
					fill_choose_value='';
					*/
				}else{
					$("form")[0].answer_option.value = answer_option;
    				$("form")[0].right_number.value = right_number;
    				$("form")[0].submit(); 
					//location.href='carnival_result.php';
				}

			});
		}else{
			//重选
		    $('.rechoose').click(function(){
		    	fill_click_num = 0;//重置点击次数
		    	fill_choose_value = '';//重置选择的答案内容
		    	fill_choose = '';//重置选择的答案编号
		    	var rechoose_question = $(question_id).text().substr(0,$(question_id).text().length-fill_answer.toString().length);
		    	for(var t=0;t<fill_answer.toString().length;t++){
		    		rechoose_question = rechoose_question+'＿';
		    	}
		    	$(question_id).text(rechoose_question);
		    });
		}
	});
	//触摸题覆盖层初始化
	$(function(){	
		var canvas_id = '';
		for(var key=0;key<10;key++){
			canvas_id = 'canvas_'+key;
			var j_canvas_id ='#'+canvas_id;
			if($(j_canvas_id).length>0) drawCanvas();
		}
		function drawCanvas(){
			var canvas = document.getElementById(canvas_id);
			var cont = canvas.getContext('2d');
			var drawflag = false;
			var x1, y1;
			var x2, y2;
			var isTouchPad = (/hp-tablet/gi).test(navigator.appVersion), 
				hasTouch = 'ontouchstart' in window && !isTouchPad,
				START_EV = hasTouch ? 'touchstart' : 'mousedown',
				MOVE_EV = hasTouch ? 'touchmove' : 'mousemove',
				END_EV = hasTouch ? 'touchend' : 'mouseup';
		        drawFace();
		  	function drawFace() {
	  			canvas.addEventListener(START_EV,mousedown,true);
				canvas.addEventListener(MOVE_EV,mousemove,true);
				canvas.addEventListener(END_EV,mouseup,true);
				var myImage = new Image();
				myImage.src = "material/scratch.png";
				cont.drawImage(myImage,0,0);
			}
			function mousedown(e){
			    var point = hasTouch ? e.touches[0] : e;
				x1 = (point.pageX - canvas.left());
				y1 = (point.pageY - canvas.top());
				drawflag = true;
			}
			function mouseup(e){
				drawflag = false;
			}
			function mousemove(e){
			    var point = hasTouch ? e.touches[0] : e;
				x2 = (point.pageX - canvas.left());
				y2 = (point.pageY - canvas.top());
				if(drawflag) clearUp();
				x1 = x2;
				y1 = y2;
			}
			function clearUp(){
				cont.save();
				cont.translate(0, 0);
				cont.globalCompositeOperation="destination-out";
				cont.moveTo(x1, y1);
				cont.lineTo(x2, y2);
				cont.lineWidth = 16;
				cont.lineJoin = "round";
				cont.stroke();
				cont.restore();
			}
			canvas.top = function(){
				var offset=this.offsetTop;
				if(this.offsetParent!=null) offset+=getTop(this.offsetParent);
				return offset;
			}
			canvas.left = function(){
				var offset=this.offsetLeft;
				if(this.offsetParent!=null) offset+=getLeft(this.offsetParent);
				return offset;
			}
			function getTop(e){
				var offset=e.offsetTop;
				if(e.offsetParent!=null) offset+=getTop(e.offsetParent);
				return offset;
			}
			function getLeft(e){
				var offset=e.offsetLeft;
				if(e.offsetParent!=null) offset+=getLeft(e.offsetParent);
				return offset;
			} 
		}
	});
</script>

</body>
</html>