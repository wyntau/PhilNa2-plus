<?php
/**
 * js loader
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
 *
 */

if ( extension_loaded('zlib') && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ) {
	ob_start('ob_gzhandler');
} else {
	ob_start();
}
header("Cache-Control: max-age=3600, public");
header("Pragma: cache");
header( "Vary: Accept-Encoding" ); // Handle proxies
header('Content-Type: text/javascript; charset: UTF-8');

$head = <<<EOF
/*
Copyright (C) 2009 - 2010 yinheli All rights reserved.
Author: yinheli
Author URI: http://philna.com/
*/\n\n
EOF;

$jsFiles = array('jQuery', 'easing', 'scrollTo', 'philna2','SayMeMod','Myjs');

$jsDir = dirname(__FILE__) . '/js';

echo $head;

foreach ($jsFiles as $file) {
	$devfile = $jsDir.'/dev/'.$file.'.js';
	$minfile = $jsDir.'/'.$file.'.js';
	if (file_exists($minfile)) {
		include_once $minfile;
	} else if (file_exists($devfile)) {
		include_once $devfile;
	}
}
