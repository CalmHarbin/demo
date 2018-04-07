<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
//查找图片名称
$sqlimg="select img from shop where id={$_GET['id']}";
$smtimg=$pdo->prepare($sqlimg);
$smtimg->execute();
$row=$smtimg->fetch();

$dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/shop";//文件路径

//删除数据
$sql="delete from shop where id={$_GET['id']}";
$smt=$pdo->prepare($sql);

if($smt->execute()){
	$sqlkey="delete from shopkeywords where shop_id={$_GET['id']}";
	$smtkey=$pdo->prepare($sqlkey);
	$smt->execute();
	unlink($dir.'/'.$row['img']);
	unlink($dir.'/th_'.$row['img']);
	echo 1;
}else{
	echo 0;
}
 ?>