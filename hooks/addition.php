<?php

//激活菜单项
if ( function_exists('register_nav_menus') ) {
  register_nav_menus(array('primary' => '头部导航栏'));
}

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

