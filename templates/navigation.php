<?php
/**
 * the navigation
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

do_action('philnaPagenaviStart');
?>
<?php
if(philnaHavePagenavi()){
?>
  <div id="pagenavi" class="box icon content clearfix">
<?php
    if(function_exists('wp_pagenavi')){
      wp_pagenavi();
    }else if(function_exists('Mini_pagenavi')){
      Mini_pagenavi();
    }else{
?>
      <span class="older left"><?php next_posts_link(__('Older Page', YHL)); ?></span>
      <span class="newer right"><?php previous_posts_link(__('Newer Page', YHL)); ?></span>
<?php
    } //endif;
?>
  </div>
<?php
} //endif;/* end pagenavi */
if(is_single()){
?>
  <div id="pagenavi" class="box icon content clearfix">
<?php
    if (get_previous_post()) {
        previous_post_link('<div class="left"><span>&laquo;</span> %link</div>');
     } else {
        echo '<div class="left"><span>&laquo;</span> 已经是最后一篇啦</div>';
     }
    if (get_next_post()) {
        next_post_link('<div class="right">%link <span>&raquo;</span></div>');
     } else {
        echo '<div class="right">已经是第一篇啦 <span>&raquo;</span></div>';
     }
?>
  </div>
<?php
} //endif;
