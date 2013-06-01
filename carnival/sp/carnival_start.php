<?php
    ini_set("display_errors", 0);
	require_once 'callgs.php';
	require_once 'config.php';
	session_start();	
	$gdp = new GsServer();
	$param_nv = array();
	$aid    = $_REQUEST['aid'];
	if($aid == null || $aid == '' || (!is_numeric($aid)))
	    $aid = 1;
	$param_nv['qtitleid'] = $aid;
	$cmdcode = "qlist";	
	$voteall = $gdp->execGmCmd($param_nv,$cmdcode);//print_r($voteall);
    $_SESSION['qlist']= $voteall;
?>
<?php require_once 'header.php';?>
<script type="text/javascript" src="common/jquery.progressbar.min.js"></script>
	<style type="text/css">
		em{width:150px;height:150px;position:absolute;left:50%;margin-left:-75px;top:50%;margin-top:120px;}
		div.sky_blue{background:#50badc;width:100%;height:87%;position: absolute;}
		div.dark_blue{background:#074d83;width:100%;height:13%;position: absolute;top:87%;}
		img.main{position:absolute;width:345px;height:350px;left:50%;margin-left:-170px;top:50%;margin-top:-320px;}
		
		img.loading{width:150px;height:150px;position:absolute;left:50%;margin-left:-75px;top:50%;margin-top:120px;}
		h3{font-size:40px;line-height:40px;width:320px;position:absolute;left:50%;margin-left:-136px;color:#430707;height:40px;top:50%;margin-top:45px;}

		h2{font-size:40px;line-height:40px;width:240px;position:absolute;left:50%;margin-left:-95px;color:#430707;height:40px;top:50%;margin-top:45px;}
		img.start{width:262px;height:104px;position:absolute;left:50%;margin-left:-122px;top:50%;margin-top:120px;}

		div.finished{display:none;}

		div.basic{width:100%;height:100%;background:#667fa1;position:absolute;z-index:1000000000;display:none;}
		div.basic aside{top:50%;left:50%;position:absolute;font-size:50px;color:#fff;width:10em;line-height:50px;margin:-25px 0 0 -250px;}
	</style>
</head>

<body ontouchmove="event.preventDefault()">
	<div class="basic" id='basic'>
		<aside id="aside">请把机器竖起来哦~亲!</aside>
	</div>
	<div class="sky_blue"></div>
	<div class="dark_blue"></div>
	<img class="main" src="material/login.jpg" alt="图片加载失败" />
	<div class="loading" id="loading">
		<h3>亲~正在加载中~</h3>
		<em id="pb1" class="progressBar"></em>

	</div>
	<div class="finished" id="finished">
		<h2>已加载完毕~</h2>
		<img class="start" id="start" src="material/start.jpg" alt="图片加载失败"/>
	</div>

<script type="text/javascript">
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

	$(function(){
		$("#pb1").progressBar();
		var x=0;
		var int=self.setInterval(function(){
	    if(x>=99){
	    	$('#finished').show('slow');
			$('#loading').hide('slow');
	        window.clearInterval(int);
	    }
	    x++;
	      $('#pb1').progressBar(x);
	    },50);
	});
	var exchange = <?php if(array_key_exists('challenger', $voteall)) echo 1;else echo 0;?>;
	$('#start').click(function(){
		if(!exchange) location.href='carnival.php';
		else location.href='carnival_exchange.php';
	});
</script>
</body>
</html>