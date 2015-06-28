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
<script>
  (function(){
    function themeurl_pet() {
      var i = 0,
      got = -1,
      url,
      len = document.getElementsByTagName('link').length;
      while (i <= len && got == -1) {
          url = document.getElementsByTagName('link')[i].href;
          got = url.indexOf('/style.css');
          i++
      }
      return url.replace(/\/style.css.*/g, "")
    };
    var swfUrl_pet = themeurl_pet();
    swfUrl_pet+="/swf/Mouse_Pet.swf";
    LoadPetParts();
    function LoadPetParts(){
      var sUrl = swfUrl_pet;
      var sHtml = "";
      sHtml += '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="240"height="180">';
      sHtml +='<param name="movie" value="'+sUrl+'">';
      sHtml +='<param name="quality" value="high">';
      sHtml +='<param name="wmode" value="opaque">';
      sHtml +='<embed src="'+sUrl+'" width="240"  height="180" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="opaque">';
      sHtml += '</object>';
      document.write(sHtml);
    }
  }
)();
</script>
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
