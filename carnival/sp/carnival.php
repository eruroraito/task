<?php
    ini_set("display_errors", 0);
	require_once 'callgs.php';
	require_once 'config.php';
	//require_once 'question.php';
	session_start();	
	$qlist = $_SESSION['qlist'];
	//print_r($_SESSION['qlist']);
	$_SESSION['start_time'] = time();//答题开始时间
?>
<?php require_once 'header.php';?>
<link type="text/css" rel="stylesheet" href="css/carnival_main.css" />
</head>
<body ontouchmove="event.preventDefault()">
	<div class="basic" id='basic'>
		<aside id="aside">请把机器竖起来哦~亲!</aside>
	</div>
	<div class="sky_blue"></div>
	<div class="dark_blue"></div>
		
	<form action="carnival_result.php" method="post" id="result_form">
		<input type ="hidden" name="answer_option" />
		<input type ="hidden" name="right_number" />
	</form>
	<!--
	<audio autoplay="autoplay" id="audio">
  		<source src="music/background.mp3" type="audio/mpeg" />
		Your browser does not support the audio element.
	</audio>
	-->
	<?php 
		foreach ($qlist['recipient'] as $key => $value) {
			echo '<div class="main" id="main_'.$key.'">';
			echo '<section class="blackboard_one" id="blackboard_one_'.$key.'">';
				if($value['type']==TYPE_WORD){
					echo '<div class="question justword" id="question_'.$key.'">'.$value['ques'].'</div>';
				}elseif($value['type']==TYPE_IMAGE){
					echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
					echo '<div class="image">';
						echo '<img src="../mr/icon/'.$value['pic_serial'].'.jpg" alt="图片无法显示" />';
					echo '</div>';
				}elseif($value['type']==TYPE_FILL){
					if($value['pic_serial']==0){
						echo '<div class="question" id="question_'.$key.'">'.$value['ques'].'</div>';
						echo '<div class="image">';
							echo '<img class="right" id="'.$key.'_image_right" src="material/right.png" alt="图片无法显示" />';
							echo '<img class="wrong" id="'.$key.'_image_wrong" src="material/wrong.png" alt="图片无法显示" />';
						echo '</div>';
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
						echo '<div class="question justword" id="question_'.$key.'">'.$value['ques'].'</div>';
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
				       //echo '<img class="non_answer non_answer_one" id="'.$key.'_1_non_answer" src="'.$image_src1.'" alt="图片无法显示" />';
				       echo '<td class="none"></td>';
				       echo '<td class="non_click" id="'.$key.'_2">否</td>';
				       //echo '<img class="non_answer non_answer_two" id="'.$key.'_2_non_answer" src="'.$image_src2.'" alt="图片无法显示" />';
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
<script type="text/javascript" src="js/auto.js"></script>
<script type="text/javascript">
	var current_key = 0;//当前序号
	var timeout = false;//是否超时
	var time_stop = false;//是否停止计时
	var max_number = 10;//题目数量
	var right_number = 0;//正确题数
	var answer_option = '';//选择的答案
	var qid = <?php echo $qlist['recipient']['0']['qid']?>

	var height = $(document).height();
	var thingsheight = 707;
	var separated = ((height-thingsheight)/3)+'px';
	$('.answer').css('bottom',separated);
	separated = ((height-thingsheight)/3)+'px';
	$('.blackboard_one').css('top',separated);
	$('.blackboard_two').css('top',separated);

	$('#main_0').show();

	//音乐播放
	function replaymusic(){
		//document.getElementById("audio").load();
		//document.getElementById("audio").play();
	}

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
		        	$(main_id).hide('slow').next().show('slow',function(){
		        		replaymusic();
		        		current_key++;
		        		if(current_key<max_number){
		        			replaymusic();
		        			var next_time_id = current_key+1;
		        			next_time_id = '#time_'+next_time_id;
		        			time(next_time_id);  
		        		}else{
		        			$("form")[0].answer_option.value = answer_option;
    						$("form")[0].right_number.value = right_number;
    						$("form")[0].submit(); 
		        		}
      		
		        	});
		        }
    		}else{
    			window.clearInterval(set_id);
    		}
    	}
    };

    time('#time_1');
    //是非题
    var non_click = false;
    $('.non_click').click(function(){
    	if(non_click) return;
    	$(this).css('background-image','url(material/non_answer_mousedown.png)');
    	non_click = true;
		time_stop = true;
		current_key++;
		var answer = $(this).parents('.non').attr('id').substring(6);
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
			if(current_key<max_number){
				$(this).parents(main_id).hide('slow').next().show('slow',function(){
					replaymusic();
					non_click = true;
					time_stop = false;
					key_toInt = parseInt(key)+2;
					var time_id = '#time_'+key_toInt;
					time(time_id);
				});

			}else{
				$("form")[0].answer_option.value = answer_option;
    			$("form")[0].right_number.value = right_number;
    			$("form")[0].submit(); 
			}
		});
	})
    //普通题
    var word_click = false;
	$('.word_click').click(function(){
		if(word_click) return;
		$(this).css('background-image','url(material/word_answer_mousedown.png)');
		word_click = true;
		time_stop = true;
		current_key++;
		var answer = $(this).parents('.word').attr('id').substring(7);
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
			if(current_key<max_number){
				$(this).parents(main_id).hide('slow').next().show('slow',function(){
					replaymusic();
					word_click = false;
					time_stop = false;
					key_toInt = parseInt(key)+2;
					var time_id = '#time_'+key_toInt;
					time(time_id);
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
		if(fill_click_num>fill_answer.toString().length) return;
		$(this).css('background-image','url(material/fill_answer_mousedown.png)');
		var fill_key = $(this).parents('.fill').attr('id').substring(0,1);
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
				if(current_key<max_number){
					$(this).parents('.main').hide('slow').next().show('slow',function(){
							replaymusic();
							time_stop = false;
							key_toInt = parseInt(fill_key)+2;
							var time_id = '#time_'+key_toInt;
							time(time_id);
							fill_click_num=0;
							fill_choose='';
							fill_choose_value='';
						});
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
		    	$('.fill_click').css('background-image','url(material/fill_answer.png)');
		    	fill_click_num = 0;//重置点击次数
		    	fill_choose_value = '';//重置选择的内容
		    	fill_choose = '';//重置选择的答案编号
		    	var rechoose_question = $(question_id).text().substr(0,$(question_id).text().length-fill_answer.toString().length);
		    	for(var t=0;t<fill_answer.toString().length;t++){
		    		rechoose_question = rechoose_question+'＿';
		    	}
		    	$(question_id).text(rechoose_question);
		    });
		}
	});
	
	$('.fill_click').mousedown(function(){
		return;
	});
	//触摸题初始化
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