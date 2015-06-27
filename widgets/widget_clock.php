<?php
class Man_Clock extends WP_Widget {
  function Man_Clock() {
    $widget_ops = array(
      'classname' => 'Man_Clock',
      'description' => '人体时钟小工具'
    );
    $this->WP_Widget('Man_Clock', $name = '人体时钟(自说Me话)',$widget_ops);
  }
  function widget($args, $instance) {
    extract( $args );
?>
<?php echo $before_widget; ?>
<h3 style="text-align:center"><span class="selected"><?php echo $instance['title'];?></span></h3>
<script charset="Shift_JIS"src="<?php bloginfo('template_url');?>/js/honehone_clock_wh.js"></script>
<?php echo $after_widget; ?>
<?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title']?strip_tags($new_instance['title']):'Fantasy-Iime';
    return $instance;
  }
  function form($instance) {
    $instance['title']= $instance['title']?$instance['title']:'Fantasy-Time';

?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    标题<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
  </label>
</p>

<?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("Man_Clock");'));
