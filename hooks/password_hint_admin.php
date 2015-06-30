<?php
/**
 * password hint
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');
/**
 * 在后台添加有关 密码提示 的相关信息
 *
 * @see do_action('submitpost_box')
 * @see do_action('submitpage_box')
 * @return null
 */
function philnaPasswordHintForAdmin(){
  $h3 = __('How to set a password hint.',YHL);
  $words = __('If your are posting a password protected post article. Please add a new <a href="#postcustom">custom field</a> width the name \'password_hint\'',YHL);
  $html=<<<END
<div class="stuffbox meta-box-sortables ui-sortable">
  <h3>$h3</h3>
  <div class="inside">
    <p>$words</p>
  </div>
</div>
END;
  echo $html;
}
add_action('submitpost_box', 'philnaPasswordHintForAdmin');
add_action('submitpage_box', 'philnaPasswordHintForAdmin');
