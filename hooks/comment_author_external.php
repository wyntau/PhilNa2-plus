<?php

function philna_comment_author_link_external() {
  global $comment;
  $url = get_comment_author_url();
  $author = get_comment_author();
  if ( empty( $url ) || 'http://' == $url )
    $return = $author;
  else
    $return = "<a href='$url' rel='external nofollow' class='url' target='_blank'>$author</a>";
  return $return;
}
add_filter('get_comment_author_link', 'philna_comment_author_link_external');
