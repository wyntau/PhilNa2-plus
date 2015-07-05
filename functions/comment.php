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
    <a rel="nofollow" class="reply" href="#comment-<?php comment_ID() ?>" title="回复这个南瓜?"><?php echo get_avatar($comment->comment_author_email, 30); ?></a>
<?php handsome_beauty($comment->comment_author_email);?>
  </div>
  <div class="comment_body left">
    <div class="comment_head clearfix">
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
    </div>
    <div class="comment_content clearfix">
      <?php if( ! $comment->comment_approved ): ?>
      <p class="alert"><strong><?php _e('Your comment is awaiting moderation.', YHL); ?></strong></p>
      <?php endif; ?>
      <?php comment_text(); ?>
    </div>
  </div>
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
  <div class="pings_head clearfix">
    <span class="time left"><?php comment_time(__('M jS, Y @ H:i', YHL)); echo ' | #', $index; ?></span>
    <?php if($user_ID) edit_comment_link(__('Edit', YHL), '<span class="action right">', '</span>'); ?>
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

/**ajax comment page
 * @return unknown_type
 */
function philnaAjaxGetCommentsPage(){
  global $post,$wp_query, $wp_rewrite;
  $postid = isset($_GET['postid']) ? $_GET['postid'] : null;
  $pageid = isset($_GET['page']) ? $_GET['page'] : null;
  if(!$postid || !$pageid){
    fail(__('Error post id or comment page id.', YHL));
  }
  // get comments
  $comments = get_comments('status=approve&post_id='.$postid);

  $post = get_post($postid);

  if(!$comments){
    fail(__('Error! can\'t find the comments', YHL));
  }

  if( 'desc' != get_option('comment_order') ){
    $comments = array_reverse($comments);
  }

  // set as singular (is_single || is_page || is_attachment)
  $wp_query->is_singular = true;

  // base url of page links
  $baseLink = '';
  if ($wp_rewrite->using_permalinks()) {
    $baseLink = '&base=' . user_trailingslashit(get_permalink($postid) . 'comment-page-%#%', 'commentpaged');
  }

  // response
  wp_list_comments('callback=philnaComments&type=comment&page=' . $pageid . '&per_page=' . get_option('comments_per_page'), $comments);
  echo '<!--PHILNA-AJAX-COMMENT-PAGE-->';
  echo '<span class="pages icon">评论翻页</span><span id="cpager">';
  paginate_comments_links('current=' . $pageid . $baseLink);
  echo '</span>';
  die;
}

/**
 * ajax comment tip
 * @return unknown_type
 */
function philnaAjaxGetComment(){
  $id = isset($_GET['id']) ? trim($_GET['id']) : null;
  if(!$id){
    fail(__('Error comment id', YHL));
  }
  $comment = get_comment($id);

  if(!$comment){
    fail(sprintf(__('Whoops! I am sorry I can\'t find the comment width id  %1$s',YHL), $id));
  }

  philnaComments($comment);
  echo '</li>';
}

/**
 * ajax update and new comment
 * @return unknown_type
 */
