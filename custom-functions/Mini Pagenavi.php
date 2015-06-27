<?php
/*****************************************
 *Mini Pagenavi v1.0 by Willin Kan.
 *免插件版pagenavi函数,
 *主题中已经提供对于wp-pagenavi插件的支持.直接启用插件即可使用wp-pagenavi插件,无须修改
 *******************************************/
function Mini_pagenavi ( $p = 2 ) { //取当前页前后各2页
  if ( is_singular ( ) ) return ; //文章与插页不用
  global $wp_query , $paged ;
  $max_page = $wp_query -> max_num_pages ;
  if ( $max_page == 1 ) return ; //只有一页不用
  if ( empty ( $paged ) ) $paged = 1 ;
  echo '<div class="wp-pagenavi"><span class="pages">'  .  ' [ ' . $paged . ' / ' . $max_page . ' ] ' . ' </span> '; // 页数
   if ( $paged > 4 ) p_link( 1, '|<' );
   if ( $paged > 1 ) p_link( $paged-1, '<<' );
  for ( $i = $paged - $p ; $i <= $paged + $p ; $i ++ ) { //中间页
    if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='current'>{$i}</span> " : p_link( $i );
  }
  if ( $paged < $max_page ) p_link( $paged+1, '>>' );
  if ( $paged < $max_page-3 ) p_link( $max_page, '>|' );
  echo '</div>';
}
function p_link( $i, $title = '' ) {
  if ( $title == '' ) $title = "{$i}";
  echo "<a href='", esc_html(get_pagenum_link( $i ) ), "'>{$title}</a>";
}
// -- END ----------------------------------------
