<?php
function comment_author_link_window() {
global $comment;
$url = get_comment_author_url();
$author = get_comment_author();
if ( empty( $url ) || 'http://' == $url )
$return = $author;
else
$return = "<a href='$url' rel='external nofollow' class='url' target='_blank'>$author</a>";
return $return;
}
add_filter('get_comment_author_link', 'comment_author_link_window');

function add_random_link($items, $args) {
	if($args->theme_location == 'primary') {
	$items .= '<li><a href="'.get_bloginfo('url').'/?random" target="_blank">随便看看</a></li>';
	}
return $items;
}
add_filter('wp_nav_menu_items', 'add_random_link', 10, 2);
