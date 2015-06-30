<?php
/**
 * homepage notice
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

if(is_home() && $GLOBALS['philnaopt']['notice'] && $GLOBALS['philnaopt']['notice_content']):
$notice = '<div id="notice" class="box">'.apply_filters('the_content',$GLOBALS['philnaopt']['notice_content']).'</div>';
$notice = '\''.addslashes($notice).'\'';
$notice = preg_replace('/\n/','\n', $notice);
?>
<script type="text/javascript">
  /* <![CDATA[ */
  var PHILNANOTICE = <?php echo $notice; ?>;
  document.write(PHILNANOTICE);
  /* ]]> */
</script>
<?php endif; ?>
