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
	function getQuestionList(){
		
		$info = $this->m_question->validateGetQuestionListInfo($this->input->post());//print_r($this->input->post());die();
		if($this->response->isSuccess()){
			
			//$this->m_question->getQuestionListSection($info,$pagination);
			$this->m_question->editHistory($info);
			//print_r($list);die();
			//$this->response->setAddon($list);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	function editQuestion(){

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg';
		$pic_index = $this->m_system->getPicIndex();
		$pic_name = $pic_index.'.jpg';
		$config['file_name'] = $pic_name;

		//$config['overwrite'] = true;
		$config['max_width'] ='500';
		$config['max_height'] ='266';
		$config['max_size'] ='30';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('edit_image'))
		{
			$error = array('error' => $this->upload->display_errors());
			$data_judeg_image = $this->input->post();

			$data = array();
			$info = $this->m_question->validateEditQuestionInfo($this->input->post(),$data);
			$user_name = $this->m_app->getCurrentUserName();
			if($this->response->isSuccess()){
				$this->m_question->editQuestion($info,$user_name);
				$this->response->setSuccess(true);
				$this->response->setDetail($this->lang->line('success_update'));
				echo $this->response->generate_json_response();
			}
		}else{
			$data = array('upload_data' => $this->upload->data());
			$info = $this->m_question->validateEditQuestionInfo($this->input->post(),$data);
			$user_name = $this->m_app->getCurrentUserName();
			if($this->response->isSuccess()){
				$this->m_question->editQuestion($info,$user_name);
				$this->response->setSuccess(true);
				$this->response->setDetail($this->lang->line('success_update'));
			}
			echo $this->response->generate_json_response();
		}

	}

	function doAudit(){
		$info = $this->m_system->validateDoAuditInfo($this->input->post());
		$info['name_audit'] = $this->m_app->getCurrentUserName();
		if($this->response->isSuccess()){
			$this->m_system->doAudit($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();

	}

	function deleteQuestion(){
		$info = $this->m_question->validateDeleteQuestionInfo($this->input->post());
		$info['name_update'] = $this->m_app->getCurrentUserName();
		if($this->response->isSuccess()){
			$this->m_question->deleteQuestion($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
	
	function first_page(){
		$info = $this->m_user->validatePaginationFirst($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	function pre_page(){
		$info = $this->m_user->validatePaginationPre($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	function next_page(){
		$info = $this->m_user->validatePaginationNext($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}

	function last_page(){
		$info = $this->m_user->validatePaginationLast($this->input->post());
		if($this->response->isSuccess()){
			$this->m_user->editHistory($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}
	function redirect(){
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