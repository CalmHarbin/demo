<?php
$i=1;
function show(){
	global $i;//引入全局变量$i;
	$i++;//让$i++;
	$j=2;//定义局部变量
	return $j;//返回局部变量$j
}
$k=show();
echo $k;
 ?>
