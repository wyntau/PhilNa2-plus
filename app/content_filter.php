<?php
/**
 * content filter functions
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
 * hook on feed content
 * you can add copyright... and so on
 * @param unknown_type $content
 * @return unknown_type
 */
function philnacopyright($content){
	if(is_feed()||is_single()){
		if($GLOBALS['philnaopt']['rss_additional_show'] && $GLOBALS['philnaopt']['rss_additional']){
		$after= '<div class="copyright_info fontsize12">' . $GLOBALS['philnaopt']['rss_additional'] . '</div>';
		$blog_link = get_bloginfo('home');
		$feed_url = get_bloginfo('rss2_url');
		$post_url = get_permalink();
		$post_title = get_the_title();
		$after = str_replace('%BLOG_LINK%', $blog_link, $after);
		$after = str_replace('%FEED_URL%', $feed_url, $after);
		$after = str_replace('%POST_URL%', $post_url, $after);
		$after = str_replace('%POST_TITLE%', $post_title, $after);
		}
	}
	return $content.$after;
}
add_filter('the_content', 'philnacopyright', 0);
