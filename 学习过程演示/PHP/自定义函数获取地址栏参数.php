<?php 
//自定义函数获取地址栏参数,$_GET
function get(){
	$arr=$_SERVER;
	//获取参数部分
	$str=$arr["QUERY_STRING"];
	//将参数字符串分割
	$arr1=explode("&",$str);
	foreach ($arr1 as $key => $value) {
	$arr2=explode("=", $value);//将一组参数以=来分割
	$arr3[$arr2[0]]=$arr2[1];//将=坐边的作为键,=右边的作为值,组成新的数组;
	}
	return $arr3;
}
$_GET=get();
echo "<pre>";
print_r($_GET);
echo "</pre>";
 ?>
