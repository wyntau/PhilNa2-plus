<?php

function comment_author_external() {
  global $comment;
  $url = get_comment_author_url();
  $author = get_comment_author();
  if ( empty( $url ) || 'http://' == $url )
    $return = $author;
  else
    $return = "<a href='$url' rel='external nofollow' class='url' target='_blank'>$author</a>";
  return $return;
}
add_filter('get_comment_author_link', 'comment_author_external');
