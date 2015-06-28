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

// Load theme textdomain
load_theme_textdomain(YHL, TEMPLATEPATH . '/languages');


include_once TEMPLATEPATH . '/base/base.php';
foreach(array(
  TEMPLATEPATH . '/base',
  TEMPLATEPATH . '/app',
  TEMPLATEPATH . '/functions',
  TEMPLATEPATH . '/widgets',
  TEMPLATEPATH . '/components'
) as $dir){
  philnaIncludeAll($dir);
}

// admin panel
!is_admin() || include_once TEMPLATEPATH . '/admin/admin.php';

do_action('PhilNaReady');
