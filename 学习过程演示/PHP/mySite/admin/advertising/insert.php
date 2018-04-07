<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
include "../../public/common/zoom.php";

$name=$_FILES["file"]["name"];//原文件名
$sfile=$_FILES["file"]["tmp_name"];//上传的目录
//限制为只能上传图片
$arr=explode("/",$_FILES["file"]["type"]);
$type=$arr[0];//图片类型

$suffix=substr($name, strrpos($name,".")+1);//截取原文件后缀

//保存的路径
$dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/advertising";

//检查目录是否存在
if(!file_exists($dir)){
	mkdir($dir);//不存在则创建s
}
$filename=time().mt_rand().'.'.$suffix;
$dfile=$dir.'/'.$filename;

$sql="insert into advertising(img,place,url,isshow) values('{$filename}','{$_POST['place']}','{$_POST['url']}','{$_POST['isshow']}')";
$smt=$pdo->prepare($sql);
if($type==="image"&&$smt->execute()){
	move_uploaded_file($sfile,$dfile);
	zoom($dfile,60,60);//图片缩放
	echo "<script>location.href='select.php'</script>";
}else{
	echo "<script>alert('只能上传图片')</script>";
	echo "<script>location.href='add.php'</script>";
}

 ?>