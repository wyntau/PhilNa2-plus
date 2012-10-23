<?php
/**
 * Some default hooks of philna2
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
 * Add a hint box when ajax paging
 *
 * @return unknown_type
 */
function philnaAjaxPagingiHint() {
	if(!defined('DOING_AJAX')) return;

	$refer = isset($_POST['lastQuery']) ? $_POST['lastQuery'] : '';
	if(!$refer) return;

	$refer = str_replace('---WENHAO---', '?', $refer);
	$refer = str_replace('---ANDHAO---', '&', $refer);
	$refer = str_replace('---DENGHAO---', '=', $refer);

	$ajaxWhat = is_search() ? __('You are doing Ajax searching, ', YHL) : __('You are doing Ajax Paging, ', YHL);

	echo
	'<div class="box message">',
	'<span class="right_arrow icon">',$ajaxWhat , '</span>',
	' <a href="',$refer ,'" title="', __('Back to last page', YHL), '">', __('Back to last page', YHL), '?</a>',
	'</div>';
}
add_action('philnaLoopStart', 'philnaAjaxPagingiHint');
