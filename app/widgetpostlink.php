<?php
/**
 * widgetpostlink functions
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**
 * 边侧栏 文章链接
 *
 * 作用: 在边侧栏显示随机文章, 最近发布的文章.
 * 为了减少数据库请求.不再使用mg12的方法.
 * 目前显示很多条的情况下也不会增加额外的数据库请求
 *
 * @since 2.0
 * @version 2.1
 */
function Randomposts($limit = 5){
  global $wpdb, $id;
  $posts_widget_title = __('Random Posts',YHL);
  if(!$posts = wp_cache_get('widgetPostsLinkElse', 'philna')){
    $posts = get_posts("numberposts={$limit}&orderby=rand");
    wp_cache_add('widgetPostsLinkElse', $posts, 'philna');
  }
  $output .="<ul>\n";
  if(empty($posts)){
    $output .= '<li>Can\'t found (没有找到)</li>';
    $output .= "</ul>\n";
    echo $output;
    return;
  }
  foreach($posts as $post) {
    $output .=  '  <li><a href="' . get_permalink($post) . '" title="' . $post->post_title . '" rel="bookmark inlinks">' . $post->post_title . '</a></li>'."\n";
  }
  $output .= "</ul>\n";
  echo $output;
}

function Recentposts($limit = 5){
  global $wpdb, $id;
  $posts_widget_title = __('Recent Posts',YHL);
  if(!$posts = wp_cache_get('widgetPostsLinkSingle', 'philna')){
    $posts = get_posts("numberposts={$limit}&orderby=post_date");
    wp_cache_add('widgetPostsLinkSingle', $posts, 'philna');
  }
  $output .="<ul>\n";
  if(empty($posts)){
    $output .= '<li>Can\'t found (没有找到)</li>';
    $output .= "</ul>\n";
    echo $output;
    return;
  }
  foreach($posts as $post) {
    $output .=  '  <li><a href="' . get_permalink($post) . '" title="' . $post->post_title . '" rel="bookmark inlinks">' . $post->post_title . '</a></li>'."\n";
  }
  $output .= "</ul>\n";
  echo $output;
}
