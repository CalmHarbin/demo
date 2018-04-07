<?php 
// echo $_GET['id'];
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

//连接数据库
$pdo=new PDO('mysql:host=localhost;dbname=test','root','123');
//设置字符集
$pdo->exec('set names utf8');
//sql语句
$sql='delete from user where id=?';
//预处理sql语句
$smt=$pdo->prepare($sql);
//绑定数据
$smt->bindValue(1,$_GET['id']);
//执行预处理语句
if ($smt->execute()) {
	echo "1";
}else{
	echo "0";
}
 ?>