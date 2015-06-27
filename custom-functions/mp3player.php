<?php
/********************************
 *提供对于mp3短代码的支持.
 *SayMe修改,添加对于播放器自动播放的支持参数
 ******************************/
function mp3player($atts, $content=null){
  extract(shortcode_atts(array("auto"=>'0'),$atts));
  $autostart=$auto?'yes':'no';
  return '<embed src="'.get_bloginfo('template_directory').'/swf/player.swf?soundFile='.$content.'&autostart='.$autostart.'&animation=yes&encode=no&initialvolume=80&remaining=yes&noinfo=no&buffer=5&checkpolicy=no&rtl=no&bg=E5E5E5&text=333333&leftbg=CCCCCC&lefticon=333333&volslider=666666&voltrack=FFFFFF&rightbg=B4B4B4&rightbghover=999999&righticon=333333&righticonhover=FFFFFF&track=FFFFFF&loader=009900&border=CCCCCC&tracker=DDDDDD&skip=666666" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="290" height="30">';
  }
add_shortcode('mp3','mp3player');

/**************************
**后台编辑器添加mp3按钮,方便添加mp3
**************************/
if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php')){
    function SayMe_add_mp3_tags(){
      echo <<<EOT
<script type="text/javascript">
  function insertAudio(){
    var U=prompt('请输入mp3 URL','http://');
    if(!U){
      return false;
    }
    var audio_url = jQuery.trim(U);
    if(audio_url == null || audio_url == "" || audio_url =='http://'){
      alert('请输入正确的mp3 URL!');
      return false;
    }else{
      var autostart = prompt('auto autostart?' , '0');
      edInsertContent(edCanvas, "[mp3 auto=" + autostart+"]" + audio_url + "[/mp3]");
    }
  }
  if(document.getElementById("ed_toolbar")){
    qt_toolbar = document.getElementById("ed_toolbar");
    edButtons[edButtons.length] = new edButton('mp3' ,'mp3' ,'[mp3]' ,'[/mp3]' ,'' );
    var qt_button = qt_toolbar.lastChild;
    while (qt_button.nodeType != 1){
      qt_button = qt_button.previousSibling;
    }
    qt_button = qt_button.cloneNode(true);
    qt_button.value = 'mp3';
    qt_button.title = '插入mp3';
    qt_button.onclick = function () { insertAudio();}
    qt_button.id = "ed_audio";
    qt_toolbar.appendChild(qt_button);
  }
</script>
EOT;
  }
  add_action('admin_footer','SayMe_add_mp3_tags');
}
