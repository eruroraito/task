<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('distanceFromCoordinate')){
	function distanceFromCoordinate($latitude1,$longitude1,$latitude2,$longitude2){

		$radLat1 = $latitude1 * PI / 180.0;
		$radLat2 = $latitude2 * PI / 180.0;
		$a = $radLat1 - $radLat2;
		$b = ($longitude1-$longitude2) * PI / 180.0;
		$s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));
		$s = $s * EARTH_RADIUS;
		$s = round($s * 10000) / 10000;

		return $s;
	}
}

if ( ! function_exists('coordinateBoundary')){
	function coordinateBoundary($latitude,$longitude,$raidus){
		$result = array();
		$degree = (24901*1609)/360.0;
		$dpmLat = 1/$degree;
		$radiusLat = $dpmLat*$raidus;
		$result['minLatitude'] = $latitude - $radiusLat;
		$result['maxLatitude'] = $latitude + $radiusLat;

		$mpdLng = $degree*cos($latitude*(PI/180));
		$dpmLng = 1/$mpdLng;
		$radiusLng = $dpmLng*$raidus;
		$result['minLongitude'] = $longitude - $radiusLng;
		$result['maxLongitude'] = $longitude + $radiusLng;

		return $result;
	}
}