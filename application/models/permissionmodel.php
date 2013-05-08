<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissionmodel extends CI_Model {

	protected $_CI;

	public function __construct(){
		parent::__construct();
		$this->_CI = & get_instance();
	}
/*
| -------------------------------------------------------------------
|  Permission Basic Functions
| -------------------------------------------------------------------
*/
	public function getUserPermission($user_id){
		$this->db->select('group_id');
		$this->db->from('user');
		$this->db->where('user_id',$user_id);
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->row_array();
		//print_r($res);die();
		return $res;
	}


/*
| -------------------------------------------------------------------
|  Permission Validate Functions
| -------------------------------------------------------------------
*/
	public function validateLoginInfo($input){
		$result = array();
		if(!isset($input['user_name']) || !validate($input['user_name'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}elseif(!isset($input['user_password']) || !validate($input['user_password'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}else{
			$result['user_name'] = strval($input['user_name']);
			$result['user_password'] = strval($input['user_password']);
		}

		return $result;
	}

}