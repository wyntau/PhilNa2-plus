<?php
/**
 * password hint
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

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

/**
 * 在后台添加有关 密码提示 的相关信息
 *
 * @see do_action('submitpost_box')
 * @see do_action('submitpage_box')
 * @return null
 */
function philnaPasswordHintForAdmin(){
	$h3 = __('How to set a password hint.',YHL);
	$words = __('If your are posting a password protected post article. Please add a new <a href="#postcustom">custom field</a> width the name \'password_hint\'',YHL);
	$html=<<<END
<div class="stuffbox meta-box-sortables ui-sortable">
	<h3>$h3</h3>
	<div class="inside">
		<p>$words</p>
	</div>
</div>
END;
	echo $html;
}
add_action('submitpost_box', 'philnaPasswordHintForAdmin');
add_action('submitpage_box', 'philnaPasswordHintForAdmin');
