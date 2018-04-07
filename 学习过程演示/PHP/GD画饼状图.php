<?php 
//创建画布
$img=imagecreatetruecolor(500,500);
//准备颜色
$black=imagecolorallocate($img,0,0,0);
$white=imagecolorallocate($img,255, 255, 255);
$red=imagecolorallocate($img, 255, 0, 0);
$green=imagecolorallocate($img,0,255,0);
$blue=imagecolorallocate($img,0,0,255);
//填充颜色
imagefill($img,0,0,$black);
//绘制
//画椭圆填充
imagefilledarc($img,250,200,200,200,0,90,$red,IMG_ARC_PIE);
imagefilledarc($img,250,200,200,200,90,240,$green,IMG_ARC_PIE);
imagefilledarc($img,250,200,200,200,240,360,$blue,IMG_ARC_PIE);
//画字
imagettftext($img, 20, 0, 280, 250, $white, "kaiti.ttf", "25%");
imagettftext($img, 20, 0, 180, 220, $white, "kaiti.ttf", "40%");
imagettftext($img, 20, 0, 260, 170, $white, "kaiti.ttf", "35%");
//打印
header("content-type:image/png");
imagepng($img);
//释放画布资源;
imagedestroy($img);

 ?>
