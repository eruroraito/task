<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getPagination')){
	function getPagination($input){
		$result = array();
        if(!isset($input['start']) || !validate($input['start'])){
            $result['start'] = LIST_DEFAULT_START;
		}else{
			$result['start'] = intval($input['start']);
		}

        if(!isset($input['limit']) || !validate($input['limit'])){
            $result['limit'] = LIST_DEFAULT_LIMIT;
		}else{
			$result['limit'] = intval($input['limit']);
		}
        
        return $result;
	}
}

if ( ! function_exists('getFilter')){
	function getFilter($input,$filterList){
		
		$filter = array();
		if(is_array($input) && is_array($filterList)){
			foreach($input as $key => $value){
				if(array_key_exists($key,$filterList) && $value != ''){
					$filter[$filterList[$key]] = $value;
				}
			}
		}

		return $filter;
	}
}

if ( ! function_exists('prepare_file_name')){
	function prepare_file_name(&$filename){
		$filename_replace = array('\\','/',':','*','?','"','\'','<','>','|');

		foreach($filename_replace as $token){
			$filename = str_replace($token,'_',$filename);
		}
	}
}

if ( ! function_exists('checkAccess')){
	function checkAccess($uri){
		if(defined('PERMISSION_DISABLE') && PERMISSION_DISABLE == true){
			return true;
		}
		if(!is_array($uri)) $uri = array($uri);

		$permissionArr = array();
		global $pms_action_list;
		if($pms_action_list !== false) $permissionArr = $pms_action_list;

		$permission = true;
		foreach($uri as $rec){
			$rec = strtolower($rec);
			$rec = str_replace('/','.',$rec);
			if(!in_array($rec,$permissionArr)){
				$permission = false;
				break;
			}
		}

		return $permission;
	}
}

if ( ! function_exists('defaultController')){
	function defaultController(){
		global $RTR;
		if(isset($RTR->routes['default_controller'])){
			$default_controller = $RTR->routes['default_controller'];
		}else{
			$default_controller = '';
		}
		
		return $default_controller;
	}
}