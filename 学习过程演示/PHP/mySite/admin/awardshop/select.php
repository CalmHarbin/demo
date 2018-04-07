<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
include "../../public/common/Page.class.php";
//分页效果实现
$sql1="select count(*) from awardshop";
$smt1=$pdo->prepare($sql1);
$smt1->execute();
$sum=$smt1->fetchColumn();//数据总量
$num=3;//一页的数量
$page=$_GET['page']?$_GET['page']:1;
//使用page类
$page=new Page($sum,$num,$page);//总数,一页的个数,当前页

$sql="select * from awardshop order by id limit {$page->idx},{$page->num}";
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
					<th>名称</th>
					<th>图片</th>
					<th>所需积分</th>
					<th>上下架</th>
					<th>是否包邮</th>
					<th>详细信息</th>
					<th>修改</th>
					<th>删除</th>
				</tr>
				<tr>
					<?php 
					foreach($rows as $row){
						$sqlclass="select lclassify.name lname,bclassify.name bname from shop,lclassify,bclassify where shop.lclassify_id=lclassify.id&&lclassify.bclassify_id=bclassify.id&&shop.id={$row['id']}";
						$smtclass=$pdo->prepare($sqlclass);
						$smtclass->execute();
						$rowclass=$smtclass->fetch();
						echo "<tr>";
						echo "<td>{$row['id']}</td>";
						echo "<td>{$row['name']}</td>";
						echo "<td><img src='/mySite/public/uploads/awardshop/th_".$row['img']."'/></td>";
						echo "<td>{$row['price']}</td>";
						echo $row['goodsShelf']?"<td>上架</td>":"<td>下架</td>";
						echo $row['mail']?"<td>包邮</td>":"<td>不包邮</td>";
						echo "<td><a href='info.php?id={$row['id']}' class='btn btn-primary'>详细信息</td>";
						echo "<td><a href='revamp.php?id={$row['id']}' class='btn btn-success'>修改</a></td>";
						echo "<td><a href='javascript:' class='btn btn-danger' num='{$row['id']}'>删除</a></td>";
						echo "</tr>";
					}
					 ?>
				</tr>
			</table>
			<p class="pull-right" id="sum">积分商品个数:<span><?php echo $sum; ?></span></p>
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