<?php
/**
 * before loop start
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

?>
<div class="loop_head box content">
<?php
if(is_search()){
	echo __('<strong>Search Results : </strong><br/>', YHL),"\n";
	global $s; printf( __('Keyword: &quot; %1$s &quot;', YHL), wp_specialchars($s, 1) );
}elseif(is_category()){
	printf( __('Archive for the &quot;%1$s&quot; Category', YHL), single_cat_title('', false) );
	if( $desc = category_description()){
		echo '<p class="desc">', __('Description: ',YHL), '</p>',"\n";
		echo $desc;
	}
}elseif(is_tag()){
	printf( __('Posts Tagged &quot;%1$s&quot;', YHL), single_tag_title('', false) );
	if( $desc = tag_description()){
		echo '<p class="desc">', __('Description: ',YHL), '</p>',"\n";
		echo $desc;
	}
}elseif(is_day()){
	printf( __('Archive for %1$s', YHL), get_the_time(__('F jS, Y', YHL)) );
}elseif (is_month()) {
	printf( __('Archive for %1$s ', YHL), get_the_time(__('F, Y', YHL)) );
}elseif(is_year()) {
	printf( __('Archive for %1$s', YHL), get_the_time(__('Y', YHL)) );
}elseif(is_author()) {
	_e('Author Archive', YHL);
}elseif(isset($_GET['paged']) && !empty($_GET['paged'])) {
	_e('Blog Archives', YHL);
}else{
	_e('Arhives page', YHL);
}
?>
</div>
