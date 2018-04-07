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
	<title>个人中心</title>
	<link rel="stylesheet" href="public/css/index.css">
	<script src="../public/js/jquery.js"></script>
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
	.main>.right ul li.info .form-group{
		line-height: 50px;
	}
	.main>.right ul li.info .form-group label{
		display: inline-block;
		width: 150px;
		text-align: right;
		padding-right: 15px;
	}
	.main>.right ul li.info .form-group input[type=text]{
		width: 300px;
	}
	.main>.right ul li.info input[type=submit]{
		display: block;
		width: 100px;
		margin-left:250px;
	}
	.main>.right ul li table{
		border-collapse: collapse;
		text-align: center;
		width: 100%;
	}
	.main>.right ul li table td{
		padding:5px;
	}
	.main>.right ul li a{
		color: blue;
	}
	.main>.right ul li div{
		line-height: 50px;
	}
	.main>.right ul li label{
		display: inline-block;
		width: 150px;
		text-align: right;
		padding-right: 15px;
	}
	.main>.right ul li input{
		width: 300px;
	}
	.main>.right ul li.update input[type=submit]{
		width:150px;
		margin-left: 200px;
	}
	.main>.right ul li.address input[type=submit]{
		width:100px;
		margin-left: 250px;
	}
	.main>.right ul li input[type=radio]{
		width: 20px;
	}
	</style>
