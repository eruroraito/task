<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Question_edit extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Questionmodel','m_question',true);
		$this->load->model('Systemmodel','m_system',true);
	}

	public function index()
	{
		$post_info = $this->input->post();
		$data['edit'] = $this->m_question->getEditQuestion($post_info);
		$data['type'] = $this->m_question->getQuestionType();
		$this->load->view('question_edit',$data);
	}


/*
| -------------------------------------------------------------------
|  Question_edit Basic Functions
| -------------------------------------------------------------------
*/
	public function editQuestion(){

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

	public function deleteQuestion(){
		$info = $this->m_question->validateDeleteQuestionInfo($this->input->post());
		$info['name_update'] = $this->m_app->getCurrentUserName();
		if($this->response->isSuccess()){
			$this->m_question->deleteQuestion($info);
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
		}
		echo $this->response->generate_json_response();
	}


}

/* End of file Question_edit.php */
/* Location: ./application/controllers/question_edit.php */