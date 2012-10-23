<?php
/**
 * header background image
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
 * head background image
 * @param unknown_type $format
 * @return unknown_type
 */
function philnaHeadImage($format = ''){
	// the option form db
	$opt = $GLOBALS['philnaopt']['headimg'];
	$opt = $opt ? $opt : 'default.jpg';

	if($format !== 'option' && $opt !== 'random'){
		return $opt;
	}

	$imagesDir = TEMPLATEPATH.'/images/headers';

	// get all images
	$allImages = scandir($imagesDir);
	foreach($allImages as $key=>$name){
		if(!preg_match('/[\.]gif$|png$|jpg$|jpeg$/i', $name)){
			unset($allImages[$key]);
		}
	}
	unset($key, $name);

	if(empty($allImages)){
		return;
	}

	sort($allImages);

	// for css random
	if($opt == 'random' && $format !== 'option'){
		return count($allImages)>1 ? $allImages[ mt_rand(0, count($allImages) - 1) ] : 'default.jpg';
	}

	// for admin select
	$out = '';

	foreach($allImages as $file){
		$selected = $file == $opt ? ' selected="selected"' : '';
		$out .= '<option value="'.$file.'"'.$selected.'>'.$file.'</option>';
	}

	// add a random select
	$selected = $opt == 'random' ? ' selected="selected"' : '';
	$out .='<option value="random"'.$selected.'>'.__('random', YHL).'</option>';
	unset($allImages, $file, $selected);
	return $out;
}

/**
 * add css style for #header
 * @return unknown_type
 */
function philnaHeaderBackgroudImage(){
	$img = get_bloginfo('template_directory') . '/images/headers/' . philnaHeadImage();
        if(!$GLOBALS['philnaopt']['no_home_slide'])
        $homeslide=trim($GLOBALS['philnaopt']['homeslide']) ? '#content .post_content{display:none;}' : '';
        else $homeslide='';
	$style = <<<EOF
<style type="text/css">
#header {
	background: #fff url($img) no-repeat;
}$homeslide
</style>\n
EOF;
	echo $style;
}
add_action('wp_head', 'philnaHeaderBackgroudImage', 99);
