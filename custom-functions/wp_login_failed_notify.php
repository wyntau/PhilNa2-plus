<?php 
/*****************************************************
 函数名称：wp_login_failed_notify v1.0 by DH.huahua.
 函数作用：有错误登录wp后台就会email通知博主
******************************************************/
function wp_login_failed_notify()
{
    date_default_timezone_set('PRC');
    $admin_email = get_bloginfo ('admin_email');
    $to = $admin_email;
	$subject = '你的博客空间登录错误警告';
	$message = '<p>你好！你的博客空间(' . get_option("blogname") . ')有登录错误！</p>' .
	'<p>请确定是您自己的登录失误，以防别人攻击！登录信息如下：</p>' .
	'<p>登录名：' . $_POST['log'] . '<p>' .
	'<p>登录密码：' . $_POST['pwd'] .  '<p>' .
	'<p>登录时间：' . date("Y-m-d H:i:s") .  '<p>' .
	'<p>登录IP：' . $_SERVER['REMOTE_ADDR'] . '<p>';
	$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
	$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
	$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
	wp_mail( $to, $subject, $message, $headers );
}
add_action('wp_login_failed', 'wp_login_failed_notify');
?>
