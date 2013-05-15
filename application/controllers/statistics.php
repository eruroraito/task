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
		$user_id = $this->m_app->getCurrentUserId();
		$data['permission'] = $this->m_permission->getUserPermission($user_id);
		$data['exam'] = $this->m_system->getQuestionNumInExam();
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



