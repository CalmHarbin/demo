<?php 
function show(){
	$arr=func_get_args();//将传来的参数存放在数组中
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
	$num=func_num_args();//获取传来参数的个数
	echo $num;
}
show(1,2,3,4,5,"sadasda");


 ?>
