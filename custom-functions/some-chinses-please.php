<?php
/*********************************************************
 *防止全英文评论,此段函数为some chinese please插件关键代码,
 *因此无须再次使用some chinese please插件以防代码冲突
 *******************************************************/
function scp_comment_post( $incoming_comment ) {
    $pattern = '/[一-龥]/u';
    if(!preg_match($pattern, $incoming_comment['comment_content'])) {
         fail(__( "错误:您的评论中必须包含汉字!" ));
    }
    return( $incoming_comment );
}
add_filter('preprocess_comment', 'scp_comment_post');
