<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Statistics_difficulty extends PC_controller {

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
		$data['difficluty'] = $this->m_system->getQuestionDetailsByDifficulty();
		if($data['permission']['group_id']==1||$data['permission']['group_id']==2) $this->load->view('statistics_difficulty',$data);
	}

/*
| -------------------------------------------------------------------
|  Statistics_difficulty Basic Functions
| -------------------------------------------------------------------
*/


}
/* End of file Statistics_difficulty.php */
/* Location: ./application/controllers/statistics_difficulty.php */



