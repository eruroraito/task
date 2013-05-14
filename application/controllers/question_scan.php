<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Question_scan extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Usermodel','m_user',true);
		$this->load->model('Appmodel','m_app',true);
		$this->load->model('Questionmodel','m_question',true);
		$this->load->model('Systemmodel','m_system',true);
	}

	public function index()
	{
		$data['type'] = $this->m_question->getQuestionType();
		$data['userlist'] = $this->m_user->getUserList();
		$data['auditerlist'] = $this->m_user->getAuditerList();
		$data['permission'] = $this->m_app->getPermission();
		$data['current_user'] = $this->m_app->getCurrentUserRealName();
		$data['scan'] = $this->m_user->getHistoryScan();
		$this->load->view('question_scan',$data);
	}

/*
| -------------------------------------------------------------------
|  Personal Basic Functions
| -------------------------------------------------------------------
*/
	public function getQuestionList(){
		
		$info = $this->m_question->validateGetQuestionListInfo($this->input->post());
		if($this->response->isSuccess()){
			$this->m_question->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function doAudit(){
		$info = $this->m_system->validateDoAuditInfo($this->input->post());
		$info['name_audit'] = $this->m_app->getCurrentUserName();
		if($this->response->isSuccess()){
			$this->m_system->doAudit($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();

	}
	
	public function first_page(){
		$info = $this->m_user->validatePaginationFirst($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function pre_page(){
		$info = $this->m_user->validatePaginationPre($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function next_page(){
		$info = $this->m_user->validatePaginationNext($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	public function last_page(){
		$info = $this->m_user->validatePaginationLast($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
	public function redirect(){
		$info = $this->m_user->validatePaginationRedirect($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistoryRedirect($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
}

/* End of file Question_scan.php */
/* Location: ./application/controllers/question_scan.php */