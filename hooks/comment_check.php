<?php

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
add_action('pre_comment_on_post', 'philnaCheckEmailAndName');
