<?php 
if(!$_COOKIE){
	echo "<script>location.href='../logon.php'</script>";
	exit;
}
setcookie("user",'',time()-1,"/");
echo "<script>location.href='../logon.php'</script>";
 ?>
