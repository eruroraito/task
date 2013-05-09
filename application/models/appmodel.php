<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appmodel extends CI_Model {

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

	public function checkUserLogin(){
		$user = $this->session->userdata('user');

		if($user !== false && is_array($user) && !empty($user) && isset($user['user_name'])){
			return true;
		}else{
			return false;
		}
	}
	
	public function getCurrentUserId(){
		if($this->checkUserLogin()){
			$user = $this->session->userdata('user');
			return $user['user_id'];
		}else{
			return 0;
		}
	}

	public function getCurrentUserName(){
		if($this->checkUserLogin()){
			$user = $this->session->userdata('user');
			return $user['user_name'];
		}else{
			return '';
		}
	}

	public function getCurrentUserRealName(){
		if($this->checkUserLogin()){
			$user = $this->session->userdata('user');
			return $user['user_realname'];
		}else{
			return '';
		}
	}

	public function getPermission(){
		if($this->checkUserLogin()){
			$user = $this->session->userdata('user');
			$this->db->select('group_id');
			$this->db->where('user_name',$user['user_name']);
			$this->db->from('user');
			$query = $this->db->get();
			$res = $query->row_array();
			return $res['group_id'];
		}else{
			return '';
		}
	}



/*
| -------------------------------------------------------------------
|  User Validate Functions
| -------------------------------------------------------------------
*/


}