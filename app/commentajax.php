<?php
/**
 * Ajax comments functions
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**ajax comment page
 * @return unknown_type
 */
function philnaAjaxCommentsPage(){
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
function philnaAjaxComment(){

	// the follow code mostly copyed from wp2.9 (wp-comments-post.php)

	global $wpdb, $user_ID;

	$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;

	$status = $wpdb->get_row( $wpdb->prepare("SELECT post_status, comment_status FROM $wpdb->posts WHERE ID = %d", $comment_post_ID) );

	if ( empty($status->comment_status) ) {
		//do_action('comment_id_not_found', $comment_post_ID);
		//exit;
		fail(__('Error post ID', YHL));
	} elseif ( !comments_open($comment_post_ID) ) {
		//do_action('comment_closed', $comment_post_ID);
		//wp_die( __('Sorry, comments are closed for this item.') );
		fail(__('Sorry, comments are closed for this item.', YHL));
	} elseif ( in_array($status->post_status, array('draft', 'pending') ) ) {
		//do_action('comment_on_draft', $comment_post_ID);
		//exit;
		fail(__('The post is in draft or pending', YHL));
	} elseif ( 'trash' == $status->post_status ) {
		//do_action('comment_on_trash', $comment_post_ID);
		//exit;
		fail(__('The post is in trash box', YHL));
	} else {
		do_action('pre_comment_on_post', $comment_post_ID);
	}

	$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
	$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
	$comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
	$comment_content      = ( isset($_POST['w']) ) ? trim($_POST['w']) : trim($_POST['comment']);

	$update_comment_ID = ( isset($_POST['update_comment_ID']) ) ?  (int)$_POST['update_comment_ID'] : 0; //取得是否为更新评论

	// If the user is logged in
	$user = wp_get_current_user();
	if ( $user->ID ) {
		if ( empty( $user->display_name ) )
			$user->display_name=$user->user_login;
		$comment_author       = $wpdb->escape($user->display_name);
		$comment_author_email = $wpdb->escape($user->user_email);
		$comment_author_url   = $wpdb->escape($user->user_url);
		if ( current_user_can('unfiltered_html') ) {
			if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
				kses_remove_filters(); // start with a clean slate
				kses_init_filters(); // set up the filters
			}
		}
	} else {
		if ( get_option('comment_registration') || 'private' == $status->post_status )
			//wp_die( __('Sorry, you must be logged in to post a comment.') );
			fail(__('Sorry, you must be logged in to post a comment.', YHL));

		// PhilNa check email and name
		do_action('philnaCheckEmailAndName', $comment_author, $comment_author_email);
	}

	$comment_type = '';

	if ( get_option('require_name_email') && !$user->ID ) {
		if ( 6 > strlen($comment_author_email) || '' == $comment_author )
			//wp_die( __('Error: please fill the required fields (name, email).') );
			fail(__('Error: please fill the required fields (name, email).', YHL));
		elseif ( !is_email($comment_author_email))
			//wp_die( __('Error: please enter a valid email address.') );
			fail(__('Error: please enter a valid email address.', YHL));
	}

	if ( '' == $comment_content )
		//wp_die( __('Error: please type a comment.') );
		fail(__('Error: please type a comment.', YHL));

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

		$comment = get_comment($comment_id);
		if ( !$user->ID ) {
			$comment_cookie_lifetime = apply_filters('comment_cookie_lifetime', 30000000);
			setcookie('comment_author_' . COOKIEHASH, $comment->comment_author, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
			setcookie('comment_author_email_' . COOKIEHASH, $comment->comment_author_email, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
			setcookie('comment_author_url_' . COOKIEHASH, esc_url($comment->comment_author_url), time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
		}

		// set cookie for update this comment
		$key = md5($comment_id.COOKIEHASH);
		setcookie('comment_author_can_update_id_'.$key.'_'. COOKIEHASH, md5($comment_id), time() + (60 * 30), COOKIEPATH, COOKIE_DOMAIN);
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

/**
 * if comment too quickly
 * @return unknown_type
 */
function philnaCommenTooQuickly(){
	status_header('403');
}
add_action('comment_flood_trigger', 'philnaCommenTooQuickly');
