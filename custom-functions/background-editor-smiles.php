<?php 
/**********************
**为后台编辑器添加表情支持
**********************/
        if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php')) 
{
    function SayMe_add_smiley()
    {
        echo <<<EOT
<script type="text/javascript"> 
	function grin(tag) 
        {
        var myField;
        tag = ' ' + tag + ' ';
        if (document.getElementById('content') && document.getElementById('content').style.display != 'none' && document.getElementById('content').type == 'textarea') 
        {
            myField = document.getElementById('content');    
            if (document.selection) 
            {
            myField.focus();
            sel = document.selection.createRange();
            sel.text = tag;
            myField.focus();
            }
            else 
                if (myField.selectionStart || myField.selectionStart == '0') 
                {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                var cursorPos = endPos;
                myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length);
                cursorPos += tag.length;
                myField.focus();
                myField.selectionStart = cursorPos;
                myField.selectionEnd = cursorPos;
                }
                else 
                {
                myField.value += tag;
                myField.focus();
                }
        } 
        else 
        {
        tinyMCE.execCommand('mceInsertContent', false, tag);
        }
    }
    var smiley=
'<p><a href="javascript:grin(\':no:\')"><img src="../wp-content/themes/philna2/images/smilies/1.gif"  /></a> <a href="javascript:grin(\':razz:\')"><img src="../wp-content/themes/philna2/images/smilies/17.gif"/></a> <a href="javascript:grin(\':sad:\')"><img src="../wp-content/themes/philna2/images/smilies/30.gif" /></a> <a href="javascript:grin(\':evil:\')"><img src="../wp-content/themes/philna2/images/smilies/2.gif" /></a> <a href="javascript:grin(\':eat:\')"><img src="../wp-content/themes/philna2/images/smilies/3.gif" /></a> <a href="javascript:grin(\':smile:\')"><img src="../wp-content/themes/philna2/images/smilies/33.gif" /></a> <a href="javascript:grin(\':sex:\')"><img src="../wp-content/themes/philna2/images/smilies/13.gif" /></a> <a href="javascript:grin(\':oops:\')"><img src="../wp-content/themes/philna2/images/smilies/25.gif" /></a> <a href="javascript:grin(\':grin:\')"><img src="../wp-content/themes/philna2/images/smilies/4.gif" /></a> <a href="javascript:grin(\':eek:\')"><img src="../wp-content/themes/philna2/images/smilies/18.gif" /></a> <a href="javascript:grin(\':han:\')"><img src="../wp-content/themes/philna2/images/smilies/6.gif" /></a> <a href="javascript:grin(\':zzz:\')"><img src="../wp-content/themes/philna2/images/smilies/29.gif" /></a> <a href="javascript:grin(\':shock:\')"><img src="../wp-content/themes/philna2/images/smilies/7.gif" /></a> <a href="javascript:grin(\':mask:\')"><img src="../wp-content/themes/philna2/images/smilies/27.gif" /></a> <a href="javascript:grin(\':surprise:\')"><img src="../wp-content/themes/philna2/images/smilies/26.gif" /></a> <a href="javascript:grin(\':jiong:\')"><img src="../wp-content/themes/philna2/images/smilies/8.gif" /></a> <a href="javascript:grin(\':cold:\')"><img src="../wp-content/themes/philna2/images/smilies/14.gif" /></a> <a href="javascript:grin(\':han:\')"><img src="../wp-content/themes/philna2/images/smilies/15.gif" /></a> <a href="javascript:grin(\':shut:\')"><img src="../wp-content/themes/philna2/images/smilies/23.gif" /></a> <a href="javascript:grin(\':???:\')"><img src="../wp-content/themes/philna2/images/smilies/5.gif" /></a> <a href="javascript:grin(\':cool:\')"><img src="../wp-content/themes/philna2/images/smilies/10.gif" /></a> <a href="javascript:grin(\':ool:\')"><img src="../wp-content/themes/philna2/images/smilies/32.gif" /></a> <a href="javascript:grin(\':lol:\')"><img src="../wp-content/themes/philna2/images/smilies/24.gif" /></a> <a href="javascript:grin(\':mad:\')"><img src="../wp-content/themes/philna2/images/smilies/31.gif" /></a> <a href="javascript:grin(\':love:\')"><img src="../wp-content/themes/philna2/images/smilies/20.gif" /></a> <a href="javascript:grin(\':twisted:\')"><img src="../wp-content/themes/philna2/images/smilies/19.gif" /></a> <a href="javascript:grin(\':roll:\')"><img src="../wp-content/themes/philna2/images/smilies/21.gif" /></a> <a href="javascript:grin(\':idea:\')"><img src="../wp-content/themes/philna2/images/smilies/9.gif" /></a> <a href="javascript:grin(\':arrow:\')"><img src="../wp-content/themes/philna2/images/smilies/16.gif" /></a> <a href="javascript:grin(\':cry:\')"><img src="../wp-content/themes/philna2/images/smilies/28.gif" /></a> <a href="javascript:grin(\':mrgreen:\')"><img src="../wp-content/themes/philna2/images/smilies/11.gif" /></a></p>';
            jQuery('#quicktags').before(smiley);
</script>
EOT;
        }   
    add_action('admin_footer','SayMe_add_smiley');
}
?>
