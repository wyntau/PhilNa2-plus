<?php
/**
 * if class exists 'tidy'
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
 * if class exists 'tidy' just do tidy HTML
 */
function philnaTidyHTML(){

	if(is_feed()) return;

	if(class_exists('tidy')){
		ob_start('philnaPHPTidyClass');
	}
}
add_action('template_redirect', 'philnaTidyHTML');

/**
 * tidy html output
 * @param unknown_type $html
 * @return unknown_type
 */
function philnaPHPTidyClass($html){
	$config = array(
		'indent'         => false,
		'output-xhtml'   => true,
		'wrap'           => 99999,
	);

	$tidy = new tidy();
	$tidy->parseString($html, $config, 'utf8');
	$tidy->cleanRepair();
	return $tidy;
}
