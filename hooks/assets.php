<?php

add_action('wp_enqueue_scripts', 'philnaLoadJQuery');
function philnaLoadJQuery(){
  wp_enqueue_script('jquery-core');
}

add_action('wp_enqueue_scripts', 'philna_stylesheet_uri');
function philna_stylesheet_uri(){
  $template_directory = get_template_directory();
  $stylesheet_dir_uri = get_stylesheet_directory_uri();

  if(is_404()){
    $file = $template_directory . '/404.css';
    $stylesheet_uri = $stylesheet_dir_uri . '/404.css';
  }else{
    $file = $template_directory . '/style.css';
    $stylesheet_uri = $stylesheet_dir_uri . '/style.css';
    // for degbug (when debug just rename style.css, this will load style.dev.css
    if(!file_exists($file)){
      $file = $template_directory . 'style.dev.css';
      $stylesheet_uri = $stylesheet_dir_uri . '/style.dev.css';
    }
  }
  // return the link with a version id (timestamp)
  $stylesheet_uri = $stylesheet_uri . '?v=' . date('YmdHi', filemtime($file));
  wp_enqueue_style('philnaStyle', $stylesheet_uri, array(), NULL);
}
