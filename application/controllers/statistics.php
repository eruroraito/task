<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Statistics extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Appmodel','m_app',true);
		$this->load->model('Usermodel','m_user',true);
		$this->load->model('Systemmodel','m_system',true);
		$this->load->model('Typemodel','m_type',true);
		$this->load->model('Questionmodel','m_question',true);
	}

	public function index()
	{
		$data = array();
		$user['user_id'] = $this->m_app->getCurrentUserId();
		$user['user_name'] = $this->m_app->getCurrentUserName();
		$user['user_realname'] = $this->m_app->getCurrentUserRealName();
		$user['users'] =$this->m_user->getUserNames();


		$data['exam'] = $this->m_system->getQuestionNumInExam();
		$data['date'] = $this->m_system->getQuestionNumInExamByDate();
		$data['audit_exam'] = $this->m_system->getQuestionDetailsInAuditExam();
		$data['origin_user_audit_exam'] = $this->m_system->getUserDetailsInExam($user);
		$data['details_in_all_exams'] = $this->m_system->getQuestionDetailsAllExams();
		$data['difficluty'] = $this->m_system->getQuestionDetailsByDifficulty();
		$data['question_type'] = $this->m_system->getQuestionDetailsByQuestionType();
		$data['question_type_and_type'] = $this->m_system->getQuestionDetailsByQuestionTypeAndType();
		$data['pic'] = $this->m_system->getPicQuestionDetails();
		
		//print_r($data['details_in_all_exams']);die();

		//$data['details'] = $this->m_user->getUserStatus($data['userid']);
		$this->load->view('statistics',$data);
	}

/*
| -------------------------------------------------------------------
|  Statistics Basic Functions
| -------------------------------------------------------------------
*/



}
/* End of file Statistics.php */
/* Location: ./application/controllers/statistics.php */



