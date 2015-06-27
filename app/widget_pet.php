<?php
class Mouse_Pet extends WP_Widget {
  function Mouse_Pet() {
    $widget_ops = array(
      'classname' => 'Mouse_Pet',
      'description' => '小老鼠宠物小工具'
    );
    $this->WP_Widget('Mouse_Pet', $name = '小老鼠宠物(自说Me话)',$widget_ops);
  }
  function widget($args, $instance) {
    extract( $args );
?>
<?php echo $before_widget; ?>
  <h3 style="text-align:center">
    <span class="selected"><?php echo $instance['title'];?></span>
  </h3>
  <script charset="Shift_JIS"src="<?php bloginfo('template_url');?>/js/Mouse_Pet.js"></script>
<?php echo $after_widget; ?>
<?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'] ? strip_tags($new_instance['title']) : '我的宠物';
    return $instance;
  }
  function form($instance) {
    $instance['title']= $instance['title']?$instance['title']:'我的宠物';
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    标题<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
  </label>
</p>

<?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("Mouse_Pet");'));
