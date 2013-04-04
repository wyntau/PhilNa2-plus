<?php
function handsome_beauty($comment_author_email){
$handsome=explode(",", $GLOBALS['philnaopt']['handsome']);
$beauty=explode(",", $GLOBALS['philnaopt']['beauty']);
$adminEmail = get_option('admin_email'); 
if($comment_author_email==$adminEmail) 
echo " <span class='admin' title='博主'>&nbsp;Admin</span>";
elseif(in_array($comment_author_email,$handsome)) 
echo " <span class='handsome' title='帅哥认证✔'>&nbsp;&nbsp;帅哥</span>"; 
elseif(in_array($comment_author_email,$beauty))
echo " <span class='beauty' title='美女认证✔'>&nbsp;&nbsp;美女</span>";
}
