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
	public function editUserHistory($info){
		$user = $this->m_app->getCurrentUserName();
		$info['type'] = SEARCH_ALL;
		$info['question_type'] = SEARCH_ALL;
		$info['difficult'] = SEARCH_ALL;
		$info['user'] = $user;
		$info['auditer'] = SEARCH_SUPER_ALL;
		$info['date_start'] = '0000-00-00 00:00:00';
		$info['date_end'] = '0000-00-00 00:00:00';
		$info['condition'] = 1;
		$info['search'] = '';
		$info['order_item'] = 1;
		$info['order'] = 1;
		$info['pagination'] = 1;
		$info['total_pagination'] = 1;
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->where('user_name',$user_name);
		$this->db->update('history',$info);
	}

	public function getSystemSubHistory(){
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->select('subindex');
		$this->db->where('user_name',$user_name);
		$this->db->from('system');
		$query = $this->db->get();
		$res = $query->row_array();

		return $res['subindex'];
	}

	public function getSystemOffHistory(){
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->select('offindex,keyword');
		$this->db->where('user_name',$user_name);
		$this->db->from('system');
		$query = $this->db->get();
		$res = $query->row_array();

		return $res;
	}

	public function editHistory($info){
		$user_name = $this->m_app->getCurrentUserName();
		if($info=='first'){
			$this->db->set('pagination',1);
		}elseif($info=='last'){
			$this->db->select('total_pagination');
			$this->db->where('user_name',$user_name);
			$this->db->from('history');
			$query = $this->db->get();
			$total = $query->row_array();
			$this->db->set('pagination',$total['total_pagination']);
		}elseif($info=='pre'){
			$this->db->select('pagination');
			$this->db->where('user_name',$user_name);
			$this->db->from('history');
			$query = $this->db->get();
			$pagination = $query->row_array();
			if($pagination['pagination']>1) $pagination['pagination'] = $pagination['pagination']-1;
			$this->db->set('pagination',$pagination['pagination']);
		}
		elseif($info=='next'){
			$this->db->select('pagination,total_pagination');
			$this->db->where('user_name',$user_name);
			$this->db->from('history');
			$query = $this->db->get();
			$pagination = $query->row_array();
			if($pagination['pagination']<$pagination['total_pagination']) $pagination['pagination'] = $pagination['pagination']+1;
			$this->db->set('pagination',$pagination['pagination']);
		}
		$this->db->where('user_name',$user_name);
		$this->db->update('history');
	}

	public function editSubHistory($info){
		$user_name = $this->m_app->getCurrentUserName();
		if($info=='first'){
			$this->db->set('subindex',1);
		}elseif($info=='last'){
			$this->db->select('subtotalindex');
			$this->db->where('user_name',$user_name);
			$this->db->from('system');
			$query = $this->db->get();
			$total = $query->row_array();
			$this->db->set('subindex',$total['subtotalindex']);
		}elseif($info=='pre'){
			$this->db->select('subindex');
			$this->db->where('user_name',$user_name);
			$this->db->from('system');
			$query = $this->db->get();
			$pagination = $query->row_array();
			if($pagination['subindex']>1) $pagination['subindex'] = $pagination['subindex']-1;
			$this->db->set('subindex',$pagination['subindex']);
		}
		elseif($info=='next'){
			$this->db->select('subindex,subtotalindex');
			$this->db->where('user_name',$user_name);
			$this->db->from('system');
			$query = $this->db->get();
			$pagination = $query->row_array();
			if($pagination['subindex']<$pagination['subtotalindex']) $pagination['subindex'] = $pagination['subindex']+1;
			$this->db->set('subindex',$pagination['subindex']);
		}
		$this->db->where('user_name',$user_name);
		$this->db->update('system');
	}

	public function editOffHistory($info){
		$user_name = $this->m_app->getCurrentUserName();
		if($info=='first'){
			$this->db->set('offindex',1);
		}elseif($info=='last'){
			$this->db->select('offtotalindex');
			$this->db->where('user_name',$user_name);
			$this->db->from('system');
			$query = $this->db->get();
			$total = $query->row_array();
			$this->db->set('offindex',$total['offtotalindex']);
		}elseif($info=='pre'){
			$this->db->select('offindex');
			$this->db->where('user_name',$user_name);
			$this->db->from('system');
			$query = $this->db->get();
			$pagination = $query->row_array();
			if($pagination['offindex']>1) $pagination['offindex'] = $pagination['offindex']-1;
			$this->db->set('offindex',$pagination['offindex']);
		}
		elseif($info=='next'){
			$this->db->select('offindex,offtotalindex');
			$this->db->where('user_name',$user_name);
			$this->db->from('system');
			$query = $this->db->get();
			$pagination = $query->row_array();
			if($pagination['offindex']<$pagination['offtotalindex']) $pagination['offindex'] = $pagination['offindex']+1;
			$this->db->set('offindex',$pagination['offindex']);
		}
		$this->db->where('user_name',$user_name);
		$this->db->update('system');
	}

	public function editHistoryRedirect($info){
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->select('total_pagination');
		$this->db->where('user_name',$user_name);
		$this->db->from('history');
		$query = $this->db->get();
		$total = $query->row_array();

		if($info<1) $info = 1;
		elseif($info>$total['total_pagination']) $info = $total['total_pagination'];

		$this->db->set('pagination',$info);
		$this->db->where('user_name',$user_name);
		$this->db->update('history');
	}

	public function editSystemSubRedirect($info){
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->select('subtotalindex');
		$this->db->where('user_name',$user_name);
		$this->db->from('system');
		$query = $this->db->get();
		$total = $query->row_array();

		if($info<1) $info = 1;
		elseif($info>$total['subtotalindex']) $info = $total['subtotalindex'];

		$this->db->set('subindex',$info);
		$this->db->where('user_name',$user_name);
		$this->db->update('system');
	}

	public function editSystemOffRedirect($info){
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->select('offtotalindex');
		$this->db->where('user_name',$user_name);
		$this->db->from('system');
		$query = $this->db->get();
		$total = $query->row_array();

		if($info<1) $info = 1;
		elseif($info>$total['offtotalindex']) $info = $total['offtotalindex'];

		$this->db->set('offindex',$info);
		$this->db->where('user_name',$user_name);
		$this->db->update('system');
	}

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
		$this->db->where('user_status',STATUS_ACTIVE);
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

		//搜索历史
		$data['user_name'] = $info['user_name'];
		$this->db->insert('history',$data);
		//出题详情
		$this->db->insert('user_details',$data);
		//上架浏览历史
		$this->db->insert('system',$data);
	}

	public function editUser($info){
		$this->db->select('user_password');
		$this->db->where('user_id',$info['user_id']);
		$this->db->from('user');
		$query = $this->db->get();
		$former_user_password = $query->row_array();
		if($former_user_password['user_password']==$info['former_user_password']){
			$this->db->where('user_id',$info['user_id']);
			$this->db->set('user_password',$info['user_password']);
			$this->db->update('user');
			return true;
		}else{
			return false;
		}	
	}

	public function getUserStatus(){

		$res['need']=0;
		$res['pass']=0;
		$res['not_pass']=0;
		$res['name'] = $this->m_app->getCurrentUserName();

		$this->db->select('id');
		$this->db->where('status',0);
		$this->db->where('name_origin',$res['name']);
		$this->db->from('question');
		$num = $this->db->count_all_results();
		$res['need'] = $res['need']+$num;

		$this->db->select('id');
		$this->db->where('status',1);
		$this->db->where('name_origin',$res['name']);
		$this->db->from('question');
		$num = $this->db->count_all_results();
		$res['not_pass'] = $res['not_pass']+$num;

		$this->db->select('id');
		$this->db->where('status',2);
		$this->db->where('name_origin',$res['name']);
		$this->db->from('question');
		$num = $this->db->count_all_results();
		$res['pass'] = $res['pass']+$num;

		$this->db->select('user_name');
		$this->db->from('user_details');
		$this->db->where('user_name',$res['name']);
		$user_name_num = $this->db->count_all_results();
		
		$user_data['user_name'] = $res['name'];
		$user_data['user_details_audit_pass'] = $res['pass'];
		$user_data['user_details_audit_not_pass'] = $res['not_pass'];
		$user_data['user_details_audit_need'] = $res['need'];

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
		$data = array();
		$pagination = 1;
		foreach ($res as $key => $value) {
			if($key=='pagination') $pagination= $value;
			elseif($key=='total_pagination') $total_pagination= $value;
			else $data[$key] = $value;
		}

		$result = array();
		$result = $this->m_question->getQuestionListSection($data,$pagination);
		
		return $result;
	}

	public function getUserHistory(){
		$res = array();
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->where('user_name',$user_name);
		$this->db->from('history');
		$query = $this->db->get();
		$res = $query->row_array();	
		
		return $res;
	}

