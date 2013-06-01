<?php
    ini_set("display_errors", 0);
	require_once 'callgs.php';
	require_once 'config.php';
	session_start();	
	$_SESSION['end_time'] = time();
	$time = $_SESSION['end_time'] - $_SESSION['start_time'];
	if($time>0&&$time<10){
		$time = '00:0'.$time;
	}elseif($time>9&&$time<60){
		$time = '00:'.$time;
	}else{
		if($time%60<10){
			$time = '0'.intval($time/60).':0'.($time%60);
		}else{
			$time = '0'.intval($time/60).':'.($time%60);
		}
	} 
	$answer_option = $_REQUEST['answer_option'];
    $right_number  = $_REQUEST['right_number'];
    $aid = $_SESSION['qlist']['recipient']['0']['qid'];
    //print_r($aid);
    //print_r($answer_option);
    
    $answer_option_array  = explode('|',$answer_option);
    for($i=0;$i<count($answer_option_array);$i=$i+2){
    	$temp_answer_option = intval($answer_option_array[$i+1]);
    	$option['option_num'] = strlen($temp_answer_option);
    	for($j=0;$j<$option['option_num'];$j++){
    		$option['option_detail'][$j] = substr($temp_answer_option,$j,1); 
    	}
    	$answers[$i/2]['option'] = $option;
    	$answers[$i/2]['prop'] = '0';
    }
    //print_r($answers);
    if($aid != '' && $aid != null && is_numeric($aid))
    {
        //print_r($q_options);die();
	    $gdp = new GsServer();
	    $param_nv = array();      
	    $param_nv['qtitleid'] = $aid;
	    $param_nv['rnum'] = $right_number;
	    $param_nv['ptime'] = $time;
        $param_nv['option'] = $answers;
	    $cmdcode = "qsub";	
	    //$voteall = $gdp->execGmCmd($param_nv,$cmdcode);	      
    }
?>

<?php require_once 'header.php';?>
	<style type="text/css">
		div.main{background:#f00;position: relative;}
		div.sky_blue{background:#50badc;width:100%;height:77%;position: absolute;}
		div.dark_blue{background:#074d83;width:100%;height:23%;position: absolute;top:77%;}
		section.information{background:url(material/result_information.png) no-repeat;width:570px;height:297px;position: absolute;left:50%;margin-left:-285px;z-index:20;}
		section.ad{width:578px;height:305px;position: absolute;left:50%;margin-left:-289px;z-index:20;}
		strong{color:#fff;font-size: 40px;width:100%;text-align: center;display: block;line-height:90px;}
		table.result{width:180px;margin:46px auto 0;padding:0 42px;color:#5a3333;font-weight:bold;font-size:24px;line-height:30px;}
		table.result tr td.red{color:#ce1313;}
		a.android{background:url(material/android_download.png) no-repeat;width:259px;height: 102px;position: absolute;left:50%;margin-left:-129px;text-indent: -1000px;overflow: hidden;}
		a.iphone{background-image:url(material/iphone_download.png);}
		div.basic{width:100%;height:100%;background:#667fa1;position:absolute;z-index:1000000000;display:none;}
		div.basic aside{top:50%;left:50%;position:absolute;font-size:50px;color:#fff;width:10em;line-height:50px;margin:-25px 0 0 -250px;}
	</style>
</head>
<body ontouchmove="event.preventDefault()">
	<div class="basic" id='basic'>
		<aside id="aside">请把机器竖起来哦~亲!</aside>
	</div>
	<div class="main" id="main">
		<div class="sky_blue"></div>
		<div class="dark_blue"></div>
		<section class="information" id="infromation_id">
			<strong>嘻嘻~你还差一点点呦~</strong>
			<table class="result">
				<tr>
					<th colspan="2">我的成绩</th>
				</tr>
				<tr>
					<td>答对:</td>
					<td class="red">
					<?php echo $right_number;?>/10题
					</td>
				</tr>
				<tr>
					<td>时间:</td>
					<td class="red">
					<?php echo $time;?>
					</td>
				</tr>
			</table>
		</section>
		<section class="ad" id="ad_id">
			<img src="material/ad.png"  />
		</section>
		<a id="download_icon" href="" class="android">android/iphone</a>
	</div>
<script type="text/javascript" src="js/auto.js"></script>
<script type="text/javascript">
	var height = $(document).height();
	var separated = ((height-704)/4)+'px';
	$('#infromation_id').css('top',separated);
	separated = (((height-704)/2)+297)+'px'; 
	$('#ad_id').css('top',separated);
	separated = (((height-704)/4)*3+297+305)+'px'; 
	$('#download_icon').css('top',separated);
  	var browser={
    	versions:function(){
            var u = navigator.userAgent, app = navigator.appVersion;
            return {         //移动终端浏览器版本信息
                trident: u.indexOf('Trident') > -1, //IE内核
                presto: u.indexOf('Presto') > -1, //opera内核
                webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器
                iPad: u.indexOf('iPad') > -1, //是否iPad
                webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
            };
         }(),
         language:(navigator.browserLanguage || navigator.language).toLowerCase()
	}
	if(browser.versions.ios){
		$('#download_icon').addClass('iphone');
	}

	function orientationChange(){  
		switch(window.orientation) {   
			case 0: $('#basic').hide();
			case 180: $('#basic').hide();  
			// Javascript to setup Portrait view   
			break;   
			case -90: $('#basic').show();			  
			case 90: $('#basic').show();
			// Javascript to steup Landscape view   
			break;   
		}   
	}
	window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", orientationChange, false);
  </script> 
</body>
</html>