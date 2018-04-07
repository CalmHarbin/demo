<?php 
session_start();
if(!$_COOKIE){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
include "../../public/common/zoom.php";

if($_FILES["file"]["error"]==0){
	$name=$_FILES["file"]["name"];//原文件名
	$sfile=$_FILES["file"]["tmp_name"];//上传的目录
	//限制为只能上传图片
	$arr=explode("/",$_FILES["file"]["type"]);
	$type=$arr[0];//图片类型

	$suffix=substr($name, strrpos($name,".")+1);//截取原文件后缀

	//保存的路径
	$dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/datum";

	//检查目录是否存在
	if(!file_exists($dir)){
		mkdir($dir);//不存在则创建
	}
	$filename=time().mt_rand().'.'.$suffix;
	$dfile=$dir.'/'.$filename;

	$sql="update datum set img='{$filename}',sex={$_POST['sex']},phone={$_POST['phone']},QQ={$_POST['QQ']},birthday={$_POST['birthday']},address='{$_POST['address']}' where user_id={$_POST['user_id']}";
	$smt=$pdo->prepare($sql);
	if($type==="image"&&$smt->execute()){
		//删除原头像
		unlink($dir."/".$_POST['img']);
		unlink($dir."/th_".$_POST['img']);

		move_uploaded_file($sfile,$dfile);
		zoom($dfile,120,120);//图片缩放
		echo "<script>alert('修改成功')</script>";
		echo "<script>location.href='../personal.php'</script>";
	}else{
		echo "<script>alert('只能上传图片')</script>";
		echo "<script>location.href='../personal.php'</script>";
	}
}else{
	$sql="update datum set sex={$_POST['sex']},phone={$_POST['phone']},QQ={$_POST['QQ']},birthday={$_POST['birthday']},address='{$_POST['address']}' where user_id={$_POST['user_id']}";
	$smt=$pdo->prepare($sql);
	if($smt->execute()){
		echo "<script>alert('修改成功')</script>";
		echo "<script>location.href='../personal.php'</script>";
	}else{
		echo "<script>alert('只能上传图片')</script>";
		echo "<script>location.href='../personal.php'</script>";
	}
}

 ?>