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
	<div id="footer_content" class="box content no_webshot">
		<a id="top" rel="nofollow" href="#header">TOP</a>
		<p>
		<a id="powered" class="icon" title="由WordPress强力驱动" href="http://wordpress.org">WordPress</a>
		Copyright &copy; 2011-2013 <?php bloginfo('name');?><sup>&reg;</sup>  | <span title="Created On 2011-3-24">本博客已运行<?php echo floor((time()-strtotime("2011-3-24"))/86400); ?>天</span>
		</p>
		<p id="footerinfo">PhilNa2 by yinheli(http://philna.com) <?php do_action('philnaFooterInfo'); ?>Modified by <a target="_blank" href="http://ISayMe.com" title="集成功能扩展">自说Me话</a><!--不知道大家能否给我保留这个链接呢?算是大家帮我做个外链吧.多谢了-->. <span id="loadstate"><?php _e('页面加载: '); echo get_num_queries(), 'queries.'; ?> <?php timer_stop(1); ?> seconds.</span></p> 
	</div>
</div>
<div class="clear"></div>
</div><!--#wrap-->
<?php wp_footer(); ?>
<?php if(!is_page()):?>
<div id="updown">
<div id="up" title="我要上天!"></div>
<?php if(is_single()):?>
<div id="comt" title="查看评论"></div>
<div id="down" title="我要吐槽!"></div>
<?php else:?><div id="down" title="我要入地!"></div><?php endif;?>
</div><?php endif;?>
 <div style="position:fixed;bottom:2%;left:50%;margin-left:521px;display:block;"><a href="#" onclick="return false" title="雷锋联盟 成员"><img style="border:none;padding:3px;" src="http://isayme.com/wp-content/ibg.png"></a></div>
</body>
</html>
