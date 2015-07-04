<?php
class PhilnaMousePet extends WP_Widget {
  function PhilnaMousePet() {
    $widget_ops = array(
      'classname' => 'PhilnaMousePet',
      'description' => '小老鼠宠物小工具'
    );
    $this->WP_Widget('PhilnaMousePet', $name = '小老鼠宠物(自说Me话)',$widget_ops);
  }
  function widget($args, $instance) {
    extract( $args );
    echo $before_widget;
?>
    <h3><?php echo $instance['title'];?></h3>
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="160" height="70" id="philna_man_clock" align="middle">
      <param name="allowScriptAccess" value="always" />
      <param name="movie" value="<?php echo get_template_directory_uri() . '/swf/mouse_pet.swf' ?>" />
      <param name="quality" value="high" />
      <param name="bgcolor" value="#ffffff" />
      <param name="wmode" value="transparent" />
      <embed wmode="transparent" src="<?php echo get_template_directory_uri() . '/swf/mouse_pet.swf' ?>" quality="high" bgcolor="#ffffff" width="230" height="180" name="philna_man_clock" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
    </object>
<?php
    echo $after_widget;
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'] ? strip_tags($new_instance['title']) : '我的宠物';
    return $instance;
  }
  function form($instance) {
    $instance['title']= $instance['title'] ? strip_tags($new_instance['title']) : '我的宠物';
?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">
        标题<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
      </label>
    </p>
<?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("PhilnaMousePet");'));
