<?php
/**
 * highlight keywords
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');


/**
 * highlight keywords
 *
 * @param array $keywords
 * @param unknown_type $content
 * @return unknown_type
 */
function philnaHighLightKeyWords( array $keywords, $content ){

  $hightLightColors = array('#FFFF00','#A0FF40','#FFD700','#DAA520','#60FF00');

  /* 非法字符 主要是特殊字符 */
  $notAllowed = array('$','(',')','*','+','.','?','[',']','\',','^','{','}','|');
  $shouldRemove = array('&',';','>','<');

  /* 没有关键字直接返回 */
  if (empty($keywords)){
    return $content;
  }
  /*
   对于想单(双)引号(',")
   这样的字符wp本身在查询的时候会去掉的.
   但是留下个空的值.并且会查询数据库
   暂时不知道为什么wp要这么处理
   猜想是:文章中难免有html标签,有标签意味着有引号.
   搜索引号就没有多大意义.
   原本以为加引号代表精确搜索,结果出现了乱码
   经测试发现是以上原因

   ∴ 这里做个判断.免得在替换的换的时候出错
   */
  /* 去掉空值 和 一些内容 */
  foreach ($keywords as $index=>$val){
    if(empty($val))
    unset($keywords[$index]);
    if(in_array($val,$shouldRemove))
    unset($keywords[$index]);
  }

  if (empty($keywords)) return $content;

  /* 选择颜色数组索引 */
  $slecet = 0;
  //$c .= '<span></span>';
  /*
   开始历遍,每个(种)关键字
   将从颜色集合数据组中选用使用不同的颜色
   注意:
   同一个关键字在文章不同的地方,颜色是相同的
   */
  foreach ($keywords as $keyword) {
    /* 关键字数量大于颜色数组数量时,索引重置 */
    if($slecet >= count($hightLightColors))
    $slecet = 0;
    //$c .= $slecet;
    /* 选择一种颜色 */
    $hightLightColor = $hightLightColors[$slecet];
    /* 累加索引 */
    $slecet++;
    /* 滤过非法字符 必须将这些字符转义 */
    $keyword = wptexturize($keyword);
    $RegExpkeyword = $keyword;
    foreach ($notAllowed as $v){
      $RegExpkeyword = str_replace($v,'\\'.$v,$RegExpkeyword);
    }
    /* 正则表达式(这是替换[高亮]的关键) 不区分大写小写 */
    $RegExp = "/($RegExpkeyword)(?=[^<>&;]*[&<])/i";
    /* 开始替换 */
    $content = preg_replace($RegExp,'<span style="background:'.$hightLightColor.';">$1</span>',$content);
  }
  //$c = str_replace('<span></span>','',$c);
  return $content;


}

/**
 * highlight WP search keywords
 *
 * @param unknown_type $content
 * @return unknown|unknown|Ambigous <mixed, unknown_type>
 */
function philnaHighlightWPSearchKeywords($content){
  if(!is_search()) return $content;
  global $wp_query;
  $keywords = $wp_query->query_vars['search_terms'];
  if(empty($keywords)){
    return $content;
  }

  return philnaHighLightKeyWords( $keywords, $content );

}
add_filter('the_content', 'philnaHighlightWPSearchKeywords', 100);
