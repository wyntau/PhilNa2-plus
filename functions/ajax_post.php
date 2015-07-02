<?php

/********************
 *首页Ajax加载文章关键函数
 ******************/
function philnaAjaxPost(){
  if(isset($_GET['id']) && $_GET['id'] != '') {
    $ariticle_id=(int)$_GET['id'];
    query_posts("p=$ariticle_id");
    while (have_posts()){
      the_post();
      the_excerpt();
    }
  }
}
