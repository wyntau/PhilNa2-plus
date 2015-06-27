<?php
/*
* 文章内容部分文字toggle伸缩,源代码取自林木木博客
*自己稍加修改,添加后台编辑器按钮,方便朋友们添加
*/
function single_toggle($atts, $content=null){
  extract(shortcode_atts(array("title"=>' 此处有货↑ '),$atts));
  return '<p class="tg_t">'.$title.' ↓ </p><p class="tg_c" style="display:none;">'.$content.'</p>';
}
add_shortcode('toggle','single_toggle');
if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php')){
    function SayMe_add_toggle_tags(){
    echo <<<EOT
<script type="text/javascript">
  function insertToggle(){
    var text=prompt('请输入想要Toggle显示的内容','');
    if(!text){
      return false;
    }
    var title = prompt('标题?' , '使用默认标题请直接确定');
    title= title=='使用默认标题请直接确定'? '':title;
    if(title){
      edInsertContent(edCanvas, "[toggle title=\"" + title+"\"]" + text + "[/toggle]");
    }else{
      edInsertContent(edCanvas, "[toggle]" + text + "[/toggle]");
    }
  }
  if(document.getElementById("ed_toolbar")){
    qt_toolbar = document.getElementById("ed_toolbar");
    edButtons[edButtons.length] = new edButton('toggle' ,'toggle' ,'[toggle]' ,'[/toggle]' ,'' );
    var qt_button = qt_toolbar.lastChild;
    while (qt_button.nodeType != 1){
      qt_button = qt_button.previousSibling;
    }
    qt_button = qt_button.cloneNode(true);
    qt_button.value = 'Tog';
    qt_button.title = '插入Toggle内容';
    qt_button.onclick = function () { insertToggle();}
    qt_button.id = "ed_audio";
    qt_toolbar.appendChild(qt_button);
  }
</script>
EOT;
  }
  add_action('admin_footer','SayMe_add_toggle_tags');
}
