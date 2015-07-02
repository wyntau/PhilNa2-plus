<?php
/**
 * Template Name: 联系页面 (Contact or about)
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

$adminEmail = get_option('admin_email');
get_header();
?>
<div id="wrap">
  <div id="header" class="box">
    <div id="caption" class="icon clearfix">
      <?php philnaBlogTitleAndDesc(); ?>
    </div>
    <?php wp_page_menu('show_home=1&menu_class=navigation'); ?>
  </div>
  <div id="content">
    <div id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <h1 class="post_title"><a class="icon" href="<?php the_permalink(); ?>" rel="bookmark inlinks permalink" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
    <div class="postinfo clearfix">
      <div class="left">
        <span class="date icon"><?php the_time(__('F jS, Y', YHL)); ?></span>
        <span class="author icon"><?php the_author_posts_link(); ?></span>
      </div>
      <div class="right">
      <?php edit_post_link(__('Edit', YHL), '<span class="edit_link icon">', '</span>'); ?>
      </div>
    </div>
    <div class="post_content content clearfix">
      <?php the_content(__('Read more...', YHL)); ?>
      <?php wp_link_pages('before=<div class="content_pages icon"><strong>'. __('Pages:', YHL).'&after=</strong></div>'); ?>
    </div>
  </div><?php /* end post */?>

  <?php if($adminEmail): ?>
  <div id="ajaxbox" class="box content message icon hide">
    <span class="ajaxloading"><?php _e('Sending your email, Give me a second...',YHL); ?></span>
  </div>
  <?php endif; ?>

  <!-- contactbox form -->
  <div id="contactbox" class="box content icon">
  <?php if($adminEmail): ?>
    <form id="contactform" method="post" action="<?php echo get_bloginfo('template_url')?>/sendemail.php">
    <div class="row">
      <input class="textfield" id="name" type="text" name="name" tabindex="1"/>
      <label for="name" class="small"><?php _e('Name',YHL)?></label>
    </div>
    <div class="row">
      <input class="textfield" id="from" type="text" name="from" tabindex="2"/>
      <label for="from" class="small"><?php _e('Your E_mail',YHL)?></label>
    </div>
    <div class="row">
      <input class="textfield" id="subject" type="text" name="subject" tabindex="3"/>
      <label for="subject" class="small"><?php _e('Subject',YHL)?></label>
    </div>
    <div class="row">
      <input class="textfield" id="vcode" type="text" name="vcode" tabindex="4"/>
      <label for="vcode" class="small"><?php _e('Verification Code',YHL)?>(*):<img class="yzimg" src="<?php bloginfo('template_url'); ?>/images/yz_img.php" title="<?php _e('Click the picture to refresh',YHL)?>" alt="" onclick="this.src=this.src+'?'" style="cursor:pointer;" /></label>
    </div>
    <div class="row">
      <textarea class="textfield mailcontent" rows="10" cols="50" id="mailcontent" tabindex="5" name="content" title="<?php _e('HTML tag enabled',YHL); ?>"><?php echo 'Dear, SayMe';the_author();echo "\n\t\n\n\n\n";echo 'Your sincerely,',"\n";?></textarea>
    </div>
    <div class="row">
      <input name="submit" type="submit" id="send" class="button bias" tabindex="6" value="<?php _e('Email Me!', YHL); ?>" />
      <input type="hidden" name="sendmail" value="send" />
    </div>
    </form>
    <?php else: ?>
    <p class="error"><?php _e('Can\'t get the admin\'s email address. The contact form is not available.'  , YHL)?></p>
    <?php endif;?>
  </div>

  <?php if($adminEmail) :?>
  <div id="allowed_tags" class="box message icon">
    <?php _e('<strong>You Can use the HTML tags:</strong> ',YHL);echo allowed_tags(); ?>
  </div>
  <?php endif;/*allowed_tags*/ ?>

  </div>
<?php get_footer(); ?>
