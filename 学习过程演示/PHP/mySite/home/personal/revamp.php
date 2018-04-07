<?php 
if(!$_COOKIE['user']){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
include "../../public/common/config.php";
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人中心</title>
	<link rel="stylesheet" href="../public/css/index.css">
	<script src="../../public/js/jquery.js"></script>
	<style>
	.main>.left{
		float: left;
		width: 190px;
	}
	.main>.right{
		float: left;
		width: 836px;
		padding: 20px 30px;
	}
	.main>.left li{
		height: 42px;
		text-align: center;
		line-height: 42px;
		background-color: #eee;
		border-bottom: 2px solid white;
	}
	.main>.left li.active{
		background-color: #50edca;
	}
	.main>.left li a{
		color: #333;
	}
	.main>.left li a:hover{
		color: #C9062C;
    	text-decoration: underline;
	}
	.main>.right ul{
		position: relative;
		height: 500px;
	}
	.main>.right ul li{
		position: absolute;
		display: none;
		width: 100%;
	}
	.main>.right ul li.active{
		display: block;
	}
	.main>.right ul li div{
		height: 50px;
		line-height: 50px;
	}
	.main>.right ul li label{
		display: inline-block;
		width: 150px;
		text-align: right;
		padding-right: 15px;
	}
	.main>.right ul li input[type=text]{
		width: 300px;
	}
	.main>.right ul li input[type=submit]{
		margin-left: 270px;
	}
	.main>.right ul li input[type=radio]{
		margin-left: 170px;
	}
	</style>
</head>
<body>
	<!-- 头部 -->
<header>
	<div class="headerTop">
		<div class="main">
			<div class="headerTopLeft">
				<i></i>
				<a href="" class="headerCollect">收藏本站</a>
				<a href="../login.php">注册会员</a>
			</div>
			<div class="headerTopRight">
				<span class="greet">欢迎光临美食网官方网站!</span>
				<?php 
				if($_COOKIE['user']){
					echo "<a href='../personal.php' class='logon'>{$_COOKIE['user']}</a>";
				}else{
					echo "<a href='../logon.php' class='logon'>[登录]</a>";
				}
				 ?>
				<a href="../personal.php" class="mine">我的账户</a>
				<a href="../personal.php?per=1" class="mine">我的订单</a>
				<div>
					<a href="">帮助中心<span class="caret"></span></a>
					<ul>
						<li><a href="">新手上路</a></li>
						<li><a href="">购物指南</a></li>
						<li><a href="">支付配送</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="headerBottom">
		<div class="main">
			<a href="../index.php">
				<img src="/mySite/home/public/img/logo.jpg" alt="" width="200px" height="59px" class="logo">
			</a>
			<div class="middle">
				<div class="seek">
					<input type="text">
					<a href="javascript:">搜索</a>
				</div>
				<script>
					$(".headerBottom .middle .seek a").click(function(){
						var val=$(this).prev().val();
							location.href="../class.php?val="+val+"";
					});
				</script>
				<span class="hot">热门搜索&nbsp;&nbsp;:</span>
				<ul>
					<?php 
						$sql="select * from keywords order by frequency desc limit 0,6";
						$smt=$pdo->prepare($sql);
						$smt->execute();
						$rows=$smt->fetchAll();
						foreach ($rows as $row) {
							echo "<li><a href='class.php?shop={$row['id']}'>{$row['keyword']}</a></li>";	
						}
					 ?>
				</ul>
				
			</div>
			<a href="../shop.php" class="close">
				<i></i>
				<span class="settle">去购物车结算<span class="Rcaret"></span></span>
			</a>
		</div>
	</div>
</header>
<!-- 导航栏 -->
<nav>
	<div class="main">
		<div class="all">
			<a href="javascript:">全部商品分类</a>
			<span class="caret"></span>
			<ul>
				<?php 
				$sqlbclassify="select * from bclassify";
				$smtbclassify=$pdo->prepare($sqlbclassify);
				$smtbclassify->execute();
				$rowsbclassify=$smtbclassify->fetchAll();
				foreach ($rowsbclassify as $rowbclassify) {
					echo "<li class='item'>
					<div class='left'>
						<h4><a href='../class.php?bclassify_id={$rowbclassify['id']}'>{$rowbclassify['name']}</a></h4><p>";
					$sqllclassify="select * from lclassify where bclassify_id={$rowbclassify['id']} limit 0,5";
					$smtlclassify=$pdo->prepare($sqllclassify);
					$smtlclassify->execute();
					$rowslclassify=$smtlclassify->fetchAll();
					foreach ($rowslclassify as $rowlclassify) {
						echo "<a href='../class.php?lclassify_id={$rowlclassify['name']}'>{$rowlclassify['name']}</a>";
					}
					echo "</p>
						<i class='haircut'></i>
						<div class='right'>
							<ul>";
					$sqllclassify="select * from lclassify where bclassify_id={$rowbclassify['id']}";
					$smtlclassify=$pdo->prepare($sqllclassify);
					$smtlclassify->execute();
					$rowslclassify=$smtlclassify->fetchAll();
					foreach ($rowslclassify as $rowlclassify) {
						echo "<li><a href='../class.php?lclassify_id={$rowlclassify['id']}'>{$rowlclassify['name']}</a></li>";
					}
					echo "</ul>
						</div>
					</div>
				</li>";
				}
				?>		
			</ul>
		</div>
		<ul class="nav">
			<?php 
				$sqlnav="select * from nav";
				$smtnav=$pdo->prepare($sqlnav);
				$smtnav->execute();
				$rowsnav=$smtnav->fetchAll();
				foreach ($rowsnav as $rownav) {
					echo "<li><a href='{$rownav['url']}'>{$rownav['content']}</a></li>";
				}
			 ?>
		</ul>
	</div>
</nav>
	<!-- 主体内容 -->
	<section>
		<div class="main">
			<div class="left">
				<ul>
					<li>
						<a href="../personal.php?page=1">我的资料</a>
					</li>
					<li>
						<a href="../personal.php?page=2">我的订单</a>
					</li>
					<li>
						<a href="../personal.php?page=3">我的收藏</a>
					</li>
					<li>
						<a href="../personal.php?page=4">我的评论</a>
					</li>
					<li class="active">
						<a href="../personal.php?page=5">我的收获地址</a>
					</li>
					<li>
						<a href="../personal.php?page=6">修改密码</a>
					</li>
					<li>
						<a href="exit.php">退出登录</a>
					</li>
				</ul>
			</div>
			<div class="right">
				<ul>
					<li class="active address">
							<?php 
							$sqladdress="select * from address where id={$_GET['address_id']}";
							$smtaddress=$pdo->prepare($sqladdress);
							$smtaddress->execute();
							$rowaddress=$smtaddress->fetch();
							 ?>
							 <form action="updateaddress.php" method="post">
							 	<div class="form-group">
							 		<label>收件人</label>
							 		<input type="text" name="name" value="<?php echo $rowaddress['name'] ?>">
							 	</div>
							 	<div class="form-group">
							 		<label>联系电话</label>
							 		<input type="text" name="phone" id="phone" value="<?php echo $rowaddress['phone'] ?>">
							 	</div>
							 	<div class="form-group">
							 		<label>收货地址</label>
							 		<input type="text" name="address" value="<?php echo $rowaddress['address'] ?>">
							 	</div>
							 	<div class="form-group">
							 		<input type="radio" name="isdefault" value="1" <?php if($rowaddress['isdefault'])echo "checked"; ?>>设为默认地址
							 		<input type="radio" name="isdefault" value="0" <?php if(!$rowaddress['isdefault'])echo "checked"; ?>>不是默认地址
							 	</div>
							 	<input type="hidden" name="id" value="<?php echo $rowaddress['id'] ?>">
							 	<input type="submit" value="确认修改" id="submit">
							 	<input type="button" value="返回" id="button">
							 </form>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<div class="clear"></div>
	<!-- 底部 -->
	<?php include "../public/common/footer.php" ?>
</body>
<script>
	$("#button").click(function(){
		history.back();
	})
	$("#submit").click(function(){
		var phone=$("#phone").val();
		if(!phone.match(/^1\d{10}$/g)){
			alert("手机号码格式不正确")
			return false;
		}
	});
</script>
</html>