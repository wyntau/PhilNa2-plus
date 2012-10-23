<?php
/**
 * ajax base
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
defined('ABSPATH') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

/**
 * is ajax query
 */
function philnaIsAjaxURL() {
	if((isset($_GET['do']) && $_GET['do'] == 'ajax') || (isset($_POST['do']) && $_POST['do'] == 'ajax')) {
		return true;
	}else{
		return false;
	}
}

/**
 * get ajax action
 *
 * @return null|string
 */
function getAjaxAction() {
	if(!philnaIsAjaxURL()) {
		return;
	}

	if(isset($_GET['action']) && $_GET['action']) {
		return trim($_GET['action']);
	}elseif(isset($_POST['action']) && $_POST['action']) {
		return trim($_POST['action']);
	}else{
		return;
	}
}

if(isset($_GET['do']) && $_GET['do'] == 'ajax'){ // for ajax!
	defined('DOING_AJAX') || define('DOING_AJAX', true);
	if(isset($_GET['action']) ){
		if('philnaAjaxGetComment' == $_GET['action']){
			defined('PHILNATIP') || define('PHILNATIP', true);
		}
	}
}

/**
 * Ajax
 *
 * @author yinheli
 *
 */
class PhilNaAjax {
	// hold normal ajax function names
	private $ajaxFunctions = array(
		'philnaSay', 'philnaAjaxGetComment', 'philnaAjaxComment', 'philnaModifyComment'
	);
	// hooked on action 'template_redirect'
	private $hookTRAjaxFunctions = array(
		'philnaDynamic',
	);
	// hooked on action 'init'
	private $hookInitAjaxFunction = array(
		'philnaAjaxCommentsPage',
	);

	private $allFunctions = array();

	/**
	 * @ignore
	 */
	public function __construct($action) {
		$this->allFunctions = array_merge($this->ajaxFunctions, $this->hookTRAjaxFunctions, $this->hookInitAjaxFunction);

		if(!in_array($action, $this->allFunctions) && !is_bot()) {
			status_header('400'); // 400 Bad Request
			die(__('Method NOT allowed!',YHL));
		}

		$this->hookAction($action);
	}

	/**
	 * Hook function to actions
	 *
	 * @param ajax action function name
	 */
	private function hookAction($action) {
		$hook = '';
		if (in_array($action, $this->ajaxFunctions)) {
			$hook = 'PhilNaReady';
		} elseif (in_array($action, $this->hookTRAjaxFunctions)) {
			$hook = 'template_redirect';
		} elseif (in_array($action, $this->hookInitAjaxFunction)) {
			$hook = 'init';
		}

		if(!empty($hook)){
			add_action($hook, $action);
			add_action($hook, array('PhilNaAjax', '_exitAjax'), 9999);
		}
	}

	/**
	 * after ajax done, exit
	 */
	public static function _exitAjax() {
		exit;
	}
}

if (philnaIsAjaxURL()) {
	defined('DOING_AJAX') || define('DOING_AJAX', true);

	$ajaxAction = getAjaxAction();

	if ($ajaxAction === 'philnaAjaxGetComment'){
		defined('PHILNATIP') || define('PHILNATIP', true);
	}

	if(!empty($ajaxAction)){
		$philnaAjax = new PhilNaAjax($ajaxAction);
	}
}
