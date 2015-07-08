<?php
/******************************************
 *$cacheswitch为头像缓存开关,
 *然后在wp-content目录建立一个avatar目录,并对目录设置权限777
 *如果不想使用头像缓存的话,请将$cacheswitch设置为0
*****************************************/

add_filter('get_avatar', 'philna_gravatar_cache', 1, 5);
function philna_gravatar_cache($avatar, $id_or_email, $size = '42', $default = '', $alt = ''){

  if(!(bool)$GLOBALS['philnaopt']['gravatar_cache']){
    return $avatar;
  }

  if(!$id_or_email){
    return $avatar;
  }

  $dir = '/wp-content/avatar';
  $dir_full = ABSPATH . $dir;

  if(!file_exists($dir_full) || !is_writable($dir_full)){
    return $avatar;
  }

  $user = false;
  if ( is_numeric( $id_or_email ) ) {
    $id = (int) $id_or_email;
    $user = get_user_by( 'id' , $id );
  } else if ( is_object( $id_or_email ) ) {
    if ( ! empty( $id_or_email->user_id ) ) {
      $id = (int) $id_or_email->user_id;
      $user = get_user_by( 'id' , $id );
    }
  } else {
    $user = get_user_by( 'email', $id_or_email );
  }

  $email = $user->get('user_email');
  $alt = esc_attr( $alt );

  $hash = md5( strtolower( $email ) );

  $path = $dir . '/'. $hash. '.jpg';
  $path_default = $dir . '/default.jpg';

  $path_full = ABSPATH . $path;

  $avatar_url = home_url() . $path;
  $avatar_default = home_url() . $path_default;

  $delta = 24 * 60 * 60 * 14; //設定14天, 單位:秒

  if (empty($default)) {
    $default = $avatar_default;
  }

  if (!is_file($path_full) || (time() - filemtime($path_full)) > $delta){ //當頭像不存在或文件超過14天才更新
    $r = get_option('avatar_rating');
    $gravatar_url = 'http://www.gravatar.com/avatar/' . $hash . '?s=' . $size . '&d=' . urlencode($default) . '&r=' . $r; // 舊服務器 (哪個快就開哪個)

    // php获取头信息可能超时, 所以设置超时时间为2秒
    $max_execution_time = ini_get('max_execution_time');
    ini_set('max_execution_time', 2);
    $headers = @get_headers( $gravatar_url );
    ini_set('max_execution_time', $max_execution_time);
    // 当返回头信息时才进行copy
    if($headers && preg_match("|200|", $headers[0])){
      @copy($gravatar_url, $path_full);
    }

    $avatar_url = esc_attr($gravatar_url); //新頭像 copy 時, 取 gravatar 顯示
  }
  if (is_file($path_full) && filesize($path_full) < 500) {
    @copy($default, $path_full);
  }
  return "<img title='{$alt}' alt='{$alt}' src='{$avatar_url}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
}
