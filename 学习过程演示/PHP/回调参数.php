<?php
//静态变量
function show($a,$b,$c){//$c就是回调参数
	return $c($a,$b);
}
function sum($x,$y){
	echo $x,$y."<br>";
	return $x+$y;
}
echo show(1,2,"sum");//把函数名传进去
 ?>
