<?php
$i=1;
while($i<10){
	$j=1;
	while($j<=$i){
		echo "$j*$i=".$i*$j;
		echo "&nbsp&nbsp&nbsp";
		$j++;
	}
	echo "<br>";
	$i++;
}
 ?>