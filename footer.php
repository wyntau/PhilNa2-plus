<?php
/**
 * footer
  * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * Required Version:
 * 	PHP5 or higher
 * 	WordPress 2.9 or higher
 *
 * If you find my work useful and you want to encourage the development of more free resources,
 * you can do it by donating...
 * 	paypal: yinheli@gmail.com
 * 	alipay: yinheli@gmail.com
 *
 * @author yinheli <yinheli@gmail.com>
 * @link http://philna.com/
 * @copyright Copyright (C) 2009 yinheli All rights reserved.
 * @license PhilNa2 is released under the GPL.
 * @version $Id$
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
		Copyright &copy; 2011 <?php bloginfo('name');?><sup>&reg;</sup>  | 本博客已运行<?php echo floor((time()-strtotime("2011-3-24"))/86400); ?>天
		</p>
		<p id="footerinfo">PhilNa2 by <a rel="acquaintance themeAuthor" class="no_webshot" href="http://philna.com" title="The author of PhilNa2">yinheli</a> <?php do_action('philnaFooterInfo'); ?>Modified by <a target="_blank" href="http://ISayMe.com" title="集成功能扩展">自说Me话</a><!--不知道大家能否给我保留这个链接呢?算是大家帮我做个外链吧.多谢了-->. <span id="loadstate"><?php _e('页面加载: '); echo get_num_queries(), 'queries.'; ?> <?php timer_stop(1); ?> seconds.</span></p> 
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
</body>
</html>
