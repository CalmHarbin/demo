<!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>从数据库中取数据</title>
 	<link rel="stylesheet" href="bs/bootstrap.min.css">
 	<script src="bs/jquery-3.2.1.js"></script>
 	<script src="bs/bootstrap.min.js"></script>
 </head>
 <body>
 	<div class="container">
 		<h1 class="page-header">用户表</h1>
 		<table class="table table-striped table-bordered table-hover">
 			<tr>
 				<th>id</th>
 				<th>用户名</th>
 				<th>密码</th>
 				<th>删除</th>
 			</tr>
			<?php 
			//连接数据库,本机=localhost;数据库=test
			$pdo=new PDO('mysql:host=localhost;dbname=test','root','123');
			//设置客户端字符集
			$pdo->exec('set names utf8');
			//mysql语句
			$sql='select * from user';
			//执行sql语句
			$smt=$pdo->query($sql);
			$rows=$smt->fetchAll(PDO::FETCH_ASSOC);//返回关联数组
			// $rows=$smt->fetchAll(PDO::FETCH_NUM);//返回索引数组
			// $rows=$smt->fetchAll(PDO::FETCH_BOTH);//返回混合数组 
			// $rows=$smt->fetchAll(PDO::FETCH_OBJ);//返回对象
			// echo "<pre>";
			// print_r($rows);
			// echo "</pre>";
			foreach ($rows as $row) {
				echo "<tr id={$row['id']}>";
				echo "<td>{$row['id']}</td>";
				echo "<td>{$row['username']}</td>";
				echo "<td>{$row['password']}</td>";
				echo "<td><a href='javascript:' num='".$row['id']."'>删除</a></td>";
				echo "</tr>";
			}
 			?>
 		</table>
 	</div>
 </body>
 <script>
 // var A=document.getElementsByTagName('a');
 // var len=A.length;
 // for (var i=0;i<len;i++){
 // 	A[i].onclick=function(){
 // 		//ajax请求
 // 		id=this.getAttribute('num');
 // 		var xhr=new XMLHttpRequest();//获取xhr对象
 // 		xhr.open('get',"delete.php?id="+id+"",true);//请求
 // 		xhr.send();//发送请求
 // 		xhr.onreadystatechange=function(){//监听请求状态
 // 			if(xhr.readyState==4){
 // 				data=xhr.responseText;//获取响应数据
 // 				console.log(data);
 // 				if(data){//删除成功
 // 					var tr=document.getElementById(id);
 // 					tr.style.display='none';
 // 				}
 // 			}
 // 		}
 // 	}
 // }
//jquery中ajax技术
 $('a').click(function(){
 	id=$(this).attr('num');
 	that=$(this);
 	//console.log(id);
 	//ajax
 	$.get('delete.php',{id:id},function(res){
		if(res){
			that.parent().parent().hide();
		}
 	});
 });
 </script>
 </html>

