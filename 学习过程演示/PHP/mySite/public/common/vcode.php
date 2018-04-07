<?php
//开启session技术
session_start();//必须写在最上方,之前不能有输出

//创建画布
$img=imagecreatetruecolor(150,30);
//准备颜色
$black=imagecolorallocate($img,0,0,0);
$white=imagecolorallocate($img,255, 255, 255);
$red=imagecolorallocate($img, 255, 0, 0);
$green=imagecolorallocate($img,0,255,0);
$blue=imagecolorallocate($img,0,0,255);
//填充颜色
imagefill($img,0,0,$black);
//绘制
$arr=array_merge(range(0,9),range(a,z),range(A,Z));
shuffle($arr);//打乱数组
$str=join(array_slice($arr,0,4)," ");//截取4位,并用空格将数组连接成字符串
//将验证码存放在数组中//下标为vcode
$_SESSION["vcode"]=$str;
//画字符串
imagettftext($img, 20, mt_rand(0,3), 20, 30, $white, "kaiti.ttf", $str);
//增加干扰素
for($i=0;$i<20;$i++){//圆弧干扰素
	imagearc($img, mt_rand(0,150), mt_rand(0,30), mt_rand(0,150), mt_rand(0,30), mt_rand(0,360), mt_rand(0,360), $green);
}
//打印
header("content-type:image/png");
imagepng($img);
//释放画布资源;
imagedestroy($img);

 ?>
