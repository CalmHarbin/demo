<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>日历表格</title>
	<style>
	td{
		text-align: center;
		empty-cells: show;
	}
	</style>
</head>
<body>
	<center>
		<h1>日历表格</h1>
		<table width="800px" border="1px" cellspacing="0">
			<tr>
				<th>周日</th>
				<th>周一</th>
				<th>周二</th>
				<th>周三</th>
				<th>周四</th>
				<th>周五</th>
				<th>周六</th>
			</tr>
			<?php 
			$days=31;
			$onoff='on';
			for($i=1;$i<=$days;){
				if($onoff=='on'){//隔行换色
					echo "<tr style='background:#aff'>";
					$onoff='off';
				}else{
					echo "<tr></tr>";
					$onoff='on';
				}

				for($j=0;$j<7;$j++,$i++){//每循环一次$i++;
					if($i>$days){
						echo "<td></td>";
					}else{
						echo "<td>{$i}</td>";
					}
				}
				echo "</tr>";
			}
			
			 ?>
		</table>
	</center>
</body>
</html>
