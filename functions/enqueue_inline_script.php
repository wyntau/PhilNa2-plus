<?php

/**
 * Enqueue inline Javascript. @see wp_enqueue_script().
 * @source http://wordpress.stackexchange.com/questions/24851/wp-enqueue-inline-script-due-to-dependancies
 *
 * KNOWN BUG: Inline scripts cannot be enqueued before
 *  any inline scripts it depends on, (unless they are
 *  placed in header, and the dependant in footer).
 *
 * @param string      $handle    Identifying name for script
 * @param string      $src       The JavaScript code
 * @param array       $deps      (optional) Array of script names on which this script depends
 * @param bool        $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 *
 * @return null
 */
function enqueue_inline_script( $handle, $js, $deps = array(), $in_footer = false ){
    // Callback for printing inline script.
    $cb = function()use( $handle, $js ){
        // Ensure script is only included once.
        if( wp_script_is( $handle, 'done' ) )
            return;
        // Print script & mark it as included.
        echo "<script type=\"text/javascript\" id=\"js-$handle\">\n$js\n</script>\n";
        global $wp_scripts;
        $wp_scripts->done[] = $handle;
    };
    // (`wp_print_scripts` is called in header and footer, but $cb has re-inclusion protection.)
    $hook = $in_footer ? 'wp_print_footer_scripts' : 'wp_print_scripts';

    // If no dependencies, simply hook into header or footer.
    if( empty($deps)){
        add_action( $hook, $cb );
        return;
    }

    // Delay printing script until all dependencies have been included.
    $cb_maybe = function()use( $deps, $in_footer, $cb, &$cb_maybe ){
        foreach( $deps as &$dep ){
            if( !wp_script_is( $dep, 'done' ) ){
                // Dependencies not included in head, try again in footer.
                if( ! $in_footer ){
                    add_action( 'wp_print_footer_scripts', $cb_maybe, 20 );
                }
                else{
                    // Dependencies were not included in `wp_head` or `wp_footer`.
                }
                return;
            }
        }
        call_user_func( $cb );
    };
    add_action( $hook, $cb_maybe, 0 );
}
