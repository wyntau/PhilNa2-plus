<?php
/**
 * base template functions
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**
 * cononical link
 * @return unknown_type
 */
function philnaCanonical(){
  if(function_exists('rel_canonical') && is_singular()){
    return;
  }
  if(is_404() || is_search()){
    return;
  }
  global $post;
  if( is_home() )
    echo '<link rel="canonical" href="'.get_bloginfo('url').'"/>',"\n";
  else
    echo  '<link rel="canonical" href="'.get_permalink($post->ID).'"/>',"\n";
}
add_action('wp_head','philnaCanonical');

/**
 * Document title
 *
 * @return string
 */
function philnaDocumentTitle(){

  // check SEO plugins
  if(philnaCheckSEOPlugins()){
    wp_title();
    return;
  }

  global $post, $wp_query;
  $page = $wp_query->get('paged');
  $page = !empty($page) ? __(' - Page  ', YHL).$page : '';

  if( is_home() ){//首页
    echo bloginfo('name'), ' - ' . get_bloginfo('description'), $page;
  }elseif( is_single() ){ // 单篇文章页
    $catAndTag = get_the_category_list(' - ', '', false) . get_the_tag_list(' - ', ' - ', '');
    echo wp_title('',true), ' - ' . strip_tags($catAndTag), ' - ', get_bloginfo('name'), $page;
  }elseif( is_page()){ //者普通页面
    echo wp_title('',true), ' - ', get_bloginfo('name');
  }elseif( is_search() ){ //搜索页
    printf(__('Search results for &quot;%1$s&quot;',YHL),
    attribute_escape(get_search_query()));
    echo ' - ', bloginfo('name'), $page;
  }elseif( is_category() ){ //分类页
    echo  single_cat_title(), ' - ', get_bloginfo('name'), $page;
  }elseif( is_tag() ){ //Tags页 (标签页)
    echo single_tag_title(), ' - ', get_bloginfo('name'), $page;
  }elseif( is_month() ){ //存档页(目前只有月份存档,如果有需要再添加其他的存档可能)
    printf(__('Archive for %1$s', YHL), single_month_title(' ', false));
    echo  ' - ', get_bloginfo('name'), $page;
  }elseif( is_404() ){ //404 错误页面
    echo __('404 Not Found  I\'m sorry', YHL), ' - ', get_bloginfo('name');
  }else{ //其他没有考虑到的情况
    echo wp_title('',true), ' - ', get_bloginfo('name'), $page;
  }
}

/**
 * 去掉 title 前面的空格
 */
add_filter('wp_title', create_function('$a, $b','return str_replace(" $b ","",$a);'), 10, 2);

/**
 * common head links
 * @return unknown_type
 */
function philnaHeadItem(){
  echo
  '<link rel="shortcut icon" href="'.get_bloginfo('template_url').'/images/favicon.png" type="image/x-icon" />',"\n",
  '<link rel="alternate" type="application/rss+xml" title="'.__('RSS 2.0 - posts', YHL).'" href="'.$GLOBALS['philnaopt']['feed_url'].'" />',"\n",
  '<link rel="alternate" type="application/rss+xml" title="'.__('RSS 2.0 - all comments', YHL).'" href="'.get_bloginfo('comments_rss2_url').'" />',"\n",
  '<link rel="apple-touch-icon" href="'.get_bloginfo('template_url').'/images/apple_touch_icon.png" /> ',"\n";

  echo is_singular() ? '<link rel="pingback" href="'.get_bloginfo('pingback_url').'"/>'."\n" : '';

  if(is_day() || is_tag() || is_search() || is_author()){
    echo '<meta name="robots" content="noindex,follow,noodp" />', "\n";
  }

  !is_bot() || wp_get_archives('type=monthly&format=link'); // for bots
}
add_action('wp_head', 'philnaHeadItem', 2);

/**
 * Keywords and description for head meta tag
 *
 * @return unknown_type
 */
