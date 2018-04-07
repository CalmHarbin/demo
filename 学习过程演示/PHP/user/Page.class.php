<?php 
//接收两个参数,总行数和一页多少行
//提供三个属性,index是limit截取的索引,number是截取的个数,show是分页按钮
class Page{
	public $index;
	public $number;
	public $show;
	public function __construct($count,$number){
		$this->number=$number;
		
		$page=$_GET['page']?$_GET['page']:1;//当前页
		$this->index=($page-1)*$number;//截取的索引

		$pages=ceil($count/$number);//有多少页
		$previous=$page-1;//上一页
		$next=$page+1;//下一页
		if($page>=$pages){
			$next=$pages;//下一页
		}
		if($page<=1){
			$previous=1;
		}
		$this->show="<ul class='pager'>
				<li class='previous'><a href='index.php?page={$previous}'>上一页</a></li>
				<li class='next'><a href='index.php?page={$next}'>下一页</a></li>
			</ul>";
	}
}
 ?>