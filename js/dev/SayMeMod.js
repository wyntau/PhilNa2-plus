jQuery(function($){
  $('#comment').bind('focus keyup input paste', function() {
    $('#num').text($(this).val().length)
  });
  $('#searchinput,#comment,#author,#email,#url').mouseover(function() {
    $(this).focus()
  });
});

(function(w) {
  var E = w(window),
    u, f, F = -1,
    n, x, D, v, y, L, r, m = !window.XMLHttpRequest,
    s = [],
    l = document.documentElement,
    k = {},
    t = new Image(),
    J = new Image(),
    H, a, g, p, I, d, G, c, A, K;
  w(function() {
    w("body").append(w([H = w('<div id="lbOverlay" />')[0], a = w('<div id="lbCenter" />')[0], G = w('<div id="lbBottomContainer" />')[0]]).css("display", "none"));
    g = w('<div id="lbImage" />').appendTo(a).append(p = w('<div style="position: relative;" />').append([I = w('<a id="lbPrevLink" href="#" />').click(B)[0], d = w('<a id="lbNextLink" href="#" />').click(e)[0]])[0])[0];
    c = w('<div id="lbBottom" />').appendTo(G).append([w('<a id="lbCloseLink" href="#" />').add(H).click(C)[0], A = w('<div id="lbCaption" />')[0], K = w('<div id="lbNumber" />')[0], w('<div style="clear: both;" />')[0]])[0]
  });
  w.slimbox = function(O, N, M) {
    u = w.extend({
      loop: false,
      overlayOpacity: 0.8,
      overlayFadeDuration: 400,
      resizeDuration: 400,
      resizeEasing: "swing",
      initialWidth: 250,
      initialHeight: 250,
      imageFadeDuration: 400,
      captionAnimationDuration: 400,
      counterText: "Image {x} of {y}",
      closeKeys: [27, 88, 67],
      previousKeys: [37, 80],
      nextKeys: [39, 78]
    }, M);
    if (typeof O == "string") {
      O = [
        [O, N]
      ];
      N = 0
    }
    y = E.scrollTop() + (E.height() / 2);
    L = u.initialWidth;
    r = u.initialHeight;
    w(a).css({
      top: Math.max(0, y - (r / 2)),
      width: L,
      height: r,
      marginLeft: -L / 2
    }).show();
    v = m || (H.currentStyle && (H.currentStyle.position != "fixed"));
    if (v) {
      H.style.position = "absolute"
    }
    w(H).css("opacity", u.overlayOpacity).fadeIn(u.overlayFadeDuration);
    z();
    j(1);
    f = O;
    u.loop = u.loop && (f.length > 1);
    return b(N)
  };
  w.fn.slimbox = function(M, P, O) {
    P = P ||
    function(Q) {
      return [Q.href, Q.title]
    };
    O = O ||
    function() {
      return true
    };
    var N = this;
    return N.unbind("click").click(function() {
      var S = this,
        U = 0,
        T, Q = 0,
        R;
      T = w.grep(N, function(W, V) {
        return O.call(S, W, V)
      });
      for (R = T.length; Q < R; ++Q) {
        if (T[Q] == S) {
          U = Q
        }
        T[Q] = P(T[Q], Q)
      }
      return w.slimbox(T, U, M)
    })
  };

  function z() {
    var N = E.scrollLeft(),
      M = E.width();
    w([a, G]).css("left", N + (M / 2));
    if (v) {
      w(H).css({
        left: N,
        top: E.scrollTop(),
        width: M,
        height: E.height()
      })
    }
  }
  function j(M) {
    if (M) {
      w("object").add(m ? "select" : "embed").each(function(O, P) {
        s[O] = [P, P.style.visibility];
        P.style.visibility = "hidden"
      })
    } else {
      w.each(s, function(O, P) {
        P[0].style.visibility = P[1]
      });
      s = []
    }
    var N = M ? "bind" : "unbind";
    E[N]("scroll resize", z);
    w(document)[N]("keydown", o)
  }
  function o(O) {
    var N = O.keyCode,
      M = w.inArray;
    return (M(N, u.closeKeys) >= 0) ? C() : (M(N, u.nextKeys) >= 0) ? e() : (M(N, u.previousKeys) >= 0) ? B() : false
  }
  function B() {
    return b(x)
  }
  function e() {
    return b(D)
  }
  function b(M) {
    if (M >= 0) {
      F = M;
      n = f[F][0];
      x = (F || (u.loop ? f.length : 0)) - 1;
      D = ((F + 1) % f.length) || (u.loop ? 0 : -1);
      q();
      a.className = "lbLoading";
      k = new Image();
      k.onload = i;
      k.src = n
    }
    return false
  }
  function i() {
    a.className = "";
    w(g).css({
      backgroundImage: "url(" + n + ")",
      visibility: "hidden",
      display: ""
    });
    w(p).width(k.width);
    w([p, I, d]).height(k.height);
    w(A).html(f[F][1] || "");
    w(K).html((((f.length > 1) && u.counterText) || "").replace(/{x}/, F + 1).replace(/{y}/, f.length));
    if (x >= 0) {
      t.src = f[x][0]
    }
    if (D >= 0) {
      J.src = f[D][0]
    }
    L = g.offsetWidth;
    r = g.offsetHeight;
    var M = Math.max(0, y - (r / 2));
    if (a.offsetHeight != r) {
      w(a).animate({
        height: r,
        top: M
      }, u.resizeDuration, u.resizeEasing)
    }
    if (a.offsetWidth != L) {
      w(a).animate({
        width: L,
        marginLeft: -L / 2
      }, u.resizeDuration, u.resizeEasing)
    }
    w(a).queue(function() {
      w(G).css({
        width: L,
        top: M + r,
        marginLeft: -L / 2,
        visibility: "hidden",
        display: ""
      });
      w(g).css({
        display: "none",
        visibility: "",
        opacity: ""
      }).fadeIn(u.imageFadeDuration, h)
    })
  }
  function h() {
    if (x >= 0) {
      w(I).show()
    }
    if (D >= 0) {
      w(d).show()
    }
    w(c).css("marginTop", -c.offsetHeight).animate({
      marginTop: 0
    }, u.captionAnimationDuration);
    G.style.visibility = ""
  }
  function q() {
    k.onload = null;
    k.src = t.src = J.src = n;
    w([a, g, c]).stop(true);
    w([I, d, g, G]).hide()
  }
  function C() {
    if (F >= 0) {
      q();
      F = x = D = -1;
      w(a).hide();
      w(H).stop().fadeOut(u.overlayFadeDuration, j)
    }
    return false
  }
})(jQuery);

