<?php
/**
 *recentcomment functions
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
 * get recent comments
 * @param unknown_type $args
 * @return unknown_type
 */
function philnaRecentcomments($args='number=5&status=approve'){

	$cacheID = md5($args);

	if($output = wp_cache_get('recentComments_'.$cacheID, 'philna')){
		echo $output;
		return;
	}

	$rcms = get_comments($args);

	//print_r($rcms);return;
	if(empty($rcms)){
		_e('No Data Found',YHL);
		return;
	}
	//历遍数据
	$output = '';
	foreach( $rcms as $rcm ){
		// 如果访客昵称为空, 则将显示名字设为 "Anonymous"
		$author = $rcm->comment_author ? $rcm->comment_author : __('Anonymous', YHL);

		$content = philnaStriptags( $rcm->comment_content);

		$l_excerpt = philnaSubstr( $content, 200 );
		$l_excerpt = preg_replace('/["\']/', '', $l_excerpt);
		$s_excerpt = convert_smilies( philnaSubstr( $content, 20 ) );

		$comment_author_link = '<a href="'.get_comment_link($rcm).'" rel="external nofollow" title="'.$l_excerpt.'">'.$author.'</a>';

		if($rcm->comment_type == ''){
			$output .= '<li class="r_item"><div class="row">'.my_avatar($rcm->comment_author_email, 30).'<span class="r_name">'.$comment_author_link.'</span><span class="r_excerpt">'.$s_excerpt.'</span></div><div class="clear"></div></li>'."\n";
		}elseif($rcm->comment_type == 'pingback'){
			$output .= '<li class="r_item r_pingback"><span class="rc_label name">' . __('Pingback:') . '</span>'.$comment_author_link.'</li>';
		}elseif($rcm->comment_type == 'trackback'){
			$output .= '<li class="r_item r_traback"><span class="rc_label name">' . __('Trackback:') . '</span>'.$comment_author_link.'</li>';
		}
	}
	wp_cache_add('recentComments_'.$cacheID. $output, 'philna');
	echo $output;
}
