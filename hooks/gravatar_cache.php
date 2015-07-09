<?php
/******************************************
 *$cacheswitch为头像缓存开关,
 *然后在wp-content目录建立一个avatar目录,并对目录设置权限777
 *如果不想使用头像缓存的话,请将$cacheswitch设置为0
*****************************************/

add_filter('get_avatar', 'philna_gravatar_cache', 1, 5);
function philna_gravatar_cache($avatar, $id_or_email, $size = '', $default = '', $alt = ''){

  // 如果不使用缓存, 则直接返回
  if(!(bool)$GLOBALS['philnaopt']['gravatar_cache']){
    return $avatar;
  }

  // 如果不存在, id 或者email, 返回
  if(!$id_or_email){
    return $avatar;
  }

  // 传入的可能是id, 也可能是email
  if(filter_var($id_or_email, FILTER_VALIDATE_EMAIL)){
    $email = $id_or_email;
  }else if( is_numeric( $id_or_email ) ) {
    $id = (int) $id_or_email;
    $user = get_user_by( 'id' , $id );
    if($user){
      $email = $user->get('user_email');
    }
  } else if ( is_object( $id_or_email ) ) {
    if ( ! empty( $id_or_email->user_id ) ) {
      $id = (int) $id_or_email->user_id;
      $user = get_user_by( 'id' , $id );
      if($user){
        $email = $user->get('user_email');
      }
    }
  }
  // 检查完毕后, 如果email不存在, 则直接返回
  if(!$email){
    return $avatar;
  }

  $dir_path = '/wp-content/avatar';
  $dir_path_full = ABSPATH . $dir_path;

  // 如果目录不存在, 则返回
  if(!file_exists($dir_path_full) || !is_writable($dir_path_full)){
    return $avatar;
  }

  $alt = esc_attr( $alt );

  $hash = md5( strtolower( $email ) );

  $avatar_path = $dir_path . '/'. $hash . '_' .$size . '.jpg';
  $avatar_path_full = ABSPATH . $avatar_path;
  $avatar_url = home_url() . $avatar_path;

  // 缓存头像7天, 单位秒
  $delta = 24 * 60 * 60 * 7;

  //當頭像不存在或文件超過7天才更新
  if (!is_file($avatar_path_full) || (time() - filemtime($avatar_path_full)) > $delta){

    $gravatar_block = $dir_path_full . '/.gravatar_block';
    // 每隔一天检查一次gravatar服务是否可用, 单位秒
    $gravatar_block_check_interval = 24 * 60 * 60 * 1;
    // have .gravatar_block file, and is created rencently
    // so the Gravatar service is not available in this wordpress server
    if(is_file($gravatar_block) && (time() - filemtime($gravatar_block) <= $gravatar_block_check_interval)){
      return $avatar;
    }

    // set default
    $avatar_default_path = $dir_path . '/default.jpg';
    $avatar_default_path_full = ABSPATH . $avatar_default_path;
    $avatar_default_url = home_url() . $avatar_default_path;

    $avatar_rating = get_option('avatar_rating');

    if (empty($default) && is_file($avatar_default_path_full)) {
      $default = $avatar_default_url;
    }else{
      $default = get_option('avatar_default');
    }

    if(is_ssl()){
      $gravatar_host = 'https://secure.gravatar.com';
    }else{
      $gravatar_host = sprintf( "http://%d.gravatar.com", (hexdec($hash{0}) % 2) );
    }

    $gravatar_url = $gravatar_host . '/avatar/' . $hash . '?s=' . $size . '&d=' . urlencode($default) . '&r=' . $avatar_rating; // 舊服務器 (哪個快就開哪個)

    // php获取头信息可能超时, 所以设置超时时间为2秒
    $stream_context = stream_context_create(array(
      'http' => array(
        'timeout' => 2
        )
    ));
    $res = @copy($gravatar_url, $avatar_path_full, $stream_context);
    if(!$res){
      $fp = fopen($gravatar_block, 'w');
      fwrite($fp, time());
    }

    $avatar_url = esc_attr($gravatar_url); //新頭像 copy 時, 取 gravatar 顯示
  }
  return "<img title=\"{$alt}\" alt=\"{$alt}\" src=\"{$avatar_url}\" class=\"avatar avatar-{$size} photo\" height=\"{$size}\" width=\"{$size}\" />";
}
