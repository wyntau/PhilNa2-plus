jQuery(function($) {
  Function.prototype.method = function(v, w) {
    if (!this.prototype[v]) {
      this.prototype[v] = w
    }
    return this
  };

  function m(v) {
    return document.getElementById(v)
  }
  function o(v) {
    url = v.u ? v.u : blogURL + "?do=ajax";
    if (v.fn) {
      url += "&action=" + v.fn
    }
    type = v.m ? v.m : "GET";
    data = v.d ? v.d : null;
    dataType = v.dt ? v.dt : "html";
    beforeSend = v.b ? v.b : null;
    error = v.e ? v.e : function() {
      alert(lang.commonError);
      document.body.style.cursor = "auto"
    };
    success = v.s ? v.s : function(w) {
      alert(w)
    };
    $.ajax({
      url: url,
      type: type,
      data: data,
      dataType: dataType,
      beforeSend: beforeSend,
      error: error,
      success: success
    })
  }
  function f(v) {
    return v.replace(/\?/g, "---WENHAO---").replace(/&/g, "---ANDHAO---").replace(/=/g, "---DENGHAO---")
  }
  var r = [];
  r.push(f(window.location.href));

  function a() {
    $("#skiptocomment").click(function() {
      $.scrollTo($("#commentstate"), 600, {
        easing: "easeOutElastic"
      });
      return false
    });
    $("#addcomment").click(function() {
      $.scrollTo($("#comment"), 600, {
        easing: "easeOutQuart"
      });
      return false
    })
  }
  a();

  function i() {
    $("#top").click(function() {
      $.scrollTo($("#header"), 700, {
        easing: "easeOutBounce"
      });
      return false
    })
  }
  i();

  function u() {
    var v = false;
    var x = $("#philna_say");
    var w = "loading";
    x.click(function() {
      if (v) {
        return false
      }
      var z = function() {
          x.hide(300, function() {
            x.html("").addClass(w).show()
          });
          v = true
        };
      var y = function() {
          x.html(lang.commonError);
          x.removeClass(w);
          v = false
        };
      var A = function(B) {
          setTimeout(function() {
            x.hide(0);
            x.html(B).removeClass(w).show(300);
            v = false
          }, 3000)
        };
      o({
        b: z,
        e: y,
        s: A,
        fn: "philnaSay"
      });
      return false
    })
  }
  u();

  function b() {
    var v = [];
    var w = [];
    $("#header .navigation li").each(function(x) {
      $(this).hover(function() {
        var y = this;
        $(y).addClass("hover");
        clearTimeout(w[x]);
        v[x] = setTimeout(function() {
          $(y).find("ul:eq(0)").slideDown(200)
        }, 200)
      }, function() {
        var y = this;
        $(y).removeClass("hover");
        clearTimeout(v[x]);
        w[x] = setTimeout(function() {
          $(y).find("ul:eq(0)").slideUp(200)
        }, 200)
      })
    })
  }
  b();

  function k() {
    var w = $("#pagenavi a");
    var v = $("#pagenavi");
    var x = $("#pagenavi").html();
    w.click(function() {
      var z = $(this).attr("href");
      r.push(f(z));
      var C = "do=ajax&action=philnaDynamic";
      C += (r[r.length - 2]) ? "&lastQuery=" + r[r.length - 2] : "";
      var B = $("#content2,#content,#content3");
      var A = function() {
          document.body.style.cursor = "wait";
          v.html(lang.ajaxloading)
        };
      var y = function() {
          alert(lang.commonError);
          v.html(x);
          document.body.style.cursor = "auto";
          k()
        };
      var D = function(E) {
          document.body.style.cursor = "auto";
          B.html(E);
          $.scrollTo("#header", 700, {
            easing: "easeOutElastic",
            onAfter: function() {
              $('#content .post_content:first').slideDown(500)
            }
          });
          homepage();
          imgEffection();
          fontChange();
          addEditor();
          k();
          a();
          e();
          p();
          c();
          t();
          n();
          q();
          l();
          g()
        };
      o({
        u: z,
        m: "post",
        d: C,
        b: A,
        e: y,
        s: D
      });
      return false
    })
  }
  k();

  function j() {
    var x = $("#searchbox");
    var w = $("#searchinput");
    var z = $("#searchbtn");
    var v = function() {
        if (w.val() == "") {
          w.val(lang.searchTip)
        }
        x.removeClass("focus");
        w.blur(v);
        w.focus(function() {
          if (w.val() == lang.searchTip) {
            w.val("")
          }
          x.addClass("focus")
        })
      };
    v();
    var y = function(B) {
        var A = blogURL + "?s=" + B;
        var E = "do=ajax&action=philnaDynamic";
        r.push(f(A));
        E += (r[r.length - 2]) ? "&lastQuery=" + r[r.length - 2] : "";
        var D = $("#content,#content2,#content3");
        var C = function() {
            document.body.style.cursor = "wait"
          };
        var F = function(G) {
            D.html(G);
            x.removeClass("searching");
            document.body.style.cursor = "auto";
            k()
          };
        o({
          u: A,
          m: "post",
          d: E,
          b: C,
          s: F
        })
      };
    $("#wpsearchform").submit(function() {
      var A = w.val();
      if (A == lang.searchTip || A == "") {
        return false
      } else {
        A = window.encodeURI(A)
      }
      y(A);
      x.addClass("searching");
      return false
    })
  }
  j();

  function h(y) {
    var x = m("comment");
    if (y) {
      if (document.selection) {
        sel = document.selection.createRange();
        sel.text = y
      } else {
        if (x.selectionStart || x.selectionStart == "0") {
          var w = x.selectionStart;
          var v = x.selectionEnd;
          var z = w;
          x.value = x.value.substring(0, w) + y + x.value.substring(v, x.value.length);
          z += y.length;
          x.selectionStart = z;
          x.selectionEnd = z
        } else {
          x.value += y
        }
      }
    }
  }
  function e() {
    var x = $(".reply");
    var w = $(".quote");
    var v = function(B) {
        var C = $(B).attr("href").replace(/.*#comment-/, "");
        var z = $("#comment-" + C + " .name").text();
        var A = $("#comment-" + C + " .comment_content").html();
        return {
          id: C,
          name: z,
          content: A
        }
      };
    var y = function(z) {
        var B = $("#comment");
        var A = B.val();
        if (A.indexOf(z) > -1) {
          alert("You've already appended this!");
          return false
        }
        $.scrollTo(B, 600, {
          easing: "easeOutBounce",
          onAfter: function() {
            B.focus();
            if (A.replace(/\s|\t|\n/g, "") == "") {
              h(z)
            } else {
              h("\n\n" + z)
            }
          }
        })
      };
    x.click(function() {
      var A = v(this);
      var z = '<a href="#comment-' + A.id + '">@' + A.name + " </a>\n";
      y(z);
      return false
    });
    w.click(function() {
      var A = v(this);
      var z = '<blockquote cite="#commentbody-' + A.id + '">';
      z += '\n<strong><a href="#comment-' + A.id + '">' + A.name + "</a> :</strong>";
      z += A.content;
      z += "</blockquote>\n";
      z = z.replace(/\t/g, "");
      y(z);
      return false
    })
  }
  e();

  function p() {
    var w = $("#comments .action .modify");
    var v = $("#commentform");
    w.click(function() {
      var D = $(this).attr("href").replace(/.*#comment-/, "");
      var C = $("#comment-" + D);
      var y = blogURL + "?do=ajax&id=" + D;
      var B = "philnaModifyComment";
      var z = function() {
          $("#updatecomment").remove();
          C.fadeTo(0, 0.7)
        };
      var x = function(E) {
          C.fadeTo(0, 1);
          if (E.responseText) {
            alert(E.responseText)
          } else {
            alert(lang.commonError)
          }
        };
      var A = function(E) {
          C.slideUp();
          var F = $("#comment");
          $("#author").val(E.name);
          $("#email").val(E.email);
          $("#url").val(E.url);
          F.val(E.content);
          $("#submit").val(lang.upcomment);
          v.append('<input id="updatecomment" type="hidden" name="update_comment_ID" value="' + D + '">');
          $.scrollTo(F, 600, {
            easing: "easeOutBounce",
            onAfter: function() {
              F.focus()
            }
          })
        };
      o({
        u: y,
        dt: "json",
        b: z,
        e: x,
        s: A,
        fn: B
      });
      return false
    })
  }
  p();

  function c() {
    var y = null;
    var v = null;
    var z = {};
    var B = $("#comments");
    var D = $('#comments .comment_content a[href^="#comment-"]');
    D.each(function() {
      if ($(this).text().match(/^@/)) {
        $(this).addClass("atreply")
      }
    });
    var w = $("#comments .comment_content a.atreply");
    var x = function(J) {
        var F = blogURL + "?do=ajax&action=philnaAjaxGetComment&id=" + J;
        var H = null;
        var G = function() {
            var K = '<li class="loadingtip box comment tip content">' + lang.ajaxloading + "</li>";
            B.append(K);
            H = $(".tip");
            H.hide().css({
              top: z.top,
              left: z.left
            }).fadeTo(0, 0.95).fadeIn(300)
          };
        var E = function(K) {
            if (K.responseText) {
              alert(K.responseText)
            } else {
              alert(lang.commonError)
            }
          };
        var I = function(K) {
            var L = $(".tip").offset();
            $(".tip").replaceWith(K);
            $(".tip").css({
              top: L.top,
              left: L.left
            }).fadeTo(0, 0.95)
          };
        o({
          u: F,
          b: G,
          e: E,
          s: I
        })
      };
    var C = function(E) {
        $("#comment-" + E).clone().attr("id", "").appendTo(B).hide().addClass("tip").css({
          top: z.top,
          left: z.left
        }).fadeTo(0, 0.95).fadeIn(300)
      };
    var A = function() {
        $(".tip").fadeOut(300, function() {
          if ($(this).hasClass("ajax")) {
            $(this).removeClass("ajax tip")
          } else {
            $(this).remove()
          }
        })
      };
    w.hover(function() {
      var E = $(this).attr("href").replace(/.*#comment-/, "");
      y = m("comment-" + E);
      if (!y) {
        v = setTimeout(function() {
          x(E)
        }, 200)
      } else {
        v = setTimeout(function() {
          C(E)
        }, 200)
      }
    }, function() {
      clearTimeout(v);
      A()
    });
    w.click(function() {
      return false
    });
    $("#comments a.atreply").mousemove(function(E) {
      z.left = E.clientX + 18;
      z.top = E.pageY + 18;
      $(".tip").css({
        left: z.left,
        top: z.top
      })
    })
  }
  c();

  function t() {
    var w = $("#commentnavi a");
    var v = $("#commentnavi").html();
    var y = $("#commentnavi");
    var x = $("#comments");
    w.click(function() {
      var D = $(this).attr("href").split(/(\?|&)action=cpage_ajax.*$/)[0];
      var B = 1;
      if (/comment-page-/i.test(D)) {
        B = D.split(/comment-page-/i)[1].split(/(\/|#|&).*$/)[0]
      } else {
        if (/cpage=/i.test(D)) {
          B = D.split(/cpage=/)[1].split(/(\/|#|&).*$/)[0]
        }
      }
      if (r.length >= 2) {
        var F = $(".post").attr("id").replace(/\D/g, "");
        if (F) {
          postID = F
        }
      }
      var A = blogURL + "?do=ajax&action=philnaAjaxCommentsPage&postid=" + postID + "&page=" + B;
      var C = function() {
          document.body.style.cursor = "wait";
          y.html(lang.ajaxloading)
        };
      var z = function(G) {
          document.body.style.cursor = "auto";
          y.html(v);
          if (G.responseText) {
            alert(G.responseText)
          } else {
            alert(lang.commonError)
          }
          t()
        };
      var E = function(H) {
          document.body.style.cursor = "auto";
          var G = H.split("<!--PHILNA-AJAX-COMMENT-PAGE-->");
          y.html(G[1]);
          x.html(G[0]);
          $.scrollTo($("#commentstate"), 600);
          t();
          e();
          c();
          p()
        };
      o({
        u: A,
        b: C,
        e: z,
        s: E
      });
      return false
    })
  }
  t();

  function n() {
    var w = $("#welcome_msg");
    var v = $("#profile");
    $("#edit_profile").toggle(function() {
      w.slideUp(200);
      v.slideDown(200);
      return false
    }, function() {
      w.slideDown(200);
      v.slideUp(200);
      return false
    })
  }
  n();

  function s() {
    var x = $("#commentform");
    var v = blogURL + "?do=ajax";
    var B = "philnaAjaxComment";
    var z = x.serialize();
    var E = $("#ajaxbox");
    var w = $("#respond");
    var y = $("#submit");
    var A = function() {
        E.slideUp(300);
        y.attr("disabled", false)
      };
    var D = function() {
        E.slideDown(300);
        y.attr("disabled", true)
      };
    var C = function(G) {
        A();
        if (G.responseText) {
          alert(G.responseText)
        } else {
          alert(lang.commonError)
        }
      };
    var F = function(G) {
        A();
        $("#comment").val("");
        if (m("updatecomment")) {
          var J = $("#updatecomment");
          var I = J.val();
          $("#comment-" + I).replaceWith(G).slideDown(300);
          $.scrollTo($("#comment-" + I), 600);
          J.remove();
          y.val(lang.scomment)
        } else {
          $("#comments").append(G);
          var H = $("#comments li:last").hide();
          H.slideDown(400);
          $("#commentcount").text($("#comments li:last .floor").text().replace(/\D/g, ""));
          $("#welcome_words").html(lang.thankscm);
          c()
        }
        p()
      };
    o({
      u: v,
      m: "POST",
      d: z,
      b: D,
      e: C,
      s: F,
      fn: B
    })
  }
  function q() {
    $("#commentform").submit(function() {
      s();
      return false
    });
    $("#commentform #comment").keydown(function(v) {
      if ((v.ctrlKey || v.altKey) && (v.keyCode == 13 || v.keyCode == 83)) {
        s();
        return false
      }
    })
  }
  q();

  function l() {
    $("#toggletrackbacks").toggle(function() {
      $(this).addClass("open");
      $("#pinglist").slideDown(200)
    }, function() {
      $(this).removeClass("open");
      $("#pinglist").slideUp(200)
    })
  }
  l();

  function g() {
    var x = $("#smiles");
    var w = $("#smiliebtn");
    var y = $("#smiles_list a");
    var v = function() {
        x.hide(200)
      };
    w.toggle(function() {
      var z = $(this).offset();
      x.css({
        left: z.left,
        top: z.top + 18
      }).slideDown(200);
      return false
    }, function() {
      x.hide(200)
    });
    y.click(function() {
      var z = $(this).attr("title");
      $("#comment").focus();
      h(z);
      w.click();
      return false
    })
  }
  g();

  function d() {
    var C = $("#contactbox");
    var z = $("#contactform");
    var x = z.attr("action") + "?do=ajax";
    var A = z.serialize();
    var v = $("#ajaxbox");
    var y = function() {
        v.slideDown()
      };
    var w = function(D) {
        v.slideUp();
        if (D.responseText) {
          alert(D.responseText)
        } else {
          alert(lang.commonError)
        }
      };
    var B = function(D) {
        v.slideUp();
        C.html(D)
      };
    o({
      m: "post",
      u: x,
      d: A,
      b: y,
      e: w,
      s: B
    })
  }
  $("#contactform").submit(function() {
    d();
    return false
  })
});
