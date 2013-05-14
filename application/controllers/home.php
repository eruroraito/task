<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Home extends PC_controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$data['user_detail'] = $this->m_user->getUserStatus();
		$this->load->view('home',$data);
	}

/*
| -------------------------------------------------------------------
|  Home Basic Functions
| -------------------------------------------------------------------
*/
	public function auditPass(){
		$info['status'] = 2;
		$this->m_user->editUserHistory($info);
		$this->response->setSuccess(true);
		$this->response->setDetail($this->lang->line('success_update'));
		echo $this->response->generate_json_response();
	}

	public function notPass(){
		$info['status'] = 1;
		$this->m_user->editUserHistory($info);
		$this->response->setSuccess(true);
		$this->response->setDetail($this->lang->line('success_update'));
		echo $this->response->generate_json_response();
	}

	public function needAudit(){
		$info['status'] = 0;
		$this->m_user->editUserHistory($info);
		$this->response->setSuccess(true);
		$this->response->setDetail($this->lang->line('success_update'));
		echo $this->response->generate_json_response();
	}
}
/* End of file Home.php */
/* Location: ./application/controllers/home.php */



