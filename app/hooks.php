<?php
/**
 * Some default hooks of philna2
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
