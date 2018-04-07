<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员登录</title>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<script src="../public/js/jquery-3.2.1.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
	<style>
	.wrap{
		position: absolute;
		top: 50%;
		left: 50%;
		width: 500px;
		height: 300px;
		margin-left: -250px;
		margin-top: -150px;
	}
	.col-md-2{
		padding-right: 0;
	}
	.form-horizontal{
		 margin-top: 8px;
   		 margin-left: -43px;
	}
	</style>
</head>
<body>
	<div class="wrap">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">请登录</div>
			</div>
			<div class="panel-body">
				<form action="verify.php" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="" class="col-md-2 control-label">账号:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" placeholder="Username" name="username">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-md-2 control-label">密码:</label>
						<div class="col-md-10">
							<input type="password" class="form-control" placeholder="password" name="password">
						</div>
					</div>
					<input type="submit" value="登录" class="btn btn-primary center-block">
				</form>
			</div>
			<div class="panel-footer">
				<a href="#">忘记密码?</a>
			</div>
		</div>
	</div>
	
</body>
</html>