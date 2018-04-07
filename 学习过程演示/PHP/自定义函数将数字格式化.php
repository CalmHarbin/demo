<?php 
$str="12345678901234523";
function ng($str){
	//将传来的字符串反转一下
	$str1=strrev($str);
	//将反转后得到的新字符串按照每3位分割,组成一个数组,并返回
	$arr=str_split($str1,3);
	//将数组转成字符串,并以逗号连接
	$str2=join($arr,",");
	//将字符串反转并返回
	$str3=strrev($str2);
	return $str3;
}
echo ng($str);
 ?>
