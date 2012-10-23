<?php
/**
 * admin
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


if(is_admin()) include_once dirname(__FILE__).'/hooks.php';

class PhilNaAdmin {
	private $stringOpt = array();
	private $boolOpt = array();
	private $opt = array();

	public function __construct(array $opt){
		$this->stringOpt = isset($opt['string']) ? (array)$opt['string'] : array();
		$this->boolOpt = isset($opt['bool']) ? (array)$opt['bool'] : array();
		add_action('admin_menu', array($this,'_admin'));
	}

	/**
	 * add admin options page
	 * @return unknown_type
	 */
	public function _admin(){
		$page = add_theme_page(__('Current Theme Options',YHL), __('PhilNa2 Settings',YHL), 10, 'PhilNa2admin', array($this, '_adminPanel'));
		if ( function_exists('add_contextual_help') ){
			$help = '<a href="http://philna.com/about/" target="_blank">'.__('PhilNa2 Bug Tracker', YHL).'</a>';
			add_contextual_help($page,$help);
		}
	}

	/**
	 * display the options page
	 *
	 * @return unknown_type
	 */
	public function _adminPanel(){
		include_once dirname(__FILE__).'/optionspage.php';
	}

	public function save($data){
		if(!$_POST) return;
		foreach($data as $key=>$value){
			if(in_array($key, $this->stringOpt)){
				$this->opt[$key] = rtrim( preg_replace('/\n\s*\r/', '', $value) );
				$this->opt[$key] = str_replace('<!--', '', $this->opt[$key]);
				$this->opt[$key] = str_replace('-->', '', $this->opt[$key]);
			}elseif(in_array($key, $this->boolOpt)){
				$this->opt[$key] = (bool)$value;
			}
		}
		do_action('savePhilNaOpt');
		if(!isset($this->opt['feed_url'])){
			$this->opt['feed_url'] = get_bloginfo('rss2_url');
		}elseif(empty($this->opt['feed_url'])){
			$this->opt['feed_url'] = get_bloginfo('rss2_url');
		}
		update_option('philnaopt', $this->opt);
	}
}


// admin options
if(is_admin()){
	$philnaDefaultOptType = array(
		'string'=>array('keywords', 'description', 'google_cse_cx', 'notice_content', 'ad', 'feed_url',
						'feed_url_email', 'rss_additional', 'headimg', 'philna_say' ,'LoadText','AjaxLoading','google_analytics_code','handsome','beauty','excerpt_length'),
		'bool'  =>array('cacheavatar','google_cse', 'notice', 'showad', 'feed', 'feed_email', 'rss_additional_show',
						'show_philna_say','homeslide','enable_google_analytics','exclude_admin_analytics','no_home_slide'),
	);
	new PhilNaAdmin($philnaDefaultOptType);
}
