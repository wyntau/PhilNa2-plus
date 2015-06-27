<?php
/**
 * Template Name: 归档(archive)
 */
get_header();
?>
<div id="wrap">
  <div id="header" class="box">
    <div id="caption" class="icon">
      <?php philnaBlogTitleAndDesc(); ?>
    </div>
    <?php wp_nav_menu(array( 'theme_location'=>'primary','container_class' => 'navigation')); ?>
<div id="top_right">
          <ul id="menu-top_right">
    <?php if(isset($_COOKIE['show_sidebar']) && !$_COOKIE['show_sidebar']=='no'):?>
      <li id="close-sidebar" title="显示/关闭侧边栏"><a>关闭侧边栏</a></li>
      <li id="show-sidebar" style="display:none;"title="显示/关闭侧边栏"><a>显示侧边栏</a></li>
    <?php else: ?>
      <li id="close-sidebar" style="display:none;" title="显示/关闭侧边栏"><a>关闭侧边栏</a></li>
      <li id="show-sidebar" title="显示/关闭侧边栏"><a>显示侧边栏</a></li>
    <?php endif;?>
        <?php if(isset($_COOKIE['show_sidebar']) && $_COOKIE['show_sidebar']=='no'): ?>
<style type="text/css">
#content,#content2,#content3 {width:920px;}
#footer {width:920px;}
#sidebar {display:none;}
</style>
<?php endif; ?>
      </ul>
        </div>
    <?php //wp_page_menu('show_home=1&menu_class=navigation'); ?>
    <div class="clear"></div>
  </div>
  <div id="content3">
    <?php
if( have_posts() ) :
  while( have_posts() ) :
  the_post();
$postTitleTag = is_singular() ? 'h1' : 'h2';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
  <<?php echo $postTitleTag; ?> class="post_title"><a class="icon" href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $postTitleTag; ?>>
<div class="postinfo">
    <div class="left no_webshot">
      <span class="date icon"><?php the_time(__('F jS, Y', YHL)); ?></span>
    </div>
    <div class="clear"></div>
  </div>
  <div class="post_content content">
<a id="expand_collapse" href="#">全部展开/收缩</a>
<div id="archives"><?php archives_list_SHe(); ?></div>
    <div class="clear"></div>
  </div>
</div><?php /* end post */?>
<?php
endwhile;
?>
<?php endif;?>
  </div>
<?php
function callback($buffer)
{
  $append_js=<<<EOT
  <script type="text/javascript">
    /* <![CDATA[ */
  jQuery(document).ready(function() {
  $('#expand_collapse,.archives-yearmonth').css({
    cursor: "s-resize"
  });
  $('#archives ul li ul.archives-monthlisting').hide();
  $('#archives ul li ul.archives-monthlisting:first').show();
  $('#archives ul li span.archives-yearmonth').click(function() {
    $(this).next().slideToggle('fast');
    return false;
  });
  //以下下是全局的操作
  $('#expand_collapse').toggle(
  function() {
    $('#archives ul li ul.archives-monthlisting').slideDown('fast');
  },
  function() {
    $('#archives ul li ul.archives-monthlisting').slideUp('fast');
  });
});
    /* ]]> */
  </script>
EOT;
//$buffer=ob_get_contents();
$buffer=str_replace('</body>',$append_js.'</body>',$buffer);
  return $buffer;
}
ob_start("callback");
get_footer();
ob_end_flush();
?>
