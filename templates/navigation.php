<?php
/**
 * the navigation
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

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

do_action('philnaPagenaviStart');
?>
<?php if(philnaHavePagenavi()) :?>
	<div id="pagenavi" class="box icon content">
		<?php if(function_exists('wp_pagenavi')) : ?>
			<?php wp_pagenavi() ?>
		<?php elseif(function_exists('Mini_pagenavi')) : ?>
			<?php Mini_pagenavi() ?>	
		<?php else : ?>
			<span class="older left"><?php next_posts_link(__('Older Page', YHL)); ?></span>
			<span class="newer right"><?php previous_posts_link(__('Newer Page', YHL)); ?></span>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
<?php endif;/* end pagenavi */?>
<?php if(is_single()): ?>
	<div id="pagenavi" class="box icon content">
		<?php 
		if (get_previous_post()) { 
			  previous_post_link('<div class="left"><span>&laquo;</span> %link</div>');
 		} else {
    			echo "<div class=\"left\"><span>&laquo;</span> 已经是最后一篇啦</div>";
 		}	
		if (get_next_post()) { 
			  next_post_link('<div class="right">%link <span>&raquo;</span></div>');
 		} else {
    			echo "<div class=\"right\">已经是第一篇啦 <span>&raquo;</span></div>";
 		}		
		?>
		<div class="clear"></div>
	</div>
<?php endif;?>
