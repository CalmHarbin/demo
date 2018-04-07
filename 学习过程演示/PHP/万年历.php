<?php 
//年份
$years=$_GET["years"]?$_GET["years"]:date("Y");
//月份
$month=$_GET["month"]?$_GET["month"]:date("m");
//当前月份一号的时间戳
$first=strtotime("{$years}-{$month}-1");
//天数
$days=date("t",$first);
//1号是周几
$week=date("w",$first);
//上一月
$lastyear=$years;
$lastmonth=$month-1;
if($lastmonth<1){
	$lastyear--;
	$lastmonth=12;
}
//下一月
$nextyear=$years;
$nextmonth=$month+1;
if($nextmonth>12){
	$nextyear++;
	$nextmonth=1;
}
 ?>

 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>万年历</title>
 	<link rel="stylesheet" href="bs/bootstrap.min.css">
 	<script src="bs/jquery-3.2.1.js"></script>
 	<script src="bs/bootstrap.min.js"></script>
 	<style>
	.container{
		text-align: center;
	}
	.table{
		margin: 0 auto;
		width: 700px;
	}
	th{
		text-align: center;
	}
 	</style>
 </head>
 <body>
 	<div class="container">
 		<h3>万年历 <?php echo "$years"; ?>年 <?php echo "$month"; ?>月</h3>
 		<table class="table table-bordered">
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
 			for($i=1-$week;$i<=$days;){//$i从1-星期几开始
 				echo "<tr>";
 				for ($j=0; $j <7 ; $j++,$i++) { 
					if($i>$days||$i<1){
						echo "<td>&nbsp;</td>";
					}else{
						echo "<td>{$i}</td>";
					}				
 				}
 				echo "</tr>";
 			}
 			 ?>
 		</table>
 		<h4>
 			<a href="万年历.php?years=<?php echo "$lastyear"; ?>&month=<?php echo "$lastmonth"; ?>">上一月</a>|
 			<a href="万年历.php?years=<?php echo "$nextyear"; ?>&month=<?php echo "$nextmonth"; ?>">下一月</a>
 		</h4>
 	</div>
 </body>
 </html>
