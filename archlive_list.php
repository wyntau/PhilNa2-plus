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
    <?php philnaCloseSidebar() ?>
    <?php //wp_page_menu('show_home=1&menu_class=navigation'); ?>
    <div class="clear"></div>
  </div>
  <div id="content">
    <?php
if( have_posts() ) :
  while( have_posts() ) :
  the_post();
$postTitleTag = is_singular() ? 'h1' : 'h2';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
  <<?php echo $postTitleTag; ?> class="post_title"><a class="icon" href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $postTitleTag; ?>>
<div class="postinfo">
    <div class="left">
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
<?php endif; ?>
  </div>
<?php
function callback($buffer){
  $append_js = <<<EOT
<script type="text/javascript">
  /* <![CDATA[ */
  jQuery(function($) {
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
    $('#expand_collapse').on('click', function() {
      var list = $('#archives ul li ul.archives-monthlisting');
      if(list.is(':hidden')){
        list.slideDown('fast');
      }else{
        list.slideUp('fast');
      }
    });
  });
  /* ]]> */
</script>
EOT;
  return str_replace('</body>',$append_js.'</body>',$buffer);
}
ob_start("callback");
get_footer();
ob_end_flush();
