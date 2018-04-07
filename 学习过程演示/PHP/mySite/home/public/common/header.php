<?php 
include "../public/common/config.php";
 ?>
<header>
	<div class="headerTop">
		<div class="main">
			<div class="headerTopLeft">
				<i></i>
				<a href="" class="headerCollect">收藏本站</a>
				<a href="login.php">注册会员</a>
			</div>
			<div class="headerTopRight">
				<span class="greet">欢迎光临美食网官方网站!</span>
				<?php 
				if($_COOKIE['user']){
					echo "<a href='personal.php' class='logon'>{$_COOKIE['user']}</a>";
				}else{
					echo "<a href='logon.php' class='logon'>[登录]</a>";
				}
				 ?>
				<a href="personal.php" class="mine">我的账户</a>
				<a href="personal.php?per=1" class="mine">我的订单</a>
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
			<a href="index.php">
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
							location.href="class.php?val="+val+"";
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
			<a href="shop.php" class="close">
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
			<a href="">全部商品分类</a>
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
						<h4><a href='class.php?bclassify_id={$rowbclassify['id']}'>{$rowbclassify['name']}</a></h4><p>";
					$sqllclassify="select * from lclassify where bclassify_id={$rowbclassify['id']} limit 0,5";
					$smtlclassify=$pdo->prepare($sqllclassify);
					$smtlclassify->execute();
					$rowslclassify=$smtlclassify->fetchAll();
					foreach ($rowslclassify as $rowlclassify) {
						echo "<a href='class.php?lclassify_id={$rowlclassify['name']}'>{$rowlclassify['name']}</a>";
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
						echo "<li><a href='class.php?lclassify_id={$rowlclassify['id']}'>{$rowlclassify['name']}</a></li>";
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