</head>
<body>
	<!-- 头部 -->
	<?php include "public/common/header.php";?>
	<!-- 主体内容 -->
	<section>
		<div class="main">
			<div class="left">
				<ul>
					<li>
						<a href="javascript:">我的资料</a>
					</li>
					<li>
						<a href="javascript:">我的订单</a>
					</li>
					<li>
						<a href="javascript:">我的收藏</a>
					</li>
					<li>
						<a href="javascript:">我的评论</a>
					</li>
					<li>
						<a href="javascript:">我的收获地址</a>
					</li>
					<li>
						<a href="javascript:">修改密码</a>
					</li>
					<li>
						<a href="personal/exit.php">退出登录</a>
					</li>
				</ul>
			</div>
			<div class="right">
				<ul>
					<li class="info">
						<?php 
						$sql="select datum.*,user.id userid from user,datum where datum.user_id=user.id&&user.username='{$_COOKIE['user']}'";
						$smt=$pdo->prepare($sql);
						$smt->execute();
						$row=$smt->fetch();
						 ?>
						<form action="personal/update.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>我的头像</label>
								<img src="/mySite/public/uploads/datum/<?php echo $row['img'] ?>" alt="" width="120px" height="120px">
							</div>
							<div class="form-group">
								<label>更换头像</label>
								<input type="file" name="file">
							</div>
							<div class="form-group">
								<label>我的性别</label>
								<input type="radio" name="sex" value="1" <?php if($row['sex'])echo "checked"; ?>>男
								<input type="radio" name="sex" value="0" <?php if(!$row['sex'])echo "checked"; ?>>女
							</div>
							<div class="form-group">
								<label>我的积分</label>
								<input type="text" disabled value="<?php echo $row['award'] ?>">
							</div>
							<div class="form-group">
								<label>我的联系方式</label>
								<input type="text" name="phone" id="phone" value="<?php echo $row['phone'] ?>">
							</div>
							<div class="form-group">
								<label>我的QQ</label>
								<input type="text" name="QQ" id="QQ" value="<?php echo $row['QQ'] ?>">
							</div>
							<div class="form-group">
								<label>我的生日</label>
								<input type="text" name="birthday" id="birthday" value="<?php echo $row['birthday'] ?>">
							</div>
							<div class="form-group">
								<label>我的家庭地址</label>
								<input type="text" name="address" value="<?php echo $row['address'] ?>">
							</div>
							<input type="hidden" name="img" value="<?php echo $row['img'] ?>">
							<input type="hidden" name="user_id" value="<?php echo $row['userid'] ?>">
							<input type="submit" value="修改" id="submit">
						</form>
					</li>
					<li class="indent">
						<?php 
						$sqlindent="select indent.orderNumber,states.state,address.*,shop.name shopname,shop.img,message.content from user,indent,states,address,shop,message where indent.states_id=states.id&&indent.address_id=address.id&&indent.user_id=user.id&&indent.shop_id=shop.id&&indent.message_id=message.id&&user.username='{$_COOKIE['user']}'";
						$smtindet=$pdo->prepare($sqlindent);
						$smtindet->execute();
						$rowsindet=$smtindet->fetchAll();
						 ?>
						<table border=1>
							<tr>
								<th>订单号</th>
								<th>订单状态</th>
								<th>收件人</th>
								<th>联系方式</th>
								<th>收获地址</th>
								<th>商品名称</th>
								<th>商品图片</th>
								<th>我的备注</th>
							</tr>
							<?php 
							foreach ($rowsindet as $rowindent) {
								echo "<tr><td>{$rowindent['orderNumber']}</td>
									<td>{$rowindent['state']}</td>
									<td>{$rowindent['name']}</td>
									<td>{$rowindent['phone']}</td>
									<td>{$rowindent['address']}</td>
									<td>{$rowindent['shopname']}</td>
									<td><img src='/mySite/public/uploads/shop/th_{$rowindent['img']}'></td>
									<td>{$rowindent['content']}</td></tr>";
							}
							 ?>
						</table>
					</li>
					<li class="collect">
						<?php 
						$sqlcollect="select collect.*,shop.name,shop.img from collect,user,shop where collect.user_id=user.id&&collect.shop_id=shop.id&&user.username='{$_COOKIE['user']}'";
						$smtcollect=$pdo->prepare($sqlcollect);
						$smtcollect->execute();
						$rowscollect=$smtcollect->fetchAll();
						 ?>
						<table border=1>
							<tr>
								<th>商品名称</th>
								<th>图片</th>
								<th>收藏时间</th>
								<th></th>
							</tr>
							<?php 
							foreach ($rowscollect as $rowcollect) {
								echo "<tr><td>{$rowcollect['name']}</td>
									  <td><img src='/mySite/public/uploads/shop/th_{$rowcollect['img']}'/></td>
									  <td>{$rowcollect['time']}</td>
									  <td><a href='detail.php?shop_id={$rowcollect['shop_id']}'>立即购买</a></td>
									  </tr>";
							}			
							 ?>
						</table>
					</li>
					<li class="evaluate">
						<table border=1>
							<?php 
							$sqlevaluate="select evaluate.*,shop.name,shop.img from evaluate,user,shop where evaluate.user_id=user.id&&evaluate.shop_id=shop.id&&user.username='{$_COOKIE['user']}'";
							$smtevaluate=$pdo->prepare($sqlevaluate);
							$smtevaluate->execute();
							$rowsevaluate=$smtevaluate->fetchAll();
							 ?>
							<tr>
								<th>商品名称</th>
								<th>图片</th>
								<th>评价时间</th>
								<th>评价等级</th>
								<th>评论内容</th>
							</tr>
							<?php 
							foreach ($rowsevaluate as $rowevaluate) {
								echo "<tr><td>{$rowevaluate['name']}</td>
									  <td><img src='/mySite/public/uploads/shop/th_{$rowevaluate['img']}'/></td>
									  <td>{$rowevaluate['time']}</td>
									  <td>{$rowevaluate['grade']}星</td>
									  <td>{$rowevaluate['content']}</td>
									  </tr>";
							}			
							 ?>
						</table>
					</li>
					<li class="address">
						<table border=1>
							<?php 
							$sqladdress="select address.*,user.id user_id from user,address where address.user_id=user.id&&user.username='{$_COOKIE['user']}'";
							$smtaddress=$pdo->prepare($sqladdress);
							$smtaddress->execute();
							$rowsaddress=$smtaddress->fetchAll();
							 ?>
							<tr>
								<th>收件人</th>
								<th>联系电话</th>
								<th>收获地址</th>
								<th>默认地址</th>
								<th></th>
								<th></th>
							</tr>
							<?php 
							foreach ($rowsaddress as $rowaddress) {
								echo "<tr><td>{$rowaddress['name']}</td>
								      <td>{$rowaddress['phone']}</td>
								      <td>{$rowaddress['address']}</td>
								      <td>";
								      if($rowaddress['isdefault']){
								      	echo "是";
								      }else{
								      	echo "否";
								      }
								      echo "</td>
								      <td><a href='personal/revamp.php?address_id={$rowaddress['id']}'>修改</a></td>
								      <td><a href='javascript:' class='del' address_id='{$rowaddress['id']}'>删除</a></td></tr>";
							}
							 ?>
						</table>
						<form action="personal/add.php" method="post">
							<div class="form-group">
								<label>收件人</label>
								<input type="text" name="name">
							</div>
							<div class="form-group">
								<label>联系电话</label>
								<input type="text" name="phone" id="addphone">
							</div>
							<div class="form-group">
								<label>练习地址</label>
								<input type="text" name="address">
							</div>
							<input type="hidden" name="user_id" value="<?php echo $rowaddress['user_id'] ?>">
							<input type="submit" id="addsubmit" value="添加收货地址">
						</form>
						<script>
						$("#addphone").blur(function(){
							var val=$(this).val();
							if(!val.match(/^1\d{10}$/g)){
								alert("手机格式不正确")
								$("#addsubmit").attr({"disabled":"disabled"});
							}else{
								$("#addsubmit").removeAttr("disabled");
							}
						})

						$(".main>.right ul li.address .del").click(function(){
							var address_id=$(this).attr("address_id");
							var that=$(this);
							$.get("personal/delete.php",{address_id:address_id},function(res){
								if(res){
									that.parent().parent().hide();
								}
							});
						});
						</script>
					</li>
					<li class="update">
						<form action="personal/verify.php" method="post">
							<div class="form-group">
								<label>请输入原密码</label>
								<input type="text" name="old">
							</div>
							<div class="form-group">
								<label>请输入新密码</label>
								<input type="password" id="one" placeholder="长度为6-32位字符" name="new">
							</div>
							<div class="form-group">
								<label>请再次输入新密码</label>
								<input type="password" id="two">
							</div>
							<input type="submit" value="确认修改密码">
						</form>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<div class="clear"></div>
	<!-- 底部 -->
	<?php include "public/common/footer.php" ?>
