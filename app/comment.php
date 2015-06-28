<?php
/**
 *app->comment
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**
 * list comments
 * @param $comment
 * @param $args
 * @param $depth
 * @return unknown_type
 */
function philnaComments($comment, $args = array(), $depth = 1){
  global $user_ID;
  static $commentcount;
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);
  if(defined('DOING_AJAX') && !isset($page)){
    $commentcount = get_comments_number($comment->comment_post_ID)-1; // will be increased
  }elseif(!$commentcount){
    if (get_option('page_comments')){
      $page = isset($page) ? $page : 1;
      $commentcount = get_option('comments_per_page') * ($page - 1);
    }else{
      $commentcount = 0;
    }
  }
  ++$commentcount; // increase
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
  <div class="the_avatar left">
    <a rel="nofollow" class="reply" href="#comment-<?php comment_ID() ?>" title="回复这个南瓜?"><?php echo my_avatar($comment->comment_author_email, 30); ?></a>
<?php handsome_beauty($comment->comment_author_email);?>
  </div>
  <div class="comment_body left">
    <div class="comment_head">
      <div class="commentinfo left">
        <span class="name webshot"><?php comment_author_link(); ?></span>
        <span class="time"><?php comment_time(__('M jS, Y @ H:i', YHL))?></span>
        <span class="floor">| #<?php echo $commentcount; ?>
      </div>
      <div class="action right">
        <?php if($commentcount==1) echo " <span class='sofa'>沙发!</span>";?>
        <?php if($commentcount==2) echo " <span class='sofa'>藤椅</span>";?>
        <?php if($commentcount==3) echo " <span class='sofa'>板凳</span>";?>
        <?php if($commentcount==4) echo " <span class='sofa'>地板</span>";?>
        <?php if(!defined('DOING_AJAX_COMMENT')): ?>
          <a rel="<?php comment_ID() ?>" class="reply icon" href="#comment-<?php comment_ID() ?>" title="<?php _e('Reply this comment',YHL); ?>"><?php _e('Reply', YHL); ?></a>
          <a rel="nofollow" class="quote icon" href="#comment-<?php comment_ID() ?>" title="<?php _e('Quote this comment',YHL); ?>"><?php _e('Quote', YHL); ?></a>
        <?php endif; ?>
        <?php if(philnaCanModifyComment(get_comment_ID()) || defined('DOING_AJAX_COMMENT')): ?>
          <a rel="nofollow" class="modify icon" href="#comment-<?php comment_ID() ?>" title="<?php _e('Your can modify your comment in 30 min',YHL); ?>"><?php _e('Modify', YHL); ?></a>
        <?php endif; ?>
        <?php if($user_ID) edit_comment_link(__('Edit', YHL)); ?>
      </div>
      <div class="clear"></div>
    </div>
    <div class="comment_content">
      <?php if( ! $comment->comment_approved ): ?>
      <p class="alert"><strong><?php _e('Your comment is awaiting moderation.', YHL); ?></strong></p>
      <?php endif; ?>
      <?php comment_text(); ?>
      <div class="clear"></div>
    </div>
  </div>
  <div class="clear"></div>

<?php

}

/**
 * list pings
 *
 * @param unknown_type $comment
 * @param unknown_type $args
 * @param unknown_type $depth
 * @return unknown_type
 */
function philnaPings($comment, $args = array(), $depth = 1){
  global $user_ID;
  static $index = 1;
  $GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
  <div class="pings_head">
    <span class="time left"><?php comment_time(__('M jS, Y @ H:i', YHL)); echo ' | #', $index; ?></span>
    <?php if($user_ID) edit_comment_link(__('Edit', YHL), '<span class="action right">', '</span>'); ?>
    <div class="clear"></div>
  </div>
  <span class="pingtype">
    <?php comment_type( __('Comment: ', YHL), __('Trackback: ', YHL), __('Pingback: ', YHL) ); ?>
  </span>
  <a href="<?php comment_author_url() ?>">
    <?php comment_author(); ?>
  </a>
</li>
<?php
  $index++;
}


/**
 * Check if the user can modify the comment
 * @param unknown_type $comment
 * @return unknown_type
 */
function philnaCanModifyComment($id, $ajax = false){
  global $user_ID;
  if($user_ID){
    return false;
  }
  $key = md5($id.COOKIEHASH);
  $updateCookie = isset($_COOKIE['comment_author_can_update_id_'.$key.'_'. COOKIEHASH]) ? $_COOKIE['comment_author_can_update_id_'.$key.'_'. COOKIEHASH] : null;
  if( $updateCookie != md5($id)){
    if($ajax){
      fail(__('Time is up! or you cant\'t edit this comment.', YHL));
    }else{
      return false;
    }
  }else{
    return true;
  }
}

/**
 * welcome message
 * @param unknown_type $email
 * @return void|string
 */
function philnaWelcomeCommentAuthorBack($email = ''){
  if(empty($email)){
    return;
  }
  global $wpdb;

  $past_30days = gmdate('Y-m-d H:i:s',((time()-(24*60*60*30))+(get_option('gmt_offset')*3600)));
  $sql = "SELECT count(comment_author_email) AS times FROM $wpdb->comments
          WHERE comment_approved = '1'
          AND comment_author_email = '$email'
          AND comment_date >= '$past_30days'";
  $times = $wpdb->get_results($sql);
  $times = ($times[0]->times) ? $times[0]->times : 0;
  $t = ($times > 1) ? '次' : '次';
  $message = $times ? sprintf(__('You comment <code>%1$s</code> %2$s in the past 30 days. Thank you.', YHL), $times, $t) : 'It seems that you have a long time did\'t commet in my blog. Do you want\'t say something this time?';

  return $message;
}
