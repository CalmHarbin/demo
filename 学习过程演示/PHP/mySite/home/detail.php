<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品详情</title>
	<link rel="stylesheet" href="public/css/index.css">
	<link rel="stylesheet" href="public/css/detail.css">
	<script src="../public/js/jquery.js"></script>
	<script src="public/js/zoom.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include "public/common/header.php";?>
	<!-- 主体内容 -->
	<section>
		<?php 
		$sqlshop="select shop.*,lclassify.name lname from shop,lclassify where shop.lclassify_id=lclassify.id&&shop.id={$_GET['shop_id']}";
		$smtshop=$pdo->prepare($sqlshop);
		$smtshop->execute();
		$rowshop=$smtshop->fetch();
		 ?>
		<div class="main">
			<div class="detailnav">
				<a href="index.php">首页</a>
				<span>&raquo;</span>
				<a href="class.php?lclassify_id=<?php echo $rowshop['lname']; ?>"><?php echo $rowshop['lname']; ?></a>
				<span>&raquo;</span>
				<span><?php echo $rowshop['name'] ?></span>
			</div>
			<div class="brief">
				<div class="briefLeft">
					<div class="top" id="zoom">
						<img src="/mySite/public/uploads/shop/<?php echo $rowshop['img'] ?>" class="old">
					</div>
					<div class="bottom">
						<button class="left">&lt;</button>
						<ul>
							<li class="active"><img src="/mySite/public/uploads/shop/<?php echo $rowshop['img'] ?>"></li>
							<?php 
							$sqlimg="select shopimg.* from shop,shopimg where shopimg.shop_id=shop.id&&shop.id={$_GET['shop_id']}";
							$smtimg=$pdo->prepare($sqlimg);
							$smtimg->execute();
							$rowsimg=$smtimg->fetchAll();
							foreach ($rowsimg as $rowimg) {
								echo "<li><img src='/mySite/public/uploads/shop/{$rowimg['img']}'></li>";
							}
							 ?>
						</ul>
						<button class="right">&gt;</button>
					</div>
				</div>
				<div class="briefRight">
					<h3><?php echo $rowshop['name'] ?></h3>
					<p><?php echo $rowshop['intro'] ?></p>
					<div class="price">
						<p>价格 : <span>￥<?php echo $rowshop['currentPrice'] ?></span></p>
						<p>库存 : <?php echo $rowshop['repertory'] ?></p>
						<p>销量 : <?php echo $rowshop['salesVolume'] ?></p>
					</div>
					<div class="num">
						<span>购买数量 : </span>
						<div>
							<button class="left">-</button>
							<input type="text" value="1" maxlength="2">
							<button class="right">+</button>
						</div>
					</div>
					<?php 
					if($_COOKIE['user']){
						echo "<a href='javascript:' id='byshop'><img src='public/img/p-btns_13.png' alt=''></a>";
						echo "<a href='javascript:' id='addshop'><img src='public/img/p-btns_09.png' alt=''></a>";
					}else{
						echo "<a href='logon.php' class='logon'><img src='public/img/p-btns_13.png' alt=''></a>";
						echo "<a href='logon.php' class='logon'><img src='public/img/p-btns_09.png' alt=''></a>";
					}
					 ?>
					<script>
					$(".logon").click(function(){
						var url=location.href;
						$.get("url.php",{url:url},function(res){
							if(!res){
								return false;
							}
						});
					});
					$("#byshop").click(function(){
						var num=$(".briefRight input").val();
						location.assign("settle.php?shop_id=<?php echo $rowshop['id'] ?>&&num="+num);
					});
					$("#addshop").click(function(){
						var num=$(".briefRight input").val();
						$.get("shopcar/add.php",{shop_id:<?php echo $rowshop['id'] ?>,num:num},function(res){
							if(res){
								alert("添加成功!");
							}
						});
					});
					</script>
				</div>
			</div>
			<div class="message">
				<div class="left">
					<ul>
						<li class="active">
							<span class="title">商品详情</span>
						</li>
						<?php
							$sqlevaluate="select evaluate.*,datum.img,user.username from evaluate,shop,user,datum where evaluate.shop_id=shop.id&&evaluate.user_id=user.id&&datum.user_id=user.id&&shop.id={$_GET['shop_id']}";
							$smtevaluate=$pdo->prepare($sqlevaluate);
							$smtevaluate->execute();
							$rowsevaluate=$smtevaluate->fetchAll();
							$a=0;$b=0;$c=0;$d=0;$e=0;$num=0;
							foreach ($rowsevaluate as $rowevaluate) {
								if($rowevaluate['grade']==1){
									$a++;
								}else if($$rowevaluate['grade']==2){
									$b++;
								}else if($rowevaluate['grade']==3){
									$c++;
								}else if($rowevaluate['grade']==4){
									$d++;
								}else if($rowevaluate['grade']==5){
									$e++;
								}
								$num++;
							}
							 ?>
						<li>
							<span class="title">商品评论(<?php echo $num ?>)</span>
						</li>
					</ul>
					<ol>
						<li class="active one">
							<?php 
							foreach ($rowsimg as $rowimg) {
								echo "<img src='/mySite/public/uploads/shop/{$rowimg['info']}' max-width='900px'>";
							}
							 ?>
						</li>
						<li class="two">
							
							<div class="top">
								<span>大家评价:</span>
								<div>
									<a href="">5分(<?php echo $e ?>)</a>
									<a href="">4分(<?php echo $d ?>)</a>
									<a href="">3分(<?php echo $c ?>)</a>
									<a href="">2分(<?php echo $b ?>)</a>
									<a href="">1分(<?php echo $a ?>)</a>
								</div>
							</div>
							<div class="bottom">
								<div class="header">
									<i></i>
									<span>评价(共<span class="num"><?php echo $num ?></span>记录)</span>
								</div>
								<ul>
									<?php 
									foreach ($rowsevaluate as $rowevaluate) {
										echo "<li>
										<img src='/mySite/public/uploads/datum/th_{$rowevaluate['img']}' alt=''>
										<i></i>
										<div class='box'>
											<p class='one'>{$rowevaluate['username']} <img src='public/images/{$rowevaluate['grade']}.png'><span>{$rowevaluate['time']}</span></p>
											<p class='two'>{$rowevaluate['content']}</p>
										</div>
									</li>";
									}
									 ?>
								</ul>
								<div class="flooter">
									<span>共 <?php echo ceil($num/20) ?>页</span>
									<a href="javascript:" class="prev">上一页</a>
									<a href="javascript:" class="next">下一页</a>
									<div>
										第<input type="text" value="1">页
										<a href="javascript:">go</a>
									</div>
								</div>
							</div>
						</li>
					</ol>
				</div>
				<div class="right">
					<img src="public/img/0303.png" alt="">
					<ul>
						<?php 
						$sqltop="select shop.* from shop,lclassify where shop.lclassify_id=lclassify.id&&lclassify.id={$rowshop['lclassify_id']} order by salesVolume desc limit 0,5";
						$smttop=$pdo->prepare($sqltop);
						$smttop->execute();
						$rowstop=$smttop->fetchAll();
						foreach ($rowstop as $rowtop) {
							echo "<li>
									<a href='detail.php?shop_id={$rowtop['id']}'>
										<img src='/mySite/public/uploads/shop/{$rowtop['img']}' alt=''>
										<p>{$rowtop['name']}</p>
										<span>￥{$rowtop['currentPrice']}</span>
									</a>
								</li>";
						}
						 ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<div class="clear"></div>
	<!-- 底部 -->
	<?php include "public/common/footer.php" ?>
