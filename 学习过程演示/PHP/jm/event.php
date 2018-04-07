<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="jm/jm.min.css">
	<script src="jquery.min.js"></script>
	<script src="jm/jm.min.js"></script>
	<title>jQuery mobile</title>
</head>
<body>
	<div id="one" data-role="page">
		<div data-role="header" data-theme="a">
			<h1>我是标题</h1>
		</div>
		<div data-role="content">
			<button data-inline="true">点我</button>	
		</div>
		<div data-role="footer" data-position="fixed">
			<h1>我是脚部</h1>
		</div>
	</div>
</body>
<script>
	$("button").on("touchcancel",function(){
		alert(11);
	});
	/*	tap点击事件
		taphold按住一秒触发

		swipe水平滑动超过30px触发
		swipeleft 左滑30px
		swiperight 右滑30px

		scrollstart 页面滚动事件
		scrollstop  页面滚动停止事件

		orientationchange 旋转手机事件  Window对象
  
		 window.orientation=0   垂直
		 window.orientation=90|-90  水平
		
		touchstart 手指按下事件
		touchmove  手指移动事件
		touchend   手指弹起事件
		touchenter 手指移入事件
		touchleave 手指移出事件
		touchcancel 触摸被取消事件
	*/	
</script>
</html>