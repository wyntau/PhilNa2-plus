<?php
/**
 * Template Name: 链接页面 (links)
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
    if( have_posts() ){
      // post loop start
      do_action('philnaLoopStart'); /* philna hook */
      while( have_posts() ){
        the_post();
        $postTitleTag = is_singular() ? 'h1' : 'h2';
    ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <<?php echo $postTitleTag; ?> class="post_title">
            <a class="icon" href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
          </<?php echo $postTitleTag; ?>>
          <div class="postinfo clearfix">
            <div class="left">
              <span class="date icon"><?php the_time(__('F jS, Y', YHL)); ?></span>
            </div>
            <div class="right">
            <?php edit_post_link(__('Edit', YHL), '<span class="edit_link icon">', '</span>'); ?>
            </div>
          </div>
          <div class="post_content content fontsize13 clearfix">
            <?php the_content(__('Read more...', YHL)); ?>
            <div class="linkpage">
              <ul>
                <?php my_list_bookmarks('title_li=&categorize=1&orderby=rand&title_before=<h3 style="background:#cccccc;font-size:14px;padding:5px;">&title_after=</h3>&category_before=<li>&category_after=</li>'); ?>
              </ul>
            </div>
            <?php
            if( is_singular() ){
              wp_link_pages(array(
                'before' => '<div class="content_pages icon"><strong>' . __('Pages:', YHL),
                'after' => '</strong></div>'
              ));
            }
            ?>
          </div>
        </div>
    <?php
      } //endwhile;
    } //endif;
    ?>
  </div>
<?php
get_footer();
