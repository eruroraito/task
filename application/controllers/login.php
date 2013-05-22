<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Usermodel','m_user',true);
		$this->load->model('Appmodel','m_app',true);
	}

	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('login');
	}


/*
| -------------------------------------------------------------------
|  Login Basic Functions
| -------------------------------------------------------------------
*/
	function authenticate(){
		$info = $this->m_user->validateLoginInfo($this->input->post());
		if($this->response->isSuccess()){
			$user = $this->m_user->getUserByName($info['user_name']);
			$captcha = $this->session->userdata('captcha');

			if($captcha!=md5($info['captcha'].SALT)){
				$this->response->setSuccess(false);
				$this->response->setDetail($this->lang->line('error_captcha'));
			}elseif(empty($user)){
				$this->response->setSuccess(false);
				$this->response->setDetail($this->lang->line('error_status_username'));
			}elseif($user['user_status'] != STATUS_ACTIVE){
				$this->response->setSuccess(false);
				$this->response->setDetail($this->lang->line('error_user_status'));
			}elseif($user['user_password'] != md5($info['user_password'].SALT)){
				$this->response->setSuccess(false);
				$this->response->setDetail($this->lang->line('error_user_password'));
			}else{
				unset($user['user_password']);
				$this->session->set_userdata('user',$user);
				$this->m_user->setThisLogin($user);
				$this->response->setSuccess(true);
				$this->response->setDetail($this->lang->line('success_login'));
			}
		}

		echo $this->response->generate_json_response();
	}

	public function logout(){
		$user_name = $this->m_app->getCurrentUserName();
		$this->m_user->setLastLogin($user_name);
		$this->session->sess_destroy();
		$this->response->setSuccess(true);
		//echo $this->response->generate_json_response();

		redirect('login');
	}

	public function captcha(){
		@header("Content-Type:image/png"); 
		$str_key='';
	  	$char_base = array('3','4','6','7','8','9','a','b','c','d','e','f','h','k','m','n','r','t','u','v','w','x','y','A','C','E','F','G','H','K','M','N','Q','T','U','V','W','X','Y');
	  	for($num=1;$num<=5;$num++){
			$rand_num = rand(0,count($char_base)-1);
			$str_key .= $char_base[$rand_num]; 
		}
		$md5key = md5(strtolower($str_key).SALT);
		$this->session->set_userdata('captcha', $md5key);
		$width = 55;
		$height = 21;
		$im=imagecreate($width,$height); 
		$back=imagecolorallocate($im,0xFF,0xFF,0xFF); 
		$pix=imagecolorallocate($im,196,255,196); 
		$font=imagecolorallocate($im,91,170,15); 
		for($i=0;$i<1000;$i++) 	{ 
			imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pix);
		} 
		imagestring($im, 5, 7, 3,$str_key, $font); 
		imagerectangle($im,0,0,$width-1,$height-1,$font); 
		imagepng($im); 
		imagedestroy($im); 
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/login.php */