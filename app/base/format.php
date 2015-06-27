<?php
/**
 *format
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');


/**
 * 添加转义字符
 *
 * @param $data
 * @return string|array
 */
function philnaAddslashes($data){
  if(is_array($data)){
    foreach($data as &$value){
      philnaAddslashes($value);
    }
  }else{
    addslashes($data);
  }
  return $data;
}

/**
 * 去掉转义字符
 *
 * @param string|array $data
 * @return string|array
 */
function philnaStripslashes($data){
  if(is_array($data)){
    foreach($data as &$value){
      philnaStripslashes($value);
    }
  }else{
    stripslashes($data);
  }
  return $data;
}

/**
 * 将数组转换为字符
 *
 * 用于缓存
 *
 * @param $data
 * @return string
 */
function philnaArray2String($data, $returns = ''){
  static $t = 1;
  $tabType = "    ";
  $tab = str_repeat($tabType,$t);
  $data = (array)$data;
  foreach($data as $key=>$value){
    if(is_array($value)){
      $t++;
      $returns .= "$tab'".$key."' => array(\n".philnaArray2String($value)."$tab),\n";
    }else{
      if(!is_bool($value)){
        $value = "'".addslashes($value)."'";
      }
      $returns .= "$tab'".$key."' => $value,\n";
    }

  }
  $returns = substr_replace($returns,'',-2,-1);
  return $returns;
}

/**
 * 去掉标签
 *
 * @param string $str
 * @param string $allow
 * @return string
 */
function philnaStriptags($str,$allow = ''){
  $str = preg_replace('/(\r\n)|(\n)/', '', $str); // 消灭换行符
  $str = strip_tags($str,$allow); //去掉html标签
  $str = preg_replace('/\[(.+?)\]/', '', $str); // 消灭'[]'这样的标签
  return $str;
}

/**
 * 格式化内容
 *
 * 对内容使用滤过器
 *
 * @param string $content
 * @return string
 */
function philnaContentFormat($content){
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

/**
 * 截取字符
 *
 * @param string $str
 * @param int $length
 * @return string
 */
function philnaSubstr($str, $len = 100){
  if(!$str){
    return;
  }

  if( strlen( $str ) <= $len ){
    return $str;
  }else{
    $ellipsis = '...';
  }

  $new_str = array();
  for($i=0;$i<$len;$i++){
    $temp_str=substr($str,0,1);
    if(ord($temp_str) > 127){
      $i++;
      if($i<$len){
        $new_str[]=substr($str,0,3);
        $str=substr($str,3);
      }
    }else{
      $new_str[]=substr($str,0,1);
      $str=substr($str,1);
    }
  }
  $new_str = join($new_str);
  $new_str .=$ellipsis;

  return $new_str;
}
