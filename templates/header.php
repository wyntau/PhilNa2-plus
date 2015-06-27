<?php
/**
 * header
 */

// no direct access
defined('PHILNA') or die('Restricted access -- PhilNa2 gorgeous design by yinheli < http://philna.com/ >');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!-- PhilNa2 gorgeous design by by yinheli ( http://philna.com/ ) Remod by 自说Me话(http://ISayMe.com) -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php philnaDocumentTitle(); ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<!--[if lte IE 6]>
<link media="screen" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/ie6.css" rel="stylesheet">
<![endif]-->
<?php if($_COOKIE["comment_author_" . COOKIEHASH]!="") { ?>
    <script type="text/javascript">document.title = "<?php echo $_COOKIE["comment_author_" . COOKIEHASH].'，欢迎归来~'; ?>" + document.title</script>
<?php } ?>
<?php is_404() || wp_head(); 
if($GLOBALS['philnaopt']['enable_google_analytics']) {
		if(!$GLOBALS['philnaopt']['exclude_admin_analytics'] || !current_user_can('manage_options')) {
			echo $GLOBALS['philnaopt']['google_analytics_code'];
		}
	}
?>
</head>
