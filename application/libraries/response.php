<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Response {

	protected $_items = array();
	protected $_totalCount = 0;
	protected $_detail = '';
	protected $_success = true;
	protected $_addon = '';

	public function __construct(){}

	public function setItems($input){
		if(is_array($input)){
			$this->_items = $input;
		}
	}

	public function setTotalCount($input){
		if(null !== $input){
			$this->_totalCount = intval($input);
		}
	}

	public function setDetail($input){
		if(null !== $input){
			$this->_detail = strval($input);
		}
	}

	public function setSuccess($input){
		$this->_success = $input;
	}

	public function setAddon($input){
		if(null !== $input){
			$this->_addon = $input;
		}
	}

	public function getAddon(){
		return $this->_addon;
	}

	public function isSuccess(){
		return $this->_success;
	}

	public function generate_json_response(){
		$resArray = array(
			'items'      => $this->_items,
			'totalCount' => $this->_totalCount,
			'detail'     => $this->_detail,
			'success'    => $this->_success,
			'addon'      => $this->_addon,
		);

		return json_encode($resArray);
	}

	public function generate_items_json_response(){
		return json_encode($this->_items);
	}
}

/* End of file response.php */
/* Location: ./application/libraries/response.php */