<?php

/**
 * if comment too quickly
 * @return unknown_type
 */
function philnaCommenTooQuickly(){
  status_header('403');
}
add_action('comment_flood_trigger', 'philnaCommenTooQuickly');
