<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('spreadArray')){
	function spreadArray($orig,$column){		
		$result = array();

		if(is_array($orig)){
			foreach($orig as $record){

				if(isset($record[$column])){
					$key = $record[$column];
				}else{
					$key = 0;
				}

				$result[$key][] = $record;
			}
		}

		return $result;
	}
}

if ( ! function_exists('extractColumn')){
	function extractColumn($list,$column){		
		$result = array();

		if(is_array($list)){
			foreach($list as $record){

				if(isset($record[$column])){
					$result[] = $record[$column];
				}
			}
		}
		$result = array_unique($result);

		return $result;
	}
}

if ( ! function_exists('reindexArray')){
	function reindexArray($orig,$column){		
		$result = array();

		if(is_array($orig)){
			foreach($orig as $record){

				if(isset($record[$column])){
					$key = $record[$column];
				}else{
					$key = 0;
				}

				$result[$key] = $record;
			}
		}

		return $result;
	}
}

if ( ! function_exists('sortArray')){
	function sortArray(&$arr,$column,$dir = SORT_ASC){//SORT_DESC
		$sortColumn = array();
		foreach ($arr as $key => $row) {
			$sortColumn[$key]  = $row[$column];
		}

		array_multisort($sortColumn,$dir,$arr);		
	}
}