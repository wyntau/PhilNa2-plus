<?php
/**
 * admin
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

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
  // add hooks
  include_once dirname(__FILE__).'/hooks.php';
  // default theme option type
  $philnaDefaultOptType = array(
    'string' => array(
      'keywords',
      'description',
      'google_cse_cx',
      'notice_content',
      'ad',
      'feed_url',
      'feed_url_email',
      'rss_additional',
      'headimg',
      'philna_say_list',

      'post_list_type',
      'title_loading_text',
      'ajax_loading_text',

      'google_analytics_code',
      'handsome',
      'beauty',
      'excerpt_length'
    ),
    'bool' => array(
      'gravatar_cache',
      'google_cse',
      'notice',
      'showad',
      'feed',
      'feed_email',
      'rss_additional_show',
      'philna_say_enable',
      'enable_google_analytics',
      'exclude_admin_analytics'
    )
  );
  new PhilNaAdmin($philnaDefaultOptType);
}
