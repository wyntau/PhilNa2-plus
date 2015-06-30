<?php
/**
 * display options
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

$title = __('PhilNa2 Settings', YHL);
screen_icon();
?>
<div class="wrap">
<h2><?php echo esc_html( $title ); ?></h2>
<?php

$msg = <<<END
<div id="message" class="updated fade">
<p><strong>%s</strong></p>
</div>
END;

$o = &$GLOBALS['philnaopt'];

// do save
if(isset($_POST['Submit']) && isset($_POST['savephilnaopt'])){
  $this->save($_POST); // $this  = class PhilNaAdmin
  printf($msg, __('Settings saved.', YHL));
  $o->reGet(); // reget the options form db
}
?>
  <style>
    #philna-form{
      background-color: #f1f1f1;
    }
    #philna-form tr{
      border-bottom: 2px solid #fff;
    }
  </style>
  <form id="philna-form" action="" method="post">
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"><?php _e('<h5>Meta</h5><em>Just in effect homepage</em>',YHL);?></th>
          <td class="form-field">
            <?php _e('Keywords',YHL); ?>
            <label for="keyword"><?php _e('( Separate keywords with commas )', YHL); ?></label><br/>
            <input type="text" name="keywords" id="keyword" class="code" value="<?php echo($o['keywords']); ?>"><br/><br/>
            <?php _e('Description',YHL); ?>
            <label for="desc"><?php _e('( Main decription for your blog )', YHL); ?></label><br/>
            <input type="text" name="description" id="desc" class="code" value="<?php echo($o['description']); ?>"><br/>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><?php _e('<h5>LoadText</h5>',YHL);?></th>
          <td class="form-field">
            <?php _e('LoadText',YHL); ?>
            <label for="LoadText"><?php _e('( 点击标题变成的文字 默认为 "页面载入中......")', YHL); ?></label><br/>
            <input type="text" name="LoadText" id="LoadText" class="code" value="<?php echo($o['LoadText']); ?>"><br/><br/>
            <?php _e('AjaxLoading',YHL); ?>
            <label for="AjaxLoading"><?php _e('( Ajax加载时的提示文字 默认为"AjaxLoading......" ,文章伸缩用户请无视此选项)', YHL); ?></label><br/>
            <input type="text" name="AjaxLoading" id="AjaxLoading" class="code" value="<?php echo($o['AjaxLoading']); ?>"><br/>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><?php _e('<h5>首页文章伸缩或Ajax加载</h5>',YHL);?></th>
          <td class="form-field">
            <input id="homeslide" name="homeslide" type="checkbox" value="checkbox" <?php if($o['homeslide']) echo "checked='checked'"; ?> />
            <label for="homeslide">勾选则首页文章伸缩,否则为Ajax加载</label><br/><br/>
            <input id="no_home_slide" name="no_home_slide" type="checkbox" value="checkbox" <?php if($o['no_home_slide']) echo "checked='checked'"; ?> />
            <label for="no_home_slide">关闭首页文章伸缩以及Ajax加载效果<br />(勾选此项会使上面的选择失效,首页无伸缩,无Ajax加载)</label><br/>
          </td>
        </tr>
         <tr valign="top">
          <th scope="row"><h5>首页文章截断长度</h5></th>
          <td class="form-field">
            <label for="excerpt_length">默认为220,请根据自己的需要进行调整(手动加More标签时无效,显示more标签之前的内容)</label><br/>
            <input type="text" name="excerpt_length" id="excerpt_length" class="code" value="<?php echo($o['excerpt_length']); ?>"><br/><br/>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><?php _e('<h5>Gavatar</h5>',YHL);?></th>
          <td class="form-field">
            <input id="cacheavatar" name="cacheavatar" type="checkbox" value="checkbox" <?php if($o['cacheavatar']) echo "checked='checked'"; ?> />
            <label for="cacheavatar">开启Gavatar头像缓存.</label><br/>
            如需使用头像缓存,请先在wp-content目录建立avatar文件夹,并设置此文件夹权限为777,文件夹中放置一张default.jpg.
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('<h5>Search Settings</h5>',YHL);?></th>
          <td class="form-field">
            <input id="google_cse" name="google_cse" type="checkbox" value="checkbox" <?php if($o['google_cse']) echo "checked='checked'"; ?> />
            <label for="google_cse"><?php _e('Using google custom search engine.', YHL); ?>  </label><br/>
            <?php _e('CX:', YHL);?><br />
            <input type="text" name="google_cse_cx"  size="45" value="<?php echo $o['google_cse_cx'];?>"><br/>
            <?php _e('How to find the CX code?',YHL)?><br/>
            <?php _e('Find <code>name="cx"</code> in the <strong>Search box code</strong> of <a href="http://www.google.com/coop/cse/">Google Custom Search Engine</a>, and type the <code>value</code> here.<br/>For example: <code>011275726292926788974:fezfvqcwgmo</code>', YHL); ?><br/>
    如需使用google自定义搜索,请在后台添加页面,选择”google搜索结果页面“模板,并将此模板的地址设为cse,<br/>比如我的网址为http://isayme.com.则google自定义搜索结果页面的链接为http://isayme.com/cse 切记!!
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><?php _e('<h5>Google统计代码</h5><em>(可选项)</em>.',YHL); ?></th>
          <td class="form-field">
            <input id="enable_google_analytics" name="enable_google_analytics" type="checkbox" value="checkbox" <?php echo $o['enable_google_analytics'] ? "checked='checked'" : '';?>/>
            <label for="enable_google_analytics"><?php _e('开启Google统计代码', YHL); ?></label>
            <p>
              <textarea name="google_analytics_code" rows="6" cols="50" class="large-text"><?php echo $o['google_analytics_code']; ?></textarea>
            </p>
            <input id="exclude_admin_analytics" name="exclude_admin_analytics" type="checkbox" value="checkbox" <?php echo $o['exclude_admin_analytics'] ? "checked='checked'" : '';?>/>
            <label for="exclude_admin_analytics"><?php _e(' (管理员登录时不统计)', YHL); ?></label>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><?php _e('<h5>Notice</h5><em>HTML enabled </em>',YHL); ?></th>
          <td class="form-field">
            <?php _e('Homepage notice',YHL); ?><br/>
            <input id="notice" name="notice" type="checkbox" value="checkbox"<?php if($o['notice']) echo "checked='checked'"; ?> />
            <label for="notice"><?php _e('This notice bar will display at the top of posts on homepage. ',YHL); ?></label>
            <p>
              <textarea name="notice_content" rows="4" cols="50" class="large-text"><?php echo $o['notice_content']; ?></textarea>
            </p>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><h5>帅哥美女认证</h5><em>请填入想要认证的邮箱来判断 </em></th>
          <td class="form-field">
            <label>
            帅哥名单(两个邮箱之间用英文逗号隔开)
            <textarea name="handsome" id="handsome" cols="50" rows="2"><?php echo($o['handsome']); ?></textarea>
            </label><br/><br/>
            <label>
            美女名单(两个邮箱之间用英文逗号隔开)
            <textarea name="beauty" id="beauty" cols="50" rows="2"><?php echo($o['beauty']); ?></textarea>
            </label>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><?php _e('<h5>Advertisement</h5><em>This AD will show in single post instead of the \'&lt;!--more--&gt;\' tag</em>. Size: 468x60',YHL); ?></th>
          <td class="form-field">
            <input id="showad" name="showad" type="checkbox" value="checkbox" <?php echo $o['showad'] ? "checked='checked'" : '';?>/>
            <label for="showad"><?php _e('Show advertisement', YHL); _e(' (Not displayed while doing ajax or the admin logged-in)', YHL); ?></label>
            <p>
              <textarea name="ad" rows="4" cols="50" class="large-text"><?php echo $o['ad']; ?></textarea>
            </p>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><h5>Feed及版权信息设置</h5></th>
          <td class="form-field">
            <input id="feed" name="feed" type="checkbox" value="checkbox" <?php if($o['feed']) echo "checked='checked'"; ?> />
            <label for="feed"><?php _e('Use custom feed.', YHL); ?></label><br/>
            <?php _e('Custom feed URL:', YHL); ?>
            <input type="text" name="feed_url" id="feed_url" value="<?php echo $o['feed_url']; ?>"><br/><br/>
            <input id="feed_email" name="feed_email" type="checkbox" value="checkbox" <?php if($o['feed_email']) echo "checked='checked'"; ?> />
            <label for="feed_email"><?php _e('Use E_mail feed.', YHL); ?></label><br/>
            <?php _e('E_mail feed URL:', YHL); ?>
            <input type="text" name="feed_url_email" class="code" value="<?php echo $o['feed_url_email']; ?>"><br/><br/>
            <label>
            <input name="rss_additional_show" type="checkbox" value="checkbox" <?php if($o['rss_additional_show']) echo "checked='checked'"; ?> />
            添加自定义文字到 文章和RSS 输出中.比如版权信息等.
            </label>
            <br/>
            <label for="rss_copyright">
            在下面填写自定义信息(支持HTML代码).
            </label>
            <br/>
            <textarea name="rss_additional" cols="50" rows="5"><?php echo $o['rss_additional']; ?></textarea>
            <div class="info">
              <p>你可以在您的代码中使用下面这些占位符：</p>
              <ul>
                <li>%BLOG_LINK% - 博客地址</li>
                <li>%FEED_URL% - RSS订阅地址</li>
                <li>%POST_URL% - 文章固定链接</li>
                <li>%POST_TITLE% - 文章标题</li>
              </ul>
              <p>例如：本文链接地址：&lt;a href="%POST_URL%">%POST_TITLE%&lt;/a><br />
              欢迎&lt;a href="%FEED_URL%">订阅我们&lt;/a> 来阅读更多有趣的文章。</p>
              <p>输出结果将被包围在一个DIV元素中</p>
            </div>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('<h5>Header background image</h5>',YHL); ?></th>
          <td class="form-field">
            <label><?php _e('Select an Image (at least size 920 px by 145 px .You can upload more files to <code>themes\philna2\images\headers</code> :)',YHL); ?><br/>
            <select name="headimg"><?php echo philnaHeadImage('option'); ?></select>
            </label><br/>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('<h5>PhilNa say</h5>',YHL); ?></th>
          <td class="form-field">
            <label>
            <input id="show_philna_say" name="show_philna_say" type="checkbox" <?php if($o['show_philna_say']) echo "checked='checked'"; ?> />
            <?php _e('Show philna say on header',YHL); ?>
            </label><br/>
            <label>
            <?php  _e('Say what?(One sentence per line)',YHL); ?>
            <textarea name="philna_say" id="philna_say" cols="50" rows="8"><?php echo($o['philna_say']); ?></textarea>
            </label>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit">
      <input class="button-primary" type="submit" value="<?php _e('Save Changes', YHL); ?>" name="Submit"/>
      <input type="hidden" name="savephilnaopt" value="save" />
    </p>
  </form>
</div>