jQuery(function($){
  function imgEffection() {
    jQuery("img").lazyload({
      placeholder: themeurl + "/images/empty.gif",
      effect: "fadeIn"
    });
    jQuery("#content .post_content a:has(img),#content2 .post_content a:has(img)").slimbox();
    jQuery('.tg_t').click(function() {
      jQuery(this).next('.tg_c').slideToggle(400)
    })
  }
  imgEffection();

  function enableStyleComment() {
    function addEditor(b, c) {
      var a = $('#comment')[0];
      if (document.selection) {
        a.focus();
        sel = document.selection.createRange();
        c ? sel.text = b + sel.text + c : sel.text = b;
        a.focus()
      } else if (a.selectionStart || a.selectionStart == '0') {
        var d = a.selectionStart;
        var e = a.selectionEnd;
        var f = e;
        c ? a.value = a.value.substring(0, d) + b + a.value.substring(d, e) + c + a.value.substring(e, a.value.length) : a.value = a.value.substring(0, d) + b + a.value.substring(e, a.value.length);
        c ? f += b.length + c.length : f += b.length - e + d;
        if (d == e && c) f -= c.length;
        a.focus();
        a.selectionStart = f;
        a.selectionEnd = f
      } else {
        a.value += b + c;
        a.focus()
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
  }
  enableStyleComment();

  jQuery('#tab-title span').mouseover(function() {
    $(this).addClass("selected").siblings().removeClass();
    $("#tab-content > ul").eq($('#tab-title span').index(this)).slideDown(250).siblings().slideUp(250)
  });

  function homepage() {
    jQuery('#content .post_title').click(function() {
      var postContent = $(this).next().next();
      var id = $(this).parent().attr("id");
      var postId = id.replace(/^post-(.*)$/, '$1');
      if (postContent.html() == "") {
        $.ajax({
          url: "?action=ajax_post&id=" + postId,
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
    })
  }
  homepage();
  jQuery('#content .post_content:first').slideDown(500);
});
