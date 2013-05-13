<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class System_user extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Questionmodel','m_question',true);
		$this->load->model('Systemmodel','m_system',true);
	}

	public function index()
	{
		$user_id = $this->m_app->getCurrentUserId();
		$data['permission'] = $this->m_permission->getUserPermission($user_id);
		$this->load->view('system_user',$data);
	}

/*
| -------------------------------------------------------------------
|  System_user Basic Functions
| -------------------------------------------------------------------
*/
	public function addUser(){
		$info = $this->m_user->validateAddUserInfo($this->input->post());
		if($this->response->isSuccess()){
			$info['user_password'] = md5($info['user_password'].SALT);
			$info['user_status'] = STATUS_ACTIVE;
			$this->m_user->addUser($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

}
/* End of file System_user.php */
/* Location: ./application/controllers/system_user.php */



