<?php
/**
 * json
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * Required Version:
 * 	PHP5 or higher
 * 	WordPress 2.9 or higher
 *
 * If you find my work useful and you want to encourage the development of more free resources,
 * you can do it by donating...
 * 	paypal: yinheli@gmail.com
 * 	alipay: yinheli@gmail.com
 *
 * @author yinheli <yinheli@gmail.com>
 * @link http://philna.com/
 * @copyright Copyright (C) 2009 yinheli All rights reserved.
 * @license PhilNa2 is released under the GPL.
 * @version $Id$
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
