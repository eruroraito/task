<?php
	//$voteall[0] = 1;
    ini_set("display_errors", 0);
	require_once 'callgs.php';
	require_once 'config.php';
	//require_once 'qlist_rs.php';
	session_start();
	
	$gdp = new GsServer();
	$param_nv = array();
	///*
	$aid    = $_REQUEST['aid'];
	if($aid == null || $aid == '' || (!is_numeric($aid)))
	    $aid = 1;
	$param_nv['qtitleid'] = $aid;
	$cmdcode = "qlist";	
	$voteall = $gdp->execGmCmd($param_nv,$cmdcode);
    $_SESSION['qlist']= $voteall;
    $prop_free = E_PROPS_FREE_NUM;
    $prop_half = E_PROPS_HALFDIFFICULTY_NUM;

    function getid()
    {
    	//return $q_option_id;
    }


?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">

<html id='html_id'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5,minimum-scale=0.5, maximum-scale=1.0, user-scalable=no" /> 
<link href="mystyle.css" rel="stylesheet" type="text/css"/>
<title>答题</title>
<meta name="keywords" content="test" />
<meta name="description" content="test" />

<style type="text/css">
	html {background:#808080;height:980px;}
	body {font-size:34px;width: 640px;}
</style>
</head>
<script>
	new Image().src = "pics/choose_up.png";
	new Image().src = "pics/background_4_02.png";
	new Image().src = "pics/button_wx.png";
	new Image().src = "pics/challenge_bg.png";
	new Image().src = "pics/choose_nor.png";
	new Image().src = "pics/error_b.png";
	new Image().src = "pics/main_bg.jpg";
	new Image().src = "pics/web_text.png";
	new Image().src = "pics/web_01_nor.png";
	new Image().src = "pics/scratch.png";
</script>
<script language="javascript">
	//alert(window.screen.height)

	var curid = 0;
	var curcid = 0;
	var maxid = <?php echo E_QUESTIN_MAX; ?>;
	var rslist = "";
	var ifclick = 0;
	var maxchoose = 0;
	var blank_fill = 0;
	var origin = -1;
	var locked = false;
	var fill_answer = "";
	var props_free_used = false;
	var props_half_used = false;
	var right_num = 0;
	var start_time = 0;
	var end_time = 0;
	var clock = false;
	var ifc = false;
	var total = 0;
	var q_ret = <?php echo E_WEIXINHELP;?> 
	var fluent = <?php 
						if (array_key_exists('challenger',$voteall)) echo 1;
						else echo 0;
				?>;
	
	function orientationChange(){   
		switch(window.orientation) {   
			case 0: document.getElementById('basic').style.display="none";  
			case 180: document.getElementById('basic').style.display="none";   
			// Javascript to setup Portrait view   
			break;   
			case -90: document.getElementById('basic').style.display="block"; 			  
			case 90: document.getElementById('basic').style.display="block";
			// Javascript to steup Landscape view   
			break;   
		}   
	}   
	window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", orientationChange, false);

	function ret_right()
	{
		return right_num;
	}

    function redirect()
    {
        setTimeout(redt,5000);
    }

    function redt()
    {
        document.getElementById('load_div').style.display = "none";
        document.getElementById('loaded_div').style.display = "";
    }

    function answer(time)
    {
    	document.getElementById('loaded_div').style.display = "none";
        document.getElementById('answer').style.display = "";       
        document.getElementById('html_id').style.background = "url(pics/main_bg.jpg)";
        countdown(0,time);
        start_time = new Date().getTime()/1000;
    }

	function countdown(time_id,duration)
	{
		//alert('time_id'+time_id);
		if(time_id>=<?php echo E_QUESTIN_MAX; ?>) return;
		duration=duration*1000; 
		var endTime = new Date().getTime() + duration + 100;

		if(ifc) var t_id = 'ctime'+(time_id);
		else var t_id = 'time'+time_id;
		//if(time_id==9) alert(duration);
		//alert('t_id'+t_id);
		interval();

		function interval()
		{
		    var n=(endTime-new Date().getTime());	    
		   if(n<=0) {
		   	//return;
		        document.getElementById(t_id).innerHTML = "00.00";
		        if(time_id==curid)
		        {
		        	//if(time_id==9) alert(000);
		        	ifclick = 1;
		       	    clock = true;
		       	    //alert(time_id);		
		       		nextqa(time_id,duration/1000);
		       		ifclick = 0;
		        }

				return ;
		    }
		    if(document.getElementById(t_id).innerHTML<10)
		    {
		    	document.getElementById(t_id).innerHTML = '0'+(n/1000).toFixed(2);
		    }
		    	
			else
				document.getElementById(t_id).innerHTML = (n/1000).toFixed(2);
		    setTimeout(interval, 10);
		}
	}

	function nextqa(qid,duration)
	{
		if(ifclick ==0)
		{
			alert('请选择答案');
			return false;
		}
		else
		{
			ifclick = 0;
			maxchoose = 0;
			blank_fill =0;
			origin = -1;
			locked = false;
			fill_answer = "";
			props_free_used = false;
			props_half_used = false;
		}			
		curdiv  = "q"+curid;
		curid 	= curid+1;
		nextdiv = "q"+curid;

		function truequestion()
		{

			var id_flag = 0;
			if(clock) 
			{
				id_flag =qid;
			}
			else
			{
				id_flag = qid-1;
			}
			
			if(total ==0)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][0]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][0]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][0]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][0]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][0]['fill_num'];else echo 0;?>;
			}
			if(total ==1)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][1]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][1]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][1]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][1]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][1]['fill_num'];else echo 0;?>;
			}
			if(total ==2)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][2]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][2]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][2]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][2]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][2]['fill_num'];else echo 0;?>;
			}
			if(total ==3)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][3]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][3]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][3]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][3]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][3]['fill_num'];else echo 0;?>;
			}
			if(total ==4)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][4]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][4]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][4]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][4]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][4]['fill_num'];else echo 0;?>;
			}
			if(total ==5)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][5]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][5]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][5]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][5]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][5]['fill_num'];else echo 0;?>;
			}
			if(total ==6)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][6]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][6]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][6]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][6]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][6]['fill_num'];else echo 0;?>;
			}
			if(total ==7)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][7]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][7]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][7]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][7]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][7]['fill_num'];else echo 0;?>;
			}
			if(total ==8)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][8]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][8]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][8]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][8]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][8]['fill_num'];else echo 0;?>;
			}
			if(total ==9)
			{
				var c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][9]['q_option'];
										else echo 0;?>;
				var t_c_answer = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][9]['answer'];else echo 0;?>;
				var c_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][9]['type'];else echo 0;?>;
				var c_option_num = <?php if(array_key_exists('challenger',$voteall)) echo count($voteall['challenger'][9]['sellist']);else echo 0;?>;
				var c_answer_num = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][9]['fill_num'];else echo 0;?>;
			}

			total++;
			/*
			var c_answer = <?php echo $voteall['challenger'][getid($q_option_id)]['q_option'];?>;//选择的选项
			var t_c_answer = <?php echo $voteall['challenger'][getid($q_option_id)]['answer'];?>;//正确答案
			var c_type = <?php echo $voteall['challenger'][getid($q_option_id)]['type'];?>;//题目类型
			var c_option_num = <?php echo count($voteall['challenger'][getid($q_option_id)]['sellist']);?>;//答案选项的数目
			var c_answer_num = <?php echo $voteall['challenger'][getid($q_option_id)]['fill_num'];?>;//正确答案包含的选项数目
			*/
			if(c_answer==t_c_answer)
			{
				if(c_type==<?php echo E_QUESTION_TYPE_FILL;?>)
				{
					var ans = new Array();
		 			for(var i=0;i<c_answer_num;i++)
		 			{

		 				ans[i] = t_c_answer.toString().substring(i,i+1);	
		 				ans[i] = parseInt(ans[i])+60;	 
		 				ans[i] = ans[i]+''+id_flag;	
		 				if(c_option_num==4)
						{
							document.getElementById(ans[i]).style.background="url(pics/choose_up.png)";
						}
						else
						{
							document.getElementById(ans[i]).style.background="url(pics/fill_up.png)";
						}			
		 			}
		 			var image_id = 'cimage'+id_flag+'right';
		 			document.getElementById(image_id).style.display="block";
				}
				else
				{
					var show = t_c_answer + 80;
					show = show+id_flag.toString();
					//alert(show);
					document.getElementById(show).innerHTML += "<span class='right'>"+"right"+"</span>";
					document.getElementById(show).style.background="url(pics/choose_up.png)";
				}
				
			}
			else
			{
				if(c_type==<?php echo E_QUESTION_TYPE_FILL;?>)
				{
					var ans = new Array();
		 			for(var i=0;i<c_answer_num;i++)
		 			{

		 				ans[i] = c_answer.toString().substring(i,i+1);	
		 				if(ans[i]!=0) {
			 				ans[i] = parseInt(ans[i])+60;	 
			 				ans[i] = ans[i]+''+id_flag;	
			 				if(c_option_num==4)
							{
								document.getElementById(ans[i]).style.background="url(pics/choose_up.png)";
							}
							else
							{
								document.getElementById(ans[i]).style.background="url(pics/fill_up.png)";
							}	
		 				}
		
		 			}
		 			var image_id = 'cimage'+id_flag+'wrong';
		 			document.getElementById(image_id).style.display="block";
				}
				else
				{
					if(c_answer>4||c_answer<1) c_answer = 1;
					var show = c_answer + 80;
					show = show+id_flag.toString();
					var true_show = t_c_answer +80;
					true_show = true_show+id_flag.toString();
					document.getElementById(show).innerHTML += "<span class='wrong'>"+"wrong"+"</span>";
					document.getElementById(show).style.background="url(pics/choose_up.png)";
					document.getElementById(true_show).innerHTML += "<span class='right'>"+"right"+"</span>";
					document.getElementById(true_show).style.background="url(pics/choose_up.png)";
				}
			}
			//}
			setTimeout(function(){				
				document.getElementById(curcdiv).style.display = "none";
				document.getElementById(nextdiv).style.display = "";
				//alert('正常'+qid);
				ifc = false;
				if(clock) 
				{
					clock = false;
					countdown(qid+1,duration);
				}
				else countdown(qid,duration);},1000);
			//document.getElementById(id_flag).innerHTML += "<span class='right'>"+"right"+"</span>";		
		}
		curcdiv = "c"+curcid;
		curcid = curcid+1;
		nextcdiv = "c"+curcid;

		if(!fluent)
		{
			//alert(curid);
			if(curid<maxid){
				document.getElementById(curdiv).style.display = "none";			
				document.getElementById(nextdiv).style.display = "";
				if(clock) {
					clock = false;
					countdown(qid+1,duration);
				}else countdown(qid,duration);
			}else{
					setTimeout(function(){
						document.getElementById('html_id').style.background = "url(pics/background_4_02.png)";
						document.getElementById('answer').style.display = "none";
						document.getElementById('result').style.display = "";

						end_time = new Date().getTime()/1000;
						var time_diff = parseInt(end_time - start_time);
						var ptime = time_diff;
		
						document.getElementById('challenge').style.display = "none";
						document.getElementById('right_num').innerHTML = right_num;
						var right_result = percent(right_num);
						document.getElementById('rank').innerHTML = right_result;
						time_diff = timedeal(time_diff);
						document.getElementById('time_help').innerHTML = time_diff;
							
						document.forms[0].rslist.value = rslist;
						document.forms[0].ptime.value  = ptime;
						document.forms[0].submit();		
						},1000);
			}

		}else{
			if(curcid<maxid)
			{
				//alert(curid);
				//alert(curcid);
				document.getElementById(curdiv).style.display = "none";			
				document.getElementById(curcdiv).style.display = "";
				ifc = true;
				//alert('回放'+(qid-1));
				var question_type = 0;
				if(clock){
					countdown(qid,duration);
					if(qid==1) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][1]['type'];else echo 0;?>;
					if(qid==2) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][2]['type'];else echo 0;?>;
					if(qid==3) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][3]['type'];else echo 0;?>;
					if(qid==4) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][4]['type'];else echo 0;?>;
					if(qid==5) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][5]['type'];else echo 0;?>;
					if(qid==6) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][6]['type'];else echo 0;?>;
					if(qid==7) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][7]['type'];else echo 0;?>;
					if(qid==8) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][8]['type'];else echo 0;?>;
					if(qid==9) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][9]['type'];else echo 0;?>;
				} else {
					countdown(qid-1,duration);
					if(qid==1) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][0]['type'];else echo 0;?>;
					if(qid==2) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][1]['type'];else echo 0;?>;
					if(qid==3) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][2]['type'];else echo 0;?>;
					if(qid==4) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][3]['type'];else echo 0;?>;
					if(qid==5) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][4]['type'];else echo 0;?>;
					if(qid==6) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][5]['type'];else echo 0;?>;
					if(qid==7) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][6]['type'];else echo 0;?>;
					if(qid==8) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][7]['type'];else echo 0;?>;
					if(qid==9) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][8]['type'];else echo 0;?>;
					if(qid==10) question_type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger'][9]['type'];else echo 0;?>;
				}
				var time_tra = parseInt(Math.random()*2+4)*1000;
				if(question_type==3)  time_tra = parseInt(Math.random()*2+7)*1000;
				
				setTimeout(truequestion,time_tra);
			
			}else
			{	
				document.getElementById(curdiv).style.display = "none";			
				document.getElementById(curcdiv).style.display = "";
				ifc = true;	
				countdown(9,20);
				setTimeout(function(){
					document.getElementById('html_id').style.background = "url(pics/background_4_02.png)";
					document.getElementById('answer').style.display = "none";
					document.getElementById('result').style.display = "";
					//var type = <?php echo $voteall['challenger']['q_ret'];?>;
					var type = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger']['q_ret'];else echo 0;?>;
					end_time = new Date().getTime()/1000;
					var time_diff = parseInt(end_time - start_time);
					var ptime = time_diff;
					//var ptime = 30;
					if(type ==1)
					{
						document.getElementById('challenge').style.display = "none";
						document.getElementById('right_num').innerHTML = right_num;
						var right_result = percent(right_num);
						document.getElementById('rank').innerHTML = right_result;
						time_diff = timedeal(time_diff);
						document.getElementById('time_help').innerHTML = time_diff;
					}
					else
					{
						document.getElementById('cha_name').style.display = "none";
						document.getElementById('help').style.display = "none";
						document.getElementById('right_num_chall').innerHTML = right_num;
						time_diff = timedeal(parseInt(time_diff/2));	
						document.getElementById('time_chall').innerHTML = time_diff;	
						//var cltime = <?php echo $voteall['challenger']['ques_role_cost_time'];?>;
						var cltime = <?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger']['ques_role_cost_time'];else echo 0?>;
						cltime = timedeal(cltime);	
						document.getElementById('time_challenger').innerHTML = cltime;
						ptime =  parseInt(ptime/2);
					}
					//alert(ptime);
					//if(<?php echo $voteall['challenger']['ques_role_correct_num']; ?>>right_num)
					if(<?php if(array_key_exists('challenger',$voteall)) echo $voteall['challenger']['ques_role_correct_num'];else echo 0?>>right_num)
					{
						document.getElementById('ifhigh').innerHTML = "看来我的知识要比你高一点点，实在是遗憾啊！";
					}			
					document.forms[0].rslist.value = rslist;
					document.forms[0].ptime.value  = ptime;
					document.forms[0].submit();		
					},3000);	
			}
		}


	}

	function timedeal(second)
	{	
		var result='00:00';
		if(second<0) alert('error');
		else if(second<10)
		{
			result = '00:0'+second;
		}
		else if(second<60)
		{
			result = '00:'+second;
		}
		else 
		{
			var minute = parseInt(second/60);
			var msecond = second-minute*60;
			if(minute<10)
			{
				if(msecond<10)
				{
					result = '0'+minute+':0'+msecond;
				}
				else
				{
					result = '0'+minute+':'+msecond;
				}
			}
			else
			{
				if(msecond<10)
				{
					result = minute+':0'+msecond;
				}
				else
				{
					result = minute+':'+msecond;
				}
			}
		}

		return result;
	}


	function percent(right_num)
	{
		var per = parseInt(Math.random()*2+1);
		var result = 0;
		if(per==1)
        {
            result = 35+right_num/<?php echo E_QUESTIN_MAX;?>/2*100;
        }
        else
        {
            result = 45+right_num/<?php echo E_QUESTIN_MAX;?>/2*100;
        }
        return result;
	}

	
	function getsel(qid,aid,type,inputid,answer_num,answer_id,true_answer,options_num,time)
	{

		ifclick = 1;
		if(type == 0||type == 1||type == 3)
		{
			if(rslist == "" || rslist == null)
			rslist = qid+"|"+answer_id;
			else
			rslist = rslist+"|"+qid+"|"+answer_id;
			if(locked)
			{
				return;
			}
			if(answer_id==true_answer)
			{
				document.getElementById(aid).innerHTML += "<span class='right'>"+"right"+"</span>";
				right_num++;		
			}
			else
			{
				true_answer = true_answer+30;
				true_answer = true_answer+''+qid;
				document.getElementById(true_answer).innerHTML += "<span class='right'>"+"right"+"</span>";	
				document.getElementById(aid).innerHTML += "<span class='wrong'>"+"wrong"+"</span>";	
			}
			locked = true;
			document.getElementById(aid).style.background="url(pics/choose_up.png)";

			setTimeout(function(){nextqa(qid,time);},1000);
			//setTimeout(function(){countdown(qid,time);},1000);
			
		}
		else if(type == 2)
		{
			if(locked)
			{
				return;
			}

			var checked = document.getElementById(inputid).checked;
			if(checked == true)
			{
				maxchoose++;
				if(maxchoose>answer_num)
				{
					document.getElementById(inputid).checked = false;
					return;
				}
				fill_answer = fill_answer+answer_id;
				if(options_num==4)
				{
					document.getElementById(aid).style.background="url(pics/choose_up.png)";
				}
				else
				{
					document.getElementById(aid).style.background="url(pics/fill_up.png)";
				}	
				var ques_id = "ques_cont" + qid;
				var str = document.getElementById(ques_id).innerHTML;
				if(origin==-1)
				{
					origin = str;
				}				
				var aidstr = document.getElementById(aid).innerHTML;
				var max = (answer_num-maxchoose+1);

				var fill_area_start = str.indexOf('＿'); //alert(fill_area_start);
				var fill_area_end = str.lastIndexOf('＿'); //alert(fill_area_end);

				var str1= str.slice(0,fill_area_start);//alert(str1);
				var str2= str.slice(fill_area_end+1);//alert(str2);

				


				//str = str.slice(0,-max);
				
				var laststr = '';
				for (var k=1;k<=answer_num-maxchoose;k++)
				{
					laststr = laststr+"＿";
				}
				str = str1+aidstr+laststr+str2;
				//alert(str);
				//document.getElementById(ques_id).innerHTML = str+"<a href='#' class='blank'>"+aidstr+"</a>"+"&nbsp;"+laststr;
				document.getElementById(ques_id).innerHTML = str;
				
				if(maxchoose==answer_num)
				{
					if(rslist == "" || rslist == null)
					rslist = qid+"|"+fill_answer;
					else
					rslist = rslist+"|"+qid+"|"+fill_answer;
					var image_id = 'qimage'+qid;

					if(fill_answer==true_answer)
					{	
						image_id = 	image_id+'right';			
						document.getElementById(image_id).style.display="block";
						right_num++;
					}
					else
					{
						image_id = 	image_id+'wrong';	
						document.getElementById(image_id).style.display="block";
					}
					locked = true;
					setTimeout(function(){nextqa(qid,time);},1000);
					//setTimeout(function(){countdown(qid,time);},1000);
				}
				
			}
			else
			{
				//alert(qid);
				document.getElementById(inputid).checked = true;
				//reset(qid);
			}			
		}

		function reset(qid)
		{
			var ques_id = "ques_cont" + qid;
			document.getElementById(ques_id).innerHTML = origin;

			maxchoose = 0;
			ifclick = 0;
			blank_fill =0;
			fill_answer = "";
			var len = qid.toString().length;
			var step = 1;
			for (var k=1;k<=len;k++)
			{
				step = step*10;
			}
			
			for (var i=11*step+qid;i<=18*step+qid;i=i+step)
			{
				document.getElementById(i).style.background="url(pics/fill_nor.png)";
			}
			for (var j=21*step+qid;j<=28*step+qid;j=j+step)
			{
				document.getElementById(j).checked = false;
			}	

			//alert("重新答题");
		}

		var f = 'qfree'+qid;
		var f_num = 'qfree_num'+qid;
		var props_free_num = document.getElementById(f_num).innerHTML;
		qid = qid+1;
		if(qid>=<?php echo E_QUESTIN_MAX; ?>) return;
		var n_f_num = 'qfree_num'+qid;
		var n_f = 'qfree'+qid;
		var imgph = "url(pics/props01_up.png)";
		if(props_free_num==0)
		{
			imgph = "url(pics/props01_ash.png)";
		 	document.getElementById(n_f).style.background=imgph;
		} 
		document.getElementById(n_f_num).innerHTML = props_free_num;

		qid=qid-1;
		var h = 'qhalf'+qid;
		var h_num = 'qhalf_num'+qid;		
		var props_half_num = document.getElementById(h_num).innerHTML;
		qid = qid+1;
		if(qid>=<?php echo E_QUESTIN_MAX; ?>) return;
		var n_h_num = 'qhalf_num'+qid;
		var n_h = 'qhalf'+qid;
		var imgph = "url(pics/props02_up.png)";
		if(props_half_num==0) 
		{
			imgph = "url(pics/props02_ash.png)";
			document.getElementById(n_h).style.background=imgph;
		}
		document.getElementById(n_h_num).innerHTML = props_half_num;
	}

		function reset(qid)
		{
			var ques_id = "ques_cont" + qid;
			document.getElementById(ques_id).innerHTML = origin;

			maxchoose = 0;
			ifclick = 0;
			blank_fill =0;
			fill_answer = "";
			var len = qid.toString().length;
			var step = 1;
			for (var k=1;k<=len;k++)
			{
				step = step*10;
			}
			
			for (var i=11*step+qid;i<=18*step+qid;i=i+step)
			{
				document.getElementById(i).style.background="url(pics/fill_nor.png)";
			}
			for (var j=21*step+qid;j<=28*step+qid;j=j+step)
			{
				document.getElementById(j).checked = false;
			}	

			//alert("重新答题");
		}
		function subsel()
		{
			//document.getElementById('subbtn').value = "提交";
		}

		function cav(canvas_id)
		{
			window.addEventListener('load', do_load, true);
			function do_load()
			{
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
					myImage.src = "pics/scratch.png";
					
					myImage.onload = function() {
						cont.drawImage(myImage, 0, 0, 300, 160);
					}	
				}

				function mousedown(e) {
				    var point = hasTouch ? e.touches[0] : e;;
					x1 = (point.pageX - canvas.left())*0.63;
					y1 = (point.pageY - canvas.top())*0.74;

					drawflag = true;
				}

				function mouseup(e) {
					drawflag = false;
				}

				function mousemove(e) {
				    var point = hasTouch ? e.touches[0] : e;;
					x2 = (point.pageX - canvas.left())*0.63;
					y2 = (point.pageY - canvas.top())*0.74;

					if (drawflag) {
						clearUp();
					}

					x1 = x2;
					y1 = y2;
				}

				function clearUp() {
					cont.save();
					cont.translate(0, 0);
					cont.globalCompositeOperation="destination-out";
					cont.moveTo(x1, y1);
					cont.lineTo(x2, y2);
					cont.lineWidth = 15;
					cont.lineJoin = "round";

					cont.stroke();
					cont.restore();
				}

				canvas.top = function(){
					var offset=this.offsetTop;

					if(this.offsetParent!=null) 
						offset+=getTop(this.offsetParent);

					return offset;
				}

				canvas.left = function(){
					var offset=this.offsetLeft;

					if(this.offsetParent!=null)
						offset+=getLeft(this.offsetParent);

					return offset;
				}

				function getTop(e){
					var offset=e.offsetTop;

					if(e.offsetParent!=null)
						offset+=getTop(e.offsetParent);

					return offset;
				}

				function getLeft(e){
					var offset=e.offsetLeft;

					if(e.offsetParent!=null) offset+=getLeft(e.offsetParent);
						return offset;
				} 
			}
		}

		 function usepropfree(qid,true_answer,type,answer_count,options,time)
		 {
		 	//alert(qid);alert(true_answer);
		 	if(props_free_used) return;
		 	props_free_used = true;
		 	var f = 'qfree'+qid;
		 	var f_num = 'qfree_num'+qid;
		 	var props_free_num = document.getElementById(f_num).innerHTML;
		 	if(props_free_num==0) return;
		 	else props_free_num--;
		 	document.getElementById(f_num).innerHTML = props_free_num;
		 	var imgph = "url(pics/props01_up.png)";
		 	if(props_free_num==0) imgph = "url(pics/props01_ash.png)";
		 	document.getElementById(f).style.background=imgph;
			if(rslist == "" || rslist == null)
			rslist = qid+"|"+true_answer;
			else
			rslist = rslist+"|"+qid+"|"+true_answer;
			if(type==<?php echo E_QUESTION_TYPE_FILL;?>)
			{
				var image_id = 'image'+qid;
				image_id = 	image_id+'right';			
				document.getElementById(image_id).style.display="block";
				var ans = new Array();
	 			var i=0;
	 			var h = 0;var x=0;
	 			true_answer = true_answer+'';
	 			for(h=1;h<=8;h++)
	 			{
	 				x = h+10;
	 				x = x+''+qid;
	 				if(options==8)
	 				{
	 					document.getElementById(x).style.background="url(pics/fill_nor.png)";
	 				}
	 				else
	 				{
	 					document.getElementById(x).style.background="url(pics/choose_nor.png)";
	 				}
	 			}
	 			
	 			for(i=0;i<answer_count;i++)
	 			{
	 				ans[i] = true_answer.substring(i,i+1);	
	 				ans[i] = parseInt(ans[i])+10;	 
	 				ans[i] = ans[i]+''+qid;	
	 				if(options==4)
					{
						document.getElementById(ans[i]).style.background="url(pics/choose_up.png)";
					}
					else
					{
						document.getElementById(ans[i]).style.background="url(pics/fill_up.png)";
					}			
	 			}

			}
			else
			{
				var aid = true_answer+30;
				aid = aid+''+qid;
				document.getElementById(aid).innerHTML += "<span class='right'>"+"right"+"</span>";	
			}
			locked = true;
			ifclick = 1;
			qid = qid+1;
			if(qid>=<?php echo E_QUESTIN_MAX; ?>) nextqa(qid,time);
			var n_f_num = 'qfree_num'+qid;
			var n_f = 'qfree'+qid;
			if(props_free_num==0) document.getElementById(n_f).style.background=imgph;
			document.getElementById(n_f_num).innerHTML = props_free_num;
			qid = qid-1;
			var h = 'qhalf'+qid;
			var h_num = 'qhalf_num'+qid;		
			var props_half_num = document.getElementById(h_num).innerHTML;
			qid = qid+1;
			if(qid>=<?php echo E_QUESTIN_MAX; ?>) return;
			var n_h_num = 'qhalf_num'+qid;
			var n_h = 'qhalf'+qid;
			var imgph = "url(pics/props02_up.png)";
			if(props_half_num==0) 
			{
				imgph = "url(pics/props02_ash.png)";
				document.getElementById(n_h).style.background=imgph;
			}
			document.getElementById(n_h_num).innerHTML = props_half_num;
			right_num++;
			setTimeout(function(){nextqa(qid,time);},1000);
			//setTimeout(function(){countdown(qid,time);},1000);
		 }

		 function useprophalf(qid,true_answer,options,type,answer_count)
		 {
		 	if(props_half_used) return;
		 	props_half_used = true;
		 	var h = 'qhalf'+qid;
		 	var h_num = 'qhalf_num'+qid;
		 	var props_half_num = document.getElementById(h_num).innerHTML;
		 	if(props_half_num==0) return;
		 	else props_half_num--;
		 	document.getElementById(h_num).innerHTML = props_half_num;
		 	var imgph = "url(pics/props02_up.png)";
		 	if(props_half_num==0) imgph = "url(pics/props01_ash.png)";
		 	document.getElementById(h).style.background=imgph;
		 	if(type==<?php echo E_QUESTION_TYPE_FILL;?>)
		 	{
		 		if(options==4)
		 		{
		 			var ans = new Array();
		 			var i=0
		 			true_answer = true_answer+'';
		 			for(i=0;i<answer_count;i++)
		 			{
		 				ans[i] = true_answer.substring(i,i+1);		 				
		 			}
		 			var j=0;
		 			var flag = true;
		 			var delete1 = parseInt(Math.random()*4+1);
			 		var delete2 = parseInt(Math.random()*4+1);
			 		do
			 		{
			 			flag=true;
			 			for(j=0;j<answer_count;j++)
		 				{
		 					if(ans[j]==delete1) flag=false;
		 				}
		 				if(flag==false)
		 				{
		 					delete1 = parseInt(Math.random()*4+1);
		 				}
			 		}while(flag==false);
			 		var aid1 = delete1+10;
					aid1 = aid1+''+qid;
					document.getElementById(aid1).innerHTML = "";	
		 		}
		 		else if(options==8)
		 		{
		 			var ans = new Array();
		 			var i=0
		 			true_answer = true_answer+'';
		 			for(i=0;i<answer_count;i++)
		 			{
		 				ans[i] = true_answer.substring(i,i+1);		 				
		 			}
		 			var j=0;
		 			var flag = true;
		 			var delete1 = parseInt(Math.random()*8+1);
			 		var delete2 = parseInt(Math.random()*8+1);
			 		do
			 		{
			 			flag=true;
			 			for(j=0;j<answer_count;j++)
		 				{
		 					if(ans[j]==delete1) flag=false;
		 				}
		 				if(flag==false)
		 				{
		 					delete1 = parseInt(Math.random()*8+1);
		 				}
		 				//alert(flag);
			 		}while(flag==false);
			 		//alert("delete1:"+delete1);
			 		var k=0;
			 		do
			 		{
			 			flag=true;
			 			for(k=0;k<answer_count;k++)
		 				{
		 					if((ans[k]==delete2)||(delete2==delete1)) flag=false;
		 				}
		 				if(flag==false)
		 				{
		 					delete2 = parseInt(Math.random()*8+1);
		 				}
		 				//alert(flag);
			 		}while(flag==false);
			 		//alert("delete2:"+delete2);
			 		var aid1 = delete1+10;
			 		var aid2 = delete2+10;
					aid1 = aid1+''+qid;
					aid2 = aid2+''+qid;
					document.getElementById(aid1).innerHTML = "";	
					document.getElementById(aid2).innerHTML = "";

		 		}
		 		else
		 		{
		 			alert("选项数目错误!");
		 		}
		 	}
		 	else
		 	{
		 		var delete1 = true_answer+parseInt(Math.random()*3+1);
		 		var delete2 = true_answer+parseInt(Math.random()*3+1);
		 		while (delete2==delete1)
		 		{
		 		    delete2 = true_answer+parseInt(Math.random()*3+1);
		 		}
		 		if(delete1>4) delete1=delete1-4;
		 		if(delete2>4) delete2=delete2-4;
		 		var aid1 = delete1+30;
		 		var aid2 = delete2+30;
				aid1 = aid1+''+qid;
				aid2 = aid2+''+qid;
				document.getElementById(aid1).innerHTML = "";	
				document.getElementById(aid2).innerHTML = "";
		 	}
		 	qid = qid+1;
		 	if(qid>=<?php echo E_QUESTIN_MAX; ?>) return;
			var n_h_num = 'qhalf_num'+qid;
			var n_h = 'qhalf'+qid;
			if(props_half_num==0) document.getElementById(n_h).style.background=imgph;
			document.getElementById(n_h_num).innerHTML = props_half_num;
		 }

