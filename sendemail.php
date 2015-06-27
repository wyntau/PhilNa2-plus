<?php
/**
 * 联系页面, 邮件发送.
 */

//只可以用post方法
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('Allow: POST');
	header("HTTP/1.1 405 Method Not Allowed");
	header("Content-type: text/plain");
    exit;
}

// Sets up the WordPress Environment
require_once(preg_replace( '/wp-content.*/', '', __FILE__ ).'wp-load.php');

session_start();

$adminEmail = get_option('admin_email');

if(!$adminEmail){
	fail(__('Admin\'s E_mail address is empty!', YHL));
}

// get post data
$name = isset($_POST['name']) ? trim($_POST['name']) : null;
$from = isset($_POST['from']) ? trim($_POST['from']) : null;
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : null;
$vcode = isset($_POST['vcode']) ? trim($_POST['vcode']) : null;
$content = isset($_POST['content']) ? stripslashes(trim($_POST['content'])) : null;

// check post data
if(!$name || !$from || !$subject){
	fail(__('Error: please fill the required fields (name, email, subject)', YHL));
}

if(!is_email($from)){
	fail(__('Error: please enter a valid email address.', YHL));
}

if($_SESSION['vcode'] !== $vcode) {
	fail(__('Verification Code error', YHL));
}

if(!$content){
	fail(__('Please type the content', YHL));
}

// format $content to HTML by the 'the_content' filter
$content = apply_filters('the_content', $content);

// data are ok? format the data and send
if(!class_exists('PHPMailer')){
	include_once ABSPATH . WPINC . '/class-phpmailer.php';
}

$mail = new PHPMailer();

// Empty out the values that may be set
$mail->ClearAddresses();
$mail->ClearAllRecipients();
$mail->ClearAttachments();
$mail->ClearBCCs();
$mail->ClearCCs();
$mail->ClearCustomHeaders();
$mail->ClearReplyTos();

/*// if you can't send email, please try 'smtp' method. Here is gmail for example.
$mail->Mailer = 'smtp';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = 'yinheli@gmail.com'; // SMTP 用户名 (SMTP username)
$mail->Password = 'password'; // 密码 (SMTP password)
*/

$mail->CharSet = get_option('blog_charset');
$mail->IsHTML(true);
$mail->From = $from;
$mail->FromName = $name;
$mail->Subject = $subject;
$mail->AddAddress($adminEmail);
// send a copy to ..
$mail->AddCC($from, $name);
$mail->Body = apply_filters('the_content', $content);

// do send
$result = @$mail->Send();

unset($_POST['vcode']);

if($result){
	$response =  sprintf(__('Congratulations, %1$s. I\'ve received your email. I\'ll be in touch as soon as I possibly can!',YHL),$name);
	if(defined('DOING_AJAX')){
		echo '<p class="success">', $response, '</p>';
	}else{
		wp_die($response, __('Success',YHL));
	}
}else{
	fail(__('Sorry! An error occurred. You may try again or other way to contact me.', YHL));
}
