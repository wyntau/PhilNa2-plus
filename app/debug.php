<?php
/**
 * debug
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

if(defined('PHILNA_DEBUG') && constant('PHILNA_DEBUG')){
  set_error_handler('philnaErrorHandler', E_ALL);
  $GLOBALS['philnaPHPErrorMessage'] = array();
}


/**
 * @param int $errno contains the level of the error raised, as an integer.
 * @param string $errstr contains the error message, as a string.
 * @param string $errfile which contains the filename that the error was raised in, as a string.
 * @param int $errline contains the line number the error was raised at, as an integer.
 * @param array $errcontext which is an array that points to the active symbol table at the point the error occurred...
 * @return unknown_type
 */
function philnaErrorHandler($errno, $errstr, $errfile, $errline, $errcontext){

  static $id = 1;
  if(!is_user_logged_in()){
    return;
  }

  switch($errno){
    case E_WARNING : case E_USER_WARNING :
      $type = 'Warning';
      break;
    case E_NOTICE : case E_USER_NOTICE :
      $type = 'Notice';
      break;
    default :
      $type = 'Error';
      break;
  }
  $GLOBALS['philnaPHPErrorMessage'][] = 'ID: '.$id.' '.$type.': '.$errfile.' line: '.$errline.' '.$errstr;
  $id++;
  return;
}

//echo E_NOTICE;

function philnaDisplayPHPErrorMessage(){

  if(is_bot()) {
    return;
  }

  if(isset($GLOBALS['philnaPHPErrorMessage']) && $GLOBALS['philnaPHPErrorMessage']){
    echo '<div class="box content widget alert" style="margin: 0 auto; width: 898px"><h3>PHP errors on this blog</h3><ul>';
    foreach($GLOBALS['philnaPHPErrorMessage'] as $message){
      echo '<li>', $message, '</li>';
    }
    echo '</ul></div>';
  }

}
add_action('wp_footer', 'philnaDisplayPHPErrorMessage', 0);

//trigger_error('test');


/**
 * for local test
 * @param unknown_type $avatar
 * @return unknown_type
 */
function philnaPhoto($avatar){
  preg_match("/src='(.*?)'/i", $avatar, $matches);
  $avatarFileUrl = isset($matches[1]) ? $matches[1] : '';
  $localFileUrl = 'http://localhost/css/images/avatar.jpg';
  return str_replace($avatarFileUrl, $localFileUrl, $avatar);
}
//add_filter('get_avatar', 'philnaPhoto', 100);
