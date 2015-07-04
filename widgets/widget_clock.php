<?php

/**
 * 边侧栏 文章链接
 *
 * 作用: 在边侧栏显示随机文章, 最近发布的文章.
 * 为了减少数据库请求.不再使用mg12的方法.
 * 目前显示很多条的情况下也不会增加额外的数据库请求
 *
 * @since 2.0
 * @version 2.1
 */
function Randomposts($limit = 5){
  global $wpdb, $id;
  $output = '';
  $posts_widget_title = __('Random Posts',YHL);
  if(!$posts = wp_cache_get('widgetPostsLinkElse', 'philna')){
    $posts = get_posts("numberposts={$limit}&orderby=rand");
    wp_cache_add('widgetPostsLinkElse', $posts, 'philna');
  }
  $output .="<ul>\n";
  if(empty($posts)){
    $output .= '<li>Can\'t found (没有找到)</li>';
    $output .= "</ul>\n";
    echo $output;
    return;
  }
  foreach($posts as $post) {
    $output .=  '  <li><a href="' . get_permalink($post) . '" title="' . $post->post_title . '" rel="bookmark inlinks">' . $post->post_title . '</a></li>'."\n";
  }
  $output .= "</ul>\n";
  echo $output;
}

function Recentposts($limit = 5){
  global $wpdb, $id;
  $output = '';
  $posts_widget_title = __('Recent Posts',YHL);
  if(!$posts = wp_cache_get('widgetPostsLinkSingle', 'philna')){
    $posts = get_posts("numberposts={$limit}&orderby=post_date");
    wp_cache_add('widgetPostsLinkSingle', $posts, 'philna');
  }
  $output .="<ul>\n";
  if(empty($posts)){
    $output .= '<li>Can\'t found (没有找到)</li>';
    $output .= "</ul>\n";
    echo $output;
    return;
  }
  foreach($posts as $post) {
    $output .=  '  <li><a href="' . get_permalink($post) . '" title="' . $post->post_title . '" rel="bookmark inlinks">' . $post->post_title . '</a></li>'."\n";
  }
  $output .= "</ul>\n";
  echo $output;
}

class PhilnaManClock extends WP_Widget {
  function PhilnaManClock() {
    $widget_ops = array(
      'classname' => 'PhilnaManClock',
      'description' => '人体时钟小工具'
    );
    $this->WP_Widget('PhilnaManClock', $name = '人体时钟(自说Me话)',$widget_ops);
  }
  function widget($args, $instance) {
    extract( $args );
    echo $before_widget;
?>
    <h3 style="text-align:center">
      <span class="selected"><?php echo $instance['title'];?></span>
    </h3>
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="160" height="70" id="philna_man_clock" align="middle">
      <param name="allowScriptAccess" value="always" />
      <param name="movie" value="<?php echo get_template_directory_uri() . '/swf/honehone_clock_wh.swf' ?>" />
      <param name="quality" value="high" />
      <param name="bgcolor" value="#ffffff" />
      <param name="wmode" value="transparent" />
      <embed wmode="transparent" src="<?php echo get_template_directory_uri() . '/swf/honehone_clock_wh.swf' ?>" quality="high" bgcolor="#ffffff" width="230" height="80" name="philna_man_clock" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
    </object>
<?php
    echo $after_widget;
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'] ? strip_tags($new_instance['title']) : 'Fantasy-Iime';
    return $instance;
  }
  function form($instance) {
    $instance['title']= $instance['title'] ? strip_tags($new_instance['title']) : 'Fantasy-Time';
?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">
        标题<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
      </label>
    </p>
<?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("PhilnaManClock");'));
