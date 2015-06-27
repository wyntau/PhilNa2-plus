<?php

if ( !isset( $wpsmiliestrans ) ) {
  $wpsmiliestrans = array(
    ':mrgreen:'  => '11.gif',
    ':no:'       => '1.gif',
    ':twisted:'  => '19.gif',
    ':shut:'     => '23.gif',
    ':eat:'      => '3.gif',
    ':arrow:'    => '16.gif',
    ':shock:'    => '7.gif',
    ':surprise:' => '26.gif',
    ':smile:'    => '33.gif',
    ':???:'      => '5.gif',
    ':cool:'     => '10.gif',
    ':cold:'     => '14.gif',
    ':evil:'     => '2.gif',
    ':grin:'     => '4.gif',
    ':idea:'     => '9.gif',
    ':han:'      => '6.gif',
    ':oops:'     => '25.gif',
    ':mask:'     => '27.gif',
    ':sigh:'     => '15.gif',
    ':razz:'     => '17.gif',
    ':roll:'     => '21.gif',
    ':cry:'      => '28.gif',
    ':zzz:'      => '29.gif',
    ':eek:'      => '18.gif',
    ':love:'     => '20.gif',
    ':sex:'      => '13.gif',
    ':jiong:'    => '8.gif',
    ':lol:'      => '24.gif',
    ':mad:'      => '31.gif',
    ':ool:'      => '32.gif',
    ':sad:'      => '30.gif',
  );
}

function custom_smilies_src($src, $img){
    return get_bloginfo('template_directory').'/images/smilies/' . $img;
}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);
