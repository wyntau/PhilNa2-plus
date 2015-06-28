jQuery(function($){
  $('#comment').bind('focus keyup input paste', function() {
    $('#num').text($(this).val().length)
  });
  $('#searchinput,#comment,#author,#email,#url').mouseover(function() {
    $(this).focus()
  });

  $('body').on('click', '.tg_t', function(){
    $(this).next('.tg_c').slideToggle(400);
  });

  (window.imgEffection = function() {
    $("img").lazyload({
      placeholder: themeurl + "/images/empty.gif",
      effect: "fadeIn"
    });
    $("#content .post_content a:has(img),#content2 .post_content a:has(img)").slimbox();
  })();

  (function enableStyleComment() {
    function addEditor(open, close) {
      var form = $('#comment')[0];
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
    var h = {
      strong: function() {
        addEditor('<strong>', '</strong>')
      },
      em: function() {
        addEditor('<em>', '</em>')
      },
      del: function() {
        addEditor('<del>', '</del>')
      },
      underline: function() {
        addEditor('<u>', '</u>')
      },
      italic: function() {
        addEditor('<i>', '</i>')
      },
      quote: function() {
        addEditor('<blockquote>', '</blockquote>')
      },
      ahref: function() {
        var a = prompt('Enter the URL', 'http://');
        if (a) {
          addEditor('<a target="_blank" href="' + a + '" rel="external">', '</a>')
        }
      },
      code: function() {
        addEditor('<code>', '</code>')
      }
    };

    $('body').on('click', '#editor_tools a', function(){
      var editor = $(this).data('editor');
      h[editor] && h[editor]();
      return false;
    });
  })();

  jQuery('#tab-title span').mouseover(function() {
    $(this).addClass("selected").siblings().removeClass();
    $("#tab-content > ul").eq($('#tab-title span').index(this)).slideDown(250).siblings().slideUp(250)
  });

  (function enableHomeSlide() {
    $('body').on('click', '#content .post_title', function() {
      var postContent = $(this).next().next();
      var id = $(this).parent().attr("id");
      var postId = id.replace(/^post-(.*)$/, '$1');
      if (postContent.html() == "") {
        $.ajax({
          url: "?do=ajax&action=philnaAjaxPost&id=" + postId,
          beforeSend: function() {
            $('#content .post_content').slideUp(150, function() {
              postContent.html('<p class="ajaxloading">' + lang.AjaxLoading + '</p>').show()
            })
          },
          success: function(data) {
            postContent.hide(0).html(data).slideDown(500, function() {
              $body.animate({
                scrollTop: $(this).offset().top - 180
              }, 500)
            });
            imgEffection()
          }
        });
        return false
      } else if (postContent.is(":hidden")) {
        $('#content .post_content').slideUp(500);
        postContent.slideDown(500, function() {
          $body.animate({
            scrollTop: $(this).offset().top - 180
          }, 400)
        });
        return false
      } else {
        $(this).children('a').text(lang.LoadText);
        window.location = $(this).children().attr('href')
      }
    });
    $('#content .post_content:first').slideDown(500);
  })();
});
