<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Home extends PC_controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$data['user_detail'] = $this->m_user->getUserStatus();
		$this->load->view('home',$data);
	}

/*
| -------------------------------------------------------------------
|  Home Basic Functions
| -------------------------------------------------------------------
*/



}
/* End of file Home.php */
/* Location: ./application/controllers/home.php */



