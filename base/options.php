<?php
/**
 * get philna options
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
    if($key == 'optDefines'){
      return $this->philnaOptDefines;
    }else if (array_key_exists($key, $this->philnaOptDefines)) {

      if(array_key_exists($key, $this->philnaOpt)){
        $value = $this->philnaOpt[$key];
      }else{
        $value = null;
      }

      if($this->philnaOptDefines[$key][0] == 'string'){
        if(!$value && array_key_exists(1, $this->philnaOptDefines[$key])){
          $value = $this->philnaOptDefines[$key][1];
        }
        return stripslashes($value);
      }else{
        return $value;
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

  /**
   * 选项的类型及默认值
   * @var array
   */
  private $philnaOptDefines = array(
    'keywords' => array('string'),
    'description' => array('string'),

    'post_list_type' => array('string'),
    'title_loading_text' => array('string', '页面载入中......'),
    'ajax_loading_text' => array('string', 'AjaxLoading......'),

    'excerpt_length' => array('string', '220'),

    'gravatar_cache' => array('bool'),

    'google_cse' => array('bool'),
    'google_cse_cx' => array('string'),

    'enable_google_analytics' => array('bool'),
    'exclude_admin_analytics' => array('bool'),
    'google_analytics_code' => array('string'),

    'notice' => array('bool'),
    'notice_content' => array('string'),

    'handsome' => array('string'),
    'beauty' => array('string'),

    'showad' => array('bool'),
    'ad' => array('string'),

    'feed' => array('bool'),
    'feed_email' => array('bool'),
    'feed_url' => array('string'),
    'feed_url_email' => array('string'),
    'rss_additional_show' => array('bool'),
    'rss_additional' => array('string'),

    'headimg' => array('string'),

    'philna_say_enable' => array('bool'),
    'philna_say_list' => array('string')
  );
}

// init philna options
$GLOBALS['philnaopt'] = PhilNaGetOpt::getInstance();
