<?php 
//文件名和类名相同
//定义一个类
class Person{
	public $name="user";
	public $age='20';
	public $sex='man';
	function say(){
		echo "my name is ".$this->name.'<br>';
	}
}
$user1=new Person();
$user1->say();
echo $user1->name.'<br>';
echo $user1->age.'<br>';
echo $user1->sex.'<br>';
 ?>
