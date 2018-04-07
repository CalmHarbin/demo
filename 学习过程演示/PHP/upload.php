<?php 
// echo "<pre>";
// print_r($_FILES);//files接受文件上传
// echo "</pre>";
$size=$_FILES["files"]["size"];
$arr=explode("/",$_FILES["files"]["type"]);
$type=$arr[0];
// echo "$type";
//文件名防止重复和中文乱码
//文件格式
$name=$_FILES["files"]["name"];//原文件名
$time=date('Y').'-'.date('m').'-'.date('d');//日期
//检测目录是否存在,不存在则创建
$dir='upload/'.$time;
if(!file_exists($dir)){
	mkdir($dir);
}
//文件名
$suffix=substr($name, strrpos($name,".")+1);//截取原文件后缀
$random=mt_rand();//随机数
$filename=time().$random.'.'.$suffix;

$sfile=$_FILES["files"]["tmp_name"];//上传的目录
$dfile=$dir.'/'.$filename;//保存的路径
//文件移动
$maxsize=1*1024*1024;
//限制文件类型和大小
if($type==="image"){
	if($size>$maxsize){
		echo "<script>alert('图片太大,不允许上传!')</script>";
	}else{
		move_uploaded_file($sfile, $dfile);
	}
}else{
	echo "<script>alert('该文件类型不允许上传!')</script>";
}
 ?>