function philnaKeywordsAndDescription(){

  // check SEO plugins
  if(philnaCheckSEOPlugins()){
    return;
  }

  global $post, $wp_query;

  // default
  $keywords = $GLOBALS['philnaopt']['keywords'] ? $GLOBALS['philnaopt']['keywords'] : 'Wordpress,philna,theme,yinheli';
  $description = $GLOBALS['philnaopt']['description'] ? $GLOBALS['philnaopt']['description'] : get_bloginfo('description');

  if(is_singular()){ // 普通页面
    $keywords = array($keywords);
    $keywords[] = get_post_meta($post->ID, 'Keywords', true);
    $keywords[] = get_post_meta($post->ID, 'keywords', true);

    // 仅对 单篇文章页( single ) 处理
    if( is_single() ){
      //获得分类名称 作为关键字
      $cats = get_the_category();
      if($cats){
        foreach( $cats as $cat ){
          $keywords[] = $cat->name;
        }
      }

      //获取Tags 将Tags 作为关键字
      $tags = get_the_tags();
      if($tags){
        foreach( $tags as $tag ){
          $keywords[] = $tag->name;
        }
      }
    }

    // 格式化处理 $keywords
    if(count($keywords) > 1){
      array_shift($keywords);
    }
    $keywords = array_filter($keywords);
    $keywords = join(',', $keywords);

    // 对 description 的处理
    if(!empty($post->post_password)){ // 受保护的文章
      $keywords = '';
      $description = __('Protected post.Enter your password to view',YHL);
    }else{
      //获取自定义域内容
       $description = mb_strimwidth(strip_tags($post->post_content),0,300);
       if( empty($description) ){
         $description = get_post_meta($post->ID, 'description', true);
       }
      //自定义域为空 试试Excerpt
      if( empty($description) ){
        $description = get_the_excerpt();
      }

      //依然为空 则截取文章的前210个字符作为描述
      if( empty($description) ){
        $description = philnaStriptags($post->post_content);
        $description = philnaSubstr($description, 260);
      }
    }

  }elseif(is_category()){ // 分类页
    $keywords = single_cat_title('', false);
    $description = philnaStriptags(category_description());
  }elseif(is_author()){ // 作者页
    $meta_auth = get_userdata(get_query_var('author'));
    $keywords = $meta_auth->display_name;
    $description = str_replace(array('"'), '&quot;', $meta_auth->description);
    $description = philnaStriptags($description);
  }elseif(is_tag()){ // 标签页
    $keywords = single_cat_title('', false);
    $description = tag_description();
    $description = philnaStriptags($description);
  }elseif(is_month()){ // 月份存档页
    $description = single_month_title(' ', false);
  }

  if( !empty($keywords) ){
    echo '<meta name="keywords" content="',trim($keywords),'" />',"\n";
  }

  if( !empty($description) ){
    echo '<meta name="description" content="',trim($description),'" />',"\n";
  }

  $currentTheme = get_current_theme();

  if(!$themes = wp_cache_get('allThemes', 'philna')){
    $themes = get_themes();
    wp_cache_add('allThemes', $themes, 'philna');
  }

  $theme = $themes[$currentTheme]['Title'];
  $version = $themes[$currentTheme]['Version'];
  $themeAuthor = philnaStriptags($themes[$currentTheme]['Author']);

  unset($keywords,$description,$currentTheme,$themes,$theme,$version,$themeAuthor);
  //hook
   do_action('after_keywords_desc');
}
add_action('wp_head', 'philnaKeywordsAndDescription',1);

/**
 * Blog title and description
 *
 * @return unknown_type
 */
function philnaBlogTitleAndDesc(){
  $title = get_bloginfo('name');
  $desc = get_bloginfo('description');
  $url = get_bloginfo('url');

  $home = <<<END
<h1 id="blog_title"><a href="$url" title="$title - $desc" rel="bookmark">$title</a></h1>
\t\t\t<h2 id="blog_description">$desc</h2>\n
END;

  $other = <<<END
<h2 id="blog_title"><a href="$url" title="$title - $desc" rel="bookmark">$title</a></h2>
\t\t\t<p id="blog_description">$desc</p>\n
END;

  if( is_home() ){
    echo $home;
  }else{
    echo $other;
  }

  do_action('philnaBlogTitleAndDesc');
}

