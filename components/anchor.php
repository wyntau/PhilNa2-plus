<?php

function philnaUpDown(){
  if(!is_page()){
?>
  <style>
    /* up and down */
    #updown{
      position:fixed;
      top:55%;
      left:50%;
      display:block;
      margin-left:-515px;
    }
    #up,#comt,#down{
      background:url(<?php echo get_template_directory_uri(); ?>/images/updown.png) no-repeat;
      position:relative;
      cursor:pointer;
      height:25px;
      width:29px;
      margin:10px 0 0;
    }
    #comt{
      background-position:left -30px;
      height:32px;
    }
    #down{
      background-position:left -68px;
    }
    #comt:hover{
      background-position:right -30px;
    }
    #up:hover{
      background-position:right 0;
    }
    #down:hover{
      background-position:right -68px;
    }
  </style>
  <div id="updown">
    <div id="up" title="我要上天!"></div>
<?php
  }
  if(is_single()){
?>
    <div id="comt" title="查看评论"></div>
    <div id="down" title="我要吐槽!"></div>
<?php
  } else {
?>
    <div id="down" title="我要入地!"></div>
<?php
  }
?>
  </div>
  <script>
    // up down anchor scroll
    jQuery(function($) {
      var fq;
      function up() {
        $window = $(window);
        $window.scrollTop($window.scrollTop() - 1);
        fq = setTimeout(up, 40)
      }
      function dn() {
        $window = $(window);
        $window.scrollTop($window.scrollTop() + 1);
        fq = setTimeout(dn, 40)
      }
      $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');

      $('#up')
      .mouseover(up)
      .mouseout(function() {
        clearTimeout(fq);
      })
      .click(function() {
        $body.animate({
          scrollTop: $('#header').offset().top
        }, 500);
      });

      $('#down')
      .mouseover(dn)
      .mouseout(function() {
        clearTimeout(fq);
      })
      .click(function() {
        $body.animate({
          scrollTop: $('#footer').offset().top
        }, 500);
      });

      $('#comt')
      .click(function() {
        $body.animate({
          scrollTop: $('#commentstate').offset().top
        }, 500);
      });
    });
  </script>
<?php
}

add_action('wp_footer', 'philnaUpDown');
