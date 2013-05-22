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
	public function deleteType($info){
		$user_id = $this->m_app->getCurrentUserId();
		$this->db->select('user_password');
		$this->db->where('user_id',$user_id);
		$this->db->from('user');
		$query = $this->db->get();
		$user_password = $query->row_array();
		if(md5($info['user_password'].SALT)==$user_password['user_password']){
			$this->db->set('visible',0);
			$this->db->where('type_id',$info['type_id']);
			$this->db->update('type_config');
			return true;
		}else{
			return false;
		}
	}

	public function changeStatus($info){
		if($info['status']==1){
			$this->db->set('status',0);
		}else{
			$this->db->set('status',1);
		}		
		$this->db->set('update_time',NOW);
		$this->db->where('type_id',$info['type_id']);
		$this->db->update('type_config');
	}

	public function getTypeStatus(){
		$res =  array();
		$this->db->select('type_id');
		$this->db->from('type_config');
		$query = $this->db->get();
		$type_ids = $query->result_array();

		foreach ($type_ids as $key => $value) {
			$this->db->select('id');
			$this->db->where('type',$value['type_id']);
			$data = array(0,1,2,3);
			$this->db->where_in('status',$data);
			$this->db->from('question');
			$res[$value['type_id']] = $this->db->count_all_results();
		}
		//print_r($res);die();
		return $res;
	}

	public function editType($info){
		if($info['type_id']==0){
			$this->db->set('type_name',$info['type_name']);
			$this->db->set('section',$info['section']);
			$this->db->insert('type_config');
			$this->db->select_max('type_config_id');
			$this->db->from('type_config');
			$query = $this->db->get();
			$num = $query->row_array();
			$this->db->set('type_id',$num['type_config_id']-2);
			$this->db->set('update_time',NOW);
			$this->db->where('type_config_id',$num['type_config_id']);
			$this->db->update('type_config');
		}else{
			$this->db->set('type_name',$info['type_name']);
			$this->db->set('section',$info['section']);
			$this->db->set('update_time',NOW);
			$this->db->where('type_id',$info['type_id']);
			$this->db->update('type_config');
		}
	}

	public function getTypeConfig(){
		$res= array();
		$this->db->from('type_config');
		$query = $this->db->get();
		$res = $query->result_array();
		return $res;
	}

	public function offSearchInfo($info){
		$this->db->set('keyword',$info);
		$this->db->set('offindex',1);
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->where('user_name',$user_name);
		$this->db->update('system');
	}

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
		$this->db->where('id',$info['id']);
		$this->db->update('question',$info);
	}

	public function getSubmitLog(){
		$this->db->from('log');
		$this->db->limit(18);
		$this->db->order_by('time_submit','desc');
		$query = $this->db->get();
		$res = $query->result_array();
		//print_r($res);die();
		foreach ($res as $key => $value) {
			$res[$key]['name_submit'] = $this->m_user->getUserRealNameByUserName($value['name_submit']);
		}
		
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

		$this->db->where_in('id',$info['question']);
		$this->db->set('status',QUESTION_PREPARE_USE);
		$this->db->update('question');
		$num = count($info['question']);
		$detail_value = '';
		foreach ($info['question'] as $key => $value) {
			if($detail_value=='')  $detail_value = $value;
			else $detail_value = $detail_value.'/'.$value;
		}
		$detail = '['.$detail_value.']';
		
		//print_r($detail);die();
		$user = $this->m_app->getCurrentUserName();
		$log_info['name_submit'] = $user;
		$log_info['question_num'] = $num;
		$log_info['time_submit'] = NOW;
		$log_info['question_detail'] = $detail;
		$this->db->insert('log',$log_info);

		$this->db->select('global_version');
		$this->db->where('global_id',1);
		$this->db->from('global');
		$query = $this->db->get();
		$global_version = $query->row_array();
		$global_version_index = $global_version['global_version']+1;
		$this->db->set('global_version',$global_version_index);
		$this->db->update('global');
	}

	public function offQuestion($info){

		$this->db->where_in('id',$info['question']);
		$this->db->set('status',QUESTION_NOT_USE);
		$this->db->update('question');
		
	}

	//审核题库和使用题库中的题目数量
	public function getQuestionNumInExam(){
		$type_ids = $this->m_type->getActiveTypeIds();
		$res['audit'] = 0;
		$res['use'] = 0;
		$data =array(0,1,2);
	
		$this->db->select('id');
		$this->db->where_in('status',$data);
		$this->db->where_in('type',$type_ids);
		$this->db->from('question');
		$num = $this->db->count_all_results();
		$res['audit'] = $res['audit']+$num;
		
		$this->db->select('id');
		$this->db->where('status',3);
		$this->db->where_in('type',$type_ids);
		$this->db->from('question');
		$num = $this->db->count_all_results();
		$res['use'] = $res['use']+$num;

		return $res;
	}

	public function getQuestionNumInExamByDate(){
		$now = time(); 
		$res =  array();
		$type_ids = $this->m_type->getActiveTypeIds();
		//今天
		$today_audit_num = 0;
		$today_use_num = 0;
	    $beginTime = date('Y-m-d 00:00:00', $now);  
	    $endTime = date('Y-m-d 23:59:59', $now);  

    	$this->db->select('id');
    	$this->db->where_in('status',array(0,1,2));
    	$this->db->where_in('type',$type_ids);
    	$this->db->where('time_update >',$beginTime);
    	$this->db->where('time_update <',$endTime);
    	$this->db->from('question');
    	$res['today_audit'] = $this->db->count_all_results();
	    
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

    	$this->db->select('id');
    	$this->db->where_in('status',array(0,1,2));
    	$this->db->where_in('type',$type_ids);
    	$this->db->where('time_update >',$beginTime);
    	$this->db->where('time_update <',$endTime);
    	$this->db->from('question');
    	$res['week_audit_num'] = $this->db->count_all_results();

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

    	$this->db->select('id');
    	$this->db->where_in('status',array(0,1,2));
    	$this->db->where_in('type',$type_ids);
    	$this->db->where('time_update >',$beginTime);
    	$this->db->where('time_update <',$endTime);
    	$this->db->from('question');
    	$res['month_audit_num'] = $this->db->count_all_results();
	    
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

    	$this->db->select('id');
    	$this->db->where_in('status',array(0,1,2));
    	$this->db->where_in('type',$type_ids);
    	$this->db->where('time_update >',$beginTime);
    	$this->db->where('time_update <',$endTime);
    	$this->db->from('question');
    	$res['three_month_audit_num'] = $this->db->count_all_results();

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

    	$this->db->select('id');
    	$this->db->where_in('status',array(0,1,2));
    	$this->db->where_in('type',$type_ids);
    	$this->db->where('time_update >',$beginTime);
    	$this->db->where('time_update <',$endTime);
    	$this->db->from('question');
    	$res['half_year_audit_num'] = $this->db->count_all_results();
 	
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

    	$this->db->select('id');
    	$this->db->where_in('status',array(0,1,2));
    	$this->db->where_in('type',$type_ids);
    	$this->db->where('time_update >',$beginTime);
    	$this->db->where('time_update <',$endTime);
    	$this->db->from('question');
    	$res['year_audit_num'] = $this->db->count_all_results();
 	
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
		$type_ids = $this->m_type->getActiveTypeIds();
		$this->db->select('id');
		$this->db->where('status',0);
		$this->db->where_in('type',$type_ids);
		$this->db->from('question');
		$res['need'] = $this->db->count_all_results();

		$this->db->select('id');
		$this->db->where('status',2);
		$this->db->where_in('type',$type_ids);
		$this->db->from('question');
		$res['pass']= $this->db->count_all_results();

		$this->db->select('id');
		$this->db->where('status',1);
		$this->db->where_in('type',$type_ids);
		$this->db->from('question');
		$res['not_pass'] = $this->db->count_all_results();

		return $res;

	}

	//出题人详情
	public function getUserDetailsInExam($user){
		$type_ids = $this->m_type->getActiveTypeIds();
		$res = array();

		foreach ($user['users'] as $key => $value) {
			$origin_name = $value['user_name'];
			$res[$origin_name]['realname'] = $this->m_user->getUserRealNameByUserName($origin_name);

			$this->db->select('id');
			$this->db->where('status',0);
			$this->db->where_in('type',$type_ids);
			$this->db->where('name_origin',$value['user_name']);
			$this->db->from('question');
			$res[$origin_name]['need'] = $this->db->count_all_results();
		
			$this->db->select('id');
			$this->db->where('status',2);
			$this->db->where_in('type',$type_ids);
			$this->db->where('name_origin',$value['user_name']);
			$this->db->from('question');
			$res[$origin_name]['pass'] = $this->db->count_all_results();

			$this->db->select('id');
			$this->db->where('status',1);
			$this->db->where_in('type',$type_ids);
			$this->db->where('name_origin',$value['user_name']);
			$this->db->from('question');
			$res[$origin_name]['not_pass'] = $this->db->count_all_results();
		}
		return $res;
	}

	//题库详情
	public function getQuestionDetailsAllExams(){
		$total_type =  $this->getTypeTotalNum();

		for($i=1;$i<=$total_type;$i++){
			$res[$i]['need'] = 0;
			$res[$i]['pass'] = 0;
			$res[$i]['not_pass'] = 0;
			$res[$i]['use'] = 0;

			$res[$i]['name'] = $this->m_type->getTypeNameByTypeId($i);

			$this->db->select('id');
			$this->db->where('status',0);
			$this->db->where('type',$i);
			$this->db->from('question');
			$res[$i]['need'] = $this->db->count_all_results();

			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',1);
			$this->db->where('type',$i);
			$this->db->from('question');
			$res[$i]['not_pass'] = $this->db->count_all_results();

			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',2);
			$this->db->where('type',$i);
			$this->db->from('question');
			$res[$i]['pass'] = $this->db->count_all_results();

			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',3);
			$this->db->where('type',$i);
			$this->db->from('question');
			$res[$i]['use'] = $this->db->count_all_results();
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
				
			$this->db->select('id');
			$this->db->where('status',0);
			$this->db->where('difficulty',$j);
			$this->db->from('question');
			$res[$j]['need'] = $this->db->count_all_results();

			$this->db->select('id');
			$this->db->where('status',1);
			$this->db->where('difficulty',$j);
			$this->db->from('question');
			$res[$j]['not_pass']= $this->db->count_all_results();

			$this->db->select('id');
			$this->db->where('status',2);
			$this->db->where('difficulty',$j);
			$this->db->from('question');
			$res[$j]['pass'] = $this->db->count_all_results();

			$this->db->select('id');
			$this->db->where('status',3);
			$this->db->where('difficulty',$j);
			$this->db->from('question');
			$res[$j]['use']= $this->db->count_all_results();

			$res[$j]['audit_total'] = $res[$j]['need']+$res[$j]['not_pass']+$res[$j]['use'];
			
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
				
			$this->db->select('id');
			$this->db->where('status',0);
			$this->db->where('question_type',$j);
			$this->db->from('question');
			$res[$j]['need'] = $this->db->count_all_results();

			$this->db->select('id');
			$this->db->where('status',1);
			$this->db->where('question_type',$j);
			$this->db->from('question');
			$res[$j]['not_pass'] = $this->db->count_all_results();

			$this->db->where('status',2);
			$this->db->where('question_type',$j);
			$this->db->from('question');
			$res[$j]['pass'] = $this->db->count_all_results();

			$this->db->select('id');
			$this->db->where('status',3);
			$this->db->where('question_type',$j);
			$this->db->from('question');
			$res[$j]['use'] = $this->db->count_all_results();

			$res[$j]['audit_total'] = $res[$j]['need']+$res[$j]['not_pass']+$res[$j]['use'];
		}
		return $res;
	}

	//题目题材详情
	public function getQuestionDetailsByQuestionTypeAndType(){
		$total_type =  $this->getTypeTotalNum();
		for($j=0;$j<=3;$j++){//题目类型
			for($k=1;$k<=3;$k++){//题目难度
				for($i=1;$i<=$total_type;$i++){//题库类型

					$this->db->select('id');
					$data = array(0,1,2);
					$this->db->where_in('status',$data);
					$this->db->where('question_type',$j);
					$this->db->where('type',$i);
					$this->db->from('question');
					$num = $this->db->count_all_results();
					$type_name = $this->m_type->getTypeNameByTypeId($i);
					$res[$type_name][$j][$k]['audit'] = $num;

					$this->db->select('id');
					$this->db->where('status',3);
					$this->db->where('question_type',$j);
					$this->db->where('type',$i);
					$this->db->from('question');
					$num = $this->db->count_all_results();
					$type_name = $this->m_type->getTypeNameByTypeId($i);
					$res[$type_name][$j][$k]['use'] = $num;
				}
			}
		}
		return $res;
	}

	//图片题目详情	
	public function getPicQuestionDetails(){
		$total_type =  $this->getTypeTotalNum();
		for($j=1;$j<=3;$j++){//题目类型
			for($k=1;$k<=3;$k++){//题目难度
				for($i=1;$i<=$total_type;$i++){//题库类型

					$this->db->select('id');
					$data = array(0,1,2);
					$this->db->where_in('status',$data);
					$this->db->where('question_type',$j);
					$this->db->where('type',$i);
					$this->db->where('icon >',0);
					$this->db->where('difficulty',$k);
					$this->db->from('question');
					$num = $this->db->count_all_results();
					$type_name = $this->m_type->getTypeNameByTypeId($i);
					$res[$type_name][$j][$k]['audit'] = $num;

					$this->db->select('id');
					$this->db->where('status',3);
					$this->db->where('question_type',$j);
					$this->db->where('type',$i);
					$this->db->where('icon >',0);
					$this->db->where('difficulty',$k);
					$this->db->from('question');
					$num = $this->db->count_all_results();
					$type_name =$this->m_type->getTypeNameByTypeId($i);
					$res[$type_name][$j][$k]['use'] = $num;

				}
			}
		}
		return $res;
	}
