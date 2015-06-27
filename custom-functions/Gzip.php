<?php
/**
 * HTTP Gzip
 * http://kan.willin.org
 */

/* HTTP Gzip */
$host = $_SERVER['HTTP_HOST'];
if ( !strstr($host, '192.168') && !strstr($host, '127.0.0') && !stristr($host, 'localhost') ) { // 本地調試不用
function wp_gzip() {
  // Don't use on Admin HTML editor
  if ( strstr($_SERVER['REQUEST_URI'], '/js/tinymce') )
    return false;
  // Can't use zlib.output_compression and ob_gzhandler at the same time
  if ( ( ini_get('zlib.output_compression') == 'On' || ini_get('zlib.output_compression_level') > 0 ) || ini_get('output_handler') == 'ob_gzhandler' )
    return false;
  // Load HTTP Compression if correct extension is loaded
  if (extension_loaded('zlib') && !ob_start('ob_gzhandler'))
    ob_start();
}
add_action('init', 'wp_gzip');
}
// -- END ----------------------------------------
