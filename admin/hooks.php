<?php
/**
 * hooks
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

function philnaBoard(){
	echo '<span>', __('Go to <a href="themes.php?page=PhilNa2admin">Theme Options page</a>?',YHL), '</span>';
}
add_action('right_now_table_end', 'philnaBoard');

/*function philnaAdminFeed(){
	global $wp_version;
	if(version_compare($wp_version, '2.7','<=')){
		return;
	}
	$s = get_option('dashboard_widget_options');
	$s['dashboard_secondary']['link'] = 'http://philna.com';
	$s['dashboard_secondary']['url'] = 'http://feed.philna.com';
	$s['dashboard_secondary']['title'] = 'PhilNa';
	update_option('dashboard_widget_options',$s);
}*/
//add_action('savePhilNaOpt','philnaAdminFeed');

function philnaAdminFooterText($text){
	return $text.' | '.__('Thank you for using <strong><a href="http://philna.com">PhilNa</a></strong> theme.',YHL);
}
add_filter('admin_footer_text','philnaAdminFooterText');
