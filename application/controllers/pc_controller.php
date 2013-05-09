<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PC_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('Appmodel','m_app',true);
		$this->load->model('Usermodel','m_user',true);
		$this->load->model('Permissionmodel','m_permission',true);

		if(!$this->m_app->checkUserLogin()){
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				redirect('login');
			}else{
				$this->response->setSuccess(false);
				$this->response->setDetail($this->lang->line('error_login_timeout'));
				$this->response->setAddon(array(
					'code' => RESPONSE_CODE_UNAUTHORIZED,
				));
				echo $this->response->generate_json_response();
				die();
			}
		}
	}
}

/* End of file pc_controller.php */
/* Location: ./application/controllers/pc_controller.php */