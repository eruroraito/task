<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class System_off extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Questionmodel','m_question',true);
		$this->load->model('Systemmodel','m_system',true);
	}

	public function index()
	{
		$data['offindex'] = $this->m_user->getSystemOffHistory();
		$data['off'] = $this->m_question->getOffQuestionList($data['offindex']);
		$user_id = $this->m_app->getCurrentUserId();
		$data['permission'] = $this->m_permission->getUserPermission($user_id);
		if($data['permission']['group_id']==1||$data['permission']['group_id']==2) $this->load->view('system_off',$data);
	}

/*
| -------------------------------------------------------------------
|  System_off Basic Functions
| -------------------------------------------------------------------
*/
	public function offUseExam(){
		$info = $this->m_system->validateOffUseExamInfo($this->input->post());
		if($this->response->isSuccess()){
			$this->m_system->offQuestion($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function first_page(){
		$info = $this->m_user->validatePaginationFirst($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editOffHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function pre_page(){
		$info = $this->m_user->validatePaginationPre($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editOffHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function next_page(){
		$info = $this->m_user->validatePaginationNext($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editOffHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function last_page(){
		$info = $this->m_user->validatePaginationLast($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editOffHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
	public function redirect(){
		$info = $this->m_user->validatePaginationRedirect($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editSystemOffRedirect($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
}
/* End of file System_off.php */
/* Location: ./application/controllers/system_off.php */



