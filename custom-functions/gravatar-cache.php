<?php
/******************************************
 *$cacheswitch为头像缓存开关,
 *如果想要使用头像缓存的话,请将$cacheswitch设为1
 *然后在wp-content目录建立一个avatar目录,并对目录设置权限777
 *如果不想使用头像缓存的话,请将$cacheswitch设置为0
*****************************************/
function my_avatar( $email, $size = '42', $default = '', $alt = '' ) {
//$cacheswitch=1;//1为使用头像缓存
$cacheavatar=trim($GLOBALS['philnaopt']['cacheavatar']);
if($cacheavatar){
  $alt = esc_attr( $alt );
  $f = md5( strtolower( $email ) );
  $w = WP_CONTENT_URL;//get_bloginfo('wpurl'); // 如果想放在 wp-content 路徑之下, 改為 $w = WP_CONTENT_URL;
  $a = $w. '/avatar/'. $f. '.jpg';
  $e = WP_CONTENT_DIR. '/avatar/'. $f. '.jpg';//ABSPATH. 'avatar/'. $f. '.jpg'; // 如果想放在 wp-content 路徑之下, 改為 $e = WP_CONTENT_DIR. '/avatar/'. $f. '.jpg';
  $t = 1209600; //設定14天, 單位:秒
  if ( empty($default) ) $default = $w. '/avatar/default.jpg';
  if ( !is_file($e) || (time() - filemtime($e)) > $t ){ //當頭像不存在或文件超過14天才更新
    $r = get_option('avatar_rating');
    //$g = sprintf( "http://%d.gravatar.com", ( hexdec( $f{0} ) % 2 ) ). '/avatar/'. $f. '?s='. $size. '&d='. $default. '&r='. $r; // wp 3.0 的服務器
    $g = 'http://www.gravatar.com/avatar/'. $f. '?s='. $size. '&d='. $default. '&r='. $r; // 舊服務器 (哪個快就開哪個)
    copy($g, $e); $a = esc_attr($g); //新頭像 copy 時, 取 gravatar 顯示
  }
  if (filesize($e) < 500) copy($default, $e);
  return "<img title='{$alt}' alt='{$alt}' src='{$a}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
}
else{
  return get_avatar($email, $size);
  }
}
