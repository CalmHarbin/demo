<?php 
$pdo=new PDO('mysql:host=localhost;dbname=test','root','123');
$pdo->exec('set names utf8');
$sql="select * from user";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($rows);
// echo "</pre>";
$json=json_encode($rows);//将数组转化为json格式
echo $json;
//echo $rows;
 ?>