<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Personal extends PC_controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('personal');
	}


/*
| -------------------------------------------------------------------
|  Personal Basic Functions
| -------------------------------------------------------------------
*/
	public function changeUserPassword(){
		$info = $this->m_user->validateChangePasswordInfo($this->input->post());
		if($this->response->isSuccess()){
			$info['user_id'] = $this->m_app->getCurrentUserId();
			$info['info']['user_password'] = md5($info['user_password'].SALT);
			$this->m_user->editUser($info);

			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

}

/* End of file Personal.php */
/* Location: ./application/controllers/personal.php */