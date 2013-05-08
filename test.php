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
