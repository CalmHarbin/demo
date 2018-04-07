<?php 
include "config.ico.php";
//分页
$number=5;//一页多少个
$page=$_GET['page']?$_GET['page']:1;//当前页
$index=($page-1)*$number;//截取的索引
$sql="select * from user order by id asc limit {$index},{$number}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetchAll();

$sql2="select count(*) from user ";
$smt=$pdo->prepare($sql2);
$smt->execute();
$count=$smt->fetchColumn();//总共有多少个
$pages=ceil($count/$number);//有多少页
$previous=$page-1;//上一页
$next=$page+1;//下一页
if($page>=$pages){
	$next=$pages;//下一页
}
if($page<=1){
	$previous=1;
}
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户模块</title>
	<link rel="stylesheet" href="../bs/bootstrap.min.css">
	<script src="../bs/jquery-3.2.1.js"></script>
	<script src="../bs/bootstrap.min.js"></script>
	<style>
	.table{
		margin-top: 20px;
	}
	th,td{
		text-align: center;
	}
	</style>
</head>
<body>
	<div class="container">
		<h1>用户表</h1>
		<div>
			<a href="" class="btn btn-primary">查看</a>
			<a href="add.php" class="btn btn-primary">添加</a>
		</div>
		<table class="table table-bordered table-striped table-hover">
			<tr>
				<th>id</th>
				<th>用户名</th>
				<th>密码</th>
				<th>修改</th>
				<th>删除</th>
			</tr>
			
			<?php 
			foreach($rows as $row){
				echo "<tr>";
				echo "<td>{$row['id']}</td>";
				echo "<td>{$row['username']}</td>";
				echo "<td>{$row['password']}</td>";
				echo "<td><a href='revamp.php?id={$row['id']}' class='btn btn-success'>修改</a></td>";
				echo "<td><a href='javascript:' class='btn btn-danger' num='{$row['id']}'>删除</a></td>";
				echo "</tr>";
			}
			 ?>
			
		</table>
		<ul class="pager">
			<li class="previous"><a href="index.php?page=<?php echo $previous; ?>">上一页</a></li>
			<li class="next"><a href="index.php?page=<?php echo $next; ?>">下一页</a></li>
		</ul>
	</div>
	<script>
	$("table a.btn-danger").click(function(){
		var del=confirm("您确认删除该用户吗?");
		console.log(del);
		if(del){
			//ajax
			var id=$(this).attr('num');
			var that=$(this);
			$.get("delete.php",{id:id},function(res){
				if(res){
					that.parent().parent().hide();
				}
			});
		}
	});
	</script>
</body>

</html>