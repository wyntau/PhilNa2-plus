<?php
/**
 * comment form
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');
?>
<div id="respond" class="box icon content">
  <div id="respond_head">
    <h4><strong><?php _e('Leave a comment', YHL); ?></strong></h4>
    <?php philnaCommentSmilies(); ?>
                <div id="editor_tools"> 
    <a style="padding:0 5px;border-right:1px solid #ddd;border-left:1px solid #ddd;" href="javascript:SIMPALED.Editor.strong()">B</a>
      <a style="padding:0 5px;border-right:1px solid #ddd;" href="javascript:SIMPALED.Editor.italic()">i</a> 
      <a style="padding:0 5px;border-right:1px solid #ddd;" href="javascript:SIMPALED.Editor.em()">em</a>
      <a style="padding:0 5px;border-right:1px solid #ddd;" href="javascript:SIMPALED.Editor.del()">del</a> 
      <a style="padding:0 5px;border-right:1px solid #ddd;" href="javascript:SIMPALED.Editor.underline()">U</a> 
      <a style="padding:0 5px;border-right:1px solid #ddd;" href="javascript:SIMPALED.Editor.ahref()">Link</a> 
      <a style="padding:0 5px;border-right:1px solid #ddd;" href="javascript:SIMPALED.Editor.code()">Code</a>
      <a style="padding:0 5px;border-right:1px solid #ddd;" href="javascript:SIMPALED.Editor.syntax()">Syntax</a> 
      <a style="padding:0 5px;border-right:1px solid #ddd;" href="javascript:SIMPALED.Editor.quote()">Quote</a> 
</div>
    <div class="clear"></div>
  </div>
  <form id="commentform" action="<?php bloginfo('url'); ?>/wp-comments-post.php" method="post">
    <div id="commentbox" class="left">
      <textarea class="textfield" rows="12" cols="50" name="comment" id="comment" tabindex="1" title="<?php _e('Support: Ctrl + Enter | Ctrl + S | Alt + S | Alt + Enter',YHL);?>"></textarea><span id="comtinfo">说点什么再走吧!</span><i id="num">0</i>
    </div>
    <div id="comment_author_info" class="right">
      <?php if($user_ID):global $user_email ?>
      <div id="welcome_info">
        <?php echo my_avatar($user_email, 30);?>
        <p>
        <?php _e('Logged in as', YHL); ?> <a class="no_webshot" href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><strong><?php echo $user_identity; ?></strong></a>.
        <a class="no_webshot" href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('Log out of this account', YHL); ?>"><?php _e('Logout &raquo;', YHL); ?></a>
        </p>
        <p><?php _e('Welcome !',YHL);?></p>
        <div class="clear"></div>
      </div>
      <?php else: ?>
      <?php if($comment_author_email):?>
      <div id="welcome_back">
        <div id="welcome_info">
          <?php echo my_avatar($comment_author_email, 30); ?>
          <p id="welcome_words"><?php printf(__('Hey! %1s, Welcome Back!'), $comment_author); ?></p>
          <p><a id="edit_profile" href="javascript:void(0);"><?php _e('Edit your profile?'); ?></a></p>
          <div class="clear"></div>
        </div>
        <div id="welcome_msg">
          <blockquote><?php echo philnaWelcomeCommentAuthorBack($comment_author_email); ?></blockquote>
        </div>
      </div>
      <?php endif;?>
      <div id="profile" class="<?php echo $comment_author_email ? 'hide' : 'profile'; ?>">
        <div class="row">
        <label for="author" class="small"><?php _e('Name', YHL); if ($req) _e('(required)', YHL); ?></label>
        <input type="text" name="author" id="author" class="textfield" value="<?php echo $comment_author; ?>" size="24" tabindex="2" />
        </div>
        <div class="row">
        <label for="email" class="small"><?php _e('E-Mail (will not be published)', YHL);if ($req) _e('(required)', YHL); ?></label>
        <input type="text" name="email" id="email" class="textfield" value="<?php echo $comment_author_email; ?>" size="24" tabindex="3" />
        </div>
        <div class="row">
        <label for="url" class="small"><?php _e('Website', YHL); ?></label>
        <input type="text" name="url" id="url" class="textfield" value="<?php echo $comment_author_url; ?>" size="24" tabindex="4" />
        </div>
      </div>
      <?php endif; /* end $user_ID */?>
      <div class="row">
        <input name="submit" type="submit" id="submit" class="button bias" tabindex="5" value="<?php _e('Submit Comment', YHL); ?>" />
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </form><strong class="comment_notice">NOTICE:</strong> You should type some Chinese word (like “你好”) in your comment to pass the spam-check, thanks for your patience!
</div>
<?php /* philna hook */ do_action('commentAfter'); ?>
<?php if(is_404()):?><div id="allowed_tags" class="box message icon">
  <?php _e('<strong>Allowed tags:</strong> ',YHL);echo allowed_tags(); ?>
</div><?php endif; ?>
