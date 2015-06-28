<?php
/**
 * content filter functions
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
  $after = '';
  if(is_feed() || is_single()){
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
if(!defined('DOING_AJAX')){
  add_filter('the_content', 'philnacopyright', 0);
}
