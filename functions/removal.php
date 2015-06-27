<?php
/***************************************
 *去除头部一些不需要的代码加载,可以按照自己的意愿重新启用,
 *只需要前面添加 "//"(不包括引号)注释即可,不推荐删除
 ****************************************/
remove_action( 'wp_head', 'feed_links_extra', 3 );//去除评论feed
remove_action( 'wp_head', 'feed_links', 2 );//去除文章的feed
remove_action( 'wp_head', 'rsd_link' );//针对Blog的离线编辑器开放接口所使用
remove_action( 'wp_head', 'wlwmanifest_link' );//如上
remove_action( 'wp_head', 'index_rel_link' );//当前页面的url
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );//后面文章的url
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );//最开始文章的url
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//相邻文章的url
remove_action( 'wp_head', 'wp_generator' );//版本号
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );//短地址
