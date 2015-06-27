<?php
/*************************************************************
 * 博客右上角欢迎词
 * 摘自winysky的W1s主题,
 *呵呵,winysky也是在philna2的早期版本中摘取的,所以我又加上了.
 ************************************************************/
function welcome_msg(){  
    if(is_bot()){
    return;
  }
  if($m = apply_filters('welcome_msg',$string)){
    echo $m;
    return;
  }
  global $referer;
  $referer=$_SERVER['HTTP_REFERER'];
  $hostinfo=parse_url($referer);
  $host_h=$hostinfo["host"];
  $host_p=$hostinfo["path"];
  $host=array($host_h,$host_p);
  if(substr($host_h, 0, 4) == 'www.')
    $host_h = substr($host_h, 4);
    $host_h_url='<a href="http://'.$host_h.'/">$host_h</a>';
    if($referer==""){
      echo "<!--您直接访问了本站!-->\n";
      if($_COOKIE["comment_author_" . COOKIEHASH]!=""){
        echo 'Howdy, <strong>'.$_COOKIE["comment_author_" . COOKIEHASH].'</strong>, 欢迎回来';
      }else{
        echo "您直接访问了本站!  莫非您记住了我的<strong>域名</strong>.厉害~我倍感荣幸啊 嘿嘿";
      }  
    //搜索引擎
      //baidu
    }elseif(preg_match('/baidu.*/i',$host_h)){
      echo "您通过 <strong>百度</strong> 找到了我! 厉害.你要是能够订阅我的博客那就更好了.我经常分享一些好东西哦";
      //google
    }elseif(!preg_match('/www\.google\.com\/reader/i',$referer) && preg_match('/google\./i',$referer)){
      echo "您通过 <strong>Google</strong> 找到了我! 厉害. 你要是能够订阅我的博客那就更好了. 我经常分享一些好东西哦";
      //yahoo
    }elseif(preg_match('/search\.yahoo.*/i',$referer) || preg_match('/yahoo.cn/i',$referer)){
      echo "您通过 <strong>Yahoo</strong> 找到了我! 厉害. 你要是能够订阅我的博客那就更好了. 我经常分享一些好东西哦";
    //阅读器
      //google
    }elseif(preg_match('/google\.com\/reader/i',$referer)){
      echo "感谢你通过 <strong>Google</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
      //xianguo
    }elseif(preg_match('/xianguo\.com\/reader/i', $referer)){
      echo "感谢你通过 <strong>鲜果</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
      //zhuaxia
    }elseif(preg_match('/zhuaxia\.com/i', $referer)){
      echo "感谢你通过 <strong>抓虾</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
      //哪吒
    }elseif(preg_match('/inezha\.com/i', $referer)){
      echo "感谢你通过 <strong>哪吒</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
      //有道
    }elseif(preg_match('/reader\.youdao/i', $referer)){
      echo "感谢你通过 <strong>有道</strong> 订阅我!  既然过来读原文了. 欢迎留言指导啊.嘿嘿 ^_^";
      //自己  
    }elseif(self()){
      echo "你在找什么吗？试试旁边的搜索吧~"."\n";
    }elseif($_COOKIE["comment_author_" . COOKIEHASH]!=""){
      echo 'Howdy, <strong>'.$_COOKIE["comment_author_" . COOKIEHASH].'</strong>欢迎从<strong>'.$host_h.'</strong>回来';
    }else{
      echo '欢迎来自<strong>'. $host_h.'</strong>的朋友. 我经常分享一些好东西哦 ^_^  欢迎订阅我的博客.';
    }
     
}
//判断是自己的函数
function self(){
  $local_info = parse_url(get_option('siteurl'));
    $local_host = $local_info['host'];
  //check self
  if ( preg_match("/^http:\/\/(\w+\.)?($local_host)/",$_SERVER['HTTP_REFERER']) != 0) return true;
}
  /**
   * 分析浏览器 对于使用IE老版本的用户推送提醒
   * 不要过分推送, 根据cookie判断
   * 比如 对IE6的推送! 我希望是每隔20秒要有一次!
   * @see setcookie_for_ie()
   */