</body>
<script>
	var input=$(".briefRight .num input");
	var val=input.val();
	//失焦,重新给val赋值
	input.blur(function(){
		var input=$(".briefRight .num input");
		val=input.val();
	})
	//点击减
	$(".briefRight .num button.left").click(function(){
		if(val!=1){
			input.val(--val);
		}
	});
	//点击减
	$(".briefRight .num button.right").click(function(){
		if(val!=99){
			input.val(++val);
		}else{
			alert("一次最多购买99个")
		}
	});

	//向左
	var i=0;
	$(".briefLeft .bottom .left").click(function(){
		//防止连击错误
		$(this).attr({"disabled":"disabled"});
		setTimeout('$(".briefLeft .bottom .left").removeAttr("disabled")',300);

		var ul=$(".briefLeft .bottom ul");
		left=ul.position().left;
		if(-left>0){
			i--;
			ul.animate({"left":left+76+"px"},300,function(){
				var src=ul.find(".active").prev().children("img").attr("src");
				ul.find(".active").prev().addClass("active").siblings().removeClass("active");
				$(".briefLeft .old").attr({"src":src});
			});
		}
	});
	//向右
	$(".briefLeft .bottom .right").click(function(){
		$(this).attr({"disabled":"disabled"});
		setTimeout('$(".briefLeft .bottom .right").removeAttr("disabled")',300);
		var ul=$(".briefLeft .bottom ul");
		left=ul.position().left;
		distance=ul.children().last().position().left+15-i*76;
		if(distance>319){
			i++;
			ul.animate({"left":left-76+"px"},300,function(){
				var src=ul.find(".active").next().children("img").attr("src");
				ul.find(".active").next().addClass("active").siblings().removeClass("active");
				$(".briefLeft .old").attr({"src":src});
			})
		}
	});
	//鼠标移入切换
	$(".briefLeft .bottom li").mouseenter(function(){
		var src=$(this).children("img").attr("src");
		$(this).addClass("active").siblings().removeClass("active");
		$(".briefLeft .old").attr({"src":src});
		$(".briefLeft .new").attr({"src":src});
	});

	//评论区
	$(".message .left>ul>li").click(function(){
		var idx=$(".message .left>ul>li").index($(this));
		$(this).addClass("active").siblings().removeClass("active");
		$(".message .left>ol>li").eq(idx).addClass("active").siblings().removeClass("active");
	});
	zoom("zoom",3);
</script>
</html>