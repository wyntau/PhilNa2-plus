<?php
/**
 * if class exists 'tidy'
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**
 * if class exists 'tidy' just do tidy HTML
 */
function philnaTidyHTML(){

  if(is_feed()) return;

  if(class_exists('tidy')){
    ob_start('philnaPHPTidyClass');
  }
}
add_action('template_redirect', 'philnaTidyHTML');

/**
 * tidy html output
 * @param unknown_type $html
 * @return unknown_type
 */
function philnaPHPTidyClass($html){
  $config = array(
    'indent'         => false,
    'output-xhtml'   => true,
    'wrap'           => 99999,
  );

  $tidy = new tidy();
  $tidy->parseString($html, $config, 'utf8');
  $tidy->cleanRepair();
  return $tidy;
}
