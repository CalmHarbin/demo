<?php
//静态变量
function show(){
	static $i=0;//静态变量,即下次的值会结着上次,不会重新赋值
	$i+=2;
	echo $i;
	echo "<br>";
} 
show();
show();
show();
show();
show();
show();
 ?>
