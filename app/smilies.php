<?php
/**
 * smilies functions
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
 * Output smilies for comment form
 *
 * @return unknown_type
 */
function philnaCommentSmilies(){
	global $wpsmiliestrans;
	$path = get_bloginfo('template_directory').'/images/smilies/';
	$output = '';
	$smilies = array_unique($wpsmiliestrans);
	$startimg = '<a id="smiliebtn" href="javascript:void(0);"><img src="'.$path.'33.gif'.'" alt="" title="'.__('Add a smiley?', YHL).'"/></a>';
	foreach ($smilies as $title=>$smilies){
		$output .= '<a title=" '.$title.' " href="#" rel="nofollow"><img src="'.$path.$smilies.'" alt=""/></a>';
	}
	$output = '<div id="smiles" class="hide"><div id="smiles_list">'.$output.'<div class="clear"></div></div></div>'."\n";

	echo $startimg,$output;
}
