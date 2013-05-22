<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excelmodel extends CI_Model {

	protected $_CI;

	public static $searchField = array();
	public static $likeField = array();

	public function __construct(){
		parent::__construct();
		$this->_CI = & get_instance();
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		include APPPATH.'third_party/PHPExcel/PHPExcel/IOFactory.php';
		include APPPATH.'third_party/PHPExcel/PHPExcel/Writer/Excel5.php';
	}
/*
| -------------------------------------------------------------------
|  Excel Basic Functions
| -------------------------------------------------------------------
*/
	public function exportQuestionReport(){
		$day = strtotime(TODAY_NOW);
		$objPHPExcel = new PHPExcel();
		$this->_init($objPHPExcel);

		$objPHPExcel->setActiveSheetIndex(0);
		$activeSheet = $objPHPExcel->getActiveSheet();
		$activeSheet->setTitle('题目列表');
		$this->_addContentContributeMonthly($activeSheet,$day);
		$this->_finishReport($activeSheet);

		$this->_save($objPHPExcel,'使用题库'.str_replace('-','',$day));
	}
/*
| -------------------------------------------------------------------
|  Excel Logical Functions
| -------------------------------------------------------------------
*/
	protected function _addContentContributeMonthly(&$activeSheet,$day){
		$titleStyle = array(
			'fill' => array(
				'type'  => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '5FA841'),
			),
		);

		$activeSheet->getColumnDimension("D")->setWidth(100);
		$activeSheet->getColumnDimension("I")->setWidth(25);
		$activeSheet->getColumnDimension("J")->setWidth(25);
		$activeSheet->getColumnDimension("K")->setWidth(25);
		$activeSheet->getColumnDimension("L")->setWidth(25);
		$activeSheet->getColumnDimension("M")->setWidth(25);
		$activeSheet->getColumnDimension("N")->setWidth(25);
		$activeSheet->getColumnDimension("O")->setWidth(25);
		$activeSheet->getColumnDimension("P")->setWidth(25);
		$activeSheet->getColumnDimension("U")->setWidth(25);
		$activeSheet->getColumnDimension("Q")->setWidth(15);
		$activeSheet->getColumnDimension("R")->setWidth(15);
		$activeSheet->getColumnDimension("S")->setWidth(15);
		$activeSheet->getColumnDimension("T")->setWidth(50);
		$type_ids = $this->m_type->getActiveTypeIds();
		
		$this->db->from('question');
		$this->db->where('status',3);
		$this->db->where_in('type',$type_ids);
		$query = $this->db->get();
		$data = $query->result_array(); 

		$activeSheet->SetCellValue('A1','编号');
		$activeSheet->SetCellValue('B1','题型');
		$activeSheet->SetCellValue('C1','难度');
		$activeSheet->SetCellValue('D1','题目');
		$activeSheet->SetCellValue('E1','图片编号');
		$activeSheet->SetCellValue('F1','图片大小');
		$activeSheet->SetCellValue('G1','题目类型');
		$activeSheet->SetCellValue('H1','答案数');
		$activeSheet->SetCellValue('I1','答案1');
		$activeSheet->SetCellValue('J1','答案2');
		$activeSheet->SetCellValue('K1','答案3');
		$activeSheet->SetCellValue('L1','答案4');
		$activeSheet->SetCellValue('M1','答案5');
		$activeSheet->SetCellValue('N1','答案6');
		$activeSheet->SetCellValue('O1','答案7');
		$activeSheet->SetCellValue('P1','答案8');
		$activeSheet->SetCellValue('Q1','出题人');
		$activeSheet->SetCellValue('R1','最后修改人');
		$activeSheet->SetCellValue('S1','审核人');
		$activeSheet->SetCellValue('T1','意见');
		$activeSheet->SetCellValue('U1','最后更新时间');


		$row = 2;
		foreach($data as $record){
			$activeSheet->SetCellValue('A'.$row,$record['id']);
			$record['type'] = $this->m_type->getTypeName($record['type']);
			$activeSheet->SetCellValue('B'.$row,$record['type']);
			switch ($record['difficulty']) {
				case '1':
					$record['difficulty'] = '新手';
					break;
				case '2':
					$record['difficulty'] = '熟练';
					break;
				case '3':
					$record['difficulty'] = '高手';
					break;				
				default:
					$record['difficulty'] = '新手';
					break;
			}
			$activeSheet->SetCellValue('C'.$row,$record['difficulty']);
			$activeSheet->SetCellValue('D'.$row,$record['question']);
			$activeSheet->SetCellValue('E'.$row,$record['icon']);
			$record['pic_size'] = $record['pic_size'].'k';
			$activeSheet->SetCellValue('F'.$row,$record['pic_size']);
			$activeSheet->SetCellValue('G'.$row,$record['question_type']);
			switch ($record['question_type']) {
				case '0':
					$record['question_type'] = '文字题';
					break;
				case '1':
					$record['question_type'] = '图片题';
					break;
				case '2':
					$record['question_type'] = '填空题';
					break;
				case '3':
					$record['question_type'] = '触摸题';
					break;				
				default:
					$record['question_type'] = '文字题';
					break;
			}
			$activeSheet->SetCellValue('H'.$row,$record['answer_num']);
			$activeSheet->SetCellValue('I'.$row,$record['answer_1']);
			$activeSheet->SetCellValue('J'.$row,$record['answer_2']);
			$activeSheet->SetCellValue('K'.$row,$record['answer_3']);
			$activeSheet->SetCellValue('L'.$row,$record['answer_4']);
			$activeSheet->SetCellValue('M'.$row,$record['answer_5']);
			$activeSheet->SetCellValue('N'.$row,$record['answer_6']);
			$activeSheet->SetCellValue('O'.$row,$record['answer_7']);
			$activeSheet->SetCellValue('P'.$row,$record['answer_8']);
			$record['name_origin'] = $this->getUserRealNameByUserName($record['name_origin']);
			$activeSheet->SetCellValue('Q'.$row,$record['name_origin']);
			$record['name_update'] = $this->getUserRealNameByUserName($record['name_update']);
			$activeSheet->SetCellValue('R'.$row,$record['name_update']);
			$record['name_audit'] = $this->getUserRealNameByUserName($record['name_audit']);
			$activeSheet->SetCellValue('S'.$row,$record['name_audit']);
			$activeSheet->SetCellValue('T'.$row,$record['suggestion']);
			$activeSheet->SetCellValue('U'.$row,$record['time_update']);
			$row++;
		}

		$activeSheet->getStyle('A1:U1')->applyFromArray($titleStyle);
	}
