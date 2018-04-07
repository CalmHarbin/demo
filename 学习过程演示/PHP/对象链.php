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
	function say(){
		echo "my name is {$this->name},my age is {$this->age},my sex is {$this->sex}<br>";
		return $this;//返回本对象
	}
	function eat(){
		echo "eat<br>";
		return $this;
	}
	function sleep(){
		echo "sleep<br>";
		return $this;
	}
	//析构方法,当类被清除时触发
	function __destruct(){
		echo "我是{$this->name}<br>";
	}
}
$user=new Person("user","20","man");
$user->say()->eat()->sleep();//对象链
 ?>
