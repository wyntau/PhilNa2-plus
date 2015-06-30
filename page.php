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
    <?php philnaCloseSidebar() ?>
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
