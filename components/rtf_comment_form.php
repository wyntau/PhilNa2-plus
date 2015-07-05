<?php

function philna_RTF_comment_form($form_id = '#comment'){
?>
  <style>
    /*edit-tool*/
    #editor_tools {
      margin: 0;
      padding-left: 30px;
      width: 300px;
      height: 16px;
    }

    #editor_tools a {
      float: left;
      color: #999;
      height: 16px;
      cursor: pointer;
      line-height: 16px;
      font-weight: bold;
      background: #fafafa;
      text-decoration: none;
      padding:0 5px;
      border-right:1px solid #ddd;
    }
    #editor_tools a:first-child{
      border-left:1px solid #ddd;
    }

    #editor_tools a:hover {
      color: #666;
      background: #ffea00;
    }
  </style>
  <div id="editor_tools">
    <a data-format="strong">B</a>
    <a data-format="italic">i</a>
    <a data-format="em">em</a>
    <a data-format="del">del</a>
    <a data-format="underline">U</a>
    <a data-format="ahref">Link</a>
    <a data-format="code">Code</a>
    <a data-format="quote">Quote</a>
  </div>
  <script>
    jQuery(function($){
      function appendFormat(open, close) {
        var form = $('<?php echo $form_id ?>')[0];
        if (document.selection) {
          sel = document.selection.createRange();
          if(close){
            sel.text = open + sel.text + close;
          }else{
            sel.text = open;
          }
          form.focus()
        } else if (form.selectionStart || form.selectionStart == '0') {
          var selectionStart = form.selectionStart;
          var selectionEnd = form.selectionEnd;
          var f = selectionEnd;
          if(close){
            form.value = form.value.substring(0, selectionStart) + open + form.value.substring(selectionStart, selectionEnd) + close + form.value.substring(selectionEnd, form.value.length);
            f += open.length + close.length;
          }else{
            form.value = form.value.substring(0, selectionStart) + open + form.value.substring(selectionEnd, form.value.length);
            f += open.length - selectionEnd + selectionStart;
          }
          if (selectionStart == selectionEnd && close) {
            f -= close.length;
          }
          form.focus();
          form.selectionStart = f;
          form.selectionEnd = f
        } else {
          form.value += open + close;
          form.focus();
        }
      }
      var formats = {
        strong: function() {
          appendFormat('<strong>', '</strong>')
        },
        em: function() {
          appendFormat('<em>', '</em>')
        },
        del: function() {
          appendFormat('<del>', '</del>')
        },
        underline: function() {
          appendFormat('<u>', '</u>')
        },
        italic: function() {
          appendFormat('<i>', '</i>')
        },
        quote: function() {
          appendFormat('<blockquote>', '</blockquote>')
        },
        ahref: function() {
          var a = prompt('Enter the URL', 'http://');
          if (a) {
            appendFormat('<a target="_blank" href="' + a + '" rel="external">', '</a>')
          }
        },
        code: function() {
          appendFormat('<code>', '</code>')
        }
      };

      $('body').on('click', '#editor_tools a', function(){
        var format = $(this).data('format');
        formats[format] && formats[format]();
        return false;
      });
    });
  </script>
<?php
}
