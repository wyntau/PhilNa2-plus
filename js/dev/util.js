jQuery(function($){
  window.ajax = function(option) {
    url = option.url ? option.url : blogURL + "?do=ajax";
    if (option.fn) {
      url += "&action=" + option.fn
    }
    type = option.type ? option.type : "GET";
    data = option.data ? option.data : null;
    dataType = option.dataType ? option.dataType : "html";
    beforeSend = option.beforeSend ? option.beforeSend : null;
    error = option.error ? option.error : function() {
      alert(lang.commonError);
      document.body.style.cursor = "auto"
    };
    success = option.success ? option.success : function(w) {
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
    });
  }
});
