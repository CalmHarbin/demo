<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
include "../../public/common/Page.class.php";
//分页效果实现
$sql1="select count(*) from indent";
$smt1=$pdo->prepare($sql1);
$smt1->execute();
$sum=$smt1->fetchColumn();//数据总量
$num=4;//一页的数量
$page=$_GET['page']?$_GET['page']:1;
//使用page类
$page=new Page($sum,$num,$page);//总数,一页的个数,当前页

$sql="select * from indent order by id limit {$page->idx},{$page->num}";
$smt=$pdo->prepare($sql);
$smt->execute();
$rows=$smt->fetchAll();

//订单状态查询
$sqlstate="select states.* from indent,states where indent.states_id=states.id";
$smtstate=$pdo->prepare($sqlstate);
$smtstate->execute();
$rowsstate=$smtstate->fetchAll();

//收获地址查询,买家查询
$sqladdress="select address.*,user.username from address,indent,user where indent.address_id=address.id&&address.user_id=user.id";
$smtaddress=$pdo->prepare($sqladdress);
$smtaddress->execute();
$rowsaddress=$smtaddress->fetchAll();

//买家留言查询,购买商品查询
$sqlmessage="select message.content,shop.name from message,shop,indent where indent.message_id=message.id&&message.shop_id=shop.id";
$smtmessage=$pdo->prepare($sqlmessage);
$smtmessage->execute();
$rowsmessage=$smtmessage->fetchAll();

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
					<th>订单号</th>
					<th>订单状态</th>
					<th>收获地址</th>
					<th>买家</th>
					<th>购买商品</th>
					<th>买家留言</th>
					<th>修改</th>
					<th>删除</th>
				</tr>
				<tr>
				<?php 
					foreach($rows as $key=>$row){
						echo "<tr>";
						echo "<td>{$row['id']}</td>";
						echo "<td>{$row['orderNumber']}</td>";
						echo "<td>{$rowsstate[$key]['state']}</td>";
						echo "<td>{$rowsaddress[$key]['address']}</td>";
						echo "<td>{$rowsaddress[$key]['username']}</td>";
						echo "<td>{$rowsmessage[$key]['name']}</td>";
						echo "<td>{$rowsmessage[$key]['content']}</td>";
						echo "<td><a href='revamp.php?id={$row['id']}&&states={$row['states_id']}&&address_id={$row['address_id']}' class='btn btn-success'>修改</a></td>";
						echo "<td><a href='javascript:' class='btn btn-danger' num='{$row['id']}' message_id='{$row['message_id']}'>删除</a></td>";
						echo "</tr>";
					}
					 ?>
				</tr>
			</table>
			<p class="pull-right" id="sum">订单个数:<span><?php echo $sum; ?></span></p>
			<?php 
				echo $page->show;
			 ?>
    </div>
</body>
<script>
	$("a[num]").click(function(){
		var id=$(this).attr('num');
		var message_id=$(this).attr('message_id');
		var that=$(this);
		var sum=$("#sum span").html();
		$.get("delete.php",{id:id,message_id:message_id},function(res){
			if(res){
				that.parent().parent().hide();
				$("#sum span").html(sum-1);
			}
		})
	});
</script>
</html>