</script>

<body id="index" style="width:640px;" >

<div class="basic" id='basic'>
	请把机器竖起来哦~亲!
</div>

<?php 
    echo "<div id='load_div' class='loading' >";
        echo "<div class='title'>";
            echo "亲～正在加载中";      
        echo "</div>";
        echo "<div  class='loading_img'>";
            echo "<img src='pics/loading.gif' alt='正在加载中...'/>";
        echo "</div>";
    echo "</div>";

    echo "<div id='loaded_div' class='loaded' style='display:none'>";
        echo "<div class='title_ed'>";
            echo "已加载完毕";      
        echo "</div>";
        echo "<div class='loaded_img'>";
        	$ptime = $voteall['recipient'][0]['ptime'];
            echo "<img src='pics/button_wx.png' alt='加载完成' onclick='answer($ptime)'/>";
        echo "</div>";
    echo "</div>";

    echo "<script type='text/javascript'>redirect();</script>"; 
?>
<script language="javascript">
//if is iphone 5
	if(window.screen.height==568)
	{
		document.getElementById('load_div').style.marginTop = "150px";
		document.getElementById('loaded_div').style.marginTop = "150px";
	}
</script >
<div class="testdiv" id="answer" style='display:none;'>
	<form name="vote" action="qlist_rs.php"  method="post" target="file_frm_uploader">
		<input type ="hidden" name="act" value="">
		<input type="hidden" name="itemid" value="">
		<?php
		 echo "<input type=\"hidden\" name=\"aid\" value=\"".$aid."\">";
		?>
		<input type="hidden" name="rslist" value="">
		<input type="hidden" name="ptime" value="">
		<?php 
			if(array_key_exists('challenger', $voteall)){
				echo '<h4 class="me">我</h4>';
				echo '<h4 class="challenger">'.$voteall['challenger']['ques_name_challenge'].'</h4>';
			}
		?>
		<?php 
		    $clientip   = $_SERVER["REMOTE_ADDR"]; 
		    $clientname = $_SERVER["REMOTE_HOST"];
		    //echo "<script type='text/javascript'>test();</script>"; 

		    function getOptions($i,$name,$voteall,$div_id,$la_id_one,$in_id_one,$la_id_two,$in_id_two,$prop_free,$prop_half)
		    {
		    	$ori_div_id = $div_id;
		    	$div_id = $div_id.$i;
		    	 if($i == 0&&$div_id=='q0')
				         $display = " ";
				     else
				         $display = "none;";
					 echo "<div class='main' style=\" display:$display;\"  id=$div_id>";
					 if($ori_div_id=='c')
					 {
					 	$cll_id = 'c_bg'.$i;
					 	echo "<div class='challenge_bg' id=$cll_id> ";
					 		echo '<div class="mes" id="message_bg">对方答题中';
					 		echo '</div>';
					 	echo "</div>";

					 }

					 $sketchpad_id = $ori_div_id.'sketchpad'.$i;
					 echo "<div class='sketchpad' id=$sketchpad_id ontouchstart='return false'>";
					 if($ori_div_id=='c')
					 {
					 	$time_id = 'ctime'.$i;
					 }
					 else
					 {
					 	$time_id = 'time'.$i;	
					 }
					 
					 $ptime = $voteall[$name][$i]['ptime'];
					 echo "<h2 id=$time_id class='time' >".$ptime.':00'."</h2>";

					 $votetype = 0;
					 $underline = '';
					 $answer_count =0;
					 $former_ques = 0;
					 //print_r($voteall[$i]['ques']);
					 //die();
					 $style = "";
					 if($voteall[$name][$i]['pic_serial']!=0)
					 {
					 	$style="style=\"margin-top:-25px;\"";
					 }
					 echo "<p class='question_name'>"."第".($i+1)."题"."</p>";
					 
					 if($voteall[$name][$i]['type']==E_QUESTION_TYPE_FILL)
					 {
					 	$que_con = $voteall[$name][$i]['ques'];
					 	$underline = '';
					 	$answer_count = $voteall[$name][$i]['fill_num'];
					 	/*
					 	$que_con = substr($que_con,0,strlen($que_con)-$answer_count);
					 	//echo $que_con;
					 	for($m= 1;$m<=$answer_count;$m++)
					 	{
					 		$que_con = $que_con.'＿';
					 		//echo $que_con;
					 	}
					 	$voteall['recipient'][$i]['ques'] = 	$que_con;	
					 	*/			 	
					 }
					 $ques_id = "ques_cont"."$i";
					 echo "<p id='$ques_id' class='question' $style>".$voteall[$name][$i]['ques']."</p>";
					 $style = "";
					 $imgpath = ""; 
					 if($ori_div_id=='q') $canvas_id = $ori_div_id."huabu"."$i";
					 
					 if($voteall[$name][$i]['type'] == E_QUESTION_TYPE_TOUCH)
					 {
					 	$imgpath = "../mr/icon/".$voteall[$name][$i]['pic_serial'].".jpg";
					 	echo "<div class='image' >";
							echo "<canvas id=$canvas_id  style=\" background: url($imgpath)\" >";
							echo "<script type='text/javascript'>cav(\"$canvas_id\");</script>"; 		
						echo "</canvas>";
						echo "</div>";
						echo "<div class='eraser_back'>";
						echo "</div>";
					 }
					
					else if($voteall[$name][$i]['type'] == E_QUESTION_TYPE_FILL)
					{
						$imgpath = "../mr/icon/".$voteall[$name][$i]['pic_serial']."."."jpg";
				 		echo "<div class='image' >";
				 		$image_id_right = $ori_div_id.'image'.$i.'right';
				 		$image_id_wrong = $ori_div_id.'image'.$i.'wrong';
				 		echo "<img class='fill' id='$image_id_right' src='pics/right_b.png' style=\"display:none\" />";
				 		echo "<img class='fill' id='$image_id_wrong' src='pics/error_b.png' style=\"display:none\"/>";
						if($voteall[$name][$i]['pic_serial']!=0){
							echo "<img  src=$imgpath / >";	
						} 
											
						echo "</div>";
						$eraser_id = 'eraser'.$i;
						echo "<div class='eraser' id='$eraser_id' onclick='reset($i)'>";
						echo "</div>";
					}
					else
					 {
					 	$imgpath = "";
					 	$having_img = $voteall[$name][$i]['pic_serial'];
					 	if($having_img!=0)
					 	{
					 		$imgpath = "../mr/icon/".$having_img."."."jpg";
					 		//echo "<script type='text/javascript'>change($ques_id);</script>";
					 		echo "<div class='image' >";
								echo "<img  src=$imgpath / >";						
							echo "</div>";
					 	}
					 	if($voteall[$name][$i]['type'] == E_QUESTION_TYPE_IMAGE)
					 	{
					 		$imgpath = "pics/props01_nor.png"; 
					 	}	
					 	echo "<div class='eraser_back'>";
						echo "</div>";				 	

					}
					
					echo "</div>";
					 	echo "<div class='options'>";
					 	$options = count($voteall[$name][$i]['sellist']);
					 	$props_free_num = $prop_free;
						$props_half_num = $prop_half;
					 	foreach($voteall[$name][$i]['sellist'] as $k=>$v)
					 	{
						   $true_answer =  $voteall[$name][$i]['answer'];
					   	   $votename = "vote".$i;
					   	   $votetype = $voteall[$name][$i]['type'];
					   	   if($i+1>=E_QUESTIN_MAX) $stime = 0;
					   	   else $stime = $voteall[$name][$i+1]['ptime'];
					   	   if($votetype == E_QUESTION_TYPE_FILL)
					 	   {
					 	   	 $ek = $k+$la_id_one;
					 	   	 $ek = $ek.$i;
					 	   	 $fk = $k+$in_id_one;
					 	   	 $fk = $fk.$i;
					 	   	 if($options==4)
					 	   	 {
					 	   	 	 $line_height = "";
					 	   	 	 if(strlen($v)>27) $line_height = '48px';
					 	   	 	 echo "<label id=$ek class='options_rectangle' for='$fk' >"."$v"."</label>";
					 			 echo "<input id=$fk  class='hide' type=\"checkbox\" name=\"".$votename."[]"."\" value=\"".$v."\" onclick= 'getsel($i,$ek,$votetype,$fk,$answer_count,$k,$true_answer,$options,$stime)' />";
					 	   	 }
					 	   	 else
					 	   	 {
					 	   		 echo "<label id=$ek class='options_square' for='$fk' >"."$v"."</label>";
					 			 echo "<input id=$fk  class='hide' type=\"checkbox\" name=\"".$votename."[]"."\" value=\"".$v."\" onclick= 'getsel($i,$ek,$votetype,$fk,$answer_count,$k,$true_answer,$options,$stime)' />";
					 		}
					 	   }
					       else
					 	   {
					 	   	 $lk = $k+$la_id_two;
					 	   	 $lk = $lk.$i;
					 	   	 $pk = $k+$in_id_two;
					 	   	 $pk = $pk.$i;
					 	   	 $line_height = "";
					 	   	 if(strlen($v)>21) $line_height = '48px';
					 	   	 //echo strlen($v);
					 	   	 echo "<label id=$lk class='options_rectangle' for='$pk' style='line-height:$line_height'>"."$v"."</label>";
					 		 echo "<input id=$pk class='hide' type=\"radio\" name=\"".$votename."\" value=\"".$v."\" onclick= 'getsel($i,$lk,$votetype,$pk,$answer_count,$k,$true_answer,$options,$stime)' />";
					 	   }
					    }
		    				echo "<div class='props clearfix' style='display:none;'>";
						    $button_free_class_name = 'free_current';
						    $button_half_class_name = 'half_difficulty';
						    if($props_free_num==0)
						    {
						    	$button_free_class_name = 'free_current_none';
						    }
						    if($props_half_num==0)
						    {
						    	$button_half_class_name = 'half_difficulty_none';
						    }
						    $f_id = $ori_div_id.'free'.$i;
						    $h_id = $ori_div_id.'half'.$i;
						    $f_num_id = $ori_div_id.'free_num'.$i;
						    $h_num_id = $ori_div_id.'half_num'.$i;
						    echo "<input id=$f_id class=$button_free_class_name type='button' name='' value='本轮免答' onclick='usepropfree($i,$true_answer,$votetype,$answer_count,$options,$stime)'>";

						    $free_class_name = 'single';
						    $half_class_name = 'single';
						    if($props_free_num > 9) 
						    {
						    	$free_class_name = 'double';
						    	$props_free_num = '9+';
						    }
						    echo "<sup id=$f_num_id class='$free_class_name free'>"."$props_free_num"."</sup>";

						    echo "<input id=$h_id class=$button_half_class_name type='button' name='' value='难度减半' onclick='useprophalf($i,$true_answer,$options,$votetype,$answer_count)'>";
						    if($props_half_num > 9) 
						    {
						    	$half_class_name = 'double';
						    	$props_half_num = '9+';
						    }
						    echo "<sup id=$h_num_id class='$half_class_name half'>"."$props_half_num"."</sup>";

					   	    echo "</div>";

					    echo "</div>";
					  
				    echo "</div>";
		    }


			for($i = 0;$i<count($voteall['recipient']);$i++)
			{
			    getOptions($i,'recipient',$voteall,'q',10,20,30,40,$prop_free,$prop_half);
			    if(array_key_exists('challenger',$voteall)){
			    	getOptions($i,'challenger',$voteall,'c',60,70,80,90,$prop_free,$prop_half);
			    }
	   		}
		?>
		<!--
		<input class="test" type="button" name="votesb" value="继续下题"  id="subbtn" onclick="nextqa()" />
		<input class="test" type="reset" name="votert" value="重置" />
		-->
	</form>
