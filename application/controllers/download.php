<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Download extends PC_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Systemmodel','m_system',true);
		$this->load->helper('download');
		$this->load->helper('form');

	}

	public function index()
	{
		$data['download_names'] = $this->m_system->getDownloadFileNames();

		$this->load->view('download',$data);
	}

/*
| -------------------------------------------------------------------
|  Download Basic Functions
| -------------------------------------------------------------------
*/
	public function do_upload()
	{
		$filename = $this->input->post();
		$config['upload_path'] = './uploads/help/';
		$config['allowed_types'] = 'xls';
		$config['file_name'] = iconv("UTF-8","gb2312",$filename['filename']);

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('upload'))
		{
			$error = array('error' => $this->upload->display_errors());

			if($error!=''){
				
				$this->response->setSuccess(false);
				$this->response->setDetail($this->lang->line('error_update'));
			}
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->response->setSuccess(true);
			$this->response->setDetail($this->lang->line('success_update'));
			$this->m_system->saveFiles($data);
		}

		echo $this->response->generate_json_response();
	}

}
/* End of file Download.php */
/* Location: ./application/controllers/download.php */



