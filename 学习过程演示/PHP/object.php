<?php 
//class 定义一个类
class Persor{
	public $name="zhangsan";
	public $age="20";
	public $sex="nan";
	public function say(){
		echo "my name is {$this->name}";//$this来表示自己
	}
}
$user1=new Persor();
echo "{$user1->name}","{$user1->age}","{$user1->sex}<br>";
$user1->say();
 ?>