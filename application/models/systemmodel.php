<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Systemmodel extends CI_Model {

	protected $_CI;

	public function __construct(){
		parent::__construct();
		$this->_CI = & get_instance();
	}
/*
| -------------------------------------------------------------------
|  System Basic Functions
| -------------------------------------------------------------------
*/
	public function getPicIndex(){
		$res= array();
		$this->db->select('global_pic_index');
		$this->db->where('global_id',1);
		$this->db->from('global');
		$query = $this->db->get();
		$res = $query->row_array();

		return $res['global_pic_index'];
	}

	public function doAudit($info){
		//print_r($info);die();
		$db_name = 'question_'.$info['type'];
		$this->db->where('id',$info['id']);
		$this->db->update($db_name,$info);
	}

	public function getSubmitLog(){
		$this->db->from('log');
		$this->db->order_by('time_submit');
		$query = $this->db->get();
		$res = $query->result_array();
		//print_r($res);die();
		return $res;
	}

	public function getDownloadFileNames(){
		$this->db->select('file_name');
		$this->db->from('file');
		$query = $this->db->get();
		$res = $query->result_array();
		//print_r($res);die();
		return $res;
	}

	public function saveFiles($data){
		$file['file_name'] = $data['upload_data']['client_name'];
		$file['file_size'] = $data['upload_data']['file_size'];
		$this->db->insert('file',$file);
	}
	
	public function submitQuestion($info){
		$num = 0;//print_r($info);die();
		$detail = '';
		foreach ($info as $key => $value) {

			$this->db->where_in('id',$value);
			$this->db->set('status',3);
			$this->db->update($key);
			$num = $num + count($value);
			$detail_value = '';
			foreach ($value as $l_key => $l_value) {
				if($detail_value=='')  $detail_value = $l_value;
				else $detail_value = $detail_value.'/'.$l_value;
			}
			if($detail=='') $detail = '['.$key.'['.$detail_value.']]';
			else $detail = $detail.','.'['.$key.'['.$detail_value.']]';

		}
		//print_r($detail);die();
		$user = $this->m_app->getCurrentUserName();
		$log_info['name_submit'] = $user;
		$log_info['question_num'] = $num;
		$log_info['time_submit'] = NOW;
		$log_info['question_detail'] = $detail;
		$this->db->insert('log',$log_info);
	}

	public function offQuestion($info){
		//$num = 0;//print_r($info);die();
		//$detail = '';
		foreach ($info as $key => $value) {

			$this->db->where_in('id',$value);
			$this->db->set('status',0);
			$db_name = "q".$key;
			$this->db->update($db_name);
			//$num = $num + count($value);
			//$detail_value = '';
			//foreach ($value as $l_key => $l_value) {
			//	if($detail_value=='')  $detail_value = $l_value;
			//	else $detail_value = $detail_value.'/'.$l_value;
		//	}
		//	if($detail=='') $detail = '['.$key.'['.$detail_value.']]';
			//else $detail = $detail.','.'['.$key.'['.$detail_value.']]';

		}
		//print_r($detail);die();
		//$user = $this->m_app->getCurrentUserName();
		//$log_info['name_submit'] = $user;
		///$log_info['question_num'] = $num;
		//$log_info['time_submit'] = NOW;
		//$log_info['question_detail'] = $detail;
		//$this->db->insert('log',$log_info);
	}

	//审核题库和使用题库中的题目数量
	public function getQuestionNumInExam(){
		
		$res['audit'] = 0;
		$res['use'] = 0;
		$data =array(0,1,2);
		for($i=1;$i<=TYPE_TOTAL;$i++){
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where_in('status',$data);
			$this->db->from($db_name);

			$num = $this->db->count_all_results();
			$res['audit'] = $res['audit']+$num;
		}
		for($i=1;$i<=TYPE_TOTAL;$i++){
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',3);
			$this->db->from($db_name);

			$num = $this->db->count_all_results();
			$res['use'] = $res['use']+$num;
		}

		return $res;
		//print_r($res);die();
	}

	public function getQuestionNumInExamByDate(){
		$now = time(); 
		$res =  array();

		//今天
		$today_audit_num = 0;
		$today_use_num = 0;
	    $beginTime = date('Y-m-d 00:00:00', $now);  
	    $endTime = date('Y-m-d 23:59:59', $now);  
	    for($i=1;$i<=TYPE_TOTAL;$i++){
	    	$db_name = 'question_'.$i;
	    	$this->db->select('id');
	    	$this->db->where_in('status',array(0,1,2));
	    	$this->db->where('time_update >',$beginTime);
	    	$this->db->where('time_update <',$endTime);
	    	$this->db->from($db_name);
	    	$num = $this->db->count_all_results();
	    	$today_audit_num = $today_audit_num + $num;	    	
	    }
	    $res['today_audit'] = $today_audit_num;
	    $this->db->select('question_num');
	    $this->db->where('time_submit >',$beginTime);
	    $this->db->where('time_submit <',$endTime);
	    $this->db->from('log');
	    $query = $this->db->get();
	    $today = $query->result_array();
	    foreach ($today as $key => $value) {
	    	$today_use_num = $today_use_num+$value['question_num'];
	    }
	    $res['today_use'] = $today_use_num;

	    //本周
		$week_audit_num = 0;
		$week_use_num = 0;
	    $time = '1' == date('w') ? strtotime('Monday', $now) : strtotime('last Monday', $now);  
	    $beginTime = date('Y-m-d 00:00:00', $time);  
	    $endTime = date('Y-m-d 23:59:59', strtotime('Sunday', $now));  
	    for($i=1;$i<=TYPE_TOTAL;$i++){
	    	$db_name = 'question_'.$i;
	    	$this->db->select('id');
	    	$this->db->where_in('status',array(0,1,2));
	    	$this->db->where('time_update >',$beginTime);
	    	$this->db->where('time_update <',$endTime);
	    	$this->db->from($db_name);
	    	$num = $this->db->count_all_results();
	    	$week_audit_num = $week_audit_num + $num;	    	
	    }
	    $res['week_audit_num'] = $week_audit_num;
	    $this->db->select('question_num');
	    $this->db->where('time_submit >',$beginTime);
	    $this->db->where('time_submit <',$endTime);
	    $this->db->from('log');
	    $query = $this->db->get();
	    $today = $query->result_array();
	    foreach ($today as $key => $value) {
	    	$week_use_num = $week_use_num+$value['question_num'];
	    }
	    $res['week_use_num'] = $week_use_num;

	    //本月
		$month_audit_num = 0;
		$month_use_num = 0;
	    $beginTime = date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m', $now), '1', date('Y', $now)));  
	    $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now))); 
	    for($i=1;$i<=TYPE_TOTAL;$i++){
	    	$db_name = 'question_'.$i;
	    	$this->db->select('id');
	    	$this->db->where_in('status',array(0,1,2));
	    	$this->db->where('time_update >',$beginTime);
	    	$this->db->where('time_update <',$endTime);
	    	$this->db->from($db_name);
	    	$num = $this->db->count_all_results();
	    	$month_audit_num = $month_audit_num + $num;	    	
	    }
	    $res['month_audit_num'] = $month_audit_num;
	    $this->db->select('question_num');
	    $this->db->where('time_submit >',$beginTime);
	    $this->db->where('time_submit <',$endTime);
	    $this->db->from('log');
	    $query = $this->db->get();
	    $today = $query->result_array();
	    foreach ($today as $key => $value) {
	    	$month_use_num = $month_use_num+$value['question_num'];
	    }
	    $res['month_use_num'] = $month_use_num;

	    //三个月内
		$three_month_audit_num = 0;
		$three_month_use_num = 0;
	    $time = strtotime('-2 month', $now);  
	    $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, date('m', $time), 1, date('Y', $time)));  
	    $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now)));  
	    for($i=1;$i<=TYPE_TOTAL;$i++){
	    	$db_name = 'question_'.$i;
	    	$this->db->select('id');
	    	$this->db->where_in('status',array(0,1,2));
	    	$this->db->where('time_update >',$beginTime);
	    	$this->db->where('time_update <',$endTime);
	    	$this->db->from($db_name);
	    	$num = $this->db->count_all_results();
	    	$three_month_audit_num = $three_month_audit_num + $num;	    	
	    }
	    $res['three_month_audit_num'] = $three_month_audit_num;
	    $this->db->select('question_num');
	    $this->db->where('time_submit >',$beginTime);
	    $this->db->where('time_submit <',$endTime);
	    $this->db->from('log');
	    $query = $this->db->get();
	    $today = $query->result_array();
	    foreach ($today as $key => $value) {
	    	$three_month_use_num = $three_month_use_num+$value['question_num'];
	    }
	    $res['three_month_use_num'] = $three_month_use_num;

	    //半年内
		$half_year_audit_num = 0;
		$half_year_use_num = 0;
	    $time = strtotime('-5 month', $now);  
	    $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, date('m', $time), 1, date('Y', $time)));  
	    $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now)));  
	    for($i=1;$i<=TYPE_TOTAL;$i++){
	    	$db_name = 'question_'.$i;
	    	$this->db->select('id');
	    	$this->db->where_in('status',array(0,1,2));
	    	$this->db->where('time_update >',$beginTime);
	    	$this->db->where('time_update <',$endTime);
	    	$this->db->from($db_name);
	    	$num = $this->db->count_all_results();
	    	$half_year_audit_num = $half_year_audit_num + $num;	    	
	    }
	    $res['half_year_audit_num'] = $half_year_audit_num;
	    $this->db->select('question_num');
	    $this->db->where('time_submit >',$beginTime);
	    $this->db->where('time_submit <',$endTime);
	    $this->db->from('log');
	    $query = $this->db->get();
	    $today = $query->result_array();
	    foreach ($today as $key => $value) {
	    	$half_year_use_num = $half_year_use_num+$value['question_num'];
	    }
	    $res['half_year_use_num'] = $half_year_use_num;

	    //今年
		$year_audit_num = 0;
		$year_use_num = 0;
	    $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, 1, 1, date('Y', $now)));  
	    $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, 12, 31, date('Y', $now))); 
	    for($i=1;$i<=TYPE_TOTAL;$i++){
	    	$db_name = 'question_'.$i;
	    	$this->db->select('id');
	    	$this->db->where_in('status',array(0,1,2));
	    	$this->db->where('time_update >',$beginTime);
	    	$this->db->where('time_update <',$endTime);
	    	$this->db->from($db_name);
	    	$num = $this->db->count_all_results();
	    	$year_audit_num = $year_audit_num + $num;	    	
	    }
	    $res['year_audit_num'] = $year_audit_num;
	    $this->db->select('question_num');
	    $this->db->where('time_submit >',$beginTime);
	    $this->db->where('time_submit <',$endTime);
	    $this->db->from('log');
	    $query = $this->db->get();
	    $today = $query->result_array();
	    foreach ($today as $key => $value) {
	    	$year_use_num = $year_use_num+$value['question_num'];
	    }
	    $res['year_use_num'] = $year_use_num;

	    //print_r($res);die();
	    return $res;
	}

	//审核题库详情
	public function getQuestionDetailsInAuditExam(){
		
		$res['need'] = 0;
		$res['pass'] = 0;
		$res['not_pass'] = 0;

		for($i=1;$i<=TYPE_TOTAL;$i++){
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',0);
			$this->db->from($db_name);

			$num = $this->db->count_all_results();
			$res['need'] = $res['need']+$num;
		}
		for($i=1;$i<=TYPE_TOTAL;$i++){
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',2);
			$this->db->from($db_name);

			$num = $this->db->count_all_results();
			$res['pass'] = $res['pass']+$num;
		}
		for($i=1;$i<=TYPE_TOTAL;$i++){
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',1);
			$this->db->from($db_name);

			$num = $this->db->count_all_results();
			$res['not_pass'] = $res['not_pass']+$num;
		}

		return $res;
		//print_r($res);die();
	}

	//出题人详情
	public function getUserDetailsInExam($user){
		
		$res = array();

		foreach ($user['users'] as $key => $value) {
			$origin_name = $value['user_name'];
			$res[$origin_name]['need']=0;
			$res[$origin_name]['pass']=0;
			$res[$origin_name]['not_pass']=0;
			$res[$origin_name]['realname'] = $this->m_user->getUserRealNameByUserName($origin_name);
			for($i=1;$i<=TYPE_TOTAL;$i++){
				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',0);
				$this->db->where('name_origin',$value['user_name']);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$origin_name]['need'] = $res[$origin_name]['need']+$num;
			}
			for($i=1;$i<=TYPE_TOTAL;$i++){
				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',2);
				$this->db->where('name_origin',$value['user_name']);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$origin_name]['pass'] = $res[$origin_name]['pass']+$num;
			}
			for($i=1;$i<=TYPE_TOTAL;$i++){
				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',1);
				$this->db->where('name_origin',$value['user_name']);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$origin_name]['not_pass'] = $res[$origin_name]['not_pass']+$num;
			}
		}

		return $res;
	}

	//题库详情
	public function getQuestionDetailsAllExams(){

		for($i=1;$i<=TYPE_TOTAL;$i++){
			$res[$i]['need'] = 0;
			$res[$i]['pass'] = 0;
			$res[$i]['not_pass'] = 0;
			$res[$i]['use'] = 0;

			$res[$i]['name'] = $this->m_type->getTypeNameByTypeId($i);
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',0);
			$this->db->from($db_name);
			$num = $this->db->count_all_results();
			$res[$i]['need'] = $res[$i]['need']+$num;

			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',1);
			$this->db->from($db_name);
			$num = $this->db->count_all_results();
			$res[$i]['not_pass'] = $res[$i]['not_pass']+$num;

			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',2);
			$this->db->from($db_name);
			$num = $this->db->count_all_results();
			$res[$i]['pass'] = $res[$i]['pass']+$num;

			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',3);
			$this->db->from($db_name);
			$num = $this->db->count_all_results();
			$res[$i]['use'] = $res[$i]['use']+$num;
		}

		return $res;
	}

	//难度详情
	public function getQuestionDetailsByDifficulty(){

		for($j=1;$j<=3;$j++){
			$res[$j]['need'] = 0;
			$res[$j]['pass'] = 0;
			$res[$j]['not_pass'] = 0;
			$res[$j]['audit_total'] = 0;
			$res[$j]['use'] = 0;

			for($i=1;$i<=TYPE_TOTAL;$i++){
				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',0);
				$this->db->where('difficulty',$j);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$j]['need'] = $res[$j]['need']+$num;

				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',1);
				$this->db->where('difficulty',$j);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$j]['not_pass'] = $res[$j]['not_pass']+$num;

				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',2);
				$this->db->where('difficulty',$j);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$j]['pass'] = $res[$j]['pass']+$num;

				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',3);
				$this->db->where('difficulty',$j);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$j]['use'] = $res[$j]['use']+$num;

				$res[$j]['audit_total'] = $res[$j]['need']+$res[$j]['not_pass']+$res[$j]['use'];
			}
		}
		//print_r($res);die();
		return $res;
	}

	//题目类型详情
	public function getQuestionDetailsByQuestionType(){

		for($j=0;$j<=3;$j++){
			$res[$j]['need'] = 0;
			$res[$j]['pass'] = 0;
			$res[$j]['not_pass'] = 0;
			$res[$j]['audit_total'] = 0;
			$res[$j]['use'] = 0;

			for($i=1;$i<=TYPE_TOTAL;$i++){
				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',0);
				$this->db->where('question_type',$j);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$j]['need'] = $res[$j]['need']+$num;

				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',1);
				$this->db->where('question_type',$j);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$j]['not_pass'] = $res[$j]['not_pass']+$num;

				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',2);
				$this->db->where('question_type',$j);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$j]['pass'] = $res[$j]['pass']+$num;

				$db_name = 'question_'.$i;
				$this->db->select('id');
				$this->db->where('status',3);
				$this->db->where('question_type',$j);
				$this->db->from($db_name);
				$num = $this->db->count_all_results();
				$res[$j]['use'] = $res[$j]['use']+$num;

				$res[$j]['audit_total'] = $res[$j]['need']+$res[$j]['not_pass']+$res[$j]['use'];
			}
		}
		//print_r($res);die();
		return $res;
	}

	//题目题材详情
	public function getQuestionDetailsByQuestionTypeAndType(){

		for($j=0;$j<=3;$j++){//题目类型
			for($k=1;$k<=3;$k++){//题目难度
				for($i=1;$i<=TYPE_TOTAL;$i++){//题库类型

					$db_name = 'question_'.$i;
					$this->db->select('id');
					$data = array(0,1,2);
					$this->db->where_in('status',$data);
					$this->db->where('question_type',$j);
					$this->db->from($db_name);
					$num = $this->db->count_all_results();
					$type_name_info = $this->m_question->getTypeNameByTypeId($i);
					$type_name = $type_name_info['type_name'];
					$res[$type_name][$j][$k]['audit'] = $num;

					$db_name = 'question_'.$i;
					$this->db->select('id');
					$this->db->where('status',3);
					$this->db->where('question_type',$j);
					$this->db->from($db_name);
					$num = $this->db->count_all_results();
					$type_name_info = $this->m_question->getTypeNameByTypeId($i);
					$type_name = $type_name_info['type_name'];
					$res[$type_name][$j][$k]['use'] = $num;

				}
			}
		}
		//print_r($res);die();
		return $res;
	}

	//图片题目详情
	public function getPicQuestionDetails(){
		$res = array();
		$res['audit'] = array();
		$res['use'] = array();
			for($i=1;$i<=TYPE_TOTAL;$i++){
				$result['audit'][$i] = array();
				$db_name = 'question_'.$i;
				$this->db->select('id,type,difficulty,purpose,question,icon,name_origin,name_update,time_update');
				$data = array(0,1,2);
				$this->db->where_in('status',$data);
				$this->db->where('icon !=',0);
				$this->db->from($db_name);
				$query = $this->db->get();

				$result['audit'][$i] = $query->result_array();
				$res['audit'] = array_merge($res['audit'],$result['audit'][$i]);

				$this->db->select('id,type,difficulty,purpose,question,icon,name_origin,name_update,time_update');
				$this->db->where('status',3);
				$this->db->where('icon !=',0);
				$this->db->from($db_name);
				$query = $this->db->get();
				$result['use'][$i] = $query->result_array();
				$res['use'] = array_merge($res['use'],$result['use'][$i]);
			}

		foreach ($res['audit'] as $key => $value) {
			$type_name_info = $this->m_question->getTypeNameByTypeId($value['type']);
			$type_name = $type_name_info['type_name'];
			$res['audit'][$key]['type'] = $type_name;
			switch ($res['audit'][$key]['difficulty']) {
				case 1:
					$res['audit'][$key]['difficulty'] ='新手';
					break;
				case 2:
					$res['audit'][$key]['difficulty'] ='熟练';
					break;
				case 3:
					$res['audit'][$key]['difficulty'] ='高手';
					break;				
				default:
					$res['audit'][$key]['difficulty'] ='新手';
					break;
			}
		}
		foreach ($res['use'] as $key => $value) {
			$type_name_info = $this->m_question->getTypeNameByTypeId($value['type']);
			$type_name = $type_name_info['type_name'];
			$res['use'][$key]['type'] = $type_name;
			switch ($res['use'][$key]['difficulty']) {
				case 1:
					$res['use'][$key]['difficulty'] ='新手';
					break;
				case 2:
					$res['use'][$key]['difficulty'] ='熟练';
					break;
				case 3:
					$res['use'][$key]['difficulty'] ='高手';
					break;				
				default:
					$res['use'][$key]['difficulty'] ='新手';
					break;
			}
		}
		//print_r($res);die();
		return $res;
	}

/*
| -------------------------------------------------------------------
|  System Validate Functions
| -------------------------------------------------------------------
*/
	public function validateSubmitToUseExamInfo($input){
		$result = array();
		if(!validate($input)){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}

		return $input;
	}

	public function validateOffUseExamInfo($input){
		$result = array();
		if(!validate($input)){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}

		return $input;
	}

	public function validateDoAuditInfo($input){
		$result = array();
		
		if(!isset($input['audit']) || !validate($input['audit'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}else{
			$result['status'] = intval($input['audit']);	
		}

		if($input['audit']==1){
			if(!isset($input['suggestion']) || !validate($input['suggestion'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_change_password'));
			}else{
				$result['suggestion'] = strval($input['suggestion']);
			}
		}

		if(!isset($input['type']) || !validate($input['type'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif(!isset($input['id']) || !validate($input['id'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}else{
			$result['type'] = intval($input['type']);		
			$result['id'] = intval($input['id']);		
		}
		//print_r($result);die();
		return $result;
	}


}