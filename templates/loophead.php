<?php
/**
 * before loop start
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

?>
<div class="loop_head box content">
<?php
  if(is_search()){
    echo __('<strong>Search Results : </strong><br/>', YHL),"\n";
    global $s;
    printf( __('Keyword: &quot; %1$s &quot;', YHL), wp_specialchars($s, 1) );
  }else if(is_category()){
    printf( __('Archive for the &quot;%1$s&quot; Category', YHL), single_cat_title('', false) );
    if( $desc = category_description()){
      echo '<p class="desc">', __('Description: ',YHL), '</p>',"\n";
      echo $desc;
    }
  }else if(is_tag()){
    printf( __('Posts Tagged &quot;%1$s&quot;', YHL), single_tag_title('', false) );
    if( $desc = tag_description()){
      echo '<p class="desc">', __('Description: ',YHL), '</p>',"\n";
      echo $desc;
    }
  }else if(is_day()){
    printf( __('Archive for %1$s', YHL), get_the_time(__('F jS, Y', YHL)) );
  }else if (is_month()) {
    printf( __('Archive for %1$s ', YHL), get_the_time(__('F, Y', YHL)) );
  }else if(is_year()) {
    printf( __('Archive for %1$s', YHL), get_the_time(__('Y', YHL)) );
  }else if(is_author()) {
    _e('Author Archive', YHL);
  }else if(isset($_GET['paged']) && !empty($_GET['paged'])) {
    _e('Blog Archives', YHL);
  }else{
    _e('Arhives page', YHL);
  }
?>
</div>