function philnaAjaxPostComment(){

  // the follow code mostly copyed from wp4.2 (wp-comments-post.php)

  global $wpdb, $user_ID;

  nocache_headers();

  $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;

  $post = get_post($comment_post_ID);

  if ( empty( $post->comment_status ) ) {
    /**
     * Fires when a comment is attempted on a post that does not exist.
     *
     * @since 1.5.0
     *
     * @param int $comment_post_ID Post ID.
     */
    do_action( 'comment_id_not_found', $comment_post_ID );
    exit;
    fail(__('Error post ID', YHL));
  }

  // get_post_status() will get the parent status for attachments.
  $status = get_post_status($post);

  $status_obj = get_post_status_object($status);

  if ( ! comments_open( $comment_post_ID ) ) {
    /**
     * Fires when a comment is attempted on a post that has comments closed.
     *
     * @since 1.5.0
     *
     * @param int $comment_post_ID Post ID.
     */
    do_action( 'comment_closed', $comment_post_ID );
    // wp_die( __( 'Sorry, comments are closed for this item.' ), 403 );
    fail(__('Sorry, comments are closed for this item.', YHL));
  }elseif ( 'trash' == $status ) {
    /**
     * Fires when a comment is attempted on a trashed post.
     *
     * @since 2.9.0
     *
     * @param int $comment_post_ID Post ID.
     */
    do_action( 'comment_on_trash', $comment_post_ID );
    // exit;
    fail(__('The post is in trash box', YHL));
  }elseif ( ! $status_obj->public && ! $status_obj->private ) {
    /**
     * Fires when a comment is attempted on a post in draft mode.
     *
     * @since 1.5.1
     *
     * @param int $comment_post_ID Post ID.
     */
    do_action( 'comment_on_draft', $comment_post_ID );
    // exit;
    fail(__('The post is in draft or pending', YHL));
  }elseif ( post_password_required( $comment_post_ID ) ) {
    /**
     * Fires when a comment is attempted on a password-protected post.
     *
     * @since 2.9.0
     *
     * @param int $comment_post_ID Post ID.
     */
    do_action( 'comment_on_password_protected', $comment_post_ID );
    // exit;
    fail(__('The post is a password-protected post', YHL));
  }else {
    /**
     * Fires before a comment is posted.
     *
     * @since 2.8.0
     *
     * @param int $comment_post_ID Post ID.
     */
    do_action( 'pre_comment_on_post', $comment_post_ID );
  }

  $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
  $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
  $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
  $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;

  $update_comment_ID = ( isset($_POST['update_comment_ID']) ) ?  (int)$_POST['update_comment_ID'] : 0; //取得是否为更新评论

  // If the user is logged in
  $user = wp_get_current_user();
  if ( $user->exists() ) {
    if ( empty( $user->display_name ) )
      $user->display_name=$user->user_login;
    $comment_author       = wp_slash($user->display_name);
    $comment_author_email = wp_slash($user->user_email);
    $comment_author_url   = wp_slash($user->user_url);
    if ( current_user_can( 'unfiltered_html' ) ) {
      if ( ! isset( $_POST['_wp_unfiltered_html_comment'] )
        || ! wp_verify_nonce( $_POST['_wp_unfiltered_html_comment'], 'unfiltered-html-comment_' . $comment_post_ID )
      ) {
        kses_remove_filters(); // start with a clean slate
        kses_init_filters(); // set up the filters
      }
    }
  } else {
    if ( get_option('comment_registration') || 'private' == $status->post_status ){
      //wp_die( __('Sorry, you must be logged in to post a comment.') );
      fail(__('Sorry, you must be logged in to post a comment.', YHL));
    }
  }

  $comment_type = '';

  if ( get_option('require_name_email') && !$user->exists() ) {
    if ( 6 > strlen($comment_author_email) || '' == $comment_author ){
      //wp_die( __('Error: please fill the required fields (name, email).') );
      fail(__('Error: please fill the required fields (name, email).', YHL));
    }else if ( !is_email($comment_author_email)){
      //wp_die( __('Error: please enter a valid email address.') );
      fail(__('Error: please enter a valid email address.', YHL));
    }
  }

  if ( '' == $comment_content ){
    //wp_die( __('Error: please type a comment.') );
    fail(__('Error: please type a comment.', YHL));
  }

  // 增加: 檢查重覆評論功能
  $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
  if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
  $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
  if ( $wpdb->get_var($dupe) ) {
      fail(__('Duplicate comment detected; it looks as though you&#8217;ve already said that!'));
  }

  // 增加: 檢查評論太快功能
  if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
  $time_lastcomment = mysql2date('U', $lasttime, false);
  $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
  $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
  if ( $flood_die ) {
      fail(__('您评论太快了, 请稍等~'));
      // fail(__('You are posting comments too quickly.  Slow down.'));
    }
  }

  $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;

  // if update?
  if($update_comment_ID){

    // check cookie
    philnaCanModifyComment($update_comment_ID, true);

    // check comment
    $comment = get_comment($update_comment_ID);
    if(!$comment){
      fail(__('The comment you are trying to update is\'t here any more', YHL));
    }
    if($comment_content == $comment->comment_content){
      fail(__('Update comment failed or you can\'t comment the same message.',YHL));
    }


    // the update comment data
    $comment_approved = $comment->comment_approved;
    $comment_ID = $update_comment_ID;
    $update_commentdata = compact('comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_ID','comment_approved');

    // do update
    if(wp_update_comment($update_commentdata)){
      $comment = get_comment($comment_ID);
    }else{
      fail(__('Sorry, Update comment failed.',YHL));
    }

    // wait for response

  }else{ // comment a new comment.
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    $comment_id = wp_new_comment( $commentdata );

    if ( ! $comment_id ) {
      // wp_die( __( "<strong>ERROR</strong>: The comment could not be saved. Please try again later." ) );
      fail( __( "Error: The comment could not be saved. Please try again later.", YHL) );
    }

    $comment = get_comment($comment_id);

    /**
     * Perform other actions when comment cookies are set.
     *
     * @since 3.4.0
     *
     * @param object $comment Comment object.
     * @param WP_User $user   User object. The user may not exist.
     */
    do_action( 'set_comment_cookies', $comment, $user );
  }

  defined('DOING_AJAX_COMMENT') || define('DOING_AJAX_COMMENT', true);

  // response
  philnaComments($comment);
  echo '</li>';
}

