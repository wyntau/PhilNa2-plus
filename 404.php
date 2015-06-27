<?php
/**
 * 404 error page
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

get_header();
?>
<div id="wrap">
  <div id="content">
    <h1><?php _e('Welcome to the 404 page!!!',YHL); ?></h1>
    <div id="content_inner" class="content">
    <p><?php _e('Whoops, sorry, It seems the page you were trying to find on my site isn\'s around anymore.This is probably my fault...but maybe I  just had changed the url or hided the post which I don\'t want to show publicly.',YHL); ?></p>
    <p><?php _e('So I have some advice for you.',YHL); ?></p>
    <ol>
    <li><?php _e('Try to Search. ',YHL)?><span><?php _e('Use google or wordpress search engine.Maybe you can find what you want or somethingelse which is usefull for you too.',YHL)?></span></li>
    <li><?php _e('Contact me. ',YHL)?><span><?php _e('If you really found something wrong please contact me that would be very friendly of you.Thank you!',YHL)?></span></li>
    </ol>
    <div id="searchform" class="box">
    <?php if($GLOBALS['philnaopt']['google_cse'] && $GLOBALS['philnaopt']['google_cse_cx']): ?>
      <div class="s_google">
        <form id="googlesearchform" action="http://www.google.com/cse" method="get">
          <div class="row">
          <input type="text" class="textfield" name="q" size="24" value="" tabindex="12"/>
          <input class="button" type="submit" value="<?php _e('Google custom search', YHL); ?>" title="Search"/>
          <input type="hidden" name="cx" value="<?php echo $GLOBALS['philnaopt']['google_cse_cx']; ?>" />
          <input type="hidden" name="ie" value="UTF-8" />
          </div>
        </form>
      </div>
      <?php endif; ?>
      <div class="s_wp">
        <form id="wpsearchform" action="<?php bloginfo('home');?>/" method="get">
          <div class="row">
          <input type="text" class="textfield" name="s" value="<?php echo isset($s) ? wp_specialchars($s, 1) : ''; ?>" title="<?php _e('Search posts',YHL); ?>" tabindex="12"/>
          <input class="button" type="submit" value="<?php _e('WordPress search', YHL); ?>" title="Search"/>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="back-links">
    <a title="<?php _e('Back to home',YHL);?>" id="back-to-home" href="<?php bloginfo('url');?>/?from=404"> &laquo; <?php _e('Back to home',YHL);?></a>
  </div>
  </div>
<?php get_footer(); ?>
