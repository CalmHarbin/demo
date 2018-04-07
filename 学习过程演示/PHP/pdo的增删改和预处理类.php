<?php 
//统计表中的总行数
$pdo=new PDO('mysql:host=localhost;dbname=test','root','123');
//设置字符集
$pdo->exec('set names utf8');
//准备sql语句
$sql='select * from user';
//执行SQL语句,查
//$smt=$pdo->query($sql);
//打印结果
// $rows=$smt->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($rows);
// echo "</pre>";
// echo $rows[0]['count(*)'];

//方法二预处理
//准备sql语句
$sql2="insert into user(username,password,class_id) values(?,?,?)";
$sql3="delete from user where id>10";
//预处理sql语句
//$smt=$pdo->prepare($sql);
//数值绑定
// $smt->bindvalue(1,'user11');
// $smt->bindvalue(2,'123');
// $smt->bindvalue(3,2);
//执行预处理sql语句
//$smt->execute();
//查看上一条sql语句影响的行数
//echo $smt->rowCount();

//数据的增删改
$sql3="delete from user where id=2";
$pdo->exec($sql3);//执行sql语句
 ?>
