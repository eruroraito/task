<?php

	$version		= "x";
	//$centralServer	= "10.182.39.192";
	//$centralServer	= "192.168.11.28";
	$centralServer	= "192.168.11.133";
	$port		  	= "8101";
	$timezone 	  	= "Asia/Shanghai";
	$char_php	  	= "utf-8";
	$char_tcp      	= "gb2312";
	$webgmh			= "0";	
		
	$def = array
		(
			'qlist'=>array
				(
					'capt'	=>'query list',
					'params'=>array
					(
						'qtitleid' 	=> array('capt'=>'题目编号', 		'type'=>'int','cmdfmt'=>'qtitleid'),
					)
				),	
			'qsub'=>array
				(
					'capt'	=>'submit list',
					'params'=>array
					(
						'qtitleid' 	=> array('capt'=>'题目', 		'type'=>'int','cmdfmt'=>'qtitleid'),
						'rnum' 	    => array('capt'=>'答对数目', 	'type'=>'short','cmdfmt'=>'rnum'),
						'ptime' 	=> array('capt'=>'所花时间', 	'type'=>'short','cmdfmt'=>'ptime'),
						'option'    => array('capt'=>'选项和道具',  'type'=>'array','cmdfmt'=>'option'),
					)
				),								
		);
?>