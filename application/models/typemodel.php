<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Typemodel extends CI_Model {

	protected $_CI;

	public function __construct(){
		parent::__construct();
		$this->_CI = & get_instance();
	}
/*
| -------------------------------------------------------------------
|  Type Basic Functions
| -------------------------------------------------------------------
*/
	public function getTypeNameByTypeId($type_config_id){
		$this->db->from('type_config');
		$this->db->where('type_config_id',$type_config_id);
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->row_array();
		if($res['status']==0) return 'not_active';
		else return $res['type_name'];
	}

	public function getTypeName($type_id){
		$this->db->select('type_name');
		$this->db->where('type_id',$type_id);
		$this->db->from('type_config');	
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->row_array();
		return $res['type_name'];
	}

	public function getActiveTypeIds(){
		$this->db->select('type_id');
		$this->db->where('status',1);
		$this->db->from('type_config');
		$query = $this->db->get();
		$res = $query->result_array();
		$result = array();
		foreach ($res as $key => $value) {
			array_push($result,$value['type_id']);
		}

		return $result;
	}
/*
| -------------------------------------------------------------------
|  Type Validate Functions
| -------------------------------------------------------------------
*/

}