<?php
/**
 * feed box
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');
?>
<div id="feedbox" class="box">
<div id="subscribe" class="left no_webshot">
  <a id="feedrss" title="<?php _e('Subscribe to this blog...', YHL); ?>" target="_blank" href="<?php echo $GLOBALS['philnaopt']['feed_url']; ?>" rel="bookmark"><span class="icon"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr> feed', YHL); ?></span></a>
  <?php if( $GLOBALS['philnaopt']['feed_email'] && $GLOBALS['philnaopt']['feed_url_email'] ): ?>
  <a id="feedemail" title="<?php _e('Subscribe to this blog via email...', YHL); ?>" target="_blank" href="<?php echo $GLOBALS['philnaopt']['feed_url_email']; ?>" rel="bookmark"><span class="icon"><?php _e('Email feed', YHL); ?></span></a>
  <?php endif; ?>
</div>
<div id="readers" class="right no_webshot">
  <ul>
    <li id="google_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', YHL); _e('Google', YHL); ?>" target="_blank" href="http://fusion.google.com/add?feedurl=<?php echo $GLOBALS['philnaopt']['feed_url']; ?>"><span class="icon"><?php _e('Google', YHL); ?></span></a></li>
    <li id="xianguo_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', YHL); _e('Xian Guo', YHL); ?>" target="_blank" href="http://www.xianguo.com/subscribe.php?url=<?php echo $GLOBALS['philnaopt']['feed_url']; ?>"><span class="icon"><?php _e('Xian Guo', YHL); ?></span></a></li>
    <li id="qqemail_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', YHL); _e('QQ email', YHL); ?>" target="_blank" href="http://mail.qq.com/cgi-bin/feed?u=<?php echo $GLOBALS['philnaopt']['feed_url']; ?>"><span class="icon"><?php _e('QQ Email', YHL); ?></span></a></li>
    <li id="yahoo_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', YHL); _e('My Yahoo!', YHL); ?>" target="_blank" href="http://add.my.yahoo.com/rss?url=<?php echo $GLOBALS['philnaopt']['feed_url']; ?>"><span class="icon"><?php _e('My Yahoo!', YHL); ?></span></a></li>
  </ul>
  <div class="clear"></div>
</div>
<div class="clear"></div>
</div>
