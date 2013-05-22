<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class System_add extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Questionmodel','m_question',true);
		$this->load->model('Systemmodel','m_system',true);
	}

	public function index()
	{
		$user_id = $this->m_app->getCurrentUserId();
		$data['permission'] = $this->m_permission->getUserPermission($user_id);
		$data['type_list'] = $this->m_system->getTypeConfig();
		$data['num'] = $this->m_question->getQuestionNum();
		$data['status'] = $this->m_system->getTypeStatus();
		if($data['permission']['group_id']==1||$data['permission']['group_id']==2) $this->load->view('system_add',$data);
	}

/*
| -------------------------------------------------------------------
|  System_add Basic Functions
| -------------------------------------------------------------------
*/
	public function deleteType(){
		$info = $this->m_system->validateDeleteTypeInfo($this->input->post());
		if($this->response->isSuccess()){
			if($this->m_system->deleteType($info)){
				$this->response->setSuccess(true);
				$this->response->setDetail($this->lang->line('success_update'));
			}else{
				$this->response->setSuccess(false);
				$this->response->setDetail($this->lang->line('error_user_password'));
			}
		}
		echo $this->response->generate_json_response();
	}
	public function editType(){
		$info = $this->m_system->validateEditTypeInfo($this->input->post());
		if($this->response->isSuccess()){
			$this->m_system->editType($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
	public function changeStatus(){
		$info = $this->input->post();
		$this->m_system->changeStatus($info);
		$this->response->setSuccess(true);
		$this->response->setDetail($this->lang->line('success_update'));
		echo $this->response->generate_json_response();
	}
}
/* End of file System_add.php */
/* Location: ./application/controllers/system_add.php */



