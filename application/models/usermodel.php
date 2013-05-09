<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model {

	protected $_CI;

	public function __construct(){
		parent::__construct();
		$this->_CI = & get_instance();
	}
/*
| -------------------------------------------------------------------
|  User Basic Functions
| -------------------------------------------------------------------
*/
	public function getUserList(){
		$this->db->select('user_name,user_realname');
		$this->db->from('user');
		$this->db->where('user_status',STATUS_ACTIVE);
		$query = $this->db->get();
		$res = $query->result_array();
		return $res;
	}

	public function getAuditerList(){
		$this->db->select('user_name,user_realname');
		$this->db->from('user');
		$this->db->where('user_status',STATUS_ACTIVE);
		$group_ids = array(1,2);
		$this->db->where_in('group_id',$group_ids);
		$query = $this->db->get();
		$res = $query->result_array();
		return $res;
	}

	public function getUserByName($user_name){
		$this->db->from('user');
		$this->db->where('user_name',$user_name);
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->row_array();

		return $res;
	}

	public function getUserNames(){
		$this->db->select('user_name,user_realname');
		$this->db->from('user');
		$this->db->where('user_status',STATUS_ACTIVE);
		$query = $this->db->get();
		$res = $query->result_array();

		return $res;
	}


	public function addUser($info){
		$this->db->insert('user',$info);
		return true;
	}

	public function editUser($info){
		$this->db->where('user_id',$info['user_id']);
		$this->db->update('user',$info['info']);
	}

	public function getUserStatus(){

		$res['need']=0;
		$res['pass']=0;
		$res['not_pass']=0;
		$res['name'] = $this->m_app->getCurrentUserName();
		for($i=1;$i<=TYPE_TOTAL;$i++){
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',0);
			$this->db->where('name_origin',$res['name']);
			$this->db->from($db_name);
			$num = $this->db->count_all_results();
			$res['need'] = $res['need']+$num;
		}
		for($i=1;$i<=TYPE_TOTAL;$i++){
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',2);
			$this->db->where('name_origin',$res['name']);
			$this->db->from($db_name);
			$num = $this->db->count_all_results();
			$res['pass'] = $res['pass']+$num;
		}
		for($i=1;$i<=TYPE_TOTAL;$i++){
			$db_name = 'question_'.$i;
			$this->db->select('id');
			$this->db->where('status',1);
			$this->db->where('name_origin',$res['name']);
			$this->db->from($db_name);
			$num = $this->db->count_all_results();
			$res['not_pass'] = $res['not_pass']+$num;
		}

		
		$this->db->select('user_name');
		$this->db->from('user_details');
		$this->db->where('user_name',$res['name']);
		$user_name_num = $this->db->count_all_results();

		
		$user_data['user_name'] = $res['name'];
		$user_data['user_details_audit_pass'] = $res['pass'];
		$user_data['user_details_audit_not_pass'] = $res['not_pass'];
		$user_data['user_details_audit_need'] = $res['need'];
		//$user_data['user_details_record'] = NOW;

		if($user_name_num){
			$this->db->select('user_details_record');
			$this->db->where('user_name',$user_data['user_name']);
			$this->db->from('user_details');
			$query = $this->db->get();
			$last_time  = $query->row_array();
			$res['time'] = $last_time['user_details_record'];
			if($res['time']=='0000-00-00 00:00:00'){
				$res['time'] = '这是您第一次登录';
			}
			$this->db->where('user_name',$user_data['user_name']);
			$this->db->update('user_details',$user_data);
		}else{
			$res['time'] = '这是您第一次登录';
			$this->db->insert('user_details',$user_data);
		}
		
		return $res;
	}

	public function setThisLogin($user){
		$this->db->select('user_name');
		$this->db->from('user_details');
		$this->db->where('user_name',$user['user_name']);
		$user_name_num = $this->db->count_all_results();
		$data['user_details_this'] = NOW;
		if($user_name_num){
			$this->db->where('user_name',$user['user_name']);
			$this->db->update('user_details',$data);
		}else{

		}
	}

	public function setLastLogin($user_name){
		$this->db->select('user_details_this');
		$this->db->from('user_details');
		$this->db->where('user_name',$user_name);
		$query = $this->db->get();
		$data = $query->row_array();
		$this->db->set('user_details_record',$data['user_details_this']);
		$this->db->update('user_details');
	}

	public function getUserRealNameByUserName($user_name){
		$this->db->select('user_realname');
		$this->db->where('user_name',$user_name);
		$this->db->from('user');
		$query = $this->db->get();
		$res = $query->row_array();
		return $res['user_realname'];
	}

	public function getHistoryScan(){
		$res = array();
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->where('user_name',$user_name);
		$this->db->from('history');
		$query = $this->db->get();
		$res = $query->row_array();	
		$result = array();
		$result = $this->m_question->getQuestionListSection($res);
		
		return $result;
	}

/*
| -------------------------------------------------------------------
|  User Validate Functions
| -------------------------------------------------------------------
*/
	public function validateLoginInfo($input){
		$result = array();
		if(!isset($input['user_name']) || !validate($input['user_name'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}elseif(!isset($input['user_password']) || !validate($input['user_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_user_password'));
		}elseif(!isset($input['captcha']) || !validate($input['captcha'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_captcha'));
		}else{
			$result['user_name'] = strval($input['user_name']);
			$result['user_password'] = strval($input['user_password']);
			$result['captcha'] = strval($input['captcha']);
		}

		return $result;
	}

	public function validateChangePasswordInfo($input){
		$result = array();
		if(!isset($input['user_password']) || !validate($input['user_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif(!isset($input['password_confirm']) || !validate($input['password_confirm'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif($input['password_confirm'] != $input['user_password']){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}else{
			$result['user_password'] = strval($input['user_password']);
		}

		return $result;
	}

	public function validateAddUserInfo($input){
		$result = array();
		if($this->checkUserName($input['user_name'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('repeat_username'));
		}elseif($this->checkUserRealName($input['user_realname'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('repeat_userrealname'));
		}elseif(!isset($input['user_name']) || !validate($input['user_name'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif(!isset($input['user_password']) || !validate($input['user_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif(!isset($input['user_rept_password']) || !validate($input['user_rept_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif($input['user_password'] != $input['user_rept_password']){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif(!isset($input['permission']) || !validate($input['permission'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif(!isset($input['user_realname']) || !validate($input['user_realname'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}else{
			$result['user_name'] = strval($input['user_name']);
			$result['user_realname'] = strval($input['user_realname']);
			$result['user_password'] = strval($input['user_password']);
			$result['group_id'] = strval($input['permission']);			
		}
		
		//print_r($this->response->generate_json_response());die();
		return $result;
	}


/*
| -------------------------------------------------------------------
|  User Extra Functions
| -------------------------------------------------------------------
*/
	public function checkUserName($user_name){
		$this->db->from('user');
		$this->db->where('user_name',$user_name);
		$res = $this->db->count_all_results();
		return $res;
	}

	public function checkUserRealName($user_realname){
		$this->db->from('user');
		$this->db->where('user_realname',$user_realname);
		$res = $this->db->count_all_results();
		return $res;
	}


}