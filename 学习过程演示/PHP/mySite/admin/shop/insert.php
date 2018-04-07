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
$dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/shop";

//检查当天是否上次过文件
if(!file_exists($dir)){
	mkdir($dir);//不存在则创建
}
//图片名字
$filename=time().mt_rand().'.'.$suffix;
$dfile=$dir.'/'.$filename;

$name=$_POST['name'];
$intro=$_POST['intro'];
$img=$filename;
$currentPrice=$_POST['currentPrice'];
$originalPrice=$_POST['originalPrice'];
$repertory=$_POST['repertory'];
$goodsShelf=$_POST['goodsShelf'];
$mail=$_POST['mail'];
$award=$_POST['award'];
$lclassify_id=$_POST['lclassify_id'];
$pricesection_id=$_POST['pricesection_id'];

//新增商品信息
$sqlshop="insert into shop(name,intro,img,currentPrice,originalPrice,salesVolume,repertory,goodsShelf,mail,integral,award,address,lclassify_id,evaluate_id,pricesection_id) values('{$name}','{$intro}','{$img}',{$currentPrice},{$originalPrice},0,{$repertory},{$goodsShelf},{$mail},1000,{$award},'湖北随州',{$lclassify_id},0,{$pricesection_id})";
$smtshop=$pdo->prepare($sqlshop);

if($type==="image"&&$smtshop->execute()){
	$id=$pdo->lastInsertId();
	foreach ($_POST['keyword_id'] as $keyword_id) {
		//新增商品关键字
		$sqlkey="insert into shopkeywords(shop_id,keyword_id) values({$id},$keyword_id)";
		$smtkey=$pdo->prepare($sqlkey);
		$smtkey->execute();
	}
	move_uploaded_file($sfile,$dfile);
	zoom($dfile,100,100);//图片缩放
	echo "<script>location.href='select.php'</script>";
}else{
	echo "<script>alert('只能上传图片')</script>";
	echo "<script>location.href='add.php'</script>";
}

 ?>