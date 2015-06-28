<?php

// load jquery
function philnaLoadJQuery(){
  wp_enqueue_script('jquery-core');
}
add_action('wp_enqueue_scripts', 'philnaLoadJQuery');

// load utils function
function philnaLoadUtil(){
  $dev = get_template_directory() . '/js/dev/util.js';
  $min = get_template_directory() . '/js/util.js';

  $dev_uri = get_template_directory_uri() . '/js/dev/util.js';
  $min_uri = get_template_directory_uri() . '/js/util.js';

  if(file_exists($min)){
    $to_load = $min_uri;
  }else{
    $to_load = $dev_uri;
  }
  wp_enqueue_script('philnaUtil', $to_load, array('jquery-core'));
}
add_action('wp_enqueue_scripts', 'philnaLoadUtil');

// load styles
function philnaLoadStyle(){
  wp_enqueue_style('philnaStyle', get_stylesheet_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'philnaLoadStyle');
