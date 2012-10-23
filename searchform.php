<?php
/**
 * searchform
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

?>
<div id="searchform" class="box">
<?php if($GLOBALS['philnaopt']['google_cse'] && $GLOBALS['philnaopt']['google_cse_cx']): ?>
	<div id="search" class="s_google">
		<form action="<?php bloginfo('home')?>/cse" id="cse-search-box">
  <div id="searchbox">
    <input id="searchinput" class="textfield" type="text" name="q" size="24" value="" tabindex="12" />
    <input id="searchbtn" class="button" type="submit" name="sa" value="" title="Search" />
    <input type="hidden" name="cx" value="<?php echo $GLOBALS['philnaopt']['google_cse_cx']; ?>" />
    <input type="hidden" name="cof" value="FORID:11" />
    <input type="hidden" name="ie" value="UTF-8" />
    
  </div>
</form>
	</div>
<?php else: ?>
	<div id="search" class="s_wp">
		<form id="wpsearchform" action="<?php bloginfo('home');?>/" method="get">
			<div id="searchbox">
			<input id="searchinput" type="text" class="textfield" name="s" value="<?php echo isset($s) ? wp_specialchars($s, 1) : ''; ?>" title="<?php _e('Search posts',YHL); ?>" tabindex="12"/>
			<input id="searchbtn" class="button" type="submit" value="" title="Search"/>
			</div>
		</form>
	</div>
<?php endif; ?>
</div>
