<?php
/**
 * Template Name: 归档(archive)
 */
get_header();
?>
<div id="wrap">
  <div id="header" class="box clearfix">
    <div id="caption" class="icon">
      <?php philnaBlogTitleAndDesc(); ?>
    </div>
    <?php wp_nav_menu(array( 'theme_location'=>'primary','container_class' => 'navigation')); ?>
    <?php philnaCloseSidebar() ?>
  </div>
  <div id="content">
<?php
if(have_posts()){
  while(have_posts()){
    the_post();
    $postTitleTag = is_singular() ? 'h1' : 'h2';
?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <<?php echo $postTitleTag; ?> class="post_title"><a class="icon" href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $postTitleTag; ?>>
      <div class="postinfo clearfix">
        <div class="left">
          <span class="date icon"><?php the_time(__('F jS, Y', YHL)); ?></span>
        </div>
      </div>
      <div class="post_content content clearfix">
        <?php archives_list_SHe(); ?>
      </div>
    </div>
<?php
  } //endwhile;
} //endif;
?>
  </div> <!-- #content -->
<?php
get_footer();
