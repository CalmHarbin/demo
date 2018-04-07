<?php 
//只含有抽象方法的类叫接口
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
//$user=new Person();//报错,抽象类无法实例化
$user=new Son();
$user->say();
$user->eat();
 ?>
