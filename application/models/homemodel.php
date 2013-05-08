<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homemodel extends CI_Model {

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
	public function getUserByName($user_name){
		$this->db->from('user');
		$this->db->where('user_name',$user_name);
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->row_array();

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
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}else{
			$result['user_name'] = strval($input['user_name']);
			$result['user_password'] = strval($input['user_password']);
		}

		return $result;
	}

}