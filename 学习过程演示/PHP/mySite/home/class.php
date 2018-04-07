<?php 
session_start();
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品分类</title>
	<link rel="stylesheet" href="public/css/index.css">
	<link rel="stylesheet" href="public/css/class.css">
	<script src="../public/js/jquery.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include "public/common/header.php";?>
	<!-- 主体内容 -->
	<section>
		<div class="main">
			<div class="shopnav">
				<div class="nav1">
					<span>分类 ：</span>
					<a href="class.php<?php echo "?pricesection_id={$_GET['pricesection_id']}&&lclassify_id={$_GET['lclassify_id']}&&bclassify_id=0" ?>" <?php if(!$_GET['bclassify_id']) echo "class='active'"; ?> >不限</a>
					<?php 
					$order=$_GET['order']?$_GET['order']:'salesVolume';
					$sqlbclassify="select * from bclassify";
					$smtbclassify=$pdo->prepare($sqlbclassify);
					$smtbclassify->execute();
					$rowsbclassify=$smtbclassify->fetchAll();
					foreach ($rowsbclassify as $rowbclassify) {
						if($_GET['bclassify_id']==$rowbclassify['id']){
							echo "<a href='class.php?pricesection_id={$_GET['pricesection_id']}&&lclassify_id={$_GET['lclassify_id']}&&bclassify_id={$rowbclassify['id']}' class='active'>{$rowbclassify['name']}</a>";
						}else{
							echo "<a href='class.php?pricesection_id={$_GET['pricesection_id']}&&lclassify_id={$_GET['lclassify_id']}&&bclassify_id={$rowbclassify['id']}'>{$rowbclassify['name']}</a>";
						}
					}
					 ?>
				</div>

				<div class="nav2">
					<span>分类 ：</span>
					<a href="class.php<?php echo "?pricesection_id={$_GET['pricesection_id']}&&bclassify_id={$_GET['bclassify_id']}&&lclassify_id=0" ?>" <?php if(!$_GET['lclassify_id']) echo "class='active'"; ?> >不限</a>
					<?php 
					$sqllclassify="select * from lclassify group by name";
					$smtlclassify=$pdo->prepare($sqllclassify);
					$smtlclassify->execute();
					$rowslclassify=$smtlclassify->fetchAll();
					foreach ($rowslclassify as $rowlclassify) {
						if($_GET['lclassify_id']==$rowlclassify['name']){
							echo "<a href='class.php?pricesection_id={$_GET['pricesection_id']}&&bclassify_id={$_GET['bclassify_id']}&&lclassify_id={$rowlclassify['name']}' class='active'>{$rowlclassify['name']}</a>";
						}else{
							echo "<a href='class.php?pricesection_id={$_GET['pricesection_id']}&&bclassify_id={$_GET['bclassify_id']}&&lclassify_id={$rowlclassify['name']}'>{$rowlclassify['name']}</a>";
						}
					}
					 ?>
				</div>
				<div class="nav3">
					<span>价格 ：</span>
					<a href="class.php<?php echo "?bclassify_id={$_GET['bclassify_id']}&&lclassify_id={$_GET['lclassify_id']}&&pricesection_id=0" ?>" <?php if(!$_GET['pricesection_id']) echo "class='active'"; ?> >不限</a>
					<?php 
					$sqlpricesection="select * from pricesection";
					$smtpricesection=$pdo->prepare($sqlpricesection);
					$smtpricesection->execute();
					$rowspricesection=$smtpricesection->fetchAll();
					foreach ($rowspricesection as $rowpricesection) {
						if($_GET['pricesection_id']==$rowpricesection['id']){
							echo "<a href='class.php?bclassify_id={$_GET['bclassify_id']}&&lclassify_id={$_GET['lclassify_id']}&&pricesection_id={$rowpricesection['id']}' class='active'>{$rowpricesection['section']}</a>";
						}else{
							echo "<a href='class.php?bclassify_id={$_GET['bclassify_id']}&&lclassify_id={$_GET['lclassify_id']}&&pricesection_id={$rowpricesection['id']}'>{$rowpricesection['section']}</a>";
						}
					}
					 ?>
				</div>
				<div class="nav4">
					<a href="javascript:" order="salesVolume">销量 ↓</a>
					<a href="javascript:" order="currentPrice">价格 ↓</a>
					<a href="javascript:" order="integral">评价 ↓</a>
				</div>
				<script>
				$(document).ready(function(){
					var order=location.search.match(/salesVolume|currentPrice|integral/g);
					$(".shopnav .nav4 a").each(function(i){
						if($(".shopnav .nav4 a")[i].getAttribute('order')==order){
							$(".shopnav .nav4 a")[i].setAttribute("class","active");
						}
						if(!order){
							$(".shopnav .nav4 a").eq(0).addClass("active");
						}
					})
				})
				$(".shopnav .nav4 a").click(function(){
					var order=$(this).attr("order");
					var url=location.href;
					if(url.match(/order/g)){
						location.replace(url.replace(/salesVolume|currentPrice|integral/g,order));
					}else{
						location.replace(url+"&&order="+order);
					}
					
				});
				</script>
			</div>
			<ul class="classShop">
				<?php 
				if($_GET['val']){
					$sql="select * from keywords";
					$smt=$pdo->prepare($sql);
					$smt->execute();
					$rows=$smt->fetchAll();
					foreach ($rows as $row) {
						if($row['keyword']==$_GET['val']){
							//搜索次数加一
							$frequency=$row['frequency']+1;//原次数加一
							$sqlfrequency="update keywords set frequency={$frequency} where id={$row['id']}";
							$smtfrequency=$pdo->prepare($sqlfrequency);
							$smtfrequency->execute();

							$shop=$_GET['shop'];
							$sqlshopid="select shop_id from shopkeywords where keyword_id={$row['id']}";
							$smtshopid=$pdo->prepare($sqlshopid);
							$smtshopid->execute();
							$rowsshopid=$smtshopid->fetchAll();

							foreach ($rowsshopid as $rowshopid) {
								$sqlshop="select * from shop where id={$rowshopid['shop_id']} order by {$order} desc";
								$smtshop=$pdo->prepare($sqlshop);
								$smtshop->execute();
								$rowshop=$smtshop->fetch();
								echo "
										<li>
											<a href='detail.php?shop_id={$rowshop['id']}'>
												<img src='/mySite/public/uploads/shop/{$rowshop['img']}' width='418px' height='418px'>
												<p>{$rowshop['intro']}</p>
												<h3>￥{$rowshop['currentPrice']}</h3>
											</a>";
											if($_COOKIE['user']){
												echo "<a href='settle.php?shop_id={$rowshop['id']}' class='buy'>立即购买</a>
													</li>";
											}else{
												echo "<a href='logon.php' class='buy buys'>立即购买</a>
													</li>";
											}
							}
						}
					}
				}

				if($_GET['shop']){
					//获得原次数
					$sqlnum="select frequency from keywords where id={$_GET['shop']}";
					$smtnum=$pdo->prepare($sqlnum);
					$smtnum->execute();
					$rownum=$smtnum->fetch();
					//搜索次数加一
					$frequency=$rownum['frequency']+1;//原次数加一
					$sqlfrequency="update keywords set frequency={$frequency} where id={$_GET['shop']}";
					$smtfrequency=$pdo->prepare($sqlfrequency);
					$smtfrequency->execute();

					$sqlshopid="select shop_id from shopkeywords where keyword_id={$_GET['shop']}";
					$smtshopid=$pdo->prepare($sqlshopid);
					$smtshopid->execute();
					$rowsshopid=$smtshopid->fetchAll();

					foreach ($rowsshopid as $rowshopid) {
						$sqlshop="select * from shop where id={$rowshopid['shop_id']} order by {$order} desc";
						$smtshop=$pdo->prepare($sqlshop);
						$smtshop->execute();
						$rowshop=$smtshop->fetch();
						echo "
						<li>
							<a href='detail.php?shop_id={$rowshop['id']}'>
								<img src='/mySite/public/uploads/shop/{$rowshop['img']}' width='418px' height='418px'>
								<p>{$rowshop['intro']}</p>
								<h3>￥{$rowshop['currentPrice']}</h3>
							</a>";
							if($_COOKIE['user']){
								echo "<a href='settle.php?shop_id={$rowshop['id']}' class='buy'>立即购买</a>
									</li>";
							}else{
								echo "<a href='logon.php' class='buy buys'>立即购买</a>
									</li>";
							}
					}
				}	

				if($_GET['bclassify_id']||$_GET['lclassify_id']||$_GET['pricesection_id']){
					if($_GET['bclassify_id']&&$_GET['lclassify_id']&&$_GET['pricesection_id']){
						$sqlshopid="select shop.* from shop,bclassify,lclassify,pricesection where shop.lclassify_id=lclassify.id&&shop.pricesection_id=pricesection.id&&lclassify.bclassify_id=bclassify.id&&bclassify.id={$_GET['bclassify_id']}&&lclassify.name='{$_GET['lclassify_id']}'&&pricesection.id={$_GET['pricesection_id']} order by {$order} desc";
					}else if($_GET['bclassify_id']&&!$_GET['lclassify_id']&&!$_GET['pricesection_id']){
						$sqlshopid="select shop.* from shop,bclassify,lclassify where shop.lclassify_id=lclassify.id&&lclassify.bclassify_id=bclassify.id&&bclassify.id={$_GET['bclassify_id']} order by {$order} desc";
					}else if(!$_GET['bclassify_id']&&$_GET['lclassify_id']&&!$_GET['pricesection_id']){
						$sqlshopid="select shop.* from shop,bclassify,lclassify where shop.lclassify_id=lclassify.id&&lclassify.bclassify_id=bclassify.id&&lclassify.name='{$_GET['lclassify_id']}' order by {$order} desc";
					}else if(!$_GET['bclassify_id']&&!$_GET['lclassify_id']&&$_GET['pricesection_id']){
						$sqlshopid="select shop.* from shop,pricesection where shop.pricesection_id=pricesection.id&&pricesection.id={$_GET['pricesection_id']} order by {$order} desc";
					}else if($_GET['bclassify_id']&&$_GET['lclassify_id']&&!$_GET['pricesection_id']){
						$sqlshopid="select shop.* from shop,bclassify,lclassify where shop.lclassify_id=lclassify.id&&lclassify.bclassify_id=bclassify.id&&bclassify.id={$_GET['bclassify_id']}&&lclassify.name='{$_GET['lclassify_id']}' order by {$order} desc";
					}else if($_GET['bclassify_id']&&!$_GET['lclassify_id']&&$_GET['pricesection_id']){
						$sqlshopid="select shop.* from shop,bclassify,lclassify,pricesection where shop.lclassify_id=lclassify.id&&shop.pricesection_id=pricesection.id&&lclassify.bclassify_id=bclassify.id&&bclassify.id={$_GET['bclassify_id']}&&pricesection.id={$_GET['pricesection_id']} order by {$order} desc";
					}else if(!$_GET['bclassify_id']&&$_GET['lclassify_id']&&$_GET['pricesection_id']){
						$sqlshopid="select shop.* from shop,bclassify,lclassify,pricesection where shop.lclassify_id=lclassify.id&&shop.pricesection_id=pricesection.id&&lclassify.bclassify_id=bclassify.id&&lclassify.name='{$_GET['lclassify_id']}'&&pricesection.id={$_GET['pricesection_id']} order by {$order} desc";
					}
					$smtshopid=$pdo->prepare($sqlshopid);
					$smtshopid->execute();
					$rowsshopid=$smtshopid->fetchAll();
					foreach ($rowsshopid as $rowshopid) {
						echo "
						<li>
							<a href='detail.php?shop_id={$rowshopid['id']}'>
								<img src='/mySite/public/uploads/shop/{$rowshopid['img']}' width='418px' height='418px'>
								<p>{$rowshopid['intro']}</p>
								<h3>￥{$rowshopid['currentPrice']}</h3>
							</a>";
							if($_COOKIE['user']){
								echo "<a href='settle.php?shop_id={$rowshop['id']}' class='buy'>立即购买</a>
									</li>";
							}else{
								echo "<a href='logon.php' class='buy buys'>立即购买</a>
									</li>";
							}
					}
				}else if(!$_GET['shop']&&!$_GET['val']){
					$sqlshopid="select * from shop order by {$order} desc";
					$smtshopid=$pdo->prepare($sqlshopid);
					$smtshopid->execute();
					$rowsshopid=$smtshopid->fetchAll();
					foreach ($rowsshopid as $rowshopid) {
						echo "
						<li>
							<a href='detail.php?shop_id={$rowshopid['id']}'>
								<img src='/mySite/public/uploads/shop/{$rowshopid['img']}' width='418px' height='418px'>
								<p>{$rowshopid['intro']}</p>
								<h3>￥{$rowshopid['currentPrice']}</h3>
							</a>";
							if($_COOKIE['user']){
								echo "<a href='settle.php?shop_id={$rowshop['id']}' class='buy'>立即购买</a>
									</li>";
							}else{
								echo "<a href='logon.php' class='buy buys'>立即购买</a>
									</li>";
							}
					}
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
	$(".buys").click(function(){
		var url=location.href;
		$.get("url.php",{url:url},function(res){
			if(!res){
				return false;
			}
		});
	});
</script>
</html>