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
	public function getTypeNameByTypeId($type_id){
		$this->db->select('type_name');
		$this->db->from('type_config');
		$this->db->where('type_id',$type_id);
		$this->db->limit(1);
		$query = $this->db->get();
		$res = $query->row_array();

		return $res['type_name'];
	}

/*
| -------------------------------------------------------------------
|  Type Validate Functions
| -------------------------------------------------------------------
*/


}