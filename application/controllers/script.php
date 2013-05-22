<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once './application/controllers/pc_controller.php';

class Script extends PC_controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);die();
		$this->load->model('Homemodel','m_home',true);
		$this->load->model('Permissionmodel','m_permission',true);
		$this->load->model('Questionmodel','m_question',true);
		$this->load->model('Systemmodel','m_system',true);
		$this->load->model('Typemodel','m_type',true);
	}

	public function index(){

	}

	public function importOriginData(){
		@ini_set('memory_limit', '640M');
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		include APPPATH.'third_party/PHPExcel/PHPExcel/IOFactory.php';
		include APPPATH.'third_party/PHPExcel/PHPExcel/Writer/Excel5.php';
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel = $objReader->load('information/config.xls');

		$sheet = $objPHPExcel->getSheet(22);
		$type = 3000;

		$status = 5;
		$name_origin ="admin";
		$name_update ="admin";
		$name_audit ="admin";

		$rowCount = $sheet->getHighestRow();

		$update_info = array();
		for($i=2;$i<=207;$i++){
			$id = $sheet->getCell('A'.$i)->getValue();
			
			$difficulty = $sheet->getCell('B'.$i)->getValue();
			$purpose = $sheet->getCell('C'.$i)->getValue();
			$question = $sheet->getCell('D'.$i)->getValue();
			$icon = $sheet->getCell('E'.$i)->getValue();
			$question_type = $sheet->getCell('F'.$i)->getValue();
			$answer_num = $sheet->getCell('G'.$i)->getValue();
			$answer_1 = $sheet->getCell('H'.$i)->getValue();
			$answer_2 = $sheet->getCell('I'.$i)->getValue();
			$answer_3 = $sheet->getCell('J'.$i)->getValue();
			$answer_4 = $sheet->getCell('K'.$i)->getValue();
			$answer_5 = $sheet->getCell('L'.$i)->getValue();
			$answer_6 = $sheet->getCell('M'.$i)->getValue();
			$answer_7 = $sheet->getCell('N'.$i)->getValue();
			$answer_8 = $sheet->getCell('O'.$i)->getValue();

			$time_update = NOW;
			$id = intval($id);
			$difficulty = intval($difficulty);
			$purpose = intval($purpose);
			$question = trim($question);
			$icon = intval($icon);
			$question_type = intval($question_type);
			$answer_num = intval($answer_num);
			$answer_1 = trim($answer_1);
			$answer_2 = trim($answer_2);
			$answer_3 = trim($answer_3);
			$answer_4 = trim($answer_4);
			if($answer_5!='') $answer_5 = trim($answer_5);
			else $answer_5 = "";
			if($answer_6!='') $answer_6 = trim($answer_6);
			else $answer_6 = "";
			if($answer_7!='') $answer_7 = trim($answer_7);
			else $answer_7 = "";
			if($answer_8!='') $answer_8 = trim($answer_8);
			else $answer_8 = "";

			$info['insert'] = array(
				//'type' => 1,
				//'difficulty' => $difficulty,
				//'purpose' => $purpose,
				'question' => $question,
				//'icon' => $icon,
				//'question_type' => $question_type,
				//'answer_num' => $answer_num,
				'answer_1' => $answer_1,
				'answer_2' => $answer_2,
				'answer_3' => $answer_3,
				'answer_4' => $answer_4,
				'answer_5' => $answer_5,
				'answer_6' => $answer_6,
				'answer_7' => $answer_7,
				'answer_8' => $answer_8,
				'name_origin' => $name_origin,
				'name_update' => $name_update,
				'name_audit' => $name_audit,
				'time_update' => $time_update,
			);

			$info['update'] = array(
				'type' => $type,
				'status' => $status,
				'difficulty' => $difficulty,
				'purpose' => $purpose,
				//'question' => $question,
				'icon' => $icon,
				'question_type' => $question_type,
				'pic_size' => 15,
				//'id'=>$id,
				//'answer_num' => $answer_num,
				//'answer_1' => $answer_1,
				//'answer_2' => $answer_2,
				//'answer_3' => $answer_3,
				//'answer_4' => $answer_4,
				//'answer_5' => $answer_5,
				//'answer_6' => $answer_6,
				//'answer_7' => $answer_7,
				//'answer_8' => $answer_8,
			);

			$this->db->insert('question',$info['insert']);
			$this->db->select_max('id');
			$this->db->from('question');
			$query = $this->db->get();
			$num = $query->row_array();			

			$this->db->where('id',$num['id']);
			$this->db->update('question',$info['update']);

		}
	}

}
/* End of file script.php */
/* Location: ./application/controllers/script.php */