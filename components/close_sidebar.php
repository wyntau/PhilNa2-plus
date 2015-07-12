<?php

function philnaCloseSidebar(){
?>
  <style>
    /*close sidebar*/
    #top_right {
      display: block;
      padding: 0;
      height: 25x;
      float:right;
    }
    #top_right ul {
      float:right;
      margin: 0;
      padding: 0;
      position: relative;
    }
    #top_right ul li {
      display: block;
      list-style: none;
      float: left;
      position: relative;
      margin-bottom:0;
    }
    #top_right ul a {
      display: block;
      color: #999;
      font-size: 12px;
      padding: 3px 15px 3px;
      margin: 0;
    }
    #top_right ul a:hover {
      background-color: #666;
      color: #FFF;
      cursor:pointer;
    }
  </style>
  <div id="top_right">
    <ul id="menu-top_right">
<?php
  if(isset($_COOKIE['show_sidebar']) && $_COOKIE['show_sidebar'] == 'no'){
?>
      <style type="text/css">
        #content{
          width:920px;
        }
        #footer {
          width:920px;
        }
        #sidebar {
          display:none;
        }
      </style>
      <li id="close-sidebar" style="display:none;" title="显示/关闭侧边栏"><a>关闭侧边栏</a></li>
      <li id="show-sidebar" title="显示/关闭侧边栏"><a>显示侧边栏</a></li>
<?php
  }else{
?>
      <li id="close-sidebar" title="显示/关闭侧边栏"><a>关闭侧边栏</a></li>
      <li id="show-sidebar" style="display:none;"title="显示/关闭侧边栏"><a>显示侧边栏</a></li>
<?php
  }
?>
    </ul>
  </div>
  <script>
    jQuery(function($){
      function SetCookie(c_name, value, expiredays) {
        var exdate = new Date();
        exdate.setTime(exdate.getTime() + expiredays * 24 * 3600 * 1000);
        document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString()) + ";path=/"
      }
      window['RootCookies'] = {};
      window['RootCookies']['SetCookie'] = SetCookie;

      $('#close-sidebar').click(function() {
        RootCookies.SetCookie('show_sidebar', 'no', 30);
        $('#close-sidebar').hide();
        $('#show-sidebar').show();
        $('#sidebar').fadeOut(500);
        window.setTimeout(function() {
          $('#content,#footer').animate({
            width: "920px"
          }, 1000);
        }, 500);
      });
      $('#show-sidebar').click(function() {
        RootCookies.SetCookie('show_sidebar', 'yes', 30);
        $('#show-sidebar').hide();
        $('#close-sidebar').show();
        $('#content,#footer').animate({
          width: "662px"
        }, 800, function() {
          $('#sidebar').fadeIn(500);
        });
      });
    });
  </script>
<?php
}
?>
