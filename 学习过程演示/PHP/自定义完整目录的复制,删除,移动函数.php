<?php 
//删除目录,传要删除的目录路径
function deldir($dir){
	$arr=scandir($dir);
	foreach ($arr as $key => $value) {
		if($key>1){
			$filedir=$dir.'/'.$value;//当前文件路径
			if(is_dir($filedir)){//判断当前是不是目录
				deldir($filedir);//递归调用
				//清空目录
				//rmdir($filedir);//使用这句时,删除目录中的所有文件但是保留了目录,和16行只能选一
			}else{
				unlink($filedir);//删除文件
			}//
		}
	}
	//删除目录
	rmdir($dir);//删除空目录
}
//$dir="dir1";
//把要删除的目录传进去
//deldir($dir);


//清空目录,传要清空的目录路径
function cleardir($dir){
	$arr=scandir($dir);
	foreach ($arr as $key => $value) {
		if($key>1){
			$filedir=$dir.'/'.$value;//当前文件路径
			if(is_dir($filedir)){//判断当前是不是目录
				deldir($filedir);//递归调用
				//清空目录
				rmdir($filedir);//使用这句时,删除目录中的所有文件但是保留了目录,和16行只能选一
			}else{
				unlink($filedir);//删除文件
			}//
		}
	}
	//删除目录
	//rmdir($dir);//删除空目录
}


//复制目录,复制$dir1到$dir2
function copydir($dir1,$dir2){
	if(!file_exists($dir2)){
		mkdir($dir2);
	}
	$arr=scandir($dir1);
	foreach ($arr as $key => $value) {
		if ($key>1) {
			$filedir=$dir1.'/'.$value;//当前文件路径
			$createdir=$dir2.'/'.$value;
			if (is_dir($filedir)) {
				copydir($filedir,$createdir);
			}else{
				copy($filedir,$createdir);
			}
		}
	}
}
$dir1="../dir";
$dir2="./";
//copydir($dir1,$dir2);
//复制目录,复制$dir1到$dir2下
function copyTodir($dir1,$dir2){
	$file=substr($dir1, strrpos($dir1, "/"));//提取要创建的目录名
	mkdir($dir2.'/'.$file);//创建目录
	$arr=scandir($dir1);
	foreach ($arr as $key => $value) {
		if ($key>1) {
			$filedir=$dir1.'/'.$value;//当前文件路径
			$createdir=$dir2.'/'.$file;
			if (is_dir($filedir)) {
				copyTodir($filedir,$createdir);//是目录就再次调用自己,并把当前目录传进去
			}else{
				copy($filedir,$createdir.'/'.$value);//文件就直接复制
			}
		}
	}
}
//copyTodir($dir1,$dir2);

//移动目录,把dir1移动到$dir2下
function movedir($dir1,$dir2){
	//先复制
	$file=substr($dir1, strrpos($dir1, "/"));//提取要创建的目录名
	mkdir($dir2.'/'.$file);//创建目录
	$arr=scandir($dir1);
	foreach ($arr as $key => $value) {
		if ($key>1) {
			$filedir=$dir1.'/'.$value;//当前文件路径
			$createdir=$dir2.'/'.$file;
			if (is_dir($filedir)) {
				copyTodir($filedir,$createdir);//是目录就再次调用自己,并把当前目录传进去
			}else{
				copy($filedir,$createdir.'/'.$value);//文件就直接复制
			}
		}
	}
	//再删除
	foreach ($arr as $key => $value) {
		if($key>1){
			$filedir=$dir1.'/'.$value;//当前文件路径
			if(is_dir($filedir)){//判断当前是不是目录
				deldir($filedir);//递归调用
				//清空目录
				//rmdir($filedir);//使用这句时,删除目录中的所有文件但是保留了目录,和16行只能选一
			}else{
				unlink($filedir);//删除文件
			}//
		}
	}
	//删除目录
	rmdir($dir1);//删除空目录
}
movedir($dir1,$dir2);

 ?>
