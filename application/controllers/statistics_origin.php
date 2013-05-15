<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Statistics_origin extends PC_controller {

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
		$user['user_id'] = $this->m_app->getCurrentUserId();
		$user['user_name'] = $this->m_app->getCurrentUserName();
		$user['user_realname'] = $this->m_app->getCurrentUserRealName();
		$user['users'] =$this->m_user->getUserNames();
		$user_id = $this->m_app->getCurrentUserId();
		$data['permission'] = $this->m_permission->getUserPermission($user_id);
		$data['origin_user_audit_exam'] = $this->m_system->getUserDetailsInExam($user);
		if($data['permission']['group_id']==1||$data['permission']['group_id']==2) $this->load->view('statistics_origin',$data);
	}

/*
| -------------------------------------------------------------------
|  Statistics_origin Basic Functions
| -------------------------------------------------------------------
*/


}
/* End of file Statistics_origin.php */
/* Location: ./application/controllers/statistics_origin.php */



