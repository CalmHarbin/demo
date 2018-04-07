<?php 
//获得指定范围的数组;
$arr1=range(1,9);
$arr2=range(a,z);
$arr3=range(A,Z);
//将数组合并
$arr=array_merge($arr1,$arr2,$arr3);
//将数组打乱
shuffle($arr);
//提取四位元素
$arr4=array_slice($arr,0,4);//从第0下标开始,提取四位,不改变原数组;
//将提取的数组转化为字符串
$str=join($arr4," ");
echo $str;//输出验证码
 ?>
