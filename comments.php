<?php
/**
 * comments
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

// Password Protection
if( post_password_required() ):
?>
<div class="box message">
  <?php _e('This post is password protected. Enter the password to view comments.', YHL);?>
</div>
<?php return; endif;?>

<!--comment satae-->
<div id="commentstate" class="box content clearfix">
  <div class="left">
      <span id="commentnum"><?php _e('Comments', YHL); ?> ( <span id="commentcount"><?php echo count($comments); ?></span> )</span>
  </div>
  <div class="right">
    <?php post_comments_feed_link( __('Feed for this Entry', YHL) ); ?>
    <?php if(is_single()):?><?php if(pings_open()):?><a id="addtrackback" class="addtrackback" rel="nofollow" href="<?php trackback_url(); ?>" title="<?php _e('Use this link to send a trackback to this post.', YHL);?>"><?php _e('Trackback', YHL);?></a><?php endif; ?><?php endif; ?>
    <?php if(comments_open()) : ?><a id="addcomment" class="addcomment" rel="nofollow" href="#respond" title="<?php _e('Add a comment', YHL);?>"><?php _e('Leave a comment', YHL); ?></a><?php endif; ?>
  </div>
</div>

<!--list comment-->
<ol id="comments">
<?php
if( have_comments() ):
  wp_list_comments('callback=philnaComments&avatar_size=40');
else:
?>
  <li class="box message">
    <?php _e('No comments yet.', YHL); ?>
  </li>
<?php endif; ?>
</ol>

<?php if(comments_open()):?>
<div id="ajaxbox" class="box content message icon hide">
    <span class="ajaxloading"><?php _e('Submitting Comment, Give me a second...',YHL); ?></span>
</div>
<?php endif; ?>

<?php
if (get_option('page_comments')):
  $comment_pages = paginate_comments_links('echo=0');
  if ($comment_pages):
?>
<!--comments pages-->
<div id="commentnavi" class="box icon content">
  <span class="pages icon"><?php _e('Comment pages', YHL); ?></span>
  <span id="cpager"><?php echo $comment_pages; ?></span>
</div>
<?php
  endif;
endif;
?>

<!--comment form-->
<?php
if(comments_open()):
  include_once get_template_directory() . '/templates/commentform.php';
else:
?>
<div class="box message">
  <?php _e('Comments are currently closed.', YHL); ?>
</div>
<?php endif; ?>
<?php if(is_single()):?>
<!--trackpbacks state-->
<div id="trackbackstate" class="box message clearfix">
  <div class="left">
      <span id="trackbacknum"><?php _e('Trackbacks &amp; Pingbacks', YHL); ?> ( <?php echo count($GLOBALS['trackbacks']); ?> )</span>
  </div>
  <div class="right">
      <span><a id="toggletrackbacks" class="icon" rel="nofollow" title="<?php __('Show/Hide the list',YHL);?>" href="javascript:void(0);"><?php _e('Toggle the list',YHL); ?></a></span>
  </div>
</div>

<!--list trackbacks-->
<ol id="pinglist" class="hide">
<?php
if( !empty($GLOBALS['trackbacks']) ):
  foreach ($GLOBALS['trackbacks'] as $comment){
    philnaPings($comment);
  }
else:
?>
  <li class="box icon message">
    <?php _e('No trackbacks yet.', YHL); ?>
  </li>
<?php
endif;
if(!pings_open()):
?>
  <li class="box icon message">
    <?php _e('Trackbacks are currently closed.', YHL); ?>
  </li>
<?php endif; ?>
</ol>
<?php endif ?>
