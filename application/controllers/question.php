<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Question extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Systemmodel','m_system',true);
		$this->load->model('Appmodel','m_app',true);
		$this->load->model('Questionmodel','m_question',true);
	}

	public function index()
	{
		$data['type'] = $this->m_question->getQuestionType();
		//print_r($data);die();
		$this->load->view('question',$data);
	}


/*
| -------------------------------------------------------------------
|  Question Basic Functions
| -------------------------------------------------------------------
*/
	public function addQuestion(){

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

		if ( ! $this->upload->do_upload('image'))
		{
			$error = array('error' => $this->upload->display_errors());
			$data_judeg_image = $this->input->post();
			if($data_judeg_image['question_type']==0||$data_judeg_image['question_type']==2)
			{
				$data = array();
				$info = $this->m_question->validateAddQuestionInfo($this->input->post(),$data);
				$info['user_name'] = $this->m_app->getCurrentUserName();
				if($this->response->isSuccess()){
					$this->m_question->addQuestion($info);
					$this->response->setSuccess(true);
					$this->response->setDetail($this->lang->line('success_update'));
					echo $this->response->generate_json_response();
				}
			}else{			
				$this->response->setSuccess(false);
				$this->response->setDetail($this->lang->line('error_update'));
			}
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$info = $this->m_question->validateAddQuestionInfo($this->input->post(),$data);
			$info['user_name'] = $this->m_app->getCurrentUserName();
			if($this->response->isSuccess()){
				$this->m_question->addQuestion($info);
				$this->response->setSuccess(true);
				$this->response->setDetail($this->lang->line('success_update'));
			}
			echo $this->response->generate_json_response();
		}		
	}
}

/* End of file Question.php */
/* Location: ./application/controllers/question.php */