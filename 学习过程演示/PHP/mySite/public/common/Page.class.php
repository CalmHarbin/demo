<?php 
class Page{
	public $idx;
	public $num;
	public $show;
	//总数,一页的个数,当前页
	function __construct($sum,$num,$page){
		$this->num=$num;
		$this->idx=($page-1)*$num;
		$pages=ceil($sum/$num);
		if($page!=1){
			$previous=$page-1;
		}else{
			$previous=1;
		}
		if($page!=$pages){
			$next=$page+1;
		}else{
			$next=$page;
		}
		for($i=1;$i<=$pages;$i++){
		    	if($i==$page){
		    		$str.="<li class='active'><a href='select.php?page={$i}'>{$i}</a></li>";
		    	}else{
		    		$str.="<li><a href='select.php?page={$i}'>{$i}</a></li>";
		    	}
		    }
		$this->show="
				<nav aria-label='Page navigation'>
			  <ul class='pagination'>
			    <li><a href='select.php?page={$previous}'>&laquo;</a></li>
			    ".$str."
			    <li><a href='select.php?page={$next}'>&raquo;</a></li>
			  </ul>
			</nav>
		";
	}
}

 ?>