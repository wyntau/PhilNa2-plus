<?php
/**
 * philnasay functions
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
 * philna say
 * @return unknown_type
 */
function philnaSay(){
	if($GLOBALS['philnaopt']['show_philna_say'] && $GLOBALS['philnaopt']['philna_say']){
		$words = explode("\n", $GLOBALS['philnaopt']['philna_say']);
		$word = $words[ mt_rand(0, count($words) - 1) ];

		echo defined('DOING_AJAX') ? $word: "\t\t\t".'<p id="philna_say" title="'.__('Click to get a new one (Random)',YHL).'">'.$word.'</p>'."\n";
	}
}
add_action('philnaBlogTitleAndDesc', 'philnaSay');
