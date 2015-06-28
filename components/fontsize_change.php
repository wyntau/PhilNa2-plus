<?php

function philnaFontsizeChange($selector){
?>
  <style>
    /*change content font size*/
    #fs-change {
      padding: 0px 8px 0 0;
      float: left;
    }
    #fs-change li {
      display: inline;
      float: left;
      color: #b4b4b4;
      margin-left: 5px;
    }
    #fs-change li a {
      border: #c8c8c8 1px solid;
      text-align: center;
      width: 16px;
      display: block;
      height: 16px;
    }
    #fs-change li a:hover {
      background: #ebebeb;
      text-decoration: none;
    }
  </style>
  <ul id="fs-change">
    <li id="fs_dec"><a href="#" title="再小点再小点!">-</a></li>
    <li id="fs_n"><a href="#" title="我要返回地球">N</a></li>
    <li id="fs_inc"><a href="#" title="给点力吧">+</a></li>
  </ul>
  <script>
    jQuery(function($){
      $('body').on('click', '#fs-change li', function() {
        var selector = '<?php echo $selector ?>';
        var increment = 1;
        var fs_n = 13;
        var fs_cur = $(selector).css('font-size');
        var fs_cur_num = parseFloat(fs_cur, 10);
        var id = $(this).attr('id');
        switch (id) {
        case 'fs_dec':
          fs_cur_num -= increment;
          break;
        case 'fs_inc':
          fs_cur_num += increment;
          break;
        case 'fs_n':
        default:
          fs_cur_num = fs_n
        }
        $(selector).css('font-size', fs_cur_num + 'px');
        return false
      })
    });
  </script>
<?php
}
