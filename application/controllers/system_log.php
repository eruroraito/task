<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class System_log extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Questionmodel','m_question',true);
		$this->load->model('Systemmodel','m_system',true);
	}

	public function index()
	{
		$user_id = $this->m_app->getCurrentUserId();
		$data['permission'] = $this->m_permission->getUserPermission($user_id);
		$data['log'] = $this->m_system->getSubmitLog();
		$this->load->view('system_log',$data);
	}

/*
| -------------------------------------------------------------------
|  System_log Basic Functions
| -------------------------------------------------------------------
*/

}
/* End of file System_log.php */
/* Location: ./application/controllers/system_log.php */



