<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="holder.js"></script> -->

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="progress">
	<div class="progress-bar progress-bar-info progress-bar-striped active" style="width:50%">50%</div>
</div>
</div>
<script type="text/javascript" src="http://music.163.com/#/search/m/?id=28193075&s='刚好遇见你'&type=1&callback=show"></script>
	<script>
	// $.getJSON('http://music.163.com/#/search/m/?id=28193075&s=刚好遇见你&type=1', {}, function(json, textStatus) {
	// 		console.log(json)
	// });
	function show(res){
		console.log(res);
	}
// 	$.ajax({    
//         url:"http://music.163.com/#/search/m/?id=28193075&s=刚好遇见你&type=1",    
//         dataType:'jsonp',    
//         data:'',    
//         jsonp:'callback',  //传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)  
  
//         success:function(result) {    
//             //console.log(result)
//         },  
//         error:function(){  
//             //错误处理  
// 		}
// });
	</script>
</body>
</html>
