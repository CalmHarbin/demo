<?php 
$arr1=array(1,2,3,4,5);//索引数组
$arr2=array("name"=>"zhangsan","age"=>"20","sex"=>"nan");//关联数组
$arr3=array(1,2,3,"name"=>"zhangsan","age"=>"20","sex"=>"nan");//混合数组
echo "{$arr1[0]}\n","{$arr1[1]}\n","{$arr1[2]}\n","{$arr1[3]}\n","{$arr1[4]}<br>";
echo "{$arr2['name']}\n","{$arr2['age']}\n","{$arr2['sex']}<br>";
echo "{$arr3[0]}\n","{$arr3[1]}\n","{$arr3[2]}\n","{$arr3['name']}\n","{$arr3["age"]}\n","{$arr3["sex"]}";


//索引数组定义方法
$arr4=array(1,2,3);

$arr4=array(10=>1,30=>3,40=>34);

$arr4[10]=1;
$arr4[30]=3;
$arr4[40]=34;

//关联数组
$arr5=array("name"=>"zhangsan","age"=>"20","sex"=>"nan");

$arr5["name"]="zhangsan";
$arr5["age"]="20";
$arr5["sex"]="nan";

//混合数组
$arr6=array(1,2,10=>3,"name"=>"zhangsan");

$arr6[0]=1;
$arr6[1]=2;
$arr6[10]=3;
$arr6["name"]="zhangsan";



 ?>