/*
| -------------------------------------------------------------------
|  User Validate Functions
| -------------------------------------------------------------------
*/
	public function validatePaginationFirst($input){
		$result = array();
		if(!isset($input['pagination_first']) || !validate($input['pagination_first'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}else{
			$result = strval($input['pagination_first']);
		}
		return $result;
	}

	public function validatePaginationRedirect($input){
		$result = array();
		if(!isset($input['pagination']) || !validate($input['pagination'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_pagination'));
		}else{
			$result = intval($input['pagination']);
		}
		return $result;
	}

	public function validatePaginationPre($input){
		$result = array();
		if(!isset($input['pagination_pre']) || !validate($input['pagination_pre'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}else{
			$result = strval($input['pagination_pre']);
		}

		return $result;
	}

	public function validatePaginationNext($input){
		$result = array();
		if(!isset($input['pagination_next']) || !validate($input['pagination_next'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}else{
			$result = strval($input['pagination_next']);
		}

		return $result;
	}

	public function validatePaginationLast($input){
		$result = array();
		if(!isset($input['pagination_last']) || !validate($input['pagination_last'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}else{
			$result = strval($input['pagination_last']);
		}

		return $result;
	}

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
		if(!isset($input['former_user_password']) || !validate($input['former_user_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_input_password'));
		}elseif(!isset($input['user_password']) || !validate($input['user_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_input_password'));
		}elseif(!isset($input['password_confirm']) || !validate($input['password_confirm'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_input_password'));
		}elseif($input['password_confirm'] != $input['user_password']){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_confirm_password'));
		}else{
			$result['former_user_password'] = strval($input['former_user_password']);
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
			$this->_CI->response->setDetail($this->lang->line('error_user_name'));
		}elseif(!isset($input['user_password']) || !validate($input['user_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_user_password'));
		}elseif(!isset($input['user_rept_password']) || !validate($input['user_rept_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_user_rept_password'));
		}elseif($input['user_password'] != $input['user_rept_password']){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_user_rept_password'));
		}elseif(!isset($input['permission']) || !validate($input['permission'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_permission'));
		}elseif(!isset($input['user_realname']) || !validate($input['user_realname'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_user_realname'));
		}else{
			$result['user_name'] = strval($input['user_name']);
			$result['user_realname'] = strval($input['user_realname']);
			$result['user_password'] = strval($input['user_password']);
			$result['group_id'] = strval($input['permission']);			
		}
		
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