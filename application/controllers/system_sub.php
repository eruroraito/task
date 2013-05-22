<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class System_sub extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Questionmodel','m_question',true);
		$this->load->model('Systemmodel','m_system',true);
		$this->load->model('Typemodel','m_type',true);
		$this->load->model('Excelmodel','m_excel',true);
	}

	public function index()
	{
		$data['subindex'] = $this->m_user->getSystemSubHistory();
		$data['submit'] = $this->m_question->getSubmitQuestionList($data['subindex']);
		$user_id = $this->m_app->getCurrentUserId();
		$data['permission'] = $this->m_permission->getUserPermission($user_id);
		//$this->m_excel->exportQuestionReport();
		if($data['permission']['group_id']==1||$data['permission']['group_id']==2) $this->load->view('system_sub',$data);
	}

/*
| -------------------------------------------------------------------
|  System_sub Basic Functions
| -------------------------------------------------------------------
*/
	public function export(){
		$this->m_excel->exportQuestionReport();
	}

	public function submitToUseExam(){
		$info = $this->m_system->validateSubmitToUseExamInfo($this->input->post());
		if($this->response->isSuccess()){
			$this->m_system->submitQuestion($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function first_page(){
		$info = $this->m_user->validatePaginationFirst($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editSubHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function pre_page(){
		$info = $this->m_user->validatePaginationPre($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editSubHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function next_page(){
		$info = $this->m_user->validatePaginationNext($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editSubHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function last_page(){
		$info = $this->m_user->validatePaginationLast($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editSubHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
	public function redirect(){
		$info = $this->m_user->validatePaginationRedirect($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editSystemSubRedirect($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
}
/* End of file System_sub.php */
/* Location: ./application/controllers/system_sub.php */



