<?php
/**
 * admin
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

class PhilNaAdmin {

  private $opt = array();

  public function __construct(){
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
    $optDefines = $GLOBALS['philnaopt']['optDefines'];
    foreach($data as $key => $value){
      if(array_key_exists($key, $optDefines)){
        if($optDefines[$key][0] == 'string'){
          if($value == '' && isset($optDefines[$key][1])){
            $value = $optDefines[$key][1];
          }
          $this->opt[$key] = rtrim( preg_replace('/\n\s*\r/', '', $value) );
          $this->opt[$key] = str_replace('<!--', '', $this->opt[$key]);
          $this->opt[$key] = str_replace('-->', '', $this->opt[$key]);
        }else if($optDefines[$key][0] == 'bool'){
          $this->opt[$key] = (bool)$value;
        }
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
  // add hooks
  include_once dirname(__FILE__).'/hooks.php';
  new PhilNaAdmin();
}
