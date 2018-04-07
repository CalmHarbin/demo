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
	$sqlimg="select img from shop where id={$_POST['id']}";
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
	$dir="{$_SERVER['DOCUMENT_ROOT']}/mySite/public/uploads/shop";

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
	$currentPrice=$_POST['currentPrice'];
	$originalPrice=$_POST['originalPrice'];
	$repertory=$_POST['repertory'];
	$goodsShelf=$_POST['goodsShelf'];
	$mail=$_POST['mail'];
	$award=$_POST['award'];
	$lclassify_id=$_POST['lclassify_id'];
	$pricesection_id=$_POST['pricesection_id'];
	$address=$_POST['address'];

	//修改商品信息
	$sqlshop="update shop set name='{$name}',intro='{$intro}',img='{$img}',currentPrice={$currentPrice},originalPrice={$originalPrice},repertory={$repertory},goodsShelf={$goodsShelf},mail={$mail},award={$award},lclassify_id={$lclassify_id},pricesection_id={$pricesection_id},address='{$address}' where id={$id}";
	$smtshop=$pdo->prepare($sqlshop);
	if($type==="image"&&$smtshop->execute()){
		//删除图片
		unlink($dir.'/'.$rowimg['img']);
		unlink($dir.'/th_'.$rowimg['img']);
		//修改商品关键字,先删除后增加
		$sqlkeydel="delete from shopkeywords where shop_id={$id}";
		$smtkeydel=$pdo->prepare($sqlkeydel);
		$smtkeydel->execute();
		//后增加
		foreach ($_POST['keyword_id'] as $keyword_id) {
			//增加商品关键字
			$sqlkey="insert into shopkeywords(shop_id,keyword_id) values({$id},'{$keyword_id}')";
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
}else if($_FILES["file"]["error"]==4){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$intro=$_POST['intro'];
	$currentPrice=$_POST['currentPrice'];
	$originalPrice=$_POST['originalPrice'];
	$repertory=$_POST['repertory'];
	$goodsShelf=$_POST['goodsShelf'];
	$mail=$_POST['mail'];
	$award=$_POST['award'];
	$lclassify_id=$_POST['lclassify_id'];
	$pricesection_id=$_POST['pricesection_id'];
	$address=$_POST['address'];

	//修改商品信息
	$sqlshop="update shop set name='{$name}',intro='{$intro}',currentPrice={$currentPrice},originalPrice={$originalPrice},repertory={$repertory},goodsShelf={$goodsShelf},mail={$mail},award={$award},lclassify_id={$lclassify_id},pricesection_id={$pricesection_id},address='{$address}' where id={$id}";
	$smtshop=$pdo->prepare($sqlshop);
	if($smtshop->execute()){
		//修改商品关键字,先删除后增加
		$sqlkeydel="delete from shopkeywords where shop_id={$id}";
		$smtkeydel=$pdo->prepare($sqlkeydel);
		$smtkeydel->execute();
		//后增加
		foreach ($_POST['keyword_id'] as $keyword_id) {
			//增加商品关键字
			$sqlkey="insert into shopkeywords(shop_id,keyword_id) values({$id},'{$keyword_id}')";
			$smtkey=$pdo->prepare($sqlkey);
			$smtkey->execute();
		}
		echo "<script>location.href='select.php'</script>";
	}else{
		echo "<script>location.href='revamp.php'</script>";
	}
}else{
	echo "<script>alert('图片错误')</script>";
	echo "<script>window.history.back();</script>";
}



 ?>