/**
 * 处理无标题文章 ( when insert a no titled post )
 *
 * 以前没有注意到,wp可以发布没有标题的文章
 * 由于SEO等方面的关系,页面部分地方用了绝对定位
 * 没有标题肯能导致页面样式'变形'
 *
 * 该函数还有待改进,可添加拼音等转换函数
 *
 * @since 2.0.1
 */
function philnaCreateTitle($data){
  if(empty($data['post_title']))
  $data['post_title'] = philnaSubstr($data['post_content'],20);
  //if(empty($data['post_name']))
  //  $data['post_name'] = $data['post_title'];//不知道有什么好东东可以转换为拼音的...
  return $data;
}
//add_filter('wp_insert_post_data','philnaCreateTitle');

/**
 * Filter Sticky post title in homepage
 * @param unknown_type $title
 * @return unknown_type
 */
function philnaFilterStickyPostTitle($title){
  if(is_home() && is_sticky()){
    $title .= __(' [ stick ]', YHL);
  }
  return $title;
}
add_filter('the_title', 'philnaFilterStickyPostTitle');

/**
 * Add class 'tagcolor_0 ~ 9' to each tag link use regular expression by filter hook
 *
 * @param string $tagLinks the tag links
 * @return string
 */
function philnaColorfullTags($tagLinks){
  $r = "/class='(.*?)'/i";
  $tagLinks = explode("\n", $tagLinks);
  $c = array(0,1,2,3,4,5,6,7,8,9);
  $returns = '';
  foreach($tagLinks as $tagLink){
    $returns .= preg_replace($r, 'class="$1 tagcolor_'.$c[mt_rand(0, count($c)-1)].'"', $tagLink)."\n ";
  }
  return $returns;
}
// add filter to wp_tag_cloud
add_filter('wp_tag_cloud', 'philnaColorfullTags');

/**
 * Filter body class
 *
 * @param array $class
 * @return multitype:
 */
function philnaBodyClass(array $class){
  $class = array_merge($class, array('philna', 'yinheli'));
  return array_unique($class);
}
add_filter('body_class','philnaBodyClass');

/**
 * Filter post class
 *
 * @param array $class
 * @return multitype:
 */
function philnaPostClass(array $class){
  global $post;
  $myClass = array('post', 'box','icon');

  $class = array_merge($class, $myClass);

  $postDate = $post->post_date;
  $now = time() + get_option('gmt_offset')*3600;
  $diff = ($now - strtotime($postDate))/3600;
  if($diff < 24){
    $class[] = 'new newin24hours';
  }

  return array_unique($class);
}
add_filter('post_class','philnaPostClass');

/**
 * Filter comment class
 * if doing ajax add class 'tip'
 * @param array $class
 * @return unknown_type
 */
function philnaCommentClass(array $class){
  if(defined('DOING_AJAX')){
    $class = array_merge($class, array('ajax'));
  }
  if(defined('PHILNATIP')){
    $class = array_merge($class, array('tip'));
  }
  $class = array_merge($class, array('box', 'icon', 'content'));
  return array_unique($class);
}
add_filter('comment_class', 'philnaCommentClass');

/**
 * Filter post_comments_feed_link_html
 * @param unknown_type $c
 * @return unknown_type
 */
function philnaPostCommentsFeedLinkHtml($c){
  return stripslashes( wp_rel_nofollow($c) );
}
add_filter('post_comments_feed_link_html', 'philnaPostCommentsFeedLinkHtml');

/**
 * If pagenavi?
 *
 * @return bool
 */
function philnaHavePagenavi(){
  if(is_singular()){
    return false;
  }
  global $wp_query;
  $posts_per_page = $wp_query->query_vars['posts_per_page'];
  $found_posts = $wp_query->found_posts;
  $paged = $wp_query->query_vars['paged'];
  if($found_posts/$posts_per_page > 1 || $paged){
    return true;
  }else{
    return false;
  }
}

/**
 * Separates comments from trackbacks
 * @since 3.0.0
 * @global array $trackbacks Array of trackbacks/pings of current post
 * @param array $comments Array of comments/trackbacks/pings of current post
 * @return array Comments only
 */
