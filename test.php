<<<<<<< HEAD
<style type="text/css">

.select * {
margin: 0;
padding: 0;
}
.select {
border:1px solid #cccccc;
float: left;
display: inline;
}

.select div {
border:1px solid #f9f9f9;
float: left;
}
/* 子选择器，在FF等非IE浏览器中识别 */
.select>div {
width:120px;
height: 17px;
overflow:hidden;
}

/* 通配选择符，只在IE浏览器中识别 */
* html .select div select {
display:block;
float: left;
margin: -2px;
}
.select div>select {
display:block;
width:124px;
float:none;
margin: -2px;
padding: 0px;
}
.select:hover {
border:1px solid #666666; //鼠标移上的效果 
}
.select select>option {
text-indent: 2px; //option在FF等非IE浏览器缩进2px
}

</style>

</head>
<body><div class="select">
<div>
<select>
<option>看见效果了吧</option>
<option>看见效果了吧</option>
<option>看见效果了吧</option>
</select>
</div>
</div>
=======
<?php 

		$now = time(); 
		//今天
		$today_audit_num = 0;
		$today_use_num = 0;
	    $beginTime = date('Y-m-d 00:00:00', $now);  
	    $endTime = date('Y-m-d 23:59:59', $now);  

	    //本周
		$week_audit_num = 0;
		$week_use_num = 0;
	    $time = '1' == date('w') ? strtotime('Monday', $now) : strtotime('last Monday', $now);  
	    $beginTime = date('Y-m-d 00:00:00', $time);  
	    $endTime = date('Y-m-d 23:59:59', strtotime('Sunday', $now));  

	    //本月
		$month_audit_num = 0;
		$month_use_num = 0;
	    $beginTime = date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m', $now), '1', date('Y', $now)));  
	    $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now))); 

	    //三个月内
		$three_month_audit_num = 0;
		$three_month_use_num = 0;
	    $time = strtotime('-2 month', $now);  
	    $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, date('m', $time), 1, date('Y', $time)));  
	    $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now)));  ;

	    //半年内
		$half_year_audit_num = 0;
		$half_year_use_num = 0;
	    $time = strtotime('-5 month', $now);  
	    $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, date('m', $time), 1, date('Y', $time)));  
	    $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now)));  

	    //今年
		$year_audit_num = 0;
		$year_use_num = 0;
	    $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, 1, 1, date('Y', $now)));  
	    $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, 12, 31, date('Y', $now))); 



?>
>>>>>>> 0c8e80f4f880af6b0917356900646d24ad02c9bd
