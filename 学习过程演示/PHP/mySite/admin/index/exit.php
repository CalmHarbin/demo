<?php 
session_start();
$_SESSION['username']='';//清空session数组
setcookie("PHPSESSION","",time()-1,"/");//删除cookie文件
session_destroy();//删除服务器上的session文件
echo "<script>location.href='../logon.php'</script>";
 ?>