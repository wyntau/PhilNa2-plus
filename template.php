<?php
/**
 * base template
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

get_header();
?>
<div id="wrap">
  <div id="header" class="box">
    <div id="caption" class="icon">
      <?php philnaBlogTitleAndDesc(); ?>
    </div>
    <?php wp_nav_menu(array('theme_location'=>'primary', 'container_class' => 'navigation')); ?>
    <?php philnaCloseSidebar() ?>
    <?php //wp_page_menu('show_home=1&menu_class=navigation'); ?>
    <div class="clear"></div>
  </div>
  <?php if(is_single() || is_page()):?>
      <div id="content2">
    <?php else: ?>
      <div id="content">
    <?php endif;?>
    <?php include_once TEMPLATEPATH . '/templates/notice.php';?>
    <?php include_once TEMPLATEPATH . '/loop.php';?>
  </div>
<?php get_footer(); ?>
