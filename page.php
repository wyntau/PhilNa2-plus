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
    <?php wp_nav_menu(array( 'theme_location'=>'primary','container_class' => 'navigation')); ?>
<div id="top_right">
          <ul id="menu-top_right">
    <?php if(!$_COOKIE['show_sidebar']=='no'):?>
      <li id="close-sidebar" title="显示/关闭侧边栏"><a>关闭侧边栏</a></li>
      <li id="show-sidebar" style="display:none;"title="显示/关闭侧边栏"><a>显示侧边栏</a></li>
    <?php else: ?>
      <li id="close-sidebar" style="display:none;" title="显示/关闭侧边栏"><a>关闭侧边栏</a></li>
      <li id="show-sidebar" title="显示/关闭侧边栏"><a>显示侧边栏</a></li>
    <?php endif;?>
        <?php if($_COOKIE['show_sidebar']=='no'): ?>
<style type="text/css">
#content,#content2,#content3 {width:920px;}
#footer {width:920px;}
#sidebar {display:none;}
</style>
<?php endif; ?>
      </ul>
        </div>
    <div class="clear"></div>
  </div>
  <div id="content3">
    <?php include_once TEMPLATEPATH . '/templates/notice.php';?>
    <?php
/**
 * loop
 */
// no direct access
if( have_posts() ) :
  // post loop start
  do_action('philnaLoopStart'); /* philna hook */
  while( have_posts() ) :
  the_post();
$postTitleTag = is_singular() ? 'h1' : 'h2';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
  <<?php echo $postTitleTag; ?> class="post_title"><a class="icon" href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $postTitleTag; ?>>
  <div class="postinfo">
    <div class="left no_webshot">
      <span class="date icon"><?php the_time(__('F jS, Y', YHL)); ?></span>
      <span class="author icon"><?php the_author_posts_link(); ?></span>
    </div>
    <div class="right">
    <?php if(is_singular()): ?><span id="skiptocomment" class="comments_link"><a href="#comments"><?php _e('Skip to Comments', YHL)?></a></span><?php else: ?><span class="comments_link"><sup>{ </sup><?php comments_popup_link(__('No Comments',YHL), __('1 Comment', YHL), __('% Comments', YHL));?><sub> }</sub></span><?php endif; ?>
    <?php edit_post_link(__('Edit', YHL), '<span class="edit_link icon">', '</span>'); ?>
    </div>
    <div class="clear"></div>
  </div>
  <div class="post_content content fontsize13">
    <?php
    the_content(__('Read more...', YHL));
    ?>
    <div class="clear"></div>
    <?php if( is_singular() ) wp_link_pages('before=<div class="content_pages icon"><strong>'. __('Pages:', YHL).'&after=</strong></div>'); ?>
    <?php /* PhilNa hook */ do_action('philnaStatement');?>
  </div>
</div><?php /* end post */?>
<?php
endwhile;
//include_once TEMPLATEPATH . '/templates/navigation.php';
comments_template();
else: // if no posts
?>
<div class="box error icon">
  <?php
  if(is_search())
    _e('Oh no!. No posts matched your criteria. You may try other keywords.',YHL);
  else
    _e('Oh no! You\'re looking for something which just isn\'t here! Fear not however, errors are to be expected, and luckily there are tools on the sidebar for you to use in your search for what you need.',YHL);
  ?>
</div>
<?php endif;?>
  </div>
<?php get_footer(); ?>
