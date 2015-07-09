<?php
/**
 * footer
 */

 /* It would be great if you’d leave the link back to my site in the footer */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

is_404() || get_sidebar(); // if 404 page, no sidebar!
?>
<!-- footer -->
<div id="footer">
  <div id="footer_content" class="box content">
    <a id="top" rel="nofollow" href="#header">TOP</a>
    <p>
    <a id="powered" class="icon" title="由WordPress强力驱动" href="http://wordpress.org">WordPress</a>
    Copyright &copy; 2011-2013 <?php bloginfo('name');?><sup>&reg;</sup>  | <span title="Created On 2011-3-24">本博客已运行<?php echo floor((time()-strtotime("2011-3-24"))/86400); ?>天</span>
    </p>
    <p id="footerinfo">
      PhilNa2 by yinheli(http://philna.com) Modified by <a target="_blank" href="http://ISayMe.com" title="集成功能扩展">自说Me话</a>.
      <?php do_action('philnaFooterInfo'); ?>
      <?php philna_query_state() ?>
    </p>
  </div>
</div>
</div><!--#wrap-->
<?php wp_footer(); ?>
</body>
</html>
