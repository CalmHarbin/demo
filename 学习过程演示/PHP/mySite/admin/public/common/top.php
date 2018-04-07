<?php 
session_start();
if(!$_SESSION['username']){
	echo "<script>location.href='/mySite/admin/logon.php'</script>";
	exit;
}
 ?>
<nav class="navbar navbar-default">
	<div class="container">
		<div class="container-fluid">
			<div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="/mySite/admin/index.php">美食网</a>
		    </div>
			
			<ul class="nav navbar-nav navbar-right" id="bs-example-navbar-collapse-1">
		        <li><a href="#">欢迎<?php echo $_SESSION['username'] ?>登录</a></li>
		        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理 
			          	<span class="caret"></span>
			          </a>
			          <ul class="dropdown-menu">
			            <li><a href="amend.php">修改密码</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="index/exit.php">退出登录</a></li>
			          </ul>
		        </li>
		     </ul>
		</div>
	</div>
</nav>