/*
| -------------------------------------------------------------------
|  Excel Private Functions
| -------------------------------------------------------------------
*/
	protected function _init(&$objPHPExcel){
		$objPHPExcel->getProperties()->setCreator('MANAGER');
		$objPHPExcel->getProperties()->setLastModifiedBy('MANAGER');
		$objPHPExcel->getProperties()->setTitle('QUESTION_DETAILS');
		$objPHPExcel->getProperties()->setSubject('');
	}

	protected function _finishReport(&$activeSheet){
		$activeSheet->FreezePane('A2');
		$lastCol = $activeSheet->getHighestColumn();
		$lastRow = $activeSheet->getHighestRow();
		$activeSheet->getStyle('A1:'.$lastCol.$lastRow)->getAlignment()->setWrapText(true);
		$activeSheet->getStyle('A1:'.$lastCol.$lastRow)->applyFromArray(array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'font' => array(
				'size' => 9,
				'bold' => true,
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
				),
			),
		));
	}

	protected function _save(&$objPHPExcel,$title){
		$filename = $title.'.xls';
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control:must-revalidate, post-check=0, pre-check=0');
		header('Content-Type:application/force-download');
		header('Content-Type:application/vnd.ms-execl');
		header('Content-Type:application/octet-stream');
		header('Content-Type:application/download');
		header('Content-Disposition:attachment;filename='.$filename);
		header('Content-Transfer-Encoding:binary');
		$objWriter->save('php://output');
	}

	protected function getUserRealNameByUserName($user_name){
		$this->db->select('user_realname');
		$this->db->where('user_name',$user_name);
		$this->db->from('user');
		$query = $this->db->get();
		$res = $query->row_array();
		if($res!=array()) return $res['user_realname'];
		else return '';
	}
}