<?php 
//连接数据库
$pdo=new PDO('mysql:host=localhost;dbname=test','root','123');
//更改编码
$pdo->exec('set names utf8');

//异常抛出
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//开启任务
$pdo->beginTransaction(); 
try{
	//准备sql语句
	$sql1='delete from user where id=2';
	//预处理SQL语句
	$smt=$pdo->prepare($sql1);
	//执行预处理语句
	$smt->execute();

	$sql2='delete from user where id=5';
	$smt=$pdo->prepare($sql2);
	$smt->execute();

	//任务成功,提交任务
	$pdo->commit();
}catch(PDOException $err){
	echo $err->getMessage()."<br>";//获取异常信息
	echo $err->getFile()."<br>";//获取异常文件名
	echo $err->getLine()."<br>";//获取异常行数
	//回滚,撤销本次任务
	$pdo->rollBack();
}


 ?>
