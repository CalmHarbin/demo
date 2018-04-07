<?php 
//继承
//父类
class Person{
	//属性
	public $name;
	public $age;
	public $sex;
	//构造方法
	public function __construct($n,$a,$s){
		$this->name=$n;
		$this->age=$a;
		$this->sex=$s;
	}
	//方法
	public function say(){
		echo "my name is {$this->name}<br>";
	}
}
//子类
class It extends Person{
	//新增属性
	public $language;
	//构造方法
	public function __construct($n,$a,$s,$l){
		parent::__construct($n,$a,$s);//将父类的构造方法内容拿过来
		$this->language=$l;
	}
	//新增方法
	public function study(){
		echo "我正在学习{$this->language}";
	}
}
//创建子对象
$user=new It("user","20","man","php");
$user->say();//调用父类中的方法
$user->study();//调用子类中的方法
 ?>
