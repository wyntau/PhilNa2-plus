<?php
/**
 *adsense
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');


/**
 * Add google adsense (size: 468x60)
 *
 * @param unknown_type $content
 * @return mixed
 */
function philnaSinglePostAD($content){
	global $user_ID, $id;
	if($user_ID) return $content;
	if(is_single() && $GLOBALS['philnaopt']['showad'] && $GLOBALS['philnaopt']['ad']){
		$adContent = $GLOBALS['philnaopt']['ad'];
		if(defined('DOING_AJAX')){ //if ajax paging return 'iframe' ad (ajax 返回数据夹杂javascript时会出错. 这里修改之前的广告隐藏为插入 iframe.)
			$adURL = get_bloginfo('url').'/?adsenseIframeURLContent';
			$adContent = '<iframe frameborder="0" hspace="0" scrolling="no" style="border:none;height:60px;overflow:hidden;width:468px;" src="' . $adURL .'"></iframe>';
		}
		
		$ad = '<span id="more-'.$id.'" class="ad icon"><span class="ad_content">'.$adContent.'</span></span>';
		$content = str_replace('<span id="more-' . $id . '"></span>', $ad, $content);
	}
	return $content;
}
add_filter('the_content', 'philnaSinglePostAD', 999);

// for adsense ajax
if(isset($_GET['adsenseIframeURLContent'])){
	if($GLOBALS['philnaopt']['showad'] && $GLOBALS['philnaopt']['ad']){
		$adsenseIframeURLContent =
<<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="zh-CN">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adsense</title>
<style type="text/css">
/*simply reset*/
* {
	margin: 0;
	padding: 0;
}
</style>
</head>
<body>
{$GLOBALS['philnaopt']['ad']}
</body>
</html>
EOF;
		echo $adsenseIframeURLContent;
		die;
	}
}
