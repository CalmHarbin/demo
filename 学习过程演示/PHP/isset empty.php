<?php 
$str1="";
$str2=0;
$str3=array();
$str4=0.0;
$str5=null;
$str6=false;
$str7="0";
$str8=(object)array();//一个空对象
//isset()判断字符串是否存在,存在true,不存在false
var_dump(isset($str1));//true
var_dump(isset($str2));//true
var_dump(isset($str3));//true
var_dump(isset($str4));//true
var_dump(isset($str5));//false
var_dump(isset($str6));//ture
var_dump(isset($str7));//true
var_dump(isset($str8));//true
var_dump(isset($str9));//false  未定义
echo "--------------------";
//empty()判断字符串是否为空,是true,不是false
var_dump(empty($str1));//true
var_dump(empty($str2));//true
var_dump(empty($str3));//true
var_dump(empty($str4));//true
var_dump(empty($str5));//true
var_dump(empty($str6));//true
var_dump(empty($str7));//true
var_dump(empty($str8));//false
echo "--------------------";
//gettype()获取类型结果;
echo "<br>";print gettype($str1);//string
echo "<br>";print gettype($str2);//integer
echo "<br>";print gettype($str3);//array
echo "<br>";print gettype($str4);//double
echo "<br>";print gettype($str5);//NULL
echo "<br>";print gettype($str6);//boolean
echo "<br>";print gettype($str7);//string
echo "<br>";print gettype($str8);//object
 ?>