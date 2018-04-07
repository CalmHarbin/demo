<?php 
//文件名和类名相同
//定义一个类
class Person{
	public $name;
	public $age;
	public $sex;
	//构造方法
	function __construct($name,$age,$sex){
		$this->name=$name;
		$this->age=$age;
		$this->sex=$sex;
	}
	//构造函数第二种方法,名字和类相同
	// function Person($name,$age,$sex){
	// 	$this->name=$name;
	// 	$this->age=$age;
	// 	$this->sex=$sex;
	// }
	function say(){
		echo "my name is {$this->name},my age is {$this->age},my sex is {$this->sex}<br>";
	}
	//析构方法,当类被清除时触发
	function __destruct(){
		echo "我是{$this->name}<br>";
	}
}
$user1=new Person("user1","20","man");
$user2=new Person("user2","40","woman");
$user3=new Person("user3","60","man");
$user1->say();
$user2->say();
$user3->say();
//回收是倒着的,栈的先进后出原理
 ?>
