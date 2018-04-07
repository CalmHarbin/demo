<?php 
//含有抽象方法的类叫抽象类;
//不含有方法体的方法叫抽象方法;
//抽象类
abstract class Person{
	public $name="user";
	public abstract function say();
	public abstract function eat();
}
//子类
class Son extends Person{
	function say(){
		echo "我必须完成这个say方法";
	}
	function eat(){
		echo "我必须完成这个eat方法";
	}
}
//$user=new Person();//报错,抽象类无法实例化
$user=new Son();
$user->say();
$user->eat();
 ?>