</body>
<script>
	//根据page的值确定命中选项
	$(document).ready(function(){
		//if(!location.search)
		var url=location.search.match(/page=\d*/g)?location.search.match(/page=\d*/g):"page=1";
		var idx=url.toString().match(/[0-9]*/g)?url.toString().match(/\d/g):1;
		if(typeof(idx)!=Number){
			idx=idx.toString().replace(/,/g,'')*1;
		}
		if(idx>6){
			idx=1;
		}
		$(".main>.left li").eq(idx-1).addClass("active");
		$(".main>.right li").eq(idx-1).addClass("active");
	});

	//验证格式
	$("#submit").click(function(){
		var phone=$("#phone").val();
		if(!phone.match(/^1\d{10}$/g)){
			alert("手机号码格式不正确")
			return false;
		}
		var QQ=$("#QQ").val();
		if(!QQ.match(/^\d{6,10}$/g)){
			alert("QQ格式不正确")
			return false;
		}
		var birthday=$("#birthday").val();
		if(!birthday.match(/^\d{8}$/g)){
			alert("生日格式不正确")
			return false;
		}
	});

	//点击切换
	$(".main>.left li").click(function(){
		$(this).addClass("active").siblings().removeClass("active");
		var idx=$(".main>.left li").index($(this));
		$(".main>.right li").eq(idx).addClass("active").siblings().removeClass("active");
	});
	$("#two").blur(function(){
		if($(this).val()!==$("#one").val()){
			alert("两次密码不一致!");
			$(".main>.right ul li.update :submit").attr({'disabled':'disabled'});
		}else{
			$(".main>.right ul li.update :submit").removeAttr('disabled');
		}
	});
</script>
</html>