<?php
/**
 * philnasay functions
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');


/**
 * philna say
 * @return unknown_type
 */
function philnaSay(){
  if($GLOBALS['philnaopt']['philna_say_enable'] && $GLOBALS['philnaopt']['philna_say_list']){
    $words = explode("\n", $GLOBALS['philnaopt']['philna_say_list']);
    $word = $words[ mt_rand(0, count($words) - 1) ];

    if(defined('DOING_AJAX')){
      echo $word;
    }else{
?>
    <style>
      #philna_say{
        background:url(<?php echo get_template_directory_uri() ?>/images/loads.gif) no-repeat 10000px 10000px;
        cursor:pointer;
        margin:0;
        position:absolute;
        top:2px;
        right:3px;
      }
      #philna_say.loading{
        cursor:default;
        display:none;
        background-position:center center;
        width:18px;
        height:18px;
    }
    </style>
    <p id="philna_say" title="<?php _e('Click to get a new one (Random)',YHL) ?>">
      <?php echo $word ?>
    </p>
    <script>
    jQuery(function($){
      var fetching = false;
      var $philnaSay = $("#philna_say");
      var fetchingClass = "loading";
      $philnaSay.click(function() {
        if (fetching) {
          return false
        }
        ajax({
          fn: "philnaSay",
          beforeSend: function() {
            $philnaSay.hide(300, function() {
              $philnaSay.html("").addClass(fetchingClass).show()
            });
            fetching = true
          },
          success: function(response) {
            setTimeout(function() {
              $philnaSay.hide(0);
              $philnaSay.html(response).removeClass(fetchingClass).show(300);
              fetching = false
            }, 1000);
          },
          error: function() {
            $philnaSay.html(lang.commonError);
            $philnaSay.removeClass(fetchingClass);
            fetching = false
          }
        });
        return false
      });
    });
    </script>
<?php
    }
  }
}

add_action('philnaBlogTitleAndDesc', 'philnaSay');
