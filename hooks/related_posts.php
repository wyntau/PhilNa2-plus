<?php
/**
 *relatedpost functions
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**
 * related posts
 *
 */
function philna_get_related_posts( $args = '' ){
  global $wpdb, $post, $id;

  $cacheID = $id.md5($args);

  if($relatedPosts = wp_cache_get('relatedPosts_'.$cacheID, 'philna')){
    return $relatedPosts;
  }

  $default = array('limit'=>8, 'excerpt_length'=>45);
  $args = wp_parse_args( $args, $default );
  extract( $args, EXTR_SKIP );

  if(!$post->ID) return;

  $tags = wp_get_post_tags($id);

  $title =  __('Related Posts',YHL);
  $related_posts = '';

  if(!empty($tags)){
    $taglist = array();
    $tagcount = count($tags);
    if ($tagcount > 0) {
      for ($i = 0; $i < $tagcount; $i++) {
        $taglist[] = $tags[$i]->term_id;
      }
    }
    $related_query_args=array(
      'tag__in' => $taglist,
      'post__not_in' => array($post->ID),
      'showposts'=>$limit,
      'orderby'=>'rand',
      'caller_get_posts'=>1
    );
    $r_posts = new WP_Query($related_query_args);
    $related_posts = $r_posts->posts;
  }else{
    $related_query_args=array(
      'post__not_in' => array($post->ID),
      'showposts'=>$limit,
      'orderby'=>'rand',
      'caller_get_posts'=>1
    );
    $title = __('Random Posts',YHL);
    $r_posts = new WP_Query($related_query_args);
    $related_posts = $r_posts->posts;
  }

  //print_r($related_posts);

  $output = '<h3>'.$title.'</h3>'."\n";
  $output .= '<ul class="related_posts">'."\n";

  // not found
  if(!$related_posts){
    $output .= '<li>'.__('Not found.', YHL).'</li>'."\n";

  }else{

    foreach($related_posts as $related_post){
      $post_title = $related_post->post_title ? $related_post->post_title : __('No title', YHL);
      $comment_count = '<span class="count">( '.$related_post->comment_count.' )</span>';
      $post_excerpt = $excerpt_length ? philnaStriptags($related_post->post_content) : '';
      $post_excerpt = $post_excerpt ? '<small class="excerpt">'.convert_smilies( philnaSubstr($post_excerpt, $excerpt_length) ).'</small>' : '';
      $output .= '<li><a href="'.get_permalink($related_post).'" title="'.$post_title.'" rel="bookmark inlinks">'.$post_title.'</a>'.$comment_count.$post_excerpt.'</li>'."\n";
    }
  }

  $output .= '</ul>'."\n";

  wp_cache_add('relatedPosts_'.$cacheID. $output, 'philna');

  return $output;
}

/**
 * Insert related post links to singular
 *
 * @return unknown_type
 */
function philna_post_insert_related_posts(){
  if(!is_singular()) return;

  if(! $relatedPosts = philna_get_related_posts()){
    return;
  }

  echo "\n\n".'<div id="relatedposts" class="box">'."\n";
  echo $relatedPosts;
  echo '</div>'."\n\n";
}
add_action('philna_loop_end', 'philna_post_insert_related_posts');

/**
 * Insert related post links to feed
 * @return unknown_type
 */
function philna_feed_insert_related_posts($content){
  global $id;
  $comment_num = get_comments_number($id);
  if($comment_num==0):
    $rss_comment_tip="截至您的阅读器抓取时还没有评论.想抢沙发?那得赶快呀";
  elseif($comment_num>=1 && $comment_num<30):
    $rss_comment_tip="截至您的阅读器抓取时已有评论<strong> ".$comment_num." </strong>条,欢迎您也过来留下您的意见 !";
  elseif($comment_num>=30):
    $rss_comment_tip="截至您的阅读器抓取时已有评论<strong> ".$comment_num." </strong>条,大家讨论的如此激烈,你为什么不过去瞧瞧?!";
  endif;
  if(is_feed()){
    $content .='<p>'.$rss_comment_tip.'</p>';
    $content .= philna_get_related_posts('limit=8&excerpt_length=0');}
  return $content;
}
add_filter('the_content', 'philna_feed_insert_related_posts', 0);
