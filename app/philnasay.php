<?php
/**
 * philnasay functions
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
