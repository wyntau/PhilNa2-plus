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

class PhilnaMixedWidget extends WP_Widget {
  function PhilnaMixedWidget() {
    $widget_ops = array(
      'classname' => 'PhilnaMixedWidget',
      'description' => '最新评论,最新文章,随机文章混合小工具'
    );
    $this->WP_Widget('Mixed_widget', $name = '混合小工具(自说Me话)',$widget_ops);
  }
  function widget($args, $instance) {
    extract( $args );
    echo $before_widget;
?>
    <style>
      .mixed-tab-title h3 {
        font-size: 14px;
      }

      .mixed-tab-title .selected {
        color: #356aa0;
        border-bottom: 0px;
      } /*标题被选中时的样式*/
      .mixed-tab-title span {
        padding: 5px 5px 5px 5px;
        border: 0px solid #ccf;
        border-right: 0px;
        margin-left: 0px;
        cursor: pointer;
      }

      .mixed-tab-content .hide {
        display: none;
      } /*默认让第一块内容显示，其余隐藏*/
      .mixed-tab-content ul {
        overflow: hidden;
      }
      .mixed-tab-content ul li {
        padding-top: 5px;
        overflow: hidden;
      }
      .mixed-tab-content ul li img.avatar {
        height: 20px;
        width: 20px;
      }
    </style>
    <div class="mixed-tab-title">
      <h3>
        <span class="selected">
          <?php echo $instance['recent_comment_title']; ?>
        </span>
        |
        <span>
          <?php echo $instance['recent_post_title']; ?>
        </span>
        |
        <span>
          <?php echo $instance['random_post_title']; ?>
        </span>
      </h3>
    </div>
    <div class="mixed-tab-content">
      <ul><?php philnaRecentcomments('number=7&status=approve'); ?></ul>
      <ul class="hide"><?php Recentposts($limit = 9); // limit output ?></ul>
      <ul class="hide"><?php Randomposts($limit = 9); // limit output ?></ul>
    </div>
    <script>
      jQuery(function($){
        $('body').on('mouseover', '.mixed-tab-title span', function(){
          var $tabTitle = $(this).parents('.mixed-tab-title');
          var $tabContent = $tabTitle.siblings('.mixed-tab-content');
          $(this).addClass('selected').siblings().removeClass('selected');
          $tabContent.find("> ul").eq($(this).index()).slideDown(250).siblings().slideUp(250);
        });
      });
    </script>
<?php
    echo $after_widget;
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
add_action('widgets_init', create_function('', 'return register_widget("PhilnaMixedWidget");'));
