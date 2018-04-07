<?php 
	// echo "<pre>";	
	// print_r($_GET);
	// echo "</pre>";
	$file=$_GET["file"];//文件名
	$download="images/".$file;//下载文件路径
	$size=filesize($download);//文件大小
	//echo "$download";
	header("content-type:application/octet-stream");//二进制文件
	header("content-disposition:attachment;filename=$file");//下载,保存时的文件名
	header("content-length:$size");//文件大小
	readfile($download);//读取文件
 ?>