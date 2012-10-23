<?php
/********************
 *首页Ajax加载文章关键函数
 ******************/
function ajax_post(){
	if($_GET['action'] == 'ajax_post' && $_GET['id'] != '') {	
		$ariticle_id=(int)$_GET['id'];
		query_posts("p=$ariticle_id");the_post();the_excerpt();
		die();
	}else{
		return;
	}
}
add_action('init', 'ajax_post');
