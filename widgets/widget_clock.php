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
<script>
  (function(){
    function themeurl() {
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
    var swfUrl = themeurl();
    var swfTitle = "honehoneclock";
    swfUrl+="/swf/honehone_clock_wh.swf";
    LoadBlogParts();
    function LoadBlogParts(){
      var sUrl = swfUrl;
      var sHtml = "";
      sHtml += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="160" height="70" id="' + swfTitle + '" align="middle">';
      sHtml += '<param name="allowScriptAccess" value="always" />';
      sHtml += '<param name="movie" value="' + sUrl + '" />';
      sHtml += '<param name="quality" value="high" />';
      sHtml += '<param name="bgcolor" value="#ffffff" />';
      sHtml += '<param name="wmode" value="transparent" />';
      sHtml += '<embed wmode="transparent" src="' + sUrl + '" quality="high" bgcolor="#ffffff" width="160" height="70" name="' + swfTitle + '" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';
      sHtml += '</object>';
      document.write(sHtml);
    }
  })();
</script>
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
