<?php
class Mixed_Widget extends WP_Widget {
  function Mixed_Widget() {
    $widget_ops = array(
      'classname' => 'Mixed_Widget',
      'description' => '最新评论,最新文章,随机文章混合小工具'
    );
    $this->WP_Widget('Mixed_widget', $name = '混合小工具(自说Me话)',$widget_ops);
  }
  function widget($args, $instance) {
    extract( $args );
?>
<?php echo $before_widget; ?>
<div id="tab-title">
  <h3>
    <span class="selected"><?php echo $instance['recent_comment_title'];?></span> | <span><?php echo $instance['recent_post_title'] ;?></span> | <span><?php echo $instance['random_post_title'] ;?></span>
  </h3>
</div>
<div id="tab-content">
  <ul><?php philnaRecentcomments('number=7&status=approve'); ?></ul>
  <ul class="hide"><?php Recentposts($limit = 9); // limit output ?></ul>
  <ul class="hide"><?php Randomposts($limit = 9); // limit output ?></ul>
</div>
<?php echo $after_widget; ?>
<?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $new_instance = wp_parse_args((array) $new_instance, array( 'recent_comment_title' => '最新评论', 'recent_post_title' => '最新文章','random_post_title'=>'随机文章'));
    $instance['recent_comment_title'] = $new_instance['recent_comment_title']?strip_tags($new_instance['recent_comment_title']):'最新评论';
    $instance['recent_post_title'] = $new_instance['recent_post_title']?strip_tags($new_instance['recent_post_title']):'最新文章';
    $instance['random_post_title'] = $new_instance['random_post_title']?strip_tags($new_instance['random_post_title']):'随机文章';
    return $instance;
  }
  function form($instance) {
    $recent_comment_title = $instance['recent_comment_title']?$instance['recent_comment_title']:'最新评论';
    $recent_post_title = $instance['recent_post_title']?$instance['recent_post_title']:'最新文章';
    $random_post_title = $instance['random_post_title']?$instance['random_post_title']:'随机文章';
    ?>
      <p>
  <label for="<?php echo $this->get_field_id('recent_comment_title'); ?>">[最新评论]标题<input class="widefat" id="<?php echo $this->get_field_id('recent_comment_title'); ?>" name="<?php echo $this->get_field_name('recent_comment_title'); ?>" type="text" value="<?php echo esc_attr($recent_comment_title); ?>" /></label>
  <label for="<?php echo $this->get_field_id('recent_post_title'); ?>">[最新文章]标题<input class="widefat" id="<?php echo $this->get_field_id('recent_post_title'); ?>" name="<?php echo $this->get_field_name('recent_post_title'); ?>" type="text" value="<?php echo esc_attr($recent_post_title); ?>" /></label>
  <label for="<?php echo $this->get_field_id('random_post_title'); ?>">[随机文章]标题<input class="widefat" id="<?php echo $this->get_field_id('random_post_title'); ?>" name="<?php echo $this->get_field_name('random_post_title'); ?>" type="text" value="<?php echo esc_attr($random_post_title); ?>" /></label>
</p>
<?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("Mixed_Widget");'));
