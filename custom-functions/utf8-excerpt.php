<?php
/***********************************************
 *由wp-utf8-excerpt插件修改而来
 *自动UTF8字符截断,从自由的风 主题Loosky提取
************************************************/

/* if the host doesn't support the mb_ functions, we have to define them. From Yskin's wp-CJK-excerpt, thanks to Yskin. */
if ( !function_exists('mb_strlen') ) {
	function mb_strlen ($text, $encode) {
		if ($encode=='UTF-8') {
			return preg_match_all('%(?:
					  [\x09\x0A\x0D\x20-\x7E]           # ASCII
					| [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
					|  \xE0[\xA0-\xBF][\x80-\xBF]       # excluding overlongs
					| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
					|  \xED[\x80-\x9F][\x80-\xBF]       # excluding surrogates
					|  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
					| [\xF1-\xF3][\x80-\xBF]{3}         # planes 4-15
					|  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
					)%xs',$text,$out);
		}else{
			return strlen($text);
		}
	}
}
/* from Internet, author unknown */
if (!function_exists('mb_substr')) {
    function mb_substr($str, $start, $len = '', $encoding="UTF-8"){
        $limit = strlen($str); 
        for ($s = 0; $start > 0;--$start) {// found the real start
            if ($s >= $limit)
                break;
            if ($str[$s] <= "\x7F")
                ++$s;
            else {
                ++$s; // skip length 
                while ($str[$s] >= "\x80" && $str[$s] <= "\xBF")
                    ++$s;
            }
        }
        if ($len == '')
            return substr($str, $s);
        else
            for ($e = $s; $len > 0; --$len) {//found the real end
                if ($e >= $limit)
                    break;
                if ($str[$e] <= "\x7F")
                    ++$e;
                else {
                    ++$e;//skip length 
                    while ($str[$e] >= "\x80" && $str[$e] <= "\xBF" && $e < $limit)
                        ++$e;
                }
            } 
        return substr($str, $s, $e - $s);
    }
}
if (!function_exists('utf8_excerpt')) {
	function utf8_excerpt ($text) {
		global $post;	
		if ( '' == $text ) {	
		$my_length= $GLOBALS['philnaopt']['excerpt_length'] ? $GLOBALS['philnaopt']['excerpt_length'] : '220';
			$home_excerpt_length = $my_length;//250;//get_option('home_excerpt_length');
			$archive_excerpt_length = $my_length;//250;//get_option('archive_excerpt_length');
			$allowd_tag = '<a><b><blockquote><br><cite><code><dd><del><div><dl><dt><em><h1><h2><h3><h4><h5><h6><i><img><li><ol><p><span><strong><ul>';
			if (is_home()) {
				$length = $home_excerpt_length;
			} else {
				$length = $archive_excerpt_length;
			}			
			$text = $post->post_content;
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$text = trim($text);			
			if($length > mb_strlen(strip_tags($text), 'utf-8')) {
				return $text;
			}			
            $more_position = stripos ($text, "<!--more-->");
            if ($more_position !== false) {
                $text = substr ($text, 0, $more_position);
            } 
            else {
				$text = strip_tags($text, $allowd_tag); 		
				$text = trim($text);   	
				$num = 0;
				$in_tag = false;
				for ($i=0; $num<$length || $in_tag; $i++) {
					if(mb_substr($text, $i, 1) == '<')
						$in_tag = true;
					elseif(mb_substr($text, $i, 1) == '>')
						$in_tag = false;
					elseif(!$in_tag)
						$num++;
				}
				$text = mb_substr ($text,0,$i, 'utf-8');            
            }    
		}
				$text = force_balance_tags($text);		
		$text .= "<p class='more-link'><a href='".get_permalink()."'>阅读更多&raquo;</a></p>";
		return $text;
	}
}
if (!function_exists('get_excerpt')) {
	function get_excerpt ($text) {
		global $post;	
		if ( '' == $text ) {	
		$my_length= $GLOBALS['philnaopt']['excerpt_length'] ? $GLOBALS['philnaopt']['excerpt_length'] : '220';		
			$home_excerpt_length = $my_length;//220;//get_option('home_excerpt_length');
			$archive_excerpt_length = $my_length;//220;//get_option('archive_excerpt_length');
			$allowd_tag = '<a><b><blockquote><br><cite><code><dd><del><div><dl><dt><em><h1><h2><h3><h4><h5><h6><i><li><ol><span><strong><ul>';			
			if (is_home()) {
				$length = $home_excerpt_length;
			} else {
				$length = $archive_excerpt_length;
			}			
			$text = $post->post_content;
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$text = trim($text);			
			if($length > mb_strlen(strip_tags($text), 'utf-8')) {
				$text = strip_tags($text, $allowd_tag); 
				return $text;
			}				
            $more_position = stripos ($text, "<!--more-->");
            if ($more_position !== false) {
                $text = substr ($text, 0, $more_position);
				$text = strip_tags($text, $allowd_tag); 
            } 
            else {
				$text = strip_tags($text, $allowd_tag); 		
				$text = trim($text);          	
				$num = 0;
				$in_tag = false;
				for ($i=0; $num<$length || $in_tag; $i++) {
					if(mb_substr($text, $i, 1) == '<')
						$in_tag = true;
					elseif(mb_substr($text, $i, 1) == '>')
						$in_tag = false;
					elseif(!$in_tag)
						$num++;
				}
				$text = mb_substr ($text,0,$i, 'utf-8');            
            }         
		}
				$text = force_balance_tags($text);
		return $text;
	}
}
add_filter('get_the_excerpt', 'utf8_excerpt', 9);
