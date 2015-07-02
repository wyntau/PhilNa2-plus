<?php
/**
 * Template Name: google搜索结果页面 (cse)
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
    <?php wp_nav_menu(array( 'theme_location'=>'primary','container_class' => 'navigation')); ?>
  </div>
<div id="content">
  <div id="cse-search-results"></div>
<script type="text/javascript">
  var googleSearchIframeName = "cse-search-results";
  var googleSearchFormName = "cse-search-box";
  var googleSearchFrameWidth = 600;
  var googleSearchDomain = "www.google.com";
  var googleSearchPath = "/cse";
</script>
<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>

</div>
<?php get_footer(); ?>
