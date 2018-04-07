<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
include "../../public/common/zoom.php";

if($_FILES["file"]["error"]==0){
	//原商品图片名
	$sqlimg="select img from awardshop where id={$_POST['id']}";
	$smtimg=$pdo->prepare($sqlimg);
	$smtimg->execute();
	$rowimg=$smtimg->fetch();
	
	$name=$_FILES["file"]["name"];//原文件名
	$sfile=$_FILES["file"]["tmp_name"];//上传的目录
	//限制为只能上传图片
	$arr=explode("/",$_FILES["file"]["type"]);
	$type=$arr[0];//图片类型

	$suffix=substr($name, strrpos($name,".")+1);//截取原文件后缀

	//保存的路径
	$dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/awardshop";

	//检查当天是否上次过文件
	if(!file_exists($dir)){
		mkdir($dir);//不存在则创建
	}
	//图片名字
	$filename=time().mt_rand().'.'.$suffix;
	$dfile=$dir.'/'.$filename;

	$id=$_POST['id'];
	$name=$_POST['name'];
	$intro=$_POST['intro'];
	$img=$filename;
	$repertory=$_POST['repertory'];
	$goodsShelf=$_POST['goodsShelf'];
	$mail=$_POST['mail'];
	$award=$_POST['award'];
	$address=$_POST['address'];
	$price=$_POST['price'];

	//修改商品信息
	$sqlshop="update awardshop set name='{$name}',intro='{$intro}',price={$price},img='{$img}',repertory={$repertory},goodsShelf={$goodsShelf},mail={$mail},award={$award},address='{$address}' where id={$id}";
	$smtshop=$pdo->prepare($sqlshop);
	if($type==="image"&&$smtshop->execute()){
		//删除图片
		unlink($dir.'/'.$rowimg['img']);
		unlink($dir.'/th_'.$rowimg['img']);

		move_uploaded_file($sfile,$dfile);
		zoom($dfile,100,100);//图片缩放
		echo "<script>location.href='select.php'</script>";
	}else{
		echo "<script>alert('只能上传图片')</script>";
		echo "<script>location.href='add.php'</script>";
	}
}else if($_FILES["file"]["error"]==4){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$intro=$_POST['intro'];
	$repertory=$_POST['repertory'];
	$goodsShelf=$_POST['goodsShelf'];
	$mail=$_POST['mail'];
	$award=$_POST['award'];
	$address=$_POST['address'];
	$price=$_POST['price'];

	//修改商品信息
	$sqlshop="update awardshop set name='{$name}',intro='{$intro}',price={$price},repertory={$repertory},goodsShelf={$goodsShelf},mail={$mail},award={$award},address='{$address}' where id={$id}";
	$smtshop=$pdo->prepare($sqlshop);
	if($smtshop->execute()){
		echo "<script>location.href='select.php'</script>";
	}else{
		echo "<script>location.href='add.php'</script>";
	}
}else{
	echo "<script>alert('图片错误')</script>";
	echo "<script>window.history.back();</script>";
}
 ?>