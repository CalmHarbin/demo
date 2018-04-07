<?php 
$arr=array(1,2,5,6,3,6,1,2,4,2,1,3,2);
$a=sort($arr);//sort()升序排序
echo "$a";
echo "<pre>";
print_r($arr);
echo "</pre>";

//获取数组里面每个值出现的次数
foreach ($arr as $value) {
	$arr1[$value]=$arr1[$value]+1;//每出现一次就+1;
}
echo "<pre>";
print_r($arr1);
echo "</pre>";
 ?>
