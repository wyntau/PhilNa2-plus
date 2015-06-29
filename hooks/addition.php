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