function killIE($msg){   
  if(preg_match('/MSIE\s6/i', $_SERVER['HTTP_USER_AGENT'])){
    if(!$_COOKIE['alert_ie_visitor_'.COOKIEHASH]){
      $msg .= '<p>呃~ , 我不得不再提示一下:</p>';
      $msg .= '<p>您正在使用古老的 Internet Explorer 浏览网页, 该浏览器不符合W3C国际标准, 本站网页可能显示不正常,或部分功能无法使用</p><br/><p> 如果您<strong><a rel="nofollow" title="ie8" href="http://www.microsoft.com/windows/internet-explorer/">升级到 Internet Explorer 8</a></strong> 或<strong>转换到另一个浏览器</strong>, 本站将能为您提供更好的服务. </p>';
      //add_action('init', 'setcookie_for_alert_ie_visitor');
    }
  }elseif(preg_match('/MSIE\s7/i', $_SERVER['HTTP_USER_AGENT'])){
    if(!$_COOKIE['alert_ie_visitor_'.COOKIEHASH]){
      $msg .= '<p>呃~ , 顺便提示一下:</p>';
      $msg .= '<p>您正在使用旧版本的 Internet Explorer 版本浏览网页，如果您<strong><a rel="nofollow" title="ie8" href="http://www.microsoft.com/windows/internet-explorer/">升级到 Internet Explorer 8</a></strong> 或<strong>转换到另一个浏览器</strong>, 本站将能为您提供更好的服务. </p>';
    }
  }elseif(preg_match('/MSIE\s8/i', $_SERVER['HTTP_USER_AGENT'])){
    if(!$_COOKIE['alert_ie_visitor_'.COOKIEHASH]){
      $msg .= '<p>呃~ , 顺便提示一下:</p>';
      $msg .= '<p>很高兴看到你使用较高版本的 Internet Explorer 浏览器! 但是我还是要向您<strong>推荐: </strong><br/>速度最快的 <strong><a rel="nofollow" title="chrome" href="http://www.google.com/chrome/">Chrome</a></strong> 和定制性最强的 <strong><a rel="nofollow" title="firefox" href="http://www.mozilla.com/">Firefox</a></strong> </p>';
    }
  }else{
    return;
  }
return $msg;
  }
add_filter('welcome_msg','killIE');

/**
 * 对于来了很多次也不评论的家伙提醒
 * 创建一个cookie用来计数
 * 结合ajax评论函数,评论后将计算器设置为-5
 * 这样评论后可以有个较长的缓和期
 * @since 2.0.1
 * @see welcome_msg, setcookie_for_alert_commentator
 * 修改了cookies的写入方法,这里只读取cookies
 */
function alert_commentator($msg){
  global $user_ID;
  //管理员是个例外.不能对管理员推送!
  if($user_ID){
    return;//just return null;
  }
  if(!isset($_COOKIE['comment_author_visit_times_'.COOKIEHASH]))
    return;//
  //当次数>=6次时 推送提示
  //由于在init上写入cookie所以实际上要等cookie累加到7是才显示提示!
  if(((int)$_COOKIE['comment_author_visit_times_'.COOKIEHASH])>=6){
    if($comment_author = $_COOKIE['comment_author_'.COOKIEHASH])
      $msg = '嗨~,&nbsp;&nbsp;'.$comment_author.' 我发现你来了很多次也没有留言! 欢迎发表你的看法.';
    else
      $msg = '新朋友? 老朋友? 我看你来了很多次却没有留言.欢迎发表你的看法.';
  }else{
    return;//
  }
  return $msg;
}
add_filter('welcome_msg','alert_commentator');

/**
 * 给访客设置一个计算器
 *
 * 作用:
 * 不过访客一直浏览,不留言计数器工作
 * 留言后将计数器归为-5
 *
 * @since 2.0.2
 */
function setcookie_for_alert_commentator(){
  if(is_bot())
    return;
  global $user_ID;
  if($user_ID)
    return;
  //如果没有计数器,写入
  if(!isset($_COOKIE['comment_author_visit_times_'.COOKIEHASH])){
    setcookie('comment_author_visit_times_'. COOKIEHASH, 1, time() + (60*60*24*300), COOKIEPATH, COOKIE_DOMAIN);
  }else{
    $visit_times = (int)$_COOKIE['comment_author_visit_times_'.COOKIEHASH];
    setcookie('comment_author_visit_times_'. COOKIEHASH, ++$visit_times, time() + (60*60*24*300), COOKIEPATH, COOKIE_DOMAIN);
  }
  //当次数大于7时 停止推送 因为连续推送了2次了
  if(((int)$_COOKIE['comment_author_visit_times_'.COOKIEHASH])>=7){
    //设置为0 重来
    setcookie('comment_author_visit_times_'. COOKIEHASH, -2, time() + (60*60*24*300), COOKIEPATH, COOKIE_DOMAIN);
  }
}
add_action('init', 'setcookie_for_alert_commentator');

/**
 * 针对ie不同版本设置不同的cookie
 *
 * 为了后面的推送升级通知
 */
function setcookie_for_ie(){
  if(isset($_COOKIE['alert_ie_visitor_'.COOKIEHASH]))
    return;
  if(preg_match('/MSIE\s6/i', $_SERVER['HTTP_USER_AGENT'])){
    //对于使用古老版ie用频繁推送 (cookies 5分钟失效)
    setcookie('alert_ie_visitor_'.COOKIEHASH,'ie6',time()+(20),COOKIEPATH,COOKIE_DOMAIN);

  }elseif(preg_match('/MSIE\s7/i', $_SERVER['HTTP_USER_AGENT'])){
    //对于使用ie7的用户减少推送 (cookies 3天失效)
    setcookie('alert_ie_visitor_'.COOKIEHASH,'ie7',time()+(60*60*24*3),COOKIEPATH,COOKIE_DOMAIN);

  }elseif(preg_match('/MSIE\s8/i', $_SERVER['HTTP_USER_AGENT'])){
    //对于使用ie8的用尽量不要推送 (cookies 100天失效)
    setcookie('alert_ie_visitor_'.COOKIEHASH,'ie8',time()+(60*60*24*10),COOKIEPATH,COOKIE_DOMAIN);
  }
}
add_action('init', 'setcookie_for_ie');
