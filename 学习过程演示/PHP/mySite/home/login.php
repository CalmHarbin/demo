<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/login.css">
	<script src="../public/js/jquery.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
</head>
<body>
	<img src="public/images/logon.jpg" alt="" class="adv">
	<div class="wrap">
		<form action="login/userlogin.php" method="post">
			<h4>用户注册</h4>
			<a href="logon.php" class="have">已有账号<span class="origin">在此登录</span></a>
			<div class="form-group">
				<input type="text" class="form-control" name="username" id="username" required>
				<span class="hint">3-12个字符,建议字母、数字、下划线组合</span>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" required>
				<span class="hint">6-32个字符，建议使用字母加数字或符号组合</span>
			</div>
			<div class="form-group">
				<input type="text" class="form-control code" name="vcode" required>
				<img src="/mySite/public/common//vcode.php" width="85px" height="35px" alt="">
				<span class="origin chenge">换一张</span>
				<span class="hint">按右图填写，不区分大小写</span>
				<input type="submit" id="submit" class="btn btn-block btn-danger" value="注册">
			</div>
		</form>
	</div>
</body>
<script>
	$(".form-group .chenge").click(function(){
		$(this).prev().attr({"src":"/mySite/public/common//vcode.php?img="+Math.random()});
	});
	$(":submit").click(function(){
		var reg1=/^\D\w{1,11}/g;//账号
		var reg2=/.{6,32}/g;
		if(!reg1.test($(":text").eq(0).val())){
			alert("账号只能含有字母数字下划线,并不能以数字开头");
			return false;
		}
		if(!reg2.test($(":password").val())){
			alert("密码请输入6-32位字符,不能含有回车");
			return false;
		}
	});
	$("#username").blur(function(){
		var val=$(this).val();
		$.get("login/select.php",{username:val},function(res){
			if(res){
				alert('该用户名已存在!');
				$("#submit").attr({"disabled":"disabled"});
			}else{
				$("#submit").removeAttr("disabled");
			}
		})
	});
</script>
</html>