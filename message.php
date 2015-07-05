<?php
/**
 * Template Name: 留言读者墙(message)
 *
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

get_header();
?>
<div id="wrap">
  <div id="header" class="box clearfix">
    <div id="caption" class="icon">
      <?php philnaBlogTitleAndDesc(); ?>
    </div>
    <?php wp_nav_menu(array( 'theme_location'=>'primary','container_class' => 'navigation')); ?>
  </div>
  <div id="content">
<?php
    include_once get_template_directory() . '/templates/notice.php';
    if( have_posts() ){
      // post loop start
      do_action('philna_loop_start'); /* philna hook */
      while( have_posts() ){
        the_post();
        $postTitleTag = is_singular() ? 'h1' : 'h2';
?>
        <div id="post-<?php the_ID(); ?>" <?php post_class();?>>
          <<?php echo $postTitleTag; ?> class="post_title">
            <a class="icon" href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>">
              <?php the_title(); ?>
            </a>
          </<?php echo $postTitleTag; ?>>
          <div class="postinfo clearfix">
            <div class="left">
              <span class="date icon"><?php the_time(__('F jS, Y', YHL)); ?></span>
              <span class="author icon"><?php the_author_posts_link(); ?></span>
            </div>
            <div class="right">
<?php
              if(is_singular()){
?> 
                <span id="skiptocomment" class="comments_link">
                  <a href="#comments"><?php _e('Skip to Comments', YHL)?></a>
                </span>
<?php
              }else{
?>
                <span class="comments_link">
                  <sup>{ </sup><?php comments_popup_link(__('No Comments',YHL), __('1 Comment', YHL), __('% Comments', YHL));?><sub> }</sub>
                </span>
<?php
              } //endif;

              edit_post_link(__('Edit', YHL), '<span class="edit_link icon">', '</span>');
?>
            </div>
          </div>
          <div class="post_content content clearfix">
            <?php the_content(__('Read more...', YHL)); ?>
            <!-- end 读者墙 -->
            <div align="center"><h2>在此留言就可以上墙哦</h2></div>
            <div align="center"><b>信春哥.原地满血,爆极品神器.</b>想要满血吗?赶紧来说几句吧!</div>
            <!-- start 读者墙 -->
<?php
            $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != 'lwent90@gmail.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 39";//最后的这个40是选取多少个头像，我一次让它显示40个。
            $wall = $wpdb->get_results($query);
            $maxNum = $wall[0]->cnt;
            $output = '';
            foreach ($wall as $comment){
              $width = round(40 / ($maxNum / $comment->cnt),2);//这个40是我设置头像的宽度，和下面&size=40里的40一个概念，如果你头像宽度32，这里就是32了。
              if( $comment->comment_author_url ){
                $url = $comment->comment_author_url;
              }else{
                $url="#";
              }
              $tmp = '<li><a target="_blank" href="' . $comment->comment_author_url . '"><span class="pic" style="background: url(http://www.gravatar.com/avatar/' . md5(strtolower($comment->comment_author_email)) . '?s=36&d=monsterid&r=G) no-repeat;">pic</span><span class="num">' . $comment->cnt . '</span><span class="name">' . $comment->comment_author . '</span></a><div class="active-bg"><div class="active-degree" style="width:' . $width . 'px"></div></div></li>';
              $output .= $tmp;
            }
            $output = '<div class="readerwall">' . $output . '<div class="clear"></div></div>';
            echo $output ;

            if( is_singular() ){
              wp_link_pages('before=<div class="content_pages icon"><strong>'. __('Pages:', YHL).'&after=</strong></div>');
            }

            do_action('philnaStatement');
?>
          </div>
        </div><?php /* end post */?>
<?php
      } //endwhile;
      //include_once get_template_directory() . '/templates/navigation.php';
      comments_template();
    }else{ // if no posts
?>
      <div class="box error icon">
        <?php
        if(is_search())
          _e('Oh no!. No posts matched your criteria. You may try other keywords.',YHL);
        else
          _e('Oh no! You\'re looking for something which just isn\'t here! Fear not however, errors are to be expected, and luckily there are tools on the sidebar for you to use in your search for what you need.',YHL);
        ?>
      </div>
<?php
    } //endif;
?>
  </div>
<?php
get_footer();
