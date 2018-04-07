<?php 
echo __FILE__;//文件的绝对路径
echo "<br>";
echo __LINE__;//当前所在行数
echo "<br>";
echo M_PI;//圆周率
echo "<br>";
function show(){
	echo "my function name is  ".__FUNCTION__;//返回所在的函数名
}
show();
 ?>