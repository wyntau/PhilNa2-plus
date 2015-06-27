<?php
/**
 * javascript
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**
 * the js lang
 * @return unknown_type
 */
function philnaJSLanguage(){
$blogtitle=get_bloginfo('name');
	$lang = array(
		'commonError'=>__('Sorry! An error occurred', YHL),
		'ajaxloading'=>'<span class="ajaxloading">'.__('Loading...', YHL).'</span>',
		'searchTip'=> __('Type text to search here...', YHL),
		'scomment'=>__('Submit Comment', YHL),
		'upcomment'=>__('Update Comment', YHL),
		'thankscm'=>__('Thanks for your comment', YHL),
		'blogName'=>$blogtitle ? $blogtitle :__('自说Me话'),//博客标题
		'AjaxLoading'=>$GLOBALS['philnaopt']['AjaxLoading'] ? $GLOBALS['philnaopt']['AjaxLoading'] : __('AjaxLoading......', YHL),//Ajaxloading提示
		'LoadText'=>$GLOBALS['philnaopt']['LoadText'] ? $GLOBALS['philnaopt']['LoadText'] : __('页面载入中......', YHL),//点击标题变成的文字
	);

	return ', lang='.philnaJSON($lang);
}

/**
 * load js in footer
 * @return null
 */
function philnaLoadJS(){
	global $post;
	$blogurl = get_bloginfo('url').'/';
	$thepostID = ', postID=';
	$thepostID .= !is_home() ? $post->ID : 'null';
	$jslang = philnaJSLanguage();
	$themeurl=get_bloginfo('template_directory');

	// javascript loader
	$jsFileURI = get_bloginfo('template_directory') . '/js.php';

	// add a version (timestamp)
	$jsFile = TEMPLATEPATH.'/js/philna2.js';
	if(file_exists($jsFile)){
		$jsFileURI .= '?v='.date('YmdHis', filemtime($jsFile));
	}

	$text = <<<EOF
<script type="text/javascript">
/* <![CDATA[ */
var yinheli = {},themeurl="$themeurl",blogURL = "$blogurl"{$thepostID}{$jslang};
/* ]]> */
</script>
<script src="{$jsFileURI}" type="text/javascript"></script>\n
EOF;
	echo $text;
}
add_action('wp_footer', 'philnaLoadJS', 100);
