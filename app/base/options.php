<?php
/**
 * get philna options
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
 * Get options
 *
 * @author yinheli
 *
 */
class PhilNaGetOpt implements ArrayAccess {

	/**
	 * 所有设置
	 *
	 * @var array
	 */
	private $philnaOpt = array();

	/**
	 * 获取设置对象
	 *
	 * @var PhilNaGetOpt
	 */
	private static $_instance;

	/**
	 * 从数据库中取得设置
	 *
	 * @return null
	 */
	private function __construct() {
		if ($r = get_option('philnaopt')) {
			$this->philnaOpt = $r;
			unset($r);
		}
	}

	/**
	 * 不许克隆
	 */
	private function __clone() {}

	/**
	 * 获取 PhilNaGetOpt 单一实例
	 *
	 * @return PhilNaGetOpt
	 */
	public static function getInstance() {
		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * 重新取得设置
	 *
	 * @return null
	 */
	public function reGet() {
		$this->__construct();
	}

	/**
	 * 给定的偏移量是否存在?
	 *
	 * @return bool
	 */
	public function offsetExists($key) {
		if (array_key_exists($key, $this->philnaOpt)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 返回给定偏移量上的数据
	 *
	 * @return null|mix
	 */
	public function offsetGet($key){
		if (array_key_exists($key, $this->philnaOpt)) {
			if (is_string($this->philnaOpt[$key])) {
				return stripslashes($this->philnaOpt[$key]);
			} else {
				return $this->philnaOpt[$key];
			}
		} else {
			return null;
		}
	}

	/**
	 * 设置给定偏移量上的数据
	 *
	 * @return bool|mix
	 */
	public function offsetSet($key, $val) {
		if (array_key_exists($key, $this->philnaOpt)) {
			$this->philnaOpt[$key] = $val;
			return $val;
		} else {
			return false;
		}
	}

	/**
	 * 置空给定偏移量上的数据
	 *
	 * @return bool
	 */
	public function offsetUnset($key) {
		if (array_key_exists($key, $this->philnaOpt)) {
			unset($this->philnaOpt[$key]);
			return true;
		} else {
			return false;
		}
	}
}
