<?php

//list(),依次对应数组下标,不可跳跃,只能对索引数组使用
$arr1=array(100,200,300);
list($a,$b,$c)=$arr1;
echo $a."<br>";
echo $b."<br>";
echo $c."<br>";
echo "-----------------------------";

//each()遍历,每each一次从数组中取出一个键值对;取不到则返回false
$arr2=array(100,200,300);
$a=each($arr2);//取出一个键值对,并返回一个数组
echo "<pre>";
print_r($a);//0索引是键,1索引是值
echo "</pre>";

$b=each($arr2);//取出一个键值对,并返回一个数组
echo "<pre>";
print_r($b);//0索引是键,1索引是值
echo "</pre>";
echo "-----------------------------<br>";

//each()和list()的配合使用来遍历数组;
//each($arr3)从arr3中取出一个键值对保存在一个新数组中,并让list()来遍历这个数组,
//$key则是$arr3中的键,$val则是$arr3中的值;
//取不到值返回false,则结束while循环
$arr3=array(100,200,"name"=>"zhangsan","age"=>"20",10=>30);
while(list($key,$val)=each($arr3)){
	echo "{$key}:{$val}"."<br>";
}
echo "-----------------------------<br>";


//foreach()循环遍历数组;
$arr4=array(100,200,"name"=>"zhangsan","age"=>"20",10=>30);
foreach($arr4 as $k=>$v){
	echo "{$k}:{$v}"."<br>";
}

 ?>
