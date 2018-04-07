<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../public/config.ico.php";
include "../public/Page.class.php";


//分页效果实现
$sql1="select count(*) from user";
$smt1=$pdo->prepare($sql1);
$smt1->execute();
$sum=$smt1->fetchColumn();//数据总量
$num=6;//一页的数量
$page=$_GET['page']?$_GET['page']:1;

//使用page类
$page=new Page($sum,$num,$page);//总数,一页的个数,当前页


$sql="select * from user order by id desc limit {$page->idx},{$page->num}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetchAll();


 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户查看</title>
	<link rel="stylesheet" href="../../public/css/bootstrap.min.css">
	<script src="../../public/js/jquery-3.2.1.js"></script>
	<script src="../../public/js/bootstrap.min.js"></script>
	<style>
	.navbar-brand{
		color: #000!important;
	}
	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="container-fluid">
				<div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="../index.php">酒仙网</a>
			    </div>
				
				<ul class="nav navbar-nav navbar-right">
			        <li><a href="#">欢迎<?php echo $_SESSION['username'] ?></a></li>
			        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理 
				          	<span class="caret"></span>
				          </a>
				           <ul class="dropdown-menu">
				            <li><a href="#"><?php echo $_SESSION['username'] ?></a></li>
				            <li role="separator" class="divider"></li>
				            <li><a href="#">修改</a></li>
				            <li role="separator" class="divider"></li>
				            <li><a href="../logon.php">退出登录</a></li>
				          </ul>
			        </li>
			     </ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="col-md-2">
			<div class="panel-group" id="accordion">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#panel1" data-toggle="collapse" data-parent="#accordion">会员管理</a>
						</div>
					</div>
					<div class="panel-collapse collapse in" id="panel1">
						<ul class="list-group">
						  <li class="list-group-item"><a href="">会员查看</a></li>
						  <li class="list-group-item"><a href="add.php">会员添加</a></li>
						</ul>
					</div>
				</div>
				<!-- 广告管理 -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#panel2" data-toggle="collapse" data-parent="#accordion">广告管理</a>
						</div>
					</div>
					<div class="panel-collapse collapse" id="panel2">
						<ul class="list-group">
						  <li class="list-group-item"><a href="">广告查看</a></li>
						  <li class="list-group-item"><a href="">广告添加</a></li>
						  <li class="list-group-item"><a href="">广告删除</a></li>
						  <li class="list-group-item"><a href="">广告修改</a></li>
						</ul>
					</div>
				</div>
				<!-- 分类管理 -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#panel3" data-toggle="collapse" data-parent="#accordion">分类管理</a>
						</div>
					</div>
					<div class="panel-collapse collapse" id="panel3">
						<ul class="list-group">
						  <li class="list-group-item"><a href="">分类查看</a></li>
						  <li class="list-group-item"><a href="">分类添加</a></li>
						  <li class="list-group-item"><a href="">分类删除</a></li>
						  <li class="list-group-item"><a href="">分类修改</a></li>
						</ul>
					</div>
				</div>
				<!-- 品牌管理 -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#panel4" data-toggle="collapse" data-parent="#accordion">品牌管理</a>
						</div>
					</div>
					<div class="panel-collapse collapse" id="panel4">
						<ul class="list-group">
						  <li class="list-group-item"><a href="">品牌查看</a></li>
						  <li class="list-group-item"><a href="">品牌添加</a></li>
						  <li class="list-group-item"><a href="">品牌删除</a></li>
						  <li class="list-group-item"><a href="">品牌修改</a></li>
						</ul>
					</div>
				</div>
				<!-- 商品管理 -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#panel5" data-toggle="collapse" data-parent="#accordion">商品管理</a>
						</div>
					</div>
					<div class="panel-collapse collapse" id="panel5">
						<ul class="list-group">
						  <li class="list-group-item"><a href="">商品查看</a></li>
						  <li class="list-group-item"><a href="">商品添加</a></li>
						  <li class="list-group-item"><a href="">商品删除</a></li>
						  <li class="list-group-item"><a href="">商品修改</a></li>
						</ul>
					</div>
				</div>
				<!-- 评论管理 -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#panel6" data-toggle="collapse" data-parent="#accordion">评论管理</a>
						</div>
					</div>
					<div class="panel-collapse collapse" id="panel6">
						<ul class="list-group">
						  <li class="list-group-item"><a href="">评论查看</a></li>
						  <li class="list-group-item"><a href="">评论添加</a></li>
						  <li class="list-group-item"><a href="">评论删除</a></li>
						  <li class="list-group-item"><a href="">评论修改</a></li>
						</ul>
					</div>
				</div>

				<!-- 订单管理 -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#panel7" data-toggle="collapse" data-parent="#accordion">订单管理</a>
						</div>
					</div>
					<div class="panel-collapse collapse" id="panel7">
						<ul class="list-group">
						  <li class="list-group-item"><a href="">订单查看</a></li>
						  <li class="list-group-item"><a href="">订单添加</a></li>
						  <li class="list-group-item"><a href="">订单删除</a></li>
						  <li class="list-group-item"><a href="">订单修改</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
		<div class="col-md-10">
			<table class="table table-striped table-bordered table-hover">
				<tr>
					<th>id</th>
					<th>用户名</th>
					<th>密码</th>
					<th>修改</th>
					<th>删除</th>
				</tr>
				<tr>
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
				</tr>
			</table>
			<?php 
			echo $page->show;
			 ?>
		</div>
	</div>
</body>
<script>
	$("a[num]").click(function(){
		var id=$(this).attr('num');
		var that=$(this);
		$.get("delete.php",{id:id},function(res){
			if(res){
				that.parent().parent().hide();
			}
		})
	});
</script>
</html>