<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
include "../../public/common/zoom.php";

if($_FILES['img']['error']==0&&$_FILES['info']['error']==0){
	$nameimg=$_FILES["img"]["name"];//原文件名
	$nameinfo=$_FILES["info"]["name"];//原文件名
	$sfile=$_FILES["img"]["tmp_name"];//上传的目录
	//限制为只能上传图片
	$arrimg=explode("/",$_FILES["img"]["type"]);
	$typeimg=$arrimg[0];//图片类型

	$arrinfo=explode("/",$_FILES["info"]["type"]);
	$typeinfo=$arrinfo[0];//图片类型

	$suffiximg=substr($nameimg, strrpos($nameimg,".")+1);//截取原文件后缀
	$suffixinfo=substr($nameinfo, strrpos($nameinfo,".")+1);//截取原文件后缀

	//保存的路径
	$dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/shop";

	//检查当天是否上次过文件
	if(!file_exists($dir)){
		mkdir($dir);//不存在则创建
	}
	//图片名字
	$filenameimg=time().mt_rand().'.'.$suffiximg;
	$dfileimg=$dir.'/'.$filenameimg;

	$filenameinfo=time().mt_rand().'.'.$suffixinfo;
	$dfileinfo=$dir.'/'.$filenameinfo;

	//新增商品信息
	$sqlshop="insert into shopimg(shop_id,img,info) values({$_POST['shop_id']},'{$filenameimg}','{$filenameinfo}')";
	$smtshop=$pdo->prepare($sqlshop);

	if($typeimg==="image"&&$typeinfo==="image"&&$smtshop->execute()){

		// move_uploaded_file($sfile,$dfileimg);
		// zoom($dfileimg,100,100);//图片缩放
		move_uploaded_file($sfile,$dfileinfo);
		// zoom($dfileinfo,100,100);//图片缩放

	// 	echo "<script>location.href='info.php?shop_id={$_POST['shop_id']}'</script>";
	// }else{
	// 	echo "<script>alert('只能上传图片')</script>";
	// 	echo "<script>history.back()</script>";
	}
}else if($_FILES['img']['error']==0&&$_FILES['info']['error']==4){
	// $nameimg=$_FILES["img"]["name"];//原文件名
	// $sfile=$_FILES["img"]["tmp_name"];//上传的目录
	// //限制为只能上传图片
	// $arrimg=explode("/",$_FILES["img"]["type"]);
	// $typeimg=$arrimg[0];//图片类型


	// $suffiximg=substr($nameimg, strrpos($nameimg,".")+1);//截取原文件后缀

	// //保存的路径
	// $dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/shop";

	// //检查当天是否上次过文件
	// if(!file_exists($dir)){
	// 	mkdir($dir);//不存在则创建
	// }
	// //图片名字
	// $filenameimg=time().mt_rand().'.'.$suffiximg;
	// $dfileimg=$dir.'/'.$filenameimg;

	// //新增商品信息
	// $sqlshop="insert into shopimg(shop_id,img,info) values({$_POST['shop_id']},'{$filenameimg}','')";
	// $smtshop=$pdo->prepare($sqlshop);

	// if($typeimg==="image"&&$smtshop->execute()){
		
	// 	move_uploaded_file($sfile,$dfileimg);
	// 	zoom($dfileimg,100,100);//图片缩放
	// 	echo "<script>location.href='info.php?shop_id={$_POST['shop_id']}'</script>";
	// }else{
	// 	echo "<script>alert('只能上传图片')</script>";
	// 	echo "<script>history.back()</script>";
	// }
}else if($_FILES['img']['error']==4&&$_FILES['info']['error']==0){
	// $nameinfo=$_FILES["info"]["name"];//原文件名
	// $sfile=$_FILES["img"]["tmp_name"];//上传的目录
	// //限制为只能上传图片

	// $arrinfo=explode("/",$_FILES["info"]["type"]);
	// $typeinfo=$arrinfo[0];//图片类型

	// $suffixinfo=substr($nameinfo, strrpos($nameinfo,".")+1);//截取原文件后缀

	// //保存的路径
	// $dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/shop";

	// //检查当天是否上次过文件
	// if(!file_exists($dir)){
	// 	mkdir($dir);//不存在则创建
	// }
	// //图片名字
	// $filenameinfo=time().mt_rand().'.'.$suffixinfo;
	// $dfileinfo=$dir.'/'.$filenameinfo;

	// //新增商品信息
	// $sqlshop="insert into shopimg(shop_id,img,info) values({$_POST['shop_id']},'','{$filenameinfo}')";
	// $smtshop=$pdo->prepare($sqlshop);

	// if($typeinfo==="image"&&$smtshop->execute()){
	// 	move_uploaded_file($sfile,$dfileinfo);
	// 	zoom($dfileinfo,100,100);//图片缩放
	// 	echo "<script>location.href='info.php?shop_id={$_POST['shop_id']}'</script>";
	// }else{
	// 	echo "<script>alert('只能上传图片')</script>";
	// 	echo "<script>history.back()</script>";
	// }
}else{
	echo "<script>location.href='select.php'</script>";
}


 ?>