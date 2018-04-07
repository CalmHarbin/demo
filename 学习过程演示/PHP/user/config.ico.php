<?php 
	//连接数据库
	$pdo=new PDO('mysql:host=localhost;dbname=test','root','123');
	//字符集
	$pdo->exec('set names utf8');
	//默认查询,默认异常
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 ?>