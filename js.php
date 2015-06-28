<?php
/**
 * js loader
 *
 */

if ( extension_loaded('zlib') && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ) {
  ob_start('ob_gzhandler');
} else {
  ob_start();
}
header("Cache-Control: max-age=3600, public");
header("Pragma: cache");
header( "Vary: Accept-Encoding" ); // Handle proxies
header('Content-Type: text/javascript; charset: UTF-8');

$head = <<<EOF
/*
Copyright (C) 2009 - 2010 yinheli All rights reserved.
Author: yinheli
Author URI: http://philna.com/
*/\n\n
EOF;

$jsFiles = array(
  'easing',
  'jquery.scrollTo',
  'jquery.lazyload',
  'philna2',
  'SayMeMod',
  'Myjs'
);

$jsDir = dirname(__FILE__) . '/js';

echo $head;

foreach ($jsFiles as $file) {
  $devfile = $jsDir.'/dev/'.$file.'.js';
  $minfile = $jsDir.'/'.$file.'.js';
  if (file_exists($minfile)) {
    include_once $minfile;
  } else if (file_exists($devfile)) {
    include_once $devfile;
  }
}
