<?php
/**
 * functions
 */

// no direct access
defined('ABSPATH') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/*
Note:
  加载顺序:
  1.读取主题配置(部分自定义函数要使用)
  2.加载自定义函数
  3.Ajax判断(自动调用已定义的函数)
*/
// debug all
error_reporting(E_ALL);

// hide error (note: 开启隐藏所有错误时, 一旦出现严重错误将导致'白屏')
// error_reporting(0);

define('YHL', 'philna2');
define('PHILNA', 'philna2');

// debug - if true the errors will display below footer when admin login
define('PHILNA_DEBUG', false);

// admin dir
define('PHILNA_ADMIN', TEMPLATEPATH . '/admin');
// app dir
define('PHILNA_APP', TEMPLATEPATH . '/app');
// base dir
define('PHILNA_BASE', TEMPLATEPATH . '/base');
// functions dir
define('PHILNA_FUNC', TEMPLATEPATH . '/functions');
// langeage dir
define('PHILNA_LANG', TEMPLATEPATH . '/languages');
// widget dir
define('PHILNA_WIDGET', TEMPLATEPATH . '/widgets');

//激活菜单项
if ( function_exists('register_nav_menus') ) {
  register_nav_menus(array('primary' => '头部导航栏'));
}

// Load theme textdomain
load_theme_textdomain(YHL, PHILNA_LANG);

// befor load my function we load the base
// functions for other functions
include_once PHILNA_BASE . '/options.php';
include_once PHILNA_BASE . '/format.php';
include_once PHILNA_BASE . '/base.php';
include_once PHILNA_BASE . '/json.php';
include_once PHILNA_BASE . '/ajax.php';

// init philna options
$GLOBALS['philnaopt'] = PhilNaGetOpt::getInstance();

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

// include functions by yinheli
philnaIncludeAll( PHILNA_APP );

// include functions by user
philnaIncludeAll( PHILNA_FUNC );

// include functions by user
philnaIncludeAll( PHILNA_WIDGET );

// admin panel
!is_admin() || include_once PHILNA_ADMIN . '/admin.php';

do_action('PhilNaReady');
