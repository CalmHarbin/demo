<?php 
if(!$_COOKIE['user']){
	echo "<script>location.href='logon.php'</script>";
	exit;
}
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>购物车</title>
	<link rel="stylesheet" href="public/css/index.css">
	<link rel="stylesheet" href="public/css/shop.css">
	<script src="../public/js/jquery.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include "public/common/header.php";?>
	<!-- 主体内容 -->
	<section>
		<div class="main">
			<div class="shoptop">
				<div class="left">
					我的购物车
				</div>
				<div class="right">
					<div class="Rleft">1.查看购物车
						<span class="one"></span>
					</div>
					<div class="Rmiddle">2.填写购物信息
						
					</div>
					<div class="Rright">3.完成订单
						<span class="two"></span>
					</div>
				</div>
			</div>
			<div class="shopbottom">
				<table>
					<tr>
						<th>图片</th>
						<th>商品</th>
						<th>单价</th>
						<th>积分</th>
						<th>数量</th>
						<th>小计</th>
						<th>操作</th>
					</tr>
					<?php 
					$sql="select shop.*,shopping.num,shopping.id shopping_id from shop,shopping,user where shopping.shop_id=shop.id&&shopping.user_id=user.id&&user.username='{$_COOKIE['user']}'";
					$smt=$pdo->prepare($sql);
					$smt->execute();
					$rows=$smt->fetchAll();
					foreach ($rows as $row) {
						echo "<tr>
							<td><img src='/mySite/public/uploads/shop/th_{$row['img']}'></td>
							<td>{$row['name']}</td>
							<td>￥<span>{$row['currentPrice']}</span> 元</td>
							<td>{$row['award']} 分</td>
							<td>
								<div>
									<button class='left'>-</button>
									<input type='text' value='{$row['num']}' maxlength='2'>
									<button class='right'>+</button>
								</div>
							</td>
							<td>
								<p>￥<span>{$row['currentPrice']}</span> 元</p>
							</td>
							<td>
								<a href='javascript:' shopping_id='{$row['shopping_id']}'>删除</a>
							</td>
						</tr>";
					}
					 ?>
					
				</table>
				<div class="bottom">
					<a href="class.php" class="left">继续购物</a>
					<span>总计:￥<span></span> 元</span>
					<a href="settle.php" class="right">立即结算</a>
				</div>
			</div>
		</div>				
	</section>

	<!-- 底部 -->
	<?php include "public/common/footer.php" ?>
</body>
<script>
	$(document).ready(function(){
		//自动结算
		function count(){
			var sum=$(".shopbottom .bottom>span span");
			var arr=$(".shopbottom table td p span");
			var sumMoney=0;
			arr.each(function(i){
				sumMoney+=arr[i].innerHTML*1;
			});
			sum.html(sumMoney);
		};
		//点击减
		$(".shopbottom table td button.left").click(function(){
			var num=$(this).next().val();
			var money=$(this).parent().parent().prev().prev().find("span").html();
			if(num!=1){
				$(this).next().val(--num);
				$(this).parent().parent().next().find("span").html(money*num);
				count();
			}
		});

		//点击减
		$(".shopbottom table td button.right").click(function(){
			var num=$(this).prev().val();
			var money=$(this).parent().parent().prev().prev().find("span").html();
			if(num!=99){
				$(this).prev().val(++num);
				$(this).parent().parent().next().find("span").html(money*num);
				count();
			}else{
				alert("一次最多购买99个")
			}
		});

		//点击删除
		$(".shopbottom table td a").click(function(){
			var shopping_id=$(this).attr("shopping_id");
			var that=$(this);
			$.get("shopping/delete.php",{shopping_id:shopping_id},function(res){
				if(res){
					that.parent().parent().remove();
					count();
				}
			});
		});

		//手动修改自动结算
		$("table input").blur(function(){
			var val=$(this).val();
			var money=$(this).parent().parent().prev().prev().find("span").html();
			if(val.match(/\D/g)){
				$(this).val(1);
			}
			$(this).parent().parent().next().find("span").html(money*val);
			count();
		});
		//加载成执行失焦事件
		$("table input").blur();
	})
	
</script>
</html>