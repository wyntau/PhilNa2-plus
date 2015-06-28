<?php

/**
 * 创建一个有密码提示的 form
 * @return string
 */
function philnaPasswordHint( $c ){
  global $post, $user_ID, $user_identity;

  $actionLink = get_option('siteurl') . '/wp-pass.php';
  $inputid =  'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
  $btnValue = __('Submit', YHL);

  // get and format hint
  $hint = get_post_meta($post->ID, 'password_hint', true);
  $hint = $hint ? $hint : __('This post is password protected. To view it please enter your password below:',YHL);
  if($user_ID){
    $hint = sprintf(__(' Welcome <strong>%1$s</strong> ! The password is : %2$s ',YHL), $user_identity, $post->post_password);
  }

  $output = <<<EOF
<form action="{$actionLink}" method="post">
  <div class="row">
  <p><label for="{$inputid}">{$hint}</label></p>
  <input id="{$inputid}" class="textfield" name="post_password" type="password" />
  <input class="button hintbtn" name="Submit" type="submit" value="{$btnValue}" />
  </div>
</form>\n
EOF;
  return $output;
}
add_filter('the_password_form', 'philnaPasswordHint');
