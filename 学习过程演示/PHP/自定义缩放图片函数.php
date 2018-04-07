<?php
//要缩放的图片路径,缩放后的宽度,高度
function zoom($src_image,$dst_w,$dst_h){
	//源图片解析
	$arr=pathinfo($src_image);
	//echo "<pre>";
	//print_r($arr);
	//echo "</pre>";
	//源图片资源,利用变量函数

	//函数名赋值给变量,变量可加()调用函数
	switch ($arr["extension"]){
		case "jpg":
			$imagecreatefrom="imagecreatefromjpeg";//获取资源
			$image="imagejpeg";//保存图片
			break;
		case "png":
			$imagecreatefrom="imagecreatefrompng";
			$image="imagepng";
			break;
		case "gif":
			$imagecreatefrom="imagecreatefromgif";
			$image="imagegif";
			break;
	}
	$src_image=$imagecreatefrom($src_image);
	//源图片宽高
	$src_w=imagesx($src_image);
	$src_h=imagesy($src_image);
	//等比例计算
	$radio=$src_w/$src_h;
	$ratio_w=$src_w/$dst_w;
	$radio_h=$src_h/$dst_h;
	if($ratio_w>$radio_h){
		$dst_h=$dst_w/$radio;
	}else{
		$dst_w=$dst_h*$radio;
	}
	//新建画布
	$dst_image=imagecreatetruecolor($dst_w,$dst_h);
	//缩放图片
	imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
	//保存图片路径
	$str=$arr['dirname'].'/t_'.$dst_w.'_'.$arr['basename'];
	//保存图片
	$image($dst_image,$str);//变量函数
}
$fillname="images/suning.jpg";
zoom($fillname,510,367);//调用函数 
 ?>