/*
| -------------------------------------------------------------------
|  System Validate Functions
| -------------------------------------------------------------------
*/
	public function validateOffSearchInfo($input){
		$result = array();
		$result['keyword'] = strval($input['keyword']);
		return $result['keyword'];
	}

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
			$result['suggestion'] = strval($input['suggestion']);
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

	public function validateEditTypeInfo($input){
		$result = array();
		
		if(!isset($input['type_id']) || !validate($input['type_id'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_type_id'));
		}elseif(!isset($input['type_name']) || !validate($input['type_name'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_type_name'));
		}elseif(!isset($input['section']) || !validate($input['section'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_section'));
		}else{
			$result['type_id'] = intval($input['type_id']);		
			$result['type_name'] = strval($input['type_name']);	
			$result['section'] = strval($input['section']);		
		}
		return $result;
	}

	public function validateDeleteTypeInfo($input){
		$result = array();
		
		if(!isset($input['type_id']) || !validate($input['type_id'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_type_id'));
		}elseif(!isset($input['user_password']) || !validate($input['user_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_user_password'));
		}else{
			$result['type_id'] = intval($input['type_id']);		
			$result['user_password'] = strval($input['user_password']);		
		}
		return $result;
	}
/*
| -------------------------------------------------------------------
|  System Extra Functions
| -------------------------------------------------------------------
*/
	public function getTypeTotalNum(){
		$this->db->select_max('type_config_id');
		$this->db->from('type_config');
		$query = $this->db->get();
		$num = $query->row_array();

		return $num['type_config_id'];
	}
}