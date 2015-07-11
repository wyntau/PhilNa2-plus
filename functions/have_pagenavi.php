<?php

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
