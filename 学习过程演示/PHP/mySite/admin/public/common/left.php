<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='logon.php'</script>";
	exit;
}
 ?>
<div class="col-md-2">
	<div class="panel-group" id="accordion">
		<!-- 会员管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel1" data-toggle="collapse" data-parent="#accordion">会员管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel1">
				<ul class="list-group">
				  <li class="list-group-item"><a href="user/select.php" target="right">会员查看</a></li>
				  <li class="list-group-item"><a href="user/add.php" target="right">会员添加</a></li>
				</ul>
			</div>
		</div>
		
		<!-- 关键字管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel3" data-toggle="collapse" data-parent="#accordion">关键字管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel3">
				<ul class="list-group">
				  <li class="list-group-item"><a href="keywords/select.php" target="right">关键字查看</a></li>
				  <li class="list-group-item"><a href="keywords/add.php" target="right">关键字添加</a></li>
				</ul>
			</div>
		</div>
		
		<!-- 商品管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel5" data-toggle="collapse" data-parent="#accordion">商品管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel5">
				<ul class="list-group">
				  <li class="list-group-item"><a href="shop/select.php" target="right">商品查看</a></li>
				  <li class="list-group-item"><a href="shop/add.php" target="right">商品添加</a></li>
				</ul>
			</div>
		</div>
		<!-- 积分商品管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel11" data-toggle="collapse" data-parent="#accordion">积分商品管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel11">
				<ul class="list-group">
				  <li class="list-group-item"><a href="awardshop/select.php" target="right">积分商品查看</a></li>
				  <li class="list-group-item"><a href="awardshop/add.php" target="right">积分商品添加</a></li>
				</ul>
			</div>
		</div>
		<!-- 订单管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel10" data-toggle="collapse" data-parent="#accordion">订单管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel10">
				<ul class="list-group">
				  <li class="list-group-item"><a href="indent/select.php" target="right">订单查看</a></li>
				</ul>
			</div>
		</div>
		<!-- 导航栏管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel6" data-toggle="collapse" data-parent="#accordion">导航栏管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel6">
				<ul class="list-group">
				  <li class="list-group-item"><a href="nav/select.php" target="right">导航栏查看</a></li>
				  <li class="list-group-item"><a href="nav/add.php" target="right">导航栏添加</a></li>
				</ul>
			</div>
		</div>
		<!-- 大分类管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel7" data-toggle="collapse" data-parent="#accordion">大分类管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel7">
				<ul class="list-group">
				  <li class="list-group-item"><a href="bclassify/select.php" target="right">大分类查看</a></li>
				  <li class="list-group-item"><a href="bclassify/add.php" target="right">大分类添加</a></li>
				</ul>
			</div>
		</div>
		<!-- 小分类管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel8" data-toggle="collapse" data-parent="#accordion">小分类管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel8">
				<ul class="list-group">
				  <li class="list-group-item"><a href="lclassify/select.php" target="right">小分类查看</a></li>
				  <li class="list-group-item"><a href="lclassify/add.php" target="right">小分类添加</a></li>
				</ul>
			</div>
		</div>
		<!-- 价格区间管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel9" data-toggle="collapse" data-parent="#accordion">价格区间管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel9">
				<ul class="list-group">
				  <li class="list-group-item"><a href="pricesection/select.php" target="right">价格区间查看</a></li>
				  <li class="list-group-item"><a href="pricesection/add.php" target="right">价格区间添加</a></li>
				</ul>
			</div>
		</div>
		<!-- 轮播图管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel2" data-toggle="collapse" data-parent="#accordion">轮播图管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel2">
				<ul class="list-group">
				  <li class="list-group-item"><a href="carousel/select.php" target="right">轮播图查看</a></li>
				  <li class="list-group-item"><a href="carousel/add.php" target="right">轮播图添加</a></li>
				</ul>
			</div>
		</div>
		<!-- 广告管理 -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<a href="#panel4" data-toggle="collapse" data-parent="#accordion">广告管理</a>
				</div>
			</div>
			<div class="panel-collapse collapse" id="panel4">
				<ul class="list-group">
				  <li class="list-group-item"><a href="advertising/select.php" target="right">广告查看</a></li>
				  <li class="list-group-item"><a href="advertising/add.php" target="right">广告添加</a></li>
				</ul>
			</div>
		</div>
		
	</div>
</div>