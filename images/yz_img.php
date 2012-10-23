<?php
/**
 * 用于生成验证图片
 */


session_start();
session_cache_expire(10);
$vcodes = '';
//生成验证码图片
@header("Content-type: image/png");
$im = imagecreate(44,15);
$back = ImageColorAllocate($im, 245,245,245);
imagefill($im,0,0,$back); //背景
srand((double)microtime()*1000000);
//生成4位数字
for($i=0;$i<4;$i++){
	$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
	$authnum=rand(1,9);
	$vcodes.=$authnum;
	imagestring($im, 5, 2+$i*10, 1, $authnum, $font);
}
//加入干扰象素
for($i=0;$i<100;$i++){
	$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
	imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
}
ImagePNG($im);
ImageDestroy($im);

$_SESSION['vcode'] = $vcodes;
