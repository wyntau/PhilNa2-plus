<?php
/**
 * json
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');


/**
 * encode json
 *
 * @param unknown_type $s
 * @return unknown_type
 */
function philnaJSON($s){
	if(function_exists('json_encode')){
		return json_encode($s);
	}else{
		// check the JSON class
		if(!class_exists('Services_JSON')) include_once ABSPATH . WPINC . '/class-json.php';
		$json = new Services_JSON();
		return $json->encode($s);
	}
}
