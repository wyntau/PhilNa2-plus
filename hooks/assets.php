<?php

add_action('wp_enqueue_scripts', 'philna_stylesheet_uri');
function philna_stylesheet_uri(){
  $template_directory = get_template_directory();
  $stylesheet_dir_uri = get_stylesheet_directory_uri();

  if(is_404()){
    $file = $template_directory . '/404.css';
    $stylesheet_uri = $stylesheet_dir_uri . '/404.css';
  }else{
    $file = $template_directory . '/style.css';
    $stylesheet_uri = $stylesheet_dir_uri . '/style.css';
    // for degbug (when debug just rename style.css, this will load style.dev.css
    if(!file_exists($file)){
      $file = $template_directory . 'style.dev.css';
      $stylesheet_uri = $stylesheet_dir_uri . '/style.dev.css';
    }
  }
  // return the link with a version id (timestamp)
  $stylesheet_uri = $stylesheet_uri . '?v=' . date('YmdHi', filemtime($file));
  wp_enqueue_style('philnaStyle', $stylesheet_uri, array(), NULL);
}

add_action('wp_enqueue_scripts', 'philnaLoadJQuery');
function philnaLoadJQuery(){
  wp_enqueue_script('jquery-core');
}

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
function philna_javascript_uri(){
  global $post;
  $blogurl = get_bloginfo('url').'/';
  $thepostID = ', postID=';
  $thepostID .= !is_home() ? $post->ID : 'null';
  $jslang = philnaJSLanguage();
  $themeurl=get_template_directory_uri();

  // javascript loader
  $jsFileURI = get_template_directory_uri() . '/js.php';

  // add a version (timestamp)
  $jsFile = get_template_directory().'/js/philna2.js';
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
add_action('wp_footer', 'philna_javascript_uri', 100);
