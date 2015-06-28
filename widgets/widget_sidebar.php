<?php

/* 注册边侧栏 */
if( function_exists('register_sidebar')){
  //1 top widget
  register_sidebar(array(
    'id' => 'sidebar-1',
    'name' => __('First widget',YHL),
    'description'=>__('This widget will show in top of the sidebar.', YHL),
    'before_widget' => '<div id="%1$s" class="widget box icon content">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  //2 left widget
  register_sidebar(array(
    'id' => 'sidebar-2',
    'name' => __('Second widget',YHL),
    'description'=>__('This widget will show in bottom of the sidebar. Replace "Meta" widget', YHL),
    'before_widget' => '<div id="%1$s" class="widget box icon content">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  //3 right widget
  register_sidebar(array(
    'id' => 'sidebar-3',
    'name' => __('Third widget',YHL),
    'description'=>__('This widget will show in bottom of the sidebar. Replace "Meta" widget', YHL),
    'before_widget' => '<div id="%1$s" class="widget box icon content">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  //4 bottom widget
  register_sidebar(array(
    'id' => 'sidebar-4',
    'name' => __('Fourth widget',YHL),
    'description'=>__('This widget will show in bottom of the sidebar. Replace "Meta" widget', YHL),
    'before_widget' => '<div id="%1$s" class="widget box icon content">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}
