<?php
/**
 * loop
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');
$GLOBALS['philnaopt'] = PhilNaGetOpt::getInstance();
if(is_archive() || is_search()){
  include_once get_template_directory() . '/templates/loophead.php';
}

if( have_posts() ) :
  // post loop start
  do_action('philnaLoopStart'); /* philna hook */
        $count=1;
  while( have_posts() ) :
  the_post();

$postTitleTag = is_singular() ? 'h1' : 'h2';
?>

<?php if( is_single() ): ?>  <div id="position" class="box message"><a class="right_arrow icon" title="<?php _e('Back to homepage', YHL); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', YHL); ?></a> &gt; <?php the_category(', '); ?> &gt; <?php the_title();?></div><?php echo "\n"; endif; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
  <<?php echo $postTitleTag; ?> class="post_title"><a class="icon" href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $postTitleTag; ?>>
  <div class="postinfo clearfix">
    <div class="left">
      <span class="date icon"><?php the_time(__('F jS, Y', YHL)); ?></span>
      <span class="author icon"><?php the_author_posts_link(); ?></span>
    </div>
    <div class="right">
<?php if(is_single()): ?>
<?php philnaFontsizeChange('.post_content,.post_content p'); ?>
<?php endif ;?>
    <?php if(is_singular()): ?><span id="skiptocomment" class="comments_link"><a href="#comments"><?php _e('Skip to Comments', YHL)?></a></span><?php else: ?><span class="comments_link"><sup>{ </sup><?php comments_popup_link(__('No Comments',YHL), __('1 Comment', YHL), __('% Comments', YHL));?><sub> }</sub></span><?php endif; ?>
    <?php edit_post_link(__('Edit', YHL), '<span class="edit_link icon">', '</span>'); ?>
    </div>
  </div>
  <div class="post_content content fontsize13 clearfix"><?php 
  if(is_bot() || is_single()) : the_content();
  elseif(trim($GLOBALS['philnaopt']['homeslide'])||trim($GLOBALS['philnaopt']['no_home_slide'])) : the_excerpt(); 
  elseif($count >=1 &&$count <=1) :the_excerpt(); 
  endif;
  $count++;?><?php 
  if( is_singular() ) wp_link_pages('link_before=<span>&link_after=</span>&before=<div class="content_pages post-pagenavi icon"><strong>'. __('Pages:', YHL).'&after=</strong></div>'); 
  ?><?php /* PhilNa hook */ do_action('philnaStatement');?></div>
        <?php if(!is_page()): ?>
  <div class="meta">
    <span class="cat icon"><?php the_category(', ');?></span>
    <?php the_tags('<span class="tag icon">', ', ', '</span>');?>
  </div>
  <?php endif; // meta ?>
  </div><?php /* end post */?>
<?php
endwhile;
do_action('philnaEndloop');
include_once get_template_directory() . '/templates/navigation.php';
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
