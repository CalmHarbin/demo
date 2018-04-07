<?php 
$arr=array(
	"name"=>"zhangsan",
	"age"=>"20",
	"sex"=>"man"
	);
function random($arr){//自定义random函数,取数组随机值
	$len=0;
	foreach ($arr as $value) {
		$arr1[]=$value;//将值依次存在数组arr1中
		$len++;
	}
	return $arr1[mt_rand(0,$len-1)];//mt_rand(min,max)获取min到max的随机整数
}
echo random($arr);
 ?>
