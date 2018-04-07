<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
include "../../public/common/Page.class.php";
//分页效果实现
$sql1="select count(*) from lclassify";
$smt1=$pdo->prepare($sql1);
$smt1->execute();
$sum=$smt1->fetchColumn();//数据总量
$num=6;//一页的数量
$page=$_GET['page']?$_GET['page']:1;
//使用page类
$page=new Page($sum,$num,$page);//总数,一页的个数,当前页

$sql="select lclassify.*,bclassify.name bname from lclassify,bclassify where lclassify.bclassify_id=bclassify.id order by id limit {$page->idx},{$page->num}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetchAll();
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台首页</title>
	<link rel="stylesheet" href="../../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/index.css">
	<script src="../../public/js/jquery.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="thumbnail">
        	<table class="table table-striped table-bordered table-hover">
				<tr>
					<th>id</th>
					<th>所在分类</th>
					<th>内容</th>
					<th>修改</th>
					<th>删除</th>
				</tr>
				<tr>
					<?php 
					foreach($rows as $row){
						echo "<tr>";
						echo "<td>{$row['id']}</td>";
						echo "<td>{$row['bname']}</td>";
						echo "<td>{$row['name']}</td>";
						echo "<td><a href='revamp.php?id={$row['id']}' class='btn btn-success'>修改</a></td>";
						echo "<td><a href='javascript:' class='btn btn-danger' num='{$row['id']}'>删除</a></td>";
						echo "</tr>";
					}
					 ?>
				</tr>
			</table>
			<p class="pull-right" id="sum">小分类个数:<span><?php echo $sum; ?></span></p>
			<?php 
				echo $page->show;
			 ?>
    </div>
</body>
<script>
	$("a[num]").click(function(){
		var id=$(this).attr('num');
		var that=$(this);
		var sum=$("#sum span").html();
		$.get("delete.php",{id:id},function(res){
			if(res){
				that.parent().parent().hide();
				$("#sum span").html(sum-1);
			}
		})
	});
</script>
</html>