</div>
<script language="javascript">
//if is iphone 5

	if(window.screen.height==568)
	{
		var flag =<?php if(array_key_exists('challenger', $voteall)) echo 1;else echo 0;?>;

		for(var id=0;id<10;id++)
		{
			var s_id = 'q'+id;
			document.getElementById(s_id).style.marginTop = "80px";
			document.getElementById(s_id).style.height = "790px";
			if(flag){
				s_id = 'c'+id;
				document.getElementById(s_id).style.marginTop = "80px";
				s_id = 'c_bg'+id;
				document.getElementById(s_id).style.marginTop = "-100px";
			}
			s_id = 'qsketchpad'+id;
			document.getElementById(s_id).style.marginBottom = "60px";
			if(flag){
				s_id = 'csketchpad'+id;
				document.getElementById(s_id).style.marginBottom = "60px";
			}
		}		
	}


</script >
<div id=result style='display:none;'>
	<div class="initiator_title" id="iphone4">
	    <div class="content" id='ifhigh'>
			哇！比我知识还要丰富。你要来展示一下么？!
		</div>
	</div>   
	<div class="initiator">
		<?php 
			if (!array_key_exists('challenger', $voteall)||$voteall['challenger']['ques_role_icon']==0) {
				echo '<img class="avatar" src="../mr/roleicon/default_men.png" width=150 height=150 />';
			}else{
				 echo '<img class="avatar" src="../mr/roleicon/'.$voteall['challenger']['ques_role_icon'].'.jpg"'.' width=150 height=150 />';
			}
		?>		
	</div> 
	<h3 id="cha_name">
	    <?php echo $voteall['challenger']['ques_name_challenge']; ?>
	</h3>  
	<div class="summary" id="help">  
	    <p class="summary" >
	     答对题数:<b id='right_num'><?php echo $right_num?></b><?php echo '/'.E_QUESTIN_MAX; ?>
	    </p>   
	    <p class="summary">
	     花费时间:<b id='time_help'>0</b>
	    </p>  
	    <p class="summary">
	     知识排名:超过<b id='rank'><?php echo $result;?></b>%的人
	    </p>  
	</div>  

	<div class="challenge" id="challenge"> 
		<table class="challenge">
		  <tr>
		    <th>我的成绩</th>
		    <th class="red"><?php echo $voteall['challenger']['ques_name_challenge'].'的成绩'; ?></th>
		  </tr>
		  <tr>
		    <td>答对:<b id='right_num_chall'><?php echo $right_num?></b></td>
		    <td class="red">答对:<?php echo $voteall['challenger']['ques_role_correct_num'];?></td>
		  </tr>
		  <tr>
		    <td>时间:<b id='time_chall'>0</b></td>
		    <td class="red">时间:<b id='time_challenger'>0</b></td>
		  </tr>
		</table>  
	</div> 
	<button class="install" id="install">

	</button>
	<a href="#" id="reply"><img class="reply" src="pics/web_02_nor.png" /></a>
</div>

<div id="file_uploader" style="display: none;">
    <iframe name='file_frm_uploader' allowTransparency='true' frameborder='0' src='about:blank'></iframe>
</div>

<script language="javascript">

	if(window.screen.height==480){
		document.getElementById('iphone4').style.marginTop = "-10px";
		var flg = <?php if(array_key_exists('challenger', $voteall)) echo 1;else echo 0;?>;
		if(!flg){
			document.getElementById('install').style.marginTop = "-30px";
			document.getElementById('install').style.marginBottom = "-7px";
		}

	}

	if(window.screen.height==900){
		//document.getElementById('message_bg').style.marginTop = "300px";
	}

</script>



</body>
</html>
