<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questionmodel extends CI_Model {

	protected $_CI;

	public function __construct(){
		parent::__construct();
		$this->_CI = & get_instance();
	}

/*
| -------------------------------------------------------------------
|  User Basic Functions
| -------------------------------------------------------------------
*/
	public function getEditQuestion($info){
		$res = array();
		$db_name = 'question_'.$info['type'];
		$this->db->where('id',$info['id']);
		$this->db->from($db_name);
		$query = $this->db->get();
		$res = $query->row_array();
		//print_r($res);die();
		return $res;
	}

	public function editHistory($info){
		//print_r($info);die();
		$info['pagination'] = 1;
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->where('user_name',$user_name);
		$this->db->update('history',$info);
	}

	public function deleteQuestion($info){//print_r($info);die();
		$db_name = 'question_'.$info['type'];
		$this->db->where('id',$info['id']);
		$this->db->set('status','-1');
		$this->db->set('name_update',$info['name_update']);
		$this->db->update($db_name);
	}

	public function getQuestionType(){
		$res = array();
		$this->db->select('type_name');
		$this->db->from('type_config');
		$query = $this->db->get();
		$res = $query->result_array();

		return $res;
	}

	public function addQuestion($info){
		$question_table_name = 'question_'.$info['type'];
		//print_r($info);die();
		$this->db->insert($question_table_name, $info['info']); 

		$this->db->select_max('id');
		$this->db->from($question_table_name);
		$query = $this->db->get();
		$num = $query->row_array();

		$this->db->where('id', $num['id']);
		$info['update']['name_origin'] = $info['user_name'];
		$info['update']['name_update'] = $info['user_name'];
		$info['update']['time_update'] = NOW;
		$this->db->update($question_table_name,$info['update']);


		$this->db->insert('total', $info['info']); 
		$this->db->select_max('total_id');
		$this->db->from('total');
		$query = $this->db->get();
		$t_num = $query->row_array();

		$this->db->where('total_id', $t_num['total_id']);
		$info['update']['name_origin'] = $info['user_name'];
		$info['update']['name_update'] = $info['user_name'];
		$info['update']['time_update'] = NOW;
		$info['update']['type'] = $info['type'];
		$info['update']['id'] = $num['id'];
		$this->db->update('total',$info['update']);

		if($info['update']['icon']>=10000){
			$this->db->where('global_id',1);
			$new_global_pic_index = $info['update']['icon']+1;
			$this->db->set('global_pic_index',$new_global_pic_index);
			$this->db->update('global');
		}
	}

	public function editQuestion($info,$user_name){
		$question_table_name = 'question_'.$info['type'];
		//print_r($info);die();
		$this->db->where('id', $info['id']);
		$info['name_update'] = $user_name;
		$info['time_update'] = NOW;
		$this->db->update($question_table_name,$info);

		if($info['icon']>=100){
			$this->db->where('global_id',1);
			$new_global_pic_index = $info['icon']+1;
			$this->db->set('global_pic_index',$new_global_pic_index);
			$this->db->update('global');
		}
	}


	public function getQuestionListSection($info,$pagination){
		$res = array();
		$pagination_start = SCAN_PERPAGE*($pagination-1);
		if($info['type']!=SEARCH_ALL){
			$this->db->start_cache();
			$db_name = 'question_'.$info['type'];
			$this->db->select('id,question,time_update,status,name_origin,name_audit,question_type,answer_num,answer_1,answer_2,answer_3,answer_4,answer_5,answer_6,answer_7,answer_8,difficulty,type,name_update,icon');			
			$this->db->from($db_name);
			if($info['question_type']!=SEARCH_ALL)      $this->db->where('question_type',$info['question_type']);
			if($info['user']!=SEARCH_SUPER_ALL) 		$this->db->where('name_origin',$info['user']);
			if($info['auditer']!=SEARCH_SUPER_ALL) 		$this->db->where('name_audit',$info['auditer']);
			if($info['status']!=SEARCH_ALL) 			$this->db->where('status',$info['status']);
			else $this->db->where_in('status',array(0,1,2,3,-1));
			if($info['difficult']!=SEARCH_ALL) 			$this->db->where('difficulty',$info['difficult']);
			if($info['date_start']!='0000-00-00 00:00:00')					$this->db->where('time_update >=',$info['date_start']);
			if($info['date_end']!='0000-00-00 00:00:00')					$this->db->where('time_update <=',$info['date_end']);

			if($info['search']!=''){
				if($info['condition']==2){
					$this->db->where('icon',intval($info['search']));
				}elseif($info['condition']==3){
					$this->db->where('id',intval($info['search']));
				}else{
					$this->db->like('question',strval($info['search']));
				}
			}
			$item_sort = 'time_update';
			$order_sort = 'asc';
			if($info['order_item']==SEARCH_QUESTION_ID) $item_sort = 'id';
			if($info['order']==SEARCH_DESC) $order_sort = 'desc';
			$this->db->order_by($item_sort,$order_sort);
			$this->db->stop_cache();
			$count = $this->db->count_all_results();	
			//print_r($count);die();
			$this->db->limit(SCAN_PERPAGE,$pagination_start);
			$query = $this->db->get();
			$this->db->flush_cache(); 
			$res['list'] = $query->result_array();
		}else{
				//$result[$i] = array();
				//$db_name = 'question_'.$i;
				$this->db->start_cache();
				$this->db->select('id,question,time_update,status,name_origin,name_audit,question_type,answer_num,answer_1,answer_2,answer_3,answer_4,answer_5,answer_6,answer_7,answer_8,difficulty,type,name_update,icon');			
				$this->db->from('total');
				if($info['question_type']!=SEARCH_ALL)    $this->db->where('question_type',$info['question_type']);
				if($info['user']!=SEARCH_SUPER_ALL) 	  $this->db->where('name_origin',$info['user']);
				if($info['auditer']!=SEARCH_SUPER_ALL) 	  $this->db->where('name_audit',$info['auditer']);
				if($info['status']!=SEARCH_ALL) 		  $this->db->where('status',$info['status']);
				else $this->db->where_in('status',array(0,1,2,3,-1));
				if($info['difficult']!=SEARCH_ALL) 		  $this->db->where('difficulty',$info['difficult']);
				//print_r($info);die();
				if($info['date_start']!='0000-00-00 00:00:00')					$this->db->where('time_update >=',$info['date_start']);
				if($info['date_end']!='0000-00-00 00:00:00')					$this->db->where('time_update <=',$info['date_end']);

				if($info['search']!=''){
					if($info['condition']==2){
						$this->db->where('icon',intval($info['search']));
					}elseif($info['condition']==3){
						$this->db->where('id',intval($info['search']));
					}else{
						$this->db->like('question',strval($info['search']));
					}
				}
				//print_r($info);die();

				$item_sort = 'time_update';
				$order_sort = 'asc';
				if($info['order_item']==SEARCH_QUESTION_ID) $item_sort = 'id';
				if($info['order']==SEARCH_DESC) $order_sort = 'desc';
				$this->db->order_by($item_sort,$order_sort);
				$this->db->stop_cache();
				$count = $this->db->count_all_results();
				$this->db->limit(SCAN_PERPAGE,$pagination_start);	
				$query = $this->db->get();
				$this->db->flush_cache();
				//$result[$i] = $query->result_array();
				//$res = array_merge($res,$result[$i]);
				$res['list'] = $query->result_array();
		}
		
		foreach ($res['list'] as $key => $value) {
			if($res['list'][$key]['name_audit']=='')  $date['name_audit']['user_realname'] = '';
			else $date['name_audit'] =  $this->getRealNameByAuditName($res['list'][$key]['name_audit']);

			$res['list'][$key]['name_audit']  = $date['name_audit']['user_realname'];
			$date['name_origin'] =  $this->getRealNameByAuditName($res['list'][$key]['name_origin']);
			$res['list'][$key]['name_origin']  = $date['name_origin']['user_realname'];
			//$date['type'] =  $this->getTypeId($res['list'][$key]['type']);
			//$res['list'][$key]['type']  = $date['type'];	
	
			$date['name_update'] = $this->m_user->getUserRealNameByUserName($res['list'][$key]['name_update']);
			$res['list'][$key]['name_update'] = $date['name_update'];
		}
		//print_r($res);die();
		$res['count'] = $count/SCAN_PERPAGE;
		$temp = intval($count/SCAN_PERPAGE);
		if($res['count']>$temp) $temp = $temp+1;
		if($temp==0) $temp =1;
		$res['count'] = $temp;
		$this->db->set('total_pagination',$res['count']);
		$user_name = $this->m_app->getCurrentUserName();
		$this->db->where('user_name',$user_name);
		$this->db->update('history');
		$res['pagination'] = $pagination;
		return $res;
	}

	public function getSubmitQuestionList(){
		$res = array();
		for($i=1;$i<=20;$i++){
			$result[$i] = array();
			$db_name = 'question_'.$i;
			$this->db->from($db_name);
			$this->db->where('status',2);
			$query = $this->db->get();
			$result[$i] = $query->result_array();
			$type_name = $this->getTypeNameByTypeId($i);

			foreach ($result[$i] as $key => $value) {
				$result[$i][$key]['type_name'] = $type_name['type_name'];
				$real_name = $this->getRealNameByAuditName($value['name_audit']);
				$result[$i][$key]['name_audit'] = $real_name['user_realname'];
				$result[$i][$key]['status'] = "已审核";
				switch ($value['difficulty']) {
					case '1':
						$result[$i][$key]['difficulty'] = "新手";
						break;
					case '2':
						$result[$i][$key]['difficulty'] = "熟练";
						break;
					case '1':
						$result[$i][$key]['difficulty'] = "高手";
						break;					
					default:
						$result[$i][$key]['difficulty'] = "新手";
						break;
				}
				switch ($value['question_type']) {
					case '0':
						$result[$i][$key]['question_type'] = "文字题";
						break;
					case '1':
						$result[$i][$key]['question_type'] = "图片题";
						break;
					case '2':
						$result[$i][$key]['question_type'] = "填空题";
						break;	
					case '2':
						$result[$i][$key]['question_type'] = "触摸题";
						break;					
					default:
						$result[$i][$key]['question_type'] = "文字题";
						break;
				}	
				
			}
			$res = array_merge($res,$result[$i]);
		}
		//print_r($res);die();

		return $res;
	}

	public function getOffQuestionList(){
		$res = array();
		for($i=1;$i<=20;$i++){
			$result[$i] = array();
			$db_name = 'question_'.$i;
			$this->db->from($db_name);
			$this->db->where('status',3);
			$query = $this->db->get();
			$result[$i] = $query->result_array();
			$type_name = $this->getTypeNameByTypeId($i);

			foreach ($result[$i] as $key => $value) {
				$result[$i][$key]['type_name'] = $type_name['type_name'];
				//$real_name = $this->getRealNameByAuditName($value['name_submit']);
				//$result[$i][$key]['name_submit'] = $real_name['user_realname'];
				switch ($value['difficulty']) {
					case '1':
						$result[$i][$key]['difficulty'] = "新手";
						break;
					case '2':
						$result[$i][$key]['difficulty'] = "熟练";
						break;
					case '1':
						$result[$i][$key]['difficulty'] = "高手";
						break;					
					default:
						$result[$i][$key]['difficulty'] = "新手";
						break;
				}
				switch ($value['question_type']) {
					case '0':
						$result[$i][$key]['question_type'] = "文字题";
						break;
					case '1':
						$result[$i][$key]['question_type'] = "图片题";
						break;
					case '2':
						$result[$i][$key]['question_type'] = "填空题";
						break;	
					case '2':
						$result[$i][$key]['question_type'] = "触摸题";
						break;					
					default:
						$result[$i][$key]['question_type'] = "文字题";
						break;
				}	
				
			}
			$res = array_merge($res,$result[$i]);
		}
		//print_r($res);die();

		return $res;
	}
	
/*
| -------------------------------------------------------------------
|  User Validate Functions
| -------------------------------------------------------------------
*/
	public function validateAddQuestionInfo($input,$data){
		$result = array();
		//print_r($data);die();
		if(!isset($input['question_type']) || !validate($input['question_type'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}else{
			$result['update']['question_type'] = intval($input['question_type']);

			if($result['update']['question_type']==1||$result['update']['question_type']==3){
				if(!isset($data['upload_data']['raw_name']) || !validate($data['upload_data']['raw_name'])){
					$this->_CI->response->setSuccess(false);
					$this->_CI->response->setDetail($this->lang->line('error_username'));
				}else{
					$result['update']['icon'] = intval($data['upload_data']['raw_name']);
				}
			}elseif($result['update']['question_type']==2){
				if(isset($data['upload_data']['raw_name'])) $result['update']['icon'] = intval($data['upload_data']['raw_name']);
				else $result['update']['icon'] = 0;
			}else{
				$result['update']['icon'] = 0;
			}

		}

		if($result['update']['question_type']==2){
			if(!isset($input['fill_option_one']) || !validate($input['fill_option_one'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['fill_option_two']) || !validate($input['fill_option_two'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['fill_option_three']) || !validate($input['fill_option_three'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['fill_option_four']) || !validate($input['fill_option_four'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['fill_option_five']) || !validate($input['fill_option_five'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['fill_option_six']) || !validate($input['fill_option_six'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['fill_option_seven']) || !validate($input['fill_option_seven'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['fill_option_eight']) || !validate($input['fill_option_eight'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['true_num']) || !validate($input['true_num'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}else{
				$result['info']['answer_1'] = strval($input['fill_option_one']);
				$result['info']['answer_2'] = strval($input['fill_option_two']);
				$result['info']['answer_3'] = strval($input['fill_option_three']);
				$result['info']['answer_4'] = strval($input['fill_option_four']);
				$result['info']['answer_5'] = strval($input['fill_option_five']);
				$result['info']['answer_6'] = strval($input['fill_option_six']);
				$result['info']['answer_7'] = strval($input['fill_option_seven']);
				$result['info']['answer_8'] = strval($input['fill_option_eight']);
				$result['update']['answer_num'] = strval($input['true_num']);
			}
		}else{
			if(!isset($input['option_one']) || !validate($input['option_one'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['option_two']) || !validate($input['option_two'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['option_three']) || !validate($input['option_three'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}elseif(!isset($input['option_four']) || !validate($input['option_four'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_username'));
			}else{
				$result['info']['answer_1'] = strval($input['option_one']);
				$result['info']['answer_2'] = strval($input['option_two']);
				$result['info']['answer_3'] = strval($input['option_three']);
				$result['info']['answer_4'] = strval($input['option_four']);
			}
		}

		if(!isset($input['question_name']) || !validate($input['question_name'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}elseif(!isset($input['question_difficulty']) || !validate($input['question_difficulty'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}elseif(!isset($input['type']) || !validate($input['type'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_username'));
		}else{
			$result['info']['question'] = strval($input['question_name']);
			$result['update']['difficulty'] = intval($input['question_difficulty']);
			$result['type'] = intval($input['type']);
		}
		//print_r($result);die();
		return $result;
	}

	public function validateGetQuestionListInfo($input){
		$result = array();
		
		if(!isset($input['type']) || !validate($input['type'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['question_type']) || !validate($input['question_type'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['user']) || !validate($input['user'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['auditer']) || !validate($input['auditer'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['status']) || !validate($input['status'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['difficult']) || !validate($input['difficult'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['search']) || !validate($input['condition'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['order_item']) || !validate($input['order_item'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['order']) || !validate($input['order'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}else{
			$result['type']          = intval($input['type']);
			$result['question_type'] = intval($input['question_type']);
			$result['user']          = strval($input['user']);
			$result['auditer']       = strval($input['auditer']);
			$result['status']        = intval($input['status']);
			$result['difficult']     = intval($input['difficult']);
			$result['search']        = strval($input['search']);
			$result['condition']     = intval($input['condition']);
			$result['order_item']    = intval($input['order_item']);
			$result['order']         = intval($input['order']);
			$result['date_start']    = strval($input['date_start']);
			$result['date_end']      = strval($input['date_end']);
		}

		return $result;

	}


	public function validateEditQuestionInfo($input,$data){
		$result = array();

		if(!isset($input['question_type']) || !validate($input['question_type'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}else{
			if(isset($data['upload_data']['raw_name'])) $result['icon']=intval($data['upload_data']['raw_name']);
		}

		if($input['question_type']==2){
			if(!isset($input['fill_option_one']) || !validate($input['fill_option_one'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['fill_option_two']) || !validate($input['fill_option_two'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['fill_option_three']) || !validate($input['fill_option_three'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['fill_option_four']) || !validate($input['fill_option_four'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['fill_option_five']) || !validate($input['fill_option_five'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['fill_option_six']) || !validate($input['fill_option_six'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['fill_option_seven']) || !validate($input['fill_option_seven'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['fill_option_eight']) || !validate($input['fill_option_eight'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['true_num']) || !validate($input['true_num'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}else{
				$result['answer_1']   = strval($input['fill_option_one']);
				$result['answer_2']   = strval($input['fill_option_two']);
				$result['answer_3']   = strval($input['fill_option_three']);
				$result['answer_4']   = strval($input['fill_option_four']);
				$result['answer_5']   = strval($input['fill_option_five']);
				$result['answer_6']   = strval($input['fill_option_six']);
				$result['answer_7']   = strval($input['fill_option_seven']);
				$result['answer_8']   = strval($input['fill_option_eight']);
				$result['answer_num'] = strval($input['true_num']);
			}
		}else{
			if(!isset($input['option_one']) || !validate($input['option_one'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['option_two']) || !validate($input['option_two'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['option_three']) || !validate($input['option_three'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}elseif(!isset($input['option_four']) || !validate($input['option_four'])){
				$this->_CI->response->setSuccess(false);
				$this->_CI->response->setDetail($this->lang->line('error_parameter'));
			}else{
				$result['answer_1'] = strval($input['option_one']);
				$result['answer_2'] = strval($input['option_two']);
				$result['answer_3'] = strval($input['option_three']);
				$result['answer_4'] = strval($input['option_four']);
			}
		}

		if(!isset($input['question_id']) || !validate($input['question_id'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['question_name']) || !validate($input['question_name'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['question_difficulty']) || !validate($input['question_difficulty'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}elseif(!isset($input['type']) || !validate($input['type'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_parameter'));
		}else{
			$result['id'] 		   = intval($input['question_id']);
			$result['type']        = intval($input['type']);			
			$result['difficulty']  = intval($input['question_difficulty']);
			$result['question']    = strval($input['question_name']);
		}

		//print_r($result);die();

		return $result;

	}

	public function validateDeleteQuestionInfo($input){
		$result = array();

		if(!isset($input['type']) || !validate($input['type'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}elseif(!isset($input['id']) || !validate($input['id'])){
			$this->_CI->response->setSuccess(false);
			$this->_CI->response->setDetail($this->lang->line('error_change_password'));
		}else{
			$result['type'] = strval($input['type']);	
			//$result['type'] = $this->getTypeIdByTypeName($result['type']);
			$result['id'] = intval($input['id']);		
		}
		//print_r($result);die();
		return $result;
	}
	


/*
| -------------------------------------------------------------------
|  Question Extern Functions
| -------------------------------------------------------------------
*/
	public function getTypeNameByTypeId($type_ids){
		$res = array();
		$this->db->select('type_name');
		$this->db->where_in('type_id',$type_ids);
		$this->db->from('type_config');
		$query = $this->db->get();
		$res = $query->row_array();
		return $res;
	}

	public function getRealNameByAuditName($user_names){
		$res = array();
		$this->db->select('user_realname');
		$this->db->where_in('user_name',$user_names);
		$this->db->from('user');
		$query = $this->db->get();
		$res = $query->row_array();
		return $res;
	}

	public function getTypeId($type_id){
		$res = array();
		$this->db->select('type_name');
		$this->db->where('type_id',$type_id);
		$this->db->from('type_config');
		$query = $this->db->get();
		$res = $query->row_array();

		return $res['type_name'];
	}

	public function getTypeIdByTypeName($type_name){
		$res = array();
		$this->db->select('type_id');
		$this->db->where('type_name',$type_name);
		$this->db->from('type_config');
		$query = $this->db->get();
		$res = $query->row_array();

		return $res['type_id'];
	}

}