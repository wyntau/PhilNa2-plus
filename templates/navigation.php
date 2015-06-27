<?php
/**
 * the navigation
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
