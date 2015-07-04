<?php
/**
 * Main sidebar
 */
// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

?>
<div id="sidebar">
<?php
  include_once get_template_directory() . '/searchform.php';
  include_once get_template_directory() . '/templates/feed.php';
  do_action('philnaWidgetsStart'); // widgets start hook

  if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ){ ?>
    <div class="widget box icon content">
      <div id="tab-title">
        <h3><span class="selected">最新评论</span> | <span>最新文章</span> | <span>随机文章</span></h3>
      </div>
      <div id="tab-content">
        <ul id="tab-slider"><?php philnaRecentcomments('number=9&status=approve'); ?></ul>
        <ul class="hide"><?php Recentposts($limit = 9); // limit output ?></ul>
        <ul class="hide"><?php Randomposts($limit = 9); // limit output ?></ul>
      </div>
    </div>
<?php
  } //endif;//widget 1

  if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ){
?>
    <div class="widget box icon content tag_cloud">
      <h3><?php _e('Tag Cloud',YHL); ?></h3>
      <?php wp_tag_cloud('unit=px&smallest=11&largest=18&order=RAND&number=30');//参数含义:单位(px),最小(11),最大(18),排序(随机) ?>
    </div>
<?php
  } //endif; //widget 2

  if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ){}

  if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ){
?>
    <div class="widget box icon content">
      <h4><?php _e('Meta',YHL); ?></h4>
      <ul>
        <?php wp_register(); ?>
        <li><?php wp_loginout(); ?></li>
      </ul>
    </div>
<?php
  } //endif; //widget 4
?>
</div>
