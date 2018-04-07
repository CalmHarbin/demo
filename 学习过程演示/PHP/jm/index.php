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
		<div  id="myPopup" data-theme="b">
			<a href="" data-role="button" data-inline="ture" data-icon="home">首页</a>
			<a href="" data-role="button" data-inline="ture" data-icon="grid">选项</a> 
			<a href="" data-role="button" data-inline="ture" data-icon="search">搜索</a>
			<a href="#two" data-role="button" data-icon="arrow-r" data-iconpos="right" data-corners="true">下一页</a>
			<a href="" data-role="button" data-icon="info" data-iconpos="top">信息</a>
		</div>
		<div data-role="footer" data-position="fixed">
			<h1>我是脚部</h1>
		</div>
	</div>
	<div id="two" data-role="page">
		<div data-role="header">
			<h1>我是标题</h1>
		</div>
		<div data-role="content">
			<div data-role="collapsible" data-collapsed="false">
			  <h2>点击我 - 我可以折叠！</h2>
			  <text>现在我默认是展开的。</text>
			</div>
		</div>
		<div data-role="footer">
			<h1>我是脚部</h1>
		</div>
	</div>

</body>
</html>