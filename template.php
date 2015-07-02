<?php
/**
 * base template
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

get_header();
?>
<div id="wrap">
  <div id="header" class="box clearfix">
    <div id="caption" class="icon">
      <?php philnaBlogTitleAndDesc(); ?>
    </div>
    <?php wp_nav_menu(array('theme_location'=>'primary', 'container_class' => 'navigation')); ?>
    <?php philnaCloseSidebar() ?>
  </div>
  <div id="content" <?php if(!is_singular()) echo 'class=" content-list"'; ?>>
  <?php include_once get_template_directory() . '/templates/notice.php';?>
  <?php include_once get_template_directory() . '/loop.php';?>
  </div>
<?php get_footer(); ?>
