<?php 
//多态
//接口
interface Person{
	function say();
	function eat();
}
//子类
class Son implements Person{
	function say(){
		echo "我必须完成这个say方法<br>";
	}
	function eat(){
		echo "我必须完成这个eat方法<br>";
	}
}
//盗版的
class Son2{
	function say(){
		echo "我必须完成这个say方法<br>";
	}
	function eat(){
		echo "我必须完成这个eat方法<br>";
	}
}
//执行方法的函数,多态
function execute(Person $obj){//加父类的名字
	$obj->say();
	$obj->eat();
}
$son=new Son();//正版的对象
$son2=new Son2();//盗版的对象
execute($son);//可执行
execute($son2);//报错
 ?>
