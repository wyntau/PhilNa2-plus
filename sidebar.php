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
  do_action('philnaWidgetsStart'); // widgets start hook?>
<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ): ?>
<!--<div class="widget box icon content">
        <h3>Fantasy-time | <a href="<?php //bloginfo('home')?>/?random">随便看看</a></h3>
  <script charset="Shift_JIS"src="http://chabudai.sakura.ne.jp/blogparts/honehoneclock/honehone_clock_wh.js"></script>
  </div>-->
<div class="widget box icon content no_webshot">
    <div id="tab-title">
    <h3><span class="selected">最新评论</span> | <span>最新文章</span> | <span>随机文章</span></h3>
  </div>
  <div id="tab-content">
    <ul id="tab-slider"><?php philnaRecentcomments('number=9&status=approve'); ?></ul>
    <ul class="hide"><?php Recentposts($limit = 9); // limit output ?></ul>
    <ul class="hide"><?php Randomposts($limit = 9); // limit output ?></ul>
  </div>
  </div>
<?php endif;//widget 1?>

<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ): ?>
    <div class="widget box icon content tag_cloud no_webshot">
      <h3><?php _e('Tag Cloud',YHL); ?></h3>
    <?php wp_tag_cloud('unit=px&smallest=11&largest=18&order=RAND&number=30');//参数含义:单位(px),最小(11),最大(18),排序(随机) ?>
    </div>
<?php endif; //widget 2 ?>

<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ): ?>
<?php if(is_home()):?>
<!--<div class="widget box icon content webshot">
    <?php //wp_list_bookmarks('title_before=<h3>&title_after=</h3>&orderby=rand&limit=24&category=2'); //如不想随机显示.请去掉 &orderby=rand
    //此处显示的是友情链接,如果只想让某个分类显示,请去后台查看相应的分类ID,然后在orderby=rand的后面添加如下内容 &category= ID 即可 如果还想显示显示的数目,请再添加&limit=数字?>
  </div>-->
<?php endif;?>
  <!--<div class="widget box icon content no_webshot">
    <?php //get_calendar(); ?>
  </div>-->
<?php endif; //widget 3 ?>
<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ): ?>
  <div class="widget box icon content no_webshot">
    <h4><?php _e('Meta',YHL); ?></h4>
    <ul>
      <?php wp_register(); ?>
      <li><?php wp_loginout(); ?></li>
    </ul>
  </div>
  <?php endif; //widget 4 ?>
</div>
