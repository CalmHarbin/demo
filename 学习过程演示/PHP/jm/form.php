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
		<div data-role="header">
			<a href="" data-role="button" data-icon="home" class="ui-btn-left">首页</a>
			<h1>表单实例</h1>
			<a href="" data-role="button" data-icon="search">搜索</a>
			<div data-role="navbar">
				<ul>
					<li><a href="" class="ui-btn-active">导航一</a></li>
					<li><a href="">导航二</a></li>
					<li><a href="">导航三</a></li>
				</ul>
			</div>
		</div>
		<div data-role="content">
			<form action="" method="post">
				<label>用户名
					<input type="text" name="username" placeholder="请输入用户名" required>
				</label>
				<label>密码
					<input type="password" name="password">
				</label>
				<label>邮箱
					<input type="email" name="email">
				</label>
				<label>生日
					<input type="date">
				</label>
				<label>年龄
					<input type="number" min="1" max="150">
				</label>
				<label>搜索
					<input type="search">
				</label>
				<label>滑动
					<input type="range" min="1" max="150" data-highlight="true">
				</label>
				<label>开关</label>
					<select data-role="slider">
						<option value="on" >On</option>
      					<option value="off" selected>Off</option>
					</select>

				<fieldset data-role="controlgroup">
					<legend>请选择性别:</legend>
					<label for="man">男</label>
					<input type="radio" id="man" name="sex" value="1" checked>
					<label for="woman">女</label>
					<input type="radio" id="woman" name="sex" value="0">
				</fieldset>

				<fieldset data-role="controlgroup" data-type="horizontal">
					<legend>请选择爱好;</legend>
					<label for="read">看书</label>
					<input type="checkbox" id="read" name="love[]" value="1" checked>
					<label for="music">音乐</label>
					<input type="checkbox" id="music" name="love[]" value="2">
					<label for="swimming">游泳</label>
					<input type="checkbox" id="swimming" name="love[]" value="3" checked>
					<label for="video">电影</label>
					<input type="checkbox" id="video" name="love[]" value="4">
					<label for="play">游戏</label>
					<input type="checkbox" id="play" name="love[]" value="5">
				</fieldset>

				<label>选择日期
					<select>
						<optgroup label="工作日">
							<option value="1">星期一</option>
							<option value="2">星期二</option>
							<option value="3">星期三</option>
							<option value="4">星期四</option>
							<option value="5">星期五</option>
						</optgoup>
						<optgroup label="双休日">
							<option value="6">星期六</option>
							<option value="0">星期天</option>
						</optgroup>
					</select>
				</label>

				<label>我可以多选,和自定义  
					<select data-native-menu="false" multiple >
						<optgroup label="工作日">
							<option value="1">星期一</option>
							<option value="2">星期二</option>
							<option value="3">星期三</option>
							<option value="4">星期四</option>
							<option value="5">星期五</option>
						</optgoup>
						<optgroup label="双休日">
							<option value="6">星期六</option>
							<option value="0">星期天</option>
						</optgroup>
					</select>
				</label>

				<label>留言
					<textarea></textarea>
				</label>
				
				<input type="submit" value="提交" data-inline="true">
				<input type="reset" value="重置" data-inline="true">
			</form>
		</div>
		<div data-role="footer" data-position="fixed">
			<h1>我是脚部</h1>
		</div>
	</div>
</body>
</html>