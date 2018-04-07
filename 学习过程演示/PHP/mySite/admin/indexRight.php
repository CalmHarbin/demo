<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='logon.php'</script>";
	exit;
}
 ?>
 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
 	<title></title>
 	<style>
		*{
			margin: 0;
			padding: 0;
		}
 	</style>
 </head>
 <body>
 	 <div class="thumbnail">
	  <img src="public/images/index.jpg" alt="每天进步一点点">
	  <div class="caption">
		    <h3>欢迎登陆网站后台管理</h3>
		    <p>在这里就是你的世界</p>
		    <p>
		    	<a href="index.php" target="top" class="btn btn-primary" role="button">返回首页</a> 
		    	<a href="index/exit.php" target="top" class="btn btn-default" role="button">退出系统</a>
		    </p>
	  </div>
	</div>
 </body>
 </html>
