<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>积分兑换</title>
	<link rel="stylesheet" href="public/css/index.css">
	<link rel="stylesheet" href="public/css/class.css">
	<script src="../public/js/jquery.js"></script>
	<style>
		.shopnav{
			height:44px;
		}
	</style>
</head>
<body>
	<!-- 头部 -->
	<?php include "public/common/header.php";?>
	<!-- 主体内容 -->
	<section>
		<div class="main">
			<div class="shopnav">
				<div class="nav4">
					<a href="" class="active">销量 ↓</a>
					<a href="">价格 ↓</a>
					<a href="">评价 ↓</a>
					<a href="">上架时间 ↓</a>
				</div>
			</div>
			<ul class="classShop">
				<li>
					<a href="">
						<img src="public/images/classshop1.jpg" alt="" width="" height="418px" height="418px">
						<p>途美（Tourmate） 途美 车载空气净化器 太阳能汽车内净化器除甲醛异味 车用香薰 爵士黑</p>
						<h3>所需积分:1938</h3>
					</a>
					<a href="" class="buy">立即兑换</a>
				</li>
				<?php 

					for($i=0;$i<13;$i++){
						echo "
						<li>
						<a href=''>
							<img src='public/images/classshop1.jpg' alt='' width='' height='418px' height='418px'>
							<p>途美（Tourmate） 途美 车载空气净化器 太阳能汽车内净化器除甲醛异味 车用香薰 爵士黑</p>
							<h3>所需积分:1938</h3>
						</a>
						<a href='' class='buy'>立即兑换</a>
					</li>

					";
				}
				 ?>
			</ul>
		</div>
	</section>

	<!-- 底部 -->
	<?php include "public/common/footer.php" ?>
</body>
<script>
	$(".classShop li").mouseenter(function(event){
			$(this).find("img").stop();
			$(this).find("a.buy").stop();
			$(this).find("a.buy").css({"display":"block"});
			$(this).find("img").animate({"top":"-10px"},300);
			$(this).find("a.buy").animate({"margin-top":"0px"},300);
	});

	$(".classShop li").mouseleave(function(){
			$(this).find("img").stop();
			$(this).find("a.buy").stop();
			$(this).find("img").animate({"top":"0px"},300);
			$(this).find("a.buy").animate({"margin-top":"48px"},300,function(){
				$(this).css({"display":"none"});
		});
	});
</script>
</html>