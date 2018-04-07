<?php 
$arr=array(
	"name"=>"user",
	"age"=>"20",
	"sex"=>"man",
	1,2,3
	);
echo "<pre>";
print_r($arr);
echo "</pre>";
echo "--------------------------------";
//获取数组中的值
$arr2=array_values($arr);
echo "<pre>";
print_r($arr2);
echo "</pre>";
echo "--------------------------------";
//获取数组中的键
$arr3=array_keys($arr);
echo "<pre>";
print_r($arr3);
echo "</pre>";
echo "--------------------------------";
//判断值在不在数组中
$arr4=in_array("user",$arr);
echo "<pre>";
var_dump($arr4);
echo "</pre>";
echo "--------------------------------";
//判断键在不在数组中
$arr5=array_key_exists("name",$arr);
echo "<pre>";
var_dump($arr5);
echo "</pre>";
echo "--------------------------------";
//将数组的键值对调
$arr6=array_flip($arr);
echo "<pre>";
print_r($arr6);
echo "</pre>";
echo "--------------------------------";
//反转数组
$arr7=array_reverse($arr);
echo "<pre>";
print_r($arr7);
echo "</pre>";
echo "--------------------------------";
 ?>