/**
 * get the comment data format to json
 * @return unknown_type
 */
function philnaModifyComment(){
  $cmid = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  if(!$cmid){
    fail(__('Error comment id', YHL));
  }
  $comment = get_comment($cmid);

  if(!$comment){
    fail(sprintf(__('Whoops! I am sorry I can\'t find the comment width id  %1$s',YHL), $id));
  }

  $data = array(
    'name'=>$comment->comment_author,
    'email'=>$comment->comment_author_email,
    'url'=>$comment->comment_author_url,
    'content'=>$comment->comment_content
  );

  echo philnaJSON($data);
}


add_action('set_comment_cookies', 'philna_set_update_comment_cookie', 20, 2);
function philna_set_update_comment_cookie($comment, $user){
  if ( $user->exists() )
    return;
  // set cookie for update this comment
  $secure = ( 'https' === parse_url( home_url(), PHP_URL_SCHEME ) );
  $key = md5($comment->comment_ID . COOKIEHASH);
  setcookie('comment_author_can_update_id_' . $key . '_' . COOKIEHASH, md5($comment->comment_ID), time() + (60 * 30), COOKIEPATH, COOKIE_DOMAIN, $secure);
}

add_action('pre_comment_on_post', 'philnaCheckEmailAndName');
/**
 * when comment check the comment_author comment_author_email
 * @param unknown_type $comment_author
 * @param unknown_type $comment_author_email
 * @return unknown_type
 */
function philnaCheckEmailAndName(){
  global $wpdb;
  $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
  $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
  if(!$comment_author || !$comment_author_email){
    return;
  }

  $result_set = $wpdb->get_results("SELECT display_name, user_email FROM $wpdb->users WHERE display_name = '" . $comment_author . "' OR user_email = '" . $comment_author_email . "'");
  if ($result_set) {
    if ($result_set[0]->display_name == $comment_author){
      $errorMessage =  __('Error: you are not allowed to use the nickname that you entered.if you are the administrator you hava to login to comment.',YHL);
    }else{
      $errorMessage = __('Error: you are not allowed to use the email that you entered.if you are the administrator you hava to login to comment.',YHL);
    }
    defined('DOING_AJAX') ? fail($errorMessage) : wp_die($errorMessage);
  }
}

add_action('comment_flood_trigger', 'philnaCommenTooQuickly');
/**
 * if comment too quickly
 * @return unknown_type
 */
function philnaCommenTooQuickly(){
  status_header('403');
}
