<?php
/**
 * base
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**
 * include all PHP script
 * @param string $dir
 * @return unknown_type
 */
function philnaIncludeAll($dir){
  $dir = realpath($dir);
  if($dir){
    $files = scandir($dir);
    sort($files);
    foreach($files as $file){
      if($file == '.' || $file == '..'){
        continue;
      }elseif(preg_match('/\.php$/i', $file)){
        include_once $dir.'/'.$file;
      }
    }
  }
}

/**
 * 通过USER_Agent判断是否为机器人.
 *
 * @return Boolean
 */
function is_bot(){
  $bots = array(
    'Google Bot1' => 'googlebot',
    'Google Bot2' => 'google',
    'MSN' => 'msnbot',
    'Alex' => 'ia_archiver',
    'Lycos' => 'lycos',
    'Ask Jeeves' => 'jeeves',
    'Altavista' => 'scooter',
    'AllTheWeb' => 'fast-webcrawler',
    'Inktomi' => 'slurp@inktomi',
    'Turnitin.com' => 'turnitinbot',
    'Technorati' => 'technorati',
    'Yahoo' => 'yahoo',
    'Findexa' => 'findexa',
    'NextLinks' => 'findlinks',
    'Gais' => 'gaisbo',
    'WiseNut' => 'zyborg',
    'WhoisSource' => 'surveybot',
    'Bloglines' => 'bloglines',
    'BlogSearch' => 'blogsearch',
    'PubSub' => 'pubsub',
    'Syndic8' => 'syndic8',
    'RadioUserland' => 'userland',
    'Gigabot' => 'gigabot',
    'Become.com' => 'become.com',
    'Bot'=>'bot',
    'Spider'=>'spider',
    'yinheli_for_test'=>'dFirefox'
  );
  $useragent = $_SERVER['HTTP_USER_AGENT'];
  foreach ($bots as $name => $lookfor) {
    if (stristr($useragent, $lookfor) !== false) {
      return true;
      break;
    }
  }
}

/**
 * 错误泡泡
 *
 * 用于抛出错误
 * 实现$s的多变
 * 摘自著名主题 k2
 * 修改了参数类型,更方便使用!
 *
 * @since 1.0
 */
function fail($s) {
  if(!defined('DOING_AJAX')){
    wp_die($s, 'PhilNa Error');
    return;
  }
  header('HTTP/1.0 403 Forbidden');
  header('Content-Type: text/plain');
  if(is_string($s)){
    die($s);
  }else{
    $s;
    die;
  }
}

// new feature of WordPress - post thumbnails
if (function_exists('add_theme_support')) {
  add_theme_support('post-thumbnails');
}

//激活菜单项
if ( function_exists('register_nav_menus') ) {
  register_nav_menus(array('primary' => '头部导航栏'));
}
