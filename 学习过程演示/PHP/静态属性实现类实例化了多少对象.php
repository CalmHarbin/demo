<?php 
//统计一个类实例化了多少对象
//静态属性
class Person{
	public static $tot;//静态属性
	function __construct(){
		SELF::$tot++;//SELF表示本类
	}
	function say(){
		echo "111";
	}
}
$obj1=new Person();
$obj2=new Person();
$obj3=new Person();
$obj4=new Person();
echo Person::$tot;
 ?>
