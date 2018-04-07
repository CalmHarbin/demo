<?php 
$src_image=imagecreatefromjpeg("images/suning.jpg");//图片资源
$dst_image=imagecreatetruecolor(415, 220);//画布资源
$src_w=imagesx($src_image);//图片宽度
$src_h=imagesy($src_image);//图片高度
imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, 415, 220, $src_w, $src_h);//复制图片
header("content-type:image/jpeg");
imagejpeg($dst_image);
 ?>
