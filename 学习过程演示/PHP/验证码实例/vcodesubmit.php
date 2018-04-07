<?php 
session_start();
echo "<pre>";
print_r($_SESSION["vcode"]);
echo "</pre>";

echo "<pre>";
print_r($_POST);
echo "</pre>";
//将字符串中空格去掉
$str=str_replace(" ", "", $_SESSION["vcode"]);
//把字符串转小写
$str_old=strtolower($str);
$str_new=strtolower($_POST["vcode"]);

if($str_old===$str_new){
	echo "验证码正确";
}else{
	echo "验证码错误";
}
 ?>