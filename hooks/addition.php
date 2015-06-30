<?php

// load jquery
function philnaLoadJQuery(){
  wp_enqueue_script('jquery-core');
}
add_action('wp_enqueue_scripts', 'philnaLoadJQuery');

// load styles
function philnaLoadStyle(){
  wp_enqueue_style('philnaStyle', get_stylesheet_uri(), array(), NULL);
}
add_action('wp_enqueue_scripts', 'philnaLoadStyle');


// fallback to wp_page_menu to show home button
add_filter('wp_page_menu_args', 'philna_page_menu_args');
function philna_page_menu_args($args){
  $args['show_home'] = 1;
  return $args;
}

// fallback to wp_page_menu to use wp_nav_menu container_class
add_filter('wp_nav_menu_args', 'philna_nav_menu_args');
function philna_nav_menu_args($args){
  $args['menu_class'] = $args['container_class'];
  return $args;
}

