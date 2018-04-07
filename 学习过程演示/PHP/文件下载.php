<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件下载</title>
</head>
<body>
		<?php 
			echo "<table width='500px' border='1px' cellspacing=0>";
			$arr=scandir("images");
			// echo "<pre>";
			// print_r($arr);
			// echo "</pre>";
			foreach ($arr as $key => $value) {
				echo "<tr>";
				if($key>1){
					echo "<td><img src='images/".$value."' width='200px'></td>";
					echo "<td><a href='download.php?file=".$value."'>下载</a></td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		 ?>
</body>
</html>
