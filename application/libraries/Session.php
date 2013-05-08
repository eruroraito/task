<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Session {

	public function __construct(){
		log_message('debug', "Session Class Initialized");
		session_start();
		log_message('debug', "Session routines successfully run");
	}

	function sess_destroy(){
		$_SESSION = array();
	}

	function userdata($key){
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}else{
			return false;
		}
	}

	function set_userdata($key = '', $value = ''){
		$_SESSION[$key] = $value;
	}

	function unset_userdata($key){
		unset( $_SESSION[$key] );
	}
}

/* End of file Session.php */
/* Location: ./application/libraries/Session.php */