function philnaSeperateComments( $comments ) {
  global $trackbacks;

  $comments_only = array_filter( $comments, 'philnaStripTrackback' );
  $trackbacks = array_filter( $comments, 'philnaStripComment' );

  return $comments_only;
}
add_filter('comments_array', 'philnaSeperateComments');

/**
 * Strips out trackbacks/pingbacks
 * the help function of Separates comments
 * @since 3.0.0
 * @param object $var current comment
 * @return boolean true if comment
 */
function philnaStripTrackback($var) {
  return ($var->comment_type != 'trackback' and $var->comment_type != 'pingback');
}

/**
 * Strips out comments
 * the help function of Separates comments
 * @since 3.0.0
 * @param object $var current comment
 * @return boolean true if trackback/pingback
 */
function philnaStripComment($var) {
  return ($var->comment_type == 'trackback' or $var->comment_type == 'pingback');
}

/**
 * filter style uri
 *
 * @param string $stylesheet_uri
 * @param string $stylesheet_dir_uri
 * @return unknown_type
 */
function philnaStyleUrl($stylesheet_uri, $stylesheet_dir_uri){
  if(is_404()){
    $file = TEMPLATEPATH.'/404.css';
    $stylesheet_uri = $stylesheet_dir_uri.'/404.css';
  }else{
    $file = TEMPLATEPATH.'/style.css';
    // for degbug (when debug just rename style.css, this will load style.dev.css
    if(!file_exists($file)){
      $file = TEMPLATEPATH.'style.dev.css';
      $stylesheet_uri = $stylesheet_dir_uri.'/style.dev.css';
    }
  }
  // return the link with a version id (timestamp)
  return $stylesheet_uri.'?v='.date('YmdHi', filemtime($file));
}
add_filter('stylesheet_uri', 'philnaStyleUrl', 10, 2);

/**
 * login logo
 *
 * @return null
 */
function philnaLoginLogo(){
  $logo = get_bloginfo('template_url').'/images/logo.gif';
  echo '
    <style type="text/css" media="screen">
    body.login{
      border-top-color: #222;
    }
    h1 a {
      background:url('.$logo.') no-repeat scroll center center ;
    }
    </style>';
}
add_action('login_head','philnaLoginLogo');

/**
 * Check SEO plugins
 *
 * @return unknown_type
 */
function philnaCheckSEOPlugins(){
  // SEO plugins
  $seoClasses = array('All_in_One_SEO_Pack');
  $seoFunctions = array();

  foreach($seoClasses as $v){
    if(class_exists($v)) return true;
  }
  foreach($seoFunctions as $v){
    if(function_exists($v)) return true;
  }
}

/**
 * filter image uhumbnail attr
 *
 * @param array $attr
 * @return array
 */
function philnaThumbnailAttr($attr) {
  if (isset($attr['class'])) {
    $attr['class'] .= ' thumbnail sided alignright';
  }
  return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'philnaThumbnailAttr');

/* 注册边侧栏 */
if( function_exists('register_sidebar')){
  //1 top widget
  register_sidebar(array(
    'name' => __('First widget',YHL),
    'description'=>__('This widget will show in top of the sidebar.', YHL),
    'before_widget' => '<div id="%1$s" class="widget box icon content">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  //2 left widget
  register_sidebar(array(
    'name' => __('Second widget',YHL),
    'description'=>__('This widget will show in bottom of the sidebar. Replace "Meta" widget', YHL),
    'before_widget' => '<div id="%1$s" class="widget box icon content">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  //3 right widget
  register_sidebar(array(
    'name' => __('Third widget',YHL),
    'description'=>__('This widget will show in bottom of the sidebar. Replace "Meta" widget', YHL),
    'before_widget' => '<div id="%1$s" class="widget box icon content">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  //4 bottom widget
  register_sidebar(array(
    'name' => __('Fourth widget',YHL),
    'description'=>__('This widget will show in bottom of the sidebar. Replace "Meta" widget', YHL),
    'before_widget' => '<div id="%1$s" class="widget box icon content">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}
