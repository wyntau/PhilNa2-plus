<?php

function add_random_link($items, $args) {
  if($args->theme_location == 'primary') {
    $items .= '
    <li>
      <a href="'.get_bloginfo('url').'/?random" target="_blank">随便看看</a>
    </li>';
  }
  return $items;
}
add_filter('wp_nav_menu_items', 'add_random_link', 10, 2);
