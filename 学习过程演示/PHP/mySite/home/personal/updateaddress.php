<?php 
if(!$_COOKIE['user']){
	echo "<script>location.href='/mySite/home/logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
if($_POST['isdefault']){
	//查询原默认地址,改为非默认
	$sqlold="update address set isdefault=0 where isdefault=1";
	$smtold=$pdo->prepare($sqlold);
	$smtold->execute();

	//修改数据
	$sql="update address set name='{$_POST['name']}',phone={$_POST['phone']},address='{$_POST['address']}',isdefault=1 where id={$_POST['id']}";
	$smt=$pdo->prepare($sql);
	if($smt->execute()){
		echo "<script>location.href='../personal.php?page=5'</script>";
	}else{
		echo "<script>history.back();</script>";
	}
}else{
	$sql="update address set name='{$_POST['name']}',phone={$_POST['phone']},address='{$_POST['address']}' where id={$_POST['id']}";
	$smt=$pdo->prepare($sql);
	if($smt->execute()){
		echo "<script>location.href='../personal.php?page=5'</script>";
	}else{
		echo "<script>history.back();</script>";
	}
}
 ?>