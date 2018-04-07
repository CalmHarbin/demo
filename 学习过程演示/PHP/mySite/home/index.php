<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>衣家</title>
	<link rel="stylesheet" href="public/css/index.css">
	<link rel="stylesheet" href="public/css/home.css">
	<script src="../public/js/jquery.js"></script>
	<script src="public/js/carousel.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include "public/common/header.php";?>
	<!-- 主体内容 -->
	<section>
		<div class="carousel">
			<ul>
				<?php 
					$sqlcarousel="select * from carousel where isshow=1";
					$smtcarousel=$pdo->prepare($sqlcarousel);
					$smtcarousel->execute();
					$rowscarousel=$smtcarousel->fetchAll();
					foreach ($rowscarousel as $rowcarousel) {
						echo "<li><a href='detail?shop_id={$rowcarousel['shop_id']}'><img src='/mySite/public/uploads/carousel/{$rowcarousel['img']}' alt=''></a></li>";
					}
				 ?>
			</ul>
		</div>
		<div class="main">
			<div class="message">
				<div class="col1">
					<?php 
						$sqladvertising="select * from advertising where place=1&&isshow=1";
						$smtadvertising=$pdo->prepare($sqladvertising);
						$smtadvertising->execute();
						$rowadvertising=$smtadvertising->fetch();
						echo "<a href='{$rowadvertising['url']}'><img src='/mySite/public/uploads/advertising/{$rowadvertising['img']}'></a>";
					 ?>
				</div>
				<div class="col2">
					<?php 
						$sqladvertising="select * from advertising where place=2&&isshow=1";
						$smtadvertising=$pdo->prepare($sqladvertising);
						$smtadvertising->execute();
						$rowadvertising=$smtadvertising->fetch();
						echo "<a href='{$rowadvertising['url']}'><img src='/mySite/public/uploads/advertising/{$rowadvertising['img']}'></a>";
					 ?>
					 <?php 
						$sqladvertising="select * from advertising where place=3&&isshow=1";
						$smtadvertising=$pdo->prepare($sqladvertising);
						$smtadvertising->execute();
						$rowadvertising=$smtadvertising->fetch();
						echo "<a href='{$rowadvertising['url']}'><img src='/mySite/public/uploads/advertising/{$rowadvertising['img']}'></a>";
					 ?>
				</div>
				<div class="col3">
					<?php 
						$sqladvertising="select * from advertising where place=4&&isshow=1";
						$smtadvertising=$pdo->prepare($sqladvertising);
						$smtadvertising->execute();
						$rowadvertising=$smtadvertising->fetch();
						echo "<a href='{$rowadvertising['url']}'><img src='/mySite/public/uploads/advertising/{$rowadvertising['img']}'></a>";
					 ?>
					 <?php 
						$sqladvertising="select * from advertising where place=5&&isshow=1";
						$smtadvertising=$pdo->prepare($sqladvertising);
						$smtadvertising->execute();
						$rowadvertising=$smtadvertising->fetch();
						echo "<a href='{$rowadvertising['url']}'><img src='/mySite/public/uploads/advertising/{$rowadvertising['img']}'></a>";
					 ?>
				</div>
				<div class="col4">
					<?php 
						$sqladvertising="select * from advertising where place=6&&isshow=1";
						$smtadvertising=$pdo->prepare($sqladvertising);
						$smtadvertising->execute();
						$rowadvertising=$smtadvertising->fetch();
						echo "<a href='{$rowadvertising['url']}'><img src='/mySite/public/uploads/advertising/{$rowadvertising['img']}'></a>";
					 ?>
					 <?php 
						$sqladvertising="select * from advertising where place=7&&isshow=1";
						$smtadvertising=$pdo->prepare($sqladvertising);
						$smtadvertising->execute();
						$rowadvertising=$smtadvertising->fetch();
						echo "<a href='{$rowadvertising['url']}'><img src='/mySite/public/uploads/advertising/{$rowadvertising['img']}'></a>";
					 ?>
				</div>
			</div>
			<div class="clear"></div>
			<div class="floor">
				<ul>
					<?php 
					$sqlbclassify="select * from bclassify";
					$smtbclassify=$pdo->prepare($sqlbclassify);
					$smtbclassify->execute();
					$rowsbclassify=$smtbclassify->fetchAll();
					$floor=0;
					foreach ($rowsbclassify as $rowbclassify) {
						$floor++;
						echo "<li>
								<div class='top'>
									<div class='left'>
										<em>{$floor}F</em>
										<a href='javascript:' class='title'>{$rowbclassify['name']}</a>
										<span>热销{$rowbclassify['name']}</span>
									</div>
									<div class='right'>
										<span></span>
										<a href='class.php?bclassify_id={$rowbclassify['id']}'>查看更多</a>
										<span></span>
									</div>
								</div>
								<div class='bottom'>
									<div class='left'>
										<ul>
											<li class='one'>本周热销 TOP</li>
											";
						$sqltop="select shop.* from shop,bclassify,lclassify where shop.lclassify_id=lclassify.id&&lclassify.bclassify_id=bclassify.id&&bclassify.id={$rowbclassify['id']} order by salesVolume desc limit 0,3";
						$smttop=$pdo->prepare($sqltop);
						$smttop->execute();
						$rowstop=$smttop->fetchAll();
						foreach ($rowstop as $rowtop) {
							echo "<li><a href='detail.php?shop_id={$rowtop['id']}'><span class='bymbol'>¥{$rowtop['currentPrice']}</span>
											<span class='content'>{$rowtop['name']}</span></a>
									</li>";
						}
						echo "</ul>
							</div>
							<div class='right'>
								<ul>";

						$sqlrand="select shop.* from shop,bclassify,lclassify where shop.lclassify_id=lclassify.id&&lclassify.bclassify_id=bclassify.id&&bclassify.id={$rowbclassify['id']} order by rand() limit 0,6";
						$smtrand=$pdo->prepare($sqlrand);
						$smtrand->execute();
						$rowsrand=$smtrand->fetchAll();
						foreach ($rowsrand as $rowrand) {
							echo "<a href='detail.php?shop_id={$rowrand['id']}'>
										<li>
											<div class='shopimg'><img src='/mySite/public/uploads/shop/{$rowrand['img']}' alt=''></div>
											<h6>{$rowrand['name']}</h6>
											<p>
												<em class='price1'>¥{$rowrand['currentPrice']}</em>
												<em class='price2'>¥{$rowrand['originalPrice']}</em>
											</p>
										</li>
									</a>";
						}

						echo "</ul>
								<div class='publicity'>
									<a href=''>
										<img src='public/images/publicity1.png' alt='' width='191px' height='465px'>
									</a>
								</div>
							</div>
						</div>
					</li>";
					}
					 ?>
				</ul>
			</div>
		</div>
	</section>
	<div class="clear"></div>
	<!-- 底部 -->
	<?php include "public/common/footer.php" ?>
</body>
<script>
		carousel("carousel",5000,"rgb(0,255,255)",false);
</script>
</html>