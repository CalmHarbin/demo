<?php 
//继承
//父类
class Person{
	//属性
	public $name="user";//公开的,外面和子类都可以访问
	protected $age="20";//被保护的,外面不能访问,子类可以访问
	private $sex="man";//私有的,外面和子类都不能访问
}
//子类
class It extends Person{
	//新增方法
	public function parentName(){
		echo "我父亲的年龄是{$this->name}<br>";
	}
	public function parentAge(){
		echo "我父亲的年龄是{$this->age}<br>";
	}
	public function parentSex(){
		echo "我父亲的年龄是{$this->sex}<br>";
	}
}
$parent=new Person();//父对象
$son=new It();//子对象
echo $parent->name."---".$son->name."<br>";//父对象和子对象都可以访问公开的属性
//echo $parent->age;//父对象不能访问被保护的属性
echo $son->parentName();
echo $son->parentAge();
echo $son->parentSex();
 ?>
