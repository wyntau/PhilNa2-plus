<?php
/**
 * homepage notice
 * display by javascript
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * Required Version:
 * 	PHP5 or higher
 * 	WordPress 2.9 or higher
 *
 * If you find my work useful and you want to encourage the development of more free resources,
 * you can do it by donating...
 * 	paypal: yinheli@gmail.com
 * 	alipay: yinheli@gmail.com
 *
 * @author yinheli <yinheli@gmail.com>
 * @link http://philna.com/
 * @copyright Copyright (C) 2009 yinheli All rights reserved.
 * @license PhilNa2 is released under the GPL.
 * @version $Id$
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
